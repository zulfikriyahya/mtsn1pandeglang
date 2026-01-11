import React, { useEffect, useState } from "react";
import { FaRegEye } from "react-icons/fa";

interface Props {
  slug: string;
}

const CardViewCounter = ({ slug }: Props) => {
  const [views, setViews] = useState("0");

  useEffect(() => {
    const safeSlug = slug.replace(/[^a-zA-Z0-9]/g, "_");
    const fetchViews = async () => {
      try {
        const response = await fetch(
          `/api/stats.php?action=view&slug=${safeSlug}`,
        );
        if (response.ok) {
          const data = await response.json();
          setViews(data.value.toLocaleString("id-ID"));
        }
      } catch (error) {}
    };
    fetchViews();
  }, [slug]);

  return (
    <div className="flex items-center gap-1" title={`${views} Kali dibaca`}>
      <FaRegEye className="text-gray-500" />
      <span>{views} Kali dibaca</span>
    </div>
  );
};

export default CardViewCounter;
