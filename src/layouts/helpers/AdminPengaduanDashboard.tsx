import React, { useEffect, useState, useMemo } from "react";
import {
  FaDownload,
  FaEye,
  FaEdit,
  FaTrash,
  FaFileUpload,
  FaTimes,
  FaCheckCircle,
  FaTimesCircle,
  FaSpinner,
  FaFilter,
  FaCalendarAlt,
  FaExclamationTriangle,
  FaSort,
  FaSortUp,
  FaSortDown,
  FaSearch,
  FaChevronLeft,
  FaChevronRight,
} from "react-icons/fa";

interface PengaduanData {
  id: number;
  nama: string;
  email: string;
  telepon: string;
  kategori: string;
  judul: string;
  isi_pengaduan: string;
  status: string;
  tanggapan: string;
  ip_address: string;
  created_at: string;
  updated_at: string;
}

interface AdminPengaduanDashboardProps {
  userRole: string;
}

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
    }).format(date);
  } catch (e) {
    return dateString;
  }
};

const getMonthFromDate = (dateString: string) => {
  try {
    return new Date(dateString.replace(" ", "T")).getMonth() + 1;
  } catch (e) {
    return 0;
  }
};

const getYearFromDate = (dateString: string) => {
  try {
    return new Date(dateString.replace(" ", "T")).getFullYear();
  } catch (e) {
    return 0;
  }
};

