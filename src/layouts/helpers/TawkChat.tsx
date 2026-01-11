import React, { useEffect, useRef } from "react";

// Menambahkan definisi tipe untuk window agar TypeScript tidak error
declare global {
  interface Window {
    Tawk_API: any;
    Tawk_LoadStart: Date;
  }
}

const TawkChat = () => {
  // Ref untuk menyimpan ID interval agar bisa dibersihkan
  const intervalRef = useRef<NodeJS.Timeout | null>(null);
  const isWidgetVisible = useRef(false);

  useEffect(() => {
    // 1. Cek Apakah di Homepage?
    if (window.location.pathname !== "/") return;

    // Cek jika script sudah ada agar tidak double
    if (document.getElementById("tawk-script")) return;

    // 2. Setup Variable Tawk
    window.Tawk_API = window.Tawk_API || {};
    window.Tawk_LoadStart = new Date();

    // 3. Inject Script
    const s1 = document.createElement("script");
    s1.id = "tawk-script";
    s1.async = true;
    s1.src = "https://embed.tawk.to/6703648b37379df10df31533/1i9ik1guj";
    s1.charset = "UTF-8";
    s1.setAttribute("crossorigin", "*");

    // 4. Logika setelah script selesai dimuat dari server Tawk
    s1.onload = () => {
      // Callback saat Tawk benar-benar siap
      window.Tawk_API.onLoad = function () {
        // A. Sembunyikan dulu di awal (biar Cookie Popup tampil duluan)
        window.Tawk_API.hideWidget();
        isWidgetVisible.current = false;

        // B. Tunggu 5 detik, baru mulai animasi loop
        setTimeout(() => {
          startAnimationLoop();
        }, 5000);
      };
    };

    document.head.appendChild(s1);

    // Cleanup saat pindah halaman
    return () => {
      if (intervalRef.current) clearInterval(intervalRef.current);
      // Opsional: Sembunyikan widget saat pindah dari homepage
      if (window.Tawk_API && window.Tawk_API.hideWidget) {
        window.Tawk_API.hideWidget();
      }
    };
  }, []);

  const startAnimationLoop = () => {
    // Jalankan pertama kali (Munculkan)
    toggleWidget();

    // Ulangi setiap 10 detik
    intervalRef.current = setInterval(() => {
      toggleWidget();
    }, 10000);
  };

  const toggleWidget = () => {
    if (!window.Tawk_API) return;

    // PENTING: Jangan sembunyikan jika user sedang membuka chat (isChatMaximized)
    if (window.Tawk_API.isChatMaximized()) {
      return;
    }

    if (isWidgetVisible.current) {
      // Jika sedang tampil -> Sembunyikan
      window.Tawk_API.hideWidget();
      isWidgetVisible.current = false;
    } else {
      // Jika sedang sembunyi -> Tampilkan
      window.Tawk_API.showWidget();
      isWidgetVisible.current = true;
    }
  };

  return null; // Tidak merender UI apa-apa, hanya logic
};

export default TawkChat;
