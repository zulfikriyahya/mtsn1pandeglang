import React, { useEffect, useState, useRef } from "react";
import SearchResult, { type ISearchItem } from "./SearchResult";

const SearchModal = () => {
  const [searchString, setSearchString] = useState("");
  const [searchData, setSearchData] = useState<ISearchItem[]>([]);
  const [isLoading, setIsLoading] = useState(false);

  // Load Search Data Async
  useEffect(() => {
    const loadSearchData = async () => {
      try {
        setIsLoading(true);
        const response = await fetch("/search.json");
        if (!response.ok) throw new Error("Search index not found");
        const data = await response.json();
        setSearchData(data);
      } catch (error) {
        console.error("Failed to load search data:", error);
      } finally {
        setIsLoading(false);
      }
    };

    // Load data only when user interacts (hover/focus) or after initial load
    // For simplicity here, we load on mount
    loadSearchData();
  }, []);

  // handle input change
  const handleSearch = (e: React.FormEvent<HTMLInputElement>) => {
    setSearchString(e.currentTarget.value.replace("\\", "").toLowerCase());
  };

  // generate search result
  const doSearch = (data: ISearchItem[]) => {
    if (searchString === "") return [];

    const regex = new RegExp(`${searchString}`, "gi");
    return data.filter((item) => {
      const title = item.frontmatter.title?.toLowerCase().match(regex);
      const description = item.frontmatter.description
        ?.toLowerCase()
        .match(regex);
      const categories = item.frontmatter.categories
        ?.join(" ")
        .toLowerCase()
        .match(regex);
      const tags = item.frontmatter.tags?.join(" ").toLowerCase().match(regex);
      // Optional: Search content (might be heavy)
      // const content = item.content?.toLowerCase().match(regex);

      return title || description || categories || tags;
    });
  };

  const searchResult = doSearch(searchData);

  // DOM Event Listeners for Modal
  useEffect(() => {
    const searchModal = document.getElementById("searchModal");
    const searchInput = document.getElementById("searchInput");
    const searchModalOverlay = document.getElementById("searchModalOverlay");
    const searchModalTriggers = document.querySelectorAll(
      "[data-search-trigger]",
    );

    const openModal = () => {
      searchModal?.classList.add("show");
      searchInput?.focus();
    };

    const closeModal = () => {
      searchModal?.classList.remove("show");
      setSearchString(""); // Clear search on close
    };

    searchModalTriggers.forEach((button) => {
      button.addEventListener("click", openModal);
    });

    searchModalOverlay?.addEventListener("click", closeModal);

    const handleKeydown = (event: KeyboardEvent) => {
      if ((event.metaKey || event.ctrlKey) && event.key === "k") {
        event.preventDefault();
        openModal();
      }
      if (event.key === "Escape") {
        closeModal();
      }
    };

    document.addEventListener("keydown", handleKeydown);

    return () => {
      searchModalTriggers.forEach((button) => {
        button.removeEventListener("click", openModal);
      });
      searchModalOverlay?.removeEventListener("click", closeModal);
      document.removeEventListener("keydown", handleKeydown);
    };
  }, []);

  return (
    <div id="searchModal" className="search-modal">
      <div id="searchModalOverlay" className="search-modal-overlay" />
      <div className="search-wrapper">
        <div className="search-wrapper-header">
          <label
            htmlFor="searchInput"
            className="absolute left-7 top-[calc(50%-9px)]"
          >
            <span className="sr-only">Search Icon</span>
            <svg
              viewBox="0 0 512 512"
              height="18"
              width="18"
              className="fill-current text-gray-400"
            >
              <path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8.0 45.3s-32.8 12.5-45.3.0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9.0 208S93.1.0 208 0 416 93.1 416 208zM208 352a144 144 0 100-288 144 144 0 100 288z"></path>
            </svg>
          </label>
          <input
            id="searchInput"
            placeholder="Cari artikel, kategori, atau tag..."
            className="search-wrapper-header-input"
            type="text"
            value={searchString}
            onChange={handleSearch}
            autoComplete="off"
          />
          {searchString && (
            <button
              onClick={() => setSearchString("")}
              className="absolute right-4 top-[calc(50%-9px)] text-gray-400 hover:text-red-500"
            >
              <svg
                viewBox="0 0 512 512"
                height="18"
                width="18"
                fill="currentColor"
              >
                <path d="M256 512A256 256 0 10256 0a256 256 0 100 512zM175 175c9.4-9.4 24.6-9.4 33.9.0l47 47 47-47c9.4-9.4 24.6-9.4 33.9.0s9.4 24.6.0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6.0 33.9s-24.6 9.4-33.9.0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9.0s-9.4-24.6.0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6.0-33.9z"></path>
              </svg>
            </button>
          )}
        </div>

        {isLoading ? (
          <div className="p-4 text-center text-sm text-gray-500">
            Memuat data...
          </div>
        ) : (
          <SearchResult
            searchResult={searchResult}
            searchString={searchString}
          />
        )}

        <div className="search-wrapper-footer">
          <span className="flex items-center">
            <span className="bg-gray-100 dark:bg-gray-700 px-1.5 py-0.5 rounded text-xs mr-2">
              ESC
            </span>
            untuk menutup
          </span>
          {searchResult.length > 0 && (
            <span className="ml-auto">
              <strong>{searchResult.length}</strong> Hasil ditemukan
            </span>
          )}
        </div>
      </div>
    </div>
  );
};

export default SearchModal;
