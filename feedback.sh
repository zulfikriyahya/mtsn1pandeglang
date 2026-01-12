#!/bin/bash

# ==============================================================================
# GENERATOR DATA ULASAN MATSANEPA (SIMPLE FORMAT SPLIT)
# Format Output: name,rating,message,created_at,ip_address
# Total: 10.000 Data (10 File @1000 Baris)
# ==============================================================================

TOTAL_DATA=10000
BATCH_SIZE=1000
BASE_FILENAME="ulasan_matsanepa_part"
HEADER_CSV="name,rating,message,created_at,ip_address"

# ==============================================================================
# 1. DATABASE NAMA (EXPANDED EDITION - 40.000+ COMBINATIONS)
# ==============================================================================

male_first=(
# Khas Banten & Sunda
"Tb" "Tubagus" "Entol" "Agus" "Asep" "Cecep" "Dadang" "Deden" "Endang" "Jajang" 
"Maman" "Nana" "Opik" "Sopian" "Tegar" "Ujang" "Yayat" "Usep" "Iwan" "Eep"
# Islami & Modern A-E
"Abid" "Adam" "Adit" "Aditya" "Ahmad" "Akbar" "Aldi" "Alif" "Alvin" "Amir" "Anwar" "Ardi" "Arif" "Aris" "Arya" "Azka"
"Bagas" "Baim" "Bambang" "Bara" "Bayu" "Bima" "Bintang" "Budi" "Burhan"
"Cahya" "Candra" "Chairul" "Cipta"
"Daffa" "Dani" "Danu" "Dedi" "Deri" "Dika" "Dimas" "Dion" "Doni" "Dwi" "Dzaki"
"Eko" "Emran" "Ervan" "Erwin" "Evan" "Ezra"
# F-J
"Fadil" "Fajar" "Faqih" "Farhan" "Farid" "Faris" "Fathir" "Fauzan" "Febri" "Fery" "Fikri" "Firman"
"Galang" "Galih" "Gani" "Ghani" "Gilang" "Gilang" "Gunawan" "Guntur" "Gustian"
"Hadi" "Hafidz" "Haikal" "Hamdan" "Hanif" "Hendra" "Heru" "Hidayat" "Hilman"
"Ibrahim" "Ihsan" "Ikbal" "Ilham" "Imam" "Imran" "Indra" "Irfan" "Irwan" "Ismail"
"Jamal" "Jefri" "Joni" "Juan" "Junaedi"
# K-O
"Kafi" "Kamal" "Kevin" "Kholid" "Kiki" "Kurnia"
"Latif" "Lukman" "Luthfi"
"Malik" "Maulana" "Miftah" "Muhammad" "Mufid" "Mustofa"
"Nabil" "Nanang" "Nasrudin" "Naufal" "Nizar" "Nugraha" "Nur"
"Omar" "Oscar"
# P-T
"Paisal" "Panji" "Pasha" "Prasetyo" "Putra"
"Qais" "Qomar"
"Raffa" "Rafi" "Rahmat" "Raka" "Rama" "Randy" "Rangga" "Rayhan" "Reza" "Rian" "Rico" "Ridwan" "Riki" "Rio" "Rizki" "Robi" "Roni" "Ryan"
"Sahrul" "Salman" "Sandi" "Satria" "Septian" "Setiawan" "Sigit" "Slamet" "Soni" "Surya" "Syahrizal"
"Taufik" "Tio" "Tito" "Tommy" "Tri" "Tulus"
# U-Z
"Umar" "Usman"
"Vano" "Vicky" "Vito"
"Wahyu" "Wildan" "Wira" "Wisnu"
"Xavier"
"Yassar" "Yoga" "Yuda" "Yudi" "Yusuf"
"Zainul" "Zaki" "Zidan" "Zulfikar"
)

