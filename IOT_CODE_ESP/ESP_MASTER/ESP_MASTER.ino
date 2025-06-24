// espmaster.ino

#include <esp_now.h>
#include <WiFi.h>
#include <HardwareSerial.h> 

typedef struct struct_message {
    char uid[32];      
    char status[10];   
    char nama[50];
    char nim[20];
    char jurusan[30];
    bool slot[4];      
} struct_message;

typedef struct struct_jadwal_system {
    char jamMulaiMobil[6];    
    char jamSelesaiMobil[6];  
    char operasionalMobil[5];
    char jamMulaiMotor[6];
    char jamSelesaiMotor[6];
    char operasionalMotor[5];
} struct_jadwal_system;

struct_message myData;
struct_jadwal_system jadwalData;



uint8_t macMobil[] = {0x24, 0xDC, 0xC3, 0x98, 0xC0, 0xAC}; 
uint8_t macMotor[] = {0x3C, 0x8A, 0x1F, 0x9C, 0x53, 0x58}; 

esp_now_peer_info_t peerInfoMobil;
esp_now_peer_info_t peerInfoMotor;

#define TXD1 19 
#define RXD1 21 
HardwareSerial SerialData(1); 

bool compareMac(const uint8_t* mac1, const uint8_t* mac2) {
    for (int i = 0; i < 6; i++) {
        if (mac1[i] != mac2[i]) return false;
    }
    return true;
}

void printSlotStatus(bool slot[]) {
    Serial.print("   Status Slot: ");
    for (int i = 0; i < 4; i++) {
        Serial.printf("Slot %d: %s ", i + 1, slot[i] ? "Kosong" : "Terisi");
    }
    Serial.println();
}

void OnDataRecv(const esp_now_recv_info_t *recvInfo, const uint8_t *incomingData, int len) {
    Serial.println("\n--- 📥 Data diterima via ESP-NOW ---");
    Serial.printf("Ukuran data diterima: %d bytes\n", len);
    Serial.printf("Ukuran struct_message lokal: %d bytes\n", sizeof(myData));

    if (len > sizeof(myData)) {
        Serial.println("⚠️ PERINGATAN KRITIS: Ukuran data ESP-NOW lebih besar dari struct lokal!");
        Serial.println("    Ini dapat menyebabkan data rusak atau crash. Pastikan struct IDENTIK.");
        len = sizeof(myData);
    }

    memcpy(&myData, incomingData, len);

    myData.uid[sizeof(myData.uid) - 1] = '\0';
    myData.status[sizeof(myData.status) - 1] = '\0';
    myData.nama[sizeof(myData.nama) - 1] = '\0';
    myData.nim[sizeof(myData.nim) - 1] = '\0';
    myData.jurusan[sizeof(myData.jurusan) - 1] = '\0';

    String asal = "Tidak Dikenal";
    if (compareMac(recvInfo->src_addr, macMobil)) {
        asal = "Mobil";
    } else if (compareMac(recvInfo->src_addr, macMotor)) {
        asal = "Motor";
    }

    Serial.println("📋 Data Terurai dari ESP-NOW:");
    Serial.printf("Asal     : %s\n", asal.c_str());
    Serial.printf("Status   : %s\n", myData.status);
    Serial.printf("UID      : %s\n", myData.uid);
    Serial.printf("Nama     : %s\n", myData.nama);
    Serial.printf("NIM      : %s\n", myData.nim);
    Serial.printf("Jurusan  : %s\n", myData.jurusan);
    printSlotStatus(myData.slot);
    Serial.println("-----------------------------------");

    String kirimUART = asal + "," + myData.status + "," + myData.uid + "," + myData.nama + "," + myData.nim + "," + myData.jurusan;
    for (int i = 0; i < 4; i++) {
        kirimUART += ",";
        kirimUART += myData.slot[i] ? "1" : "0"; 
    }
    kirimUART += "\n"; 

    Serial.println("DEBUG MASTER OUT: String yang akan dikirim via UART ke Database: " + kirimUART);

    size_t bytesSent = SerialData.print(kirimUART);
    if (bytesSent > 0) {
        Serial.printf("📤 Data berhasil dikirim ke ESP Database via UART (%d bytes).\n", bytesSent);
    } else {
        Serial.println("❌ Gagal mengirim data ke ESP Database via UART (0 bytes dikirim).");
    }
}

