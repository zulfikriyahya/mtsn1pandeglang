import React, { useEffect, useState } from "react";
import { FaRegEye } from "react-icons/fa";

interface Props {
  slug: string;
}

const CardViewCounter = ({ slug }: Props) => {
  const [views, setViews] = useState("0");

  useEffect(() => {
    const NAMESPACE = "mtsn1pandeglang_sch_id";
    // Pastikan format KEY ini sama persis dengan yang ada di PostViewCounter
    // slug biasanya: "judul-artikel" -> key: "post_blog_judul-artikel"
    const KEY = `post_blog_${slug}`;

    // Debugging: Cek di Console browser (F12) apakah Key-nya sudah benar
    // console.log("Fetching View untuk:", KEY);

    fetch(`https://api.counterapi.dev/v1/${NAMESPACE}/${KEY}`)
      .then((res) => {
        if (!res.ok) throw new Error("Data belum ada (404)");
        return res.json();
      })
      .then((data) => {
        setViews(data.count.toLocaleString("id-ID"));
      })
      .catch((err) => {
        // Jika error (artinya artikel belum pernah dibuka dengan sistem baru), biarkan 0
        setViews("0");
      });
  }, [slug]);

  return (
    <div className="flex items-center gap-1" title={`${views} kali dibaca`}>
      <FaRegEye className="text-gray-500" />
      <span>{views} kali dibaca</span>
    </div>
  );
};

export default CardViewCounter;
