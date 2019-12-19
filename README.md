# BergParking
App to show availability of parking spots in the Muhlenberg College circle.

To run on local machine:
  
 REQUIREMENTS:
 
    - RaspberryPi
    
    - PIR sensor
    
    - Internet connection
    
    - webserver
    
    - Xcode
  
  1. Download all files
  2. If not installed, install APACHE2 webserver on the RaspberryPi.
  3. Paste the pir.php file into the html folder of the www folder on the RaspberryPi.
  4. Open tester.py on RaspberryPi on Geany Programmer's Editor.
  5. Navigate to Build --> Execute or press F5. A shell should appear and display a message of whether or not motion is detected. 
  6. Once script is running on RPI, open a web browser on your local machine and navigate to the 192.168.1.4/pir.php or whatever the local IP address of the Raspberry Pi is. To find the IP address, open a terminal window on the RPI and type ifconfig. Copy the address from eth0 inet section and add /pir.php to the end. 
  7. When the sensor detects motion one of the spots on the website should turn red. The spot will turn green again if no motion is detected for one minute.
  
  #######
  
  8. To view concept of application download Xcode folder and open the Xcode project in Xcode 10.0+ .
  9. Once all assets have loaded, click the play button in the top left of the Xcode window and a mock iPhone should pop up on the screen with the application loaded onto it. 
  10. Click on the app to see the loading screen and home screen.
