import React, { useState, useEffect } from "react";
import {
  FaCheck,
  FaChevronLeft,
  FaChevronRight,
  FaUser,
  FaBuilding,
  FaConciergeBell,
  FaGraduationCap,
  FaPaperPlane,
  FaChartBar,
} from "react-icons/fa";

// Data Pertanyaan Lengkap (Mengacu pada standar Pelayanan Publik & ZI WBK)
const surveyData = [
  {
    id: "zi",
    title: "Zona Integritas",
    icon: <FaBuilding />,
    description:
      "Penilaian terkait transparansi, anti-korupsi, dan integritas petugas.",
    questions: [
      {
        id: "zi_1",
        text: "Tidak ada pungutan liar (pungli) atau permintaan imbalan di luar ketentuan resmi.",
      },
      {
        id: "zi_2",
        text: "Petugas menolak segala bentuk gratifikasi (hadiah/uang pelicin).",
      },
      {
        id: "zi_3",
        text: "Prosedur pelayanan transparan, mudah dipahami, dan tidak berbelit-belit.",
      },
      {
        id: "zi_4",
        text: "Terdapat sarana pengaduan yang jelas dan responsif jika terjadi penyimpangan.",
      },
      {
        id: "zi_5",
        text: "Informasi persyaratan dan biaya layanan ditampilkan secara terbuka dan mudah diakses.",
      },
      {
        id: "zi_6",
        text: "Petugas menunjukkan sikap profesional dan tidak diskriminatif dalam memberikan layanan.",
      },
      {
        id: "zi_7",
        text: "Sistem pengaduan dan penanganan keluhan berjalan efektif dan dapat dipertanggungjawabkan.",
      },
      {
        id: "zi_8",
        text: "Terdapat keterbukaan informasi publik yang dapat diakses dengan mudah oleh masyarakat.",
      },
    ],
  },
  {
    id: "service",
    title: "Pelayanan PTSP",
    icon: <FaConciergeBell />,
    description:
      "Kualitas layanan administrasi, fasilitas, dan kesigapan petugas di ruang PTSP.",
    questions: [
      {
        id: "srv_1",
        text: "Petugas melayani dengan sikap ramah, sopan, santun, dan profesional (3S: Senyum, Sapa, Salam).",
      },
      {
        id: "srv_2",
        text: "Ruang tunggu pelayanan nyaman, bersih, dan dilengkapi fasilitas pendukung yang memadai.",
      },
      {
        id: "srv_3",
        text: "Waktu penyelesaian layanan cepat dan sesuai dengan standar waktu yang dijanjikan.",
      },
      {
        id: "srv_4",
        text: "Petugas memiliki kompetensi dan pengetahuan yang baik dalam memberikan solusi atau informasi.",
      },
      {
        id: "srv_5",
        text: "Sistem antrian terorganisir dengan baik dan adil bagi semua pemohon layanan.",
      },
      {
        id: "srv_6",
        text: "Tersedia informasi yang jelas mengenai alur dan tahapan pelayanan.",
      },
      {
        id: "srv_7",
        text: "Fasilitas toilet, mushola, dan area parkir tersedia dan dalam kondisi baik.",
      },
      {
        id: "srv_8",
        text: "Petugas responsif dalam menanggapi pertanyaan dan menyelesaikan masalah yang dihadapi.",
      },
      {
        id: "srv_9",
        text: "Formulir dan dokumen persyaratan mudah didapatkan dan dipahami.",
      },
      {
        id: "srv_10",
        text: "Terdapat layanan pengaduan atau kotak saran yang mudah diakses.",
      },
    ],
  },
  {
    id: "academic",
    title: "Akademik & Pembelajaran",
    icon: <FaGraduationCap />,
    description:
      "Kualitas proses belajar mengajar, kompetensi guru, dan fasilitas pendidikan.",
    questions: [
      {
        id: "acd_1",
        text: "Guru menguasai materi pembelajaran dengan baik dan menyampaikannya secara menarik.",
      },
      {
        id: "acd_2",
        text: "Komunikasi antara sekolah (Wali Kelas/Guru) dan Wali Murid berjalan lancar dan terbuka.",
      },
      {
        id: "acd_3",
        text: "Fasilitas pembelajaran (kelas, lab, perpustakaan) mendukung kebutuhan belajar siswa.",
      },
      {
        id: "acd_4",
        text: "Sekolah aktif memberikan informasi perkembangan akademik dan karakter siswa secara berkala.",
      },
      {
        id: "acd_5",
        text: "Metode pembelajaran yang digunakan guru bervariasi dan sesuai dengan kebutuhan siswa.",
      },
      {
        id: "acd_6",
        text: "Guru memberikan perhatian dan bimbingan yang memadai kepada setiap siswa.",
      },
      {
        id: "acd_7",
        text: "Penilaian hasil belajar dilakukan secara objektif, transparan, dan tepat waktu.",
      },
      {
        id: "acd_8",
        text: "Sekolah menyediakan program ekstrakurikuler yang beragam dan berkualitas.",
      },
      {
        id: "acd_9",
        text: "Fasilitas teknologi (komputer, internet, media pembelajaran digital) memadai dan dimanfaatkan dengan baik.",
      },
      {
        id: "acd_10",
        text: "Lingkungan sekolah kondusif, aman, dan mendukung proses pembelajaran yang efektif.",
      },
      {
        id: "acd_11",
        text: "Sekolah melakukan evaluasi dan perbaikan berkelanjutan terhadap kualitas pembelajaran.",
      },
      {
        id: "acd_12",
        text: "Guru menerapkan pendidikan karakter dan nilai-nilai positif dalam pembelajaran sehari-hari.",
      },
    ],
  },
];

