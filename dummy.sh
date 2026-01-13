#!/bin/bash

# ==============================================================================
# DUMMY ULTIMATE DATA GENERATOR
# Version: 4.0 (Updated for 6 Categories Survey)
# Output: ./dummy/
# Features: Enhanced Database, 6 Survey Categories, Massive Variations
# ==============================================================================

OUTPUT_DIR="dummy"

# Bersihkan layar dan tampilkan header
clear
echo "=================================================================="
echo "   GENERATOR DATA DUMMY (ULTIMATE EDITION v4.0)"
echo "   Support 6 Kategori Survei: ZI, Service, Academic, Facilities,"
echo "   Management, Culture"
echo "=================================================================="

# ------------------------------------------------------------------------------
# 1. KONFIGURASI INTERAKTIF
# ------------------------------------------------------------------------------

# Input Total Data
read -p "1. Total data per kategori? (Default: 10000): " INPUT_TOTAL
INPUT_TOTAL=${INPUT_TOTAL:-10000}

# Input Batch Size
read -p "2. Maksimal baris per file CSV? (Default: 1000): " INPUT_BATCH
INPUT_BATCH=${INPUT_BATCH:-1000}

# Input Tanggal
read -p "3. Tanggal Mulai (YYYY-MM-DD) [Def: 2024-01-01]: " INPUT_START_DATE
INPUT_START_DATE=${INPUT_START_DATE:-"2024-01-01"}

read -p "4. Tanggal Selesai (YYYY-MM-DD) [Def: 2025-12-31]: " INPUT_END_DATE
INPUT_END_DATE=${INPUT_END_DATE:-"2025-12-31"}

# Input Rating
read -p "5. Minimal Rating Bintang (1-5)? [Def: 4]: " INPUT_MIN_STAR
if [[ -z "$INPUT_MIN_STAR" || "$INPUT_MIN_STAR" -lt 1 || "$INPUT_MIN_STAR" -gt 5 ]]; then 
    INPUT_MIN_STAR=4
fi

# Konversi Tanggal ke Timestamp
TS_START=$(date -d "$INPUT_START_DATE" +%s 2>/dev/null)
TS_END=$(date -d "$INPUT_END_DATE" +%s 2>/dev/null)

# Fallback jika date gagal (untuk kompatibilitas sistem)
if [[ -z "$TS_START" || -z "$TS_END" ]]; then
    echo "Warning: Format tanggal tidak dikenali. Menggunakan default 2024-2025."
    TS_START=1704067200
    TS_END=1767225600
fi

# Buat Folder Output
if [ ! -d "$OUTPUT_DIR" ]; then
    mkdir -p "$OUTPUT_DIR"
fi

echo "------------------------------------------------------------------"
echo "SUMMARY KONFIGURASI:"
echo "------------------------------------------------------------------"
echo "Target Folder : ./$OUTPUT_DIR/"
echo "Total Data    : $(printf "%'.f\n" $INPUT_TOTAL) baris per tipe"
echo "Pecahan File  : $(printf "%'.f\n" $INPUT_BATCH) baris/file"
echo "Periode       : $INPUT_START_DATE s/d $INPUT_END_DATE"
echo "Rating Range  : $INPUT_MIN_STAR - 5 Bintang"
echo "------------------------------------------------------------------"
read -p "Tekan ENTER untuk memulai proses generation..."

# ------------------------------------------------------------------------------
# 2. DATABASE NAMA (DITINGKATKAN - 100+ Item per Array)
# ------------------------------------------------------------------------------

