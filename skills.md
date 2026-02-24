# README
# MTsN 1 Pandeglang — Website Resmi

> **Mandiri, Takwa, Peduli Lingkungan, Prestasi**

Website resmi MTsN 1 Pandeglang dibangun dengan [Astro](https://astro.build/) sebagai static site generator, React untuk komponen interaktif, dan Tailwind CSS untuk styling. Dilengkapi fitur PWA, CMS berbasis PHP, sistem pengaduan, dan survei kepuasan layanan.

---

## Project Structure
```bash
.
├── astro.config.mjs
├── config
│   └── nginx
│       └── nginx.conf
├── deploy.sh
├── draft.md
├── dummy-pengaduan.sh
├── dummy.sh
├── generate.sh
├── install.sh
├── LICENSE
├── package.json
├── public
│   ├── api
│   │   ├── admin_pengaduan.php
│   │   ├── admin.php
│   │   ├── auth.php
│   │   ├── config.php
│   │   ├── content.php
│   │   ├── crud.php
│   │   ├── feedback.php
│   │   ├── import_pengaduan.php
│   │   ├── import.php
│   │   ├── lib
│   │   │   ├── font
│   │   │   │   ├── courierbi.php
│   │   │   │   ├── courierb.php
│   │   │   │   ├── courieri.php
│   │   │   │   ├── courier.php
│   │   │   │   ├── helveticabi.php
│   │   │   │   ├── helveticab.php
│   │   │   │   ├── helveticai.php
│   │   │   │   ├── helvetica.php
│   │   │   │   ├── symbol.php
│   │   │   │   ├── timesbi.php
│   │   │   │   ├── timesb.php
│   │   │   │   ├── timesi.php
│   │   │   │   ├── times.php
│   │   │   │   └── zapfdingbats.php
│   │   │   ├── fpdf.css
│   │   │   └── fpdf.php
│   │   ├── pengaduan.php
│   │   ├── print_pdf.php
│   │   ├── print_pengaduan_pdf.php
│   │   ├── stats.php
│   │   ├── survey.php
│   │   └── users.php
│   ├── images
│   │   ├── artikel
│   │   │   ├── banner.png
│   │   │   ├── guest-teacher-1
│   │   │   │   ├── banner.bkp.jpeg
│   │   │   │   └── banner.jpeg
│   │   │   ├── isra-miraj-1447h
│   │   │   │   └── banner.jpeg
│   │   │   ├── learning-conference-3
│   │   │   │   └── banner.jpeg
│   │   │   ├── plp-kkn
│   │   │   │   └── 2025
│   │   │   │       └── uin-banten
│   │   │   │           ├── alfina-husna-azkia.png
│   │   │   │           ├── amalia-fatihah.png
│   │   │   │           ├── aulia-al-qisti-nazifah.png
│   │   │   │           ├── hafidz-dian-nugraha.png
│   │   │   │           ├── ine-febriyanti.png
│   │   │   │           ├── kegiatan-1.png
│   │   │   │           ├── kegiatan-2.png
│   │   │   │           ├── kegiatan-3.png
│   │   │   │           ├── kegiatan-4.png
│   │   │   │           ├── kegiatan-5.png
│   │   │   │           ├── kegiatan-6.png
│   │   │   │           ├── kegiatan-7.png
│   │   │   │           ├── khoirotunnisa.png
│   │   │   │           ├── linda-mutia-rahmah.png
│   │   │   │           ├── muhammad-abdullah.png
│   │   │   │           ├── muhammad-faqih-abdul-wafa.png
│   │   │   │           ├── muhoiriah.png
│   │   │   │           ├── nina-isnaiyah.png
│   │   │   │           ├── nur-indah-isnaini.png
│   │   │   │           ├── pia-fatmawati.png
│   │   │   │           ├── rihadatul-aisy.png
│   │   │   │           ├── siti-arifah.png
│   │   │   │           ├── siti-khoirunisa.png
│   │   │   │           └── susi-susilawati.png
│   │   │   └── zona-integritas.png
│   │   ├── assets
│   │   │   ├── akreditasi.png
│   │   │   ├── banner.png
│   │   │   ├── ekstrakurikuler.png
│   │   │   ├── fasilitas.png
│   │   │   ├── kepala-madrasah.png
│   │   │   ├── kurikulum.png
│   │   │   ├── program.png
│   │   │   ├── ptsp.png
│   │   │   └── zona-integritas.png
│   │   ├── authors
│   │   │   └── yahya-zulfikri.png
│   │   ├── avatar.png
│   │   ├── avatar-sm.png
│   │   ├── brand-darkmode.png
│   │   ├── brand-lightmode.png
│   │   ├── call-to-action.png
│   │   ├── favicon.png
│   │   ├── icons
│   │   │   ├── icon-192x192.png
│   │   │   └── icon-512x512.png
│   │   ├── image-placeholder.png
│   │   ├── instansi
│   │   │   ├── logo-instansi.png
│   │   │   ├── logo-institusi.png
│   │   │   ├── tte-kepala-madrasah.png
│   │   │   ├── tte-kepala-tata-usaha.png
│   │   │   └── tte-koordinator-tim-pusdatin.png
│   │   └── logo.png
│   ├── manifest.json
│   ├── robots.txt
│   ├── template.mdx
│   └── videos
│       └── artikel
│           └── plp-kkn
│               └── 2025
│                   └── uin-banten
│                       ├── video-1.mp4
│                       └── video-2.mp4
├── README.mdx
├── rebuild.sh
├── scripts
│   ├── jsonGenerator.js
│   └── removeDarkmode.js
├── skills.md
├── src
│   ├── config
│   │   ├── config.json
│   │   ├── menu.json
│   │   ├── social.json
│   │   └── theme.json
│   ├── content
│   │   ├── about
│   │   │   └── -index.md
│   │   ├── authors
│   │   │   ├── -index.md
│   │   │   └── yahya-zulfikri.md
│   │   ├── blog
│   │   │   ├── anugerah-satyalancana-karya-satya.mdx
│   │   │   ├── guest-teacher-session-1.mdx
│   │   │   ├── -index.md
│   │   │   ├── isra-miraj-1447.mdx
│   │   │   ├── konferensi-pembelajaran-session-3.mdx
│   │   │   ├── laporan-analisis-komprehensif-website-sekolah-indonesia.mdx
│   │   │   ├── mtsn-1-pandeglang-banjir-prestasi.mdx
│   │   │   ├── mtsn-1-pandeglang-raih-juara-1-nasional.mdx
│   │   │   ├── pembinaan-pegawai-dan-pelepasan-asn-purnabakti.mdx
│   │   │   ├── penyaluran-makanan-bergizi-gratis-mbg.mdx
│   │   │   ├── plp-kkn-uin-banten-2025.mdx
│   │   │   ├── tasyakuran-kelulusan-dan-launching-pol.mdx
│   │   │   └── zona-integritas.mdx
│   │   ├── contact
│   │   │   └── -index.md
│   │   ├── homepage
│   │   │   └── -index.md
│   │   ├── pages
│   │   │   ├── adiwiyata.mdx
│   │   │   ├── akreditasi.mdx
│   │   │   ├── alumni.mdx
│   │   │   ├── badminton-club.mdx
│   │   │   ├── basketball-club.mdx
│   │   │   ├── ekstrakurikuler.mdx
│   │   │   ├── elements.mdx
│   │   │   ├── faq.mdx
│   │   │   ├── footsal-club.mdx
│   │   │   ├── guru.mdx
│   │   │   ├── jurnalistik.mdx
│   │   │   ├── kebijakan-privasi.md
│   │   │   ├── kurikulum.mdx
│   │   │   ├── osim.mdx
│   │   │   ├── paskibra.mdx
│   │   │   ├── pecinta-alam.mdx
│   │   │   ├── pelayanan.mdx
│   │   │   ├── pmr.mdx
│   │   │   ├── pramuka.mdx
│   │   │   ├── program.mdx
│   │   │   ├── sejarah.mdx
│   │   │   ├── siswa.mdx
│   │   │   ├── staf.mdx
│   │   │   ├── visi-misi-tujuan.mdx
│   │   │   ├── volleyball-club.mdx
│   │   │   └── zona-integritas.mdx
│   │   └── sections
│   │       ├── call-to-action.md
│   │       └── testimonial.md
│   ├── content.config.ts
│   ├── hooks
│   │   └── useTheme.ts
│   ├── layouts
│   │   ├── Base.astro
│   │   ├── components
│   │   │   ├── AuthorCard.astro
│   │   │   ├── BlogCard.astro
│   │   │   ├── Breadcrumbs.astro
│   │   │   ├── ImageMod.astro
│   │   │   ├── Logo.astro
│   │   │   ├── Pagination.astro
│   │   │   ├── PengaduanForm.astro
│   │   │   ├── Share.astro
│   │   │   ├── Social.astro
│   │   │   ├── ThemeSwitcher.astro
│   │   │   └── TwSizeIndicator.astro
│   │   ├── helpers
│   │   │   ├── AdminDashboard.tsx
│   │   │   ├── AdminPengaduanDashboard.tsx
│   │   │   ├── CardViewCounter.tsx
│   │   │   ├── CookieConsent.tsx
│   │   │   ├── DynamicIcon.tsx
│   │   │   ├── GiscusComment.tsx
│   │   │   ├── InstallPrompt.tsx
│   │   │   ├── PengaduanForm.tsx
│   │   │   ├── PostViewCounter.tsx
│   │   │   ├── ProfilMahasiswaPLP.tsx
│   │   │   ├── SearchModal.tsx
│   │   │   ├── SearchResult.tsx
│   │   │   ├── ServiceRating.tsx
│   │   │   ├── SurveyWizard.tsx
│   │   │   ├── TawkChat.tsx
│   │   │   ├── VideoModal.tsx
│   │   │   └── VisitorCounter.tsx
│   │   ├── partials
│   │   │   ├── CallToAction.astro
│   │   │   ├── Footer.astro
│   │   │   ├── Header.astro
│   │   │   ├── LatestPostsSlider.astro
│   │   │   ├── PageHeader.astro
│   │   │   ├── PostSidebar.astro
│   │   │   └── Testimonial.astro
│   │   ├── PostSingle.astro
│   │   └── shortcodes
│   │       ├── Accordion.tsx
│   │       ├── Button.tsx
│   │       ├── Notice.tsx
│   │       ├── Tabs.tsx
│   │       ├── Tab.tsx
│   │       ├── Video.tsx
│   │       └── Youtube.tsx
│   ├── lib
│   │   ├── contentParser.astro
│   │   ├── taxonomyParser.astro
│   │   └── utils
│   │       ├── bgImageMod.ts
│   │       ├── dateFormat.ts
│   │       ├── readingTime.ts
│   │       ├── similarItems.ts
│   │       ├── sortFunctions.ts
│   │       ├── taxonomyFilter.ts
│   │       └── textConverter.ts
│   ├── pages
│   │   ├── 404.astro
│   │   ├── about.astro
│   │   ├── admin
│   │   │   └── index.astro
│   │   ├── authors
│   │   │   ├── index.astro
│   │   │   └── [single].astro
│   │   ├── blog
│   │   │   ├── index.astro
│   │   │   ├── page
│   │   │   │   └── [slug].astro
│   │   │   └── [single].astro
│   │   ├── categories
│   │   │   ├── [category].astro
│   │   │   └── index.astro
│   │   ├── contact.astro
│   │   ├── index.astro
│   │   ├── pengaduan.astro
│   │   ├── [regular].astro
│   │   ├── survei-kepuasan.astro
│   │   └── tags
│   │       ├── index.astro
│   │       └── [tag].astro
│   ├── scripts
│   │   ├── gsap-animations.js
│   │   └── spotlight.js
│   ├── styles
│   │   ├── base.css
│   │   ├── buttons.css
│   │   ├── components.css
│   │   ├── main.css
│   │   ├── navigation.css
│   │   ├── safe.css
│   │   ├── search.css
│   │   └── utilities.css
│   ├── tailwind-plugin
│   │   ├── tw-bs-grid.js
│   │   └── tw-theme.js
│   └── types
│       └── index.d.ts
├── tsconfig.json
└── yarn.lock
```

## Tech Stack

| Layer | Teknologi |
|---|---|
| Framework | Astro 5, React 19 |
| Styling | Tailwind CSS 4, GSAP, Lenis |
| Content | MDX, Giscus (komentar) |
| Backend API | PHP (CRUD, auth, PDF export) |
| PWA | Vite PWA Plugin, Workbox |
| Package Manager | Yarn 3 (Berry) |

---

## Prasyarat

- Node.js `>= 18`
- Yarn `3.6.0` (`corepack enable`)
- PHP `>= 8.0` (untuk fitur API di `public/api/`)

---

## Instalasi

```bash
corepack enable
yarn install
```

---

## Penggunaan

```bash
# Development server (auto-generate JSON + hot reload)
yarn dev

# Build produksi
yarn build

# Preview hasil build
yarn preview

# Type checking
yarn check

# Format kode
yarn format
```

---

## Struktur Utama

```
src/
├── content/        # Konten MDX (blog, pages, authors)
├── layouts/        # Layout Astro + komponen React (.tsx)
├── pages/          # Routing berbasis file Astro
├── styles/         # CSS modular (base, components, utilities)
└── config/         # Konfigurasi site (menu, theme, social)

public/
└── api/            # Backend PHP (auth, CRUD, PDF, pengaduan, survei)

scripts/
├── jsonGenerator.js    # Pre-build: generate JSON dari konten
└── removeDarkmode.js   # Utility: hapus dark mode
```

---

## Fitur

- **Blog & Artikel** — konten berbasis MDX dengan kategori dan tag
- **Pengaduan Online** — form pengaduan dengan dashboard admin
- **Survei Kepuasan** — wizard multi-step dengan visualisasi chart
- **Admin Dashboard** — manajemen konten dengan export PDF (FPDF)
- **PWA** — installable, offline-ready
- **SEO** — sitemap otomatis, Open Graph, structured data
- **Pencarian** — modal pencarian client-side

---

## Lisensi

[MIT](./LICENSE) © [Yahya Zulfikri](https://github.com/zulfikriyahya)

---

# Skills & Project Convention Reference

Dokumen ini digunakan sebagai konteks bagi AI assistant saat membantu pengembangan project **MTsN 1 Pandeglang**. Baca dokumen ini sebelum memberikan saran kode atau arsitektur.

---

## Developer Profile

- **Nama**: Yahya Zulfikri
- **Level**: Senior Developer
- **Bahasa**: Indonesia (penjelasan), English (kode & nama teknis)
- **Asumsi**: Sudah paham konsep dasar seperti instalasi, struktur folder standar, cara kerja framework — tidak perlu dijelaskan ulang kecuali diminta

---

## Project Overview

| Atribut | Detail |
|---|---|
| Nama | MTsN 1 Pandeglang |
| Framework | Astro 5 + React 19 |
| Styling | Tailwind CSS 4 |
| Package Manager | Yarn 3 (Berry) |
| Backend | PHP 8+ (REST API di `public/api/`) |
| PWA | Vite PWA + Workbox |
| Type | Static Site + PHP API hybrid |

---

## Struktur Layer & File Placement

```
src/layouts/components/     → Komponen Astro (.astro) — presentational, no logic berat
src/layouts/helpers/        → Komponen React (.tsx) — interaktif, stateful
src/layouts/partials/       → Section layout besar (Header, Footer, dll)
src/layouts/shortcodes/     → Komponen MDX shortcode (Accordion, Tabs, dll)
src/pages/                  → Routing Astro (file-based)
src/content/                → Konten MDX/MD (blog, pages, authors)
src/lib/utils/              → Pure utility functions (.ts)
src/config/                 → Konfigurasi JSON (menu, theme, social)
public/api/                 → PHP REST API endpoint
scripts/                    → Node.js build scripts
```

**Aturan placement:**
- Logic interaktif → `helpers/*.tsx`
- Markup statis / SSG → `components/*.astro` atau `partials/*.astro`
- Utility murni tanpa side effect → `lib/utils/*.ts`
- Jangan campur logic berat di file `.astro`

---

## Naming Convention

| Konteks | Konvensi | Contoh |
|---|---|---|
| Komponen React/Astro | PascalCase | `AdminDashboard.tsx`, `BlogCard.astro` |
| Utility function | camelCase | `dateFormat.ts`, `sortFunctions.ts` |
| CSS class | kebab-case (Tailwind utility) | `text-primary`, `bg-dark` |
| API endpoint PHP | snake_case | `admin_pengaduan.php` |
| Konten MDX | kebab-case | `guest-teacher-session-1.mdx` |
| Variabel kode | ringkas & deskriptif | `i`, `el`, `e` untuk event, `res` untuk response |

---

## Pattern: React (helpers/*.tsx)

### State Management
- Gunakan `useState` / `useReducer` untuk state lokal
- Tidak ada global state manager (Redux, Zustand) — tidak ada di project ini
- Tidak ada `localStorage` / `sessionStorage` — simpan state di memori React

### Data Fetching
```tsx
// Pattern standar fetch ke PHP API
const [data, setData] = useState(null);
const [loading, setLoading] = useState(false);

const fetchData = async () => {
  setLoading(true);
  try {
    const res = await fetch('/api/endpoint.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(payload),
    });
    const json = await res.json();
    setData(json);
  } catch (e) {
    console.error(e);
  } finally {
    setLoading(false);
  }
};
```

### Komponen
- Default export untuk semua komponen
- Props didestrukturisasi langsung di parameter
- Hindari `any` — gunakan tipe eksplisit atau interface
- Gunakan `react-icons` untuk ikon, bukan inline SVG

---

## Pattern: Astro (.astro)

- Data fetching dilakukan di frontmatter (`---`) saat build time
- Komponen interaktif dipass sebagai `client:load` atau `client:idle`
- Gunakan `ImageMod.astro` untuk semua gambar (bukan `<img>` langsung)
- Layout utama selalu extends `Base.astro`

```astro
---
import Base from "@/layouts/Base.astro";
import { SomeHelper } from "@/layouts/helpers/SomeHelper";
---
<Base>
  <SomeHelper client:load />
</Base>
```

---

## Styling: Tailwind CSS 4

- Hanya gunakan utility class Tailwind — tidak ada custom CSS inline di komponen kecuali terpaksa
- Custom style ditulis di `src/styles/*.css` dengan layer yang tepat
- Dark mode didukung via class `.dark` (ThemeSwitcher)
- Responsive mengikuti breakpoint Tailwind standar (`sm`, `md`, `lg`, `xl`)
- Plugin aktif: `@tailwindcss/typography`, `@tailwindcss/forms`
- Jangan gunakan arbitrary value `[...]` berlebihan — ekstrak ke config jika dipakai lebih dari sekali

---

## Konvensi PHP API (`public/api/`)

### Struktur Response
```php
// Success
echo json_encode(['success' => true, 'data' => $result]);

// Error
http_response_code(400);
echo json_encode(['success' => false, 'message' => 'Pesan error']);
```

### Pola Umum
- Setiap endpoint include `config.php` untuk koneksi DB
- Method request dicek via `$_SERVER['REQUEST_METHOD']`
- Input dari body JSON: `json_decode(file_get_contents('php://input'), true)`
- Output selalu `Content-Type: application/json`
- Autentikasi via session PHP — cek di `auth.php`

### File yang Ada
| File | Fungsi |
|---|---|
| `config.php` | Koneksi database |
| `auth.php` | Login/logout/session |
| `crud.php` | Operasi CRUD umum |
| `admin.php` | Endpoint khusus admin |
| `pengaduan.php` | CRUD pengaduan publik |
| `admin_pengaduan.php` | Manajemen pengaduan (admin) |
| `survey.php` | Data survei kepuasan |
| `stats.php` | Statistik & analitik |
| `print_pdf.php` | Export PDF via FPDF |
| `users.php` | Manajemen user |
| `import.php` | Import data |

---

## Dependency Penting yang Perlu Diketahui

| Package | Kegunaan |
|---|---|
| `gsap` + `lenis` | Animasi scroll & efek UI |
| `swiper` | Slider/carousel |
| `chart.js` + `react-chartjs-2` | Visualisasi data survei |
| `@giscus/react` | Komentar berbasis GitHub Discussions |
| `marked` | Parse markdown ke HTML di runtime |
| `date-fns` | Formatting tanggal |
| `gray-matter` | Parse frontmatter MDX |

---

## Constraint untuk AI Assistant

### ❌ JANGAN lakukan ini:
- Jangan sarankan instalasi library baru tanpa konfirmasi — project ini sudah punya stack yang terdefinisi
- Jangan gunakan `localStorage` atau `sessionStorage` di dalam komponen React
- Jangan buat komponen baru di luar layer yang tepat (lihat bagian **Struktur Layer**)
- Jangan gunakan `<form>` HTML di komponen React — gunakan event handler `onClick`/`onChange`
- Jangan jelaskan konsep dasar (cara install, apa itu useState, dll) kecuali diminta
- Jangan gunakan inline style `style={{}}` di React kecuali benar-benar tidak bisa dengan Tailwind
- Jangan sarankan Redux, Zustand, atau state manager eksternal lainnya
- Jangan gunakan `any` sebagai tipe TypeScript
- Jangan buat file PHP baru di luar `public/api/` tanpa alasan kuat

### ✅ SELALU lakukan ini:
- Rujuk struktur layer sebelum menentukan di mana file baru ditempatkan
- Gunakan nama variabel ringkas tapi deskriptif sesuai konvensi
- Jawab langsung ke solusi teknis — tanpa pembuka panjang
- Gunakan Bahasa Indonesia untuk penjelasan, English untuk kode
- Jika ada beberapa pendekatan, tampilkan trade-off secara ringkas
- Prioritaskan dependency yang sudah ada sebelum menyarankan yang baru
