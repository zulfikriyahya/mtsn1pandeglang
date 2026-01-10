#!/bin/bash

sudo chown -R $USER:$USER /var/www/mtsn1pandeglang.sch.id/
git config --global --add safe.directory /var/www/mtsn1pandeglang.sch.id
git pull origin static
yarn
yarn build
sudo chown -R www-data:www-data /var/www/mtsn1pandeglang.sch.id/

