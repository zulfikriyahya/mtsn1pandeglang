# 📋 TODO: Migrasi MTs Negeri 1 Pandeglang ke Directus

## 🔧 **PHASE 0: SETUP & PREPARATION**

### Environment Setup

- [ ] Install Directus (via Docker/npm)
- [ ] Setup PostgreSQL/MySQL database
- [ ] Configure `.env` file (DB credentials, secret keys)
- [ ] Install Directus CLI tools
- [ ] Setup backup strategy untuk existing files

### Project Structure

- [ ] Create `/directus` folder di root project
- [ ] Setup Directus admin panel
- [ ] Configure storage adapter (local/S3/Cloudinary)
- [ ] Setup media library folders
- [ ] Test Directus admin access

---

## 📊 **PHASE 1: SCHEMA CREATION**

### Core Collections (Week 1)

- [ ] Create `articles` collection
- [ ] Create `categories` collection
- [ ] Create `tags` collection
- [ ] Create `authors` collection
- [ ] Create junction table `articles_categories`
- [ ] Create junction table `articles_tags`
- [ ] Create junction table `articles_files`

### Homepage Collections

- [ ] Create `homepage_banner` (singleton)
- [ ] Create `homepage_features`
- [ ] Create `testimonials`

### Pages & Settings

- [ ] Create `pages` collection
- [ ] Create `site_settings` (singleton)
- [ ] Create `navigation_menus`

### Extended Collections (Week 2)

- [ ] Create `teachers` collection
- [ ] Create `staff` collection
- [ ] Create `extracurricular` collection
- [ ] Create `activities` collection
- [ ] Create `achievements` collection
- [ ] Create `gallery` collection
- [ ] Create `plp_students` collection
- [ ] Create `announcements` collection
- [ ] Create `downloads` collection

---

## 🔗 **PHASE 2: RELATIONS SETUP**

### M2O Relations

- [ ] `articles.author` → `authors`
- [ ] `articles.featured_image` → `directus_files`
- [ ] `pages.image` → `directus_files`
- [ ] `teachers.photo` → `directus_files`
- [ ] `navigation_menus.parent_id` → `navigation_menus`

### M2M Relations

- [ ] `articles` ↔ `categories` (via `articles_categories`)
- [ ] `articles` ↔ `tags` (via `articles_tags`)
- [ ] `articles` ↔ `directus_files` (via `articles_files`)
- [ ] `teachers` ↔ `subjects` (via junction table)
- [ ] `achievements` ↔ `students` (via junction table)

### Test Relations

- [ ] Verify all relations working in UI
- [ ] Test cascade delete behavior
- [ ] Test required field validations

---

## 🔐 **PHASE 3: PERMISSIONS & ROLES**

### Create Roles

- [ ] `Administrator` - Full access
- [ ] `Editor` - Content management
- [ ] `Author` - Own articles only
- [ ] `Public` - Read-only API access

### Configure Permissions (per role)

- [ ] Set `articles` permissions
- [ ] Set `pages` permissions
- [ ] Set `authors` permissions
- [ ] Set `categories/tags` permissions
- [ ] Set `site_settings` permissions (admin only)
- [ ] Set `directus_files` permissions
- [ ] Set public read permissions for API

### API Access

- [ ] Generate API access tokens
- [ ] Configure CORS settings
- [ ] Setup rate limiting
- [ ] Test public API endpoints

---

## 📦 **PHASE 4: DATA MIGRATION**

### Prepare Migration Scripts

- [ ] Write script to extract MDX frontmatter
- [ ] Write script to extract MDX content
- [ ] Write script to map file paths
- [ ] Write script to upload images
- [ ] Write script to create relations

### Migrate Content (Priority Order)

#### Blog Articles (60+ files)

- [ ] Extract all `/src/content/blog/*.mdx`
- [ ] Parse frontmatter (title, date, author, etc)
- [ ] Convert MDX to HTML/Markdown
- [ ] Upload featured images to Directus
- [ ] Create article records
- [ ] Link categories & tags
- [ ] Verify all links working

#### Authors (1 file)

- [ ] Migrate `yahya-zulfikri.md`
- [ ] Upload author avatar
- [ ] Link social media accounts
- [ ] Verify author-article relations

#### Homepage Content

- [ ] Migrate banner content
- [ ] Migrate 7 feature sections
- [ ] Migrate testimonials (17 items)
- [ ] Upload all section images
- [ ] Verify button links

#### Static Pages (20+ files)

