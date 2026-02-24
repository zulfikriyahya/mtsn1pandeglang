#!/bin/bash

# ==============================================================================
# DUMMY ULTIMATE DATA GENERATOR
# Version: 4.2 (Modular Rating & Expanded Data)
# Output: ./dummy/
# Compatibility: MTsN 1 Pandeglang (6 Survey Indicators)
# ==============================================================================

OUTPUT_DIR="dummy"

# Bersihkan layar dan tampilkan header
clear
echo "=================================================================="
echo "   GENERATOR DATA DUMMY (MODULAR EDITION v4.2)"
echo "   Fitur: Pesan/Kalimat menyesuaikan Nilai Rating (1-5)"
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

read -p "4. Tanggal Selesai (YYYY-MM-DD) [Def: 2026-12-31]: " INPUT_END_DATE
INPUT_END_DATE=${INPUT_END_DATE:-"2026-12-31"}

# Input Rating
read -p "5. Minimal Rating Bintang (1-5)? [Def: 4]: " INPUT_MIN_STAR
if [[ -z "$INPUT_MIN_STAR" || "$INPUT_MIN_STAR" -lt 1 || "$INPUT_MIN_STAR" -gt 5 ]]; then 
    INPUT_MIN_STAR=4
fi

# Konversi Tanggal ke Timestamp
TS_START=$(date -d "$INPUT_START_DATE" +%s 2>/dev/null)
TS_END=$(date -d "$INPUT_END_DATE" +%s 2>/dev/null)

if [[ -z "$TS_START" || -z "$TS_END" ]]; then
    echo "Warning: Format tanggal tidak dikenali. Menggunakan default 2024-2026."
    TS_START=1704067200 # 1 Jan 2024
    TS_END=1798761600   # 31 Des 2026
fi

if [ ! -d "$OUTPUT_DIR" ]; then
    mkdir -p "$OUTPUT_DIR"
fi

echo "------------------------------------------------------------------"
echo "SUMMARY KONFIGURASI:"
echo "------------------------------------------------------------------"
echo "Target Folder : ./$OUTPUT_DIR/"
echo "Total Data    : $(printf "%'.f\n" $INPUT_TOTAL) baris per tipe"
echo "Periode       : $INPUT_START_DATE s/d $INPUT_END_DATE"
echo "Rating Range  : $INPUT_MIN_STAR - 5 Bintang"
echo "------------------------------------------------------------------"
read -p "Tekan ENTER untuk memulai proses generation..."

# ------------------------------------------------------------------------------
# 2. DATABASE NAMA (DITAMBAHKAN AGAR LEBIH BANYAK)
# ------------------------------------------------------------------------------

