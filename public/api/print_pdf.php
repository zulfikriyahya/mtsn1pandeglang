<?php
// Matikan display error agar tidak merusak output PDF
ini_set('display_errors', 0);
ini_set('log_errors', 1);

session_start();
date_default_timezone_set('Asia/Jakarta');

// 1. Cek Login
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    die("Akses Ditolak.");
}

// 2. Cek Library FPDF
if (!file_exists(__DIR__ . '/lib/fpdf.php')) {
    die("Error: Library FPDF tidak ditemukan. Pastikan file fpdf.php ada di folder public/api/lib/");
}
require('lib/fpdf.php');

// 3. Database
$dbPath = __DIR__ . '/../../stats.db';
try {
    $db = new SQLite3($dbPath);
} catch (Exception $e) {
    die("Error DB: " . $e->getMessage());
}

// 4. Parameter Input
$month = isset($_GET['month']) ? (int)$_GET['month'] : (int)date('m');
$year = isset($_GET['year']) ? (int)$_GET['year'] : (int)date('Y');
$bulanIndo = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
$periodeText = strtoupper($bulanIndo[$month] . ' ' . $year);

// 5. Helpers
function formatFullTime($timestamp)
{
    try {
        $dt = new DateTime($timestamp);
        $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        return $dt->format('d') . ' ' . $bulan[(int)$dt->format('m')] . ' ' . $dt->format('Y') . "\n" . $dt->format('H:i') . ' WIB';
    } catch (Exception $e) {
        return "-";
    }
}

// 6. Extended PDF Class
class PDF extends FPDF
{
    var $widths;
    var $aligns;

    // Properti baru untuk menangani Header Tabel Berulang
    var $tableHeaderCallback = null;
    var $isPrintingTable = false;

    function SetWidths($w)
    {
        $this->widths = $w;
    }

    function SetAligns($a)
    {
        $this->aligns = $a;
    }

    // Fungsi untuk registrasi fungsi header tabel saat ini
    function SetTableHeaderCallback($callback)
    {
        $this->tableHeaderCallback = $callback;
    }

    function ImageRemote($url, $x, $y, $w, $h)
    {
        // ... (Kode ImageRemote tetap sama seperti sebelumnya untuk performa)
        $tmpFile = sys_get_temp_dir() . '/qr_' . md5($url) . '.png';
        if (file_exists($tmpFile) && filesize($tmpFile) > 0) {
            $this->Image($tmpFile, $x, $y, $w, $h);
            return;
        }
        $ch = curl_init($url);
        $fp = fopen($tmpFile, 'wb');
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        fclose($fp);

        if ($code == 200 && filesize($tmpFile) > 0) {
            $this->Image($tmpFile, $x, $y, $w, $h);
        }
    }

