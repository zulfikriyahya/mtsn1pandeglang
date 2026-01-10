import React, { useEffect, useState } from "react";
import { FaRegEye } from "react-icons/fa";

const PostViewCounter = () => {
  const [views, setViews] = useState<string>("...");

  useEffect(() => {
    const NAMESPACE = "mtsn1pandeglang.sch.id";

    // Ambil path URL saat ini sebagai ID unik (misal: "blog-judul-artikel")
    // Kita bersihkan karakter slash agar valid di API
    const currentPath = window.location.pathname
      .replace(/^\/|\/$/g, "")
      .replace(/\//g, "_");
    const KEY = currentPath || "home";

    // Hitung view
    fetch(`https://api.countapi.xyz/hit/${NAMESPACE}/${KEY}`)
      .then((res) => res.json())
      .then((data) => {
        setViews(data.value.toLocaleString("id-ID"));
      })
      .catch(() => {
        // Fallback: Jika gagal hit, coba ambil data saja (read-only)
        fetch(`https://api.countapi.xyz/get/${NAMESPACE}/${KEY}`)
          .then((res) => res.json())
          .then((data) => setViews(data.value.toLocaleString("id-ID")))
          .catch(() => setViews("-"));
      });
  }, []);

  return (
    <span className="flex items-center gap-2" title="Jumlah Pembaca">
      <FaRegEye className="text-gray-500 dark:text-gray-400" />
      <span className="font-semibold">{views}</span>
      <span className="text-xs">x dibaca</span>
    </span>
  );
};

export default PostViewCounter;
