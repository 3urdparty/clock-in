#include <ArduinoJson.h>
#include <SPI.h>
#include <Wire.h>
#include <WiFiClient.h>
#include <ESP8266WiFi.h>
#include <SoftwareSerial.h>
#include <ESP8266WebServer.h>
#include <ESP8266HTTPClient.h>
#include <Adafruit_GFX.h>
#include <Adafruit_SSD1306.h>
#include <Adafruit_Fingerprint.h>
#include <NTPClient.h>
#include <WiFiUdp.h>
#include "Glyphs.h"


// Paramaters
#define Finger_Rx 0
#define Finger_Tx 2
#define SCREEN_WIDTH 128
#define SCREEN_HEIGHT 64
#define OLED_RESET 0
#define Wifi_start_width 54
#define Wifi_start_height 49



// Components
Adafruit_SSD1306 display(SCREEN_WIDTH, SCREEN_HEIGHT, &Wire, OLED_RESET);
SoftwareSerial mySerial(Finger_Rx, Finger_Tx);
Adafruit_Fingerprint finger = Adafruit_Fingerprint(&mySerial);

// Network Environment Variables
const char *soft_ap_ssid = "NodeMCU-AP";
const char *soft_ap_password = "NodeMCU123+";
String ip_address = "192.168.4.2";
String port = "8000";
String host= "http://" + ip_address + ":" + port + "/api";

// Time settings
const long utcOffsetInSeconds = 28800;
String daysOfTheWeek[7] = {"Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"};

// NTP Client
WiFiUDP ntpUDP;
NTPClient timeClient(ntpUDP, "pool.ntp.org", utcOffsetInSeconds);

// Global Variables
String data;
int finger_id = 0;
uint8_t id;

// Function headers
void connectToWiFi();

// Setup
void setup() {
    WiFi.mode(WIFI_AP_STA);
    WiFi.softAP(soft_ap_ssid, soft_ap_password);
    // Serial.begin(115200);

  // Setup OLED screen
  // if(!display.begin(SSD1306_SWITCHCAPVCC, 0x3C)) {
  //   log("SSD1306 allocation failed");
  //   for(;;);
  // }
  //
  // display.display();
  // delay(2000); // Pause for 2 seconds
  // display.clearDisplay();
  //

  // Connecting time client
  // timeClient.begin();
  // log("Time client started Successfully");
  //
  // // Setup the Fingerprint sensor
  // finger.begin(57600);
  // log("Fingerprint test started...");
  //
  // if (finger.verifyPassword()) {
  //   log("Fingerprint Sensor found");
  //   display.clearDisplay();
  //   display.drawBitmap( 34, 0, FinPr_valid_bits, FinPr_valid_width, FinPr_valid_height, WHITE);
  //   display.display();
  // } else {
  //   log("Fingerprint Sensor not found");
  //   display.clearDisplay();
  //   display.drawBitmap( 32, 0, FinPr_failed_bits, FinPr_failed_width, FinPr_failed_height, WHITE);
  //   display.display();
  //   while (1) { delay(20); }
  // }
  //
  // finger.getTemplateCount();
  // log("Fingerprint templates: " + String(finger.templateCount));
}

// Loop
void loop() {
  // delay(1000);
  // finger_id = scan();
  // delay(50);
  // displayEmployee();
  // syncWithServer();
  delay(1000);
    sendDeviceStatus();
}

void log(String message){
  timeClient.update();
  String time = daysOfTheWeek[timeClient.getDay()] +  ',' + timeClient.getFormattedTime();
  String log = '[' + time +  ']' + ':'+message;
  Serial.println(log);
}

