// Handler fungsi dipisah agar bisa dihapus/dipasang ulang saat navigasi halaman
function handleMouseMove(e) {
  // Cek apakah element yang di-hover (atau induknya) memiliki class ".btn"
  const btn = e.target.closest(".btn");

  // Jika ya, hitung posisi mouse relatif terhadap tombol tersebut
  if (btn) {
    const rect = btn.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;

    // Update variabel CSS hanya pada tombol yang sedang disentuh
    btn.style.setProperty("--x", `${x}px`);
    btn.style.setProperty("--y", `${y}px`);
  }
}

export function initSpotlightButtons() {
  // 1. Hapus listener lama (PENTING untuk Astro View Transitions agar tidak menumpuk)
  document.removeEventListener("mousemove", handleMouseMove);

  // 2. Pasang listener global ke dokumen
  document.addEventListener("mousemove", handleMouseMove);
}