male_last=(
# A-F
"Abdullah" "Adhitama" "Adriansyah" "Afandi" "Akbar" "Alamsyah" "Alfian" "Ali" "Anwar" "Aprianto" "Ardiansyah" "Arifin" "Ashari" "Asshiddiq" "Astaman"
"Bachtiar" "Bahri" "Basalamah" "Baskoro" "Basri" "Budiman"
"Cahyadi" "Cahyono" "Chandra"
"Damanik" "Darmawan" "Dewantara" "Dharma" "Dinata" "Djaya"
"Effendi" "Erlangga"
"Fadhilah" "Fauzi" "Febrian" "Ferdian" "Firdaus" "Firmansyah"
# G-K
"Gumelar" "Gunawan"
"Hadi" "Hakim" "Hamzah" "Handoko" "Hardianto" "Hartono" "Haryanto" "Hasan" "Hendrawan" "Herlambang" "Hermawan" "Hidayat"
"Ibrahim" "Irawan" "Iskandar" "Ismail" "Iswanto"
"Jailani" "Jamaludin" "Jaya" "Julianto"
"Kadir" "Kamal" "Kurnia" "Kurniawan" "Kusnadi" "Kusuma"
# L-P
"Lazuardi" "Lesmana" "Lubis"
"Mahendra" "Mahardika" "Marzuki" "Maulana" "Mubarok" "Mulyadi" "Mulyana" "Mustofa" "Muttaqin"
"Nasrullah" "Nasution" "Nugraha" "Nurhadi"
"Oktavian" "Oetama"
"Pangestu" "Pamungkas" "Permadi" "Permana" "Pradana" "Prakoso" "Prasetio" "Pratama" "Prayoga" "Purnomo" "Putra"
# Q-U
"Qodir" "Qolbi"
"Rachman" "Raharja" "Rahman" "Ramadhan" "Ramdani" "Rasyid" "Riyadi" "Rohman" "Rosyid" "Rusli"
"Sadewa" "Saepudin" "Safitra" "Sahputra" "Saleh" "Salim" "Sanjaya" "Santoso" "Saputra" "Saputro" "Sari" "Setiawan" "Setyawan" "Sidik" "Sihabudin" "Simanjuntak" "Siregar" "Soleh" "Solihin" "Somantri" "Subagja" "Subekti" "Sudrajat" "Suharto" "Sulaiman" "Supriyadi" "Suryana" "Susanto" "Susilo" "Sutrisno" "Syafi'i" "Syahputra"
"Tanjung" "Triyono"
"Utama" "Utomo"
# V-Z
"Viansyah"
"Wahyu" "Wardana" "Wibisono" "Wibowo" "Wicaksono" "Widodo" "Wijaya" "Wiraatmadja" "Wirawan"
"Yuda" "Yudhistira" "Yulianto" "Yusuf"
"Zaelani" "Zain" "Zakaria" "Zulkarnain"
)

