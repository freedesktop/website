#! /bin/sh

cd /home/ooo/planet
date >> /home/ooo/planet/log
python planet.py ooo/config.ini >> /home/ooo/planet/log 2>&1
