#!/bin/bash

# Warna untuk output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Fungsi untuk print dengan warna
print_success() {
    echo -e "${GREEN}✓ $1${NC}"
}

print_error() {
    echo -e "${RED}✗ $1${NC}"
}

print_info() {
    echo -e "${BLUE}ℹ $1${NC}"
}

print_warning() {
    echo -e "${YELLOW}⚠ $1${NC}"
}

print_header() {
    echo -e "\n${BLUE}═══════════════════════════════════════════${NC}"
    echo -e "${BLUE}$1${NC}"
    echo -e "${BLUE}═══════════════════════════════════════════${NC}\n"
}

# Fungsi untuk konfirmasi
confirm() {
    read -p "$(echo -e ${YELLOW}$1 [y/n]: ${NC})" response
    case "$response" in
        [yY][eE][sS]|[yY]) 
            return 0
            ;;
        *)
            return 1
            ;;
    esac
}

# Cek apakah script dijalankan sebagai root
if [ "$EUID" -eq 0 ]; then 
    print_error "Jangan jalankan script ini sebagai root!"
    print_info "Jalankan dengan: bash install.sh"
    exit 1
fi

# Banner
clear
echo -e "${GREEN}"
cat << "EOF"
╔═══════════════════════════════════════════════════════╗
║                                                       ║
║     ASTRO DEPLOYMENT AUTOMATION INSTALLER             ║
║     untuk Debian/Ubuntu Server                        ║
║                                                       ║
╚═══════════════════════════════════════════════════════╝
EOF
echo -e "${NC}"

print_info "Script ini akan menginstall dan mengkonfigurasi:"
echo "  • Nginx"
echo "  • Curl"
echo "  • Git"
echo "  • Node.js (versi terbaru LTS)"
echo "  • Yarn"
echo "  • Setup deployment automation untuk Astro"
echo ""

if ! confirm "Lanjutkan instalasi?"; then
    print_warning "Instalasi dibatalkan."
    exit 0
fi

# ============================================================
# STEP 1: UPDATE SISTEM
# ============================================================
print_header "STEP 1: UPDATE SISTEM"

print_info "Mengupdate package list..."
sudo apt update

if confirm "Apakah Anda ingin upgrade sistem?"; then
    sudo apt upgrade -y
    print_success "Sistem berhasil diupdate dan upgrade"
else
    print_success "Sistem berhasil diupdate"
fi

# ============================================================
# STEP 2: INSTALL DEPENDENCIES
# ============================================================
print_header "STEP 2: INSTALL DEPENDENCIES"

# Install Nginx
if command -v nginx &> /dev/null; then
    print_warning "Nginx sudah terinstall"
else
    print_info "Menginstall Nginx..."
    sudo apt install -y nginx
    sudo systemctl enable nginx
    sudo systemctl start nginx
    print_success "Nginx berhasil diinstall"
fi

# Install Curl
if command -v curl &> /dev/null; then
    print_warning "Curl sudah terinstall"
else
    print_info "Menginstall Curl..."
    sudo apt install -y curl
    print_success "Curl berhasil diinstall"
fi

# Install Git
if command -v git &> /dev/null; then
    print_warning "Git sudah terinstall"
else
    print_info "Menginstall Git..."
    sudo apt install -y git
    print_success "Git berhasil diinstall"
fi

# Install Node.js
if command -v node &> /dev/null; then
    print_warning "Node.js sudah terinstall ($(node -v))"
    if confirm "Apakah Anda ingin reinstall Node.js versi terbaru?"; then
        print_info "Menginstall Node.js versi terbaru..."
        curl -fsSL https://deb.nodesource.com/setup_lts.x | sudo -E bash -
        sudo apt install -y nodejs
        print_success "Node.js berhasil diupdate ke versi $(node -v)"
    fi
else
    print_info "Menginstall Node.js versi terbaru LTS..."
    curl -fsSL https://deb.nodesource.com/setup_lts.x | sudo -E bash -
    sudo apt install -y nodejs
    print_success "Node.js berhasil diinstall ($(node -v))"