female_first=(
# Khas Banten & Sunda
"Ratu" "Neng" "Euis" "Iis" "Mimin" "Tati" "Lilis" "Pipit" "Kokom" "Cucu" "Yoyoh" "Eneng" "Neneng" "Ai" "Imas"
# A-E
"Adiba" "Adinda" "Afifah" "Agnes" "Aisyah" "Ajeng" "Alia" "Alifa" "Amalia" "Amanda" "Amel" "Amira" "Ana" "Andini" "Anggi" "Ani" "Anita" "Annisa" "April" "Ardhina" "Arin" "Astri" "Aulia" "Ayu" "Azizah"
"Bela" "Bella" "Berlian" "Bila" "Bilqis" "Bunga"
"Caca" "Cahya" "Cantika" "Cici" "Cindy" "Citra" "Clarissa"
"Dahlan" "Dahlia" "Desi" "Devi" "Dewi" "Diah" "Dian" "Dinda" "Dina" "Dini" "Dita" "Diva"
"Eka" "Elis" "Elma" "Elsa" "Elvina" "Endah" "Erna" "Erni" "Eva" "Evi"
# F-J
"Fadhilah" "Fani" "Fanny" "Farah" "Farida" "Fatin" "Fauziah" "Fera" "Fika" "Fira" "Fitri" "Fitria" "Friska" "Fuji"
"Gendis" "Ghea" "Gina" "Gisela" "Gita" "Grace"
"Hafizah" "Halimah" "Hana" "Hani" "Hanna" "Hesti" "Hilda" "Husna"
"Ika" "Ima" "Ina" "Indah" "Indri" "Inez" "Intan" "Ira" "Irma"
"Jamilah" "Jelita" "Jihan" "Jojo" "Julia" "Juwita"
# K-O
"Kaila" "Karina" "Karlina" "Kartika" "Kayla" "Kania" "Khansa" "Khusnul" "Kiki"
"Laila" "Lana" "Laras" "Lia" "Linda" "Lisna" "Lulu" "Luna"
"Maharani" "Mawar" "Maya" "Mega" "Meisya" "Melati" "Meli" "Mita" "Mona" "Mutia"
"Nabila" "Nadia" "Nadin" "Naila" "Nanda" "Nania" "Nayla" "Nia" "Nina" "Nisa" "Nita" "Nola" "Novi" "Novia" "Nur" "Nurul"
"Ola" "Olive" "Olivia" "Olla" "Ovi"
# P-T
"Pia" "Prita" "Puput" "Putri"
"Qiana" "Qori" "Qorina"
"Rahma" "Raisa" "Rani" "Rara" "Ratna" "Reni" "Rere" "Resti" "Ria" "Rika" "Rina" "Rini" "Riri" "Risa" "Risda" "Riska" "Risma" "Riza" "Rosi" "Rosma"
"Sabrina" "Safira" "Salma" "Salsa" "Santi" "Sarah" "Sari" "Sekar" "Sela" "Septi" "Sherly" "Sifa" "Silvi" "Sinta" "Siska" "Siti" "Sri" "Suci" "Susi" "Syifa"
"Talita" "Tania" "Tara" "Tia" "Tiara" "Tika" "Tina" "Tri" "Tyas"
# U-Z
"Uci" "Ulfah" "Ulya" "Umairoh" "Uswatun"
"Vania" "Vera" "Vina" "Vivi" "Viona"
"Wanda" "Widya" "Wulan" "Winda" "Wiwit" "Wulan"
"Xena" "Xaviera"
"Yanti" "Yasmin" "Yola" "Yulia" "Yuliana" "Yuni" "Yusra"
"Zahra" "Zahwa" "Zakia" "Zalfa" "Zaskia" "Zia"
)

