import React, { useEffect, useState } from "react";

const TawkChat = () => {
  const [isLoaded, setIsLoaded] = useState(false);

  useEffect(() => {
    // 1. Cek Apakah di Homepage?
    // Jika path bukan "/" atau base url, jangan muat
    if (window.location.pathname !== "/") return;

    // 2. Delay Load (Agar tidak bentrok dengan popup cookie/install di awal)
    // Muncul setelah 5 detik
    const timer = setTimeout(() => {
      loadTawk();
    }, 5000);

    return () => clearTimeout(timer);
  }, []);

  const loadTawk = () => {
    // Cek jika script sudah ada
    if (document.getElementById("tawk-script")) return;

    const s1 = document.createElement("script");
    s1.id = "tawk-script";
    s1.async = true;
    s1.src = "https://embed.tawk.to/6703648b37379df10df31533/1i9ik1guj";
    s1.charset = "UTF-8";
    s1.setAttribute("crossorigin", "*");

    // Callback saat script selesai dimuat
    s1.onload = () => {
      setIsLoaded(true);
      initAnimationLoop();
    };

    document.head.appendChild(s1);
  };

  // 3. Logika Animasi (Sembunyi/Tampil per 10 detik)
  const initAnimationLoop = () => {
    // Pastikan Tawk API tersedia
    const interval = setInterval(() => {
      // @ts-ignore
      if (window.Tawk_API) {
        // @ts-ignore
        if (window.Tawk_API.isChatMinimized()) {
          // Jika sedang minimize, tampilkan (Maximize)
          // @ts-ignore
          window.Tawk_API.maximize();
        } else {
          // Jika sedang maximize, sembunyikan (Minimize)
          // @ts-ignore
          window.Tawk_API.minimize();
        }
      }
    }, 15000); // Set 15 detik agar user punya waktu baca chat

    // Cleanup interval saat unmount
    return () => clearInterval(interval);
  };

  return null; // Komponen ini tidak merender UI, hanya logic
};

export default TawkChat;
