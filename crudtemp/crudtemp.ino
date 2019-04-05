#include <MCUFRIEND_kbv.h>
MCUFRIEND_kbv tft;

#include "barcodes.h"
char character;
void setup()
{
    uint16_t ID = tft.readID();
    tft.begin(ID);
    Serial.begin(230400);
// Where rotation is 0, or 2 for portrait and 1 or 3 for landscape rotations.
   tft.setRotation(3);
   tft.fillScreen(TFT_WHITE);
    tft.setCursor(20, 20);
    tft.setTextColor(TFT_BLACK);  tft.setTextSize(3);
    tft.println(Name);
    tft.setCursor(200,50);
    tft.println("$"+Price);
    //tft.print(Price);    
    tft.drawBitmap(20, 90, imageVarName, 300,150, TFT_BLACK, TFT_WHITE);  // img
}
void loop() 
{
}
