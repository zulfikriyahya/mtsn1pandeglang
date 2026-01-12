import React, { useEffect, useState, useMemo, useRef } from "react";
import {
  FaDownload,
  FaSignOutAlt,
  FaEye,
  FaStar,
  FaChartLine,
  FaPoll,
  FaSort,
  FaSortUp,
  FaSortDown,
  FaSearch,
  FaChevronLeft,
  FaChevronRight,
  FaExclamationTriangle,
  FaTimes,
  FaExternalLinkAlt,
  FaQuoteLeft,
  FaTrash, // Ikon Hapus
  FaExclamationCircle, // Ikon Konfirmasi
  FaFileUpload, // Ikon Import (BARU)
  FaFileCsv,
} from "react-icons/fa";
import {
  Chart as ChartJS,
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement,
  BarElement,
  ArcElement,
  Title,
  Tooltip,
  Legend,
  Filler,
} from "chart.js";
import { Bar, Pie, Line } from "react-chartjs-2";

ChartJS.register(
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement,
  BarElement,
  ArcElement,
  Title,
  Tooltip,
  Legend,
  Filler,
);

interface User {
  name: string;
  email: string;
  picture: string;
}

// --- HELPER: FORMAT TANGGAL ---
const formatDateIndo = (dateString: string) => {
  if (!dateString) return "-";
  try {
    const date = new Date(
      dateString.includes("Z")
        ? dateString
        : dateString.replace(" ", "T") + "Z",
    );
    return new Intl.DateTimeFormat("id-ID", {
      weekday: "long",
      day: "numeric",
      month: "long",
      year: "numeric",
      hour: "2-digit",
      minute: "2-digit",
      timeZone: "Asia/Jakarta",
      timeZoneName: "short",
    })
      .format(date)
      .replace("pukul", "");
  } catch (e) {
    return dateString;
  }
};

