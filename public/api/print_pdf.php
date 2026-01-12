<?php
// Matikan display error
ini_set('display_errors', 0);
ini_set('log_errors', 1);

session_start();
date_default_timezone_set('Asia/Jakarta');

// 1. Cek Login
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    die("Akses Ditolak.");
}

// 2. Cek Library
if (!file_exists(__DIR__ . '/lib/fpdf.php')) {
    die("Error: Library FPDF tidak ditemukan.");
}
require('lib/fpdf.php');

// 3. Database
$dbPath = __DIR__ . '/../../stats.db';
try {
    $db = new SQLite3($dbPath);
} catch (Exception $e) {
    die("Error DB: " . $e->getMessage());
}

// 4. Parameter
$month = isset($_GET['month']) ? (int)$_GET['month'] : (int)date('m');
$year = isset($_GET['year']) ? (int)$_GET['year'] : (int)date('Y');
$bulanIndo = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
$periodeText = strtoupper($bulanIndo[$month] . ' ' . $year);

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

// 6. PDF Class
class PDF extends FPDF
{
    var $widths;
    var $aligns;
    var $tableHeaderCallback = null;
    var $isPrintingTable = false;

    // --- PERBAIKAN: Getter & Setter untuk properti Protected ---
    function setPageBreakTrigger($val)
    {
        $this->PageBreakTrigger = $val;
    }

    function getPageBreakTrigger()
    {
        return $this->PageBreakTrigger;
    }
    // -----------------------------------------------------------

    function SetWidths($w)
    {
        $this->widths = $w;
    }
    function SetAligns($a)
    {
        $this->aligns = $a;
    }

    function SetTableHeaderCallback($callback)
    {
        $this->tableHeaderCallback = $callback;
    }

