#include <WiFi.h>
#include <FirebaseESP32.h> 
#include <HardwareSerial.h>
#include <time.h>       

// WiFi Config
#define WIFI_SSID "Mencari Tempat Berlabuh"
#define WIFI_PASSWORD "terangijiwa"

// Firebase Config
#define FIREBASE_HOST "steinlie-realtime-default-rtdb.asia-southeast1.firebasedatabase.app"
#define FIREBASE_AUTH "ioR8EfB7hQynfuQLFncJhuUbzjTiDnqIxNNemBh"

// Firebase objects
FirebaseData fbdo;
FirebaseAuth auth;
FirebaseConfig config;

// UART2 Config
#define TXD2 19 
#define RXD2 21 
HardwareSerial mySerial(2); 

String receivedMessage = "";
String parsedKendaraan = "";
String parsedStatus = "";
String parsedUid = "";
String parsedNama = "";
String parsedNim = "";
String parsedJurusan = "";
bool parsedSlotStatus[4];
String currentTimestamp = "";
String currentDate = "";
String currentTime = "";
bool isTimeSynced = false;

struct JadwalKendaraan {
  String jamMulai;
  String jamSelesai;
  String operasional;
};

JadwalKendaraan jadwalMobil;
JadwalKendaraan jadwalMotor;

unsigned long lastJadwalReadTime = 0;
const long jadwalReadInterval = 5000; 

void connectToWiFi();
void initializeFirebase();
void syncNTPTime();
String getFormattedTimestamp();
void handleWiFiConnection();
void readAndProcessSerial();
bool parseReceivedData(String message);
void sendParkingDataToFirebase();
void updateParkingSpotStatus();
void readJadwalSistemFromFirebase(); 
void sendJadwalToESPMaster();     

void syncNTPTime() {
    configTime(7 * 3600, 0, "pool.ntp.org", "time.nist.gov"); 
    Serial.print("⏳ Sinkronisasi waktu NTP");
    time_t now = time(nullptr);
    int attempts = 0;
    while (now < 100000 && WiFi.status() == WL_CONNECTED && attempts < 20) {
        delay(500);
        Serial.print(".");
        now = time(nullptr);
        attempts++;
    }
    if (WiFi.status() == WL_CONNECTED && now >= 100000) {
        Serial.println("\n✅ Waktu tersinkronisasi.");
        isTimeSynced = true;
    } else {
        Serial.println("\n❌ Gagal sinkronisasi waktu, WiFi terputus atau tidak ada koneksi.");
        Serial.println("     Firebase tidak akan dapat mengirim data tanpa koneksi waktu.");
        isTimeSynced = false;
    }
}

String getFormattedTimestamp() {
    struct tm timeinfo;
    if (!getLocalTime(&timeinfo)) {
        Serial.println("❌ Gagal mendapatkan waktu lokal (NTP mungkin belum sinkron).");
        return "unknown_time";
    }
    char buffer[25];
    strftime(buffer, sizeof(buffer), "%Y-%m-%d_%H:%M:%S", &timeinfo);
    return String(buffer);
}

void connectToWiFi() {
    WiFi.mode(WIFI_STA);
    WiFi.begin(WIFI_SSID, WIFI_PASSWORD);
    Serial.print("🔌 Menghubungkan ke WiFi");

    int retry = 0;
    while (WiFi.status() != WL_CONNECTED && retry < 20) {
        delay(500);
        Serial.print(".");
        retry++;
    }

    if (WiFi.status() == WL_CONNECTED) {
        Serial.println("\n✅ WiFi terhubung!");
        Serial.println("IP Address: " + WiFi.localIP().toString());
        syncNTPTime();
    } else {
        Serial.println("\n❌ Gagal terhubung ke WiFi. Program akan tetap berjalan, tapi Firebase tidak akan berfungsi.");
    }
}

void initializeFirebase() {
    config.host = FIREBASE_HOST;
    config.signer.tokens.legacy_token = FIREBASE_AUTH;
    Firebase.begin(&config, &auth);
    Firebase.reconnectWiFi(true);
}

void handleWiFiConnection() {
    if (WiFi.status() != WL_CONNECTED) {
        Serial.println("⚠️ WiFi tidak tersambung. Mencoba menyambung kembali...");
        delay(2000); 
        WiFi.begin(WIFI_SSID, WIFI_PASSWORD);
        if (WiFi.status() == WL_CONNECTED && !isTimeSynced) {
            syncNTPTime();
        }
    }
}