# Data asli tetap ada, ditambahkan data baru di bawahnya
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
# --- TAMBAHAN BARU ---
"Abimanyu" "Adnan" "Affandi" "Agung" "Aji" "Alfons" "Andre" "Andi" "Angga" "Anjas" "Anton" "Arjuna" "Arman" "Arnold" "Aswin" "Atta"
"Bahrul" "Bakri" "Banu" "Bastian" "Bisma" "Bobby" "Bonar" "Boris" "Bryan"
"Cahyo" "Cepi" "Christian" "Cornelius"
"Damar" "Dandi" "Darto" "Davin" "Dendi" "Denny" "Dewa" "Didik" "Dito" "Doddy" "Donny"
"Edi" "Edo" "Edwin" "Efan" "Eky" "Elvan" "Erik" "Erlanda" "Ersya"
"Fahri" "Fandi" "Farid" "Fatih" "Fendi" "Ferdi" "Fian" "Fino" "Frans" "Fredy"
"Gagah" "Geri" "Gito" "Glenn" "Gofar" "Gugun"
"Hafiz" "Hamdani" "Hary" "Hasbi" "Helmi" "Hendri" "Hery" "Husen"
"Idham" "Iksan" "Iman" "Iqbal" "Irham" "Ivan"
"Jalal" "Jamal" "Januar" "Jefri" "Jerry" "Jimmy" "Johan" "Juhri"
"Kadir" "Kaleb" "Karim" "Karta" "Kunto"
"Luki" "Luqman"
"Mahdi" "Mamat" "Maman" "Marwan" "Miko" "Mirza" "Muis" "Mukti" "Munir"
"Nasir" "Nino" "Nofal" "Novri"
"Oman" "Opick"
"Parto" "Pepen" "Permadi" "Pian" "Pujiono"
"Qosim"
"Rahmat" "Raihan" "Randi" "Rasya" "Reno" "Reynaldi" "Rifki" "Rijal" "Rizky" "Rochman" "Roy" "Rusdi" "Ruslan"
"Sabri" "Sadam" "Saiful" "Sakti" "Sam" "Samsudin" "Sandy" "Saepul" "Sidik" "Subhan" "Sugeng" "Suhardi" "Sulaeman" "Sutrisno" "Syahrul"
"Taufan" "Tedy" "Teguh" "Thoriq" "Toni" "Totok" "Trisno"
"Ucup" "Udin" "Unang"
"Valen" "Vian"
"Wandi" "Wardi" "Wibie" "Widi" "Wiji" "Winarso"
"Yadi" "Yahya" "Yance" "Yasin" "Yayan" "Yogi" "Yono" "Yudha" "Yusril"
"Zacky" "Zain" "Zainudin" "Zamzam" "Zikri"
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
# --- TAMBAHAN BARU ---
"Adikusuma" "Admaja" "Afnan" "Alam" "Alfarizi" "Alamsyah" "Amiruddin" "Anggoro" "Apandi" "Ardianto" "Assegaf" "Atmaja" "Azhar"
"Bahtiar" "Barus" "Baskara" "Batubara" "Budiarto" "Bustomi"
"Caniago" "Chaniago"
"Dahlan" "Dalimunthe" "Damara" "Darma" "Darwis" "Dermawan" "Deswanto" "Dewanto" "Djamal" "Djoyo"
"Ependi"
"Fachrezi" "Falah" "Farid" "Fathoni" "Fauzan" "Febrianto" "Firdaus"
"Gani" "Ghozali" "Gultom" "Gunadi" "Gustaman"
"Habibi" "Hafiz" "Halim" "Hamid" "Harahap" "Haris" "Hartanto" "Haryadi" "Hasibuan" "Hendra" "Hermansyah" "Hidayatullah" "Huda"
"Idris" "Ikhsan" "Irawadi" "Isman"
"Jaelani" "Jatmiko" "Johan" "Juanda"
"Kamil" "Karim" "Kertarajasa" "Khaerudin" "Kholil" "Kristanto" "Kuswara"
"Leman" "Lumbanraja" "Lutfi"
"Madani" "Mahfud" "Makarim" "Manaf" "Mansur" "Marbun" "Mardiansyah" "Maryanto" "Misbah" "Muchtar" "Mulyanto" "Munandar" "Murti" "Mustaqim"
"Naim" "Nandana" "Nawawi" "Nazir" "Nugraha" "Nurrahman"
"Octora"
"Pahlevi" "Panjaitan" "Pangaribuan" "Pasaribu" "Perdana" "Pohan" "Prabowo" "Pramana" "Pramono" "Prasetya" "Prawira" "Prihantoro" "Purnawan" "Purwanto"
"Quraish"
"Rahardjo" "Rahmadi" "Rahmatullah" "Ramlan" "Rifai" "Rinaldi" "Rismanto" "Rizal" "Rizky" "Rohendi" "Rosadi" "Rustandi"
"Sabarudin" "Sadikin" "Safrizal" "Sahid" "Salimin" "Samudra" "Sani" "Saragih" "Sasmita" "Sastro" "Setiadi" "Siagian" "Silitonga" "Sinaga" "Sitepu" "Situmorang" "Sobari" "Sofyan" "Sucipto" "Sudarso" "Sugandi" "Sugiyanto" "Suhadi" "Suhendar" "Suherman" "Sukma" "Sulistyo" "Sumantri" "Sunardi" "Supandi" "Suparman" "Suprapto" "Suryadi" "Suseno" "Sutanto" "Syah" "Syarif" "Syarifuddin"
"Tamba" "Tambunan" "Tarigan" "Tobing" "Triadi"
"Umar" "Usman"
"Wahyudi" "Waluyo" "Wardana" "Wibowo" "Widjaja" "Widodo" "Wiguna" "Winata" "Winarno" "Wiryawan"
"Yahya" "Yasin" "Yudha" "Yunarto" "Yusuf"
"Zaenudin" "Zahran" "Zainal" "Zuhdi"
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
# --- TAMBAHAN BARU ---
"Ade" "Adeline" "Afra" "Ainun" "Ajeng" "Alana" "Aletha" "Alfiah" "Alicia" "Alin" "Almira" "Alya" "Amara" "Aminah" "Anastasya" "Angel" "Anindya" "Anis" "Anisa" "Anna" "Arumi" "Aryani" "Asih" "Asma" "Asri" "Astin" "Astri" "Atik" "Audrey" "Avril" "Ayudia" "Azka"
"Badriyah" "Baiq" "Bunga"
"Calista" "Carla" "Celine" "Chelsea" "Chintya" "Christy" "Cika" "Clara" "Cut"
"Danita" "Darla" "Dea" "Dedeh" "Delia" "Della" "Denisa" "Desy" "Dhara" "Dini" "Diyah" "Dwi"
"Eca" "Eli" "Elly" "Ely" "Ema" "Emilia" "Endang" "Erika" "Eriska"
"Fabiola" "Fadila" "Fahira" "Fairuz" "Faradina" "Fathia" "Fatma" "Fatmawati" "Feby" "Feni" "Fina" "Fira" "Frida"
"Gadis" "Gita" "Gwen"
"Hafsah" "Halwa" "Hana" "Hanifa" "Hasna" "Helma" "Hera" "Hikmah"
"Ida" "Ifa" "Iis" "Ika" "Ilma" "Imel" "Indi" "Ines" "Inggit" "Intan" "Ipeh" "Isma" "Ita"
"Jihan" "Jinan" "Juwita"
"Kania" "Karin" "Karolin" "Khadijah" "Khalisa" "Khansa" "Kinar" "Klara" "Komalasari"
"Lala" "Lastri" "Latifah" "Lela" "Leni" "Lia" "Liana" "Lily" "Lina" "Lisa" "Lola" "Lusi" "Lydia"
"Maesaroh" "Magda" "Maida" "Maimunah" "Manda" "Maria" "Marina" "Marissa" "Marlin" "Martha" "Maryam" "Mei" "Meilda" "Melani" "Mey" "Mila" "Mimi" "Mira" "Mirna" "Monica" "Murni" "Mutiara"
"Nabila" "Nada" "Nadya" "Nafisa" "Nahla" "Nana" "Nani" "Nara" "Narti" "Nasya" "Nelly" "Neni" "Nesia" "Niken" "Nike" "Nila" "Nilam" "Nimas" "Ningrum" "Ningsih" "Nining" "Nisa" "Nona" "Nova" "Nurbaeti" "Nurlelasari"
"Okta"
"Peni" "Pita" "Popy" "Priscila" "Puji"
"Qonita" "Queen"
"Rachel" "Rahmi" "Ratih" "Ratna" "Ratu" "Rina" "Rinda" "Rini" "Ririn" "Riska" "Risti" "Rita" "Rizka" "Rohmah" "Rona" "Rosa" "Rosita" "Rumi" "Ruth"
"Sabila" "Sadia" "Safina" "Sakina" "Salwa" "Sana" "Sania" "Sany" "Sartika" "Saskia" "Selly" "Septi" "Shabrina" "Shafa" "Shinta" "Shofi" "Sila" "Silvia" "Sindy" "Sofi" "Sofia" "Sonia" "Sonya" "Soraya" "Sri" "Stefani" "Sukaesih" "Sumarni" "Sumi" "Susi" "Syahla"
"Talitha" "Tamara" "Tami" "Tantri" "Tari" "Tasia" "Taty" "Tika" "Tini" "Titin" "Tri" "Trisna" "Tuti" "Tyas"
"Ulfah" "Uli" "Umi" "Una" "Uni" "Uti"
"Valen" "Vania" "Vani" "Vanya" "Velin" "Veny" "Vera" "Vika" "Vina" "Viola" "Vita"
"Warda" "Wina" "Windi" "Wuri"
"Yana" "Yani" "Yara" "Yasmin" "Yati" "Yeyen" "Yulia" "Yuyun"
"Zafira" "Zahra" "Zainab" "Zaskia" "Zea" "Zeline" "Zoya" "Zulfa"
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
# --- TAMBAHAN BARU ---
"Adelina" "Afriani" "Agustine" "Aisyah" "Alfiani" "Aliya" "Amira" "Anastasia" "Anggraeni" "Anisa" "Antania" "Ardiana" "Arifiani" "Arum" "Aryanti" "Asmara" "Asri" "Aulia" "Ayuningtyas" "Azwar"
"Cahaya" "Chandra" "Christiana"
"Damanik" "Damayanti" "Daniati" "Darmawati" "Dewanti" "Dhewanti"
"Ekawati" "Elviana" "Erlin" "Ermawati"
"Fadhila" "Fahira" "Fairuz" "Fajri" "Fauziah" "Febriana" "Ferawati" "Fitria"
"Ginting" "Gunawan"
"Habsari" "Hadi" "Halimah" "Hamidah" "Handayani" "Hanifah" "Hartini" "Haryani" "Hastuti" "Hayati" "Hidayati" "Humaira"
"Ika" "Ilhami" "Imaniar" "Indah" "Indrawati" "Inayah" "Irawati" "Iskandar" "Ismi" "Istiqomah"
"Jayanti" "Juwita"
"Kamilia" "Kania" "Karina" "Karmila" "Khasanah" "Kholifah" "Kirana" "Kristiani" "Kurniasari" "Kusumawardani"
"Laila" "Laras" "Lestari" "Lestia" "Lubis"
"Maheswari" "Maimun" "Malahayati" "Manalu" "Manurung" "Marliana" "Marsela" "Maryati" "Mawar" "Mawarni" "Mayangsari" "Meliana" "Melinda" "Mulia" "Mulyasari" "Munawaroh" "Mustika"
"Nabila" "Nadapdap" "Nadia" "Nafisah" "Nainggolan" "Natalia" "Ningsih" "Nirmala" "Nisrina" "Noviana" "Novita" "Nur" "Nuraeni" "Nurazizah" "Nurhaliza" "Nurjannah" "Nurmalasari"
"Oktavia"
"Pandjaitan" "Panggabean" "Paramita" "Pertiwi" "Pitaloka" "Pradita" "Pramesti" "Prasetia" "Prastika" "Pratama" "Prawiro" "Pujiastuti" "Purnamasari" "Purwanti" "Puspa" "Puspitasari" "Puteri"
"Qoriah"
"Rahmi" "Ramadhani" "Rania" "Raras" "Ratih" "Ratnawati" "Restu" "Rianti" "Ristiani" "Rizki" "Rohmawati" "Rosida" "Rosita" "Rozalina" "Rukmana"
"Sabrina" "Safira" "Sagita" "Sahara" "Sakinah" "Salim" "Salsabilla" "Sanjaya" "Santoso" "Saputri" "Saras" "Sari" "Sasmita" "Septia" "Setiani" "Setyawati" "Shaleha" "Shalihah" "Shinta" "Siburian" "Simbolon" "Siregar" "Siroj" "Siska" "Situmorang" "Soedjono" "Sofiani" "Soleha" "Suci" "Sugiarti" "Suharti" "Sukmawati" "Sulastri" "Sumarni" "Sundari" "Suprihatin" "Surbakti" "Surya" "Susana" "Susilowati" "Syafitri" "Syahputri"
"Tambunan" "Tania" "Tarigan" "Tiana" "Tiara" "Trianingsih" "Tristiani"
"Utami"
"Vivi"
"Wahyuni" "Wardah" "Wati" "Widiani" "Widiastuti" "Widya" "Wijaya" "Wulandari"
"Yanti" "Yuliani" "Yuniarti" "Yunita" "Yusri"
"Zahro" "Zain" "Zulaikha" "Zulfikar"
)

