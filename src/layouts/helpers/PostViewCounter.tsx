import React, { useEffect, useState } from "react";
import { FaRegEye } from "react-icons/fa";

const PostViewCounter = () => {
  const [views, setViews] = useState<string>("...");
  const [isHidden, setIsHidden] = useState(false);

  useEffect(() => {
    const NAMESPACE = "mtsn1pandeglang_sch_id";

    // Ambil path URL, ganti slash dengan underscore agar valid
    let pathKey = window.location.pathname
      .replace(/^\/|\/$/g, "")
      .replace(/\//g, "_");
    if (!pathKey) pathKey = "home";

    // Prefix 'post_' untuk membedakan dengan counter lain
    const KEY = `post_${pathKey}`;

    const fetchCounter = async () => {
      try {
        // Increment
        const res = await fetch(
          `https://api.counterapi.dev/v1/${NAMESPACE}/${KEY}/up`,
        );
        if (!res.ok) throw new Error("Failed");
        const data = await res.json();
        setViews(data.count.toLocaleString("id-ID"));
      } catch (error) {
        // Fallback: Read Only
        try {
          const resRead = await fetch(
            `https://api.counterapi.dev/v1/${NAMESPACE}/${KEY}`,
          );
          if (!resRead.ok) throw new Error("Read Failed");
          const dataRead = await resRead.json();
          setViews(dataRead.count.toLocaleString("id-ID"));
        } catch (err) {
          setIsHidden(true); // Sembunyikan jika error total
        }
      }
    };

    fetchCounter();
  }, []);

  if (isHidden) return null;

  return (
    <span className="flex items-center gap-2" title="Jumlah Pembaca">
      <FaRegEye className="text-gray-500 dark:text-gray-400" />
      <span className="font-regular">{views}</span>
      <span className="text-md">kali dibaca</span>
    </span>
  );
};

export default PostViewCounter;