fi

# Install Yarn
if command -v yarn &> /dev/null; then
    print_warning "Yarn sudah terinstall ($(yarn -v))"
else
    print_info "Menginstall Yarn..."
    sudo npm install -g yarn
    print_success "Yarn berhasil diinstall ($(yarn -v))"
fi

# ============================================================
# STEP 3: SETUP SSH KEY UNTUK GITHUB
# ============================================================
print_header "STEP 3: SETUP SSH KEY UNTUK GITHUB"

if [ -f ~/.ssh/id_ed25519.pub ]; then
    print_warning "SSH key sudah ada"
    if confirm "Apakah Anda ingin membuat SSH key baru?"; then
        read -p "Masukkan email untuk SSH key: " ssh_email
        ssh-keygen -t ed25519 -C "$ssh_email" -f ~/.ssh/id_ed25519 -N ""
        print_success "SSH key baru berhasil dibuat"
    fi
else
    read -p "Masukkan email untuk SSH key: " ssh_email
    ssh-keygen -t ed25519 -C "$ssh_email" -f ~/.ssh/id_ed25519 -N ""
    print_success "SSH key berhasil dibuat"
fi

echo ""
print_info "Public SSH Key Anda:"
echo -e "${GREEN}$(cat ~/.ssh/id_ed25519.pub)${NC}"
echo ""
print_warning "PENTING: Tambahkan SSH key di atas ke GitHub!"
print_info "1. Buka https://github.com/settings/ssh/new"
print_info "2. Paste SSH key di atas"
print_info "3. Klik 'Add SSH key'"
echo ""
read -p "Tekan ENTER setelah menambahkan SSH key ke GitHub..."

# Test koneksi GitHub
print_info "Testing koneksi ke GitHub..."
if ssh -T git@github.com 2>&1 | grep -q "successfully authenticated"; then
    print_success "Koneksi ke GitHub berhasil!"
else
    print_warning "Tidak dapat terkoneksi ke GitHub. Pastikan SSH key sudah ditambahkan."
fi

# ============================================================
# STEP 4: KONFIGURASI PROJECT
# ============================================================
print_header "STEP 4: KONFIGURASI PROJECT"

# Input repository URL
read -p "Masukkan URL repository GitHub (default: https://github.com/zulfikriyahya/mtsn1pandeglang): " repo_url
repo_url=${repo_url:-"https://github.com/zulfikriyahya/mtsn1pandeglang"}

# Convert HTTPS to SSH jika perlu
if [[ $repo_url == https://github.com/* ]]; then
    repo_ssh=$(echo $repo_url | sed 's/https:\/\/github.com\//git@github.com:/')
    print_info "Menggunakan SSH URL: $repo_ssh"
else
    repo_ssh=$repo_url
fi

# Input nama project
repo_name=$(basename $repo_url .git)
read -p "Masukkan nama project (default: $repo_name): " project_name
project_name=${project_name:-$repo_name}

# Input directory
read -p "Masukkan directory instalasi (default: /var/www/$project_name): " project_dir
project_dir=${project_dir:-"/var/www/$project_name"}

# Input branch
read -p "Masukkan nama branch (default: main): " branch_name
branch_name=${branch_name:-"main"}

# Input domain
read -p "Masukkan domain (contoh: mtsn1pandeglang.sch.id atau kosongkan jika pakai IP): " domain_name

# Input interval deployment
print_info "Pilih interval deployment otomatis:"
echo "  1. Setiap 1 jam"
echo "  2. Setiap 2 jam"
echo "  3. Setiap 3 jam"
echo "  4. Setiap 4 jam"
echo "  5. Setiap 6 jam"
echo "  6. Setiap 12 jam"
echo "  7. Custom (manual input)"
read -p "Pilihan (1-7): " interval_choice

case $interval_choice in
    1) cron_schedule="0 * * * *"; interval_text="setiap 1 jam" ;;
    2) cron_schedule="0 */2 * * *"; interval_text="setiap 2 jam" ;;
    3) cron_schedule="0 */3 * * *"; interval_text="setiap 3 jam" ;;
    4) cron_schedule="0 */4 * * *"; interval_text="setiap 4 jam" ;;
    5) cron_schedule="0 */6 * * *"; interval_text="setiap 6 jam" ;;
    6) cron_schedule="0 */12 * * *"; interval_text="setiap 12 jam" ;;
    7) 
        read -p "Masukkan cron schedule (contoh: 0 */3 * * *): " cron_schedule
        interval_text="custom: $cron_schedule"
        ;;
    *) 
        cron_schedule="0 */3 * * *"
        interval_text="setiap 3 jam (default)"
        ;;
