import React, { useEffect, useState } from "react";
import Giscus from "@giscus/react";

const GiscusComment = () => {
  const [theme, setTheme] = useState("light");

  useEffect(() => {
    const updateGiscusTheme = () => {
      const isDark = document.documentElement.classList.contains("dark");
      setTheme(isDark ? "transparent_dark" : "light");
    };
    updateGiscusTheme();
    const observer = new MutationObserver((mutations) => {
      mutations.forEach((mutation) => {
        if (
          mutation.type === "attributes" &&
          mutation.attributeName === "class"
        ) {
          updateGiscusTheme();
        }
      });
    });

    observer.observe(document.documentElement, {
      attributes: true,
      attributeFilter: ["class"],
    });

    return () => observer.disconnect();
  }, []);

  return (
    <div className="mt-14 pt-10 border-t border-border dark:border-darkmode-border">
      <h3 className="h5 mb-6">Komentar</h3>
      <Giscus
        id="comments"
        repo="zulfikriyahya/mtsn1pandeglang"
        repoId="R_kgDOOC18-g"
        category="General"
        categoryId="DIC_kwDOOC18-s4C0zja"
        mapping="pathname"
        term="Komentar di MTsN 1 Pandeglang"
        reactionsEnabled="1"
        emitMetadata="0"
        inputPosition="top"
        theme={theme}
        lang="id"
        loading="lazy"
      />
    </div>
  );
};

export default GiscusComment;
