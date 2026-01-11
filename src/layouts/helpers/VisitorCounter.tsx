import React, { useEffect, useState } from "react";
import { FaEye } from "react-icons/fa";

const VisitorCounter = () => {
  const [visits, setVisits] = useState<string>("...");
  const [isHidden, setIsHidden] = useState(false);

  useEffect(() => {
    const NAMESPACE = "mtsn1pandeglang";
    const KEY = "site-visits";

    const fetchCounter = async () => {
      try {
        // /hit = Tambah kunjungan
        const res = await fetch(
          `https://api.countapi.dev/hit/${NAMESPACE}/${KEY}`,
        );
        if (!res.ok) throw new Error("Network response was not ok");
        const data = await res.json();
        setVisits(data.value.toLocaleString("id-ID"));
      } catch (error) {
        try {
          // /get = Baca saja jika hit gagal
          const resRead = await fetch(
            `https://api.countapi.dev/get/${NAMESPACE}/${KEY}`,
          );
          if (!resRead.ok) throw new Error("Read failed");
          const dataRead = await resRead.json();
          setVisits(dataRead.value.toLocaleString("id-ID"));
        } catch (err) {
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
