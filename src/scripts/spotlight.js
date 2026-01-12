function handleMouseMove(e) {
  const btn = e.target.closest(".btn");

  if (btn) {
    const rect = btn.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;

    btn.style.setProperty("--x", `${x}px`);
    btn.style.setProperty("--y", `${y}px`);
  }
}

export function initSpotlightButtons() {
  document.removeEventListener("mousemove", handleMouseMove);

  document.addEventListener("mousemove", handleMouseMove);
}
