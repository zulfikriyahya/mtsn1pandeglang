import React, { useEffect, useState } from "react";
import { FaRegEye } from "react-icons/fa";

const PostViewCounter = () => {
  const [views, setViews] = useState<string>("...");
  const [isHidden, setIsHidden] = useState(false);

  useEffect(() => {
    // Gunakan namespace tanpa titik agar aman
    const NAMESPACE = "mtsn1pandeglang";

    // Ambil Slug dari URL terakhir
    const pathSegments = window.location.pathname.split("/").filter(Boolean);
    const slug = pathSegments[pathSegments.length - 1] || "home";

    // Key Format: post-{slug}
    const KEY = `post-${slug}`;

    const fetchCounter = async () => {
      try {
        // Gunakan countapi.dev
        // /hit = Menambah angka (Increment)
        const res = await fetch(
          `https://api.countapi.dev/hit/${NAMESPACE}/${KEY}`,
        );

        if (!res.ok) throw new Error("Failed");

        const data = await res.json();
        // countapi.dev mengembalikan properti 'value', bukan 'count'
        setViews(data.value.toLocaleString("id-ID"));
      } catch (error) {
        // Fallback: Baca Saja (/get)
        try {
          const resRead = await fetch(
            `https://api.countapi.dev/get/${NAMESPACE}/${KEY}`,
          );
          if (!resRead.ok) throw new Error("Read Failed");
          const dataRead = await resRead.json();
          setViews(dataRead.value.toLocaleString("id-ID"));
        } catch (err) {
          setIsHidden(true);
        }
      }
    };

    fetchCounter();
  }, []);

  if (isHidden) return null;

  return (
    <span className="flex items-center gap-2" title="Jumlah Pembaca">
      <FaRegEye className="text-gray-500 dark:text-gray-400" />
      <span className="font-semibold">{views}</span>
      <span className="text-xs">kali dibaca</span>
    </span>
  );
};

export default PostViewCounter;