const AdminDashboard = () => {
  // --- STATE HOOKS ---
  const [user, setUser] = useState<User | null>(null);
  const [loading, setLoading] = useState(true);
  const [data, setData] = useState<any>(null);
  const [errorMsg, setErrorMsg] = useState<string | null>(null);
  const [activeTab, setActiveTab] = useState("overview");

  // State Modal Detail
  const [selectedItem, setSelectedItem] = useState<any | null>(null);
  const [modalType, setModalType] = useState<"feedback" | "survey" | null>(
    null,
  );

  // State Modal Konfirmasi Delete
  const [confirmModal, setConfirmModal] = useState<{
    isOpen: boolean;
    ids: number[];
    type: "feedback" | "survey";
    count: number;
  }>({ isOpen: false, ids: [], type: "feedback", count: 0 });

  // State Modal Import (BARU)
  const [importModalOpen, setImportModalOpen] = useState(false);

  // State Filter PDF
  const [selectedMonth, setSelectedMonth] = useState(
    () => new Date().getMonth() + 1,
  );
  const [selectedYear, setSelectedYear] = useState(() =>
    new Date().getFullYear(),
  );

  // --- GOOGLE AUTH INIT ---
  const initializeGoogleButton = () => {
    const btnContainer = document.getElementById("googleBtn");
    if (!btnContainer) return;
    /* @ts-ignore */
    if (window.google && window.google.accounts) {
      /* @ts-ignore */
      window.google.accounts.id.initialize({
        client_id: import.meta.env.PUBLIC_GOOGLE_CLIENT_ID,
        callback: handleCredentialResponse,
        auto_select: false,
        ui_mode: "popup",
      });
      /* @ts-ignore */
      window.google.accounts.id.renderButton(btnContainer, {
        theme: "outline",
        size: "large",
        width: 250,
      });
    }
  };

  const handleCredentialResponse = async (response: any) => {
    setLoading(true);
    try {
      const res = await fetch("/api/auth.php?action=login", {
        method: "POST",
        body: JSON.stringify({ credential: response.credential }),
      });
      const result = await res.json();
      if (result.status === "success") {
        setUser(result.user);
        fetchStats();
      } else {
        alert(result.message);
      }
    } catch (e) {
      alert("Terjadi kesalahan jaringan.");
    }
    setLoading(false);
  };

  const fetchStats = async () => {
    setErrorMsg(null);
    try {
      const res = await fetch("/api/admin.php?action=stats");
      if (!res.ok) throw new Error(`Server Error: ${res.status}`);
      const json = await res.json();
      if (json.status === "error") throw new Error(json.message);
      setData(json);
    } catch (e: any) {
      setErrorMsg(e.message || "Gagal memuat data.");
    }
  };

  useEffect(() => {
    let isMounted = true;
    const init = async () => {
      try {
        const authRes = await fetch("/api/auth.php?action=check");
        const authData = await authRes.json();
        if (isMounted) {
          if (authData.status === "authenticated") {
            setUser(authData.user);
            fetchStats();
          } else {
            if (!document.getElementById("google-client-script")) {
              const script = document.createElement("script");
              script.src = "https://accounts.google.com/gsi/client";
              script.async = true;
              script.id = "google-client-script";
              script.onload = initializeGoogleButton;
              document.body.appendChild(script);
            } else {
              setTimeout(initializeGoogleButton, 500);
            }
          }
          setLoading(false);
        }
      } catch (e) {
        if (isMounted) setErrorMsg("Gagal menghubungi server autentikasi.");
        setLoading(false);
      }
    };
    init();
    return () => {
      isMounted = false;
    };
  }, []);

  const handleLogout = async () => {
    await fetch("/api/auth.php?action=logout");
    setUser(null);
    window.location.reload();
  };

  const downloadReport = (type: string) => {
    window.open(`/api/admin.php?action=export&type=${type}`, "_blank");
  };

  const printPDF = () => {
    window.open(
      `/api/print_pdf.php?month=${selectedMonth}&year=${selectedYear}`,
      "_blank",
    );
  };

  const openDetail = (item: any, type: "feedback" | "survey") => {
    setSelectedItem(item);
    setModalType(type);
  };

  const closeDetail = () => {
    setSelectedItem(null);
    setModalType(null);
  };

  // --- LOGIKA HAPUS DATA (SINGLE & BULK) ---
  const requestDelete = (ids: number[], type: "feedback" | "survey") => {
    setConfirmModal({
      isOpen: true,
      ids,
      type,
      count: ids.length,
    });
  };

  const executeDelete = async () => {
    try {
      const res = await fetch("/api/crud.php?action=delete", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
          ids: confirmModal.ids,
          type: confirmModal.type,
        }),
      });
      const json = await res.json();

      if (json.status === "success") {
        fetchStats(); // Refresh data
        // Tutup modal detail jika item yang dihapus sedang dibuka
        if (
          selectedItem &&
          confirmModal.ids.includes(selectedItem.id) &&
          modalType === confirmModal.type
        ) {
          closeDetail();
        }
      } else {
        alert(json.message || "Gagal menghapus data.");
      }
    } catch (e) {
      alert("Terjadi kesalahan jaringan.");
    } finally {
      setConfirmModal((prev) => ({ ...prev, isOpen: false }));
    }
  };

  // --- LOGIKA IMPORT DATA (BARU) ---
  const handleImportSuccess = () => {
    fetchStats();
    setImportModalOpen(false);
  };

  // --- RENDER LOGIC ---
  if (loading)
    return (
      <div className="text-center p-12">
        <div className="animate-spin h-8 w-8 border-4 border-primary border-t-transparent rounded-full mx-auto mb-4"></div>
        Memuat Sistem...
      </div>
    );

  if (!user) {
    return (
      <div className="flex min-h-[60vh] flex-col items-center justify-center">
        <div className="w-full max-w-md rounded-2xl border border-border bg-white p-8 text-center shadow-xl dark:border-darkmode-border dark:bg-darkmode-light">
          <img
            src="/images/brand-lightmode.png"
            alt="Logo"
            className="mx-auto mb-6 h-12"
          />
          <h2 className="h4 mb-2">Portal Admin</h2>
          <div className="flex justify-center h-[50px]">
            <div id="googleBtn"></div>
          </div>
        </div>
      </div>
    );
  }

  return (
    <div className="min-h-screen pb-12 relative">
      {/* Header */}
      <div className="mb-8 flex flex-col xl:flex-row items-center justify-between gap-4 rounded-xl bg-white p-6 border border-border shadow-sm dark:bg-darkmode-light dark:border-darkmode-border">
        <div className="flex items-center gap-4 w-full md:w-auto">
          <img
            src={user.picture}
            alt={user.name}
            className="h-12 w-12 rounded-full border border-gray-200 shadow-sm"
          />
          <div>
            <h3 className="h5 mb-0 font-bold">{user.name}</h3>
            <p className="text-sm text-text-light">{user.email}</p>
          </div>
        </div>

        {/* Action Controls */}
        <div className="flex flex-wrap items-center justify-center gap-2 w-full md:w-auto">
          <select
            value={selectedMonth}
            onChange={(e) => setSelectedMonth(Number(e.target.value))}
            className="rounded-lg border border-border px-3 py-1.5 text-sm outline-none focus:border-primary dark:bg-darkmode-body dark:border-darkmode-border"
          >
            {[
              "Januari",
              "Februari",
              "Maret",
              "April",
              "Mei",
              "Juni",
              "Juli",
              "Agustus",
              "September",
              "Oktober",
              "November",
              "Desember",
            ].map((m, i) => (
              <option key={i} value={i + 1}>
                {m}
              </option>
            ))}
          </select>

          <select
            value={selectedYear}
            onChange={(e) => setSelectedYear(Number(e.target.value))}
            className="rounded-lg border border-border px-3 py-1.5 text-sm outline-none focus:border-primary dark:bg-darkmode-body dark:border-darkmode-border"
          >
            {[2024, 2025, 2026].map((y) => (
              <option key={y} value={y}>
                {y}
              </option>
            ))}
          </select>

          <button
            onClick={() => setImportModalOpen(true)}
            className="btn btn-sm flex items-center gap-2 bg-orange-500 hover:bg-orange-600 text-white border-orange-500 whitespace-nowrap"
          >
            <FaFileUpload /> Import
          </button>

          <button
            onClick={printPDF}
            className="btn btn-outline-primary btn-sm flex items-center gap-2 print:hidden whitespace-nowrap"
          >
            <FaDownload /> PDF
          </button>
          <button
            onClick={handleLogout}
            className="btn btn-primary btn-sm flex items-center gap-2 bg-red-500 border-red-500 hover:bg-red-600 print:hidden whitespace-nowrap"
          >
            <FaSignOutAlt /> Keluar
          </button>
        </div>
      </div>

      {errorMsg && (
        <div className="mb-8 rounded-xl bg-red-50 p-4 border border-red-200 text-red-700 flex items-center gap-3">
          <FaExclamationTriangle className="text-xl" />
          <div>
            <p className="font-bold">Gagal memuat data</p>
            <p className="text-sm">{errorMsg}</p>
            <button
              onClick={fetchStats}
              className="mt-2 text-xs underline hover:text-red-900"
            >
              Coba Lagi
            </button>
          </div>
        </div>
      )}

      {data && (
        <div className="animate-fade-in">
          {/* Overview Cards */}
          <div className="mb-8 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
            <StatCard
              label="Total Kunjungan"
              value={data.overview.visits.toLocaleString()}
              icon={<FaEye />}
              color="text-blue-500"
              bg="bg-blue-50 dark:bg-blue-900/20"
            />
            <StatCard
              label="Artikel Dibaca"
              value={data.overview.posts_count.toLocaleString()}
              icon={<FaChartLine />}
              color="text-green-500"
              bg="bg-green-50 dark:bg-green-900/20"
            />
            <StatCard
              label="Total Ulasan"
              value={data.overview.feedback_count.toLocaleString()}
              icon={<FaStar />}
              color="text-yellow-500"
              bg="bg-yellow-50 dark:bg-yellow-900/20"
            />
            <StatCard
              label="Responden Survei"
              value={data.overview.survey_count.toLocaleString()}
              icon={<FaPoll />}
              color="text-purple-500"
              bg="bg-purple-50 dark:bg-purple-900/20"
            />
          </div>

          {/* Navigation Tabs */}
          <div className="mb-8 border-b border-border dark:border-darkmode-border">
            <nav className="-mb-px flex space-x-8 overflow-x-auto">
              {[
                { id: "overview", label: "Ringkasan Grafik" },
                { id: "posts", label: "Data Artikel" },
                { id: "feedback", label: "Data Ulasan" },
                { id: "surveys", label: "Data Survei" },
              ].map((tab) => (
                <button
                  key={tab.id}
                  onClick={() => setActiveTab(tab.id)}
                  className={`whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium transition-colors ${activeTab === tab.id ? "border-primary text-primary" : "border-transparent text-gray-500 hover:border-gray-300 dark:text-gray-400"}`}
                >
                  {tab.label}
                </button>
              ))}
            </nav>
          </div>

          {/* TAB CONTENTS */}
          {activeTab === "overview" && (
            <div className="grid grid-cols-1 lg:grid-cols-2 gap-8">
              <div className="lg:col-span-2 rounded-xl border border-border bg-white p-6 shadow-sm dark:bg-darkmode-light dark:border-darkmode-border">
                <h3 className="h6 mb-6">Tren Aktivitas (30 Hari Terakhir)</h3>
                <div className="h-72">
                  <Line
                    data={{
                      labels: data.charts.activity.labels,
                      datasets: [
                        {
                          label: "Ulasan Masuk",
                          data: data.charts.activity.feedback,
                          borderColor: "#eab308",
                          backgroundColor: "rgba(234, 179, 8, 0.1)",
                          fill: true,
                          tension: 0.4,
                        },
                        {
                          label: "Survei Masuk",
                          data: data.charts.activity.survey,
                          borderColor: "#8b5cf6",
                          backgroundColor: "rgba(139, 92, 246, 0.1)",
                          fill: true,
                          tension: 0.4,
                        },
                      ],
                    }}
                    options={{ responsive: true, maintainAspectRatio: false }}
                  />
                </div>
              </div>
              <div className="rounded-xl border border-border bg-white p-6 shadow-sm dark:bg-darkmode-light dark:border-darkmode-border">
                <h3 className="h6 mb-6 text-center">
                  Distribusi Rating Bintang
                </h3>
                <div className="h-64 flex justify-center">
                  <Pie
                    data={{
                      labels: ["5 ★", "4 ★", "3 ★", "2 ★", "1 ★"],
                      datasets: [
                        {
                          data: [5, 4, 3, 2, 1].map(
                            (r) => data.charts.stars[r],
                          ),
                          backgroundColor: [
                            "#22c55e",
                            "#3b82f6",
                            "#eab308",
                            "#f97316",
                            "#ef4444",
                          ],
                          borderWidth: 1,
                        },
                      ],
                    }}
                    options={{ responsive: true, maintainAspectRatio: false }}
                  />
                </div>
              </div>
              <div className="rounded-xl border border-border bg-white p-6 shadow-sm dark:bg-darkmode-light dark:border-darkmode-border">
                <h3 className="h6 mb-6 text-center">Skor Rata-rata Survei</h3>
                <div className="h-64">
                  <Bar
                    data={{
                      labels: ["Zona Integritas", "Pelayanan", "Akademik"],
                      datasets: [
                        {
                          label: "Skor (Skala 5)",
                          data: [
                            data.charts.survey_avg.zi,
                            data.charts.survey_avg.service,
                            data.charts.survey_avg.academic,
                          ],
                          backgroundColor: ["#3b82f6", "#10b981", "#8b5cf6"],
                          borderRadius: 6,
                        },
                      ],
                    }}
                    options={{
                      responsive: true,
                      maintainAspectRatio: false,
                      scales: { y: { min: 0, max: 5 } },
                    }}
                  />
                </div>
              </div>
            </div>
          )}

          {activeTab === "posts" && (
            <DataTable
              title="Statistik Artikel Populer"
              data={data.tables.posts}
              enableSelection={false}
              onDownload={() => downloadReport("posts")}
              columns={[
                {
                  key: "slug",
                  label: "Judul Artikel",
                  render: (val: string) => val.replace(/-/g, " ").toUpperCase(),
                },
                {
                  key: "views",
                  label: "Jumlah Pembaca",
                  sortable: true,
                  className: "text-right font-bold",
                },
              ]}
            />
          )}

          {activeTab === "feedback" && (
            <DataTable
              title="Data Ulasan Masuk"
              data={data.tables.feedbacks}
              searchKeys={["name", "message"]}
              enableSelection={true}
              onBulkDelete={(ids) => requestDelete(ids, "feedback")}
              onDownload={() => downloadReport("feedback")}
              columns={[
                {
                  key: "created_at",
                  label: "Waktu",
                  sortable: true,
                  className: "w-48 text-sm text-gray-500",
                  render: (val: string) => formatDateIndo(val),
                },
                {
                  key: "name",
                  label: "Nama Pengirim",
                  sortable: true,
                  className: "font-medium w-48",
                },
                {
                  key: "rating",
                  label: "Rating",
                  sortable: true,
                  className: "w-24",
                  render: (val: number) => (
                    <span className="inline-block px-2 py-1 bg-yellow-100 text-yellow-700 rounded text-xs font-bold">
                      {val} ★
                    </span>
                  ),
                },
                {
                  key: "message",
                  label: "Pesan / Kritik",
                  render: (val: string, row: any) => (
                    <div className="group relative">
                      <p className="italic text-gray-600 dark:text-gray-400 line-clamp-1 max-w-xs">
                        {val || "-"}
                      </p>
                      {val && val.length > 50 && (
                        <button
                          onClick={() => openDetail(row, "feedback")}
                          className="text-xs text-primary hover:underline mt-1 flex items-center gap-1"
                        >
                          Lihat Detail{" "}
                          <FaExternalLinkAlt className="text-[10px]" />
                        </button>
                      )}
                    </div>
                  ),
                },
                {
                  key: "actions",
                  label: "Aksi",
                  className: "text-center w-16",
                  render: (_: any, row: any) => (
                    <button
                      onClick={() => requestDelete([row.id], "feedback")}
                      className="text-red-500 hover:text-red-700 p-2 transition-colors hover:bg-red-50 rounded-full"
                      title="Hapus Data"
                    >
                      <FaTrash size={14} />
                    </button>
                  ),
                },
              ]}
            />
          )}

          {activeTab === "surveys" && (
            <DataTable
              title="Data Survei Kepuasan"
              data={data.tables.surveys}
              searchKeys={["respondent_name", "feedback"]}
              enableSelection={true}
              onBulkDelete={(ids) => requestDelete(ids, "survey")}
              onDownload={() => downloadReport("survey")}
              columns={[
                {
                  key: "created_at",
                  label: "Waktu",
                  sortable: true,
                  className: "w-48 text-sm text-gray-500",
                  render: (val: string) => formatDateIndo(val),
                },
                {
                  key: "respondent_name",
                  label: "Responden",
                  sortable: true,
                  className: "w-48",
                  render: (_: any, row: any) => (
                    <div>
                      <div className="font-bold">{row.respondent_name}</div>
                      <div className="text-xs text-gray-500">
                        {row.respondent_role}
                      </div>
                    </div>
                  ),
                },
                {
                  key: "score_zi",
                  label: "ZI",
                  sortable: true,
                  className: "text-center font-semibold text-blue-600 w-16",
                },
                {
                  key: "score_service",
                  label: "Layanan",
                  sortable: true,
                  className: "text-center font-semibold text-green-600 w-16",
                },
                {
                  key: "score_academic",
                  label: "Akademik",
                  sortable: true,
                  className: "text-center font-semibold text-purple-600 w-16",
                },
                {
                  key: "feedback",
                  label: "Masukan",
                  render: (val: string, row: any) => (
                    <div>
                      <p className="italic text-gray-500 text-sm line-clamp-1 max-w-xs">
                        {val || "-"}
                      </p>
                      {val && val.length > 50 && (
                        <button
                          onClick={() => openDetail(row, "survey")}
                          className="text-xs text-primary hover:underline mt-1 flex items-center gap-1"
                        >
                          Lihat Detail{" "}
                          <FaExternalLinkAlt className="text-[10px]" />
                        </button>
                      )}
                    </div>
                  ),
                },
                {
                  key: "actions",
                  label: "Aksi",
                  className: "text-center w-16",
                  render: (_: any, row: any) => (
                    <button
                      onClick={() => requestDelete([row.id], "survey")}
                      className="text-red-500 hover:text-red-700 p-2 transition-colors hover:bg-red-50 rounded-full"
                      title="Hapus Data"
                    >
                      <FaTrash size={14} />
                    </button>
                  ),
                },
              ]}
            />
          )}
        </div>
      )}

      {/* MODAL IMPORT DATA (BARU) */}
      <ImportModal
        isOpen={importModalOpen}
        onClose={() => setImportModalOpen(false)}
        onSuccess={handleImportSuccess}
      />

      {/* CUSTOM CONFIRMATION MODAL */}
      <ConfirmationModal
        isOpen={confirmModal.isOpen}
        title="Konfirmasi Penghapusan"
        message={`Apakah Anda yakin ingin menghapus ${confirmModal.count} data terpilih? Tindakan ini permanen dan tidak dapat dibatalkan.`}
        onConfirm={executeDelete}
        onCancel={() => setConfirmModal((prev) => ({ ...prev, isOpen: false }))}
      />

      {/* DETAIL MODAL POPUP */}
      {selectedItem && (
        <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm animate-fade-in">
          <div className="bg-white dark:bg-darkmode-body w-full max-w-lg rounded-2xl shadow-2xl overflow-hidden border border-gray-100 dark:border-darkmode-border transform transition-all scale-100">
            {/* Modal Header */}
            <div className="flex items-center justify-between p-6 border-b border-gray-100 dark:border-darkmode-border bg-gray-50 dark:bg-white/5">
              <div>
                <h3 className="text-lg font-bold text-gray-800 dark:text-white">
                  Detail{" "}
                  {modalType === "feedback" ? "Ulasan" : "Masukan Survei"}
                </h3>
                <p className="text-xs text-gray-500 mt-1">
                  {formatDateIndo(selectedItem.created_at)}
                </p>
              </div>
              <button
                onClick={closeDetail}
                className="text-gray-400 hover:text-red-500 transition-colors bg-white dark:bg-white/10 p-2 rounded-full shadow-sm"
              >
                <FaTimes />
              </button>
            </div>

            {/* Modal Content */}
            <div className="p-6">
              <div className="flex items-start gap-4 mb-6">
                <div className="h-12 w-12 flex-shrink-0 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold text-xl">
                  {(selectedItem.name || selectedItem.respondent_name || "A")
                    .charAt(0)
                    .toUpperCase()}
                </div>
                <div>
                  <p className="font-bold text-lg text-gray-800 dark:text-white">
                    {selectedItem.name || selectedItem.respondent_name}
                  </p>
                  <p className="text-sm text-gray-500">
                    {selectedItem.respondent_role || "Pengunjung / Wali Murid"}
                  </p>

                  {modalType === "feedback" && (
                    <div className="mt-2 flex gap-1">
                      {[1, 2, 3, 4, 5].map((s) => (
                        <FaStar
                          key={s}
                          className={
                            s <= selectedItem.rating
                              ? "text-yellow-400"
                              : "text-gray-200"
                          }
                        />
                      ))}
                    </div>
                  )}
                </div>
              </div>

              {/* Message Box */}
              <div className="relative rounded-xl bg-gray-50 dark:bg-white/5 p-6 border border-gray-100 dark:border-darkmode-border">
                <FaQuoteLeft className="absolute top-4 left-4 text-gray-200 dark:text-gray-600 text-2xl" />
                <div className="relative z-10">
                  <p className="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-2">
                    Isi Pesan:
                  </p>
                  <p className="text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-wrap">
                    {modalType === "feedback"
                      ? selectedItem.message
                      : selectedItem.feedback}
                  </p>
                </div>
              </div>

              {/* Stats for Survey */}
              {modalType === "survey" && (
                <div className="grid grid-cols-3 gap-4 mt-6">
                  <div className="text-center p-3 bg-blue-50 rounded-lg dark:bg-blue-900/20">
                    <div className="text-xs text-blue-600 font-bold uppercase">
                      ZI
                    </div>
                    <div className="text-xl font-bold text-blue-700">
                      {selectedItem.score_zi}
                    </div>
                  </div>
                  <div className="text-center p-3 bg-green-50 rounded-lg dark:bg-green-900/20">
                    <div className="text-xs text-green-600 font-bold uppercase">
                      Layanan
                    </div>
                    <div className="text-xl font-bold text-green-700">
                      {selectedItem.score_service}
                    </div>
                  </div>
                  <div className="text-center p-3 bg-purple-50 rounded-lg dark:bg-purple-900/20">
                    <div className="text-xs text-purple-600 font-bold uppercase">
                      Akademik
                    </div>
                    <div className="text-xl font-bold text-purple-700">
                      {selectedItem.score_academic}
                    </div>
                  </div>
                </div>
              )}
            </div>

            {/* Modal Footer */}
            <div className="bg-gray-50 dark:bg-white/5 px-6 py-4 flex justify-between items-center text-xs text-gray-400 border-t border-gray-100 dark:border-darkmode-border">
              <span>IP: {selectedItem.ip_address}</span>
              <div className="flex gap-2">
                <button
                  onClick={() => requestDelete([selectedItem.id], modalType!)}
                  className="btn bg-red-100 text-red-600 hover:bg-red-200 border-transparent btn-sm flex items-center gap-2"
                >
                  <FaTrash /> Hapus
                </button>
                <button
                  onClick={closeDetail}
                  className="btn btn-primary btn-sm"
                >
                  Tutup
                </button>
              </div>
            </div>
          </div>
        </div>
      )}
    </div>
  );
};