esac

# Input package manager
print_info "Pilih package manager:"
echo "  1. npm"
echo "  2. yarn"
read -p "Pilihan (1-2, default: npm): " pm_choice
if [ "$pm_choice" == "2" ]; then
    package_manager="yarn"
    install_cmd="yarn install"
    build_cmd="yarn build"
else
    package_manager="npm"
    install_cmd="npm install"
    build_cmd="npm run build"
fi

# Konfirmasi
echo ""
print_header "KONFIRMASI KONFIGURASI"
echo "Repository      : $repo_ssh"
echo "Project Name    : $project_name"
echo "Directory       : $project_dir"
echo "Branch          : $branch_name"
echo "Domain          : ${domain_name:-"(menggunakan IP)"}"
echo "Package Manager : $package_manager"
echo "Deployment      : $interval_text"
echo "Cron Schedule   : $cron_schedule"
echo ""

if ! confirm "Apakah konfigurasi sudah benar?"; then
    print_error "Instalasi dibatalkan. Jalankan ulang script untuk konfigurasi ulang."
    exit 1
fi

# ============================================================
# STEP 5: CLONE REPOSITORY
# ============================================================
print_header "STEP 5: CLONE REPOSITORY"

if [ -d "$project_dir" ]; then
    print_warning "Directory $project_dir sudah ada"
    if confirm "Apakah Anda ingin menghapus dan clone ulang?"; then
        sudo rm -rf "$project_dir"
    else
        print_info "Menggunakan directory yang ada"
    fi
fi

if [ ! -d "$project_dir" ]; then
    print_info "Membuat directory $project_dir..."
    sudo mkdir -p "$project_dir"
    sudo chown $USER:$USER "$project_dir"
    
    print_info "Cloning repository..."
    git clone "$repo_ssh" "$project_dir"
    
    if [ $? -eq 0 ]; then
        print_success "Repository berhasil di clone"
    else
        print_error "Gagal clone repository!"
        print_info "Periksa kembali SSH key dan akses repository"
        exit 1
    fi
fi

cd "$project_dir"

# Checkout branch
git checkout "$branch_name"

# Install dependencies
print_info "Menginstall dependencies dengan $package_manager..."
$install_cmd

if [ $? -eq 0 ]; then
    print_success "Dependencies berhasil diinstall"
else
    print_error "Gagal install dependencies!"
    exit 1
fi

# Build project
print_info "Building project..."
$build_cmd

if [ $? -eq 0 ]; then
    print_success "Project berhasil di build"
else
    print_error "Gagal build project!"
    exit 1
fi

# ============================================================
# STEP 6: BUAT DEPLOYMENT SCRIPT
# ============================================================
print_header "STEP 6: SETUP DEPLOYMENT AUTOMATION"

deploy_script="/usr/local/bin/deploy-$project_name.sh"
log_file="/var/log/deploy-$project_name.log"

print_info "Membuat deployment script di $deploy_script..."

sudo tee "$deploy_script" > /dev/null <<EOF
#!/bin/bash

# Konfigurasi
PROJECT_DIR="$project_dir"
LOG_FILE="$log_file"
BRANCH="$branch_name"
PACKAGE_MANAGER="$package_manager"

# Fungsi logging
log() {
    echo "[\$(date '+%Y-%m-%d %H:%M:%S')] \$1" | tee -a "\$LOG_FILE"
}

log "=== Starting deployment process ==="

# Pindah ke directory project
cd "\$PROJECT_DIR" || exit 1

