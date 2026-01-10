import React from "react";
import Giscus from "@giscus/react";

const GiscusComment = () => {
  return (
    <div className="mt-10">
      <Giscus
        id="comments"
        repo="zulfikriyahya/NAMA-REPO-ANDA" // Ganti dengan repo GitHub Anda
        repoId="R_kgDOOC18-g" // Ganti ID
        category="General"
        categoryId="DAPATKAN_DARI_GISCUS_APP" // Ganti ID
        mapping="pathname"
        term="Welcome to @giscus/react component!"
        reactionsEnabled="1"
        emitMetadata="1"
        inputPosition="top"
        theme="dark"
        lang="id"
        loading="lazy"
      />
    </div>
  );
};

export default GiscusComment;
