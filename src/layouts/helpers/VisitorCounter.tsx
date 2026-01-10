import React, { useEffect, useState } from "react";
import { FaEye } from "react-icons/fa";

const VisitorCounter = () => {
  const [visits, setVisits] = useState<string>("...");
  const [isHidden, setIsHidden] = useState(false);

  useEffect(() => {
    // Ganti titik dengan underscore agar aman untuk ID
    const NAMESPACE = "mtsn1pandeglang_sch_id";
    const KEY = "site_visits";

    const fetchCounter = async () => {
      try {
        // Coba increment (tambah 1)
        const res = await fetch(
          `https://api.counterapi.dev/v1/${NAMESPACE}/${KEY}/up`,
        );

        if (!res.ok) throw new Error("Network response was not ok");

        const data = await res.json();
        setVisits(data.count.toLocaleString("id-ID"));
      } catch (error) {
        console.warn(
          "Counter blocked/error, switching to read-only or hiding.",
        );

        // Jika gagal nambah (mungkin karena refresh cepat), coba baca saja
        try {
          const resRead = await fetch(
            `https://api.counterapi.dev/v1/${NAMESPACE}/${KEY}`,
          );
          if (!resRead.ok) throw new Error("Read failed");
          const dataRead = await resRead.json();
          setVisits(dataRead.count.toLocaleString("id-ID"));
        } catch (err) {
          // Jika masih gagal (kena AdBlock parah), sembunyikan komponen
          setIsHidden(true);
        }
      }
    };

    fetchCounter();
  }, []);

  if (isHidden) return null;

  return (
    <div className="mt-4 flex justify-center text-xs text-text-light dark:text-darkmode-text-light opacity-80 transition-opacity duration-500">
      <div className="flex items-center gap-2" title="Total Kunjungan Website">
        <FaEye className="text-blue-500" />
        <span className="font-bold">{visits}</span>
        <span>Total Kunjungan</span>
      </div>
    </div>
  );
};

export default VisitorCounter;
