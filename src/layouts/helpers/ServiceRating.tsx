import React, { useState, useEffect } from "react";
import { FaStar, FaUserCheck } from "react-icons/fa";

const ServiceRating = () => {
  const [rating, setRating] = useState(0);
  const [hover, setHover] = useState(0);
  const [name, setName] = useState("");
  const [message, setMessage] = useState("");
  const [status, setStatus] = useState<
    "idle" | "loading" | "submitting" | "success" | "error" | "submitted"
  >("loading");
  const [responseMsg, setResponseMsg] = useState("");

  // State untuk menyimpan data statistik
  const [stats, setStats] = useState({ average: 0, total: 0 });

  // 1. Cek Status saat load
  useEffect(() => {
    const checkStatus = async () => {
      try {
        const res = await fetch("/api/feedback.php");
        const data = await res.json();

        if (data.stats) setStats(data.stats);

        if (data.has_submitted) {
          setStatus("submitted");
        } else {
          setStatus("idle");
        }
      } catch (error) {
        setStatus("error");
      }
    };
    checkStatus();
  }, []);

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    if (rating === 0) {
      alert("Mohon berikan bintang terlebih dahulu.");
      return;
    }

    setStatus("submitting");

    try {
      const res = await fetch("/api/feedback.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ name, rating, message }),
      });

      const data = await res.json();

      if (res.ok && data.status === "success") {
        setStatus("submitted"); // Ubah ke submitted agar tampil statistik
        if (data.stats) setStats(data.stats);
        setResponseMsg(data.message);
      } else {
        setStatus("error");
        setResponseMsg(data.message || "Terjadi kesalahan.");
      }
    } catch (error) {
      setStatus("error");
      setResponseMsg("Gagal menghubungi server.");
    }
  };

  // Tampilan Hasil Statistik (Jika sudah submit)
  if (status === "submitted") {
    return (
      <div className="rounded-xl border border-border bg-white p-8 shadow-sm text-center dark:border-darkmode-border dark:bg-darkmode-body">
        <div className="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-green-100 text-green-600 mb-4 animate-bounce">
          <FaUserCheck size={30} />
        </div>
        <h3 className="h4 mb-2 text-green-700 dark:text-green-400">
          Terima Kasih!
        </h3>
        <p className="mb-6 text-sm text-text-light">
          Anda sudah memberikan penilaian untuk layanan kami.
        </p>

        <div className="bg-light dark:bg-darkmode-light p-6 rounded-lg">
          <p className="text-sm font-semibold mb-2 uppercase tracking-wide text-text-light">
            Indeks Kepuasan Masyarakat
          </p>
          <div className="flex justify-center items-end gap-2 mb-2">
            <span className="text-5xl font-bold text-primary">
              {stats.average}
            </span>
            <span className="text-xl text-gray-400 mb-1">/ 5.0</span>
          </div>
          <div className="flex justify-center gap-1 mb-4">
            {[1, 2, 3, 4, 5].map((star) => (
              <FaStar
                key={star}
                size={20}
                className={
                  star <= Math.round(stats.average)
                    ? "text-yellow-400"
                    : "text-gray-300"
                }
              />
            ))}
          </div>
          <p className="text-xs text-text-light">
            Berdasarkan {stats.total} responden
          </p>
        </div>
      </div>
    );
  }

  if (status === "loading")
    return <div className="text-center p-8">Memuat data...</div>;

  return (
    <div className="rounded-xl border border-border bg-white p-8 shadow-sm dark:border-darkmode-border dark:bg-darkmode-body">
      <h3 className="h4 mb-2 text-center">Beri Penilaian Pelayanan</h3>
      <p className="mb-6 text-center text-sm text-text-light dark:text-darkmode-text-light">
        Bagaimana pengalaman Anda hari ini?
      </p>

      <form onSubmit={handleSubmit}>
        <div className="mb-6 flex justify-center gap-2">
          {[...Array(5)].map((_, index) => {
            const ratingValue = index + 1;
            return (
              <label key={index} className="cursor-pointer">
                <input
                  type="radio"
                  name="rating"
                  className="hidden"
                  value={ratingValue}
                  onClick={() => setRating(ratingValue)}
                />
                <FaStar
                  className="transition-transform duration-200 hover:scale-110"
                  size={35}
                  color={
                    ratingValue <= (hover || rating) ? "#ffc107" : "#e4e5e9"
                  }
                  onMouseEnter={() => setHover(ratingValue)}
                  onMouseLeave={() => setHover(0)}
                />
              </label>
            );
          })}
        </div>

        <div className="space-y-4">
          <div>
            <input
              type="text"
              className="form-input py-2 text-sm"
              placeholder="Nama Anda (Opsional)"
              value={name}
              onChange={(e) => setName(e.target.value)}
            />
          </div>
          <div>
            <textarea
              className="form-input py-2 text-sm"
              rows={3}
              placeholder="Kritik & Saran..."
              value={message}
              onChange={(e) => setMessage(e.target.value)}
            ></textarea>
          </div>
        </div>

        {status === "error" && (
          <p className="mt-4 text-center text-sm text-red-500">{responseMsg}</p>
        )}

        <button
          type="submit"
          disabled={status === "submitting"}
          className="btn btn-primary mt-6 w-full"
        >
          {status === "submitting" ? "Mengirim..." : "Kirim Penilaian"}
        </button>
      </form>
    </div>
  );
};

export default ServiceRating;
