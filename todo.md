# Admin Dashboard - Perbaikan & Fitur Baru

1. Data Artikel

- Upload file konten .mdx ke path src/content/blog/
- Insert: Timpa otomatis jika nama file duplikat
- Delete: Hapus file artikel

4. Cetak PDF

- Urutkan data berdasarkan timestamp (terbaru → terlama)
- Header tabel muncul di setiap halaman (jika lebih dari 1 halaman)
- Jarak tabel terakhir dengan tanda tangan:
- Gabung dalam 1 halaman jika muat
- Pisah halaman jika tidak muat

5. Multi-Admin

- Daftar email admin di .env → simpan ke database
- Validasi login berdasarkan database admin
