import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
import Lenis from "lenis";

gsap.registerPlugin(ScrollTrigger);

export function initAnimations() {
  const lenis = new Lenis({
    duration: 1.2,
    easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
    orientation: "vertical",
    gestureDirection: "vertical",
    smoothWheel: true,
  });

  lenis.on("scroll", ScrollTrigger.update);

  gsap.ticker.add((time) => {
    lenis.raf(time * 1000);
  });

  gsap.ticker.lagSmoothing(0);

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
          start: "top 85%",
          toggleActions: "play none none reverse",
        },
      },
    );
  });

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
        stagger: 0.15,
        ease: "power2.out",
        scrollTrigger: {
          trigger: container,
          start: "top 85%",
        },
      },
    );
  });

  const heroImages = document.querySelectorAll(".gsap-hero-image");
  if (heroImages.length > 0) {
    gsap.fromTo(
      heroImages,
      { scale: 0.9, opacity: 0 },
      { scale: 1, opacity: 1, duration: 1.5, ease: "power2.out" },
    );
  }

  ScrollTrigger.refresh();
}
