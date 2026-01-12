# Admin Dashboard - Perbaikan & Fitur Baru

1. Data Artikel

- Upload file konten .mdx ke path src/content/blog/
- Insert: Timpa otomatis jika nama file duplikat
- Delete: Hapus file artikel

2. Multi-Role

File .env:
PUBLIC_GOOGLE_CLIENT_ID=33203236150-amm5kr16pc5pds6vmmsknd4rec3tplur.apps.googleusercontent.com
ADMIN_EMAIL=dev.mtsn1pandeglang@gmail.com

- Daftar email admin di .env → simpan ke database tabel users
- jadikan sistem ini memiliki role super admin (memiliki semua akses action di dashboard admin), Operator (memiliki hak akses melihat dan mengunduh di dashboard admin), dan User (memiliki hak akses melihat statistik saja)
- Validasi login berdasarkan database tabel users
- Super admin dapat mendaftarkan, mengedit, dan menghapus dan menonaktifkan email Operator dan User
- Tambahkan fitur registrasi akun baru dan login akun juga verifikasi lewat email
