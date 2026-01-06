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

// Ambil domain dari env untuk image optimization whitelist
const directusUrl = process.env.PUBLIC_DIRECTUS_URL || "http://localhost:8055";
const directusDomain = new URL(directusUrl).hostname;

export default defineConfig({
  site: config.site.base_url || "https://mtsn1pandeglang.sch.id",
  base: config.site.base_path || "/",
  trailingSlash: config.site.trailing_slash ? "always" : "never",

  // Konfigurasi Image Service untuk Remote Images
  image: {
    service: sharp(),
    domains: [directusDomain, "localhost"],
    remotePatterns: [{ protocol: "https" }, { protocol: "http" }],
  },

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
      // ... (Konfigurasi PWA tetap sama seperti sebelumnya)
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
        maximumFileSizeToCacheInBytes: 50 * 1024 * 1024,
        runtimeCaching: [
          // Cache images from Directus
          {
            urlPattern: new RegExp(`^${directusUrl}/assets/.*`),
            handler: "StaleWhileRevalidate",
            options: {
              cacheName: "directus-assets",
              expiration: {
                maxEntries: 100,
                maxAgeSeconds: 60 * 60 * 24 * 30, // 30 Days
              },
            },
          },
        ],
      },
      devOptions: { enabled: true },
    }),
  ],
  markdown: {
    remarkPlugins: [remarkToc, [remarkCollapse, { test: "Table of contents" }]],
    shikiConfig: { theme: "one-dark-pro", wrap: true },
    extendDefaultPlugins: true,
  },
});