male_first=(
"Tb" "Tubagus" "Entol" "Agus" "Asep" "Cecep" "Dadang" "Deden" "Endang" "Jajang" 
"Maman" "Nana" "Opik" "Sopian" "Tegar" "Ujang" "Yayat" "Usep" "Iwan" "Eep"
"Abid" "Adam" "Adit" "Aditya" "Ahmad" "Akbar" "Aldi" "Alif" "Alvin" "Amir" "Anwar" "Ardi" "Arif" "Aris" "Arya" "Azka"
"Bagas" "Baim" "Bambang" "Bara" "Bayu" "Bima" "Bintang" "Budi" "Burhan" "Bram" "Beni"
"Cahya" "Candra" "Chairul" "Cipta" "Cakra"
"Daffa" "Dani" "Danu" "Dedi" "Deri" "Dika" "Dimas" "Dion" "Doni" "Dwi" "Dzaki" "Darma" "David" "Dicky"
"Eko" "Emran" "Ervan" "Erwin" "Evan" "Ezra" "Ega" "Elang"
"Fadil" "Fajar" "Faqih" "Farhan" "Farid" "Faris" "Fathir" "Fauzan" "Febri" "Fery" "Fikri" "Firman" "Fahmi" "Faiz"
"Galang" "Galih" "Gani" "Ghani" "Gilang" "Gunawan" "Guntur" "Gustian" "Gading" "Genta"
"Hadi" "Hafidz" "Haikal" "Hamdan" "Hanif" "Hendra" "Heru" "Hidayat" "Hilman" "Husein" "Haryo"
"Ibrahim" "Ihsan" "Ikbal" "Ilham" "Imam" "Imran" "Indra" "Irfan" "Irwan" "Ismail" "Ilyas" "Ibnu"
"Jamal" "Jefri" "Joni" "Juan" "Junaedi" "Joko" "Julian"
"Kafi" "Kamal" "Kevin" "Kholid" "Kiki" "Kurnia" "Kenzo" "Krisna"
"Latif" "Lukman" "Luthfi" "Leo" "Lian"
"Malik" "Maulana" "Miftah" "Muhammad" "Mufid" "Mustofa" "Marcel" "Mario" "Mochamad"
"Nabil" "Nanang" "Nasrudin" "Naufal" "Nizar" "Nugraha" "Nur" "Nico" "Nathan"
"Omar" "Oscar" "Oki"
"Paisal" "Panji" "Pasha" "Prasetyo" "Putra" "Pandu" "Prama"
"Qais" "Qomar"
"Raffa" "Rafi" "Rahmat" "Raka" "Rama" "Randy" "Rangga" "Rayhan" "Reza" "Rian" "Rico" "Ridwan" "Riki" "Rio" "Rizki" "Robi" "Roni" "Ryan" "Rendra"
"Sahrul" "Salman" "Sandi" "Satria" "Septian" "Setiawan" "Sigit" "Slamet" "Soni" "Surya" "Syahrizal" "Samsul" "Samuel"
"Taufik" "Tio" "Tito" "Tommy" "Tri" "Tulus" "Tomi" "Teddy"
"Umar" "Usman" "Ubay"
"Vano" "Vicky" "Vito" "Verdi"
"Wahyu" "Wildan" "Wira" "Wisnu" "Wawan" "Willy"
"Xavier"
"Yassar" "Yoga" "Yuda" "Yudi" "Yusuf" "Yosep" "Yanuar"
"Zainul" "Zaki" "Zidan" "Zulfikar" "Zaenal"
)

male_last=(
"Abdullah" "Adhitama" "Adriansyah" "Afandi" "Akbar" "Alamsyah" "Alfian" "Ali" "Anwar" "Aprianto" "Ardiansyah" "Arifin" "Ashari" "Asshiddiq" "Astaman"
"Bachtiar" "Bahri" "Basalamah" "Baskoro" "Basri" "Budiman" "Bramantyo" "Bawono"
"Cahyadi" "Cahyono" "Chandra"
"Damanik" "Darmawan" "Dewantara" "Dharma" "Dinata" "Djaya" "Danuarta"
"Effendi" "Erlangga" "El-Farisi"
"Fadhilah" "Fauzi" "Febrian" "Ferdian" "Firdaus" "Firmansyah" "Fachrudin"
"Gumelar" "Gunawan" "Ginting"
"Hadi" "Hakim" "Hamzah" "Handoko" "Hardianto" "Hartono" "Haryanto" "Hasan" "Hendrawan" "Herlambang" "Hermawan" "Hidayat" "Hutagalung"
"Ibrahim" "Irawan" "Iskandar" "Ismail" "Iswanto" "Indrawan"
"Jailani" "Jamaludin" "Jaya" "Julianto"
"Kadir" "Kamal" "Kurnia" "Kurniawan" "Kusnadi" "Kusuma" "Kusumo"
"Lazuardi" "Lesmana" "Lubis" "Laksana"
"Mahendra" "Mahardika" "Marzuki" "Maulana" "Mubarok" "Mulyadi" "Mulyana" "Mustofa" "Muttaqin" "Manopo" "Mangkualam"
"Nasrullah" "Nasution" "Nugraha" "Nurhadi" "Nugroho" "Napitupulu"
"Oktavian" "Oetama"
"Pangestu" "Pamungkas" "Permadi" "Permana" "Pradana" "Prakoso" "Prasetio" "Pratama" "Prayoga" "Purnomo" "Putra" "Prabowo" "Pardede"
"Qodir" "Qolbi"
"Rachman" "Raharja" "Rahman" "Ramadhan" "Ramdani" "Rasyid" "Riyadi" "Rohman" "Rosyid" "Rusli" "Ramli"
"Sadewa" "Saepudin" "Safitra" "Sahputra" "Saleh" "Salim" "Sanjaya" "Santoso" "Saputra" "Saputro" "Sari" "Setiawan" "Setyawan" "Sidik" "Sihabudin" "Simanjuntak" "Siregar" "Soleh" "Solihin" "Somantri" "Subagja" "Subekti" "Sudrajat" "Suharto" "Sulaiman" "Supriyadi" "Suryana" "Susanto" "Susilo" "Sutrisno" "Syafi'i" "Syahputra" "Sihombing" "Sitompul"
"Tanjung" "Triyono" "Tirtayasa"
"Utama" "Utomo"
"Viansyah"
"Wahyu" "Wardana" "Wibisono" "Wibowo" "Wicaksono" "Widodo" "Wijaya" "Wiraatmadja" "Wirawan" "Wibakso"
"Yuda" "Yudhistira" "Yulianto" "Yusuf" "Yamin"
"Zaelani" "Zain" "Zakaria" "Zulkarnain" "Zuhri"
)

