<?php
session_start();
date_default_timezone_set('Asia/Jakarta');

// 1. Proteksi Akses
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    die("Akses Ditolak: Harap login terlebih dahulu.");
}

// 2. Ambil Parameter Filter
$month = isset($_GET['month']) ? (int)$_GET['month'] : (int)date('m');
$year = isset($_GET['year']) ? (int)$_GET['year'] : (int)date('Y');

// Validasi input sederhana
if ($month < 1 || $month > 12) $month = (int)date('m');
if ($year < 2020 || $year > 2030) $year = (int)date('Y');

// Nama Bulan Indo
$bulanIndo = [
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
$periodeText = $bulanIndo[$month] . ' ' . $year;

// 3. Load Library
require('lib/fpdf.php');
$dbPath = __DIR__ . '/../../stats.db';
$db = new SQLite3($dbPath);

// 4. Helper Functions
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

// 5. Extend Class FPDF
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
        $path = '../images/instansi/';
        $logoSize = 18;

        if (file_exists($path . 'logo-institusi.png')) {
            $this->Image($path . 'logo-institusi.png', 12, 10, $logoSize);
        }

        if (file_exists($path . 'logo-instansi.png')) {
            $this->Image($path . 'logo-instansi.png', 180, 10, $logoSize);
        }

        $this->SetY(11);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 5, 'KEMENTERIAN AGAMA REPUBLIK INDONESIA', 0, 1, 'C');

        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 6, 'KANTOR KEMENTERIAN AGAMA KABUPATEN PANDEGLANG', 0, 1, 'C');

        $this->SetFont('Arial', 'B', 16);
        $this->Cell(0, 7, 'MADRASAH TSANAWIYAH NEGERI 1 PANDEGLANG', 0, 1, 'C');

        $this->SetFont('Arial', '', 9);
        $this->Cell(0, 4, 'Jl. Raya Labuan Km. 5,7 Palurahan, Kec. Kaduhejo, Kab. Pandeglang - Banten 42253', 0, 1, 'C');
        $this->Cell(0, 4, 'Website: https://mtsn1pandeglang.sch.id | Email: adm@mtsn1pandeglang.sch.id', 0, 1, 'C');

        $this->SetLineWidth(0.5);
        $this->Line(10, 43, 200, 43);
        $this->SetLineWidth(0.2);
        $this->Line(10, 44, 200, 44);
        $this->Ln(12);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Halaman ' . $this->PageNo() . '/{nb} - Sistem Informasi Digital MTsN 1 Pandeglang', 0, 0, 'C');
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
        if ($this->GetY() + $h > $this->PageBreakTrigger) $this->AddPage($this->CurOrientation);
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

// 6. Inisialisasi PDF
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->SetMargins(10, 10, 10);
$pdf->AddPage();

// === JUDUL LAPORAN ===
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 6, 'LAPORAN REKAPITULASI PELAYANAN DIGITAL & SURVEI KEPUASAN', 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 5, 'Periode Laporan: ' . $periodeText, 0, 1, 'C');
$pdf->Ln(6);

// === AMBIL DATA (DIFILTER BERDASARKAN BULAN & TAHUN) ===
// Format SQLite strftime('%m', created_at) outputnya '01', '02', dll. Jadi kita perlu str_pad bulan.
$m = str_pad($month, 2, '0', STR_PAD_LEFT);
$y = $year;

// Query Statistik
$visits = $db->querySingle("SELECT value FROM global_stats WHERE key = 'site_visits'") ?: 0; // Visit global tidak bisa difilter per bulan (kecuali struktur DB diubah)
$posts = $db->querySingle("SELECT COUNT(*) FROM post_stats") ?: 0; // Sama, ini global

// Query Feedback per Bulan
$feedback = $db->querySingle("SELECT COUNT(*) FROM feedback WHERE strftime('%m', created_at) = '$m' AND strftime('%Y', created_at) = '$y'") ?: 0;

// Query Survey per Bulan
$survey = $db->querySingle("SELECT COUNT(*) FROM survey_responses WHERE strftime('%m', created_at) = '$m' AND strftime('%Y', created_at) = '$y'") ?: 0;

// === TABEL RINGKASAN DENGAN QR CODE ===
// Posisi Awal Tabel
$xTable = 10;
$yTable = $pdf->GetY();
$colLabelW = 70;
$colValueW = 85;
$colQRW = 35; // Lebar kolom QR
$rowH = 8;    // Tinggi baris standar