void displayEmployee(){
  if (finger_id > 0){
    display.clearDisplay();
    display.drawBitmap( 34, 0, FinPr_valid_bits, FinPr_valid_width, FinPr_valid_height, WHITE);
    display.display();

    SendFingerprintID( finger_id );
  }
  else if (finger_id == 0){
    display.clearDisplay();
    display.drawBitmap( 32, 0, FinPr_start_bits, FinPr_start_width, FinPr_start_height, WHITE);
    display.display();
  }
  else if (finger_id == -1){
    display.clearDisplay();
    display.drawBitmap( 34, 0, FinPr_invalid_bits, FinPr_invalid_width, FinPr_invalid_height, WHITE);
    display.display();
  }
  //---------------------------------------------
  //Didn't find the scanner or there an error
  else if (finger_id == -2){
    display.clearDisplay();
    display.drawBitmap( 32, 0, FinPr_failed_bits, FinPr_failed_width, FinPr_failed_height, WHITE);
    display.display();
  }
}

void SendFingerprintID( int finger ){
  WiFiClient client;
  HTTPClient http;
  data = "fingerprint_id=" + String(finger);
  String link = host + "/scan";
  http.begin(client,link);
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");

  int httpCode = http.POST(data);   //Send the request
  String payload = http.getString();    //Get the response payload

  log("Sending fingerprint");
  log("Response: " + payload);

  JsonDocument json;
  deserializeJson(json, payload);

  if (json["action"] == "clock-in") {
    display.clearDisplay();
    display.setTextSize(2);             // Normal 2:2 pixel scale
    display.setTextColor(WHITE);        // Draw white text
    display.setCursor(15,0);             // Start at top-left corner
    display.setCursor(0,20);
  }
  else if (json["action"] == "clock-out") {
    display.clearDisplay();
    display.setTextSize(2);             // Normal 2:2 pixel scale
    display.setTextColor(WHITE);        // Draw white text
    display.setCursor(10,0);             // Start at top-left corner
    display.setCursor(0,20);
  }
  String message = json["message"];
  log(message);
  display.print(message);
  display.display();
  delay(3000);
  data = "";
  http.end();  //Close connection
}

//********************Get the Fingerprint ID******************
int scan() {
  uint8_t p = finger.getImage();
  switch (p) {
    case FINGERPRINT_OK:
      log("Scanned Fingerprint");
      break;
    case FINGERPRINT_NOFINGER:
      return 0;
    case FINGERPRINT_PACKETRECIEVEERR:
      return -2;
    case FINGERPRINT_IMAGEFAIL:
      return -2;
    default:
      return -2;
  }
  p = finger.image2Tz();
  switch (p) {
    case FINGERPRINT_OK:
      log("Image converted to template");
      break;
    case FINGERPRINT_IMAGEMESS:
      //Serial.println("Image too messy");
      return -1;
    case FINGERPRINT_PACKETRECIEVEERR:
      //Serial.println("Communication error");
      return -2;
    case FINGERPRINT_FEATUREFAIL:
      //Serial.println("Could not find fingerprint features");
      return -2;
    case FINGERPRINT_INVALIDIMAGE:
      //Serial.println("Could not find fingerprint features");
      return -2;
    default:
      log("Unknown error when converting");
      return -2;
  }
  // OK converted!
  p = finger.fingerFastSearch();
  if (p == FINGERPRINT_OK) {
    log("Fingerprint match found");
  } else if (p == FINGERPRINT_PACKETRECIEVEERR) {
    //Serial.println("Communication error");
    return -2;
  } else if (p == FINGERPRINT_NOTFOUND) {
    log("Fingerprint not found");
    return -1;
  } else {
    log("Unknown error when searching");
    return -2;
  }

  return finger.fingerID;
}