female_first=(
"Ratu" "Neng" "Euis" "Iis" "Mimin" "Tati" "Lilis" "Pipit" "Kokom" "Cucu" "Yoyoh" "Eneng" "Neneng" "Ai" "Imas"
"Adiba" "Adinda" "Afifah" "Agnes" "Aisyah" "Ajeng" "Alia" "Alifa" "Amalia" "Amanda" "Amel" "Amira" "Ana" "Andini" "Anggi" "Ani" "Anita" "Annisa" "April" "Ardhina" "Arin" "Astri" "Aulia" "Ayu" "Azizah" "Aurel" "Aura"
"Bela" "Bella" "Berlian" "Bila" "Bilqis" "Bunga" "Bernadya"
"Caca" "Cahya" "Cantika" "Cici" "Cindy" "Citra" "Clarissa" "Chika" "Cinta"
"Dahlan" "Dahlia" "Desi" "Devi" "Dewi" "Diah" "Dian" "Dinda" "Dina" "Dini" "Dita" "Diva" "Dhea" "Dwi"
"Eka" "Elis" "Elma" "Elsa" "Elvina" "Endah" "Erna" "Erni" "Eva" "Evi" "Ester" "Elsya"
"Fadhilah" "Fani" "Fanny" "Farah" "Farida" "Fatin" "Fauziah" "Fera" "Fika" "Fira" "Fitri" "Fitria" "Friska" "Fuji" "Felly"
"Gendis" "Ghea" "Gina" "Gisela" "Gita" "Grace" "Gabriella"
"Hafizah" "Halimah" "Hana" "Hani" "Hanna" "Hesti" "Hilda" "Husna" "Hanum"
"Ika" "Ima" "Ina" "Indah" "Indri" "Inez" "Intan" "Ira" "Irma" "Isyana"
"Jamilah" "Jelita" "Jihan" "Jojo" "Julia" "Juwita" "Jessica"
"Kaila" "Karina" "Karlina" "Kartika" "Kayla" "Kania" "Khansa" "Khusnul" "Kiki" "Kirana" "Keisya"
"Laila" "Lana" "Laras" "Lia" "Linda" "Lisna" "Lulu" "Luna" "Lesti" "Lidia"
"Maharani" "Mawar" "Maya" "Mega" "Meisya" "Melati" "Meli" "Mita" "Mona" "Mutia" "Marsha" "Melisa"
"Nabila" "Nadia" "Nadin" "Naila" "Nanda" "Nania" "Nayla" "Nia" "Nina" "Nisa" "Nita" "Nola" "Novi" "Novia" "Nur" "Nurul" "Naura" "Natasha"
"Ola" "Olive" "Olivia" "Olla" "Ovi"
"Pia" "Prita" "Puput" "Putri" "Prilly" "Pevita"
"Qiana" "Qori" "Qorina"
"Rahma" "Raisa" "Rani" "Rara" "Ratna" "Reni" "Rere" "Resti" "Ria" "Rika" "Rina" "Rini" "Riri" "Risa" "Risda" "Riska" "Risma" "Riza" "Rosi" "Rosma" "Rina"
"Sabrina" "Safira" "Salma" "Salsa" "Santi" "Sarah" "Sari" "Sekar" "Sela" "Septi" "Sherly" "Sifa" "Silvi" "Sinta" "Siska" "Siti" "Sri" "Suci" "Susi" "Syifa" "Shania" "Sandra"
"Talita" "Tania" "Tara" "Tia" "Tiara" "Tika" "Tina" "Tri" "Tyas" "Tasya"
"Uci" "Ulfah" "Ulya" "Umairoh" "Uswatun"
"Vania" "Vera" "Vina" "Vivi" "Viona" "Valerie" "Vanesha"
"Wanda" "Widya" "Wulan" "Winda" "Wiwit" "Wulan" "Wati"
"Xena" "Xaviera"
"Yanti" "Yasmin" "Yola" "Yulia" "Yuliana" "Yuni" "Yusra" "Yuki"
"Zahra" "Zahwa" "Zakia" "Zalfa" "Zaskia" "Zia" "Ziva"
)