# ------------------------------------------------------------------------------
# 3. DATABASE PESAN (MODULAR PER BINTANG)
# ------------------------------------------------------------------------------

# PESAN BINTANG 5 (Sangat Puas, Sempurna, Memuji)
star_5_msgs=(
"Pelayanan PTSP sangat cepat, legalisir ijazah selesai dalam 15 menit tanpa biaya."
"Gedung PTSP nyaman dan petugasnya ramah, benar-benar Zona Integritas."
"Transparansi biaya PPDB sangat jelas, tidak ada pungli di madrasah ini."
"Luar biasa, anak saya sangat senang sekolah di sini karena gurunya perhatian."
"Fasilitas lengkap, dari lab komputer sampai masjidnya sangat bersih dan wangi."
"Satpam sangat ramah dan membantu mengarahkan parkir dengan baik."
"Sistem digital madrasah sangat maju, pantau nilai anak jadi mudah."
"Kantin sehat dan higienis, sangat tenang melepaskan anak jajan di sekolah."
"Program tahfidz-nya juara, hafalan anak saya meningkat pesat."
"Toilet siswa bersih sekali, air lancar. Jempolan untuk kebersihannya."
"Respon admin WhatsApp sangat cepat dan solutif. Pertahankan!"
"Lingkungan sekolah sangat asri dan hijau, bikin betah belajar."
"Tidak ada diskriminasi, semua dilayani dengan senyum dan sapa."
"Proses administrasi tidak berbelit-belit, sangat efisien."
"Sangat merekomendasikan MTsN 1 Pandeglang untuk pendidikan karakter anak."
)

