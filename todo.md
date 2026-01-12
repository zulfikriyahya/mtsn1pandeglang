# Admin Dashboard - Perbaikan & Fitur Baru

(Astro SSG)

1. Data Artikel

- Upload file konten .mdx ke path src/content/blog/ (super admin, dan operator) (Timpa otomatis jika nama file duplikat) -> tampilkan tombol rebuild
- Delete: Hapus file artikel (super admin) -> tampilkan tombol rebuild
- Unduh File (super admin)
- Ketika ada operator yang mengunggah file (jangan langsung rebuild) -> unduh file untuk meninjau (super admin) -> tampilkan tombol rebuild/hapus file
- build hanya boleh dilakukan oleh super admin
