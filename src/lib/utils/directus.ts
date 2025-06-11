import { createDirectus, rest, } from '@directus/sdk';

type Global = {
  title: string;
  description: string;
  content: string;
  meta_title: string;
}

type Author = {
  name: string
}

type Page = {
  title: string;
  content: string;
  slug: string;
}

type Post = {
  image: string;
  title: string;
  author: Author;
  content: string;
  published_date: string
  slug: string;
}

type Schema = {
  posts: Post[];
  global: Global;
  pages: Page[];
}

const directus = createDirectus<Schema>('https://backend.zedlabs.id').with(rest());

export default directus;
