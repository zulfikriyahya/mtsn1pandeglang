<h1 align=center>Astro + Tailwind CSS + TypeScript Starter and Boilerplate</h1>

<p align=center>Astroplate adalah template starter gratis yang dibangun dengan Astro, TailwindCSS & TypeScript, menyediakan segala yang Anda butuhkan untuk memulai proyek Astro Anda dan menghemat waktu berharga.</p>

<p align=center>Dibuat dengan ♥ oleh <a href="https://zeon.studio/">Zeon Studio</a></p>

<p align=center> Jika Anda merasa proyek ini berguna, berikan bintang ⭐ untuk menunjukkan dukungan Anda. </p>

<h2 align="center"> <a target="_blank" href="https://astroplate.netlify.app/" rel="nofollow">👀 Demo</a> | <a target="_blank" href="https://astroplate-multilang.netlify.app/" rel="nofollow">👀 Demo Multilang</a> | <a  target="_blank" href="https://pagespeed.web.dev/analysis/https-astroplate-netlify-app/yzx3foum3w?form_factor=desktop">Page Speed (100%)🚀</a>
</h2>

<p align=center>
  <a href="https://github.com/withastro/astro/releases/tag/astro%404.3.2" alt="Contributors">
    <img src="https://img.shields.io/static/v1?label=ASTRO&message=4.3&color=000&logo=astro" />
  </a>

  <a href="https://github.com/zeon-studio/astroplate/blob/main/LICENSE">
    <img src="https://img.shields.io/github/license/zeon-studio/astroplate" alt="license"></a>

  <img src="https://img.shields.io/github/languages/code-size/zeon-studio/astroplate" alt="code size">

  <a href="https://github.com/zeon-studio/astroplate/graphs/contributors">
    <img src="https://img.shields.io/github/contributors/zeon-studio/astroplate" alt="contributors"></a>
</p>

## 📌 Fitur Utama

- 👥 Multi-Penulis
- 🌐 Multibahasa
- 🎯 Saran Postingan Serupa
- 🔍 Fitur Pencarian
- 🌑 Mode Gelap
- 🏷️ Tag & Kategori
- 🔗 Pengaturan Netlify yang sudah dikonfigurasi
- 📞 Formulir kontak dukungan
- 📱 Responsif penuh
- 📝 Tulis dan perbarui konten dalam Markdown / MDX
- 💬 Komentar Disqus
- 🔳 Penyorotan Sintaks

### 📄 15+ Halaman Pra-Desain

- 🏠 Halaman Utama
- 👤 Tentang
- 📞 Kontak
- 👥 Penulis
- 👤 Penulis Tunggal
- 📝 Blog
- 📝 Blog Tunggal
- 🚫 404 Khusus
- 💡 Elemen
- 📄 Kebijakan Privasi
- 🏷️ Tag
- 🏷️ Tag Tunggal
- 🗂️ Kategori
- 🗂️ Kategori Tunggal
- 🔍 Pencarian

## 🔗 Integrasi

- astro/react
- astro/sitemap
- astro/tailwind

## 🚀 Memulai

### 📦 Ketergantungan

- astro v5.3+
- node v22.14.0+
- npm v11.1.0+
- tailwind v3.4+

### 👉 Instal Ketergantungan

```bash
npm install
```
### 👉 Perintah Pengembangan

```bash
npm run dev
```
### 👉 Perintah Build

```bash
npm run build
```

### 👉 Build dan Jalankan Dengan Docker

```bash
docker build -t astroplate .
# atau
# docker --build-arg INSTALLER=npm build -t astroplate .
# atau
# docker --build-arg INSTALLER=pnpm build -t astroplate .

docker run -p 3000:80 astroplate
# atau
# docker run --rm -p 3000:80 astroplate
```

Untuk mengakses shell dalam kontainer:

```bash
docker run -it --rm astroplate ash
```