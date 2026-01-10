import React, { useEffect, useState } from "react";
import { FaUsers, FaEye } from "react-icons/fa";

const VisitorCounter = () => {
  // State untuk menangani jika script diblokir browser
  const [isError, setIsError] = useState(false);

  useEffect(() => {
    // Bersihkan script lama
    const existingScript = document.getElementById("busuanzi-main");
    if (existingScript) existingScript.remove();

    // Buat script baru
    const script = document.createElement("script");
    script.id = "busuanzi-main";
    // Tambahkan timestamp agar tidak di-cache oleh browser (?t=...)
    script.src = `//busuanzi.ibruce.info/busuanzi/2.3/busuanzi.pure.mini.js?t=${new Date().getTime()}`;
    script.async = true;
    script.referrerPolicy = "unsafe-url"; // Paksa policy di level script juga

    // Jika gagal memuat (kena AdBlock)
    script.onerror = () => {
      console.warn("Busuanzi blocked by browser/AdBlock");
      setIsError(true);
    };

    document.body.appendChild(script);
  }, []);

  if (isError) return null; // Sembunyikan jika error/diblokir

  return (
    <div className="mt-4 flex justify-center gap-6 text-xs text-text-light dark:text-darkmode-text-light opacity-80">
      <div className="flex items-center gap-2">
        <FaUsers className="text-primary" />
        <span id="busuanzi_container_site_uv" style={{ display: "none" }}>
          <span id="busuanzi_value_site_uv" className="font-bold">
            ...
          </span>{" "}
          Visitor
        </span>
      </div>
      <div className="flex items-center gap-2">
        <FaEye className="text-blue-500" />
        <span id="busuanzi_container_site_pv" style={{ display: "none" }}>
          <span id="busuanzi_value_site_pv" className="font-bold">
            ...
          </span>{" "}
          Views
        </span>
      </div>
    </div>
  );
};

export default VisitorCounter;