//******************Check if there a Fingerprint ID to delete******************
uint8_t deleteFingerprint( int id) {
  uint8_t p = -1;

  p = finger.deleteModel(id);

  if (p == FINGERPRINT_OK) {
    //Serial.println("Deleted!");
    display.clearDisplay();
    display.setTextSize(2);             // Normal 2:2 pixel scale
    display.setTextColor(WHITE);        // Draw white text
    display.setCursor(0,0);             // Start at top-left corner
    display.print(F("Deleted!\n"));
    display.display();
    confirmDelete(id);
    return p;
  } else if (p == FINGERPRINT_PACKETRECIEVEERR) {
    //Serial.println("Communication error");
    display.clearDisplay();
    display.setTextSize(1);             // Normal 1:1 pixel scale
    display.setTextColor(WHITE);        // Draw white text
    display.setCursor(0,0);             // Start at top-left corner
    display.print(F("Communication error!\n"));
    display.display();
    return p;
  } else if (p == FINGERPRINT_BADLOCATION) {
    //Serial.println("Could not delete in that location");
    display.clearDisplay();
    display.setTextSize(1);             // Normal 1:1 pixel scale
    display.setTextColor(WHITE);        // Draw white text
    display.setCursor(0,0);             // Start at top-left corner
    display.print(F("Could not delete in that location!\n"));
    display.display();
    return p;
  } else if (p == FINGERPRINT_FLASHERR) {
    //Serial.println("Error writing to flash");
    display.clearDisplay();
    display.setTextSize(1);             // Normal 1:1 pixel scale
    display.setTextColor(WHITE);        // Draw white text
    display.setCursor(0,0);             // Start at top-left corner
    display.print(F("Error writing to flash!\n"));
    display.display();
    return p;
  } else {
    //Serial.print("Unknown error: 0x"); Serial.println(p, HEX);
    display.clearDisplay();
    display.setTextSize(2);             // Normal 2:2 pixel scale
    display.setTextColor(WHITE);        // Draw white text
    display.setCursor(0,0);             // Start at top-left corner
    display.print(F("Unknown error:\n"));
    display.display();
    return p;
  }

}

void confirmDelete(int id){
  WiFiClient client;
  HTTPClient http;    //Declare object of class HTTPClient
  String link = host + "/fingerprints/"+String(id);
  http.begin(client,link); //initiate HTTP request, put your Website URL or Your Computer IP
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");    //Specify content-type header
  int httpCode = http.DELETE();   //Send the request
  String payload = http.getString();    //Get the response payload

  JsonDocument json;
  deserializeJson(json, payload);

  display.clearDisplay();
  display.setTextSize(2);             // Normal 1:1 pixel scale
  display.setTextColor(WHITE);        // Draw white text
  display.setCursor(0,0);             // Start at top-left corner

  String message = json["message"];
  display.print(message);
  display.display();
  delay(5000);

  http.end();  //Close connection

}

