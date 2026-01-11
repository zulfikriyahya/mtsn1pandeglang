import React, { useEffect, useState, useMemo } from "react";
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

// Registrasi Komponen Chart
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

const AdminDashboard = () => {
  const [user, setUser] = useState<User | null>(null);
  const [loading, setLoading] = useState(true);
  const [data, setData] = useState<any>(null);
  const [activeTab, setActiveTab] = useState("overview");

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

  useEffect(() => {
    const init = async () => {
      try {
        const authRes = await fetch("/api/auth.php?action=check");
        const authData = await authRes.json();
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
      } catch (e) {
        console.error(e);
      }
      setLoading(false);
    };
    init();
  }, []);

  const handleCredentialResponse = async (response: any) => {
    setLoading(true);
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
    setLoading(false);
  };

  const fetchStats = async () => {
    const res = await fetch("/api/admin.php?action=stats");
    if (res.ok) {
      const json = await res.json();
      setData(json);
    }
  };

  const handleLogout = async () => {
    await fetch("/api/auth.php?action=logout");
    setUser(null);
    window.location.reload();
  };

  const downloadReport = (type: string) => {
    window.open(`/api/admin.php?action=export&type=${type}`, "_blank");
  };

  const printPDF = () => window.print();

  if (loading)
    return <div className="text-center p-12">Memuat Sistem Admin...</div>;

  // --- LOGIN UI ---
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
          <p className="mb-8 text-sm text-text-light">
            Silakan login untuk mengakses data.
          </p>
          <div className="flex justify-center h-[50px]">
            <div id="googleBtn"></div>
          </div>
        </div>
      </div>
    );
  }

  // --- DASHBOARD UI ---
  return (
    <div className="min-h-screen pb-12">
      {/* 1. Header */}
      <div className="mb-8 flex flex-col md:flex-row items-center justify-between gap-4 rounded-xl bg-white p-6 border border-border shadow-sm dark:bg-darkmode-light dark:border-darkmode-border">
        <div className="flex items-center gap-4">
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
        <div className="flex gap-2">
          <button
            onClick={printPDF}
            className="btn btn-outline-primary btn-sm flex items-center gap-2 print:hidden"
          >
            <FaDownload /> PDF
          </button>
          <button
            onClick={handleLogout}
            className="btn btn-primary btn-sm flex items-center gap-2 bg-red-500 border-red-500 hover:bg-red-600 print:hidden"
          >
            <FaSignOutAlt /> Keluar
          </button>
        </div>
      </div>

      {data && (
        <>
          {/* 2. Overview Stats Cards */}
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

          {/* 3. Navigation Tabs */}
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
                  className={`whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium transition-colors ${
                    activeTab === tab.id
                      ? "border-primary text-primary"
                      : "border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 dark:text-gray-400"
                  }`}
                >
                  {tab.label}
                </button>
              ))}
            </nav>
          </div>

          {/* 4. Content Area */}
          <div className="animate-fade-in">
            {/* TAB: OVERVIEW (Charts) */}
            {activeTab === "overview" && (
              <div className="grid grid-cols-1 lg:grid-cols-2 gap-8">
                {/* Trend Chart */}
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
                      options={{
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { position: "top" } },
                      }}
                    />
                  </div>
                </div>

                {/* Pie Chart: Rating */}
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

                {/* Bar Chart: Survey Score */}
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

            {/* TAB: POSTS */}
            {activeTab === "posts" && (
              <DataTable
                title="Statistik Artikel Populer"
                data={data.tables.posts}
                columns={[
                  {
                    key: "slug",
                    label: "Judul Artikel",
                    render: (val: string) =>
                      val.replace(/-/g, " ").toUpperCase(),
                  },
                  {
                    key: "views",
                    label: "Jumlah Pembaca",
                    sortable: true,
                    className: "text-right font-bold",
                  },
                ]}
                onDownload={() => downloadReport("posts")}
              />
            )}

            {/* TAB: FEEDBACK */}
            {activeTab === "feedback" && (
              <DataTable
                title="Data Ulasan Masuk"
                data={data.tables.feedbacks}
                columns={[
                  {
                    key: "created_at",
                    label: "Tanggal",
                    sortable: true,
                    className: "w-32 text-sm text-gray-500",
                  },
                  {
                    key: "name",
                    label: "Nama Pengirim",
                    sortable: true,
                    className: "font-medium",
                  },
                  {
                    key: "rating",
                    label: "Rating",
                    sortable: true,
                    render: (val: number) => (
                      <span className="inline-block px-2 py-1 bg-yellow-100 text-yellow-700 rounded text-xs font-bold">
                        {val} ★
                      </span>
                    ),
                  },
                  {
                    key: "message",
                    label: "Pesan / Kritik",
                    className: "italic text-gray-600 dark:text-gray-400",
                  },
                  {
                    key: "ip_address",
                    label: "IP Address",
                    className: "text-xs text-gray-400 font-mono",
                  },
                ]}
                searchKeys={["name", "message"]}
                onDownload={() => downloadReport("feedback")}
              />
            )}

            {/* TAB: SURVEY */}
            {activeTab === "surveys" && (
              <DataTable
                title="Data Survei Kepuasan"
                data={data.tables.surveys}
                columns={[
                  {
                    key: "created_at",
                    label: "Tanggal",
                    sortable: true,
                    className: "w-32 text-sm text-gray-500",
                  },
                  {
                    key: "respondent_name",
                    label: "Responden",
                    sortable: true,
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
                    className: "text-center font-semibold text-blue-600",
                  },
                  {
                    key: "score_service",
                    label: "Layanan",
                    sortable: true,
                    className: "text-center font-semibold text-green-600",
                  },
                  {
                    key: "score_academic",
                    label: "Akademik",
                    sortable: true,
                    className: "text-center font-semibold text-purple-600",
                  },
                  {
                    key: "feedback",
                    label: "Masukan",
                    className: "italic text-gray-500 text-sm",
                  },
                ]}
                searchKeys={["respondent_name", "feedback"]}
                onDownload={() => downloadReport("survey")}
              />
            )}
          </div>
        </>
      )}
    </div>
  );
};

