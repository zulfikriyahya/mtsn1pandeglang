// src/lib/directus.ts
import {
  createDirectus,
  rest,
  authentication,
  staticToken,
  readItems,
  readItem,
  readSingleton,
} from "@directus/sdk";

// ============================================
// TYPE DEFINITIONS - DIRECTUS SCHEMA
// ============================================

// Global Site Settings (Singleton)
type SiteSettings = {
  id: number;
  site_title: string;
  site_tagline?: string;
  site_description?: string;
  logo?: string;
  logo_darkmode?: string;
  favicon?: string;
  contact_email?: string;
  contact_phone?: string;
  address?: string;
  social_media?: SocialMedia[];
  google_analytics_id?: string;
  gtm_id?: string;
  enable_search: boolean;
  enable_dark_mode: boolean;
  copyright_text?: string;
};

type SocialMedia = {
  platform:
    | "facebook"
    | "instagram"
    | "twitter"
    | "youtube"
    | "whatsapp"
    | "email";
  url: string;
  icon?: string;
};

// Articles & Blog
type Article = {
  id: number;
  status: "published" | "draft" | "archived";
  sort?: number;
  date_created?: string;
  date_updated?: string;
  user_created?: string;
  user_updated?: string;
  title: string;
  slug: string;
  excerpt?: string;
  content: string;
  featured_image?: string | DirectusFile;
  gallery?: ArticleFile[];
  publish_date?: string;
  author?: string | Author;
  meta_title?: string;
  meta_description?: string;
  categories?: ArticleCategory[];
  tags?: ArticleTag[];
  view_count?: number;
  reading_time?: number;
};

type Author = {
  id: string;
  status: "active" | "inactive";
  name: string;
  slug: string;
  email?: string;
  title?: string;
  avatar?: string | DirectusFile;
  bio?: string;
  social_media?: SocialMedia[];
};

type Category = {
  id: number;
  sort?: number;
  name: string;
  slug: string;
  description?: string;
  color?: string;
  icon?: string;
};

type Tag = {
  id: number;
  name: string;
  slug: string;
};

// Junction Tables for M2M Relations
type ArticleCategory = {
  id: number;
  articles_id: number | Article;
  categories_id: number | Category;
};

type ArticleTag = {
  id: number;
  articles_id: number | Article;
  tags_id: number | Tag;
};

type ArticleFile = {
  id: number;
  articles_id: number | Article;
  directus_files_id: string | DirectusFile;
};

// Directus File
type DirectusFile = {
  id: string;
  storage: string;
  filename_disk: string;
  filename_download: string;
  title?: string;
  type: string;
  folder?: string;
  uploaded_by?: string;
  uploaded_on: string;
  modified_by?: string;
  modified_on: string;
  charset?: string;
  filesize: number;
  width?: number;
  height?: number;
  duration?: number;
  embed?: string;
  description?: string;
  location?: string;
  tags?: string[];
  metadata?: Record<string, any>;
};

// Homepage Content
type HomepageBanner = {
  id: number;
  title: string;
  content: string;
  image: string | DirectusFile;
  button_enable: boolean;
  button_label?: string;
  button_link?: string;
};

type HomepageFeature = {
  id: number;
  status: "published" | "draft";
  sort?: number;
  title: string;
  content: string;
  image: string | DirectusFile;
  bulletpoints?: BulletPoint[];
  button_enable: boolean;
  button_label?: string;
  button_link?: string;
};

type BulletPoint = {
  text: string;
};

type Testimonial = {
  id: number;
  status: "published" | "draft";
  sort?: number;
  name: string;
  designation?: string;
  avatar?: string | DirectusFile;
  content: string;
  rating?: 1 | 2 | 3 | 4 | 5;
};

// Pages
type Page = {
  id: number;
  status: "published" | "draft";
  sort?: number;
  date_created?: string;
  date_updated?: string;
  title: string;
  slug: string;
  content: string;
  image?: string | DirectusFile;
  template: "default" | "full-width" | "with-sidebar";
  meta_title?: string;
  meta_description?: string;
};

// Navigation
type NavigationMenu = {
  id: number;
  status: "published" | "draft";
  sort?: number;
  position: "header" | "footer" | "sidebar";
  name: string;
  url?: string;
  parent_id?: number | NavigationMenu;
  open_in_new_tab: boolean;
  icon?: string;
};

// Teachers & Staff
type Teacher = {
  id: number;
  status: "active" | "inactive";
  sort?: number;
  name: string;
  nip?: string;
  position?: string;
  photo?: string | DirectusFile;
  bio?: string;
  subjects?: TeacherSubject[];
  classes?: TeacherClass[];
  education?: string;
  certifications?: string;
  email?: string;
  phone?: string;
};

