import React, { useState, useEffect } from "react";
import {
  FaChevronLeft,
  FaChevronRight,
  FaUser,
  FaBuilding,
  FaConciergeBell,
  FaGraduationCap,
  FaPaperPlane,
  FaChartBar,
} from "react-icons/fa";

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
      {
        id: "zi_9",
        text: "Petugas tidak melakukan praktik diskriminasi berdasarkan SARA, status sosial, atau faktor lainnya.",
      },
      {
        id: "zi_10",
        text: "Terdapat kode etik dan standar perilaku yang jelas dan diterapkan secara konsisten.",
      },
      {
        id: "zi_11",
        text: "Proses pengambilan keputusan pelayanan dilakukan secara objektif dan dapat dipertanggungjawabkan.",
      },
      {
        id: "zi_12",
        text: "Terdapat mekanisme whistleblowing system (pelaporan pelanggaran) yang aman dan terlindungi.",
      },
      {
        id: "zi_13",
        text: "Setiap petugas menggunakan identitas diri (name tag) yang jelas dan mudah terlihat.",
      },
      {
        id: "zi_14",
        text: "Tidak ada praktik percaloan atau perantara tidak resmi dalam pengurusan layanan.",
      },
      {
        id: "zi_15",
        text: "Terdapat papan pengumuman atau media informasi yang menampilkan standar pelayanan dan pengaduan.",
      },
      {
        id: "zi_16",
        text: "Instansi menerapkan sistem merit dalam pengelolaan SDM (promosi berdasarkan kinerja, bukan KKN).",
      },
      {
        id: "zi_17",
        text: "Terdapat aturan pemberian hadiah/rewards dan punishment yang jelas dan adil.",
      },
      {
        id: "zi_18",
        text: "Instansi melakukan sosialisasi dan edukasi anti-korupsi secara berkala kepada pegawai dan masyarakat.",
      },
      {
        id: "zi_19",
        text: "Terdapat laporan kinerja dan penggunaan anggaran yang dapat diakses publik secara berkala.",
      },
      {
        id: "zi_20",
        text: "Sistem monitoring dan evaluasi internal berjalan efektif untuk mencegah penyimpangan.",
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
      {
        id: "srv_11",
        text: "Loket pelayanan tertata rapi dan dilengkapi dengan teknologi pendukung yang memadai.",
      },
      {
        id: "srv_12",
        text: "Tersedia layanan konsultasi atau helpdesk untuk membantu masyarakat yang membutuhkan informasi.",
      },
      {
        id: "srv_13",
        text: "Petugas menggunakan bahasa yang mudah dipahami dan tidak menggunakan istilah teknis yang rumit.",
      },
      {
        id: "srv_14",
        text: "Terdapat display monitor atau papan informasi yang menampilkan nomor antrian dan status layanan.",
      },
      {
        id: "srv_15",
        text: "Ruang pelayanan memiliki pencahayaan dan sirkulasi udara (AC/ventilasi) yang baik.",
      },
      {
        id: "srv_16",
        text: "Tersedia fasilitas bagi penyandang disabilitas dan lansia (kursi roda, jalur khusus, dll).",
      },
      {
        id: "srv_17",
        text: "Area tunggu dilengkapi dengan tempat duduk yang cukup dan nyaman.",
      },
      {
        id: "srv_18",
        text: "Tersedia layanan pengaduan online atau hotline yang responsif.",
      },
      {
        id: "srv_19",
        text: "Petugas memberikan konfirmasi atau tanda bukti atas setiap transaksi layanan.",
      },
      {
        id: "srv_20",
        text: "Terdapat survei kepuasan pelanggan yang dilakukan secara berkala.",
      },
      {
        id: "srv_21",
        text: "Jam pelayanan sesuai dengan yang diinformasikan dan petugas hadir tepat waktu.",
      },
      {
        id: "srv_22",
        text: "Tersedia fasilitas wifi gratis dan charging station untuk kenyamanan pengunjung.",
      },
      {
        id: "srv_23",
        text: "Petugas memberikan penjelasan yang lengkap jika terdapat penolakan atau revisi dokumen.",
      },
      {
        id: "srv_24",
        text: "Terdapat sistem tracking atau monitoring status permohonan yang dapat diakses pemohon.",
      },
      {
        id: "srv_25",
        text: "Ruang pelayanan memiliki tata letak yang jelas dengan signage/penunjuk arah yang mudah dipahami.",
      },
      {
        id: "srv_26",
        text: "Tersedia area khusus untuk konsultasi privat atau penanganan kasus sensitif.",
      },
      {
        id: "srv_27",
        text: "Petugas melakukan verifikasi dokumen dengan teliti namun tidak mempersulit proses.",
      },
      {
        id: "srv_28",
        text: "Tersedia informasi biaya layanan yang transparan tanpa ada biaya tersembunyi.",
      },
      {
        id: "srv_29",
        text: "Sistem pembayaran mudah, modern (tunai, transfer, QRIS), dan dilengkapi dengan bukti pembayaran resmi.",
      },
      {
        id: "srv_30",
        text: "Terdapat inovasi layanan digital/online yang memudahkan masyarakat tanpa harus datang langsung.",
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
      {
        id: "acd_13",
        text: "Kurikulum yang diterapkan relevan dengan perkembangan zaman dan kebutuhan masa depan siswa.",
      },
      {
        id: "acd_14",
        text: "Guru menggunakan media pembelajaran yang kreatif dan inovatif (video, gamifikasi, dll).",
      },
      {
        id: "acd_15",
        text: "Terdapat program remedial dan pengayaan bagi siswa yang membutuhkan.",
      },
      {
        id: "acd_16",
        text: "Sekolah memberikan kesempatan siswa untuk aktif berpartisipasi dalam kegiatan lomba dan kompetisi.",
      },
      {
        id: "acd_17",
        text: "Perpustakaan sekolah memiliki koleksi buku yang lengkap, update, dan mudah diakses.",
      },
      {
        id: "acd_18",
        text: "Laboratorium (IPA, Komputer, Bahasa) memiliki peralatan yang memadai dan berfungsi dengan baik.",
      },
      {
        id: "acd_19",
        text: "Guru memberikan tugas dan pekerjaan rumah yang proporsional dan bermakna.",
      },
      {
        id: "acd_20",
        text: "Sekolah menyediakan bimbingan konseling yang efektif untuk mendukung perkembangan siswa.",
      },
      {
        id: "acd_21",
        text: "Terdapat program pengembangan bakat dan minat siswa di luar akademik.",
      },
      {
        id: "acd_22",
        text: "Guru memberikan umpan balik (feedback) yang konstruktif terhadap hasil kerja siswa.",
      },
      {
        id: "acd_23",
        text: "Sekolah menerapkan pembelajaran berbasis proyek dan pemecahan masalah (HOTS).",
      },
      {
        id: "acd_24",
        text: "Terdapat kerjasama dengan pihak eksternal (universitas, industri) untuk memperkaya pembelajaran.",
      },
      {
        id: "acd_25",
        text: "Guru aktif mengikuti pelatihan dan pengembangan profesional untuk meningkatkan kompetensi.",
      },
      {
        id: "acd_26",
        text: "Sistem penjadwalan pelajaran teratur dan tidak sering terjadi pergantian jadwal mendadak.",
      },
      {
        id: "acd_27",
        text: "Sekolah memiliki program literasi dan numerasi yang kuat dan berkelanjutan.",
      },
      {
        id: "acd_28",
        text: "Terdapat sistem pembelajaran daring/hybrid yang efektif sebagai alternatif atau pendukung.",
      },
      {
        id: "acd_29",
        text: "Guru mendorong siswa untuk berpikir kritis, kreatif, dan mandiri.",
      },
      {
        id: "acd_30",
        text: "Sekolah menyediakan ruang kelas yang nyaman dengan fasilitas yang mendukung (proyektor, AC, papan tulis interaktif).",
      },
      {
        id: "acd_31",
        text: "Terdapat kegiatan studi lapangan atau kunjungan edukatif yang memperkaya wawasan siswa.",
      },
      {
        id: "acd_32",
        text: "Guru menerapkan pembelajaran diferensiasi sesuai dengan kebutuhan dan gaya belajar siswa.",
      },
      {
        id: "acd_33",
        text: "Sekolah memiliki standar kelulusan dan kompetensi yang jelas dan terukur.",
      },
      {
        id: "acd_34",
        text: "Terdapat program pendampingan untuk siswa berprestasi dan siswa yang membutuhkan perhatian khusus.",
      },
      {
        id: "acd_35",
        text: "Guru menghargai pendapat dan kreativitas siswa dalam proses pembelajaran.",
      },
      {
        id: "acd_36",
        text: "Sekolah melakukan parent-teacher conference secara rutin untuk membahas perkembangan siswa.",
      },
      {
        id: "acd_37",
        text: "Terdapat sistem raport digital yang memudahkan akses informasi perkembangan siswa.",
      },
      {
        id: "acd_38",
        text: "Sekolah menyediakan fasilitas olahraga dan seni yang memadai untuk pengembangan non-akademik.",
      },
      {
        id: "acd_39",
        text: "Guru memberikan motivasi dan inspirasi kepada siswa untuk meraih cita-cita mereka.",
      },
      {
        id: "acd_40",
        text: "Sekolah memiliki program persiapan ujian nasional/asesmen yang terstruktur dan efektif.",
      },
    ],
  },
  {
    id: "facilities",
    title: "Sarana & Prasarana",
    icon: <FaBuilding />,
    description:
      "Kondisi fisik bangunan, kebersihan, keamanan, dan fasilitas penunjang sekolah.",
    questions: [
      {
        id: "fac_1",
        text: "Kondisi gedung sekolah terawat dengan baik dan aman untuk kegiatan pembelajaran.",
      },
      {
        id: "fac_2",
        text: "Kebersihan lingkungan sekolah terjaga (kelas, toilet, halaman, kantin).",
      },
      {
        id: "fac_3",
        text: "Toilet siswa bersih, jumlahnya memadai, dan berfungsi dengan baik.",
      },
      {
        id: "fac_4",
        text: "Sistem keamanan sekolah baik (satpam, CCTV, pagar, akses keluar-masuk terkontrol).",
      },
      {
        id: "fac_5",
        text: "Kantin sekolah bersih, sehat, dan menyediakan makanan bergizi dengan harga terjangkau.",
      },
      {
        id: "fac_6",
        text: "Lapangan olahraga dan area bermain tersedia dan dalam kondisi baik.",
      },
      {
        id: "fac_7",
        text: "Fasilitas UKS (Unit Kesehatan Sekolah) lengkap dan dikelola dengan baik.",
      },
      {
        id: "fac_8",
        text: "Mushola atau tempat ibadah tersedia, bersih, dan nyaman digunakan.",
      },
      {
        id: "fac_9",
        text: "Area parkir kendaraan siswa dan tamu tertata rapi dan aman.",
      },
      {
        id: "fac_10",
        text: "Sistem penerangan (listrik) di seluruh area sekolah berfungsi dengan baik.",
      },
      {
        id: "fac_11",
        text: "Sistem sanitasi dan pengelolaan sampah terorganisir dengan baik.",
      },
      {
        id: "fac_12",
        text: "Terdapat jalur evakuasi dan sistem penanggulangan bencana yang jelas.",
      },
      {
        id: "fac_13",
        text: "Fasilitas air bersih tersedia dan mudah diakses di berbagai titik sekolah.",
      },
      {
        id: "fac_14",
        text: "Ventilasi dan sirkulasi udara di ruang kelas baik dan mendukung kenyamanan belajar.",
      },
      {
        id: "fac_15",
        text: "Sekolah memiliki area hijau atau taman yang membuat lingkungan sejuk dan asri.",
      },
      {
        id: "fac_16",
        text: "Fasilitas untuk penyandang disabilitas tersedia (ramp, toilet khusus, dll).",
      },
      {
        id: "fac_17",
        text: "Aula atau ruang serbaguna tersedia untuk kegiatan besar sekolah.",
      },
      {
        id: "fac_18",
        text: "Sistem drainase dan penanganan air hujan berfungsi baik tanpa genangan.",
      },
      {
        id: "fac_19",
        text: "Papan informasi dan mading sekolah tertata rapi dan selalu diperbarui.",
      },
      {
        id: "fac_20",
        text: "Sekolah melakukan perawatan dan perbaikan fasilitas secara rutin dan responsif.",
      },
    ],
  },
  {
    id: "management",
    title: "Manajemen & Kepemimpinan",
    icon: <FaUser />,
    description:
      "Tata kelola sekolah, kepemimpinan kepala sekolah, dan sistem administrasi.",
    questions: [
      {
        id: "mgt_1",
        text: "Kepala sekolah menunjukkan kepemimpinan yang visioner dan inspiratif.",
      },
      {
        id: "mgt_2",
        text: "Visi dan misi sekolah jelas, dipahami oleh warga sekolah, dan diimplementasikan dengan baik.",
      },
      {
        id: "mgt_3",
        text: "Kepala sekolah terbuka menerima masukan dan kritik dari warga sekolah dan orang tua.",
      },
      {
        id: "mgt_4",
        text: "Sistem administrasi sekolah (absensi, nilai, keuangan) tertib dan transparan.",
      },
      {
        id: "mgt_5",
        text: "Proses penerimaan siswa baru dilakukan secara objektif dan transparan.",
      },
      {
        id: "mgt_6",
        text: "Informasi kebijakan sekolah disampaikan dengan jelas kepada orang tua dan siswa.",
      },
      {
        id: "mgt_7",
        text: "Sekolah memiliki program kerja tahunan yang terstruktur dan terlaksana dengan baik.",
      },
      {
        id: "mgt_8",
        text: "Terdapat komite sekolah yang aktif dan melibatkan peran orang tua secara optimal.",
      },
      {
        id: "mgt_9",
        text: "Pengelolaan keuangan sekolah akuntabel dan dilaporkan secara berkala.",
      },
      {
        id: "mgt_10",
        text: "Sekolah responsif dalam menangani keluhan atau masalah yang disampaikan orang tua.",
      },
      {
        id: "mgt_11",
        text: "Terdapat sistem reward and punishment yang adil untuk siswa dan guru.",
      },
      {
        id: "mgt_12",
        text: "Kepala sekolah aktif melakukan supervisi dan monitoring kualitas pembelajaran.",
      },
      {
        id: "mgt_13",
        text: "Sekolah memiliki SOP (Standar Operasional Prosedur) yang jelas untuk berbagai kegiatan.",
      },
      {
        id: "mgt_14",
        text: "Terdapat rapat koordinasi rutin antara guru, staf, dan pimpinan sekolah.",
      },
      {
        id: "mgt_15",
        text: "Sekolah melakukan evaluasi diri secara berkala untuk perbaikan berkelanjutan.",
      },
      {
        id: "mgt_16",
        text: "Sistem dokumentasi dan arsip sekolah tertata rapi dan mudah diakses saat dibutuhkan.",
      },
      {
        id: "mgt_17",
        text: "Terdapat program pengembangan SDM guru dan tenaga kependidikan yang terencana.",
      },
      {
        id: "mgt_18",
        text: "Sekolah memiliki kerjasama dengan stakeholder eksternal (pemda, dinas, komunitas).",
      },
      {
        id: "mgt_19",
        text: "Kepala sekolah memberikan contoh teladan dalam disiplin, integritas, dan etos kerja.",
      },
      {
        id: "mgt_20",
        text: "Sekolah inovatif dalam menghadapi tantangan dan beradaptasi dengan perubahan.",
      },
    ],
  },
  {
    id: "culture",
    title: "Budaya & Iklim Sekolah",
    icon: <FaUser />,
    description:
      "Suasana sekolah, hubungan antarwarga sekolah, dan nilai-nilai yang diterapkan.",
    questions: [
      {
        id: "cul_1",
        text: "Hubungan antara siswa, guru, dan staf terjalin harmonis dan saling menghargai.",
      },
      {
        id: "cul_2",
        text: "Sekolah menciptakan lingkungan yang inklusif dan ramah terhadap keberagaman.",
      },
      {
        id: "cul_3",
        text: "Tidak ada praktik bullying atau kekerasan di lingkungan sekolah.",
      },
      {
        id: "cul_4",
        text: "Sekolah menerapkan nilai-nilai religius dan moral dalam kehidupan sehari-hari.",
      },
      {
        id: "cul_5",
        text: "Budaya disiplin (tepat waktu, tertib, bertanggung jawab) diterapkan dengan konsisten.",
      },
      {
        id: "cul_6",
        text: "Siswa diajarkan untuk menghormati guru, orang tua, dan sesama.",
      },
      {
        id: "cul_7",
        text: "Sekolah mendorong budaya prestasi dan kompetisi yang sehat.",
      },
      {
        id: "cul_8",
        text: "Terdapat program pembinaan karakter yang terintegrasi dalam kehidupan sekolah.",
      },
      {
        id: "cul_9",
        text: "Sekolah memiliki tradisi atau kegiatan khas yang mempererat kebersamaan warga sekolah.",
      },
      {
        id: "cul_10",
        text: "Lingkungan sekolah mendukung kreativitas dan inovasi siswa.",
      },
      {
        id: "cul_11",
        text: "Terdapat budaya gotong royong dan kepedulian sosial di kalangan warga sekolah.",
      },
      {
        id: "cul_12",
        text: "Sekolah aktif mengkampanyekan gaya hidup sehat dan peduli lingkungan.",
      },
      {
        id: "cul_13",
        text: "Guru dan staf menjadi role model yang baik dalam perilaku dan tutur kata.",
      },
      {
        id: "cul_14",
        text: "Sekolah memberikan apresiasi kepada siswa yang berprestasi akademik dan non-akademik.",
      },
      {
        id: "cul_15",
        text: "Terdapat kegiatan spiritual atau keagamaan yang rutin dilaksanakan.",
      },
      {
        id: "cul_16",
        text: "Sekolah mengajarkan siswa untuk bertanggung jawab terhadap tugas dan kewajiban mereka.",
      },
      {
        id: "cul_17",
        text: "Komunikasi antarwarga sekolah berlangsung terbuka, jujur, dan konstruktif.",
      },
      {
        id: "cul_18",
        text: "Sekolah memiliki aturan dan tata tertib yang jelas, adil, dan ditegakkan secara konsisten.",
      },
      {
        id: "cul_19",
        text: "Terdapat kegiatan parenting atau sekolah orang tua untuk membangun kolaborasi keluarga-sekolah.",
      },
      {
        id: "cul_20",
        text: "Siswa merasa aman, nyaman, dan bahagia berada di lingkungan sekolah.",
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

  // State stats dinamis
  const [stats, setStats] = useState<any>({ total: 0 });

  const totalSteps = surveyData.length + 2;

  useEffect(() => {
    const fetchSurveyData = async () => {
      try {
        const res = await fetch("/api/survey.php");
        const data = await res.json();
        if (data.stats) setStats(data.stats);
        if (data.has_submitted) setStatus("submitted");
        else setStatus("idle");
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
        setStatus("submitted");
      } else {
        setStatus("error");
      }
    } catch (e) {
      setStatus("error");
    }
  };

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

  if (status === "submitted" || status === "success") {
    const colors = [
      "bg-blue-500",
      "bg-green-500",
      "bg-purple-500",
      "bg-orange-500",
      "bg-pink-500",
      "bg-teal-500",
    ];

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

        <div className="space-y-6">
          {surveyData.map((section, idx) => {
            const score = stats[section.id] || 0;
            return (
              <div key={section.id}>
                <div className="flex justify-between items-end mb-2">
                  <h4 className="text-lg flex items-center gap-2">
                    <span className="text-primary">{section.icon}</span>{" "}
                    {section.title}
                  </h4>
                  <span className="font-bold text-2xl text-primary">
                    {score}
                    <span className="text-sm text-gray-400 font-normal">
                      /5
                    </span>
                  </span>
                </div>
                <div className="h-4 w-full bg-gray-200 rounded-full overflow-hidden dark:bg-gray-700">
                  <div
                    className={`h-full ${colors[idx % colors.length]} transition-all duration-1000`}
                    style={{ width: `${(score / 5) * 100}%` }}
                  ></div>
                </div>
              </div>
            );
          })}
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

  return (
    <div className="max-w-3xl mx-auto">
      <div className="mb-8">
        <div className="flex justify-between mb-2 text-xs font-semibold uppercase text-text-light dark:text-darkmode-text-light tracking-wide">
          <span>Data Diri</span>
          <span className="hidden sm:inline">Pertanyaan</span>
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

        <div className="p-8">
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
                        className={`w-10 h-10 sm:w-12 sm:h-12 rounded-full font-bold text-sm sm:text-base transition-all ${answers[q.id] === val ? "bg-primary text-white scale-110 shadow-lg shadow-primary/40" : "bg-white dark:bg-darkmode-body border border-border dark:border-darkmode-border text-text-light hover:border-primary hover:text-primary"}`}
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

          {status === "error" && (
            <div className="mt-4 p-3 bg-red-100 text-red-700 rounded text-sm text-center">
              Terjadi kesalahan.
            </div>
          )}
        </div>

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