female_last=(
# A-K
"Adawiyah" "Afifah" "Agustina" "Aini" "Amalia" "Ambarwati" "Aminah" "Andini" "Anggraini" "Anjani" "Aprilia" "Apriani" "Ardianti" "Ariani" "Astuti" "Aulia" "Azizah" "Azzahra"
"Basagita" "Basalamah" "Budiarti"
"Cahaya" "Cahyani" "Chairunisa" "Chairunnisa"
"Damayanti" "Deswita" "Dewi"
"Elvina" "Ernawati"
"Fadhilah" "Faridah" "Fatimah" "Febriani" "Fitri" "Fitriani" "Fitriana"
"Gitasari" "Gustina"
"Haliza" "Handayani" "Haryanti" "Hasanah" "Herawati" "Hidayah"
"Indraswari" "Indriani" "Irawati" "Ismayanti"
"Jannah" "Julaeha" "Juliana" "Juwita"
"Kamilah" "Kartika" "Kartini" "Khadijah" "Khairunnisa" "Khasanah" "Kurnia" "Kurniawati" "Kusuma" "Kusumawati"
# L-Z
"Larasati" "Lestari"
"Maharani" "Mardiah" "Marlina" "Maryani" "Maulida" "Mayasari" "Melati" "Mulyani" "Murni"
"Ningsih" "Novitasari" "Nuraini" "Nurjanah" "Nurhasanah" "Nurhayati" "Nurlaila"
"Oktaviani" "Oktaviana"
"Pambudi" "Permata" "Pertiwi" "Prameswari" "Pratiwi" "Puspita" "Puspitasari" "Putri"
"Qolbi" "Qonita"
"Rahayu" "Rahma" "Rahmadani" "Rahmawati" "Ramadhani" "Ratnasari" "Riyanti" "Rohimah" "Rosdiana" "Rosmalina"
"Saadiah" "Safitri" "Salsabila" "Santika" "Saraswati" "Sari" "Sartika" "Septiani" "Setiawati" "Setyowati" "Shohihah" "Suci" "Suhartini" "Sulistiawati" "Sumiati" "Suryani" "Susanti" "Susilawati" "Syahputri"
"Triana"
"Utami" "Utari"
"Veronica"
"Wahyuni" "Wardani" "Wati" "Widya" "Wijayanti" "Wulandari" "Wulansari"
"Yulia" "Yuliana" "Yuliani" "Yuniar" "Yusnita"
"Zahira" "Zahra" "Zainab"
)

# ==============================================================================
# 2. DATABASE PESAN / MESSAGE (Context: MTsN 1 Pandeglang)
# ==============================================================================

# Topic: Pelayanan & PTSP
msg_service=(
"Pelayanan PTSP sangat cepat, legalisir ijazah selesai dalam 15 menit tanpa biaya."
"Gedung PTSP nyaman dan petugasnya ramah, benar-benar Zona Integritas."
"Transparansi biaya PPDB sangat jelas, tidak ada pungli di madrasah ini."
"Sistem antrian di PTSP tertib, ruang tunggunya adem ada AC."
"Apresiasi untuk Pak Umar Mu'tamar dan staf TU yang sangat membantu administrasi anak saya."
"Tracking berkas lewat WhatsApp sangat inovatif, memudahkan wali murid."
"Pelayanan satu pintu yang profesional, satpamnya juga sangat membantu mengarahkan."
)

# Topic: Akademik & Kurikulum
msg_acad=(
"Program Kurikulum Berbasis Cinta membuat anak saya senang berangkat sekolah."
"Alhamdulillah hafalan Juz 30 anak saya lancar berkat program Tahfidz Intensif."
"Kelas Unggulan Sains sangat membantu persiapan anak menghadapi KSN."
"Sangat terkesan dengan Guest Teacher Session, memberikan wawasan dunia kerja."
"Guru-guru menerapkan metode mengajar yang humanis, anak tidak merasa tertekan."
"Program Bilingual Arab-Inggris melatih kepercayaan diri siswa tampil di depan umum."
"Kelas Digital dengan tablet sangat relevan untuk persiapan masa depan anak."
"Klinik Riset sangat bagus untuk melatih anak berpikir kritis dan menulis karya ilmiah."
)

# Topic: Ekskul & Prestasi
msg_ekskul=(
"Bangga sekali melihat Drumband Gema Nada yang selalu juara di tingkat provinsi."
"Ekskul Paskibra Satria Pandeglang benar-benar membentuk mental disiplin anak."
"SISPALA mengajarkan kemandirian dan kepedulian lingkungan yang nyata."
"Tim Futsal Matsanepa FC mainnya taktis dan sportif, fasilitas lapangannya juga oke."
"Anak saya jadi lebih percaya diri setelah gabung di OSIM dan ikut LDKS."
"PMR Madya sangat sigap dalam pertolongan pertama, kegiatannya sangat positif."
"Marawis dan Hadroh sekolah ini suaranya merdu, sering diundang acara masyarakat."
"Ekskul Jurnalistik melatih anak saya jadi kritis dan jago menulis berita."
)