    function Header()
    {
        $path = '../images/instansi/'; // Pastikan path ini benar relatif terhadap script php
        $logoSize = 24;

        if (file_exists($path . 'logo-institusi.png')) $this->Image($path . 'logo-institusi.png', 10, 10, $logoSize);
        if (file_exists($path . 'logo-instansi.png')) $this->Image($path . 'logo-instansi.png', 176, 10, $logoSize);

        $this->SetY(12);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 5, 'KEMENTERIAN AGAMA REPUBLIK INDONESIA', 0, 1, 'C');
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 6, 'KANTOR KEMENTERIAN AGAMA KABUPATEN PANDEGLANG', 0, 1, 'C');
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 6, 'MADRASAH TSANAWIYAH NEGERI 1 PANDEGLANG', 0, 1, 'C');
        $this->SetFont('Arial', '', 9);
        $this->Cell(0, 4, 'Jl. Raya Labuan Km. 5,7 Palurahan, Kaduhejo, Pandeglang - Banten 42253', 0, 1, 'C');
        $this->Cell(0, 4, 'Website: https://mtsn1pandeglang.sch.id | Email: adm@mtsn1pandeglang.sch.id', 0, 1, 'C');

        $this->SetLineWidth(0.5);
        $this->Line(10, 39, 200, 39);
        $this->SetLineWidth(0.2);
        $this->Line(10, 40, 200, 40);

        $this->Ln(8);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Hal ' . $this->PageNo() . '/{nb} | Sistem Informasi MTsN 1 Pandeglang | Dicetak: ' . date('d/m/Y H:i') . ' WIB', 0, 0, 'C');
    }

    function CheckPageBreak($h)
    {
        // Logic: Jika posisi Y sekarang + tinggi baris > batas halaman
        if ($this->GetY() + $h > $this->PageBreakTrigger) {
            $this->AddPage($this->CurOrientation);

            // RE-PRINT HEADER TABEL JIKA ADA
            if ($this->isPrintingTable && is_callable($this->tableHeaderCallback)) {
                call_user_func($this->tableHeaderCallback);
            }
        }
    }

    function Row($data, $fill = false)
    {
        $nb = 0;
        for ($i = 0; $i < count($data); $i++) $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        $h = 5 * $nb;

        $this->CheckPageBreak($h); // Cek apakah perlu halaman baru

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

// ==========================================
// MAIN GENERATION LOGIC
// ==========================================
try {
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->SetMargins(10, 10, 10);
    $pdf->SetAutoPageBreak(false); // Kita handle page break manual di Row()
    $pdf->PageBreakTrigger = 297 - 20; // A4 Height - Bottom Margin (approx)

    $pdf->AddPage();

    // Data Preparation
    $m = str_pad($month, 2, '0', STR_PAD_LEFT);
    $y = $year;

    // --- JUDUL LAPORAN ---
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 6, 'LAPORAN REKAPITULASI PELAYANAN DIGITAL', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 5, 'Periode Laporan: ' . $periodeText, 0, 1, 'C');
    $pdf->Ln(5);

    // --- RINGKASAN (Tidak perlu looping, jadi manual saja) ---
    // [Kode ringkasan & QR Code sama seperti sebelumnya, saya persingkat untuk fokus ke tabel]
    $visits = $db->querySingle("SELECT value FROM global_stats WHERE key = 'site_visits'") ?: 0;
    $articleViews = $db->querySingle("SELECT SUM(views) FROM post_stats") ?: 0;
    $surveyCount = $db->querySingle("SELECT COUNT(*) FROM survey_responses WHERE strftime('%m', created_at) = '$m' AND strftime('%Y', created_at) = '$y'") ?: 0;
    $feedbackCount = $db->querySingle("SELECT COUNT(*) FROM feedback WHERE strftime('%m', created_at) = '$m' AND strftime('%Y', created_at) = '$y'") ?: 0;

    // Hitung IKM
    $indices = $db->querySingle("SELECT AVG(score_zi) as zi, AVG(score_service) as service, AVG(score_academic) as academic FROM survey_responses WHERE strftime('%m', created_at) = '$m' AND strftime('%Y', created_at) = '$y'", true);
    $idxZI = $indices ? round($indices['zi'] ?? 0, 2) : 0;
    $idxService = $indices ? round($indices['service'] ?? 0, 2) : 0;
    $idxAcademic = $indices ? round($indices['academic'] ?? 0, 2) : 0;
    $ikmValue = ($surveyCount > 0) ? round(($idxZI + $idxService + $idxAcademic) / 3, 2) : 0;

    // Render Tabel Ringkasan (Hardcode, tidak butuh auto-break)
    $rowH = 7;
    $wTable1 = 155;
    $wQR = 35;
    $startX = 10;
    $startY = $pdf->GetY();

    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetFillColor(230, 230, 230);
    $pdf->Cell($wTable1, $rowH, ' I. RINGKASAN TRAFIK WEBSITE', 1, 0, 'L', true);
    $pdf->Cell($wQR, $rowH * 4, '', 1, 0, 'C'); // Placeholder QR

    // QR Code
    $qrContent = urlencode("MTSN1PDG|{$m}/{$y}|V:{$visits}|IKM:{$ikmValue}");
    $qrUrl = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={$qrContent}&bgcolor=ffffff";
    $pdf->ImageRemote($qrUrl, ($startX + $wTable1) + 5.5, $startY + 2, 24, 24);

    $pdf->Ln($rowH);
    $pdf->SetFont('Arial', '', 9);
    $pdf->SetFillColor(250, 250, 250);
    $wLabel = 65;
    $wValue = 90;

    $pdf->Cell($wLabel, $rowH, ' Bulan Pelaporan', 1, 0, 'L', true);
    $pdf->Cell($wValue, $rowH, '  ' . $periodeText, 1, 1, 'L');
    $pdf->Cell($wLabel, $rowH, ' Total Kunjungan', 1, 0, 'L', true);
    $pdf->Cell($wValue, $rowH, '  ' . number_format($visits), 1, 1, 'L');
    $pdf->Cell($wLabel, $rowH, ' Total Artikel Dibaca', 1, 0, 'L', true);
    $pdf->Cell($wValue, $rowH, '  ' . number_format($articleViews), 1, 1, 'L');
    $pdf->Ln(5);

    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetFillColor(230, 230, 230);
    $pdf->Cell(190, $rowH, ' II. KUALITAS PELAYANAN', 1, 1, 'L', true);
    $pdf->SetFont('Arial', '', 9);
    $pdf->SetFillColor(250, 250, 250);
    $wLabelFull = 70;
    $wValueFull = 120;

    $pdf->Cell($wLabelFull, $rowH, ' Responden Survei', 1, 0, 'L', true);
    $pdf->Cell($wValueFull, $rowH, ' ' . number_format($surveyCount) . ' Orang', 1, 1, 'L');
    $pdf->Cell($wLabelFull, $rowH, ' Ulasan Masuk', 1, 0, 'L', true);
    $pdf->Cell($wValueFull, $rowH, ' ' . number_format($feedbackCount) . ' Pesan', 1, 1, 'L');

    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell($wLabelFull, $rowH, ' Indeks Kepuasan (IKM)', 1, 0, 'L', true);
    $pdf->Cell($wValueFull, $rowH, ' ' . ($ikmValue > 0 ? $ikmValue . " / 5.00" : "-"), 1, 1, 'L');
    $pdf->Ln(8);

    // ==========================================
    // BAGIAN A: DETAIL SURVEI (Dengan Header Berulang)
    // ==========================================

    // Definisi Fungsi Header Survei
    $drawSurveyHeader = function () use ($pdf) {
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetFillColor(0, 150, 100);
        $pdf->SetTextColor(255);
        $pdf->Cell(8, 7, 'No', 1, 0, 'C', true);
        $pdf->Cell(25, 7, 'Waktu', 1, 0, 'C', true);
        $pdf->Cell(45, 7, 'Responden', 1, 0, 'L', true);
        $pdf->Cell(12, 7, 'ZI', 1, 0, 'C', true);
        $pdf->Cell(12, 7, 'LYN', 1, 0, 'C', true);
        $pdf->Cell(12, 7, 'AKD', 1, 0, 'C', true);
        $pdf->Cell(12, 7, 'Rata', 1, 0, 'C', true);
        $pdf->Cell(64, 7, 'Masukan', 1, 1, 'L', true);
        $pdf->SetTextColor(0); // Reset text color
    };

    // 1. Judul Section
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(0, 7, 'A. DATA DETAIL SURVEI KEPUASAN (Terbaru -> Terlama)', 0, 1, 'L');

    // 2. Set Konfigurasi Tabel
    $pdf->SetWidths([8, 25, 45, 12, 12, 12, 12, 64]);
    $pdf->SetAligns(['C', 'C', 'L', 'C', 'C', 'C', 'C', 'L']);
    $pdf->SetFont('Arial', '', 8);

    // 3. Gambar Header Pertama Kali
    $drawSurveyHeader();

    // 4. Aktifkan Mode Tabel & Callback
    $pdf->isPrintingTable = true;
    $pdf->SetTableHeaderCallback($drawSurveyHeader);

    // 5. Query & Loop Data (ORDER BY created_at DESC)
    $resSurv = $db->query("SELECT * FROM survey_responses WHERE strftime('%m', created_at) = '$m' AND strftime('%Y', created_at) = '$y' ORDER BY created_at DESC");

    $no = 1;
    $found1 = false;
    while ($row = $resSurv->fetchArray(SQLITE3_ASSOC)) {
        $found1 = true;
        $idxIndividual = round(($row['score_zi'] + $row['score_service'] + $row['score_academic']) / 3, 2);

        $pdf->Row([
            $no++,
            formatFullTime($row['created_at']),
            $row['respondent_name'] . "\n(" . $row['respondent_role'] . ")",
            $row['score_zi'],
            $row['score_service'],
            $row['score_academic'],
            $idxIndividual,
            $row['feedback'] ?: '-'
        ]);
    }

    // Matikan mode tabel
    $pdf->isPrintingTable = false;

    if (!$found1) {
        $pdf->SetFont('Arial', 'I', 8);
        $pdf->Cell(190, 8, 'Tidak ada data pada periode ini.', 1, 1, 'C');
    }
    $pdf->Ln(6);


    // ==========================================
    // BAGIAN B: DETAIL ULASAN (Dengan Header Berulang)
    // ==========================================

    // Definisi Fungsi Header Ulasan
    $drawFeedbackHeader = function () use ($pdf) {
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetFillColor(255, 193, 7);
        $pdf->SetTextColor(0);
        $pdf->Cell(8, 7, 'No', 1, 0, 'C', true);
        $pdf->Cell(25, 7, 'Waktu', 1, 0, 'C', true);
        $pdf->Cell(50, 7, 'Nama Pengirim', 1, 0, 'L', true);
        $pdf->Cell(20, 7, 'Rating', 1, 0, 'C', true);
        $pdf->Cell(87, 7, 'Isi Pesan', 1, 1, 'L', true);
    };

    // 1. Judul Section
    $pdf->SetFont('Arial', 'B', 10);
    // Cek apakah judul muat, jika tidak paksa pindah halaman
    if ($pdf->GetY() + 15 > $pdf->PageBreakTrigger) $pdf->AddPage();
    $pdf->Cell(0, 7, 'B. DATA DETAIL ULASAN MASUK (Terbaru -> Terlama)', 0, 1, 'L');

    // 2. Set Konfigurasi Tabel
    $pdf->SetWidths([8, 25, 50, 20, 87]);
    $pdf->SetAligns(['C', 'C', 'L', 'C', 'L']);
    $pdf->SetFont('Arial', '', 8);

    // 3. Gambar Header Pertama Kali
    $drawFeedbackHeader();

    // 4. Aktifkan Mode Tabel & Callback
    $pdf->isPrintingTable = true;
    $pdf->SetTableHeaderCallback($drawFeedbackHeader);

    // 5. Query & Loop
    $resFeed = $db->query("SELECT * FROM feedback WHERE strftime('%m', created_at) = '$m' AND strftime('%Y', created_at) = '$y' ORDER BY created_at DESC");

    $no = 1;
    $found2 = false;
    while ($row = $resFeed->fetchArray(SQLITE3_ASSOC)) {
        $found2 = true;
        $pdf->Row([
            $no++,
            formatFullTime($row['created_at']),
            $row['name'] ?: 'Anonim',
            $row['rating'] . ' / 5',
            $row['message'] ?: '-'
        ]);
    }

    $pdf->isPrintingTable = false;

    if (!$found2) {
        $pdf->SetFont('Arial', 'I', 8);
        $pdf->Cell(190, 8, 'Tidak ada data pada periode ini.', 1, 1, 'C');
    }

    $pdf->Ln(8);

    // ==========================================
    // TANDA TANGAN (Smart Page Break Logic)
    // ==========================================

    $signatureHeight = 60; // Estimasi tinggi blok tanda tangan

    // Cek sisa ruang halaman
    // Jika posisi Y sekarang + tinggi tanda tangan > batas halaman, buat halaman baru
    if ($pdf->GetY() + $signatureHeight > $pdf->PageBreakTrigger) {
        $pdf->AddPage();
    }

    // Render Tanda Tangan
    $path = '../images/instansi/';
    $tglCetak = date('d') . ' ' . $bulanIndo[(int)date('m')] . ' ' . date('Y');
    $qrSize = 18;

    $yStart = $pdf->GetY();

    // Tanggal
    $pdf->SetXY(120, $yStart);
    $pdf->SetFont('Arial', '', 11);
    $pdf->Cell(70, 5, 'Pandeglang, ' . $tglCetak, 0, 1, 'C');
    $pdf->Ln(5);
    $yJabatan = $pdf->GetY();

    // Jabatan
    $pdf->SetXY(20, $yJabatan);
    $pdf->Cell(70, 5, 'Kepala Tata Usaha,', 0, 0, 'C');
    $pdf->SetXY(120, $yJabatan);
    $pdf->Cell(70, 5, 'Koordinator Tim Pusdatin,', 0, 1, 'C');

    // Gambar TTE
    $yImage = $pdf->GetY() + 1;
    if (file_exists($path . 'tte-kepala-tata-usaha.png')) $pdf->Image($path . 'tte-kepala-tata-usaha.png', 46, $yImage, $qrSize);
    if (file_exists($path . 'tte-koordinator-tim-pusdatin.png')) $pdf->Image($path . 'tte-koordinator-tim-pusdatin.png', 146, $yImage, $qrSize);

    // Nama Pejabat
    $pdf->SetY($yImage + 19);
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->SetX(20);
    $pdf->Cell(70, 5, "UMAR MU'TAMAR, S.Ag.", 0, 0, 'C');
    $pdf->SetX(120);
    $pdf->Cell(70, 5, 'YAHYA ZULFIKRI', 0, 1, 'C');

    // NIP
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetX(20);
    $pdf->Cell(70, 4, 'NIP. 196903061998031004', 0, 0, 'C');
    $pdf->SetX(120);
    $pdf->Cell(70, 4, 'NIP. 200001142025211016', 0, 1, 'C');

    // Kepala Madrasah
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

    // Output PDF
    $pdf->Output('I', 'Laporan_Pelayanan_Digital_' . $month . '_' . $year . '.pdf');
} catch (Exception $e) {
    die("PDF Generation Error: " . $e->getMessage());
}
