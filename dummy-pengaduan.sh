#!/bin/bash

# ==============================================================================
# GENERATOR DATA DUMMY PENGADUAN MASYARAKAT
# Version: 1.0 (Modular & Intelligent Response)
# Output: ./dummy/
# Compatibility: MTsN 1 Pandeglang - Sistem Pengaduan
# ==============================================================================

OUTPUT_DIR="dummy"

# Bersihkan layar dan tampilkan header
clear
echo "=================================================================="
echo "   GENERATOR DATA PENGADUAN MASYARAKAT v1.0"
echo "   Fitur: Tanggapan menyesuaikan Kategori & Status"
echo "=================================================================="

# ------------------------------------------------------------------------------
# 1. KONFIGURASI INTERAKTIF
# ------------------------------------------------------------------------------

read -p "1. Total data pengaduan? (Default: 1000): " INPUT_TOTAL
INPUT_TOTAL=${INPUT_TOTAL:-1000}

read -p "2. Maksimal baris per file CSV? (Default: 500): " INPUT_BATCH
INPUT_BATCH=${INPUT_BATCH:-500}

read -p "3. Tanggal Mulai (YYYY-MM-DD) [Def: 2024-01-01]: " INPUT_START_DATE
INPUT_START_DATE=${INPUT_START_DATE:-"2024-01-01"}

read -p "4. Tanggal Selesai (YYYY-MM-DD) [Def: 2024-12-31]: " INPUT_END_DATE
INPUT_END_DATE=${INPUT_END_DATE:-"2024-12-31"}

# Konversi Tanggal ke Timestamp
TS_START=$(date -d "$INPUT_START_DATE" +%s 2>/dev/null)
TS_END=$(date -d "$INPUT_END_DATE" +%s 2>/dev/null)

if [[ -z "$TS_START" || -z "$TS_END" ]]; then
    echo "Warning: Format tanggal tidak dikenali. Menggunakan default 2024."
    TS_START=1704067200 # 1 Jan 2024
    TS_END=1735689599   # 31 Des 2024
fi

if [ ! -d "$OUTPUT_DIR" ]; then
    mkdir -p "$OUTPUT_DIR"
fi

echo "------------------------------------------------------------------"
echo "SUMMARY KONFIGURASI:"
echo "------------------------------------------------------------------"
echo "Target Folder : ./$OUTPUT_DIR/"
echo "Total Data    : $(printf "%'.f\n" $INPUT_TOTAL) pengaduan"
echo "Periode       : $INPUT_START_DATE s/d $INPUT_END_DATE"
echo "------------------------------------------------------------------"
read -p "Tekan ENTER untuk memulai proses generation..."

# ------------------------------------------------------------------------------
# 2. DATABASE NAMA (SANGAT LENGKAP)
# ------------------------------------------------------------------------------

male_first=(
"Ahmad" "Agus" "Andi" "Arief" "Asep" "Budi" "Bambang" "Dedi" "Eko" "Hadi" 
"Irfan" "Joko" "Krisna" "Lukman" "Muhammad" "Nabil" "Ridwan" "Rizki" "Taufik" "Yusuf"
"Abdul" "Ade" "Adrian" "Affandi" "Aditya" "Akbar" "Alif" "Amin" "Anwar" "Ardi"
"Bagas" "Bahri" "Bara" "Bayu" "Burhan" "Cahya" "Candra" "Dani" "Dimas" "Fajar"
"Fahmi" "Faisal" "Farhan" "Fauzan" "Galih" "Gilang" "Gunawan" "Hafiz" "Haikal" "Hamdan"
"Haris" "Hendra" "Hidayat" "Hilman" "Husein" "Ikhsan" "Ilham" "Imam" "Indra" "Irwan"
"Jamal" "Johan" "Junaidi" "Kamal" "Kholid" "Kurnia" "Latif" "Mahdi" "Malik" "Maulana"
"Muhamad" "Mufid" "Nanda" "Nasir" "Naufal" "Nugraha" "Omar" "Pandu" "Prasetyo" "Putra"
"Rafi" "Rahman" "Raka" "Rama" "Rangga" "Rayhan" "Reza" "Rian" "Riko" "Ryan"
"Sahrul" "Salman" "Sandi" "Satria" "Septian" "Sigit" "Surya" "Teguh" "Tri" "Wahyu"
"Wira" "Wisnu" "Yoga" "Yuda" "Yudi" "Zaki" "Zidan" "Zulfikar" "Tubagus" "Ujang"
)

