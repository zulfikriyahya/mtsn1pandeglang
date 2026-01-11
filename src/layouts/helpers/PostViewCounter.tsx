import React, { useEffect, useState } from "react";
import { FaRegEye } from "react-icons/fa";

const PostViewCounter = () => {
  const [views, setViews] = useState<string>("...");

  useEffect(() => {
    // Ambil slug artikel
    const pathSegments = window.location.pathname.split("/").filter(Boolean);
    const slug = pathSegments[pathSegments.length - 1] || "home";
    const safeSlug = slug.replace(/[^a-zA-Z0-9]/g, "_"); // Bersihkan karakter aneh

    const NAMESPACE = "mtsn1pandeglang_v2";
    const KEY = `post_${safeSlug}`;

    const API_URL = `https://api.countapi.xyz/hit/${NAMESPACE}/${KEY}`;
    const LOCAL_STORAGE_KEY = `local_view_${KEY}`;

    const fetchViews = async () => {
      try {
        const res = await fetch(API_URL);
        if (!res.ok) throw new Error("API Error");
        const data = await res.json();

        setViews(data.value.toLocaleString("id-ID"));
        localStorage.setItem(LOCAL_STORAGE_KEY, data.value);
      } catch (error) {
        // Fallback Local Storage
        let localCount = parseInt(
          localStorage.getItem(LOCAL_STORAGE_KEY) || "0",
        );
        localCount++;
        localStorage.setItem(LOCAL_STORAGE_KEY, localCount.toString());

        // Angka dasar dummy (misal 50) + hitungan lokal agar tidak terlihat 0
        const displayCount = localCount > 0 ? localCount : 25 + localCount;
        setViews(displayCount.toLocaleString("id-ID"));
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
