<?php
// Matikan display error agar tidak merusak binary PDF, log error saja
ini_set('display_errors', 0);
ini_set('log_errors', 1);

session_start();
date_default_timezone_set('Asia/Jakarta');

// 1. Cek Login
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    die("Akses Ditolak: Harap login terlebih dahulu.");
}

// 2. Cek Library FPDF (Wajib Ada)
if (!file_exists(__DIR__ . '/lib/fpdf.php')) {
    die("Error Fatal: File 'public/api/lib/fpdf.php' tidak ditemukan. Harap upload file library FPDF.");
}
require('lib/fpdf.php');

// 3. Koneksi Database
$dbPath = __DIR__ . '/../../stats.db';
try {
    $db = new SQLite3($dbPath);
} catch (Exception $e) {
    die("Error Database: " . $e->getMessage());
}

// 4. Parameter Filter
$month = isset($_GET['month']) ? (int)$_GET['month'] : (int)date('m');
$year = isset($_GET['year']) ? (int)$_GET['year'] : (int)date('Y');
if ($month < 1 || $month > 12) $month = (int)date('m');
if ($year < 2020 || $year > 2030) $year = (int)date('Y');

$bulanIndo = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
$periodeText = $bulanIndo[$month] . ' ' . $year;

// 5. Helpers
function getIndonesianDate($timestamp = null)
{
    $dt = new DateTime($timestamp ?? 'now');
    $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    return $dt->format('d') . ' ' . $bulan[(int)$dt->format('m')] . ' ' . $dt->format('Y');
}

function formatFullTime($timestamp)
{
    return getIndonesianDate($timestamp) . ' ' . date('H:i', strtotime($timestamp)) . ' WIB';
}

// 6. FPDF Class
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

    // FUNGSI AMAN DOWNLOAD GAMBAR (cURL)
    function ImageRemote($url, $x, $y, $w, $h)
    {
        $tmpFile = sys_get_temp_dir() . '/qr_' . md5($url) . '.png';
        $downloaded = false;

        // Cara 1: cURL (Lebih handal)
        if (function_exists('curl_init')) {
            $ch = curl_init($url);
            $fp = fopen($tmpFile, 'wb');
            curl_setopt($ch, CURLOPT_FILE, $fp);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5); // Timeout 5 detik
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            fclose($fp);
            if ($httpCode == 200 && filesize($tmpFile) > 0) $downloaded = true;
        }

        // Cara 2: file_get_contents (Fallback)
        if (!$downloaded && ini_get('allow_url_fopen')) {
            $content = @file_get_contents($url);
            if ($content) {
                file_put_contents($tmpFile, $content);
                $downloaded = true;
            }
        }

        if ($downloaded) {
            try {
                $this->Image($tmpFile, $x, $y, $w, $h);
            } catch (Exception $e) {
                $this->Rect($x, $y, $w, $h);
                $this->SetXY($x, $y + ($h / 2) - 2);
                $this->SetFont('Arial', '', 6);
                $this->Cell($w, 4, 'Invalid Image', 0, 0, 'C');
            }
            @unlink($tmpFile);
        } else {
            // Jika gagal download, gambar kotak kosong
            $this->Rect($x, $y, $w, $h);
            $this->SetXY($x, $y + ($h / 2) - 2);
            $this->SetFont('Arial', '', 6);
            $this->Cell($w, 4, 'QR Error', 0, 0, 'C');
        }
    }

    function Header()
    {
        $path = '../images/instansi/';
        $logoSize = 18;

        if (file_exists($path . 'logo-institusi.png')) $this->Image($path . 'logo-institusi.png', 12, 10, $logoSize);
        if (file_exists($path . 'logo-instansi.png')) $this->Image($path . 'logo-instansi.png', 180, 10, $logoSize);

        $this->SetY(11);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 5, 'KEMENTERIAN AGAMA REPUBLIK INDONESIA', 0, 1, 'C');
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 6, 'KANTOR KEMENTERIAN AGAMA KABUPATEN PANDEGLANG', 0, 1, 'C');
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(0, 7, 'MADRASAH TSANAWIYAH NEGERI 1 PANDEGLANG', 0, 1, 'C');
        $this->SetFont('Arial', '', 9);
        $this->Cell(0, 4, 'Jl. Raya Labuan Km. 5,7 Kadulisung, Pandeglang - Banten 42251', 0, 1, 'C');
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
        for ($i = 0; $i < count($data); $i++) $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
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

