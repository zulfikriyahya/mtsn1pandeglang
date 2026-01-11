import React, { useEffect, useState } from "react";
import { FaCookieBite, FaTimes } from "react-icons/fa";

declare global {
  interface Window {
    dataLayer: any[];
  }
}

const CookieConsent = () => {
  const [show, setShow] = useState(false);

  const grantConsent = () => {
    window.dataLayer = window.dataLayer || [];
    window.dataLayer.push({
      event: "consent_granted",
      consent_status: "granted",
    });

    console.log("GTM Consent: Granted");
  };

  useEffect(() => {
    const consent = localStorage.getItem("cookie-consent");

    if (consent === "accepted") {
      grantConsent();
    } else if (consent === "declined") {
    } else {
      const timer = setTimeout(() => setShow(true), 2000);
      return () => clearTimeout(timer);
    }
  }, []);

  const handleAccept = () => {
    localStorage.setItem("cookie-consent", "accepted");
    grantConsent();
    setShow(false);
  };

  const handleDecline = () => {
    localStorage.setItem("cookie-consent", "declined");
    setShow(false);
  };

  if (!show) return null;

  return (
    <div className="fixed bottom-4 right-4 z-[9999] w-[90%] max-w-sm animate-slide-up rounded-xl border border-border bg-white p-6 shadow-2xl dark:border-darkmode-border dark:bg-[#1a1d24]">
      <div className="mb-4 flex items-start gap-4">
        <div className="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-primary/10 text-primary dark:bg-primary/20">
          <FaCookieBite className="text-xl" />
        </div>
        <div>
          <h3 className="mb-1 text-lg font-bold text-dark dark:text-white">
            Persetujuan Cookie 🍪
          </h3>
          <p className="text-sm leading-relaxed text-text-light dark:text-darkmode-text-light">
            Kami menggunakan cookie untuk meningkatkan pengalaman Anda dan
            menganalisis trafik website.
          </p>
        </div>

        <button
          onClick={handleDecline}
          className="absolute right-2 top-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-200"
          aria-label="Tutup"
        >
          <FaTimes />
        </button>
      </div>

      <div className="flex flex-col gap-3 sm:flex-row">
        <button
          onClick={handleDecline}
          className="w-full rounded-lg border border-border bg-transparent px-4 py-2 text-sm font-semibold text-text-light transition-colors hover:bg-gray-100 hover:text-dark dark:border-darkmode-border dark:text-darkmode-text-light dark:hover:bg-white/5 dark:hover:text-white"
        >
          Tolak
        </button>
        <button
          onClick={handleAccept}
          className="w-full rounded-lg bg-primary px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-primary/20 transition-all hover:-translate-y-0.5 hover:shadow-primary/40 dark:text-black"
        >
          Terima Semua
        </button>
      </div>
    </div>
  );
};

export default CookieConsent;
