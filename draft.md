## Direktori: src

### File: `./src/config/config.json`

```json
{
  "site": {
    "title": "MTs Negeri 1 Pandeglang",
    "base_url": "https://mtsn1pandeglang.sch.id",
    "base_path": "/",
    "trailing_slash": false,
    "favicon": "/images/favicon.png",
    "logo": "/images/brand-lightmode.png",
    "logo_darkmode": "/images/brand-darkmode.png",
    "logo_width": "220",
    "logo_height": "25",
    "logo_text": "Logo MTs Negeri 1 Pandeglang"
  },

  "settings": {
    "search": true,
    "sticky_header": true,
    "theme_switcher": true,
    "default_theme": "system",
    "pagination": 10,
    "summary_length": 200,
    "blog_folder": "blog"
  },

  "params": {
    "contact_form_action": "#",
    "copyright": "[**&copy; 2022 - 2026 Madrasah Tsanawiyah Negeri 1 Pandeglang**](/)<br/>Dikelola & dikembangkan oleh [**Tim Teknis**](https://github.com/zulfikriyahya)"
  },

  "navigation_button": {
    "enable": true,
    "label": "Daftar Sekarang",
    "link": "https://daftar.mtsn1pandeglang.sch.id"
  },

  "google_tag_manager": {
    "enable": true,
    "gtm_id": "G-31LVR4XF5F"
  },

  "disqus": {
    "enable": false,
    "shortname": "themefisher-template",
    "settings": {}
  },

  "metadata": {
    "meta_author": "Yahya Zulfikri",
    "meta_image": "/images/authors/yahya-zulfikri.png",
    "meta_description": "Petugas Pengelola Administrasi Belanja Pegawai (PPABP), Customer Service Officer (CSO), Web Developer, System Administrator di MTs Negeri 1 Pandeglang"
  }
}
```

---

### File: `./src/config/menu.json`

```json
{
  "main": [
    {
      "name": "Profil Madrasah",
      "url": "",
      "hasChildren": true,
      "children": [
        {
          "name": "Tentang Kami",
          "url": "/about"
        },
        {
          "name": "Sejarah",
          "url": "/sejarah"
        },
        {
          "name": "Visi Misi",
          "url": "/visi-misi-tujuan"
        },
        {
          "name": "Akreditasi & Prestasi",
          "url": "/akreditasi"
        },
        {
          "name": "Zona Integritas (WBK)",
          "url": "/zona-integritas"
        },
        {
          "name": "Tenaga Pendidik",
          "url": "/guru"
        },
        {
          "name": "Tenaga Kependidikan",
          "url": "/staf"
        }
      ]
    },
    {
      "name": "Akademik",
      "url": "",
      "hasChildren": true,
      "children": [
        {
          "name": "Kurikulum",
          "url": "/kurikulum"
        },
        {
          "name": "Program Unggulan",
          "url": "/program"
        },
        {
          "name": "Kalender Pendidikan",
          "url": "#"
        }
      ]
    },
    {
      "name": "Kesiswaan",
      "url": "",
      "hasChildren": true,
      "children": [
        {
          "name": "Semua Ekstrakurikuler",
          "url": "/ekstrakurikuler"
        },
        {
          "name": "OSIM",
          "url": "/osim"
        },
        {
          "name": "Pramuka",
          "url": "/pramuka"
        },
        {
          "name": "Paskibra",
          "url": "/paskibra"
        },
        {
          "name": "PMR",
          "url": "/pmr"
        },
        {
          "name": "Adiwiyata & SISPALA",
          "url": "/pecinta-alam"
        },
        {
          "name": "Olahraga Prestasi",
          "url": "/volleyball-club"
        },
        {
          "name": "Jurnalistik",
          "url": "/jurnalistik"
        },
        {
          "name": "Data Alumni",
          "url": "/alumni"
        }
      ]
    },
    {
      "name": "Informasi",
      "url": "",
      "hasChildren": true,
      "children": [
        {
          "name": "Berita & Artikel",
          "url": "/blog"
        },
        {
          "name": "Penulis",
          "url": "/authors/yahya-zulfikri"
        },
        {
          "name": "Layanan PTSP",
          "url": "/pelayanan"
        },
        {
          "name": "Survei Kepuasan",
          "url": "/survei-kepuasan"
        },
        {
          "name": "Pertanyaan Umum (FAQ)",
          "url": "/faq"
        },
        {
          "name": "Galeri Foto",
          "url": "https://www.instagram.com/mtsn1_pandeglang/?hl=id"
        },
        {
          "name": "Galeri Video",
          "url": "https://www.youtube.com/@mtsn1pandeglangofficial"
        }
      ]
    },
    {
      "name": "Aplikasi Digital",
      "url": "",
      "hasChildren": true,
      "children": [
        {
          "name": "PPDB Online",
          "url": "https://daftar.mtsn1pandeglang.sch.id"
        },
        {
          "name": "Rapor Digital (RDM)",
          "url": "https://rdm.mtsn1pandeglang.sch.id"
        },
        {
          "name": "E-Learning / CBT",
          "url": "https://cbt.mtsn1pandeglang.sch.id"
        },
        {
          "name": "Presensi Online (POL)",
          "url": "https://presensi.mtsn1pandeglang.sch.id"
        },
        {
          "name": "Perpustakaan Digital",
          "url": "https://perpustakaan.mtsn1pandeglang.sch.id"
        },
        {
          "name": "Bank Data",
          "url": "https://drive.mtsn1pandeglang.sch.id"
        },
        {
          "name": "Pemutakhiran Data Mandiri (PDM)",
          "url": "https://pdm.mtsn1pandeglang.sch.id"
        }
      ]
    }
  ],
  "footer": [
    {
      "name": "Beranda",
      "url": "/"
    },
    {
      "name": "Tentang Kami",
      "url": "/about"
    },
    {
      "name": "Kebijakan Privasi",
      "url": "/kebijakan-privasi"
    },
    {
      "name": "Pertanyaan Umum (FAQ)",
      "url": "/faq"
    }
  ]
}
```

---

### File: `./src/config/social.json`

```json
{
  "main": [
    {
      "name": "youtube",
      "icon": "FaYoutube",
      "link": "https://www.youtube.com/@mtsn1pandeglangofficial"
    },
    {
      "name": "instagram",
      "icon": "FaInstagram",
      "link": "https://www.instagram.com/mtsn1_pandeglang"
    },
    {
      "name": "email",
      "icon": "FaEnvelope",
      "link": "mailto:dev@mtsn1pandeglang.sch.id"
    },
    {
      "name": "whatsapp",
      "icon": "FaWhatsapp",
      "link": "https://wa.me/62895351856267/?text=Hallo, PTSP MTs Negeri 1 Pandeglang. 👋"
    }
  ]
}
```

---

### File: `./src/config/theme.json`

```json
{
  "colors": {
    "default": {
      "theme_color": {
        "primary": "#00dc82",
        "body": "#ffffff",
        "border": "#e5e7eb",
        "light": "#f9fafb",
        "dark": "#020420"
      },
      "text_color": {
        "text": "#0f172a",
        "text-dark": "#020420",
        "text-light": "#64748b"
      }
    },
    "darkmode": {
      "theme_color": {
        "primary": "#00dc82",
        "body": "#020420",
        "border": "#1e293b",
        "light": "#0f172a",
        "dark": "#000000"
      },
      "text_color": {
        "text": "#f1f5f9",
        "text-dark": "#ffffff",
        "text-light": "#94a3b8"
      }
    }
  },
  "fonts": {
    "font_family": {
      "primary": "Lexend:wght@400;600;700",
      "primary_type": "sans-serif",
      "secondary": "Lexend:wght@400;500;700",
      "secondary_type": "sans-serif"
    },
    "font_size": {
      "base": "16",
      "scale": "1.2"
    }
  }
}
```

---

### File: `./src/content.config.ts`

```typescript
import { glob } from "astro/loaders";
import { defineCollection, z } from "astro:content";

const commonFields = {
  title: z.string(),
  description: z.string(),
  meta_title: z.string().optional(),
  date: z.date().optional(),
  image: z.string().optional(),
  draft: z.boolean(),
};

const blogCollection = defineCollection({
  loader: glob({ pattern: "**/*.{md,mdx}", base: "src/content/blog" }),
  schema: z.object({
    title: z.string(),
    meta_title: z.string().optional(),
    description: z.string().optional(),
    date: z.date().optional(),
    image: z.string().optional(),
    author: z.string().default("Admin"),
    categories: z.array(z.string()).default(["others"]),
    tags: z.array(z.string()).default(["others"]),
    draft: z.boolean().optional(),
  }),
});

const authorsCollection = defineCollection({
  loader: glob({ pattern: "**/*.{md,mdx}", base: "src/content/authors" }),
  schema: z.object({
    ...commonFields,
    social: z
      .array(
        z
          .object({
            name: z.string().optional(),
            icon: z.string().optional(),
            link: z.string().optional(),
          })
          .optional(),
      )
      .optional(),
    draft: z.boolean().optional(),
  }),
});

const pagesCollection = defineCollection({
  loader: glob({ pattern: "**/*.{md,mdx}", base: "src/content/pages" }),
  schema: z.object({
    ...commonFields,
  }),
});

const aboutCollection = defineCollection({
  loader: glob({ pattern: "**/*.{md,mdx}", base: "src/content/about" }),
  schema: z.object({
    ...commonFields,
  }),
});

const contactCollection = defineCollection({
  loader: glob({ pattern: "**/*.{md,mdx}", base: "src/content/contact" }),
  schema: z.object({
    ...commonFields,
  }),
});

const homepageCollection = defineCollection({
  loader: glob({ pattern: "**/-*.{md,mdx}", base: "src/content/homepage" }),
  schema: z.object({
    banner: z.object({
      title: z.string(),
      content: z.string(),
      image: z.string(),
      button: z.object({
        enable: z.boolean(),
        label: z.string(),
        link: z.string(),
      }),
    }),
    features: z.array(
      z.object({
        title: z.string(),
        image: z.string(),
        content: z.string(),
        bulletpoints: z.array(z.string()),
        button: z.object({
          enable: z.boolean(),
          label: z.string(),
          link: z.string(),
        }),
      }),
    ),
  }),
});

const ctaSectionCollection = defineCollection({
  loader: glob({
    pattern: "call-to-action.{md,mdx}",
    base: "src/content/sections",
  }),
  schema: z.object({
    enable: z.boolean(),
    title: z.string(),
    description: z.string(),
    image: z.string(),
    button: z.object({
      enable: z.boolean(),
      label: z.string(),
      link: z.string(),
    }),
  }),
});

const testimonialSectionCollection = defineCollection({
  loader: glob({
    pattern: "testimonial.{md,mdx}",
    base: "src/content/sections",
  }),
  schema: z.object({
    enable: z.boolean(),
    title: z.string(),
    description: z.string(),
    testimonials: z.array(
      z.object({
        name: z.string(),
        avatar: z.string(),
        designation: z.string(),
        content: z.string(),
      }),
    ),
  }),
});

export const collections = {
  homepage: homepageCollection,
  blog: blogCollection,
  authors: authorsCollection,
  pages: pagesCollection,
  about: aboutCollection,
  contact: contactCollection,
  ctaSection: ctaSectionCollection,
  testimonialSection: testimonialSectionCollection,
};
```

---

### File: `./src/content/about/-index.md`

```markdown
---
title: "Tentang Kami"
meta_title: "Profil MTs Negeri 1 Pandeglang"
description: "MTs Negeri 1 Pandeglang: Inkubator generasi unggul dengan semangat Mandiri, Takwa, Peduli Lingkungan, dan Prestasi."
image: "/images/logo.png"
draft: false
---

### MTs Negeri 1 Pandeglang

**Inkubator Generasi Cendekia & Berkarakter**

---

Kami hadir bukan sekadar sebagai ruang kelas, melainkan sebagai ekosistem pendidikan holistik yang menyatukan tradisi keilmuan dengan kemuliaan adab. Di MTs Negeri 1 Pandeglang, kami merajut kecerdasan intelektual, kematangan spiritual, dan kepekaan sosial dalam satu sinergi yang harmonis.

Identitas kami terukir kokoh dalam empat pilar nilai yang menjadi denyut nadi kehidupan madrasah:

**MANDIRI**
Membangun mentalitas tangguh dan karakter adaptif. Kami menempa siswa untuk memiliki agilitas dalam berpikir dan bertindak, siap menghadapi dinamika zaman dengan kepercayaan diri yang utuh.

**TAKWA**
Menjadikan integritas spiritual sebagai kompas kehidupan. Kami memastikan setiap langkah kemajuan akademik selalu selaras dengan nilai-nilai Ilahiah, mencetak intelektual yang tunduk dan patuh pada Rabb-nya.

**PEDULI LINGKUNGAN**
Sebagai garda terdepan Madrasah Adiwiyata, kami menanamkan kesadaran ekologis yang mendalam. Kami mendidik siswa untuk menjadi khalifah yang amanah, merawat harmoni alam demi keberlanjutan masa depan.

**PRESTASI**
Menciptakan budaya keunggulan tanpa henti. Kami memfasilitasi setiap potensi unik siswa untuk mekar sempurna, mengukir jejak sejarah melalui pencapaian gemilang di kancah nasional maupun global.

---

Melalui dedikasi tenaga pendidik profesional dan transformasi digital yang berkelanjutan, kami berkomitmen mencetak pemimpin masa depan yang paripurna.

> _Mandiri, Takwa, Peduli Lingkungan, Prestasi_
```

---

### File: `./src/content/authors/yahya-zulfikri.md`

```markdown
---
title: Yahya Zulfikri
email: dev@mtsn1pandeglang.sch.id
image: "/images/authors/yahya-zulfikri.png"
description: Lead Developer & System Administrator
social:
  - name: github
    icon: FaGithub
    link: https://github.com/zulfikriyahya

  - name: linkedin
    icon: FaLinkedin
    link: https://www.linkedin.com/in/zulfikriyahya?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app
---

**_Lead Developer & Digital System Architect based in Pandeglang._**

Dedicated to orchestrating digital transformation within the educational sector. With a robust command of modern web technologies, I strive to bridge the gap between complex back-end logic and elegant front-end experiences.

Beyond the code, I am a problem solver committed to building efficient, scalable, and user-centric applications. When not architecting the next system update, you can find me exploring emerging tech trends or enjoying the serene atmosphere of Pandeglang.

_Let's innovate and build the future of education together._
```

---

### File: `./src/content/authors/-index.md`

```markdown
---
title: "Penulis"
meta_title: "Penulis Artikel MTs Negeri 1 Pandeglang"
description: "Penulis Artikel MTs Negeri 1 Pandeglang"
image: ""
draft: false
---
```

---

### File: `./src/content/blog/guest-teacher-session-1.mdx`

```markdown
---
title: "Perkuat Kolaborasi Rumah dan Madrasah, MTsN 1 Pandeglang Gelar Program Guru Tamu"
meta_title: "Perkuat Kolaborasi Rumah dan Madrasah, MTsN 1 Pandeglang Gelar Program Guru Tamu Perdana"
description: "Kolaborasi Rumah – Madrasah untuk Keberhasilan Pendidikan. Program inovatif yang menghadirkan orang tua sebagai guru tamu untuk berbagi pengalaman nyata dunia kerja kepada siswa."
date: 2026-01-08T09:00:00Z
image: "/images/artikel/guest-teacher/banner.jpeg"
categories:
  ["Artikel", "Berita Utama", "Inovasi Pendidikan", "Kolaborasi Orang Tua"]
author: "Yahya Zulfikri"
tags:
  [
    "KolaborasiRumahMadrasah",
    "GuruTamuMTsN1Pandeglang",
    "PembelajaranKontekstual",
    "InspirasiPendidikan",
  ]
draft: false
---

**Pandeglang, 08 Januari 2026** – Suasana belajar di MTs Negeri 1 Pandeglang hari ini terasa begitu istimewa dan penuh energi. Memasuki Tahun Pelajaran 2025–2026, madrasah kebanggaan kita secara resmi meluncurkan program inovatif bertajuk **Guest Teacher Session #1: Program Guru Tamu**.

Mengangkat tema besar **"Kolaborasi Rumah – Madrasah untuk Keberhasilan Pendidikan"**, kegiatan ini menjadi bukti nyata bahwa mendidik generasi bangsa bukan hanya tugas guru di madrasah, melainkan sebuah sinergi indah bersama orang tua di rumah.

### Menghadirkan "Dunia Nyata" ke Ruang Kelas

Program inovatif ini melibatkan satu orang perwakilan orang tua atau wali siswa dari setiap kelas untuk berperan sebagai guru tamu (guest teacher) di kelas anak mereka masing-masing. Selama 80 menit (2 jam pelajaran), para orang tua berbagi pengalaman nyata mengenai profesi, tantangan kerja, serta pelajaran hidup yang inspiratif kepada para siswa.
Materi yang disampaikan dirancang secara khusus agar relevan dengan dunia kerja, sehingga siswa dapat memahami manfaat langsung dari pelajaran yang mereka terima di sekolah dalam kehidupan sehari-hari.

#### Mengapa Program Ini Begitu Berarti?

Kepala MTsN 1 Pandeglang, **H. Eman Sulaiman, S.Ag., M.Pd.**, menekankan bahwa program ini adalah cara terbaik memberikan pengalaman belajar yang **kontekstual dan bermakna**.

> "Kita ingin siswa tidak hanya terpaku pada teori di buku teks. Dengan menghadirkan orang tua sebagai praktisi, siswa bisa melihat langsung bagaimana ilmu yang mereka pelajari di kelas diaplikasikan dalam dunia kerja. Cerita sukses dan tantangan dari para orang tua akan menjadi kompas berharga bagi masa depan mereka."
>
> — **H. Eman Sulaiman, S.Ag., M.Pd.** (_Kepala MTsN 1 Pandeglang_)

### Momen Berharga: 80 Menit yang Menggugah Semangat

Kemeriahan dimulai sejak pagi. Sebelum memasuki ruang kelas pada pukul 08.10 WIB, para guru tamu berkumpul hangat di **Ruang PPDB** untuk mengikuti pembukaan singkat bersama Koordinator Bidang Akademik, **Mahbudin, S.Pd.I., M.Pd.**

#### Bukan Sekadar Materi, Tapi Berbagi Hati

<div
  style={{
    display: "flex",
    flexWrap: "wrap",
    gap: "16px",
    marginBottom: "24px",
  }}
>
  <div style={{ flex: "1 1 320px", aspectRatio: "16/9" }}>
    <Video width="100%" src="artikel/guest-teacher/session-1.mp4" />
  </div>
</div>

Materi yang disampaikan sangat kaya karena lahir dari latar belakang profesi yang beragam. Para guru tamu tidak hanya bicara soal tugas pekerjaan, tetapi juga menyentuh aspek emosional dan karakter:

1. **Jejak Langkah** – Perkenalan diri dan latar belakang pendidikan.
2. **Kisah di Balik Layar** – Cerita masa sekolah/madrasah, kegagalan yang pernah dialami, hingga bagaimana mereka bangkit kembali.
3. **Wawasan Profesional** – Realita dunia kerja, keterampilan yang dibutuhkan, hingga peluang karier di masa depan.
4. **Pesan Cinta** – Wejangan tulus untuk memotivasi peserta didik.
5. **Dialog Interaktif** – Sesi tanya jawab yang seru dan refleksi bersama.

Siswa tampak terpaku menyimak kisah jatuh bangun, nilai kejujuran, serta disiplin yang menjadi kunci sukses para orang tua mereka.

### Dampak Nyata: Lebih dari Sekadar Belajar

Program ini meninggalkan jejak positif bagi perkembangan mental dan akademik siswa:

- **Belajar dari Sang Praktisi:** Siswa mendapatkan wawasan autentik yang tidak ditemukan di lembar modul manapun.
- **Menemukan "Why" dalam Belajar:** Mereka mulai paham mengapa harus belajar matematika, bahasa, atau agama, karena melihat langsung manfaatnya di masa depan.
- **Bangga dan Termotivasi:** Ada binar bangga di mata siswa saat melihat orang tua mereka (atau orang tua temannya) berbagi ilmu. Ini adalah _booster_ kepercayaan diri yang luar biasa.
- **Cakrawala Baru:** Membuka mata siswa bahwa pilihan masa depan itu luas dan menantang untuk diraih.

### Mempererat Ikatan: Madrasah, Rumah, dan Masyarakat

Keberhasilan acara perdana ini adalah buah manis dari kerja keras para **Wali Kelas** yang telah mengkurasi orang tua hebat sebagai narasumber. Kepala TU MTsN 1 Pandeglang, **Umar Mu'tamar, S.Ag.**, menyambut hangat kolaborasi ini sebagai energi baru bagi madrasah.

> "Ini adalah langkah awal dari penguatan kolaborasi segitiga emas: Rumah, Madrasah, dan Masyarakat. Dukungan orang tua adalah ruh bagi keberhasilan pendidikan siswa, baik dalam aspek kognitif maupun pembentukan karakter."
>
> — **Umar Mu'tamar, S.Ag.** (_Kepala TU MTsN 1 Pandeglang_)

### Wujud Sinergi Madrasah dan Orang Tua

Pihak madrasah menekankan bahwa keberhasilan pendidikan siswa sangat bergantung pada dukungan dan keterlibatan aktif orang tua. Program ini merupakan langkah awal yang strategis dalam memperkuat kolaborasi antara Madrasah, Rumah, dan Masyarakat.
"Madrasah berharap program ini dapat meningkatkan kualitas pembelajaran melalui kolaborasi yang nyata antara pihak madrasah dan orang tua siswa," tutup Mahbudin.

### Menatap Masa Depan yang Lebih Cerah

Dengan berakhirnya **Guest Teacher Session #1**, MTsN 1 Pandeglang menegaskan komitmennya untuk menjadi madrasah yang **adaptif dan inklusif**. Ke depan, sesi-sesi lanjutan dengan tema yang lebih beragam sudah menanti untuk dieksplorasi.

#### Apresiasi Setinggi-tingginya

Terima kasih kami haturkan kepada:

- **Seluruh Orang Tua** yang telah meluangkan waktu berharga untuk berbagi inspirasi.
- **Bapak/Ibu Wali Kelas** atas koordinasi yang luar biasa.
- **Tim Akademik** sebagai dirigen utama program ini.
- **Seluruh Siswa** yang telah menyambut guru tamu mereka dengan penuh antusias.

**Mari Bersinergi untuk Pendidikan Terbaik**

_Bagaimana kesan Bapak/Ibu mengenai program ini? Apakah ada profesi tertentu yang ingin Bapak/Ibu lihat di sesi berikutnya? Tuliskan aspirasi Anda di kolom komentar di bawah ini! Mari terus bergandengan tangan demi masa depan putra-putri kita._

**Tim Redaksi:**

- **Penulis:** Yahya Zulfikri
- **Editor:** Tim Humas MTsN 1 Pandeglang
- **Whatsapp:** [WhatsApp PTSP](https://wa.me/62895351856267)
- **Instagram** [@mtsn1_pandeglang](https://www.instagram.com/reel/DTRj60-kZvW/?igsh=MWkxZzFrejYzOXJzbA==)
```

---

### File: `./src/content/blog/laporan-analisis-komprehensif-website-sekolah-indonesia.mdx`

````markdown
---
title: "Laporan Analisis Komprehensif Website Sekolah Indonesia"
meta_title: "Laporan Analisis Komprehensif Website Sekolah Indonesia"
description: "Laporan Analisis Komprehensif Website Sekolah Indonesia"
date: 2025-01-10T08:00:00Z
image: "/images/assets/banner.png"
categories: ["Artikel"]
author: "Yahya Zulfikri"
tags: ["Analisis Website"]
draft: false
---

## Laporan Prestasi

**Website MTs Negeri 1 Pandeglang mendapat nilai A+ dan masuk Top 5 se-Indonesia!**

| Yang Dinilai               | Peringkat                   | Nilai   | Keterangan                           |
| -------------------------- | --------------------------- | ------- | ------------------------------------ |
| **Kecepatan**              | **Juara 4** dari 19 sekolah | 97/100  | Lebih cepat dari 95% website sekolah |
| **Keamanan**               | **Juara 1** dari 20 sekolah | 100/100 | Paling aman se-Indonesia!            |
| **SEO** (Tampil di Google) | **Juara 3** dari 20 sekolah | 95/100  | Mudah ditemukan di pencarian         |
| **Hemat Biaya**            | **Juara 2** dari 20 sekolah | 98/100  | Performa bagus, biaya murah          |

---

## Apa Artinya Ini?

### 1. **Website Super Cepat**

- Halaman website terbuka dalam **0.8 detik** (kurang dari 1 detik!)
- **10x lebih cepat** dari website madrasah lain
- **5x lebih cepat** dari website SMA Negeri pada umumnya

**Perbandingan:**

- Website MTs N 1 Pandeglang: **0.8 detik**
- Website madrasah lainnya: **8 detik**
- Website SMA biasa: **4.5 detik**

> **Bayangkan:** Orang tua/siswa membuka website, langsung tampil! Sementara website lain masih loading.

---

### 2. **Keamanan Maksimal**

**Nilai Keamanan: 100/100 (Sempurna!)**

Artinya:

- **Tidak bisa diretas** oleh hacker
- **Data pengunjung aman**
- **Tidak ada virus** atau malware
- **Tidak ada iklan mencurigakan**

**Mengapa aman?**
Website ini menggunakan teknologi "Static Site" (website statis) - seperti rumah tanpa pintu masuk untuk maling. Hacker tidak punya celah untuk masuk!

**Perbandingan dengan sekolah lain:**

- 60% website sekolah menggunakan sistem yang mudah diretas
- Banyak website sekolah yang sudah pernah kena hack
- Website MTs N 1 Pandeglang: **Mustahil diretas**

---

### 3. **Mudah Ditemukan di Google**

**Nilai SEO: 95/100**

Ketika orang mencari:

- "Madrasah di Pandeglang"
- "MTs terbaik Banten"
- "Sekolah Islam Pandeglang"

**Website muncul di halaman pertama Google!**

---

### 4. **Hemat Biaya**

| Website               | Biaya/Tahun       | Kecepatan  | Keamanan    |
| --------------------- | ----------------- | ---------- | ----------- |
| **MTs N 1 PDG**       | **Rp 10-30 juta** | **97/100** | **100/100** |
| Website Internasional | Rp 100-200 juta   | 100/100    | 95/100      |
| Website SMA biasa     | Rp 8-15 juta      | 50/100     | 45/100      |

**Kesimpulan:** Performa setara sekolah internasional, tapi biaya 5-10x lebih murah!

---

## Posisi Website

```
Tier SS (Super Elite) - Sekolah Internasional Mahal
├─ Budget: Rp 100-200 juta/tahun
└─ Contoh: Singapore International School
         ▼
Tier S (Professional) - TOP 5% INDONESIA
├─ MTs Negeri 1 Pandeglang
├─ Budget: Rp 10-30 juta/tahun
├─ Kecepatan: 0.8 detik
└─ Keamanan: 100% aman
         ▼
Tier A (Bagus) - SMA Negeri Terbaik
├─ Budget: Rp 10-30 juta/tahun
├─ Kecepatan: 2.5 detik
└─ Keamanan: 65% aman
         ▼
Tier B (Standar) - Mayoritas Sekolah Negeri
├─ Budget: Rp 8-15 juta/tahun
├─ Kecepatan: 4.5 detik
└─ Keamanan: 45% aman
         ▼
Tier C (Di Bawah Standar) - 60% Sekolah
├─ Budget: Rp 2-5 juta/tahun
├─ Kecepatan: 8-12 detik (sangat lambat!)
└─ Keamanan: 15% aman (bahaya!)
```

---

## Keunggulan Dibanding Sekolah Lain

### Versus Madrasah Lain

- **10x lebih cepat**
- **20x lebih aman**
- **Teknologi 10 tahun lebih maju**
- Biaya hanya 2-3x lebih mahal (worth it!)

### Versus SMA Negeri

- **5x lebih cepat**
- **3x lebih aman**
- **Teknologi 5 tahun lebih maju**
- Biaya hampir sama

### Versus Sekolah Internasional

- Kecepatan **setara**
- Keamanan **setara**
- Teknologi **modern**
- Biaya **5-10x lebih murah**

---

## Teknologi yang Digunakan

**Sistem yang dipilih: Astro + React (Teknologi Terkini 2025)**

### Mengapa Ini Pilihan Terbaik?

**1. Astro Framework**

- Teknologi terbaru dari Amerika
- Digunakan oleh perusahaan besar seperti Google, Microsoft
- Menghasilkan website super cepat

**2. React**

- Teknologi dari Facebook/Meta
- Paling populer di dunia (digunakan oleh Instagram, Netflix)
- Membuat website interaktif dan modern

**3. TailwindCSS**

- Sistem desain modern
- Tampilan responsif (bagus di HP & komputer)
- Mudah diupdate

### Fitur-Fitur Modern

**PWA (Progressive Web App)**

- Website bisa dibuka offline
- Bisa di-install seperti aplikasi di HP
- Notifikasi push (jika diperlukan)

**Dark Mode**

- Mode gelap untuk hemat baterai
- Nyaman di mata saat malam hari

**Responsive Design**

- Tampilan sempurna di HP
- Tampilan sempurna di tablet
- Tampilan sempurna di komputer

**Cepat & Ringan**

- Loading cepat meski internet lambat
- Hemat kuota internet

---

## Pengalaman Pengguna

### Saat Orang Tua/Siswa Membuka Website

**Website Biasa (8 detik):**

```
0 detik  → Klik link
1 detik  → Loading...
2 detik  → Loading...
3 detik  → Loading...
4 detik  → Loading...
5 detik  → Loading...
6 detik  → Loading...
7 detik  → Loading...
8 detik  → Akhirnya muncul! (tapi pengunjung sudah males)
```

**Website MTs N 1 Pandeglang (0.8 detik):**

```
0 detik  → Klik link
0.8 detik → Langsung muncul sempurna!
```

> **Fakta:** 53% pengunjung akan meninggalkan website jika loading lebih dari 3 detik!

---

## Kenapa Keamanan Penting?

### Bahaya Website Tidak Aman

**Website Diretas**

- Data sekolah dicuri
- Website diganti isinya (defacing)
- Nama sekolah jadi buruk

  **Malware/Virus**

- Komputer pengunjung bisa kena virus
- Data pribadi bisa dicuri
- Orang tua tidak percaya

  **Data Bocor**

- Informasi siswa tersebar
- Nomor telepon disalahgunakan
- Privasi terganggu

### Solusi Website MTs N 1 Pandeglang

**Static Site Security**

- Tidak ada database yang bisa diretas
- Tidak ada sistem login yang bisa dibobol
- Tidak ada file upload yang berbahaya

  **HTTPS Enforced**

- Semua data terenkripsi
- Aman dari penyadapan

  **Regular Updates**

- Sistem selalu update
- Bug keamanan langsung diperbaiki

---

## Rekomendasi

### Yang HARUS Dilakukan (Wajib)

**1. Maintenance Rutin** (15 menit/bulan)

- Cek website masih jalan baik
- Update konten berita/pengumuman
- Biaya: Sudah termasuk dalam paket

**2. Backup Otomatis** (Sudah jalan)

- Data website tersimpan aman
- Jika ada masalah, bisa dikembalikan
- Tidak perlu action tambahan

**3. Update Konten** (30 menit/minggu)

- Upload berita terbaru
- Update info PPDB
- Upload foto kegiatan
- **Ini yang paling penting untuk SEO!**

### Yang TIDAK Perlu (Belum)

**Jangan upgrade teknologi dulu!**

Alasan:

- Sudah bagus banget (Top 4 se-Indonesia)
- Upgrade hanya menambah 0.2-0.4 detik (tidak terasa)
- Biaya upgrade mahal
- Maintenance jadi ribet

**Website sudah SEMPURNA untuk kebutuhan sekolah!**

---

## Rencana 3 Tahun ke Depan

### Tahun 1 (Sekarang)

- **Status:** Optimal
- **Budget:** Rp 15 juta/tahun
- **Fitur:** Blog, PWA, Search
- **Nilai:** 97/100
- **Action:** Maintain & update konten

### Tahun 2 (Jika Butuh Fitur Tambahan)

- **Upgrade:** Tambah sistem login (opsional)
- **Budget:** +Rp 10 juta (total Rp 25 juta)
- **Fitur Baru:**
  - Portal siswa
  - Portal guru
  - Database nilai (jika diperlukan)
- **Nilai:** 95/100 (turun sedikit, tapi fitur bertambah)

### Tahun 3 (Full Portal)

- **Upgrade:** Sistem sekolah lengkap
- **Budget:** +Rp 15 juta (total Rp 40 juta)
- **Fitur Baru:**
  - E-learning/LMS
  - Sistem pembayaran online
  - Aplikasi absensi
- **Nilai:** 93/100

**Rekomendasi:** Tetap di Tahun 1 dulu sampai benar-benar butuh fitur tambahan!

---

## Kesimpulan

### Website MTs Negeri 1 Pandeglang:

- **Juara 4 Tercepat** se-Indonesia
- **Juara 1 Teraman** di semua kategori
- **Juara 1** di kalangan Madrasah se-Indonesia
- **Juara 2** paling hemat biaya (ROI terbaik)

### Kata Kunci Prestasi:

- **10x lebih cepat** dari madrasah lain
- **100x lebih aman** dari website sekolah biasa
- **5x lebih murah** dari sekolah internasional dengan performa setara
- **Teknologi 2025** yang modern dan masa depan

---

## Pesan untuk Pimpinan Sekolah

**Selamat! Website sudah sangat baik.**

Yang perlu dilakukan:

1.  Jaga kualitas konten (update rutin)
2.  Manfaatkan untuk promosi PPDB
3.  Gunakan untuk membangun brand image
4.  Maintenance rutin (sudah mudah)

Yang TIDAK perlu:

1.  Upgrade teknologi (sudah optimal)
2.  Tambah fitur yang tidak dipakai
3.  Ganti sistem (buang-buang uang)

**Website ini adalah investasi jangka panjang yang sangat bagus untuk sekolah!**

---

## Kontak & Support

**Untuk pertanyaan teknis atau bantuan:**

- Developer: Yahya Zulfikri
- Maintenance: Rutin setiap bulan
- Emergency: Response dalam 24 jam

**Catatan Penting:**
Website ini sudah sangat baik dan tidak perlu perubahan besar. Focus pada konten dan promosi, bukan pada teknologi.

---

- **Laporan dibuat:** 10 Januari 2025
- **Website:** mtsn1pandeglang.sch.id
- **Teknologi:** Astro 5.16.6 + React 19.2.0 + TailwindCSS 4.1.14
- **Status:** Optimal - No Action Required

**Tim Redaksi:**

- **Penulis:** Yahya Zulfikri
- **Editor:** Tim Humas MTsN 1 Pandeglang
- **Whatsapp:** [WhatsApp PTSP](https://wa.me/62895351856267)
````

---

### File: `./src/content/blog/plp-kkn-uin-banten-2025.mdx`

```markdown
---
title: "Implementasi Program PLP Integratif Mahasiswa UIN Sultan Maulana Hasanuddin Banten di MTs Negeri 1 Pandeglang Tahun 2025"
meta_title: "Implementasi Program PLP Integratif Mahasiswa UIN Sultan Maulana Hasanuddin Banten di MTs Negeri 1 Pandeglang"
description: "Laporan komprehensif pelaksanaan Pengenalan Lapangan Persekolahan (PLP) - Kuliah Kerja Nyata (KKN) Integratif mahasiswa UIN Banten di MTs Negeri 1 Pandeglang periode Agustus - Oktober 2025"
date: 2025-10-17T08:00:00Z
image: "/images/artikel/plp-kkn/2025/uin-banten/kegiatan-2.png"
categories: ["UIN Banten", "PLP", "KKN", "Kegiatan Mahasiswa"]
author: "Yahya Zulfikri"
tags: ["UINBanten", "KegiatanMahasiswa", "PLP", "KKN"]
draft: false
---

Pengenalan Lapangan Persekolahan (PLP) - Kuliah Kerja Nyata (KKN) Integratif merupakan komponen esensial dalam sistem pendidikan tinggi yang bertujuan mengintegrasikan teori dengan praktik lapangan. Artikel ini menguraikan implementasi program PLP Integratif mahasiswa Universitas Islam Negeri (UIN) Sultan Maulana Hasanuddin Banten di Madrasah Tsanawiyah Negeri (MTs N) 1 Pandeglang selama periode Agustus hingga Oktober 2025. Program ini melibatkan mahasiswa dari berbagai program studi yang melaksanakan kegiatan pembelajaran, pembinaan ekstrakurikuler, serta pengabdian kepada masyarakat madrasah. Hasil evaluasi menunjukkan bahwa kegiatan ini memberikan kontribusi signifikan terhadap pengembangan kompetensi mahasiswa sebagai calon pendidik profesional, sekaligus meningkatkan kualitas pembelajaran di lembaga mitra.

<Notice type="note">
  **Kata Kunci:** Pengenalan Lapangan Persekolahan, Kuliah Kerja Nyata,
  Pendidikan Keguruan, MTs Negeri 1 Pandeglang, UIN Banten
</Notice>

---

## Pendahuluan

### Latar Belakang

Perguruan tinggi sebagai institusi pendidikan memiliki tanggung jawab dalam mencetak lulusan yang kompeten dan siap menghadapi tantangan dunia kerja. Dalam konteks pendidikan keguruan, pengalaman lapangan menjadi elemen krusial dalam membentuk kompetensi pedagogik, profesional, kepribadian, dan sosial calon pendidik (Darling-Hammond, 2006). Pengenalan Lapangan Persekolahan (PLP) - Kuliah Kerja Nyata (KKN) Integratif merupakan manifestasi dari pendekatan experiential learning yang memungkinkan mahasiswa mengaplikasikan pengetahuan teoretis dalam situasi riil di lapangan.

Universitas Islam Negeri (UIN) Sultan Maulana Hasanuddin Banten, sebagai salah satu perguruan tinggi Islam terkemuka di Provinsi Banten, secara konsisten menyelenggarakan program PLP Integratif sebagai bagian integral dari kurikulum akademik. Program ini dirancang untuk memberikan pengalaman autentik kepada mahasiswa dalam konteks pembelajaran di lembaga pendidikan formal, khususnya madrasah.

MTs Negeri 1 Pandeglang dipilih sebagai mitra dalam pelaksanaan program PLP Integratif periode Agustus hingga Oktober 2025 berdasarkan pertimbangan akreditasi madrasah yang baik, lokasi strategis, serta kesediaan pihak madrasah untuk berkolaborasi dalam pengembangan pendidikan. Kolaborasi ini diharapkan dapat menghasilkan sinergi positif antara perguruan tinggi dengan lembaga pendidikan menengah dalam mewujudkan peningkatan mutu pendidikan nasional.

### Tujuan Program

Pelaksanaan program PLP Integratif di MTs Negeri 1 Pandeglang memiliki tujuan komprehensif yang mencakup aspek akademik, profesional, dan sosial, antara lain:

**Aspek Pengembangan Kompetensi Mahasiswa:**
Mengembangkan kompetensi pedagogik mahasiswa melalui praktik pembelajaran langsung di kelas dengan supervisi guru pamong dan dosen pembimbing lapangan. Meningkatkan kemampuan profesional mahasiswa dalam merancang, melaksanakan, dan mengevaluasi pembelajaran yang efektif dan inovatif. Membangun karakter kepribadian yang kuat sebagai calon pendidik yang berintegritas, disiplin, dan bertanggung jawab. Mengasah kompetensi sosial melalui interaksi dengan berbagai stakeholder pendidikan, termasuk peserta didik, guru, tenaga kependidikan, dan masyarakat madrasah.

**Aspek Kontribusi kepada Lembaga Mitra:**
Memberikan dukungan tenaga pendamping dalam kegiatan pembelajaran dan administrasi madrasah. Menghadirkan inovasi pembelajaran melalui penerapan metode, strategi, dan media pembelajaran berbasis teknologi dan pendekatan kontemporer. Memperkuat program ekstrakurikuler dan kegiatan pembinaan karakter peserta didik. Memfasilitasi transfer pengetahuan terkini dari perguruan tinggi ke lembaga pendidikan menengah.

**Aspek Pengabdian kepada Masyarakat:**
Melaksanakan program-program pengayaan akademik bagi peserta didik yang membutuhkan pendampingan khusus. Menyelenggarakan kegiatan sosial kemasyarakatan yang memberikan manfaat langsung kepada warga madrasah dan masyarakat sekitar. Memperkuat kemitraan strategis antara UIN Banten dengan lembaga pendidikan di wilayah Pandeglang.

---

## Profil Lembaga Mitra

### Madrasah Tsanawiyah Negeri 1 Pandeglang

MTs Negeri 1 Pandeglang merupakan lembaga pendidikan menengah pertama berbasis keislaman yang berada di bawah pembinaan Kementerian Agama Republik Indonesia. Madrasah ini telah terakreditasi dengan baik dan memiliki reputasi sebagai salah satu institusi pendidikan berkualitas di Kabupaten Pandeglang. Dengan didukung oleh tenaga pendidik yang kompeten dan fasilitas pembelajaran yang memadai, madrasah ini terus berkomitmen untuk menghasilkan lulusan yang unggul dalam prestasi akademik dan berakhlak mulia.

Lokasi madrasah yang strategis memudahkan akses bagi mahasiswa praktikan, sementara iklim akademik yang kondusif menciptakan lingkungan pembelajaran yang optimal. Kerja sama antara MTs Negeri 1 Pandeglang dengan UIN Banten telah terjalin cukup lama, menjadikan madrasah ini sebagai mitra yang ideal untuk pelaksanaan program PLP Integratif.

### Visi dan Misi Madrasah

Visi madrasah adalah mewujudkan lembaga pendidikan Islam yang unggul, berakhlak mulia, dan berwawasan global. Misi madrasah mencakup penyelenggaraan pembelajaran yang berkualitas, pembinaan karakter Islami, pengembangan potensi peserta didik secara holistik, serta pemberdayaan seluruh komponen madrasah untuk terus berinovasi dalam bidang pendidikan.

---

## Metodologi Pelaksanaan Program

### Tahap Persiapan

Tahap persiapan dimulai dengan koordinasi antara pihak UIN Banten dengan MTs Negeri 1 Pandeglang untuk menyepakati mekanisme pelaksanaan, jadwal kegiatan, dan pembagian tugas. Mahasiswa peserta program mengikuti pembekalan yang diselenggarakan oleh fakultas, meliputi orientasi tentang kompetensi guru, teknik pembelajaran efektif, manajemen kelas, serta etika profesi kependidikan. Pembekalan ini juga mencakup penjelasan mengenai administrasi PLP Integratif, termasuk penyusunan laporan dan instrumen evaluasi.

### Tahap Observasi

Pada minggu pertama, mahasiswa melakukan observasi komprehensif terhadap lingkungan madrasah, karakteristik peserta didik, proses pembelajaran di kelas, serta sistem administrasi madrasah. Observasi ini menjadi dasar penting dalam merancang strategi pembelajaran yang sesuai dengan kondisi riil di lapangan. Mahasiswa juga berkonsultasi dengan guru pamong untuk memahami kurikulum, silabus, dan capaian pembelajaran yang harus dicapai.

### Tahap Pelaksanaan

Tahap pelaksanaan mencakup kegiatan PLP Integratif yang dilaksanakan secara terintegrasi. Pada kegiatan PLP, mahasiswa melakukan praktik pembelajaran terbimbing dan mandiri sesuai dengan bidang studi masing-masing. Setiap mahasiswa ditugaskan untuk mengajar minimal 8 kali pertemuan dengan supervisi guru pamong dan dosen pembimbing lapangan. Kegiatan KKN difokuskan pada program pengabdian masyarakat, pembinaan ekstrakurikuler, dan pendampingan akademik di luar jam pembelajaran formal.

### Tahap Evaluasi dan Pelaporan

Setiap kegiatan pembelajaran dievaluasi menggunakan instrumen yang telah disiapkan. Evaluasi dilakukan oleh guru pamong dan dosen pembimbing, mencakup aspek perencanaan pembelajaran, pelaksanaan pembelajaran, pengelolaan kelas, penggunaan media dan metode, serta penilaian hasil belajar. Mahasiswa juga melakukan refleksi diri untuk mengidentifikasi kekuatan dan area yang perlu ditingkatkan. Pada akhir program, mahasiswa menyusun laporan komprehensif yang mencakup deskripsi kegiatan, analisis hasil, refleksi, dan rekomendasi.

---

## Pengenalan Lapangan Persekolahan (PLP)

### Perencanaan Pembelajaran

Mahasiswa menyusun perangkat pembelajaran yang komprehensif, meliputi analisis kurikulum, pemetaan Kompetensi Inti (KI) dan Kompetensi Dasar (KD), penyusunan Rencana Pelaksanaan Pembelajaran (RPP), pengembangan media pembelajaran, dan desain instrumen penilaian. Perangkat pembelajaran ini dikonsultasikan secara intensif dengan guru pamong dan dosen pembimbing untuk memastikan kesesuaiannya dengan standar pendidikan nasional dan karakteristik peserta didik di MTs Negeri 1 Pandeglang.

Dalam penyusunan RPP, mahasiswa mengintegrasikan berbagai pendekatan pembelajaran modern, seperti pembelajaran berbasis masalah (problem-based learning), pembelajaran kooperatif (cooperative learning), dan pembelajaran kontekstual (contextual teaching and learning). Media pembelajaran yang dikembangkan memanfaatkan teknologi informasi dan komunikasi, seperti presentasi multimedia, video pembelajaran, dan aplikasi edukatif yang relevan dengan materi ajar.

### Pelaksanaan Pembelajaran

Praktik pembelajaran dilaksanakan di kelas-kelas yang telah ditentukan sesuai dengan bidang studi mahasiswa. Mahasiswa menerapkan berbagai strategi pembelajaran untuk menciptakan suasana belajar yang aktif, inovatif, kreatif, efektif, dan menyenangkan (PAIKEM). Implementasi pembelajaran mencakup kegiatan pendahuluan (apersepsi dan motivasi), kegiatan inti (eksplorasi, elaborasi, dan konfirmasi), serta kegiatan penutup (refleksi dan tindak lanjut).

Dalam pelaksanaan pembelajaran, mahasiswa juga mengembangkan keterampilan bertanya, keterampilan menjelaskan, keterampilan mengelola kelas, dan keterampilan melaksanakan variasi dalam pembelajaran. Interaksi pedagogis yang terbangun antara mahasiswa praktikan dengan peserta didik mencerminkan prinsip-prinsip pembelajaran yang berpusat pada siswa (student-centered learning).

### Evaluasi Pembelajaran

Mahasiswa melakukan evaluasi pembelajaran secara formatif dan sumatif untuk mengukur pencapaian kompetensi peserta didik. Evaluasi formatif dilakukan selama proses pembelajaran berlangsung melalui observasi, tanya jawab, dan penugasan. Evaluasi sumatif dilaksanakan pada akhir pembelajaran dalam bentuk tes tertulis, tes lisan, atau penilaian kinerja sesuai dengan karakteristik kompetensi yang diukur. Hasil evaluasi dianalisis untuk memberikan umpan balik kepada peserta didik dan menjadi bahan refleksi bagi mahasiswa dalam memperbaiki praktik pembelajaran selanjutnya.

---

## Kegiatan Kuliah Kerja Nyata (KKN)

### Program Pembinaan Akademik

Mahasiswa menyelenggarakan program bimbingan belajar (bimbel) bagi peserta didik yang membutuhkan pendampingan akademik tambahan. Bimbingan belajar difokuskan pada mata pelajaran yang dianggap sulit oleh peserta didik, seperti matematika, IPA, bahasa Arab, dan bahasa Inggris. Kegiatan ini dilaksanakan di luar jam pelajaran formal dengan metode pembelajaran yang lebih personal dan disesuaikan dengan kebutuhan individual peserta didik.

### Program Pembinaan Ekstrakurikuler

Mahasiswa terlibat aktif dalam pembinaan kegiatan ekstrakurikuler madrasah, seperti pramuka, olahraga, seni dan budaya, jurnalistik, serta tilawah Al-Qur'an. Keterlibatan mahasiswa memberikan dinamika baru dalam kegiatan ekstrakurikuler dan membantu mengembangkan bakat serta minat peserta didik di luar pembelajaran akademik formal. Mahasiswa juga membantu merancang program kegiatan ekstrakurikuler yang lebih terstruktur dan berorientasi pada pengembangan soft skills peserta didik.

### Program Pengabdian Sosial Kemasyarakatan

Sebagai implementasi nilai-nilai pengabdian kepada masyarakat, mahasiswa melaksanakan berbagai program sosial, antara lain: bakti sosial pembersihan lingkungan madrasah, penyuluhan kesehatan dan kebersihan, program literasi dan donasi buku, serta kegiatan keagamaan bersama warga madrasah. Program-program ini dirancang untuk memberikan manfaat langsung kepada masyarakat madrasah dan memperkuat fungsi madrasah sebagai pusat pengembangan masyarakat.

### Dukungan Administrasi Madrasah

Mahasiswa juga memberikan kontribusi dalam kegiatan administrasi madrasah, seperti pengelolaan perpustakaan, pemutakhiran data peserta didik, dokumentasi kegiatan madrasah, serta penyusunan bahan ajar dan media pembelajaran. Dukungan ini membantu meringankan beban administratif guru dan tenaga kependidikan, sekaligus memberikan pembelajaran praktis bagi mahasiswa tentang manajemen pendidikan.

---

## Profil Mahasiswa Peserta PLP Integratif

Berikut adalah daftar mahasiswa UIN Sultan Maulana Hasanuddin Banten yang melaksanakan kegiatan PLP Integratif di MTs Negeri 1 Pandeglang periode Agustus - Oktober 2025:

import ProfilMahasiswaPLP from "@/helpers/ProfilMahasiswaPLP";

<ProfilMahasiswaPLP client:load />

---

| No  | Nama Lengkap                  |    NIM    | Program Studi                    | Guru Pembimbing               |
| :-: | :---------------------------- | :-------: | :------------------------------- | :---------------------------- |
|  1  | **Siti Arifah**               | 221250030 | Manajemen Pendidikan Islam (MPI) | **Mahbudin, M.Pd.**           |
|  2  | **Ine Febriyanti**            | 221250031 | Manajemen Pendidikan Islam (MPI) | **Mahbudin, M.Pd.**           |
|  3  | **Muhammad Faqih Abdul Wafa** | 221210172 | Pendidikan Agama Islam (PAI)     | **Euis Sofi Sulasiah, M.Pd.** |
|  4  | **Rihadatul A'isy**           | 221210007 | Pendidikan Agama Islam (PAI)     | **Euis Sofi Sulasiah, M.Pd.** |
|  5  | **Muhammad Abdullah**         | 221210118 | Pendidikan Agama Islam (PAI)     | **H. Solichul Hadi M.Ag.**    |
|  6  | **Siti Khoirunisa**           | 221210100 | Pendidikan Agama Islam (PAI)     | **H. Solichul Hadi M.Ag.**    |
|  7  | **Nur Indah Isnaini**         | 221210020 | Pendidikan Agama Islam (PAI)     | **Siti Wahidoh, S.Pd.I.**     |
|  8  | **Susi Susilawati**           | 221220017 | Pendidikan Bahasa Arab (PBA)     | **Aam Amalia, S.Pd.I.**       |
|  9  | **Aulia Al Qisti Nazifah**    | 221220026 | Pendidikan Bahasa Arab (PBA)     | **Aam Amalia, S.Pd.I.**       |
| 10  | **Linda Mutia Rahmah**        | 221220060 | Pendidikan Bahasa Arab (PBA)     | **Siti maryam, S.Pd.I.**      |
| 11  | **Pia Fatmawati**             | 221220075 | Pendidikan Bahasa Arab (PBA)     | **Siti maryam, S.Pd.I.**      |
| 12  | **Hafidz Dian Nugraha**       | 221220077 | Pendidikan Bahasa Arab (PBA)     | **Siti maryam, S.Pd.I.**      |
| 13  | **Amalia Fatihah**            | 221230073 | Tadris Bahasa Inggris (TBI)      | **Mahbudin, M.Pd.**           |
| 14  | **Alfina Husna Azkia**        | 221230074 | Tadris Bahasa Inggris (TBI)      | **Endah Humaedah, M.Pd.**     |
| 15  | **Muhoiriah**                 | 221230075 | Tadris Bahasa Inggris (TBI)      | **Endah Humaedah, M.Pd.**     |
| 16  | **Nina Isnaiyah**             | 221230077 | Tadris Bahasa Inggris (TBI)      | **Cucu Wakiah, S.Pd.**        |
| 17  | **Khoirotunnisa**             | 221230142 | Tadris Bahasa Inggris (TBI)      | **Cucu Wakiah, S.Pd.**        |

<Notice type="note">
  **Catatan:** Data mahasiswa di atas merupakan peserta program PLP Integratif
  yang telah menyelesaikan seluruh rangkaian kegiatan dengan baik.
</Notice>

---

## Hasil dan Capaian Program

### Capaian Akademik Mahasiswa

Berdasarkan evaluasi yang dilakukan oleh guru pamong dan dosen pembimbing lapangan, seluruh mahasiswa peserta program menunjukkan perkembangan yang signifikan dalam penguasaan kompetensi keguruan. Kompetensi pedagogik mahasiswa meningkat, tercermin dari kemampuan mereka dalam merancang pembelajaran yang sistematis, mengelola kelas secara efektif, dan melaksanakan evaluasi pembelajaran yang komprehensif. Kompetensi profesional juga berkembang, ditandai dengan penguasaan materi ajar yang mendalam dan kemampuan mengintegrasikan pengetahuan teoretis dengan praktik pembelajaran.

Dari aspek kepribadian, mahasiswa menunjukkan sikap profesional, disiplin, bertanggung jawab, dan memiliki etos kerja yang tinggi. Kompetensi sosial mahasiswa juga meningkat, terlihat dari kemampuan mereka berkomunikasi secara efektif dengan berbagai pihak, bekerja sama dalam tim, dan beradaptasi dengan lingkungan madrasah.

### Dampak terhadap Madrasah

Kehadiran mahasiswa praktikan memberikan dampak positif bagi MTs Negeri 1 Pandeglang. Program bimbingan belajar yang diselenggarakan membantu meningkatkan pemahaman peserta didik terhadap materi pelajaran yang sulit. Inovasi pembelajaran yang dibawa oleh mahasiswa, khususnya dalam penggunaan teknologi dan media pembelajaran interaktif, memberikan inspirasi bagi guru-guru untuk terus mengembangkan metode pengajaran mereka.

Kegiatan ekstrakurikuler menjadi lebih variatif dan terstruktur dengan adanya pendampingan dari mahasiswa. Program-program sosial kemasyarakatan juga memperkuat fungsi madrasah sebagai agen perubahan sosial di lingkungan sekitar. Selain itu, dukungan administrasi yang diberikan mahasiswa membantu meringankan beban kerja guru dan tenaga kependidikan.

### Kontribusi terhadap Masyarakat

Program KKN yang dilaksanakan memberikan manfaat langsung kepada masyarakat madrasah dan sekitarnya. Kegiatan bakti sosial, penyuluhan kesehatan, dan program literasi meningkatkan kesadaran masyarakat akan pentingnya pendidikan, kesehatan, dan kebersihan lingkungan. Program keagamaan yang diselenggarakan memperkuat nilai-nilai spiritual dan solidaritas sosial di kalangan warga madrasah.

---

## Tantangan dan Solusi

### Tantangan dalam Pelaksanaan

Dalam pelaksanaan program PLP Integratif, mahasiswa menghadapi beberapa tantangan, antara lain: penyesuaian dengan lingkungan baru dan budaya madrasah, perbedaan karakteristik dan tingkat pemahaman peserta didik dalam satu kelas, keterbatasan fasilitas dan media pembelajaran di beberapa ruang kelas, serta manajemen waktu antara kegiatan PLP, KKN, dan penyusunan administrasi.

### Strategi Pemecahan Masalah

Untuk mengatasi tantangan tersebut, mahasiswa menerapkan berbagai strategi, seperti melakukan komunikasi intensif dengan guru pamong dan dosen pembimbing untuk mendapatkan arahan dan solusi, mengembangkan pembelajaran diferensiasi untuk mengakomodasi keberagaman kemampuan peserta didik, memanfaatkan sumber daya yang tersedia secara kreatif dan inovatif, serta menyusun jadwal kegiatan yang terorganisir dengan baik.

Dukungan dari pihak madrasah dan universitas juga sangat membantu dalam mengatasi berbagai kendala yang dihadapi. Rapat koordinasi rutin antara mahasiswa, guru pamong, dan dosen pembimbing menjadi forum efektif untuk mengevaluasi pelaksanaan program dan mencari solusi bersama atas permasalahan yang muncul.

---

## Dokumentasi Kegiatan

### Galeri Foto Kegiatan

<div style={{ display: "flex", flexWrap: "wrap", gap: "16px" }}>

<div style={{ flex: "1 1 320px", aspectRatio: "16/9" }}>
  <img
    src="/images/artikel/plp-kkn/2025/uin-banten/kegiatan-1.png"
    alt="Praktik pembelajaran di kelas dengan metode interaktif"
    style={{ width: "100%", borderRadius: "8px" }}
  />
</div>

<div style={{ flex: "1 1 320px", aspectRatio: "16/9" }}>
  <img
    src="/images/artikel/plp-kkn/2025/uin-banten/kegiatan-3.png"
    alt="Pembinaan kegiatan ekstrakurikuler siswa"
    style={{ width: "100%", borderRadius: "8px" }}
  />
</div>

<div style={{ flex: "1 1 320px", aspectRatio: "16/9" }}>
  <img
    src="/images/artikel/plp-kkn/2025/uin-banten/kegiatan-4.png"
    alt="Diskusi kelompok mahasiswa dalam evaluasi pembelajaran"
    style={{ width: "100%", borderRadius: "8px" }}
  />
</div>

<div style={{ flex: "1 1 320px", aspectRatio: "16/9" }}>
  <img
    src="/images/artikel/plp-kkn/2025/uin-banten/kegiatan-6.png"
    alt="Kegiatan bimbingan belajar dengan siswa"
    style={{ width: "100%", borderRadius: "8px" }}
  />
</div>

<div style={{ flex: "1 1 320px", aspectRatio: "16/9" }}>
  <img
    src="/images/artikel/plp-kkn/2025/uin-banten/kegiatan-5.png"
    alt="Program bakti sosial dan pengabdian masyarakat"
    style={{ width: "100%", borderRadius: "8px" }}
  />
</div>

<div style={{ flex: "1 1 320px", aspectRatio: "16/9" }}>
  <img
    src="/images/artikel/plp-kkn/2025/uin-banten/kegiatan-7.png"
    alt="Kegiatan bimbingan belajar dengan siswa"
    style={{ width: "100%", borderRadius: "8px" }}
  />
</div>

</div>

---

### Video Dokumentasi Kegiatan

#### Rangkaian Kegiatan PLP Integratif

<div
  style={{
    display: "flex",
    flexWrap: "wrap",
    gap: "16px",
    marginBottom: "24px",
  }}
>
  <div style={{ flex: "1 1 320px", aspectRatio: "16/9" }}>
    <Video width="100%" src="artikel/plp-kkn/2025/uin-banten/video-1.mp4" />
  </div>

  <div style={{ flex: "1 1 320px", aspectRatio: "16/9" }}>
    <Video width="100%" src="artikel/plp-kkn/2025/uin-banten/video-2.mp4" />
  </div>
</div>

---

## Refleksi dan Pembelajaran

### Perspektif Mahasiswa

Mahasiswa peserta program PLP Integratif menyampaikan bahwa pengalaman ini memberikan pembelajaran yang sangat berharga dan tidak dapat diperoleh melalui perkuliahan di kelas semata. Mereka menyadari bahwa menjadi seorang pendidik tidak hanya memerlukan penguasaan materi ajar, tetapi juga kemampuan untuk memahami karakteristik peserta didik, mengelola dinamika kelas, dan menciptakan lingkungan belajar yang kondusif.

Mahasiswa juga belajar tentang pentingnya kesabaran, kreativitas, dan adaptabilitas dalam menghadapi berbagai situasi di lapangan. Interaksi dengan guru-guru berpengalaman memberikan wawasan tentang profesionalisme keguruan dan dedikasi dalam menjalankan tugas sebagai pendidik. Pengalaman berinteraksi dengan peserta didik yang memiliki latar belakang dan karakteristik yang beragam mengajarkan mahasiswa untuk lebih empatik dan inklusif dalam pendekatan pembelajaran.

### Perspektif Guru Pamong

Para guru pamong yang membimbing mahasiswa praktikan menyampaikan apresiasi atas antusiasme dan semangat belajar yang ditunjukkan mahasiswa. Kehadiran mahasiswa memberikan energi baru dalam proses pembelajaran dan memperkenalkan metode serta media pembelajaran yang inovatif. Guru-guru juga merasa terbantu dengan adanya mahasiswa praktikan, terutama dalam kegiatan ekstrakurikuler dan program pengayaan akademik.

Beberapa guru pamong menyarankan agar program PLP Integratif ini terus dilanjutkan dan diperkuat dengan koordinasi yang lebih intensif antara universitas dengan madrasah. Mereka juga mengusulkan agar durasi program diperpanjang sehingga mahasiswa memiliki waktu yang lebih cukup untuk beradaptasi dan mengimplementasikan berbagai inovasi pembelajaran.

### Perspektif Peserta Didik

Peserta didik memberikan respons positif terhadap kehadiran mahasiswa praktikan. Mereka merasa senang dengan metode pembelajaran yang lebih variatif dan interaktif yang dibawakan oleh mahasiswa. Penggunaan media pembelajaran berbasis teknologi, seperti video pembelajaran dan aplikasi edukatif, membuat proses belajar menjadi lebih menarik dan mudah dipahami.

Peserta didik juga mengapresiasi program bimbingan belajar yang diselenggarakan mahasiswa, yang membantu mereka memahami materi pelajaran yang sulit dengan cara yang lebih sederhana dan menyenangkan. Kegiatan ekstrakurikuler yang dibimbing mahasiswa juga dinilai lebih kreatif dan inspiratif.

---

## Kesimpulan dan Rekomendasi

### Kesimpulan

Program Pengenalan Lapangan Persekolahan (PLP) - Kuliah Kerja Nyata (KKN) Integratif mahasiswa UIN Sultan Maulana Hasanuddin Banten di MTs Negeri 1 Pandeglang periode Agustus hingga Oktober 2025 telah terlaksana dengan baik dan mencapai tujuan yang telah ditetapkan. Program ini berhasil mengembangkan kompetensi pedagogik, profesional, kepribadian, dan sosial mahasiswa sebagai calon pendidik profesional.

Kegiatan PLP memberikan pengalaman praktis kepada mahasiswa dalam merancang, melaksanakan, dan mengevaluasi pembelajaran yang efektif dan inovatif. Kegiatan KKN memperkuat komitmen mahasiswa terhadap pengabdian kepada masyarakat dan mengembangkan kepekaan sosial mereka terhadap permasalahan pendidikan di lingkungan madrasah.

Bagi MTs Negeri 1 Pandeglang, kehadiran mahasiswa praktikan memberikan kontribusi positif dalam meningkatkan kualitas pembelajaran, memperkaya program ekstrakurikuler, dan mendukung administrasi madrasah. Kolaborasi antara UIN Banten dengan MTs Negeri 1 Pandeglang dalam program ini telah memperkuat sinergi antara perguruan tinggi dengan lembaga pendidikan menengah dalam upaya meningkatkan mutu pendidikan nasional.

### Rekomendasi

Berdasarkan evaluasi dan refleksi atas pelaksanaan program, beberapa rekomendasi dapat diajukan untuk perbaikan program di masa mendatang:

**Untuk Universitas:**
Meningkatkan kualitas pembekalan mahasiswa sebelum penerjunan ke lapangan, khususnya terkait dengan manajemen kelas, pengembangan media pembelajaran, dan teknik evaluasi pembelajaran. Memperkuat koordinasi dan komunikasi dengan lembaga mitra untuk memastikan kesesuaian antara program PLP Integratif dengan kebutuhan lembaga. Menyediakan dukungan teknis dan finansial yang memadai untuk memfasilitasi mahasiswa dalam mengembangkan inovasi pembelajaran. Mengembangkan sistem monitoring dan evaluasi yang lebih komprehensif untuk memantau perkembangan mahasiswa selama program berlangsung.

**Untuk Madrasah:**
Menyediakan fasilitas dan infrastruktur yang memadai untuk mendukung kegiatan pembelajaran, seperti akses internet yang stabil, LCD proyektor di setiap kelas, dan laboratorium yang lengkap. Meningkatkan intensitas bimbingan dan supervisi dari guru pamong kepada mahasiswa praktikan. Memberikan kebebasan kepada mahasiswa untuk berinovasi dalam pembelajaran dengan tetap memperhatikan pencapaian kurikulum. Melibatkan mahasiswa praktikan dalam berbagai kegiatan madrasah untuk memperkaya pengalaman mereka.

**Untuk Mahasiswa:**
Mempersiapkan diri secara matang sebelum pelaksanaan program, baik dari aspek penguasaan materi, keterampilan pedagogik, maupun mental. Bersikap proaktif dalam mencari pembelajaran dan pengalaman baru selama program berlangsung. Menjalin komunikasi yang baik dengan guru pamong, dosen pembimbing, dan seluruh komponen madrasah. Mendokumentasikan seluruh kegiatan dengan baik sebagai bahan refleksi dan pembelajaran. Menjaga profesionalisme dan integritas sebagai calon pendidik.

**Untuk Stakeholder Pendidikan:**
Mendukung pelaksanaan program PLP Integratif sebagai bagian penting dari sistem pendidikan guru di Indonesia. Memfasilitasi kemitraan yang lebih luas antara perguruan tinggi dengan lembaga pendidikan dasar dan menengah. Menyediakan kebijakan dan regulasi yang mendukung peningkatan kualitas program PLP Integratif.

---

## Penutup

Program PLP Integratif merupakan wadah strategis dalam menyiapkan calon pendidik yang profesional, kompeten, dan memiliki dedikasi tinggi terhadap dunia pendidikan. Pengalaman yang diperoleh mahasiswa selama program ini menjadi bekal berharga yang akan mereka bawa dalam meniti karir sebagai pendidik profesional.

Keberhasilan program ini tidak lepas dari dukungan dan kerja sama yang baik antara berbagai pihak, termasuk pimpinan dan dosen UIN Sultan Maulana Hasanuddin Banten, kepala madrasah dan seluruh guru serta tenaga kependidikan MTs Negeri 1 Pandeglang, serta seluruh peserta didik yang telah menerima kehadiran mahasiswa praktikan dengan antusiasme tinggi.

Semoga kolaborasi antara UIN Banten dengan MTs Negeri 1 Pandeglang dapat terus berlanjut dan semakin diperkuat di masa mendatang. Melalui kemitraan yang solid dan berkelanjutan, diharapkan dapat tercipta ekosistem pendidikan yang berkualitas dan mampu mencetak generasi penerus bangsa yang cerdas, berkarakter, dan berakhlak mulia.

Akhir kata, semoga program PLP Integratif ini memberikan manfaat yang maksimal bagi semua pihak yang terlibat dan berkontribusi nyata dalam memajukan pendidikan Indonesia menuju masa depan yang lebih gemilang.

---

## Ucapan Terima Kasih

Pelaksanaan program PLP Integratif ini tidak akan berjalan dengan lancar tanpa dukungan dari berbagai pihak. Oleh karena itu, kami menyampaikan terima kasih dan penghargaan setinggi-tingginya kepada:

1. **Bapak Rektor UIN Sultan Maulana Hasanuddin Banten** beserta jajaran pimpinan universitas yang telah memfasilitasi pelaksanaan program ini.
2. **Bapak Dekan Fakultas Tarbiyah dan Keguruan** beserta seluruh dosen pembimbing lapangan yang telah memberikan bimbingan dan arahan kepada mahasiswa.
3. **Bapak Kepala MTs Negeri 1 Pandeglang** yang telah berkenan menerima mahasiswa praktikan dan menyediakan fasilitas yang dibutuhkan.
4. **Bapak/Ibu Guru Pamong MTs Negeri 1 Pandeglang** yang telah membimbing mahasiswa dengan penuh kesabaran dan dedikasi.
5. **Seluruh Tenaga Kependidikan MTs Negeri 1 Pandeglang** yang telah membantu kelancaran administrasi dan kegiatan program.
6. **Peserta Didik MTs Negeri 1 Pandeglang** yang telah menerima mahasiswa praktikan dengan antusias dan berpartisipasi aktif dalam setiap kegiatan.
7. **Orang Tua/Wali Peserta Didik** yang telah memberikan dukungan terhadap pelaksanaan program ini.
8. **Seluruh pihak** yang tidak dapat disebutkan satu per satu yang telah berkontribusi dalam mensukseskan program PLP Integratif ini.

Semoga Allah SWT membalas semua kebaikan yang telah diberikan dengan pahala yang berlimpah dan keberkahan dalam setiap langkah. Aamiin ya Rabbal 'Alamin.

---

## Referensi

1. Darling-Hammond, L. (2006). Powerful Teacher Education: Lessons from Exemplary Programs. San Francisco: Jossey-Bass.
2. Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi. (2022). Standar Nasional Pendidikan Tinggi. Jakarta: Kemdikbudristek.
3. Peraturan Menteri Agama Republik Indonesia Nomor 90 Tahun 2013 tentang Penyelenggaraan Pendidikan Madrasah.
4. Undang-Undang Republik Indonesia Nomor 14 Tahun 2005 tentang Guru dan Dosen.
5. Universitas Islam Negeri Sultan Maulana Hasanuddin Banten. (2024). Pedoman Praktik Pengalaman Lapangan dan Kuliah Kerja Nyata. Serang: UIN Banten Press.

---

## Informasi Kontak

<Tabs client:load>

<Tab name="MTs Negeri 1 Pandeglang">
  - **Alamat:** Jl. Raya Labuan Km. 5,7 Palurahan, Kaduhejo, Pandeglang, Banten
  - **Telepon:** 62895351856267
  - **Email:** adm@mtsn1pandeglang.sch.id
  - **Website:** www.mtsn1pandeglang.sch.id
</Tab>
<Tab name="UIN Sultan Maulana Hasanuddin Banten">
  - **Alamat:** Jl. Jenderal Sudirman No. 30, Serang, Banten
  - **Telepon:** (0254) 200323
  - **Email:** info@uinbanten.ac.id
  - **Website:** www.uinbanten.ac.id
</Tab>
</Tabs>

**Tim Redaksi:**

- **Penulis:** Yahya Zulfikri
- **Editor:** Tim Humas MTsN 1 Pandeglang
- **Whatsapp:** [WhatsApp PTSP](https://wa.me/62895351856267)
```

---

### File: `./src/content/blog/zona-integritas.mdx`

```markdown
---
title: "Wujudkan Zona Integritas, Kepala Kemenag Resmikan Gedung PTSP MTsN 1 Pandeglang"
meta_title: "Peresmian Gedung PTSP MTsN 1 Pandeglang Menuju Zona Integritas WBK dan WBBM"
description: "Kepala Kemenag Pandeglang meresmikan gedung Pelayanan Terpadu Satu Pintu MTsN 1 Pandeglang sebagai langkah strategis menuju Wilayah Bebas Korupsi dan Wilayah Birokrasi Bersih Melayani"
date: 2024-01-03T08:00:00Z
image: "/images/artikel/zona-integritas.png"
categories: ["Artikel"]
author: "Yahya Zulfikri"
tags: ["Zona Integritas", "PTSP"]
draft: false
---

Kepala Kantor Kementerian Agama Kabupaten Pandeglang H. Amin Hidayat meresmikan gedung Pelayanan Terpadu Satu Pintu (PTSP) MTsN 1 Pandeglang di Kampung Kadulisung, Desa Palurahan, Kecamatan Kaduhejo, Kabupaten Pandeglang, Rabu (3/1/2024). Peresmian ini menandai langkah strategis dalam mewujudkan zona integritas menuju Wilayah Bebas Korupsi (WBK) dan Wilayah Birokrasi Bersih Melayani (WBBM) di seluruh madrasah di Kabupaten Pandeglang.

Peresmian dilakukan bersama Kepala Seksi (Kasi) Penyelenggara Haji dan Umrah (PHU) Kantor Kemenag Pandeglang Haji Kholid, sebagai implementasi nyata dari program pembangunan zona integritas di lingkungan madrasah.

## Pilot Project Zona Integritas

Kepala MTsN 1 Pandeglang Eman Sulaeman menjelaskan bahwa peresmian gedung PTSP ini merupakan salah satu implementasi konkret setelah MTsN 1 Pandeglang ditunjuk sebagai pilot project pembangunan satuan kerja zona integritas pada tahun 2023.

"Ini merupakan salah satu implementasi dari upaya MTsN 1 Pandeglang yang tahun ini ditunjuk sebagai pilot project untuk pembangunan satuan kerja zona integritas. Jadi MTsN 1 Pandeglang sedang menuju zona integritas, menuju Wilayah Bebas Korupsi dan Wilayah Birokrasi Bersih Melayani," ujar H. Eman Sulaiman.

MTsN 1 Pandeglang menjadi sekolah pertama di Kabupaten Pandeglang yang menuju pembangunan zona integritas, menjadikannya pionir dalam reformasi birokrasi pendidikan berbasis madrasah.

## Tahapan Pembangunan Zona Integritas

Untuk mencapai tujuan WBK dan WBBM, Eman menjelaskan bahwa proses dilakukan secara bertahap. Sebelumnya, ia bersama seluruh dewan guru dan staf MTsN 1 Pandeglang telah menandatangani pakta integritas sebagai komitmen bersama.

Tahapan kegiatan yang disiapkan meliputi pembangunan infrastruktur gedung layanan PTSP dan pengembangan Sumber Daya Manusia (SDM) yang kompeten dalam memberikan pelayanan prima.

## Pelayanan Terpadu dan Terintegrasi

Melalui gedung PTSP, seluruh jenis pelayanan yang berkaitan dengan pendidikan akan terpusat di satu lokasi. Pelayanan yang tersedia mencakup layanan terhadap masyarakat, alumni, kesiswaan, wali siswa, serta Kelompok Kerja Madrasah (KKM) dan anggotanya.

"Jenis layanan yang bisa dilayani di PTSP yaitu menyangkut semua pelayanan yang berkaitan dengan pendidikan. Pelayanan terhadap masyarakat dan wali siswa khususnya, baik layanan surat-menyurat yang dibutuhkan oleh wali siswa, legalisir ijazah bisa dilayani di sini dengan cepat," jelas Eman.

Terpusatnya penyelenggaraan pelayanan ini memberikan kemudahan dalam hal pengawasan sekaligus meningkatkan efektivitas dan efisiensi dalam praktiknya.

## Teknologi Mendukung Transparansi

Untuk mendukung terwujudnya zona integritas WBK dan WBBM, gedung PTSP dilengkapi dengan berbagai sarana modern. Kamera keamanan dipasang di seluruh area sehingga aktivitas petugas, guru, dan stakeholder lainnya dapat terlihat secara real-time.

"Kita juga akan punya aplikasi big data. Jadi melalui aplikasi tersebut seluruh data dan informasi pelayanan dari sekolah kami ini akan bisa diakses oleh masyarakat," ungkap Eman.

Seluruh sistem akan terkoneksi ke platform digital yang dapat diakses melalui perangkat android, memberikan keterbukaan informasi yang optimal. Menurut Eman, implementasi teknologi ini berdampak signifikan pada pengurangan potensi korupsi dan pungutan liar.

"Jadi nanti seluruhnya akan terkoneksi ke android. Selain itu, jika dibandingkan dengan sekolah yang belum memiliki PTSP ini, tentu secara keterbukaan pelayanan kita lebih baik," tambahnya.

## Apresiasi dan Harapan Kepala Kemenag

Kepala Kantor Kementerian Agama Kabupaten Pandeglang H. Amin Hidayat memberikan apresiasi tinggi atas terobosan yang dilakukan MTsN 1 Pandeglang. Menurutnya, hal ini merupakan bukti bahwa pendidikan di Kabupaten Pandeglang, terutama yang berbasis madrasah, terus mengalami perkembangan positif.

"Saya berharap seluruh madrasah juga mengikuti dan membuat layanan satu pintu di masing-masing madrasah. Mudah-mudahan pelayanan satu pintu itu bisa juga diikuti oleh sekolah-sekolah yang lainnya," ujar H. Amin Hidayat.

H. Amin Hidayat mengakui bahwa menyiapkan konsep zona integritas bukanlah hal yang mudah dan memerlukan komitmen dari seluruh civitas akademika. "Saya berharap seluruh madrasah juga, mengikuti dan membuat layanan satu pintu. Menyiapkan konsep seperti ini tidaklah mudah, ini harus dilaksanakan oleh seluruh civitas akademika MTsN 1 Pandeglang," tegasnya.

## Komitmen Menuju WBK dan WBBM

H. Amin Hidayat menegaskan bahwa pencapaian zona integritas memerlukan konsistensi dan disiplin dari seluruh elemen. "Kalau sudah zona integritas maka jangan juga ada yang kesiangan. Ngajar jangan telat, semuanya harus benar-benar mengikuti komitmen bersama mewujudkan madrasah menuju Wilayah Bebas Korupsi (WBK) dan Wilayah Birokrasi Bersih Melayani (WBBM)," tandasnya.

Peresmian gedung PTSP MTsN 1 Pandeglang ini diharapkan menjadi inspirasi dan contoh bagi madrasah serta sekolah lainnya di Kabupaten Pandeglang untuk terus meningkatkan kualitas pelayanan publik yang transparan, akuntabel, dan bebas dari praktik korupsi.

**Tim Redaksi:**

- **Penulis:** Yahya Zulfikri
- **Editor:** Tim Humas MTsN 1 Pandeglang
- **Whatsapp:** [WhatsApp PTSP](https://wa.me/62895351856267)
```

---

### File: `./src/content/blog/-index.md`

```markdown
---
title: "Artikel"
meta_title: "Artikel MTs Negeri 1 Pandeglang"
description: "Artikel MTs Negeri 1 Pandeglang"
image: ""
draft: false
---
```

---

### File: `./src/content/contact/-index.md`

```markdown
---
title: "Kontak Kami"
description: "Kontak MTs Negeri 1 Pandeglang"
meta_title: "Kontak MTs Negeri 1 Pandeglang"
draft: false
image: ""
---
```

---

### File: `./src/content/homepage/-index.md`

```markdown
---
# Banner
banner:
  title: "Mewujudkan Generasi Cendekia & Berkarakter Mulia"
  content: "Selamat datang di MTs Negeri 1 Pandeglang. Kami memadukan keunggulan akademik, kematangan spiritual, dan teknologi modern untuk mempersiapkan putra-putri Anda menjadi pemimpin masa depan yang kompeten dan berakhlak."
  image: "/images/assets/banner.png"
  button:
    enable: true
    label: "Bergabung Bersama Kami"
    link: "https://daftar.mtsn1pandeglang.sch.id"

# Fitur (Optimized for Bento Grid Layout)
features:
  - title: "Akreditasi Unggul (A)"
    image: "/images/assets/akreditasi.png"
    content: "Bukti nyata komitmen kami terhadap mutu pendidikan. MTs Negeri 1 Pandeglang telah memenuhi standar nasional pendidikan tertinggi dengan predikat A (Unggul), menjamin kualitas pengajaran, manajemen, dan kelulusan yang kredibel."
    bulletpoints:
      - "Terakreditasi A (Unggul) oleh BAN-S/M"
      - "Standar Manajemen ISO Pendidikan"
      - "Tenaga Pendidik Tersertifikasi Profesional"
      - "Jaminan Mutu Berkelanjutan"
    button:
      enable: true
      label: "Lihat Sertifikat"
      link: "/akreditasi"

  - title: "Ekosistem Belajar Modern"
    image: "/images/assets/fasilitas.png"
    content: "Kami menghadirkan lingkungan belajar yang menunjang eksplorasi dan inovasi siswa dengan infrastruktur terlengkap."
    bulletpoints:
      - "Perpustakaan Digital (E-Library)"
      - "Laboratorium Sains & Komputer"
      - "Sarana Olahraga & Ibadah Representatif"
    button:
      enable: true
      label: "Jelajahi Fasilitas"
      link: "https://maps.app.goo.gl/o7fvJLDUnTmxEiwT6"

  - title: "Kurikulum Berbasis Cinta"
    image: "/images/assets/kurikulum.png"
    content: "Pendekatan pendidikan humanis yang menyentuh hati. Kami tidak hanya mengajar otak, tetapi juga mendidik jiwa dengan kasih sayang, menciptakan suasana belajar yang nyaman dan membahagiakan bagi setiap siswa."
    bulletpoints:
      - "Pendekatan Saintifik & STEAM"
      - "Program Tahfidz Al-Qur'an Intensif"
      - "Kelas Bilingual & Literasi Digital"
      - "Penguatan Profil Pelajar Pancasila"
    button:
      enable: true
      label: "Pelajari Kurikulum"
      link: "/kurikulum"

  - title: "Mengapa Memilih Kami?"
    image: "/images/assets/program.png"
    content: "MTs Negeri 1 Pandeglang bukan sekadar madrasah, melainkan inkubator masa depan. Kami fokus pada pembentukan karakter (Character Building) yang kuat, kemandirian, dan prestasi. Lulusan kami terbukti mampu bersaing di jenjang pendidikan favorit dan memiliki pondasi agama yang kokoh."
    bulletpoints:
      - "Track Record Prestasi Akademik & Non-Akademik"
      - "Budaya Sekolah yang Inklusif & Disiplin"
      - "Program Pengembangan Bakat Terarah"
      - "Sinergi Kuat antara Guru, Siswa, dan Orang Tua"
    button:
      enable: true
      label: "Program Unggulan"
      link: "/program"

  - title: "Zona Integritas (ZI)"
    image: "/images/assets/zona-integritas.png"
    content: "Pelopor Wilayah Bebas Korupsi (WBK) di lingkungan madrasah. Kami menjunjung tinggi transparansi dan akuntabilitas."
    bulletpoints:
      - "Budaya Anti-Korupsi & Gratifikasi"
      - "Layanan Publik yang Transparan"
      - "Birokrasi Bersih Melayani"
    button:
      enable: true
      label: "Nilai Integritas"
      link: "/zona-integritas"

  - title: "Layanan Digital (PTSP)"
    image: "/images/assets/ptsp.png"
    content: "Kemudahan akses layanan administrasi satu pintu yang cepat, modern, dan dapat diakses secara digital."
    bulletpoints:
      - "Layanan Legalisir & Administrasi Cepat"
      - "Ramah, Profesional, & Solutif"
      - "Sistem Antrian & Tracking Online"
    button:
      enable: true
      label: "Akses Layanan"
      link: "/pelayanan"

  - title: "Inkubator Talenta"
    image: "/images/assets/ekstrakurikuler.png"
    content: "Wadah pengembangan minat dan bakat siswa melalui beragam ekstrakurikuler prestasi."
    bulletpoints:
      - "Pramuka, Paskibra & PMR"
      - "Sains, Jurnalistik & Riset"
      - "Olahraga & Seni Budaya"
      - "Keagamaan & Adiwiyata"
    button:
      enable: true
      label: "Lihat Ekstrakurikuler"
      link: "/ekstrakurikuler"
---
```

---

### File: `./src/content/pages/adiwiyata.mdx`

```markdown
---
title: "Madrasah Adiwiyata"
meta_title: "Program Adiwiyata MTs Negeri 1 Pandeglang - Green School"
description: "Mewujudkan sekolah hijau yang berbudaya lingkungan. Gerakan konservasi, pengelolaan limbah, dan inovasi ramah lingkungan di MTs Negeri 1 Pandeglang."
draft: false
---

### Madrasah Hijau, Masa Depan Berkelanjutan

**"Harmony with Nature, Harmony with Future"**

---

MTs Negeri 1 Pandeglang berkomitmen penuh untuk bertransformasi menjadi **Eco-Madrasah (Green School)**. Program Adiwiyata bagi kami bukan sekadar lomba atau predikat, melainkan sebuah gerakan kultural untuk menanamkan _mindset_ keberlanjutan (sustainability) kepada seluruh warga madrasah.

Kami mengintegrasikan nilai-nilai ekologis ke dalam setiap aspek pembelajaran, menciptakan lingkungan yang asri, sehat, dan inspiratif untuk tumbuh kembang siswa.

### Empat Pilar Gerakan Adiwiyata

Strategi kami dalam mewujudkan madrasah berbudaya lingkungan bertumpu pada empat pilar aksi:

#### 1. Kebijakan Berwawasan Lingkungan

Madrasah menetapkan regulasi yang pro-lingkungan, seperti:

- **Zona Bebas Plastik (Zero Plastic):** Larangan penggunaan kemasan plastik sekali pakai di kantin dan lingkungan sekolah.
- **Paperless Policy:** Digitalisasi administrasi dan ujian untuk mengurangi penggunaan kertas.
- **Anggaran Hijau:** Alokasi dana khusus untuk pemeliharaan taman dan inovasi lingkungan.

#### 2. Pelaksanaan Kurikulum Berbasis Lingkungan

Mengintegrasikan isu lingkungan ke dalam KBM (Kegiatan Belajar Mengajar) dan Projek Penguatan Profil Pelajar Pancasila (P5):

- **Tema P5:** "Gaya Hidup Berkelanjutan" dan "Rekayasa Teknologi".
- **Pembelajaran Kontekstual:** Menggunakan kebun sekolah, kolam, dan bank sampah sebagai laboratorium alam.

#### 3. Kegiatan Lingkungan Partisipatif

Melibatkan seluruh elemen (Guru, Siswa, Orang Tua, dan Masyarakat) dalam aksi nyata:

- **Bank Sampah "Berhias":** Manajemen pengelolaan sampah terpadu dengan prinsip 3R (_Reduce, Reuse, Recycle_). Sampah organik diolah menjadi kompos, anorganik menjadi kerajinan atau tabungan emas.
- **Jumat Bersih & Sehat:** Rutinitas mingguan untuk pembersihan massal dan senam bersama.
- **Duta Lingkungan:** Pembentukan kader siswa yang menjadi _influencer_ kebersihan bagi teman sebayanya.

#### 4. Pengelolaan Sarana Ramah Lingkungan

- **Konservasi Energi & Air:** Pemanfaatan pencahayaan alami, penggunaan lampu hemat energi, dan sistem biopori untuk resapan air.
- **Green House & Apotek Hidup:** Konservasi tanaman obat keluarga (TOGA) dan pembibitan tanaman hias.
- **Sanitasi Sehat:** Penyediaan toilet bersih, wastafel di setiap kelas, dan drainase yang lancar.

---

### Inovasi Unggulan

Kami terus mendorong siswa dan guru untuk melahirkan inovasi ramah lingkungan, antara lain:

- **Eco-Enzyme:** Pemanfaatan limbah kulit buah menjadi cairan serbaguna (pembersih/pupuk).
- **Vertical Garden:** Solusi penghijauan di lahan terbatas.
- **Kompos Takakura:** Metode pengomposan praktis skala rumah tangga.

---

> "Bumi ini tidak kita warisi dari nenek moyang, melainkan kita pinjam dari anak cucu kita. Melalui Adiwiyata, MTs Negeri 1 Pandeglang menyiapkan generasi yang tidak hanya cerdas otaknya, tetapi juga hijau hatinya untuk merawat bumi."
>
> — **Tim Adiwiyata MTs Negeri 1 Pandeglang**
```

---

### File: `./src/content/pages/akreditasi.mdx`

```markdown
---
title: "Akreditasi"
meta_title: "Akreditasi MTs Negeri 1 Pandeglang"
description: "Akreditasi MTs Negeri 1 Pandeglang"
draft: false
---

MTs Negeri 1 Pandeglang telah diakui secara resmi oleh pemerintah dan berbagai lembaga akreditasi pendidikan. Akreditasi ini menunjukkan bahwa madrasah kami telah memenuhi standar kualitas pendidikan yang tinggi dan berkomitmen untuk terus meningkatkan mutu pendidikan yang diberikan kepada siswa-siswi.

### Tujuan Akreditasi

Akreditasi bertujuan untuk:

1. Menilai kualitas pendidikan yang diberikan oleh MTs Negeri 1 Pandeglang.
2. Menjamin bahwa madrasah memenuhi standar pendidikan yang ditetapkan oleh pemerintah.
3. Memberikan gambaran kepada masyarakat mengenai kualitas dan prestasi madrasah.
4. Meningkatkan kepercayaan masyarakat terhadap madrasah dan sistem pendidikan yang diterapkan.

## Proses Akreditasi

### Persiapan

MTs Negeri 1 Pandeglang melakukan berbagai persiapan untuk menghadapi proses akreditasi, antara lain:

- Mempersiapkan dokumen dan data yang diperlukan.
- Melakukan evaluasi internal terhadap kualitas pendidikan.
- Melibatkan seluruh warga sekolah dalam proses akreditasi.

### Penilaian

Proses akreditasi melibatkan penilaian oleh tim asesor dari Badan Akreditasi Nasional Sekolah/Madrasah (BAN-S/M). Penilaian dilakukan melalui observasi, wawancara, dan evaluasi dokumen untuk menilai berbagai aspek, seperti:

- Kurikulum dan proses pembelajaran.
- Kualitas tenaga pendidik dan kependidikan.
- Sarana dan prasarana pendidikan.
- Manajemen dan tata kelola sekolah.
- Partisipasi masyarakat dan lingkungan sekolah.

### Hasil Akreditasi

Hasil akreditasi menunjukkan bahwa MTs Negeri 1 Pandeglang telah berhasil memenuhi standar kualitas pendidikan yang tinggi. Madrasah kami mendapatkan peringkat **A** dengan nilai yang sangat baik dalam berbagai aspek penilaian.

## Manfaat Akreditasi

Akreditasi memberikan berbagai manfaat bagi MTs Negeri 1 Pandeglang, antara lain:

- Mengakui dan menghargai upaya madrasah dalam meningkatkan kualitas pendidikan.
- Memberikan motivasi kepada seluruh warga sekolah untuk terus berprestasi.
- Meningkatkan kepercayaan masyarakat terhadap madrasah.
- Membuka peluang kerjasama dengan berbagai pihak untuk mendukung pengembangan pendidikan.

## Sertifikat Akreditasi

MTs Negeri 1 Pandeglang telah menerima sertifikat akreditasi dari Badan Akreditasi Nasional Sekolah/Madrasah (BAN-S/M) sebagai bukti pengakuan resmi atas kualitas pendidikan yang diberikan.

<Button
  label="Lihat Data"
  link="https://ban-pdm.id//satuanpendidikan/69788409"
  style="solid"
/>

> "Akreditasi MTs Negeri 1 Pandeglang adalah bukti nyata komitmen kami untuk memberikan pendidikan berkualitas kepada siswa-siswi. Kami akan terus berusaha untuk meningkatkan mutu pendidikan dan mencapai prestasi yang lebih tinggi." - Kepala MTs Negeri 1 Pandeglang
```

---

### File: `./src/content/pages/alumni.mdx`

```markdown
---
title: "Alumni"
meta_title: "Alumni MTs Negeri 1 Pandeglang"
description: "Alumni MTs Negeri 1 Pandeglang"
draft: false
---

MTs Negeri 1 Pandeglang bangga memiliki jaringan alumni yang luas dan sukses. Para alumni kami telah mencapai berbagai prestasi di berbagai bidang, baik di tingkat nasional maupun internasional. Halaman ini didedikasikan untuk menghubungkan kembali para alumni dengan almamater tercinta dan mempererat tali silaturahmi di antara sesama alumni.

### Tujuan Halaman Alumni

Halaman Alumni MTs Negeri 1 Pandeglang bertujuan untuk:

1. Menjaga hubungan baik antara alumni dan almamater.
2. Meningkatkan jejaring dan kolaborasi di antara alumni.
3. Memberikan informasi tentang kegiatan dan acara reuni alumni.
4. Memfasilitasi kontribusi alumni untuk pengembangan sekolah.

## Kegiatan Alumni

### Reuni Alumni

MTs Negeri 1 Pandeglang secara rutin mengadakan acara reuni alumni untuk mempererat hubungan dan mengenang masa-masa indah di sekolah. Acara reuni ini diisi dengan berbagai kegiatan, seperti:

- Sambutan dan pidato dari kepala sekolah dan perwakilan alumni.
- Pertunjukan seni dan budaya.
- Diskusi dan sharing pengalaman antaralumni.
- Kegiatan sosial dan bakti alumni.

### Kontribusi Alumni

Para alumni MTs Negeri 1 Pandeglang diharapkan dapat memberikan kontribusi untuk pengembangan sekolah. Beberapa bentuk kontribusi yang dapat dilakukan antara lain:

- Donasi untuk pengembangan fasilitas dan program sekolah.
- Pembinaan dan mentoring kepada siswa-siswi MTs Negeri 1 Pandeglang.
- Kolaborasi dalam kegiatan sosial dan kemanusiaan.
- Pemberian beasiswa kepada siswa berprestasi dan kurang mampu.

### Jejaring dan Karir

Halaman Alumni juga menyediakan platform untuk meningkatkan jejaring dan karir para alumni. Beberapa kegiatan yang mendukung hal ini antara lain:

- Seminar dan workshop tentang pengembangan karir.
- Pertemuan jejaring alumni di berbagai bidang.
- Portal lowongan pekerjaan dan kesempatan magang.

## Fitur-Fitur Utama

### Data Alumni

MTs Negeri 1 Pandeglang menjaga database alumni yang terupdate untuk memudahkan komunikasi dan koordinasi. Data alumni ini meliputi:

- Nama lengkap.
- Tahun lulus.
- Bidang pekerjaan atau studi lanjut.
- Kontak yang dapat dihubungi.

### Berita Alumni

Halaman ini juga menyajikan berita terbaru tentang prestasi dan kegiatan alumni. Berita ini mencakup:

- Prestasi akademik dan non-akademik alumni.
- Kegiatan sosial dan kemanusiaan yang diikuti oleh alumni.
- Cerita inspiratif dari alumni yang sukses di berbagai bidang.

### Komunitas Alumni

MTs Negeri 1 Pandeglang mendorong pembentukan komunitas alumni berdasarkan angkatan, bidang studi, atau minat yang sama. Komunitas ini bertujuan untuk mempererat hubungan dan meningkatkan kolaborasi di antara alumni.

---

> "Kami sangat bangga dengan prestasi dan kontribusi yang telah diberikan oleh para alumni MTs Negeri 1 Pandeglang. Halaman Alumni ini adalah wujud apresiasi kami dan harapan untuk terus menjaga hubungan baik dengan para alumni." - Kepala MTs Negeri 1 Pandeglang
```

---

### File: `./src/content/pages/badminton-club.mdx`

```markdown
---
title: "Klub Bulu Tangkis (MATSANEPA BC)"
meta_title: "Badminton Club MTs Negeri 1 Pandeglang - Smash & Netting"
description: "Mencetak atlet bulu tangkis yang lincah dan berteknik tinggi. Wadah pembinaan bakat tepok bulu siswa MTs Negeri 1 Pandeglang."
draft: false
---

### Kecepatan, Refleks, Strategi

**"Terbang Meraih Poin, Smash Meraih Juara"**

---

Klub Bulu Tangkis MTs Negeri 1 Pandeglang (Matsanepa BC) adalah rumah bagi para pecinta olahraga tepok bulu. Kami memfasilitasi siswa untuk mengembangkan bakat mereka dari sekadar hobi menjadi kemampuan atlet yang kompetitif.

Bulu tangkis di sini bukan hanya soal memukul _shuttlecock_ sekeras mungkin, tapi tentang **kecerdasan membaca permainan, kelincahan kaki (_footwork_), dan kekuatan mental** di lapangan.

### Fokus Latihan

Kami menerapkan metode latihan yang seimbang antara fisik dan teknik:

#### 1. Teknik Pukulan (Strokes)

- **Servis:** Menguasai servis pendek tipis net dan servis panjang ke belakang.
- **Lob & Drop Shot:** Pukulan melambung ke garis belakang dan tipuan halus ke depan net.
- **Smash & Drive:** Pukulan serangan mematikan dan pukulan datar cepat.
- **Netting:** Seni permainan jaring yang membutuhkan _feeling_ halus.

#### 2. Pergerakan Kaki (Footwork)

Kunci permainan bulu tangkis adalah kaki. Kami melatih langkah kaki yang efisien agar pemain dapat menjangkau seluruh sudut lapangan tanpa membuang tenaga berlebih (_shadow badminton_).

#### 3. Fisik & Stamina

- Latihan kelincahan (_agility_) dan reaksi cepat.
- Latihan pergelangan tangan (_wrist work_) untuk pukulan yang tajam.

---

### Kategori & Kompetisi

Kami membina pemain untuk sektor:

- Tunggal Putra & Putri
- Ganda Putra, Putri, & Campuran

**Ajang yang Diikuti:**

- **O2SN (Olimpiade Olahraga Siswa Nasional):** Target utama prestasi siswa.
- **Kejurkab PBSI:** Kejuaraan tingkat kabupaten untuk menambah poin peringkat.
- **Turnamen Antar Pelajar:** Kompetisi persahabatan antar sekolah.

### Fasilitas

- **GOR Bulu Tangkis:** Bekerjasama dengan GOR terdekat atau menggunakan aula serbaguna madrasah.
- **Peralatan Latihan:** Raket latihan, _shuttlecock_ berkualitas, dan net standar BWF.

---

> "Bulu tangkis adalah olahraga catur fisik. Kamu harus berpikir dua langkah ke depan sebelum memukul kok. Di klub ini, kami melatih tubuhmu agar secepat pikiranmu."
>
> — **Pelatih Bulu Tangkis MTs Negeri 1 Pandeglang**
```

---

### File: `./src/content/pages/basketball-club.mdx`

```markdown
---
title: "Klub Bola Basket (MATSANEPA HOOPS)"
meta_title: "Basketball Club MTs Negeri 1 Pandeglang - Dribble, Shoot, Score!"
description: "Membentuk tim basket yang solid, lincah, dan bermental juara. Pelatihan fundamental basket modern untuk mencetak atlet pelajar potensial."
draft: false
---

### Play Hard, Play Smart, Play Together

**"Defense Wins Championships"**

---

Klub Bola Basket MTs Negeri 1 Pandeglang (Matsanepa Hoops) adalah komunitas bagi siswa yang mencintai kecepatan, akurasi, dan ketangkasan. Kami bukan sekadar melempar bola ke keranjang, tapi kami belajar tentang **disiplin waktu, strategi, dan respek**.

Dengan gaya permainan cepat (_fast break_) dan pertahanan solid, kami berusaha menjadikan basket sebagai salah satu olahraga unggulan yang membawa nama harum madrasah di kancah kompetisi pelajar.

### Filosofi Permainan

Kami percaya bahwa pemain hebat tidak lahir dari bakat saja, tapi dari ribuan jam latihan (_repetition_).

- **Fundamental First:** Mengutamakan penguasaan teknik dasar yang benar sebelum trik-trik rumit.
- **Hustle:** Semangat juang tinggi, mengejar setiap bola liar, dan tidak malas bertahan.
- **Brotherhood:** Rasa kekeluargaan yang kuat di dalam dan luar lapangan.

---

### Program Latihan (Drills)

Kurikulum latihan kami mengadaptasi metode basket modern:

#### 1. Fundamental Skills

- **Dribbling:** Latihan _ball handling_ agar bola menyatu dengan tangan (Crossover, Behind the back).
- **Shooting Form:** Memperbaiki mekanika tembakan (B.E.E.F - _Balance, Eyes, Elbow, Follow Through_) untuk akurasi tinggi.
- **Passing:** Teknik umpan dada (_chest pass_) dan pantul (_bounce pass_) yang tajam.
- **Lay-up:** Teknik mencetak angka dasar sambil berlari.

#### 2. Taktik & Strategi

- **Offense:** Pola penyerangan _Pick and Roll_, _Give and Go_, dan _Motion Offense_.
- **Defense:** Sistem pertahanan _Man-to-Man_ dan _Zone Defense_ (2-3, 3-2).
- **Rebounding:** Teknik _Box Out_ untuk mengamankan bola pantul.

#### 3. Strength & Conditioning

Latihan fisik khusus basket untuk meningkatkan lompatan (_vertical jump_), kecepatan (_sprint_), dan stamina.

---

### Ajang Kompetisi

Kami rutin mengikuti berbagai turnamen untuk menguji mental bertanding:

- **DBL Junior (Developmental Basketball League):** Kompetisi basket pelajar terbesar.
- **Piala PERBASI:** Turnamen resmi tingkat kabupaten/kota.
- **Invitasi Sekolah:** Pertandingan persahabatan antar SMP/MTs.

### Fasilitas

- **Lapangan Basket Outdoor:** Lapangan dengan ring standar dan garis lapangan yang jelas.
- **Peralatan:** Bola basket Molten/Spalding ukuran 6 & 7, _cone_, dan _agility ladder_.

---

> "Basket mengajarkan kami bahwa ketika kami jatuh (foul), kami harus bangkit lagi untuk melakukan _free throw_. Kegagalan _shooting_ hari ini adalah alasan untuk berlatih lebih keras esok hari."
>
> — **Coach Basket MTs Negeri 1 Pandeglang**
```

---

### File: `./src/content/pages/ekstrakurikuler.mdx`

```markdown
---
title: "Ekstrakurikuler"
meta_title: "Ekstrakurikuler MTs Negeri 1 Pandeglang - Wadah Kreasi & Prestasi"
description: "Daftar lengkap kegiatan ekstrakurikuler di MTs Negeri 1 Pandeglang. Dari organisasi, olahraga, hingga pecinta alam. Temukan bakatmu di sini."
draft: false
---

### Wadah Kreasi & Prestasi Siswa

**"Temukan Bakatmu, Ukir Prestasimu"**

---

Di MTs Negeri 1 Pandeglang, pembelajaran tidak berhenti saat bel pulang berbunyi. Kami percaya bahwa _soft skill_, kepemimpinan, dan karakter juara justru ditempa melalui kegiatan di luar kelas.

Kami menyediakan beragam pilihan ekstrakurikuler yang dikelola secara profesional untuk menampung minat dan bakat siswa yang beragam. Berikut adalah kategori kegiatan yang dapat diikuti:

---

## 1. Organisasi & Kepemimpinan

_Mencetak kader pemimpin masa depan yang disiplin, tangguh, dan peduli sesama._

### OSIM (Organisasi Siswa Intra Madrasah)

Induk organisasi siswa yang menjadi mitra madrasah dalam menggerakkan demokrasi dan kegiatan siswa.

<Button label="Selengkapnya tentang OSIM" link="/osim" style="outline" />

### Gerakan Pramuka

Wadah pembinaan karakter kemandirian, survival, dan nasionalisme melalui metode kepanduan modern.

<Button label="Jelajahi Pramuka" link="/pramuka" style="outline" />

### Paskibra (Pasukan Pengibar Bendera)

Pasukan elit pengibar bendera yang melatih kedisiplinan fisik, mental baja, dan tata upacara.

<Button label="Profil Korps Paskibra" link="/paskibra" style="outline" />

### PMR (Palang Merah Remaja)

Relawan muda kesehatan yang sigap dalam pertolongan pertama dan aksi kemanusiaan.

<Button label="Info PMR Madya" link="/pmr" style="outline" />

---

## 2. Olahraga Prestasi

_Membangun sportivitas, fisik prima, dan mental juara._

### Klub Bola Voli (Matsanepa VC)

Tim voli kebanggaan madrasah dengan tradisi juara dan pelatihan teknik tingkat lanjut.

<Button label="Lihat Klub Voli" link="/volleyball-club" style="outline" />

### Klub Futsal (Matsanepa FC)

Wadah bagi talenta sepak bola untuk mengasah _skill_ individu dan taktik permainan cepat.

<Button label="Lihat Klub Futsal" link="/futsal-club" style="outline" />

### Klub Basket (Matsanepa Hoops)

Komunitas basket yang energik, fokus pada _dribble_, _shooting_, dan strategi modern.

<Button label="Lihat Klub Basket" link="/basketball-club" style="outline" />

### Klub Bulu Tangkis (Matsanepa BC)

Pusat pelatihan teknik tepok bulu (_badminton_) yang fokus pada kelincahan dan strategi permainan.

<Button label="Lihat Klub Badminton" link="/badminton-club" style="outline" />

---

## 3. Minat, Bakat & Lingkungan

_Mengasah kreativitas, literasi, dan kepedulian terhadap alam._

### SISPALA (Siswa Pecinta Alam)

Garda terdepan konservasi lingkungan dan petualangan alam bebas yang mendukung program Adiwiyata.

<Button label="Kegiatan Pecinta Alam" link="/pecinta-alam" style="outline" />

### Jurnalistik Siswa

Komunitas literasi bagi siswa yang gemar menulis, fotografi, dan meliput berita sekolah.

<Button label="Karya Jurnalistik" link="/jurnalistik" style="outline" />

---

### Mengapa Harus Mengikuti Ekstrakurikuler?

1.  **Pengembangan Karakter:** Melatih tanggung jawab, disiplin, dan manajemen waktu.
2.  **Sosialisasi:** Memperluas pergaulan positif antar kelas dan angkatan.
3.  **Jalur Prestasi:** Sertifikat kejuaraan ekskul sangat berguna untuk mendaftar ke jenjang pendidikan selanjutnya (PPDB Jalur Prestasi).
4.  **Kesehatan Mental:** Menjadi sarana _refreshing_ yang positif dari rutinitas akademik.

> "Jangan hanya menjadi siswa yang datang, duduk, dan pulang. Jadilah siswa yang aktif, berkarya, dan meninggalkan jejak prestasi. Pilih ekskulmu sekarang!"
>
> — **Wakil Kepala Madrasah Bidang Kesiswaan**
```

---

### File: `./src/content/pages/elements.mdx`

````markdown
---
title: "Elements"
meta_title: ""
description: "this is meta description"
draft: false
---

# Heading 1

## Heading 2

### Heading 3

#### Heading 4

##### Heading 5

###### Heading 6

---

### Paragraph

Did you come here for something in particular or just general Riker-bashing? And blowing into maximum warp speed, you appeared for an instant to be in two places at once. We have a saboteur aboard. We know you’re dealing in stolen ore. But I wanna talk about the assassination attempt on Lieutenant Worf. Could someone survive inside a transporter buffer for 75 years? Fate. It protects fools, little children, and ships.

Did you come here for something in particular or just general Riker-bashing? And blowing into maximum warp speed, you appeared for an instant to be in two places at once. We have a saboteur aboard. We know you’re dealing in stolen ore. But I wanna talk about the assassination attempt on Lieutenant Worf. Could someone survive inside a transporter buffer for 75 years? Fate. It protects fools, little children, and ships.

---

### Emphasis

1. Did you come here for something in **particular** or just general

2. Did you come here for something in <ins>particular</ins>

3. _Did you come here_

4. Did you come here for **something** in particular

5. Did you come here for something in particular

6. Did you come here for something in particular

7. URLs and URLs in angle brackets will automatically get turned into links. [http://www.example.com](http://www.example.com) or

8. [http://www.example.com](http://www.example.com) and sometimes example.com (but not on Github, for example).

---

### Link

[I'm an inline-style link](https://www.google.com)

[I'm an inline-style link with title](https://www.google.com "Google's Homepage")

[I'm a reference-style link][arbitrary case-insensitive reference text]

[I'm a relative reference to a repository file](../blob/master/LICENSE)

[You can use numbers for reference-style link definitions][1]

Or leave it empty and use the [link text itself].

example.com (but not on Github, for example).

Some text to show that the reference links can follow later.

[arbitrary case-insensitive reference text]: https://www.themefisher.com
[1]: https://gethugothemes.com
[link text itself]: https://www.getjekyllthemes.com

---

### Ordered List

1. List item
2. List item
3. List item
4. List item
5. List item

---

### Unordered List

- List item
- List item
- List item
- List item
- List item

---

### Code and Syntax Highlighting

#### HTML

```html
<ul>
  <li class="nav-item">
    <a class="nav-link" href="/">Home</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="about/">About</a>
  </li>
</ul>
```

---

#### CSS

```css
img {
  vertical-align: middle;
  border: 0;
  max-width: 100%;
  height: auto;
}
```

---

#### JavaScript

```javascript
window.addEventListener("load", (e) => {
  document.querySelector(".preloader").style.display = "none";
});
```

---

### Button

<Button label="Solid" link="#" style="solid" />
<Button label="Outline" link="#" style="outline" />

---

### Quote

> Did you come here for something in particular or just general Riker-bashing? And blowing into maximum warp speed, you appeared for an instant to be in two places at once.

---

### Notice

<Notice type="note">This is a simple note.</Notice>

<Notice type="tip">This is a simple note.</Notice>

<Notice type="info">This is a simple note.</Notice>

<Notice type="warning">This is a simple note.</Notice>

---

### Tab

<Tabs client:load>

<Tab name="Tab 1">

#### Did you come here for something in particular?

Did you come here for something in particular or just general Riker-bashing? And blowing into maximum warp speed, you appeared for an instant to be in two places at once. We have a saboteur aboard. We know you’re dealing in stolen ore. But I wanna talk about the assassination attempt on Lieutenant Worf.

</Tab>

<Tab name="Tab 2">

#### I wanna talk about the assassination attempt

Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.

Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.

</Tab>

<Tab name="Tab 3">

#### We know you’re dealing in stolen ore

Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.

Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo

</Tab>

</Tabs>

---

### Table

| #   |    First     |     Last     |       Handle |
| :-- | :----------: | :----------: | -----------: |
| 1   | Row:1 Cell:1 | Row:1 Cell:2 | Row:1 Cell:3 |
| 2   | Row:2 Cell:1 | Row:2 Cell:2 | Row:2 Cell:3 |
| 3   | Row:3 Cell:1 | Row:3 Cell:2 | Row:3 Cell:3 |

---

### Accordion

<Accordion client:load title="Why should you need to do this?">

- This is a thing.
- This is a thing.
- This is a thing.
- This is a thing.
- This is a thing.

</Accordion>

<Accordion client:load title="How can I adjust Horizontal centering">

- This is a thing.
- This is a thing.
- This is a thing.
- This is a thing.
- This is a thing.

</Accordion>

<Accordion client:load title="Should you use Negative margin?">

- This is a thing.
- This is a thing.
- This is a thing.
- This is a thing.
- This is a thing.

</Accordion>

---

### Image

![image](/images/image-placeholder.png)

---

### Youtube video

<Youtube client:load id="C0DPdy98e4c" title="Play:Youtube" />

---

### Custom video

<Video width="100%" src="https://www.w3schools.com/html/mov_bbb.mp4" />
````

---

### File: `./src/content/pages/faq.mdx`

```markdown
---
title: "Pertanyaan Umum (FAQ)"
meta_title: "FAQ - Pertanyaan Umum MTs Negeri 1 Pandeglang"
description: "Temukan jawaban atas pertanyaan yang sering diajukan mengenai Pendaftaran (PPDB), Kurikulum, Ekstrakurikuler, dan Layanan di MTs Negeri 1 Pandeglang."
draft: false
---

Berikut adalah daftar pertanyaan yang sering diajukan oleh calon siswa, orang tua/wali murid, dan masyarakat umum. Silakan klik pada pertanyaan untuk melihat jawabannya.

### Penerimaan Peserta Didik Baru (PPDB)

<Accordion client:load title="Kapan pendaftaran siswa baru (PPDB) dibuka?">
  Pendaftaran Peserta Didik Baru (PPDB) biasanya dibuka mulai bulan **Februari
  hingga Mei** setiap tahunnya. Jadwal pasti dapat berubah menyesuaikan kalender
  pendidikan Kemenag. Silakan pantau website resmi atau menu [PPDB
  Online](https://daftar.mtsn1pandeglang.sch.id) untuk informasi terbaru.
</Accordion>

<Accordion client:load title="Apakah ada biaya pendaftaran?">
  MTs Negeri 1 Pandeglang berkomitmen pada zona integritas. Biaya pendaftaran
  dan operasional sekolah mengacu pada ketentuan DIPA dan Komite Madrasah yang
  transparan. Untuk jalur reguler biasanya **Gratis** formulir. Detail rincian
  daftar ulang akan disampaikan saat rapat wali murid.
</Accordion>

<Accordion client:load title="Apa saja jalur masuk yang tersedia?">
  Kami membuka beberapa jalur: 1. **Jalur Prestasi:** Menggunakan sertifikat
  kejuaraan akademik/non-akademik minimal tingkat Kabupaten. 2. **Jalur
  Tahfidz:** Bagi siswa yang memiliki hafalan Al-Qur'an minimal 1-2 Juz. 3.
  **Jalur Reguler:** Melalui tes seleksi akademik umum. 4. **Jalur Afirmasi:**
  Untuk siswa dari keluarga kurang mampu (KIP/PKH).
</Accordion>

---

### Akademik & Kurikulum

<Accordion client:load title="Kurikulum apa yang digunakan di sini?">
  Kami menggunakan **Kurikulum Merdeka** yang dipadukan dengan **Kurikulum
  Kemenag**. Pendekatan kami adalah *Kurikulum Berbasis Cinta* yang
  menyeimbangkan kecerdasan intelektual, emosional, dan spiritual.
</Accordion>

<Accordion client:load title="Apakah ada program kelas unggulan?">
  Ya, kami memiliki beberapa program kelas khusus: - **Kelas Sains & Riset:**
  Fokus pada pendalaman MIPA dan persiapan olimpiade. - **Kelas Tahfidz:** Fokus
  pada hafalan Al-Qur'an intensif. - **Kelas Digital:** Pembelajaran berbasis IT
  menggunakan perangkat tablet/laptop. - **Kelas Bilingual:** Pengantar bahasa
  Arab dan Inggris.
</Accordion>

<Accordion client:load title="Bagaimana jam belajar di MTsN 1 Pandeglang?">
  Kegiatan Belajar Mengajar (KBM) dimulai pukul **07.00 WIB** (diawali dengan
  pembiasaan sholat Dhuha & Tadarus) dan berakhir pukul **14.30 WIB**. Untuk
  kegiatan ekstrakurikuler dilaksanakan setelah jam pelajaran selesai atau di
  hari Sabtu.
</Accordion>

---

### Sarana & Layanan

<Accordion client:load title="Apakah boleh membawa HP ke madrasah?">
  Secara umum, siswa **tidak diperkenankan** membawa Smartphone untuk
  menghindari penyalahgunaan dan gangguan fokus belajar, kecuali ada instruksi
  khusus dari guru mata pelajaran untuk kebutuhan KBM Digital (biasanya
  dititipkan di loker kelas/wali kelas).
</Accordion>

<Accordion client:load title="Bagaimana cara melegalisir ijazah alumni?">
  Kami sudah memiliki layanan **PTSP (Pelayanan Terpadu Satu Pintu)**. Alumni
  bisa datang langsung membawa fotokopi ijazah asli ke gedung PTSP pada jam
  kerja (Senin-Jumat, 08.00 - 15.00 WIB). Layanan ini **Gratis** dan bisa
  ditunggu (±15 menit).
</Accordion>

<Accordion client:load title="Apakah tersedia Asrama/Pondok Pesantren?">
  Saat ini MTs Negeri 1 Pandeglang belum menyediakan asrama internal. Namun,
  banyak siswa kami yang tinggal di pondok pesantren di sekitar lingkungan
  madrasah (Ciekek, Kaduhejo, dll) yang bermitra dengan masyarakat sekitar.
</Accordion>

---

<Notice type="info">
  Tidak menemukan jawaban yang Anda cari? Silakan hubungi kami langsung melalui
  WhatsApp PTSP di pojok kanan bawah atau melalui halaman [Hubungi
  Kami](/contact).
</Notice>
```

---

### File: `./src/content/pages/footsal-club.mdx`

```markdown
---
title: "Klub Futsal (MATSANEPA FC)"
meta_title: "Futsal Club MTs Negeri 1 Pandeglang - Skill & Strategi"
description: "Membentuk tim futsal yang solid, taktis, dan bermental juara. Wadah penyaluran bakat sepak bola siswa MTs Negeri 1 Pandeglang dengan pelatihan profesional."
draft: false
---

### Lari Cepat, Umpan Akurat, Gol Dahsyat

**"Fair Play di Hati, Prestasi di Nanti"**

---

Klub Futsal MTs Negeri 1 Pandeglang (MATSANEPA FC) adalah rumah bagi talenta-talenta muda berbakat di dunia sepak bola mini. Kami memadukan _skill_ individu dengan kecerdasan taktik untuk menciptakan permainan yang indah dan efektif.

Bagi kami, futsal bukan sekadar menendang bola ke gawang. Ini adalah seni mengelola ruang sempit, mengambil keputusan sepersekian detik, dan menjaga kekompakan tim di bawah tekanan.

### Visi Permainan

Kami mengadopsi filosofi permainan futsal modern:

1.  **Cepat & Dinamis:** Mengutamakan sirkulasi bola yang cepat dan pergerakan tanpa bola.
2.  **Cerdas:** Bermain menggunakan otak, membaca celah pertahanan lawan.
3.  **Respek:** Menjunjung tinggi sportivitas di dalam dan di luar lapangan.

---

### Kurikulum Latihan

Program latihan dirancang sistematis untuk mencetak pemain yang komplet:

#### 1. Teknik Dasar (Fundamentals)

Penguasaan bola adalah kunci.

- **Passing & Control:** Akurasi umpan pendek dan kontrol bola lengket.
- **Dribbling:** Teknik melewati lawan dalam situasi 1 vs 1.
- **Shooting:** Teknik tendangan keras dan terarah (ujung kaki/concong).

#### 2. Taktik & Strategi (Game Play)

Memahami cara bermain sebagai unit.

- **Rotasi Pemain:** Pergerakan memutar untuk membongkar pertahanan.
- **Set Piece:** Strategi bola mati (Kick-in, Corner kick, Free kick).
- **Defense System:** Pola pertahanan _Man-to-Man_ dan _Zone Defense_.
- **Power Play:** Strategi menyerang total saat tertinggal di menit akhir.

#### 3. Fisik & Mental

- Latihan kelincahan (_agility_) dan kecepatan (_speed_).
- Simulasi pertandingan untuk melatih mental juara.

---

### Liga & Kompetisi

Kami aktif berpartisipasi dalam berbagai jenjang kompetisi untuk menambah jam terbang:

- **Liga Futsal Pelajar:** Kompetisi rutin antar sekolah se-Kabupaten.
- **Classmeeting Cup:** Ajang pencarian bakat internal madrasah.
- **Friendly Match:** Pertandingan persahabatan melawan sekolah tetangga setiap bulan.

### Fasilitas

- **Lapangan Multifungsi:** Area latihan yang aman dan representatif.
- **Peralatan Latihan:** _Cone_, _marker_, rompi latihan, dan bola standar futsal.

---

> "Kemenangan sejati bukan hanya skor akhir di papan skor, tapi bagaimana cara kita bermain sebagai tim. Di sini, _skill_ individu memenangkan pertandingan, tapi kerjasama tim memenangkan kejuaraan."
>
> — **Pelatih Futsal MTs Negeri 1 Pandeglang**
```

---

### File: `./src/content/pages/guru.mdx`

```markdown
---
title: "Guru"
meta_title: "Guru MTs Negeri 1 Pandeglang"
description: "Guru MTs Negeri 1 Pandeglang"
draft: true
---

MTs Negeri 1 Pandeglang memiliki tenaga pengajar yang berdedikasi tinggi dan berkompeten di bidangnya masing-masing. Para guru di MTs Negeri 1 Pandeglang berkomitmen untuk memberikan pendidikan yang berkualitas dan mendukung perkembangan akademik serta personal siswa-siswi.

### Tujuan Halaman Guru

Halaman Guru MTs Negeri 1 Pandeglang bertujuan untuk:

1. Memperkenalkan tenaga pengajar kepada siswa, orang tua, dan masyarakat.
2. Memberikan informasi mengenai latar belakang, kompetensi, dan pengalaman para guru.
3. Meningkatkan transparansi dan akuntabilitas dalam pengelolaan sekolah.
4. Membangun komunikasi yang baik antara guru, siswa, dan orang tua.

## Guru Mata Pelajaran

### Guru Matematika

**Nama:** Bapak Abdul Rahman, S.Si.  
**Latar Belakang:** Sarjana Sains dari Institut Teknologi Bandung (ITB)  
**Pengalaman:** 10 tahun mengajar Matematika  
**Komitmen:** Meningkatkan pemahaman konsep matematika melalui pendekatan kontekstual.

### Guru Bahasa Inggris

**Nama:** Ibu Ratna Dewi, S.Pd.  
**Latar Belakang:** Sarjana Pendidikan dari Universitas Indonesia (UI)  
**Pengalaman:** 8 tahun mengajar Bahasa Inggris  
**Komitmen:** Meningkatkan kemampuan berbahasa Inggris siswa dengan metode interaktif.

### Guru Ilmu Pengetahuan Alam

**Nama:** Bapak Ahmad Fikri, M.Sc.  
**Latar Belakang:** Magister Sains dari Universitas Gadjah Mada (UGM)  
**Pengalaman:** 12 tahun mengajar Ilmu Pengetahuan Alam  
**Komitmen:** Membantu siswa memahami konsep sains melalui eksperimen dan praktik.

### Guru Ilmu Pengetahuan Sosial

**Nama:** Ibu Siti Zubaidah, M.Pd.  
**Latar Belakang:** Magister Pendidikan dari Universitas Negeri Jakarta (UNJ)  
**Pengalaman:** 9 tahun mengajar Ilmu Pengetahuan Sosial  
**Komitmen:** Mendorong siswa untuk kritis dan analitis dalam memahami fenomena sosial.

## Guru Keterampilan dan Seni

### Guru Seni dan Budaya

**Nama:** Ibu Maya Puspita, S.Sn.  
**Latar Belakang:** Sarjana Seni dari Institut Seni Indonesia (ISI)  
**Pengalaman:** 7 tahun mengajar Seni dan Budaya  
**Komitmen:** Mengembangkan kreativitas siswa melalui berbagai bentuk seni.

### Guru Pendidikan Jasmani

**Nama:** Bapak Dedi Sutrisno, S.Pd.  
**Latar Belakang:** Sarjana Pendidikan dari Universitas Pendidikan Indonesia (UPI)  
**Pengalaman:** 10 tahun mengajar Pendidikan Jasmani  
**Komitmen:** Meningkatkan kebugaran fisik dan kesehatan siswa melalui olahraga.

---

> "Guru di MTs Negeri 1 Pandeglang adalah pilar utama dalam proses pembelajaran. Kami berkomitmen untuk memberikan pendidikan yang berkualitas dan mendukung perkembangan akademik serta personal siswa-siswi." - Kepala MTs Negeri 1 Pandeglang
```

---

### File: `./src/content/pages/jurnalistik.mdx`

```markdown
---
title: "Jurnalistik Siswa"
meta_title: "Jurnalistik MTs Negeri 1 Pandeglang - Suara Kreativitas Siswa"
description: "Wadah literasi dan kreativitas siswa. Melatih kemampuan menulis, fotografi, dan reportase untuk merekam jejak prestasi madrasah."
draft: false
---

### Pena Tajam, Fakta Terkam

**"Menulis untuk Mengabadi, Memotret untuk Mewarta"**

---

Ekstrakurikuler Jurnalistik MTs Negeri 1 Pandeglang (Siswa Pers Matsanepa) adalah komunitas literasi yang bergerak di bidang peliputan, penulisan, dan publikasi. Kami adalah **mata dan telinga** madrasah, merekam setiap momen berharga dan menyajikannya dalam bentuk karya yang inspiratif.

Di era digital ini, kami bertransformasi menjadi _Content Creator_ yang cerdas, memerangi berita bohong (hoax) dengan fakta, dan menyebarkan kabar positif tentang prestasi madrasah ke dunia luar.

### Divisi Kreatif

Kami membagi peran agar setiap anggota dapat spesifik mengembangkan minatnya:

#### 1. Divisi Redaksi (Penulis)

Jantungnya jurnalistik.

- **Reporter:** Melakukan wawancara dan reportase kegiatan sekolah.
- **Penulis Artikel/Opini:** Menuangkan ide kritis tentang isu pendidikan dan remaja.
- **Sastra:** Menulis cerpen, puisi, dan resensi buku untuk mading atau web sekolah.

#### 2. Divisi Fotografi & Videografi

Mata lensa yang menangkap momen.

- **Fotografi Jurnalistik:** Teknik mengambil foto berita yang bercerita.
- **Video Reportase:** Membuat liputan berita video (vlog) kegiatan sekolah.
- **Editing:** Belajar _software_ editing foto dan video dasar.

#### 3. Divisi Mading & Medsos

Wajah publikasi karya.

- **Mading Sekolah:** Mengelola papan majalah dinding dengan tata letak artistik.
- **Admin Media Sosial:** Mengelola Instagram/Facebook madrasah dengan konten kreatif dan _caption_ menarik.

---

### Program Unggulan

- **Penerbitan Buletin/Majalah Sekolah:** Karya kolektif semesteran yang berisi kumpulan berita, profil siswa berprestasi, dan karya sastra.
- **Pelatihan Jurnalistik Dasar (PJTD):** Workshop mengundang wartawan profesional atau penulis tamu.
- **Kunjungan Media:** _Study tour_ ke kantor redaksi koran atau stasiun TV lokal.
- **Liputan Event Besar:** Menjadi tim dokumentasi resmi saat Porseni, Perpisahan, atau PHBI.

---

### Manfaat Bergabung

1.  **Berpikir Kritis:** Melatih kemampuan menganalisis informasi dan melihat peristiwa dari berbagai sudut pandang.
2.  **Percaya Diri:** Terbiasa mewawancarai guru, kepala sekolah, bahkan pejabat tamu.
3.  **Jejak Digital Positif:** Karya tulisan dan foto yang dipublikasikan menjadi portofolio berharga untuk masa depan.

---

> "Jurnalisme adalah draf pertama dari sejarah. Di sini kami belajar bahwa kata-kata memiliki kekuatan untuk menginspirasi perubahan. Setiap goresan pena kami adalah dedikasi untuk almamater tercinta."
>
> — **Pemimpin Redaksi Siswa**
```

---

### File: `./src/content/pages/kebijakan-privasi.md`

```markdown
---
title: "Kebijakan Privasi"
meta_title: "Kebijakan Privasi MTs Negeri 1 Pandeglang"
description: "Kebijakan Privasi MTs Negeri 1 Pandeglang"
draft: false
---

### Kebijakan Privasi MTs Negeri 1 Pandeglang

#### Tanggung Jawab Kontributor

Kontributor diharapkan untuk menjaga integritas dan akurasi informasi yang disediakan di situs web MTs Negeri 1 Pandeglang. Konten yang dipublikasikan harus sesuai dengan nilai dan misi sekolah serta tidak melanggar hak cipta atau privasi individu lain. Kontributor juga bertanggung jawab untuk memperbarui informasi secara berkala guna memastikan relevansi dan keakuratannya.

#### Pengumpulan Informasi Pribadi

MTs Negeri 1 Pandeglang mengumpulkan informasi pribadi seperti nama, alamat email, dan nomor telepon untuk keperluan pendaftaran, komunikasi, dan penyediaan layanan yang lebih baik. Informasi yang dikumpulkan hanya akan digunakan untuk tujuan yang telah disebutkan dan tidak akan dibagikan kepada pihak ketiga tanpa izin dari pemilik informasi.

#### Perlindungan Informasi Pribadi

MTs Negeri 1 Pandeglang berkomitmen untuk melindungi informasi pribadi yang dikumpulkan. Kami menggunakan berbagai metode keamanan untuk mencegah akses, penggunaan, atau pengungkapan yang tidak sah terhadap informasi pribadi. Pengguna diharapkan untuk menjaga kerahasiaan akun mereka dan segera melaporkan jika ada indikasi pelanggaran keamanan.

#### Perubahan Kebijakan Privasi

1. MTs Negeri 1 Pandeglang selalu berusaha untuk mengikuti perkembangan terbaru dalam teknologi dan regulasi privasi.
2. Setiap perubahan dalam kebijakan privasi akan diumumkan di situs web kami dan pengguna akan diberitahu melalui email.
3. Pengguna dianjurkan untuk secara berkala memeriksa kebijakan privasi ini untuk mengetahui pembaruan terbaru.
4. Dengan terus menggunakan layanan kami setelah perubahan kebijakan, pengguna dianggap menyetujui perubahan tersebut.
```

---

### File: `./src/content/pages/kurikulum.mdx`

```markdown
---
title: "Kurikulum Berbasis Cinta"
meta_title: "Kurikulum Berbasis Cinta & Merdeka Belajar MTs Negeri 1 Pandeglang"
description: "Pendekatan pendidikan humanis di MTs Negeri 1 Pandeglang yang memadukan standar Kurikulum Merdeka dengan kasih sayang, kenyamanan, dan pembentukan karakter."
draft: false
---

### Filosofi Pendidikan Humanis

**"Mendidik dengan Hati, Menginspirasi dengan Aksi"**

---

Di MTs Negeri 1 Pandeglang, kami menerjemahkan Kurikulum Merdeka lebih dari sekadar standar akademik nasional. Kami mengusung paradigma **Kurikulum Berbasis Cinta**.

Ini adalah pendekatan revolusioner yang menempatkan kebahagiaan siswa, keamanan emosional, dan kasih sayang guru sebagai fondasi utama. Kami percaya bahwa ketika hati siswa tersentuh dan merasa dicintai, akal mereka akan terbuka lebar untuk menyerap ilmu pengetahuan terumit sekalipun.

### Pilar Utama: C.I.N.T.A

Implementasi kurikulum kami dibangun di atas lima nilai inti:

**C - Cerdas & Critical Thinking**
Pembelajaran yang merangsang nalar kritis (HOTS), bukan sekadar menghafal, melainkan memahami esensi dan solusi masalah.

**I - Inovatif & Inklusif**
Ruang belajar yang menerima keragaman potensi siswa. Setiap anak adalah bintang dengan cahayanya masing-masing.

**N - Nyaman & Menyenangkan**
Menciptakan _Joyful Learning_. Sekolah bukan tempat yang menakutkan, melainkan rumah kedua yang dirindukan.

**T - Takwa & Beradab**
Ilmu tanpa adab adalah kesia-siaan. Kami mengutamakan pembentukan karakter Islami sebelum penguasaan materi.

**A - Adaptif Digital**
Mengintegrasikan teknologi terkini agar siswa siap menghadapi tantangan masa depan tanpa kehilangan jati diri.

---

### Struktur Program Pembelajaran

Kami menyusun arsitektur kurikulum yang seimbang antara kebutuhan duniawi dan ukhrawi:

#### 1. Intrakurikuler (Akademik & Agama)

_Penguatan fondasi keilmuan yang solid._

- **Sains & Teknologi:** Matematika, IPA (Fisika/Biologi), Informatika.
- **Sosial & Humaniora:** IPS, Bahasa Indonesia, Bahasa Inggris, PPKn.
- **Ilmu Keislaman (Kemenag):** Al-Qur'an Hadits, Akidah Akhlak, Fikih, SKI, Bahasa Arab.

#### 2. Kokurikuler (P5 & PPRA)

_Proyek Penguatan Profil Pelajar Pancasila & Rahmatan Lil Alamin._

Siswa diajak turun langsung ke lapangan untuk menyelesaikan masalah nyata (Project Based Learning), seperti kewirausahaan, gaya hidup berkelanjutan, dan kearifan lokal Banten.

#### 3. Program Unggulan (Excellence)

_Menu tambahan untuk percepatan potensi._

- **Tahfidz Camp:** Program intensif menghafal Al-Qur'an.
- **Bilingual Class:** Pembiasaan bahasa asing (Arab & Inggris) dalam keseharian.
- **Klinik Sains:** Pendalaman materi untuk persiapan kompetisi/olimpiade.

---

### Pendekatan Personal (Personalized Learning)

Dalam Kurikulum Berbasis Cinta, kami tidak membandingkan ikan dengan burung dalam hal kemampuan memanjat pohon.

- **Asesmen Diagnostik:** Mengenali gaya belajar siswa di awal masuk (Visual, Auditori, atau Kinestetik).
- **Teaching at the Right Level:** Memberikan materi sesuai dengan tingkat pemahaman siswa, bukan memaksakan target kurikulum semata.
- **Sentuhan Parenting:** Guru berperan sebagai orang tua asuh yang siap mendengar keluh kesah siswa, tidak hanya soal pelajaran, tapi juga kehidupan.

---

> "Pendidikan tanpa cinta hanya akan menghasilkan kecerdasan tanpa hati nurani. Kurikulum kami dirancang untuk menyentuh akal dan jiwa sekaligus, memastikan siswa tumbuh menjadi pribadi yang bahagia dan prestatif."
>
> — **Wakil Kepala Bidang Kurikulum**
```

---

### File: `./src/content/pages/osim.mdx`

```markdown
---
title: "OSIM (Organisasi Siswa Intra Madrasah)"
meta_title: "OSIM MTs Negeri 1 Pandeglang - Inkubator Pemimpin Muda"
description: "Pusat kepemimpinan siswa MTs Negeri 1 Pandeglang. Wadah aspirasi, kreasi, dan inovasi siswa dalam membangun madrasah yang unggul dan demokratis."
draft: false
---

### Inkubator Pemimpin Masa Depan

**"Berpikir Kritis, Bertindak Demokratis, Mengabdi dengan Hati"**

---

Organisasi Siswa Intra Madrasah (OSIM) MTs Negeri 1 Pandeglang adalah satu-satunya wadah organisasi siswa resmi yang diakui di lingkungan madrasah. Kami bukan sekadar pelaksana kegiatan, melainkan mitra strategis madrasah dalam membangun iklim akademik dan sosial yang positif.

OSIM hadir sebagai laboratorium kepemimpinan nyata, tempat di mana siswa belajar berdemokrasi, menyusun kebijakan, mengeksekusi program, dan melayani kebutuhan seluruh siswa.

### Visi & Misi Strategis

**Visi:**
Menjadikan OSIM sebagai organisasi yang aspiratif, inovatif, dan berintegritas dalam mewujudkan siswa madrasah yang berkarakter Pancasila dan berakhlakul karimah.

**Misi Utama:**

1.  Membangun budaya organisasi yang profesional dan kekeluargaan.
2.  Menampung dan memperjuangkan aspirasi siswa secara santun.
3.  Menyelenggarakan kegiatan yang meningkatkan _soft skill_ dan _hard skill_ siswa.

---

### Struktur & Program Unggulan

OSIM bergerak dalam berbagai bidang (sekbid) yang mencakup seluruh aspek kehidupan siswa:

#### 1. Legislasi & Aspirasi (MPK)

_Majelis Perwakilan Kelas._
Forum tertinggi siswa untuk menyuarakan ide dan evaluasi. Kami rutin mengadakan **Forum Aspirasi Siswa** untuk mendengar masukan langsung dari setiap kelas demi perbaikan madrasah.

#### 2. Keagamaan & Budi Pekerti

Menggerakkan syiar Islam di madrasah melalui program:

- Peringatan Hari Besar Islam (PHBI) yang meriah dan bermakna.
- Program infaq/sedekah Jumat.
- Pengelolaan kegiatan Ramadhan (Pesantren Kilat).

#### 3. Pengembangan Minat & Bakat (Event Organizer)

Menjadi motor penggerak _event_ besar madrasah yang dinanti-nanti:

- **CLASSMEETING:** Ajang kompetisi olahraga dan seni antar kelas.
- **PORSENI:** Pekan Olahraga dan Seni Madrasah.
- **Festival Bulan Bahasa:** Lomba literasi, pidato, dan karya tulis.

#### 4. Kaderisasi & LDKS

Menjamin regenerasi kepemimpinan yang berkualitas melalui **Latihan Dasar Kepemimpinan Siswa (LDKS)**. Program intensif ini menempa mental calon pengurus baru dengan materi manajemen organisasi, _public speaking_, dan _problem solving_.

---

### Keunggulan Bergabung dengan OSIM

Menjadi pengurus OSIM MTs Negeri 1 Pandeglang memberikan privilese pengembangan diri yang luar biasa:

- **Networking Luas:** Membangun relasi dengan guru, alumni, dan organisasi sekolah lain.
- **Project Management:** Belajar mengelola _event_ berskala besar, mulai dari perencanaan proposal, pencarian dana (sponsorship), hingga eksekusi lapangan.
- **Public Speaking:** Terlatih berbicara di depan umum, memimpin rapat, dan bernegosiasi.
- **Problem Solving:** Terbiasa menghadapi masalah nyata dan mencari solusi cepat di bawah tekanan.

---

### Fasilitas & Dukungan

Madrasah memberikan dukungan penuh bagi operasional OSIM:

- **Sekretariat OSIM:** Ruang kerja khusus yang nyaman untuk rapat dan administrasi.
- **Anggaran Kegiatan:** Dukungan dana madrasah untuk setiap program kerja yang disetujui.
- **Mentoring Guru:** Bimbingan langsung dari Wakil Kepala Madrasah Bidang Kesiswaan dan Pembina OSIM yang kompeten.

---

> "Di OSIM, kami tidak belajar untuk menjadi 'bos', kami belajar untuk menjadi 'pemimpin' yang melayani. Karena kepemimpinan bukan tentang jabatan, melainkan tentang seberapa besar dampak positif yang bisa kita berikan untuk orang lain."
>
> — **Ketua OSIM MTs Negeri 1 Pandeglang**
```

---

### File: `./src/content/pages/paskibra.mdx`

```markdown
---
title: "Korps Paskibra"
meta_title: "Paskibra MTs Negeri 1 Pandeglang"
description: "Membentuk kader pemimpin bangsa yang disiplin, tangguh, dan berkarakter Pancasila melalui pendidikan kepaskibrakaan di MTs Negeri 1 Pandeglang."
draft: false
---

### Garda Terdepan Patriotisme

**"Disiplin adalah Napasku, Kesetiaan adalah Kebanggaanku"**

---

Pasukan Pengibar Bendera (Paskibra) MTs Negeri 1 Pandeglang bukan sekadar kegiatan ekstrakurikuler baris-berbaris. Ini adalah **kawah candradimuka** bagi siswa-siswi terpilih untuk ditempa menjadi pribadi yang memiliki karakter baja, mental juara, dan jiwa nasionalisme yang tinggi.

Sebagai salah satu ekstrakurikuler paling prestisius, Paskibra MTsN 1 Pandeglang (biasa dijuluki _Satria Pandeglang_) berkomitmen mencetak kader pemimpin yang siap tampil prima dalam tugas negara maupun kehidupan sehari-hari.

### Filosofi Pembinaan: Tri Matra Paskibra

Kami menerapkan tiga dimensi pembinaan utama:

1.  **Fisik yang Prima:** Membangun ketahanan fisik melalui latihan terukur.
2.  **Mental Baja:** Membentuk keberanian, ketenangan di bawah tekanan, dan tanggung jawab.
3.  **Intelektual:** Memahami wawasan kebangsaan, tata upacara, dan kepemimpinan.

---

### Program & Kegiatan Unggulan

Kurikulum pelatihan kami dirancang sistematis untuk menghasilkan pasukan yang presisi dan estetis:

#### 1. Pendidikan Dasar & Latihan (Diklat)

Fase awal pembentukan karakter. Anggota baru diperkenalkan dengan dasar-dasar kepaskibrakaan, PBB (Peraturan Baris Berbaris) dasar, dan penanaman etika kedisiplinan.

#### 2. Spesialisasi PBB & Variasi Formasi

Siswa dilatih tidak hanya baris-berbaris statis, tetapi juga:

- **PBB Murni:** Ketepatan gerakan sesuai Perpang TNI.
- **Variasi & Formasi:** Kreativitas manuver barisan yang indah dan dinamis untuk kompetisi.

#### 3. Petugas Protokoler Upacara

Menjadi pelaksana utama setiap Upacara Bendera hari Senin, Peringatan Hari Besar Nasional (HUT RI, Hari Santri, Hari Amal Bhakti), dan acara resmi madrasah lainnya dengan standar Tata Upacara Sipil/Militer yang ketat.

#### 4. Kompetisi LKBB (Lomba Ketangkasan Baris Berbaris)

Tim inti Paskibra rutin diterjunkan dalam berbagai ajang lomba LKBB tingkat Kabupaten, Provinsi, hingga Nasional untuk menguji mental dan meraih prestasi.

#### 5. Malam Keakraban & Jiwa Korsa

Membangun _Esprit de Corps_ (Jiwa Korsa) yang kuat. Kami menanamkan rasa persaudaraan bahwa sakit satu sakit semua, senang satu senang semua.

---

### Mengapa Bergabung dengan Paskibra?

Bergabung dengan Paskibra MTs Negeri 1 Pandeglang memberikan nilai tambah yang signifikan bagi siswa:

- **Mentoring Profesional:** Dilatih langsung oleh purna Paskibraka dan pelatih berpengalaman yang memiliki sertifikasi.
- **Jalur Prestasi:** Kesempatan besar untuk masuk ke SMA/MA favorit melalui jalur prestasi non-akademik (sertifikat kejuaraan).
- **Manajemen Waktu:** Siswa terlatih membagi waktu antara akademik dan organisasi dengan sangat baik.
- **Postur & Kesehatan:** Latihan rutin memperbaiki postur tubuh menjadi tegap dan meningkatkan kesehatan fisik secara menyeluruh.

---

### Galeri Prestasi

Paskibra MTs Negeri 1 Pandeglang telah mengukir berbagai tinta emas, di antaranya:

- Juara Umum LKBB Tingkat Kabupaten Pandeglang.
- Juara Danton Terbaik & Variasi Formasi Terbaik.
- Pengirim perwakilan Paskibraka Tingkat Kabupaten setiap tahunnya.

---

> "Kami tidak hanya diajarkan untuk mengibarkan bendera, tapi kami diajarkan bagaimana cara menghormatinya dengan segenap jiwa dan raga. Paskibra adalah tempat di mana keringat berubah menjadi emas prestasi."
>
> — **Komandan Satuan Paskibra**
```

---

### File: `./src/content/pages/pecinta-alam.mdx`

```markdown
---
title: "SISPALA (Siswa Pecinta Alam)"
meta_title: "SISPALA MTs Negeri 1 Pandeglang - Penjaga Kelestarian Alam"
description: "Membentuk generasi muda yang tangguh, peduli lingkungan, dan memiliki kemampuan survival. Garda terdepan program Adiwiyata MTs Negeri 1 Pandeglang."
draft: false
---

### Sahabat Alam, Penjaga Kehidupan

**"Lestari Alamku, Lestari Madrasahku"**

---

SISPALA (Siswa Pecinta Alam) MTs Negeri 1 Pandeglang bukan sekadar komunitas penikmat alam, melainkan gerakan edukasi untuk mencetak kader konservasi yang militan dan cerdas. Kami adalah garda terdepan dalam menyukseskan program **Madrasah Adiwiyata**.

Di sini, siswa tidak hanya diajarkan untuk mendaki gunung atau menjelajah hutan, tetapi dididik untuk memahami filosofi bahwa _"Alam bukan warisan nenek moyang, melainkan titipan anak cucu yang harus dijaga."_

### Filosofi & Kode Etik

Setiap anggota SISPALA memegang teguh Kode Etik Pecinta Alam:

1.  **Tidak mengambil apa pun kecuali gambar.**
2.  **Tidak meninggalkan apa pun kecuali jejak.**
3.  **Tidak membunuh apa pun kecuali waktu.**

---

### Divisi & Fokus Kegiatan

Kami membagi fokus kegiatan menjadi tiga pilar utama untuk memastikan pengembangan _skill_ yang menyeluruh:

#### 1. Divisi Gunung Hutan (Mountaineering)

Melatih ketahanan fisik dan mental melalui interaksi langsung dengan alam liar.

- **Navigasi Darat:** Kemampuan membaca peta, kompas, dan orientasi medan.
- **Manajemen Perjalanan:** Perencanaan logistik dan rute ekspedisi.
- **Survival Dasar:** Teknik bertahan hidup di alam bebas (membuat bivak, mencari air/makanan, api).

#### 2. Divisi Lingkungan Hidup (Konservasi)

Fokus pada aksi nyata penyelamatan lingkungan di sekolah dan masyarakat.

- **Bank Sampah & Daur Ulang:** Mengelola limbah sekolah menjadi barang bernilai guna.
- **Green House & Apotek Hidup:** Perawatan tanaman obat dan pembibitan.
- **Operasi Semut:** Gerakan bersih gunung dan bersih lingkungan madrasah.

#### 3. Divisi SAR & Kemanusiaan (Search and Rescue)

Membekali siswa dengan kemampuan pertolongan pertama dan tanggap bencana.

- **PPGD:** Pertolongan Pertama Gawat Darurat di lapangan.
- **Mitigasi Bencana:** Edukasi kesiapsiagaan menghadapi bencana alam.

---

### Mengapa Bergabung dengan SISPALA?

Bergabung dengan SISPALA MTs Negeri 1 Pandeglang membentuk karakter yang unik dan kuat:

- **Mentalitas Baja:** Terbiasa menghadapi kesulitan dan tantangan di alam membuat siswa tidak mudah menyerah dalam kehidupan nyata.
- **Solidaritas Tanpa Batas:** Ikatan persaudaraan yang terbentuk saat susah-senang bersama di alam liar sangatlah kuat.
- **Kecerdasan Ekologis:** Memahami isu lingkungan global dan menjadi agen perubahan di masyarakat.
- **Kemandirian:** Terlatih memasak, mendirikan tenda, dan mengurus diri sendiri jauh dari kenyamanan rumah.

---

### Fasilitas & Ekspedisi

Untuk menunjang kegiatan, kami didukung oleh:

- **Peralatan Outdoor Standar:** Tenda dome, alat masak (nesting), kompas, dan alat navigasi.
- **Mentor Berpengalaman:** Dibimbing oleh praktisi pecinta alam dan guru pendamping bersertifikat.
- **Agenda Ekspedisi Tahunan:** Pendakian gunung (Gunung Karang, Pulosari) dan Kemah Konservasi.

---

> "Kami belajar dari alam bahwa hal terindah tidak didapat dengan instan. Puncak gunung tidak akan rendah bagi mereka yang terus melangkah. Jadilah tangguh seperti karang, dan menyejukkan seperti embun pagi."
>
> — **Ketua SISPALA MTs Negeri 1 Pandeglang**
```

---

### File: `./src/content/pages/pelayanan.mdx`

```markdown
---
title: "Layanan Digital (PTSP)"
meta_title: "PTSP MTs Negeri 1 Pandeglang - Pelayanan Cepat & Transparan"
description: "Akses layanan administrasi pendidikan satu pintu yang modern, transparan, dan akuntabel. Melayani legalisir, surat keterangan, dan informasi akademik secara terpadu."
draft: false
---

import ServiceRating from "@/helpers/ServiceRating";

### Birokrasi Bersih, Melayani Sepenuh Hati

**"Cepat, Tepat, Transparan, dan Akuntabel"**

---

Pelayanan Terpadu Satu Pintu (PTSP) MTs Negeri 1 Pandeglang adalah wujud reformasi birokrasi di lingkungan madrasah. Kami menghapus stigma pelayanan publik yang berbelit-belit menjadi layanan yang **simpel, pasti, dan ramah teknologi**.

Sebagai bagian dari Zona Integritas, PTSP kami menjamin seluruh layanan administrasi **BEBAS BIAYA (Gratis)** dan **BEBAS PUNGLI**, memberikan kenyamanan dan kepastian bagi wali murid, alumni, dan masyarakat luas.

### Standar Maklumat Pelayanan

Kami berkomitmen menyelenggarakan pelayanan sesuai standar operasional prosedur (SOP) yang telah ditetapkan dan siap menerima sanksi apabila melanggar maklumat ini.

1.  **Kepastian Waktu:** Setiap jenis layanan memiliki estimasi waktu penyelesaian yang jelas.
2.  **Transparansi Persyaratan:** Tidak ada persyaratan "siluman", semua tercantum jelas di loket dan website.
3.  **Kemudahan Akses:** Layanan dapat diakses secara _walk-in_ (datang langsung) maupun _online_.

---

### Katalog Layanan Unggulan

Kami melayani berbagai kebutuhan administrasi kependidikan secara terpusat:

#### 1. Layanan Kesiswaan & Akademik

- Legalisir Ijazah & Raport (Selesai dalam 15 menit jika berkas lengkap).
- Surat Keterangan Pindah Sekolah (Mutasi Masuk/Keluar).
- Penerbitan Surat Keterangan Kesalahan Penulisan Ijazah.
- Layanan NISN dan Verval PD.

#### 2. Layanan Kepegawaian & Tata Usaha

- Pengurusan Kenaikan Pangkat & Berkala Guru/Pegawai.
- Surat Keterangan Aktif Melaksanakan Tugas.
- Layanan Persuratan Dinas Masuk/Keluar.

#### 3. Layanan Informasi & Pengaduan

- Pusat Informasi PPDB (Penerimaan Peserta Didik Baru).
- Layanan Pengaduan Masyarakat (_Whistleblowing System_).
- Konsultasi Akademik Wali Murid.

---

### Inovasi Layanan Digital

Untuk mempermudah akses di era digital, kami menghadirkan terobosan:

- **E-Tamu:** Buku tamu digital untuk pencatatan pengunjung yang rapi dan aman.
- **Tracking Berkas:** Pemohon dapat memantau status penyelesaian berkas melalui WhatsApp Gateway.
- **Kotak Saran Digital:** Kanal aspirasi _real-time_ untuk evaluasi kepuasan pelayanan.

### Fasilitas Ruang Pelayanan

Kami mendesain ruang PTSP senyaman lobi perbankan untuk kenyamanan Anda:

- Ruang tunggu ber-AC dengan kursi ergonomis.
- Mesin antrian digital.
- Fasilitas air minum gratis & _charging station_.
- Akses ramah disabilitas (kursi roda & jalur landai).

---

<div className="my-10 max-w-lg mx-auto">
  <ServiceRating client:load />
</div>

> "Kepuasan Anda adalah kebanggaan kami. Kami hadir untuk memangkas birokrasi, bukan menambahnya. PTSP MTs Negeri 1 Pandeglang siap melayani dengan senyum, salam, dan sapa."
>
> — **Kepala Urusan Tata Usaha**
```

---

### File: `./src/content/pages/pmr.mdx`

```markdown
---
title: "PMR (Palang Merah Remaja)"
meta_title: "PMR MTs Negeri 1 Pandeglang - Relawan Muda Kemanusiaan"
description: "Mencetak relawan muda yang sigap, tangguh, dan peduli. Wadah pembinaan pertolongan pertama, kesehatan remaja, dan aksi kemanusiaan di MTs Negeri 1 Pandeglang."
draft: false
---

### Relawan Muda, Wira Kemanusiaan

**"Siamo Tutti Fratelli - Kita Semua Bersaudara"**

---

Palang Merah Remaja (PMR) Unit MTs Negeri 1 Pandeglang adalah wadah pembinaan generasi muda yang bergerak di bidang kemanusiaan dan kesehatan. Kami mendidik siswa untuk menjadi **"Dokter Kecil"** yang sigap dalam pertolongan pertama, sekaligus menjadi **"Duta Kesehatan"** bagi teman sebayanya.

Berlandaskan pada 7 Prinsip Dasar Gerakan Palang Merah dan Bulan Sabit Merah Internasional, PMR Madya (Tingkat SMP/MTs) kami fokus pada pembentukan karakter peduli (_care_), responsif, dan kerjasama.

### Tri Bakti PMR

Seluruh program kerja kami mengacu pada filosofi Tri Bakti PMR:

1.  **Meningkatkan Keterampilan Hidup Sehat:** Menjadi contoh gaya hidup bersih dan sehat bagi lingkungan sekitar.
2.  **Berkarya dan Berbakti di Masyarakat:** Terjun langsung membantu sesama yang membutuhkan.
3.  **Mempererat Persahabatan Nasional dan Internasional:** Menjalin relasi positif tanpa memandang perbedaan.

---

### Kurikulum & Materi Pelatihan

Anggota PMR dilatih secara intensif dengan kurikulum standar PMI (Palang Merah Indonesia):

#### 1. Pertolongan Pertama (First Aid)

Skill wajib bagi setiap anggota. Materi mencakup:

- Penanganan luka pendarahan & patah tulang (pembidaian).
- Resusitasi Jantung Paru (RJP/CPR).
- Evakuasi korban & transportasi darurat.

#### 2. Perawatan Keluarga (PK)

Melatih kemandirian dalam merawat orang sakit di rumah, mulai dari mengganti sprei pasien hingga membantu mobilitas.

#### 3. Pendidikan Remaja Sebaya (PRS)

Memberdayakan anggota senior untuk menjadi konselor bagi teman-temannya terkait isu kesehatan remaja (NAPZA, HIV/AIDS, Kesehatan Reproduksi, & Kesehatan Mental).

#### 4. Ayo Siaga Bencana

Edukasi mitigasi bencana alam (gempa bumi, banjir, kebakaran) agar siswa tidak panik dan tahu prosedur penyelamatan diri.

---

### Peran di Madrasah

PMR memegang peran vital dalam operasional harian madrasah:

- **Tim Kesehatan Upacara:** Siaga penuh menangani siswa yang pingsan atau sakit saat upacara bendera.
- **Piket UKS (Usaha Kesehatan Sekolah):** Mengelola ruang UKS, memberikan pertolongan ringan, dan pencatatan kesehatan siswa.
- **Event Medic:** Menjadi tim medis resmi dalam kegiatan besar madrasah seperti Porseni, Kemah Pramuka, dan Study Tour.

---

### Kegiatan Penunjang

- **Jumbara (Jumpa Bakti Gembira):** Ajang pertemuan dan lomba PMR tingkat Kabupaten/Provinsi.
- **Donor Darah Sukarela:** Mengorganisir _event_ donor darah bagi guru dan masyarakat sekitar.
- **Bakti Sosial:** Penyaluran bantuan logistik saat terjadi bencana alam di wilayah Banten.

---

> "Menjadi anggota PMR bukan tentang memakai seragam putih, tapi tentang memiliki hati yang siap melayani. Tangan kami dilatih untuk mengobati luka, tapi senyum kami didedikasikan untuk mengobati duka."
>
> — **Pembina PMR MTs Negeri 1 Pandeglang**
```

---

### File: `./src/content/pages/pramuka.mdx`

```markdown
---
title: "Gerakan Pramuka"
meta_title: "Pramuka MTs Negeri 1 Pandeglang - Pasukan Penggalang"
description: "Membentuk tunas bangsa yang berkarakter, mandiri, dan cinta tanah air. Gugus Depan MTs Negeri 1 Pandeglang, wadah pembinaan kepanduan modern."
draft: false
---

### Satyaku Kudharmakan, Dharmaku Kubaktikan

**"Ikhlas Bakti Bina Bangsa, Berbudi Bawa Laksana"**

---

Gerakan Pramuka Gugus Depan MTs Negeri 1 Pandeglang (Pasukan Penggalang) adalah ekstrakurikuler wajib yang menjadi pilar utama pendidikan karakter di madrasah. Kami bukan sekadar belajar tali-temali, tapi kami belajar tentang **kemandirian, kehormatan, dan pengabdian**.

Pramuka di sini didesain sebagai laboratorium kehidupan. Tempat di mana teori kepemimpinan dipraktikkan langsung di lapangan, dan nilai-nilai Dasa Dharma ditanamkan hingga menjadi kebiasaan.

### Visi Pembinaan

Mencetak Pramuka Penggalang yang:

1.  **Taqwa:** Memiliki spiritualitas yang kokoh sesuai sila pertama Pancasila.
2.  **Tangguh:** Memiliki mental baja, tidak manja, dan mampu bertahan dalam segala kondisi (_Survival_).
3.  **Terampil:** Menguasai _life skills_ yang berguna bagi diri sendiri dan masyarakat.

---

### Program & Kegiatan Unggulan

Kami menerapkan metode kepanduan modern yang menyenangkan namun tetap disiplin (_Scouting with Joy_):

#### 1. Teknik Kepramukaan (Tekpram)

Penguasaan skill lapangan yang mumpuni:

- **Pionering:** Seni bangunan darurat menggunakan tongkat dan tali (menara pandang, jembatan).
- **Navigasi Darat:** Membaca peta, kompas, dan tanda jejak alam.
- **Sandi & Morse:** Komunikasi rahasia dan isyarat bendera (Semaphore).

#### 2. Perkemahan (Camping)

Puncak dari pelatihan kemandirian.

- **PERJUSA:** Perkemahan Jumat Sabtu untuk anggota baru.
- **Lomba Tingkat (LT):** Kompetisi regu prestasi berjenjang dari madrasah hingga nasional.
- **Jambore:** Pertemuan besar Pramuka Penggalang untuk menjalin persahabatan.

#### 3. Gladian Pimpinan Regu (DIANPINRU)

Pelatihan khusus bagi para Pratama (Ketua) dan Pimpinan Regu (Pinru). Mereka dilatih manajemen tim, pengambilan keputusan, dan psikologi kepemimpinan.

#### 4. Pramuka Peduli

Aksi sosial nyata seperti baksos bencana alam, pelestarian lingkungan (penanaman pohon), dan gerakan pungut sampah (GPS).

---

### Mengapa Harus Aktif Pramuka?

Pramuka MTs Negeri 1 Pandeglang memberikan bekal masa depan yang tidak diajarkan di dalam kelas:

- **Karakter Building:** Melatih kedisiplinan, tanggung jawab, dan jiwa korsa.
- **Sertifikat Garuda:** Kesempatan mencapai tingkatan tertinggi (Pramuka Garuda) yang diakui sebagai jalur prestasi masuk SMA/MA Unggulan.
- **Soft Skills:** Kemampuan komunikasi, kerjasama tim (_teamwork_), dan manajemen konflik.

---

### Fasilitas Gugus Depan

- **Sanggar Pramuka:** Markas komando yang lengkap dengan perpustakaan mini kepanduan.
- **Peralatan Lengkap:** Tenda dome, alat masak lapangan, kompas bidik, dan stok tongkat/tali yang memadai.
- **Pembina Bersertifikat:** Dilatih oleh Pembina Mahir Lanjutan (KPL/KPD) yang kompeten.

---

> "Seorang Pramuka tidak pernah terkejut; dia tahu apa yang harus dilakukan ketika sesuatu yang tak terduga terjadi. Jadilah seperti kelapa: kuat akarnya, tinggi cita-citanya, dan berguna semua bagiannya."
>
> — **Ka. Mabigus MTs Negeri 1 Pandeglang**
```

---

### File: `./src/content/pages/program.mdx`

```markdown
---
title: "Program Unggulan"
meta_title: "Program Unggulan MTs Negeri 1 Pandeglang - Akselerasi Prestasi"
description: "Inovasi program pendidikan MTs Negeri 1 Pandeglang: Kelas Unggulan, Tahfidz Qur'an, Bilingual, dan Digital Class. Mempersiapkan siswa bersaing di era global."
draft: false
---

### Akselerator Potensi Siswa

**"Menggali Potensi, Mengukir Prestasi, Membangun Generasi Rabbani"**

---

MTs Negeri 1 Pandeglang menyadari bahwa setiap siswa memiliki bakat unik yang membutuhkan wadah khusus untuk berkembang maksimal. Oleh karena itu, kami merancang **Program Unggulan (Excellence Programs)** yang melampaui standar kurikulum reguler.

Program ini didesain untuk memberikan tantangan intelektual, pengayaan spiritual, dan _skill_ masa depan yang dibutuhkan siswa untuk bersaing di tingkat nasional maupun internasional.

### 1. Kelas Unggulan Akademik (Sains & Riset)

_Wadah bagi para calon saintis muda._

Kelas ini diperuntukkan bagi siswa dengan kecerdasan kognitif di atas rata-rata.

- **Kurikulum Diperkaya:** Pendalaman materi Olimpiade (KSN) Matematika, IPA, dan IPS.
- **Klinik Riset:** Pembinaan intensif penulisan Karya Ilmiah Remaja (KIR) dan metode penelitian dasar.
- **Target:** Menjuarai kompetisi akademik tingkat Provinsi dan Nasional.

### 2. Program Tahfidz Al-Qur'an Intensif

_Mencetak penjaga wahyu yang intelek._

Program prioritas untuk membentuk generasi Qur'ani.

- **Metode:** Menggunakan metode hafalan mutqin (kuat) dengan setoran harian (_ziyadah_) dan pengulangan (_murojaah_).
- **Target:** Hafalan minimal 3 Juz (Juz 30, 29, 1) lulus dengan predikat _Jayyid Jiddan_ bersertifikat.
- **Wisuda Tahfidz:** Apresiasi tahunan bagi para hafidz/hafidzah muda.

### 3. Kelas Bilingual (Arab & Inggris)

_Gerbang menuju wawasan global._

Mempersiapkan siswa menjadi warga dunia (_global citizen_) tanpa kehilangan identitas keislaman.

- **English/Arabic Day:** Wajib berbahasa asing pada hari tertentu.
- **Native Speaker Exposure:** Mendatangkan pembicara tamu atau praktisi bahasa.
- **Public Speaking:** Latihan pidato (_muhadharah_) dwibahasa untuk melatih kepercayaan diri.

### 4. Kelas Digital (ICT & Multimedia)

_Menjawab tantangan revolusi industri 4.0._

Kelas berbasis teknologi di mana setiap siswa menggunakan tablet/laptop sebagai media utama pembelajaran.

- **Coding Dasar:** Pengenalan logika pemrograman dan pembuatan web sederhana.
- **Desain Grafis:** Pelatihan dasar Canva, Photoshop, dan Video Editing.
- **Literasi Digital:** Etika bermedia sosial dan keamanan data (_cyber security_).

---

### Metode Pendampingan (Mentoring)

Keberhasilan program ini didukung oleh sistem pendampingan yang ketat namun humanis:

- **Wali Kelas Khusus:** Guru pilihan yang berdedikasi tinggi memantau perkembangan setiap siswa.
- **Laporan Berkala:** _Progress report_ bulanan kepada orang tua via aplikasi digital.
- **Konseling Karier:** Pemetaan minat bakat sejak dini untuk persiapan masuk SMA/MA Favorit.

---

> "Kami tidak hanya mengajarkan siswa untuk menjawab soal ujian, tetapi kami mempersiapkan mereka untuk menjawab tantangan masa depan. Program unggulan adalah jalan tol bagi mereka yang ingin berlari lebih cepat."
>
> — **Koordinator Program Unggulan**
```

---

### File: `./src/content/pages/sejarah.mdx`

```markdown
---
title: "Sejarah"
meta_title: "Sejarah MTs Negeri 1 Pandeglang"
description: "Sejarah MTs Negeri 1 Pandeglang"
draft: false
---

## Pendirian dan Awal Berdiri

MTs Negeri 1 Pandeglang, yang terletak di Jalan Raya Labuan Km. 5,7 Kadulisung, Sukasari, Kecamatan Kaduhejo, Kabupaten Pandeglang, didirikan dengan tujuan untuk menyediakan pendidikan agama Islam yang berkualitas bagi masyarakat sekitar. Madrasah ini awalnya dikenal dengan nama MTs Al-Manshuriah, yang didirikan oleh HM. Mansyur. Sejak awal berdirinya, madrasah ini telah menjadi pilihan utama bagi masyarakat sekitar yang menginginkan pendidikan agama yang kuat dan berkualitas.

## Perkembangan dan Prestasi

Seiring berjalannya waktu, MTs Negeri 1 Pandeglang terus berkembang dan mencapai berbagai prestasi di berbagai bidang. Madrasah ini sangat diminati oleh masyarakat sekitar sehingga jumlah siswanya semakin bertambah setiap tahunnya. Para pendiri dan penyelenggara madrasah memiliki komitmen yang sangat tinggi untuk terus meningkatkan prestasi yang telah dicapai.

Beberapa prestasi yang telah diraih oleh siswa-siswi MTs Negeri 1 Pandeglang antara lain:

- Juara 3 MHQ 3 Juz di ajang MUSTAZAN XI.
- Juara 2 Kyorugi Cadet Putri U 43 Kg pada ajang KONI Cup Series - 5 Indonesia Taekwondo Championship.
- Juara I dan Danton Terbaik pada ajang LKBB dalam rangka HUT TNI Ke-79.
- Juara III Olimpiade Bahasa Arab Tingkat Kabupaten Pandeglang.

## Visi dan Misi

MTs Negeri 1 Pandeglang memiliki visi untuk menjadi madrasah yang taat beragama, unggul dalam berprestasi, dan peduli terhadap lingkungan. Misi dari madrasah ini adalah untuk menyediakan pendidikan yang berkualitas, membentuk karakter siswa yang berakhlak mulia, dan menciptakan lingkungan belajar yang kondusif dan inspiratif.

## Komitmen dan Dedikasi

Para pendiri dan penyelenggara MTs Negeri 1 Pandeglang memiliki komitmen yang tinggi untuk terus meningkatkan kualitas pendidikan yang diberikan. Mereka berusaha untuk menyediakan fasilitas yang memadai, tenaga pendidik yang berkualitas, dan program-program pendidikan yang inovatif. Dengan komitmen dan dedikasi yang tinggi, MTs Negeri 1 Pandeglang terus berupaya untuk mencetak generasi yang berprestasi dan berakhlak mulia.

---

> "MTs Negeri 1 Pandeglang adalah madrasah yang memiliki sejarah panjang dan prestasi yang membanggakan. Kami berkomitmen untuk terus memberikan pendidikan yang berkualitas dan membentuk generasi yang berakhlak mulia." - Kepala MTs Negeri 1 Pandeglang
```

---

### File: `./src/content/pages/siswa.mdx`

```markdown
---
title: "Siswa"
meta_title: "Siswa MTs Negeri 1 Pandeglang"
description: "Siswa MTs Negeri 1 Pandeglang"
draft: false
---

## Pengenalan

MTs Negeri 1 Pandeglang memiliki siswa-siswi yang bersemangat dan berprestasi dalam berbagai bidang. Kami berkomitmen untuk menyediakan lingkungan belajar yang mendukung pengembangan akademik, keterampilan, dan karakter siswa.

### Tujuan Halaman Siswa

Halaman Siswa MTs Negeri 1 Pandeglang bertujuan untuk:

1. Memberikan informasi tentang kegiatan dan prestasi siswa.
2. Menyediakan wadah untuk menampilkan karya dan kontribusi siswa.
3. Meningkatkan rasa bangga dan solidaritas di antara siswa.
4. Mendukung komunikasi antara siswa, orang tua, dan guru.

## Kegiatan Siswa

### Kegiatan Akademik

Siswa di MTs Negeri 1 Pandeglang aktif dalam berbagai kegiatan akademik, seperti:

- Olimpiade Sains
- Lomba Matematika dan Fisika
- Kompetisi Debat Bahasa Inggris
- Perlombaan Karya Tulis Ilmiah

### Kegiatan Ekstrakurikuler

Selain kegiatan akademik, siswa juga terlibat dalam berbagai kegiatan ekstrakurikuler, seperti:

- Olahraga (Sepak Bola, Bola Basket, Bulu Tangkis)
- Seni dan Budaya (Tari Tradisional, Musik, Teater)
- Pramuka dan Kegiatan Sosial
- Klub Sains dan Lingkungan

### Prestasi Siswa

Siswa-siswi MTs Negeri 1 Pandeglang telah meraih berbagai prestasi, baik di tingkat lokal, nasional, maupun internasional. Beberapa prestasi yang telah diraih antara lain:

- Juara 3 MHQ 3 Juz di ajang MUSTAZAN XI
- Juara 2 Kyorugi Cadet Putri U 43 Kg pada ajang KONI Cup Series - 5 Indonesia Taekwondo Championship
- Juara I dan Danton Terbaik pada ajang LKBB dalam rangka HUT TNI Ke-79
- Juara III Olimpiade Bahasa Arab Tingkat Kabupaten Pandeglang

## Fitur-Fitur Utama

### Galeri Karya Siswa

Halaman ini menampilkan galeri karya siswa, seperti tulisan, lukisan, fotografi, dan proyek sains. Kami memberikan apresiasi kepada siswa yang telah berkontribusi dan menampilkan karya-karya mereka untuk inspirasi semua.

### Testimoni Siswa

Testimoni dari siswa tentang pengalaman mereka di MTs Negeri 1 Pandeglang juga ditampilkan di halaman ini. Testimoni ini mencakup pengalaman belajar, kegiatan ekstrakurikuler, dan pencapaian pribadi.

### Penghargaan dan Sertifikat

Siswa-siswi yang telah meraih prestasi akan mendapatkan penghargaan dan sertifikat yang diakui secara resmi oleh sekolah. Penghargaan ini diberikan sebagai bentuk apresiasi dan motivasi untuk terus berprestasi.

---

> "Siswa di MTs Negeri 1 Pandeglang adalah aset berharga yang kami banggakan. Kami berkomitmen untuk menyediakan pendidikan yang berkualitas dan mendukung pengembangan potensi mereka secara menyeluruh." - Kepala MTs Negeri 1 Pandeglang
```

---

### File: `./src/content/pages/staf.mdx`

```markdown
---
title: "Staf"
meta_title: "Staf MTs Negeri 1 Pandeglang"
description: "Staf MTs Negeri 1 Pandeglang"
draft: true
---

## Pengenalan

Staf MTs Negeri 1 Pandeglang terdiri dari tenaga pendidik dan kependidikan yang berdedikasi tinggi untuk memberikan pendidikan berkualitas kepada siswa-siswi. Staf kami memiliki kompetensi dan pengalaman yang memadai dalam bidangnya masing-masing, serta berkomitmen untuk menciptakan lingkungan belajar yang kondusif dan inspiratif.

---

> "Staf MTs Negeri 1 Pandeglang adalah pilar utama dalam mewujudkan visi dan misi sekolah. Kami berkomitmen untuk bekerja sama dalam menciptakan lingkungan belajar yang kondusif dan inspiratif bagi siswa-siswi." - Kepala Tata Usaha MTs Negeri 1 Pandeglang
```

---

### File: `./src/content/pages/visi-misi-tujuan.mdx`

```markdown
---
title: "Visi, Misi dan Tujuan"
meta_title: "Visi, Misi dan Tujuan MTs Negeri 1 Pandeglang"
description: "Visi, Misi dan Tujuan MTs Negeri 1 Pandeglang"
draft: false
---

## Visi

MTs Negeri 1 Pandeglang memiliki visi untuk menjadi madrasah yang **taat beragama, unggul dalam berprestasi, dan peduli terhadap lingkungan**. Visi ini mencerminkan komitmen kami untuk menciptakan generasi yang berakhlak mulia, berprestasi dalam berbagai bidang, dan memiliki kesadaran tinggi terhadap pelestarian lingkungan.

## Misi

Untuk mencapai visi tersebut, MTs Negeri 1 Pandeglang memiliki beberapa misi utama:

1. Menyediakan pendidikan yang berkualitas dan berlandaskan nilai-nilai agama Islam.
2. Mendorong siswa untuk meraih prestasi akademik dan non-akademik.
3. Menciptakan lingkungan belajar yang kondusif dan inspiratif.
4. Menanamkan nilai-nilai moral dan etika kepada siswa.
5. Meningkatkan kesadaran siswa terhadap pentingnya menjaga dan melestarikan lingkungan.
6. Mengembangkan keterampilan hidup yang berguna bagi siswa dalam menghadapi tantangan masa depan.

## Tujuan

Tujuan dari MTs Negeri 1 Pandeglang adalah sebagai berikut:

1. Mencetak siswa yang **beriman, bertaqwa, dan berakhlak mulia**.
2. Menghasilkan lulusan yang **berprestasi** di bidang akademik dan non-akademik.
3. Membangun lingkungan sekolah yang **bersih, hijau, dan sehat**.
4. Menyediakan **fasilitas pendidikan yang memadai** dan mendukung proses pembelajaran.
5. Meningkatkan kompetensi guru dan tenaga kependidikan melalui **pelatihan dan pengembangan profesional**.
6. Menjalin kerjasama dengan berbagai pihak untuk mendukung pengembangan pendidikan di madrasah.

---

> "Dengan visi, misi, dan tujuan yang jelas, MTs Negeri 1 Pandeglang berkomitmen untuk terus meningkatkan kualitas pendidikan dan mencetak generasi yang berakhlak mulia, berprestasi, dan peduli terhadap lingkungan." - Kepala MTs Negeri 1 Pandeglang
```

---

### File: `./src/content/pages/volleyball-club.mdx`

```markdown
---
title: "Klub Bola Voli (MATSANEPA VC)"
meta_title: "Volleyball Club MTs Negeri 1 Pandeglang - Pencetak Atlet Berprestasi"
description: "Pusat pembinaan atlet voli muda berbakat. Menggabungkan teknik profesional, disiplin tinggi, dan semangat sportivitas untuk meraih prestasi."
draft: false
---

### Smash Keras, Semangat Tuntas

**"Satu Tim, Satu Jiwa, Satu Tujuan: JUARA"**

---

Klub Bola Voli MTs Negeri 1 Pandeglang (MATSANEPA VC) adalah salah satu ekstrakurikuler olahraga paling populer dan berprestasi. Kami bukan sekadar bermain bola, tetapi kami membangun **kultur juara**.

Di sini, bakat mentah siswa diasah menjadi atlet potensial melalui program latihan yang terstruktur, disiplin ketat, dan jam terbang kompetisi yang tinggi.

### Filosofi Tim

Kami menanamkan tiga nilai utama kepada setiap pemain:

1.  **Disiplin:** Latihan adalah ibadah. Tidak ada tempat bagi kemalasan.
2.  **Kerjasama (Teamwork):** Voli adalah olahraga tim, ego individu harus dikesampingkan demi kemenangan bersama.
3.  **Sportivitas:** Menghormati lawan, wasit, dan aturan permainan adalah harga mati.

---

### Program Pembinaan Berjenjang

Kami membagi skuat latihan berdasarkan kemampuan untuk memaksimalkan potensi:

#### 1. Kelas Pemula (Basic Skills)

Fokus pada penguasaan teknik dasar yang benar (_form_):

- **Passing Bawah & Atas:** Fondasi pertahanan dan serangan.
- **Service:** Teknik servis bawah dan servis atas (floating).
- **Footwork:** Kelincahan pergerakan kaki di lapangan.

#### 2. Kelas Lanjutan (Advanced Tactics)

Persiapan tim inti sekolah untuk kompetisi:

- **Spiking & Blocking:** Teknik serangan tajam dan bendungan pertahanan.
- **Strategi Permainan:** Formasi serangan (4-2, 5-1) dan pola pertahanan.
- **Fisik & Stamina:** Latihan beban tubuh, _sprint_, dan daya tahan (_endurance_).

#### 3. Sparing Partner

Uji coba rutin melawan tim dari sekolah lain (SMP/SMA) atau klub lokal untuk mengasah mental bertanding dan membaca strategi lawan.

---

### Fasilitas Latihan Standar PBVSI

Madrasah menyediakan fasilitas terbaik untuk menunjang prestasi:

- **Lapangan Voli Representatif:** Lapangan _outdoor_ dengan ukuran standar nasional.
- **Peralatan Lengkap:** Bola Mikasa/Molten standar turnamen, net profesional, dan alat bantu latihan fisik.
- **Jersey Tim:** Seragam kebanggaan yang didesain modern untuk meningkatkan kepercayaan diri pemain.

---

### Pelatih & Prestasi

Tim dibimbing oleh pelatih berlisensi dan guru olahraga berpengalaman yang pernah menjadi atlet daerah.

**Jejak Prestasi:**

- Juara Turnamen Voli Pelajar Tingkat Kabupaten.
- Juara Ajang KKM (Kelompok Kerja Madrasah).
- Penyumbang atlet untuk tim POPDA (Pekan Olahraga Pelajar Daerah).

---

> "Di lapangan ini, kami belajar bahwa kemenangan bukan hanya soal siapa yang paling kuat memukul bola, tapi siapa yang paling kuat bangkit saat bola menyentuh tanah. Voli mengajarkan kami arti pantang menyerah."
>
> — **Kapten Tim Voli Putra**
```

---

### File: `./src/content/pages/zona-integritas.mdx`

```markdown
---
title: "Zona Integritas"
meta_title: "Zona Integritas MTs Negeri 1 Pandeglang"
description: "Zona Integritas MTs Negeri 1 Pandeglang"
draft: false
---

Zona Integritas (ZI) adalah sebuah konsep yang diterapkan di MTs Negeri 1 Pandeglang untuk menciptakan lingkungan yang bersih dari korupsi dan membangun budaya kerja yang jujur dan transparan. Zona Integritas ini bertujuan untuk meningkatkan kepercayaan masyarakat terhadap lembaga pendidikan dan memastikan pelayanan yang berkualitas.

### Tujuan Zona Integritas

Zona Integritas di MTs Negeri 1 Pandeglang bertujuan untuk:

1. Meningkatkan efisiensi dan efektivitas pelayanan publik.
2. Membangun budaya kerja yang jujur dan transparan.
3. Mencegah praktik korupsi, kolusi, dan nepotisme.
4. Meningkatkan kepercayaan masyarakat terhadap lembaga pendidikan.

## Komponen Zona Integritas

### Manajemen Perubahan

Manajemen perubahan dilakukan untuk mengubah pola pikir dan budaya kerja di lingkungan MTs Negeri 1 Pandeglang. Langkah-langkah yang diambil meliputi:

- Sosialisasi dan pendidikan tentang Zona Integritas.
- Pelatihan dan pengembangan kapasitas pegawai.
- Peningkatan kesadaran tentang pentingnya integritas.

### Penguatan Akuntabilitas

Penguatan akuntabilitas bertujuan untuk meningkatkan transparansi dan akuntabilitas dalam setiap aspek pelayanan di MTs Negeri 1 Pandeglang. Langkah-langkah yang diambil meliputi:

- Penyusunan dan publikasi laporan kinerja.
- Pengawasan internal yang ketat.
- Pelaporan dan evaluasi secara berkala.

### Peningkatan Kualitas Pelayanan Publik

Peningkatan kualitas pelayanan publik bertujuan untuk memberikan layanan yang berkualitas dan memuaskan kepada masyarakat. Langkah-langkah yang diambil meliputi:

- Penyediaan layanan yang cepat, tepat, dan akurat.
- Penggunaan teknologi informasi untuk mendukung pelayanan.
- Monitoring dan evaluasi pelayanan secara berkala.

## Program Kerja Zona Integritas

### Pendidikan Antikorupsi

MTs Negeri 1 Pandeglang melaksanakan program pendidikan antikorupsi untuk siswa dan pegawai. Program ini bertujuan untuk meningkatkan kesadaran dan pemahaman tentang bahaya korupsi serta mendorong perilaku yang jujur dan berintegritas.

### Pelayanan Publik Terpadu

MTs Negeri 1 Pandeglang menerapkan pelayanan publik terpadu yang terintegrasi dan efisien. Program ini mencakup berbagai layanan administratif dan informasi yang dapat diakses oleh siswa, orang tua, dan masyarakat dengan mudah.

### Pengawasan dan Pengendalian

Pengawasan dan pengendalian dilakukan secara berkala untuk memastikan pelaksanaan Zona Integritas berjalan dengan baik. Pengawasan dilakukan oleh tim internal yang bertugas untuk memantau dan mengevaluasi setiap kegiatan yang terkait dengan Zona Integritas.

---

> "Penerapan Zona Integritas di MTs Negeri 1 Pandeglang adalah langkah nyata kami untuk menciptakan lingkungan pendidikan yang bersih, transparan, dan berintegritas. Kami berkomitmen untuk memberikan pelayanan terbaik dan membangun kepercayaan masyarakat." - Kepala MTs Negeri 1 Pandeglang
```

---

### File: `./src/content/sections/call-to-action.md`

```markdown
---
enable: true
title: "Siap Menjadi Bagian dari Generasi Unggul?"
image: "/images/call-to-action.png"
description: "Jangan lewatkan kesempatan emas untuk bergabung dengan keluarga besar MTs Negeri 1 Pandeglang. Mari wujudkan mimpi akademik dan karakter mulia bersama madrasah berprestasi."
button:
  enable: true
  label: "Daftar Sekarang"
  link: "https://daftar.mtsn1pandeglang.sch.id"
---
```

---

### File: `./src/content/sections/testimonial.md`

```markdown
---
enable: true
title: "Apa Kata Orang Tentang MTs Negeri 1 Pandeglang"
description: "Baca beberapa testimoni di bawah ini untuk mengetahui pendapat orang tentang kami."

# Testimonials
testimonials:
  - name: "Yuliana Ramadhani"
    designation: "Alumni 2013"
    avatar: "/images/avatar-sm.png"
    content: "Selama di MTs Negeri 1 Pandeglang, saya mendapatkan tidak hanya ilmu, tetapi juga nilai-nilai kehidupan yang sangat berharga."

  - name: "Arif Hidayat"
    designation: "Alumni 2016"
    avatar: "/images/avatar-sm.png"
    content: "Guru-guru yang sabar dan peduli benar-benar membuat saya merasa dihargai. Sekolah ini membentuk karakter saya."

  - name: "Maya Putri"
    designation: "Alumni 2018"
    avatar: "/images/avatar-sm.png"
    content: "MTsN 1 Pandeglang tidak hanya fokus pada akademik, tapi juga aktif dalam kegiatan seni dan olahraga. Saya merasa berkembang secara menyeluruh."

  - name: "Dimas Kurniawan"
    designation: "Alumni 2020"
    avatar: "/images/avatar-sm.png"
    content: "Saya belajar arti tanggung jawab dan kerja keras di sini. Terima kasih untuk semua bimbingannya."

  - name: "Sri Mulyani"
    designation: "Alumni 2012"
    avatar: "/images/avatar-sm.png"
    content: "Atmosfer belajar di MTsN 1 Pandeglang sangat menyenangkan, saya merasa didukung sepenuhnya untuk sukses."

  - name: "Hendra Gunawan"
    designation: "Alumni 2015"
    avatar: "/images/avatar-sm.png"
    content: "MTs Negeri 1 Pandeglang adalah tempat saya belajar percaya diri. Kini saya menerapkan banyak pelajaran dari sana di dunia kerja."

  - name: "Laila Nuraini"
    designation: "Alumni 2019"
    avatar: "/images/avatar-sm.png"
    content: "Kegiatan ekstrakurikulernya luar biasa! Saya bisa berkembang tidak hanya sebagai pelajar tapi juga sebagai pribadi."

  - name: "Yoga Saputra"
    designation: "Alumni 2017"
    avatar: "/images/avatar-sm.png"
    content: "Sekolah ini punya semangat kekeluargaan yang kuat. Saya merindukan suasananya bahkan setelah lulus."

  - name: "Melani Oktavira"
    designation: "Alumni 2021"
    avatar: "/images/avatar-sm.png"
    content: "Saya suka bagaimana guru-guru selalu terbuka untuk berdiskusi dan membantu muridnya berkembang."

  - name: "Sandy Prakoso"
    designation: "Alumni 2023"
    avatar: "/images/avatar-sm.png"
    content: "Salah satu hal terbaik di sini adalah kesempatan untuk ikut kompetisi dan menunjukkan potensi diri."

  - name: "Intan Fadillah"
    designation: "Alumni 2014"
    avatar: "/images/avatar-sm.png"
    content: "Di MTsN 1 Pandeglang, saya belajar pentingnya kedisiplinan dan semangat kebersamaan. Itu menjadi bekal besar dalam perjalanan hidup saya."

  - name: "Rizky Fauzan"
    designation: "Alumni 2017"
    avatar: "/images/avatar-sm.png"
    content: "Lingkungan yang positif dan guru yang perhatian menjadikan sekolah ini rumah kedua bagi saya."

  - name: "Nurul Hikmah"
    designation: "Alumni 2016"
    avatar: "/images/avatar-sm.png"
    content: "MTs Negeri 1 Pandeglang telah membuka banyak pintu kesempatan dalam hidup saya, baik akademik maupun non-akademik."

  - name: "Fajar Nugroho"
    designation: "Alumni 2022"
    avatar: "/images/avatar-sm.png"
    content: "Saya mengenal banyak teman luar biasa dan mendapatkan pengalaman berorganisasi yang membentuk kepemimpinan saya."

  - name: "Dewi Anggraini"
    designation: "Alumni 2013"
    avatar: "/images/avatar-sm.png"
    content: "MTsN 1 Pandeglang memberikan saya kepercayaan diri untuk mengejar impian saya, bahkan di luar zona nyaman."

  - name: "Galih Prasetyo"
    designation: "Alumni 2015"
    avatar: "/images/avatar-sm.png"
    content: "Pembelajaran berbasis proyek dan pendekatan kreatif guru-guru membuat saya semakin mencintai proses belajar."

  - name: "Anisa Putri"
    designation: "Alumni 2019"
    avatar: "/images/avatar-sm.png"
    content: "Saya merasa dilatih untuk berpikir kritis dan mandiri di sekolah ini, hal yang sangat berguna di masa kuliah."

  - name: "Reza Maulana"
    designation: "Alumni 2021"
    avatar: "/images/avatar-sm.png"
    content: "MTs Negeri 1 Pandeglang punya semangat inovatif. Banyak teknologi pembelajaran diterapkan secara menarik."
---
```

---

### File: `./src/hooks/useTheme.ts`

```typescript
import { useEffect, useState } from "react";

const useTheme = (): string => {
  const [themeValue, setThemeValue] = useState("");

  useEffect(() => {
    setThemeValue(
      document.documentElement.classList.contains("dark") ? "dark" : "light",
    );
  }, []);

  return themeValue;
};

export default useTheme;
```

---

### File: `./src/layouts/Base.astro`

```astro
---
import TwSizeIndicator from "@/components/TwSizeIndicator.astro";
import config from "@/config/config.json";
import theme from "@/config/theme.json";
import { plainify } from "@/lib/utils/textConverter";
import Footer from "@/partials/Footer.astro";
import Header from "@/partials/Header.astro";
import "@/styles/main.css";
import {
  GoogleTagmanager,
  GoogleTagmanagerNoscript,
} from "@digi4care/astro-google-tagmanager";
import { AstroFont } from "astro-font";
import { ClientRouter } from "astro:transitions";
import SearchModal from "./helpers/SearchModal";
import InstallPrompt from "@/layouts/helpers/InstallPrompt";
import CookieConsent from "@/layouts/helpers/CookieConsent";

const pf = theme.fonts.font_family.primary;
const sf = theme.fonts.font_family.secondary;

let fontPrimary, fontSecondary;
if (theme.fonts.font_family.primary) {
  fontPrimary = theme.fonts.font_family.primary
    .replace(/\+/g, " ")
    .replace(/:[ital,]*[ital@]*[wght@]*[0-9,;.]+/gi, "");
}
if (theme.fonts.font_family.secondary) {
  fontSecondary = theme.fonts.font_family.secondary
    .replace(/\+/g, " ")
    .replace(/:[ital,]*[ital@]*[wght@]*[0-9,;.]+/gi, "");
}
export interface Props {
  title?: string;
  meta_title?: string;
  description?: string;
  image?: string;
  noindex?: boolean;
  canonical?: string;
}

const { title, meta_title, description, image, noindex, canonical } =
  Astro.props;
---

<!doctype html>
<html lang="en">
  <head>
    <link rel="manifest" href="/manifest.json" />
    {
      config.google_tag_manager.enable && (
        <GoogleTagmanager id={config.google_tag_manager.gtm_id} />
      )
    }
    <link rel="shortcut icon" href={config.site.favicon} />
    <meta name="theme-name" content="astroplate" />
    <meta name="msapplication-TileColor" content="#000000" />
    <meta
      name="theme-color"
      media="(prefers-color-scheme: light)"
      content="#fff"
    />
    <meta
      name="theme-color"
      media="(prefers-color-scheme: dark)"
      content="#000"
    />
    <meta name="generator" content={Astro.generator} />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <AstroFont
      config={[
        {
          src: [],
          preload: false,
          display: "swap",
          name: fontPrimary!,
          fallback: "sans-serif",
          cssVariable: "font-primary",
          googleFontsURL: `https://fonts.googleapis.com/css2?family=${pf}&display=swap`,
        },
        {
          src: [],
          preload: false,
          display: "swap",
          name: fontSecondary!,
          fallback: "sans-serif",
          cssVariable: "font-secondary",
          googleFontsURL: `https://fonts.googleapis.com/css2?family=${sf}&display=swap`,
        },
      ]}
    />

    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, maximum-scale=5"
    />

    <title>
      {plainify(meta_title ? meta_title : title ? title : config.site.title)}
    </title>

    {canonical && <link rel="canonical" href={canonical} item-prop="url" />}

    {noindex && <meta name="robots" content="noindex,nofollow" />}

    <meta
      name="description"
      content={plainify(
        description ? description : config.metadata.meta_description,
      )}
    />

    <ClientRouter />

    <meta name="author" content={config.metadata.meta_author} />

    <meta
      property="og:title"
      content={plainify(
        meta_title ? meta_title : title ? title : config.site.title,
      )}
    />

    <meta
      property="og:description"
      content={plainify(
        description ? description : config.metadata.meta_description,
      )}
    />
    <meta property="og:type" content="website" />
    <meta
      property="og:url"
      content={`${config.site.base_url}/${Astro.url.pathname.replace("/", "")}`}
    />

    <meta
      name="twitter:title"
      content={plainify(
        meta_title ? meta_title : title ? title : config.site.title,
      )}
    />

    <meta
      name="twitter:description"
      content={plainify(
        description ? description : config.metadata.meta_description,
      )}
    />

    <meta
      property="og:image"
      content={`${config.site.base_url}${
        image ? image : config.metadata.meta_image
      }`}
    />

    <meta
      name="twitter:image"
      content={`${config.site.base_url}${
        image ? image : config.metadata.meta_image
      }`}
    />
    <meta name="twitter:card" content="summary_large_image" />
  </head>
  <body>
    {
      config.google_tag_manager.enable && (
        <GoogleTagmanagerNoscript id={config.google_tag_manager.gtm_id} />
      )
    }

    <TwSizeIndicator />
    <Header />
    <SearchModal client:load />
    <main id="main-content" class="pt-28 lg:pt-32 min-h-screen">
      <slot />
    </main>
    <Footer />
    <InstallPrompt client:load />
    <CookieConsent client:only="react" />

    <script>
      import { initAnimations } from "@/scripts/gsap-animations";

      document.addEventListener("astro:page-load", () => {
        initAnimations();
      });
    </script>

    <script>
      import { initAnimations } from "@/scripts/gsap-animations";
      import { initSpotlightButtons } from "@/scripts/spotlight";

      document.addEventListener("astro:page-load", () => {
        initAnimations();
        initSpotlightButtons();
      });
    </script>
  </body>
</html>
```

---

### File: `./src/layouts/PostSingle.astro`

```astro
---
import BlogCard from "@/components/BlogCard.astro";
import Share from "@/components/Share.astro";
import GiscusComment from "@/helpers/GiscusComment";
import { getSinglePage } from "@/lib/contentParser.astro";
import dateFormat from "@/lib/utils/dateFormat";
import readingTime from "@/lib/utils/readingTime"; // Import Reading Time
import similarItems from "@/lib/utils/similarItems";
import { humanize, markdownify, slugify } from "@/lib/utils/textConverter";
import { render } from "astro:content";
import {
  FaRegFolder,
  FaRegUserCircle,
  FaRegCalendarAlt,
  FaRegClock,
} from "react-icons/fa";
import ImageMod from "./components/ImageMod.astro";
import PostViewCounter from "@/layouts/helpers/PostViewCounter";

const COLLECTION_FOLDER = "blog";
const { post } = Astro.props;

const posts = await getSinglePage(COLLECTION_FOLDER);
const similarPosts = similarItems(post, posts);
const { Content } = await render(post);
const { title, description, author, categories, image, date, tags } = post.data;
---

<section class="section pt-7">
  <div class="container">
    <div class="row justify-center">
      <article class="lg:col-10">
        {
          image && (
            <div class="mb-10 gsap-hero-image">
              <ImageMod
                src={image}
                height={500}
                width={1200}
                alt={title}
                class="w-full rounded"
                format="webp"
              />
            </div>
          )
        }
        <div class="gsap-fade-up">
          <h1 set:html={markdownify(title)} class="h2 mb-4" />
          <ul class="mb-4">
            <li class="mr-4 inline-block">
              <a href={`/authors/${slugify(author)}`}>
                <FaRegUserCircle className={"mr-2 -mt-1 inline-block"} />
                {humanize(author)}
              </a>
            </li>
            <li class="mr-4 inline-block">
              <FaRegFolder className={"mr-2 -mt-1 inline-block"} />
              {
                categories.map((category: string, index: number) => (
                  <a href={`/categories/${slugify(category)}`}>
                    {humanize(category)}
                    {index !== categories.length - 1 && ","}
                  </a>
                ))
              }
            </li>

            <li class="mr-4 inline-block">
              <FaRegCalendarAlt className={"mr-2 -mt-1 inline-block"} />
              {dateFormat(date)}
            </li>

            <li class="mr-4 inline-block">
              <FaRegClock className={"mr-2 -mt-1 inline-block"} />
              {readingTime(post.body)}
            </li>

            <li class="mr-4 inline-block">
              <PostViewCounter client:only="react" />
            </li>
          </ul>
        </div>
        <div class="content mb-10 gsap-fade-up">
          <Content />
        </div>
        <div class="row items-start justify-between">
          <div class="mb-10 flex items-center lg:col-5 lg:mb-0">
            <h5 class="mr-3">Tags :</h5>
            <ul>
              {
                tags.map((tag: string) => (
                  <li class="inline-block">
                    <a
                      class="m-1 block rounded bg-light px-3 py-1 hover:bg-primary hover:text-white dark:bg-darkmode-light dark:hover:bg-darkmode-primary dark:hover:text-text-dark"
                      href={`/tags/${slugify(tag)}`}
                    >
                      {humanize(tag)}
                    </a>
                  </li>
                ))
              }
            </ul>
          </div>
          <div class="flex items-center lg:col-4">
            <h5 class="mr-3">Share :</h5>
            <Share
              className="social-icons"
              title={title}
              description={description}
              slug={post.id}
            />
          </div>
        </div>
        <GiscusComment client:visible />
      </article>
    </div>

    <div class="section pb-0">
      <h2 class="h3 mb-12 text-center">Related Posts</h2>
      <div class="row justify-center">
        {
          similarPosts.map((post) => (
            <div class="lg:col-4 md:col-6 mb-14">
              <BlogCard data={post} />
            </div>
          ))
        }
      </div>
    </div>
  </div>
</section>
```

---

### File: `./src/layouts/components/AuthorCard.astro`

```astro
---
import { plainify } from "@/lib/utils/textConverter";
import ImageMod from "./ImageMod.astro";
import Social from "./Social.astro";

const { data } = Astro.props;
const { title, image, social } = data.data;
---

<div class="rounded bg-light p-8 text-center dark:bg-darkmode-light">
  {
    image && (
      <ImageMod
        class="mx-auto mb-6 rounded"
        src={image}
        alt={title}
        width={120}
        height={120}
        format="webp"
      />
    )
  }

  <h4 class="mb-3">
    <a href={`/authors/${data.id}`}>{title}</a>
  </h4>
  <p class="mb-4">
    {plainify(data.body?.slice(0, 100))}
  </p>
  <Social source={social} className="social-icons" />
</div>
```

---

### File: `./src/layouts/components/BlogCard.astro`

```astro
---
import config from "@/config/config.json";
import dateFormat from "@/lib/utils/dateFormat";
import readingTime from "@/lib/utils/readingTime"; // Import Reading Time
import { humanize, plainify, slugify } from "@/lib/utils/textConverter";
import { FaCubes, FaRegUserCircle, FaCalendarTimes } from "react-icons/fa"; // Tambah FaRegClock
import ImageMod from "./ImageMod.astro";

const {
  summary_length,
  blog_folder,
}: { summary_length: number; blog_folder: string } = config.settings;
const { data } = Astro.props;
const { title, image, date, author, categories } = data.data;
---

<div class="bg-body dark:bg-darkmode-body">
  {
    image && (
      <ImageMod
        class="mb-6 w-full rounded"
        src={image}
        alt={title}
        width={445}
        height={230}
        format="webp"
      />
    )
  }
  <h4 class="mb-3">
    <a href={`/${blog_folder}/${data.id}`}>
      {title}
    </a>
  </h4>
  <ul class="mb-4">
    <li class="mr-4 inline-block">
      <a href={`/authors/${slugify(author)}`}>
        <FaRegUserCircle className={"mr-2 -mt-1 inline-block"} />
        {humanize(author)}
      </a>
    </li>
    <li class="mr-4 inline-block">
      <FaCubes className={"mr-2 -mt-1 inline-block"} />
      {
        categories.map((category: string, index: number) => (
          <a href={`/categories/${slugify(category)}`}>
            {humanize(category)}
            {index !== categories.length - 1 && ","}
          </a>
        ))
      }
    </li>
    <li class="mr-4 inline-block">
      <FaCalendarTimes className={"mr-2 -mt-1 inline-block"} />
      {readingTime(data.body)}
    </li>

    {date && <li class="inline-block">{dateFormat(date)}</li>}
  </ul>
  <p class="mb-6">{plainify(data.body?.slice(0, Number(summary_length)))}</p>
  <a class="btn btn-outline-primary btn-sm" href={`/${blog_folder}/${data.id}`}>
    selengkapnya
  </a>
</div>
```

---

### File: `./src/layouts/components/Breadcrumbs.astro`

```astro
---
import { humanize } from "@/lib/utils/textConverter";

const { className }: { className?: string } = Astro.props;

const paths = Astro.url.pathname.split("/").filter((x) => x);
let parts = [
  {
    label: "Beranda",
    href: "/",
    "aria-label": Astro.url.pathname === "/" ? "page" : undefined,
  },
];

paths.forEach((label: string, i: number) => {
  const href = `/${paths.slice(0, i + 1).join("/")}`;
  label !== "page" &&
    parts.push({
      label: humanize(label.replace(".html", "").replace(/[-_]/g, " ")) || "",
      href,
      "aria-label": Astro.url.pathname === href ? "page" : undefined,
    });
});
---

<nav aria-label="Breadcrumb" class={className}>
  <ol class="inline-flex" role="list">
    {
      parts.map(({ label, ...attrs }, index) => (
        <li class="mx-1 capitalize" role="listitem">
          {index > 0 && <span class="inlin-block mr-1">/</span>}
          {index !== parts.length - 1 ? (
            <a class="text-primary dark:text-darkmode-primary" {...attrs}>
              {label}
            </a>
          ) : (
            <span class="text-text-light dark:text-darkmode-text-light">
              {label}
            </span>
          )}
        </li>
      ))
    }
  </ol>
</nav>
```

---

### File: `./src/layouts/components/ImageMod.astro`

```astro
---
import type { ImageMetadata } from "astro";
import { Image } from "astro:assets";
interface Props {
  src: string;
  alt: string;
  width: number;
  height: number;
  loading?: "eager" | "lazy" | null | undefined;
  decoding?: "async" | "auto" | "sync" | null | undefined;
  format?: "auto" | "avif" | "jpeg" | "png" | "svg" | "webp";
  class?: string;
  style?: any;
}
let {
  src,
  alt,
  width,
  height,
  loading,
  decoding,
  class: className,
  format,
  style,
} = Astro.props;

src = `/public${src}`;

const images = import.meta.glob("/public/images/**/*.{jpeg,jpg,png,gif}");

const isValidPath = images[src] ? true : false;

!isValidPath &&
  console.error(
    `\x1b[31mImage not found - ${src}.\x1b[0m Make sure the image is in the /public/images folder.`,
  );
---

{
  isValidPath && (
    <Image
      src={images[src]() as Promise<{ default: ImageMetadata }>}
      alt={alt}
      width={width}
      height={height}
      loading={loading}
      decoding={decoding}
      class={className}
      format={format}
      style={style}
    />
  )
}
```

---

### File: `./src/layouts/components/Logo.astro`

```astro
---
import config from "@/config/config.json";
import ImageMod from "./ImageMod.astro";

const { src, srcDarkmode }: { src?: string; srcDarkmode?: string } =
  Astro.props;
const {
  logo,
  logo_darkmode,
  logo_width,
  logo_height,
  logo_text,
  title,
}: {
  logo: string;
  logo_darkmode: string;
  logo_width: any;
  logo_height: any;
  logo_text: string;
  title: string;
} = config.site;

const { theme_switcher }: { theme_switcher: boolean } = config.settings;
---

<a href="/" class="navbar-brand inline-block">
  {
    src || srcDarkmode || logo || logo_darkmode ? (
      <>
        <ImageMod
          src={src ? src : logo}
          class={`inline-block ${theme_switcher && "dark:hidden"}`}
          width={logo_width.replace("px", "") * 2}
          height={logo_height.replace("px", "") * 2}
          alt={title}
          style={{
            height: logo_height.replace("px", "") + "px",
            width: logo_width.replace("px", "") + "px",
          }}
          format="webp"
        />
        {theme_switcher && (
          <ImageMod
            src={srcDarkmode ? srcDarkmode : logo_darkmode}
            class={"hidden dark:inline-block"}
            width={logo_width.replace("px", "") * 2}
            height={logo_height.replace("px", "") * 2}
            alt={title}
            style={{
              height: logo_height.replace("px", "") + "px",
              width: logo_width.replace("px", "") + "px",
            }}
            format="webp"
          />
        )}
      </>
    ) : logo_text ? (
      logo_text
    ) : (
      title
    )
  }
</a>
```

---

### File: `./src/layouts/components/Pagination.astro`

```astro
---
type Pagination = {
  section?: string;
  currentPage?: number;
  totalPages?: number;
};
const { section, currentPage = 1, totalPages = 1 }: Pagination = Astro.props;

const indexPageLink = currentPage === 2;
const hasPrevPage = currentPage > 1;
const hasNextPage = totalPages > currentPage!;

let pageList: number[] = [];
for (let i = 1; i <= totalPages; i++) {
  pageList.push(i);
}
---

{
  totalPages > 1 && (
    <nav
      class="flex items-center justify-center space-x-3"
      aria-label="Pagination"
    >
      {/* previous */}
      {hasPrevPage ? (
        <a
          href={
            indexPageLink
              ? `${section ? "/" + section : "/"}`
              : `${section ? "/" + section : ""}/page/${currentPage - 1}`
          }
          class="rounded px-2 py-1.5 text-text-dark hover:bg-light dark:text-darkmode-text-dark dark:hover:bg-darkmode-light"
        >
          <span class="sr-only">Previous</span>
          <svg
            viewBox="0 0 20 20"
            fill="currentColor"
            aria-hidden="true"
            height="30"
            width="30"
          >
            <path
              fill-rule="evenodd"
              d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
              clip-rule="evenodd"
            />
          </svg>
        </a>
      ) : (
        <span class="rounded px-2 py-1.5 text-text-light">
          <span class="sr-only">Previous</span>
          <svg
            viewBox="0 0 20 20"
            fill="currentColor"
            aria-hidden="true"
            height="30"
            width="30"
          >
            <path
              fill-rule="evenodd"
              d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
              clip-rule="evenodd"
            />
          </svg>
        </span>
      )}

      {/* page index */}
      {pageList.map((pagination, i) =>
        pagination === currentPage ? (
          <span
            aria-current="page"
            class="rounded bg-primary px-4 py-2 text-white dark:bg-darkmode-primary dark:text-text-dark"
          >
            {pagination}
          </span>
        ) : (
          <a
            href={
              i === 0
                ? `${section ? "/" + section : "/"}`
                : `${section ? "/" + section : ""}/page/${pagination}`
            }
            aria-current="page"
            class="rounded px-4 py-2 text-text-dark hover:bg-light dark:text-darkmode-text-dark dark:hover:bg-darkmode-light"
          >
            {pagination}
          </a>
        ),
      )}

      {/* next page */}
      {hasNextPage ? (
        <a
          href={`${section ? "/" + section : ""}/page/${currentPage + 1}`}
          class="rounded px-2 py-1.5 text-text-dark hover:bg-light dark:text-darkmode-text-dark dark:hover:bg-darkmode-light"
        >
          <span class="sr-only">Next</span>
          <svg
            viewBox="0 0 20 20"
            fill="currentColor"
            aria-hidden="true"
            height="30"
            width="30"
          >
            <path
              fill-rule="evenodd"
              d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
              clip-rule="evenodd"
            />
          </svg>
        </a>
      ) : (
        <span class="rounded px-2 py-1.5 text-text-light">
          <span class="sr-only">Next</span>
          <svg
            viewBox="0 0 20 20"
            fill="currentColor"
            aria-hidden="true"
            height="30"
            width="30"
          >
            <path
              fill-rule="evenodd"
              d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
              clip-rule="evenodd"
            />
          </svg>
        </span>
      )}
    </nav>
  )
}
```

---

### File: `./src/layouts/components/Share.astro`

```astro
---
import config from "@/config/config.json";
import {
  IoLogoFacebook,
  IoLogoLinkedin,
  IoMailOutline,
  IoLogoWhatsapp,
  IoCopyOutline,
} from "react-icons/io5";

const { base_url }: { base_url: string } = config.site;
const {
  title,
  description,
  slug,
  className,
}: { title?: string; description?: string; slug?: string; className?: string } =
  Astro.props;
---

<ul class={`${className}`}>
  <li class="inline-block">
    <a
      aria-label="facebook share button"
      href={`https://facebook.com/sharer/sharer.php?u=${base_url}/${slug}`}
      target="_blank"
      rel="noreferrer noopener"
    >
      <IoLogoFacebook />
    </a>
  </li>
  <li class="inline-block">
    <a
      aria-label="linkedin share button"
      href={`https://www.linkedin.com/shareArticle?mini=true&url=${base_url}/${slug}&title=${title}&summary=${description}&source=${base_url}`}
      target="_blank"
      rel="noreferrer noopener"
    >
      <IoLogoLinkedin />
    </a>
  </li>
  <li class="inline-block">
    <a
      aria-label="whatsapp share button"
      href={`https://api.whatsapp.com/send?text=${title}%20${base_url}/${slug}`}
      target="_blank"
      rel="noreferrer noopener"
    >
      <IoLogoWhatsapp />
    </a>
  </li>
</ul>
```

---

### File: `./src/layouts/components/Social.astro`

```astro
---
const { source, className } = Astro.props;
import DynamicIcon from "@/helpers/DynamicIcon";

export interface ISocial {
  name: string;
  icon: string;
  link: string;
}
---

<ul class={className}>
  {
    source.map((social: ISocial) => (
      <li>
        <a
          aria-label={social.name}
          href={social.link}
          target="_blank"
          rel="noopener noreferrer nofollow"
        >
          <span class="sr-only">{social.name}</span>
          <DynamicIcon className="inline-block" icon={social.icon} />
        </a>
      </li>
    ))
  }
</ul>
```

---

### File: `./src/layouts/components/ThemeSwitcher.astro`

```astro
---
import config from "@/config/config.json";

const {
  theme_switcher,
  // default_theme,
}: { theme_switcher: boolean; default_theme: string } = config.settings;
const { className }: { className?: string } = Astro.props;
---

{
  theme_switcher && (
    <div class={`theme-switcher ${className}`}>
      <input id="theme-switcher" data-theme-switcher type="checkbox" />
      <label for="theme-switcher">
        <span class="sr-only">theme switcher</span>
        <span>
          <svg
            class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 z-10 opacity-100 dark:opacity-0"
            viewBox="0 0 56 56"
            fill="#fff"
            height="16"
            width="16"
          >
            <path d="M30 4.6c0-1-.9-2-2-2a2 2 0 0 0-2 2v5c0 1 .9 2 2 2s2-1 2-2Zm9.6 9a2 2 0 0 0 0 2.8c.8.8 2 .8 2.9 0L46 13a2 2 0 0 0 0-2.9 2 2 0 0 0-3 0Zm-26 2.8c.7.8 2 .8 2.8 0 .8-.7.8-2 0-2.9L13 10c-.7-.7-2-.8-2.9 0-.7.8-.7 2.1 0 3ZM28 16a12 12 0 0 0-12 12 12 12 0 0 0 12 12 12 12 0 0 0 12-12 12 12 0 0 0-12-12Zm23.3 14c1.1 0 2-.9 2-2s-.9-2-2-2h-4.9a2 2 0 0 0-2 2c0 1.1 1 2 2 2ZM4.7 26a2 2 0 0 0-2 2c0 1.1.9 2 2 2h4.9c1 0 2-.9 2-2s-1-2-2-2Zm37.8 13.6a2 2 0 0 0-3 0 2 2 0 0 0 0 2.9l3.6 3.5a2 2 0 0 0 2.9 0c.8-.8.8-2.1 0-3ZM10 43.1a2 2 0 0 0 0 2.9c.8.7 2.1.8 3 0l3.4-3.5c.8-.8.8-2.1 0-2.9-.8-.8-2-.8-2.9 0Zm20 3.4c0-1.1-.9-2-2-2a2 2 0 0 0-2 2v4.9c0 1 .9 2 2 2s2-1 2-2Z" />
          </svg>
          <svg
            class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 z-10 opacity-0 dark:opacity-100"
            viewBox="0 0 24 24"
            fill="none"
            height="16"
            width="16"
          >
            <path
              fill="#000"
              fill-rule="evenodd"
              clip-rule="evenodd"
              d="M8.2 2.2c1-.4 2 .6 1.6 1.5-1 3-.4 6.4 1.8 8.7a8.4 8.4 0 0 0 8.7 1.8c1-.3 2 .5 1.5 1.5v.1a10.3 10.3 0 0 1-9.4 6.2A10.3 10.3 0 0 1 3.2 6.7c1-2 2.9-3.5 4.9-4.4Z"
            />
          </svg>
        </span>
      </label>
    </div>
  )
}

<script>
  import { settings } from "@/config/config.json";
  const matchMedia = window.matchMedia("(prefers-color-scheme: dark)");

  matchMedia.addEventListener("change", () =>
    toggleTheme(document.querySelectorAll("[data-theme-switcher]")),
  );

  function toggleTheme(themeSwitch: NodeListOf<Element>) {
    const defaulTheme =
      settings.default_theme === "system"
        ? matchMedia.matches
          ? "dark"
          : "light"
        : settings.default_theme;
    const currentTheme = localStorage.getItem("theme") || defaulTheme;
    const isDarkTheme = currentTheme === "dark";
    themeSwitch.forEach((sw: any) => (sw.checked = isDarkTheme));
    document.documentElement.classList.toggle("dark", isDarkTheme);
  }

  const setDarkMode = () => {
    const themeSwitch = document.querySelectorAll("[data-theme-switcher]");
    toggleTheme(themeSwitch);
    themeSwitch.forEach((sw) => {
      sw.addEventListener("click", function () {
        const defaulTheme =
          settings.default_theme === "system"
            ? matchMedia.matches
              ? "dark"
              : "light"
            : settings.default_theme;
        const currentTheme = localStorage.getItem("theme") || defaulTheme;
        const newTheme = currentTheme === "light" ? "dark" : "light";
        localStorage.setItem("theme", newTheme);
        toggleTheme(themeSwitch);
      });
    });
  };

  // Runs on initial navigation
  setDarkMode();
  // Runs on view transitions navigation
  document.addEventListener("astro:after-swap", setDarkMode);
</script>
```

---

### File: `./src/layouts/components/TwSizeIndicator.astro`

```astro
---

---

{
  process.env.NODE_ENV === "development" && (
    <div class="fixed left-0 top-0 z-50 flex w-[30px] items-center justify-center bg-gray-200 py-[2.5px] text-[12px] uppercase text-black sm:bg-red-200 md:bg-yellow-200 lg:bg-green-200 xl:bg-blue-200 2xl:bg-pink-200">
      <span class="block sm:hidden">all</span>
      <span class="hidden sm:block md:hidden">sm</span>
      <span class="hidden md:block lg:hidden">md</span>
      <span class="hidden lg:block xl:hidden">lg</span>
      <span class="hidden xl:block 2xl:hidden">xl</span>
      <span class="hidden 2xl:block">2xl</span>
    </div>
  )
}
```

---

### File: `./src/layouts/helpers/AdminDashboard.tsx`

```tsx
import React, { useEffect, useState, useMemo, useRef } from "react";
import {
  FaDownload,
  FaSignOutAlt,
  FaEye,
  FaStar,
  FaChartLine,
  FaPoll,
  FaSort,
  FaSortUp,
  FaSortDown,
  FaSearch,
  FaChevronLeft,
  FaChevronRight,
  FaExclamationTriangle,
  FaTimes,
  FaExternalLinkAlt,
  FaQuoteLeft,
  FaTrash,
  FaExclamationCircle,
  FaFileUpload,
  FaFileCsv,
  FaArrowUp,
  FaArrowRight,
} from "react-icons/fa";
import {
  Chart as ChartJS,
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement,
  BarElement,
  ArcElement,
  Title,
  Tooltip,
  Legend,
  Filler,
} from "chart.js";
import { Bar, Pie, Line } from "react-chartjs-2";

ChartJS.register(
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement,
  BarElement,
  ArcElement,
  Title,
  Tooltip,
  Legend,
  Filler,
);

interface User {
  name: string;
  email: string;
  picture: string;
}

const formatDateIndo = (dateString: string) => {
  if (!dateString) return "-";
  try {
    const date = new Date(
      dateString.includes("Z")
        ? dateString
        : dateString.replace(" ", "T") + "Z",
    );
    return new Intl.DateTimeFormat("id-ID", {
      weekday: "long",
      day: "numeric",
      month: "long",
      year: "numeric",
      hour: "2-digit",
      minute: "2-digit",
      timeZone: "Asia/Jakarta",
      timeZoneName: "short",
    })
      .format(date)
      .replace("pukul", "");
  } catch (e) {
    return dateString;
  }
};

const AdminDashboard = () => {
  const [user, setUser] = useState<User | null>(null);
  const [loading, setLoading] = useState(true);
  const [data, setData] = useState<any>(null);
  const [errorMsg, setErrorMsg] = useState<string | null>(null);
  const [activeTab, setActiveTab] = useState("overview");

  // State Modals
  const [selectedItem, setSelectedItem] = useState<any | null>(null);
  const [modalType, setModalType] = useState<"feedback" | "survey" | null>(
    null,
  );
  const [confirmModal, setConfirmModal] = useState<{
    isOpen: boolean;
    ids: number[];
    type: "feedback" | "survey";
    count: number;
  }>({ isOpen: false, ids: [], type: "feedback", count: 0 });
  const [importModalOpen, setImportModalOpen] = useState(false);
  const [statDetailModal, setStatDetailModal] = useState<{
    isOpen: boolean;
    type: "visits" | "posts" | "feedback" | "survey" | null;
    title: string;
  }>({ isOpen: false, type: null, title: "" });

  const [selectedMonth, setSelectedMonth] = useState(
    () => new Date().getMonth() + 1,
  );
  const [selectedYear, setSelectedYear] = useState(() =>
    new Date().getFullYear(),
  );

  const initializeGoogleButton = () => {
    const btnContainer = document.getElementById("googleBtn");
    if (!btnContainer) return;
    /* @ts-ignore */
    if (window.google && window.google.accounts) {
      /* @ts-ignore */
      window.google.accounts.id.initialize({
        client_id: import.meta.env.PUBLIC_GOOGLE_CLIENT_ID,
        callback: handleCredentialResponse,
        auto_select: false,
        ui_mode: "popup",
      });
      /* @ts-ignore */
      window.google.accounts.id.renderButton(btnContainer, {
        theme: "outline",
        size: "large",
        width: 250,
      });
    }
  };

  const handleCredentialResponse = async (response: any) => {
    setLoading(true);
    try {
      const res = await fetch("/api/auth.php?action=login", {
        method: "POST",
        body: JSON.stringify({ credential: response.credential }),
      });
      const result = await res.json();
      if (result.status === "success") {
        setUser(result.user);
        fetchStats();
      } else {
        alert(result.message);
      }
    } catch (e) {
      alert("Terjadi kesalahan jaringan.");
    }
    setLoading(false);
  };

  const fetchStats = async () => {
    setErrorMsg(null);
    try {
      const res = await fetch("/api/admin.php?action=stats");
      if (!res.ok) throw new Error(`Server Error: ${res.status}`);
      const json = await res.json();
      if (json.status === "error") throw new Error(json.message);
      setData(json);
    } catch (e: any) {
      setErrorMsg(e.message || "Gagal memuat data.");
    }
  };

  useEffect(() => {
    let isMounted = true;
    const init = async () => {
      try {
        const authRes = await fetch("/api/auth.php?action=check");
        const authData = await authRes.json();
        if (isMounted) {
          if (authData.status === "authenticated") {
            setUser(authData.user);
            fetchStats();
          } else {
            if (!document.getElementById("google-client-script")) {
              const script = document.createElement("script");
              script.src = "https://accounts.google.com/gsi/client";
              script.async = true;
              script.id = "google-client-script";
              script.onload = initializeGoogleButton;
              document.body.appendChild(script);
            } else {
              setTimeout(initializeGoogleButton, 500);
            }
          }
          setLoading(false);
        }
      } catch (e) {
        if (isMounted) setErrorMsg("Gagal menghubungi server autentikasi.");
        setLoading(false);
      }
    };
    init();
    return () => {
      isMounted = false;
    };
  }, []);

  const handleLogout = async () => {
    await fetch("/api/auth.php?action=logout");
    setUser(null);
    window.location.reload();
  };

  const downloadReport = (type: string) => {
    window.open(`/api/admin.php?action=export&type=${type}`, "_blank");
  };

  const printPDF = () => {
    window.open(
      `/api/print_pdf.php?month=${selectedMonth}&year=${selectedYear}`,
      "_blank",
    );
  };

  const openDetail = (item: any, type: "feedback" | "survey") => {
    setSelectedItem(item);
    setModalType(type);
  };

  const closeDetail = () => {
    setSelectedItem(null);
    setModalType(null);
  };

  const requestDelete = (ids: number[], type: "feedback" | "survey") => {
    setConfirmModal({ isOpen: true, ids, type, count: ids.length });
  };

  const executeDelete = async () => {
    try {
      const res = await fetch("/api/crud.php?action=delete", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
          ids: confirmModal.ids,
          type: confirmModal.type,
        }),
      });
      const json = await res.json();
      if (json.status === "success") {
        fetchStats();
        if (
          selectedItem &&
          confirmModal.ids.includes(selectedItem.id) &&
          modalType === confirmModal.type
        ) {
          closeDetail();
        }
      } else {
        alert(json.message || "Gagal menghapus data.");
      }
    } catch (e) {
      alert("Terjadi kesalahan jaringan.");
    } finally {
      setConfirmModal((prev) => ({ ...prev, isOpen: false }));
    }
  };

  const handleImportSuccess = () => {
    fetchStats();
    setImportModalOpen(false);
  };

  if (loading)
    return (
      <div className="flex h-screen items-center justify-center bg-gray-50 dark:bg-darkmode-body">
        <div className="text-center">
          <div className="mx-auto mb-4 h-12 w-12 animate-spin rounded-full border-4 border-primary border-t-transparent"></div>
          <p className="text-gray-500 animate-pulse">Memuat Dashboard...</p>
        </div>
      </div>
    );

  if (!user) {
    return (
      <div className="flex min-h-[60vh] flex-col items-center justify-center">
        <div className="w-full max-w-md rounded-2xl border border-border bg-white p-8 text-center shadow-xl dark:border-darkmode-border dark:bg-darkmode-light">
          <img
            src="/images/brand-lightmode.png"
            alt="Logo"
            className="mx-auto mb-6 h-12"
          />
          <h2 className="h4 mb-2">Portal Admin</h2>
          <div className="flex justify-center h-[50px]">
            <div id="googleBtn"></div>
          </div>
        </div>
      </div>
    );
  }

  return (
    <div className="min-h-screen pb-12 relative bg-gray-50 dark:bg-darkmode-body">
      {/* Header */}
      <div className="mb-8 flex flex-col xl:flex-row items-center justify-between gap-4 rounded-xl bg-white p-6 border border-border shadow-sm dark:bg-darkmode-light dark:border-darkmode-border sticky top-24 z-30">
        <div className="flex items-center gap-4 w-full md:w-auto">
          <img
            src={user.picture}
            alt={user.name}
            className="h-12 w-12 rounded-full border-2 border-primary/20 shadow-sm"
          />
          <div>
            <h3 className="h5 mb-0 font-bold">{user.name}</h3>
            <p className="text-sm text-text-light">{user.email}</p>
          </div>
        </div>

        <div className="flex flex-wrap items-center justify-center gap-2 w-full md:w-auto">
          <select
            value={selectedMonth}
            onChange={(e) => setSelectedMonth(Number(e.target.value))}
            className="rounded-lg border border-border px-3 py-1.5 text-sm outline-none focus:border-primary dark:bg-darkmode-body dark:border-darkmode-border"
          >
            {[
              "Januari",
              "Februari",
              "Maret",
              "April",
              "Mei",
              "Juni",
              "Juli",
              "Agustus",
              "September",
              "Oktober",
              "November",
              "Desember",
            ].map((m, i) => (
              <option key={i} value={i + 1}>
                {m}
              </option>
            ))}
          </select>

          <select
            value={selectedYear}
            onChange={(e) => setSelectedYear(Number(e.target.value))}
            className="rounded-lg border border-border px-3 py-1.5 text-sm outline-none focus:border-primary dark:bg-darkmode-body dark:border-darkmode-border"
          >
            {[2024, 2025, 2026].map((y) => (
              <option key={y} value={y}>
                {y}
              </option>
            ))}
          </select>

          <button
            onClick={() => setImportModalOpen(true)}
            className="btn btn-sm flex items-center gap-2 bg-orange-500 hover:bg-orange-600 text-white border-orange-500 whitespace-nowrap shadow-md shadow-orange-500/20"
          >
            <FaFileUpload /> Import
          </button>

          <button
            onClick={printPDF}
            className="btn btn-outline-primary btn-sm flex items-center gap-2 print:hidden whitespace-nowrap"
          >
            <FaDownload /> PDF
          </button>
          <button
            onClick={handleLogout}
            className="btn btn-primary btn-sm flex items-center gap-2 bg-red-500 border-red-500 hover:bg-red-600 print:hidden whitespace-nowrap shadow-md shadow-red-500/20"
          >
            <FaSignOutAlt /> Keluar
          </button>
        </div>
      </div>

      {errorMsg && (
        <div className="mb-8 rounded-xl bg-red-50 p-4 border border-red-200 text-red-700 flex items-center gap-3">
          <FaExclamationTriangle className="text-xl" />
          <div>
            <p className="font-bold">Gagal memuat data</p>
            <p className="text-sm">{errorMsg}</p>
            <button
              onClick={fetchStats}
              className="mt-2 text-xs underline hover:text-red-900"
            >
              Coba Lagi
            </button>
          </div>
        </div>
      )}

      {data && (
        <div className="animate-fade-in space-y-8">
          {/* Glassmorphism Cards */}
          <div className="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
            <StatCard
              label="Total Kunjungan"
              value={data.overview.visits.toLocaleString()}
              icon={<FaEye />}
              color="text-blue-400"
              gradient="from-blue-500/20 to-cyan-500/5"
              onClick={() =>
                setStatDetailModal({
                  isOpen: true,
                  type: "visits",
                  title: "Statistik Kunjungan",
                })
              }
            />
            <StatCard
              label="Artikel Dibaca"
              value={data.overview.posts_count.toLocaleString()}
              icon={<FaChartLine />}
              color="text-emerald-400"
              gradient="from-emerald-500/20 to-teal-500/5"
              onClick={() =>
                setStatDetailModal({
                  isOpen: true,
                  type: "posts",
                  title: "Artikel Terpopuler",
                })
              }
            />
            <StatCard
              label="Total Ulasan"
              value={data.overview.feedback_count.toLocaleString()}
              icon={<FaStar />}
              color="text-yellow-400"
              gradient="from-yellow-500/20 to-orange-500/5"
              onClick={() =>
                setStatDetailModal({
                  isOpen: true,
                  type: "feedback",
                  title: "Ulasan Terbaru",
                })
              }
            />
            <StatCard
              label="Responden Survei"
              value={data.overview.survey_count.toLocaleString()}
              icon={<FaPoll />}
              color="text-purple-400"
              gradient="from-purple-500/20 to-pink-500/5"
              onClick={() =>
                setStatDetailModal({
                  isOpen: true,
                  type: "survey",
                  title: "Ringkasan Survei",
                })
              }
            />
          </div>

          <div className="border-b border-border dark:border-darkmode-border">
            <nav className="-mb-px flex space-x-8 overflow-x-auto">
              {[
                { id: "overview", label: "Ringkasan Grafik" },
                { id: "posts", label: "Data Artikel" },
                { id: "feedback", label: "Data Ulasan" },
                { id: "surveys", label: "Data Survei" },
              ].map((tab) => (
                <button
                  key={tab.id}
                  onClick={() => setActiveTab(tab.id)}
                  className={`whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium transition-all ${activeTab === tab.id ? "border-primary text-primary" : "border-transparent text-gray-500 hover:border-gray-300 dark:text-gray-400 hover:text-gray-700"}`}
                >
                  {tab.label}
                </button>
              ))}
            </nav>
          </div>

          {activeTab === "overview" && (
            <div className="grid grid-cols-1 lg:grid-cols-2 gap-8 animate-fade-in">
              <div className="lg:col-span-2 rounded-xl border border-border bg-white p-6 shadow-sm dark:bg-darkmode-light dark:border-darkmode-border">
                <h3 className="h6 mb-6">Tren Aktivitas (30 Hari Terakhir)</h3>
                <div className="h-72">
                  <Line
                    data={{
                      labels: data.charts.activity.labels,
                      datasets: [
                        {
                          label: "Ulasan Masuk",
                          data: data.charts.activity.feedback,
                          borderColor: "#eab308",
                          backgroundColor: "rgba(234, 179, 8, 0.1)",
                          fill: true,
                          tension: 0.4,
                        },
                        {
                          label: "Survei Masuk",
                          data: data.charts.activity.survey,
                          borderColor: "#8b5cf6",
                          backgroundColor: "rgba(139, 92, 246, 0.1)",
                          fill: true,
                          tension: 0.4,
                        },
                      ],
                    }}
                    options={{ responsive: true, maintainAspectRatio: false }}
                  />
                </div>
              </div>
              <div className="rounded-xl border border-border bg-white p-6 shadow-sm dark:bg-darkmode-light dark:border-darkmode-border">
                <h3 className="h6 mb-6 text-center">
                  Distribusi Rating Bintang
                </h3>
                <div className="h-64 flex justify-center">
                  <Pie
                    data={{
                      labels: ["5 ★", "4 ★", "3 ★", "2 ★", "1 ★"],
                      datasets: [
                        {
                          data: [5, 4, 3, 2, 1].map(
                            (r) => data.charts.stars[r],
                          ),
                          backgroundColor: [
                            "#22c55e",
                            "#3b82f6",
                            "#eab308",
                            "#f97316",
                            "#ef4444",
                          ],
                          borderWidth: 1,
                        },
                      ],
                    }}
                    options={{ responsive: true, maintainAspectRatio: false }}
                  />
                </div>
              </div>
              <div className="rounded-xl border border-border bg-white p-6 shadow-sm dark:bg-darkmode-light dark:border-darkmode-border">
                <h3 className="h6 mb-6 text-center">Skor Rata-rata Survei</h3>
                <div className="h-64">
                  <Bar
                    data={{
                      labels: ["Zona Integritas", "Pelayanan", "Akademik"],
                      datasets: [
                        {
                          label: "Skor (Skala 5)",
                          data: [
                            data.charts.survey_avg.zi,
                            data.charts.survey_avg.service,
                            data.charts.survey_avg.academic,
                          ],
                          backgroundColor: ["#3b82f6", "#10b981", "#8b5cf6"],
                          borderRadius: 6,
                        },
                      ],
                    }}
                    options={{
                      responsive: true,
                      maintainAspectRatio: false,
                      scales: { y: { min: 0, max: 5 } },
                    }}
                  />
                </div>
              </div>
            </div>
          )}

          {activeTab === "posts" && (
            <DataTable
              title="Statistik Artikel Populer"
              data={data.tables.posts}
              enableSelection={false}
              onDownload={() => downloadReport("posts")}
              columns={[
                {
                  key: "slug",
                  label: "Judul Artikel",
                  render: (val: string) => val.replace(/-/g, " ").toUpperCase(),
                },
                {
                  key: "views",
                  label: "Jumlah Pembaca",
                  sortable: true,
                  className: "text-right font-bold",
                },
              ]}
            />
          )}

          {activeTab === "feedback" && (
            <DataTable
              title="Data Ulasan Masuk"
              data={data.tables.feedbacks}
              searchKeys={["name", "message"]}
              enableSelection={true}
              onBulkDelete={(ids) => requestDelete(ids, "feedback")}
              onDownload={() => downloadReport("feedback")}
              columns={[
                {
                  key: "created_at",
                  label: "Waktu",
                  sortable: true,
                  className: "w-48 text-sm text-gray-500",
                  render: (val: string) => formatDateIndo(val),
                },
                {
                  key: "name",
                  label: "Nama Pengirim",
                  sortable: true,
                  className: "font-medium w-48",
                },
                {
                  key: "rating",
                  label: "Rating",
                  sortable: true,
                  className: "w-24",
                  render: (val: number) => (
                    <span className="inline-block px-2 py-1 bg-yellow-100 text-yellow-700 rounded text-xs font-bold">
                      {val} ★
                    </span>
                  ),
                },
                {
                  key: "message",
                  label: "Pesan / Kritik",
                  render: (val: string, row: any) => (
                    <div className="group relative">
                      <p className="italic text-gray-600 dark:text-gray-400 line-clamp-1 max-w-xs">
                        {val || "-"}
                      </p>
                      {val && val.length > 50 && (
                        <button
                          onClick={() => openDetail(row, "feedback")}
                          className="text-xs text-primary hover:underline mt-1 flex items-center gap-1"
                        >
                          Lihat Detail{" "}
                          <FaExternalLinkAlt className="text-[10px]" />
                        </button>
                      )}
                    </div>
                  ),
                },
                {
                  key: "actions",
                  label: "Aksi",
                  className: "text-center w-16",
                  render: (_: any, row: any) => (
                    <button
                      onClick={() => requestDelete([row.id], "feedback")}
                      className="text-red-500 hover:text-red-700 p-2 transition-colors hover:bg-red-50 rounded-full"
                      title="Hapus Data"
                    >
                      <FaTrash size={14} />
                    </button>
                  ),
                },
              ]}
            />
          )}

          {activeTab === "surveys" && (
            <DataTable
              title="Data Survei Kepuasan"
              data={data.tables.surveys}
              searchKeys={["respondent_name", "feedback"]}
              enableSelection={true}
              onBulkDelete={(ids) => requestDelete(ids, "survey")}
              onDownload={() => downloadReport("survey")}
              columns={[
                {
                  key: "created_at",
                  label: "Waktu",
                  sortable: true,
                  className: "w-48 text-sm text-gray-500",
                  render: (val: string) => formatDateIndo(val),
                },
                {
                  key: "respondent_name",
                  label: "Responden",
                  sortable: true,
                  className: "w-48",
                  render: (_: any, row: any) => (
                    <div>
                      <div className="font-bold">{row.respondent_name}</div>
                      <div className="text-xs text-gray-500">
                        {row.respondent_role}
                      </div>
                    </div>
                  ),
                },
                {
                  key: "score_zi",
                  label: "ZI",
                  sortable: true,
                  className: "text-center font-semibold text-blue-600 w-16",
                },
                {
                  key: "score_service",
                  label: "Layanan",
                  sortable: true,
                  className: "text-center font-semibold text-green-600 w-16",
                },
                {
                  key: "score_academic",
                  label: "Akademik",
                  sortable: true,
                  className: "text-center font-semibold text-purple-600 w-16",
                },
                {
                  key: "feedback",
                  label: "Masukan",
                  render: (val: string, row: any) => (
                    <div>
                      <p className="italic text-gray-500 text-sm line-clamp-1 max-w-xs">
                        {val || "-"}
                      </p>
                      {val && val.length > 50 && (
                        <button
                          onClick={() => openDetail(row, "survey")}
                          className="text-xs text-primary hover:underline mt-1 flex items-center gap-1"
                        >
                          Lihat Detail{" "}
                          <FaExternalLinkAlt className="text-[10px]" />
                        </button>
                      )}
                    </div>
                  ),
                },
                {
                  key: "actions",
                  label: "Aksi",
                  className: "text-center w-16",
                  render: (_: any, row: any) => (
                    <button
                      onClick={() => requestDelete([row.id], "survey")}
                      className="text-red-500 hover:text-red-700 p-2 transition-colors hover:bg-red-50 rounded-full"
                      title="Hapus Data"
                    >
                      <FaTrash size={14} />
                    </button>
                  ),
                },
              ]}
            />
          )}
        </div>
      )}

      {/* --- ALL MODALS --- */}

      <ImportModal
        isOpen={importModalOpen}
        onClose={() => setImportModalOpen(false)}
        onSuccess={handleImportSuccess}
      />

      <ConfirmationModal
        isOpen={confirmModal.isOpen}
        title="Konfirmasi Penghapusan"
        message={`Apakah Anda yakin ingin menghapus ${confirmModal.count} data terpilih? Tindakan ini permanen dan tidak dapat dibatalkan.`}
        onConfirm={executeDelete}
        onCancel={() => setConfirmModal((prev) => ({ ...prev, isOpen: false }))}
      />

      {/* DETAIL ITEM MODAL */}
      {selectedItem && (
        <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm animate-fade-in">
          <div className="bg-white dark:bg-darkmode-body w-full max-w-lg rounded-2xl shadow-2xl overflow-hidden border border-gray-100 dark:border-darkmode-border transform transition-all scale-100">
            <div className="flex items-center justify-between p-6 border-b border-gray-100 dark:border-darkmode-border bg-gray-50 dark:bg-white/5">
              <div>
                <h3 className="text-lg font-bold text-gray-800 dark:text-white">
                  Detail{" "}
                  {modalType === "feedback" ? "Ulasan" : "Masukan Survei"}
                </h3>
                <p className="text-xs text-gray-500 mt-1">
                  {formatDateIndo(selectedItem.created_at)}
                </p>
              </div>
              <button
                onClick={closeDetail}
                className="text-gray-400 hover:text-red-500 transition-colors p-2"
              >
                <FaTimes />
              </button>
            </div>
            <div className="p-6">
              <div className="flex items-start gap-4 mb-6">
                <div className="h-12 w-12 flex-shrink-0 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold text-xl">
                  {(selectedItem.name || selectedItem.respondent_name || "A")
                    .charAt(0)
                    .toUpperCase()}
                </div>
                <div>
                  <p className="font-bold text-lg text-gray-800 dark:text-white">
                    {selectedItem.name || selectedItem.respondent_name}
                  </p>
                  <p className="text-sm text-gray-500">
                    {selectedItem.respondent_role || "Pengunjung / Wali Murid"}
                  </p>
                  {modalType === "feedback" && (
                    <div className="mt-2 flex gap-1">
                      {[1, 2, 3, 4, 5].map((s) => (
                        <FaStar
                          key={s}
                          className={
                            s <= selectedItem.rating
                              ? "text-yellow-400"
                              : "text-gray-200"
                          }
                        />
                      ))}
                    </div>
                  )}
                </div>
              </div>
              <div className="relative rounded-xl bg-gray-50 dark:bg-white/5 p-6 border border-gray-100 dark:border-darkmode-border">
                <FaQuoteLeft className="absolute top-4 left-4 text-gray-200 dark:text-gray-600 text-2xl" />
                <div className="relative z-10">
                  <p className="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-2">
                    Isi Pesan:
                  </p>
                  <p className="text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-wrap">
                    {modalType === "feedback"
                      ? selectedItem.message
                      : selectedItem.feedback}
                  </p>
                </div>
              </div>
              {modalType === "survey" && (
                <div className="grid grid-cols-3 gap-4 mt-6">
                  <div className="text-center p-3 bg-blue-50 rounded-lg dark:bg-blue-900/20">
                    <div className="text-xs text-blue-600 font-bold uppercase">
                      ZI
                    </div>
                    <div className="text-xl font-bold text-blue-700">
                      {selectedItem.score_zi}
                    </div>
                  </div>
                  <div className="text-center p-3 bg-green-50 rounded-lg dark:bg-green-900/20">
                    <div className="text-xs text-green-600 font-bold uppercase">
                      Layanan
                    </div>
                    <div className="text-xl font-bold text-green-700">
                      {selectedItem.score_service}
                    </div>
                  </div>
                  <div className="text-center p-3 bg-purple-50 rounded-lg dark:bg-purple-900/20">
                    <div className="text-xs text-purple-600 font-bold uppercase">
                      Akademik
                    </div>
                    <div className="text-xl font-bold text-purple-700">
                      {selectedItem.score_academic}
                    </div>
                  </div>
                </div>
              )}
            </div>
            <div className="bg-gray-50 dark:bg-white/5 px-6 py-4 flex justify-between items-center text-xs text-gray-400 border-t border-gray-100 dark:border-darkmode-border">
              <span>IP: {selectedItem.ip_address}</span>
              <div className="flex gap-2">
                <button
                  onClick={() => requestDelete([selectedItem.id], modalType!)}
                  className="btn bg-red-100 text-red-600 hover:bg-red-200 border-transparent btn-sm flex items-center gap-2"
                >
                  <FaTrash /> Hapus
                </button>
                <button
                  onClick={closeDetail}
                  className="btn btn-primary btn-sm"
                >
                  Tutup
                </button>
              </div>
            </div>
          </div>
        </div>
      )}

      {/* STAT DETAIL MODAL (NEW FEATURE - REAL DATA) */}
      <StatDetailModal
        isOpen={statDetailModal.isOpen}
        onClose={() =>
          setStatDetailModal({ ...statDetailModal, isOpen: false })
        }
        title={statDetailModal.title}
        type={statDetailModal.type}
        data={data}
      />
    </div>
  );
};

// --- SUB COMPONENTS ---

const StatCard = ({ label, value, icon, color, gradient, onClick }: any) => (
  <div
    onClick={onClick}
    className="group relative overflow-hidden rounded-2xl border border-white/20 bg-white/10 dark:bg-white/5 backdrop-blur-lg p-6 shadow-xl transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl hover:bg-white/20 cursor-pointer"
  >
    <div
      className={`absolute -right-6 -top-6 h-24 w-24 rounded-full bg-gradient-to-br ${gradient} blur-2xl opacity-20 transition-all duration-500 group-hover:scale-150 group-hover:opacity-30`}
    ></div>
    <div className="relative z-10 flex items-start justify-between">
      <div>
        <p className="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">
          {label}
        </p>
        <h3 className="mt-2 text-3xl font-bold text-gray-800 dark:text-white transition-all group-hover:scale-105 origin-left">
          {value}
        </h3>
        <div className="mt-2 flex items-center gap-1 text-xs font-medium text-green-500 bg-green-500/10 w-fit px-2 py-0.5 rounded-full">
          <FaArrowUp className="text-[10px]" />
          <span>Active</span>
        </div>
      </div>
      <div
        className={`flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br ${gradient} text-xl ${color} shadow-inner transition-transform duration-300 group-hover:rotate-12`}
      >
        {icon}
      </div>
    </div>
    <div className="absolute bottom-0 left-0 h-1 w-full bg-gradient-to-r from-transparent via-white/20 to-transparent transform scale-x-0 transition-transform duration-500 group-hover:scale-x-100"></div>
    <div className="absolute bottom-4 right-4 opacity-0 transition-all duration-300 group-hover:opacity-100 group-hover:translate-x-0 translate-x-2">
      <FaArrowRight className="text-gray-400 text-sm" />
    </div>
  </div>
);

const StatDetailModal = ({ isOpen, onClose, title, type, data }: any) => {
  if (!isOpen || !data) return null;

  // Helper untuk visit stats
  const getVisitStats = () => {
    const visits = data.charts.activity.visits || [];
    const today = visits[visits.length - 1] || 0;
    const totalPeriod = visits.reduce((a: number, b: number) => a + b, 0);
    const average =
      visits.length > 0 ? Math.round(totalPeriod / visits.length) : 0;
    return { today, average, visits };
  };

  const visitStats =
    type === "visits" ? getVisitStats() : { today: 0, average: 0, visits: [] };

  return (
    <div className="fixed inset-0 z-[60] flex items-center justify-center p-4 bg-black/60 backdrop-blur-md animate-fade-in">
      <div className="bg-white dark:bg-[#1a1d24] w-full max-w-2xl rounded-2xl shadow-2xl overflow-hidden border border-white/10 flex flex-col max-h-[85vh]">
        <div className="px-6 py-4 border-b border-gray-100 dark:border-white/5 flex justify-between items-center bg-gray-50/50 dark:bg-white/5">
          <h3 className="text-lg font-bold text-gray-800 dark:text-white">
            {title}
          </h3>
          <button
            onClick={onClose}
            className="p-2 rounded-full hover:bg-gray-200 dark:hover:bg-white/10 transition-colors"
          >
            <FaTimes />
          </button>
        </div>
        <div className="p-6 overflow-y-auto custom-scrollbar">
          {type === "visits" && (
            <div>
              <div className="mb-6 h-64 w-full bg-gradient-to-b from-blue-50/50 to-transparent rounded-xl p-4 border border-blue-100 dark:border-blue-900/30">
                <Line
                  data={{
                    labels: data.charts.activity.labels,
                    datasets: [
                      {
                        label: "Kunjungan Harian (Realtime)",
                        data: visitStats.visits,
                        borderColor: "#3b82f6",
                        backgroundColor: (context: any) => {
                          const ctx = context.chart.ctx;
                          const gradient = ctx.createLinearGradient(
                            0,
                            0,
                            0,
                            200,
                          );
                          gradient.addColorStop(0, "rgba(59, 130, 246, 0.5)");
                          gradient.addColorStop(1, "rgba(59, 130, 246, 0.0)");
                          return gradient;
                        },
                        fill: true,
                        tension: 0.4,
                        pointRadius: 4,
                        pointBackgroundColor: "#fff",
                        pointBorderColor: "#3b82f6",
                        pointBorderWidth: 2,
                      },
                    ],
                  }}
                  options={{
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                      y: {
                        beginAtZero: true,
                        grid: { color: "rgba(0,0,0,0.05)" },
                      },
                      x: { grid: { display: false } },
                    },
                  }}
                />
              </div>
              <div className="grid grid-cols-2 gap-4">
                <div className="p-4 rounded-xl bg-gray-50 dark:bg-white/5 text-center border border-gray-100 dark:border-white/10">
                  <p className="text-sm text-gray-500 mb-1">
                    Kunjungan Hari Ini
                  </p>
                  <p className="text-3xl font-bold text-blue-600 dark:text-blue-400">
                    {visitStats.today.toLocaleString()}
                  </p>
                </div>
                <div className="p-4 rounded-xl bg-gray-50 dark:bg-white/5 text-center border border-gray-100 dark:border-white/10">
                  <p className="text-sm text-gray-500 mb-1">Rata-rata / Hari</p>
                  <p className="text-3xl font-bold text-indigo-600 dark:text-indigo-400">
                    {visitStats.average.toLocaleString()}
                  </p>
                </div>
              </div>
            </div>
          )}
          {type === "posts" && (
            <div className="space-y-3">
              <h4 className="text-sm font-semibold text-gray-500 uppercase">
                Top 5 Artikel Dibaca
              </h4>
              {data.tables.posts.slice(0, 5).map((post: any, idx: number) => (
                <div
                  key={idx}
                  className="flex items-center justify-between p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-white/5 transition-colors border border-transparent hover:border-gray-100 dark:hover:border-white/10"
                >
                  <div className="flex items-center gap-3">
                    <span
                      className={`flex h-6 w-6 items-center justify-center rounded-full text-xs font-bold ${idx < 3 ? "bg-yellow-100 text-yellow-700" : "bg-gray-100 text-gray-600"}`}
                    >
                      {idx + 1}
                    </span>
                    <span className="font-medium text-sm line-clamp-1 max-w-[250px]">
                      {post.slug.replace(/-/g, " ")}
                    </span>
                  </div>
                  <span className="text-sm font-bold text-green-600 flex items-center gap-1">
                    <FaEye className="text-xs" /> {post.views}
                  </span>
                </div>
              ))}
            </div>
          )}
          {type === "feedback" && (
            <div className="space-y-4">
              <h4 className="text-sm font-semibold text-gray-500 uppercase">
                Ulasan Terbaru
              </h4>
              {data.tables.feedbacks.slice(0, 5).map((fb: any, idx: number) => (
                <div
                  key={idx}
                  className="p-4 rounded-xl bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-white/5"
                >
                  <div className="flex justify-between items-start mb-2">
                    <div className="flex items-center gap-2">
                      <div className="h-8 w-8 rounded-full bg-gradient-to-br from-yellow-400 to-orange-500 flex items-center justify-center text-white font-bold text-xs">
                        {(fb.name || "A").charAt(0)}
                      </div>
                      <div>
                        <p className="text-sm font-bold">{fb.name}</p>
                        <div className="flex text-yellow-400 text-[10px]">
                          {[...Array(5)].map((_, i) => (
                            <FaStar
                              key={i}
                              className={
                                i < fb.rating
                                  ? "text-yellow-400"
                                  : "text-gray-300"
                              }
                            />
                          ))}
                        </div>
                      </div>
                    </div>
                    <span className="text-[10px] text-gray-400">
                      {formatDateIndo(fb.created_at)}
                    </span>
                  </div>
                  <p className="text-sm text-gray-600 dark:text-gray-300 italic">
                    "{fb.message}"
                  </p>
                </div>
              ))}
            </div>
          )}
          {type === "survey" && (
            <div>
              <div className="h-60 mb-6">
                <Bar
                  data={{
                    labels: ["Zona Integritas", "Pelayanan", "Akademik"],
                    datasets: [
                      {
                        label: "Skor Rata-rata",
                        data: [
                          data.charts.survey_avg.zi,
                          data.charts.survey_avg.service,
                          data.charts.survey_avg.academic,
                        ],
                        backgroundColor: ["#3b82f6", "#10b981", "#8b5cf6"],
                        borderRadius: 8,
                      },
                    ],
                  }}
                  options={{
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: { y: { max: 5 } },
                  }}
                />
              </div>
              <div className="grid grid-cols-3 gap-2">
                <div className="text-center p-2 rounded-lg bg-blue-50 dark:bg-blue-900/20">
                  <p className="text-xs text-gray-500">ZI</p>
                  <p className="font-bold text-blue-600">
                    {data.charts.survey_avg.zi}
                  </p>
                </div>
                <div className="text-center p-2 rounded-lg bg-green-50 dark:bg-green-900/20">
                  <p className="text-xs text-gray-500">Layanan</p>
                  <p className="font-bold text-green-600">
                    {data.charts.survey_avg.service}
                  </p>
                </div>
                <div className="text-center p-2 rounded-lg bg-purple-50 dark:bg-purple-900/20">
                  <p className="text-xs text-gray-500">Akademik</p>
                  <p className="font-bold text-purple-600">
                    {data.charts.survey_avg.academic}
                  </p>
                </div>
              </div>
            </div>
          )}
        </div>
        <div className="p-4 border-t border-gray-100 dark:border-white/5 bg-gray-50/50 dark:bg-white/5 text-right">
          <button onClick={onClose} className="btn btn-primary btn-sm">
            Tutup
          </button>
        </div>
      </div>
    </div>
  );
};

const ImportModal = ({ isOpen, onClose, onSuccess }: any) => {
  const [importType, setImportType] = useState<"feedback" | "survey">(
    "feedback",
  );
  const [file, setFile] = useState<File | null>(null);
  const [isUploading, setIsUploading] = useState(false);
  const fileInputRef = useRef<HTMLInputElement>(null);

  if (!isOpen) return null;

  const handleFileChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    if (e.target.files && e.target.files[0]) {
      setFile(e.target.files[0]);
    }
  };

  const handleUpload = async () => {
    if (!file) return alert("Pilih file CSV terlebih dahulu.");

    setIsUploading(true);
    const formData = new FormData();
    formData.append("file", file);
    formData.append("type", importType);

    try {
      const res = await fetch("/api/import.php?action=import", {
        method: "POST",
        body: formData,
      });

      const textResponse = await res.text();
      try {
        const json = JSON.parse(textResponse);
        if (json.status === "success") {
          alert(json.message);
          onSuccess();
        } else {
          alert("Gagal: " + (json.message || "Terjadi kesalahan server."));
        }
      } catch (jsonError) {
        console.error("Server Raw Response:", textResponse);
        alert(
          "Terjadi kesalahan pada Server (Cek Console). Pastikan struktur database sesuai template.",
        );
      }
    } catch (e) {
      alert("Terjadi kesalahan jaringan atau koneksi terputus.");
    } finally {
      setIsUploading(false);
      setFile(null);
      if (fileInputRef.current) fileInputRef.current.value = "";
    }
  };

  return (
    <div className="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm animate-fade-in">
      <div className="bg-white dark:bg-darkmode-body w-full max-w-md rounded-xl shadow-2xl p-6 border border-gray-100 dark:border-darkmode-border">
        <div className="flex justify-between items-center mb-6">
          <h3 className="text-lg font-bold">Import Data CSV</h3>
          <button onClick={onClose}>
            <FaTimes className="text-gray-400 hover:text-red-500" />
          </button>
        </div>
        <div className="mb-4">
          <label className="block text-sm font-medium mb-2">
            Pilih Tipe Data
          </label>
          <div className="flex gap-4">
            <label className="flex items-center gap-2 cursor-pointer">
              <input
                type="radio"
                name="importType"
                value="feedback"
                checked={importType === "feedback"}
                onChange={() => setImportType("feedback")}
              />{" "}
              Data Ulasan
            </label>
            <label className="flex items-center gap-2 cursor-pointer">
              <input
                type="radio"
                name="importType"
                value="survey"
                checked={importType === "survey"}
                onChange={() => setImportType("survey")}
              />{" "}
              Data Survei
            </label>
          </div>
        </div>
        <div className="mb-6">
          <label className="block text-sm font-medium mb-2">Upload File</label>
          <div
            className="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center cursor-pointer hover:bg-gray-50 dark:hover:bg-white/5 transition-colors"
            onClick={() => fileInputRef.current?.click()}
          >
            <input
              type="file"
              accept=".csv"
              ref={fileInputRef}
              className="hidden"
              onChange={handleFileChange}
            />
            {file ? (
              <div className="flex items-center justify-center gap-2 text-green-600 font-medium">
                <FaFileCsv size={24} />
                {file.name}
              </div>
            ) : (
              <div className="text-gray-500">
                <FaFileUpload className="mx-auto mb-2 text-2xl" />
                <p>Klik untuk memilih file CSV</p>
              </div>
            )}
          </div>
          <div className="mt-2 text-right">
            <a
              href={`/api/import.php?action=template&type=${importType}`}
              className="text-xs text-primary hover:underline flex items-center justify-end gap-1"
            >
              <FaDownload /> Download Template CSV
            </a>
          </div>
        </div>
        <div className="flex justify-end gap-2">
          <button
            onClick={onClose}
            className="btn btn-outline-primary btn-sm"
            disabled={isUploading}
          >
            Batal
          </button>
          <button
            onClick={handleUpload}
            className="btn btn-primary btn-sm"
            disabled={!file || isUploading}
          >
            {isUploading ? "Mengupload..." : "Mulai Import"}
          </button>
        </div>
      </div>
    </div>
  );
};

const ConfirmationModal = ({
  isOpen,
  title,
  message,
  onConfirm,
  onCancel,
}: any) => {
  if (!isOpen) return null;
  return (
    <div className="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm animate-fade-in">
      <div className="bg-white dark:bg-darkmode-body w-full max-w-sm rounded-xl shadow-2xl p-6 border border-gray-100 dark:border-darkmode-border transform transition-all scale-100">
        <div className="text-center">
          <div className="mx-auto flex items-center justify-center h-14 w-14 rounded-full bg-red-100 mb-4">
            <FaExclamationCircle className="text-3xl text-red-600" />
          </div>
          <h3 className="text-lg font-bold text-gray-900 dark:text-white mb-2">
            {title}
          </h3>
          <p className="text-sm text-gray-500 dark:text-gray-400 mb-6">
            {message}
          </p>
          <div className="flex gap-3 justify-center">
            <button
              onClick={onCancel}
              className="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-lg text-sm font-medium transition-colors dark:bg-white/10 dark:text-gray-300 dark:hover:bg-white/20"
            >
              Batal
            </button>
            <button
              onClick={onConfirm}
              className="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-medium shadow-md shadow-red-200 transition-colors"
            >
              Ya, Hapus
            </button>
          </div>
        </div>
      </div>
    </div>
  );
};

const DataTable = ({
  title,
  data,
  columns,
  searchKeys = ["slug"],
  onDownload,
  enableSelection = false,
  onBulkDelete,
}: any) => {
  const [search, setSearch] = useState("");
  const [sortConfig, setSortConfig] = useState<{
    key: string;
    direction: "asc" | "desc";
  } | null>(null);
  const [currentPage, setCurrentPage] = useState(1);
  const [rowsPerPage, setRowsPerPage] = useState(10);
  const [selectedIds, setSelectedIds] = useState<number[]>([]);

  useEffect(() => {
    setSelectedIds([]);
  }, [data, currentPage, search]);

  const filteredData = useMemo(() => {
    if (!search) return data;
    return data.filter((row: any) =>
      searchKeys.some((key: any) =>
        String(row[key] || "")
          .toLowerCase()
          .includes(search.toLowerCase()),
      ),
    );
  }, [data, search, searchKeys]);

  const sortedData = useMemo(() => {
    if (!sortConfig) return filteredData;
    return [...filteredData].sort((a: any, b: any) => {
      let aVal = a[sortConfig.key];
      let bVal = b[sortConfig.key];
      if (aVal < bVal) return sortConfig.direction === "asc" ? -1 : 1;
      if (aVal > bVal) return sortConfig.direction === "asc" ? 1 : -1;
      return 0;
    });
  }, [filteredData, sortConfig]);

  const totalPages = Math.ceil(sortedData.length / rowsPerPage);
  const paginatedData = sortedData.slice(
    (currentPage - 1) * rowsPerPage,
    currentPage * rowsPerPage,
  );
  const requestSort = (key: string) => {
    setSortConfig({
      key,
      direction:
        sortConfig?.key === key && sortConfig.direction === "asc"
          ? "desc"
          : "asc",
    });
  };
  const handleSelectAll = (e: React.ChangeEvent<HTMLInputElement>) => {
    if (e.target.checked) {
      setSelectedIds(paginatedData.map((row: any) => row.id));
    } else {
      setSelectedIds([]);
    }
  };
  const handleSelectRow = (id: number) => {
    if (selectedIds.includes(id)) {
      setSelectedIds(selectedIds.filter((sid) => sid !== id));
    } else {
      setSelectedIds([...selectedIds, id]);
    }
  };

  return (
    <div className="rounded-xl border border-border bg-white shadow-sm overflow-hidden dark:bg-darkmode-light dark:border-darkmode-border">
      <div className="flex flex-col gap-4 p-5 md:flex-row md:items-center md:justify-between border-b border-border dark:border-darkmode-border bg-gray-50 dark:bg-white/5">
        <div className="flex items-center gap-3">
          <h3 className="text-lg font-bold">{title}</h3>
          {enableSelection && selectedIds.length > 0 && (
            <button
              onClick={() => onBulkDelete && onBulkDelete(selectedIds)}
              className="px-3 py-1 bg-red-100 text-red-600 hover:bg-red-200 rounded text-xs font-bold flex items-center gap-2 animate-fade-in transition-all"
            >
              <FaTrash /> Hapus ({selectedIds.length})
            </button>
          )}
        </div>
        <div className="flex flex-col sm:flex-row gap-3">
          <div className="relative">
            <FaSearch className="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" />
            <input
              type="text"
              placeholder="Cari data..."
              className="w-full rounded-lg border border-border py-2 pl-9 pr-4 text-sm focus:border-primary focus:outline-none dark:bg-darkmode-body dark:border-darkmode-border"
              onChange={(e) => {
                setSearch(e.target.value);
                setCurrentPage(1);
              }}
            />
          </div>
          <button
            onClick={onDownload}
            className="btn btn-primary btn-sm flex items-center justify-center gap-2 bg-green-600 border-green-600 hover:bg-green-700"
          >
            <FaDownload /> Excel
          </button>
        </div>
      </div>
      <div className="overflow-x-auto">
        <table className="w-full text-left text-sm">
          <thead className="bg-gray-100 text-xs uppercase text-gray-500 dark:bg-black/20">
            <tr>
              {enableSelection && (
                <th className="px-4 py-3 w-10 text-center">
                  <div className="flex items-center justify-center">
                    <input
                      type="checkbox"
                      className="rounded border-gray-300 text-primary focus:ring-primary h-4 w-4 cursor-pointer"
                      onChange={handleSelectAll}
                      checked={
                        paginatedData.length > 0 &&
                        paginatedData.every((row: any) =>
                          selectedIds.includes(row.id),
                        )
                      }
                    />
                  </div>
                </th>
              )}
              <th className="px-6 py-3 w-10 text-center">#</th>
              {columns.map((col: any) => (
                <th
                  key={col.key}
                  className={`px-6 py-3 cursor-pointer hover:bg-gray-200 dark:hover:bg-white/10 transition-colors ${col.className || ""}`}
                  onClick={() => col.sortable && requestSort(col.key)}
                >
                  <div
                    className={`flex items-center gap-1 ${col.className?.includes("text-center") ? "justify-center" : ""} ${col.className?.includes("text-right") ? "justify-end" : ""}`}
                  >
                    {col.label}
                    {col.sortable && (
                      <span className="text-gray-400">
                        {sortConfig?.key === col.key ? (
                          sortConfig.direction === "asc" ? (
                            <FaSortUp />
                          ) : (
                            <FaSortDown />
                          )
                        ) : (
                          <FaSort />
                        )}
                      </span>
                    )}
                  </div>
                </th>
              ))}
            </tr>
          </thead>
          <tbody className="divide-y divide-border dark:divide-darkmode-border">
            {paginatedData.length > 0 ? (
              paginatedData.map((row: any, i: number) => (
                <tr
                  key={i}
                  className={`transition-colors ${selectedIds.includes(row.id) ? "bg-blue-50 dark:bg-blue-900/20" : "hover:bg-gray-50 dark:hover:bg-white/5"}`}
                >
                  {enableSelection && (
                    <td className="px-4 py-4 text-center">
                      <div className="flex items-center justify-center">
                        <input
                          type="checkbox"
                          className="rounded border-gray-300 text-primary focus:ring-primary h-4 w-4 cursor-pointer"
                          checked={selectedIds.includes(row.id)}
                          onChange={() => handleSelectRow(row.id)}
                        />
                      </div>
                    </td>
                  )}
                  <td className="px-6 py-4 text-center text-gray-400">
                    {(currentPage - 1) * rowsPerPage + i + 1}
                  </td>
                  {columns.map((col: any) => (
                    <td
                      key={col.key}
                      className={`px-6 py-4 ${col.className || ""}`}
                    >
                      {col.render
                        ? col.render(row[col.key], row)
                        : row[col.key]}
                    </td>
                  ))}
                </tr>
              ))
            ) : (
              <tr>
                <td
                  colSpan={columns.length + (enableSelection ? 2 : 1)}
                  className="px-6 py-10 text-center text-gray-500"
                >
                  Tidak ada data ditemukan.
                </td>
              </tr>
            )}
          </tbody>
        </table>
      </div>
      <div className="flex flex-col items-center justify-between gap-4 border-t border-border bg-gray-50 p-4 dark:bg-white/5 dark:border-darkmode-border sm:flex-row">
        <div className="text-xs text-gray-500">
          Menampilkan{" "}
          <span className="font-bold text-gray-700 dark:text-gray-300">
            {(currentPage - 1) * rowsPerPage + 1}
          </span>{" "}
          sampai{" "}
          <span className="font-bold text-gray-700 dark:text-gray-300">
            {Math.min(currentPage * rowsPerPage, sortedData.length)}
          </span>{" "}
          dari{" "}
          <span className="font-bold text-gray-700 dark:text-gray-300">
            {sortedData.length}
          </span>{" "}
          data
        </div>
        <div className="flex items-center gap-2">
          <select
            className="rounded border border-border bg-white px-2 py-1 text-xs outline-none focus:border-primary dark:bg-darkmode-body dark:border-darkmode-border"
            value={rowsPerPage}
            onChange={(e) => {
              setRowsPerPage(Number(e.target.value));
              setCurrentPage(1);
            }}
          >
            <option value={5}>5</option>
            <option value={10}>10</option>
            <option value={20}>20</option>
            <option value={50}>50</option>
          </select>
          <div className="flex rounded border border-border bg-white dark:bg-darkmode-body dark:border-darkmode-border">
            <button
              onClick={() => setCurrentPage((p) => Math.max(1, p - 1))}
              disabled={currentPage === 1}
              className="px-3 py-1 hover:bg-gray-100 disabled:opacity-50 dark:hover:bg-white/10"
            >
              <FaChevronLeft className="text-xs" />
            </button>
            <span className="px-3 py-1 text-xs font-medium border-l border-r border-border dark:border-darkmode-border flex items-center">
              Halaman {currentPage}
            </span>
            <button
              onClick={() => setCurrentPage((p) => Math.min(totalPages, p + 1))}
              disabled={currentPage === totalPages || totalPages === 0}
              className="px-3 py-1 hover:bg-gray-100 disabled:opacity-50 dark:hover:bg-white/10"
            >
              <FaChevronRight className="text-xs" />
            </button>
          </div>
        </div>
      </div>
    </div>
  );
};

export default AdminDashboard;
```

---

### File: `./src/layouts/helpers/CardViewCounter.tsx`

```tsx
import React, { useEffect, useState } from "react";
import { FaRegEye } from "react-icons/fa";

interface Props {
  slug: string;
}

const CardViewCounter = ({ slug }: Props) => {
  const [views, setViews] = useState("0");

  useEffect(() => {
    const safeSlug = slug.replace(/[^a-zA-Z0-9]/g, "_");
    const fetchViews = async () => {
      try {
        const response = await fetch(
          `/api/stats.php?action=view&slug=${safeSlug}`,
        );
        if (response.ok) {
          const data = await response.json();
          setViews(data.value.toLocaleString("id-ID"));
        }
      } catch (error) {}
    };
    fetchViews();
  }, [slug]);

  return (
    <div className="flex items-center gap-1" title={`${views} Kali dibaca`}>
      <FaRegEye className="text-gray-500" />
      <span>{views} Kali dibaca</span>
    </div>
  );
};

export default CardViewCounter;
```

---

### File: `./src/layouts/helpers/CookieConsent.tsx`

```tsx
import React, { useEffect, useState } from "react";
import { FaCookieBite, FaTimes } from "react-icons/fa";

declare global {
  interface Window {
    dataLayer: any[];
  }
}

const CookieConsent = () => {
  const [show, setShow] = useState(false);

  const grantConsent = () => {
    window.dataLayer = window.dataLayer || [];
    window.dataLayer.push({
      event: "consent_granted",
      consent_status: "granted",
    });

    console.log("GTM Consent: Granted");
  };

  useEffect(() => {
    const consent = localStorage.getItem("cookie-consent");

    if (consent === "accepted") {
      grantConsent();
    } else if (consent === "declined") {
    } else {
      const timer = setTimeout(() => setShow(true), 2000);
      return () => clearTimeout(timer);
    }
  }, []);

  const handleAccept = () => {
    localStorage.setItem("cookie-consent", "accepted");
    grantConsent();
    setShow(false);
  };

  const handleDecline = () => {
    localStorage.setItem("cookie-consent", "declined");
    setShow(false);
  };

  if (!show) return null;

  return (
    <div className="fixed bottom-4 right-4 z-[9999] w-[90%] max-w-sm animate-slide-up rounded-xl border border-border bg-white p-6 shadow-2xl dark:border-darkmode-border dark:bg-[#1a1d24]">
      <div className="mb-4 flex items-start gap-4">
        <div className="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-primary/10 text-primary dark:bg-primary/20">
          <FaCookieBite className="text-xl" />
        </div>
        <div>
          <h3 className="mb-1 text-lg font-bold text-dark dark:text-white">
            Persetujuan Cookie 🍪
          </h3>
          <p className="text-sm leading-relaxed text-text-light dark:text-darkmode-text-light">
            Kami menggunakan cookie untuk meningkatkan pengalaman Anda dan
            menganalisis trafik website.
          </p>
        </div>

        <button
          onClick={handleDecline}
          className="absolute right-2 top-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-200"
          aria-label="Tutup"
        >
          <FaTimes />
        </button>
      </div>

      <div className="flex flex-col gap-3 sm:flex-row">
        <button
          onClick={handleDecline}
          className="w-full rounded-lg border border-border bg-transparent px-4 py-2 text-sm font-semibold text-text-light transition-colors hover:bg-gray-100 hover:text-dark dark:border-darkmode-border dark:text-darkmode-text-light dark:hover:bg-white/5 dark:hover:text-white"
        >
          Tolak
        </button>
        <button
          onClick={handleAccept}
          className="w-full rounded-lg bg-primary px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-primary/20 transition-all hover:-translate-y-0.5 hover:shadow-primary/40 dark:text-black"
        >
          Terima Semua
        </button>
      </div>
    </div>
  );
};

export default CookieConsent;
```

---

### File: `./src/layouts/helpers/DynamicIcon.tsx`

```tsx
import React, { type FC } from "react";
import type { IconType } from "react-icons";
import * as FaIcons from "react-icons/fa6";

type IconMap = Record<string, IconType>;

interface IDynamicIcon extends React.SVGProps<SVGSVGElement> {
  icon: string;
  className?: string;
}

const iconLibraries: { [key: string]: IconMap } = {
  fa: FaIcons,
};

const DynamicIcon: FC<IDynamicIcon> = ({ icon, ...props }) => {
  const IconLibrary = getIconLibrary(icon);
  const Icon = IconLibrary ? IconLibrary[icon] : undefined;

  if (!Icon) {
    return <span className="text-sm">Ikon tidak ditemukan</span>;
  }

  return <Icon {...props} />;
};

const getIconLibrary = (icon: string): IconMap | undefined => {
  const libraryKey = icon.substring(0, 2).toLowerCase();

  return iconLibraries[libraryKey];
};

export default DynamicIcon;
```

---

### File: `./src/layouts/helpers/GiscusComment.tsx`

```tsx
import React, { useEffect, useState } from "react";
import Giscus from "@giscus/react";

const GiscusComment = () => {
  const [theme, setTheme] = useState("light");

  useEffect(() => {
    const updateGiscusTheme = () => {
      const isDark = document.documentElement.classList.contains("dark");
      setTheme(isDark ? "transparent_dark" : "light");
    };
    updateGiscusTheme();
    const observer = new MutationObserver((mutations) => {
      mutations.forEach((mutation) => {
        if (
          mutation.type === "attributes" &&
          mutation.attributeName === "class"
        ) {
          updateGiscusTheme();
        }
      });
    });

    observer.observe(document.documentElement, {
      attributes: true,
      attributeFilter: ["class"],
    });

    return () => observer.disconnect();
  }, []);

  return (
    <div className="mt-14 pt-10 border-t border-border dark:border-darkmode-border">
      <h3 className="h5 mb-6">Komentar</h3>
      <Giscus
        id="comments"
        repo="zulfikriyahya/mtsn1pandeglang"
        repoId="R_kgDOOC18-g"
        category="General"
        categoryId="DIC_kwDOOC18-s4C0zja"
        mapping="pathname"
        term="Komentar di MTsN 1 Pandeglang"
        reactionsEnabled="1"
        emitMetadata="0"
        inputPosition="top"
        theme={theme}
        lang="id"
        loading="lazy"
      />
    </div>
  );
};

export default GiscusComment;
```

---

### File: `./src/layouts/helpers/InstallPrompt.tsx`

```tsx
import type { ReactElement } from "react";
import { useEffect, useState } from "react";

interface BeforeInstallPromptEvent extends Event {
  prompt: () => Promise<void>;
  userChoice: Promise<{ outcome: "accepted" | "dismissed" }>;
}

const InstallPrompt = () => {
  const [deferredPrompt, setDeferredPrompt] =
    useState<BeforeInstallPromptEvent | null>(null);
  const [showInstallPrompt, setShowInstallPrompt] = useState(false);
  const [isIOS, setIsIOS] = useState(false);
  const [isDarkMode, setIsDarkMode] = useState(false);

  useEffect(() => {
    const sessionDismissed = sessionStorage.getItem("pwa-install-dismissed");
    const isIOSDevice = /iPad|iPhone|iPod/.test(navigator.userAgent);
    setIsIOS(isIOSDevice);
    const isDark = document.documentElement.classList.contains("dark");
    setIsDarkMode(isDark);
    const observer = new MutationObserver(() => {
      const isDark = document.documentElement.classList.contains("dark");
      setIsDarkMode(isDark);
    });

    observer.observe(document.documentElement, {
      attributes: true,
      attributeFilter: ["class"],
    });

    const handleBeforeInstallPrompt = (e: Event) => {
      console.log("beforeinstallprompt event fired");
      e.preventDefault();
      setDeferredPrompt(e as BeforeInstallPromptEvent);

      if (!sessionDismissed) {
        setTimeout(() => {
          console.log("Showing install prompt");
          setShowInstallPrompt(true);
        }, 3000);
      }
    };

    console.log("InstallPrompt mounted, isIOS:", isIOSDevice);
    console.log("Session dismissed:", sessionDismissed);

    window.addEventListener("beforeinstallprompt", handleBeforeInstallPrompt);

    return () => {
      window.removeEventListener(
        "beforeinstallprompt",
        handleBeforeInstallPrompt,
      );
      observer.disconnect();
    };
  }, []);

  const handleInstall = async () => {
    if (!deferredPrompt) return;

    try {
      await deferredPrompt.prompt();
      const { outcome } = await deferredPrompt.userChoice;

      if (outcome === "accepted") {
        console.log("PWA installed successfully");
      }

      setDeferredPrompt(null);
      setShowInstallPrompt(false);
      sessionStorage.setItem("pwa-install-dismissed", "true");
    } catch (error) {
      console.error("Error installing PWA:", error);
    }
  };

  const handleDismiss = () => {
    setShowInstallPrompt(false);
    sessionStorage.setItem("pwa-install-dismissed", "true");
  };

  if (!showInstallPrompt) return null;

  return (
    <div className="fixed bottom-4 left-4 right-4 md:left-auto md:right-4 md:w-96 z-50 animate-slide-up">
      <div className="rounded-lg border border-border bg-white shadow-2xl dark:border-darkmode-border dark:bg-darkmode-body">
        <div className="p-4">
          <div className="flex items-start gap-3">
            <div className="flex-shrink-0">
              <img
                src="/images/icons/icon-192x192.png"
                alt="App Icon"
                className="h-12 w-12 rounded-lg"
              />
            </div>

            <div className="flex-1">
              <h3 className="mb-1 font-semibold text-dark dark:text-white">
                Install Aplikasi
              </h3>
              <p className="mb-3 text-sm text-gray-600 dark:text-gray-300">
                {isIOS
                  ? "Bagikan → Tambah ke Home Screen untuk akses lebih cepat!"
                  : "Install MTs Negeri 1 Pandeglang untuk akses lebih cepat dan bisa digunakan offline!"}
              </p>

              <div className="flex gap-2">
                {!isIOS && deferredPrompt && (
                  <button
                    onClick={handleInstall}
                    className="rounded-lg bg-primary px-4 py-2 text-sm font-semibold text-white transition-opacity hover:opacity-90"
                  >
                    Install Sekarang
                  </button>
                )}
                <button
                  onClick={handleDismiss}
                  className="rounded-lg bg-gray-200 px-4 py-2 text-sm font-semibold text-gray-900 transition-opacity hover:opacity-90 dark:bg-gray-700 dark:text-gray-100"
                >
                  {isIOS ? "Tutup" : "Nanti Saja"}
                </button>
              </div>
            </div>

            <button
              onClick={handleDismiss}
              className="flex-shrink-0 text-gray-500 transition-colors hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200"
              aria-label="Close"
            >
              <svg
                className="h-5 w-5"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  strokeLinecap="round"
                  strokeLinejoin="round"
                  strokeWidth={2}
                  d="M6 18L18 6M6 6l12 12"
                />
              </svg>
            </button>
          </div>
        </div>
      </div>
    </div>
  );
};

export default InstallPrompt;
```

---

### File: `./src/layouts/helpers/PostViewCounter.tsx`

```tsx
import React, { useEffect, useState } from "react";
import { FaRegEye } from "react-icons/fa";

const PostViewCounter = () => {
  const [views, setViews] = useState("...");

  useEffect(() => {
    const pathSegments = window.location.pathname.split("/").filter(Boolean);
    const rawSlug = pathSegments[pathSegments.length - 1] || "home";
    const safeSlug = rawSlug.replace(/[^a-zA-Z0-9]/g, "_");

    const sessionKey = `viewed_${safeSlug}`;
    const hasViewed = sessionStorage.getItem(sessionKey);

    const hitViews = async () => {
      try {
        const url = `/api/stats.php?action=view&slug=${safeSlug}`;
        const method = !hasViewed ? "POST" : "GET";
        const response = await fetch(url, { method });
        if (response.ok) {
          const data = await response.json();
          setViews(data.value.toLocaleString("id-ID"));
          if (!hasViewed) sessionStorage.setItem(sessionKey, "true");
        }
      } catch (error) {
        console.error(error);
      }
    };
    hitViews();
  }, []);

  return (
    <span className="flex items-center gap-2" title="Jumlah Pembaca">
      <FaRegEye className="text-gray-500 dark:text-gray-400" />
      <span className="font-regular">{views}</span>
      <span className="text-md">Kali dibaca</span>
    </span>
  );
};

export default PostViewCounter;
```

---

### File: `./src/layouts/helpers/ProfilMahasiswaPLP.tsx`

```tsx
import React, { useState, useEffect } from "react";
import {
  FaChevronLeft,
  FaChevronRight,
  FaGraduationCap,
  FaUser,
  FaBook,
  FaPause,
  FaPlay,
} from "react-icons/fa";

const mahasiswaData = [
  {
    nama: "Siti Arifah",
    nim: "221250030",
    jurusan: "Manajemen Pendidikan Islam (MPI)",
    guruPamong: "Mahbudin, M.Pd.",
    foto: "/images/artikel/plp-kkn/2025/uin-banten/siti-arifah.png",
  },
  {
    nama: "Ine Febriyanti",
    nim: "221250031",
    jurusan: "Manajemen Pendidikan Islam (MPI)",
    guruPamong: "Mahbudin, M.Pd.",
    foto: "/images/artikel/plp-kkn/2025/uin-banten/ine-febriyanti.png",
  },
  {
    nama: "Muhammad Faqih Abdul Wafa",
    nim: "221210172",
    jurusan: "Pendidikan Agama Islam (PAI)",
    guruPamong: "Euis Sofi Sulasiah, M.Pd.",
    foto: "/images/artikel/plp-kkn/2025/uin-banten/muhammad-faqih-abdul-wafa.png",
  },
  {
    nama: "Rihadatul A'isy",
    nim: "221210007",
    jurusan: "Pendidikan Agama Islam (PAI)",
    guruPamong: "Euis Sofi Sulasiah, M.Pd.",
    foto: "/images/artikel/plp-kkn/2025/uin-banten/rihadatul-aisy.png",
  },
  {
    nama: "Muhammad Abdullah",
    nim: "221210118",
    jurusan: "Pendidikan Agama Islam (PAI)",
    guruPamong: "H. Solichul Hadi M.Ag.",
    foto: "/images/artikel/plp-kkn/2025/uin-banten/muhammad-abdullah.png",
  },
  {
    nama: "Siti Khoirunisa",
    nim: "221210100",
    jurusan: "Pendidikan Agama Islam (PAI)",
    guruPamong: "H. Solichul Hadi M.Ag.",
    foto: "/images/artikel/plp-kkn/2025/uin-banten/siti-khoirunisa.png",
  },
  {
    nama: "Nur Indah Isnaini",
    nim: "221210020",
    jurusan: "Pendidikan Agama Islam (PAI)",
    guruPamong: "Siti Wahidoh, S.Pd.I.",
    foto: "/images/artikel/plp-kkn/2025/uin-banten/nur-indah-isnaini.png",
  },
  {
    nama: "Susi Susilawati",
    nim: "221220017",
    jurusan: "Pendidikan Bahasa Arab (PBA)",
    guruPamong: "Aam Amalia, S.Pd.I.",
    foto: "/images/artikel/plp-kkn/2025/uin-banten/susi-susilawati.png",
  },
  {
    nama: "Aulia Al Qisti Nazifah",
    nim: "221220026",
    jurusan: "Pendidikan Bahasa Arab (PBA)",
    guruPamong: "Aam Amalia, S.Pd.I.",
    foto: "/images/artikel/plp-kkn/2025/uin-banten/aulia-al-qisti-nazifah.png",
  },
  {
    nama: "Linda Mutia Rahmah",
    nim: "221220060",
    jurusan: "Pendidikan Bahasa Arab (PBA)",
    guruPamong: "Siti maryam, S.Pd.I.",
    foto: "/images/artikel/plp-kkn/2025/uin-banten/linda-mutia-rahmah.png",
  },
  {
    nama: "Pia Fatmawati",
    nim: "221220075",
    jurusan: "Pendidikan Bahasa Arab (PBA)",
    guruPamong: "Siti maryam, S.Pd.I.",
    foto: "/images/artikel/plp-kkn/2025/uin-banten/pia-fatmawati.png",
  },
  {
    nama: "Hafidz Dian Nugraha",
    nim: "221220077",
    jurusan: "Pendidikan Bahasa Arab (PBA)",
    guruPamong: "Siti maryam, S.Pd.I.",
    foto: "/images/artikel/plp-kkn/2025/uin-banten/hafidz-dian-nugraha.png",
  },
  {
    nama: "Amalia Fatihah",
    nim: "221230073",
    jurusan: "Tadris Bahasa Inggris (TBI)",
    guruPamong: "Mahbudin, M.Pd.",
    foto: "/images/artikel/plp-kkn/2025/uin-banten/amalia-fatihah.png",
  },
  {
    nama: "Alfina Husna Azkia",
    nim: "221230074",
    jurusan: "Tadris Bahasa Inggris (TBI)",
    guruPamong: "Endah Humaedah, M.Pd.",
    foto: "/images/artikel/plp-kkn/2025/uin-banten/alfina-husna-azkia.png",
  },
  {
    nama: "Muhoiriah",
    nim: "221230075",
    jurusan: "Tadris Bahasa Inggris (TBI)",
    guruPamong: "Endah Humaedah, M.Pd.",
    foto: "/images/artikel/plp-kkn/2025/uin-banten/muhoiriah.png",
  },
  {
    nama: "Nina Isnaiyah",
    nim: "221230077",
    jurusan: "Tadris Bahasa Inggris (TBI)",
    guruPamong: "Cucu Wakiah, S.Pd.",
    foto: "/images/artikel/plp-kkn/2025/uin-banten/nina-isnaiyah.png",
  },
  {
    nama: "Khoirotunnisa",
    nim: "221230142",
    jurusan: "Tadris Bahasa Inggris (TBI)",
    guruPamong: "Cucu Wakiah, S.Pd.",
    foto: "/images/artikel/plp-kkn/2025/uin-banten/khoirotunnisa.png",
  },
];

export default function ProfilMahasiswaPLP() {
  const [currentIndex, setCurrentIndex] = useState(0);
  const [isAutoplay, setIsAutoplay] = useState(true);

  useEffect(() => {
    if (!isAutoplay) return;

    const interval = setInterval(() => {
      setCurrentIndex((prev) => (prev + 1) % mahasiswaData.length);
    }, 5000);

    return () => clearInterval(interval);
  }, [isAutoplay]);

  const nextSlide = () => {
    setIsAutoplay(false);
    setCurrentIndex((prev) => (prev + 1) % mahasiswaData.length);
  };

  const prevSlide = () => {
    setIsAutoplay(false);
    setCurrentIndex(
      (prev) => (prev - 1 + mahasiswaData.length) % mahasiswaData.length,
    );
  };

  const goToSlide = (index) => {
    setIsAutoplay(false);
    setCurrentIndex(index);
  };

  const currentMahasiswa = mahasiswaData[currentIndex];

  return (
    <div className="w-full my-12">
      <div className="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-500">
        <div className="relative">
          <div className="grid lg:grid-cols-5 gap-6 p-6 lg:p-8">
            <div className="lg:col-span-2 flex items-center justify-center py-4">
              <div className="relative w-full max-w-sm">
                <div className="aspect-square rounded-2xl overflow-hidden shadow-lg border-4 border-blue-50 bg-gradient-to-br from-blue-50 to-indigo-50 flex items-center justify-center p-4">
                  <img
                    src={currentMahasiswa.foto}
                    alt={currentMahasiswa.nama}
                    className="w-full h-full object-contain transition-transform duration-300 hover:scale-105"
                    onError={(e) => {
                      e.target.src = "/images/avatar.png";
                    }}
                  />
                </div>

                <div className="absolute -bottom-3 -right-3 bg-gradient-to-br from-blue-600 to-indigo-600 text-white rounded-full w-14 h-14 flex items-center justify-center font-bold text-xl shadow-lg border-4 border-white">
                  {currentIndex + 1}
                </div>
              </div>
            </div>

            <div className="lg:col-span-3 flex flex-col justify-center space-y-6">
              <div>
                <h3 className="text-3xl lg:text-4xl font-bold text-gray-900 mb-2">
                  {currentMahasiswa.nama}
                </h3>
                <div className="h-1 w-20 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-full"></div>
              </div>

              <div className="grid gap-4">
                <div className="flex items-start space-x-3 p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                  <div className="bg-blue-100 p-2.5 rounded-lg flex-shrink-0">
                    <FaUser className="text-xl text-blue-600" />
                  </div>
                  <div className="min-w-0 flex-1">
                    <p className="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">
                      Nomor Induk Mahasiswa
                    </p>
                    <p className="text-lg font-bold text-gray-900">
                      {currentMahasiswa.nim}
                    </p>
                  </div>
                </div>

                <div className="flex items-start space-x-3 p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                  <div className="bg-indigo-100 p-2.5 rounded-lg flex-shrink-0">
                    <FaGraduationCap className="text-xl text-indigo-600" />
                  </div>
                  <div className="min-w-0 flex-1">
                    <p className="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">
                      Program Studi
                    </p>
                    <p className="text-lg font-bold text-gray-900">
                      {currentMahasiswa.jurusan}
                    </p>
                  </div>
                </div>

                <div className="flex items-start space-x-3 p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                  <div className="bg-purple-100 p-2.5 rounded-lg flex-shrink-0">
                    <FaBook className="text-xl text-purple-600" />
                  </div>
                  <div className="min-w-0 flex-1">
                    <p className="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">
                      Guru Pembimbing
                    </p>
                    <p className="text-lg font-bold text-gray-900">
                      {currentMahasiswa.guruPamong}
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <button
            onClick={prevSlide}
            className="absolute left-2 top-1/2 -translate-y-1/2 bg-white/95 hover:bg-white p-2.5 rounded-full shadow-lg transition-all hover:scale-110 hover:shadow-xl z-10"
            aria-label="Previous"
          >
            <FaChevronLeft className="text-xl text-gray-700" />
          </button>
          <button
            onClick={nextSlide}
            className="absolute right-2 top-1/2 -translate-y-1/2 bg-white/95 hover:bg-white p-2.5 rounded-full shadow-lg transition-all hover:scale-110 hover:shadow-xl z-10"
            aria-label="Next"
          >
            <FaChevronRight className="text-xl text-gray-700" />
          </button>
        </div>

        <div className="flex justify-center items-center gap-2 py-6 px-4 bg-gradient-to-b from-white to-gray-50 overflow-x-auto">
          {mahasiswaData.map((_, index) => (
            <button
              key={index}
              onClick={() => goToSlide(index)}
              className={`transition-all rounded-full flex-shrink-0 ${
                index === currentIndex
                  ? "w-8 h-2.5 bg-gradient-to-r from-blue-600 to-indigo-600"
                  : "w-2.5 h-2.5 bg-gray-300 hover:bg-gray-400"
              }`}
              aria-label={`Go to slide ${index + 1}`}
              title={mahasiswaData[index].nama}
            />
          ))}
        </div>

        <div className="px-6 py-4 bg-gray-50 border-t border-gray-100">
          <div className="flex items-center justify-between text-sm">
            <span className="text-gray-600">
              Mahasiswa{" "}
              <span className="font-bold text-gray-900">
                {currentIndex + 1}
              </span>{" "}
              dari{" "}
              <span className="font-bold text-gray-900">
                {mahasiswaData.length}
              </span>
            </span>
            <button
              onClick={() => setIsAutoplay(!isAutoplay)}
              className={`flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-medium transition-colors ${
                isAutoplay
                  ? "bg-blue-100 text-blue-700 hover:bg-blue-200"
                  : "bg-gray-200 text-gray-700 hover:bg-gray-300"
              }`}
            >
              {isAutoplay ? (
                <>
                  <FaPause /> Pause
                </>
              ) : (
                <>
                  <FaPlay /> Play
                </>
              )}
            </button>
          </div>
        </div>
      </div>
    </div>
  );
}
```

---

### File: `./src/layouts/helpers/SearchModal.tsx`

```tsx
import searchData from ".json/search.json";
import React, { useEffect, useState } from "react";
import SearchResult, { type ISearchItem } from "./SearchResult";

const SearchModal = () => {
  const [searchString, setSearchString] = useState("");
  const handleSearch = (e: React.FormEvent<HTMLInputElement>) => {
    setSearchString(e.currentTarget.value.replace("\\", "").toLowerCase());
  };
  const doSearch = (searchData: ISearchItem[]) => {
    const regex = new RegExp(`${searchString}`, "gi");
    if (searchString === "") {
      return [];
    } else {
      const searchResult = searchData.filter((item) => {
        const title = item.frontmatter.title.toLowerCase().match(regex);
        const description = item.frontmatter.description
          ?.toLowerCase()
          .match(regex);
        const categories = item.frontmatter.categories
          ?.join(" ")
          .toLowerCase()
          .match(regex);
        const tags = item.frontmatter.tags
          ?.join(" ")
          .toLowerCase()
          .match(regex);
        const content = item.content.toLowerCase().match(regex);

        if (title || content || description || categories || tags) {
          return item;
        }
      });
      return searchResult;
    }
  };
  const startTime = performance.now();
  const searchResult = doSearch(searchData as ISearchItem[]);
  const endTime = performance.now();
  const totalTime = ((endTime - startTime) / 1000).toFixed(3);
  useEffect(() => {
    const searchModal = document.getElementById("searchModal");
    const searchInput = document.getElementById("searchInput");
    const searchModalOverlay = document.getElementById("searchModalOverlay");
    const searchResultItems = document.querySelectorAll("#searchItem");
    const searchModalTriggers = document.querySelectorAll(
      "[data-search-trigger]",
    );

    const openModal = () => {
      searchModal!.classList.add("show");
      document.body.classList.add("overflow-hidden");
      searchInput!.focus();
    };

    const closeModal = () => {
      searchModal!.classList.remove("show");
      document.body.classList.remove("overflow-hidden");
      setSearchString("");
    };
    searchModalTriggers.forEach((button) => {
      button.addEventListener("click", openModal);
    });
    searchModalOverlay!.addEventListener("click", closeModal);
    let selectedIndex = -1;

    const updateSelection = () => {
      searchResultItems.forEach((item, index) => {
        if (index === selectedIndex) {
          item.classList.add("search-result-item-active");
        } else {
          item.classList.remove("search-result-item-active");
        }
      });

      searchResultItems[selectedIndex]?.scrollIntoView({
        behavior: "smooth",
        block: "nearest",
      });
    };

    const handleKeyDown = (event: KeyboardEvent) => {
      if ((event.metaKey || event.ctrlKey) && event.key === "k") {
        event.preventDefault();
        openModal();
        updateSelection();
      }

      if (searchModal!.classList.contains("show")) {
        if (event.key === "ArrowUp" || event.key === "ArrowDown") {
          event.preventDefault();
        }

        if (event.key === "Escape") {
          closeModal();
        }

        if (event.key === "ArrowUp" && selectedIndex > 0) {
          selectedIndex--;
        } else if (
          event.key === "ArrowDown" &&
          selectedIndex < searchResultItems.length - 1
        ) {
          selectedIndex++;
        } else if (event.key === "Enter") {
          const activeLink = document.querySelector(
            ".search-result-item-active a",
          ) as HTMLAnchorElement;
          if (activeLink) {
            activeLink?.click();
            document.body.classList.remove("overflow-hidden");
          }
        }
        updateSelection();
      }
    };

    document.addEventListener("keydown", handleKeyDown);

    return () => {
      searchModalTriggers.forEach((button) => {
        button.removeEventListener("click", openModal);
      });
      searchModalOverlay!.removeEventListener("click", closeModal);
      document.removeEventListener("keydown", handleKeyDown);
    };
  }, [searchString]);

  return (
    <div id="searchModal" className="search-modal">
      <div id="searchModalOverlay" className="search-modal-overlay" />
      <div className="search-wrapper">
        <div className="search-wrapper-header">
          <label
            htmlFor="searchInput"
            className="absolute left-7 top-[calc(50%-7px)]"
          >
            <span className="sr-only">Cari ikon</span>
            {searchString ? (
              <svg
                onClick={() => setSearchString("")}
                viewBox="0 0 512 512"
                height="18"
                width="18"
                className="hover:text-red-500 cursor-pointer -mt-0.5"
              >
                <title>Ikon Tutup</title>
                <path
                  fill="currentcolor"
                  d="M256 512A256 256 0 10256 0a256 256 0 100 512zM175 175c9.4-9.4 24.6-9.4 33.9.0l47 47 47-47c9.4-9.4 24.6-9.4 33.9.0s9.4 24.6.0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6.0 33.9s-24.6 9.4-33.9.0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9.0s-9.4-24.6.0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6.0-33.9z"
                ></path>
              </svg>
            ) : (
              <svg
                viewBox="0 0 512 512"
                height="18"
                width="18"
                className="-mt-0.5"
              >
                <title>Ikon Cari</title>
                <path
                  fill="currentcolor"
                  d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8.0 45.3s-32.8 12.5-45.3.0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9.0 208S93.1.0 208 0 416 93.1 416 208zM208 352a144 144 0 100-288 144 144 0 100 288z"
                ></path>
              </svg>
            )}
          </label>
          <input
            id="searchInput"
            placeholder="Cari artikel, halaman, atau pengumuman..."
            className="search-wrapper-header-input"
            type="input"
            name="search"
            value={searchString}
            onChange={handleSearch}
            autoComplete="off"
          />
        </div>
        <SearchResult searchResult={searchResult} searchString={searchString} />
        <div className="search-wrapper-footer">
          <span className="flex items-center">
            <kbd>
              <svg
                width="14"
                height="14"
                fill="currentcolor"
                viewBox="0 0 16 16"
              >
                <path d="M3.204 11h9.592L8 5.519 3.204 11zm-.753-.659 4.796-5.48a1 1 0 011.506.0l4.796 5.48c.566.647.106 1.659-.753 1.659H3.204a1 1 0 01-.753-1.659z"></path>
              </svg>
            </kbd>
            <kbd>
              <svg
                width="14"
                height="14"
                fill="currentcolor"
                viewBox="0 0 16 16"
              >
                <path d="M3.204 5h9.592L8 10.481 3.204 5zm-.753.659 4.796 5.48a1 1 0 001.506.0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 00-.753 1.659z"></path>
              </svg>
            </kbd>
            untuk navigasi
          </span>
          <span className="flex items-center">
            <kbd>
              <svg
                width="12"
                height="12"
                fill="currentcolor"
                viewBox="0 0 16 16"
              >
                <path
                  fillRule="evenodd"
                  d="M14.5 1.5a.5.5.0 01.5.5v4.8a2.5 2.5.0 01-2.5 2.5H2.707l3.347 3.346a.5.5.0 01-.708.708l-4.2-4.2a.5.5.0 010-.708l4-4a.5.5.0 11.708.708L2.707 8.3H12.5A1.5 1.5.0 0014 6.8V2a.5.5.0 01.5-.5z"
                ></path>
              </svg>
            </kbd>
            untuk memilih
          </span>
          {searchString && (
            <span>
              <strong>{searchResult.length} </strong> Hasil - dalam{" "}
              <strong>{totalTime} </strong> detik
            </span>
          )}
          <span>
            <kbd>ESC</kbd> untuk menutup
          </span>
        </div>
      </div>
    </div>
  );
};

export default SearchModal;
```

---

### File: `./src/layouts/helpers/SearchResult.tsx`

```tsx
import { plainify, titleify } from "@/lib/utils/textConverter";
import React from "react";

export interface ISearchItem {
  group: string;
  slug: string;
  frontmatter: {
    title: string;
    image?: string;
    description?: string;
    categories?: string[];
    tags?: string[];
  };
  content: string;
}

export interface ISearchGroup {
  group: string;
  groupItems: {
    slug: string;
    frontmatter: {
      title: string;
      image?: string;
      description?: string;
      categories?: string[];
      tags?: string[];
    };
    content: string;
  }[];
}
const SearchResult = ({
  searchResult,
  searchString,
}: {
  searchResult: ISearchItem[];
  searchString: string;
}) => {
  const generateSearchGroup = (searchResult: ISearchItem[]) => {
    const joinDataByGroup: ISearchGroup[] = searchResult.reduce(
      (groupItems: ISearchGroup[], item: ISearchItem) => {
        const groupIndex = groupItems.findIndex(
          (group) => group.group === item.group,
        );
        if (groupIndex === -1) {
          groupItems.push({
            group: item.group,
            groupItems: [
              {
                frontmatter: { ...item.frontmatter },
                slug: item.slug,
                content: item.content,
              },
            ],
          });
        } else {
          groupItems[groupIndex].groupItems.push({
            frontmatter: { ...item.frontmatter },
            slug: item.slug,
            content: item.content,
          });
        }

        return groupItems;
      },
      [],
    );
    return joinDataByGroup;
  };
  const finalResult = generateSearchGroup(searchResult);

  const matchMarker = (text: string, substring: string) => {
    const parts = text.split(new RegExp(`(${substring})`, "gi"));
    return parts.map((part, index) =>
      part.toLowerCase() === substring.toLowerCase() ? (
        <mark key={index}>{part}</mark>
      ) : (
        part
      ),
    );
  };

  const matchUnderline = (text: string, substring: string) => {
    const parts = text?.split(new RegExp(`(${substring})`, "gi"));
    return parts?.map((part, index) =>
      part.toLowerCase() === substring.toLowerCase() ? (
        <span key={index} className="underline">
          {part}
        </span>
      ) : (
        part
      ),
    );
  };

  const matchContent = (content: string, substring: string) => {
    const plainContent = plainify(content);
    const position = plainContent
      .toLowerCase()
      .indexOf(substring.toLowerCase());

    let wordStart = position;
    while (wordStart > 0 && plainContent[wordStart - 1] !== " ") {
      wordStart--;
    }

    const matches = plainContent.substring(
      wordStart,
      substring.length + position,
    );
    const matchesAfter = plainContent.substring(
      substring.length + position,
      substring.length + position + 80,
    );
    return (
      <>
        {matchMarker(matches, substring)}
        {matchesAfter}
      </>
    );
  };

  return (
    <div className="search-wrapper-body">
      {searchString ? (
        <div className="search-result">
          {finalResult.length > 0 ? (
            finalResult.map((result) => (
              <div className="search-result-group" key={result.group}>
                <p className="search-result-group-title">
                  {titleify(result.group)}
                </p>

                {result.groupItems.map((item) => (
                  <div
                    key={item.slug}
                    id="searchItem"
                    className="search-result-item"
                  >
                    {item.frontmatter.image && (
                      <div className="search-result-item-image">
                        <img
                          src={item.frontmatter.image}
                          alt={item.frontmatter.title}
                        />
                      </div>
                    )}
                    <div className="search-result-item-body">
                      <a
                        href={`/${item.slug}`}
                        className="search-result-item-title search-result-item-link"
                      >
                        {matchUnderline(item.frontmatter.title, searchString)}
                      </a>
                      {item.frontmatter.description && (
                        <p className="search-result-item-description">
                          {matchUnderline(
                            item.frontmatter.description,
                            searchString,
                          )}
                        </p>
                      )}
                      {item.content && (
                        <p className="search-result-item-content">
                          {matchContent(item.content, searchString)}
                        </p>
                      )}
                      <div className="search-result-item-taxonomies">
                        {item.frontmatter.categories && (
                          <div className="mr-2">
                            <svg
                              width="14"
                              height="14"
                              fill="currentColor"
                              viewBox="0 0 16 16"
                            >
                              <path d="M11 0H3a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2 2 2 0 0 0 2-2V4a2 2 0 0 0-2-2 2 2 0 0 0-2-2zm2 3a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1V3zM2 2a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V2z"></path>
                            </svg>
                            {item.frontmatter.categories.map(
                              (category, index) => (
                                <span key={category}>
                                  {matchUnderline(category, searchString)}
                                  {item.frontmatter.categories &&
                                    index !==
                                      item.frontmatter.categories.length -
                                        1 && <>, </>}
                                </span>
                              ),
                            )}
                          </div>
                        )}
                        {item.frontmatter.tags && (
                          <div className="mr-2">
                            <svg
                              width="14"
                              height="14"
                              fill="currentColor"
                              viewBox="0 0 16 16"
                            >
                              <path d="M3 2v4.586l7 7L14.586 9l-7-7H3zM2 2a1 1 0 0 1 1-1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 2 6.586V2z"></path>
                              <path d="M5.5 5a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm0 1a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zM1 7.086a1 1 0 0 0 .293.707L8.75 15.25l-.043.043a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 0 7.586V3a1 1 0 0 1 1-1v5.086z"></path>
                            </svg>
                            {item.frontmatter.tags.map((tag, index) => (
                              <span key={tag}>
                                {matchUnderline(tag, searchString)}
                                {item.frontmatter.tags &&
                                  index !==
                                    item.frontmatter.tags.length - 1 && <>, </>}
                              </span>
                            ))}
                          </div>
                        )}
                      </div>
                    </div>
                  </div>
                ))}
              </div>
            ))
          ) : (
            <div className="search-result-empty">
              <svg
                className="mx-auto"
                width="42"
                height="42"
                viewBox="0 0 47 47"
                fill="none"
              >
                <path
                  fillRule="evenodd"
                  clipRule="evenodd"
                  d="M7.10368 33.9625C9.90104 36.2184 13.2988 37.6547 16.9158 38.0692C21.6958 38.617 26.5063 37.3401 30.3853 34.4939C30.4731 34.6109 30.5668 34.7221 30.6721 34.8304L41.9815 46.1397C42.5323 46.6909 43.2795 47.0007 44.0587 47.001C44.838 47.0013 45.5854 46.692 46.1366 46.1412C46.6878 45.5904 46.9976 44.8432 46.9979 44.064C46.9981 43.2847 46.6888 42.5373 46.138 41.9861L34.8287 30.6767C34.7236 30.5704 34.6107 30.4752 34.4909 30.3859C37.3352 26.5046 38.6092 21.6924 38.0579 16.912C37.6355 13.2498 36.1657 9.81322 33.8586 6.9977L31.7805 9.09214C34.0157 11.9274 35.2487 15.4472 35.2487 19.0942C35.2487 21.2158 34.8308 23.3167 34.0189 25.2769C33.207 27.2371 32.0169 29.0181 30.5167 30.5184C29.0164 32.0186 27.2354 33.2087 25.2752 34.0206C23.315 34.8325 21.2141 35.2504 19.0925 35.2504C16.9708 35.2504 14.8699 34.8325 12.9098 34.0206C11.5762 33.4682 10.3256 32.7409 9.18992 31.8599L7.10368 33.9625ZM28.9344 6.28152C26.1272 4.12516 22.671 2.93792 19.0925 2.93792C14.8076 2.93792 10.6982 4.64009 7.66829 7.66997C4.6384 10.6999 2.93623 14.8093 2.93623 19.0942C2.93623 21.2158 3.35413 23.3167 4.16605 25.2769C4.72475 26.6257 5.4625 27.8897 6.35716 29.0358L4.2702 31.1391C1.35261 27.548 -0.165546 23.0135 0.00974294 18.3781C0.19158 13.5695 2.18233 9.00695 5.58371 5.60313C8.98509 2.19932 13.5463 0.205307 18.3547 0.0200301C22.9447 -0.156832 27.4369 1.32691 31.0132 4.18636L28.9344 6.28152Z"
                  fill="currentColor"
                ></path>
                <path
                  d="M3.13672 39.1367L38.3537 3.64355"
                  stroke="black"
                  strokeWidth="3"
                  strokeLinecap="round"
                ></path>
              </svg>
              <p className="mt-4">
                Tidak ada hasil untuk &quot;<strong>{searchString}</strong>
                &quot;
              </p>
            </div>
          )}
        </div>
      ) : (
        <div className="py-8 text-center">Ketik sesuatu untuk mencari...</div>
      )}
    </div>
  );
};

export default SearchResult;
```

---

### File: `./src/layouts/helpers/ServiceRating.tsx`

```tsx
import React, { useState, useEffect } from "react";
import { FaStar, FaUserCheck } from "react-icons/fa";

const ServiceRating = () => {
  const [rating, setRating] = useState(0);
  const [hover, setHover] = useState(0);
  const [name, setName] = useState("");
  const [message, setMessage] = useState("");
  const [status, setStatus] = useState<
    "idle" | "loading" | "submitting" | "success" | "error" | "submitted"
  >("loading");
  const [responseMsg, setResponseMsg] = useState("");

  // State untuk menyimpan data statistik
  const [stats, setStats] = useState({ average: 0, total: 0 });

  // 1. Cek Status saat load
  useEffect(() => {
    const checkStatus = async () => {
      try {
        const res = await fetch("/api/feedback.php");
        const data = await res.json();

        if (data.stats) setStats(data.stats);

        if (data.has_submitted) {
          setStatus("submitted");
        } else {
          setStatus("idle");
        }
      } catch (error) {
        setStatus("error");
      }
    };
    checkStatus();
  }, []);

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    if (rating === 0) {
      alert("Mohon berikan bintang terlebih dahulu.");
      return;
    }

    setStatus("submitting");

    try {
      const res = await fetch("/api/feedback.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ name, rating, message }),
      });

      const data = await res.json();

      if (res.ok && data.status === "success") {
        setStatus("submitted"); // Ubah ke submitted agar tampil statistik
        if (data.stats) setStats(data.stats);
        setResponseMsg(data.message);
      } else {
        setStatus("error");
        setResponseMsg(data.message || "Terjadi kesalahan.");
      }
    } catch (error) {
      setStatus("error");
      setResponseMsg("Gagal menghubungi server.");
    }
  };

  // Tampilan Hasil Statistik (Jika sudah submit)
  if (status === "submitted") {
    return (
      <div className="rounded-xl border border-border bg-white p-8 shadow-sm text-center dark:border-darkmode-border dark:bg-darkmode-body">
        <div className="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-green-100 text-green-600 mb-4 animate-bounce">
          <FaUserCheck size={30} />
        </div>
        <h3 className="h4 mb-2 text-green-700 dark:text-green-400">
          Terima Kasih!
        </h3>
        <p className="mb-6 text-sm text-text-light">
          Anda sudah memberikan penilaian untuk layanan kami.
        </p>

        <div className="bg-light dark:bg-darkmode-light p-6 rounded-lg">
          <p className="text-sm font-semibold mb-2 uppercase tracking-wide text-text-light">
            Indeks Kepuasan Masyarakat
          </p>
          <div className="flex justify-center items-end gap-2 mb-2">
            <span className="text-5xl font-bold text-primary">
              {stats.average}
            </span>
            <span className="text-xl text-gray-400 mb-1">/ 5.0</span>
          </div>
          <div className="flex justify-center gap-1 mb-4">
            {[1, 2, 3, 4, 5].map((star) => (
              <FaStar
                key={star}
                size={20}
                className={
                  star <= Math.round(stats.average)
                    ? "text-yellow-400"
                    : "text-gray-300"
                }
              />
            ))}
          </div>
          <p className="text-xs text-text-light">
            Berdasarkan {stats.total} responden
          </p>
        </div>
      </div>
    );
  }

  if (status === "loading")
    return <div className="text-center p-8">Memuat data...</div>;

  return (
    <div className="rounded-xl border border-border bg-white p-8 shadow-sm dark:border-darkmode-border dark:bg-darkmode-body">
      <h3 className="h4 mb-2 text-center">Beri Penilaian Pelayanan</h3>
      <p className="mb-6 text-center text-sm text-text-light dark:text-darkmode-text-light">
        Bagaimana pengalaman Anda hari ini?
      </p>

      <form onSubmit={handleSubmit}>
        <div className="mb-6 flex justify-center gap-2">
          {[...Array(5)].map((_, index) => {
            const ratingValue = index + 1;
            return (
              <label key={index} className="cursor-pointer">
                <input
                  type="radio"
                  name="rating"
                  className="hidden"
                  value={ratingValue}
                  onClick={() => setRating(ratingValue)}
                />
                <FaStar
                  className="transition-transform duration-200 hover:scale-110"
                  size={35}
                  color={
                    ratingValue <= (hover || rating) ? "#ffc107" : "#e4e5e9"
                  }
                  onMouseEnter={() => setHover(ratingValue)}
                  onMouseLeave={() => setHover(0)}
                />
              </label>
            );
          })}
        </div>

        <div className="space-y-4">
          <div>
            <input
              type="text"
              className="form-input py-2 text-sm"
              placeholder="Nama Anda (Opsional)"
              value={name}
              onChange={(e) => setName(e.target.value)}
            />
          </div>
          <div>
            <textarea
              className="form-input py-2 text-sm"
              rows={3}
              placeholder="Kritik & Saran..."
              value={message}
              onChange={(e) => setMessage(e.target.value)}
            ></textarea>
          </div>
        </div>

        {status === "error" && (
          <p className="mt-4 text-center text-sm text-red-500">{responseMsg}</p>
        )}

        <button
          type="submit"
          disabled={status === "submitting"}
          className="btn btn-primary mt-6 w-full"
        >
          {status === "submitting" ? "Mengirim..." : "Kirim Penilaian"}
        </button>
      </form>
    </div>
  );
};

export default ServiceRating;
```

---

### File: `./src/layouts/helpers/SurveyWizard.tsx`

```tsx
import React, { useState, useEffect } from "react";
import {
  FaCheck,
  FaChevronLeft,
  FaChevronRight,
  FaUser,
  FaBuilding,
  FaConciergeBell,
  FaGraduationCap,
  FaPaperPlane,
  FaChartBar,
} from "react-icons/fa";

// Data Pertanyaan (Sama seperti sebelumnya)
const surveyData = [
  {
    id: "zi",
    title: "Zona Integritas",
    icon: <FaBuilding />,
    description: "Penilaian terkait transparansi dan anti-korupsi.",
    questions: [
      {
        id: "zi_1",
        text: "Tidak ada pungutan liar (pungli) atau gratifikasi dalam layanan.",
      },
      {
        id: "zi_2",
        text: "Prosedur pelayanan jelas, transparan, dan mudah dipahami.",
      },
      {
        id: "zi_3",
        text: "Petugas menolak segala bentuk pemberian imbalan di luar ketentuan.",
      },
    ],
  },
  {
    id: "service",
    title: "Pelayanan PTSP",
    icon: <FaConciergeBell />,
    description: "Kualitas layanan administrasi di ruang PTSP.",
    questions: [
      {
        id: "srv_1",
        text: "Petugas melayani dengan ramah, sopan, dan santun.",
      },
      { id: "srv_2", text: "Ruang tunggu pelayanan nyaman dan bersih." },
      {
        id: "srv_3",
        text: "Layanan selesai tepat waktu sesuai standar yang dijanjikan.",
      },
    ],
  },
  {
    id: "academic",
    title: "Akademik",
    icon: <FaGraduationCap />,
    description: "Kualitas pembelajaran dan kompetensi guru.",
    questions: [
      { id: "acd_1", text: "Guru menguasai materi pembelajaran dengan baik." },
      {
        id: "acd_2",
        text: "Komunikasi antara sekolah dan wali murid berjalan lancar.",
      },
      {
        id: "acd_3",
        text: "Fasilitas pembelajaran mendukung kebutuhan siswa.",
      },
    ],
  },
];

const SurveyWizard = () => {
  const [step, setStep] = useState(0);
  const [profile, setProfile] = useState({ name: "", role: "Wali Murid" });
  const [answers, setAnswers] = useState<Record<string, number>>({});
  const [feedback, setFeedback] = useState("");
  const [status, setStatus] = useState<
    "idle" | "loading" | "submitting" | "success" | "submitted" | "error"
  >("loading");
  const [stats, setStats] = useState({
    zi: 0,
    service: 0,
    academic: 0,
    total: 0,
  });

  const totalSteps = surveyData.length + 2;

  // 1. Fetch Status & Stats
  useEffect(() => {
    const fetchSurveyData = async () => {
      try {
        const res = await fetch("/api/survey.php");
        const data = await res.json();

        if (data.stats) setStats(data.stats);

        if (data.has_submitted) {
          setStatus("submitted");
        } else {
          setStatus("idle");
        }
      } catch (error) {
        setStatus("error");
      }
    };
    fetchSurveyData();
  }, []);

  const handleScore = (qId: string, val: number) => {
    setAnswers((prev) => ({ ...prev, [qId]: val }));
  };

  const calculateScores = () => {
    const scores: Record<string, number> = {};
    surveyData.forEach((section) => {
      let sum = 0;
      section.questions.forEach((q) => {
        sum += answers[q.id] || 0;
      });
      scores[section.id] = parseFloat(
        (sum / section.questions.length).toFixed(2),
      );
    });
    return scores;
  };

  const handleSubmit = async () => {
    setStatus("submitting");
    const finalData = {
      profile,
      answers,
      feedback,
      scores: calculateScores(),
    };

    try {
      const res = await fetch("/api/survey.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(finalData),
      });
      const result = await res.json();
      if (res.ok && result.status === "success") {
        if (result.stats) setStats(result.stats);
        setStatus("submitted"); // Switch ke tampilan hasil
      } else {
        setStatus("error");
      }
    } catch (e) {
      setStatus("error");
    }
  };

  // Tampilan Hasil Survei (Statistik)
  if (status === "submitted" || status === "success") {
    return (
      <div className="max-w-3xl mx-auto bg-white dark:bg-darkmode-light rounded-xl p-8 border border-border dark:border-darkmode-border shadow-lg animate-fade-in">
        <div className="text-center mb-10">
          <div className="inline-flex items-center justify-center w-20 h-20 rounded-full bg-blue-100 text-blue-600 mb-6">
            <FaChartBar className="text-4xl" />
          </div>
          <h2 className="h3 mb-2">Hasil Survei Kepuasan</h2>
          <p className="text-text-light dark:text-darkmode-text-light">
            Terima kasih telah berpartisipasi. Berikut adalah indeks kepuasan
            rata-rata dari <strong>{stats.total}</strong> responden.
          </p>
        </div>

        <div className="space-y-8">
          {/* Result Item: ZI */}
          <div>
            <div className="flex justify-between items-end mb-2">
              <h4 className="text-lg flex items-center gap-2">
                <FaBuilding className="text-primary" /> Zona Integritas
              </h4>
              <span className="font-bold text-2xl text-primary">
                {stats.zi}
                <span className="text-sm text-gray-400 font-normal">/5</span>
              </span>
            </div>
            <div className="h-4 w-full bg-gray-200 rounded-full overflow-hidden dark:bg-gray-700">
              <div
                className="h-full bg-blue-500 transition-all duration-1000"
                style={{ width: `${(stats.zi / 5) * 100}%` }}
              ></div>
            </div>
          </div>

          {/* Result Item: Service */}
          <div>
            <div className="flex justify-between items-end mb-2">
              <h4 className="text-lg flex items-center gap-2">
                <FaConciergeBell className="text-primary" /> Pelayanan PTSP
              </h4>
              <span className="font-bold text-2xl text-primary">
                {stats.service}
                <span className="text-sm text-gray-400 font-normal">/5</span>
              </span>
            </div>
            <div className="h-4 w-full bg-gray-200 rounded-full overflow-hidden dark:bg-gray-700">
              <div
                className="h-full bg-green-500 transition-all duration-1000"
                style={{ width: `${(stats.service / 5) * 100}%` }}
              ></div>
            </div>
          </div>

          {/* Result Item: Academic */}
          <div>
            <div className="flex justify-between items-end mb-2">
              <h4 className="text-lg flex items-center gap-2">
                <FaGraduationCap className="text-primary" /> Akademik
              </h4>
              <span className="font-bold text-2xl text-primary">
                {stats.academic}
                <span className="text-sm text-gray-400 font-normal">/5</span>
              </span>
            </div>
            <div className="h-4 w-full bg-gray-200 rounded-full overflow-hidden dark:bg-gray-700">
              <div
                className="h-full bg-purple-500 transition-all duration-1000"
                style={{ width: `${(stats.academic / 5) * 100}%` }}
              ></div>
            </div>
          </div>
        </div>

        <div className="text-center mt-12">
          <a href="/" className="btn btn-outline-primary">
            Kembali ke Beranda
          </a>
        </div>
      </div>
    );
  }

  if (status === "loading")
    return <div className="text-center p-12">Memuat survei...</div>;

  // Render Logic Form (Sama seperti sebelumnya)
  const isProfileStep = step === 0;
  const isFeedbackStep = step === totalSteps - 1;
  const isSurveyStep = step > 0 && step < totalSteps - 1;
  const currentSection = isSurveyStep ? surveyData[step - 1] : null;

  const canProceed = () => {
    if (isProfileStep) return profile.name.length > 2;
    if (isSurveyStep && currentSection) {
      return currentSection.questions.every((q) => answers[q.id]);
    }
    return true;
  };

  return (
    <div className="max-w-3xl mx-auto">
      {/* Progress Bar */}
      <div className="mb-8">
        <div className="flex justify-between mb-2 text-xs font-semibold uppercase text-text-light dark:text-darkmode-text-light tracking-wide">
          <span>Data Diri</span>
          {surveyData.map((s) => (
            <span key={s.id} className="hidden sm:inline">
              {s.title}
            </span>
          ))}
          <span>Selesai</span>
        </div>
        <div className="h-2 bg-gray-200 rounded-full overflow-hidden dark:bg-gray-700">
          <div
            className="h-full bg-primary transition-all duration-500 ease-out"
            style={{ width: `${((step + 1) / totalSteps) * 100}%` }}
          ></div>
        </div>
      </div>

      <div className="bg-white dark:bg-darkmode-light rounded-2xl shadow-xl border border-border dark:border-darkmode-border overflow-hidden">
        {/* Header Section */}
        <div className="bg-light dark:bg-darkmode-body px-8 py-6 border-b border-border dark:border-darkmode-border">
          <h2 className="h4 flex items-center gap-3">
            {isProfileStep && (
              <>
                <FaUser className="text-primary" /> Data Responden
              </>
            )}
            {isSurveyStep && currentSection && (
              <>
                <span className="text-primary">{currentSection.icon}</span>{" "}
                {currentSection.title}
              </>
            )}
            {isFeedbackStep && (
              <>
                <FaPaperPlane className="text-primary" /> Kritik & Saran
              </>
            )}
          </h2>
          {isSurveyStep && currentSection && (
            <p className="text-sm mt-1 text-text-light opacity-80">
              {currentSection.description}
            </p>
          )}
        </div>

        {/* Content Body */}
        <div className="p-8">
          {/* STEP 1: PROFILE */}
          {isProfileStep && (
            <div className="space-y-6 animate-fade-in">
              <div>
                <label className="form-label text-sm">Nama Lengkap</label>
                <input
                  type="text"
                  className="form-input"
                  placeholder="Masukkan nama Anda"
                  value={profile.name}
                  onChange={(e) =>
                    setProfile({ ...profile, name: e.target.value })
                  }
                />
              </div>
              <div>
                <label className="form-label text-sm">Peran Anda</label>
                <select
                  className="form-input cursor-pointer"
                  value={profile.role}
                  onChange={(e) =>
                    setProfile({ ...profile, role: e.target.value })
                  }
                >
                  <option>Wali Murid</option>
                  <option>Siswa</option>
                  <option>Alumni</option>
                  <option>Tamu / Masyarakat Umum</option>
                  <option>Guru / Staf</option>
                </select>
              </div>
            </div>
          )}

          {/* STEP 2..N: SURVEY QUESTIONS */}
          {isSurveyStep && currentSection && (
            <div className="space-y-8 animate-fade-in">
              {currentSection.questions.map((q, idx) => (
                <div
                  key={q.id}
                  className="p-4 rounded-lg bg-light/50 dark:bg-darkmode-body/50 border border-transparent hover:border-border transition-all"
                >
                  <p className="font-medium mb-4">
                    {idx + 1}. {q.text}
                  </p>
                  <div className="flex flex-wrap gap-2 sm:gap-4 justify-center sm:justify-start">
                    {[1, 2, 3, 4, 5].map((val) => (
                      <button
                        key={val}
                        onClick={() => handleScore(q.id, val)}
                        className={`
                          w-10 h-10 sm:w-12 sm:h-12 rounded-full font-bold text-sm sm:text-base transition-all
                          ${
                            answers[q.id] === val
                              ? "bg-primary text-white scale-110 shadow-lg shadow-primary/40"
                              : "bg-white dark:bg-darkmode-body border border-border dark:border-darkmode-border text-text-light hover:border-primary hover:text-primary"
                          }
                        `}
                      >
                        {val}
                      </button>
                    ))}
                  </div>
                  <div className="flex justify-between mt-2 text-xs text-text-light px-1">
                    <span>Sangat Buruk</span>
                    <span>Sangat Baik</span>
                  </div>
                </div>
              ))}
            </div>
          )}

          {/* STEP FINAL: FEEDBACK */}
          {isFeedbackStep && (
            <div className="animate-fade-in">
              <label className="form-label">
                Apakah ada saran untuk perbaikan?
              </label>
              <textarea
                rows={5}
                className="form-input"
                placeholder="Tuliskan pesan, kritik, atau saran Anda di sini..."
                value={feedback}
                onChange={(e) => setFeedback(e.target.value)}
              ></textarea>
            </div>
          )}

          {/* Error Message */}
          {status === "error" && (
            <div className="mt-4 p-3 bg-red-100 text-red-700 rounded text-sm text-center">
              Terjadi kesalahan (mungkin Anda sudah mengisi atau koneksi
              terputus).
            </div>
          )}
        </div>

        {/* Footer Navigation */}
        <div className="bg-light dark:bg-darkmode-body px-8 py-4 border-t border-border dark:border-darkmode-border flex justify-between items-center">
          <button
            onClick={() => setStep((prev) => prev - 1)}
            disabled={step === 0 || status === "submitting"}
            className="btn btn-outline-primary btn-sm flex items-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed"
          >
            <FaChevronLeft className="text-xs" /> Kembali
          </button>

          {isFeedbackStep ? (
            <button
              onClick={handleSubmit}
              disabled={status === "submitting"}
              className="btn btn-primary btn-sm flex items-center gap-2"
            >
              {status === "submitting" ? "Mengirim..." : "Kirim Survei"}{" "}
              <FaPaperPlane className="text-xs" />
            </button>
          ) : (
            <button
              onClick={() => setStep((prev) => prev + 1)}
              disabled={!canProceed()}
              className="btn btn-primary btn-sm flex items-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed"
            >
              Lanjut <FaChevronRight className="text-xs" />
            </button>
          )}
        </div>
      </div>
    </div>
  );
};

export default SurveyWizard;
```

---

### File: `./src/layouts/helpers/TawkChat.tsx`

```tsx
import React, { useEffect, useRef } from "react";
declare global {
  interface Window {
    Tawk_API: any;
    Tawk_LoadStart: Date;
  }
}

const TawkChat = () => {
  const intervalRef = useRef<NodeJS.Timeout | null>(null);
  const isWidgetVisible = useRef(false);

  useEffect(() => {
    if (window.location.pathname !== "/") return;
    if (document.getElementById("tawk-script")) return;
    window.Tawk_API = window.Tawk_API || {};
    window.Tawk_LoadStart = new Date();
    const s1 = document.createElement("script");
    s1.id = "tawk-script";
    s1.async = true;
    s1.src = "https://embed.tawk.to/6703648b37379df10df31533/1i9ik1guj";
    s1.charset = "UTF-8";
    s1.setAttribute("crossorigin", "*");
    s1.onload = () => {
      window.Tawk_API.onLoad = function () {
        window.Tawk_API.hideWidget();
        isWidgetVisible.current = false;
        setTimeout(() => {
          startAnimationLoop();
        }, 5000);
      };
    };

    document.head.appendChild(s1);
    return () => {
      if (intervalRef.current) clearInterval(intervalRef.current);
      if (window.Tawk_API && window.Tawk_API.hideWidget) {
        window.Tawk_API.hideWidget();
      }
    };
  }, []);

  const startAnimationLoop = () => {
    toggleWidget();
    intervalRef.current = setInterval(() => {
      toggleWidget();
    }, 10000);
  };

  const toggleWidget = () => {
    if (!window.Tawk_API) return;
    if (window.Tawk_API.isChatMaximized()) {
      return;
    }

    if (isWidgetVisible.current) {
      window.Tawk_API.hideWidget();
      isWidgetVisible.current = false;
    } else {
      window.Tawk_API.showWidget();
      isWidgetVisible.current = true;
    }
  };

  return null;
};

export default TawkChat;
```

---

### File: `./src/layouts/helpers/VideoModal.tsx`

```tsx
import React, { useState, useEffect, useCallback } from "react";
import { FaPlay, FaTimes } from "react-icons/fa";

interface VideoModalProps {
  videoId?: string;
  src?: string;
  label?: string;
}

const VideoModal = ({
  videoId,
  src,
  label = "Tonton Video",
}: VideoModalProps) => {
  const [isMounted, setIsMounted] = useState(false);
  const [isVisible, setIsVisible] = useState(false);

  const openModal = () => {
    setIsMounted(true);
    setTimeout(() => setIsVisible(true), 10);
  };

  const closeModal = useCallback(() => {
    setIsVisible(false);
    setTimeout(() => {
      setIsMounted(false);
    }, 300);
  }, []);

  useEffect(() => {
    const handleEsc = (e: KeyboardEvent) => {
      if (e.key === "Escape") closeModal();
    };

    if (isMounted) {
      document.addEventListener("keydown", handleEsc);
      document.body.style.overflow = "hidden";
    } else {
      document.body.style.overflow = "unset";
    }

    return () => {
      document.removeEventListener("keydown", handleEsc);
      document.body.style.overflow = "unset";
    };
  }, [isMounted, closeModal]);

  return (
    <>
      <button
        onClick={openModal}
        className="btn btn-outline-primary mb-4 ml-0 md:ml-4 gap-2"
        type="button"
      >
        <FaPlay className="text-xs" />
        {label}
      </button>

      {isMounted && (
        <div
          className={`fixed inset-0 z-[9999] bg-black transition-opacity duration-300 ease-in-out ${
            isVisible ? "opacity-100" : "opacity-0"
          }`}
        >
          <button
            onClick={closeModal}
            className={`absolute right-6 top-6 z-50 rounded-full bg-black/40 p-3 text-white backdrop-blur-md transition-all duration-500 hover:bg-white hover:text-black hover:rotate-90 ${
              isVisible
                ? "translate-y-0 opacity-100"
                : "-translate-y-10 opacity-0"
            }`}
            aria-label="Tutup Video"
          >
            <FaTimes size={24} />
          </button>

          <div className="absolute inset-0 flex h-full w-full items-center justify-center">
            {videoId ? (
              <iframe
                className="h-full w-full"
                src={`https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0&modestbranding=1`}
                title="YouTube video player"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowFullScreen
              ></iframe>
            ) : (
              <video
                src={src}
                className="h-full w-full object-contain"
                controls
                autoPlay
                playsInline
              >
                Browser Anda tidak mendukung tag video.
              </video>
            )}
          </div>
        </div>
      )}
    </>
  );
};

export default VideoModal;
```

---

### File: `./src/layouts/helpers/VisitorCounter.tsx`

```tsx
import React, { useEffect, useState } from "react";
import { FaEye } from "react-icons/fa";

const VisitorCounter = () => {
  const [visits, setVisits] = useState("...");

  useEffect(() => {
    const hasVisited = sessionStorage.getItem("session_visited");

    const fetchVisits = async () => {
      try {
        const url = "/api/stats.php?action=visit";
        const method = !hasVisited ? "POST" : "GET";

        const response = await fetch(url, { method });
        if (response.ok) {
          const data = await response.json();
          setVisits(data.value.toLocaleString("id-ID"));
          if (!hasVisited) sessionStorage.setItem("session_visited", "true");
        }
      } catch (error) {
        console.error(error);
      }
    };
    fetchVisits();
  }, []);

  return (
    <div className="mt-4 flex justify-center text-xs text-text-light dark:text-darkmode-text-light opacity-80">
      <div className="flex items-center gap-2" title="Total Kunjungan">
        <FaEye className="text-green-500" />
        <span className="font-bold">{visits}</span>
        <span>Total Kunjungan</span>
      </div>
    </div>
  );
};

export default VisitorCounter;
```

---

### File: `./src/layouts/partials/CallToAction.astro`

```astro
---
import ImageMod from "@/components/ImageMod.astro";
import { markdownify } from "@/lib/utils/textConverter";
const { call_to_action } = Astro.props;
---

{
  call_to_action.data.enable && (
    <section class="mb-28">
      <div class="container">
        <div class="rounded-xl bg-light px-4 py-16 dark:bg-darkmode-light xl:p-20">
          <div class="row items-center justify-between">
            <div class="mb-10 md:col-5 lg:col-4 md:order-2 md:mb-0">
              <ImageMod
                class="w-full"
                src={call_to_action.data.image}
                width={392}
                height={390}
                alt="cta-image"
                format="webp"
              />
            </div>
            <div class="md:col-7 md:order-1">
              <h2
                set:html={markdownify(call_to_action.data.title)}
                class="mb-2"
              />
              <p
                set:html={markdownify(call_to_action.data.description)}
                class="mb-6"
              />
              {call_to_action.data.button.enable && (
                <a
                  class="btn btn-primary"
                  href={call_to_action.data.button.link}
                >
                  {call_to_action.data.button.label}
                </a>
              )}
            </div>
          </div>
        </div>
      </div>
    </section>
  )
}
```

---

### File: `./src/layouts/partials/Footer.astro`

```astro
---
import Logo from "@/components/Logo.astro";
import Social from "@/components/Social.astro";
import config from "@/config/config.json";
import menu from "@/config/menu.json";
import social from "@/config/social.json";
import { markdownify } from "@/lib/utils/textConverter";
import VisitorCounter from "@/layouts/helpers/VisitorCounter";

const { footer }: { footer: { name: string; url: string }[] } = menu;
---

<footer class="bg-light dark:bg-darkmode-light">
  <div class="container">
    <div class="row items-center py-10">
      <div class="mb-8 text-center lg:col-3 lg:mb-0 lg:text-left">
        <Logo />
      </div>
      <div class="mb-8 text-center lg:col-6 lg:mb-0">
        <ul>
          {
            footer.map((menu) => (
              <li class="m-3 inline-block">
                <a href={menu.url}>{menu.name}</a>
              </li>
            ))
          }
        </ul>
      </div>
      <div class="mb-8 text-center lg:col-3 lg:mb-0 lg:mt-0 lg:text-right">
        <Social source={social.main} className="social-icons" />
      </div>
    </div>
  </div>
  <div class="border-t border-border py-7 dark:border-darkmode-border">
    <div
      class="container text-center text-text-light dark:text-darkmode-text-light"
    >
      <p set:html={markdownify(config.params.copyright)} />

      <VisitorCounter client:only="react" />
    </div>
  </div>
</footer>
```

---

### File: `./src/layouts/partials/Header.astro`

```astro
---
import Logo from "@/components/Logo.astro";
import ThemeSwitcher from "@/components/ThemeSwitcher.astro";
import config from "@/config/config.json";
import menu from "@/config/menu.json";
import { FaChevronDown, FaBars, FaTimes, FaSearch } from "react-icons/fa";

export interface ChildNavigationLink {
  name: string;
  url: string;
}

export interface NavigationLink {
  name: string;
  url: string;
  hasChildren?: boolean;
  children?: ChildNavigationLink[];
}

const { main }: { main: NavigationLink[] } = menu;
const { navigation_button } = config;
const { pathname } = Astro.url;
---

<header
  class="fixed top-4 inset-x-0 z-50 px-4 print:hidden transition-all duration-300"
>
  <nav class="mx-auto max-w-7xl">
    <div
      class="relative flex items-center justify-between rounded-full bg-white/80 px-5 py-2.5 shadow-lg shadow-gray-200/20 backdrop-blur-md border border-gray-200/50 transition-colors dark:bg-[#13151a]/80 dark:border-white/10 dark:shadow-black/20"
    >
      <div class="flex shrink-0 items-center">
        <Logo />
      </div>

      <ul class="hidden lg:flex items-center gap-1 xl:gap-2">
        {
          main.map((menu) => (
            <li class="relative group">
              {menu.hasChildren ? (
                <>
                  <button
                    class={`flex items-center gap-1 rounded-full px-3 py-1.5 text-sm font-medium transition-all hover:bg-gray-100 hover:text-primary dark:hover:bg-white/5 dark:hover:text-primary ${
                      menu.children?.map(({ url }) => url).includes(pathname) ||
                      menu.children
                        ?.map(({ url }) => `${url}/`)
                        .includes(pathname)
                        ? "text-primary bg-primary/10 dark:bg-primary/20"
                        : "text-gray-600 dark:text-gray-300"
                    }`}
                  >
                    {menu.name}
                    <FaChevronDown className="text-[10px] opacity-50 group-hover:rotate-180 transition-transform duration-300" />
                  </button>

                  <div class="absolute left-1/2 top-full mt-2 w-48 -translate-x-1/2 pt-2 opacity-0 invisible transform translate-y-2 transition-all duration-300 group-hover:visible group-hover:opacity-100 group-hover:translate-y-0">
                    <ul class="rounded-xl border border-gray-100 bg-white/90 p-1.5 shadow-xl backdrop-blur-md dark:border-white/10 dark:bg-[#1a1d24]/95">
                      {menu.children?.map((child) => (
                        <li>
                          <a
                            href={child.url}
                            class={`block rounded-lg px-3 py-2 text-sm transition-colors hover:bg-gray-50 hover:text-primary dark:hover:bg-white/5 dark:hover:text-primary ${
                              pathname === `${child.url}/` ||
                              pathname === child.url
                                ? "text-primary bg-primary/5 dark:bg-primary/10"
                                : "text-gray-600 dark:text-gray-300"
                            }`}
                          >
                            {child.name}
                          </a>
                        </li>
                      ))}
                    </ul>
                  </div>
                </>
              ) : (
                <a
                  href={menu.url}
                  class={`block rounded-full px-3 py-1.5 text-sm font-medium transition-all hover:bg-gray-100 hover:text-primary dark:hover:bg-white/5 dark:hover:text-primary ${
                    pathname === `${menu.url}/` || pathname === menu.url
                      ? "text-primary bg-primary/10 dark:bg-primary/20"
                      : "text-gray-600 dark:text-gray-300"
                  }`}
                >
                  {menu.name}
                </a>
              )}
            </li>
          ))
        }
      </ul>

      <div class="flex items-center gap-2 sm:gap-3">
        <button
          aria-label="Search"
          data-search-trigger
          class="flex h-9 w-9 cursor-pointer items-center justify-center rounded-full text-gray-600 transition-colors hover:bg-gray-100 hover:text-primary dark:text-gray-300 dark:hover:bg-white/5 dark:hover:text-white"
        >
          <FaSearch className="h-4 w-4" />
        </button>

        <ThemeSwitcher className="mr-1" />

        <div class="hidden h-5 w-px bg-gray-200 dark:bg-white/10 lg:block">
        </div>

        {
          navigation_button.enable && (
            <a
              href={navigation_button.link}
              class="hidden rounded-full bg-primary px-5 py-2 text-sm font-semibold text-white shadow-lg shadow-primary/30 transition-all hover:bg-primary/90 hover:shadow-primary/50 hover:-translate-y-0.5 lg:block dark:text-black"
            >
              {navigation_button.label}
            </a>
          )
        }
        <button
          id="mobile-menu-toggle"
          aria-label="Toggle Menu"
          class="flex h-9 w-9 cursor-pointer items-center justify-center rounded-full bg-gray-100 text-gray-600 transition-colors hover:bg-gray-200 hover:text-black lg:hidden dark:bg-white/5 dark:text-gray-300 dark:hover:bg-white/10 dark:hover:text-white"
        >
          <FaBars className="icon-bars" />
          <FaTimes className="icon-times hidden" />
        </button>
      </div>
    </div>
    <div
      id="mobile-menu"
      class="hidden mt-3 origin-top rounded-3xl border border-gray-200 bg-white/90 p-4 shadow-xl backdrop-blur-xl lg:hidden dark:border-white/10 dark:bg-[#13151a]/95"
    >
      <ul class="flex flex-col gap-1">
        {
          main.map((menu) => (
            <li>
              {menu.hasChildren ? (
                <details class="group">
                  <summary class="flex cursor-pointer items-center justify-between rounded-xl px-4 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:text-gray-200 dark:hover:bg-white/5">
                    {menu.name}
                    <FaChevronDown class="text-xs transition-transform group-open:rotate-180" />
                  </summary>
                  <ul class="mt-1 flex flex-col gap-1 rounded-xl bg-gray-50 p-2 dark:bg-black/20">
                    {menu.children?.map((child) => (
                      <li>
                        <a
                          href={child.url}
                          class={`block rounded-lg px-4 py-2 text-sm transition-colors hover:text-primary dark:hover:text-primary ${
                            pathname === `${child.url}/` ||
                            pathname === child.url
                              ? "text-primary font-semibold"
                              : "text-gray-500 dark:text-gray-400"
                          }`}
                        >
                          {child.name}
                        </a>
                      </li>
                    ))}
                  </ul>
                </details>
              ) : (
                <a
                  href={menu.url}
                  class={`block rounded-xl px-4 py-3 text-sm font-medium hover:bg-gray-50 dark:hover:bg-white/5 ${
                    pathname === `${menu.url}/` || pathname === menu.url
                      ? "text-primary bg-primary/5 dark:bg-primary/10"
                      : "text-gray-700 dark:text-gray-200"
                  }`}
                >
                  {menu.name}
                </a>
              )}
            </li>
          ))
        }

        {
          navigation_button.enable && (
            <li class="mt-2 pt-2 border-t border-gray-100 dark:border-white/5">
              <a
                href={navigation_button.link}
                class="flex w-full items-center justify-center rounded-xl bg-primary py-3 text-sm font-bold text-white shadow-lg shadow-primary/20 dark:text-black"
              >
                {navigation_button.label}
              </a>
            </li>
          )
        }
      </ul>
    </div>
  </nav>
</header>

<script>
  function initMobileMenu() {
    const toggleBtn = document.getElementById("mobile-menu-toggle");
    const mobileMenu = document.getElementById("mobile-menu");
    const iconBars = document.querySelector(".icon-bars");
    const iconTimes = document.querySelector(".icon-times");

    if (toggleBtn && mobileMenu) {
      const newBtn = toggleBtn.cloneNode(true);
      toggleBtn.parentNode?.replaceChild(newBtn, toggleBtn);

      newBtn.addEventListener("click", () => {
        const isHidden = mobileMenu.classList.contains("hidden");

        if (isHidden) {
          mobileMenu.classList.remove("hidden");
          mobileMenu.classList.add("animate-menu-slide-down");
          iconBars?.classList.add("hidden");
          iconTimes?.classList.remove("hidden");
        } else {
          mobileMenu.classList.add("hidden");
          mobileMenu.classList.remove("animate-menu-slide-down");
          iconBars?.classList.remove("hidden");
          iconTimes?.classList.add("hidden");
        }
      });
    }
  }

  document.addEventListener("astro:page-load", initMobileMenu);
</script>

<style>
  .animate-menu-slide-down {
    animation: menuSlide 0.3s cubic-bezier(0.16, 1, 0.3, 1) forwards;
  }

  @keyframes menuSlide {
    from {
      opacity: 0;
      transform: translateY(-10px) scale(0.98);
    }
    to {
      opacity: 1;
      transform: translateY(0) scale(1);
    }
  }
</style>
```

---

### File: `./src/layouts/partials/LatestPostsSlider.astro`

```astro
---
import ImageMod from "@/components/ImageMod.astro";
import { getSinglePage } from "@/lib/contentParser.astro";
import { sortByDate } from "@/lib/utils/sortFunctions";
import dateFormat from "@/lib/utils/dateFormat";
import readingTime from "@/lib/utils/readingTime";
import CardViewCounter from "@/layouts/helpers/CardViewCounter";
import { humanize } from "@/lib/utils/textConverter";
import {
  FaRegClock,
  FaRegCalendarAlt,
  FaArrowRight,
  FaRegEye,
} from "react-icons/fa";

const posts = await getSinglePage("blog");
const sortedPosts = sortByDate(posts);
const latestPosts = sortedPosts.slice(0, 6);
---

<section class="section bg-light dark:bg-darkmode-light overflow-hidden">
  <div class="container">
    <div class="mb-12 text-center">
      <h2 class="h2 gsap-fade-up">Berita & Artikel Terbaru</h2>
      <p
        class="mt-4 text-text-light dark:text-darkmode-text-light gsap-fade-up"
      >
        Ikuti perkembangan informasi terkini dan kegiatan seru di MTs Negeri 1
        Pandeglang.
      </p>
    </div>

    <div class="gsap-fade-up relative">
      <div class="swiper latest-posts-slider !pb-12">
        <div class="swiper-wrapper">
          {
            latestPosts.map((post) => (
              <div class="swiper-slide h-auto">
                <div class="group h-full flex flex-col overflow-hidden rounded-2xl border border-border bg-body transition-all duration-300 hover:-translate-y-1 hover:shadow-lg dark:border-darkmode-border dark:bg-darkmode-body">
                  <div class="relative h-56 overflow-hidden">
                    {post.data.image ? (
                      <ImageMod
                        src={post.data.image}
                        height={300}
                        width={600}
                        alt={post.data.title}
                        class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110"
                        format="webp"
                      />
                    ) : (
                      <div class="flex h-full w-full items-center justify-center bg-gray-200 text-gray-400">
                        No Image
                      </div>
                    )}

                    <div class="absolute left-4 top-4">
                      <span class="rounded-md bg-white/90 px-3 py-1 text-xs font-bold uppercase tracking-wider text-primary shadow-sm backdrop-blur-sm dark:bg-black/80 dark:text-white">
                        {humanize(post.data.categories[0])}
                      </span>
                    </div>
                  </div>

                  <div class="flex flex-1 flex-col p-6">
                    <div class="mb-3 flex items-center gap-4 text-xs text-text-light dark:text-darkmode-text-light">
                      <div class="flex items-center gap-1">
                        <FaRegCalendarAlt />
                        {dateFormat(post.data.date)}
                      </div>
                      <div class="flex items-center gap-1">
                        <FaRegClock />
                        {readingTime(post.body)}
                      </div>
                      <div class="flex items-center gap-1">
                        <CardViewCounter client:visible slug={post.id} />
                      </div>
                    </div>

                    <h3 class="h5 mb-3 flex-1 font-bold leading-snug">
                      <a
                        href={`/blog/${post.id}`}
                        class="transition-colors hover:text-primary hover:underline decoration-2 underline-offset-4"
                      >
                        {post.data.title}
                      </a>
                    </h3>

                    <div class="mt-4 pt-4 border-t border-border dark:border-darkmode-border">
                      <a
                        href={`/blog/${post.id}`}
                        class="group/link flex items-center text-sm font-semibold text-primary transition-colors hover:text-dark dark:hover:text-white"
                      >
                        Baca Selengkapnya
                        <FaArrowRight className="ml-2 transition-transform duration-300 group-hover/link:translate-x-1" />
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            ))
          }
        </div>

        <div class="latest-posts-pagination mt-8 flex justify-center gap-2">
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  import { Swiper } from "swiper";
  import "swiper/css";
  import "swiper/css/pagination";
  import { Autoplay, Pagination } from "swiper/modules";

  const initLatestPostsSlider = () => {
    new Swiper(".latest-posts-slider", {
      modules: [Pagination, Autoplay],
      spaceBetween: 24,
      loop: true,
      autoplay: {
        delay: 4000,
        disableOnInteraction: false,
        pauseOnMouseEnter: true,
      },
      pagination: {
        el: ".latest-posts-pagination",
        type: "bullets",
        clickable: true,
      },
      breakpoints: {
        0: { slidesPerView: 1 },
        768: { slidesPerView: 2 },
        1024: { slidesPerView: 3 },
      },
    });
  };

  document.addEventListener("astro:page-load", initLatestPostsSlider);
</script>
```

---

### File: `./src/layouts/partials/PageHeader.astro`

```astro
---
import Breadcrumbs from "@/components/Breadcrumbs.astro";
import { humanize } from "@/lib/utils/textConverter";

const { title = "" }: { title?: string } = Astro.props;
---

<section>
  <div class="container text-center">
    <div
      class="rounded-2xl bg-gradient-to-b from-body to-light px-8 pb-14 pt-8 dark:from-darkmode-body dark:to-darkmode-light"
    >
      <h1 set:text={humanize(title)} />
      <Breadcrumbs className="mt-6" />
    </div>
  </div>
</section>
```

---

### File: `./src/layouts/partials/PostSidebar.astro`

```astro
---
import { humanize } from "@/lib/utils/textConverter";

const { tags, categories, allCategories } = Astro.props;
---

<div class="lg:col-4">
  <div class="mb-8">
    <div class="rounded bg-light p-8 dark:bg-darkmode-light">
      <ul class="space-y-4">
        <h5 class="text-center">Sambutan Kepala MTs Negeri 1 Pandeglang</h5>
        <img
          src="/images/assets/kepala-madrasah.png"
          width="100%"
          class="rounded-lg"
        />
        <li class="text-justify">
          Puji syukur Alhamdulillah senantiasa kita panjatkan kepada Ilahi Robbi
          atas segala nikmat dan karunia-Nya. Dalam kehidupan, kebutuhan akan
          informasi adalah suatu hal yang sangat esensial. MTs Negeri 1
          Pandeglang sebagai lembaga pendidikan memiliki tugas dan tanggung
          jawab untuk mendidik generasi muda yang berkualitas dan tanggap
          terhadap perkembangan ilmu pengetahuan dan teknologi di era
          globalisasi ini. Internet menjadi jendela utama untuk melihat dunia.
          MTs Negeri 1 Pandeglang telah memiliki fasilitas ini, oleh karena itu
          kami akan menampilkan segala hal yang ada dan terjadi di lembaga kami,
          sehingga dunia dapat melihat kondisi, kegiatan, prestasi, dan kemajuan
          yang ada di sini. Kami sangat mengharapkan kritik dan saran dari
          berbagai pihak demi kebaikan dan kemajuan MTs Negeri 1 Pandeglang.
          Untuk seluruh civitas akademika, mari kita bersama-sama ukir prestasi
          demi kejayaan madrasah kita. Amin.
        </li>
        <li class="text-center">
          <b>Kepala MTs Negeri 1 Pandeglang</b>
          <br />
          <b>H. Eman Sulaiman, S.Ag., M.Pd.</b>
          <br />
          NIP 197006032000031002
        </li>
      </ul>
    </div>
  </div>
  <div class="mb-8">
    <h5 class="mb-6">Kategori</h5>
    <div class="rounded bg-light p-8 dark:bg-darkmode-light">
      <ul class="space-y-4">
        {
          categories.map((category: any) => {
            const count = allCategories.filter(
              (c: any) => c === category,
            ).length;
            return (
              <li>
                <a
                  class="flex justify-between hover:text-primary dark:hover:text-darkmode-primary"
                  href={`/categories/${category}`}
                >
                  {humanize(category)} <span>({count})</span>
                </a>
              </li>
            );
          })
        }
      </ul>
    </div>
  </div>
  <div class="mb-8">
    <h5 class="mb-6">Tagar</h5>
    <div class="rounded bg-light p-6 dark:bg-darkmode-light">
      <ul>
        {
          tags.map((tag: any) => {
            return (
              <li class="inline-block">
                <a
                  class="m-1 block rounded bg-white px-3 py-1 hover:bg-primary hover:text-white dark:bg-darkmode-body dark:hover:bg-darkmode-primary dark:hover:text-text-dark"
                  href={`/tags/${tag}`}
                >
                  {humanize(tag)}
                </a>
              </li>
            );
          })
        }
      </ul>
    </div>
  </div>
</div>
```

---

### File: `./src/layouts/partials/Testimonial.astro`

```astro
---
import { markdownify } from "@/lib/utils/textConverter";
import ImageMod from "@/components/ImageMod.astro";
const { testimonial } = Astro.props;
---

{
  testimonial.data.enable && (
    <section class="section">
      <div class="container">
        <div class="row">
          <div class="mx-auto mb-12 text-center md:col-10 lg:col-8 xl:col-6">
            <h2 set:html={markdownify(testimonial.data.title)} class="mb-4" />
            <p set:html={markdownify(testimonial.data.description)} />
          </div>
          <div class="col-12">
            <div class="swiper testimonial-slider">
              <div class="swiper-wrapper">
                {testimonial.data.testimonials.map(
                  (item: {
                    avatar: string;
                    content: string;
                    name: string;
                    designation: string;
                  }) => (
                    <div class="swiper-slide">
                      <div class="rounded-lg bg-light px-7 py-10 dark:bg-darkmode-light">
                        <div class="text-text-dark dark:text-white">
                          <svg
                            width="33"
                            height="20"
                            viewBox="0 0 33 20"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <path
                              d="M1.28375 19.41L0.79375 18.64C1.21375 17.0067 1.75042 15.07 2.40375 12.83C3.05708 10.5433 3.75708 8.28 4.50375 6.04C5.29708 3.75333 6.06708 1.77 6.81375 0.0899959H15.3538C14.9338 2.09666 14.4904 4.26667 14.0238 6.6C13.5571 8.88666 13.1371 11.15 12.7638 13.39C12.4371 15.5833 12.1571 17.59 11.9238 19.41H1.28375ZM31.69 0.0899959L32.18 0.859998C31.76 2.54 31.2233 4.5 30.57 6.74C29.9167 8.98 29.2167 11.2433 28.47 13.53C27.7233 15.77 26.9533 17.73 26.16 19.41H17.69C18.0167 17.9167 18.3433 16.33 18.67 14.65C18.9967 12.9233 19.3 11.22 19.58 9.54C19.9067 7.81333 20.1867 6.15667 20.42 4.57C20.7 2.93666 20.91 1.44333 21.05 0.0899959H31.69Z"
                              fill="currentColor"
                            />
                          </svg>
                        </div>
                        <blockquote
                          class="mt-8"
                          set:html={markdownify(item.content)}
                        />
                        <div class="mt-11 flex items-center">
                          <div class="text-text-dark dark:text-white">
                            <ImageMod
                              height={50}
                              width={50}
                              class="rounded-full"
                              src={item.avatar}
                              alt={item.name}
                              format="webp"
                            />
                          </div>
                          <div class="ml-4">
                            <h3
                              set:text={item.name}
                              class="h5 font-primary font-semibold"
                            />
                            <p
                              set:text={item.designation}
                              class="text-text-dark dark:text-white"
                            />
                          </div>
                        </div>
                      </div>
                    </div>
                  ),
                )}
              </div>
              <div class="testimonial-slider-pagination mt-9 flex items-center justify-center text-center" />
            </div>
          </div>
        </div>
      </div>
    </section>
  )
}

<script>
  import { Swiper } from "swiper";
  import "swiper/css";
  import "swiper/css/pagination";
  import { Autoplay, Pagination } from "swiper/modules";

  document.addEventListener("astro:page-load", () => {
    new Swiper(".testimonial-slider", {
      modules: [Pagination, Autoplay],
      spaceBetween: 24,
      loop: true,
      autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },
      pagination: {
        el: ".testimonial-slider-pagination",
        type: "bullets",
        clickable: true,
      },
      breakpoints: {
        768: {
          slidesPerView: 2,
        },
        992: {
          slidesPerView: 3,
        },
      },
    });
  });
</script>
```

---

### File: `./src/layouts/shortcodes/Accordion.tsx`

```tsx
import React, { useState } from "react";

const Accordion = ({
  title,
  children,
  className,
}: {
  title: string;
  children: React.ReactNode;
  className?: string;
}) => {
  const [show, setShow] = useState(false);

  return (
    <div className={`accordion ${show && "active"} ${className}`}>
      <button className="accordion-header" onClick={() => setShow(!show)}>
        {title}
        <svg
          className="accordion-icon"
          x="0px"
          y="0px"
          viewBox="0 0 512 512"
          xmlSpace="preserve"
        >
          <path
            fill="currentColor"
            d="M505.755,123.592c-8.341-8.341-21.824-8.341-30.165,0L256.005,343.176L36.421,123.592c-8.341-8.341-21.824-8.341-30.165,0 s-8.341,21.824,0,30.165l234.667,234.667c4.16,4.16,9.621,6.251,15.083,6.251c5.462,0,10.923-2.091,15.083-6.251l234.667-234.667 C514.096,145.416,514.096,131.933,505.755,123.592z"
          ></path>
        </svg>
      </button>
      <div className="accordion-content">{children}</div>
    </div>
  );
};

export default Accordion;
```

---

### File: `./src/layouts/shortcodes/Button.tsx`

```tsx
import React from "react";

const Button = ({
  label,
  link,
  style,
  rel,
}: {
  label: string;
  link: string;
  style?: string;
  rel?: string;
}) => {
  return (
    <a
      href={link}
      target={link.startsWith("http") ? "_blank" : "_self"}
      rel={`noopener noreferrer ${
        rel ? (rel === "follow" ? "" : rel) : "nofollow"
      }`}
      className={`btn mb-4 me-4 hover:text-white dark:hover:text-black hover:no-underline ${
        style === "outline" ? "btn-outline-primary" : "btn-primary"
      }`}
    >
      {label}
    </a>
  );
};

export default Button;
```

---

### File: `./src/layouts/shortcodes/Notice.tsx`

```tsx
import { humanize } from "@/lib/utils/textConverter";
import React from "react";

function Notice({
  type,
  children,
}: {
  type: string;
  children: React.ReactNode;
}) {
  return (
    <div className={`notice ${type}`}>
      <div className="notice-head">
        {type === "tip" ? (
          <svg
            width="20"
            height="20"
            viewBox="0 0 24 24"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              fillRule="evenodd"
              clipRule="evenodd"
              d="M12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12C0 5.37258 5.37258 0 12 0ZM12 2.4C6.69807 2.4 2.4 6.69807 2.4 12C2.4 17.3019 6.69807 21.6 12 21.6C17.3019 21.6 21.6 17.3019 21.6 12C21.6 6.69807 17.3019 2.4 12 2.4ZM15.9515 7.55147L9.6 13.9029L8.04853 12.3515C7.5799 11.8828 6.8201 11.8828 6.35147 12.3515C5.88284 12.8201 5.88284 13.5799 6.35147 14.0485L8.75147 16.4485C9.2201 16.9172 9.9799 16.9172 10.4485 16.4485L17.6485 9.24853C18.1172 8.7799 18.1172 8.0201 17.6485 7.55147C17.1799 7.08284 16.4201 7.08284 15.9515 7.55147Z"
              fill="currentColor"
            />
          </svg>
        ) : type === "info" ? (
          <svg
            width="20"
            height="20"
            viewBox="0 0 18 20"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M9.16109 0.993016C9.97971 1.03952 10.6611 1.42989 11.0721 2.22339L17.7981 15.8014C18.4502 17.1739 17.4403 19.0208 15.7832 19.0474H2.23859C0.730337 19.0234 -0.507163 17.3108 0.231587 15.7864L7.08321 2.20877C7.21146 1.96502 7.26996 1.89452 7.38059 1.76664C7.82534 1.25102 8.31171 0.975016 9.16109 0.993016ZM9.05046 2.49189C8.79284 2.50464 8.55696 2.64902 8.42834 2.87327C6.06134 7.36539 3.77946 11.9036 1.56546 16.4734C1.36071 16.9328 1.71209 17.5223 2.22621 17.547C6.74871 17.6201 11.2731 17.6201 15.7956 17.547C16.2925 17.523 16.666 16.953 16.459 16.4783C14.2866 11.9093 12.0471 7.37102 9.72171 2.87814C9.58446 2.63402 9.38309 2.48739 9.05046 2.49189Z"
              fill="currentColor"
            />
            <path
              d="M9.61323 13.2153H8.35773L8.21973 7.04688H9.75723L9.61323 13.2153ZM8.17773 15.1015C8.17773 14.8731 8.25161 14.6841 8.39973 14.5338C8.54823 14.3838 8.75036 14.3084 9.00648 14.3084C9.26298 14.3084 9.46511 14.3838 9.61323 14.5338C9.76136 14.6841 9.83561 14.8731 9.83561 15.1015C9.83561 15.3216 9.76323 15.5057 9.61923 15.6539C9.47486 15.802 9.27086 15.8762 9.00648 15.8762C8.74211 15.8762 8.53811 15.802 8.39373 15.6539C8.24973 15.5057 8.17773 15.3216 8.17773 15.1015Z"
              fill="currentColor"
            />
          </svg>
        ) : type === "warning" ? (
          <svg
            width="20"
            height="20"
            viewBox="0 0 20 20"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              fillRule="evenodd"
              clipRule="evenodd"
              d="M10 0C15.522 0 20 4.478 20 10C20 15.522 15.522 20 10 20C4.478 20 0 15.522 0 10C0 4.478 4.478 0 10 0ZM10 2C5.589 2 2 5.589 2 10C2 14.411 5.589 18 10 18C14.411 18 18 14.411 18 10C18 5.589 14.411 2 10 2ZM12.293 6.293L13.707 7.707L11.414 10L13.707 12.293L12.293 13.707L10 11.414L7.707 13.707L6.293 12.293L8.586 10L6.293 7.707L7.707 6.293L10 8.586L12.293 6.293Z"
              fill="currentColor"
            />
          </svg>
        ) : (
          <svg
            width="20"
            height="20"
            viewBox="0 0 20 20"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M10 9V14M10 19C5.02944 19 1 14.9706 1 10C1 5.02944 5.02944 1 10 1C14.9706 1 19 5.02944 19 10C19 14.9706 14.9706 19 10 19ZM10.0498 6V6.1L9.9502 6.1002V6H10.0498Z"
              stroke="currentColor"
              strokeWidth="2"
              strokeLinecap="round"
              strokeLinejoin="round"
            />
          </svg>
        )}
        <p className="my-0 ml-1.5">{humanize(type)}</p>
      </div>
      <div className="notice-body">{children}</div>
    </div>
  );
}

export default Notice;
```

---

### File: `./src/layouts/shortcodes/Tab.tsx`

```tsx
import React from "react";

function Tab({ name, children }: { name: string; children: React.ReactNode }) {
  return <div data-name={name}>{children}</div>;
}

export default Tab;
```

---

### File: `./src/layouts/shortcodes/Tabs.tsx`

```tsx
import { marked } from "marked";
import React, { useEffect, useRef, useState } from "react";

const Tabs = ({ children }: { children: React.ReactElement }) => {
  const [active, setActive] = useState<number>(0);
  const [defaultFocus, setDefaultFocus] = useState<boolean>(false);

  const tabRefs: React.RefObject<HTMLElement[]> = useRef([]);
  useEffect(() => {
    if (defaultFocus) {
      //@ts-ignore
      tabRefs.current[active]?.focus();
    } else {
      setDefaultFocus(true);
    }
  }, [active]);

  const tabLinks = Array.from(
    (children.props as any).value.matchAll(
      /<div\s+data-name="([^"]+)"[^>]*>((?:.|\n)*?)<\/div>/g,
    ),
    (match: RegExpMatchArray) => ({ name: match[1], children: match[0] }),
  );

  const handleKeyDown = (
    event: React.KeyboardEvent<EventTarget>,
    index: number,
  ) => {
    if (event.key === "Enter" || event.key === " ") {
      setActive(index);
    } else if (event.key === "ArrowRight") {
      setActive((active + 1) % tabLinks.length);
    } else if (event.key === "ArrowLeft") {
      setActive((active - 1 + tabLinks.length) % tabLinks.length);
    }
  };

  return (
    <div className="tab">
      <ul className="tab-nav">
        {tabLinks.map(
          (item: { name: string; children: string }, index: number) => (
            <li
              key={index}
              className={`tab-nav-item ${index === active && "active"}`}
              role="tab"
              tabIndex={index === active ? 0 : -1}
              onKeyDown={(event) => handleKeyDown(event, index)}
              onClick={() => setActive(index)}
              //@ts-ignore
              ref={(ref) => (tabRefs.current[index] = ref)}
            >
              {item.name}
            </li>
          ),
        )}
      </ul>
      {tabLinks.map((item: { name: string; children: string }, i: number) => (
        <div
          className={active === i ? "tab-content block px-5" : "hidden"}
          key={i}
          dangerouslySetInnerHTML={{
            __html: marked.parse(item.children),
          }}
        />
      ))}
    </div>
  );
};

export default Tabs;
```

---

### File: `./src/layouts/shortcodes/Video.tsx`

```tsx
import React from "react";
function Video({
  title,
  width = 500,
  height = "auto",
  src,
  ...rest
}: {
  title: string;
  width: number;
  height: number | "auto";
  src: string;
  [key: string]: any;
}) {
  return (
    <video
      className="overflow-hidden rounded-lg"
      width={width}
      height={height}
      controls
      {...rest}
    >
      <source
        src={src.match(/^http/) ? src : `/videos/${src}`}
        type="video/mp4"
      />
      {title}
    </video>
  );
}

export default Video;
```

---

### File: `./src/layouts/shortcodes/Youtube.tsx`

```tsx
import React, { useEffect } from "react";

const Youtube = ({
  id,
  title,
  ...rest
}: {
  id: string;
  title: string;
  [key: string]: any;
}) => {
  useEffect(() => {
    import("@justinribeiro/lite-youtube");
  }, []);

  // @ts-ignore
  return (
    <lite-youtube
      className="rounded-lg"
      videoid={id}
      videotitle={title}
      {...rest}
    />
  );
};

export default Youtube;
```

---

### File: `./src/lib/contentParser.astro`

```astro
---
import {
  getCollection,
  getEntry,
  type CollectionEntry,
  type CollectionKey,
} from "astro:content";

type PageData = {
  title: string;
  meta_title?: string;
  description?: string;
  image?: string;
  draft?: boolean;
};

export const getSinglePage = async <C extends CollectionKey>(
  collectionName: C,
): Promise<CollectionEntry<C>[]> => {
  const allPages = await getCollection(
    collectionName,
    ({ data, id }) => !(data as PageData)?.draft && !id.startsWith("-"),
  );
  return allPages;
};

export const getListPage = async <C extends CollectionKey>(
  collectionName: C,
  documentId: "-index" | string,
): Promise<CollectionEntry<C>> => {
  const data = (await getEntry(
    collectionName,
    documentId,
  )) as CollectionEntry<C> | null;

  if (!data) {
    throw new Error(
      `No page found for the collection: ${collectionName} with filename: ${documentId}`,
    );
  }

  return data;
};
---
```

---

### File: `./src/lib/taxonomyParser.astro`

```astro
---
import { getSinglePage } from "@/lib/contentParser.astro";
import { slugify } from "@/lib/utils/textConverter";

export const getTaxonomy = async (collection: any, name: string) => {
  const singlePages = await getSinglePage(collection);
  const taxonomyPages = singlePages.map((page: any) => page.data[name]);
  let taxonomies: string[] = [];
  for (let i = 0; i < taxonomyPages.length; i++) {
    const categoryArray = taxonomyPages[i];
    for (let j = 0; j < categoryArray.length; j++) {
      taxonomies.push(slugify(categoryArray[j]));
    }
  }
  const taxonomy = [...new Set(taxonomies)];
  return taxonomy;
};

export const getAllTaxonomy = async (collection: any, name: string) => {
  const singlePages = await getSinglePage(collection);
  const taxonomyPages = singlePages.map((page: any) => page.data[name]);
  let taxonomies: string[] = [];
  for (let i = 0; i < taxonomyPages.length; i++) {
    const categoryArray = taxonomyPages[i];
    for (let j = 0; j < categoryArray.length; j++) {
      taxonomies.push(slugify(categoryArray[j]));
    }
  }
  return taxonomies;
};
---
```

---

### File: `./src/lib/utils/bgImageMod.ts`

```typescript
import { getImage } from "astro:assets";

const bgImageMod = async (
  src: string,
  format?: "auto" | "avif" | "jpeg" | "png" | "svg" | "webp",
) => {
  src = `/public${src}`;
  const images = import.meta.glob("/public/images/**/*.{jpeg,jpg,png,gif}");

  if (!src || !images[src]) {
    console.error(
      `\x1b[31mImage not found - ${src}.\x1b[0m Make sure the image is in the /public/images folder.`,
    );

    return "";
  }

  const getImagePath = async (image: string) => {
    try {
      const imageData = (await images[image]()) as any;
      return imageData;
    } catch (error) {
      return `Image not found - ${src}. Make sure the image is in the /public/images folder.`;
    }
  };

  const image = await getImagePath(src);

  const ImageMod = await getImage({
    src: image.default,
    format: format,
  });

  return ImageMod.src;
};

export default bgImageMod;
```

---

### File: `./src/lib/utils/dateFormat.ts`

```typescript
import { format } from "date-fns";
import { id } from "date-fns/locale";

const dateFormat = (
  date: Date | string,
  pattern: string = "dd MMMM yyyy",
): string => {
  const dateObj = new Date(date);
  const output = format(dateObj, pattern, { locale: id });
  return output;
};

export default dateFormat;
```

---

### File: `./src/lib/utils/readingTime.ts`

```typescript
const readingTime = (content: string): string => {
  const WPS = 275 / 60;

  let images = 0;
  const regex = /\w/;

  let words = content.split(" ").filter((word) => {
    if (word.includes("<img")) {
      images += 1;
    }
    return regex.test(word);
  }).length;

  let imageAdjust = images * 4;
  let imageSecs = 0;
  let imageFactor = 12;

  while (images) {
    imageSecs += imageFactor;
    if (imageFactor > 3) {
      imageFactor -= 1;
    }
    images -= 1;
  }

  const minutes = Math.ceil(((words - imageAdjust) / WPS + imageSecs) / 60);
  if (minutes < 10) {
    return "0" + minutes + ` Menit baca`;
  } else {
    return minutes + ` Menit baca`;
  }
};

export default readingTime;
```

---

### File: `./src/lib/utils/similarItems.ts`

```typescript
const similarItems = (currentItem: any, allItems: any[]) => {
  let categories: string[] = [];
  let tags: string[] = [];

  if (currentItem.data.categories.length > 0) {
    categories = currentItem.data.categories;
  }

  if (currentItem.data.tags.length > 0) {
    tags = currentItem.data.tags;
  }

  const filterByCategories = allItems.filter((item: any) =>
    categories.find((category) => item.data.categories.includes(category)),
  );

  const filterByTags = allItems.filter((item: any) =>
    tags.find((tag) => item.data.tags.includes(tag)),
  );

  const mergedItems = [...new Set([...filterByCategories, ...filterByTags])];

  const filterBySlug = mergedItems.filter(
    (product) => product.id !== currentItem.id,
  );

  return filterBySlug;
};

export default similarItems;
```

---

### File: `./src/lib/utils/sortFunctions.ts`

```typescript
export const sortByDate = (array: any[]) => {
  const sortedArray = array.sort(
    (a: any, b: any) =>
      new Date(b.data.date && b.data.date).valueOf() -
      new Date(a.data.date && a.data.date).valueOf(),
  );
  return sortedArray;
};

export const sortByWeight = (array: any[]) => {
  const withWeight = array.filter(
    (item: { data: { weight: any } }) => item.data.weight,
  );
  const withoutWeight = array.filter(
    (item: { data: { weight: any } }) => !item.data.weight,
  );
  const sortedWeightedArray = withWeight.sort(
    (a: { data: { weight: number } }, b: { data: { weight: number } }) =>
      a.data.weight - b.data.weight,
  );
  const sortedArray = [...new Set([...sortedWeightedArray, ...withoutWeight])];
  return sortedArray;
};
```

---

### File: `./src/lib/utils/taxonomyFilter.ts`

```typescript
import { slugify } from "@/lib/utils/textConverter";

const taxonomyFilter = (posts: any[], name: string, key: string) =>
  posts.filter((post) =>
    post.data[name].map((name: string) => slugify(name)).includes(key),
  );

export default taxonomyFilter;
```

---

### File: `./src/lib/utils/textConverter.ts`

```typescript
import { slug } from "github-slugger";
import { marked } from "marked";

export const slugify = (content: string) => {
  return slug(content);
};

export const markdownify = (content: string, div?: boolean) => {
  return div ? marked.parse(content) : marked.parseInline(content);
};

export const humanize = (content: string) => {
  return content
    .replace(/^[\s_]+|[\s_]+$/g, "")
    .replace(/[_\s]+/g, " ")
    .replace(/[-\s]+/g, " ")
    .replace(/^[a-z]/, function (m) {
      return m.toUpperCase();
    });
};

export const titleify = (content: string) => {
  const humanized = humanize(content);
  return humanized
    .split(" ")
    .map((word) => word.charAt(0).toUpperCase() + word.slice(1))
    .join(" ");
};

export const plainify = (content: string) => {
  const parseMarkdown: any = marked.parse(content);
  const filterBrackets = parseMarkdown.replace(/<\/?[^>]+(>|$)/gm, "");
  const filterSpaces = filterBrackets.replace(/[\r\n]\s*[\r\n]/gm, "");
  const stripHTML = htmlEntityDecoder(filterSpaces);
  return stripHTML;
};

const htmlEntityDecoder = (htmlWithEntities: string) => {
  let entityList: { [key: string]: string } = {
    "&nbsp;": " ",
    "&lt;": "<",
    "&gt;": ">",
    "&amp;": "&",
    "&quot;": '"',
    "&#39;": "'",
  };
  let htmlWithoutEntities: string = htmlWithEntities.replace(
    /(&amp;|&lt;|&gt;|&quot;|&#39;)/g,
    (entity: string): string => {
      return entityList[entity];
    },
  );
  return htmlWithoutEntities;
};
```

---

### File: `./src/pages/404.astro`

```astro
---
import Base from "@/layouts/Base.astro";
---

<Base title="Halaman Tidak Ditemukan">
  <section class="section-sm text-center width:100">
    <div class="container">
      <div class="row justify-center">
        <div class="sm:col-10 md:col-8 lg:col-6">
          <span
            class="text-[8rem] block font-bold text-text-dark dark:text-darkmode-text-dark"
          >
            404
          </span>
          <h1 class="h2 mb-4">Halaman Tidak Ditemukan</h1>
          <div class="content">
            <p>
              Halaman yang Anda cari mungkin telah dihapus, namanya diubah, atau
              sementara tidak tersedia.
            </p>
          </div>
          <a href="/" class="btn btn-primary mt-8">Kembali ke Beranda</a>
        </div>
      </div>
    </div>
  </section>
</Base>
```

---

### File: `./src/pages/about.astro`

```astro
---
import ImageMod from "@/components/ImageMod.astro";
import Base from "@/layouts/Base.astro";
import { getListPage } from "@/lib/contentParser.astro";
import { markdownify } from "@/lib/utils/textConverter";
import { render } from "astro:content";

const aboutIndex = await getListPage("about", "-index");
const { Content } = await render(aboutIndex);
const { title, description, meta_title, image } = aboutIndex.data;

if (aboutIndex.data.draft) {
  return Astro.redirect("/404");
}
---

<Base
  title={title}
  meta_title={meta_title}
  description={description}
  image={image}
>
  <section class="section-sm">
    <div class="container">
      <div class="row justify-center">
        <div class="text-center md:col-10 lg:col-7">
          {
            image && (
              <ImageMod
                class="mx-auto mb-6 rounded-lg"
                src={image}
                width={200}
                height={200}
                alt={title}
                format="webp"
              />
            )
          }
          <h2 set:html={markdownify(title)} class="h3 mb-6" />
          <div class="content">
            <Content />
          </div>
        </div>
      </div>
    </div>
  </section>
</Base>
```

---

### File: `./src/pages/admin/index.astro`

```astro
---
import Base from "@/layouts/Base.astro";
import AdminDashboard from "@/layouts/helpers/AdminDashboard";

// Halaman ini bersifat statis di sisi Astro,
// proteksi sebenarnya dilakukan di dalam komponen React (Client-side)
// dan di PHP API (Server-side)
---

<Base
  title="Admin Dashboard"
  meta_title="Admin Panel - MTsN 1 Pandeglang"
  noindex={true}
>
  <section class="section-sm bg-gray-50 dark:bg-darkmode-body min-h-screen">
    <div class="container">
      <AdminDashboard client:only="react" />
    </div>
  </section>
</Base>
```

---

### File: `./src/pages/authors/index.astro`

```astro
---
import AuthorCard from "@/components/AuthorCard.astro";
import Base from "@/layouts/Base.astro";
import { getListPage, getSinglePage } from "@/lib/contentParser.astro";
import PageHeader from "@/partials/PageHeader.astro";

const authorIndex = await getListPage("authors", "-index");

if (authorIndex.data.draft) {
  return Astro.redirect("/404");
}

const authors = await getSinglePage("authors");
---

<Base title={authorIndex.data.title}>
  <PageHeader title={authorIndex.data.title} />
  <section class="section-sm pb-0">
    <div class="container">
      <div class="row justify-center">
        {
          authors.map((author) => (
            <div class="mb-14 md:col-6 lg:col-4">
              <AuthorCard data={author} />
            </div>
          ))
        }
      </div>
    </div>
  </section>
</Base>
```

---

### File: `./src/pages/authors/[single].astro`

```astro
---
import BlogCard from "@/components/BlogCard.astro";
import ImageMod from "@/components/ImageMod.astro";
import Social from "@/components/Social.astro";
import Base from "@/layouts/Base.astro";
import { getSinglePage } from "@/lib/contentParser.astro";
import { slugify } from "@/lib/utils/textConverter";
import { render } from "astro:content";

export async function getStaticPaths() {
  const COLLECTION_FOLDER = "authors";
  const authors = await getSinglePage(COLLECTION_FOLDER);

  const paths = authors.map((author) => ({
    params: {
      single: author.id,
    },
    props: { author },
  }));
  return paths;
}

const { author } = Astro.props;
const { title, social, meta_title, description, image } = author.data;
const { Content } = await render(author);

const BLOG_FOLDER = "blog";
const posts = await getSinglePage(BLOG_FOLDER);
const postFilterByAuthor = posts.filter(
  (post) => slugify(post.data.author) === slugify(title),
);
---

<Base
  title={title}
  meta_title={meta_title}
  description={description}
  image={image}
>
  <section class="section-sm pb-0">
    <div class="container">
      <div
        class="row justify-center border-b border-border pb-14 dark:border-darkmode-border"
      >
        <div class="text-center lg:col-4">
          {
            image && (
              <ImageMod
                src={image}
                class="mx-auto mb-10 rounded"
                height={200}
                width={200}
                alt={title}
                format="webp"
              />
            )
          }
          <h1 class="h3 mb-6">{title}</h1>
          <div class="content">
            <Content />
          </div>
          <Social source={social} className="social-icons" />
        </div>
      </div>

      <div class="row justify-center pb-16 pt-14">
        {
          postFilterByAuthor.map((post) => (
            <div class="mb-12 md:col-6 lg:col-4">
              <BlogCard data={post} />
            </div>
          ))
        }
      </div>
    </div>
  </section>
</Base>
```

---

### File: `./src/pages/blog/index.astro`

```astro
---
import BlogCard from "@/components/BlogCard.astro";
import Pagination from "@/components/Pagination.astro";
import config from "@/config/config.json";
import Base from "@/layouts/Base.astro";
import { getListPage, getSinglePage } from "@/lib/contentParser.astro";
import { getAllTaxonomy, getTaxonomy } from "@/lib/taxonomyParser.astro";
import { sortByDate } from "@/lib/utils/sortFunctions";
import PageHeader from "@/partials/PageHeader.astro";
import PostSidebar from "@/partials/PostSidebar.astro";

const BLOG_FOLDER = "blog";

const postIndex = await getListPage(BLOG_FOLDER, "-index");
if (postIndex.data.draft) {
  return Astro.redirect("/404");
}
const posts = await getSinglePage(BLOG_FOLDER);
const allCategories = await getAllTaxonomy(BLOG_FOLDER, "categories");
const categories = await getTaxonomy(BLOG_FOLDER, "categories");
const tags = await getTaxonomy(BLOG_FOLDER, "tags");
const sortedPosts = sortByDate(posts);
const totalPages: number = Math.ceil(posts.length / config.settings.pagination);
const currentPosts = sortedPosts.slice(0, config.settings.pagination);
---

<Base
  title={postIndex.data.title}
  meta_title={postIndex.data.meta_title}
  image={postIndex.data.image}
  description={postIndex.data.description}
>
  <PageHeader title={postIndex?.data.title} />
  <section class="section">
    <div class="container">
      <div class="row gx-5">
        <div class="lg:col-8">
          <div class="row gsap-stagger-parent">
            {
              currentPosts.map((post) => (
                <div class="mb-14 md:col-6">
                  <BlogCard data={post} />
                </div>
              ))
            }
          </div>
          <Pagination
            section={BLOG_FOLDER}
            currentPage={1}
            totalPages={totalPages}
          />
        </div>
        <PostSidebar
          categories={categories}
          tags={tags}
          allCategories={allCategories}
        />
      </div>
    </div>
  </section>
</Base>
```

---

### File: `./src/pages/blog/page/[slug].astro`

```astro
---
import BlogCard from "@/components/BlogCard.astro";
import Pagination from "@/components/Pagination.astro";
import config from "@/config/config.json";
import Base from "@/layouts/Base.astro";
import { getListPage, getSinglePage } from "@/lib/contentParser.astro";
import { getAllTaxonomy, getTaxonomy } from "@/lib/taxonomyParser.astro";
import { sortByDate } from "@/lib/utils/sortFunctions";
import PageHeader from "@/partials/PageHeader.astro";
import PostSidebar from "@/partials/PostSidebar.astro";

const BLOG_FOLDER = "blog";

const { slug } = Astro.params;
const postIndex = await getListPage(BLOG_FOLDER, "-index");

if (postIndex.data.draft) {
  return Astro.redirect("/404");
}

const posts = await getSinglePage(BLOG_FOLDER);
const allCategories = await getAllTaxonomy(BLOG_FOLDER, "categories");
const categories = await getTaxonomy(BLOG_FOLDER, "categories");
const tags = await getTaxonomy(BLOG_FOLDER, "tags");
const sortedPosts = sortByDate(posts);
const totalPages = Math.ceil(posts.length / config.settings.pagination);
const currentPage = slug && !isNaN(Number(slug)) ? Number(slug) : 1;
const indexOfLastPost = currentPage * config.settings.pagination;
const indexOfFirstPost = indexOfLastPost - config.settings.pagination;
const currentPosts = sortedPosts.slice(indexOfFirstPost, indexOfLastPost);

export async function getStaticPaths() {
  const BLOG_FOLDER = "blog";
  const posts = await getSinglePage(BLOG_FOLDER);
  const totalPages = Math.ceil(posts.length / config.settings.pagination);
  const paths = [];

  for (let i = 1; i < totalPages; i++) {
    paths.push({
      params: {
        slug: (i + 1).toString(),
      },
    });
  }
  return paths;
}
---

<Base
  title={postIndex.data.title}
  meta_title={postIndex.data.meta_title}
  image={postIndex.data.image}
  description={postIndex.data.description}
>
  <PageHeader title={postIndex.data.title} />
  <section class="section">
    <div class="container">
      <div class="row gx-5">
        <div class="lg:col-8">
          <div class="row">
            {
              currentPosts.map((post) => (
                <div class="mb-14 md:col-6">
                  <BlogCard data={post} />
                </div>
              ))
            }
          </div>
          <Pagination
            section={BLOG_FOLDER}
            currentPage={currentPage}
            totalPages={totalPages}
          />
        </div>

        <PostSidebar
          categories={categories}
          tags={tags}
          allCategories={allCategories}
        />
      </div>
    </div>
  </section>
</Base>
```

---

### File: `./src/pages/blog/[single].astro`

```astro
---
import Base from "@/layouts/Base.astro";
import PostSingle from "@/layouts/PostSingle.astro";
import { getSinglePage } from "@/lib/contentParser.astro";

export async function getStaticPaths() {
  const BLOG_FOLDER = "blog";
  const posts = await getSinglePage(BLOG_FOLDER);

  const paths = posts.map((post) => ({
    params: {
      single: post.id,
    },
    props: { post },
  }));
  return paths;
}

const { post } = Astro.props;
const { title, meta_title, description, image } = post.data;
---

<Base
  title={title}
  meta_title={meta_title}
  description={description}
  image={image}
>
  <PostSingle post={post} />
</Base>
```

---

### File: `./src/pages/categories/index.astro`

```astro
---
import Base from "@/layouts/Base.astro";
import { getAllTaxonomy, getTaxonomy } from "@/lib/taxonomyParser.astro";
import { humanize } from "@/lib/utils/textConverter";
import PageHeader from "@/partials/PageHeader.astro";

const BLOG_FOLDER = "blog";

const categories = await getTaxonomy(BLOG_FOLDER, "categories");
const allCategories = await getAllTaxonomy(BLOG_FOLDER, "categories");
---

<Base title={"Categories"}>
  <PageHeader title={"Categories"} />
  <section class="section">
    <div class="container text-center">
      <ul>
        {
          categories.map((category: string) => {
            const count = allCategories.filter((c) => c === category).length;
            return (
              <li class="m-3 inline-block">
                <a
                  href={`/categories/${category}`}
                  class="block rounded bg-light px-4 py-2 text-xl text-text-dark dark:bg-darkmode-light dark:text-darkmode-text-dark"
                >
                  {humanize(category)}{" "}
                  <span class="ml-2 rounded bg-body px-2 dark:bg-darkmode-body">
                    {count}
                  </span>
                </a>
              </li>
            );
          })
        }
      </ul>
    </div>
  </section>
</Base>
```

---

### File: `./src/pages/categories/[category].astro`

```astro
---
import BlogCard from "@/components/BlogCard.astro";
import Base from "@/layouts/Base.astro";
import { getSinglePage } from "@/lib/contentParser.astro";
import { getTaxonomy } from "@/lib/taxonomyParser.astro";
import { sortByDate } from "@/lib/utils/sortFunctions";
import taxonomyFilter from "@/lib/utils/taxonomyFilter";
import PageHeader from "@/partials/PageHeader.astro";

export async function getStaticPaths() {
  const BLOG_FOLDER = "blog";
  const categories = await getTaxonomy(BLOG_FOLDER, "categories");

  return categories.map((category) => {
    return {
      params: { category },
    };
  });
}

const { category } = Astro.params;

const BLOG_FOLDER = "blog";
const posts = await getSinglePage(BLOG_FOLDER);
const filterByCategories = taxonomyFilter(posts, "categories", category!);
const sortedPosts = sortByDate(filterByCategories);
---

<Base title={category}>
  <PageHeader title={category} />
  <div class="section-sm pb-0">
    <div class="container">
      <div class="row">
        {
          sortedPosts.map((post) => (
            <div class="mb-14 md:col-6 lg:col-4">
              <BlogCard data={post} />
            </div>
          ))
        }
      </div>
    </div>
  </div>
</Base>
```

---

### File: `./src/pages/contact.astro`

```astro
---
import config from "@/config/config.json";
import Base from "@/layouts/Base.astro";
import { getListPage } from "@/lib/contentParser.astro";
import PageHeader from "@/partials/PageHeader.astro";

const contactIndex = await getListPage("contact", "-index");
const { contact_form_action }: { contact_form_action: string } = config.params;
const { title, description, meta_title, image } = contactIndex.data;

if (contactIndex.data.draft) {
  return Astro.redirect("/404");
}
---

<Base
  title={title}
  meta_title={meta_title}
  description={description}
  image={image}
>
  <PageHeader title={title} />
  <section class="section-sm">
    <div class="container">
      <div class="row">
        <div class="mx-auto md:col-10 lg:col-6">
          <form action={contact_form_action} method="POST">
            <div class="mb-6">
              <label for="name" class="form-label">
                Nama Lengkap <span class="text-red-500">*</span>
              </label>
              <input
                id="name"
                name="name"
                class="form-input"
                placeholder="John Doe"
                type="text"
                required
              />
            </div>
            <div class="mb-6">
              <label for="email" class="form-label">
                Alamat Email <span class="text-red-500">*</span>
              </label>
              <input
                id="email"
                name="email"
                class="form-input"
                placeholder="john.doe@email.com"
                type="email"
                required
              />
            </div>
            <div class="mb-6">
              <label for="message" class="form-label">
                Pesan <span class="text-red-500">*</span>
              </label>
              <textarea
                id="message"
                name="message"
                class="form-input"
                placeholder="Message goes here..."
                required
                rows="8"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Kirim</button>
          </form>
        </div>
      </div>
    </div>
  </section>
</Base>
```

---

### File: `./src/pages/index.astro`

```astro
---
import ImageMod from "@/components/ImageMod.astro";
import Base from "@/layouts/Base.astro";
import { getListPage } from "@/lib/contentParser.astro";
import { markdownify } from "@/lib/utils/textConverter";
import CallToAction from "@/partials/CallToAction.astro";
import Testimonial from "@/partials/Testimonial.astro";
import LatestPostsSlider from "@/partials/LatestPostsSlider.astro";
import { FaCheck } from "react-icons/fa";
import VideoModal from "@/layouts/helpers/VideoModal";
import TawkChat from "@/layouts/helpers/TawkChat";

const homepage = await getListPage("homepage", "-index");
const call_to_action = await getListPage("ctaSection", "call-to-action");
const testimonial = await getListPage("testimonialSection", "testimonial");

const { banner, features } = homepage.data;
---

<Base>
  <section class="section pt-14">
    <div class="container">
      <div class="row justify-center">
        <div class="lg:col-7 md:col-9 mb-8 text-center gsap-fade-up">
          <h1
            set:html={markdownify(banner.title)}
            class="mb-4 text-h3 lg:text-h1"
          />
          <p set:html={markdownify(banner.content)} class="mb-8" />
          {
            banner.button.enable && (
              <div class="flex flex-wrap justify-center gap-4">
                <a
                  class="btn btn-primary mb-4"
                  href={banner.button.link}
                  target={
                    banner.button.link.startsWith("http") ? "_blank" : "_self"
                  }
                  rel="noopener"
                >
                  {banner.button.label}
                </a>

                <VideoModal
                  client:load
                  videoId="q5ECbq5EuuE"
                  label="Selayang Pandang"
                />
              </div>
            )
          }
        </div>
        {
          banner.image && (
            <div class="col-12 gsap-hero-image">
              <ImageMod
                src={banner.image}
                height={380}
                width={1200}
                alt="banner"
                format="webp"
              />
            </div>
          )
        }
      </div>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <div class="mb-12 text-center">
        <h2 class="h2 gsap-fade-up">Keunggulan Kami</h2>
        <p
          class="mt-4 text-text-light dark:text-darkmode-text-light gsap-fade-up"
        >
          Mengapa MTs Negeri 1 Pandeglang adalah pilihan terbaik untuk masa
          depan putra-putri Anda.
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 gsap-stagger-parent">
        {
          features.map((feature, index) => {
            const isWide = index === 0 || index === 3;

            return (
              <div
                class={`
                  group relative overflow-hidden rounded-3xl border border-border bg-white p-8 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl dark:border-darkmode-border dark:bg-darkmode-light
                  ${isWide ? "md:col-span-2" : "md:col-span-1"}
                `}
              >
                <div
                  class={`flex h-full flex-col ${isWide ? "lg:flex-row lg:items-center lg:gap-8" : "gap-6"}`}
                >
                  <div
                    class={`
                    relative shrink-0 overflow-hidden rounded-2xl bg-light dark:bg-darkmode-body
                    ${isWide ? "lg:w-1/2 h-64 lg:h-full" : "h-48 w-full"}
                  `}
                  >
                    <ImageMod
                      src={feature.image}
                      height={400}
                      width={600}
                      alt={feature.title}
                      class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110"
                      format="webp"
                    />
                  </div>

                  <div class="flex flex-1 flex-col justify-between">
                    <div>
                      <h3 class="h4 mb-3 font-bold">{feature.title}</h3>
                      <p
                        class="mb-4 text-text-light dark:text-darkmode-text-light line-clamp-3"
                        set:html={markdownify(feature.content)}
                      />

                      {feature.bulletpoints && (
                        <ul class="mb-6 space-y-2">
                          {feature.bulletpoints
                            .slice(0, isWide ? 4 : 2)
                            .map((bullet: string) => (
                              <li class="flex items-start text-sm">
                                <span class="mr-2 mt-1 text-primary">
                                  <FaCheck />
                                </span>
                                <span>{bullet}</span>
                              </li>
                            ))}
                          {feature.bulletpoints.length > (isWide ? 4 : 2) && (
                            <li class="text-xs text-text-light italic">
                              + {feature.bulletpoints.length - (isWide ? 4 : 2)}{" "}
                              poin lainnya
                            </li>
                          )}
                        </ul>
                      )}
                    </div>

                    {feature.button.enable && (
                      <div class="mt-auto pt-4">
                        <a
                          href={feature.button.link}
                          class="inline-flex items-center font-semibold text-primary transition-colors hover:text-dark dark:hover:text-white"
                        >
                          {feature.button.label}
                          <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="ml-2 h-4 w-4 transition-transform group-hover:translate-x-1"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                          >
                            <path
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M14 5l7 7m0 0l-7 7m7-7H3"
                            />
                          </svg>
                        </a>
                      </div>
                    )}
                  </div>
                </div>
              </div>
            );
          })
        }
      </div>
    </div>
  </section>

  <LatestPostsSlider />

  <Testimonial testimonial={testimonial} />
  <div class="gsap-fade-up">
    <CallToAction call_to_action={call_to_action} />
  </div>

  <TawkChat client:only="react" />
</Base>
```

---

### File: `./src/pages/survei-kepuasan.astro`

```astro
---
import Base from "@/layouts/Base.astro";
import PageHeader from "@/partials/PageHeader.astro";
import SurveyWizard from "@/layouts/helpers/SurveyWizard";

const title = "Survei Kepuasan Masyarakat";
const description =
  "Bantu kami meningkatkan kualitas layanan MTs Negeri 1 Pandeglang dengan mengisi survei kepuasan pelanggan secara online.";
---

<Base title={title} meta_title={title} description={description}>
  <PageHeader title={title} />

  <section class="section-sm">
    <div class="container">
      <div class="row justify-center">
        <div class="lg:col-10">
          <div class="mb-10 text-center">
            <p class="text-lg">
              Survei ini bertujuan untuk mengukur tingkat kepuasan masyarakat
              terhadap penyelenggaraan pelayanan publik di <strong
                >MTs Negeri 1 Pandeglang</strong
              >. Identitas dan jawaban Anda dijamin kerahasiaannya.
            </p>
          </div>

          <SurveyWizard client:only="react" />
        </div>
      </div>
    </div>
  </section>
</Base>
```

---

### File: `./src/pages/tags/index.astro`

```astro
---
import Base from "@/layouts/Base.astro";
import { getAllTaxonomy, getTaxonomy } from "@/lib/taxonomyParser.astro";
import { humanize } from "@/lib/utils/textConverter";
import PageHeader from "@/partials/PageHeader.astro";

const BLOG_FOLDER = "blog";

const tags = await getTaxonomy(BLOG_FOLDER, "tags");
const allTags = await getAllTaxonomy(BLOG_FOLDER, "tags");
---

<Base title={"Tags"}>
  <PageHeader title={"Tags"} />
  <section class="section">
    <div class="container text-center">
      <ul>
        {
          tags.map((tag: any) => {
            const count = allTags.filter((c) => c === tag).length;
            return (
              <li class="m-3 inline-block">
                <a
                  href={`/tags/${tag}`}
                  class="block rounded bg-light px-4 py-2 text-xl text-text-dark dark:bg-darkmode-light dark:text-darkmode-text-dark"
                >
                  {humanize(tag)}{" "}
                  <span class="ml-2 rounded bg-body px-2 dark:bg-darkmode-body">
                    {count}
                  </span>
                </a>
              </li>
            );
          })
        }
      </ul>
    </div>
  </section>
</Base>
```

---

### File: `./src/pages/tags/[tag].astro`

```astro
---
import BlogCard from "@/components/BlogCard.astro";
import Base from "@/layouts/Base.astro";
import { getSinglePage } from "@/lib/contentParser.astro";
import { getTaxonomy } from "@/lib/taxonomyParser.astro";
import { sortByDate } from "@/lib/utils/sortFunctions";
import taxonomyFilter from "@/lib/utils/taxonomyFilter";
import PageHeader from "@/partials/PageHeader.astro";

export async function getStaticPaths() {
  const BLOG_FOLDER = "blog";
  const tags = await getTaxonomy(BLOG_FOLDER, "tags");

  return tags.map((tag) => {
    return {
      params: { tag },
    };
  });
}

const { tag } = Astro.params;

const BLOG_FOLDER = "blog";
const posts = await getSinglePage(BLOG_FOLDER);
const filterByTags = taxonomyFilter(posts, "tags", tag!);
const sortedPosts = sortByDate(filterByTags);
---

<Base title={tag}>
  <PageHeader title={tag} />
  <div class="section-sm pb-0">
    <div class="container">
      <div class="row">
        {
          sortedPosts.map((post) => (
            <div class="mb-14 md:col-6 lg:col-4">
              <BlogCard data={post} />
            </div>
          ))
        }
      </div>
    </div>
  </div>
</Base>
```

---

### File: `./src/pages/[regular].astro`

```astro
---
import Base from "@/layouts/Base.astro";
import { getSinglePage } from "@/lib/contentParser.astro";
import PageHeader from "@/partials/PageHeader.astro";
import { render } from "astro:content";

export async function getStaticPaths() {
  const COLLECTION_FOLDER = "pages";

  const pages = await getSinglePage(COLLECTION_FOLDER);

  const paths = pages.map((page) => ({
    params: {
      regular: page.id,
    },
    props: { page },
  }));
  return paths;
}

const { page } = Astro.props;
const { title, meta_title, description, image } = page.data;
const { Content } = await render(page);
---

<Base
  title={title}
  meta_title={meta_title}
  description={description}
  image={image}
>
  <PageHeader title={title} />
  <section class="section-sm">
    <div class="container">
      <div class="row justify-center">
        <div class="lg:col-10">
          <div class="content">
            <Content />
          </div>
        </div>
      </div>
    </div>
  </section>
</Base>
```

---

### File: `./src/scripts/gsap-animations.js`

```javascript
import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
import Lenis from "lenis";

gsap.registerPlugin(ScrollTrigger);

export function initAnimations() {
  const lenis = new Lenis({
    duration: 1.2,
    easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
    orientation: "vertical",
    gestureDirection: "vertical",
    smoothWheel: true,
  });

  lenis.on("scroll", ScrollTrigger.update);

  gsap.ticker.add((time) => {
    lenis.raf(time * 1000);
  });

  gsap.ticker.lagSmoothing(0);

  const fadeUpElements = document.querySelectorAll(".gsap-fade-up");

  fadeUpElements.forEach((elem) => {
    gsap.fromTo(
      elem,
      {
        y: 50,
        opacity: 0,
      },
      {
        y: 0,
        opacity: 1,
        duration: 1,
        ease: "power3.out",
        scrollTrigger: {
          trigger: elem,
          start: "top 85%",
          toggleActions: "play none none reverse",
        },
      },
    );
  });

  const staggerContainers = document.querySelectorAll(".gsap-stagger-parent");

  staggerContainers.forEach((container) => {
    const children = container.children;

    gsap.fromTo(
      children,
      {
        y: 30,
        opacity: 0,
      },
      {
        y: 0,
        opacity: 1,
        duration: 0.8,
        stagger: 0.15,
        ease: "power2.out",
        scrollTrigger: {
          trigger: container,
          start: "top 85%",
        },
      },
    );
  });

  const heroImages = document.querySelectorAll(".gsap-hero-image");
  if (heroImages.length > 0) {
    gsap.fromTo(
      heroImages,
      { scale: 0.9, opacity: 0 },
      { scale: 1, opacity: 1, duration: 1.5, ease: "power2.out" },
    );
  }

  ScrollTrigger.refresh();
}
```

---

### File: `./src/scripts/spotlight.js`

```javascript
function handleMouseMove(e) {
  const btn = e.target.closest(".btn");

  if (btn) {
    const rect = btn.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;

    btn.style.setProperty("--x", `${x}px`);
    btn.style.setProperty("--y", `${y}px`);
  }
}

export function initSpotlightButtons() {
  document.removeEventListener("mousemove", handleMouseMove);

  document.addEventListener("mousemove", handleMouseMove);
}
```

---

### File: `./src/styles/base.css`

```css
html {
  @apply text-base-sm md:text-base;
}

body {
  @apply bg-body text-base dark:bg-darkmode-body font-primary font-normal leading-relaxed text-text dark:text-darkmode-text;
}

h1,
h2,
h3,
h4,
h5,
h6 {
  @apply font-secondary font-bold leading-tight text-text-dark dark:text-darkmode-text-dark;
}

h1,
.h1 {
  @apply text-h1-sm md:text-h1;
}

h2,
.h2 {
  @apply text-h2-sm md:text-h2;
}

h3,
.h3 {
  @apply text-h3-sm md:text-h3;
}

h4,
.h4 {
  @apply text-h4;
}

h5,
.h5 {
  @apply text-h5;
}

h6,
.h6 {
  @apply text-h6;
}

b,
strong {
  @apply font-semibold;
}

code {
  @apply after:border-none;
}

blockquote > p {
  @apply my-0!;
}

button {
  @apply cursor-pointer;
}
```

---

### File: `./src/styles/buttons.css`

```css
.btn {
  @apply relative inline-flex items-center justify-center overflow-hidden rounded border border-transparent px-6 py-2.5 font-semibold capitalize transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg active:translate-y-0 active:scale-95;

  --x: 50%;
  --y: 50%;
  z-index: 1;
}

.btn-sm {
  @apply rounded-sm px-4 py-1.5 text-sm;
}

.btn::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  z-index: -1;

  background: radial-gradient(
    circle at var(--x) var(--y),
    var(--spotlight-color, var(--color-primary)) 0%,
    transparent 50%
  );

  opacity: 0;
  transition: opacity 0.3s ease;
}

.btn:hover::before {
  opacity: 1;
}

.btn-primary {
  @apply border-primary bg-primary text-white dark:border-darkmode-primary dark:bg-darkmode-primary dark:text-text-dark;

  --spotlight-color: rgba(255, 255, 255, 0.4);
}

.btn-outline-primary {
  @apply border-primary bg-transparent text-primary dark:border-darkmode-primary dark:text-darkmode-primary;

  @apply hover:text-white dark:hover:text-black;

  --spotlight-color: var(--color-primary);
}

.dark .btn-outline-primary {
  --spotlight-color: var(--color-darkmode-primary);
}
```

---

### File: `./src/styles/components.css`

```css
.section {
  @apply py-24 xl:py-28;
}

.section-sm {
  @apply py-16 xl:py-20;
}

.container {
  @apply mx-auto xl:!max-w-[1320px] px-4;
}

.social-icons {
  @apply space-x-4;
}
.social-icons li {
  @apply inline-block;
}
.social-icons li a {
  @apply flex h-9 w-9 items-center justify-center rounded-sm bg-primary text-center leading-9 text-white dark:bg-darkmode-primary dark:text-text-dark;
}
.social-icons li a svg {
  @apply h-5 w-5;
}

.notice {
  @apply mb-6 rounded-lg border px-8 py-6;
}

.notice-head {
  @apply flex items-center;
}

.notice-head svg {
  @apply mr-3;
}

.notice-head p {
  @apply font-secondary text-xl font-semibold text-text-dark dark:text-darkmode-text-light;
}

.notice-body {
  @apply mt-3;
}

.notice-body p {
  @apply my-0;
}

.notice.note {
  @apply text-[#1B83E2];
  @apply border-current;
}

.notice.tip {
  @apply text-[#40D294];
  @apply border-current;
}

.notice.info {
  @apply text-[#E3A72C];
  @apply border-current;
}

.notice.warning {
  @apply text-[#DB2C23];
  @apply border-current;
}
.tab {
  @apply overflow-hidden rounded-lg border border-border dark:border-darkmode-border;
}

.tab-nav {
  @apply flex border-b border-border bg-light dark:border-darkmode-border dark:bg-darkmode-light !m-0 !list-none;
}

.tab-nav-item {
  @apply cursor-pointer border-b-[3px] border-border py-2 text-lg text-text-dark opacity-80 dark:border-light !my-0 !px-8;
}

.tab-nav-item.active {
  @apply border-b-[3px] border-dark opacity-100 dark:border-darkmode-primary;
}

.tab-content {
  @apply px-5;
}

.tab-content-panel {
  @apply p-8;
}

.tab-content-panel p {
  @apply mb-0;
}

.tab-content-panel.active {
  @apply block;
}

.accordion {
  @apply mb-6 overflow-hidden rounded-lg border border-border bg-light dark:border-darkmode-border dark:bg-darkmode-light;
}

.accordion-header {
  @apply flex w-full cursor-pointer items-center justify-between px-8 py-4 text-lg text-text-dark dark:bg-darkmode-light dark:text-darkmode-text-light;
}

.accordion-icon {
  @apply h-[.8em] w-[.8em] rotate-[-90deg] transition-transform duration-200;
}

.accordion-content {
  @apply max-h-0 overflow-hidden px-8 py-0;
}

.accordion.active .accordion-icon {
  @apply rotate-0;
}

.accordion.active .accordion-content {
  @apply max-h-screen;
}

.modal {
  @apply fixed inset-0 z-40 hidden h-full w-full overflow-auto;
}

.modal-overlay {
  @apply fixed inset-0 z-40 hidden h-full w-full bg-black/40;
}

.modal-content {
  @apply relative top-1/2 z-50 mx-auto max-w-[90%] -translate-y-1/2 rounded-lg bg-body p-8 dark:bg-darkmode-body;
}

.modal-close {
  @apply absolute right-3 top-3 h-8 w-8 rounded-full bg-light text-center leading-8 text-text-dark dark:bg-darkmode-light dark:text-darkmode-text-dark;
}

.content {
  @apply prose max-w-none;
  @apply prose-headings:mb-[.3em] prose-headings:mt-[.6em] prose-headings:text-text-dark dark:prose-headings:text-darkmode-text-dark;
  @apply prose-h1:text-h1-sm md:prose-h1:text-h1;
  @apply prose-h2:text-h2-sm md:prose-h2:text-h2;
  @apply prose-h3:text-h3-sm md:prose-h3:text-h3;
  @apply prose-p:text-base prose-p:text-text dark:prose-p:text-darkmode-text;
  @apply prose-a:text-text prose-a:[&.btn]:no-underline  dark:prose-a:text-darkmode-text;
  @apply prose-img:max-w-full prose-img:rounded;
  @apply prose-strong:text-text-dark dark:prose-strong:text-darkmode-text;
  @apply prose-hr:border-border dark:prose-hr:border-darkmode-border;
  @apply prose-pre:rounded-lg prose-pre:bg-light dark:prose-pre:bg-darkmode-light;
  @apply prose-code:text-darkmode-text-dark;
  @apply prose-li:text-text dark:prose-li:text-darkmode-text;
  @apply prose-blockquote:rounded-lg prose-blockquote:border prose-blockquote:border-l-[10px] prose-blockquote:border-primary prose-blockquote:bg-light prose-blockquote:px-8 prose-blockquote:py-10 prose-blockquote:font-secondary prose-blockquote:text-2xl prose-blockquote:not-italic prose-blockquote:text-text-dark dark:prose-blockquote:border-darkmode-primary dark:prose-blockquote:bg-darkmode-light dark:prose-blockquote:text-darkmode-text-light;
  @apply prose-table:relative prose-table:overflow-hidden prose-table:rounded-lg prose-table:before:absolute prose-table:before:left-0 prose-table:before:top-0 prose-table:before:h-full prose-table:before:w-full prose-table:before:rounded-[inherit] prose-table:before:border prose-table:before:border-border prose-table:before:content-[""] dark:prose-table:before:border-darkmode-border;
  @apply prose-thead:border-border prose-thead:bg-light dark:prose-thead:border-darkmode-border dark:prose-thead:bg-darkmode-light;
  @apply prose-th:relative prose-th:z-10 prose-th:px-4 prose-th:py-[18px] prose-th:text-text-dark dark:prose-th:text-darkmode-text;
  @apply prose-tr:border-border dark:prose-tr:border-darkmode-border;
  @apply prose-td:relative prose-td:z-10 prose-td:px-3 prose-td:py-[18px] dark:prose-td:text-darkmode-text;
}
```

---

### File: `./src/styles/main.css`

```css
@import "tailwindcss";
@plugin "../tailwind-plugin/tw-theme";
@plugin "../tailwind-plugin/tw-bs-grid";
@plugin "@tailwindcss/forms";
@plugin "@tailwindcss/typography";

@custom-variant dark (&:where(.dark, .dark *));

@import "./safe.css";
@import "./utilities.css";

@layer base {
  @import "./base.css";
}

@layer components {
  @import "./components.css";
  @import "./navigation.css";
  @import "./buttons.css";
  @import "./search.css";
}
```

---

### File: `./src/styles/navigation.css`

```css
.header {
  @apply bg-body dark:bg-darkmode-body py-6;
}

.navbar {
  @apply relative flex flex-wrap items-center justify-between;
}

.navbar-brand {
  @apply text-text-dark dark:text-darkmode-text-dark text-xl font-semibold;
  image {
    @apply max-h-full max-w-full;
  }
}

.navbar-nav {
  @apply text-center lg:text-left;
}

.nav-link {
  @apply text-text-dark hover:text-primary dark:text-darkmode-text-dark dark:hover:text-darkmode-primary block p-3 cursor-pointer font-semibold transition lg:px-2 lg:py-3;
}

.nav-dropdown {
  @apply mr-0;
}

.nav-dropdown > svg {
  @apply pointer-events-none;
}

.nav-dropdown-list {
  @apply bg-body dark:bg-darkmode-body z-10 min-w-[180px] rounded p-4 shadow-sm;
}

.nav-dropdown-item {
  @apply [&:not(:last-child)]:mb-2;
}

.nav-dropdown-link {
  @apply text-text-dark hover:text-primary dark:text-darkmode-text dark:hover:text-darkmode-primary block py-1 font-semibold transition;
}

.theme-switcher {
  @apply inline-flex;

  label {
    @apply bg-border relative inline-block h-4 w-6 cursor-pointer rounded-2xl lg:w-10;
  }

  input {
    @apply absolute opacity-0;
  }

  span {
    @apply bg-dark absolute -top-1 left-0 flex h-6 w-6 items-center justify-center rounded-full transition-all duration-300 dark:bg-white;
  }

  input:checked + label {
    span {
      @apply lg:left-4;
    }
  }
}
```

---

### File: `./src/styles/safe.css`

```css
input#nav-toggle:checked + label #show-button {
  @apply hidden;
}
input#nav-toggle:checked + label #hide-button {
  @apply block;
}
input#nav-toggle:checked ~ #nav-menu {
  @apply block;
}
.swiper-pagination-bullet {
  @apply !h-2.5 !w-2.5 !rounded-full !bg-gray-300 !opacity-100 transition-all duration-300 ease-in-out dark:!bg-gray-700;
  margin: 0 6px !important;
}
.swiper-pagination-bullet-active {
  @apply !w-8 !bg-primary dark:!bg-primary;
}
```

---

### File: `./src/styles/search.css`

```css
.search-modal {
  @apply z-50 fixed top-0 left-0 w-full h-full flex items-start justify-center invisible opacity-0;
}
.search-modal.show {
  @apply visible opacity-100;
}
.search-modal-overlay {
  @apply fixed top-0 left-0 w-full h-full bg-black opacity-50;
}
.search-wrapper {
  @apply bg-white dark:bg-darkmode-body w-[660px] max-w-[96%] mt-24 rounded shadow-lg relative z-10;
}
.search-wrapper-header {
  @apply p-4 relative;
}
.search-wrapper-header-input {
  @apply border border-solid w-full focus:ring-0 focus:border-dark border-border rounded-[4px] h-12 pr-4 pl-10 transition duration-200 outline-none dark:bg-darkmode-light dark:text-darkmode-text dark:border-darkmode-border dark:focus:border-darkmode-primary;
}
.search-wrapper-body {
  @apply dark:bg-darkmode-light dark:shadow-none max-h-[calc(100vh-350px)] overflow-y-auto bg-light shadow-[inset_0_2px_18px_#ddd] p-4 rounded;
}
.search-wrapper-footer {
  @apply text-xs select-none leading-none md:flex items-center px-3.5 py-2 hidden;
}
.search-wrapper-footer kbd {
  @apply bg-light dark:bg-darkmode-light text-xs leading-none text-center mr-[3px] px-1 py-0.5 rounded-[3px];
}
.search-wrapper-footer span:not(:last-child) {
  @apply mr-4;
}
.search-wrapper-footer span:last-child {
  @apply ml-auto;
}
.search-result-empty {
  @apply text-center cursor-text select-none px-0 py-8;
}
.search-result-group {
  @apply mb-4;
}
.search-result-group-title {
  @apply text-lg text-text-dark dark:text-darkmode-text-dark mb-[5px] px-3;
}
.search-result-item {
  @apply rounded border bg-white dark:bg-darkmode-body dark:border-darkmode-border flex items-start mb-1 p-4 scroll-my-[30px] border-solid border-border relative;
}
.search-result-item mark {
  @apply bg-yellow-200 rounded-[2px];
}
.search-result-item-title {
  @apply text-lg font-bold text-text-dark dark:text-darkmode-text-dark leading-none;
}
.search-result-item-link::after {
  @apply absolute top-0 right-0 bottom-0 left-0 z-10 content-[""];
}
.search-result-item-image {
  @apply shrink-0 mr-3.5;
}
.search-result-item-image img {
  @apply w-[60px] h-[60px] md:w-[100px] md:h-[100px] rounded-[4px] object-cover;
}
.search-result-item-description {
  @apply text-sm line-clamp-1 mt-1;
}
.search-result-item-content {
  @apply mx-0 my-1.5 empty:hidden line-clamp-1;
}
.search-result-item-taxonomies {
  @apply text-sm flex flex-wrap items-center text-text-light dark:text-darkmode-text-light;
}
.search-result-item-taxonomies svg {
  @apply inline-block mr-1;
}
.search-result-item-active,
.search-result-item:focus,
.search-result-item:hover {
  @apply bg-dark dark:bg-dark;
}
.search-result-item-active .search-result-item-title,
.search-result-item:focus .search-result-item-title,
.search-result-item:hover .search-result-item-title {
  @apply text-white;
}
.search-result-item-active .search-result-item-description,
.search-result-item:focus .search-result-item-description,
.search-result-item:hover .search-result-item-description {
  @apply text-white/80;
}
.search-result-item-active .search-result-item-content,
.search-result-item:focus .search-result-item-content,
.search-result-item:hover .search-result-item-content {
  @apply text-white/90;
}
.search-result-item-active .search-result-item-taxonomies,
.search-result-item:focus .search-result-item-taxonomies,
.search-result-item:hover .search-result-item-taxonomies {
  @apply text-white/90;
}
```

---

### File: `./src/styles/utilities.css`

```css
@utility bg-gradient {
  @apply bg-linear-to-b from-[rgba(249,249,249,1)] from-[0.53%] to-white to-[83.28%] dark:from-darkmode-light dark:to-darkmode-body;
}

@utility form-input {
  @apply w-full rounded border-transparent bg-light px-6 py-4 text-text-dark placeholder:text-text-light focus:border-primary dark:focus:border-darkmode-primary focus:ring-transparent dark:border-darkmode-border dark:bg-darkmode-light dark:text-darkmode-text-light;
}

@utility form-label {
  @apply mb-4 block font-secondary text-xl font-normal text-text-dark dark:text-darkmode-text-light;
}

@keyframes slide-up {
  from {
    transform: translateY(100%);
    opacity: 0;
  }
  to {
    transform: translateY(0);
    opacity: 1;
  }
}

.animate-slide-up {
  animation: slide-up 0.3s ease-out;
}
```

---

### File: `./src/tailwind-plugin/tw-bs-grid.js`

```javascript
import plugin from "tailwindcss/plugin";

module.exports = plugin.withOptions(() => {
  return ({ addComponents }) => {
    const gridColumns = 12;
    const gridGutterWidth = "1.5rem";
    const gridGutters = {
      0: "0",
      1: "0.25rem",
      2: "0.5rem",
      3: "1rem",
      4: "1.5rem",
      5: "3rem",
    };
    const respectImportant = true;
    const columns = Array.from({ length: gridColumns }, (_, i) => i + 1);
    const rowColsSteps = columns.slice(0, Math.floor(gridColumns / 2));

    addComponents(
      {
        ".row": {
          "--bs-gutter-x": gridGutterWidth,
          "--bs-gutter-y": 0,
          display: "flex",
          flexWrap: "wrap",
          marginTop: "calc(var(--bs-gutter-y) * -1)",
          marginRight: "calc(var(--bs-gutter-x) / -2)",
          marginLeft: "calc(var(--bs-gutter-x) / -2)",
          "& > *": {
            boxSizing: "border-box",
            flexShrink: 0,
            width: "100%",
            maxWidth: "100%",
            paddingRight: "calc(var(--bs-gutter-x) / 2)",
            paddingLeft: "calc(var(--bs-gutter-x) / 2)",
            marginTop: "var(--bs-gutter-y)",
          },
        },
      },
      { respectImportant },
    );

    addComponents(
      [
        {
          ".col": { flex: "1 0 0%" },
          ".row-cols-auto": { "& > *": { flex: "0 0 auto", width: "auto" } },
        },
        ...rowColsSteps.map((num) => ({
          [`.row-cols-${num}`]: {
            "& > *": { flex: "0 0 auto", width: `${100 / num}%` },
          },
        })),
        { ".col-auto": { flex: "0 0 auto", width: "auto" } },
        ...columns.map((num) => ({
          [`.col-${num}`]: {
            flex: "0 0 auto",
            width: `${(100 / gridColumns) * num}%`,
          },
        })),
      ],
      { respectImportant },
    );

    addComponents(
      [0, ...columns.slice(0, -1)].map((num) => ({
        [`.offset-${num}`]: { marginLeft: `${(100 / gridColumns) * num}%` },
      })),
      { respectImportant },
    );

    if (Object.keys(gridGutters).length) {
      const gutterComponents = Object.entries(gridGutters).reduce(
        (acc, [key, value]) => {
          acc[`.g-${key}`] = { "--bs-gutter-x": value, "--bs-gutter-y": value };
          acc[`.gx-${key}`] = { "--bs-gutter-x": value };
          acc[`.gy-${key}`] = { "--bs-gutter-y": value };
          return acc;
        },
        {},
      );
      addComponents(gutterComponents, { respectImportant });
    }

    addComponents(
      [
        {
          ".order-first": { order: "-1" },
          ".order-last": { order: gridColumns + 1 },
        },
        ...[0, ...columns].map((num) => ({
          [`.order-${num}`]: { order: String(num) },
        })),
      ],
      { respectImportant },
    );
  };
});
```

---

### File: `./src/tailwind-plugin/tw-theme.js`

```javascript
import plugin from "tailwindcss/plugin";
import themeConfig from "../config/theme.json";

const findFont = (fontStr) =>
  fontStr.replace(/\+/g, " ").replace(/:[^:]+/g, "");

const fontFamilies = Object.entries(themeConfig.fonts.font_family)
  .filter(([key]) => !key.includes("type"))
  .reduce((acc, [key, font]) => {
    acc[key] =
      `${findFont(font)}, ${themeConfig.fonts.font_family[`${key}_type`] || "sans-serif"}`;
    return acc;
  }, {});

const defaultColorGroups = [
  { colors: themeConfig.colors.default.theme_color, prefix: "" },
  { colors: themeConfig.colors.default.text_color, prefix: "" },
];
const darkColorGroups = [];
if (themeConfig.colors.darkmode?.theme_color) {
  darkColorGroups.push({
    colors: themeConfig.colors.darkmode.theme_color,
    prefix: "darkmode-",
  });
}
if (themeConfig.colors.darkmode?.text_color) {
  darkColorGroups.push({
    colors: themeConfig.colors.darkmode.text_color,
    prefix: "darkmode-",
  });
}

const getVars = (groups) => {
  const vars = {};
  groups.forEach(({ colors, prefix }) => {
    Object.entries(colors).forEach(([k, v]) => {
      const cssKey = k.replace(/_/g, "-");
      vars[`--color-${prefix}${cssKey}`] = v;
    });
  });
  return vars;
};

const defaultVars = getVars(defaultColorGroups);
const darkVars = getVars(darkColorGroups);

const baseSize = Number(themeConfig.fonts.font_size.base);
const scale = Number(themeConfig.fonts.font_size.scale);
const calculateFontSizes = (base, scale) => {
  const sizes = {};
  let currentSize = scale;
  for (let i = 6; i >= 1; i--) {
    sizes[`h${i}`] = `${currentSize}rem`;
    sizes[`h${i}-sm`] = `${currentSize * 0.9}rem`;
    currentSize *= scale;
  }
  sizes.base = `${base}px`;
  sizes["base-sm"] = `${base * 0.8}px`;
  return sizes;
};
const fontSizes = calculateFontSizes(baseSize, scale);

const fontVars = {};
Object.entries(fontSizes).forEach(([key, value]) => {
  fontVars[`--text-${key}`] = value;
});
Object.entries(fontFamilies).forEach(([key, font]) => {
  fontVars[`--font-${key}`] = font;
});

const baseVars = { ...fontVars, ...defaultVars };

const colorsMap = {};
[...defaultColorGroups, ...darkColorGroups].forEach(({ colors, prefix }) => {
  Object.entries(colors).forEach(([key]) => {
    const cssKey = key.replace(/_/g, "-");
    colorsMap[prefix + cssKey] = `var(--color-${prefix}${cssKey})`;
  });
});

module.exports = plugin.withOptions(() => {
  return function ({ addBase, addUtilities, matchUtilities }) {
    addBase({
      ":root": baseVars,
      ".dark": darkVars,
    });

    const fontUtils = {};
    Object.keys(fontFamilies).forEach((key) => {
      fontUtils[`.font-${key}`] = { fontFamily: `var(--font-${key})` };
    });
    Object.keys(fontSizes).forEach((key) => {
      fontUtils[`.text-${key}`] = { fontSize: `var(--text-${key})` };
    });
    addUtilities(fontUtils, {
      variants: ["responsive", "hover", "focus", "active", "disabled"],
    });

    matchUtilities(
      {
        bg: (value) => ({ backgroundColor: value }),
        text: (value) => ({ color: value }),
        border: (value) => ({ borderColor: value }),
        fill: (value) => ({ fill: value }),
        stroke: (value) => ({ stroke: value }),
      },
      { values: colorsMap, type: "color" },
    );

    matchUtilities(
      {
        from: (value) => ({
          "--tw-gradient-from": value,
          "--tw-gradient-via-stops":
            "var(--tw-gradient-via-stops, var(--tw-gradient-position), var(--tw-gradient-from) var(--tw-gradient-from-position), var(--tw-gradient-to) var(--tw-gradient-to-position))",
          "--tw-gradient-stops":
            "var(--tw-gradient-via-stops, var(--tw-gradient-position), var(--tw-gradient-from) var(--tw-gradient-from-position), var(--tw-gradient-to) var(--tw-gradient-to-position))",
        }),
        to: (value) => ({
          "--tw-gradient-to": value,
          "--tw-gradient-via-stops":
            "var(--tw-gradient-via-stops, var(--tw-gradient-position), var(--tw-gradient-from) var(--tw-gradient-from-position), var(--tw-gradient-to) var(--tw-gradient-to-position))",
          "--tw-gradient-stops":
            "var(--tw-gradient-via-stops, var(--tw-gradient-position), var(--tw-gradient-from) var(--tw-gradient-from-position), var(--tw-gradient-to) var(--tw-gradient-to-position))",
        }),
        via: (value) => ({
          "--tw-gradient-via": value,
          "--tw-gradient-via-stops":
            "var(--tw-gradient-position), var(--tw-gradient-from) var(--tw-gradient-from-position), var(--tw-gradient-via) var(--tw-gradient-via-position), var(--tw-gradient-to) var(--tw-gradient-to-position)",
        }),
      },
      { values: colorsMap, type: "color" },
    );
  };
});
```

---

### File: `./src/types/index.d.ts`

```typescript
export type Feature = {
  button: button;
  image: string;
  bulletpoints: string[];
  content: string;
  title: string;
};

export type Button = {
  enable: boolean;
  label: string;
  link: string;
};
```

---

## Direktori: public

### File: `./public/.htaccess`

```
##### Optimize default expiration time - BEGIN
<IfModule mod_expires.c>

  ## Enable expiration control
  ExpiresActive On

  ## CSS and JS expiration: 1 week after request
  ExpiresByType text/css "now plus 1 week"
  ExpiresByType application/javascript "now plus 1 week"
  ExpiresByType application/x-javascript "now plus 1 week"

  ## Image files expiration: 1 month after request
  ExpiresByType image/bmp "now plus 1 month"
  ExpiresByType image/gif "now plus 1 month"
  ExpiresByType image/jpeg "now plus 1 month"
  ExpiresByType image/webp "now plus 1 month"
  ExpiresByType image/jp2 "now plus 1 month"
  ExpiresByType image/pipeg "now plus 1 month"
  ExpiresByType image/png "now plus 1 month"
  ExpiresByType image/svg+xml "now plus 1 month"
  ExpiresByType image/tiff "now plus 1 month"
  ExpiresByType image/x-icon "now plus 1 month"
  ExpiresByType image/ico "now plus 1 month"
  ExpiresByType image/icon "now plus 1 month"
  ExpiresByType text/ico "now plus 1 month"
  ExpiresByType application/ico "now plus 1 month"
  ExpiresByType image/vnd.wap.wbmp "now plus 1 month"

  ## Font files expiration: 1 month after request
  ExpiresByType application/x-font-ttf "now plus 1 month"
  ExpiresByType application/x-font-opentype "now plus 1 month"
  ExpiresByType application/x-font-woff "now plus 1 month"
  ExpiresByType font/woff2 "now plus 1 month"
  ExpiresByType image/svg+xml "now plus 1 month"

  ## Audio files expiration: 1 month after request
  ExpiresByType audio/ogg "now plus 1 month"
  ExpiresByType application/ogg "now plus 1 month"
  ExpiresByType audio/basic "now plus 1 month"
  ExpiresByType audio/mid "now plus 1 month"
  ExpiresByType audio/midi "now plus 1 month"
  ExpiresByType audio/mpeg "now plus 1 month"
  ExpiresByType audio/mp3 "now plus 1 month"
  ExpiresByType audio/x-aiff "now plus 1 month"
  ExpiresByType audio/x-mpegurl "now plus 1 month"
  ExpiresByType audio/x-pn-realaudio "now plus 1 month"
  ExpiresByType audio/x-wav "now plus 1 month"

  ## Movie files expiration: 1 month after request
  ExpiresByType application/x-shockwave-flash "now plus 1 month"
  ExpiresByType x-world/x-vrml "now plus 1 month"
  ExpiresByType video/x-msvideo "now plus 1 month"
  ExpiresByType video/mpeg "now plus 1 month"
  ExpiresByType video/mp4 "now plus 1 month"
  ExpiresByType video/quicktime "now plus 1 month"
  ExpiresByType video/x-la-asf "now plus 1 month"
  ExpiresByType video/x-ms-asf "now plus 1 month"
</IfModule>
##### Optimize default expiration time - END

##### 1 Month for most static resources
<filesMatch ".(css|jpg|jpeg|png|webp|gif|js|ico|woff|woff2|eot|ttf)$">
  Header set Cache-Control "max-age=2592000, public"
</filesMatch>

##### Enable gzip compression for resources
<ifModule mod_gzip.c>
  mod_gzip_on Yes
  mod_gzip_dechunk Yes
  mod_gzip_item_include file .(html?|txt|css|js|php)$
  mod_gzip_item_include handler ^cgi-script$
  mod_gzip_item_include mime ^text/.*
  mod_gzip_item_include mime ^application/x-javascript.*
  mod_gzip_item_exclude mime ^image/.*
  mod_gzip_item_exclude rspheader ^Content-Encoding:.*gzip.*
</ifModule>

##### Or, compress certain file types by extension:
<FilesMatch ".(html|css|jpg|jpeg|webp|png|gif|js|ico)">
  SetOutputFilter DEFLATE
</FilesMatch>

##### Set Header Vary: Accept-Encoding
<IfModule mod_headers.c>
  <FilesMatch ".(js|css|xml|gz|html)$">
    Header append Vary: Accept-Encoding
  </FilesMatch>
</IfModule>
```

---

### File: `./public/api/admin.php`

```
<?php
session_start();
date_default_timezone_set('Asia/Jakarta');

// Proteksi
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('HTTP/1.1 403 Forbidden');
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
    exit;
}

$dbPath = __DIR__ . '/../../stats.db';

try {
    if (!class_exists('SQLite3')) {
        throw new Exception("SQLite3 driver not installed.");
    }

    $db = new SQLite3($dbPath);
    $action = $_GET['action'] ?? 'stats';

    // === HELPER: Format Tanggal Indonesia ===
    function formatTanggalIndo($timestamp)
    {
        try {
            $dt = new DateTime($timestamp, new DateTimeZone('UTC'));
            $dt->setTimezone(new DateTimeZone('Asia/Jakarta'));

            $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            $tgl = $dt->format('d');
            $bln = $bulan[(int)$dt->format('m')];
            $thn = $dt->format('Y');
            $jam = $dt->format('H:i');

            return "$tgl $bln $thn, $jam WIB";
        } catch (Exception $e) {
            return $timestamp;
        }
    }

    // === HELPER: Grafik Harian ===
    function getSafeDailyActivity($db, $table, $days = 30)
    {
        $data = [];
        for ($i = $days - 1; $i >= 0; $i--) {
            $date = date('Y-m-d', strtotime("-$i days"));
            $data[$date] = 0;
        }

        try {
            $check = $db->querySingle("SELECT count(*) FROM sqlite_master WHERE type='table' AND name='$table'");
            if (!$check) return $data;

            // Query Group by Date (WIB)
            $query = "SELECT substr(datetime(created_at, '+7 hours'), 1, 10) as date, COUNT(*) as count
                      FROM $table
                      WHERE created_at >= date('now', '-$days days', '-7 hours')
                      GROUP BY date";

            $res = $db->query($query);
            if ($res) {
                while ($row = $res->fetchArray(SQLITE3_ASSOC)) {
                    if (isset($data[$row['date']])) {
                        $data[$row['date']] = $row['count'];
                    }
                }
            }
        } catch (Exception $e) {
        }
        return $data;
    }

    if ($action === 'stats') {
        header('Content-Type: application/json');

        // 1. Overview Count
        $visits = $db->querySingle("SELECT value FROM global_stats WHERE key = 'site_visits'") ?: 0;

        $total_posts = 0;
        if ($db->querySingle("SELECT count(*) FROM sqlite_master WHERE type='table' AND name='post_stats'")) {
            $total_posts = $db->querySingle("SELECT COUNT(*) FROM post_stats") ?: 0;
        }

        $total_feedback = 0;
        $stars = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];
        if ($db->querySingle("SELECT count(*) FROM sqlite_master WHERE type='table' AND name='feedback'")) {
            $total_feedback = $db->querySingle("SELECT COUNT(*) FROM feedback") ?: 0;
            $resStar = $db->query("SELECT rating, COUNT(*) as count FROM feedback GROUP BY rating");
            while ($row = $resStar->fetchArray(SQLITE3_ASSOC)) {
                $stars[$row['rating']] = $row['count'];
            }
        }

        $total_survey = 0;
        $survey_avg = ['zi' => 0, 'service' => 0, 'academic' => 0];
        if ($db->querySingle("SELECT count(*) FROM sqlite_master WHERE type='table' AND name='survey_responses'")) {
            $total_survey = $db->querySingle("SELECT COUNT(*) FROM survey_responses") ?: 0;
            $avgQuery = $db->querySingle("SELECT AVG(score_zi) as zi, AVG(score_service) as service, AVG(score_academic) as academic FROM survey_responses", true);
            if ($avgQuery) {
                $survey_avg['zi'] = round($avgQuery['zi'] ?? 0, 2);
                $survey_avg['service'] = round($avgQuery['service'] ?? 0, 2);
                $survey_avg['academic'] = round($avgQuery['academic'] ?? 0, 2);
            }
        }

        // 4. Activity Trends (Real Data)
        $activity_feedback = getSafeDailyActivity($db, 'feedback');
        $activity_survey = getSafeDailyActivity($db, 'survey_responses');
        $activity_visits = getSafeDailyActivity($db, 'traffic_logs'); // [BARU] Data Kunjungan Harian

        // 5. Raw Data Tables
        $posts = [];
        if ($total_posts > 0) {
            $resPost = $db->query("SELECT slug, views FROM post_stats ORDER BY views DESC");
            while ($row = $resPost->fetchArray(SQLITE3_ASSOC)) $posts[] = $row;
        }

        $feedbacks = [];
        if ($total_feedback > 0) {
            $resFeed = $db->query("SELECT * FROM feedback ORDER BY created_at DESC");
            while ($row = $resFeed->fetchArray(SQLITE3_ASSOC)) $feedbacks[] = $row;
        }

        $surveys = [];
        if ($total_survey > 0) {
            $resSurv = $db->query("SELECT * FROM survey_responses ORDER BY created_at DESC");
            while ($row = $resSurv->fetchArray(SQLITE3_ASSOC)) $surveys[] = $row;
        }

        echo json_encode([
            'overview' => [
                'visits' => $visits,
                'posts_count' => $total_posts,
                'feedback_count' => $total_feedback,
                'survey_count' => $total_survey
            ],
            'charts' => [
                'stars' => $stars,
                'survey_avg' => $survey_avg,
                'activity' => [
                    'labels' => array_keys($activity_feedback),
                    'feedback' => array_values($activity_feedback),
                    'survey' => array_values($activity_survey),
                    'visits' => array_values($activity_visits) // [BARU] Kirim ke Frontend
                ]
            ],
            'tables' => [
                'posts' => $posts,
                'feedbacks' => $feedbacks,
                'surveys' => $surveys
            ]
        ]);
    }

    // === EXPORT CSV ===
    elseif ($action === 'export') {
        $type = $_GET['type'] ?? '';
        $filename = "laporan_{$type}_" . date('Y-m-d_His') . ".csv";

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $output = fopen('php://output', 'w');
        fprintf($output, chr(0xEF) . chr(0xBB) . chr(0xBF)); // BOM for Excel

        if ($type === 'feedback') {
            fputcsv($output, ['ID', 'Waktu (WIB)', 'Nama', 'Rating', 'Pesan', 'IP Address']);
            $res = $db->query("SELECT id, created_at, name, rating, message, ip_address FROM feedback ORDER BY created_at DESC");
            while ($row = $res->fetchArray(SQLITE3_ASSOC)) {
                $row['created_at'] = formatTanggalIndo($row['created_at']);
                fputcsv($output, $row);
            }
        } elseif ($type === 'survey') {
            fputcsv($output, ['ID', 'Waktu (WIB)', 'Nama', 'Peran', 'Skor ZI', 'Skor Pelayanan', 'Skor Akademik', 'Masukan', 'IP Address']);
            $res = $db->query("SELECT id, created_at, respondent_name, respondent_role, score_zi, score_service, score_academic, feedback, ip_address FROM survey_responses ORDER BY created_at DESC");
            while ($row = $res->fetchArray(SQLITE3_ASSOC)) {
                $row['created_at'] = formatTanggalIndo($row['created_at']);
                fputcsv($output, $row);
            }
        } elseif ($type === 'posts') {
            fputcsv($output, ['Judul Artikel / Slug', 'Jumlah Pembaca']);
            $res = $db->query("SELECT slug, views FROM post_stats ORDER BY views DESC");
            while ($row = $res->fetchArray(SQLITE3_ASSOC)) fputcsv($output, $row);
        }
        fclose($output);
        exit;
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}

```

---

### File: `./public/api/auth.php`

```
<?php
session_start();
header('Content-Type: application/json');
header('Cross-Origin-Opener-Policy: same-origin-allow-popups');
header('Referrer-Policy: no-referrer-when-downgrade');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET');

// Konfigurasi Email Admin (Hardcode untuk keamanan ganda atau ambil dari env jika server support)
$ALLOWED_EMAIL = 'dev.mtsn1pandeglang@gmail.com';

$action = $_GET['action'] ?? '';

if ($action === 'login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    $id_token = $data['credential'] ?? '';

    if (!$id_token) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Token tidak ditemukan']);
        exit;
    }

    // Verifikasi Token langsung ke Google (Tanpa Library Berat)
    $url = "https://oauth2.googleapis.com/tokeninfo?id_token=" . $id_token;
    $response = file_get_contents($url);

    if ($response) {
        $payload = json_decode($response, true);

        // Cek Email & Verified Email
        if (isset($payload['email']) && $payload['email_verified'] == 'true') {
            if ($payload['email'] === $ALLOWED_EMAIL) {
                // Login Sukses
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_email'] = $payload['email'];
                $_SESSION['admin_name'] = $payload['name'];
                $_SESSION['admin_picture'] = $payload['picture'];

                echo json_encode([
                    'status' => 'success',
                    'user' => [
                        'name' => $payload['name'],
                        'email' => $payload['email'],
                        'picture' => $payload['picture']
                    ]
                ]);
            } else {
                http_response_code(403);
                echo json_encode(['status' => 'error', 'message' => 'Akses ditolak. Email tidak terdaftar sebagai Admin.']);
            }
        } else {
            http_response_code(401);
            echo json_encode(['status' => 'error', 'message' => 'Token Google tidak valid.']);
        }
    } else {
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Gagal memverifikasi ke Google.']);
    }
} elseif ($action === 'check') {
    if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
        echo json_encode([
            'status' => 'authenticated',
            'user' => [
                'name' => $_SESSION['admin_name'],
                'email' => $_SESSION['admin_email'],
                'picture' => $_SESSION['admin_picture']
            ]
        ]);
    } else {
        echo json_encode(['status' => 'guest']);
    }
} elseif ($action === 'logout') {
    session_destroy();
    echo json_encode(['status' => 'success']);
}

```

---

### File: `./public/api/crud.php`

```
<?php
session_start();
header('Content-Type: application/json');

// 1. Cek Login Admin
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    http_response_code(403);
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
    exit;
}

$dbPath = __DIR__ . '/../../stats.db';

try {
    if (!class_exists('SQLite3')) {
        throw new Exception("SQLite3 driver not installed.");
    }

    $db = new SQLite3($dbPath);

    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    $action = $_GET['action'] ?? '';

    if ($action === 'delete') {
        $type = $data['type'] ?? '';

        // UPDATE: Mendukung single ID atau multiple IDs
        $ids = [];
        if (isset($data['ids']) && is_array($data['ids'])) {
            $ids = $data['ids'];
        } elseif (isset($data['id'])) {
            $ids = [$data['id']];
        }

        if (empty($ids)) throw new Exception("Tidak ada data yang dipilih.");

        // Validasi Tipe Tabel
        $table = '';
        if ($type === 'feedback') {
            $table = 'feedback';
        } elseif ($type === 'survey') {
            $table = 'survey_responses';
        } else {
            throw new Exception("Tipe data tidak dikenal.");
        }

        // Sanitasi ID menjadi integer semua
        $sanitized_ids = array_map('intval', $ids);
        $ids_string = implode(',', $sanitized_ids);

        // Eksekusi Bulk Delete
        // Query: DELETE FROM table WHERE id IN (1, 2, 3)
        $query = "DELETE FROM $table WHERE id IN ($ids_string)";

        if ($db->exec($query)) {
            $count = $db->changes();
            echo json_encode(['status' => 'success', 'message' => "$count data berhasil dihapus."]);
        } else {
            throw new Exception("Gagal menghapus data.");
        }
    } else {
        throw new Exception("Action tidak valid.");
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}

```

---

### File: `./public/api/feedback.php`

```
<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');

$dbPath = __DIR__ . '/../../stats.db';

function getClientIP()
{
    // Handle IP jika di belakang proxy/Cloudflare
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) return $_SERVER['HTTP_CLIENT_IP'];
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) return $_SERVER['HTTP_X_FORWARDED_FOR'];
    return $_SERVER['REMOTE_ADDR'];
}

try {
    if (!class_exists('SQLite3')) {
        throw new Exception("SQLite3 driver not installed.");
    }

    $db = new SQLite3($dbPath);
    $ip_address = getClientIP();

    // 1. Update Struktur Tabel (Menambahkan kolom ip_address jika belum ada)
    // Kita cek dulu apakah kolom sudah ada, cara simpel: coba query dummy
    $checkTable = $db->querySingle("SELECT count(*) FROM sqlite_master WHERE type='table' AND name='feedback'");
    if ($checkTable) {
        $cols = $db->query("PRAGMA table_info(feedback)");
        $hasIpCol = false;
        while ($row = $cols->fetchArray()) {
            if ($row['name'] === 'ip_address') $hasIpCol = true;
        }
        if (!$hasIpCol) {
            $db->exec("ALTER TABLE feedback ADD COLUMN ip_address TEXT");
        }
    } else {
        $query = "CREATE TABLE IF NOT EXISTS feedback (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT,
            rating INTEGER NOT NULL,
            message TEXT,
            ip_address TEXT,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )";
        $db->exec($query);
    }

    // Fungsi Helper untuk ambil stats
    function getStats($db)
    {
        $row = $db->querySingle("SELECT AVG(rating) as average, COUNT(*) as total FROM feedback", true);
        return [
            'average' => round($row['average'] ?? 0, 1),
            'total' => $row['total'] ?? 0
        ];
    }

    // 2. Handle POST (Submit Data)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Cek apakah IP sudah pernah submit
        $checkIp = $db->prepare("SELECT id FROM feedback WHERE ip_address = :ip");
        $checkIp->bindValue(':ip', $ip_address, SQLITE3_TEXT);
        $res = $checkIp->execute();

        if ($res->fetchArray()) {
            echo json_encode(['status' => 'error', 'message' => 'Anda sudah memberikan penilaian sebelumnya.']);
            exit;
        }

        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if (!isset($data['rating'])) throw new Exception("Rating wajib diisi.");

        $name = isset($data['name']) ? htmlspecialchars(strip_tags($data['name'])) : 'Anonim';
        $rating = (int)$data['rating'];
        $message = isset($data['message']) ? htmlspecialchars(strip_tags($data['message'])) : '';

        $stmt = $db->prepare("INSERT INTO feedback (name, rating, message, ip_address) VALUES (:name, :rating, :message, :ip)");
        $stmt->bindValue(':name', $name, SQLITE3_TEXT);
        $stmt->bindValue(':rating', $rating, SQLITE3_INTEGER);
        $stmt->bindValue(':message', $message, SQLITE3_TEXT);
        $stmt->bindValue(':ip', $ip_address, SQLITE3_TEXT);

        if ($stmt->execute()) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Terima kasih atas penilaian Anda!',
                'stats' => getStats($db)
            ]);
        } else {
            throw new Exception("Gagal menyimpan data.");
        }
    }
    // 3. Handle GET (Cek Status IP & Ambil Stats)
    else {
        $checkIp = $db->prepare("SELECT id FROM feedback WHERE ip_address = :ip");
        $checkIp->bindValue(':ip', $ip_address, SQLITE3_TEXT);
        $res = $checkIp->execute();
        $hasSubmitted = ($res->fetchArray()) ? true : false;

        echo json_encode([
            'status' => 'ready',
            'has_submitted' => $hasSubmitted,
            'stats' => getStats($db)
        ]);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}

```

---

### File: `./public/api/import.php`

```
<?php
session_start();
// Matikan display error agar tidak merusak JSON (PENTING)
ini_set('display_errors', 0);
ini_set('log_errors', 1);
header('Content-Type: application/json');

try {
    // 1. Cek Login Admin
    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        throw new Exception("Unauthorized access.");
    }

    // 2. Koneksi Database
    $dbPath = __DIR__ . '/../../stats.db';

    // Cek Permission File
    if (file_exists($dbPath) && !is_writable($dbPath)) {
        throw new Exception("File database terkunci (Permission Denied). Mohon cek izin file stats.db");
    }

    // Cek Permission Folder (untuk file .wal)
    if (!is_writable(dirname($dbPath))) {
        throw new Exception("Folder database terkunci. Mohon cek izin folder root.");
    }

    $db = new SQLite3($dbPath);
    $db->busyTimeout(5000);

    $action = $_GET['action'] ?? '';

    // === ACTION: IMPORT ===
    if ($action === 'import' && $_SERVER['REQUEST_METHOD'] === 'POST') {

        if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
            throw new Exception("Upload failed with error code: " . ($_FILES['file']['error'] ?? 'Unknown'));
        }

        $type = $_POST['type'] ?? '';
        $fileTmpPath = $_FILES['file']['tmp_name'];

        // Baca CSV
        ini_set('auto_detect_line_endings', true);
        $handle = fopen($fileTmpPath, "r");
        if (!$handle) throw new Exception("Tidak bisa membaca file temporary.");

        // Skip Header
        fgetcsv($handle, 1000, ",");

        $successCount = 0;
        $db->exec('BEGIN TRANSACTION');

        try {
            if ($type === 'feedback') {
                // Cek kolom ip_address secara dinamis
                $resCols = $db->query("PRAGMA table_info(feedback)");
                $hasIp = false;
                while ($col = $resCols->fetchArray()) {
                    if ($col['name'] === 'ip_address') $hasIp = true;
                }

                // Query Adaptif
                $fields = ['name', 'rating', 'message', 'created_at'];
                $params = [':name', ':rating', ':message', ':created_at'];

                if ($hasIp) {
                    $fields[] = 'ip_address';
                    $params[] = ':ip_address';
                }

                $sql = "INSERT INTO feedback (" . implode(',', $fields) . ") VALUES (" . implode(',', $params) . ")";
                $stmt = $db->prepare($sql);

                while (($data = fgetcsv($handle, 2000, ",")) !== FALSE) {
                    $data = array_map('trim', $data);
                    if (count($data) < 2) continue;

                    $stmt->bindValue(':name', $data[0] ?: 'Anonim', SQLITE3_TEXT);
                    $stmt->bindValue(':rating', max(1, min(5, (int)($data[1] ?? 5))), SQLITE3_INTEGER);
                    $stmt->bindValue(':message', $data[2] ?? '', SQLITE3_TEXT);
                    $stmt->bindValue(':created_at', $data[3] ?: date('Y-m-d H:i:s'), SQLITE3_TEXT);
                    if ($hasIp) $stmt->bindValue(':ip_address', $data[4] ?? '127.0.0.1', SQLITE3_TEXT);

                    $stmt->execute();
                    $successCount++;
                }
            } elseif ($type === 'survey') {
                // Cek kolom dinamis
                $resCols = $db->query("PRAGMA table_info(survey_responses)");
                $cols = [];
                while ($col = $resCols->fetchArray()) {
                    $cols[] = $col['name'];
                }

                $hasIp = in_array('ip_address', $cols);
                $hasJson = in_array('details_json', $cols);

                // Build query
                $fields = ['respondent_name', 'respondent_role', 'score_zi', 'score_service', 'score_academic', 'feedback', 'created_at'];
                $params = [':name', ':role', ':zi', ':service', ':acad', ':feedback', ':created'];

                if ($hasIp) {
                    $fields[] = 'ip_address';
                    $params[] = ':ip';
                }
                if ($hasJson) {
                    $fields[] = 'details_json';
                    $params[] = ':json';
                }

                $sql = "INSERT INTO survey_responses (" . implode(',', $fields) . ") VALUES (" . implode(',', $params) . ")";
                $stmt = $db->prepare($sql);

                while (($data = fgetcsv($handle, 2000, ",")) !== FALSE) {
                    $data = array_map('trim', $data);
                    if (count($data) < 5) continue;

                    $stmt->bindValue(':name', $data[0] ?: 'Anonim', SQLITE3_TEXT);
                    $stmt->bindValue(':role', $data[1] ?: 'Umum', SQLITE3_TEXT);
                    $stmt->bindValue(':zi', (float)($data[2] ?? 0), SQLITE3_FLOAT);
                    $stmt->bindValue(':service', (float)($data[3] ?? 0), SQLITE3_FLOAT);
                    $stmt->bindValue(':acad', (float)($data[4] ?? 0), SQLITE3_FLOAT);
                    $stmt->bindValue(':feedback', $data[5] ?? '', SQLITE3_TEXT);
                    $stmt->bindValue(':created', $data[6] ?: date('Y-m-d H:i:s'), SQLITE3_TEXT);

                    if ($hasIp) $stmt->bindValue(':ip', $data[7] ?? '127.0.0.1', SQLITE3_TEXT);
                    if ($hasJson) $stmt->bindValue(':json', '{}', SQLITE3_TEXT);

                    $stmt->execute();
                    $successCount++;
                }
            }

            $db->exec('COMMIT');
            fclose($handle);
            echo json_encode(['status' => 'success', 'message' => "Sukses import $successCount data."]);
        } catch (Exception $ex) {
            $db->exec('ROLLBACK');
            throw $ex;
        }
    }
    // === ACTION: TEMPLATE ===
    elseif ($action === 'template') {
        $type = $_GET['type'] ?? 'feedback';
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="template_' . $type . '.csv"');
        $out = fopen('php://output', 'w');
        fprintf($out, chr(0xEF) . chr(0xBB) . chr(0xBF)); // BOM

        if ($type === 'feedback') {
            fputcsv($out, ['name', 'rating', 'message', 'created_at', 'ip_address']);
            fputcsv($out, ['Budi', '5', 'Mantap', date('Y-m-d H:i:s'), '127.0.0.1']);
        } else {
            fputcsv($out, ['respondent_name', 'respondent_role', 'score_zi', 'score_service', 'score_academic', 'feedback', 'created_at', 'ip_address']);
            fputcsv($out, ['Siti', 'Wali Murid', '5', '4', '5', 'Oke', date('Y-m-d H:i:s'), '127.0.0.1']);
        }
        fclose($out);
    } else {
        throw new Exception("Invalid Action");
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}

```

---

### File: `./public/api/print_pdf.php`

```
<?php
// Matikan display error
ini_set('display_errors', 0);
ini_set('log_errors', 1);

session_start();
date_default_timezone_set('Asia/Jakarta');

// 1. Cek Login
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    die("Akses Ditolak. Silakan Login.");
}

// 2. Cek Library
$libPath = __DIR__ . '/lib/fpdf.php';
if (!file_exists($libPath)) {
    die("ERROR: Library FPDF tidak ditemukan. Pastikan file uploaded di public/api/lib/fpdf.php");
}
require($libPath);

// 3. Database
$dbPath = __DIR__ . '/../../stats.db';
try {
    $db = new SQLite3($dbPath);
} catch (Exception $e) {
    die("Error DB: " . $e->getMessage());
}

// 4. Parameter
$month = isset($_GET['month']) ? (int)$_GET['month'] : (int)date('m');
$year = isset($_GET['year']) ? (int)$_GET['year'] : (int)date('Y');
$bulanIndo = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
$periodeText = strtoupper($bulanIndo[$month] . ' ' . $year);

// 5. Helpers
function getIndonesianDate($timestamp = null)
{
    $dt = new DateTime($timestamp ?? 'now');
    $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    return $dt->format('d') . ' ' . $bulan[(int)$dt->format('m')] . ' ' . $dt->format('Y');
}
function formatFullTime($timestamp)
{
    return getIndonesianDate($timestamp) . ' ' . date('H:i', strtotime($timestamp)) . ' WIB';
}

// 6. PDF Class
class PDF extends FPDF
{
    var $widths;
    var $aligns;
    function SetWidths($w)
    {
        $this->widths = $w;
    }
    function SetAligns($a)
    {
        $this->aligns = $a;
    }

    function ImageRemote($url, $x, $y, $w, $h)
    {
        $tmpFile = sys_get_temp_dir() . '/qr_' . md5($url) . '.png';
        if (!file_exists($tmpFile) || filesize($tmpFile) == 0) {
            $ch = curl_init($url);
            $fp = fopen($tmpFile, 'wb');
            curl_setopt($ch, CURLOPT_FILE, $fp);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_exec($ch);
            curl_close($ch);
            fclose($fp);
        }
        if (file_exists($tmpFile) && filesize($tmpFile) > 0) $this->Image($tmpFile, $x, $y, $w, $h);
    }

    function Header()
    {
        $path = '../images/instansi/';
        $logoSize = 24;
        if (file_exists($path . 'logo-institusi.png')) $this->Image($path . 'logo-institusi.png', 10, 10, $logoSize);
        if (file_exists($path . 'logo-instansi.png')) $this->Image($path . 'logo-instansi.png', 176, 10, $logoSize);
        $this->SetY(12);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 5, 'KEMENTERIAN AGAMA REPUBLIK INDONESIA', 0, 1, 'C');
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 6, 'KANTOR KEMENTERIAN AGAMA KABUPATEN PANDEGLANG', 0, 1, 'C');
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 6, 'MADRASAH TSANAWIYAH NEGERI 1 PANDEGLANG', 0, 1, 'C');
        $this->SetFont('Arial', '', 9);
        $this->Cell(0, 4, 'Jl. Raya Labuan Km. 5,7 Palurahan, Kaduhejo, Pandeglang - Banten 42253', 0, 1, 'C');
        $this->Cell(0, 4, 'Website: https://mtsn1pandeglang.sch.id | Email: adm@mtsn1pandeglang.sch.id', 0, 1, 'C');
        $this->SetLineWidth(0.5);
        $this->Line(10, 39, 200, 39);
        $this->SetLineWidth(0.2);
        $this->Line(10, 40, 200, 40);
        $this->Ln(6);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Hal ' . $this->PageNo() . '/{nb} | Sistem Informasi MTsN 1 Pandeglang | Dicetak: ' . date('d/m/Y H:i') . ' WIB', 0, 0, 'C');
    }

    function Row($data, $fill = false)
    {
        $nb = 0;
        for ($i = 0; $i < count($data); $i++) $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        $h = 5 * $nb;
        $this->CheckPageBreak($h);
        for ($i = 0; $i < count($data); $i++) {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            $x = $this->GetX();
            $y = $this->GetY();
            $this->Rect($x, $y, $w, $h, $fill ? 'DF' : 'D');
            $this->MultiCell($w, 5, $data[$i], 0, $a);
            $this->SetXY($x + $w, $y);
        }
        $this->Ln($h);
    }
    function CheckPageBreak($h)
    {
        if ($this->GetY() + $h > $this->PageBreakTrigger) $this->AddPage($this->CurOrientation);
    }
    function NbLines($w, $txt)
    {
        $cw = &$this->CurrentFont['cw'];
        if ($w == 0) $w = $this->w - $this->rMargin - $this->x;
        $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
        $s = str_replace("\r", '', $txt);
        $nb = strlen($s);
        if ($nb > 0 && $s[$nb - 1] == "\n") $nb--;
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $nl = 1;
        while ($i < $nb) {
            $c = $s[$i];
            if ($c == "\n") {
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
                continue;
            }
            if ($c == ' ') $sep = $i;
            $l += $cw[$c];
            if ($l > $wmax) {
                if ($sep == -1) {
                    if ($i == $j) $i++;
                } else $i = $sep + 1;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
            } else $i++;
        }
        return $nl;
    }
}

// MAIN SCRIPT
try {
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->SetMargins(10, 10, 10);
    $pdf->AddPage();

    $m = str_pad($month, 2, '0', STR_PAD_LEFT);
    $y = $year;

    $visits = $db->querySingle("SELECT value FROM global_stats WHERE key = 'site_visits'") ?: 0;
    $feedbackCount = $db->querySingle("SELECT COUNT(*) FROM feedback WHERE strftime('%m', created_at) = '$m' AND strftime('%Y', created_at) = '$y'") ?: 0;
    $surveyCount = $db->querySingle("SELECT COUNT(*) FROM survey_responses WHERE strftime('%m', created_at) = '$m' AND strftime('%Y', created_at) = '$y'") ?: 0;
    $articleViews = $db->querySingle("SELECT SUM(views) FROM post_stats") ?: 0;

    $indices = $db->querySingle("SELECT AVG(score_zi) as zi, AVG(score_service) as service, AVG(score_academic) as academic FROM survey_responses WHERE strftime('%m', created_at) = '$m' AND strftime('%Y', created_at) = '$y'", true);
    $idxZI = $indices ? round($indices['zi'] ?? 0, 2) : 0;
    $idxService = $indices ? round($indices['service'] ?? 0, 2) : 0;
    $idxAcademic = $indices ? round($indices['academic'] ?? 0, 2) : 0;
    $ikmValue = ($surveyCount > 0) ? round(($idxZI + $idxService + $idxAcademic) / 3, 2) : 0;

    $avgRatingRaw = $db->querySingle("SELECT AVG(rating) FROM feedback WHERE strftime('%m', created_at) = '$m' AND strftime('%Y', created_at) = '$y'");
    $avgRatingVal = $avgRatingRaw ? round($avgRatingRaw, 2) : 0;
    $avgRatingText = ($avgRatingVal > 0) ? "$avgRatingVal / 5.00" : "-";

    function getPredikat($val)
    {
        if ($val >= 4.5) return "Sangat Baik (A)";
        if ($val >= 4.0) return "Baik (B)";
        if ($val >= 3.0) return "Cukup (C)";
        if ($val > 0) return "Kurang (D)";
        return "-";
    }
    $ikmText = ($ikmValue > 0) ? "$ikmValue / 5.00 (" . getPredikat($ikmValue) . ")" : "-";

    // Header Laporan
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 6, 'LAPORAN REKAPITULASI PELAYANAN DIGITAL', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 5, 'Periode Laporan: ' . $periodeText, 0, 1, 'C');
    $pdf->Ln(5);

    // TABEL 1: RINGKASAN TRAFIK (Kiri) & QR (Kanan)
    $startX = 10;
    $startY = $pdf->GetY();
    $rowH = 7;
    $wQR = 35;
    $wTable1 = 155;

    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetFillColor(230, 230, 230);
    $pdf->Cell($wTable1, $rowH, ' I. RINGKASAN TRAFIK WEBSITE', 1, 0, 'L', true);

    $pdf->Cell($wQR, $rowH * 4, '', 1, 0, 'C');
    $qrContent = urlencode("MTSN1PDG|{$m}/{$y}|V:{$visits}|A:{$articleViews}|S:{$surveyCount}|F:{$feedbackCount}|IKM:{$ikmValue}");
    $qrUrl = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={$qrContent}&bgcolor=ffffff";
    $pdf->ImageRemote($qrUrl, ($startX + $wTable1) + 5.5, $startY + 2, 24, 24);
    $pdf->Ln($rowH);

    $wLabel = 65;
    $wValue = 90;
    $pdf->SetFont('Arial', '', 9);
    $pdf->SetFillColor(250, 250, 250);
    $pdf->Cell($wLabel, $rowH, ' Bulan Pelaporan', 1, 0, 'L', true);
    $pdf->Cell($wValue, $rowH, '  ' . $periodeText, 1, 1, 'L');
    $pdf->Cell($wLabel, $rowH, ' Total Kunjungan', 1, 0, 'L', true);
    $pdf->Cell($wValue, $rowH, '  ' . number_format($visits) . ' Pengunjung', 1, 1, 'L');
    $pdf->Cell($wLabel, $rowH, ' Total Artikel Dibaca', 1, 0, 'L', true);
    $pdf->Cell($wValue, $rowH, '  ' . number_format($articleViews) . ' Kali Dibaca', 1, 1, 'L');
    $pdf->Ln(5);

    // TABEL 2: KUALITAS PELAYANAN (5 Baris Total)
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetFillColor(230, 230, 230);
    $pdf->Cell(190, $rowH, ' II. KUALITAS PELAYANAN & PARTISIPASI PUBLIK', 1, 1, 'L', true);

    $pdf->SetFont('Arial', '', 9);
    $pdf->SetFillColor(250, 250, 250);
    $wL = 50;
    $wV = 45;

    // Baris 2 (Partisipasi - Split)
    $pdf->Cell($wL, $rowH, ' Jumlah Responden Survei', 1, 0, 'L', true);
    $pdf->Cell($wV, $rowH, ' ' . number_format($surveyCount) . ' Orang', 1, 0, 'L');
    $pdf->Cell($wL, $rowH, ' Jumlah Ulasan Masuk', 1, 0, 'L', true);
    $pdf->Cell($wV, $rowH, ' ' . number_format($feedbackCount) . ' Pesan', 1, 1, 'L');

    // Baris 3 (Rincian Indeks - Split 3)
    $wSub = 190 / 3;
    $pdf->Cell($wSub, $rowH, ' Indeks ZI: ' . ($idxZI > 0 ? $idxZI : '-'), 1, 0, 'C', true);
    $pdf->Cell($wSub, $rowH, ' Indeks Layanan: ' . ($idxService > 0 ? $idxService : '-'), 1, 0, 'C', true);
    $pdf->Cell($wSub, $rowH, ' Indeks Akademik: ' . ($idxAcademic > 0 ? $idxAcademic : '-'), 1, 1, 'C', true);

    // Baris 4 (Rating Ulasan - Full)
    $pdf->Cell(70, $rowH, ' Rata-rata Rating Ulasan', 1, 0, 'L', true);
    $pdf->Cell(120, $rowH, ' ' . $avgRatingText, 1, 1, 'L');

    // Baris 5 (IKM Total - Full Highlight)
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetFillColor(240, 240, 240);
    $pdf->Cell(70, $rowH, ' Indeks Kepuasan Masy. (IKM)', 1, 0, 'L', true);
    $pdf->Cell(120, $rowH, ' ' . $ikmText, 1, 1, 'L', true);
    $pdf->Ln(8);

    // Detail Tables
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(0, 7, 'A. DATA DETAIL SURVEI KEPUASAN', 0, 1, 'L');
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->SetFillColor(0, 150, 100);
    $pdf->SetTextColor(255);
    $pdf->Cell(8, 7, 'No', 1, 0, 'C', true);
    $pdf->Cell(35, 7, 'Waktu', 1, 0, 'C', true);
    $pdf->Cell(40, 7, 'Responden', 1, 0, 'L', true);
    $pdf->Cell(14, 7, 'ZI', 1, 0, 'C', true);
    $pdf->Cell(14, 7, 'LYN', 1, 0, 'C', true);
    $pdf->Cell(14, 7, 'AKD', 1, 0, 'C', true);
    $pdf->Cell(14, 7, 'IDX', 1, 0, 'C', true);
    $pdf->Cell(51, 7, 'Masukan', 1, 1, 'L', true);
    $pdf->SetTextColor(0);
    $pdf->SetFont('Arial', '', 8);
    $pdf->SetWidths([8, 35, 40, 14, 14, 14, 14, 51]);
    $pdf->SetAligns(['C', 'C', 'L', 'C', 'C', 'C', 'C', 'L']);

    $resSurv = $db->query("SELECT * FROM survey_responses WHERE strftime('%m', created_at) = '$m' AND strftime('%Y', created_at) = '$y' ORDER BY created_at DESC");
    $no = 1;
    $found1 = false;
    while ($row = $resSurv->fetchArray(SQLITE3_ASSOC)) {
        $found1 = true;
        $idx = round(($row['score_zi'] + $row['score_service'] + $row['score_academic']) / 3, 2);
        $pdf->Row([$no++, formatFullTime($row['created_at']), $row['respondent_name'] . "\n(" . $row['respondent_role'] . ")", $row['score_zi'], $row['score_service'], $row['score_academic'], $idx, $row['feedback'] ?: '-']);
    }
    if (!$found1) $pdf->Cell(190, 8, 'Tidak ada data.', 1, 1, 'C');
    $pdf->Ln(6);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(0, 7, 'B. DATA DETAIL ULASAN MASUK', 0, 1, 'L');
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->SetFillColor(255, 193, 7);
    $pdf->SetTextColor(0);
    $pdf->Cell(8, 7, 'No', 1, 0, 'C', true);
    $pdf->Cell(35, 7, 'Waktu', 1, 0, 'C', true);
    $pdf->Cell(45, 7, 'Nama', 1, 0, 'L', true);
    $pdf->Cell(20, 7, 'Rating', 1, 0, 'C', true);
    $pdf->Cell(82, 7, 'Pesan', 1, 1, 'L', true);
    $pdf->SetFont('Arial', '', 8);
    $pdf->SetWidths([8, 35, 45, 20, 82]);
    $pdf->SetAligns(['C', 'C', 'L', 'C', 'L']);

    $resFeed = $db->query("SELECT * FROM feedback WHERE strftime('%m', created_at) = '$m' AND strftime('%Y', created_at) = '$y' ORDER BY created_at DESC");
    $no = 1;
    $found2 = false;
    while ($row = $resFeed->fetchArray(SQLITE3_ASSOC)) {
        $found2 = true;
        $pdf->Row([$no++, formatFullTime($row['created_at']), $row['name'] ?: 'Anonim', $row['rating'] . ' / 5', $row['message'] ?: '-']);
    }
    if (!$found2) $pdf->Cell(190, 8, 'Tidak ada data.', 1, 1, 'C');

    // TTE
    $pdf->AddPage();
    $pdf->Ln(5);
    $path = '../images/instansi/';
    $tglCetak = getIndonesianDate();
    $qrSize = 18;
    $yStart = $pdf->GetY();
    $pdf->SetXY(120, $yStart);
    $pdf->SetFont('Arial', '', 11);
    $pdf->Cell(70, 5, 'Pandeglang, ' . $tglCetak, 0, 1, 'C');
    $pdf->Ln(5);
    $yJabatan = $pdf->GetY();
    $pdf->SetXY(20, $yJabatan);
    $pdf->Cell(70, 5, 'Kepala Tata Usaha,', 0, 0, 'C');
    $pdf->SetXY(120, $yJabatan);
    $pdf->Cell(70, 5, 'Koordinator Tim Pusdatin,', 0, 1, 'C');
    $yImage = $pdf->GetY() + 1;
    if (file_exists($path . 'tte-kepala-tata-usaha.png')) $pdf->Image($path . 'tte-kepala-tata-usaha.png', 46, $yImage, $qrSize);
    if (file_exists($path . 'tte-koordinator-tim-pusdatin.png')) $pdf->Image($path . 'tte-koordinator-tim-pusdatin.png', 146, $yImage, $qrSize);
    $pdf->SetY($yImage + 19);
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->SetX(20);
    $pdf->Cell(70, 5, "UMAR MU'TAMAR, S.Ag.", 0, 0, 'C');
    $pdf->SetX(120);
    $pdf->Cell(70, 5, 'YAHYA ZULFIKRI', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetX(20);
    $pdf->Cell(70, 4, 'NIP. 196903061998031004', 0, 0, 'C');
    $pdf->SetX(120);
    $pdf->Cell(70, 4, 'NIP. 200001142025211016', 0, 1, 'C');
    $pdf->Ln(8);
    $pdf->SetFont('Arial', '', 11);
    $pdf->Cell(0, 5, 'Mengetahui,', 0, 1, 'C');
    $pdf->Cell(0, 5, 'Kepala Madrasah,', 0, 1, 'C');
    $yImageKamad = $pdf->GetY() + 1;
    if (file_exists($path . 'tte-kepala-madrasah.png')) $pdf->Image($path . 'tte-kepala-madrasah.png', 96, $yImageKamad, $qrSize);
    $pdf->SetY($yImageKamad + 19);
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(0, 5, 'H. EMAN SULAIMAN, S.Ag., M.Pd.', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 4, 'NIP. 197006032000031002', 0, 1, 'C');

    $pdf->Output('I', 'Laporan_Statistik_Website_' . $month . '_' . $year . '.pdf');
} catch (Exception $e) {
    die("PDF Error: " . $e->getMessage());
}

```

---

### File: `./public/api/stats.php`

```
<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: https://mtsn1pandeglang.sch.id');
header('Access-Control-Allow-Methods: GET, POST');
session_start();
date_default_timezone_set('Asia/Jakarta');

$dbPath = __DIR__ . '/../../stats.db';

try {
    if (!class_exists('SQLite3')) {
        throw new Exception("SQLite3 driver not installed on PHP");
    }
    $db = new SQLite3($dbPath);

    // Tabel Akumulasi (Lama - Tetap dipakai untuk counter total cepat)
    $db->exec("CREATE TABLE IF NOT EXISTS global_stats (key TEXT PRIMARY KEY, value INTEGER DEFAULT 0)");
    $db->exec("INSERT OR IGNORE INTO global_stats (key, value) VALUES ('site_visits', 0)");

    // Tabel Statistik Artikel
    $db->exec("CREATE TABLE IF NOT EXISTS post_stats (slug TEXT PRIMARY KEY, views INTEGER DEFAULT 0)");

    // [BARU] Tabel Log Trafik Harian (Untuk Grafik Real)
    $db->exec("CREATE TABLE IF NOT EXISTS traffic_logs (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        ip_address TEXT,
        user_agent TEXT,
        endpoint TEXT,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

    $action = $_GET['action'] ?? '';
    $slug   = $_GET['slug'] ?? '';
    $method = $_SERVER['REQUEST_METHOD'];

    $response = ['value' => 0];

    // === LOGIKA HITUNG KUNJUNGAN ===
    if ($action === 'visit') {
        if ($method === 'POST') {
            if (!isset($_SESSION['has_visited_site'])) {
                // 1. Update Total Counter (Global)
                $db->exec("UPDATE global_stats SET value = value + 1 WHERE key = 'site_visits'");

                // 2. [BARU] Insert Log Harian (Detail)
                $stmt = $db->prepare("INSERT INTO traffic_logs (ip_address, user_agent, endpoint) VALUES (:ip, :ua, 'home')");
                $stmt->bindValue(':ip', $_SERVER['REMOTE_ADDR'], SQLITE3_TEXT);
                $stmt->bindValue(':ua', $_SERVER['HTTP_USER_AGENT'] ?? '', SQLITE3_TEXT);
                $stmt->execute();

                $_SESSION['has_visited_site'] = true;
            }
        }
        $result = $db->querySingle("SELECT value FROM global_stats WHERE key = 'site_visits'");
        $response['value'] = $result ? $result : 0;
    }
    // === LOGIKA HITUNG ARTIKEL ===
    elseif ($action === 'view' && !empty($slug)) {
        $slug = preg_replace('/[^a-zA-Z0-9_-]/', '', $slug);
        $sessionKey = 'viewed_' . $slug;

        if ($method === 'POST') {
            if (!isset($_SESSION[$sessionKey])) {
                $stmt = $db->prepare("INSERT INTO post_stats (slug, views) VALUES (:slug, 1) ON CONFLICT(slug) DO UPDATE SET views = views + 1");
                $stmt->bindValue(':slug', $slug, SQLITE3_TEXT);
                $stmt->execute();
                $_SESSION[$sessionKey] = true;
            }
        }
        $stmt = $db->prepare("SELECT views FROM post_stats WHERE slug = :slug");
        $stmt->bindValue(':slug', $slug, SQLITE3_TEXT);
        $result = $stmt->execute();
        $row = $result->fetchArray(SQLITE3_ASSOC);
        $response['value'] = $row ? $row['views'] : 0;
    }
    echo json_encode($response);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}

```

---

### File: `./public/api/survey.php`

```
<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');

$dbPath = __DIR__ . '/../../stats.db';

function getClientIP()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) return $_SERVER['HTTP_CLIENT_IP'];
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) return $_SERVER['HTTP_X_FORWARDED_FOR'];
    return $_SERVER['REMOTE_ADDR'];
}

try {
    if (!class_exists('SQLite3')) {
        throw new Exception("SQLite3 driver not installed.");
    }

    $db = new SQLite3($dbPath);
    $ip_address = getClientIP();

    // 1. Update Struktur Tabel (Add ip_address)
    $checkTable = $db->querySingle("SELECT count(*) FROM sqlite_master WHERE type='table' AND name='survey_responses'");
    if ($checkTable) {
        $cols = $db->query("PRAGMA table_info(survey_responses)");
        $hasIpCol = false;
        while ($row = $cols->fetchArray()) {
            if ($row['name'] === 'ip_address') $hasIpCol = true;
        }
        if (!$hasIpCol) {
            $db->exec("ALTER TABLE survey_responses ADD COLUMN ip_address TEXT");
        }
    } else {
        $query = "CREATE TABLE IF NOT EXISTS survey_responses (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            respondent_name TEXT,
            respondent_role TEXT,
            score_zi REAL,
            score_service REAL,
            score_academic REAL,
            feedback TEXT,
            details_json TEXT,
            ip_address TEXT,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )";
        $db->exec($query);
    }

    // Helper Stats
    function getSurveyStats($db)
    {
        $sql = "SELECT
            AVG(score_zi) as zi,
            AVG(score_service) as service,
            AVG(score_academic) as academic,
            COUNT(*) as total
            FROM survey_responses";
        $row = $db->querySingle($sql, true);

        return [
            'zi' => round($row['zi'] ?? 0, 1),
            'service' => round($row['service'] ?? 0, 1),
            'academic' => round($row['academic'] ?? 0, 1),
            'total' => $row['total'] ?? 0
        ];
    }

    // 2. Handle POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Cek IP
        $checkIp = $db->prepare("SELECT id FROM survey_responses WHERE ip_address = :ip");
        $checkIp->bindValue(':ip', $ip_address, SQLITE3_TEXT);
        $res = $checkIp->execute();

        if ($res->fetchArray()) {
            echo json_encode(['status' => 'error', 'message' => 'Anda sudah mengisi survei ini.']);
            exit;
        }

        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if (empty($data['answers'])) throw new Exception("Data jawaban kosong.");

        $name = htmlspecialchars(strip_tags($data['profile']['name'] ?? 'Anonim'));
        $role = htmlspecialchars(strip_tags($data['profile']['role'] ?? 'Umum'));
        $feedback = htmlspecialchars(strip_tags($data['feedback'] ?? ''));
        $scoreZi = $data['scores']['zi'] ?? 0;
        $scoreService = $data['scores']['service'] ?? 0;
        $scoreAcademic = $data['scores']['academic'] ?? 0;
        $details = json_encode($data['answers']);

        $stmt = $db->prepare("INSERT INTO survey_responses
            (respondent_name, respondent_role, score_zi, score_service, score_academic, feedback, details_json, ip_address)
            VALUES (:name, :role, :zi, :service, :academic, :feedback, :details, :ip)");

        $stmt->bindValue(':name', $name, SQLITE3_TEXT);
        $stmt->bindValue(':role', $role, SQLITE3_TEXT);
        $stmt->bindValue(':zi', $scoreZi, SQLITE3_FLOAT);
        $stmt->bindValue(':service', $scoreService, SQLITE3_FLOAT);
        $stmt->bindValue(':academic', $scoreAcademic, SQLITE3_FLOAT);
        $stmt->bindValue(':feedback', $feedback, SQLITE3_TEXT);
        $stmt->bindValue(':details', $details, SQLITE3_TEXT);
        $stmt->bindValue(':ip', $ip_address, SQLITE3_TEXT);

        if ($stmt->execute()) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Survei berhasil dikirim.',
                'stats' => getSurveyStats($db)
            ]);
        } else {
            throw new Exception("Gagal menyimpan data.");
        }
    }
    // 3. Handle GET
    else {
        $checkIp = $db->prepare("SELECT id FROM survey_responses WHERE ip_address = :ip");
        $checkIp->bindValue(':ip', $ip_address, SQLITE3_TEXT);
        $res = $checkIp->execute();
        $hasSubmitted = ($res->fetchArray()) ? true : false;

        echo json_encode([
            'status' => 'ready',
            'has_submitted' => $hasSubmitted,
            'stats' => getSurveyStats($db)
        ]);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}

```

---

### File: `./public/manifest.json`

```json
{
  "name": "Madrasah Tsanawiyah Negeri 1 Pandeglang",
  "short_name": "MTs Negeri 1 Pandeglang",
  "author": {
    "name": "Yahya Zulfikri",
    "role": "Fullstack Developer",
    "phone": "62895351856267"
  },
  "description": "Mandiri, Takwa, Peduli Lingkungan, Prestasi.",
  "start_url": "/",
  "scope": "/",
  "display": "standalone",
  "theme_color": "#00dc82",
  "background_color": "#ffffff",
  "orientation": "portrait-primary",
  "icons": [
    {
      "src": "/images/icons/icon-192x192.png",
      "sizes": "192x192",
      "type": "image/png",
      "purpose": "any"
    },
    {
      "src": "/images/icons/icon-192x192.png",
      "sizes": "192x192",
      "type": "image/png",
      "purpose": "maskable"
    },
    {
      "src": "/images/icons/icon-512x512.png",
      "sizes": "512x512",
      "type": "image/png",
      "purpose": "any"
    },
    {
      "src": "/images/icons/icon-512x512.png",
      "sizes": "512x512",
      "type": "image/png",
      "purpose": "maskable"
    }
  ],
  "screenshots": [
    {
      "src": "/images/icons/screenshoot.png",
      "sizes": "512x512",
      "type": "image/png",
      "form_factor": "narrow"
    }
  ],
  "categories": ["education"]
}
```

---

### File: `./public/robots.txt`

```text
User-agent: *
Allow: /

Disallow: /api/*
```

---

## Direktori: scripts

### File: `./scripts/jsonGenerator.js`

```javascript
import fs from "node:fs";
import path from "node:path";
import matter from "gray-matter";

const CONTENT_DEPTH = 2;
const JSON_FOLDER = "./.json";
const BLOG_FOLDER = "src/content/blog";

// get data from markdown
const getData = (folder, groupDepth) => {
  const getPath = fs.readdirSync(folder);
  const removeIndex = getPath.filter((item) => !item.startsWith("-"));

  const getPaths = removeIndex.flatMap((filename) => {
    const filepath = path.join(folder, filename);
    const stats = fs.statSync(filepath);
    const isFolder = stats.isDirectory();

    if (isFolder) {
      return getData(filepath, groupDepth);
    } else if (filename.endsWith(".md") || filename.endsWith(".mdx")) {
      const file = fs.readFileSync(filepath, "utf-8");
      const { data, content } = matter(file);
      const pathParts = filepath.split(path.sep);
      const slug =
        data.slug ||
        pathParts
          .slice(CONTENT_DEPTH)
          .join("/")
          .replace(/\.[^/.]+$/, "");
      const group = pathParts[groupDepth];

      return {
        group: group,
        slug: slug,
        frontmatter: data,
        content: content,
      };
    } else {
      return [];
    }
  });

  return getPaths.filter((page) => !page.frontmatter?.draft && page);
};

try {
  // create folder if it doesn't exist
  if (!fs.existsSync(JSON_FOLDER)) {
    fs.mkdirSync(JSON_FOLDER);
  }

  // create json files
  fs.writeFileSync(
    `${JSON_FOLDER}/posts.json`,
    JSON.stringify(getData(BLOG_FOLDER, 2)),
  );

  // merger json files for search
  const postsPath = new URL(`../${JSON_FOLDER}/posts.json`, import.meta.url);
  const posts = JSON.parse(fs.readFileSync(postsPath, "utf8"));
  const search = [...posts];
  fs.writeFileSync(`${JSON_FOLDER}/search.json`, JSON.stringify(search));
} catch (err) {
  console.error(err);
}
```

---

### File: `./scripts/removeDarkmode.js`

```javascript
const fs = require("fs");
const path = require("path");

(function () {
  const rootDirs = ["src/pages", "src/hooks", "src/layouts", "src/styles"];

  const deleteAssetList = [
    "public/images/logo-darkmode.png",
    "src/layouts/components/ThemeSwitcher.astro",
  ];

  const configFiles = [
    { filePath: "src/config/theme.json", patterns: ["colors.darkmode"] },
  ];

  const filePaths = [
    {
      filePath: "src/layouts/partials/Header.astro",
      patterns: [
        "<ThemeSwitchers*(?:\\s+[^>]+)?\\s*(?:\\/\\>|>([\\s\\S]*?)<\\/ThemeSwitchers*>)",
      ],
    },
  ];

  filePaths.forEach(({ filePath, patterns }) => {
    removeDarkModeFromFiles(filePath, patterns);
  });

  deleteAssetList.forEach(deleteAsset);
  function deleteAsset(asset) {
    try {
      fs.unlinkSync(asset);
      console.log(`${path.basename(asset)} deleted successfully!`);
    } catch (error) {
      console.error(`${asset} not found`);
    }
  }

  rootDirs.forEach(removeDarkModeFromPages);
  configFiles.forEach(removeDarkMode);

  function removeDarkModeFromFiles(filePath, regexPatterns) {
    const fileContent = fs.readFileSync(filePath, "utf8");
    let updatedContent = fileContent;
    regexPatterns.forEach((pattern) => {
      const regex = new RegExp(pattern, "g");
      updatedContent = updatedContent.replace(regex, "");
    });
    fs.writeFileSync(filePath, updatedContent, "utf8");
  }

  function removeDarkModeFromPages(directoryPath) {
    const files = fs.readdirSync(directoryPath);

    files.forEach((file) => {
      const filePath = path.join(directoryPath, file);
      const stats = fs.statSync(filePath);
      if (stats.isDirectory()) {
        removeDarkModeFromPages(filePath);
      } else if (stats.isFile()) {
        removeDarkModeFromFiles(filePath, [
          '(?:(?!["])\\S)*dark:(?:(?![,;"])\\S)*',
        ]);
      }
    });
  }

  function removeDarkMode(configFile) {
    const { filePath, patterns } = configFile;
    const contentFile = JSON.parse(fs.readFileSync(filePath, "utf8"));
    patterns.forEach((pattern) => deleteNestedProperty(contentFile, pattern));
    fs.writeFileSync(filePath, JSON.stringify(contentFile));
  }

  function deleteNestedProperty(obj, propertyPath) {
    const properties = propertyPath.split(".");
    let currentObj = obj;
    for (let i = 0; i < properties.length - 1; i++) {
      const property = properties[i];
      if (currentObj.hasOwnProperty(property)) {
        currentObj = currentObj[property];
      } else {
        return; // Property not found, no need to continue
      }
    }
    delete currentObj[properties[properties.length - 1]];
  }
})();
```

---

## Direktori: ROOT

### File: `./.env`

```
# Google Auth
PUBLIC_GOOGLE_CLIENT_ID=33203236150-amm5kr16pc5pds6vmmsknd4rec3tplur.apps.googleusercontent.com
ADMIN_EMAIL=dev.mtsn1pandeglang@gmail.com
```

---

### File: `./astro.config.mjs`

```javascript
import mdx from "@astrojs/mdx";
import react from "@astrojs/react";
import sitemap from "@astrojs/sitemap";
import tailwindcss from "@tailwindcss/vite";
import AutoImport from "astro-auto-import";
import { defineConfig } from "astro/config";
import remarkCollapse from "remark-collapse";
import remarkToc from "remark-toc";
import sharp from "sharp";
import config from "./src/config/config.json";
import AstroPWA from "@vite-pwa/astro";

export default defineConfig({
  site: config.site.base_url
    ? config.site.base_url
    : "https://mtsn1pandeglang.sch.id",
  base: config.site.base_path ? config.site.base_path : "/",
  trailingSlash: config.site.trailing_slash ? "always" : "never",
  image: { service: sharp() },
  vite: { plugins: [tailwindcss()] },
  integrations: [
    react(),
    sitemap(),
    AutoImport({
      imports: [
        "@/shortcodes/Button",
        "@/shortcodes/Accordion",
        "@/shortcodes/Notice",
        "@/shortcodes/Video",
        "@/shortcodes/Youtube",
        "@/shortcodes/Tabs",
        "@/shortcodes/Tab",
      ],
    }),
    mdx(),
    AstroPWA({
      registerType: "autoUpdate",
      manifest: {
        name: "Madrasah Tsanawiyah Negeri 1 Pandeglang",
        short_name: "MTs Negeri 1 Pandeglang",
        description: "Mandiri, Takwa, Peduli Lingkungan, Prestasi.",
        theme_color: "#00dc82",
        background_color: "#ffffff",
        display: "standalone",
        start_url: "/",
        scope: "/",
        icons: [
          {
            src: "/images/icons/icon-192x192.png",
            sizes: "192x192",
            type: "image/png",
            purpose: "any maskable",
          },
          {
            src: "/images/icons/icon-512x512.png",
            sizes: "512x512",
            type: "image/png",
            purpose: "any maskable",
          },
        ],
      },
      workbox: {
        navigateFallback: "/",
        globPatterns: [
          "**/*.{js,css,html,ico,png,svg,webp,jpg,jpeg,woff,woff2}",
        ],
        maximumFileSizeToCacheInBytes: 60 * 1024 * 1024,
        globIgnores: ["**/videos/artikel/plp-kkn/**"],
        runtimeCaching: [
          {
            urlPattern: /^https:\/\/fonts\.googleapis\.com\/.*/i,
            handler: "CacheFirst",
            options: {
              cacheName: "google-fonts-cache",
              expiration: {
                maxEntries: 10,
                maxAgeSeconds: 60 * 60 * 24 * 365,
              },
              cacheableResponse: {
                statuses: [0, 200],
              },
            },
          },
          {
            urlPattern: /^https:\/\/fonts\.gstatic\.com\/.*/i,
            handler: "CacheFirst",
            options: {
              cacheName: "gstatic-fonts-cache",
              expiration: {
                maxEntries: 10,
                maxAgeSeconds: 60 * 60 * 24 * 365,
              },
              cacheableResponse: {
                statuses: [0, 200],
              },
            },
          },
          {
            urlPattern: /\.(?:png|jpg|jpeg|svg|gif|webp)$/,
            handler: "CacheFirst",
            options: {
              cacheName: "images-cache",
              expiration: {
                maxEntries: 50,
                maxAgeSeconds: 60 * 60 * 24 * 30,
              },
            },
          },
        ],
      },
      devOptions: {
        enabled: true,
      },
    }),
  ],
  markdown: {
    remarkPlugins: [remarkToc, [remarkCollapse, { test: "Table of contents" }]],
    shikiConfig: { theme: "one-dark-pro", wrap: true },
    extendDefaultPlugins: true,
  },
});
```

---

### File: `./deploy.sh`

```bash
#!/bin/bash
MAX_RETRIES=3
DELAY=5
PROJECT_DIR="/var/www/mtsn1pandeglang.sch.id"
echo "=== MEMULAI DEPLOYMENT ==="
sudo chown -R $USER:$USER $PROJECT_DIR
git config --global --add safe.directory $PROJECT_DIR
git stash
git pull origin static --force
echo "--- Installing Project Dependencies ---"
yarn install --check-files
rm -rf dist/
ATTEMPT=1
SUCCESS=0
while [ $ATTEMPT -le $MAX_RETRIES ]; do
    echo "--- Build Attempt $ATTEMPT of $MAX_RETRIES ---"
    yarn build
    if [ $? -eq 0 ]; then
        echo "Build Sukses!"
        SUCCESS=1
        break
    else
        echo "Build Gagal pada percobaan ke-$ATTEMPT"
        if [ $ATTEMPT -lt $MAX_RETRIES ]; then
            echo "Menunggu $DELAY detik sebelum mencoba lagi..."
            sleep $DELAY
        fi
        ATTEMPT=$((ATTEMPT + 1))
    fi
done
if [ $SUCCESS -eq 0 ]; then
    echo "DEPLOYMENT GAGAL SETELAH $MAX_RETRIES PERCOBAAN."
    exit 1
fi
echo "--- Setting up Database ---"
DB_FILE="$PROJECT_DIR/stats.db"
if [ ! -f "$DB_FILE" ]; then
    touch "$DB_FILE"
    echo "Database created."
fi
echo "--- Finalizing Permissions ---"
sudo chown www-data:www-data "$DB_FILE"
sudo chmod 664 "$DB_FILE"
sudo chown -R www-data:www-data $PROJECT_DIR
sudo chown $USER:$USER "$PROJECT_DIR/deploy.sh"
sudo chmod +x "$PROJECT_DIR/deploy.sh"
echo "=== DEPLOYMENT SELESAI & SUKSES! ==="
```

---

### File: `./package.json`

```json
{
  "name": "mtsn1pandeglang",
  "version": "0.0.1",
  "description": "Mandiri, Takwa, Peduli Lingkungan, Prestasi",
  "author": "Yahya Zulfikri",
  "license": "MIT",
  "private": true,
  "packageManager": "yarn@1.22.22",
  "type": "module",
  "scripts": {
    "dev": "yarn generate-json && astro dev",
    "build": "yarn generate-json && astro build",
    "preview": "astro preview",
    "check": "astro check",
    "format": "prettier -w ./src",
    "generate-json": "node scripts/jsonGenerator.js",
    "remove-darkmode": "node scripts/removeDarkmode.js && yarn format"
  },
  "dependencies": {
    "@astrojs/check": "0.9.6",
    "@astrojs/mdx": "4.3.13",
    "@astrojs/node": "^9.5.1",
    "@astrojs/react": "4.4.2",
    "@astrojs/sitemap": "3.6.0",
    "@digi4care/astro-google-tagmanager": "^1.6.0",
    "@giscus/react": "^3.1.0",
    "@justinribeiro/lite-youtube": "^1.8.2",
    "astro": "5.16.6",
    "astro-auto-import": "^0.4.5",
    "astro-font": "^1.1.0",
    "better-sqlite3": "^12.6.0",
    "chart.js": "^4.5.1",
    "date-fns": "^4.1.0",
    "github-slugger": "^2.0.0",
    "gray-matter": "^4.0.3",
    "gsap": "^3.14.2",
    "lenis": "^1.3.17",
    "marked": "^16.4.0",
    "prop-types": "^15.8.1",
    "react": "^19.2.0",
    "react-chartjs-2": "^5.3.1",
    "react-dom": "^19.2.0",
    "react-icons": "^5.5.0",
    "remark-collapse": "^0.1.2",
    "remark-toc": "^9.0.0",
    "swiper": "^12.0.2",
    "vite": "^7.1.9"
  },
  "devDependencies": {
    "@tailwindcss/forms": "^0.5.10",
    "@tailwindcss/typography": "^0.5.19",
    "@tailwindcss/vite": "^4.1.14",
    "@types/better-sqlite3": "^7.6.13",
    "@types/node": "22.15.3",
    "@types/react": "19.2.2",
    "@types/react-dom": "19.2.2",
    "@vite-pwa/astro": "^1.1.1",
    "eslint": "^9.37.0",
    "prettier": "^3.6.2",
    "prettier-plugin-astro": "^0.14.1",
    "prettier-plugin-tailwindcss": "^0.7.0",
    "sharp": "0.34.4",
    "tailwindcss": "^4.1.14",
    "typescript": "^5.9.3",
    "vite-plugin-pwa": "^1.1.0",
    "workbox-build": "^7.3.0",
    "workbox-window": "^7.3.0"
  }
}
```

---

### File: `./todo.md`

```markdown
# Content

1. Kurikulum Berbasis Cinta
2. Program Guru Tamu
3. Prestasi Madrasah
4. Publish kegiatan yang telah lalu.
```

---

### File: `./tsconfig.json`

```json
{
  "extends": "astro/tsconfigs/strict",
  "compilerOptions": {
    "baseUrl": ".",
    "target": "es6",
    "allowJs": true,
    "strict": true,
    "forceConsistentCasingInFileNames": true,
    "noEmit": true,
    "jsx": "react-jsx",
    "isolatedModules": true,
    "incremental": true,
    "allowSyntheticDefaultImports": true,
    "paths": {
      "@/components/*": ["./src/layouts/components/*"],
      "@/shortcodes/*": ["./src/layouts/shortcodes/*"],
      "@/helpers/*": ["./src/layouts/helpers/*"],
      "@/partials/*": ["./src/layouts/partials/*"],
      "@/*": ["./src/*"]
    }
  },
  "include": [".astro/types.d.ts", "**/*.ts", "**/*.tsx", "**/*.astro"],
  "exclude": ["node_modules", "dist"]
}
```

---

permasalahan yang saya temukan
error yang saya temukan
Akses penyimpanan secara otomatis diberikan untuk sumber “about:neterror” di “https://mtsn1pandeglang.sch.id”.
Server Response: <empty string> <anonymous code>:1:147461
overrideMethod <anonymous code>:1
d https://mtsn1pandeglang.sch.id/_astro/AdminDashboard.D8KQHYcJ.js:18
Kesalahan peta sumber: Error: JSON.parse: unexpected character at line 1 column 1 of the JSON data
Stack in the worker:parseSourceMapInput@resource://devtools/client/shared/vendor/source-map/lib/util.js:163:15
\_factory@resource://devtools/client/shared/vendor/source-map/lib/source-map-consumer.js:1066:22
SourceMapConsumer@resource://devtools/client/shared/vendor/source-map/lib/source-map-consumer.js:26:12
\_fetch@resource://devtools/client/shared/source-map-loader/utils/fetchSourceMap.js:83:19

Sumber URL: https://mtsn1pandeglang.sch.id/admin/%3Canonymous%20code%3E
URL Peta Sumber: installHook.js.map

XHRPOST
https://mtsn1pandeglang.sch.id/api/import.php?action=import
[HTTP/2 500 677ms]

Server Response: <empty string> <anonymous code>:1:147461
overrideMethod <anonymous code>:1
d https://mtsn1pandeglang.sch.id/_astro/AdminDashboard.D8KQHYcJ.js:18
Mv https://mtsn1pandeglang.sch.id/_astro/client.DCKK-Ipe.js:32
Qc https://mtsn1pandeglang.sch.id/_astro/client.DCKK-Ipe.js:32
qi https://mtsn1pandeglang.sch.id/_astro/client.DCKK-Ipe.js:32
Qc https://mtsn1pandeglang.sch.id/_astro/client.DCKK-Ipe.js:32
kc https://mtsn1pandeglang.sch.id/_astro/client.DCKK-Ipe.js:33
Xd https://mtsn1pandeglang.sch.id/_astro/client.DCKK-Ipe.js:33

https://mtsn1pandeglang.sch.id/api/admin.php?action=export&type=survey mungkin memiliki masalah sementara atau mungkin telah dipindahkan.

Kode kesalahan: 500 Internal Server Error

code
Code
download
content_copy
expand_less
Sementara ini mungkin situs terlalu sibuk atau tidak menyala. Cobalah beberapa saat lagi.

https://mtsn1pandeglang.sch.id/api/admin.php?action=export&type=feedback mungkin memiliki masalah sementara atau mungkin telah dipindahkan.

Kode kesalahan: 500 Internal Server Error

code
Code
download
content_copy
expand_less
Sementara ini mungkin situs terlalu sibuk atau tidak menyala. Cobalah beberapa saat lagi.

https://mtsn1pandeglang.sch.id/api/print_pdf.php?month=1&year=2026 mungkin memiliki masalah sementara atau mungkin telah dipindahkan.

Kode kesalahan: 500 Internal Server Error

code
Code
download
content_copy
expand_less
Sementara ini mungkin situs terlalu sibuk atau tidak menyala. Cobalah beberapa saat lagi.

library pdf sudah ada dan database saya versi terbaru dan sudah fix permission

masalah di import, export, print pdf