// --- SUB COMPONENTS ---

// 1. IMPORT MODAL
const ImportModal = ({ isOpen, onClose, onSuccess }: any) => {
  const [importType, setImportType] = useState<"feedback" | "survey">(
    "feedback",
  );
  const [file, setFile] = useState<File | null>(null);
  const [isUploading, setIsUploading] = useState(false);
  const fileInputRef = useRef<HTMLInputElement>(null);

  if (!isOpen) return null;

  const handleFileChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    if (e.target.files && e.target.files[0]) {
      setFile(e.target.files[0]);
    }
  };

  const handleUpload = async () => {
    if (!file) return alert("Pilih file CSV terlebih dahulu.");

    setIsUploading(true);
    const formData = new FormData();
    formData.append("file", file);
    formData.append("type", importType);

    try {
      const res = await fetch("/api/import.php?action=import", {
        method: "POST",
        body: formData,
      });
      const json = await res.json();

      if (json.status === "success") {
        alert(json.message);
        onSuccess();
      } else {
        alert(json.message || "Gagal mengupload file.");
      }
    } catch (e) {
      alert("Terjadi kesalahan jaringan.");
    } finally {
      setIsUploading(false);
      setFile(null);
    }
  };

  return (
    <div className="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm animate-fade-in">
      <div className="bg-white dark:bg-darkmode-body w-full max-w-md rounded-xl shadow-2xl p-6 border border-gray-100 dark:border-darkmode-border">
        <div className="flex justify-between items-center mb-6">
          <h3 className="text-lg font-bold">Import Data CSV</h3>
          <button onClick={onClose}>
            <FaTimes className="text-gray-400 hover:text-red-500" />
          </button>
        </div>

        <div className="mb-4">
          <label className="block text-sm font-medium mb-2">
            Pilih Tipe Data
          </label>
          <div className="flex gap-4">
            <label className="flex items-center gap-2 cursor-pointer">
              <input
                type="radio"
                name="importType"
                value="feedback"
                checked={importType === "feedback"}
                onChange={() => setImportType("feedback")}
              />
              Data Ulasan
            </label>
            <label className="flex items-center gap-2 cursor-pointer">
              <input
                type="radio"
                name="importType"
                value="survey"
                checked={importType === "survey"}
                onChange={() => setImportType("survey")}
              />
              Data Survei
            </label>
          </div>
        </div>

        <div className="mb-6">
          <label className="block text-sm font-medium mb-2">Upload File</label>
          <div
            className="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center cursor-pointer hover:bg-gray-50 dark:hover:bg-white/5 transition-colors"
            onClick={() => fileInputRef.current?.click()}
          >
            <input
              type="file"
              accept=".csv"
              ref={fileInputRef}
              className="hidden"
              onChange={handleFileChange}
            />
            {file ? (
              <div className="flex items-center justify-center gap-2 text-green-600 font-medium">
                <FaFileCsv size={24} />
                {file.name}
              </div>
            ) : (
              <div className="text-gray-500">
                <FaFileUpload className="mx-auto mb-2 text-2xl" />
                <p>Klik untuk memilih file CSV</p>
              </div>
            )}
          </div>
          <div className="mt-2 text-right">
            <a
              href={`/api/import.php?action=template&type=${importType}`}
              className="text-xs text-primary hover:underline flex items-center justify-end gap-1"
            >
              <FaDownload /> Download Template CSV
            </a>
          </div>
        </div>

        <div className="flex justify-end gap-2">
          <button
            onClick={onClose}
            className="btn btn-outline-primary btn-sm"
            disabled={isUploading}
          >
            Batal
          </button>
          <button
            onClick={handleUpload}
            className="btn btn-primary btn-sm"
            disabled={!file || isUploading}
          >
            {isUploading ? "Mengupload..." : "Mulai Import"}
          </button>
        </div>
      </div>
    </div>
  );
};

