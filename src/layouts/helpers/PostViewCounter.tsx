import React, { useEffect, useState } from "react";
import { FaRegEye } from "react-icons/fa";

const PostViewCounter = () => {
  const [views, setViews] = useState<string>("...");
  const [isHidden, setIsHidden] = useState(false);

  useEffect(() => {
    // 1. Namespace Bersih (Tanpa titik/underscore)
    const NAMESPACE = "mtsn1pandeglang";

    // 2. Ambil Slug dari URL terakhir saja
    // Contoh: /blog/judul-artikel -> judul-artikel
    const pathSegments = window.location.pathname.split("/").filter(Boolean);
    const slug = pathSegments[pathSegments.length - 1] || "home";

    // 3. Key Format: post-{slug}
    const KEY = `post-${slug}`;

    const fetchCounter = async () => {
      try {
        // Hitungan Naik (Up)
        const res = await fetch(
          `https://api.counterapi.dev/v1/${NAMESPACE}/${KEY}/up`,
        );
        if (!res.ok) throw new Error("Failed");
        const data = await res.json();
        setViews(data.count.toLocaleString("id-ID"));
      } catch (error) {
        // Fallback: Baca Saja (Down/Get)
        try {
          const resRead = await fetch(
            `https://api.counterapi.dev/v1/${NAMESPACE}/${KEY}`,
          );
          if (!resRead.ok) throw new Error("Read Failed");
          const dataRead = await resRead.json();
          setViews(dataRead.count.toLocaleString("id-ID"));
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
