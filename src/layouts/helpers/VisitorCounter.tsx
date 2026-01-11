import React, { useEffect, useState } from "react";
import { FaEye } from "react-icons/fa";

const VisitorCounter = () => {
  const [visits, setVisits] = useState("...");

  useEffect(() => {
    // Namespace unik (Gunakan nama domain tanpa titik untuk aman)
    const NAMESPACE = "mtsn1pandeglang_official";
    const KEY = "site_visits";

    // Nama fungsi callback unik
    const callbackName = `cb_visits_${Math.floor(Math.random() * 100000)}`;

    // 1. Definisikan fungsi callback di window
    // @ts-ignore
    window[callbackName] = (response) => {
      setVisits(response.value.toLocaleString("id-ID"));
      // Bersihkan script setelah selesai
      // @ts-ignore
      delete window[callbackName];
      document.getElementById("script-visits")?.remove();
    };

    // 2. Buat script tag JSONP (Bypass CORS)
    const script = document.createElement("script");
    script.id = "script-visits";
    // ?callback=... adalah kunci JSONP
    script.src = `https://api.countapi.xyz/hit/${NAMESPACE}/${KEY}?callback=${callbackName}`;

    // 3. Eksekusi
    document.body.appendChild(script);
  }, []);

  return (
    <div className="mt-4 flex justify-center text-xs text-text-light dark:text-darkmode-text-light opacity-80">
      <div className="flex items-center gap-2" title="Total Kunjungan">
        <FaEye className="text-blue-500" />
        <span className="font-bold">{visits}</span>
        <span>Total Kunjungan</span>
      </div>
    </div>
  );
};

export default VisitorCounter;