# Stash perubahan lokal jika ada
git stash

# Pull perubahan terbaru
log "Pulling latest changes from GitHub..."
git pull origin "\$BRANCH"

if [ \$? -ne 0 ]; then
    log "ERROR: Git pull failed"
    exit 1
fi

# Install/update dependencies
log "Installing dependencies with \$PACKAGE_MANAGER..."
if [ "\$PACKAGE_MANAGER" == "yarn" ]; then
    yarn install
else
    npm install
fi

if [ \$? -ne 0 ]; then
    log "ERROR: Dependency installation failed"
    exit 1
fi

# Set permissions untuk user
log "Setting permissions for build..."
sudo chown -R $USER:$USER "$PROJECT_DIR"
sudo chmod -R 755 "$PROJECT_DIR"

# Hapus dist directory lama jika ada
if [ -d "$PROJECT_DIR/dist" ]; then
    rm -rf "$PROJECT_DIR/dist"
fi

# Build project
log "Building Astro project..."
if [ "\$PACKAGE_MANAGER" == "yarn" ]; then
    yarn build
else
    npm run build
fi

if [ \$? -ne 0 ]; then
    log "ERROR: Build failed"
    exit 1
fi

# Set permissions untuk Nginx
log "Setting permissions..."
sudo chown -R www-data:www-data "\$PROJECT_DIR/dist"
sudo chmod -R 755 "\$PROJECT_DIR/dist"

log "=== Deployment completed successfully ==="
log ""
EOF

sudo chmod +x "$deploy_script"
print_success "Deployment script berhasil dibuat"

# Buat log file
sudo touch "$log_file"
sudo chown $USER:$USER "$log_file"
print_success "Log file dibuat di $log_file"

# ============================================================
# STEP 7: SETUP CRON JOB
# ============================================================
print_header "STEP 7: SETUP CRON JOB"

print_info "Menambahkan cron job untuk deployment otomatis..."

# Hapus cron job lama jika ada
(crontab -l 2>/dev/null | grep -v "deploy-$project_name.sh") | crontab -

# Tambah cron job baru
(crontab -l 2>/dev/null; echo "$cron_schedule $deploy_script >> $log_file 2>&1") | crontab -

print_success "Cron job berhasil ditambahkan ($interval_text)"

# ============================================================
# STEP 8: KONFIGURASI NGINX
# ============================================================
print_header "STEP 8: KONFIGURASI NGINX"

nginx_conf="/etc/nginx/sites-available/$project_name"

print_info "Membuat konfigurasi Nginx..."

if [ -z "$domain_name" ]; then
    server_name="_"
    print_info "Menggunakan default server (IP address)"
else
    server_name="$domain_name www.$domain_name"
    print_info "Menggunakan domain: $domain_name"
fi

sudo tee "$nginx_conf" > /dev/null <<EOF
server {
    listen 80;
    server_name $server_name;
    
    root $project_dir/dist;
    index index.html;
    
    # Logs
    access_log /var/log/nginx/$project_name-access.log;
    error_log /var/log/nginx/$project_name-error.log;
    
    # Main location
    location / {
        try_files \$uri \$uri/ /index.html;
    }
    
    # Cache static assets
    location ~* \.(js|css|png|jpg|jpeg|gif|ico|svg|woff|woff2|ttf|eot|webp|avif)$ {
        expires 1y;
        add_header Cache-Control "public, immutable";
    }
    
    # Security headers
    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header X-XSS-Protection "1; mode=block" always;
    
    # Gzip compression
    gzip on;
    gzip_vary on;
    gzip_min_length 1024;
    gzip_types text/plain text/css text/xml text/javascript application/x-javascript application/xml+rss application/javascript application/json;
    
    # Hide Nginx version
    server_tokens off;
}
EOF

# Enable site
sudo ln -sf "$nginx_conf" "/etc/nginx/sites-enabled/$project_name"

