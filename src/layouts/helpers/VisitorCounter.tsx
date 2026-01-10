import React, { useEffect, useState } from "react";
import { FaUsers, FaEye } from "react-icons/fa";

const VisitorCounter = () => {
  // State untuk menghindari flickering sebelum angka muncul
  const [isLoaded, setIsLoaded] = useState(false);

  useEffect(() => {
    // Fungsi untuk memuat script Busuanzi secara manual
    const loadScript = () => {
      // Hapus script lama jika ada (untuk mencegah duplikasi/konflik)
      const existingScript = document.getElementById("busuanzi-script");
      if (existingScript) {
        existingScript.remove();
      }

      // Buat elemen script baru
      const script = document.createElement("script");
      script.id = "busuanzi-script";
      script.src = "//busuanzi.ibruce.info/busuanzi/2.3/busuanzi.pure.mini.js";
      script.async = true;

      // Saat script selesai dimuat, elemen dengan ID busuanzi akan otomatis terisi
      script.onload = () => {
        // Beri sedikit jeda agar angka sempat dirender oleh script
        setTimeout(() => setIsLoaded(true), 500);
      };

      // Tempelkan ke body
      document.body.appendChild(script);
    };

    loadScript();

    // Cleanup saat komponen dilepas (opsional)
    return () => {
      const script = document.getElementById("busuanzi-script");
      if (script) script.remove();
    };
  }, []);

  return (
    <div className="mt-4 flex justify-center gap-6 text-xs text-text-light dark:text-darkmode-text-light opacity-80">
      {/* Total Pengunjung (UV - Unique Visitor) */}
      <div className="flex items-center gap-2" title="Total Pengunjung Unik">
        <FaUsers className="text-primary" />
        <span
          id="busuanzi_container_site_uv"
          className={isLoaded ? "inline-block animate-fade-in" : "hidden"}
        >
          <span id="busuanzi_value_site_uv" className="font-bold">
            ...
          </span>{" "}
          Visitor
        </span>
        {!isLoaded && <span>Memuat...</span>}
      </div>

      {/* Total Dilihat (PV - Page View) */}
      <div className="flex items-center gap-2" title="Total Halaman Dilihat">
        <FaEye className="text-blue-500" />
        <span
          id="busuanzi_container_site_pv"
          className={isLoaded ? "inline-block animate-fade-in" : "hidden"}
        >
          <span id="busuanzi_value_site_pv" className="font-bold">
            ...
          </span>{" "}
          Views
        </span>
        {!isLoaded && <span>Memuat...</span>}
      </div>
    </div>
  );
};

export default VisitorCounter;
