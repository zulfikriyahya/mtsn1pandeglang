<?php
session_start();
date_default_timezone_set('Asia/Jakarta');

// 1. Proteksi Akses
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    die("Akses Ditolak: Harap login terlebih dahulu.");
}

// 2. Load Library
require('lib/fpdf.php');
$dbPath = __DIR__ . '/../../stats.db';
$db = new SQLite3($dbPath);

// 3. Helper Functions
function getIndonesianDate($timestamp = null)
{
    $dt = new DateTime($timestamp ?? 'now');
    $bulan = [
        1 => 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    ];
    return $dt->format('d') . ' ' . $bulan[(int)$dt->format('m')] . ' ' . $dt->format('Y');
}

function formatFullTime($timestamp)
{
    return getIndonesianDate($timestamp) . ' ' . date('H:i', strtotime($timestamp)) . ' WIB';
}

// 4. Extend Class FPDF
class PDF extends FPDF
{
    var $widths;
    var $aligns;

    function SetWidths($w)
    {
        $this->widths = $w;
    }
    function SetAligns($a)
    {
        $this->aligns = $a;
    }

    // --- KOP SURAT RESMI ---
    function Header()
    {
        // Path Gambar Absolut
        $path = __DIR__ . '../../../images/instansi/';

        // 1. LOGO KIRI (Kemenag / Institusi) - Hirarki lebih tinggi di kiri
        if (file_exists($path . 'logo-institusi.png')) {
            $this->Image($path . 'logo-institusi.png', 10, 10, 23);
        }

        // 2. LOGO KANAN (MTs / Instansi)
        if (file_exists($path . 'logo-instansi.png')) {
            $this->Image($path . 'logo-instansi.png', 177, 10, 23);
        }

        // Teks Kop
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 5, 'KEMENTERIAN AGAMA REPUBLIK INDONESIA', 0, 1, 'C');

        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 6, 'KANTOR KEMENTERIAN AGAMA KABUPATEN PANDEGLANG', 0, 1, 'C');

        $this->SetFont('Arial', 'B', 16);
        $this->Cell(0, 7, 'MADRASAH TSANAWIYAH NEGERI 1 PANDEGLANG', 0, 1, 'C');

        $this->SetFont('Arial', '', 9);
        $this->Cell(0, 4, 'Jl. Raya Labuan Km. 5,7 Kadulisung, Pandeglang - Banten 42251', 0, 1, 'C');
        $this->Cell(0, 4, 'Website: https://mtsn1pandeglang.sch.id | Email: adm@mtsn1pandeglang.sch.id', 0, 1, 'C');

        // Garis Pembatas
        $this->SetLineWidth(0.5);
        $this->Line(10, 42, 200, 42);
        $this->SetLineWidth(0.2);
        $this->Line(10, 43, 200, 43);
        $this->Ln(10);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Halaman ' . $this->PageNo() . '/{nb} - Dicetak via Sistem Informasi Digital MTsN 1 Pandeglang', 0, 0, 'C');
    }

    function Row($data, $fill = false)
    {
        $nb = 0;
        for ($i = 0; $i < count($data); $i++)
            $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        $h = 5 * $nb;
        $this->CheckPageBreak($h);

        for ($i = 0; $i < count($data); $i++) {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            $x = $this->GetX();
            $y = $this->GetY();
            $this->Rect($x, $y, $w, $h, $fill ? 'DF' : 'D');
            $this->MultiCell($w, 5, $data[$i], 0, $a);
            $this->SetXY($x + $w, $y);
        }
        $this->Ln($h);
    }

    function CheckPageBreak($h)
    {
        if ($this->GetY() + $h > $this->PageBreakTrigger)
            $this->AddPage($this->CurOrientation);
    }

    function NbLines($w, $txt)
    {
        $cw = &$this->CurrentFont['cw'];
        if ($w == 0) $w = $this->w - $this->rMargin - $this->x;
        $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
        $s = str_replace("\r", '', $txt);
        $nb = strlen($s);
        if ($nb > 0 && $s[$nb - 1] == "\n") $nb--;
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $nl = 1;
        while ($i < $nb) {
            $c = $s[$i];
            if ($c == "\n") {
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
                continue;
            }
            if ($c == ' ') $sep = $i;
            $l += $cw[$c];
            if ($l > $wmax) {
                if ($sep == -1) {
                    if ($i == $j) $i++;
                } else $i = $sep + 1;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
            } else $i++;
        }
        return $nl;
    }
}

