#!/bin/bash

# Fix PATH untuk yarn
export PATH="/usr/local/bin:/usr/bin:/bin:$HOME/.yarn/bin:$PATH"

# --- KONFIGURASI ---
MAX_RETRIES=3
DELAY=5
PROJECT_DIR="/var/www/mtsn1pandeglang.sch.id"
BRANCH="static"
LOG_FILE="/var/log/web_build.log"

# Fungsi Logging
log() {
    echo "[$(date '+%Y-%m-%d %H:%M:%S')] $1" | tee -a "$LOG_FILE"
}

log "=== MEMULAI SMART DEPLOYMENT ==="

cd $PROJECT_DIR || exit

# Setup Git
git config --global --add safe.directory $PROJECT_DIR
git config user.email "zulfikriyahya@gmail.com"
git config user.name "Server AutoDeploy"

# Stash & Pull
log "--- Menyimpan perubahan lokal ---"
git stash save "AutoSave before Pull"

log "--- Pulling dari GitHub ---"
git pull origin $BRANCH --no-edit

log "--- Mengembalikan perubahan lokal ---"
git stash pop

# Push jika ada konten baru
if [[ -n $(git status -s src/content/ public/images/) ]]; then
    log "--- Sync konten ke GitHub ---"
    git add src/content/ public/images/
    git commit -m "AutoSync: Konten baru [Skip CI]"
    git push origin $BRANCH
fi

# Build
log "--- Installing Dependencies ---"
yarn install --check-files || { log "Yarn install gagal!"; exit 1; }

rm -rf dist/
ATTEMPT=1
SUCCESS=0

while [ $ATTEMPT -le $MAX_RETRIES ]; do
    log "--- Build Attempt $ATTEMPT of $MAX_RETRIES ---"
    yarn build
    if [ $? -eq 0 ]; then
        SUCCESS=1
        break
    else
        sleep $DELAY
        ATTEMPT=$((ATTEMPT + 1))
    fi
done

if [ $SUCCESS -eq 0 ]; then
    log "DEPLOYMENT GAGAL!"
    exit 1
fi

# Database
DB_FILE="$PROJECT_DIR/database.db"
[ ! -f "$DB_FILE" ] && touch "$DB_FILE" && chmod 664 "$DB_FILE"

log "=== DEPLOYMENT SUKSES! ==="