female_last=(
"Adawiyah" "Afifah" "Agustina" "Aini" "Amalia" "Ambarwati" "Aminah" "Andini" "Anggraini" "Anjani" "Aprilia" "Apriani" "Ardianti" "Ariani" "Astuti" "Aulia" "Azizah" "Azzahra" "Ayu" "Ayunda"
"Basagita" "Basalamah" "Budiarti"
"Cahaya" "Cahyani" "Chairunisa" "Chairunnisa" "Cahyawati"
"Damayanti" "Deswita" "Dewi" "Dianita"
"Elvina" "Ernawati"
"Fadhilah" "Faridah" "Fatimah" "Febriani" "Fitri" "Fitriani" "Fitriana"
"Gitasari" "Gustina"
"Haliza" "Handayani" "Haryanti" "Hasanah" "Herawati" "Hidayah" "Hardiyanti"
"Indraswari" "Indriani" "Irawati" "Ismayanti"
"Jannah" "Julaeha" "Juliana" "Juwita"
"Kamilah" "Kartika" "Kartini" "Khadijah" "Khairunnisa" "Khasanah" "Kurnia" "Kurniawati" "Kusuma" "Kusumawati"
"Larasati" "Lestari"
"Maharani" "Mardiah" "Marlina" "Maryani" "Maulida" "Mayasari" "Melati" "Mulyani" "Murni" "Marwah"
"Ningsih" "Novitasari" "Nuraini" "Nurjanah" "Nurhasanah" "Nurhayati" "Nurlaila" "Nugraheni" "Nasywa"
"Oktaviani" "Oktaviana"
"Pambudi" "Permata" "Pertiwi" "Prameswari" "Pratiwi" "Puspita" "Puspitasari" "Putri" "Pratiwi" "Puspitasari"
"Qolbi" "Qonita"
"Rahayu" "Rahma" "Rahmadani" "Rahmawati" "Ramadhani" "Ratnasari" "Riyanti" "Rohimah" "Rosdiana" "Rosmalina"
"Saadiah" "Safitri" "Salsabila" "Santika" "Saraswati" "Sari" "Sartika" "Septiani" "Setiawati" "Setyowati" "Shohihah" "Suci" "Suhartini" "Sulistiawati" "Sumiati" "Suryani" "Susanti" "Susilawati" "Syahputri" "Susilowati"
"Triana"
"Utami" "Utari"
"Veronica"
"Wahyuni" "Wardani" "Wati" "Widya" "Wijayanti" "Wulandari" "Wulansari" "Winarsih" "Wulandari"
"Yulia" "Yuliana" "Yuliani" "Yuniar" "Yusnita"
"Zahira" "Zahra" "Zainab"
)

# ------------------------------------------------------------------------------
# 3. DATABASE PESAN / KONTEKS (DITINGKATKAN)
# ------------------------------------------------------------------------------

# ULASAN WEBSITE/SEKOLAH (General)
msg_service=(
"Pelayanan PTSP sangat cepat, legalisir ijazah selesai dalam 15 menit tanpa biaya."
"Gedung PTSP nyaman dan petugasnya ramah, benar-benar Zona Integritas."
"Transparansi biaya PPDB sangat jelas, tidak ada pungli di madrasah ini."
"Sistem antrian di PTSP tertib, ruang tunggunya adem ada AC."
"Apresiasi untuk Pak Umar Mu'tamar dan staf TU yang sangat membantu administrasi anak saya."
"Tracking berkas lewat WhatsApp sangat inovatif, memudahkan wali murid."
"Pelayanan satu pintu yang profesional, satpamnya juga sangat membantu mengarahkan."
"Respon admin di WhatsApp sangat cepat, saya terbantu saat lupa password akun PPDB."
"Pengambilan raport berjalan tertib, tidak berdesak-desakan."
"Satpam di gerbang depan sangat ramah dan selalu tersenyum menyapa tamu."
"Parkiran tamu tertata rapi, pelayanan dari awal masuk sampai keluar sangat baik."
)

msg_acad=(
"Program Kurikulum Berbasis Cinta membuat anak saya senang berangkat sekolah."
"Alhamdulillah hafalan Juz 30 anak saya lancar berkat program Tahfidz Intensif."
"Kelas Unggulan Sains sangat membantu persiapan anak menghadapi KSN."
"Sangat terkesan dengan Guest Teacher Session, memberikan wawasan dunia kerja."
"Guru-guru menerapkan metode mengajar yang humanis, anak tidak merasa tertekan."
"Program Bilingual Arab-Inggris melatih kepercayaan diri siswa tampil di depan umum."
"Kelas Digital dengan tablet sangat relevan untuk persiapan masa depan anak."
"Klinik Riset sangat bagus untuk melatih anak berpikir kritis dan menulis karya ilmiah."
"Anak saya jadi lebih disiplin sholat dhuha dan dzuhur berjamaah."
"Metode pembelajaran di MTs Negeri 1 Pandeglang tidak membosankan, banyak praktik langsung."
"Tugas-tugas yang diberikan guru sangat mendidik dan tidak memberatkan siswa."
)

msg_ekskul=(
"Bangga sekali melihat Drumband Gema Nada yang selalu juara di tingkat provinsi."
"Ekskul Paskibra Satria Pandeglang benar-benar membentuk mental disiplin anak."
"SISPALA mengajarkan kemandirian dan kepedulian lingkungan yang nyata."
"Tim Futsal MTs Negeri 1 Pandeglang FC mainnya taktis dan sportif, fasilitas lapangannya juga oke."
"Anak saya jadi lebih percaya diri setelah gabung di OSIM dan ikut LDKS."
"PMR Madya sangat sigap dalam pertolongan pertama, kegiatannya sangat positif."
"Marawis dan Hadroh sekolah ini suaranya merdu, sering diundang acara masyarakat."
"Ekskul Jurnalistik melatih anak saya jadi kritis dan jago menulis berita."
"Kegiatan Pramuka di sini sangat seru, kemah benerannya mantap."
"Paduan suara sekolah suaranya harmonis, bikin merinding kalau pas upacara."
)

