import React, { useEffect, useState } from "react";
import { FaEye } from "react-icons/fa";

const VisitorCounter = () => {
  const [visits, setVisits] = useState("...");

  // useEffect(() => {
  //   const NAMESPACE = "mtsn1pandeglang_v2";
  //   const KEY = "site_visits";
  //   const CALLBACK_NAME = `cb_visit_${Math.floor(Math.random() * 100000)}`;

  //   // 1. Definisikan Callback di Window
  //   // @ts-ignore
  //   window[CALLBACK_NAME] = (response) => {
  //     setVisits(response.value.toLocaleString("id-ID"));
  //     cleanup();
  //   };

  //   // 2. Buat Script JSONP
  //   const script = document.createElement("script");
  //   script.id = `script-${CALLBACK_NAME}`;
  //   // Gunakan /hit untuk menambah hitungan
  //   script.src = `https://api.countapi.xyz/hit/${NAMESPACE}/${KEY}?callback=${CALLBACK_NAME}`;

  //   // 3. Handle Error (Fallback ke LocalStorage jika script diblokir total)
  //   script.onerror = () => {
  //     let localCount = parseInt(
  //       localStorage.getItem("local_site_visits") || "0",
  //     );
  //     localCount++;
  //     localStorage.setItem("local_site_visits", localCount.toString());
  //     setVisits((1205 + localCount).toLocaleString("id-ID")); // Angka dummy + local
  //     cleanup();
  //   };

  //   document.body.appendChild(script);

  //   // Fungsi bersih-bersih
  //   const cleanup = () => {
  //     // @ts-ignore
  //     delete window[CALLBACK_NAME];
  //     document.getElementById(`script-${CALLBACK_NAME}`)?.remove();
  //   };

  //   return () => cleanup();
  // }, []);
  useEffect(() => {
    const hasVisited = sessionStorage.getItem("session_visited");

    const fetchVisits = async () => {
      try {
        // Panggil file PHP
        const url = "/api/stats.php?action=visit";

        // Jika belum visit, gunakan POST (untuk nambah), jika sudah GET (cuma baca)
        const method = !hasVisited ? "POST" : "GET";

        const response = await fetch(url, { method });
        if (response.ok) {
          const data = await response.json();
          setVisits(data.value.toLocaleString("id-ID"));
          if (!hasVisited) sessionStorage.setItem("session_visited", "true");
        }
      } catch (error) {
        console.error(error);
      }
    };
    fetchVisits();
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
