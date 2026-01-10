import React, { useState, useEffect, useCallback } from "react";
import { FaPlay, FaTimes } from "react-icons/fa";

interface VideoModalProps {
  videoId?: string;
  src?: string;
  label?: string;
}

const VideoModal = ({
  videoId,
  src,
  label = "Tonton Video",
}: VideoModalProps) => {
  const [isMounted, setIsMounted] = useState(false);
  const [isVisible, setIsVisible] = useState(false);

  const openModal = () => {
    setIsMounted(true);
    setTimeout(() => setIsVisible(true), 10);
  };

  const closeModal = useCallback(() => {
    setIsVisible(false);
    setTimeout(() => {
      setIsMounted(false);
    }, 300);
  }, []);

  // Handle ESC key
  useEffect(() => {
    const handleEsc = (e: KeyboardEvent) => {
      if (e.key === "Escape") closeModal();
    };

    if (isMounted) {
      document.addEventListener("keydown", handleEsc);
      document.body.style.overflow = "hidden";
    } else {
      document.body.style.overflow = "unset";
    }

    return () => {
      document.removeEventListener("keydown", handleEsc);
      document.body.style.overflow = "unset";
    };
  }, [isMounted, closeModal]);

  return (
    <>
      {/* 
        KITA KEMBALI KE CLASS STANDAR 
        Efek animasi & spotlight sekarang ditangani oleh global CSS & JS
      */}
      <button
        onClick={openModal}
        className="btn btn-outline-primary mb-4 ml-0 md:ml-4 gap-2"
        type="button"
      >
        <FaPlay className="text-xs" />
        {label}
      </button>

      {/* Render Modal Fullscreen */}
      {isMounted && (
        <div
          className={`fixed inset-0 z-[9999] bg-black transition-opacity duration-300 ease-in-out ${
            isVisible ? "opacity-100" : "opacity-0"
          }`}
        >
          {/* Tombol Close */}
          <button
            onClick={closeModal}
            className={`absolute right-6 top-6 z-50 rounded-full bg-black/40 p-3 text-white backdrop-blur-md transition-all duration-500 hover:bg-white hover:text-black hover:rotate-90 ${
              isVisible
                ? "translate-y-0 opacity-100"
                : "-translate-y-10 opacity-0"
            }`}
            aria-label="Tutup Video"
          >
            <FaTimes size={24} />
          </button>

          {/* Container Video */}
          <div className="absolute inset-0 flex h-full w-full items-center justify-center">
            {videoId ? (
              <iframe
                className="h-full w-full"
                src={`https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0&modestbranding=1`}
                title="YouTube video player"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowFullScreen
              ></iframe>
            ) : (
              <video
                src={src}
                className="h-full w-full object-contain"
                controls
                autoPlay
                playsInline
              >
                Browser Anda tidak mendukung tag video.
              </video>
            )}
          </div>
        </div>
      )}
    </>
  );
};

export default VideoModal;