# Topic: Lingkungan & Fasilitas
msg_env=(
"Suasana madrasah sangat asri dan hijau, program Adiwiyata benar-benar jalan."
"Kebijakan Zero Plastic di kantin sangat bagus untuk edukasi lingkungan."
"Bank Sampah Berhias mengajarkan siswa memilah sampah jadi berkah."
"Toilet siswa bersih dan airnya lancar, sangat nyaman."
"Masjid sekolah luas dan bersih, kegiatan sholat Dhuha berjalannya tertib."
"Website sekolah super cepat (0.8 detik), cari info PPDB jadi gampang."
"Perpustakaan digitalnya lengkap, anak saya betah baca buku di sana."
)

# Gabung semua pesan
ALL_MSGS=("${msg_service[@]}" "${msg_acad[@]}" "${msg_ekskul[@]}" "${msg_env[@]}")

# ==============================================================================
# 3. FUNGSI GENERATOR
# ==============================================================================

get_random() {
    local arr=("${!1}")
    echo "${arr[RANDOM % ${#arr[@]}]}"
}

gen_ip() {
    # Random IP
    echo "$((RANDOM % 100 + 36)).$((RANDOM % 256)).$((RANDOM % 256)).$((RANDOM % 256))"
}

gen_date() {
    # 1 Jan 2024 - 31 Des 2026
    local start=1704067200
    local end=1798761600
    local diff=$((end - start))
    local offset=$(( (RANDOM << 15 | RANDOM) % diff ))
    local final=$((start + offset))
    date -d "@$final" "+%Y-%m-%d %H:%M:%S"
}

# ==============================================================================
# 4. EKSEKUSI UTAMA
# ==============================================================================

declare -A used_names
count=0
file_index=1
current_file="${BASE_FILENAME}_${file_index}.csv"

# Write Header File 1
echo "$HEADER_CSV" > "$current_file"

echo "Membuat 10.000 data (Format: name,rating,message,created_at,ip_address)..."

while [ $count -lt $TOTAL_DATA ]; do
    
    # 1. GENERATE NAME (Unique)
    gender=$((RANDOM % 2))
    if [ $gender -eq 0 ]; then
        fname=$(get_random male_first[@])
        lname=$(get_random male_last[@])
    else
        fname=$(get_random female_first[@])
        lname=$(get_random female_last[@])
    fi
    fullname="$fname $lname"
    
    # Cek Unik
    if [[ -n "${used_names[$fullname]}" ]]; then continue; fi
    used_names["$fullname"]=1
    
    # 2. RATING (4 or 5)
    rating=$((RANDOM % 2 + 4))
    
    # 3. MESSAGE (Random from all topics)
    message=$(get_random ALL_MSGS[@])
    
    # 4. DATE & IP
    created_at=$(gen_date)
    ip_address=$(gen_ip)
    
    # 5. WRITE TO CSV
    # Gunakan quotes pada message untuk handle koma di dalam kalimat
    echo "$fullname,$rating,\"$message\",$created_at,$ip_address" >> "$current_file"
    
    ((count++))
    
    # 6. SPLIT LOGIC
    if (( count % BATCH_SIZE == 0 && count < TOTAL_DATA )); then
        ((file_index++))
        current_file="${BASE_FILENAME}_${file_index}.csv"
        echo "$HEADER_CSV" > "$current_file"
        echo "File #$((file_index-1)) selesai. Membuat File #$file_index..."
    fi
    
    # Visual Progress
    if (( count % 100 == 0 )); then echo -ne "Progress: $count / $TOTAL_DATA \r"; fi
done

echo ""
echo "------------------------------------------------------------"
echo "SUKSES! 10 File CSV telah dibuat."
echo "Format: name,rating,message,created_at,ip_address"
echo "Files: ${BASE_FILENAME}_1.csv s/d ${BASE_FILENAME}_10.csv"
echo "------------------------------------------------------------"