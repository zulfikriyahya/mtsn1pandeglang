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

  useEffect(() => {
    // Check if dismissed in current session
    const sessionDismissed = sessionStorage.getItem("pwa-install-dismissed");

    // Detect iOS
    const isIOSDevice = /iPad|iPhone|iPod/.test(navigator.userAgent);
    setIsIOS(isIOSDevice);

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

    // Log untuk debugging
    console.log("InstallPrompt mounted, isIOS:", isIOSDevice);
    console.log("Session dismissed:", sessionDismissed);

    window.addEventListener("beforeinstallprompt", handleBeforeInstallPrompt);

    return () => {
      window.removeEventListener(
        "beforeinstallprompt",
        handleBeforeInstallPrompt,
      );
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
            {/* App Icon */}
            <div className="flex-shrink-0">
              <img
                src="/images/icons/icon-192x192.png"
                alt="App Icon"
                className="h-12 w-12 rounded-lg"
              />
            </div>

            {/* Content */}
            <div className="flex-1">
              <h3 className="mb-1 font-semibold text-dark dark:text-darkmode-dark">
                Install Aplikasi
              </h3>
              <p className="mb-3 text-sm text-text-light dark:text-darkmode-text-light">
                {isIOS
                  ? "Bagikan → Tambah ke Home Screen untuk akses lebih cepat!"
                  : "Install MTs Negeri 1 Pandeglang untuk akses lebih cepat dan bisa digunakan offline!"}
              </p>

              {/* Buttons */}
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
                  className="rounded-lg bg-theme-light px-4 py-2 text-sm font-semibold text-dark transition-opacity hover:opacity-90 dark:bg-darkmode-theme-light dark:text-darkmode-dark"
                >
                  {isIOS ? "Tutup" : "Nanti Saja"}
                </button>
              </div>
            </div>

            {/* Close Button */}
            <button
              onClick={handleDismiss}
              className="flex-shrink-0 text-text-light transition-colors hover:text-dark dark:text-darkmode-text-light dark:hover:text-darkmode-dark"
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
