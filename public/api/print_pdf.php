<?php
session_start();
date_default_timezone_set('Asia/Jakarta');

// 1. Proteksi Akses
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    die("Akses Ditolak: Harap login terlebih dahulu.");
}

// 2. Load Library & Database
require('lib/fpdf.php');
$dbPath = __DIR__ . '/../../stats.db';
$db = new SQLite3($dbPath);

// 3. Helper Functions (Format Tanggal Indonesia)
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
        // Path Gambar
        $path = __DIR__ . '/../../images/instansi/';

        // Logo Kiri (MTs) - X=10, Y=10, Width=22
        if (file_exists($path . 'logo-instansi.png')) {
            $this->Image($path . 'logo-instansi.png', 10, 10, 22);
        }

        // Logo Kanan (Kemenag) - X=178 (A4 Width 210 - Margin 10 - Width 22), Y=10
        if (file_exists($path . 'logo-institusi.png')) {
            $this->Image($path . 'logo-institusi.png', 178, 10, 22);
        }

        // Teks Kop
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 5, 'KEMENTERIAN AGAMA REPUBLIK INDONESIA', 0, 1, 'C');

        $this->SetFont('Arial', 'B', 13);
        $this->Cell(0, 6, 'KANTOR KEMENTERIAN AGAMA KABUPATEN PANDEGLANG', 0, 1, 'C');

        $this->SetFont('Arial', 'B', 16);
        $this->Cell(0, 7, 'MTs NEGERI 1 PANDEGLANG', 0, 1, 'C');

        $this->SetFont('Arial', '', 9);
        $this->Cell(0, 4, 'Jl. Raya Labuan Km. 5,7 Kadulisung, Pandeglang - Banten 42251', 0, 1, 'C');
        $this->Cell(0, 4, 'Website: https://mtsn1pandeglang.sch.id | Email: adm@mtsn1pandeglang.sch.id', 0, 1, 'C');

        // Garis Pembatas (Double Line)
        $this->SetLineWidth(0.5);
        $this->Line(10, 40, 200, 40);
        $this->SetLineWidth(0.2);
        $this->Line(10, 41, 200, 41);
        $this->Ln(8);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Halaman ' . $this->PageNo() . '/{nb} - Dokumen ini dicetak secara digital pada ' . formatFullTime('now'), 0, 0, 'C');
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

// === KONTEN LAPORAN ===
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 8, 'LAPORAN REKAPITULASI PELAYANAN DIGITAL', 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 5, 'Periode: S.d. ' . getIndonesianDate(), 0, 1, 'C');
$pdf->Ln(5);

// Ambil Data Statistik Ringkas
$visits = $db->querySingle("SELECT value FROM global_stats WHERE key = 'site_visits'") ?: 0;
$posts = $db->querySingle("SELECT COUNT(*) FROM post_stats") ?: 0;
$feedback = $db->querySingle("SELECT COUNT(*) FROM feedback") ?: 0;
$survey = $db->querySingle("SELECT COUNT(*) FROM survey_responses") ?: 0;

// Tabel Ringkasan
$pdf->SetFont('Arial', '', 10);
$pdf->SetFillColor(240, 240, 240);
$pdf->Cell(95, 8, 'Total Kunjungan Portal', 1, 0, 'L', true);
$pdf->Cell(95, 8, number_format($visits) . ' Pengunjung', 1, 1, 'R');
$pdf->Cell(95, 8, 'Total Responden Survei IKM', 1, 0, 'L', true);
$pdf->Cell(95, 8, $survey . ' Responden', 1, 1, 'R');
$pdf->Cell(95, 8, 'Total Ulasan & Kritik Masuk', 1, 0, 'L', true);
$pdf->Cell(95, 8, $feedback . ' Ulasan', 1, 1, 'R');
$pdf->Ln(8);

// === TABEL DATA (Contoh: Data Survei Terbaru) ===
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 8, 'A. SAMPEL DATA SURVEI KEPUASAN (50 Terbaru)', 0, 1, 'L');
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetFillColor(0, 150, 100);
$pdf->SetTextColor(255);

// Header Table
$pdf->Cell(8, 8, 'No', 1, 0, 'C', true);
$pdf->Cell(35, 8, 'Tanggal', 1, 0, 'C', true);
$pdf->Cell(40, 8, 'Responden', 1, 0, 'L', true);
$pdf->Cell(15, 8, 'ZI', 1, 0, 'C', true);
$pdf->Cell(15, 8, 'LYN', 1, 0, 'C', true);
$pdf->Cell(15, 8, 'AKD', 1, 0, 'C', true);
$pdf->Cell(62, 8, 'Masukan', 1, 1, 'L', true);

