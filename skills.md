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
