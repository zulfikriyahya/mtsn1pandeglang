import React, { useEffect, useState } from "react";
import { FaRegEye } from "react-icons/fa";

const PostViewCounter = () => {
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    // Hapus script lama agar bisa memuat ulang hitungan untuk URL baru ini
    const existingScript = document.getElementById("busuanzi-script-post");
    if (existingScript) {
      existingScript.remove();
    }

    // Buat script baru khusus untuk halaman ini
    const script = document.createElement("script");
    script.id = "busuanzi-script-post";
    script.src = "//busuanzi.ibruce.info/busuanzi/2.3/busuanzi.pure.mini.js";
    script.async = true;

    script.onload = () => {
      // Beri sedikit jeda agar angka muncul
      setTimeout(() => setLoading(false), 500);
    };

    document.body.appendChild(script);

    // Cleanup
    return () => {
      const scriptToRemove = document.getElementById("busuanzi-script-post");
      if (scriptToRemove) scriptToRemove.remove();
    };
  }, []);

  return (
    <span className="flex items-center gap-2" title="Jumlah Pembaca">
      <FaRegEye className="text-gray-500 dark:text-gray-400" />

      {/* Container ini wajib ada agar script Busuanzi bisa mendeteksi dan mengisinya */}
      <span
        id="busuanzi_container_page_pv"
        className={loading ? "hidden" : "inline-block animate-fade-in"}
        style={{ display: loading ? "none" : "inline-block" }}
      >
        <span id="busuanzi_value_page_pv" className="font-semibold">
          ...
        </span>
      </span>

      {loading && <span className="text-xs opacity-50">...</span>}
    </span>
  );
};

export default PostViewCounter;
