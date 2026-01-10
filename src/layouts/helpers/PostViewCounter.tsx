import React, { useEffect, useState } from "react";
import { FaRegEye } from "react-icons/fa";

const PostViewCounter = () => {
  const [isError, setIsError] = useState(false);

  useEffect(() => {
    const existingScript = document.getElementById("busuanzi-post");
    if (existingScript) existingScript.remove();

    const script = document.createElement("script");
    script.id = "busuanzi-post";
    script.src = `//busuanzi.ibruce.info/busuanzi/2.3/busuanzi.pure.mini.js?t=${new Date().getTime()}`;
    script.async = true;
    script.referrerPolicy = "unsafe-url";

    script.onerror = () => setIsError(true);

    document.body.appendChild(script);
  }, []);

  if (isError) return null;

  return (
    <span className="flex items-center gap-2" title="Jumlah Pembaca">
      <FaRegEye className="text-gray-500 dark:text-gray-400" />
      <span id="busuanzi_container_page_pv" style={{ display: "none" }}>
        <span id="busuanzi_value_page_pv" className="font-semibold">
          ...
        </span>
      </span>
    </span>
  );
};

export default PostViewCounter;
