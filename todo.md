# Refactor to dinamical data:

```
## 🎯 **PRIORITAS TINGGI** (Core Content Management)

### 1. **Blog/Artikel System**
**Collections:**
- `articles` - Artikel utama
  - title, slug, content (rich text), excerpt
  - featured_image, gallery
  - author (M2O ke users)
  - categories (M2M)
  - tags (M2M)
  - publish_date, status (draft/published)
  - meta_title, meta_description

- `categories` - Kategori artikel
- `tags` - Tag artikel
- `authors` - Data penulis/kontributor

**Files:** `src/content/blog/*.mdx`, `src/pages/blog/*`

---

### 2. **Homepage Content**
**Collections:**
- `homepage_banner`
  - title, content, image
  - button_text, button_link

- `homepage_features`
  - title, content, image
  - bulletpoints (JSON/Array)
  - button_enable, button_label, button_link
  - order/sort

- `testimonials`
  - name, designation, avatar
  - content, rating

**Files:** `src/content/homepage/-index.md`, `src/content/sections/*`

---

### 3. **Pages Content**
**Collections:**
- `pages`
  - slug, title, content (rich text)
  - meta_title, meta_description, image
  - template_type (default, custom)
  - status (draft/published)

**Files:** `src/content/pages/*.mdx` (akreditasi, kurikulum, program, dll)

---

## 🎯 **PRIORITAS MENENGAH** (Extended Features)

### 4. **Organizational Structure**
**Collections:**
- `teachers` (Guru)
  - name, nip, position
  - photo, bio
  - subjects (M2M), classes
  - education, certifications

- `staff` (Staf)
  - name, nip, position, division
  - photo, contact

- `students` (Siswa) - Optional
  - name, nisn, class
  - achievements (M2M)

**Files:** `src/content/pages/guru.mdx`, `src/content/pages/staf.mdx`

---

### 5. **Programs & Activities**
**Collections:**
- `extracurricular`
  - name, slug, description
  - coach, schedule, gallery
  - achievements

- `activities` (Kegiatan Madrasah)
  - title, date, description
  - photos, participants
  - category (event/competition/ceremony)

**Files:** `src/content/pages/osim.mdx`, `src/content/pages/pramuka.mdx`, dll

---

### 6. **Achievements & Gallery**
**Collections:**
- `achievements`
  - title, date, category
  - description, level (sekolah/kabupaten/nasional)
  - participants, photo

- `gallery`
  - title, description, date
  - images (M2M to directus_files)
  - category (kegiatan/prestasi/fasilitas)

---

### 7. **PLP/KKN Students**
**Collections:**
- `plp_students`
  - name, nim, university
  - program_study, supervisor
  - photo, period_start, period_end
  - activities (rich text)

**Files:** `src/content/blog/plp-kkn-uin-banten-2025.mdx`

---

## 🎯 **PRIORITAS RENDAH** (Configuration & Settings)

### 8. **Site Configuration**
**Collections:**
- `site_settings` (Singleton)
  - site_title, tagline, description
  - logo, logo_darkmode
  - contact_email, phone, address
  - social_media (JSON)
  - google_analytics_id, gtm_id

- `navigation_menus`
  - menu_items (JSON nested structure)
  - position (header/footer)

**Files:** `src/config/*.json`

---

### 9. **Media & Files**
**Collections:**
- `downloads` (File Repository)
  - title, category, file (M2O)
  - description, date_uploaded
  - access_level (public/member)

---

### 10. **Announcements & News**
**Collections:**
- `announcements`
  - title, content, type (info/warning/urgent)
  - start_date, end_date
  - target_audience (siswa/guru/umum)
  - show_on_homepage

---

## 📊 **STRUKTUR RELASI UTAMA**

```

articles
├── author (M2O) → authors
├── categories (M2M) → categories
└── tags (M2M) → tags

pages
└── sections (M2M) → page_sections

teachers
├── subjects (M2M) → subjects
└── classes (M2M) → classes

plp_students
├── university (M2O) → universities
└── supervisor (M2O) → teachers

achievements
├── students (M2M) → students
└── category (M2O) → achievement_categories

````

---

## 🔄 **IMPLEMENTASI BERTAHAP**

### **Phase 1** (1-2 minggu)
- ✅ Blog/Articles system
- ✅ Homepage content
- ✅ Basic pages
- ✅ Site settings

### **Phase 2** (2-3 minggu)
- ✅ Teachers & Staff
- ✅ Extracurricular
- ✅ Gallery & Achievements
- ✅ Navigation menus

### **Phase 3** (1-2 minggu)
- ✅ PLP Students
- ✅ Announcements
- ✅ Downloads
- ✅ Advanced features

---

## 🛠️ **TECHNICAL CONSIDERATIONS**

### **Yang HARUS Tetap Static:**
- Theme configuration (colors, fonts)
- Build scripts
- Core layouts & components structure
- PWA manifest
- Search functionality logic

### **Yang Bisa Dinamis:**
- ✅ Semua content (text, images, videos)
- ✅ Menu structure
- ✅ Meta tags & SEO
- ✅ Social media links
- ✅ Contact information

### **API Integration Points:**
```typescript
// Example structure
src/
├── lib/
│   └── directus.ts          // Directus client
├── api/
│   ├── articles.ts          // Article queries
│   ├── pages.ts             // Pages queries
│   └── settings.ts          // Settings queries
└── pages/
    └── [...slug].astro      // Dynamic routing
````

---

## 💡 **REKOMENDASI PRIORITAS**

**Mulai dengan:**

1. **Blog System** - Paling sering diupdate
2. **Homepage Content** - Impact visual tinggi
3. **Site Settings** - Fleksibilitas konfigurasi
4. **Pages Content** - Kemudahan update statis

**Kemudian tambahkan:** 5. Teachers/Staff data 6. Extracurricular & Activities 7. Gallery & Achievements 8. Advanced features (announcements, downloads)

---

Apakah Anda ingin saya buatkan:

1. **Directus schema definition** untuk collections ini?
2. **API integration code** untuk mengambil data dari Directus?
3. **Migration guide** untuk memindahkan content yang ada ke Directus?

```

```