const AdminPengaduanDashboard: React.FC<AdminPengaduanDashboardProps> = ({
  userRole,
}) => {
  const [data, setData] = useState<PengaduanData[]>([]);
  const [stats, setStats] = useState({
    total: 0,
    menunggu: 0,
    proses: 0,
    selesai: 0,
    ditolak: 0,
  });
  const [loading, setLoading] = useState(true);
  const [selectedItem, setSelectedItem] = useState<PengaduanData | null>(null);
  const [editModal, setEditModal] = useState(false);
  const [importModal, setImportModal] = useState(false);

  // Filter states
  const [filterMonth, setFilterMonth] = useState(0);
  const [filterYear, setFilterYear] = useState(0);
  const [filterStatus, setFilterStatus] = useState("all");
  const [filterKategori, setFilterKategori] = useState("all");

  // Table states
  const [search, setSearch] = useState("");
  const [sortConfig, setSortConfig] = useState<{
    key: string;
    direction: "asc" | "desc";
  } | null>(null);
  const [currentPage, setCurrentPage] = useState(1);
  const [rowsPerPage, setRowsPerPage] = useState(10);
  const [selectedIds, setSelectedIds] = useState<number[]>([]);

  // PDF Filter
  const [pdfMonth, setPdfMonth] = useState(() => new Date().getMonth() + 1);
  const [pdfYear, setPdfYear] = useState(() => new Date().getFullYear());
  const [pdfStatus, setPdfStatus] = useState("all");

  const monthOptions = [
    "Semua Bulan",
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
  ];

  const yearOptions = [0, 2024, 2025, 2026, 2027];
  const kategoriOptions = [
    "all",
    "Pelayanan",
    "Fasilitas",
    "Akademik",
    "Keuangan",
    "SDM",
    "Lainnya",
  ];

  useEffect(() => {
    fetchData();
  }, []);

  const fetchData = async () => {
    setLoading(true);
    try {
      const res = await fetch("/api/admin_pengaduan.php?action=list");
      const json = await res.json();
      if (json.status === "success") {
        setData(json.data);
        setStats(json.stats);
      }
    } catch (e) {
      console.error("Gagal fetch data pengaduan", e);
    }
    setLoading(false);
  };

  const filteredData = useMemo(() => {
    return data.filter((item) => {
      const matchMonth =
        filterMonth === 0 || getMonthFromDate(item.created_at) === filterMonth;
      const matchYear =
        filterYear === 0 || getYearFromDate(item.created_at) === filterYear;
      const matchStatus =
        filterStatus === "all" ||
        item.status.toLowerCase() === filterStatus.toLowerCase();
      const matchKategori =
        filterKategori === "all" || item.kategori === filterKategori;
      const matchSearch =
        !search ||
        item.nama.toLowerCase().includes(search.toLowerCase()) ||
        item.email.toLowerCase().includes(search.toLowerCase()) ||
        item.judul.toLowerCase().includes(search.toLowerCase()) ||
        item.isi_pengaduan.toLowerCase().includes(search.toLowerCase());

      return (
        matchMonth &&
        matchYear &&
        matchStatus &&
        matchKategori &&
        matchSearch
      );
    });
  }, [data, filterMonth, filterYear, filterStatus, filterKategori, search]);

  const sortedData = useMemo(() => {
    if (!sortConfig) return filteredData;
    return [...filteredData].sort((a, b) => {
      const aVal = a[sortConfig.key as keyof PengaduanData];
      const bVal = b[sortConfig.key as keyof PengaduanData];
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

  const handleSelectAll = (e: React.ChangeEvent<HTMLInputElement>) => {
    if (e.target.checked) {
      setSelectedIds(paginatedData.map((row) => row.id));
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

  const handleUpdate = async (id: number, status: string, tanggapan: string) => {
    try {
      const res = await fetch("/api/admin_pengaduan.php?action=update", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ id, status, tanggapan }),
      });
      const json = await res.json();
      if (json.status === "success") {
        fetchData();
        setEditModal(false);
        setSelectedItem(null);
        alert("Pengaduan berhasil diupdate!");
      } else {
        alert(json.message);
      }
    } catch (e) {
      alert("Gagal update pengaduan");
    }
  };

  const handleDelete = async (ids: number[]) => {
    if (!window.confirm(`Yakin hapus ${ids.length} pengaduan?`)) return;
    try {
      const res = await fetch("/api/admin_pengaduan.php?action=delete", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ ids }),
      });
      const json = await res.json();
      if (json.status === "success") {
        fetchData();
        setSelectedIds([]);
        alert(json.message);
      } else {
        alert(json.message);
      }
    } catch (e) {
      alert("Gagal menghapus pengaduan");
    }
  };

  const downloadExcel = () => {
    window.open("/api/admin_pengaduan.php?action=export", "_blank");
  };

  const printPDF = () => {
    window.open(
      `/api/print_pengaduan_pdf.php?month=${pdfMonth}&year=${pdfYear}&status=${pdfStatus}`,
      "_blank",
    );
  };

  if (loading) {
    return (
      <div className="text-center p-12">
        <FaSpinner className="animate-spin h-8 w-8 mx-auto mb-4 text-primary" />
        Memuat Data...
      </div>
    );
  }

  return (
    <div className="space-y-6">
      {/* Stats Cards */}
      <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
        <StatCard
          label="Total Pengaduan"
          value={stats.total}
          color="text-blue-600"
          bg="bg-blue-50 dark:bg-blue-900/20"
        />
        <StatCard
          label="Menunggu"
          value={stats.menunggu}
          color="text-yellow-600"
          bg="bg-yellow-50 dark:bg-yellow-900/20"
        />
        <StatCard
          label="Proses"
          value={stats.proses}
          color="text-orange-600"
          bg="bg-orange-50 dark:bg-orange-900/20"
        />
        <StatCard
          label="Selesai"
          value={stats.selesai}
          color="text-green-600"
          bg="bg-green-50 dark:bg-green-900/20"
        />
        <StatCard
          label="Ditolak"
          value={stats.ditolak || 0}
          color="text-red-600"
          bg="bg-red-50 dark:bg-red-900/20"
        />
      </div>

      {/* Main Table */}
      <div className="rounded-xl border border-border bg-white shadow-sm overflow-hidden dark:bg-darkmode-light dark:border-darkmode-border">
        {/* Header */}
        <div className="flex flex-col gap-4 p-5 md:flex-row md:items-center md:justify-between border-b border-border dark:border-darkmode-border bg-gray-50 dark:bg-white/5">
          <div className="flex items-center gap-3">
            <h3 className="text-lg font-bold">Data Pengaduan Masyarakat</h3>
            {userRole === "super_admin" && selectedIds.length > 0 && (
              <button
                onClick={() => handleDelete(selectedIds)}
                className="px-3 py-1 bg-red-100 text-red-600 hover:bg-red-200 rounded text-xs font-bold flex items-center gap-2"
              >
                <FaTrash /> Hapus ({selectedIds.length})
              </button>
            )}
          </div>

          <div className="flex flex-col md:flex-row gap-3 md:items-center">
            {/* Filters */}
            <div className="flex flex-wrap gap-2 items-center">
              <div className="flex items-center gap-2 border border-border rounded-lg px-2 py-1.5 bg-white dark:bg-darkmode-body dark:border-darkmode-border">
                <FaCalendarAlt className="text-gray-400" />
                <select
                  className="text-xs bg-transparent outline-none"
                  value={filterMonth}
                  onChange={(e) => setFilterMonth(Number(e.target.value))}
                >
                  {monthOptions.map((m, i) => (
                    <option key={i} value={i}>
                      {m}
                    </option>
                  ))}
                </select>
                <select
                  className="text-xs bg-transparent outline-none border-l border-gray-200 pl-2 ml-1"
                  value={filterYear}
                  onChange={(e) => setFilterYear(Number(e.target.value))}
                >
                  <option value={0}>Semua Tahun</option>
                  {yearOptions.slice(1).map((y) => (
                    <option key={y} value={y}>
                      {y}
                    </option>
                  ))}
                </select>
              </div>

              <div className="flex items-center gap-2 border border-border rounded-lg px-2 py-1.5 bg-white dark:bg-darkmode-body dark:border-darkmode-border">
                <FaFilter className="text-gray-400" />
                <select
                  className="text-xs bg-transparent outline-none"
                  value={filterStatus}
                  onChange={(e) => setFilterStatus(e.target.value)}
                >
                  <option value="all">Semua Status</option>
                  <option value="menunggu">Menunggu</option>
                  <option value="proses">Proses</option>
                  <option value="selesai">Selesai</option>
                  <option value="ditolak">Ditolak</option>
                </select>
              </div>

              <div className="flex items-center gap-2 border border-border rounded-lg px-2 py-1.5 bg-white dark:bg-darkmode-body dark:border-darkmode-border">
                <FaExclamationTriangle className="text-gray-400" />
                <select
                  className="text-xs bg-transparent outline-none"
                  value={filterKategori}
                  onChange={(e) => setFilterKategori(e.target.value)}
                >
                  {kategoriOptions.map((k) => (
                    <option key={k} value={k}>
                      {k === "all" ? "Semua Kategori" : k}
                    </option>
                  ))}
                </select>
              </div>
            </div>

            {/* Search */}
            <div className="relative">
              <FaSearch className="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" />
              <input
                type="text"
                placeholder="Cari pengaduan..."
                className="w-full rounded-lg border border-border py-2 pl-9 pr-4 text-sm focus:border-primary focus:outline-none dark:bg-darkmode-body dark:border-darkmode-border"
                onChange={(e) => {
                  setSearch(e.target.value);
                  setCurrentPage(1);
                }}
              />
            </div>

            {/* Actions */}
            <div className="flex gap-2">
              <button
                onClick={() => setImportModal(true)}
                className="btn btn-sm bg-orange-500 hover:bg-orange-600 text-white border-orange-500 flex items-center gap-2"
              >
                <FaFileUpload /> Import
              </button>

              <button
                onClick={downloadExcel}
                className="btn btn-sm bg-green-600 hover:bg-green-700 text-white border-green-600 flex items-center gap-2"
              >
                <FaDownload /> Excel
              </button>

              {/* PDF Filter & Print */}
              <div className="flex items-center gap-2 bg-gray-50 dark:bg-white/5 p-1.5 rounded-lg border border-border dark:border-darkmode-border">
                <select
                  value={pdfMonth}
                  onChange={(e) => setPdfMonth(Number(e.target.value))}
                  className="text-xs bg-transparent outline-none"
                >
                  {monthOptions.slice(1).map((m, i) => (
                    <option key={i} value={i + 1}>
                      {m}
                    </option>
                  ))}
                </select>
                <select
                  value={pdfYear}
                  onChange={(e) => setPdfYear(Number(e.target.value))}
                  className="text-xs bg-transparent outline-none"
                >
                  {yearOptions.slice(1).map((y) => (
                    <option key={y} value={y}>
                      {y}
                    </option>
                  ))}
                </select>
                <select
                  value={pdfStatus}
                  onChange={(e) => setPdfStatus(e.target.value)}
                  className="text-xs bg-transparent outline-none border-l border-gray-200 pl-2"
                >
                  <option value="all">Semua</option>
                  <option value="menunggu">Menunggu</option>
                  <option value="proses">Proses</option>
                  <option value="selesai">Selesai</option>
                </select>
              </div>

              <button
                onClick={printPDF}
                className="btn btn-sm btn-primary flex items-center gap-2"
              >
                <FaDownload /> PDF
              </button>
            </div>
          </div>
        </div>

        {/* Table */}
        <div className="overflow-x-auto">
          <table className="w-full text-left text-sm">
            <thead className="bg-gray-100 text-xs uppercase text-gray-500 dark:bg-black/20">
              <tr>
                {userRole === "super_admin" && (
                  <th className="px-4 py-3 w-10 text-center">
                    <input
                      type="checkbox"
                      className="rounded border-gray-300 text-primary focus:ring-primary h-4 w-4 cursor-pointer"
                      onChange={handleSelectAll}
                      checked={
                        paginatedData.length > 0 &&
                        paginatedData.every((row) => selectedIds.includes(row.id))
                      }
                    />
                  </th>
                )}
                <th className="px-6 py-3 w-10 text-center">#</th>
                <th
                  className="px-6 py-3 cursor-pointer hover:bg-gray-200 dark:hover:bg-white/10"
                  onClick={() => requestSort("created_at")}
                >
                  <div className="flex items-center gap-1">
                    Tanggal
                    {sortConfig?.key === "created_at" ? (
                      sortConfig.direction === "asc" ? (
                        <FaSortUp />
                      ) : (
                        <FaSortDown />
                      )
                    ) : (
                      <FaSort />
                    )}
                  </div>
                </th>
                <th className="px-6 py-3">Pengirim</th>
                <th className="px-6 py-3">Kategori</th>
                <th className="px-6 py-3">Judul</th>
                <th className="px-6 py-3 text-center">Status</th>
                <th className="px-6 py-3 text-center">Aksi</th>
              </tr>
            </thead>
            <tbody className="divide-y divide-border dark:divide-darkmode-border">
              {paginatedData.length > 0 ? (
                paginatedData.map((row, i) => (
                  <tr
                    key={row.id}
                    className={`transition-colors ${selectedIds.includes(row.id) ? "bg-blue-50 dark:bg-blue-900/20" : "hover:bg-gray-50 dark:hover:bg-white/5"}`}
                  >
                    {userRole === "super_admin" && (
                      <td className="px-4 py-4 text-center">
                        <input
                          type="checkbox"
                          className="rounded border-gray-300 text-primary focus:ring-primary h-4 w-4 cursor-pointer"
                          checked={selectedIds.includes(row.id)}
                          onChange={() => handleSelectRow(row.id)}
                        />
                      </td>
                    )}
                    <td className="px-6 py-4 text-center text-gray-400">
                      {(currentPage - 1) * rowsPerPage + i + 1}
                    </td>
                    <td className="px-6 py-4 text-xs text-gray-500">
                      {formatDateIndo(row.created_at)}
                    </td>
                    <td className="px-6 py-4">
                      <div className="font-bold">{row.nama}</div>
                      <div className="text-xs text-gray-500">{row.email}</div>
                    </td>
                    <td className="px-6 py-4">
                      <span className="px-2 py-1 bg-gray-100 text-gray-700 rounded text-xs">
                        {row.kategori}
                      </span>
                    </td>
                    <td className="px-6 py-4 max-w-xs truncate">
                      {row.judul}
                    </td>
                    <td className="px-6 py-4 text-center">
                      <span
                        className={`px-2 py-1 rounded text-xs font-bold ${
                          row.status === "Selesai"
                            ? "bg-green-100 text-green-700"
                            : row.status === "Proses"
                              ? "bg-orange-100 text-orange-700"
                              : row.status === "Ditolak"
                                ? "bg-red-100 text-red-700"
                                : "bg-yellow-100 text-yellow-700"
                        }`}
                      >
                        {row.status}
                      </span>
                    </td>
                    <td className="px-6 py-4 text-center">
                      <div className="flex justify-center gap-2">
                        <button
                          onClick={() => {
                            setSelectedItem(row);
                          }}
                          className="p-2 bg-blue-50 text-blue-600 rounded hover:bg-blue-100"
                          title="Lihat Detail"
                        >
                          <FaEye />
                        </button>
                        <button
                          onClick={() => {
                            setSelectedItem(row);
                            setEditModal(true);
                          }}
                          className="p-2 bg-yellow-50 text-yellow-600 rounded hover:bg-yellow-100"
                          title="Edit/Tanggapi"
                        >
                          <FaEdit />
                        </button>
                        {userRole === "super_admin" && (
                          <button
                            onClick={() => handleDelete([row.id])}
                            className="p-2 bg-red-50 text-red-600 rounded hover:bg-red-100"
                            title="Hapus"
                          >
                            <FaTrash />
                          </button>
                        )}
                      </div>
                    </td>
                  </tr>
                ))
              ) : (
                <tr>
                  <td
                    colSpan={userRole === "super_admin" ? 9 : 8}
                    className="px-6 py-10 text-center text-gray-500"
                  >
                    Tidak ada data ditemukan.
                  </td>
                </tr>
              )}
            </tbody>
          </table>
        </div>

        {/* Pagination */}
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
              <option value={10}>10</option>
              <option value={20}>20</option>
              <option value={50}>50</option>
              <option value={100}>100</option>
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
                onClick={() =>
                  setCurrentPage((p) => Math.min(totalPages, p + 1))
                }
                disabled={currentPage === totalPages || totalPages === 0}
                className="px-3 py-1 hover:bg-gray-100 disabled:opacity-50 dark:hover:bg-white/10"
              >
                <FaChevronRight className="text-xs" />
              </button>
            </div>
          </div>
        </div>
      </div>

      {/* Detail Modal */}
      {selectedItem && !editModal && (
        <DetailModal
          item={selectedItem}
          onClose={() => setSelectedItem(null)}
        />
      )}

      {/* Edit Modal */}
      {selectedItem && editModal && (
        <EditModal
          item={selectedItem}
          onClose={() => {
            setEditModal(false);
            setSelectedItem(null);
          }}
          onSave={handleUpdate}
        />
      )}

      {/* Import Modal */}
      {importModal && (
        <ImportModal
          onClose={() => setImportModal(false)}
          onSuccess={() => {
            fetchData();
            setImportModal(false);
          }}
        />
      )}
    </div>
  );
};

