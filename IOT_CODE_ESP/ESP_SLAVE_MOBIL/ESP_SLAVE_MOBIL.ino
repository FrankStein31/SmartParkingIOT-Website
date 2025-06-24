#include <WiFi.h>
#include <esp_now.h>
#include <Wire.h>
#include <LiquidCrystal_I2C.h>
#include <SPI.h>
#include <MFRC522.h>
#include <ESP32Servo.h>
#include <ctype.h> 

#define RST_PIN 4
#define SS_PIN 5

#define US1_TRIG 14
#define US1_ECHO 17
#define US2_TRIG 27
#define US2_ECHO 16
#define US3_TRIG 26
#define US3_ECHO 2
#define US4_TRIG 25
#define US4_ECHO 15

#define PIN_IR_MASUK 32
#define PIN_IR_KELUAR 33

#define SERVO_MASUK 13
#define SERVO_KELUAR 12

LiquidCrystal_I2C lcd(0x27, 16, 2);
MFRC522 rfid(SS_PIN, RST_PIN);
MFRC522::MIFARE_Key key;
Servo servoMasuk;
Servo servoKeluar;


typedef struct struct_message {
  char uid[32];
  char status[10];
  char nama[50];
  char nim[20];
  char jurusan[30];
  bool slot[4];
  int totalSlotKosong;
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
struct_jadwal_system receivedJadwal; 

uint8_t masterAddress[] = {0xCC, 0x7B, 0x5C, 0x27, 0x10, 0x24}; 
esp_now_peer_info_t peerInfo;

unsigned long lastSendTime = 0;
unsigned long interval = 10000;
unsigned long lastNoActivityDisplayTime = 0; 
const unsigned long noActivityDisplayInterval = 5000;
bool isEntryDetected = false;

unsigned long timeAllSlotsEmpty = 0;
static int previousTotalSlotKosong = -1;

enum LcdDisplayMode {
  LCD_MODE_SLOTS_AVAILABLE, 
  LCD_MODE_ACCESS_CLOSED,  
  LCD_MODE_TEMPORARY_MESSAGE 
};

LcdDisplayMode currentLcdMode = LCD_MODE_SLOTS_AVAILABLE; 
String lastDisplayedLine1 = ""; 
String lastDisplayedLine2_text = ""; 
int lastDisplayedLine2_char = -1; 

byte downArrow[8] = {
  0b00100,
  0b00100,
  0b00100,
  0b00100,
  0b00100,
  0b11111,
  0b01110,
  0b00100
};

bool isStringEmptyOrWhitespace(const char* str) {
    if (str == NULL || str[0] == '\0') {
        return true;
    }
    for (int i = 0; str[i] != '\0'; i++) {
        if (!isspace((unsigned char)str[i])) {
            return false;
        }
    }
    return true;
}

void updateLcdDisplay(String line1_text, int charCodeForLine1, String line2_text, int charCodeForLine2, LcdDisplayMode newMode) {
    int line1_len = line1_text.length();
    if (charCodeForLine1 != -1) line1_len++; 
    String paddedLine1 = "";
    int pad1_left = (16 - line1_len) / 2;
    for (int i = 0; i < pad1_left; i++) paddedLine1 += " ";
    paddedLine1 += line1_text;
    while (paddedLine1.length() < 16) paddedLine1 += " ";

    int line2_len = line2_text.length();
    if (charCodeForLine2 != -1) line2_len++; 
    String paddedLine2 = "";
    int pad2_left = (16 - line2_len) / 2;
    for (int i = 0; i < pad2_left; i++) paddedLine2 += " ";
    paddedLine2 += line2_text;
    while (paddedLine2.length() < 16) paddedLine2 += " ";

    if (newMode != currentLcdMode || paddedLine1 != lastDisplayedLine1 || paddedLine2 != lastDisplayedLine2_text || charCodeForLine1 != lastDisplayedLine2_char || charCodeForLine2 != lastDisplayedLine2_char) {
        lcd.clear(); 
        
        lcd.setCursor(0, 0);
        lcd.print(paddedLine1);
        if (charCodeForLine1 != -1) {
            lcd.setCursor(pad1_left + line1_text.length(), 0);
            lcd.write(charCodeForLine1);
        }

        lcd.setCursor(0, 1);
        lcd.print(paddedLine2);
        if (charCodeForLine2 != -1) {
            lcd.setCursor(pad2_left + line2_text.length(), 1);
            lcd.write(charCodeForLine2);
        }

        currentLcdMode = newMode; 
        lastDisplayedLine1 = paddedLine1; 
        lastDisplayedLine2_text = paddedLine2; 
        lastDisplayedLine2_char = charCodeForLine2;
    }
}

void penjadwalan(const esp_now_recv_info_t *recvInfo, const uint8_t *incomingData, int len) {
  Serial.println("\n--- 📥 Jadwal diterima via ESP-NOW dari Master ---");
  Serial.printf("Ukuran data diterima: %d bytes\n", len);
  Serial.printf("Ukuran struct_jadwal_system lokal: %d bytes\n", sizeof(receivedJadwal));

  char prevOperasionalMobil[5];
  strcpy(prevOperasionalMobil, receivedJadwal.operasionalMobil);

  if (len == sizeof(receivedJadwal)) {
    memcpy(&receivedJadwal, incomingData, sizeof(receivedJadwal));

    receivedJadwal.jamMulaiMobil[sizeof(receivedJadwal.jamMulaiMobil) - 1] = '\0';
    receivedJadwal.jamSelesaiMobil[sizeof(receivedJadwal.jamSelesaiMobil) - 1] = '\0';
    receivedJadwal.operasionalMobil[sizeof(receivedJadwal.operasionalMobil) - 1] = '\0';
    receivedJadwal.jamMulaiMotor[sizeof(receivedJadwal.jamMulaiMotor) - 1] = '\0';
    receivedJadwal.jamSelesaiMotor[sizeof(receivedJadwal.jamSelesaiMotor) - 1] = '\0';
    receivedJadwal.operasionalMotor[sizeof(receivedJadwal.operasionalMotor) - 1] = '\0';

    Serial.println("✅ Jadwal sistem diperbarui dari Master:");
    Serial.print("Mobil - Jam Mulai: "); Serial.print(receivedJadwal.jamMulaiMobil);
    Serial.print(", Jam Selesai: "); Serial.print(receivedJadwal.jamSelesaiMobil);
    Serial.print(", Operasional: "); Serial.println(receivedJadwal.operasionalMobil);
    Serial.print("Motor - Jam Mulai: "); Serial.print(receivedJadwal.jamMulaiMotor);
    Serial.print(", Jam Selesai: "); Serial.print(receivedJadwal.jamSelesaiMotor);
    Serial.print(", Operasional: "); Serial.println(receivedJadwal.operasionalMotor);

    if (strcmp(receivedJadwal.operasionalMobil, prevOperasionalMobil) != 0) {
        Serial.println("DEBUG: Status operasional MOBIL berubah.");
    }
    
    if (strcmp(receivedJadwal.operasionalMobil, "off") == 0) {
        Serial.println("DEBUG: Operasional OFF untuk Mobil terdeteksi. Menutup akses.");
        Serial.println("DEBUG: Sensor infrared TIDAK AKAN bereaksi.");
        servoMasuk.write(90); 
        servoKeluar.write(70); 
    } else { 
        Serial.println("DEBUG: Operasional ON untuk Mobil. Mengaktifkan akses.");
        Serial.println("DEBUG: Sensor infrared AKAN bereaksi.");
    }
  } else {
    Serial.println("⚠️ Ukuran data jadwal dari Master tidak cocok!");
  }
}

void OnDataSent(const uint8_t *mac_addr, esp_now_send_status_t status) {
  Serial.print("Status kirim data ke Master: ");
  Serial.println(status == ESP_NOW_SEND_SUCCESS ? "Berhasil" : "Gagal");
}

void printData() {
  Serial.println("===== DATA TERKIRIM =====");
  Serial.print("UID     : "); Serial.println(myData.uid);
  Serial.print("Status  : "); Serial.println(myData.status);
  Serial.print("Nama    : "); Serial.println(myData.nama);
  Serial.print("NIM     : "); Serial.println(myData.nim);
  Serial.print("Jurusan : "); Serial.println(myData.jurusan);
  Serial.print("Slot    : ");
  for (int i = 0; i < 4; i++) {
    Serial.print(myData.slot[i] ? "[Kosong] " : "[Terisi] ");
  }
  Serial.println();
  Serial.print("Total Slot Kosong: ");
  Serial.println(myData.totalSlotKosong);
  Serial.println("=========================");
}

void setup() {
  Serial.begin(115200);
  WiFi.mode(WIFI_STA); 

  if (esp_now_init() != ESP_OK) {
    Serial.println("ESP-NOW gagal dimulai");
    return;
  }
  Serial.println("✅ ESP-NOW berhasil diinisialisasi.");

  esp_now_register_send_cb(OnDataSent);
  esp_now_register_recv_cb(penjadwalan); 

  memcpy(peerInfo.peer_addr, masterAddress, 6);
  peerInfo.channel = 0;
  peerInfo.encrypt = false;

  if (esp_now_add_peer(&peerInfo) != ESP_OK) {
    Serial.println("Gagal menambahkan peer Master");
    return;
  }
  Serial.println("✅ Peer Master berhasil ditambahkan.");

  lcd.init();
  lcd.backlight();
  lcd.createChar(0, downArrow); 
  SPI.begin();
  rfid.PCD_Init();
  for (byte i = 0; i < 6; i++) key.keyByte[i] = 0xFF;

  servoMasuk.setPeriodHertz(50);
  servoKeluar.setPeriodHertz(50);
  servoMasuk.attach(SERVO_MASUK, 500, 2400);
  servoKeluar.attach(SERVO_KELUAR, 500, 2400);
  servoMasuk.write(90);  
  servoKeluar.write(70); 

  pinMode(PIN_IR_MASUK, INPUT);
  pinMode(PIN_IR_KELUAR, INPUT);
  pinMode(US1_TRIG, OUTPUT); pinMode(US1_ECHO, INPUT);
  pinMode(US2_TRIG, OUTPUT); pinMode(US2_ECHO, INPUT);
  pinMode(US3_TRIG, OUTPUT); pinMode(US3_ECHO, INPUT);
  pinMode(US4_TRIG, OUTPUT); pinMode(US4_ECHO, INPUT);

  strcpy(receivedJadwal.operasionalMobil, "on");
  strcpy(receivedJadwal.jamMulaiMobil, "00:00");
  strcpy(receivedJadwal.jamSelesaiMobil, "23:59");
  strcpy(receivedJadwal.operasionalMotor, "on");
  strcpy(receivedJadwal.jamMulaiMotor, "00:00");
  strcpy(receivedJadwal.jamSelesaiMotor, "23:59");

  lastDisplayedLine1 = "RESET_LINE_1";
  lastDisplayedLine2_text = "RESET_LINE_2"; 
  lastDisplayedLine2_char = -2; 
  currentLcdMode = LCD_MODE_TEMPORARY_MESSAGE; 
  
  Serial.println("Sistem Parkir Siap");
}

bool cekSlot(int trig, int echo) {
  digitalWrite(trig, LOW);
  delayMicroseconds(2);
  digitalWrite(trig, HIGH);
  delayMicroseconds(10);
  digitalWrite(trig, LOW);

  long durasi = pulseIn(echo, HIGH, 30000); 
  if (durasi == 0) return true; 

  int jarak = durasi * 0.034 / 2;
  return jarak > 4; 
}

int getSlotKosong() {
  for (int i = 0; i < 4; i++) {
    if (myData.slot[i]) return i + 1; 
  }
  return -1; 
}

void kirimKeMaster() {
  esp_err_t result = esp_now_send(masterAddress, (uint8_t *)&myData, sizeof(myData));
  Serial.println(result == ESP_OK ? "Data dikirim ke Master" : "Gagal kirim data ke Master");
}

bool readBlock(byte blockNum, byte *buffer, byte *size) {
  MFRC522::StatusCode status;
  byte sector = blockNum / 4;
  byte trailerBlock = sector * 4 + 3;

  status = rfid.PCD_Authenticate(MFRC522::PICC_CMD_MF_AUTH_KEY_A, trailerBlock, &key, &(rfid.uid));
  if (status != MFRC522::STATUS_OK) return false;

  status = rfid.MIFARE_Read(blockNum, buffer, size);
  return status == MFRC522::STATUS_OK;
}

void logikaKetersediaanSlotParkir() {
  if (strcmp(receivedJadwal.operasionalMobil, "on") == 0) {
    myData.slot[0] = cekSlot(US1_TRIG, US1_ECHO);
    myData.slot[1] = cekSlot(US2_TRIG, US2_ECHO);
    myData.slot[2] = cekSlot(US3_TRIG, US3_ECHO);
    myData.slot[3] = cekSlot(US4_TRIG, US4_ECHO);

    int slotKosong = 0;
    for (int i = 0; i < 4; i++) {
      if (myData.slot[i]) slotKosong++;
    }
    myData.totalSlotKosong = slotKosong;

    if (myData.totalSlotKosong == 4 && previousTotalSlotKosong < 4) {
        timeAllSlotsEmpty = millis(); 
    } else if (myData.totalSlotKosong < 4 && previousTotalSlotKosong == 4) {
        timeAllSlotsEmpty = 0; 
    }
    previousTotalSlotKosong = myData.totalSlotKosong;

    bool slotStatusChanged = (myData.totalSlotKosong != previousTotalSlotKosong);
    bool timeForDefaultRefresh = (millis() - lastNoActivityDisplayTime > noActivityDisplayInterval);

    if (!isEntryDetected) { 
        String line1_display;
        if (slotKosong > 0) {
            line1_display = "Tersedia " + String(slotKosong) + " slot";
        } else {
            line1_display = "Parkir Penuh!";
        }
        
        String line2_display_text = "Keluar "; 
        

        if (slotStatusChanged || timeForDefaultRefresh || currentLcdMode != LCD_MODE_SLOTS_AVAILABLE) {
            updateLcdDisplay(line1_display, -1, line2_display_text, 0, LCD_MODE_SLOTS_AVAILABLE); // 0 adalah indeks downArrow
            lastNoActivityDisplayTime = millis(); // Reset timer refresh default
        }
    }
  } else { 
    updateLcdDisplay("Akses Parkir", -1, "DITUTUP!", -1, LCD_MODE_ACCESS_CLOSED); 
    servoMasuk.write(90);
    servoKeluar.write(70);
  }
}

void logikaMasukParkir() {
  if (strcmp(receivedJadwal.operasionalMobil, "on") == 0) {
    if (rfid.PICC_IsNewCardPresent() && rfid.PICC_ReadCardSerial()) {
      isEntryDetected = true; 
      lastNoActivityDisplayTime = millis();
      
      if (myData.totalSlotKosong == 0) {
        updateLcdDisplay("Parkir Penuh!", -1, "Parkir ditolak", -1, LCD_MODE_TEMPORARY_MESSAGE); 
        delay(3000); 
        isEntryDetected = false; 
        currentLcdMode = LCD_MODE_SLOTS_AVAILABLE; 
        rfid.PICC_HaltA();
        rfid.PCD_StopCrypto1();
        return;
      }

      String uidStr = "";
      for (byte i = 0; i < rfid.uid.size; i++) {
        uidStr += String(rfid.uid.uidByte[i], HEX);
      }
      uidStr.toUpperCase();
      uidStr.toCharArray(myData.uid, sizeof(myData.uid));
      strcpy(myData.status, "MASUK");

      byte blockNama = 4;
      byte blockNIM = 5;
      byte blockJurusan = 6;
      byte buffer[18];
      byte size = sizeof(buffer);
      
      bool suksesBacaNama = readBlock(blockNama, buffer, &size);
      if (suksesBacaNama) {
        strncpy(myData.nama, (char*)buffer, sizeof(myData.nama) - 1);
        myData.nama[sizeof(myData.nama) - 1] = '\0';
      } else {
        strcpy(myData.nama, "Nama Tidak Ada"); 
      }

      bool suksesBacaNIM = readBlock(blockNIM, buffer, &size);
      if (suksesBacaNIM) {
        strncpy(myData.nim, (char*)buffer, sizeof(myData.nim) - 1);
        myData.nim[sizeof(myData.nim) - 1] = '\0';
      } else {
        strcpy(myData.nim, "NIM Tidak Ada"); 
      }

      bool suksesBacaJurusan = readBlock(blockJurusan, buffer, &size);
      if (suksesBacaJurusan) {
        strncpy(myData.jurusan, (char*)buffer, sizeof(myData.jurusan) - 1);
        myData.jurusan[sizeof(myData.jurusan) - 1] = '\0';
      } else {
        strcpy(myData.jurusan, "Jurusan Tidak Ada"); 
      }

      if ( !suksesBacaNama || isStringEmptyOrWhitespace(myData.nama) ||
           !suksesBacaNIM  || isStringEmptyOrWhitespace(myData.nim)  ||
           !suksesBacaJurusan || isStringEmptyOrWhitespace(myData.jurusan) ) {
          updateLcdDisplay("Mahasiswa tdk", -1, "terdaftar", -1, LCD_MODE_TEMPORARY_MESSAGE); 
          delay(3000);
          isEntryDetected = false;
          currentLcdMode = LCD_MODE_SLOTS_AVAILABLE; 
          rfid.PICC_HaltA();
          rfid.PCD_StopCrypto1();
          return;
      }

      printData();
      kirimKeMaster();

      updateLcdDisplay(String(myData.nama), -1, "Parkir di: " + String(getSlotKosong()), -1, LCD_MODE_TEMPORARY_MESSAGE);
      delay(4000);

      servoMasuk.write(0); 

      unsigned long waktuMulaiIR = millis();
      while (digitalRead(PIN_IR_MASUK) == HIGH && (millis() - waktuMulaiIR < 300000)) { 
        delay(100);
      }

      for (int pos = 0; pos <= 90; pos += 1) { 
        servoMasuk.write(pos);
        delay(30);
      }
      
      delay(1000);
      isEntryDetected = false;
      currentLcdMode = LCD_MODE_SLOTS_AVAILABLE; 
      rfid.PICC_HaltA();
      rfid.PCD_StopCrypto1();
    }
  } else {
    servoMasuk.write(90); 
  }
}

void logikaKeluarParkir() {
  if (strcmp(receivedJadwal.operasionalMobil, "on") == 0) {
    if (digitalRead(PIN_IR_KELUAR) == LOW && !isEntryDetected) {
        
        if (myData.totalSlotKosong == 4) {
            if (timeAllSlotsEmpty != 0 && (millis() - timeAllSlotsEmpty < 20000)) {
            } else {
                updateLcdDisplay("Tidak terbuka", -1, "Parkir kosong!", -1, LCD_MODE_TEMPORARY_MESSAGE);
                delay(3000);
                currentLcdMode = LCD_MODE_SLOTS_AVAILABLE;
                return;
            }
        }

        strcpy(myData.uid, "-");
        strcpy(myData.status, "KELUAR");
        strcpy(myData.nama, "-");
        strcpy(myData.nim, "-");
        strcpy(myData.jurusan, "-");

        printData();
        kirimKeMaster();

        servoKeluar.write(240); 
        delay(2000);

        for (int pos = 240; pos >= 70; pos -= 1) { 
            servoKeluar.write(pos);
            delay(30);
        }
        delay(1000);
        currentLcdMode = LCD_MODE_SLOTS_AVAILABLE;
    }
  } else {
    servoKeluar.write(70); 
  }
}

void logikaParkir() {
  if (millis() - lastSendTime > interval) {
    strcpy(myData.uid, "-");
    strcpy(myData.status, "UPDATE"); 
    strcpy(myData.nama, "-");
    strcpy(myData.nim, "-");
    strcpy(myData.jurusan, "-");

    printData();
    kirimKeMaster();
    lastSendTime = millis();
  }
}

void loop() {
  logikaKetersediaanSlotParkir();
  logikaMasukParkir();           
  logikaKeluarParkir();          
  logikaParkir();                

  delay(10);
}