const SurveyWizard = () => {
  const [step, setStep] = useState(0);
  const [profile, setProfile] = useState({ name: "", role: "Wali Murid" });
  const [answers, setAnswers] = useState<Record<string, number>>({});
  const [feedback, setFeedback] = useState("");
  const [status, setStatus] = useState<
    "idle" | "loading" | "submitting" | "success" | "submitted" | "error"
  >("loading");
  const [stats, setStats] = useState({
    zi: 0,
    service: 0,
    academic: 0,
    total: 0,
  });

  const totalSteps = surveyData.length + 2;

  // 1. Fetch Status & Stats
  useEffect(() => {
    const fetchSurveyData = async () => {
      try {
        const res = await fetch("/api/survey.php");
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
    fetchSurveyData();
  }, []);

  const handleScore = (qId: string, val: number) => {
    setAnswers((prev) => ({ ...prev, [qId]: val }));
  };

  const calculateScores = () => {
    const scores: Record<string, number> = {};
    surveyData.forEach((section) => {
      let sum = 0;
      section.questions.forEach((q) => {
        sum += answers[q.id] || 0;
      });
      scores[section.id] = parseFloat(
        (sum / section.questions.length).toFixed(2),
      );
    });
    return scores;
  };

  const handleSubmit = async () => {
    setStatus("submitting");
    const finalData = {
      profile,
      answers,
      feedback,
      scores: calculateScores(),
    };

    try {
      const res = await fetch("/api/survey.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(finalData),
      });
      const result = await res.json();
      if (res.ok && result.status === "success") {
        if (result.stats) setStats(result.stats);
        setStatus("submitted"); // Switch ke tampilan hasil
      } else {
        setStatus("error");
      }
    } catch (e) {
      setStatus("error");
    }
  };

  // Tampilan Hasil Survei (Statistik)
  if (status === "submitted" || status === "success") {
    return (
      <div className="max-w-3xl mx-auto bg-white dark:bg-darkmode-light rounded-xl p-8 border border-border dark:border-darkmode-border shadow-lg animate-fade-in">
        <div className="text-center mb-10">
          <div className="inline-flex items-center justify-center w-20 h-20 rounded-full bg-blue-100 text-blue-600 mb-6">
            <FaChartBar className="text-4xl" />
          </div>
          <h2 className="h3 mb-2">Hasil Survei Kepuasan</h2>
          <p className="text-text-light dark:text-darkmode-text-light">
            Terima kasih telah berpartisipasi. Berikut adalah indeks kepuasan
            rata-rata dari <strong>{stats.total}</strong> responden.
          </p>
        </div>

        <div className="space-y-8">
          {/* Result Item: ZI */}
          <div>
            <div className="flex justify-between items-end mb-2">
              <h4 className="text-lg flex items-center gap-2">
                <FaBuilding className="text-primary" /> Zona Integritas
              </h4>
              <span className="font-bold text-2xl text-primary">
                {stats.zi}
                <span className="text-sm text-gray-400 font-normal">/5</span>
              </span>
            </div>
            <div className="h-4 w-full bg-gray-200 rounded-full overflow-hidden dark:bg-gray-700">
              <div
                className="h-full bg-blue-500 transition-all duration-1000"
                style={{ width: `${(stats.zi / 5) * 100}%` }}
              ></div>
            </div>
          </div>

          {/* Result Item: Service */}
          <div>
            <div className="flex justify-between items-end mb-2">
              <h4 className="text-lg flex items-center gap-2">
                <FaConciergeBell className="text-primary" /> Pelayanan PTSP
              </h4>
              <span className="font-bold text-2xl text-primary">
                {stats.service}
                <span className="text-sm text-gray-400 font-normal">/5</span>
              </span>
            </div>
            <div className="h-4 w-full bg-gray-200 rounded-full overflow-hidden dark:bg-gray-700">
              <div
                className="h-full bg-green-500 transition-all duration-1000"
                style={{ width: `${(stats.service / 5) * 100}%` }}
              ></div>
            </div>
          </div>

          {/* Result Item: Academic */}
          <div>
            <div className="flex justify-between items-end mb-2">
              <h4 className="text-lg flex items-center gap-2">
                <FaGraduationCap className="text-primary" /> Akademik
              </h4>
              <span className="font-bold text-2xl text-primary">
                {stats.academic}
                <span className="text-sm text-gray-400 font-normal">/5</span>
              </span>
            </div>
            <div className="h-4 w-full bg-gray-200 rounded-full overflow-hidden dark:bg-gray-700">
              <div
                className="h-full bg-purple-500 transition-all duration-1000"
                style={{ width: `${(stats.academic / 5) * 100}%` }}
              ></div>
            </div>
          </div>
        </div>

        <div className="text-center mt-12">
          <a href="/" className="btn btn-outline-primary">
            Kembali ke Beranda
          </a>
        </div>
      </div>
    );
  }

  if (status === "loading")
    return <div className="text-center p-12">Memuat survei...</div>;

  // Render Logic Form (Sama seperti sebelumnya)
  const isProfileStep = step === 0;
  const isFeedbackStep = step === totalSteps - 1;
  const isSurveyStep = step > 0 && step < totalSteps - 1;
  const currentSection = isSurveyStep ? surveyData[step - 1] : null;

  const canProceed = () => {
    if (isProfileStep) return profile.name.length > 2;
    if (isSurveyStep && currentSection) {
      return currentSection.questions.every((q) => answers[q.id]);
    }
    return true;
  };

  return (
    <div className="max-w-3xl mx-auto">
      {/* Progress Bar */}
      <div className="mb-8">
        <div className="flex justify-between mb-2 text-xs font-semibold uppercase text-text-light dark:text-darkmode-text-light tracking-wide">
          <span>Data Diri</span>
          {surveyData.map((s) => (
            <span key={s.id} className="hidden sm:inline">
              {s.title}
            </span>
          ))}
          <span>Selesai</span>
        </div>
        <div className="h-2 bg-gray-200 rounded-full overflow-hidden dark:bg-gray-700">
          <div
            className="h-full bg-primary transition-all duration-500 ease-out"
            style={{ width: `${((step + 1) / totalSteps) * 100}%` }}
          ></div>
        </div>
      </div>

      <div className="bg-white dark:bg-darkmode-light rounded-2xl shadow-xl border border-border dark:border-darkmode-border overflow-hidden">
        {/* Header Section */}
        <div className="bg-light dark:bg-darkmode-body px-8 py-6 border-b border-border dark:border-darkmode-border">
          <h2 className="h4 flex items-center gap-3">
            {isProfileStep && (
              <>
                <FaUser className="text-primary" /> Data Responden
              </>
            )}
            {isSurveyStep && currentSection && (
              <>
                <span className="text-primary">{currentSection.icon}</span>{" "}
                {currentSection.title}
              </>
            )}
            {isFeedbackStep && (
              <>
                <FaPaperPlane className="text-primary" /> Kritik & Saran
              </>
            )}
          </h2>
          {isSurveyStep && currentSection && (
            <p className="text-sm mt-1 text-text-light opacity-80">
              {currentSection.description}
            </p>
          )}
        </div>

        {/* Content Body */}
        <div className="p-8">
          {/* STEP 1: PROFILE */}
          {isProfileStep && (
            <div className="space-y-6 animate-fade-in">
              <div>
                <label className="form-label text-sm">Nama Lengkap</label>
                <input
                  type="text"
                  className="form-input"
                  placeholder="Masukkan nama Anda"
                  value={profile.name}
                  onChange={(e) =>
                    setProfile({ ...profile, name: e.target.value })
                  }
                />
              </div>
              <div>
                <label className="form-label text-sm">Peran Anda</label>
                <select
                  className="form-input cursor-pointer"
                  value={profile.role}
                  onChange={(e) =>
                    setProfile({ ...profile, role: e.target.value })
                  }
                >
                  <option>Wali Murid</option>
                  <option>Siswa</option>
                  <option>Alumni</option>
                  <option>Tamu / Masyarakat Umum</option>
                  <option>Guru / Staf</option>
                </select>
              </div>
            </div>
          )}

          {/* STEP 2..N: SURVEY QUESTIONS */}
          {isSurveyStep && currentSection && (
            <div className="space-y-8 animate-fade-in">
              {currentSection.questions.map((q, idx) => (
                <div
                  key={q.id}
                  className="p-4 rounded-lg bg-light/50 dark:bg-darkmode-body/50 border border-transparent hover:border-border transition-all"
                >
                  <p className="font-medium mb-4">
                    {idx + 1}. {q.text}
                  </p>
                  <div className="flex flex-wrap gap-2 sm:gap-4 justify-center sm:justify-start">
                    {[1, 2, 3, 4, 5].map((val) => (
                      <button
                        key={val}
                        onClick={() => handleScore(q.id, val)}
                        className={`
                          w-10 h-10 sm:w-12 sm:h-12 rounded-full font-bold text-sm sm:text-base transition-all
                          ${
                            answers[q.id] === val
                              ? "bg-primary text-white scale-110 shadow-lg shadow-primary/40"
                              : "bg-white dark:bg-darkmode-body border border-border dark:border-darkmode-border text-text-light hover:border-primary hover:text-primary"
                          }
                        `}
                      >
                        {val}
                      </button>
                    ))}
                  </div>
                  <div className="flex justify-between mt-2 text-xs text-text-light px-1">
                    <span>Sangat Buruk</span>
                    <span>Sangat Baik</span>
                  </div>
                </div>
              ))}
            </div>
          )}

          {/* STEP FINAL: FEEDBACK */}
          {isFeedbackStep && (
            <div className="animate-fade-in">
              <label className="form-label">
                Apakah ada saran untuk perbaikan?
              </label>
              <textarea
                rows={5}
                className="form-input"
                placeholder="Tuliskan pesan, kritik, atau saran Anda di sini..."
                value={feedback}
                onChange={(e) => setFeedback(e.target.value)}
              ></textarea>
            </div>
          )}

          {/* Error Message */}
          {status === "error" && (
            <div className="mt-4 p-3 bg-red-100 text-red-700 rounded text-sm text-center">
              Terjadi kesalahan (mungkin Anda sudah mengisi atau koneksi
              terputus).
            </div>
          )}
        </div>

        {/* Footer Navigation */}
        <div className="bg-light dark:bg-darkmode-body px-8 py-4 border-t border-border dark:border-darkmode-border flex justify-between items-center">
          <button
            onClick={() => setStep((prev) => prev - 1)}
            disabled={step === 0 || status === "submitting"}
            className="btn btn-outline-primary btn-sm flex items-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed"
          >
            <FaChevronLeft className="text-xs" /> Kembali
          </button>

          {isFeedbackStep ? (
            <button
              onClick={handleSubmit}
              disabled={status === "submitting"}
              className="btn btn-primary btn-sm flex items-center gap-2"
            >
              {status === "submitting" ? "Mengirim..." : "Kirim Survei"}{" "}
              <FaPaperPlane className="text-xs" />
            </button>
          ) : (
            <button
              onClick={() => setStep((prev) => prev + 1)}
              disabled={!canProceed()}
              className="btn btn-primary btn-sm flex items-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed"
            >
              Lanjut <FaChevronRight className="text-xs" />
            </button>
          )}
        </div>
      </div>
    </div>
  );
};

export default SurveyWizard;
