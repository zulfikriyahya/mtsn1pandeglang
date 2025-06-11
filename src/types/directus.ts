export type Global = {
  title: string;
  description: string;
  content: string;
  meta_title: string;
};

export type Author = {
  name: string;
};

export type Page = {
  title: string;
  content: string;
  slug: string;
};

export type Post = {
  image: string;
  title: string;
  author: Author;
  content: string;
  published_date: string;
  slug: string;
};

export type Schema = {
  posts: Post[];
  global: Global;
  pages: Page[];
  authors: Author[];
};
