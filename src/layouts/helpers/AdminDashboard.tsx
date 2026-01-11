import React, { useEffect, useState } from "react";
import {
  FaDownload,
  FaSignOutAlt,
  FaEye,
  FaStar,
  FaChartLine,
} from "react-icons/fa";

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

  // 1. Cek Login & Fetch Data
  useEffect(() => {
    const init = async () => {
      // Load Google Script
      const script = document.createElement("script");
      script.src = "https://accounts.google.com/gsi/client";
      script.async = true;
      document.body.appendChild(script);

      // Cek Session PHP
      const authRes = await fetch("/api/auth.php?action=check");
      const authData = await authRes.json();

      if (authData.status === "authenticated") {
        setUser(authData.user);
        fetchStats();
      } else {
        // Render Google Button jika belum login
        script.onload = () => {
          /* @ts-ignore */
          window.google.accounts.id.initialize({
            client_id: import.meta.env.PUBLIC_GOOGLE_CLIENT_ID,
            callback: handleCredentialResponse,
          });
          /* @ts-ignore */
          window.google.accounts.id.renderButton(
            document.getElementById("googleBtn"),
            { theme: "outline", size: "large", width: 250 },
          );
        };
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

  const printPDF = () => {
    window.print();
  };

  if (loading) return <div className="text-center p-10">Memuat Sistem...</div>;

  // --- TAMPILAN LOGIN ---
  if (!user) {
    return (
      <div className="flex min-h-[60vh] flex-col items-center justify-center">
        <div className="w-full max-w-md rounded-2xl border border-border bg-white p-8 text-center shadow-xl dark:border-darkmode-border dark:bg-darkmode-light">
          <img
            src="/images/brand-lightmode.png"
            alt="Logo"
            className="mx-auto mb-6 h-12"
          />
          <h2 className="h4 mb-2">Login Admin</h2>
          <p className="mb-8 text-sm text-text-light">
            Khusus untuk email:{" "}
            <b>
              {import.meta.env.ADMIN_EMAIL || "dev.mtsn1pandeglang@gmail.com"}
            </b>
          </p>
          <div className="flex justify-center">
            <div id="googleBtn"></div>
          </div>
        </div>
      </div>
    );
  }

  // --- TAMPILAN DASHBOARD ---
  return (
    <div className="min-h-screen">
      {/* Header Admin */}
      <div className="mb-8 flex flex-col md:flex-row items-center justify-between gap-4 rounded-xl bg-primary/10 p-6 border border-primary/20">
        <div className="flex items-center gap-4">
          <img
            src={user.picture}
            alt={user.name}
            className="h-12 w-12 rounded-full border-2 border-white shadow"
          />
          <div>
            <h3 className="h5 mb-0">Halo, {user.name}</h3>
            <p className="text-sm text-text-light">{user.email}</p>
          </div>
        </div>
        <div className="flex gap-2">
          <button
            onClick={printPDF}
            className="btn btn-outline-primary btn-sm flex items-center gap-2 print:hidden"
          >
            <FaDownload /> Cetak PDF
          </button>
          <button
            onClick={handleLogout}
            className="btn btn-primary btn-sm flex items-center gap-2 bg-red-500 border-red-500 hover:bg-red-600 print:hidden"
          >
            <FaSignOutAlt /> Logout
          </button>
        </div>
      </div>

      {/* Stats Cards */}
      {data && (
        <div className="mb-8 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
          <div className="rounded-xl border border-border bg-white p-6 shadow-sm dark:bg-darkmode-light">
            <div className="flex items-center gap-3 mb-2">
              <div className="p-2 bg-blue-100 text-blue-600 rounded-lg">
                <FaEye />
              </div>
              <h4 className="text-sm font-bold uppercase text-gray-500">
                Total Kunjungan
              </h4>
            </div>
            <p className="text-3xl font-bold">{data.visits.toLocaleString()}</p>
          </div>

          <div className="rounded-xl border border-border bg-white p-6 shadow-sm dark:bg-darkmode-light">
            <div className="flex items-center gap-3 mb-2">
              <div className="p-2 bg-yellow-100 text-yellow-600 rounded-lg">
                <FaStar />
              </div>
              <h4 className="text-sm font-bold uppercase text-gray-500">
                Total Ulasan
              </h4>
            </div>
            <p className="text-3xl font-bold">{data.ratings.length}</p>
          </div>

          <div className="rounded-xl border border-border bg-white p-6 shadow-sm dark:bg-darkmode-light">
            <div className="flex items-center gap-3 mb-2">
              <div className="p-2 bg-purple-100 text-purple-600 rounded-lg">
                <FaChartLine />
              </div>
              <h4 className="text-sm font-bold uppercase text-gray-500">
                Total Survei
              </h4>
            </div>
            <p className="text-3xl font-bold">{data.surveys.length}</p>
          </div>
        </div>
      )}

      {/* Tabs Navigation */}
      <div className="mb-6 border-b border-border dark:border-darkmode-border print:hidden">
        <nav className="-mb-px flex space-x-8">
          {["overview", "posts", "ratings", "surveys"].map((tab) => (
            <button
              key={tab}
              onClick={() => setActiveTab(tab)}
              className={`border-b-2 py-4 px-1 text-sm font-medium capitalize ${
                activeTab === tab
                  ? "border-primary text-primary"
                  : "border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700"
              }`}
            >
              {tab}
            </button>
          ))}
        </nav>
      </div>

      {/* Tab Contents */}
      {data && (
        <div className="space-y-8">
          {/* TAB: POSTS */}
          {(activeTab === "overview" || activeTab === "posts") && (
            <div className="rounded-xl border border-border bg-white shadow-sm dark:bg-darkmode-light overflow-hidden">
              <div className="flex items-center justify-between border-b border-border bg-gray-50 px-6 py-4 dark:bg-white/5 dark:border-darkmode-border">
                <h3 className="h6 mb-0">10 Artikel Terpopuler</h3>
                <button
                  onClick={() => downloadReport("posts")}
                  className="text-sm text-primary hover:underline print:hidden"
                >
                  Download Excel
                </button>
              </div>
              <div className="overflow-x-auto">
                <table className="w-full text-left text-sm">
                  <thead className="bg-gray-50 text-xs uppercase text-gray-500 dark:bg-white/5">
                    <tr>
                      <th className="px-6 py-3">Judul / Slug</th>
                      <th className="px-6 py-3 text-right">Dilihat</th>
                    </tr>
                  </thead>
                  <tbody className="divide-y divide-gray-200 dark:divide-white/10">
                    {data.posts.map((post: any, i: number) => (
                      <tr
                        key={i}
                        className="hover:bg-gray-50 dark:hover:bg-white/5"
                      >
                        <td className="px-6 py-4 font-medium">
                          {post.slug.replace(/_/g, " ")}
                        </td>
                        <td className="px-6 py-4 text-right">{post.views}</td>
                      </tr>
                    ))}
                  </tbody>
                </table>
              </div>
            </div>
          )}

          {/* TAB: RATINGS */}
          {(activeTab === "overview" || activeTab === "ratings") && (
            <div className="rounded-xl border border-border bg-white shadow-sm dark:bg-darkmode-light overflow-hidden">
              <div className="flex items-center justify-between border-b border-border bg-gray-50 px-6 py-4 dark:bg-white/5 dark:border-darkmode-border">
                <h3 className="h6 mb-0">Ulasan Pelayanan Terbaru</h3>
                <button
                  onClick={() => downloadReport("feedback")}
                  className="text-sm text-primary hover:underline print:hidden"
                >
                  Download Excel
                </button>
              </div>
              <div className="overflow-x-auto">
                <table className="w-full text-left text-sm">
                  <thead className="bg-gray-50 text-xs uppercase text-gray-500 dark:bg-white/5">
                    <tr>
                      <th className="px-6 py-3">Tanggal</th>
                      <th className="px-6 py-3">Nama</th>
                      <th className="px-6 py-3">Rating</th>
                      <th className="px-6 py-3">Pesan</th>
                    </tr>
                  </thead>
                  <tbody className="divide-y divide-gray-200 dark:divide-white/10">
                    {data.ratings.map((item: any, i: number) => (
                      <tr key={i}>
                        <td className="px-6 py-4 whitespace-nowrap text-gray-500">
                          {item.created_at}
                        </td>
                        <td className="px-6 py-4 font-medium">{item.name}</td>
                        <td className="px-6 py-4 text-yellow-500 font-bold">
                          {item.rating} ★
                        </td>
                        <td className="px-6 py-4 text-gray-600 max-w-xs truncate">
                          {item.message}
                        </td>
                      </tr>
                    ))}
                  </tbody>
                </table>
              </div>
            </div>
          )}

          {/* TAB: SURVEYS */}
          {(activeTab === "overview" || activeTab === "surveys") && (
            <div className="rounded-xl border border-border bg-white shadow-sm dark:bg-darkmode-light overflow-hidden page-break">
              <div className="flex items-center justify-between border-b border-border bg-gray-50 px-6 py-4 dark:bg-white/5 dark:border-darkmode-border">
                <h3 className="h6 mb-0">Data Survei Kepuasan</h3>
                <button
                  onClick={() => downloadReport("survey")}
                  className="text-sm text-primary hover:underline print:hidden"
                >
                  Download Excel
                </button>
              </div>
              <div className="overflow-x-auto">
                <table className="w-full text-left text-sm">
                  <thead className="bg-gray-50 text-xs uppercase text-gray-500 dark:bg-white/5">
                    <tr>
                      <th className="px-6 py-3">Responden</th>
                      <th className="px-6 py-3 text-center">ZI</th>
                      <th className="px-6 py-3 text-center">Layanan</th>
                      <th className="px-6 py-3 text-center">Akademik</th>
                      <th className="px-6 py-3">Masukan</th>
                    </tr>
                  </thead>
                  <tbody className="divide-y divide-gray-200 dark:divide-white/10">
                    {data.surveys.map((item: any, i: number) => (
                      <tr key={i}>
                        <td className="px-6 py-4">
                          <div className="font-bold">
                            {item.respondent_name}
                          </div>
                          <div className="text-xs text-gray-500">
                            {item.respondent_role}
                          </div>
                          <div className="text-xs text-gray-400 mt-1">
                            {item.created_at}
                          </div>
                        </td>
                        <td className="px-6 py-4 text-center font-bold text-blue-600">
                          {item.score_zi}
                        </td>
                        <td className="px-6 py-4 text-center font-bold text-green-600">
                          {item.score_service}
                        </td>
                        <td className="px-6 py-4 text-center font-bold text-purple-600">
                          {item.score_academic}
                        </td>
                        <td className="px-6 py-4 text-gray-600 italic max-w-xs">
                          {item.feedback || "-"}
                        </td>
                      </tr>
                    ))}
                  </tbody>
                </table>
              </div>
            </div>
          )}
        </div>
      )}
    </div>
  );
};

export default AdminDashboard;
