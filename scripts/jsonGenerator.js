import fs from "node:fs";
import { createDirectus, rest, readItems, staticToken } from "@directus/sdk";
import "dotenv/config";

const JSON_FOLDER = "./public"; // Simpan langsung di public agar bisa diakses fetch
const DIRECTUS_URL = process.env.PUBLIC_DIRECTUS_URL || "http://localhost:8055";
const DIRECTUS_TOKEN = process.env.DIRECTUS_API_TOKEN;

if (!DIRECTUS_TOKEN) {
  console.warn("⚠️ Warning: DIRECTUS_API_TOKEN not found in .env");
}

const directus = createDirectus(DIRECTUS_URL)
  .with(rest())
  .with(staticToken(DIRECTUS_TOKEN || ""));

const generateSearchIndex = async () => {
  try {
    console.log("🔍 Fetching articles from Directus for Search Index...");

    // Fetch articles with necessary fields
    const articles = await directus.request(
      readItems("articles", {
        filter: { status: { _eq: "published" } },
        fields: [
          "title",
          "slug",
          "content",
          "excerpt",
          "featured_image",
          "categories.categories_id.name",
          "tags.tags_id.name",
        ],
      }),
    );

    // Transform data to match Search Component expectation
    const searchData = articles.map((article) => {
      // Handle Image URL
      const image = article.featured_image
        ? `${DIRECTUS_URL}/assets/${article.featured_image}`
        : "";

      // Handle Categories & Tags (flatten nested arrays)
      const categories =
        article.categories?.map((c) => c.categories_id?.name).filter(Boolean) ||
        [];
      const tags =
        article.tags?.map((t) => t.tags_id?.name).filter(Boolean) || [];

      return {
        slug: `blog/${article.slug}`,
        group: "blog",
        frontmatter: {
          title: article.title,
          image: image,
          description: article.excerpt,
          categories: categories,
          tags: tags,
        },
        content: article.content,
      };
    });

    // Create folder if not exists
    if (!fs.existsSync(JSON_FOLDER)) {
      fs.mkdirSync(JSON_FOLDER);
    }

    // Write to search.json
    fs.writeFileSync(`${JSON_FOLDER}/search.json`, JSON.stringify(searchData));

    console.log(`✅ Search index generated with ${searchData.length} items.`);
  } catch (error) {
    console.error("❌ Error generating search index:", error);
  }
};

generateSearchIndex();
