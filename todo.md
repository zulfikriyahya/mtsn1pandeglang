# Admin Dashboard - Perbaikan & Fitur Baru

(Astro SSG)

1. Data Artikel

- unduh template artikel di path public/template.mdx
- Upload file artikel konten .mdx ke path src/content/blog/ artikel konten gambar ke public/images/artikel artikel konten video ke public/videos/artikel (super admin, dan operator) (tampilkan modal konfirmasi Timpa atau rename file jika nama file duplikat) -> tampilkan tombol rebuild
- Delete: Hapus file artikel (super admin) -> tampilkan tombol rebuild
- Unduh File (super admin)
- Ketika ada operator yang mengunggah file (jangan langsung rebuild) -> unduh file untuk meninjau (super admin) -> tampilkan tombol rebuild/hapus file
- build hanya boleh dilakukan oleh super admin
