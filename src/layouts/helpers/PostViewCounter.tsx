import React, { useEffect, useState } from "react";
import { FaRegEye } from "react-icons/fa";

const PostViewCounter = () => {
  const [views, setViews] = useState("...");

  useEffect(() => {
    const pathSegments = window.location.pathname.split("/").filter(Boolean);
    const rawSlug = pathSegments[pathSegments.length - 1] || "home";
    const safeSlug = rawSlug.replace(/[^a-zA-Z0-9]/g, "_");

    const sessionKey = `viewed_${safeSlug}`;
    const hasViewed = sessionStorage.getItem(sessionKey);

    const hitViews = async () => {
      try {
        const url = `/api/stats.php?action=view&slug=${safeSlug}`;
        const method = !hasViewed ? "POST" : "GET";
        const response = await fetch(url, { method });
        if (response.ok) {
          const data = await response.json();
          setViews(data.value.toLocaleString("id-ID"));
          if (!hasViewed) sessionStorage.setItem(sessionKey, "true");
        }
      } catch (error) {
        console.error(error);
      }
    };
    hitViews();
  }, []);

  return (
    <span className="flex items-center gap-2" title="Jumlah Pembaca">
      <FaRegEye className="text-gray-500 dark:text-gray-400" />
      <span className="font-regular">{views}</span>
      <span className="text-md">Kali dibaca</span>
    </span>
  );
};

export default PostViewCounter;