# PESAN BINTANG 4 (Puas, Bagus, Ada Sedikit Saran)
star_4_msgs=(
"Pelayanan sudah sangat baik, hanya perlu ditingkatkan kecepatan WiFi di ruang tunggu."
"Sekolah yang bagus, anak saya betah. Parkiran tamu mungkin bisa diperluas lagi."
"Secara umum memuaskan, petugas ramah, tapi antrian pagi agak panjang."
"Fasilitas oke, AC di ruang pelayanan dingin. Cuma proses fotokopi agak jauh."
"Program akademik mantap, tapi komunikasi wali kelas mohon lebih intens."
"Lingkungan bersih, tapi tong sampah di area belakang perlu ditambah."
"Sudah bagus, Zona Integritas terasa. Tinggal pertahankan konsistensinya."
"Website informatif, tapi kadang agak lambat diakses saat jam sibuk."
"Guru-guru kompeten. Saran: perbanyak kegiatan outing class."
"Prosedur jelas dan transparan. Waktu tunggu standar, tidak terlalu lama."
"Kantin bersih, variasi menu makanannya bisa ditambah lagi."
"Keamanan bagus. Cuma akses masuk saat jam pulang agak macet."
"Perpustakaan lengkap, anak saya suka. Jam bukanya kalau bisa diperpanjang."
"Pelayanan PTSP ramah, ruang tunggunya nyaman. Good job."
"Bagus sekali, tapi sosialisasi program sekolah ke orang tua perlu lebih sering."
)