male_last=(
"Abdullah" "Aditama" "Adriansyah" "Akbar" "Alamsyah" "Anwar" "Ardiansyah" "Arifin" "Azhar"
"Budiman" "Cahyadi" "Darmawan" "Dewantara" "Fauzi" "Firmansyah" "Gunawan" "Hadi" "Handoko"
"Hartono" "Hasan" "Hermawan" "Hidayat" "Ibrahim" "Irawan" "Iskandar" "Jaya" "Kurniawan"
"Mahendra" "Maulana" "Mulyadi" "Nasution" "Nugraha" "Pamungkas" "Permana" "Pradana" "Pratama"
"Purnomo" "Putra" "Rahman" "Ramadhan" "Riyadi" "Saputra" "Setiawan" "Sudrajat" "Sulaiman"
"Susanto" "Syahputra" "Utama" "Wardana" "Wibowo" "Wijaya" "Yusuf" "Zakaria" "Zulkarnain"
)

female_first=(
"Siti" "Nur" "Ani" "Dewi" "Rina" "Sri" "Wati" "Yuni" "Diah" "Indah"
"Fitri" "Lina" "Maya" "Ratna" "Ayu" "Eka" "Lia" "Nita" "Dina" "Tari"
"Adinda" "Afifah" "Aisyah" "Amalia" "Anisa" "Aulia" "Azizah" "Bella" "Cantika" "Citra"
"Devi" "Dinda" "Dwi" "Elma" "Farah" "Fatin" "Gita" "Hana" "Intan" "Isyana"
"Jelita" "Kartika" "Laila" "Mawar" "Melati" "Nabila" "Nadia" "Olivia" "Putri" "Rahma"
"Rini" "Risa" "Sabrina" "Safira" "Salma" "Sarah" "Sekar" "Silvi" "Tania" "Tiara"
"Vina" "Winda" "Wulan" "Yasmin" "Zahra" "Zaskia" "Ratu" "Neng" "Euis" "Lilis"
)

female_last=(
"Agustina" "Amalia" "Anjani" "Aprilia" "Astuti" "Aulia" "Damayanti" "Dewi" "Fadhilah"
"Fitriani" "Handayani" "Herawati" "Hidayah" "Kartini" "Kurniawati" "Lestari" "Maharani"
"Maulida" "Nurjanah" "Pratiwi" "Puspita" "Putri" "Rahayu" "Rahmawati" "Sari" "Septiani"
"Suci" "Susanti" "Utami" "Wahyuni" "Wati" "Wulandari" "Yulianti" "Zahra"
)

# ------------------------------------------------------------------------------
# 3. DATABASE KATEGORI & KONTEN
# ------------------------------------------------------------------------------

kategori_opts=("Pelayanan" "Fasilitas" "Akademik" "Keuangan" "SDM" "Lainnya")

# === JUDUL PENGADUAN PER KATEGORI ===

judul_pelayanan=(
"Pelayanan PPDB Kurang Informatif"
"Petugas TU Kurang Ramah"
"Proses Legalisir Ijazah Lama"
"Antrian Pelayanan Terlalu Panjang"
"Pelayanan Surat Keterangan Lambat"
"Petugas Administrasi Main HP Saat Melayani"
"Sistem Pendaftaran Online Error"
"Informasi Syarat Pendaftaran Tidak Jelas"
"Pelayanan Tidak Sesuai Jadwal"
"Ruang Tunggu Tidak Nyaman"
"Petugas Tidak Ada di Tempat"
"Pelayanan Diskriminatif"
"Prosedur Terlalu Berbelit"
"Waktu Pelayanan Terlalu Singkat"
"Respon WhatsApp Admin Lambat"
)

judul_fasilitas=(
"AC Kelas Tidak Dingin"
"Toilet Rusak dan Kotor"
"Lampu Kelas Mati"
"Kursi Kelas Banyak yang Rusak"
"LCD Proyektor Tidak Berfungsi"
"Perpustakaan Buku Kurang Lengkap"
"Lab Komputer Mouse Rusak"
"Kantin Kurang Bersih"
"Musala Air Wudhu Mampet"
"Lapangan Basket Berlubang"
"Genting Kelas Bocor Saat Hujan"
"Pintu Toilet Rusak"
"Jendela Kelas Tidak Bisa Ditutup"
"Kipas Angin Kelas Tidak Berputar"
"Parkiran Motor Sempit"
)

judul_akademik=(
"Guru Sering Tidak Masuk Kelas"
"Jadwal Pelajaran Sering Berubah"
"Materi Pelajaran Terlalu Sulit"
"Tugas Terlalu Banyak"
"Guru Kurang Menjelaskan Materi"
"Nilai Rapor Tidak Sesuai"
"Sistem Penilaian Tidak Transparan"
"Buku Paket Belum Tersedia"
"Jam Pelajaran Terlalu Padat"
"Guru BK Jarang Ada"
"Ekstrakurikuler Kurang Variasi"
"Try Out UN Tidak Rutin"
"Pengumuman Kegiatan Mendadak"
"Guru Pilih Kasih"
"Soal Ujian Terlalu Susah"
)