msg_env=(
"Suasana madrasah sangat asri dan hijau, program Adiwiyata benar-benar jalan."
"Kebijakan Zero Plastic di kantin sangat bagus untuk edukasi lingkungan."
"Bank Sampah Berhias mengajarkan siswa memilah sampah jadi berkah."
"Toilet siswa bersih dan airnya lancar, sangat nyaman."
"Masjid sekolah luas dan bersih, kegiatan sholat Dhuha berjalannya tertib."
"Website sekolah super cepat (0.8 detik), cari info PPDB jadi gampang."
"Perpustakaan digitalnya lengkap, anak saya betah baca buku di sana."
"Kantin sehatnya bersih, jajanan aman dan tidak pakai pengawet."
"Taman sekolah terawat dengan baik, banyak spot foto yang instagramable."
"Akses Wi-Fi di area perpustakaan sangat kencang, membantu siswa cari referensi."
"Kebersihan lingkungan sekolah patut diacungi jempol, tidak ada sampah berserakan."
)

ALL_MSGS=("${msg_service[@]}" "${msg_acad[@]}" "${msg_ekskul[@]}" "${msg_env[@]}")

# ROLES & FEEDBACK KHUSUS SURVEI (6 KATEGORI)
roles=(
"Wali Murid" "Wali Murid" "Wali Murid" "Wali Murid" "Wali Murid" "Wali Murid" "Wali Murid"
"Siswa" "Siswa" "Siswa" "Siswa"
"Alumni" "Alumni"
"Tamu / Masyarakat Umum"
"Guru / Staf"
)

# Feedback berdasarkan kategori
fb_zi=(
"Pelayanan PTSP sangat memuaskan, tidak ada pungli sama sekali."
"Transparansi biaya dan prosedur sangat jelas, sesuai standar Zona Integritas."
"Tidak ada pungutan liar, semua sesuai ketentuan resmi."
"Petugas menolak gratifikasi, sangat profesional dan berintegritas."
"Sistem pengaduan responsif, keluhan saya ditanggapi dengan baik."
"Informasi persyaratan ditampilkan secara terbuka dan mudah diakses."
"Petugas tidak diskriminatif, melayani semua dengan adil."
"Whistleblowing system tersedia dan aman untuk pelaporan."
"Tidak ada praktik percaloan, semua urusan langsung dengan petugas resmi."
"Monitoring internal berjalan baik untuk mencegah penyimpangan."
)

fb_service=(
"Petugas melayani dengan ramah dan sopan, 3S benar-benar diterapkan."
"Ruang tunggu nyaman, bersih, dilengkapi AC dan charging station."
"Waktu penyelesaian layanan sangat cepat sesuai standar."
"Petugas sangat kompeten memberikan solusi dan informasi."
"Sistem antrian tertib dan adil untuk semua pemohon."
"Informasi alur pelayanan sangat jelas dan mudah dipahami."
"Fasilitas toilet, mushola, parkir tersedia dan bersih."
"Petugas sangat responsif menangani pertanyaan dan masalah."
"Formulir mudah didapat dan dipahami dengan baik."
"Layanan pengaduan mudah diakses dan ditanggapi dengan cepat."
"Display monitor antrian berfungsi dengan baik."
"Tersedia layanan konsultasi yang sangat membantu."
"Ruang pelayanan memiliki pencahayaan dan AC yang baik."
"Fasilitas untuk disabilitas tersedia dengan lengkap."
"Jam pelayanan sesuai dan petugas hadir tepat waktu."
)

fb_academic=(
"Guru menguasai materi dan menyampaikannya dengan menarik."
"Komunikasi guru dengan wali murid sangat lancar dan terbuka."
"Fasilitas pembelajaran mendukung kebutuhan belajar siswa."
"Informasi perkembangan akademik disampaikan secara berkala."
"Metode pembelajaran bervariasi dan sesuai kebutuhan siswa."
"Guru memberikan perhatian dan bimbingan yang memadai."
"Penilaian hasil belajar objektif, transparan, dan tepat waktu."
"Program ekstrakurikuler beragam dan berkualitas."
"Fasilitas teknologi memadai dan dimanfaatkan dengan baik."
"Lingkungan sekolah kondusif, aman, dan mendukung pembelajaran."
"Sekolah melakukan evaluasi dan perbaikan berkelanjutan."
"Guru menerapkan pendidikan karakter dalam pembelajaran."
"Kurikulum relevan dengan perkembangan zaman."
"Guru menggunakan media pembelajaran yang kreatif."
"Program remedial dan pengayaan sangat membantu siswa."
"Perpustakaan lengkap dan mudah diakses."
"Laboratorium memiliki peralatan yang memadai."
"Tugas proporsional dan bermakna untuk siswa."
"Bimbingan konseling efektif mendukung perkembangan siswa."
"Guru memberikan feedback konstruktif yang membangun."
)

