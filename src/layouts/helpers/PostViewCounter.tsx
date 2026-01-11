import React, { useEffect, useState } from "react";
import { FaRegEye } from "react-icons/fa";

const PostViewCounter = () => {
  const [views, setViews] = useState("...");

  useEffect(() => {
    const NAMESPACE = "mtsn1pandeglang_official";

    // Ambil slug, bersihkan karakter aneh
    const pathSegments = window.location.pathname.split("/").filter(Boolean);
    const slug = pathSegments[pathSegments.length - 1] || "home";
    // Ganti karakter selain huruf/angka dengan underscore
    const safeSlug = slug.replace(/[^a-zA-Z0-9]/g, "_");

    const KEY = `post_${safeSlug}`;
    const callbackName = `cb_post_${Math.floor(Math.random() * 100000)}`;

    // 1. Callback JSONP
    // @ts-ignore
    window[callbackName] = (response) => {
      setViews(response.value.toLocaleString("id-ID"));
      // @ts-ignore
      delete window[callbackName];
      document.getElementById("script-post-view")?.remove();
    };

    // 2. Script Injection
    const script = document.createElement("script");
    script.id = "script-post-view";
    script.src = `https://api.countapi.xyz/hit/${NAMESPACE}/${KEY}?callback=${callbackName}`;

    document.body.appendChild(script);
  }, []);

  return (
    <span className="flex items-center gap-2" title="Jumlah Pembaca">
      <FaRegEye className="text-gray-500 dark:text-gray-400" />
      <span className="font-semibold">{views}</span>
      <span className="text-xs">kali dibaca</span>
    </span>
  );
};

export default PostViewCounter;