judul_keuangan=(
"Tagihan SPP Ganda"
"Sistem Pembayaran Online Error"
"Biaya Tidak Transparan"
"Bukti Pembayaran Tidak Diberikan"
"Uang Kas Kelas Tidak Jelas"
"Iuran Komite Terlalu Mahal"
"Ada Pungutan Liar"
"Pembayaran Via Transfer Sulit"
"Laporan Keuangan Tidak Terbuka"
"Pengembalian Uang Terlambat"
"Tagihan Tidak Jelas Rinciannya"
"Nomor Rekening Pembayaran Berubah-ubah"
"Biaya Seragam Terlalu Mahal"
"Uang Kegiatan Tidak Ada Laporan"
"Denda Keterlambatan Terlalu Tinggi"
)

judul_sdm=(
"Guru Galak dan Suka Marah"
"Petugas Kebersihan Jarang Bersih-bersih"
"Satpam Kurang Ramah"
"Guru Datang Terlambat"
"Petugas Kantin Kurang Sopan"
"Guru Tidak Menguasai Materi"
"Wali Kelas Jarang Komunikasi"
"Kepala Sekolah Jarang Terlihat"
"Guru Piket Tidak Ada"
"Petugas TU Lama Tanggap"
"Guru Olahraga Jarang Hadir"
"Teknisi IT Lambat Respon"
"Guru Kurang Disiplin"
"Petugas Perpustakaan Galak"
"Cleaning Service Kurang Rajin"
)

judul_lainnya=(
"Keamanan Sekolah Kurang"
"Bullying Tidak Ditangani"
"Lingkungan Sekolah Tidak Asri"
"Banyak Sampah Berserakan"
"Kantin Tidak Sehat"
"Helm Hilang di Parkiran"
"Website Sekolah Sering Down"
"Wifi Sekolah Tidak Bisa Dipakai"
"CCTV Tidak Berfungsi"
"Pagar Sekolah Rusak"
"Warung di Luar Sekolah Ganggu"
"Jalanan Sekolah Berlubang"
"Akses Masuk Macet Saat Pulang"
"Ventilasi Kelas Kurang"
"Sound System Rusak Saat Upacara"
)

# === ISI PENGADUAN PER KATEGORI ===

isi_pelayanan=(
"Saya datang ke sekolah untuk mengurus PPDB anak saya, namun informasi yang diberikan sangat minim. Petugasnya kurang informatif dan terkesan tidak sabar dalam menjelaskan. Mohon petugas diberi pelatihan pelayanan prima."
"Petugas TU terlihat tidak ramah saat melayani. Ketika saya bertanya tentang syarat administrasi, jawabannya singkat dan ketus. Mohon ditingkatkan keramahan dalam melayani masyarakat."
"Saya sudah menunggu 2 jam hanya untuk proses legalisir ijazah. Prosesnya sangat lambat dan tidak ada sistem antrian yang jelas. Harap diperbaiki agar lebih efisien."
"Antrian pelayanan sangat panjang terutama di pagi hari. Petugas hanya 1-2 orang sehingga banyak yang menunggu lama. Tolong ditambah petugas atau sistem antrian online."
"Mengurus surat keterangan siswa sudah 1 minggu belum jadi. Padahal waktu pengerjaan katanya 3 hari kerja. Mohon dipercepat prosesnya karena sangat mendesak."
"Saat saya datang untuk bertanya, petugas malah asyik main HP dan kurang responsif. Ini sangat tidak profesional. Harap petugas lebih fokus saat jam kerja."
"Website pendaftaran online terus error saat diakses. Sudah dicoba berkali-kali tetap tidak bisa masuk. Mohon sistem IT diperbaiki segera."
"Informasi syarat pendaftaran di brosur dan website berbeda. Saya jadi bingung mana yang benar. Tolong disamakan informasinya agar tidak membingungkan."
"Pelayanan katanya buka jam 8 pagi, tapi petugas baru siap melayani jam 8.30. Mohon lebih disiplin sesuai jadwal yang sudah ditentukan."
"Ruang tunggu pengaduan sangat panas, tidak ada AC atau kipas angin. Kursinya juga kurang. Mohon ditambahkan fasilitas agar lebih nyaman."
)