# PESAN BINTANG 3 (Netral, Standar, Biasa Saja)
star_3_msgs=(
"Pelayanan standar, sesuai prosedur saja. Tidak ada yang istimewa."
"Cukup baik, tapi proses legalisir hari ini lumayan lama."
"Fasilitas sekolah lumayan, ada beberapa yang perlu perbaikan ringan."
"Program sekolah biasa saja seperti madrasah pada umumnya."
"Kadang respon cepat, kadang lambat. Perlu konsistensi pelayanan."
"Kebersihan oke, tapi kadang masih lihat sampah plastik di selokan."
"Guru mengajar cukup baik, tugas ke siswa rasanya cukup banyak."
"Parkiran sempit jadi susah keluar masuk kalau lagi ramai."
"Website sekolah sering maintenance pas mau cek info."
"Pelayanan buka jam 8, tapi petugas baru siap jam 8.15."
"Kantin cukup bersih, harganya standar."
"Sistem informasi nilai cukup membantu, walau tampilannya kaku."
"Ruang tunggu tamu biasa saja, kipas anginnya kurang terasa."
"Satpam cukup tegas, tapi kurang senyum hari ini."
"Proses administrasi lancar, cuma form-nya terlalu banyak yang harus diisi."
)

# PESAN BINTANG 2 (Kecewa, Kurang, Ada Keluhan)
star_2_msgs=(
"Pelayanan agak mengecewakan, saya menunggu 1 jam hanya untuk stempel."
"Toilet siswa baunya kurang sedap, mohon petugas kebersihan lebih rajin."
"Website PPDB error terus saat diakses, sangat menyulitkan."
"Petugas di loket kurang ramah dan main HP saat melayani."
"Lingkungan sekolah banyak genangan air kalau hujan."
"Komunikasi guru ke orang tua sangat minim."
"Fasilitas lab komputer banyak yang rusak mouse-nya."
"Katanya Zona Integritas, tapi infonya masih membingungkan."
"Jadwal pelajaran sering berubah mendadak tanpa pemberitahuan."
"Kantin jorok, banyak lalat. Mohon diperhatikan."
"Ruang kelas panas, kipas angin mati."
"Sistem pengaduan tidak ada respon sudah 3 hari."
"Buku paket di perpustakaan stoknya sedikit."
"Satpam kurang kooperatif saat ditanya lokasi."
"Wi-Fi sekolah tidak bisa dipakai siswa."
)

