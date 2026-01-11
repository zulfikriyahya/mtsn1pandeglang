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

// 3. Helper Functions
function formatTgl($timestamp)
{
    $dt = new DateTime($timestamp);
    $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    return $dt->format('d') . ' ' . $bulan[(int)$dt->format('m')] . ' ' . $dt->format('Y') . ' ' . $dt->format('H:i');
}

// 4. Extend Class FPDF untuk Custom Header/Footer & Tabel Canggih
class PDF extends FPDF
{
    // Variable untuk lebar kolom tabel dinamis
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

    // Fungsi Header Halaman (Kop Surat)
    function Header()
    {
        // Logo (Pastikan path file benar relative terhadap file ini)
        $logoPath = __DIR__ . '/../../images/logo.png';
        if (file_exists($logoPath)) {
            // $this->Image($logoPath, 10, 6, 30); // Uncomment jika logo file fisik ada
        }

        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 5, 'KEMENTERIAN AGAMA REPUBLIK INDONESIA', 0, 1, 'C');
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(0, 8, 'MTs NEGERI 1 PANDEGLANG', 0, 1, 'C');
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 5, 'Jl. Raya Labuan Km. 5,7 Kadulisung, Pandeglang - Banten', 0, 1, 'C');
        $this->Cell(0, 5, 'Website: https://mtsn1pandeglang.sch.id | Email: adm@mtsn1pandeglang.sch.id', 0, 1, 'C');

        $this->SetLineWidth(0.5);
        $this->Line(10, 36, 200, 36);
        $this->Ln(10);
    }

    // Fungsi Footer Halaman
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Halaman ' . $this->PageNo() . '/{nb} - Dicetak pada: ' . date('d/m/Y H:i') . ' WIB', 0, 0, 'C');
    }

    // Fungsi Ajaib: MultiCell Table Row (Agar teks panjang bisa wrap rapi di tabel)
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
$pdf->AddPage();

// === BAGIAN 1: RINGKASAN DATA ===
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'LAPORAN STATISTIK & PELAYANAN DIGITAL', 0, 1, 'C');
$pdf->Ln(2);

// Ambil Data Statistik
$visits = $db->querySingle("SELECT value FROM global_stats WHERE key = 'site_visits'") ?: 0;
$posts = $db->querySingle("SELECT COUNT(*) FROM post_stats") ?: 0;
$feedback = $db->querySingle("SELECT COUNT(*) FROM feedback") ?: 0;
$survey = $db->querySingle("SELECT COUNT(*) FROM survey_responses") ?: 0;
$avg = $db->querySingle("SELECT AVG(rating) FROM feedback") ?: 0;

$pdf->SetFont('Arial', '', 10);
$pdf->SetFillColor(230, 230, 230);
$pdf->Cell(95, 8, 'Total Kunjungan Website', 1, 0, 'L', true);
$pdf->Cell(95, 8, number_format($visits) . ' Pengunjung', 1, 1, 'R');
$pdf->Cell(95, 8, 'Artikel Dibaca', 1, 0, 'L', true);
$pdf->Cell(95, 8, number_format($posts) . ' Kali', 1, 1, 'R');
$pdf->Cell(95, 8, 'Total Ulasan Masuk', 1, 0, 'L', true);
$pdf->Cell(95, 8, $feedback . ' Ulasan', 1, 1, 'R');
$pdf->Cell(95, 8, 'Rata-rata Rating', 1, 0, 'L', true);
$pdf->Cell(95, 8, number_format($avg, 1) . ' / 5.0', 1, 1, 'R');
$pdf->Ln(10);

// === BAGIAN 2: DATA SURVEI KEPUASAN (DETAIL) ===
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(0, 8, 'A. DATA SURVEI KEPUASAN MASYARAKAT', 0, 1, 'L');
$pdf->SetFont('Arial', 'B', 9);
$pdf->SetFillColor(0, 220, 130); // Warna Hijau MTs
$pdf->SetTextColor(255);