type Staff = {
  id: number;
  status: "active" | "inactive";
  sort?: number;
  name: string;
  nip?: string;
  position?: string;
  division?: string;
  photo?: string | DirectusFile;
  contact?: string;
  email?: string;
};

type Subject = {
  id: number;
  name: string;
  code?: string;
};

type Class = {
  id: number;
  name: string;
  level?: string;
};

type TeacherSubject = {
  id: number;
  teachers_id: number | Teacher;
  subjects_id: number | Subject;
};

type TeacherClass = {
  id: number;
  teachers_id: number | Teacher;
  classes_id: number | Class;
};

// Extracurricular & Activities
type Extracurricular = {
  id: number;
  status: "published" | "draft";
  sort?: number;
  name: string;
  slug: string;
  description?: string;
  coach?: string | Teacher;
  schedule?: string;
  gallery?: ExtracurricularFile[];
  achievements?: string;
};

type Activity = {
  id: number;
  status: "published" | "draft";
  title: string;
  slug: string;
  date?: string;
  description?: string;
  photos?: ActivityFile[];
  participants?: string;
  category: "event" | "competition" | "ceremony" | "workshop";
};

type ExtracurricularFile = {
  id: number;
  extracurricular_id: number | Extracurricular;
  directus_files_id: string | DirectusFile;
};

type ActivityFile = {
  id: number;
  activities_id: number | Activity;
  directus_files_id: string | DirectusFile;
};

// Achievements
type Achievement = {
  id: number;
  status: "published" | "draft";
  title: string;
  date?: string;
  category?: string | AchievementCategory;
  description?: string;
  level: "school" | "district" | "province" | "national" | "international";
  participants?: string;
  photo?: string | DirectusFile;
};

type AchievementCategory = {
  id: number;
  name: string;
  slug: string;
};

// Gallery
type Gallery = {
  id: number;
  status: "published" | "draft";
  sort?: number;
  title: string;
  description?: string;
  date?: string;
  images?: GalleryFile[];
  category: "activities" | "achievements" | "facilities" | "events";
};

type GalleryFile = {
  id: number;
  gallery_id: number | Gallery;
  directus_files_id: string | DirectusFile;
};

// PLP/KKN Students
type PLPStudent = {
  id: number;
  status: "active" | "completed" | "inactive";
  name: string;
  nim: string;
  university?: string | University;
  program_study: string;
  supervisor?: string | Teacher;
  photo?: string | DirectusFile;
  period_start?: string;
  period_end?: string;
  activities?: string;
};

type University = {
  id: number;
  name: string;
  short_name?: string;
  logo?: string | DirectusFile;
};

// Announcements
type Announcement = {
  id: number;
  status: "published" | "draft" | "archived";
  title: string;
  content: string;
  type: "info" | "warning" | "urgent";
  start_date?: string;
  end_date?: string;
  target_audience: "students" | "teachers" | "public" | "all";
  show_on_homepage: boolean;
};

// Downloads
type Download = {
  id: number;
  status: "published" | "draft";
  title: string;
  category?: string;
  file?: string | DirectusFile;
  description?: string;
  date_uploaded?: string;
  access_level: "public" | "member";
  download_count?: number;
};

// Students (Optional - for advanced features)
type Student = {
  id: number;
  status: "active" | "inactive" | "alumni";
  name: string;
  nisn?: string;
  class?: string | Class;
  achievements?: StudentAchievement[];
  photo?: string | DirectusFile;
};

type StudentAchievement = {
  id: number;
  students_id: number | Student;
  achievements_id: number | Achievement;
};

// ============================================
// MAIN SCHEMA TYPE
// ============================================

type Schema = {
  // Core Collections
  articles: Article[];
  authors: Author[];
  categories: Category[];
  tags: Tag[];

  // Junction Tables
  articles_categories: ArticleCategory[];
  articles_tags: ArticleTag[];
  articles_files: ArticleFile[];

  // Homepage
  homepage_banner: HomepageBanner;
  homepage_features: HomepageFeature[];
  testimonials: Testimonial[];

  // Pages & Navigation
  pages: Page[];
  navigation_menus: NavigationMenu[];

  // Settings
  site_settings: SiteSettings;

  // Organization
  teachers: Teacher[];
  staff: Staff[];
  subjects: Subject[];
  classes: Class[];
  teachers_subjects: TeacherSubject[];
  teachers_classes: TeacherClass[];

  // Activities
  extracurricular: Extracurricular[];
  activities: Activity[];
  extracurricular_files: ExtracurricularFile[];
  activities_files: ActivityFile[];

  // Achievements & Gallery
  achievements: Achievement[];
  achievement_categories: AchievementCategory[];
  gallery: Gallery[];
  gallery_files: GalleryFile[];

  // PLP/KKN
  plp_students: PLPStudent[];
  universities: University[];

  // Other
  announcements: Announcement[];
  downloads: Download[];
  students: Student[];
  student_achievements: StudentAchievement[];

  // Directus System
  directus_files: DirectusFile[];
};