// Sub Components

const StatCard = ({ label, value, color, bg }: any) => (
  <div
    className={`flex flex-col justify-center rounded-xl border border-border p-4 shadow-sm transition-all hover:shadow-md dark:border-darkmode-border ${bg}`}
  >
    <p className={`text-2xl font-bold ${color}`}>{value}</p>
    <p className="text-sm text-gray-600 dark:text-gray-400">{label}</p>
  </div>
);

const DetailModal = ({ item, onClose }: any) => (
  <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm animate-fade-in">
    <div className="bg-white dark:bg-darkmode-body w-full max-w-2xl rounded-2xl shadow-2xl overflow-hidden border border-gray-100 dark:border-darkmode-border">
      <div className="flex items-center justify-between p-6 border-b border-gray-100 dark:border-darkmode-border bg-gray-50 dark:bg-white/5">
        <h3 className="text-lg font-bold">Detail Pengaduan</h3>
        <button
          onClick={onClose}
          className="text-gray-400 hover:text-red-500 p-2 rounded-full"
        >
          <FaTimes />
        </button>
      </div>
      <div className="p-6 space-y-4 max-h-[70vh] overflow-y-auto">
        <div className="grid grid-cols-2 gap-4">
          <div>
            <label className="text-xs text-gray-500 font-bold">Nama</label>
            <p className="font-medium">{item.nama}</p>
          </div>
          <div>
            <label className="text-xs text-gray-500 font-bold">Email</label>
            <p className="font-medium">{item.email}</p>
          </div>
          <div>
            <label className="text-xs text-gray-500 font-bold">Telepon</label>
            <p className="font-medium">{item.telepon || "-"}</p>
          </div>
          <div>
            <label className="text-xs text-gray-500 font-bold">Kategori</label>
            <p className="font-medium">{item.kategori}</p>
          </div>
        </div>

        <div>
          <label className="text-xs text-gray-500 font-bold">
            Judul Pengaduan
          </label>
          <p className="font-medium">{item.judul}</p>
        </div>

        <div>
          <label className="text-xs text-gray-500 font-bold">
            Isi Pengaduan
          </label>
          <div className="p-4 bg-gray-50 dark:bg-white/5 rounded-lg border border-gray-100 dark:border-darkmode-border mt-2">
            <p className="whitespace-pre-wrap">{item.isi_pengaduan}</p>
          </div>
        </div>

        <div className="grid grid-cols-2 gap-4">
          <div>
            <label className="text-xs text-gray-500 font-bold">Status</label>
            <p>
              <span
                className={`px-3 py-1 rounded text-sm font-bold inline-block mt-1 ${
                  item.status === "Selesai"
                    ? "bg-green-100 text-green-700"
                    : item.status === "Proses"
                      ? "bg-orange-100 text-orange-700"
                      : item.status === "Ditolak"
                        ? "bg-red-100 text-red-700"
                        : "bg-yellow-100 text-yellow-700"
                }`}
              >
                {item.status}
              </span>
            </p>
          </div>
          <div>
            <label className="text-xs text-gray-500 font-bold">
              Tanggal Masuk
            </label>
            <p className="text-sm">
              {formatDateIndo(item.created_at)}
            </p>
          </div>
        </div>

        {item.tanggapan && (
          <div>
            <label className="text-xs text-gray-500 font-bold">
              Tanggapan / Tindak Lanjut
            </label>
            <div className="p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-100 dark:border-blue-900/30 mt-2">
              <p className="whitespace-pre-wrap">{item.tanggapan}</p>
            </div>
          </div>
        )}
      </div>
      <div className="bg-gray-50 dark:bg-white/5 px-6 py-4 border-t border-gray-100 dark:border-darkmode-border flex justify-end">
        <button onClick={onClose} className="btn btn-primary">
          Tutup
        </button>
      </div>
    </div>
  </div>
);