// 5. Inisialisasi PDF
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->SetMargins(10, 10, 10);
$pdf->AddPage();

// === JUDUL LAPORAN ===
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 8, 'LAPORAN REKAPITULASI PELAYANAN DIGITAL & SURVEI KEPUASAN', 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 5, 'Periode Data: s.d. ' . getIndonesianDate(), 0, 1, 'C');
$pdf->Ln(5);

// Ambil Statistik
$visits = $db->querySingle("SELECT value FROM global_stats WHERE key = 'site_visits'") ?: 0;
$posts = $db->querySingle("SELECT COUNT(*) FROM post_stats") ?: 0;
$feedback = $db->querySingle("SELECT COUNT(*) FROM feedback") ?: 0;
$survey = $db->querySingle("SELECT COUNT(*) FROM survey_responses") ?: 0;

// Tabel Statistik
$pdf->SetFont('Arial', '', 10);
$pdf->SetFillColor(245, 245, 245);
$pdf->Cell(95, 8, 'Total Kunjungan Website', 1, 0, 'L', true);
$pdf->Cell(95, 8, number_format($visits) . ' Pengunjung', 1, 1, 'R');
$pdf->Cell(95, 8, 'Total Responden Survei IKM', 1, 0, 'L', true);
$pdf->Cell(95, 8, $survey . ' Responden', 1, 1, 'R');
$pdf->Cell(95, 8, 'Total Ulasan & Kritik Masuk', 1, 0, 'L', true);
$pdf->Cell(95, 8, $feedback . ' Ulasan', 1, 1, 'R');
$pdf->Ln(8);

// === BAGIAN 1: DATA SURVEI KEPUASAN ===
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 8, 'A. DATA SURVEI KEPUASAN MASYARAKAT (LENGKAP)', 0, 1, 'L');
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetFillColor(0, 150, 100);
$pdf->SetTextColor(255);

// Header Table
$pdf->Cell(8, 8, 'No', 1, 0, 'C', true);
$pdf->Cell(35, 8, 'Waktu', 1, 0, 'C', true);
$pdf->Cell(40, 8, 'Responden', 1, 0, 'L', true);
$pdf->Cell(15, 8, 'ZI', 1, 0, 'C', true);
$pdf->Cell(15, 8, 'LYN', 1, 0, 'C', true);
$pdf->Cell(15, 8, 'AKD', 1, 0, 'C', true);
$pdf->Cell(62, 8, 'Masukan', 1, 1, 'L', true);

$pdf->SetTextColor(0);
$pdf->SetFont('Arial', '', 8);
$pdf->SetWidths([8, 35, 40, 15, 15, 15, 62]);
$pdf->SetAligns(['C', 'C', 'L', 'C', 'C', 'C', 'L']);

// QUERY TANPA LIMIT
$resSurv = $db->query("SELECT * FROM survey_responses ORDER BY created_at DESC");
$no = 1;
while ($row = $resSurv->fetchArray(SQLITE3_ASSOC)) {
    $pdf->Row([
        $no++,
        formatFullTime($row['created_at']),
        $row['respondent_name'] . "\n(" . $row['respondent_role'] . ")",
        $row['score_zi'],
        $row['score_service'],
        $row['score_academic'],
        $row['feedback'] ?: '-'
    ]);
}
$pdf->Ln(5);

// === BAGIAN 2: DATA ULASAN PELAYANAN ===
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 8, 'B. DATA ULASAN & RATING PELAYANAN (LENGKAP)', 0, 1, 'L');
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetFillColor(255, 193, 7); // Warna Kuning/Emas
$pdf->SetTextColor(0);

$pdf->Cell(8, 8, 'No', 1, 0, 'C', true);
$pdf->Cell(35, 8, 'Waktu', 1, 0, 'C', true);
$pdf->Cell(45, 8, 'Nama', 1, 0, 'L', true);
$pdf->Cell(20, 8, 'Rating', 1, 0, 'C', true);
$pdf->Cell(82, 8, 'Pesan', 1, 1, 'L', true);

