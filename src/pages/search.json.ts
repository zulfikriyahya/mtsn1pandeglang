import { getArticles } from "@/lib/directus";
import { getAssetURL } from "@/lib/directus";

export async function GET() {
  const articles = await getArticles();

  const searchList = articles.map((item) => ({
    slug: `blog/${item.slug}`,
    group: "blog",
    frontmatter: {
      title: item.title,
      image: getAssetURL(item.featured_image),
      description: item.excerpt,
      categories: item.categories?.map((c: any) => c.categories_id?.name) || [],
      tags: item.tags?.map((t: any) => t.tags_id?.name) || [],
    },
    content: item.content,
  }));

  return new Response(JSON.stringify(searchList), {
    status: 200,
    headers: {
      "Content-Type": "application/json",
    },
  });
}