fb_facilities=(
"Kondisi gedung sekolah terawat dengan baik dan aman."
"Kebersihan lingkungan sekolah sangat terjaga."
"Toilet siswa bersih, memadai, dan berfungsi dengan baik."
"Sistem keamanan sekolah baik dengan satpam dan CCTV."
"Kantin bersih, sehat, dan menyediakan makanan bergizi."
"Lapangan olahraga tersedia dan dalam kondisi baik."
"Fasilitas UKS lengkap dan dikelola dengan baik."
"Mushola bersih dan nyaman digunakan."
"Area parkir tertata rapi dan aman."
"Sistem penerangan di seluruh area berfungsi dengan baik."
"Sistem sanitasi dan pengelolaan sampah terorganisir."
"Jalur evakuasi dan sistem penanggulangan bencana jelas."
"Fasilitas air bersih tersedia dan mudah diakses."
"Ventilasi dan sirkulasi udara di kelas sangat baik."
"Area hijau membuat lingkungan sejuk dan asri."
"Fasilitas untuk disabilitas tersedia dengan lengkap."
"Aula tersedia untuk kegiatan besar sekolah."
"Sistem drainase berfungsi baik tanpa genangan."
"Papan informasi tertata rapi dan selalu diperbarui."
"Perawatan fasilitas dilakukan rutin dan responsif."
)

fb_management=(
"Kepala sekolah menunjukkan kepemimpinan yang visioner."
"Visi dan misi sekolah jelas dan diimplementasikan dengan baik."
"Kepala sekolah terbuka menerima masukan dan kritik."
"Sistem administrasi sekolah tertib dan transparan."
"Proses PPDB dilakukan secara objektif dan transparan."
"Informasi kebijakan disampaikan dengan jelas."
"Program kerja tahunan terstruktur dan terlaksana dengan baik."
"Komite sekolah aktif dan melibatkan orang tua."
"Pengelolaan keuangan akuntabel dan dilaporkan berkala."
"Sekolah responsif menangani keluhan orang tua."
"Sistem reward and punishment adil untuk siswa dan guru."
"Kepala sekolah aktif melakukan supervisi pembelajaran."
"SOP jelas untuk berbagai kegiatan sekolah."
"Rapat koordinasi rutin berjalan dengan baik."
"Evaluasi diri dilakukan berkala untuk perbaikan."
"Dokumentasi dan arsip tertata rapi."
"Program pengembangan SDM guru terencana dengan baik."
"Kerjasama dengan stakeholder eksternal berjalan baik."
"Kepala sekolah memberikan teladan dalam disiplin."
"Sekolah inovatif menghadapi tantangan dan perubahan."
)

fb_culture=(
"Hubungan warga sekolah terjalin harmonis dan saling menghargai."
"Lingkungan inklusif dan ramah terhadap keberagaman."
"Tidak ada praktik bullying di lingkungan sekolah."
"Nilai-nilai religius dan moral diterapkan sehari-hari."
"Budaya disiplin diterapkan dengan konsisten."
"Siswa diajarkan menghormati guru dan sesama."
"Budaya prestasi dan kompetisi sehat didorong."
"Program pembinaan karakter terintegrasi dengan baik."
"Tradisi sekolah mempererat kebersamaan warga sekolah."
"Lingkungan mendukung kreativitas dan inovasi siswa."
"Budaya gotong royong dan kepedulian sosial kuat."
"Kampanye gaya hidup sehat dan peduli lingkungan aktif."
"Guru dan staf menjadi role model yang baik."
"Apresiasi diberikan kepada siswa berprestasi."
"Kegiatan spiritual dilaksanakan secara rutin."
"Siswa bertanggung jawab terhadap tugas mereka."
"Komunikasi warga sekolah terbuka dan konstruktif."
"Aturan dan tata tertib jelas, adil, dan ditegakkan."
"Program parenting membangun kolaborasi keluarga-sekolah."
"Siswa merasa aman, nyaman, dan bahagia di sekolah."
)

