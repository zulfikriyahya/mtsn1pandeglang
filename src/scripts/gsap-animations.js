import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

// Daftarkan plugin
gsap.registerPlugin(ScrollTrigger);

export function initAnimations() {
  // 1. Animasi Fade Up (Muncul dari bawah ke atas)
  // Gunakan class="gsap-fade-up" pada elemen HTML
  const fadeUpElements = document.querySelectorAll(".gsap-fade-up");

  fadeUpElements.forEach((elem) => {
    gsap.fromTo(
      elem,
      {
        y: 50,
        opacity: 0,
      },
      {
        y: 0,
        opacity: 1,
        duration: 1,
        ease: "power3.out",
        scrollTrigger: {
          trigger: elem,
          start: "top 85%", // Mulai animasi saat elemen berada di 85% viewport
          toggleActions: "play none none reverse", // Mainkan saat masuk, reverse saat keluar
        },
      },
    );
  });

  // 2. Animasi Stagger (Muncul berurutan untuk list/grid)
  // Gunakan class="gsap-stagger-parent" pada container (ul/div pembungkus)
  // Elemen anaknya akan otomatis di-animasikan
  const staggerContainers = document.querySelectorAll(".gsap-stagger-parent");

  staggerContainers.forEach((container) => {
    const children = container.children;

    gsap.fromTo(
      children,
      {
        y: 30,
        opacity: 0,
      },
      {
        y: 0,
        opacity: 1,
        duration: 0.8,
        stagger: 0.15, // Jeda antar elemen 0.15 detik
        ease: "power2.out",
        scrollTrigger: {
          trigger: container,
          start: "top 85%",
        },
      },
    );
  });

  // 3. Animasi Hero Image (Zoom in halus saat load)
  // Gunakan class="gsap-hero-image"
  const heroImages = document.querySelectorAll(".gsap-hero-image");
  if (heroImages.length > 0) {
    gsap.fromTo(
      heroImages,
      { scale: 0.9, opacity: 0 },
      { scale: 1, opacity: 1, duration: 1.5, ease: "power2.out" },
    );
  }

  // Refresh ScrollTrigger agar akurat setelah loading konten
  ScrollTrigger.refresh();
}