# PESAN BINTANG 1 (Sangat Buruk, Marah, Kritik Pedas)
star_1_msgs=(
"Sangat kecewa! Pelayanan sangat lambat dan tidak profesional."
"Toilet kotor sekali, air mati total. Sangat tidak layak."
"Petugas membentak wali murid saat bertanya. Tidak sopan!"
"Masih ada pungutan yang tidak jelas peruntukannya."
"Sistem sekolah berantakan, data anak saya hilang."
"Fasilitas buruk, plafon kelas mau rubuh."
"Tidak ada transparansi sama sekali."
"Guru sering kosong tidak masuk kelas."
"Website mati total berhari-hari."
"Lingkungan sekolah kumuh dan tidak terawat."
"Pengaduan saya dicuekin total."
"Parkiran tidak aman, helm hilang."
"Sangat tidak merekomendasikan sekolah ini."
"Diskriminasi pelayanan sangat terasa."
"Kebersihan nol besar, sampah berserakan."
)

# Array Survey Feedback (Modular berdasarkan sentiment/skor)
# Kita akan menggunakan array ini untuk feedbcak survei agar sesuai skor
fb_positive=(
"Pelayanan sangat memuaskan, pertahankan!"
"Sangat transparan dan akuntabel."
"Fasilitas lengkap dan mendukung pembelajaran."
"Manajemen sekolah sangat profesional."
"Lingkungan sekolah sangat kondusif dan nyaman."
"Guru-guru sangat kompeten dan inspiratif."
"Program unggulan sekolah sangat bermanfaat."
"Tidak ada pungli, semua gratis dan cepat."
"Respon pengaduan sangat cepat ditangani."
"Budaya sekolah sangat positif dan religius."
)

fb_neutral=(
"Pelayanan cukup baik, namun perlu ditingkatkan lagi."
"Fasilitas sudah memadai meski ada beberapa yang rusak."
"Proses administrasi standar, tidak cepat tidak lambat."
"Perlu perbaikan di sektor kebersihan toilet."
"Komunikasi sekolah dengan orang tua cukup lancar."
"Program sekolah berjalan baik, perlu inovasi lagi."
"Sistem antrian perlu diperbaiki agar lebih tertib."
"Parkiran perlu diperluas untuk kenyamanan."
"Kadang petugas kurang ramah, mohon dibina."
"Website perlu update berita terbaru."
)

fb_negative=(
"Pelayanan lambat dan berbelit-belit."
"Fasilitas banyak yang rusak dan tidak terawat."
"Kurang transparan dalam biaya."
"Lingkungan kurang bersih dan tidak nyaman."
"Respon terhadap keluhan sangat lambat."
"Sistem birokrasi sekolah menyulitkan."
"Guru sering tidak ada di tempat saat dicari."
"Toilet kotor dan bau, air sering mati."
"Website sering down dan tidak bisa diakses."
"Keamanan kurang, helm sering hilang."
)

# ROLES & USER AGENTS TETAP SAMA
roles=(
"Wali Murid" "Wali Murid" "Wali Murid" "Wali Murid" "Wali Murid" "Wali Murid" "Wali Murid"
"Siswa" "Siswa" "Siswa" "Siswa"
"Alumni" "Alumni"
"Tamu / Masyarakat Umum"
"Guru / Staf"
)