// ============================================
// DIRECTUS CLIENT CONFIGURATION
// ============================================

const directusUrl =
  import.meta.env.PUBLIC_DIRECTUS_URL || "http://localhost:8055";
const directusToken = import.meta.env.DIRECTUS_API_TOKEN;

if (!directusToken) {
  console.warn("⚠️ DIRECTUS_API_TOKEN is not set. Some features may not work.");
}

// Create Directus client with authentication
const directus = createDirectus<Schema>(directusUrl)
  .with(rest())
  .with(authentication("json"))
  .with(staticToken(directusToken || ""));

// ============================================
// API FUNCTIONS
// ============================================

/**
 * Get site settings
 */
export const getSiteSettings = async (): Promise<SiteSettings | null> => {
  try {
    return await directus.request(readSingleton("site_settings"));
  } catch (error) {
    console.error("Error fetching site settings:", error);
    return null;
  }
};

/**
 * Get all articles
 */
export const getArticles = async (params?: {
  limit?: number;
  filter?: any;
  sort?: string[];
}): Promise<Article[]> => {
  try {
    return await directus.request(
      readItems("articles", {
        filter: { status: { _eq: "published" }, ...params?.filter },
        limit: params?.limit || -1,
        sort: params?.sort || ["-publish_date"],
        fields: [
          "*",
          "author.*",
          "categories.categories_id.*",
          "tags.tags_id.*",
        ],
      }),
    );
  } catch (error) {
    console.error("Error fetching articles:", error);
    return [];
  }
};

/**
 * Get single article by slug
 */
export const getArticleBySlug = async (
  slug: string,
): Promise<Article | null> => {
  try {
    const articles = await directus.request(
      readItems("articles", {
        filter: { slug: { _eq: slug }, status: { _eq: "published" } },
        limit: 1,
        fields: [
          "*",
          "author.*",
          "categories.categories_id.*",
          "tags.tags_id.*",
          "gallery.directus_files_id.*",
        ],
      }),
    );
    return articles[0] || null;
  } catch (error) {
    console.error(`Error fetching article with slug ${slug}:`, error);
    return null;
  }
};

/**
 * Get all categories
 */
export const getCategories = async (): Promise<Category[]> => {
  try {
    return await directus.request(
      readItems("categories", {
        sort: ["sort", "name"],
      }),
    );
  } catch (error) {
    console.error("Error fetching categories:", error);
    return [];
  }
};

/**
 * Get all tags
 */
export const getTags = async (): Promise<Tag[]> => {
  try {
    return await directus.request(
      readItems("tags", {
        sort: ["name"],
      }),
    );
  } catch (error) {
    console.error("Error fetching tags:", error);
    return [];
  }
};

/**
 * Get all authors
 */
export const getAuthors = async (): Promise<Author[]> => {
  try {
    return await directus.request(
      readItems("authors", {
        filter: { status: { _eq: "active" } },
        fields: ["*"],
      }),
    );
  } catch (error) {
    console.error("Error fetching authors:", error);
    return [];
  }
};

/**
 * Get author by slug
 */
export const getAuthorBySlug = async (slug: string): Promise<Author | null> => {
  try {
    const authors = await directus.request(
      readItems("authors", {
        filter: { slug: { _eq: slug }, status: { _eq: "active" } },
        limit: 1,
      }),
    );
    return authors[0] || null;
  } catch (error) {
    console.error(`Error fetching author with slug ${slug}:`, error);
    return null;
  }
};

/**
 * Get homepage banner
 */
export const getHomepageBanner = async (): Promise<HomepageBanner | null> => {
  try {
    return await directus.request(readSingleton("homepage_banner"));
  } catch (error) {
    console.error("Error fetching homepage banner:", error);
    return null;
  }
};

/**
 * Get homepage features
 */
export const getHomepageFeatures = async (): Promise<HomepageFeature[]> => {
  try {
    return await directus.request(
      readItems("homepage_features", {
        filter: { status: { _eq: "published" } },
        sort: ["sort"],
      }),
    );
  } catch (error) {
    console.error("Error fetching homepage features:", error);
    return [];
  }
};

/**
 * Get testimonials
 */
export const getTestimonials = async (): Promise<Testimonial[]> => {
  try {
    return await directus.request(
      readItems("testimonials", {
        filter: { status: { _eq: "published" } },
        sort: ["sort"],
      }),
    );
  } catch (error) {
    console.error("Error fetching testimonials:", error);
    return [];
  }
};

