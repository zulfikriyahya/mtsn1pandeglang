import React, { useState } from "react";
import { FaStar } from "react-icons/fa";

const ServiceRating = () => {
  const [rating, setRating] = useState(0);
  const [hover, setHover] = useState(0);
  const [name, setName] = useState("");
  const [message, setMessage] = useState("");
  const [status, setStatus] = useState<
    "idle" | "submitting" | "success" | "error"
  >("idle");
  const [responseMsg, setResponseMsg] = useState("");

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
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ name, rating, message }),
      });

      const data = await res.json();

      if (res.ok && data.status === "success") {
        setStatus("success");
        setResponseMsg(data.message);
        // Reset form
        setRating(0);
        setName("");
        setMessage("");
      } else {
        setStatus("error");
        setResponseMsg(data.message || "Terjadi kesalahan.");
      }
    } catch (error) {
      setStatus("error");
      setResponseMsg("Gagal menghubungi server.");
    }
  };

  return (
    <div className="rounded-xl border border-border bg-white p-8 shadow-sm dark:border-darkmode-border dark:bg-darkmode-body">
      <h3 className="h4 mb-2 text-center">Beri Penilaian Pelayanan</h3>
      <p className="mb-6 text-center text-sm text-text-light dark:text-darkmode-text-light">
        Kepuasan Anda adalah prioritas kami.
      </p>

      {status === "success" ? (
        <div className="rounded-lg bg-green-100 p-6 text-center text-green-700 dark:bg-green-900/30 dark:text-green-300">
          <p className="text-xl font-bold">🎉 Terima Kasih!</p>
          <p>{responseMsg}</p>
          <button
            onClick={() => setStatus("idle")}
            className="mt-4 text-sm underline hover:text-green-900"
          >
            Kirim penilaian lagi
          </button>
        </div>
      ) : (
        <form onSubmit={handleSubmit}>
          {/* Bintang */}
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
                    className="transition-colors duration-200"
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

          {/* Form Input */}
          <div className="space-y-4">
            <div>
              <label className="mb-1 block text-sm font-medium">
                Nama (Opsional)
              </label>
              <input
                type="text"
                className="form-input py-2 text-sm"
                placeholder="Nama Anda"
                value={name}
                onChange={(e) => setName(e.target.value)}
              />
            </div>
            <div>
              <label className="mb-1 block text-sm font-medium">
                Kritik & Saran
              </label>
              <textarea
                className="form-input py-2 text-sm"
                rows={3}
                placeholder="Tuliskan pengalaman Anda..."
                value={message}
                onChange={(e) => setMessage(e.target.value)}
              ></textarea>
            </div>
          </div>

          {status === "error" && (
            <p className="mt-4 text-center text-sm text-red-500">
              {responseMsg}
            </p>
          )}

          <button
            type="submit"
            disabled={status === "submitting"}
            className="btn btn-primary mt-6 w-full"
          >
            {status === "submitting" ? "Mengirim..." : "Kirim Penilaian"}
          </button>
        </form>
      )}
    </div>
  );
};

export default ServiceRating;