# Hapus default site jika ada
if [ -L "/etc/nginx/sites-enabled/default" ]; then
    if confirm "Apakah Anda ingin menonaktifkan default Nginx site?"; then
        sudo rm /etc/nginx/sites-enabled/default
        print_success "Default site dinonaktifkan"
    fi
fi

# Test konfigurasi Nginx
print_info "Testing konfigurasi Nginx..."
if sudo nginx -t; then
    print_success "Konfigurasi Nginx valid"
    sudo systemctl reload nginx
    print_success "Nginx berhasil di reload"
else
    print_error "Konfigurasi Nginx tidak valid!"
    exit 1
fi

# ============================================================
# STEP 9: SETUP SSL (OPSIONAL)
# ============================================================
print_header "STEP 9: SETUP SSL (OPSIONAL)"

if [ ! -z "$domain_name" ]; then
    if confirm "Apakah Anda ingin menginstall SSL certificate dengan Let's Encrypt?"; then
        print_info "Menginstall Certbot..."
        sudo apt install -y certbot python3-certbot-nginx
        
        print_info "Generating SSL certificate..."
        sudo certbot --nginx -d "$domain_name" -d "www.$domain_name" --non-interactive --agree-tos --register-unsafely-without-email || \
        sudo certbot --nginx -d "$domain_name" -d "www.$domain_name"
        
        if [ $? -eq 0 ]; then
            print_success "SSL certificate berhasil diinstall"
            print_info "Auto-renewal sudah aktif"
        else
            print_warning "Gagal install SSL certificate"
            print_info "Anda bisa install manual nanti dengan: sudo certbot --nginx -d $domain_name"
        fi
    fi
else
    print_warning "SSL tidak dapat diinstall tanpa domain"
fi

# ============================================================
# STEP 10: BUAT MANAGEMENT SCRIPT
# ============================================================
print_header "STEP 10: MEMBUAT MANAGEMENT SCRIPT"

manage_script="/usr/local/bin/manage-$project_name.sh"

sudo tee "$manage_script" > /dev/null <<'EOFMANAGE'
#!/bin/bash

PROJECT_NAME="PROJECT_NAME_PLACEHOLDER"
PROJECT_DIR="PROJECT_DIR_PLACEHOLDER"
LOG_FILE="LOG_FILE_PLACEHOLDER"
DEPLOY_SCRIPT="DEPLOY_SCRIPT_PLACEHOLDER"

RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m'

print_header() {
    echo -e "\n${BLUE}═══════════════════════════════════════════${NC}"
    echo -e "${BLUE}$1${NC}"
    echo -e "${BLUE}═══════════════════════════════════════════${NC}\n"
}

show_menu() {
    clear
    echo -e "${GREEN}"
    echo "╔═══════════════════════════════════════════════════════╗"
    echo "║         ASTRO DEPLOYMENT MANAGEMENT                   ║"
    echo "║         Project: $PROJECT_NAME"
    echo "╚═══════════════════════════════════════════════════════╝"
    echo -e "${NC}"
    echo "1. Deploy Now (Manual)"
    echo "2. View Deployment Log"
    echo "3. View Live Log (tail -f)"
    echo "4. Check Deployment Status"
    echo "5. View Cron Job"
    echo "6. Edit Cron Job"
    echo "7. Restart Nginx"
    echo "8. View Nginx Error Log"
    echo "9. Check Disk Usage"
    echo "10. Git Status"
    echo "0. Exit"
    echo ""
    read -p "Pilih menu (0-10): " choice
}