/**
 * Get pages
 */
export const getPages = async (): Promise<Page[]> => {
  try {
    return await directus.request(
      readItems("pages", {
        filter: { status: { _eq: "published" } },
        sort: ["sort"],
      }),
    );
  } catch (error) {
    console.error("Error fetching pages:", error);
    return [];
  }
};

/**
 * Get page by slug
 */
export const getPageBySlug = async (slug: string): Promise<Page | null> => {
  try {
    const pages = await directus.request(
      readItems("pages", {
        filter: { slug: { _eq: slug }, status: { _eq: "published" } },
        limit: 1,
      }),
    );
    return pages[0] || null;
  } catch (error) {
    console.error(`Error fetching page with slug ${slug}:`, error);
    return null;
  }
};

/**
 * Get navigation menus
 */
export const getNavigationMenus = async (
  position?: "header" | "footer" | "sidebar",
): Promise<NavigationMenu[]> => {
  try {
    const filter = position
      ? { position: { _eq: position }, status: { _eq: "published" } }
      : { status: { _eq: "published" } };

    return await directus.request(
      readItems("navigation_menus", {
        filter,
        sort: ["sort"],
      }),
    );
  } catch (error) {
    console.error("Error fetching navigation menus:", error);
    return [];
  }
};

// ============================================
// HELPER FUNCTIONS
// ============================================

/**
 * Get full URL for Directus assets
 */
export const getAssetURL = (
  fileId: string | DirectusFile | undefined | null,
): string => {
  if (!fileId) return "";

  const id = typeof fileId === "string" ? fileId : fileId.id;
  return `${directusUrl}/assets/${id}`;
};

/**
 * Get thumbnail URL for images
 */
export const getThumbnailURL = (
  fileId: string | DirectusFile | undefined | null,
  width: number = 400,
  height?: number,
  fit: "cover" | "contain" | "inside" | "outside" = "cover",
): string => {
  if (!fileId) return "";

  const id = typeof fileId === "string" ? fileId : fileId.id;
  const params = new URLSearchParams({
    width: width.toString(),
    ...(height && { height: height.toString() }),
    fit,
  });

  return `${directusUrl}/assets/${id}?${params.toString()}`;
};

/**
 * Format date to readable string
 */
export const formatDate = (date: string | undefined | null): string => {
  if (!date) return "";
  return new Date(date).toLocaleDateString("id-ID", {
    year: "numeric",
    month: "long",
    day: "numeric",
  });
};

/**
 * Calculate reading time from content
 */
export const calculateReadingTime = (content: string): number => {
  const wordsPerMinute = 200;
  const wordCount = content.trim().split(/\s+/).length;
  return Math.ceil(wordCount / wordsPerMinute);
};

/**
 * Strip HTML tags from content
 */
export const stripHtml = (html: string): string => {
  return html.replace(/<[^>]*>/g, "");
};

/**
 * Truncate text to specified length
 */
export const truncateText = (text: string, length: number = 160): string => {
  if (text.length <= length) return text;
  return text.substring(0, length).trim() + "...";
};

/**
 * Generate excerpt from content
 */
export const generateExcerpt = (
  content: string,
  length: number = 160,
): string => {
  const plainText = stripHtml(content);
  return truncateText(plainText, length);
};

// ============================================
// EXPORT
// ============================================

export default directus;

// Export types for use in other files
export type {
  Schema,
  Article,
  Author,
  Category,
  Tag,
  Page,
  NavigationMenu,
  SiteSettings,
  HomepageBanner,
  HomepageFeature,
  Testimonial,
  Teacher,
  Staff,
  Subject,
  Class,
  Extracurricular,
  Activity,
  Achievement,
  Gallery,
  PLPStudent,
  University,
  Announcement,
  Download,
  Student,
  DirectusFile,
  SocialMedia,
  BulletPoint,
};

// Export enums for convenience
export const ArticleStatus = {
  PUBLISHED: "published" as const,
  DRAFT: "draft" as const,
  ARCHIVED: "archived" as const,
};

export const ActivityCategory = {
  EVENT: "event" as const,
  COMPETITION: "competition" as const,
  CEREMONY: "ceremony" as const,
  WORKSHOP: "workshop" as const,
};

export const AchievementLevel = {
  SCHOOL: "school" as const,
  DISTRICT: "district" as const,
  PROVINCE: "province" as const,
  NATIONAL: "national" as const,
  INTERNATIONAL: "international" as const,
};

export const AnnouncementType = {
  INFO: "info" as const,
  WARNING: "warning" as const,
  URGENT: "urgent" as const,
};

export const MenuPosition = {
  HEADER: "header" as const,
  FOOTER: "footer" as const,
  SIDEBAR: "sidebar" as const,
};