bool parseReceivedData(String message) {
    if (message.length() == 0) return false;

    int commaCount = 0;
    for (int i = 0; i < message.length(); i++) {
        if (message.charAt(i) == ',') {
            commaCount++;
        }
    }

    if (commaCount == 9) { 
        int commaIndices[9];
        int currentSearchIndex = 0;

        for (int i = 0; i < 9; i++) {
            commaIndices[i] = message.indexOf(',', currentSearchIndex);
            if (commaIndices[i] == -1) {
                Serial.println("⚠️ Error parsing data: Tidak semua koma ditemukan meskipun count-nya benar.");
                return false;
            }
            currentSearchIndex = commaIndices[i] + 1;
        }

        parsedKendaraan = message.substring(0, commaIndices[0]);
        parsedStatus = message.substring(commaIndices[0] + 1, commaIndices[1]);
        parsedUid = message.substring(commaIndices[1] + 1, commaIndices[2]);
        parsedNama = message.substring(commaIndices[2] + 1, commaIndices[3]);
        parsedNim = message.substring(commaIndices[3] + 1, commaIndices[4]);
        parsedJurusan = message.substring(commaIndices[4] + 1, commaIndices[5]);

        parsedSlotStatus[0] = (message.substring(commaIndices[5] + 1, commaIndices[6]) == "1");
        parsedSlotStatus[1] = (message.substring(commaIndices[6] + 1, commaIndices[7]) == "1");
        parsedSlotStatus[2] = (message.substring(commaIndices[7] + 1, commaIndices[8]) == "1");
        parsedSlotStatus[3] = (message.substring(commaIndices[8] + 1) == "1");

        Serial.println("📋 Data Terurai dari ESP Master:");
        Serial.println("Kendaraan: " + parsedKendaraan);
        Serial.println("Status   : " + parsedStatus);
        Serial.println("UID      : " + parsedUid);
        Serial.println("Nama     : " + parsedNama);
        Serial.println("NIM      : " + parsedNim);
        Serial.println("Jurusan  : " + parsedJurusan);
        Serial.print("Status Slot: ");
        for (int i = 0; i < 4; i++) {
            Serial.print(parsedSlotStatus[i] ? "Kosong " : "Terisi ");
        }
        Serial.println();
        return true;
    } else {
        Serial.println("⚠️ Format data tidak valid! Harap periksa jumlah koma.");
        Serial.println("     Diharapkan 9 koma, ditemukan: " + String(commaCount) + ". Data yang diterima: '" + message + "'");
        return false;
    }
}

