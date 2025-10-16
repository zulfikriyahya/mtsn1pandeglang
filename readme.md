# Website MTs Negeri 1 Pandeglang v0.0.1

## Project Info

- **Name**: mtsn1pandeglang
- **Version**: 0.0.1
- **Description**: Astro and Tailwindcss boilerplate
- **Author**: zulfikriyahya
- **License**: MIT
- **Package Manager**: yarn@1.22.22

---

## Scripts

| Script | Perintah |
|--------|----------|
| `dev` | `yarn generate-json && astro dev` - Development server |
| `build` | `yarn generate-json && astro build` - Production build |
| `preview` | `astro preview` - Preview production build |
| `check` | `astro check` - Type checking |
| `format` | `prettier -w ./src` - Format code |
| `generate-json` | `node scripts/jsonGenerator.js` - Generate JSON files |
| `remove-darkmode` | `node scripts/removeDarkmode.js && yarn format` - Remove dark mode |

---

## Dependencies (Runtime)

### Astro & Framework

- **astro** `^5.14.4` - Static site generator
- **@astrojs/mdx** `^4.3.7` - MDX support
- **@astrojs/react** `^4.4.0` - React integration
- **@astrojs/rss** `^4.0.12` - RSS feed generation
- **@astrojs/sitemap** `^3.6.0` - Sitemap generation
- **@astrojs/check** `0.9.4` - Type checking

### UI & Styling

- **react** `^19.2.0` - UI library
- **react-dom** `^19.2.0` - React DOM rendering
- **react-icons** `^5.5.0` - Icon library
- **swiper** `^11.2.10` - Carousel/slider component

### Analytics & Tracking

- **@digi4care/astro-google-tagmanager** `^1.6.0` - Google Tag Manager integration
- **disqus-react** `^1.1.7` - Disqus comments

### Content & Parsing

- **gray-matter** `^4.0.3` - YAML front-matter parser
- **marked** `^15.0.12` - Markdown parser
- **remark-collapse** `^0.1.2` - Remark plugin untuk collapsible content
- **remark-toc** `^9.0.0` - Remark plugin untuk table of contents

### Utilities

- **date-fns** `^4.1.0` - Date formatting & manipulation
- **github-slugger** `^2.0.0` - URL slug generator
- **prop-types** `^15.8.1` - PropTypes validation
- **@justinribeiro/lite-youtube** `^1.8.2` - Lightweight YouTube embed
- **astro-font** `^1.1.0` - Font optimization
- **astro-auto-import** `^0.4.5` - Auto import components
- **vite** `^6.3.6` - Build tool

---

## Dev Dependencies

### Styling

- **tailwindcss** `^4.1.14` - Utility-first CSS framework
- **@tailwindcss/vite** `^4.1.14` - Tailwind Vite plugin
- **@tailwindcss/forms** `^0.5.10` - Form styling plugin
- **@tailwindcss/typography** `^0.5.19` - Typography plugin

### Code Quality

- **prettier** `^3.6.2` - Code formatter
- **prettier-plugin-astro** `^0.14.1` - Astro formatter
- **prettier-plugin-tailwindcss** `^0.6.14` - Tailwind formatter
- **eslint** `^9.37.0` - Linter
- **typescript** `^5.9.3` - TypeScript compiler

### Progressive Web App

- **@vite-pwa/astro** `^1.1.1` - PWA integration

### Image Processing

- **sharp** `0.33.5` - Image manipulation & optimization

### Type Definitions

- **@types/node** `22.15.3` - Node.js types
- **@types/react** `19.1.2` - React types
- **@types/react-dom** `19.1.2` - React DOM types

---

## Ringkasan

### Total Dependencies: 26 packages

- **Production**: 18 packages
- **Development**: 18 packages

### Core Technology Stack

- Astro 5.x (SSG)
- React 19.x (UI components)
- Tailwind CSS 4.x (styling)
- TypeScript 5.x (type safety)
- Vite 6.x (bundler)

### Key Features

- Responsive design with Tailwind CSS
- MDX support untuk content rich pages
- React components integration
- PWA ready
- SEO optimized (sitemap, RSS)
- Analytics (Google Tag Manager)
- Comments (Disqus)
- Image optimization
- Code formatting & linting

---

## Structure