- [ ] Migrate `/src/content/pages/*.mdx`
- [ ] List: akreditasi, kurikulum, program, zona-integritas
- [ ] List: pelayanan, sejarah, visi-misi-tujuan
- [ ] List: guru, staf, siswa, alumni
- [ ] List: osim, pramuka, paskibra, pmr, adiwiyata
- [ ] List: pecinta-alam, volleyball-club
- [ ] Upload page images
- [ ] Verify internal links

#### PLP Students Data

- [ ] Migrate 17 student profiles
- [ ] Upload student photos
- [ ] Link to supervisors
- [ ] Migrate activity gallery

#### Media Files

- [ ] Upload `/public/images/**/*`
- [ ] Upload `/public/videos/**/*`
- [ ] Organize into folders
- [ ] Update file references
- [ ] Verify all media accessible

### Verify Migration

- [ ] Check data integrity
- [ ] Verify all images uploaded
- [ ] Test all internal links
- [ ] Compare content with original
- [ ] Check for missing data

---

## 🔌 **PHASE 5: API INTEGRATION**

### Setup Directus SDK

- [ ] Install `@directus/sdk` in Astro project
- [ ] Create `/src/lib/directus.ts` client
- [ ] Configure API endpoint
- [ ] Setup authentication
- [ ] Test connection

### Create API Services

#### Articles Service (`/src/api/articles.ts`)

- [ ] `getAllArticles()` function
- [ ] `getArticleBySlug(slug)` function
- [ ] `getArticlesByCategory(category)` function
- [ ] `getArticlesByTag(tag)` function
- [ ] `getArticlesByAuthor(author)` function
- [ ] `getFeaturedArticles()` function
- [ ] Implement pagination
- [ ] Add search functionality

#### Pages Service (`/src/api/pages.ts`)

- [ ] `getAllPages()` function
- [ ] `getPageBySlug(slug)` function
- [ ] Handle page templates

#### Homepage Service (`/src/api/homepage.ts`)

- [ ] `getBanner()` function
- [ ] `getFeatures()` function
- [ ] `getTestimonials()` function

#### Settings Service (`/src/api/settings.ts`)

- [ ] `getSiteSettings()` function
- [ ] `getNavigationMenus(position)` function
- [ ] `getSocialMedia()` function

#### Authors Service (`/src/api/authors.ts`)

- [ ] `getAllAuthors()` function
- [ ] `getAuthorBySlug(slug)` function

#### Categories/Tags Service

- [ ] `getAllCategories()` function
- [ ] `getAllTags()` function
- [ ] `getCategoryBySlug(slug)` function
- [ ] `getTagBySlug(slug)` function

#### Teachers Service (`/src/api/teachers.ts`)

- [ ] `getAllTeachers()` function
- [ ] `getTeacherById(id)` function

#### Activities Service (`/src/api/activities.ts`)

- [ ] `getAllActivities()` function
- [ ] `getActivityBySlug(slug)` function

### Test API Integration

- [ ] Test all GET requests
- [ ] Test error handling
- [ ] Test rate limiting
- [ ] Verify data structure
- [ ] Check performance

---

## 🎨 **PHASE 6: FRONTEND INTEGRATION**

### Update Astro Pages

#### Blog Pages

- [ ] Update `/src/pages/blog/index.astro`
- [ ] Update `/src/pages/blog/[single].astro`
- [ ] Update `/src/pages/blog/page/[slug].astro`
- [ ] Replace `getSinglePage()` with Directus API
- [ ] Update pagination logic
- [ ] Verify blog listing works

#### Category/Tag Pages

- [ ] Update `/src/pages/categories/index.astro`
- [ ] Update `/src/pages/categories/[category].astro`
- [ ] Update `/src/pages/tags/index.astro`
- [ ] Update `/src/pages/tags/[tag].astro`
- [ ] Replace taxonomy parser with API calls

#### Author Pages

- [ ] Update `/src/pages/authors/index.astro`
- [ ] Update `/src/pages/authors/[single].astro`
- [ ] Show author's articles dynamically

#### Homepage

- [ ] Update `/src/pages/index.astro`
- [ ] Fetch banner from Directus
- [ ] Fetch features from Directus
- [ ] Fetch testimonials from Directus

#### Static Pages

- [ ] Update `/src/pages/[regular].astro`
- [ ] Dynamic routing from Directus
- [ ] Handle page templates
- [ ] Fetch page content

#### About Page

- [ ] Update `/src/pages/about.astro`
- [ ] Fetch from Directus pages

#### Contact Page

- [ ] Update `/src/pages/contact.astro`
- [ ] Keep form action static
- [ ] Fetch contact info from settings

### Update Components