void sendDeviceStatus(){

WiFiClient client;
  HTTPClient http;    //Declare object of class HTTPClient
  String link = host + "/devices/1";
  http.begin(client,link);  //initiate HTTP request, put your Website URL or Your Computer IP
  http.addHeader("Content-Type", "application/json");    //Specify content-type header

    String status = "online";
    int battery = 100;
    int proximity = 0;
    String connection = "wifi";
    int connection_strength = 100;

	String data= "{ \"status\": \"" +status +
	"\",\"battery\": " + battery +", \"proximity\": " + proximity + ", \"connection\": \"" + connection + "\", \"connection_strength\": " + connection_strength + "}";
  int httpCode = http.PUT(data);   //Send the request
  String payload = http.getString();    //Get the response payload

  JsonDocument json;
  deserializeJson(json, payload);

    String response = http.getString();
        Serial.println(response);

  if (json["action"] == "add") {
    Serial.println("Adding fingerprint");
    enrollFingerprint(json["fingerprint_id"]);
  } else if (json["action"] == "delete") {
    Serial.println("Deleting fingerprint");
    deleteFingerprint(json["fingerprint_id"]);
  }

  http.end();
}
//******************Check if there a Fingerprint ID to add******************
void syncWithServer(){

WiFiClient client;
  HTTPClient http;    //Declare object of class HTTPClient
  String link = host + "/sync";
  http.begin(client,link);  //initiate HTTP request, put your Website URL or Your Computer IP
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");    //Specify content-type header

  int httpCode = http.GET();   //Send the request
  String payload = http.getString();    //Get the response payload

  JsonDocument json;
  deserializeJson(json, payload);


  if (json["action"] == "add") {
    Serial.println("Adding fingerprint");
    enrollFingerprint(json["fingerprint_id"]);
  } else if (json["action"] == "delete") {
    Serial.println("Deleting fingerprint");
    deleteFingerprint(json["fingerprint_id"]);
  }

  http.end();
}
//******************Enroll a Finpgerprint ID*****************
uint8_t enrollFingerprint(int id) {

  int p = -1;
  display.clearDisplay();
  display.drawBitmap( 34, 0, FinPr_scan_bits, FinPr_scan_width, FinPr_scan_height, WHITE);
  display.display();
  while (p != FINGERPRINT_OK) {
    p = finger.getImage();
    switch (p) {
    case FINGERPRINT_OK:
      //Serial.println("Image taken");
      display.clearDisplay();
      display.drawBitmap( 34, 0, FinPr_valid_bits, FinPr_valid_width, FinPr_valid_height, WHITE);
      display.display();
      break;
    case FINGERPRINT_NOFINGER:
      //Serial.println(".");
      display.setTextSize(1);             // Normal 2:2 pixel scale
      display.setTextColor(WHITE);        // Draw white text
      display.setCursor(0,0);             // Start at top-left corner
      display.print(F("scanning"));
      display.display();
      break;
    case FINGERPRINT_PACKETRECIEVEERR:
      display.clearDisplay();
      display.drawBitmap( 34, 0, FinPr_invalid_bits, FinPr_invalid_width, FinPr_invalid_height, WHITE);
      display.display();
      break;
    case FINGERPRINT_IMAGEFAIL:
      Serial.println("Imaging error");
      break;
    default:
      Serial.println("Unknown error");
      break;
    }
  }

  // OK success!

  p = finger.image2Tz(1);
  switch (p) {
    case FINGERPRINT_OK:
      display.clearDisplay();
      display.drawBitmap( 34, 0, FinPr_valid_bits, FinPr_valid_width, FinPr_valid_height, WHITE);
      display.display();
      break;
    case FINGERPRINT_IMAGEMESS:
      display.clearDisplay();
      display.drawBitmap( 34, 0, FinPr_invalid_bits, FinPr_invalid_width, FinPr_invalid_height, WHITE);
      display.display();
      return p;
    case FINGERPRINT_PACKETRECIEVEERR:
      Serial.println("Communication error");
      return p;
    case FINGERPRINT_FEATUREFAIL:
      Serial.println("Could not find fingerprint features");
      return p;
    case FINGERPRINT_INVALIDIMAGE:
      Serial.println("Could not find fingerprint features");
      return p;
    default:
      Serial.println("Unknown error");
      return p;
  }
  display.clearDisplay();
  display.setTextSize(2);             // Normal 2:2 pixel scale
  display.setTextColor(WHITE);        // Draw white text
  display.setCursor(0,0);             // Start at top-left corner
  display.print(F("Remove"));
  display.setCursor(0,20);
  display.print(F("finger"));
  display.display();
  //Serial.println("Remove finger");
  delay(2000);
  p = 0;
  while (p != FINGERPRINT_NOFINGER) {
    p = finger.getImage();
  }
  Serial.print("ID "); Serial.println(id);
  p = -1;
  display.clearDisplay();
  display.drawBitmap( 34, 0, FinPr_scan_bits, FinPr_scan_width, FinPr_scan_height, WHITE);
  display.display();
  while (p != FINGERPRINT_OK) {
    p = finger.getImage();
    switch (p) {
    case FINGERPRINT_OK:
      //Serial.println("Image taken");
      display.clearDisplay();
      display.drawBitmap( 34, 0, FinPr_valid_bits, FinPr_valid_width, FinPr_valid_height, WHITE);
      display.display();
      break;
    case FINGERPRINT_NOFINGER:
      //Serial.println(".");
      display.setTextSize(1);             // Normal 2:2 pixel scale
      display.setTextColor(WHITE);        // Draw white text
      display.setCursor(0,0);             // Start at top-left corner
      display.print(F("scanning"));
      display.display();
      break;
    case FINGERPRINT_PACKETRECIEVEERR:
      Serial.println("Communication error");
      break;
    case FINGERPRINT_IMAGEFAIL:
      Serial.println("Imaging error");
      break;
    default:
      Serial.println("Unknown error");
      break;
    }
  }

  // OK success!

  p = finger.image2Tz(2);
  switch (p) {
    case FINGERPRINT_OK:
      //Serial.println("Image converted");
      display.clearDisplay();
      display.drawBitmap( 34, 0, FinPr_valid_bits, FinPr_valid_width, FinPr_valid_height, WHITE);
      display.display();
      break;
    case FINGERPRINT_IMAGEMESS:
      Serial.println("Image too messy");
      return p;
    case FINGERPRINT_PACKETRECIEVEERR:
      Serial.println("Communication error");
      return p;
    case FINGERPRINT_FEATUREFAIL:
      Serial.println("Could not find fingerprint features");
      return p;
    case FINGERPRINT_INVALIDIMAGE:
      Serial.println("Could not find fingerprint features");
      return p;
    default:
      Serial.println("Unknown error");
      return p;
  }

  // OK converted!
  Serial.print("Creating model for #");  Serial.println(id);

  p = finger.createModel();
  if (p == FINGERPRINT_OK) {
    //Serial.println("Prints matched!");
    display.clearDisplay();
    display.drawBitmap( 34, 0, FinPr_valid_bits, FinPr_valid_width, FinPr_valid_height, WHITE);
    display.display();
  } else if (p == FINGERPRINT_PACKETRECIEVEERR) {
    Serial.println("Communication error");
    return p;
  } else if (p == FINGERPRINT_ENROLLMISMATCH) {
    Serial.println("Fingerprints did not match");
    return p;
  } else {
    Serial.println("Unknown error");
    return p;
  }

  Serial.print("ID ");
  Serial.println(id);
  p = finger.storeModel(id);
  if (p == FINGERPRINT_OK) {
    Serial.println("Stored!");
    display.clearDisplay();
    display.drawBitmap( 34, 0, FinPr_valid_bits, FinPr_valid_width, FinPr_valid_height, WHITE);
    display.display();
    confirmAdding(id);
    return p;
  } else if (p == FINGERPRINT_PACKETRECIEVEERR) {
    Serial.println("Communication error");
    return p;
  } else if (p == FINGERPRINT_BADLOCATION) {
    Serial.println("Could not store in that location");
    return p;
  } else if (p == FINGERPRINT_FLASHERR) {
    Serial.println("Error writing to flash");
    return p;
  } else {
    Serial.println("Unknown error");
    return p;
  }
}

//******************Check if there a Fingerprint ID to add******************
void confirmAdding(int id){
  WiFiClient client;
  HTTPClient http;    //Declare object of class HTTPClient
  String link = host + "/fingerprints";
  data = "fingerprint_id=" + String(id); // Add the Fingerprint ID to the Post array in order to send it
  http.begin(client,link); //initiate HTTP request, put your Website URL or Your Computer IP
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");    //Specify content-type header
  int httpCode = http.POST(data);   //Send the request
  String payload = http.getString();    //Get the response payload

  JsonDocument json;
  deserializeJson(json, payload);

  display.clearDisplay();
  display.setTextSize(2);             // Normal 1:1 pixel scale
  display.setTextColor(WHITE);        // Draw white text
  display.setCursor(0,0);             // Start at top-left corner

  String message = json["message"];
  display.print(message);
  display.display();
  delay(5000);

  http.end();  //Close connection
};

