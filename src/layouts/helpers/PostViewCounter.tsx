import React, { useEffect, useState } from "react";
import { FaRegEye } from "react-icons/fa";

const PostViewCounter = () => {
  const [views, setViews] = useState("...");

  useEffect(() => {
    const NAMESPACE = "mtsn1pandeglang";

    // Ambil bagian terakhir dari URL
    const pathSegments = window.location.pathname.split("/").filter(Boolean);
    const rawSlug = pathSegments[pathSegments.length - 1] || "home";

    // BERSIHKAN SLUG: Hanya huruf, angka, dan underscore
    const safeSlug = rawSlug.replace(/[^a-zA-Z0-9]/g, "_");
    const KEY = `post_${safeSlug}`;

    const fetchViews = async () => {
      try {
        // Gunakan /up untuk menambah view
        const res = await fetch(
          `https://api.counterapi.dev/v1/${NAMESPACE}/${KEY}/up`,
        );
        if (!res.ok) throw new Error("Error");
        const data = await res.json();
        setViews(data.count.toLocaleString("id-ID"));
      } catch (error) {
        // Silent fail
      }
    };

    fetchViews();
  }, []);

  return (
    <span className="flex items-center gap-2" title="Jumlah Pembaca">
      <FaRegEye className="text-gray-500 dark:text-gray-400" />
      <span className="font-semibold">{views}</span>
      <span className="text-xs">kali dibaca</span>
    </span>
  );
};

export default PostViewCounter;