    function ImageRemote($url, $x, $y, $w, $h)
    {
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
        } else {
            $this->SetXY($x, $y);
            $this->SetFont('Arial', 'I', 7);
            $this->Cell($w, $h, 'QR Error', 0, 0, 'C');
        }
    }

    function Header()
    {
        $path = '../images/instansi/';
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

        $this->Ln(6);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Hal ' . $this->PageNo() . '/{nb} | Sistem Informasi MTsN 1 Pandeglang | Dicetak: ' . date('d/m/Y H:i') . ' WIB', 0, 0, 'C');
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
        if ($this->GetY() + $h > $this->PageBreakTrigger) {
            $this->AddPage($this->CurOrientation);
            // Header Berulang
            if ($this->isPrintingTable && is_callable($this->tableHeaderCallback)) {
                call_user_func($this->tableHeaderCallback);
            }
        }
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

// MAIN SCRIPT
try {
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->SetMargins(10, 10, 10);
    $pdf->SetAutoPageBreak(false); // Matikan auto page break

    // PERBAIKAN: Gunakan fungsi setter yang kita buat di class PDF
    // 297 (Tinggi A4) - 20 (Margin Bawah) = 277
    $pdf->setPageBreakTrigger(277);

    $pdf->AddPage();

    // Queries
    $m = str_pad($month, 2, '0', STR_PAD_LEFT);
    $y = $year;

    // Data Counts
    $visits = $db->querySingle("SELECT value FROM global_stats WHERE key = 'site_visits'") ?: 0;
    $feedbackCount = $db->querySingle("SELECT COUNT(*) FROM feedback WHERE strftime('%m', created_at) = '$m' AND strftime('%Y', created_at) = '$y'") ?: 0;
    $surveyCount = $db->querySingle("SELECT COUNT(*) FROM survey_responses WHERE strftime('%m', created_at) = '$m' AND strftime('%Y', created_at) = '$y'") ?: 0;
    $articleViews = $db->querySingle("SELECT SUM(views) FROM post_stats") ?: 0;

    // Hitung Indeks
    $indices = $db->querySingle("SELECT 
        AVG(score_zi) as zi, 
        AVG(score_service) as service, 
        AVG(score_academic) as academic 
        FROM survey_responses 
        WHERE strftime('%m', created_at) = '$m' AND strftime('%Y', created_at) = '$y'", true);

    $idxZI = $indices ? round($indices['zi'] ?? 0, 2) : 0;
    $idxService = $indices ? round($indices['service'] ?? 0, 2) : 0;
    $idxAcademic = $indices ? round($indices['academic'] ?? 0, 2) : 0;

    $ikmValue = 0;
    if ($surveyCount > 0) {
        $ikmValue = round(($idxZI + $idxService + $idxAcademic) / 3, 2);
    }

    $avgRatingRaw = $db->querySingle("SELECT AVG(rating) FROM feedback WHERE strftime('%m', created_at) = '$m' AND strftime('%Y', created_at) = '$y'");
    $avgRatingVal = $avgRatingRaw ? round($avgRatingRaw, 2) : 0;
    $avgRatingText = ($avgRatingVal > 0) ? "$avgRatingVal / 5.00" : "-";

    function getPredikat($val)
    {
        if ($val >= 4.5) return "Sangat Baik (A)";
        if ($val >= 4.0) return "Baik (B)";
        if ($val >= 3.0) return "Cukup (C)";
        if ($val > 0) return "Kurang (D)";
        return "-";
    }
    $ikmText = ($ikmValue > 0) ? "$ikmValue / 5.00 (" . getPredikat($ikmValue) . ")" : "-";

    // === JUDUL ===
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 6, 'LAPORAN REKAPITULASI PELAYANAN DIGITAL', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 5, 'Periode Laporan: ' . $periodeText, 0, 1, 'C');
    $pdf->Ln(5);

    // ==========================================
    // TABEL 1: RINGKASAN TRAFIK
    // ==========================================

    $startX = 10;
    $startY = $pdf->GetY();
    $rowH = 7;
    $wQR = 35;
    $wTable1 = 155;

    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetFillColor(230, 230, 230);
    $pdf->Cell($wTable1, $rowH, ' I. RINGKASAN TRAFIK WEBSITE', 1, 0, 'L', true);

    $pdf->Cell($wQR, $rowH * 4, '', 1, 0, 'C');
    $qrContent = urlencode("MTSN1PDG|{$m}/{$y}|V:{$visits}|A:{$articleViews}|S:{$surveyCount}|F:{$feedbackCount}|IKM:{$ikmValue}");
    $qrUrl = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={$qrContent}&bgcolor=ffffff";
    $pdf->ImageRemote($qrUrl, ($startX + $wTable1) + 5.5, $startY + 2, 24, 24);

    $pdf->Ln($rowH);

    $wLabel = 65;
    $wValue = 90;
    $pdf->SetFont('Arial', '', 9);
    $pdf->SetFillColor(250, 250, 250);

    $pdf->Cell($wLabel, $rowH, ' Bulan Pelaporan', 1, 0, 'L', true);
    $pdf->Cell($wValue, $rowH, '  ' . $periodeText, 1, 1, 'L');
    $pdf->Cell($wLabel, $rowH, ' Total Kunjungan', 1, 0, 'L', true);
    $pdf->Cell($wValue, $rowH, '  ' . number_format($visits) . ' Pengunjung', 1, 1, 'L');
    $pdf->Cell($wLabel, $rowH, ' Total Artikel Dibaca', 1, 0, 'L', true);
    $pdf->Cell($wValue, $rowH, '  ' . number_format($articleViews) . ' Kali Dibaca', 1, 1, 'L');
    $pdf->Ln(5);

    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetFillColor(230, 230, 230);
    $pdf->Cell(190, $rowH, ' II. KUALITAS PELAYANAN & PARTISIPASI PUBLIK', 1, 1, 'L', true);

    $pdf->SetFont('Arial', '', 9);
    $pdf->SetFillColor(250, 250, 250);
    $wLabelFull = 70;
    $wValueFull = 120;

    $pdf->Cell($wLabelFull, $rowH, ' Jumlah Responden Survei', 1, 0, 'L', true);
    $pdf->Cell($wValueFull, $rowH, ' ' . number_format($surveyCount) . ' Orang', 1, 1, 'L');
    $pdf->Cell($wLabelFull, $rowH, ' Jumlah Ulasan Masuk', 1, 0, 'L', true);
    $pdf->Cell($wValueFull, $rowH, ' ' . number_format($feedbackCount) . ' Pesan', 1, 1, 'L');

    $wSub = 190 / 3;
    $pdf->Cell($wSub, $rowH, ' Indeks ZI: ' . ($idxZI > 0 ? $idxZI : '-'), 1, 0, 'C', true);
    $pdf->Cell($wSub, $rowH, ' Indeks Layanan: ' . ($idxService > 0 ? $idxService : '-'), 1, 0, 'C', true);
    $pdf->Cell($wSub, $rowH, ' Indeks Akademik: ' . ($idxAcademic > 0 ? $idxAcademic : '-'), 1, 1, 'C', true);

    $pdf->Cell($wLabelFull, $rowH, ' Rata-rata Rating Ulasan', 1, 0, 'L', true);
    $pdf->Cell($wValueFull, $rowH, ' ' . $avgRatingText, 1, 1, 'L');

    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetFillColor(240, 240, 240);
    $pdf->Cell($wLabelFull, $rowH, ' Indeks Kepuasan Masy. (IKM)', 1, 0, 'L', true);
    $pdf->Cell($wValueFull, $rowH, ' ' . $ikmText, 1, 1, 'L', true);

    $pdf->Ln(8);

    // ==========================================
    // A. DATA SURVEI
    // ==========================================

    $drawSurveyHeader = function () use ($pdf) {
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetFillColor(0, 150, 100);
        $pdf->SetTextColor(255);
        $pdf->Cell(8, 7, 'No', 1, 0, 'C', true);
        $pdf->Cell(35, 7, 'Waktu', 1, 0, 'C', true);
        $pdf->Cell(40, 7, 'Responden', 1, 0, 'L', true);
        $pdf->Cell(14, 7, 'ZI', 1, 0, 'C', true);
        $pdf->Cell(14, 7, 'LYN', 1, 0, 'C', true);
        $pdf->Cell(14, 7, 'AKD', 1, 0, 'C', true);
        $pdf->Cell(14, 7, 'IDX', 1, 0, 'C', true);
        $pdf->Cell(51, 7, 'Masukan', 1, 1, 'L', true);
        $pdf->SetTextColor(0);
        $pdf->SetFont('Arial', '', 8);
    };

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(0, 7, 'A. DATA DETAIL SURVEI KEPUASAN (Terlama -> Terbaru)', 0, 1, 'L');

    $pdf->SetWidths([8, 35, 40, 14, 14, 14, 14, 51]);
    $pdf->SetAligns(['C', 'C', 'L', 'C', 'C', 'C', 'C', 'L']);

    $drawSurveyHeader();
    $pdf->SetTableHeaderCallback($drawSurveyHeader);
    $pdf->isPrintingTable = true;

    // Sorting: ASC
    $resSurv = $db->query("SELECT * FROM survey_responses WHERE strftime('%m', created_at) = '$m' AND strftime('%Y', created_at) = '$y' ORDER BY created_at ASC");
    $no = 1;
    $found1 = false;
    while ($row = $resSurv->fetchArray(SQLITE3_ASSOC)) {
        $found1 = true;
        $idxIndividual = round(($row['score_zi'] + $row['score_service'] + $row['score_academic']) / 3, 2);
        $pdf->Row([$no++, formatFullTime($row['created_at']), $row['respondent_name'] . "\n(" . $row['respondent_role'] . ")", $row['score_zi'], $row['score_service'], $row['score_academic'], $idxIndividual, $row['feedback'] ?: '-']);
    }

    $pdf->isPrintingTable = false;

    if (!$found1) $pdf->Cell(190, 8, 'Tidak ada data pada periode ini.', 1, 1, 'C');
    $pdf->Ln(6);

    // ==========================================
    // B. DATA ULASAN
    // ==========================================

    $drawFeedbackHeader = function () use ($pdf) {
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetFillColor(255, 193, 7);
        $pdf->SetTextColor(0);
        $pdf->Cell(8, 7, 'No', 1, 0, 'C', true);
        $pdf->Cell(35, 7, 'Waktu', 1, 0, 'C', true);
        $pdf->Cell(45, 7, 'Nama', 1, 0, 'L', true);
        $pdf->Cell(20, 7, 'Rating', 1, 0, 'C', true);
        $pdf->Cell(82, 7, 'Pesan', 1, 1, 'L', true);
        $pdf->SetFont('Arial', '', 8);
    };

    $pdf->SetFont('Arial', 'B', 10);
    // PERBAIKAN: Gunakan Getter
    if ($pdf->GetY() + 15 > $pdf->getPageBreakTrigger()) $pdf->AddPage();

    $pdf->Cell(0, 7, 'B. DATA DETAIL ULASAN MASUK (Terlama -> Terbaru)', 0, 1, 'L');

    $pdf->SetWidths([8, 35, 45, 20, 82]);
    $pdf->SetAligns(['C', 'C', 'L', 'C', 'L']);

    $drawFeedbackHeader();
    $pdf->SetTableHeaderCallback($drawFeedbackHeader);
    $pdf->isPrintingTable = true;

    // Sorting: ASC
    $resFeed = $db->query("SELECT * FROM feedback WHERE strftime('%m', created_at) = '$m' AND strftime('%Y', created_at) = '$y' ORDER BY created_at ASC");
    $no = 1;
    $found2 = false;
    while ($row = $resFeed->fetchArray(SQLITE3_ASSOC)) {
        $found2 = true;
        $pdf->Row([$no++, formatFullTime($row['created_at']), $row['name'] ?: 'Anonim', $row['rating'] . ' / 5', $row['message'] ?: '-']);
    }

    $pdf->isPrintingTable = false;

    if (!$found2) $pdf->Cell(190, 8, 'Tidak ada data pada periode ini.', 1, 1, 'C');

    $pdf->Ln(8);

    // ==========================================
    // TANDA TANGAN (Smart Page Break)
    // ==========================================

    $signatureBlockHeight = 80;

    // PERBAIKAN: Gunakan Getter
    if ($pdf->GetY() + $signatureBlockHeight > $pdf->getPageBreakTrigger()) {
        $pdf->AddPage();
    }

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
    $pdf->Cell(70, 5, 'YAHYA ZULFIKRI', 0, 1, 'C');

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

    $pdf->Output('I', 'Laporan_Statistik_Website_' . $month . '_' . $year . '.pdf');
} catch (Exception $e) {
    die("PDF Error: " . $e->getMessage());
}
