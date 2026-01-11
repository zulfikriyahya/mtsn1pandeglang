import React, { useEffect, useState } from "react";
import { FaRegEye } from "react-icons/fa";

const PostViewCounter = () => {
  const [views, setViews] = useState("...");

  useEffect(() => {
    const NAMESPACE = "mtsn1pandeglang_v2";

    // Logika Key: Ambil bagian terakhir URL, ganti karakter aneh dengan underscore
    const pathSegments = window.location.pathname.split("/").filter(Boolean);
    const slug = pathSegments[pathSegments.length - 1] || "home";
    const safeSlug = slug.replace(/[^a-zA-Z0-9]/g, "_");

    const KEY = `post_${safeSlug}`;
    const CALLBACK_NAME = `cb_post_${safeSlug}_${Math.floor(Math.random() * 100000)}`;

    // 1. Definisikan Callback
    // @ts-ignore
    window[CALLBACK_NAME] = (response) => {
      setViews(response.value.toLocaleString("id-ID"));
      // Simpan ke local storage agar CardView punya backup data jika API error
      localStorage.setItem(`local_view_${KEY}`, response.value);
      cleanup();
    };

    // 2. Buat Script JSONP
    const script = document.createElement("script");
    script.id = `script-${CALLBACK_NAME}`;
    // Gunakan /hit karena ini halaman baca (nambah view)
    script.src = `https://api.countapi.xyz/hit/${NAMESPACE}/${KEY}?callback=${CALLBACK_NAME}`;

    // 3. Fallback Error
    script.onerror = () => {
      const localKey = `local_view_${KEY}`;
      let localCount = parseInt(localStorage.getItem(localKey) || "0");
      localCount++;
      localStorage.setItem(localKey, localCount.toString());
      setViews(localCount > 0 ? localCount.toLocaleString("id-ID") : "1");
      cleanup();
    };

    document.body.appendChild(script);

    const cleanup = () => {
      // @ts-ignore
      delete window[CALLBACK_NAME];
      document.getElementById(`script-${CALLBACK_NAME}`)?.remove();
    };

    return () => cleanup();
  }, []);

  return (
    <span className="flex items-center gap-2" title="Jumlah Pembaca">
      <FaRegEye className="text-gray-500 dark:text-gray-400" />
      <span className="font-regular">{views}</span>
      <span className="text-md">kali dibaca</span>
    </span>
  );
};

export default PostViewCounter;