$pdf->SetFont('Arial', '', 8);
$pdf->SetWidths([8, 35, 45, 20, 82]);
$pdf->SetAligns(['C', 'C', 'L', 'C', 'L']);

// QUERY TANPA LIMIT
$resFeed = $db->query("SELECT * FROM feedback ORDER BY created_at DESC");
$no = 1;
while ($row = $resFeed->fetchArray(SQLITE3_ASSOC)) {
    $pdf->Row([
        $no++,
        formatFullTime($row['created_at']),
        $row['name'] ?: 'Anonim',
        $row['rating'] . ' / 5',
        $row['message'] ?: '-'
    ]);
}

// === AREA TANDA TANGAN (SIGNATURE SECTION) ===
$pdf->AddPage(); // Pindah halaman khusus tanda tangan agar rapi
$pdf->Ln(10);

$path = __DIR__ . '/../../images/instansi/';
$tglCetak = getIndonesianDate();

// Posisi Y awal tanda tangan
$yStart = $pdf->GetY();

// --- KANAN (PUSDATIN + Tanggal) ---
$pdf->SetXY(120, $yStart);
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(70, 5, 'Pandeglang, ' . $tglCetak, 0, 1, 'C');
$pdf->Ln(5);

$yJabatan = $pdf->GetY();

// --- KIRI (KEPALA TU) ---
$pdf->SetXY(20, $yJabatan);
$pdf->Cell(70, 5, 'Kepala Tata Usaha,', 0, 0, 'C');

// --- KANAN (PUSDATIN) ---
$pdf->SetXY(120, $yJabatan);
$pdf->Cell(70, 5, 'Koordinator Tim Pusdatin,', 0, 1, 'C');

// --- GAMBAR TTE (BARIS 1) ---
$yImage = $pdf->GetY() + 2;

// TTE KIRI (KTU)
if (file_exists($path . 'tte-kepala-tata-usaha.png')) {
    $pdf->Image($path . 'tte-kepala-tata-usaha.png', 40, $yImage, 30);
}

// TTE KANAN (Pusdatin)
if (file_exists($path . 'tte-koordinator-tim-pusdatin.png')) {
    $pdf->Image($path . 'tte-koordinator-tim-pusdatin.png', 140, $yImage, 30);
}

// Space tanda tangan
$pdf->Ln(35);

// --- NAMA & NIP (BARIS 1) ---
$pdf->SetFont('Arial', 'B', 11);

// KIRI (KTU)
$pdf->SetX(20);
$pdf->Cell(70, 5, "UMAR MU'TAMAR, S.Ag.", 0, 0, 'C');

// KANAN (Pusdatin)
$pdf->SetX(120);
$pdf->Cell(70, 5, 'YAHYA ZULFIKRI, S.Kom.', 0, 1, 'C');

// NIP
$pdf->SetFont('Arial', '', 10);
// KIRI (KTU)
$pdf->SetX(20);
$pdf->Cell(70, 5, 'NIP. 196903061998031004', 0, 0, 'C');

// KANAN (Pusdatin)
$pdf->SetX(120);
$pdf->Cell(70, 5, 'NIP. 200001142025211016', 0, 1, 'C');


// --- BARIS 2: KEPALA MADRASAH (Tengah Bawah) ---
$pdf->Ln(15);

$pdf->SetFont('Arial', '', 11);
$pdf->Cell(0, 5, 'Mengetahui,', 0, 1, 'C');
$pdf->Cell(0, 5, 'Kepala Madrasah,', 0, 1, 'C');

// Image Kamad (Tengah)
$yImageKamad = $pdf->GetY() + 2;
if (file_exists($path . 'tte-kepala-madrasah.png')) {
    // Tengah A4 (210mm) dikurang setengah lebar gambar (15mm) = 90
    $pdf->Image($path . 'tte-kepala-madrasah.png', 90, $yImageKamad, 30);
}

$pdf->Ln(35);

$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(0, 5, 'H. EMAN SULAIMAN, S.Ag., M.Pd.', 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 5, 'NIP. 197006032000031002', 0, 1, 'C');

// Output
$pdf->Output('I', 'Laporan_Pelayanan_MTsN1Pandeglang_' . date('Ymd_His') . '.pdf');
