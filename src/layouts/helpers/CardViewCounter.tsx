import React, { useEffect, useState } from "react";
import { FaRegEye } from "react-icons/fa";

interface Props {
  slug: string; // Slug asli dari Astro (misal: "judul-artikel")
}

const CardViewCounter = ({ slug }: Props) => {
  const [views, setViews] = useState("0");

  useEffect(() => {
    // 1. Namespace HARUS SAMA dengan PostViewCounter (mtsn1pandeglang_v2)
    const NAMESPACE = "mtsn1pandeglang_v2";

    // 2. Bersihkan slug agar sama dengan format KEY di PostViewCounter
    // post_judul_artikel (underscore)
    const safeSlug = slug.replace(/[^a-zA-Z0-9]/g, "_");
    const KEY = `post_${safeSlug}`;

    const LOCAL_STORAGE_KEY = `local_view_${KEY}`;

    const fetchData = async () => {
      try {
        // Coba ambil dari API (GET/INFO saja agar tidak nambah view)
        const res = await fetch(
          `https://api.countapi.xyz/info/${NAMESPACE}/${KEY}`,
        );

        if (!res.ok) throw new Error("Data not found");

        const data = await res.json();
        setViews(data.value.toLocaleString("id-ID"));

        // Simpan ke local storage untuk cadangan
        localStorage.setItem(LOCAL_STORAGE_KEY, data.value);
      } catch (error) {
        // Jika API gagal/belum ada data, coba ambil dari Local Storage
        const localData = localStorage.getItem(LOCAL_STORAGE_KEY);
        if (localData) {
          setViews(parseInt(localData).toLocaleString("id-ID"));
        } else {
          setViews("0");
        }
      }
    };

    fetchData();
  }, [slug]);

  return (
    <div className="flex items-center gap-1" title={`${views} kali dibaca`}>
      <FaRegEye className="text-gray-500" />
      <span>{views}</span>
    </div>
  );
};

export default CardViewCounter;
