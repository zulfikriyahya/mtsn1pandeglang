#!/bin/bash

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

# 1. Alihkan permission ke user saat ini agar bisa git/yarn
sudo chown -R $USER:$USER $PROJECT_DIR

cd $PROJECT_DIR || exit

# 2. Setup Git
git config --global --add safe.directory $PROJECT_DIR
git config user.email "zulfikriyahya@gmail.com"
git config user.name "Server AutoDeploy"

# 3. AMANKAN PERUBAHAN LOKAL SERVER (Simpan konten baru ke Stash)
log "--- Menyimpan perubahan lokal (Stash) ---"
git stash save "AutoSave before Pull"

# 4. AMBIL UPDATE DARI GITHUB (Laptop)
log "--- Pulling dari GitHub ---"
git pull origin $BRANCH --no-edit

# 5. KEMBALIKAN PERUBAHAN LOKAL SERVER
log "--- Mengembalikan perubahan lokal (Pop Stash) ---"
git stash pop

# 6. CEK APAKAH ADA FILE BARU DI FOLDER KONTEN?
# Kita hanya ingin push jika ada perubahan file Markdown/Gambar, bukan node_modules/system
if [[ -n $(git status -s src/content/ public/images/) ]]; then
    log "--- Terdeteksi konten baru di Server. Melakukan Sync ke GitHub... ---"
    
    git add src/content/ public/images/
    git commit -m "AutoSync: Konten baru dari Server [Skip CI]" 
    # [Skip CI] berguna mencegah looping jika Anda pakai CI/CD pipeline
    
    git push origin $BRANCH
    log "--- Sync ke GitHub Berhasil ---"
else
    log "--- Tidak ada konten baru di Server untuk di-push ---"
fi

# 7. BUILD PROCESS (Optimized)
# Hapus node_modules setiap kali itu lambat. Yarn check-files sudah cukup.
log "--- Installing Dependencies ---"
yarn install --check-files

rm -rf dist/
ATTEMPT=1
SUCCESS=0

while [ $ATTEMPT -le $MAX_RETRIES ]; do
    log "--- Build Attempt $ATTEMPT of $MAX_RETRIES ---"
    yarn build
    
    if [ $? -eq 0 ]; then
        log "Build Sukses!"
        SUCCESS=1
        break
    else
        log "Build Gagal. Retrying..."
        sleep $DELAY
        ATTEMPT=$((ATTEMPT + 1))
    fi
done

if [ $SUCCESS -eq 0 ]; then
    log "DEPLOYMENT GAGAL (FATAL ERROR)."
    # Kembalikan permission meski gagal agar web tetap jalan (jika ada sisa cache)
    sudo chown -R www-data:www-data $PROJECT_DIR
    exit 1
fi

# 8. DATABASE SETUP
DB_FILE="$PROJECT_DIR/database.db"
if [ ! -f "$DB_FILE" ]; then
    touch "$DB_FILE"
    log "Database created."
fi

# 9. FINALISASI PERMISSION (PENTING UNTUK API PHP)
log "--- Mengatur Permission Final ---"
# Berikan folder project ke www-data
sudo chown -R www-data:www-data $PROJECT_DIR

# Pastikan script deploy tetap milik user kita agar bisa diedit/jalankan manual nanti
sudo chown $USER:$USER "$PROJECT_DIR/deploy.sh"
sudo chown $USER:$USER "$PROJECT_DIR/rebuild.sh"
sudo chmod +x "$PROJECT_DIR/deploy.sh"
sudo chmod +x "$PROJECT_DIR/rebuild.sh"
sudo usermod -a -G $USER www-data
sudo chown -R $USER:$USER /var/www/mtsn1pandeglang.sch.id
sudo chmod -R 775 /var/www/mtsn1pandeglang.sch.id
sudo touch /var/log/web_build.log
sudo chmod 666 /var/log/web_build.log
# Pastikan database bisa ditulisi www-data
sudo chmod 664 "$DB_FILE"

# Pastikan folder konten bisa ditulisi www-data (untuk fitur upload)
sudo chmod -R 775 "$PROJECT_DIR/src/content/blog"

log "=== DEPLOYMENT SELESAI & SUKSES! ==="