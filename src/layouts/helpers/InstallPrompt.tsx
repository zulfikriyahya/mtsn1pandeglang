import type { ReactElement } from "react";
import { useEffect, useState } from "react";

interface BeforeInstallPromptEvent extends Event {
  prompt: () => Promise<void>;
  userChoice: Promise<{ outcome: "accepted" | "dismissed" }>;
}

const InstallPrompt = () => {
  const [deferredPrompt, setDeferredPrompt] =
    useState<BeforeInstallPromptEvent | null>(null);
  const [showInstallPrompt, setShowInstallPrompt] = useState(false);
  const [isIOS, setIsIOS] = useState(false);
  const [isDarkMode, setIsDarkMode] = useState(false);

  useEffect(() => {
    const sessionDismissed = sessionStorage.getItem("pwa-install-dismissed");
    const isIOSDevice = /iPad|iPhone|iPod/.test(navigator.userAgent);
    setIsIOS(isIOSDevice);
    const isDark = document.documentElement.classList.contains("dark");
    setIsDarkMode(isDark);
    const observer = new MutationObserver(() => {
      const isDark = document.documentElement.classList.contains("dark");
      setIsDarkMode(isDark);
    });

    observer.observe(document.documentElement, {
      attributes: true,
      attributeFilter: ["class"],
    });

    const handleBeforeInstallPrompt = (e: Event) => {
      console.log("beforeinstallprompt event fired");
      e.preventDefault();
      setDeferredPrompt(e as BeforeInstallPromptEvent);

      if (!sessionDismissed) {
        setTimeout(() => {
          console.log("Showing install prompt");
          setShowInstallPrompt(true);
        }, 3000);
      }
    };

    console.log("InstallPrompt mounted, isIOS:", isIOSDevice);
    console.log("Session dismissed:", sessionDismissed);

    window.addEventListener("beforeinstallprompt", handleBeforeInstallPrompt);

    return () => {
      window.removeEventListener(
        "beforeinstallprompt",
        handleBeforeInstallPrompt,
      );
      observer.disconnect();
    };
  }, []);

  const handleInstall = async () => {
    if (!deferredPrompt) return;

    try {
      await deferredPrompt.prompt();
      const { outcome } = await deferredPrompt.userChoice;

      if (outcome === "accepted") {
        console.log("PWA installed successfully");
      }

      setDeferredPrompt(null);
      setShowInstallPrompt(false);
      sessionStorage.setItem("pwa-install-dismissed", "true");
    } catch (error) {
      console.error("Error installing PWA:", error);
    }
  };

  const handleDismiss = () => {
    setShowInstallPrompt(false);
    sessionStorage.setItem("pwa-install-dismissed", "true");
  };

  if (!showInstallPrompt) return null;

  return (
    <div className="fixed bottom-4 left-4 right-4 md:left-auto md:right-4 md:w-96 z-50 animate-slide-up">
      <div className="rounded-lg border border-border bg-white shadow-2xl dark:border-darkmode-border dark:bg-darkmode-body">
        <div className="p-4">
          <div className="flex items-start gap-3">
            <div className="flex-shrink-0">
              <img
                src="/images/icons/icon-192x192.png"
                alt="App Icon"
                className="h-12 w-12 rounded-lg"
              />
            </div>

            <div className="flex-1">
              <h3 className="mb-1 font-semibold text-dark dark:text-white">
                Install Aplikasi
              </h3>
              <p className="mb-3 text-sm text-gray-600 dark:text-gray-300">
                {isIOS
                  ? "Bagikan → Tambah ke Home Screen untuk akses lebih cepat!"
                  : "Install MTs Negeri 1 Pandeglang untuk akses lebih cepat dan bisa digunakan offline!"}
              </p>

              <div className="flex gap-2">
                {!isIOS && deferredPrompt && (
                  <button
                    onClick={handleInstall}
                    className="rounded-lg bg-primary px-4 py-2 text-sm font-semibold text-white transition-opacity hover:opacity-90"
                  >
                    Install Sekarang
                  </button>
                )}
                <button
                  onClick={handleDismiss}
                  className="rounded-lg bg-gray-200 px-4 py-2 text-sm font-semibold text-gray-900 transition-opacity hover:opacity-90 dark:bg-gray-700 dark:text-gray-100"
                >
                  {isIOS ? "Tutup" : "Nanti Saja"}
                </button>
              </div>
            </div>

            <button
              onClick={handleDismiss}
              className="flex-shrink-0 text-gray-500 transition-colors hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200"
              aria-label="Close"
            >
              <svg
                className="h-5 w-5"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  strokeLinecap="round"
                  strokeLinejoin="round"
                  strokeWidth={2}
                  d="M6 18L18 6M6 6l12 12"
                />
              </svg>
            </button>
          </div>
        </div>
      </div>
    </div>
  );
};

export default InstallPrompt;