```bash
.
├── astro.config.mjs
├── config
│   └── nginx
│       └── nginx.conf
├── laporan-analisis-website.md
├── LICENSE
├── package.json
├── public
│   ├── images
│   │   ├── artikel
│   │   │   └── isra-miraj.png
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
│   │   │   ├── icon-512x512.png
│   │   │   └── screenshot-1.png
│   │   ├── image-placeholder.png
│   │   ├── logo.png
│   │   └── sertifikat-akreditasi
│   │       └── 2023.pdf
│   ├── manifest.json
│   └── robots.txt
├── ranking-kecepatan-website-sekolah-di-indonesia.md
├── ranking-teknologi-website-sekolah-di-indonesia.md
├── readme.md
├── scripts
│   ├── jsonGenerator.js
│   └── removeDarkmode.js
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
│   │   │   ├── -index.md
│   │   │   ├── olimpiade-bahasa-arab-2016.md
│   │   │   └── olimpiade-sains-2016.md
│   │   ├── contact
│   │   │   └── -index.md
│   │   ├── homepage
│   │   │   └── -index.md
│   │   ├── pages
│   │   │   ├── adiwiyata.mdx
│   │   │   ├── akreditasi.mdx
│   │   │   ├── alumni.mdx
│   │   │   ├── ekstrakurikuler.mdx
│   │   │   ├── elements.mdx
│   │   │   ├── guru.mdx
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
│   │   │   ├── Share.astro
│   │   │   ├── Social.astro
│   │   │   ├── ThemeSwitcher.astro
│   │   │   └── TwSizeIndicator.astro
│   │   ├── helpers
│   │   │   ├── Disqus.tsx
│   │   │   ├── DynamicIcon.tsx
│   │   │   ├── InstallPrompt.tsx
│   │   │   ├── SearchModal.tsx
│   │   │   └── SearchResult.tsx
│   │   ├── partials
│   │   │   ├── CallToAction.astro
│   │   │   ├── Footer.astro
│   │   │   ├── Header.astro
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
│   │   ├── [regular].astro
│   │   └── tags
│   │       ├── index.astro
│   │       └── [tag].astro
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
├── struktur.txt
└── tsconfig.json
```

---

## Description

### Root Files

- `astro.config.mjs` - Konfigurasi utama Astro
- `package.json` - Dependencies dan script project
- `tsconfig.json` - Konfigurasi TypeScript
- `LICENSE` - Lisensi project

### Dokumentasi

- `readme.md` - Panduan umum project
- `laporan-analisis-website.md` - Analisis performa website
- `ranking-kecepatan-website-sekolah-di-indonesia.md` - Benchmark kecepatan
- `ranking-teknologi-website-sekolah-di-indonesia.md` - Benchmark teknologi

### Config & Nginx

- `config/nginx/nginx.conf` - Konfigurasi server Nginx

### Public Assets

- `public/images/` - Aset gambar (banner, artikel, logo, favicon)
- `public/manifest.json` - PWA manifest
- `public/robots.txt` - SEO robots directive

### Script

- `scripts/` - Helper scripts (JSON generator, dark mode remover)

### Source Code (src/)

- `config/` - File konfigurasi JSON (menu, social, theme, config)
- `content/` - Content markdown (blog, pages, about, contact, authors)
- `layouts/` - Template Astro & komponen (Header, Footer, Blog layout, dll)
- `pages/` - Route pages (index, blog, contact, categories, tags)
- `styles/` - CSS files (base, components, utilities, navigation)
- `lib/` - Utility functions (parser, formatter, filter)
- `hooks/` - Custom hooks (useTheme)
- `types/` - TypeScript definitions
- `tailwind-plugin/` - Custom Tailwind plugins

---

## Fitur Utama

- Multi-Penulis
- Multibahasa
- Saran Postingan Serupa
- Fitur Pencarian
- Mode Gelap
- Tag & Kategori
- Pengaturan Netlify yang sudah dikonfigurasi
- Formulir kontak dukungan
- Responsif penuh
- Tulis dan perbarui konten dalam Markdown / MDX
- Komentar Disqus
- Penyorotan Sintaks

### 15+ Halaman Pra-Desain

- Halaman Utama
- Tentang
- Kontak
- Penulis
- Penulis Tunggal
- Blog
- Blog Tunggal
- 404 Khusus
- Elemen
- Kebijakan Privasi
- Tag
- Tag Tunggal
- Kategori
- Kategori Tunggal
- Pencarian

---

## Memulai

### Instal Ketergantungan

```bash
npm install
```

### Perintah Pengembangan

```bash
npm run dev
```

### Perintah Build

```bash
npm run build
```
