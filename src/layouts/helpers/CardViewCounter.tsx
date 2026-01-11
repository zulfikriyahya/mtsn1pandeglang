import React, { useEffect, useState } from "react";
import { FaRegEye } from "react-icons/fa";

interface Props {
  slug: string;
}

const CardViewCounter = ({ slug }: Props) => {
  const [views, setViews] = useState("0");

  useEffect(() => {
    const NAMESPACE = "mtsn1pandeglang";
    const KEY = `post-${slug}`;

    const fetchData = async () => {
      try {
        // Gunakan /get (Hanya membaca, tidak menambah)
        const res = await fetch(
          `https://api.countapi.dev/get/${NAMESPACE}/${KEY}`,
        );

        if (!res.ok) throw new Error("Not found");

        const data = await res.json();
        // Perhatikan: data.value
        setViews(data.value.toLocaleString("id-ID"));
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