isi_fasilitas=(
"AC di kelas 8A sudah lama tidak dingin. Siswa kepanasan terutama siang hari sehingga tidak fokus belajar. Mohon segera diperbaiki atau diganti."
"Toilet siswa kondisinya sangat kotor dan bau. Air sering mati, pintu rusak tidak bisa ditutup. Mohon kebersihan toilet lebih diperhatikan."
"Beberapa lampu di kelas 7B sudah mati sejak seminggu lalu. Kelas jadi gelap terutama pagi hari. Tolong segera diganti lampunya."
"Banyak kursi di kelas yang sudah rusak dan goyang. Siswa tidak nyaman duduk. Mohon segera diperbaiki atau diganti dengan yang baru."
"LCD proyektor di kelas tidak berfungsi sehingga guru tidak bisa menampilkan materi. Ini mengganggu proses pembelajaran. Harap segera diperbaiki."
"Koleksi buku di perpustakaan sangat terbatas. Buku pelajaran terbaru juga belum ada. Mohon ditambah koleksi bukunya agar siswa bisa belajar lebih banyak."
"Banyak mouse komputer di lab yang rusak. Siswa jadi rebutan komputer yang masih berfungsi. Tolong dilengkapi peralatannya."
"Kantin sekolah kurang bersih, banyak lalat. Peralatan makan juga kurang higienis. Mohon kebersihan kantin lebih diperhatikan demi kesehatan siswa."
"Air wudhu di musala sering mampet dan berbau. Mohon dibersihkan secara rutin agar siswa nyaman beribadah."
"Lapangan basket kondisinya berlubang dan berbahaya untuk bermain. Sudah ada yang terjatuh dan terluka. Mohon segera diperbaiki."
)

isi_akademik=(
"Guru matematika sering tidak masuk kelas tanpa pemberitahuan. Materi jadi tertinggal dan siswa bingung. Mohon guru lebih disiplin dan jika berhalangan beri kabar."
"Jadwal pelajaran sering berubah mendadak tanpa pemberitahuan jelas. Siswa dan orang tua jadi bingung. Tolong konsisten dengan jadwal yang sudah dibuat."
"Materi pelajaran terlalu sulit dan guru kurang menjelaskan dengan detail. Banyak siswa yang tidak paham. Mohon cara mengajar lebih mudah dipahami."
"Tugas yang diberikan guru terlalu banyak. Siswa jadi stress dan tidak ada waktu istirahat. Tolong porsi tugas disesuaikan dengan kemampuan siswa."
"Guru hanya membaca buku dan tidak menjelaskan lebih dalam. Siswa banyak yang tidak paham materi. Mohon metode mengajar lebih interaktif."
"Nilai rapor anak saya tidak sesuai dengan nilai ulangan harian. Mohon penjelasan sistem penilaiannya agar transparan dan bisa dikonfirmasi."
"Sistem penilaian tidak jelas, siswa tidak tahu dari mana nilai berasal. Mohon lebih transparan dalam penilaian dan beri akses ke siswa/ortu."
"Buku paket pelajaran untuk kelas 9 belum tersedia padahal sudah 2 minggu masuk. Siswa kesulitan belajar. Mohon segera didistribusikan."
"Jam pelajaran dari pagi sampai sore terlalu padat. Siswa kelelahan dan tidak fokus. Tolong jadwal diperbaiki agar lebih seimbang."
"Guru BK jarang ada di ruangan saat siswa butuh konseling. Mohon lebih rutin standby agar siswa yang butuh bantuan bisa langsung dilayani."
)

isi_keuangan=(
"Saya menerima tagihan SPP sebanyak 2 kali untuk bulan yang sama. Mohon dicek sistem pembayarannya karena ini jelas salah dan merugikan."
"Sistem pembayaran online sering error dan gagal. Sudah transfer tapi tidak tercatat. Mohon sistem IT keuangan diperbaiki agar tidak merepotkan."
"Rincian biaya sekolah tidak jelas. Banyak pos yang tidak dijelaskan untuk apa. Mohon lebih transparan dalam hal keuangan."
"Setelah membayar, bukti pembayaran tidak diberikan. Hanya dicatat di buku saja. Mohon setiap pembayaran diberi bukti resmi."
"Uang kas kelas yang dikumpulkan setiap bulan tidak ada laporannya. Orang tua tidak tahu digunakan untuk apa. Mohon dibuat laporan transparan."
"Iuran komite sekolah terlalu mahal dan tidak sesuai dengan fasilitas yang diberikan. Mohon dikaji ulang besaran iurannya."
"Ada pungutan yang tidak jelas dasarnya. Katanya untuk kegiatan tapi tidak ada penjelasan detail. Mohon tidak ada pungutan di luar resmi."
"Pembayaran via transfer sangat sulit karena nomor rekening sering berubah. Mohon konsisten dan buat sistem pembayaran yang lebih mudah."
"Laporan penggunaan dana BOS tidak pernah disampaikan ke orang tua. Mohon lebih terbuka soal keuangan sekolah."
"Pengembalian uang sisa kegiatan study tour sudah 2 bulan belum dikembalikan. Mohon segera diproses."
)

