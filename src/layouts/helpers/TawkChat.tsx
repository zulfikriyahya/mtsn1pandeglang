import React, { useEffect, useRef } from "react";
declare global {
  interface Window {
    Tawk_API: any;
    Tawk_LoadStart: Date;
  }
}

const TawkChat = () => {
  const intervalRef = useRef<NodeJS.Timeout | null>(null);
  const isWidgetVisible = useRef(false);

  useEffect(() => {
    if (window.location.pathname !== "/") return;
    if (document.getElementById("tawk-script")) return;
    window.Tawk_API = window.Tawk_API || {};
    window.Tawk_LoadStart = new Date();
    const s1 = document.createElement("script");
    s1.id = "tawk-script";
    s1.async = true;
    s1.src = "https://embed.tawk.to/6703648b37379df10df31533/1i9ik1guj";
    s1.charset = "UTF-8";
    s1.setAttribute("crossorigin", "*");
    s1.onload = () => {
      window.Tawk_API.onLoad = function () {
        window.Tawk_API.hideWidget();
        isWidgetVisible.current = false;
        setTimeout(() => {
          startAnimationLoop();
        }, 5000);
      };
    };

    document.head.appendChild(s1);
    return () => {
      if (intervalRef.current) clearInterval(intervalRef.current);
      if (window.Tawk_API && window.Tawk_API.hideWidget) {
        window.Tawk_API.hideWidget();
      }
    };
  }, []);

  const startAnimationLoop = () => {
    toggleWidget();
    intervalRef.current = setInterval(() => {
      toggleWidget();
    }, 10000);
  };

  const toggleWidget = () => {
    if (!window.Tawk_API) return;
    if (window.Tawk_API.isChatMaximized()) {
      return;
    }

    if (isWidgetVisible.current) {
      window.Tawk_API.hideWidget();
      isWidgetVisible.current = false;
    } else {
      window.Tawk_API.showWidget();
      isWidgetVisible.current = true;
    }
  };

  return null;
};

export default TawkChat;
