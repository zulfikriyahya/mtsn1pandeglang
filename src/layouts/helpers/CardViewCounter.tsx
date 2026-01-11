import React, { useEffect, useState } from "react";
import { FaRegEye } from "react-icons/fa";

interface Props {
  slug: string;
}

const CardViewCounter = ({ slug }: Props) => {
  const [views, setViews] = useState("0");

  useEffect(() => {
    const NAMESPACE = "mtsn1pandeglang";

    // Logika pembersihan HARUS SAMA dengan PostViewCounter
    const safeSlug = slug.replace(/[^a-zA-Z0-9]/g, "_");
    const KEY = `post_${safeSlug}`;

    const fetchData = async () => {
      try {
        // HAPUS '/up' di sini. Cukup panggil URL endpoint untuk membaca data.
        const res = await fetch(
          `https://api.counterapi.dev/v1/${NAMESPACE}/${KEY}`,
        );

        if (!res.ok) throw new Error("Not found");

        const data = await res.json();
        setViews(data.count.toLocaleString("id-ID"));
      } catch (error) {
        setViews("0");
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