isi_sdm=(
"Guru sering marah-marah di kelas tanpa alasan jelas. Siswa jadi takut dan tidak nyaman belajar. Mohon guru lebih sabar dalam mendidik."
"Petugas kebersihan jarang membersihkan kelas. Sampah menumpuk dan lingkungan jadi kotor. Tolong lebih rutin dalam bertugas."
"Satpam kurang ramah dan galak saat ditanya. Mohon lebih sopan karena satpam adalah wajah pertama sekolah."
"Guru sering datang terlambat 15-20 menit. Waktu belajar jadi berkurang. Mohon lebih disiplin waktu."
"Petugas kantin kurang sopan dan judes saat melayani siswa. Mohon dibina agar lebih ramah."
"Guru tidak menguasai materi yang diajarkan, sering salah saat menjelaskan. Mohon guru lebih prepare sebelum mengajar."
"Wali kelas jarang berkomunikasi dengan orang tua tentang perkembangan anak. Mohon lebih proaktif."
"Kepala sekolah jarang terlihat dan tidak pernah turun ke kelas. Mohon lebih dekat dengan siswa dan guru."
"Guru piket tidak pernah ada di pos piket. Jadi tidak ada yang mengawasi siswa yang terlambat. Mohon lebih tertib."
"Petugas TU lama dalam merespon pertanyaan. Kadang harus datang berkali-kali baru dilayani. Mohon lebih cepat tanggap."
)

isi_lainnya=(
"Keamanan sekolah kurang. Sering ada orang luar masuk tanpa izin. Mohon security lebih ketat dan pasang CCTV."
"Kasus bullying tidak ditangani dengan serius. Korban hanya disuruh bersabar. Mohon ada tindakan tegas terhadap pelaku."
"Lingkungan sekolah tidak asri, pohon banyak yang mati. Mohon ditanami pohon lagi agar sejuk dan enak dipandang."
"Banyak sampah plastik berserakan di halaman sekolah. Tempat sampah kurang. Mohon tambah tong sampah dan edukasi siswa."
"Kantin menjual makanan yang tidak sehat seperti mie instan dan minuman berpewarna. Mohon diawasi menu kantin."
"Helm motor saya hilang di parkiran. Tidak ada pengamanan. Mohon parkiran dibuat lebih aman atau ada petugas jaga."
"Website sekolah sering down dan tidak bisa diakses. Informasi penting jadi tidak bisa dibaca. Mohon server diperbaiki."
"Wifi sekolah tidak bisa dipakai oleh siswa. Padahal untuk tugas online butuh internet. Mohon dibuka akses wifi untuk siswa."
"CCTV di beberapa titik tidak berfungsi. Ini penting untuk keamanan. Mohon segera diperbaiki atau diganti."
"Pagar sekolah bagian belakang rusak dan bolong. Siswa bisa keluar masuk sembarangan. Mohon segera diperbaiki."
)

# === STATUS & TANGGAPAN ===

status_opts=("Menunggu" "Proses" "Selesai" "Ditolak")

# TANGGAPAN UNTUK STATUS "SELESAI" (PER KATEGORI)
tanggapan_selesai_pelayanan=(
"Terima kasih atas masukannya. Petugas sudah kami beri pembinaan tentang pelayanan prima. Informasi PPDB juga sudah kami lengkapi di website dan banner."
"Sudah kami tegur dan beri arahan kepada petugas TU untuk lebih ramah dalam melayani. Terima kasih laporannya."
"Proses legalisir sudah kami percepat dengan sistem antrian digital. Sekarang rata-rata hanya 15-30 menit. Terima kasih masukannya."
"Kami sudah menambah petugas pelayanan dan membuat sistem antrian online. Mohon dicoba kembali. Terima kasih."
"Surat keterangan sudah selesai dan dapat diambil di TU. Mohon maaf atas keterlambatannya. Kami akan lebih cepat ke depannya."
"Petugas sudah kami tegur dan akan kami awasi kedisiplinannya. Terima kasih atas laporannya."
"Sistem pendaftaran online sudah diperbaiki oleh tim IT. Silakan dicoba kembali. Terima kasih."
"Informasi sudah kami samakan di semua media. Silakan cek kembali. Terima kasih masukannya."
"Sudah kami ingatkan kepada semua petugas untuk lebih disiplin waktu. Terima kasih."
"Ruang tunggu sudah kami perbaiki dengan tambahan AC dan kursi. Silakan datang kembali. Terima kasih."
)

