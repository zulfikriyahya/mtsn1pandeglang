import React, { useState } from "react";
import {
  FaCheck,
  FaChevronLeft,
  FaChevronRight,
  FaUser,
  FaBuilding,
  FaConciergeBell,
  FaGraduationCap,
  FaPaperPlane,
} from "react-icons/fa";

// Definisi Pertanyaan
const surveyData = [
  {
    id: "zi",
    title: "Zona Integritas",
    icon: <FaBuilding />,
    description: "Penilaian terkait transparansi dan anti-korupsi.",
    questions: [
      {
        id: "zi_1",
        text: "Tidak ada pungutan liar (pungli) atau gratifikasi dalam layanan.",
      },
      {
        id: "zi_2",
        text: "Prosedur pelayanan jelas, transparan, dan mudah dipahami.",
      },
      {
        id: "zi_3",
        text: "Petugas menolak segala bentuk pemberian imbalan di luar ketentuan.",
      },
    ],
  },
  {
    id: "service",
    title: "Pelayanan PTSP",
    icon: <FaConciergeBell />,
    description: "Kualitas layanan administrasi di ruang PTSP.",
    questions: [
      {
        id: "srv_1",
        text: "Petugas melayani dengan ramah, sopan, dan santun.",
      },
      { id: "srv_2", text: "Ruang tunggu pelayanan nyaman dan bersih." },
      {
        id: "srv_3",
        text: "Layanan selesai tepat waktu sesuai standar yang dijanjikan.",
      },
    ],
  },
  {
    id: "academic",
    title: "Akademik",
    icon: <FaGraduationCap />,
    description: "Kualitas pembelajaran dan kompetensi guru.",
    questions: [
      { id: "acd_1", text: "Guru menguasai materi pembelajaran dengan baik." },
      {
        id: "acd_2",
        text: "Komunikasi antara sekolah dan wali murid berjalan lancar.",
      },
      {
        id: "acd_3",
        text: "Fasilitas pembelajaran mendukung kebutuhan siswa.",
      },
    ],
  },
];

const SurveyWizard = () => {
  const [step, setStep] = useState(0); // 0: Profile, 1..n: Survey Sections, n+1: Feedback
  const [profile, setProfile] = useState({ name: "", role: "Wali Murid" });
  const [answers, setAnswers] = useState<Record<string, number>>({});
  const [feedback, setFeedback] = useState("");
  const [status, setStatus] = useState<
    "idle" | "submitting" | "success" | "error"
  >("idle");

  const totalSteps = surveyData.length + 2; // Profile + Sections + Feedback

  // Handle Score Change
  const handleScore = (qId: string, val: number) => {
    setAnswers((prev) => ({ ...prev, [qId]: val }));
  };

  // Helper: Calculate Average Score
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

  // Submit Handler
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
        setStatus("success");
      } else {
        setStatus("error");
      }
    } catch (e) {
      setStatus("error");
    }
  };

  // Render Logic
  const isProfileStep = step === 0;
  const isFeedbackStep = step === totalSteps - 1;
  const isSurveyStep = step > 0 && step < totalSteps - 1;
  const currentSection = isSurveyStep ? surveyData[step - 1] : null;

  // Validation for Next Button
  const canProceed = () => {
    if (isProfileStep) return profile.name.length > 2;
    if (isSurveyStep && currentSection) {
      return currentSection.questions.every((q) => answers[q.id]);
    }
    return true;
  };

  if (status === "success") {
    return (
      <div className="text-center py-12 animate-fade-in bg-white dark:bg-darkmode-light rounded-xl p-8 border border-border dark:border-darkmode-border shadow-lg">
        <div className="inline-flex items-center justify-center w-20 h-20 rounded-full bg-green-100 text-green-600 mb-6">
          <FaCheck className="text-4xl" />
        </div>
        <h2 className="h3 mb-2">Terima Kasih!</h2>
        <p className="text-text-light dark:text-darkmode-text-light">
          Masukan Anda sangat berharga untuk kemajuan MTs Negeri 1 Pandeglang.
        </p>
        <a href="/" className="btn btn-primary mt-8">
          Kembali ke Beranda
        </a>
      </div>
    );
  }

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
              Terjadi kesalahan saat mengirim data. Silakan coba lagi.
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
