import React, { useEffect, useState } from "react";
import {
  FaHome,
  FaChartBar,
  FaComments,
  FaPoll,
  FaSignOutAlt,
  FaDownload,
  FaBars,
  FaTimes,
  FaStar,
  FaEye,
  FaUsers,
  FaSearch,
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
} from "chart.js";
import { Bar, Pie, Line } from "react-chartjs-2";

// Registrasi ChartJS
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
  const [activeTab, setActiveTab] = useState("dashboard");
  const [sidebarOpen, setSidebarOpen] = useState(false);
  const [searchTerm, setSearchTerm] = useState("");

  // --- AUTH & INIT LOGIC (Sama seperti sebelumnya) ---
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

  // --- CHART CONFIGURATIONS ---
  const chartOptions = { responsive: true, maintainAspectRatio: false };

  // --- LOADING STATE ---
  if (loading)
    return (
      <div className="flex h-screen items-center justify-center bg-gray-50">
        <div className="h-10 w-10 animate-spin rounded-full border-4 border-primary border-t-transparent"></div>
      </div>
    );

  // --- LOGIN PAGE ---
  if (!user) {
    return (
      <div className="flex min-h-screen items-center justify-center bg-gray-50 px-4">
        <div className="w-full max-w-md rounded-2xl bg-white p-8 shadow-xl text-center">
          <img
            src="/images/brand-lightmode.png"
            alt="Logo"
            className="mx-auto mb-8 h-12"
          />
          <h2 className="text-2xl font-bold text-gray-800">Admin Portal</h2>
          <p className="mb-8 text-gray-500">Login untuk mengakses dashboard.</p>
          <div className="flex justify-center h-[50px]">
            <div id="googleBtn"></div>
          </div>
        </div>
      </div>
    );
  }

  // --- MAIN LAYOUT ---
  return (
    <div className="flex h-screen bg-gray-100 dark:bg-[#0f172a] overflow-hidden text-gray-800 dark:text-gray-200">
      {/* SIDEBAR */}
      <aside
        className={`fixed inset-y-0 left-0 z-50 w-64 bg-white dark:bg-[#1e293b] shadow-lg transform transition-transform duration-300 lg:relative lg:translate-x-0 ${sidebarOpen ? "translate-x-0" : "-translate-x-full"}`}
      >
        <div className="flex h-16 items-center justify-between px-6 border-b border-gray-100 dark:border-gray-700">
          <span className="text-lg font-bold text-primary">ADMIN PANEL</span>
          <button
            onClick={() => setSidebarOpen(false)}
            className="lg:hidden text-gray-500"
          >
            <FaTimes />
          </button>
        </div>
        <nav className="p-4 space-y-2">
          {[
            { id: "dashboard", label: "Dashboard", icon: <FaHome /> },
            {
              id: "articles",
              label: "Statistik Artikel",
              icon: <FaChartBar />,
            },
            { id: "feedback", label: "Ulasan Pelayanan", icon: <FaComments /> },
            { id: "surveys", label: "Data Survei", icon: <FaPoll /> },
          ].map((item) => (
            <button
              key={item.id}
              onClick={() => {
                setActiveTab(item.id);
                setSidebarOpen(false);
              }}
              className={`flex w-full items-center gap-3 rounded-lg px-4 py-3 text-sm font-medium transition-colors ${
                activeTab === item.id
                  ? "bg-primary/10 text-primary dark:bg-primary/20"
                  : "text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:hover:bg-gray-800"
              }`}
            >
              {item.icon} {item.label}
            </button>
          ))}
        </nav>
        <div className="absolute bottom-0 w-full p-4 border-t border-gray-100 dark:border-gray-700">
          <div className="flex items-center gap-3 mb-4">
            <img
              src={user.picture}
              alt="Avatar"
              className="h-10 w-10 rounded-full border border-gray-200"
            />
            <div className="overflow-hidden">
              <p className="truncate text-sm font-bold">{user.name}</p>
              <p className="truncate text-xs text-gray-500">{user.email}</p>
            </div>
          </div>
          <button
            onClick={handleLogout}
            className="flex w-full items-center justify-center gap-2 rounded-lg bg-red-50 text-red-600 py-2 text-sm font-medium hover:bg-red-100 transition-colors"
          >
            <FaSignOutAlt /> Keluar
          </button>
        </div>
      </aside>

      {/* CONTENT AREA */}
      <main className="flex-1 flex flex-col h-screen overflow-hidden">
        {/* HEADER */}
        <header className="flex h-16 items-center justify-between bg-white dark:bg-[#1e293b] px-6 shadow-sm border-b border-gray-100 dark:border-gray-700">
          <button
            onClick={() => setSidebarOpen(true)}
            className="lg:hidden text-gray-600"
          >
            <FaBars />
          </button>
          <h1 className="text-xl font-bold capitalize ml-4 lg:ml-0">
            {activeTab.replace("_", " ")}
          </h1>
          <div className="flex items-center gap-4">
            <span className="text-xs text-gray-400 hidden sm:block">
              Last updated: {new Date().toLocaleTimeString()}
            </span>
          </div>
        </header>

        {/* SCROLLABLE CONTENT */}
        <div className="flex-1 overflow-y-auto p-6">
          {/* VIEW: DASHBOARD */}
          {activeTab === "dashboard" && data && (
            <div className="space-y-6">
              {/* STATS GRID */}
              <div className="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
                <StatCard
                  title="Total Kunjungan"
                  value={data.overview.visits.toLocaleString()}
                  icon={<FaEye className="text-blue-500" />}
                  bg="bg-blue-50 dark:bg-blue-900/20"
                />
                <StatCard
                  title="Total Ulasan"
                  value={data.overview.feedback_count}
                  icon={<FaStar className="text-yellow-500" />}
                  bg="bg-yellow-50 dark:bg-yellow-900/20"
                />
                <StatCard
                  title="Responden Survei"
                  value={data.overview.survey_count}
                  icon={<FaPoll className="text-purple-500" />}
                  bg="bg-purple-50 dark:bg-purple-900/20"
                />
                <StatCard
                  title="Artikel Dibaca"
                  value={data.overview.posts_count}
                  icon={<FaChartBar className="text-green-500" />}
                  bg="bg-green-50 dark:bg-green-900/20"
                />
              </div>

              {/* CHARTS ROW 1 */}
              <div className="grid grid-cols-1 lg:grid-cols-3 gap-6">
                {/* RATA-RATA SURVEI (BAR) */}
                <div className="lg:col-span-2 rounded-xl bg-white dark:bg-[#1e293b] p-6 shadow-sm border border-gray-100 dark:border-gray-700">
                  <h3 className="mb-4 font-bold text-gray-700 dark:text-gray-300">
                    Indeks Kepuasan Rata-rata
                  </h3>
                  <div className="h-64">
                    <Bar
                      data={{
                        labels: ["Zona Integritas", "Pelayanan", "Akademik"],
                        datasets: [
                          {
                            label: "Skor (Maks 5.0)",
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
                      options={chartOptions}
                    />
                  </div>
                </div>

                {/* DISTRIBUSI BINTANG (PIE) */}
                <div className="rounded-xl bg-white dark:bg-[#1e293b] p-6 shadow-sm border border-gray-100 dark:border-gray-700">
                  <h3 className="mb-4 font-bold text-gray-700 dark:text-gray-300">
                    Distribusi Rating
                  </h3>
                  <div className="h-64 flex justify-center">
                    <Pie
                      data={{
                        labels: [
                          "5 Bintang",
                          "4 Bintang",
                          "3 Bintang",
                          "2 Bintang",
                          "1 Bintang",
                        ],
                        datasets: [
                          {
                            data: [
                              data.charts.stars[5],
                              data.charts.stars[4],
                              data.charts.stars[3],
                              data.charts.stars[2],
                              data.charts.stars[1],
                            ],
                            backgroundColor: [
                              "#22c55e",
                              "#3b82f6",
                              "#eab308",
                              "#f97316",
                              "#ef4444",
                            ],
                            borderWidth: 0,
                          },
                        ],
                      }}
                      options={chartOptions}
                    />
                  </div>
                </div>
              </div>

              {/* CHARTS ROW 2 - ACTIVITY LINE */}
              <div className="rounded-xl bg-white dark:bg-[#1e293b] p-6 shadow-sm border border-gray-100 dark:border-gray-700">
                <h3 className="mb-4 font-bold text-gray-700 dark:text-gray-300">
                  Aktivitas 7 Hari Terakhir
                </h3>
                <div className="h-64">
                  <Line
                    data={{
                      labels: Object.keys(data.charts.activity.feedback),
                      datasets: [
                        {
                          label: "Ulasan Masuk",
                          data: Object.values(data.charts.activity.feedback),
                          borderColor: "#eab308",
                          tension: 0.4,
                        },
                        {
                          label: "Survei Masuk",
                          data: Object.values(data.charts.activity.survey),
                          borderColor: "#8b5cf6",
                          tension: 0.4,
                        },
                      ],
                    }}
                    options={chartOptions}
                  />
                </div>
              </div>
            </div>
          )}

          {/* VIEW: ARTICLES */}
          {activeTab === "articles" && (
            <DataTable
              title="Statistik Artikel"
              data={data.tables.posts}
              columns={[
                {
                  header: "Judul Artikel",
                  accessor: (row: any) =>
                    row.slug.replace(/-/g, " ").toUpperCase(),
                  className: "font-medium",
                },
                {
                  header: "Dibaca",
                  accessor: "views",
                  className: "text-right",
                },
              ]}
              onDownload={() => downloadReport("posts")}
            />
          )}

          {/* VIEW: FEEDBACK */}
          {activeTab === "feedback" && (
            <DataTable
              title="Ulasan & Kritik Saran"
              data={data.tables.feedbacks}
              columns={[
                {
                  header: "Tanggal",
                  accessor: "created_at",
                  className: "text-gray-500 text-xs w-32",
                },
                { header: "Nama", accessor: "name", className: "font-medium" },
                {
                  header: "Rating",
                  accessor: (row: any) => (
                    <span className="text-yellow-500 font-bold">
                      {row.rating} ★
                    </span>
                  ),
                  className: "w-20",
                },
                {
                  header: "Pesan",
                  accessor: "message",
                  className: "italic text-gray-600 dark:text-gray-400",
                },
              ]}
              searchable
              onDownload={() => downloadReport("feedback")}
            />
          )}

          {/* VIEW: SURVEYS */}
          {activeTab === "surveys" && (
            <DataTable
              title="Data Survei Kepuasan"
              data={data.tables.surveys}
              columns={[
                {
                  header: "Tanggal",
                  accessor: "created_at",
                  className: "text-gray-500 text-xs w-32",
                },
                {
                  header: "Responden",
                  accessor: (row: any) => (
                    <div>
                      <div className="font-bold">{row.respondent_name}</div>
                      <div className="text-xs text-gray-500">
                        {row.respondent_role}
                      </div>
                    </div>
                  ),
                },
                {
                  header: "ZI",
                  accessor: "score_zi",
                  className: "text-center font-bold text-blue-600",
                },
                {
                  header: "Layanan",
                  accessor: "score_service",
                  className: "text-center font-bold text-green-600",
                },
                {
                  header: "Akademik",
                  accessor: "score_academic",
                  className: "text-center font-bold text-purple-600",
                },
                {
                  header: "Masukan",
                  accessor: (row: any) => (
                    <span className="italic text-gray-500">
                      {row.feedback || "-"}
                    </span>
                  ),
                },
              ]}
              searchable
              onDownload={() => downloadReport("survey")}
            />
          )}
        </div>
      </main>
    </div>
  );
};

// --- SUB COMPONENTS ---

const StatCard = ({ title, value, icon, bg }: any) => (
  <div className="rounded-xl border border-gray-100 bg-white p-6 shadow-sm dark:bg-[#1e293b] dark:border-gray-700 transition-transform hover:-translate-y-1">
    <div className="flex items-center justify-between">
      <div>
        <p className="text-sm font-medium text-gray-500 dark:text-gray-400">
          {title}
        </p>
        <p className="text-3xl font-bold text-gray-800 dark:text-white mt-1">
          {value}
        </p>
      </div>
      <div
        className={`flex h-12 w-12 items-center justify-center rounded-lg ${bg} text-xl`}
      >
        {icon}
      </div>
    </div>
  </div>
);

const DataTable = ({ title, data, columns, onDownload, searchable }: any) => {
  const [filter, setFilter] = useState("");

  const filteredData = data.filter((row: any) => {
    if (!filter) return true;
    return Object.values(row).some((val) =>
      String(val).toLowerCase().includes(filter.toLowerCase()),
    );
  });

  return (
    <div className="rounded-xl border border-gray-100 bg-white shadow-sm dark:bg-[#1e293b] dark:border-gray-700 overflow-hidden">
      <div className="flex flex-col sm:flex-row items-center justify-between border-b border-gray-100 px-6 py-4 dark:border-gray-700 gap-4">
        <h3 className="text-lg font-bold text-gray-800 dark:text-white">
          {title}
        </h3>
        <div className="flex w-full sm:w-auto items-center gap-3">
          {searchable && (
            <div className="relative w-full sm:w-64">
              <FaSearch className="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs" />
              <input
                type="text"
                placeholder="Cari data..."
                className="w-full rounded-lg border border-gray-200 py-2 pl-9 pr-4 text-sm focus:border-primary focus:outline-none dark:bg-gray-800 dark:border-gray-600"
                onChange={(e) => setFilter(e.target.value)}
              />
            </div>
          )}
          <button
            onClick={onDownload}
            className="flex items-center gap-2 rounded-lg bg-green-50 px-4 py-2 text-sm font-medium text-green-600 hover:bg-green-100 transition-colors"
          >
            <FaDownload /> <span className="hidden sm:inline">Excel</span>
          </button>
        </div>
      </div>
      <div className="overflow-x-auto">
        <table className="w-full text-left text-sm">
          <thead className="bg-gray-50 text-xs uppercase text-gray-500 dark:bg-gray-800">
            <tr>
              {columns.map((col: any, i: number) => (
                <th key={i} className={`px-6 py-3 ${col.className || ""}`}>
                  {col.header}
                </th>
              ))}
            </tr>
          </thead>
          <tbody className="divide-y divide-gray-100 dark:divide-gray-700">
            {filteredData.length > 0 ? (
              filteredData.map((row: any, i: number) => (
                <tr
                  key={i}
                  className="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors"
                >
                  {columns.map((col: any, j: number) => (
                    <td key={j} className={`px-6 py-4 ${col.className || ""}`}>
                      {typeof col.accessor === "function"
                        ? col.accessor(row)
                        : row[col.accessor]}
                    </td>
                  ))}
                </tr>
              ))
            ) : (
              <tr>
                <td
                  colSpan={columns.length}
                  className="px-6 py-8 text-center text-gray-500"
                >
                  Tidak ada data ditemukan.
                </td>
              </tr>
            )}
          </tbody>
        </table>
      </div>
      <div className="bg-gray-50 px-6 py-3 text-xs text-gray-500 dark:bg-gray-800 border-t border-gray-100 dark:border-gray-700">
        Menampilkan {filteredData.length} data terbaru.
      </div>
    </div>
  );
};

export default AdminDashboard;
