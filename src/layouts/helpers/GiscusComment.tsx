import React, { useEffect, useState } from "react";
import Giscus from "@giscus/react";

const GiscusComment = () => {
  // State untuk menyimpan tema Giscus
  const [theme, setTheme] = useState("light");

  useEffect(() => {
    // Fungsi untuk menentukan tema berdasarkan class 'dark' di <html>
    const updateGiscusTheme = () => {
      const isDark = document.documentElement.classList.contains("dark");

      // Pilih tema Giscus yang sesuai
      // 'transparent_dark' biasanya lebih menyatu daripada 'dark' biasa
      setTheme(isDark ? "transparent_dark" : "light");
    };

    // 1. Jalankan sekali saat komponen dimuat
    updateGiscusTheme();

    // 2. Pasang 'Mata-mata' (Observer) untuk memantau perubahan class di <html>
    const observer = new MutationObserver((mutations) => {
      mutations.forEach((mutation) => {
        if (
          mutation.type === "attributes" &&
          mutation.attributeName === "class"
        ) {
          updateGiscusTheme();
        }
      });
    });

    observer.observe(document.documentElement, {
      attributes: true,
      attributeFilter: ["class"], // Hanya pantau perubahan atribut class
    });

    // Cleanup saat komponen dilepas
    return () => observer.disconnect();
  }, []);

  return (
    <div className="mt-14 pt-10 border-t border-border dark:border-darkmode-border">
      <h3 className="h5 mb-6">Komentar</h3>
      <Giscus
        id="comments"
        repo="zulfikriyahya/mtsn1pandeglang"
        repoId="R_kgDOOC18-g"
        category="General"
        categoryId="DIC_kwDOOC18-s4C0zja"
        mapping="pathname"
        term="Komentar di MTsN 1 Pandeglang"
        reactionsEnabled="1"
        emitMetadata="0"
        inputPosition="top"
        theme={theme} // <--- Tema dinamis dari state
        lang="id"
        loading="lazy"
      />
    </div>
  );
};

export default GiscusComment;