while true; do
    show_menu
    case $choice in
        1)
            print_header "MANUAL DEPLOYMENT"
            bash "$DEPLOY_SCRIPT"
            read -p "Press ENTER to continue..."
            ;;
        2)
            print_header "DEPLOYMENT LOG"
            tail -50 "$LOG_FILE"
            read -p "Press ENTER to continue..."
            ;;
        3)
            print_header "LIVE LOG (Ctrl+C to exit)"
            tail -f "$LOG_FILE"
            ;;
        4)
            print_header "DEPLOYMENT STATUS"
            echo "Last 5 deployments:"
            grep "Deployment completed" "$LOG_FILE" | tail -5
            echo ""
            echo "Last errors:"
            grep "ERROR" "$LOG_FILE" | tail -5
            read -p "Press ENTER to continue..."
            ;;
        5)
            print_header "CRON JOB"
            crontab -l | grep "$PROJECT_NAME"
            read -p "Press ENTER to continue..."
            ;;
        6)
            print_header "EDIT CRON JOB"
            crontab -e
            ;;
        7)
            print_header "RESTART NGINX"
            sudo nginx -t && sudo systemctl restart nginx
            echo "Nginx restarted"
            read -p "Press ENTER to continue..."
            ;;
        8)
            print_header "NGINX ERROR LOG"
            sudo tail -50 /var/log/nginx/$PROJECT_NAME-error.log
            read -p "Press ENTER to continue..."
            ;;
        9)
            print_header "DISK USAGE"
            df -h "$PROJECT_DIR"
            echo ""
            du -sh "$PROJECT_DIR"/*
            read -p "Press ENTER to continue..."
            ;;
        10)
            print_header "GIT STATUS"
            cd "$PROJECT_DIR"
            git status
            echo ""
            git log --oneline -5
            read -p "Press ENTER to continue..."
            ;;
        0)
            echo "Goodbye!"
            exit 0
            ;;
        *)
            echo "Invalid choice"
            sleep 1
            ;;
    esac
done
EOFMANAGE

# Replace placeholders
sudo sed -i "s|PROJECT_NAME_PLACEHOLDER|$project_name|g" "$manage_script"
sudo sed -i "s|PROJECT_DIR_PLACEHOLDER|$project_dir|g" "$manage_script"
sudo sed -i "s|LOG_FILE_PLACEHOLDER|$log_file|g" "$manage_script"
sudo sed -i "s|DEPLOY_SCRIPT_PLACEHOLDER|$deploy_script|g" "$manage_script"

sudo chmod +x "$manage_script"
print_success "Management script dibuat di $manage_script"

# ============================================================
# INSTALASI SELESAI
# ============================================================
print_header "✓ INSTALASI SELESAI!"

echo -e "${GREEN}╔═══════════════════════════════════════════════════════╗${NC}"
echo -e "${GREEN}║           INSTALASI BERHASIL DISELESAIKAN             ║${NC}"
echo -e "${GREEN}╚═══════════════════════════════════════════════════════╝${NC}"
echo ""
print_info "Ringkasan Instalasi:"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "📁 Project Directory  : $project_dir"
echo "🌐 Website URL        : http://$([ -z "$domain_name" ] && hostname -I | awk '{print $1}' || echo "$domain_name")"
echo "📋 Deployment Log     : $log_file"
echo "⚙️  Deployment Script  : $deploy_script"
echo "🔧 Management Script  : $manage_script"
echo "⏰ Cron Schedule      : $interval_text"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo ""

print_info "Command yang bisa digunakan:"
echo "  • Deploy manual        : bash $deploy_script"
echo "  • Lihat log           : tail -f $log_file"
echo "  • Management menu     : bash $manage_script"
echo "  • Edit cron           : crontab -e"
echo "  • Test nginx config   : sudo nginx -t"
echo "  • Reload nginx        : sudo systemctl reload nginx"
echo ""

if confirm "Apakah Anda ingin menjalankan deployment sekarang?"; then
    print_info "Menjalankan deployment pertama..."
    bash "$deploy_script"
    print_success "Deployment selesai! Cek website Anda"
fi

echo ""
print_success "Website Anda sekarang bisa diakses di:"
if [ -z "$domain_name" ]; then
    echo -e "${GREEN}http://$(hostname -I | awk '{print $1}')${NC}"
else
    echo -e "${GREEN}http://$domain_name${NC}"
    if [ -f "/etc/letsencrypt/live/$domain_name/fullchain.pem" ]; then
        echo -e "${GREEN}https://$domain_name${NC}"
    fi
fi

echo ""
print_info "Untuk management, jalankan: bash $manage_script"
echo ""
print_success "Terima kasih telah menggunakan installer ini! 🚀"