// -- BARIS 1: JUDUL PERIODE --
$pdf->SetFont('Arial', 'B', 9);
$pdf->SetFillColor(230, 255, 230); // Hijau Muda
$pdf->Cell($colLabelW, $rowH, 'Bulan Pelaporan', 1, 0, 'L', true);
$pdf->Cell($colValueW, $rowH, strtoupper($periodeText), 1, 0, 'L');

// -- QR CODE CELL (MERGE ROW) --
// Kita simpan posisi X,Y untuk QR Code nanti
$xQR = $pdf->GetX();
$yQR = $pdf->GetY();
// Gambar border kosong dulu untuk tempat QR (tinggi 4 baris x 8mm = 32mm)
$pdf->Cell($colQRW, 32, '', 1, 1, 'C');

// Generate QR Code Link Validasi (Contoh URL)
$qrUrl = "https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=Verifikasi:MTsN1PDG-{$m}-{$y}&choe=UTF-8";
$pdf->Image($qrUrl, $xQR + 2.5, $yQR + 2.5, 30, 30, 'PNG'); // Masukkan gambar ke dalam kotak tadi

// -- BARIS 2: KUNJUNGAN --
$pdf->SetXY($xTable, $yTable + $rowH);
$pdf->Cell($colLabelW, $rowH, 'Total Kunjungan Website', 1, 0, 'L', true);
$pdf->Cell($colValueW, $rowH, number_format($visits) . ' Pengunjung (Akumulasi)', 1, 1, 'L');

// -- BARIS 3: RESPONDEN --
$pdf->SetX($xTable);
$pdf->Cell($colLabelW, $rowH, 'Total Responden Survei', 1, 0, 'L', true);
$pdf->Cell($colValueW, $rowH, $survey . ' Responden', 1, 1, 'L');

// -- BARIS 4: ULASAN --
$pdf->SetX($xTable);
$pdf->Cell($colLabelW, $rowH, 'Total Ulasan Masuk', 1, 0, 'L', true);
$pdf->Cell($colValueW, $rowH, $feedback . ' Ulasan', 1, 1, 'L');

// -- BARIS 5: FOOTER QR (TIMESTAMP) --
$pdf->SetXY($xQR, $yQR + 32); // Pindah ke bawah kotak QR
$pdf->SetFont('Arial', '', 6);
$pdf->Cell($colQRW, 4, 'Dicetak: ' . date('d/m/Y H:i'), 1, 1, 'C'); // Border tipis di bawah QR

$pdf->Ln(8);

// === BAGIAN 1: DATA SURVEI KEPUASAN ===
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 7, 'A. DATA SURVEI KEPUASAN MASYARAKAT', 0, 1, 'L');
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetFillColor(0, 150, 100);
$pdf->SetTextColor(255);

// Header Table
$pdf->Cell(8, 7, 'No', 1, 0, 'C', true);
$pdf->Cell(35, 7, 'Waktu', 1, 0, 'C', true);
$pdf->Cell(40, 7, 'Responden', 1, 0, 'L', true);
$pdf->Cell(15, 7, 'ZI', 1, 0, 'C', true);
$pdf->Cell(15, 7, 'LYN', 1, 0, 'C', true);
$pdf->Cell(15, 7, 'AKD', 1, 0, 'C', true);
$pdf->Cell(62, 7, 'Masukan', 1, 1, 'L', true);

$pdf->SetTextColor(0);
$pdf->SetFont('Arial', '', 8);
$pdf->SetWidths([8, 35, 40, 15, 15, 15, 62]);
$pdf->SetAligns(['C', 'C', 'L', 'C', 'C', 'C', 'L']);

// QUERY FILTER BULAN
$resSurv = $db->query("SELECT * FROM survey_responses WHERE strftime('%m', created_at) = '$m' AND strftime('%Y', created_at) = '$y' ORDER BY created_at DESC");
$no = 1;
$foundData = false;
while ($row = $resSurv->fetchArray(SQLITE3_ASSOC)) {
    $foundData = true;
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
if (!$foundData) {
    $pdf->Cell(190, 8, 'Tidak ada data survei pada periode ini.', 1, 1, 'C');
}
$pdf->Ln(4);

// === BAGIAN 2: DATA ULASAN PELAYANAN ===
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 7, 'B. DATA ULASAN & RATING PELAYANAN', 0, 1, 'L');
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetFillColor(255, 193, 7);
$pdf->SetTextColor(0);

