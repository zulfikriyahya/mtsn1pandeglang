import React, { useEffect, useState } from "react";
import { FaRegEye } from "react-icons/fa";

interface Props {
  slug: string;
}

const CardViewCounter = ({ slug }: Props) => {
  const [views, setViews] = useState("0");

  useEffect(() => {
    const NAMESPACE = "mtsn1pandeglang_v2";
    const safeSlug = slug.replace(/[^a-zA-Z0-9]/g, "_");
    const KEY = `post_${safeSlug}`;

    // Buat nama callback unik
    const callbackName = `cb_card_${safeSlug}_${Math.floor(Math.random() * 1000)}`;

    // 1. Definisikan Callback
    // @ts-ignore
    window[callbackName] = (response) => {
      setViews(response.value.toLocaleString("id-ID"));
      // Bersih-bersih
      // @ts-ignore
      delete window[callbackName];
      document.getElementById(`script-${callbackName}`)?.remove();
    };

    // 2. Inject Script JSONP (Gunakan /info agar tidak nambah hitungan)
    const script = document.createElement("script");
    script.id = `script-${callbackName}`;
    script.src = `https://api.countapi.xyz/info/${NAMESPACE}/${KEY}?callback=${callbackName}`;

    // Handle Error Script (Jika diblokir AdBlock)
    script.onerror = () => {
      // Silent fail atau fallback ke local storage
      const localKey = `local_view_${KEY}`;
      const localData = localStorage.getItem(localKey);
      if (localData) setViews(parseInt(localData).toLocaleString("id-ID"));
    };

    document.body.appendChild(script);

    // Cleanup jika komponen unmount cepat
    return () => {
      // @ts-ignore
      if (window[callbackName]) {
        // @ts-ignore
        delete window[callbackName];
        document.getElementById(`script-${callbackName}`)?.remove();
      }
    };
  }, [slug]);

  return (
    <div className="flex items-center gap-1" title={`${views} kali dibaca`}>
      <FaRegEye className="text-gray-500" />
      <span>{views} kali dibaca</span>
    </div>
  );
};

export default CardViewCounter;