#### BlogCard

- [ ] Update `/src/layouts/components/BlogCard.astro`
- [ ] Handle Directus data structure
- [ ] Update image paths

#### AuthorCard

- [ ] Update `/src/layouts/components/AuthorCard.astro`
- [ ] Handle new data structure

#### Navigation

- [ ] Update `/src/layouts/partials/Header.astro`
- [ ] Fetch menu from `navigation_menus`
- [ ] Build nested menu structure

#### Footer

- [ ] Update `/src/layouts/partials/Footer.astro`
- [ ] Fetch footer menu dynamically
- [ ] Fetch social media links

#### PostSidebar

- [ ] Update `/src/layouts/partials/PostSidebar.astro`
- [ ] Fetch categories/tags from API
- [ ] Update sambutan content source

### Update Layouts

#### PostSingle

- [ ] Update `/src/layouts/PostSingle.astro`
- [ ] Handle Directus article structure
- [ ] Update similar posts logic
- [ ] Fix image rendering

#### Base Layout

- [ ] Update `/src/layouts/Base.astro`
- [ ] Fetch site settings for meta tags
- [ ] Update logo paths

---

## 🔍 **PHASE 7: SEARCH & FEATURES**

### Update Search

- [ ] Update `/scripts/jsonGenerator.js`
- [ ] Fetch from Directus API instead
- [ ] Generate `search.json` from API
- [ ] Update SearchModal component
- [ ] Test search functionality

### Update Sitemap

- [ ] Configure `@astrojs/sitemap`
- [ ] Fetch URLs from Directus
- [ ] Generate dynamic sitemap

### RSS Feed (Optional)

- [ ] Create RSS feed generator
- [ ] Fetch articles from Directus
- [ ] Build XML structure

---

## 🖼️ **PHASE 8: MEDIA OPTIMIZATION**

### Image Handling

- [ ] Update `ImageMod.astro` component
- [ ] Handle Directus image transformations
- [ ] Setup responsive images
- [ ] Configure lazy loading
- [ ] Test image optimization

### Video Handling

- [ ] Update `Video.tsx` component
- [ ] Handle Directus video files
- [ ] Test video embeds

### File Downloads

- [ ] Setup downloads collection
- [ ] Create download links
- [ ] Track download counts

---

## ⚡ **PHASE 9: PERFORMANCE & OPTIMIZATION**

### Caching Strategy

- [ ] Implement API response caching
- [ ] Setup Redis (optional)
- [ ] Configure cache TTL
- [ ] Cache invalidation strategy

### Build Optimization

- [ ] Update build scripts
- [ ] Test SSG build times
- [ ] Optimize API calls
- [ ] Reduce bundle size

### CDN Setup (Optional)

- [ ] Configure CDN for media
- [ ] Setup Cloudflare/Vercel
- [ ] Test media delivery

---

## 🧪 **PHASE 10: TESTING**

### Content Testing

- [ ] Verify all pages load correctly
- [ ] Check all images render
- [ ] Test all internal links
- [ ] Test all external links
- [ ] Verify meta tags
- [ ] Check Open Graph images

### Functionality Testing

- [ ] Test blog pagination
- [ ] Test category filtering
- [ ] Test tag filtering
- [ ] Test search functionality
- [ ] Test navigation menus
- [ ] Test responsive design

### Performance Testing

- [ ] Run Lighthouse audit
- [ ] Test page load times
- [ ] Check Core Web Vitals
- [ ] Test on slow connections
- [ ] Test on mobile devices

### SEO Testing

- [ ] Verify sitemap.xml
- [ ] Check robots.txt
- [ ] Test meta descriptions
- [ ] Verify canonical URLs
- [ ] Check structured data

### Cross-browser Testing

- [ ] Test on Chrome
- [ ] Test on Firefox
- [ ] Test on Safari
- [ ] Test on Edge
- [ ] Test on mobile browsers

---

## 🚀 **PHASE 11: DEPLOYMENT**

### Pre-deployment

- [ ] Backup current live site
- [ ] Export database
- [ ] Document rollback procedure
- [ ] Setup staging environment
- [ ] Deploy to staging
- [ ] QA testing on staging

### Directus Deployment

- [ ] Deploy Directus to production server
- [ ] Configure production database
- [ ] Setup SSL certificate
- [ ] Configure environment variables
- [ ] Test API endpoints
- [ ] Setup automated backups

### Astro Site Deployment

- [ ] Update build configuration
- [ ] Configure Directus API URL
- [ ] Build production bundle
- [ ] Deploy to hosting (Vercel/Netlify)
- [ ] Configure custom domain
- [ ] Setup SSL