const EditModal = ({ item, onClose, onSave }: any) => {
  const [status, setStatus] = useState(item.status);
  const [tanggapan, setTanggapan] = useState(item.tanggapan || "");

  return (
    <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm animate-fade-in">
      <div className="bg-white dark:bg-darkmode-body w-full max-w-2xl rounded-2xl shadow-2xl overflow-hidden border border-gray-100 dark:border-darkmode-border">
        <div className="flex items-center justify-between p-6 border-b border-gray-100 dark:border-darkmode-border bg-gray-50 dark:bg-white/5">
          <h3 className="text-lg font-bold">Edit & Tanggapi Pengaduan</h3>
          <button
            onClick={onClose}
            className="text-gray-400 hover:text-red-500 p-2 rounded-full"
          >
            <FaTimes />
          </button>
        </div>
        <div className="p-6 space-y-4">
          <div>
            <label className="text-sm font-bold mb-2 block">
              Judul Pengaduan
            </label>
            <p className="text-sm text-gray-600 dark:text-gray-400">
              {item.judul}
            </p>
          </div>

          <div>
            <label className="text-sm font-bold mb-2 block">Status</label>
            <select
              value={status}
              onChange={(e) => setStatus(e.target.value)}
              className="w-full border border-border rounded-lg p-2 bg-gray-50 dark:bg-white/10 dark:text-white"
            >
              <option value="Menunggu">Menunggu</option>
              <option value="Proses">Proses</option>
              <option value="Selesai">Selesai</option>
              <option value="Ditolak">Ditolak</option>
            </select>
          </div>

          <div>
            <label className="text-sm font-bold mb-2 block">
              Tanggapan / Tindak Lanjut
            </label>
            <textarea
              value={tanggapan}
              onChange={(e) => setTanggapan(e.target.value)}
              className="w-full border border-border rounded-lg p-3 bg-gray-50 dark:bg-white/10 dark:text-white"
              rows={6}
              placeholder="Berikan tanggapan atau keterangan tindak lanjut..."
            />
          </div>
        </div>
        <div className="bg-gray-50 dark:bg-white/5 px-6 py-4 border-t border-gray-100 dark:border-darkmode-border flex justify-end gap-2">
          <button onClick={onClose} className="btn btn-outline-primary">
            Batal
          </button>
          <button
            onClick={() => onSave(item.id, status, tanggapan)}
            className="btn btn-primary"
          >
            Simpan
          </button>
        </div>
      </div>
    </div>
  );
};