// Header Tabel Survei
$pdf->Cell(8, 8, 'No', 1, 0, 'C', true);
$pdf->Cell(35, 8, 'Tanggal', 1, 0, 'C', true);
$pdf->Cell(40, 8, 'Responden', 1, 0, 'L', true);
$pdf->Cell(15, 8, 'ZI', 1, 0, 'C', true);
$pdf->Cell(15, 8, 'Layanan', 1, 0, 'C', true);
$pdf->Cell(15, 8, 'Akademik', 1, 0, 'C', true);
$pdf->Cell(62, 8, 'Masukan / Saran', 1, 1, 'L', true);

$pdf->SetTextColor(0);
$pdf->SetFont('Arial', '', 8);
$pdf->SetWidths([8, 35, 40, 15, 15, 15, 62]);
$pdf->SetAligns(['C', 'C', 'L', 'C', 'C', 'C', 'L']);

$resSurv = $db->query("SELECT * FROM survey_responses ORDER BY created_at DESC LIMIT 50");
$no = 1;
while ($row = $resSurv->fetchArray(SQLITE3_ASSOC)) {
    $role = $row['respondent_role'] ? " (" . $row['respondent_role'] . ")" : "";
    $pdf->Row([
        $no++,
        formatTgl($row['created_at']),
        $row['respondent_name'] . "\n" . $row['respondent_role'],
        $row['score_zi'],
        $row['score_service'],
        $row['score_academic'],
        $row['feedback'] ?: '-'
    ]);
}
$pdf->Ln(10);

// === BAGIAN 3: ULASAN & RATING ===
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(0, 8, 'B. DATA ULASAN & KRITIK SARAN', 0, 1, 'L');
$pdf->SetFont('Arial', 'B', 9);
$pdf->SetFillColor(0, 220, 130);
$pdf->SetTextColor(255);

// Header Tabel Ulasan
$pdf->Cell(10, 8, 'No', 1, 0, 'C', true);
$pdf->Cell(35, 8, 'Tanggal', 1, 0, 'C', true);
$pdf->Cell(45, 8, 'Nama Pengirim', 1, 0, 'L', true);
$pdf->Cell(20, 8, 'Rating', 1, 0, 'C', true);
$pdf->Cell(80, 8, 'Isi Pesan', 1, 1, 'L', true);

$pdf->SetTextColor(0);
$pdf->SetFont('Arial', '', 8);
$pdf->SetWidths([10, 35, 45, 20, 80]);
$pdf->SetAligns(['C', 'C', 'L', 'C', 'L']);

$resFeed = $db->query("SELECT * FROM feedback ORDER BY created_at DESC LIMIT 50");
$no = 1;
while ($row = $resFeed->fetchArray(SQLITE3_ASSOC)) {
    $pdf->Row([
        $no++,
        formatTgl($row['created_at']),
        $row['name'] ?: 'Anonim',
        $row['rating'] . ' Bintang',
        $row['message'] ?: '-'
    ]);
}

// === TANDA TANGAN (Opsional) ===
$pdf->Ln(15);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(120);
$pdf->Cell(60, 5, 'Pandeglang, ' . date('d F Y'), 0, 1, 'C');
$pdf->Cell(120);
$pdf->Cell(60, 5, 'Mengetahui,', 0, 1, 'C');
$pdf->Cell(120);
$pdf->Cell(60, 5, 'Kepala Madrasah', 0, 1, 'C');
$pdf->Ln(20);
$pdf->Cell(120);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(60, 5, 'H. Eman Sulaiman, S.Ag., M.Pd.', 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(120);
$pdf->Cell(60, 5, 'NIP. 197006032000031002', 0, 1, 'C');

// Output PDF
$pdf->Output('I', 'Laporan_Kinerja_MTsN1Pandeglang.pdf');