# USER AGENTS (MODERN 2024-2025 MIX)
user_agents=(
# Android High-End
"Mozilla/5.0 (Linux; Android 14; SM-S928B) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.6099.193 Mobile Safari/537.36"
"Mozilla/5.0 (Linux; Android 13; SM-A546E) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Mobile Safari/537.36"
"Mozilla/5.0 (Linux; Android 14; Pixel 8 Pro) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Mobile Safari/537.36"
# Android Mid-Range (Common in ID)
"Mozilla/5.0 (Linux; Android 12; Redmi Note 12) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.0.0 Mobile Safari/537.36"
"Mozilla/5.0 (Linux; Android 13; CPH2477) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Mobile Safari/537.36"
"Mozilla/5.0 (Linux; Android 11; V2111) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Mobile Safari/537.36"
"Mozilla/5.0 (Linux; Android 10; SM-A125F) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Mobile Safari/537.36"
# iOS / iPhone
"Mozilla/5.0 (iPhone; CPU iPhone OS 17_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.2 Mobile/15E148 Safari/604.1"
"Mozilla/5.0 (iPhone; CPU iPhone OS 16_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.7 Mobile/15E148 Safari/604.1"
"Mozilla/5.0 (iPhone; CPU iPhone OS 15_8 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/120.0.6099.119 Mobile/15E148 Safari/604.1"
# Desktop
"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36"
"Mozilla/5.0 (Windows NT 11.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36 Edg/121.0.0.0"
"Mozilla/5.0 (Macintosh; Intel Mac OS X 14_2_1) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.2 Safari/605.1.15"
"Mozilla/5.0 (X11; Linux x86_64; rv:122.0) Gecko/20100101 Firefox/122.0"
# Bots
"Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)"
"Mozilla/5.0 (compatible; bingbot/2.0; +http://www.bing.com/bingbot.htm)"
"Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)"
)

# ------------------------------------------------------------------------------
# 4. FUNGSI UTILITIES
# ------------------------------------------------------------------------------

get_random() {
    local arr=("${!1}")
    echo "${arr[RANDOM % ${#arr[@]}]}"
}

gen_ip() {
    echo "$((RANDOM % 100 + 36)).$((RANDOM % 256)).$((RANDOM % 256)).$((RANDOM % 256))"
}

gen_date() {
    local start=$TS_START
    local end=$TS_END
    local diff=$((end - start))
    local offset=$(( (RANDOM << 15 | RANDOM) % diff ))
    local final=$((start + offset))
    date -d "@$final" "+%Y-%m-%d %H:%M:%S"
}

gen_rating() {
    local min=$INPUT_MIN_STAR
    local max=5
    local range=$((max - min + 1))
    echo $((min + RANDOM % range))
}

# Fungsi untuk generate score desimal (1.00 - 5.00)
gen_score_decimal() {
    local min=$INPUT_MIN_STAR
    local max=5
    local range=$((max - min + 1))
    local integer=$((min + RANDOM % range))
    
    # Generate decimal 00-99
    local decimal=$((RANDOM % 100))
    
    # Format dengan 2 digit (tambah leading zero jika perlu)
    if [ $decimal -lt 10 ]; then
        echo "${integer}.0${decimal}"
    else
        echo "${integer}.${decimal}"
    fi
}

# ------------------------------------------------------------------------------
# 5. GENERATOR LOGIC
# ------------------------------------------------------------------------------

# === SECTION 1: ULASAN ===
echo ""
echo ">>> MEMULAI GENERATE DATA ULASAN..."
echo "Format: name,rating,message,created_at,ip_address"

BASE_FILENAME="ulasan_part"
HEADER_CSV="name,rating,message,created_at,ip_address"
count=0
file_index=1
current_file="${OUTPUT_DIR}/${BASE_FILENAME}_${file_index}.csv"
declare -A used_names_ulasan

echo "$HEADER_CSV" > "$current_file"

while [ $count -lt $INPUT_TOTAL ]; do
    # Generate Name & Check Unique
    gender=$((RANDOM % 2))
    if [ $gender -eq 0 ]; then
        fname=$(get_random male_first[@])
        lname=$(get_random male_last[@])
    else
        fname=$(get_random female_first[@])
        lname=$(get_random female_last[@])
    fi
    fullname="$fname $lname"
    
    # Retry logic simple jika nama sudah ada, tambahkan nama tengah
    if [[ -n "${used_names_ulasan[$fullname]}" ]]; then 
        if [ $gender -eq 0 ]; then
            mname=$(get_random male_first[@])
        else
            mname=$(get_random female_first[@])
        fi
        fullname="$fname $mname $lname"
    fi
    used_names_ulasan["$fullname"]=1
    
    # Data lain
    rating=$(gen_rating)
    message=$(get_random ALL_MSGS[@])
    created_at=$(gen_date)
    ip_address=$(gen_ip)
    
    echo "$fullname,$rating,\"$message\",$created_at,$ip_address" >> "$current_file"
    ((count++))
    
    # Split
    if (( count % INPUT_BATCH == 0 && count < INPUT_TOTAL )); then
        ((file_index++))
        current_file="${OUTPUT_DIR}/${BASE_FILENAME}_${file_index}.csv"
        echo "$HEADER_CSV" > "$current_file"
    fi
    
    # Progress Bar
    if (( count % 500 == 0 )); then echo -ne "   Progress: $count / $INPUT_TOTAL \r"; fi
done
echo -e "\n   [OK] Selesai."


# === SECTION 2: SURVEI (6 KATEGORI - UPDATED FORMAT) ===
echo ""
echo ">>> MEMULAI GENERATE DATA SURVEI (6 KATEGORI)..."
echo "Format: respondent_name,respondent_role,score_zi,score_service,score_academic,score_facilities,score_management,score_culture,feedback,created_at,ip_address"

