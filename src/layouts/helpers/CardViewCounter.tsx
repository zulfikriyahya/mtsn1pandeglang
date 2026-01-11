import React, { useEffect, useState } from "react";
import { FaRegEye } from "react-icons/fa";

interface Props {
  slug: string; // ID artikel (slug)
}

const CardViewCounter = ({ slug }: Props) => {
  const [views, setViews] = useState("...");

  useEffect(() => {
    // Format Key sesuai dengan PostViewCounter: post_blog_judul-artikel
    const NAMESPACE = "mtsn1pandeglang_sch_id";
    const KEY = `post_blog_${slug}`;

    // Fetch mode baca saja (get)
    fetch(`https://api.counterapi.dev/v1/${NAMESPACE}/${KEY}`)
      .then((res) => res.json())
      .then((data) => setViews(data.count.toLocaleString("id-ID")))
      .catch(() => setViews("0"));
  }, [slug]);

  return (
    <div className="flex items-center gap-1" title={`${views} Pembaca`}>
      <FaRegEye />
      <span>{views}</span>
    </div>
  );
};

export default CardViewCounter;