void processJadwalFromDatabase(String message) {

    Serial.println("DEBUG MASTER IN: Menerima jadwal dari Database: " + message);

    if (message.startsWith("jadwal_mobil,")) {
        int firstComma = message.indexOf(',');
        int secondComma = message.indexOf(',', firstComma + 1);
        int thirdComma = message.indexOf(',', secondComma + 1);

        if (firstComma != -1 && secondComma != -1 && thirdComma != -1) {
            String jamMulai = message.substring(firstComma + 1, secondComma);
            String jamSelesai = message.substring(secondComma + 1, thirdComma);
            String operasional = message.substring(thirdComma + 1); 

            strncpy(jadwalData.jamMulaiMobil, jamMulai.c_str(), sizeof(jadwalData.jamMulaiMobil) - 1);
            strncpy(jadwalData.jamSelesaiMobil, jamSelesai.c_str(), sizeof(jadwalData.jamSelesaiMobil) - 1);
            strncpy(jadwalData.operasionalMobil, operasional.c_str(), sizeof(jadwalData.operasionalMobil) - 1);
            
            jadwalData.jamMulaiMobil[sizeof(jadwalData.jamMulaiMobil) - 1] = '\0';
            jadwalData.jamSelesaiMobil[sizeof(jadwalData.jamSelesaiMobil) - 1] = '\0';
            jadwalData.operasionalMobil[sizeof(jadwalData.operasionalMobil) - 1] = '\0';

            Serial.println("MASTER PARSED: Jadwal Mobil - Mulai: " + jamMulai + ", Selesai: " + jamSelesai + ", Operasional: " + operasional);
            
            esp_err_t resultMobil = esp_now_send(macMobil, (uint8_t *) &jadwalData, sizeof(jadwalData));
            if (resultMobil == ESP_OK) {
                Serial.println("✅ MASTER: Jadwal Mobil berhasil dikirim ke ESP Mobil via ESP-NOW.");
            } else {
                Serial.printf("❌ MASTER: Gagal mengirim jadwal Mobil ke ESP Mobil via ESP-NOW (Error: %d).\n", resultMobil);
            }
        } else {
            Serial.println("⚠️ MASTER: Format pesan jadwal mobil tidak valid.");
        }
    } else if (message.startsWith("jadwal_motor,")) {
        int firstComma = message.indexOf(',');
        int secondComma = message.indexOf(',', firstComma + 1);
        int thirdComma = message.indexOf(',', secondComma + 1);

        if (firstComma != -1 && secondComma != -1 && thirdComma != -1) {
            String jamMulai = message.substring(firstComma + 1, secondComma);
            String jamSelesai = message.substring(secondComma + 1, thirdComma);
            String operasional = message.substring(thirdComma + 1);

            strncpy(jadwalData.jamMulaiMotor, jamMulai.c_str(), sizeof(jadwalData.jamMulaiMotor) - 1);
            strncpy(jadwalData.jamSelesaiMotor, jamSelesai.c_str(), sizeof(jadwalData.jamSelesaiMotor) - 1);
            strncpy(jadwalData.operasionalMotor, operasional.c_str(), sizeof(jadwalData.operasionalMotor) - 1);

            jadwalData.jamMulaiMotor[sizeof(jadwalData.jamMulaiMotor) - 1] = '\0';
            jadwalData.jamSelesaiMotor[sizeof(jadwalData.jamSelesaiMotor) - 1] = '\0';
            jadwalData.operasionalMotor[sizeof(jadwalData.operasionalMotor) - 1] = '\0';

            Serial.println("MASTER PARSED: Jadwal Motor - Mulai: " + jamMulai + ", Selesai: " + jamSelesai + ", Operasional: " + operasional);
            
            esp_err_t resultMotor = esp_now_send(macMotor, (uint8_t *) &jadwalData, sizeof(jadwalData));
            if (resultMotor == ESP_OK) {
                Serial.println("✅ MASTER: Jadwal Motor berhasil dikirim ke ESP Motor via ESP-NOW.");
            } else {
                Serial.printf("❌ MASTER: Gagal mengirim jadwal Motor ke ESP Motor via ESP-NOW (Error: %d).\n", resultMotor);
            }
        } else {
            Serial.println("⚠️ MASTER: Format pesan jadwal motor tidak valid.");
        }
    }
}


void setup() {
    Serial.begin(115200);
    Serial.println("ESP Master Start");
    Serial.printf("Ukuran struct_message lokal: %d bytes\n", sizeof(struct_message)); 
    Serial.printf("Ukuran struct_jadwal_system lokal: %d bytes\n", sizeof(struct_jadwal_system)); 

    SerialData.begin(115200, SERIAL_8N1, RXD1, TXD1); 
    Serial.println("UART1 (SerialData) initialized with 115200 baud.");

    WiFi.mode(WIFI_STA); 

    if (esp_now_init() != ESP_OK) {
        Serial.println("❌ Gagal inisialisasi ESP-NOW. Mohon restart.");
        return;
    }
    Serial.println("✅ ESP-NOW berhasil diinisialisasi.");

    esp_now_register_recv_cb(OnDataRecv);
    Serial.println("✅ ESP Master siap menerima data ESP-NOW dari sensor.");

    memcpy(peerInfoMobil.peer_addr, macMobil, 6);
    peerInfoMobil.channel = 0; 
    peerInfoMobil.encrypt = false;
    if (esp_now_add_peer(&peerInfoMobil) != ESP_OK){
      Serial.println("❌ Gagal menambahkan peer ESP Mobil.");
    } else {
      Serial.println("✅ Peer ESP Mobil berhasil ditambahkan.");
    }

    memcpy(peerInfoMotor.peer_addr, macMotor, 6);
    peerInfoMotor.channel = 0; 
    peerInfoMotor.encrypt = false;
    if (esp_now_add_peer(&peerInfoMotor) != ESP_OK){
      Serial.println("❌ Gagal menambahkan peer ESP Motor.");
    } else {
      Serial.println("✅ Peer ESP Motor berhasil ditambahkan.");
    }

    memset(&jadwalData, 0, sizeof(jadwalData)); 
    strncpy(jadwalData.jamMulaiMobil, "00:00", sizeof(jadwalData.jamMulaiMobil));
    strncpy(jadwalData.jamSelesaiMobil, "00:00", sizeof(jadwalData.jamSelesaiMobil));
    strncpy(jadwalData.operasionalMobil, "off", sizeof(jadwalData.operasionalMobil)); 
    strncpy(jadwalData.jamMulaiMotor, "00:00", sizeof(jadwalData.jamMulaiMotor));
    strncpy(jadwalData.jamSelesaiMotor, "00:00", sizeof(jadwalData.jamSelesaiMotor));
    strncpy(jadwalData.operasionalMotor, "off", sizeof(jadwalData.operasionalMotor)); 
}

void loop() {
    while (SerialData.available()) {
        String receivedJadwalMessage = SerialData.readStringUntil('\n');
        receivedJadwalMessage.trim(); 
        if (receivedJadwalMessage.length() > 0) {
            processJadwalFromDatabase(receivedJadwalMessage);
        }
    }

    delay(10); 
}