const ImportModal = ({ onClose, onSuccess }: any) => {
  const [file, setFile] = useState<File | null>(null);
  const [uploading, setUploading] = useState(false);
  const [progress, setProgress] = useState(0);
  const [result, setResult] = useState<{
    status: "idle" | "success" | "error";
    message: string;
  }>({ status: "idle", message: "" });

  const handleUpload = () => {
    if (!file) return;
    setUploading(true);
    setProgress(0);

    const formData = new FormData();
    formData.append("file", file);

    const xhr = new XMLHttpRequest();
    xhr.upload.addEventListener("progress", (e) => {
      if (e.lengthComputable) setProgress(Math.round((e.loaded / e.total) * 100));
    });

    xhr.addEventListener("load", () => {
      if (xhr.status >= 200 && xhr.status < 300) {
        try {
          const json = JSON.parse(xhr.responseText);
          if (json.status === "success") {
            setResult({ status: "success", message: json.message });
            setTimeout(() => onSuccess(), 2000);
          } else {
            setResult({ status: "error", message: json.message });
          }
        } catch (e) {
          setResult({ status: "error", message: "Format respon tidak valid" });
        }
      } else {
        setResult({
          status: "error",
          message: `Server error (${xhr.status})`,
        });
      }
      setUploading(false);
    });

    xhr.addEventListener("error", () => {
      setResult({ status: "error", message: "Terjadi kesalahan jaringan" });
      setUploading(false);
    });

    xhr.open("POST", "/api/import_pengaduan.php?action=import");
    xhr.send(formData);
  };

  return (
    <div className="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm animate-fade-in">
      <div className="bg-white dark:bg-darkmode-body w-full max-w-md rounded-xl shadow-2xl overflow-hidden border border-gray-100 dark:border-darkmode-border">
        {result.status === "idle" && (
          <div className="p-6">
            <div className="flex justify-between items-center mb-6">
              <h3 className="text-lg font-bold">Import Data Pengaduan</h3>
              <button onClick={onClose}>
                <FaTimes className="text-gray-400 hover:text-red-500" />
              </button>
            </div>

            <div className="mb-6">
              <label
                className="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center cursor-pointer hover:bg-gray-50 dark:hover:bg-white/5 transition-colors group block"
                htmlFor="csvFile"
              >
                <input
                  type="file"
                  id="csvFile"
                  accept=".csv"
                  className="hidden"
                  onChange={(e) =>
                    setFile(e.target.files ? e.target.files[0] : null)
                  }
                />
                {file ? (
                  <div className="text-green-600 font-medium">
                    <FaCheckCircle className="mx-auto mb-2 text-2xl" />
                    <span className="truncate max-w-[200px] block text-sm">
                      {file.name}
                    </span>
                  </div>
                ) : (
                  <div className="text-gray-500 group-hover:text-primary">
                    <FaFileUpload className="mx-auto mb-2 text-2xl" />
                    <p>Klik untuk pilih file CSV</p>
                  </div>
                )}
              </label>
              <div className="mt-2 text-right">
                <a
                  href="/api/import_pengaduan.php?action=template"
                  className="text-xs text-primary hover:underline"
                >
                  <FaDownload className="inline mr-1" /> Download Template CSV
                </a>
              </div>
            </div>

            <div className="flex justify-end gap-2">
              <button onClick={onClose} className="btn btn-outline-primary btn-sm">
                Batal
              </button>
              <button
                onClick={handleUpload}
                className="btn btn-primary btn-sm disabled:opacity-50"
                disabled={!file || uploading}
              >
                Mulai Import
              </button>
            </div>
          </div>
        )}

        {uploading && (
          <div className="p-8 text-center">
            <FaSpinner className="mx-auto text-4xl text-primary animate-spin mb-4" />
            <h3 className="text-lg font-bold mb-2">Mengupload Data...</h3>
            <div className="w-full bg-gray-200 rounded-full h-4 overflow-hidden">
              <div
                className="bg-primary h-4 transition-all"
                style={{ width: `${progress}%` }}
              />
            </div>
            <p className="text-xs mt-2">{progress}%</p>
          </div>
        )}

        {result.status === "success" && (
          <div className="p-8 text-center">
            <FaCheckCircle className="mx-auto text-5xl text-green-600 mb-4 animate-bounce" />
            <h3 className="text-xl font-bold text-green-700 mb-2">
              Import Berhasil!
            </h3>
            <p className="text-gray-600">{result.message}</p>
          </div>
        )}

        {result.status === "error" && (
          <div className="p-8 text-center">
            <FaTimesCircle className="mx-auto text-5xl text-red-600 mb-4" />
            <h3 className="text-xl font-bold text-red-700 mb-2">
              Import Gagal
            </h3>
            <p className="text-sm text-red-600 mb-6">{result.message}</p>
            <button
              onClick={() => setResult({ status: "idle", message: "" })}
              className="btn btn-primary"
            >
              Coba Lagi
            </button>
          </div>
        )}
      </div>
    </div>
  );
};

export default AdminPengaduanDashboard;