// --- MAIN GENERATION ---
try {
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->SetMargins(10, 10, 10);
    $pdf->AddPage();

    // Judul
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 6, 'LAPORAN REKAPITULASI PELAYANAN DIGITAL & SURVEI KEPUASAN', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 5, 'Periode Laporan: ' . $periodeText, 0, 1, 'C');
    $pdf->Ln(6);

    // Queries
    $m = str_pad($month, 2, '0', STR_PAD_LEFT);
    $y = $year;

    // Gunakan try-catch query agar tidak mati jika tabel belum ada
    $visits = $db->querySingle("SELECT value FROM global_stats WHERE key = 'site_visits'") ?: 0;
    $feedback = $db->querySingle("SELECT COUNT(*) FROM feedback WHERE strftime('%m', created_at) = '$m' AND strftime('%Y', created_at) = '$y'") ?: 0;
    $survey = $db->querySingle("SELECT COUNT(*) FROM survey_responses WHERE strftime('%m', created_at) = '$m' AND strftime('%Y', created_at) = '$y'") ?: 0;

    // Tabel Ringkasan
    $xTable = 10;
    $yTable = $pdf->GetY();
    $colLabelW = 70;
    $colValueW = 85;
    $colQRW = 35;
    $rowH = 8;

    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetFillColor(230, 255, 230);
    $pdf->Cell($colLabelW, $rowH, 'Bulan Pelaporan', 1, 0, 'L', true);
    $pdf->Cell($colValueW, $rowH, strtoupper($periodeText), 1, 0, 'L');

    // QR Code
    $xQR = $pdf->GetX();
    $yQR = $pdf->GetY();
    $pdf->Cell($colQRW, 32, '', 1, 1, 'C');
    $qrUrl = "https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=Verifikasi:MTsN1PDG-{$m}-{$y}&choe=UTF-8";
    $pdf->ImageRemote($qrUrl, $xQR + 2.5, $yQR + 2.5, 30, 30);

    $pdf->SetXY($xTable, $yTable + $rowH);
    $pdf->Cell($colLabelW, $rowH, 'Total Kunjungan Website', 1, 0, 'L', true);
    $pdf->Cell($colValueW, $rowH, number_format($visits) . ' Pengunjung', 1, 1, 'L');

    $pdf->SetX($xTable);
    $pdf->Cell($colLabelW, $rowH, 'Total Responden Survei', 1, 0, 'L', true);
    $pdf->Cell($colValueW, $rowH, $survey . ' Responden', 1, 1, 'L');

    $pdf->SetX($xTable);
    $pdf->Cell($colLabelW, $rowH, 'Total Ulasan Masuk', 1, 0, 'L', true);
    $pdf->Cell($colValueW, $rowH, $feedback . ' Ulasan', 1, 1, 'L');

    $pdf->SetXY($xQR, $yQR + 32);
    $pdf->SetFont('Arial', '', 6);
    $pdf->Cell($colQRW, 4, 'Dicetak: ' . date('d/m/Y H:i'), 1, 1, 'C');
    $pdf->Ln(8);

    // Data Survey
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(0, 7, 'A. DATA SURVEI KEPUASAN MASYARAKAT', 0, 1, 'L');
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->SetFillColor(0, 150, 100);
    $pdf->SetTextColor(255);
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

    $resSurv = $db->query("SELECT * FROM survey_responses WHERE strftime('%m', created_at) = '$m' AND strftime('%Y', created_at) = '$y' ORDER BY created_at DESC");
    $no = 1;
    $found1 = false;
    while ($row = $resSurv->fetchArray(SQLITE3_ASSOC)) {
        $found1 = true;
        $pdf->Row([$no++, formatFullTime($row['created_at']), $row['respondent_name'] . "\n(" . $row['respondent_role'] . ")", $row['score_zi'], $row['score_service'], $row['score_academic'], $row['feedback'] ?: '-']);
    }
    if (!$found1) $pdf->Cell(190, 8, 'Tidak ada data pada periode ini.', 1, 1, 'C');
    $pdf->Ln(4);

    // Data Feedback
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

    $resFeed = $db->query("SELECT * FROM feedback WHERE strftime('%m', created_at) = '$m' AND strftime('%Y', created_at) = '$y' ORDER BY created_at DESC");
    $no = 1;
    $found2 = false;
    while ($row = $resFeed->fetchArray(SQLITE3_ASSOC)) {
        $found2 = true;
        $pdf->Row([$no++, formatFullTime($row['created_at']), $row['name'] ?: 'Anonim', $row['rating'] . ' / 5', $row['message'] ?: '-']);
    }
    if (!$found2) $pdf->Cell(190, 8, 'Tidak ada data pada periode ini.', 1, 1, 'C');

    // Tanda Tangan
    $pdf->AddPage();
    $pdf->Ln(5);
    $path = '../images/instansi/';
    $tglCetak = getIndonesianDate();
    $qrSize = 18;
    $yStart = $pdf->GetY();

    $pdf->SetXY(120, $yStart);
    $pdf->SetFont('Arial', '', 11);
    $pdf->Cell(70, 5, 'Pandeglang, ' . $tglCetak, 0, 1, 'C');
    $pdf->Ln(5);
    $yJabatan = $pdf->GetY();

    $pdf->SetXY(20, $yJabatan);
    $pdf->Cell(70, 5, 'Kepala Tata Usaha,', 0, 0, 'C');
    $pdf->SetXY(120, $yJabatan);
    $pdf->Cell(70, 5, 'Koordinator Tim Pusdatin,', 0, 1, 'C');

    $yImage = $pdf->GetY() + 1;
    if (file_exists($path . 'tte-kepala-tata-usaha.png')) $pdf->Image($path . 'tte-kepala-tata-usaha.png', 46, $yImage, $qrSize);
    if (file_exists($path . 'tte-koordinator-tim-pusdatin.png')) $pdf->Image($path . 'tte-koordinator-tim-pusdatin.png', 146, $yImage, $qrSize);

    $pdf->SetY($yImage + 19);
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

    $pdf->Ln(8);
    $pdf->SetFont('Arial', '', 11);
    $pdf->Cell(0, 5, 'Mengetahui,', 0, 1, 'C');
    $pdf->Cell(0, 5, 'Kepala Madrasah,', 0, 1, 'C');

    $yImageKamad = $pdf->GetY() + 1;
    if (file_exists($path . 'tte-kepala-madrasah.png')) $pdf->Image($path . 'tte-kepala-madrasah.png', 96, $yImageKamad, $qrSize);

    $pdf->SetY($yImageKamad + 19);
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(0, 5, 'H. EMAN SULAIMAN, S.Ag., M.Pd.', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 4, 'NIP. 197006032000031002', 0, 1, 'C');

    $pdf->Output('I', 'Laporan_' . $month . '_' . $year . '.pdf');
} catch (Exception $e) {
    die("PDF Error: " . $e->getMessage());
}
