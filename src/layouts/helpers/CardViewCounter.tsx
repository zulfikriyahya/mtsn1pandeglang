import React, { useEffect, useState } from "react";
import { FaRegEye } from "react-icons/fa";

interface Props {
  slug: string; // Ini adalah ID artikel (misal: "judul-artikel")
}

const CardViewCounter = ({ slug }: Props) => {
  const [views, setViews] = useState("0");

  useEffect(() => {
    // 1. Namespace HARUS SAMA dengan PostViewCounter
    const NAMESPACE = "mtsn1pandeglang";

    // 2. Key Format HARUS SAMA: post-{slug}
    const KEY = `post-${slug}`;

    const fetchData = async () => {
      try {
        // HANYA BACA (jangan pakai /up disini)
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
      <FaRegEye />
      <span>{views}</span>
    </div>
  );
};

export default CardViewCounter;