// 2. CONFIRMATION MODAL
const ConfirmationModal = ({
  isOpen,
  title,
  message,
  onConfirm,
  onCancel,
}: any) => {
  if (!isOpen) return null;

  return (
    <div className="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm animate-fade-in">
      <div className="bg-white dark:bg-darkmode-body w-full max-w-sm rounded-xl shadow-2xl p-6 border border-gray-100 dark:border-darkmode-border transform transition-all scale-100">
        <div className="text-center">
          <div className="mx-auto flex items-center justify-center h-14 w-14 rounded-full bg-red-100 mb-4">
            <FaExclamationCircle className="text-3xl text-red-600" />
          </div>
          <h3 className="text-lg font-bold text-gray-900 dark:text-white mb-2">
            {title}
          </h3>
          <p className="text-sm text-gray-500 dark:text-gray-400 mb-6">
            {message}
          </p>
          <div className="flex gap-3 justify-center">
            <button
              onClick={onCancel}
              className="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-lg text-sm font-medium transition-colors dark:bg-white/10 dark:text-gray-300 dark:hover:bg-white/20"
            >
              Batal
            </button>
            <button
              onClick={onConfirm}
              className="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-medium shadow-md shadow-red-200 transition-colors"
            >
              Ya, Hapus
            </button>
          </div>
        </div>
      </div>
    </div>
  );
};

