#!/bin/bash
MAX_RETRIES=3
DELAY=5
PROJECT_DIR="/var/www/mtsn1pandeglang.sch.id"
echo "=== MEMULAI DEPLOYMENT ==="
sudo chown -R $USER:$USER $PROJECT_DIR
git config --global --add safe.directory $PROJECT_DIR
git stash
git pull origin static --force
echo "--- Installing Project Dependencies ---"
yarn install --check-files
rm -rf dist/
ATTEMPT=1
SUCCESS=0
while [ $ATTEMPT -le $MAX_RETRIES ]; do
    echo "--- Build Attempt $ATTEMPT of $MAX_RETRIES ---"
    yarn build
    if [ $? -eq 0 ]; then
        echo "Build Sukses!"
        SUCCESS=1
        break
    else
        echo "Build Gagal pada percobaan ke-$ATTEMPT"
        if [ $ATTEMPT -lt $MAX_RETRIES ]; then
            echo "Menunggu $DELAY detik sebelum mencoba lagi..."
            sleep $DELAY
        fi
        ATTEMPT=$((ATTEMPT + 1))
    fi
done
if [ $SUCCESS -eq 0 ]; then
    echo "DEPLOYMENT GAGAL SETELAH $MAX_RETRIES PERCOBAAN."
    exit 1
fi
echo "--- Setting up Database ---"
DB_FILE="$PROJECT_DIR/stats.db"
if [ ! -f "$DB_FILE" ]; then
    touch "$DB_FILE"
    echo "Database created."
fi
echo "--- Finalizing Permissions ---"
sudo chown www-data:www-data "$DB_FILE"
sudo chmod 664 "$DB_FILE"
sudo chown -R www-data:www-data $PROJECT_DIR
sudo chown -R $USER:$USER $PROJECT_DIR/deploy.sh
echo "=== DEPLOYMENT SELESAI & SUKSES! ==="