$pdf->SetTextColor(0);
$pdf->SetFont('Arial', '', 8);
$pdf->SetWidths([8, 35, 40, 15, 15, 15, 62]);
$pdf->SetAligns(['C', 'C', 'L', 'C', 'C', 'C', 'L']);

$resSurv = $db->query("SELECT * FROM survey_responses ORDER BY created_at DESC LIMIT 50");
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

// === AREA TANDA TANGAN (SIGNATURE SECTION) ===
$pdf->AddPage(); // Pindah halaman untuk tanda tangan agar rapi
$pdf->Ln(10);

$path = __DIR__ . '/../../images/instansi/';
$tglCetak = getIndonesianDate();

// Posisi Y awal tanda tangan
$yStart = $pdf->GetY();

// --- BARIS 1: PUSDATIN (Kiri) & KEPALA TU (Kanan) ---

// 1. Titimangsa (Hanya di kanan)
$pdf->SetXY(120, $yStart);
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(70, 5, 'Pandeglang, ' . $tglCetak, 0, 1, 'C');

$pdf->Ln(2); // Spasi dikit

// 2. Jabatan
$yJabatan = $pdf->GetY();
// Kiri
$pdf->SetXY(20, $yJabatan);
$pdf->Cell(70, 5, 'Koordinator Tim Pusdatin,', 0, 0, 'C');
// Kanan
$pdf->SetXY(120, $yJabatan);
$pdf->Cell(70, 5, 'Kepala Tata Usaha,', 0, 1, 'C');

// 3. Gambar TTE (QR/Tanda Tangan)
$yImage = $pdf->GetY() + 2;
// Image Pusdatin (Kiri)
if (file_exists($path . 'tte-koordinator-tim-pusdatin.png')) {
    $pdf->Image($path . 'tte-koordinator-tim-pusdatin.png', 40, $yImage, 30); // X, Y, Width
}
// Image KTU (Kanan)
if (file_exists($path . 'tte-kepala-tata-usaha.png')) {
    $pdf->Image($path . 'tte-kepala-tata-usaha.png', 140, $yImage, 30);
}

// Space untuk tanda tangan (jika gambar tidak ada, space tetap ada)
$pdf->Ln(35);

// 4. Nama Pejabat
$pdf->SetFont('Arial', 'B', 11);
// Kiri
$pdf->SetX(20);
$pdf->Cell(70, 5, 'YAHYA ZULFIKRI, S.Kom.', 0, 0, 'C'); // Sesuaikan Nama
// Kanan
$pdf->SetX(120);
$pdf->Cell(70, 5, 'UMAR MU\'TAMAR, S.Ag.', 0, 1, 'C'); // Sesuaikan Nama

// 5. NIP
$pdf->SetFont('Arial', '', 10);
// Kiri
$pdf->SetX(20);
$pdf->Cell(70, 5, 'NIP. -', 0, 0, 'C'); // Sesuaikan NIP
// Kanan
$pdf->SetX(120);
$pdf->Cell(70, 5, 'NIP. 197501012000031001', 0, 1, 'C'); // Sesuaikan NIP

// --- BARIS 2: KEPALA MADRASAH (Tengah Bawah) ---
$pdf->Ln(15);

$pdf->SetFont('Arial', '', 11);
$pdf->Cell(0, 5, 'Mengetahui,', 0, 1, 'C');
$pdf->Cell(0, 5, 'Kepala Madrasah,', 0, 1, 'C');

// Image Kamad (Tengah)
$yImageKamad = $pdf->GetY() + 2;
if (file_exists($path . 'tte-kepala-madrasah.png')) {
    // Center image logic: (PageWidth - ImageWidth) / 2
    $xCenter = (210 - 30) / 2;
    $pdf->Image($path . 'tte-kepala-madrasah.png', $xCenter, $yImageKamad, 30);
}

$pdf->Ln(35);

$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(0, 5, 'H. EMAN SULAIMAN, S.Ag., M.Pd.', 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 5, 'NIP. 197006032000031002', 0, 1, 'C');

// Output
$pdf->Output('I', 'Laporan_Kinerja_MTsN1Pandeglang_' . date('Ymd') . '.pdf');