// 3. STAT CARD
const StatCard = ({ label, value, icon, color, bg }: any) => (
  <div className="flex items-center justify-between rounded-xl border border-border bg-white p-6 shadow-sm transition-all hover:shadow-md dark:bg-darkmode-light dark:border-darkmode-border">
    <div>
      <p className="text-sm font-medium text-text-light">{label}</p>
      <p className="mt-2 text-3xl font-bold text-text-dark dark:text-white">
        {value}
      </p>
    </div>
    <div
      className={`flex h-12 w-12 items-center justify-center rounded-lg ${bg} text-xl ${color}`}
    >
      {icon}
    </div>
  </div>
);

// 4. DATA TABLE (Dengan Fitur Selection)
interface Column {
  key: string;
  label: string;
  sortable?: boolean;
  className?: string;
  render?: (value: any, row: any) => React.ReactNode;
}

const DataTable = ({
  title,
  data,
  columns,
  searchKeys = ["slug"],
  onDownload,
  enableSelection = false,
  onBulkDelete,
}: {
  title: string;
  data: any[];
  columns: Column[];
  searchKeys?: string[];
  onDownload: () => void;
  enableSelection?: boolean;
  onBulkDelete?: (ids: number[]) => void;
}) => {
  const [search, setSearch] = useState("");
  const [sortConfig, setSortConfig] = useState<{
    key: string;
    direction: "asc" | "desc";
  } | null>(null);
  const [currentPage, setCurrentPage] = useState(1);
  const [rowsPerPage, setRowsPerPage] = useState(10);
  const [selectedIds, setSelectedIds] = useState<number[]>([]);

  // Reset selection when data changes
  useEffect(() => {
    setSelectedIds([]);
  }, [data, currentPage, search]);

  const filteredData = useMemo(() => {
    if (!search) return data;
    return data.filter((row) =>
      searchKeys.some((key) =>
        String(row[key] || "")
          .toLowerCase()
          .includes(search.toLowerCase()),
      ),
    );
  }, [data, search, searchKeys]);

  const sortedData = useMemo(() => {
    if (!sortConfig) return filteredData;
    return [...filteredData].sort((a, b) => {
      let aVal = a[sortConfig.key];
      let bVal = b[sortConfig.key];
      if (aVal < bVal) return sortConfig.direction === "asc" ? -1 : 1;
      if (aVal > bVal) return sortConfig.direction === "asc" ? 1 : -1;
      return 0;
    });
  }, [filteredData, sortConfig]);

  const totalPages = Math.ceil(sortedData.length / rowsPerPage);
  const paginatedData = sortedData.slice(
    (currentPage - 1) * rowsPerPage,
    currentPage * rowsPerPage,
  );

  const requestSort = (key: string) => {
    setSortConfig({
      key,
      direction:
        sortConfig?.key === key && sortConfig.direction === "asc"
          ? "desc"
          : "asc",
    });
  };

  // Selection Logic
  const handleSelectAll = (e: React.ChangeEvent<HTMLInputElement>) => {
    if (e.target.checked) {
      const currentIds = paginatedData.map((row) => row.id);
      setSelectedIds(currentIds);
    } else {
      setSelectedIds([]);
    }
  };

  const handleSelectRow = (id: number) => {
    if (selectedIds.includes(id)) {
      setSelectedIds(selectedIds.filter((sid) => sid !== id));
    } else {
      setSelectedIds([...selectedIds, id]);
    }
  };

  return (
    <div className="rounded-xl border border-border bg-white shadow-sm overflow-hidden dark:bg-darkmode-light dark:border-darkmode-border">
      <div className="flex flex-col gap-4 p-5 md:flex-row md:items-center md:justify-between border-b border-border dark:border-darkmode-border bg-gray-50 dark:bg-white/5">
        <div className="flex items-center gap-3">
          <h3 className="text-lg font-bold">{title}</h3>
          {/* BULK DELETE BUTTON */}
          {enableSelection && selectedIds.length > 0 && (
            <button
              onClick={() => onBulkDelete && onBulkDelete(selectedIds)}
              className="px-3 py-1 bg-red-100 text-red-600 hover:bg-red-200 rounded text-xs font-bold flex items-center gap-2 animate-fade-in transition-all"
            >
              <FaTrash /> Hapus ({selectedIds.length})
            </button>
          )}
        </div>

        <div className="flex flex-col sm:flex-row gap-3">
          <div className="relative">
            <FaSearch className="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" />
            <input
              type="text"
              placeholder="Cari data..."
              className="w-full rounded-lg border border-border py-2 pl-9 pr-4 text-sm focus:border-primary focus:outline-none dark:bg-darkmode-body dark:border-darkmode-border"
              onChange={(e) => {
                setSearch(e.target.value);
                setCurrentPage(1);
              }}
            />
          </div>
          <button
            onClick={onDownload}
            className="btn btn-primary btn-sm flex items-center justify-center gap-2 bg-green-600 border-green-600 hover:bg-green-700"
          >
            <FaDownload /> Excel
          </button>
        </div>
      </div>
      <div className="overflow-x-auto">
        <table className="w-full text-left text-sm">
          <thead className="bg-gray-100 text-xs uppercase text-gray-500 dark:bg-black/20">
            <tr>
              {/* CHECKBOX HEADER */}
              {enableSelection && (
                <th className="px-4 py-3 w-10 text-center">
                  <div className="flex items-center justify-center">
                    <input
                      type="checkbox"
                      className="rounded border-gray-300 text-primary focus:ring-primary h-4 w-4 cursor-pointer"
                      onChange={handleSelectAll}
                      checked={
                        paginatedData.length > 0 &&
                        paginatedData.every((row) =>
                          selectedIds.includes(row.id),
                        )
                      }
                    />
                  </div>
                </th>
              )}
              <th className="px-6 py-3 w-10 text-center">#</th>
              {columns.map((col) => (
                <th
                  key={col.key}
                  className={`px-6 py-3 cursor-pointer hover:bg-gray-200 dark:hover:bg-white/10 transition-colors ${col.className || ""}`}
                  onClick={() => col.sortable && requestSort(col.key)}
                >
                  <div
                    className={`flex items-center gap-1 ${col.className?.includes("text-center") ? "justify-center" : ""} ${col.className?.includes("text-right") ? "justify-end" : ""}`}
                  >
                    {col.label}
                    {col.sortable && (
                      <span className="text-gray-400">
                        {sortConfig?.key === col.key ? (
                          sortConfig.direction === "asc" ? (
                            <FaSortUp />
                          ) : (
                            <FaSortDown />
                          )
                        ) : (
                          <FaSort />
                        )}
                      </span>
                    )}
                  </div>
                </th>
              ))}
            </tr>
          </thead>
          <tbody className="divide-y divide-border dark:divide-darkmode-border">
            {paginatedData.length > 0 ? (
              paginatedData.map((row, i) => (
                <tr
                  key={i}
                  className={`transition-colors ${selectedIds.includes(row.id) ? "bg-blue-50 dark:bg-blue-900/20" : "hover:bg-gray-50 dark:hover:bg-white/5"}`}
                >
                  {/* CHECKBOX ROW */}
                  {enableSelection && (
                    <td className="px-4 py-4 text-center">
                      <div className="flex items-center justify-center">
                        <input
                          type="checkbox"
                          className="rounded border-gray-300 text-primary focus:ring-primary h-4 w-4 cursor-pointer"
                          checked={selectedIds.includes(row.id)}
                          onChange={() => handleSelectRow(row.id)}
                        />
                      </div>
                    </td>
                  )}
                  <td className="px-6 py-4 text-center text-gray-400">
                    {(currentPage - 1) * rowsPerPage + i + 1}
                  </td>
                  {columns.map((col) => (
                    <td
                      key={col.key}
                      className={`px-6 py-4 ${col.className || ""}`}
                    >
                      {col.render
                        ? col.render(row[col.key], row)
                        : row[col.key]}
                    </td>
                  ))}
                </tr>
              ))
            ) : (
              <tr>
                <td
                  colSpan={columns.length + (enableSelection ? 2 : 1)}
                  className="px-6 py-10 text-center text-gray-500"
                >
                  Tidak ada data ditemukan.
                </td>
              </tr>
            )}
          </tbody>
        </table>
      </div>
      <div className="flex flex-col items-center justify-between gap-4 border-t border-border bg-gray-50 p-4 dark:bg-white/5 dark:border-darkmode-border sm:flex-row">
        <div className="text-xs text-gray-500">
          Menampilkan{" "}
          <span className="font-bold text-gray-700 dark:text-gray-300">
            {(currentPage - 1) * rowsPerPage + 1}
          </span>{" "}
          sampai{" "}
          <span className="font-bold text-gray-700 dark:text-gray-300">
            {Math.min(currentPage * rowsPerPage, sortedData.length)}
          </span>{" "}
          dari{" "}
          <span className="font-bold text-gray-700 dark:text-gray-300">
            {sortedData.length}
          </span>{" "}
          data
        </div>
        <div className="flex items-center gap-2">
          <select
            className="rounded border border-border bg-white px-2 py-1 text-xs outline-none focus:border-primary dark:bg-darkmode-body dark:border-darkmode-border"
            value={rowsPerPage}
            onChange={(e) => {
              setRowsPerPage(Number(e.target.value));
              setCurrentPage(1);
            }}
          >
            <option value={5}>5</option>
            <option value={10}>10</option>
            <option value={20}>20</option>
            <option value={50}>50</option>
          </select>
          <div className="flex rounded border border-border bg-white dark:bg-darkmode-body dark:border-darkmode-border">
            <button
              onClick={() => setCurrentPage((p) => Math.max(1, p - 1))}
              disabled={currentPage === 1}
              className="px-3 py-1 hover:bg-gray-100 disabled:opacity-50 dark:hover:bg-white/10"
            >
              <FaChevronLeft className="text-xs" />
            </button>
            <span className="px-3 py-1 text-xs font-medium border-l border-r border-border dark:border-darkmode-border flex items-center">
              Halaman {currentPage}
            </span>
            <button
              onClick={() => setCurrentPage((p) => Math.min(totalPages, p + 1))}
              disabled={currentPage === totalPages || totalPages === 0}
              className="px-3 py-1 hover:bg-gray-100 disabled:opacity-50 dark:hover:bg-white/10"
            >
              <FaChevronRight className="text-xs" />
            </button>
          </div>
        </div>
      </div>
    </div>
  );
};

export default AdminDashboard;
