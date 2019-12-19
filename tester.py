#!/usr/bin/env python
# -*- coding: utf-8 -*-
#
#  tester.py
#
#  Zachary Schur
#  Fall 2019
#  CUE FINAL PROJECT
#
#  Using GPIO and pymysql libraries, this script activates a PIR sensor
#  to detect motion through a RaspberryPi. If motion is detected a
#  connection to the MYSQL server is made and the date and time at
#  which motion is detected is added to the table.
#

import RPi.GPIO as GPIO #library to handle GPIO on raspberryPi pins as variables
import time #library that allows for time (in seconds) to be used throughout program
import pymysql #library that allows connection to MYSQL database through Python

GPIO.setwarnings(False) #ignore warnings
GPIO.setmode(GPIO.BOARD) #initalize GPIO pins layout
GPIO.setup(7, GPIO.IN) #initalize GPIO pin 7 as input

while True: #while loop to handle motion sensing
    i=GPIO.input(7) #variable to hold GPIO pin 7 input data
    if i==0:
        print("Not Sensing Motion",i)
        time.sleep(15) #wait 15 seconds before executing while loop again
    elif i==1:
        print("Motion Detected",i)
        connection = pymysql.connect(host='database-2.cxbmzlvswtfo.us-east-2.rds.amazonaws.com', #connect to AWS RDS database with port 3306
                             port=3306,
                             user='root',
                             password='rootpassword',
                             database='pirData',
                             connect_timeout = 5 #wait 5 seconds before timing out when connecting
                             )
        curs=connection.cursor() #initalize cursor on database
        curs.execute("INSERT INTO pirData (timeStamp) values(now())") #SQL insert statement to be executed on MYSQL database when motion is detected
                                                                      #inserts dateTime at the moment motion is detected
        connection.commit() #commit SQL statement on MYSQL server
        print("data inserted") #if motion is sensed, data is inserted
        connection.close() #close database connection
        time.sleep(15) #wait 15 seconds before executing while loop again
