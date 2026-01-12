import React, { useEffect, useState } from "react";
import { FaEye } from "react-icons/fa";

const VisitorCounter = () => {
  const [visits, setVisits] = useState("...");

  useEffect(() => {
    const hasVisited = sessionStorage.getItem("session_visited");

    const fetchVisits = async () => {
      try {
        const url = "/api/stats.php?action=visit";
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
        <FaEye className="text-green-500" />
        <span className="font-bold">{visits}</span>
        <span>Total Kunjungan</span>
      </div>
    </div>
  );
};

export default VisitorCounter;