// --- SUB COMPONENTS ---

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

// --- ADVANCED DATA TABLE COMPONENT ---
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
}: {
  title: string;
  data: any[];
  columns: Column[];
  searchKeys?: string[];
  onDownload: () => void;
}) => {
  const [search, setSearch] = useState("");
  const [sortConfig, setSortConfig] = useState<{
    key: string;
    direction: "asc" | "desc";
  } | null>(null);
  const [currentPage, setCurrentPage] = useState(1);
  const [rowsPerPage, setRowsPerPage] = useState(10);

  // 1. Filtering
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

  // 2. Sorting
  const sortedData = useMemo(() => {
    if (!sortConfig) return filteredData;
    return [...filteredData].sort((a, b) => {
      if (a[sortConfig.key] < b[sortConfig.key])
        return sortConfig.direction === "asc" ? -1 : 1;
      if (a[sortConfig.key] > b[sortConfig.key])
        return sortConfig.direction === "asc" ? 1 : -1;
      return 0;
    });
  }, [filteredData, sortConfig]);

  // 3. Pagination
  const totalPages = Math.ceil(sortedData.length / rowsPerPage);
  const paginatedData = sortedData.slice(
    (currentPage - 1) * rowsPerPage,
    currentPage * rowsPerPage,
  );

  const requestSort = (key: string) => {
    let direction: "asc" | "desc" = "asc";
    if (
      sortConfig &&
      sortConfig.key === key &&
      sortConfig.direction === "asc"
    ) {
      direction = "desc";
    }
    setSortConfig({ key, direction });
  };

  return (
    <div className="rounded-xl border border-border bg-white shadow-sm overflow-hidden dark:bg-darkmode-light dark:border-darkmode-border">
      {/* Table Header Controls */}
      <div className="flex flex-col gap-4 p-5 md:flex-row md:items-center md:justify-between border-b border-border dark:border-darkmode-border bg-gray-50 dark:bg-white/5">
        <h3 className="text-lg font-bold">{title}</h3>
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

      {/* Table Content */}
      <div className="overflow-x-auto">
        <table className="w-full text-left text-sm">
          <thead className="bg-gray-100 text-xs uppercase text-gray-500 dark:bg-black/20">
            <tr>
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
                  className="hover:bg-gray-50 dark:hover:bg-white/5 transition-colors"
                >
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
                  colSpan={columns.length + 1}
                  className="px-6 py-10 text-center text-gray-500"
                >
                  Tidak ada data ditemukan.
                </td>
              </tr>
            )}
          </tbody>
        </table>
      </div>

      {/* Pagination Footer */}
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