BASE_FILENAME="survei_part"
HEADER_CSV="respondent_name,respondent_role,score_zi,score_service,score_academic,score_facilities,score_management,score_culture,feedback,created_at,ip_address"
count=0
file_index=1
current_file="${OUTPUT_DIR}/${BASE_FILENAME}_${file_index}.csv"
declare -A used_names_survei

echo "$HEADER_CSV" > "$current_file"

while [ $count -lt $INPUT_TOTAL ]; do
    # Generate Name (Boleh sama dengan ulasan, tapi unik di tabel survei)
    gender=$((RANDOM % 2))
    if [ $gender -eq 0 ]; then
        fname=$(get_random male_first[@])
        lname=$(get_random male_last[@])
    else
        fname=$(get_random female_first[@])
        lname=$(get_random female_last[@])
    fi
    fullname="$fname $lname"
    
    if [[ -n "${used_names_survei[$fullname]}" ]]; then 
         if [ $gender -eq 0 ]; then mname=$(get_random male_first[@]); else mname=$(get_random female_first[@]); fi
         fullname="$fname $mname $lname"
    fi
    used_names_survei["$fullname"]=1
    
    # Data Survey - 6 Kategori dengan decimal score
    role=$(get_random roles[@])
    s_zi=$(gen_score_decimal)
    s_srv=$(gen_score_decimal)
    s_aca=$(gen_score_decimal)
    s_fac=$(gen_score_decimal)
    s_mgt=$(gen_score_decimal)
    s_cul=$(gen_score_decimal)
    
    # Pilih feedback berdasarkan kategori dengan skor tertinggi
    # Untuk variasi, ambil dari berbagai kategori feedback
    feedback_choice=$((RANDOM % 6))
    case $feedback_choice in
        0) msg=$(get_random fb_zi[@]) ;;
        1) msg=$(get_random fb_service[@]) ;;
        2) msg=$(get_random fb_academic[@]) ;;
        3) msg=$(get_random fb_facilities[@]) ;;
        4) msg=$(get_random fb_management[@]) ;;
        5) msg=$(get_random fb_culture[@]) ;;
    esac
    
    c_at=$(gen_date)
    ip=$(gen_ip)
    
    # Tulis sesuai format yang diminta (6 kategori)
    echo "$fullname,$role,$s_zi,$s_srv,$s_aca,$s_fac,$s_mgt,$s_cul,\"$msg\",$c_at,$ip" >> "$current_file"
    ((count++))
    
    if (( count % INPUT_BATCH == 0 && count < INPUT_TOTAL )); then
        ((file_index++))
        current_file="${OUTPUT_DIR}/${BASE_FILENAME}_${file_index}.csv"
        echo "$HEADER_CSV" > "$current_file"
    fi
    
    if (( count % 500 == 0 )); then echo -ne "   Progress: $count / $INPUT_TOTAL \r"; fi
done
echo -e "\n   [OK] Selesai."


# === SECTION 3: KUNJUNGAN ===
echo ""
echo ">>> MEMULAI GENERATE DATA KUNJUNGAN..."
echo "Format: ip_address,user_agent,created_at"

BASE_FILENAME="kunjungan_part"
HEADER_CSV="ip_address,user_agent,created_at"
count=0
file_index=1
current_file="${OUTPUT_DIR}/${BASE_FILENAME}_${file_index}.csv"

echo "$HEADER_CSV" > "$current_file"

while [ $count -lt $INPUT_TOTAL ]; do
    ip=$(gen_ip)
    ua=$(get_random user_agents[@])
    c_at=$(gen_date)
    
    echo "$ip,\"$ua\",$c_at" >> "$current_file"
    ((count++))
    
    if (( count % INPUT_BATCH == 0 && count < INPUT_TOTAL )); then
        ((file_index++))
        current_file="${OUTPUT_DIR}/${BASE_FILENAME}_${file_index}.csv"
        echo "$HEADER_CSV" > "$current_file"
    fi
    
    if (( count % 500 == 0 )); then echo -ne "   Progress: $count / $INPUT_TOTAL \r"; fi
done
echo -e "\n   [OK] Selesai."


# ------------------------------------------------------------------------------
# 6. SELESAI
# ------------------------------------------------------------------------------
echo ""
echo "=================================================================="
echo "   SEMUA PROSES BERHASIL!"
echo "=================================================================="
echo "Lokasi Folder  : ./$OUTPUT_DIR/"
echo "Total File     : $((file_index * 3)) File CSV"
echo ""
echo "DETAIL FORMAT:"
echo "1. ULASAN      : name, rating, message, created_at, ip_address"
echo "2. SURVEI      : respondent_name, respondent_role,"
echo "                 score_zi, score_service, score_academic,"
echo "                 score_facilities, score_management, score_culture,"
echo "                 feedback, created_at, ip_address"
echo "3. KUNJUNGAN   : ip_address, user_agent, created_at"
echo ""
echo "Silakan cek folder '$OUTPUT_DIR' untuk melihat hasilnya."
echo "=================================================================="