user_agents=(
"Mozilla/5.0 (Linux; Android 14; SM-S928B) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.6099.193 Mobile Safari/537.36"
"Mozilla/5.0 (Linux; Android 13; SM-A546E) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Mobile Safari/537.36"
"Mozilla/5.0 (Linux; Android 14; Pixel 8 Pro) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Mobile Safari/537.36"
"Mozilla/5.0 (Linux; Android 12; Redmi Note 12) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.0.0 Mobile Safari/537.36"
"Mozilla/5.0 (Linux; Android 13; CPH2477) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Mobile Safari/537.36"
"Mozilla/5.0 (Linux; Android 11; V2111) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Mobile Safari/537.36"
"Mozilla/5.0 (Linux; Android 10; SM-A125F) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Mobile Safari/537.36"
"Mozilla/5.0 (iPhone; CPU iPhone OS 17_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.2 Mobile/15E148 Safari/604.1"
"Mozilla/5.0 (iPhone; CPU iPhone OS 16_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.7 Mobile/15E148 Safari/604.1"
"Mozilla/5.0 (iPhone; CPU iPhone OS 15_8 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/120.0.6099.119 Mobile/15E148 Safari/604.1"
"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36"
"Mozilla/5.0 (Windows NT 11.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36 Edg/121.0.0.0"
"Mozilla/5.0 (Macintosh; Intel Mac OS X 14_2_1) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.2 Safari/605.1.15"
"Mozilla/5.0 (X11; Linux x86_64; rv:122.0) Gecko/20100101 Firefox/122.0"
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

# Fungsi Helper baru untuk generate score yang match dengan rating
gen_score_from_rating() {
    local rating=$1
    local decimal=$((RANDOM % 100))
    # Jika rating 5, limit desimal agar tidak lewat 5.0
    if [ "$rating" -eq 5 ]; then
        echo "5.00"
    else
        if [ $decimal -lt 10 ]; then
            echo "${rating}.0${decimal}"
        else
            echo "${rating}.${decimal}"
        fi
    fi
}

# ------------------------------------------------------------------------------
# 5. GENERATOR LOGIC (UPDATED WITH MODULAR LOGIC)
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
    
    if [[ -n "${used_names_ulasan[$fullname]}" ]]; then 
        if [ $gender -eq 0 ]; then
            mname=$(get_random male_first[@])
        else
            mname=$(get_random female_first[@])
        fi
        fullname="$fname $mname $lname"
    fi
    used_names_ulasan["$fullname"]=1
    
    # MODULAR LOGIC: Message follows Rating
    rating=$(gen_rating)
    case $rating in
        5) message=$(get_random star_5_msgs[@]) ;;
        4) message=$(get_random star_4_msgs[@]) ;;
        3) message=$(get_random star_3_msgs[@]) ;;
        2) message=$(get_random star_2_msgs[@]) ;;
        1) message=$(get_random star_1_msgs[@]) ;;
        *) message=$(get_random star_4_msgs[@]) ;; # Default fallback
    esac
    
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


# === SECTION 2: SURVEI (MODULAR FEEDBACK) ===
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
    # Generate Name
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
    
    # MODULAR LOGIC FOR SURVEY
    # Kita tentukan dulu "Rating Dasar" baris ini agar skor dan feedback sinkron
    base_rating=$(gen_rating)

    role=$(get_random roles[@])
    
    # Generate skor 6 kategori berdasarkan base_rating agar konsisten
    # Contoh: Jika base 5, semua skor berkisar 5.0 - 5.xx (max 5)
    # Jika base 2, semua skor 2.xx
    s_zi=$(gen_score_from_rating $base_rating)
    s_srv=$(gen_score_from_rating $base_rating)
    s_aca=$(gen_score_from_rating $base_rating)
    s_fac=$(gen_score_from_rating $base_rating)
    s_mgt=$(gen_score_from_rating $base_rating)
    s_cul=$(gen_score_from_rating $base_rating)
    
    # Pilih feedback text yang sesuai dengan base_rating (Sentiment Analysis simulation)
    if [ "$base_rating" -ge 5 ]; then
        msg=$(get_random fb_positive[@])
    elif [ "$base_rating" -eq 4 ]; then
        # Acak antara positif dan sedikit netral
        if [ $((RANDOM%2)) -eq 0 ]; then msg=$(get_random fb_positive[@]); else msg=$(get_random fb_neutral[@]); fi
    elif [ "$base_rating" -eq 3 ]; then
        msg=$(get_random fb_neutral[@])
    else
        # 1 dan 2 masuk negatif
        msg=$(get_random fb_negative[@])
    fi
    
    c_at=$(gen_date)
    ip=$(gen_ip)
    
    # Tulis
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
echo "1. ULASAN      : name, rating, message (Sesuai Rating), created_at..."
echo "2. SURVEI      : Score & Feedback (Sesuai Sentiment)..."
echo "3. KUNJUNGAN   : ip_address, user_agent, created_at"
echo "=================================================================="