tanggapan_selesai_fasilitas=(
"AC sudah diperbaiki dan berfungsi normal kembali. Terima kasih laporannya."
"Toilet sudah dibersihkan dan diperbaiki. Kami juga sudah mengatur jadwal pembersihan rutin. Terima kasih."
"Lampu sudah diganti dan kelas kembali terang. Terima kasih atas informasinya."
"Kursi yang rusak sudah diperbaiki dan sebagian sudah diganti baru. Terima kasih."
"LCD proyektor sudah diperbaiki oleh teknisi. Sekarang sudah bisa digunakan kembali. Terima kasih."
"Kami sudah menambah koleksi buku perpustakaan. Silakan berkunjung kembali. Terima kasih sarannya."
"Mouse komputer yang rusak sudah diganti dengan yang baru. Terima kasih laporannya."
"Kantin sudah dibersihkan dan kami ingatkan penjaga kantin untuk lebih menjaga kebersihan. Terima kasih."
"Saluran air wudhu sudah dibersihkan dan lancar kembali. Terima kasih informasinya."
"Lapangan basket sudah diperbaiki dan diratakan kembali. Terima kasih laporannya."
)

tanggapan_selesai_akademik=(
"Guru sudah kami tegur dan akan kami awasi kedisiplinannya. Jika berhalangan wajib memberitahu. Terima kasih."
"Jadwal pelajaran sudah dibuat fix dan tidak akan berubah kecuali kondisi darurat. Terima kasih masukannya."
"Kami sudah mengadakan rapat dengan guru untuk menyesuaikan metode mengajar. Terima kasih."
"Sudah kami koordinasikan dengan guru-guru untuk mengurangi dan menyeimbangkan tugas siswa. Terima kasih."
"Guru sudah kami beri arahan untuk lebih interaktif dalam mengajar. Terima kasih sarannya."
"Sistem penilaian sudah kami jelaskan secara transparan di rapat orang tua. Terima kasih."
"Nilai sudah bisa diakses melalui sistem online. Terima kasih masukannya."
"Buku paket sudah didistribusikan ke semua kelas. Terima kasih informasinya."
"Jadwal pelajaran sudah kami revisi agar lebih seimbang. Terima kasih sarannya."
"Guru BK sudah kami ingatkan untuk lebih standby di ruangan saat jam kerja. Terima kasih."
)

tanggapan_selesai_keuangan=(
"Tagihan ganda sudah kami koreksi dan dikembalikan. Mohon maaf atas kesalahan sistem. Terima kasih."
"Sistem pembayaran sudah diperbaiki dan berjalan normal. Silakan dicoba kembali. Terima kasih."
"Rincian biaya sudah kami tampilkan di papan pengumuman dan website. Terima kasih sarannya."
"Mulai sekarang setiap pembayaran akan diberi kwitansi resmi. Terima kasih masukannya."
"Laporan kas kelas sudah dibuat dan akan dibagikan setiap bulan. Terima kasih."
"Iuran komite sudah dikaji ulang dan disesuaikan. Terima kasih masukannya."
"Kami pastikan tidak ada pungutan di luar yang resmi. Terima kasih laporannya."
"Nomor rekening sudah dibuat konsisten dan dipublikasikan resmi. Terima kasih."
"Laporan keuangan BOS sudah ditempel di papan pengumuman. Terima kasih."
"Uang sudah dikembalikan. Mohon maaf atas keterlambatannya. Terima kasih."
)

tanggapan_selesai_sdm=(
"Guru yang bersangkutan sudah kami beri pembinaan tentang manajemen emosi. Terima kasih laporannya."
"Petugas kebersihan sudah kami ingatkan untuk lebih rajin. Terima kasih."
"Satpam sudah kami beri arahan untuk lebih ramah kepada tamu. Terima kasih."
"Guru sudah kami tegur dan akan kami awasi kedisiplinan waktunya. Terima kasih."
"Petugas kantin sudah kami nasihati untuk lebih sopan. Terima kasih laporannya."
"Guru sudah kami beri pelatihan dan pendampingan materi. Terima kasih masukannya."
"Wali kelas sudah kami ingatkan untuk lebih komunikatif dengan orang tua. Terima kasih."
"Kepala sekolah akan lebih sering turun ke kelas untuk monitoring. Terima kasih sarannya."
"Guru piket sudah dijadwalkan ulang dan akan lebih tertib. Terima kasih."
"Petugas TU sudah kami beri arahan untuk lebih responsif. Terima kasih."
)

