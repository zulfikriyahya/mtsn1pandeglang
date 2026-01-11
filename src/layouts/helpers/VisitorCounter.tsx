import React, { useEffect, useState } from "react";
import { FaEye } from "react-icons/fa";

const VisitorCounter = () => {
  const [visits, setVisits] = useState("...");

  useEffect(() => {
    // PENTING: Namespace hanya huruf kecil, tanpa titik/spasi
    const NAMESPACE = "mtsn1pandeglang";
    const KEY = "site_visits";

    const fetchVisits = async () => {
      try {
        // Gunakan /up untuk menambah
        const res = await fetch(
          `https://api.counterapi.dev/v1/${NAMESPACE}/${KEY}/up`,
        );
        if (!res.ok) throw new Error("Error");
        const data = await res.json();
        setVisits(data.count.toLocaleString("id-ID"));
      } catch (error) {
        // Fallback: Baca saja jika gagal nambah
        try {
          const resGet = await fetch(
            `https://api.counterapi.dev/v1/${NAMESPACE}/${KEY}`,
          );
          const dataGet = await resGet.json();
          setVisits(dataGet.count.toLocaleString("id-ID"));
        } catch (e) {
          console.error(e);
        }
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
