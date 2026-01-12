#!/bin/bash

# Panggil script deploy.sh yang canggih (Smart Sync)
# Outputnya kita lempar ke log file
sudo -u zulfikriyahya ./deploy.sh >> /var/log/web_build.log 2>&1