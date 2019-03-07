#include <M5Stack.h>
#define trigPin1 1
#define echoPin1 3
#define trigPin2 26
#define echoPin2 25

const int redPin = 21;
const int greenPin = 19;


long duration, distance, RightSensor, LeftSensor;
int peopleCount = 0;

bool empty = true;

bool first = false;       //states for going inside room
bool second = false;
bool third = false;
bool fourth = false;

bool fifth = false;       //states for leaving room
bool sixth = false;
bool seventh = false;
bool eighth = false;

 
void setup(){
  M5.begin();
  
  Serial.begin (9600);
  pinMode(trigPin1, OUTPUT);
  pinMode(echoPin1, INPUT);
  pinMode(trigPin2, OUTPUT);
  pinMode(echoPin2, INPUT);
  pinMode(redPin, OUTPUT); 
  pinMode(greenPin, OUTPUT); 
  }
  
  
  void loop() {
  M5.update(); 
  if (empty == true){
      digitalWrite(redPin, LOW);
      digitalWrite(greenPin, HIGH); 
      M5.Lcd.print("NOT BEING USED");
      M5.Lcd.print("peopleCount");
      M5.Lcd.print("\n");       
    }
    else if (empty == false){
      digitalWrite(redPin, HIGH);
      digitalWrite(greenPin, LOW); 
      M5.Lcd.print("BEING USED");
      M5.Lcd.print("peopleCount");
      M5.Lcd.print("\n");
    }
     
  SonarSensor(trigPin1, echoPin1);
  RightSensor = distance;
  SonarSensor(trigPin2, echoPin2);
  LeftSensor = distance;
   
  Serial.print(LeftSensor);
  Serial.print(" - ");
  Serial.print(RightSensor);
  Serial.println();
  Serial.print(peopleCount);
  Serial.println();
  
  if (!first && !second && !third && !fourth && RightSensor < 50){
    first = true;
  }
  if (first && !second && !third && !fourth && RightSensor < 50 && LeftSensor < 50){
    second = true;
  }
  if (first && second && !third && !fourth && RightSensor > 50 && LeftSensor < 50){
    third = true;
  }
  if (first && second && third && !fourth && RightSensor > 50 && LeftSensor > 50){
    fourth = true;
  }
  if (fourth){
    peopleCount++;
    first = false;
    second = false;
    third = false;
    fourth = false;
  }
  
  if (!fifth && !sixth && !seventh && !eighth && LeftSensor < 50){
    fifth = true;
  }
  if (fifth && !sixth && !seventh && !eighth && LeftSensor < 50 && RightSensor < 50){
    sixth = true;
  }
  if (fifth && sixth && !seventh && !eighth && LeftSensor > 50 && RightSensor < 50){
    seventh = true;
  }
  if (fifth && sixth && seventh && !eighth && LeftSensor > 50 && RightSensor > 50){
    eighth = true;
  }
  if (eighth){
    peopleCount--;
    fifth = false;
    sixth = false;
    seventh = false;
    eighth = false;
  }
  
  if (peopleCount == 0){
    empty = true;
  }
  else {
    empty =false;
  }
    delay(200);
  }
   
  void SonarSensor(int trigPin,int echoPin)
  {
  digitalWrite(trigPin, LOW);
  delayMicroseconds(2);
  digitalWrite(trigPin, HIGH);
  delayMicroseconds(10);
  digitalWrite(trigPin, LOW);
  duration = pulseIn(echoPin, HIGH);
  distance = (duration/2) / 29.1;
 
}