void sendParkingDataToFirebase() {
    if (WiFi.status() != WL_CONNECTED) {
        Serial.println("❌ Tidak dapat mengirim data parkir: WiFi tidak terhubung.");
        return;
    }

    if (isTimeSynced) {
        currentTimestamp = getFormattedTimestamp();
        currentDate = currentTimestamp.substring(0, 10);
        currentTime = currentTimestamp.substring(11, 19);
    } else {
        Serial.println("⚠️ Waktu belum tersinkronisasi. Menggunakan timestamp 'unknown_time'.");
        currentTimestamp = "unknown_time";
        currentDate = "unknown_date";
        currentTime = "unknown_time";
    }

    String akses;
    if (parsedUid.equalsIgnoreCase("7A33B3")) { 
        akses = "petugas";
    } else {
        akses = "ktm";
    Serial.println("UID '" + parsedUid + "' terdeteksi, akses: " + akses);

    if (!(parsedStatus.equalsIgnoreCase("update") || parsedStatus.equalsIgnoreCase("KELUAR"))) {
        Serial.println("🚀 Mengirim data Mahasiswa ke Firebase...");
        if (!Firebase.setString(fbdo, "/Mahasiswa/" + parsedNim + "/Nama", parsedNama) ||
            !Firebase.setString(fbdo, "/Mahasiswa/" + parsedNim + "/Jurusan", parsedJurusan)) {
            Serial.println("❌ Gagal mengirim data Mahasiswa: " + fbdo.errorReason());
        } else {
            Serial.println("✅ Data Mahasiswa berhasil dikirim.");
        }

        FirebaseJson parkirJson;
        parkirJson.set("nim", parsedNim);
        parkirJson.set("nama", parsedNama);
        parkirJson.set("jurusan", parsedJurusan);
        parkirJson.set("akses", akses);
        parkirJson.set("tanggal", currentDate);
        parkirJson.set("waktu", currentTime);

        String parkirPath = "/parkir/" + parsedKendaraan + "/" + currentTimestamp;
        Serial.println("🚀 Mengirim data Parkir ke Firebase di path: " + parkirPath);
        if (!Firebase.setJSON(fbdo, parkirPath, parkirJson)) {
            Serial.println("❌ Gagal mengirim data Parkir: " + fbdo.errorReason());
        } else {
            Serial.println("✅ Data Parkir berhasil dikirim.");
        }
    } else {
        Serial.println("🚫 Status '" + parsedStatus + "' terdeteksi. Data tidak akan dikirim ke log parkir (/parkir).");
    }
}

void updateParkingSpotStatus() {
    if (WiFi.status() != WL_CONNECTED) {
        Serial.println("❌ Tidak dapat memperbarui data Tempat Parkir: WiFi tidak terhubung.");
        return;
    }

    FirebaseJson tempatParkirJson;
    for (int i = 0; i < 4; i++) {
        String slotName = "slot" + String(i + 1);
        String slotStatus = parsedSlotStatus[i] ? "available" : "occupied";
        tempatParkirJson.set(slotName, slotStatus);
    }
    String tempatParkirPath = "/tempat_parkir/" + parsedKendaraan;
    Serial.println("🚀 Memperbarui data Tempat Parkir di Firebase di path: " + tempatParkirPath);

    if (!Firebase.updateNode(fbdo, tempatParkirPath, tempatParkirJson)) {
        Serial.println("❌ Gagal memperbarui data Tempat Parkir: " + fbdo.errorReason());
    } else {
        Serial.println("✅ Data Tempat Parkir berhasil diperbarui.");
    }
}

void readAndProcessSerial() {
    while (mySerial.available()) { 
        receivedMessage = mySerial.readStringUntil('\n');
        receivedMessage.trim();
        Serial.println("📨 Diterima dari ESP Master: '" + receivedMessage + "'");

        if (parseReceivedData(receivedMessage)) {
            sendParkingDataToFirebase();
            updateParkingSpotStatus();
        }
    }
}

void readJadwalSistemFromFirebase() {
  if (WiFi.status() != WL_CONNECTED) {
    Serial.println("❌ Tidak dapat membaca jadwal: WiFi tidak terhubung.");
    return;
  }

  Serial.println("🚀 Membaca jadwal_sistem dari Firebase...");

  if (Firebase.getString(fbdo, "/jadwal_sistem/mobil/jam_mulai")) {
    jadwalMobil.jamMulai = fbdo.stringData();
  } else {
    Serial.println("❌ Gagal membaca jadwal_sistem/mobil/jam_mulai: " + fbdo.errorReason());
  }

  if (Firebase.getString(fbdo, "/jadwal_sistem/mobil/jam_selesai")) {
    jadwalMobil.jamSelesai = fbdo.stringData();
  } else {
    Serial.println("❌ Gagal membaca jadwal_sistem/mobil/jam_selesai: " + fbdo.errorReason());
  }

  if (Firebase.getString(fbdo, "/jadwal_sistem/mobil/operasional")) {
    jadwalMobil.operasional = fbdo.stringData();
  } else {
    Serial.println("❌ Gagal membaca jadwal_sistem/mobil/operasional: " + fbdo.errorReason());
  }

  if (Firebase.getString(fbdo, "/jadwal_sistem/motor/jam_mulai")) {
    jadwalMotor.jamMulai = fbdo.stringData();
  } else {
    Serial.println("❌ Gagal membaca jadwal_sistem/motor/jam_mulai: " + fbdo.errorReason());
  }

  if (Firebase.getString(fbdo, "/jadwal_sistem/motor/jam_selesai")) {
    jadwalMotor.jamSelesai = fbdo.stringData();
  } else {
    Serial.println("❌ Gagal membaca jadwal_sistem/motor/jam_selesai: " + fbdo.errorReason());
  }

  if (Firebase.getString(fbdo, "/jadwal_sistem/motor/operasional")) {
    jadwalMotor.operasional = fbdo.stringData();
  } else {
    Serial.println("❌ Gagal membaca jadwal_sistem/motor/operasional: " + fbdo.errorReason());
  }

  Serial.println("✅ Jadwal sistem berhasil dibaca:");
  Serial.println("Mobil - Jam Mulai: " + jadwalMobil.jamMulai + ", Jam Selesai: " + jadwalMobil.jamSelesai + ", Operasional: " + jadwalMobil.operasional);
  Serial.println("Motor - Jam Mulai: " + jadwalMotor.jamMulai + ", Jam Selesai: " + jadwalMotor.jamSelesai + ", Operasional: " + jadwalMotor.operasional);
}

void sendJadwalToESPMaster() {
  String messageMobil = "jadwal_mobil," + jadwalMobil.jamMulai + "," + jadwalMobil.jamSelesai + "," + jadwalMobil.operasional + "\n";
  String messageMotor = "jadwal_motor," + jadwalMotor.jamMulai + "," + jadwalMotor.jamSelesai + "," + jadwalMotor.operasional + "\n";
  
  mySerial.print(messageMobil);
  mySerial.print(messageMotor); // Kirim kedua jadwal
  
  Serial.println("⬆️ Mengirim jadwal ke ESP Master:");
  Serial.print(messageMobil);
  Serial.print(messageMotor);
}


void setup() {
    Serial.begin(115200);
    mySerial.begin(115200, SERIAL_8N1, RXD2, TXD2); 
    Serial.println("📥 ESP32 UART Receiver Siap");
    Serial.println("UART2 (mySerial) initialized with 115200 baud.");

    connectToWiFi();
    initializeFirebase();

    if (WiFi.status() == WL_CONNECTED) {
      readJadwalSistemFromFirebase();
      sendJadwalToESPMaster();
      lastJadwalReadTime = millis(); 
    }
}

void loop() {
    handleWiFiConnection();

    if (WiFi.status() == WL_CONNECTED) {
        readAndProcessSerial();

        if (millis() - lastJadwalReadTime >= jadwalReadInterval) {
            readJadwalSistemFromFirebase();
            sendJadwalToESPMaster();
            lastJadwalReadTime = millis();
        }
    } else {
        Serial.println("❌ Tidak ada koneksi WiFi, menunggu...");
    }

    delay(100);
}