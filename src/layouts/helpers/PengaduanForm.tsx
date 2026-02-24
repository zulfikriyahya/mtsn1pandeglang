import React, { useState, useEffect } from "react";
import {
  FaUser,
  FaEnvelope,
  FaPhone,
  FaExclamationTriangle,
  FaPaperPlane,
  FaCheckCircle,
  FaTimesCircle,
} from "react-icons/fa";

const PengaduanForm = () => {
  const [formData, setFormData] = useState({
    nama: "",
    email: "",
    telepon: "",
    kategori: "Pelayanan",
    judul: "",
    isi_pengaduan: "",
  });

  const [status, setStatus] = useState<
    "idle" | "loading" | "success" | "error"
  >("idle");
  const [message, setMessage] = useState("");

  const kategoriOptions = [
    "Pelayanan",
    "Fasilitas",
    "Akademik",
    "Keuangan",
    "SDM",
    "Lainnya",
  ];

  const handleChange = (
    e: React.ChangeEvent<
      HTMLInputElement | HTMLTextAreaElement | HTMLSelectElement
    >,
  ) => {
    setFormData({
      ...formData,
      [e.target.name]: e.target.value,
    });
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    setStatus("loading");

    try {
      const res = await fetch("/api/pengaduan.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(formData),
      });

      const result = await res.json();

      if (result.status === "success") {
        setStatus("success");
        setMessage(result.message);
        setFormData({
          nama: "",
          email: "",
          telepon: "",
          kategori: "Pelayanan",
          judul: "",
          isi_pengaduan: "",
        });
      } else {
        setStatus("error");
        setMessage(result.message || "Terjadi kesalahan.");
      }
    } catch (error) {
      setStatus("error");
      setMessage("Gagal menghubungi server.");
    }
  };

  if (status === "success") {
    return (
      <div className="rounded-xl border border-border bg-white p-8 shadow-sm text-center dark:border-darkmode-border dark:bg-darkmode-body">
        <div className="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-green-100 text-green-600 mb-4 animate-bounce">
          <FaCheckCircle size={30} />
        </div>
        <h3 className="h4 mb-2 text-green-700 dark:text-green-400">
          Pengaduan Terkirim!
        </h3>
        <p className="mb-6 text-sm text-text-light">{message}</p>
        <button
          onClick={() => setStatus("idle")}
          className="btn btn-primary"
        >
          Kirim Pengaduan Lain
        </button>
      </div>
    );
  }

  return (
    <div className="rounded-xl border border-border bg-white p-8 shadow-sm dark:border-darkmode-border dark:bg-darkmode-body">
      <h3 className="h4 mb-6 text-center">Form Pengaduan</h3>

      <form onSubmit={handleSubmit} className="space-y-6">
        {/* Nama */}
        <div>
          <label className="form-label flex items-center gap-2">
            <FaUser className="text-primary" />
            Nama Lengkap <span className="text-red-500">*</span>
          </label>
          <input
            type="text"
            name="nama"
            value={formData.nama}
            onChange={handleChange}
            className="form-input"
            placeholder="Nama lengkap Anda"
            required
          />
        </div>

        {/* Email */}
        <div>
          <label className="form-label flex items-center gap-2">
            <FaEnvelope className="text-primary" />
            Email <span className="text-red-500">*</span>
          </label>
          <input
            type="email"
            name="email"
            value={formData.email}
            onChange={handleChange}
            className="form-input"
            placeholder="email@example.com"
            required
          />
        </div>

        {/* Telepon */}
        <div>
          <label className="form-label flex items-center gap-2">
            <FaPhone className="text-primary" />
            Nomor Telepon
          </label>
          <input
            type="tel"
            name="telepon"
            value={formData.telepon}
            onChange={handleChange}
            className="form-input"
            placeholder="08123456789"
          />
        </div>

        {/* Kategori */}
        <div>
          <label className="form-label flex items-center gap-2">
            <FaExclamationTriangle className="text-primary" />
            Kategori Pengaduan <span className="text-red-500">*</span>
          </label>
          <select
            name="kategori"
            value={formData.kategori}
            onChange={handleChange}
            className="form-input cursor-pointer"
            required
          >
            {kategoriOptions.map((kat) => (
              <option key={kat} value={kat}>
                {kat}
              </option>
            ))}
          </select>
        </div>

        {/* Judul */}
        <div>
          <label className="form-label">
            Judul Pengaduan <span className="text-red-500">*</span>
          </label>
          <input
            type="text"
            name="judul"
            value={formData.judul}
            onChange={handleChange}
            className="form-input"
            placeholder="Ringkasan pengaduan Anda"
            required
          />
        </div>

        {/* Isi Pengaduan */}
        <div>
          <label className="form-label">
            Isi Pengaduan <span className="text-red-500">*</span>
          </label>
          <textarea
            name="isi_pengaduan"
            value={formData.isi_pengaduan}
            onChange={handleChange}
            className="form-input"
            rows={6}
            placeholder="Jelaskan pengaduan Anda secara detail..."
            required
          ></textarea>
        </div>

        {/* Status Error */}
        {status === "error" && (
          <div className="p-4 bg-red-100 text-red-700 rounded-lg flex items-center gap-3">
            <FaTimesCircle className="text-xl" />
            <p className="text-sm">{message}</p>
          </div>
        )}

        {/* Submit Button */}
        <button
          type="submit"
          disabled={status === "loading"}
          className="btn btn-primary w-full flex items-center justify-center gap-2"
        >
          {status === "loading" ? (
            <>
              <div className="animate-spin h-5 w-5 border-2 border-white border-t-transparent rounded-full"></div>
              Mengirim...
            </>
          ) : (
            <>
              <FaPaperPlane /> Kirim Pengaduan
            </>
          )}
        </button>
      </form>

      <div className="mt-6 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
        <p className="text-xs text-gray-600 dark:text-gray-300">
          <strong>Catatan:</strong> Pengaduan Anda akan kami proses dan ditindaklanjuti 
          maksimal 3x24 jam. Kami akan menghubungi Anda melalui email atau telepon 
          yang telah didaftarkan.
        </p>
      </div>
    </div>
  );
};

export default PengaduanForm;