### Post-deployment

- [ ] Verify all pages live
- [ ] Test all functionality
- [ ] Monitor error logs
- [ ] Check analytics setup
- [ ] Update DNS if needed

---

## 📚 **PHASE 12: DOCUMENTATION**

### Technical Documentation

- [ ] Document Directus schema
- [ ] Document API endpoints
- [ ] Document collections structure
- [ ] Document relations
- [ ] Document permissions setup
- [ ] Create architecture diagram

### Content Management Guide

- [ ] Write editor's guide
- [ ] Create video tutorials
- [ ] Document content workflow
- [ ] Document image upload process
- [ ] Document article publishing flow

### Developer Documentation

- [ ] Document local setup
- [ ] Document API integration
- [ ] Document component usage
- [ ] Document build process
- [ ] Document deployment process

---

## 🎓 **PHASE 13: TRAINING**

### Admin Training

- [ ] Train on Directus interface
- [ ] Train on content creation
- [ ] Train on user management
- [ ] Train on permissions
- [ ] Train on backups

### Editor Training

- [ ] Train on article creation
- [ ] Train on image upload
- [ ] Train on category management
- [ ] Train on page editing
- [ ] Train on media library

### Create Training Materials

- [ ] Record video tutorials
- [ ] Create PDF guides
- [ ] Build knowledge base
- [ ] Setup help desk system

---

## 🔧 **PHASE 14: MAINTENANCE SETUP**

### Monitoring

- [ ] Setup uptime monitoring
- [ ] Setup error tracking (Sentry)
- [ ] Setup performance monitoring
- [ ] Configure alerts
- [ ] Setup log aggregation

### Backup Strategy

- [ ] Daily database backups
- [ ] Weekly full backups
- [ ] Test restore process
- [ ] Document backup procedure
- [ ] Setup offsite backups

### Update Procedures

- [ ] Document Directus update process
- [ ] Document Astro update process
- [ ] Schedule regular updates
- [ ] Test updates on staging first

---

## 🎯 **PHASE 15: POST-LAUNCH**

### Week 1

- [ ] Monitor site performance
- [ ] Fix any critical bugs
- [ ] Collect user feedback
- [ ] Monitor analytics
- [ ] Check error logs daily

### Week 2-4

- [ ] Optimize based on feedback
- [ ] Add missing features
- [ ] Improve documentation
- [ ] Train additional users
- [ ] Plan future enhancements

### Ongoing

- [ ] Monthly security updates
- [ ] Quarterly feature reviews
- [ ] Regular content audits
- [ ] Performance optimization
- [ ] User satisfaction surveys

---

## 📊 **PHASE 16: ADVANCED FEATURES (Optional)**

### Content Features

- [ ] Multi-language support
- [ ] Content versioning
- [ ] Draft preview system
- [ ] Scheduled publishing
- [ ] Content analytics

### User Features

- [ ] User registration
- [ ] Comment system
- [ ] User profiles
- [ ] Bookmarks/favorites
- [ ] Newsletter integration

### Advanced Integrations

- [ ] Google Analytics 4
- [ ] Facebook Pixel
- [ ] WhatsApp Business API
- [ ] Push notifications
- [ ] Email marketing integration

---

## ✅ **COMPLETION CHECKLIST**

### Verification

- [ ] All content migrated
- [ ] All features working
- [ ] All tests passing
- [ ] Documentation complete
- [ ] Training completed
- [ ] Monitoring active
- [ ] Backups configured

### Sign-off

- [ ] Developer sign-off
- [ ] Client/Admin approval
- [ ] Content team approval
- [ ] Final QA approval
- [ ] Go-live authorization

---

## 📝 **NOTES**

### Priority Levels

- **🔴 Critical** - Must complete before launch
- **🟡 Important** - Complete within first month
- **🟢 Nice to have** - Can be added later

### Time Estimates

- **Phase 0-3**: 1-2 weeks (Setup & Schema)
- **Phase 4**: 2-3 weeks (Data Migration)
- **Phase 5-6**: 2-3 weeks (API & Frontend)
- **Phase 7-10**: 1-2 weeks (Features & Testing)
- **Phase 11**: 3-5 days (Deployment)
- **Phase 12-13**: 1 week (Documentation & Training)
- **Phase 14-15**: Ongoing (Maintenance)

**Total Estimated Time**: 8-12 weeks for full migration

---

**Last Updated**: 2025-01-07  
**Project**: MTs Negeri 1 Pandeglang - Directus Migration  
**Status**: Planning Phase