$pdf->Cell(8, 7, 'No', 1, 0, 'C', true);
$pdf->Cell(35, 7, 'Waktu', 1, 0, 'C', true);
$pdf->Cell(45, 7, 'Nama', 1, 0, 'L', true);
$pdf->Cell(20, 7, 'Rating', 1, 0, 'C', true);
$pdf->Cell(82, 7, 'Pesan', 1, 1, 'L', true);

$pdf->SetFont('Arial', '', 8);
$pdf->SetWidths([8, 35, 45, 20, 82]);
$pdf->SetAligns(['C', 'C', 'L', 'C', 'L']);

// QUERY FILTER BULAN
$resFeed = $db->query("SELECT * FROM feedback WHERE strftime('%m', created_at) = '$m' AND strftime('%Y', created_at) = '$y' ORDER BY created_at DESC");
$no = 1;
$foundData2 = false;
while ($row = $resFeed->fetchArray(SQLITE3_ASSOC)) {
    $foundData2 = true;
    $pdf->Row([
        $no++,
        formatFullTime($row['created_at']),
        $row['name'] ?: 'Anonim',
        $row['rating'] . ' / 5',
        $row['message'] ?: '-'
    ]);
}
if (!$foundData2) {
    $pdf->Cell(190, 8, 'Tidak ada data ulasan pada periode ini.', 1, 1, 'C');
}

// === AREA TANDA TANGAN ===
$pdf->AddPage();
$pdf->Ln(5);

$path = '../images/instansi/';
$tglCetak = getIndonesianDate(); // Tanggal hari ini (saat dicetak)
$qrSize = 18;

$yStart = $pdf->GetY();

// --- KANAN (TANGGAL) ---
$pdf->SetXY(120, $yStart);
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(70, 5, 'Pandeglang, ' . $tglCetak, 0, 1, 'C');
$pdf->Ln(5);

$yJabatan = $pdf->GetY();

// --- JABATAN ---
$pdf->SetXY(20, $yJabatan);
$pdf->Cell(70, 5, 'Kepala Tata Usaha,', 0, 0, 'C');
$pdf->SetXY(120, $yJabatan);
$pdf->Cell(70, 5, 'Koordinator Tim Pusdatin,', 0, 1, 'C');

// --- GAMBAR TTE ---
$yImage = $pdf->GetY() + 1;
if (file_exists($path . 'tte-kepala-tata-usaha.png')) {
    $pdf->Image($path . 'tte-kepala-tata-usaha.png', 46, $yImage, $qrSize);
}
if (file_exists($path . 'tte-koordinator-tim-pusdatin.png')) {
    $pdf->Image($path . 'tte-koordinator-tim-pusdatin.png', 146, $yImage, $qrSize);
}

$pdf->SetY($yImage + 19);

// --- NAMA & NIP ---
$pdf->SetFont('Arial', 'B', 11);
$pdf->SetX(20);
$pdf->Cell(70, 5, "UMAR MU'TAMAR, S.Ag.", 0, 0, 'C');
$pdf->SetX(120);
$pdf->Cell(70, 5, 'YAHYA ZULFIKRI, S.Kom.', 0, 1, 'C');

$pdf->SetFont('Arial', '', 10);
$pdf->SetX(20);
$pdf->Cell(70, 4, 'NIP. 196903061998031004', 0, 0, 'C');
$pdf->SetX(120);
$pdf->Cell(70, 4, 'NIP. 200001142025211016', 0, 1, 'C');

// --- KAMAD ---
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(0, 5, 'Mengetahui,', 0, 1, 'C');
$pdf->Cell(0, 5, 'Kepala Madrasah,', 0, 1, 'C');

$yImageKamad = $pdf->GetY() + 1;
if (file_exists($path . 'tte-kepala-madrasah.png')) {
    $pdf->Image($path . 'tte-kepala-madrasah.png', 96, $yImageKamad, $qrSize);
}

$pdf->SetY($yImageKamad + 19);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(0, 5, 'H. EMAN SULAIMAN, S.Ag., M.Pd.', 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 4, 'NIP. 197006032000031002', 0, 1, 'C');

// Output
$pdf->Output('I', 'Laporan_' . $month . '_' . $year . '.pdf');
