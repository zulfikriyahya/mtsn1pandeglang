import React, { useEffect, useState } from "react";
import { FaRegEye } from "react-icons/fa";

interface Props {
  slug: string;
}

const CardViewCounter = ({ slug }: Props) => {
  const [views, setViews] = useState("0");

  useEffect(() => {
    const NAMESPACE = "mtsn1pandeglang_sch_id";
    // Key harus sama persis dengan logic di PostViewCounter
    // Asumsi URL artikel adalah /blog/slug-artikel
    const KEY = `post_blog_${slug}`;

    fetch(`https://api.counterapi.dev/v1/${NAMESPACE}/${KEY}`)
      .then((res) => {
        if (!res.ok) throw new Error("Belum ada data");
        return res.json();
      })
      .then((data) => setViews(data.count.toLocaleString("id-ID")))
      .catch(() => setViews("0")); // Jika error/belum ada view, tampilkan 0
  }, [slug]);

  return (
    <div className="flex items-center gap-1" title={`${views} Pembaca`}>
      <FaRegEye />
      <span>{views} kali dibaca</span>
    </div>
  );
};

export default CardViewCounter;
