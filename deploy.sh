#!/bin/bash

sudo chown -R $USER:$USER /var/www/mtsn1pandeglang.sch.id/
sudo apt-get install php8.4-sqlite3 -y
git config --global --add safe.directory /var/www/mtsn1pandeglang.sch.id
git reset --hard origin/static
git pull origin static
yarn
yarn build

DB_FILE="/var/www/mtsn1pandeglang.sch.id/stats.db"
if [ ! -f "$DB_FILE" ]; then
    touch "$DB_FILE"
    echo "Database created."
fi
sudo chown www-data:www-data "$DB_FILE"
sudo chmod 664 "$DB_FILE"
sudo chown -R www-data:www-data /var/www/mtsn1pandeglang.sch.id/