tanggapan_selesai_lainnya=(
"Kami sudah memperketat sistem keamanan dan menambah CCTV. Terima kasih laporannya."
"Kasus bullying sudah ditangani dengan sanksi tegas kepada pelaku. Terima kasih."
"Kami sudah menanam pohon baru di lingkungan sekolah. Terima kasih sarannya."
"Tong sampah sudah ditambah dan kami edukasi siswa tentang kebersihan. Terima kasih."
"Menu kantin sudah kami awasi dan batasi makanan tidak sehat. Terima kasih."
"Sistem keamanan parkiran sudah diperbaiki dengan petugas jaga. Terima kasih laporannya."
"Website sudah diperbaiki dan berjalan normal kembali. Terima kasih informasinya."
"Wifi sudah dibuka untuk siswa dengan sistem login. Terima kasih sarannya."
"CCTV yang rusak sudah diganti baru. Terima kasih laporannya."
"Pagar sekolah sudah diperbaiki dan diperkuat. Terima kasih informasinya."
)

# TANGGAPAN UNTUK STATUS "PROSES"
tanggapan_proses=(
"Sedang kami proses dan koordinasikan dengan pihak terkait. Estimasi selesai minggu depan. Terima kasih."
"Tim kami sedang menangani pengaduan Anda. Mohon bersabar. Akan kami kabari perkembangannya."
"Sudah kami teruskan ke bagian terkait dan sedang dalam proses perbaikan. Terima kasih laporannya."
"Sedang kami evaluasi dan koordinasikan. Mohon menunggu update selanjutnya. Terima kasih."
"Pengaduan Anda sedang kami proses. Akan segera kami tindaklanjuti. Terima kasih."
"Sudah masuk dalam jadwal perbaikan minggu ini. Mohon bersabar. Terima kasih."
"Sedang kami verifikasi data dan akan segera ditindaklanjuti. Terima kasih laporannya."
"Tim maintenance sedang menangani. Estimasi selesai 2-3 hari ke depan. Terima kasih."
"Sudah kami agendakan untuk rapat koordinasi. Mohon menunggu. Terima kasih."
"Sedang dalam proses pengadaan/perbaikan. Akan kami update secepatnya. Terima kasih."
)

