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
