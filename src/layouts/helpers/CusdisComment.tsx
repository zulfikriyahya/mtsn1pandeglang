import React, { useEffect, useState } from "react";

const CusdisComment = () => {
  // Masukkan App ID Anda dari cusdis.com di sini
  const CUSDIS_APP_ID = "ea71071e-0fc3-4d5d-896d-347ab601774f";

  const [theme, setTheme] = useState("light");

  useEffect(() => {
    // 1. Deteksi Dark Mode
    const updateTheme = () => {
      const isDark = document.documentElement.classList.contains("dark");
      setTheme(isDark ? "dark" : "light");
    };
    updateTheme();

    const observer = new MutationObserver(updateTheme);
    observer.observe(document.documentElement, {
      attributes: true,
      attributeFilter: ["class"],
    });

    // 2. Load Script Cusdis
    const script = document.createElement("script");
    script.src = "https://cusdis.com/js/cusdis.es.js";
    script.async = true;
    script.defer = true;
    document.body.appendChild(script);

    return () => {
      observer.disconnect();
      // Cleanup script jika perlu
      const existingScript = document.querySelector(
        'script[src="https://cusdis.com/js/cusdis.es.js"]',
      );
      if (existingScript) existingScript.remove();
    };
  }, []);

  return (
    <div className="mt-14 pt-10 border-t border-border dark:border-darkmode-border">
      <h3 className="h5 mb-6">Komentar</h3>
      <div
        id="cusdis_thread"
        data-host="https://cusdis.com"
        data-app-id={CUSDIS_APP_ID}
        data-page-id={
          typeof window !== "undefined" ? window.location.pathname : ""
        }
        data-page-url={
          typeof window !== "undefined" ? window.location.href : ""
        }
        data-page-title={typeof document !== "undefined" ? document.title : ""}
        data-theme={theme}
        data-lang="id" // Bahasa Indonesia
      ></div>
    </div>
  );
};

export default CusdisComment;