# TANGGAPAN UNTUK STATUS "DITOLAK"
tanggapan_ditolak=(
"Mohon maaf, pengaduan Anda tidak dapat kami proses karena tidak sesuai dengan ketentuan yang berlaku."
"Setelah kami verifikasi, data yang Anda sampaikan tidak sesuai fakta di lapangan. Terima kasih."
"Mohon maaf, hal yang Anda adukan di luar kewenangan sekolah. Terima kasih."
"Pengaduan serupa sudah pernah ditangani dan diselesaikan. Mohon dicek kembali. Terima kasih."
"Mohon maaf, pengaduan tidak dapat diproses karena data tidak lengkap."
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

gen_telepon() {
    echo "08$((RANDOM % 10))$((RANDOM % 10))$((RANDOM % 10000 + 10000))$((RANDOM % 10000))"
}

gen_email() {
    local name=$1
    local domain=("gmail.com" "yahoo.com" "outlook.com" "email.com" "mail.com")
    local clean_name=$(echo "$name" | tr '[:upper:]' '[:lower:]' | tr ' ' '.')
    echo "${clean_name}@$(get_random domain[@])"
}

# ------------------------------------------------------------------------------
# 5. GENERATOR LOGIC
# ------------------------------------------------------------------------------

echo ""
echo ">>> MEMULAI GENERATE DATA PENGADUAN..."
echo "Format: nama,email,telepon,kategori,judul,isi_pengaduan,status,tanggapan,created_at,ip_address"

BASE_FILENAME="pengaduan_part"
HEADER_CSV="nama,email,telepon,kategori,judul,isi_pengaduan,status,tanggapan,created_at,ip_address"

count=0
file_index=1
current_file="${OUTPUT_DIR}/${BASE_FILENAME}_${file_index}.csv"
declare -A used_names

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
    
    # Cek uniqueness
    if [[ -n "${used_names[$fullname]}" ]]; then 
        if [ $gender -eq 0 ]; then
            mname=$(get_random male_first[@])
        else
            mname=$(get_random female_first[@])
        fi
        fullname="$fname $mname $lname"
    fi
    used_names["$fullname"]=1
    
    # Generate Email & Telepon
    email=$(gen_email "$fullname")
    telepon=$(gen_telepon)
    
    # Pilih Kategori Random
    kategori=$(get_random kategori_opts[@])
    
    # Pilih Judul & Isi sesuai Kategori
    case $kategori in
        "Pelayanan")
            judul=$(get_random judul_pelayanan[@])
            isi=$(get_random isi_pelayanan[@])
            ;;
        "Fasilitas")
            judul=$(get_random judul_fasilitas[@])
            isi=$(get_random isi_fasilitas[@])
            ;;
        "Akademik")
            judul=$(get_random judul_akademik[@])
            isi=$(get_random isi_akademik[@])
            ;;
        "Keuangan")
            judul=$(get_random judul_keuangan[@])
            isi=$(get_random isi_keuangan[@])
            ;;
        "SDM")
            judul=$(get_random judul_sdm[@])
            isi=$(get_random isi_sdm[@])
            ;;
        "Lainnya")
            judul=$(get_random judul_lainnya[@])
            isi=$(get_random isi_lainnya[@])
            ;;
    esac
    
    # Generate Status (Weighted Random: 20% Menunggu, 30% Proses, 45% Selesai, 5% Ditolak)
    rand_status=$((RANDOM % 100))
    if [ $rand_status -lt 20 ]; then
        status="Menunggu"
        tanggapan=""
    elif [ $rand_status -lt 50 ]; then
        status="Proses"
        tanggapan=$(get_random tanggapan_proses[@])
    elif [ $rand_status -lt 95 ]; then
        status="Selesai"
        # Pilih tanggapan sesuai kategori
        case $kategori in
            "Pelayanan") tanggapan=$(get_random tanggapan_selesai_pelayanan[@]) ;;
            "Fasilitas") tanggapan=$(get_random tanggapan_selesai_fasilitas[@]) ;;
            "Akademik") tanggapan=$(get_random tanggapan_selesai_akademik[@]) ;;
            "Keuangan") tanggapan=$(get_random tanggapan_selesai_keuangan[@]) ;;
            "SDM") tanggapan=$(get_random tanggapan_selesai_sdm[@]) ;;
            "Lainnya") tanggapan=$(get_random tanggapan_selesai_lainnya[@]) ;;
        esac
    else
        status="Ditolak"
        tanggapan=$(get_random tanggapan_ditolak[@])
    fi
    
    created_at=$(gen_date)
    ip_address=$(gen_ip)
    
    # Escape double quotes dalam text
    judul_clean=$(echo "$judul" | sed 's/"/""/g')
    isi_clean=$(echo "$isi" | sed 's/"/""/g')
    tanggapan_clean=$(echo "$tanggapan" | sed 's/"/""/g')
    
    # Write CSV
    echo "$fullname,$email,$telepon,$kategori,\"$judul_clean\",\"$isi_clean\",$status,\"$tanggapan_clean\",$created_at,$ip_address" >> "$current_file"
    ((count++))
    
    # Split file jika sudah mencapai batch size
    if (( count % INPUT_BATCH == 0 && count < INPUT_TOTAL )); then
        ((file_index++))
        current_file="${OUTPUT_DIR}/${BASE_FILENAME}_${file_index}.csv"
        echo "$HEADER_CSV" > "$current_file"
    fi
    
    # Progress indicator
    if (( count % 100 == 0 )); then 
        echo -ne "   Progress: $count / $INPUT_TOTAL \r"
    fi
done

echo -e "\n   [OK] Selesai."

# ------------------------------------------------------------------------------
# 6. STATISTIK & SUMMARY
# ------------------------------------------------------------------------------

echo ""
echo "=================================================================="
echo "   PROSES SELESAI!"
echo "=================================================================="
echo "Lokasi Folder  : ./$OUTPUT_DIR/"
echo "Total File     : $file_index File CSV"
echo "Total Data     : $(printf "%'.f\n" $INPUT_TOTAL) pengaduan"
echo ""
echo "DETAIL DISTRIBUSI STATUS (Estimasi):"
echo "- Menunggu  : ~20% (Belum ada tanggapan)"
echo "- Proses    : ~30% (Sedang ditangani)"
echo "- Selesai   : ~45% (Sudah ditindaklanjuti)"
echo "- Ditolak   : ~5%  (Tidak dapat diproses)"
echo ""
echo "KATEGORI PENGADUAN:"
echo "1. Pelayanan  - PPDB, TU, Administrasi"
echo "2. Fasilitas  - AC, Toilet, Kelas, Lab"
echo "3. Akademik   - Guru, Jadwal, Materi, Nilai"
echo "4. Keuangan   - SPP, Biaya, Transparansi"
echo "5. SDM        - Guru, Petugas, Staff"
echo "6. Lainnya    - Keamanan, Lingkungan, Umum"
echo "=================================================================="
echo ""
echo "CARA IMPORT:"
echo "1. Login ke Admin Dashboard (/admin)"
echo "2. Klik tab 'Pengaduan Masyarakat'"
echo "3. Klik tombol 'Import'"
echo "4. Upload file CSV dari folder ./dummy/"
echo "5. Proses import akan berjalan otomatis"
echo ""
echo "File siap digunakan! ✅"
echo "=================================================================="