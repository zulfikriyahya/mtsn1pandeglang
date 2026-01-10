import React, { useEffect, useState } from "react";
import { FaEye } from "react-icons/fa";

const VisitorCounter = () => {
  const [visits, setVisits] = useState<string>("...");

  useEffect(() => {
    // Gunakan namespace unik, misal domain sekolah Anda
    const NAMESPACE = "mtsn1pandeglang.sch.id";
    const KEY = "total_visits"; // Key untuk total kunjungan situs

    // Panggil API (hit = tambah 1 kunjungan)
    fetch(`https://api.countapi.xyz/hit/${NAMESPACE}/${KEY}`)
      .then((res) => res.json())
      .then((data) => {
        setVisits(data.value.toLocaleString("id-ID")); // Format angka ribuan (1.234)
      })
      .catch((err) => {
        console.error("CounterAPI Error:", err);
        // Fallback jika error (misal jaringan down), ambil info saja tanpa nambah
        fetch(`https://api.countapi.xyz/get/${NAMESPACE}/${KEY}`)
          .then((res) => res.json())
          .then((data) => setVisits(data.value.toLocaleString("id-ID")))
          .catch(() => setVisits("Err"));
      });
  }, []);

  return (
    <div className="mt-4 flex justify-center text-xs text-text-light dark:text-darkmode-text-light opacity-80">
      <div className="flex items-center gap-2" title="Total Kunjungan Website">
        <FaEye className="text-blue-500" />
        <span className="font-bold">{visits}</span>
        <span>Total Kunjungan</span>
      </div>
    </div>
  );
};

export default VisitorCounter;
