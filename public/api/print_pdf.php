<?php
ini_set('display_errors', 0);
ini_set('log_errors', 1);
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once __DIR__ . '/config.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    die("Akses Ditolak.");
}
if (!file_exists(__DIR__ . '/lib/fpdf.php')) {
    die("Error: Library FPDF tidak ditemukan.");
}
require('lib/fpdf.php');

try {
    $pdo = getDBConnection();
} catch (Exception $e) {
    die("Error DB: " . $e->getMessage());
}

$month      = isset($_GET['month']) ? (int)$_GET['month'] : (int)date('m');
$year       = isset($_GET['year'])  ? (int)$_GET['year']  : (int)date('Y');
$bulanIndo  = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
$periodeText = strtoupper($bulanIndo[$month] . ' ' . $year);

// --- HELPERS ---
function getIndonesianDate(?string $timestamp = null): string
{
    $dt    = new DateTime($timestamp ?? 'now');
    $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    return $dt->format('d') . ' ' . $bulan[(int)$dt->format('m')] . ' ' . $dt->format('Y');
}

function formatFullTime(string $timestamp): string
{
    return getIndonesianDate($timestamp) . ' ' . date('H:i', strtotime($timestamp)) . ' WIB';
}

function renderSignatureBlock(object $pdf, array $signs, string $tglCetak): void
{
    $qrSize = 18;
    $yStart = $pdf->GetY();

    $pdf->SetXY(120, $yStart);
    $pdf->SetFont('Arial', '', 11);
    $pdf->Cell(70, 5, $signs['city'] . ', ' . $tglCetak, 0, 1, 'C');
    $pdf->Ln(5);

    $yJabatan = $pdf->GetY();
    $pdf->SetXY(20,  $yJabatan);
    $pdf->Cell(70, 5, $signs['tu']['role'], 0, 0, 'C');
    $pdf->SetXY(120, $yJabatan);
    $pdf->Cell(70, 5, $signs['pusdatin']['role'], 0, 1, 'C');

    $yImg = $pdf->GetY() + 1;
    if (file_exists($signs['tu']['img']))       $pdf->Image($signs['tu']['img'],       46,  $yImg, $qrSize);
    if (file_exists($signs['pusdatin']['img'])) $pdf->Image($signs['pusdatin']['img'], 146, $yImg, $qrSize);

    $pdf->SetY($yImg + 19);
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->SetX(20);
    $pdf->Cell(70, 5, $signs['tu']['name'],       0, 0, 'C');
    $pdf->SetX(120);
    $pdf->Cell(70, 5, $signs['pusdatin']['name'], 0, 1, 'C');

    $pdf->SetFont('Arial', '', 10);
    $pdf->SetX(20);
    $pdf->Cell(70, 4, 'NIP. ' . $signs['tu']['nip'],       0, 0, 'C');
    $pdf->SetX(120);
    $pdf->Cell(70, 4, 'NIP. ' . $signs['pusdatin']['nip'], 0, 1, 'C');
    $pdf->Ln(8);

    $pdf->SetFont('Arial', '', 11);
    $pdf->Cell(0, 5, 'Mengetahui,',          0, 1, 'C');
    $pdf->Cell(0, 5, $signs['kamad']['role'], 0, 1, 'C');

    $yKamad = $pdf->GetY() + 1;
    if (file_exists($signs['kamad']['img'])) $pdf->Image($signs['kamad']['img'], 96, $yKamad, $qrSize);

    $pdf->SetY($yKamad + 19);
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(0, 5, $signs['kamad']['name'], 0, 1, 'C');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 4, 'NIP. ' . $signs['kamad']['nip'], 0, 1, 'C');
}

// --- PDF CLASS ---
class PDF extends FPDF
{
    public array  $widths  = [];
    public array  $aligns  = [];
    public        $tableHeaderCallback = null;
    public bool   $isPrintingTable     = false;

    public function setPageBreakTrigger(float $val): void
    {
        $this->PageBreakTrigger = $val;
    }
    public function getPageBreakTrigger(): float
    {
        return $this->PageBreakTrigger;
    }
    public function SetWidths(array $w): void
    {
        $this->widths = $w;
    }
    public function SetAligns(array $a): void
    {
        $this->aligns = $a;
    }
    public function SetTableHeaderCallback(callable $cb): void
    {
        $this->tableHeaderCallback = $cb;
    }

    public function ImageRemote(string $url, float $x, float $y, float $w, float $h): void
    {
        $tmp = sys_get_temp_dir() . '/qr_' . md5($url) . '.png';
        if (!file_exists($tmp) || filesize($tmp) === 0) {
            $ch = curl_init($url);
            $fp = fopen($tmp, 'wb');
            curl_setopt_array($ch, [
                CURLOPT_FILE           => $fp,
                CURLOPT_HEADER         => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_USERAGENT      => 'Mozilla/5.0',
                CURLOPT_TIMEOUT        => 10,
                CURLOPT_SSL_VERIFYPEER => false,
            ]);
            $code = curl_getinfo(curl_exec($ch) ? $ch : $ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            fclose($fp);
        }
        if (file_exists($tmp) && filesize($tmp) > 0) {
            $this->Image($tmp, $x, $y, $w, $h);
        } else {
            $this->SetXY($x, $y);
            $this->SetFont('Arial', 'I', 7);
            $this->Cell($w, $h, 'QR Error', 0, 0, 'C');
        }
    }

    public function Header(): void
    {
        $path = '../images/instansi/';
        $sz   = 24;
        if (file_exists($path . 'logo-institusi.png')) $this->Image($path . 'logo-institusi.png', 10,  10, $sz);
        if (file_exists($path . 'logo-instansi.png'))  $this->Image($path . 'logo-instansi.png',  176, 10, $sz);

        $this->SetY(12);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 5, 'KEMENTERIAN AGAMA REPUBLIK INDONESIA', 0, 1, 'C');
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 6, 'KANTOR KEMENTERIAN AGAMA KABUPATEN PANDEGLANG', 0, 1, 'C');
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 6, 'MADRASAH TSANAWIYAH NEGERI 1 PANDEGLANG', 0, 1, 'C');
        $this->SetFont('Arial', '',   9);
        $this->Cell(0, 4, 'Jl. Raya Labuan Km. 5,7 Palurahan, Kaduhejo, Pandeglang - Banten 42253', 0, 1, 'C');
        $this->Cell(0, 4, 'Website: https://mtsn1pandeglang.sch.id | Email: adm@mtsn1pandeglang.sch.id', 0, 1, 'C');

        $this->SetLineWidth(0.5);
        $this->Line(10, 39, 200, 39);
        $this->SetLineWidth(0.2);
        $this->Line(10, 40, 200, 40);
        $this->Ln(6);
    }

    public function Footer(): void
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Hal ' . $this->PageNo() . '/{nb} | Sistem Informasi MTsN 1 Pandeglang | Dicetak: ' . date('d/m/Y H:i') . ' WIB', 0, 0, 'C');
    }

    public function Row(array $data, bool $fill = false): void
    {
        $nb = 0;
        for ($i = 0; $i < count($data); $i++) {
            $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        }
        $h = 5 * $nb;
        $this->CheckPageBreak($h);
        for ($i = 0; $i < count($data); $i++) {
            $w = $this->widths[$i];
            $a = $this->aligns[$i] ?? 'L';
            $x = $this->GetX();
            $y = $this->GetY();
            $this->Rect($x, $y, $w, $h, $fill ? 'DF' : 'D');
            $this->MultiCell($w, 5, $data[$i], 0, $a);
            $this->SetXY($x + $w, $y);
        }
        $this->Ln($h);
    }

    public function CheckPageBreak(float $h): void
    {
        if ($this->GetY() + $h > $this->PageBreakTrigger) {
            $this->AddPage($this->CurOrientation);
            if ($this->isPrintingTable && is_callable($this->tableHeaderCallback)) {
                call_user_func($this->tableHeaderCallback);
            }
        }
    }

    public function NbLines(float $w, string $txt): int
    {
        $cw   = &$this->CurrentFont['cw'];
        if ($w == 0) $w = $this->w - $this->rMargin - $this->x;
        $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
        $s    = str_replace("\r", '', $txt);
        $nb   = strlen($s);
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

// --- GENERATE PDF ---
try {
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->SetMargins(10, 10, 10);
    $pdf->SetAutoPageBreak(false);
    $pdf->setPageBreakTrigger(277);
    $pdf->AddPage();

    $m = str_pad($month, 2, '0', STR_PAD_LEFT);

    // Ambil data statistik
    $visits       = (int)($pdo->query("SELECT value FROM global_stats WHERE `key` = 'site_visits'")->fetchColumn() ?: 0);
    $feedbackCount = (int)($pdo->query("SELECT COUNT(*) FROM feedback WHERE MONTH(created_at) = $m AND YEAR(created_at) = $year")->fetchColumn() ?: 0);
    $surveyCount   = (int)($pdo->query("SELECT COUNT(*) FROM survey_responses WHERE MONTH(created_at) = $m AND YEAR(created_at) = $year")->fetchColumn() ?: 0);
    $articleViews  = (int)($pdo->query("SELECT SUM(views) FROM post_stats")->fetchColumn() ?: 0);

    $indices = $pdo->query(
        "SELECT AVG(score_zi) as zi, AVG(score_service) as service,
                AVG(score_academic) as academic, AVG(score_facilities) as facilities,
                AVG(score_management) as management, AVG(score_culture) as culture
         FROM survey_responses
         WHERE MONTH(created_at) = $m AND YEAR(created_at) = $year"
    )->fetch();

    $idx = [];
    foreach (['zi', 'service', 'academic', 'facilities', 'management', 'culture'] as $k) {
        $idx[$k] = $indices ? round((float)($indices[$k] ?? 0), 2) : 0;
    }

    $ikmValue = $surveyCount > 0
        ? round(array_sum($idx) / count($idx), 2)
        : 0;

    $avgRatingRaw = $pdo->query(
        "SELECT AVG(rating) FROM feedback WHERE MONTH(created_at) = $m AND YEAR(created_at) = $year"
    )->fetchColumn();
    $avgRatingVal  = $avgRatingRaw ? round((float)$avgRatingRaw, 2) : 0;
    $avgRatingText = $avgRatingVal > 0 ? "$avgRatingVal / 5.00" : "-";

    function getPredikat(float $val): string
    {
        if ($val >= 4.5) return "Sangat Baik (A)";
        if ($val >= 4.0) return "Baik (B)";
        if ($val >= 3.0) return "Cukup (C)";
        if ($val >  0)   return "Kurang (D)";
        return "-";
    }

    $ikmText = $ikmValue > 0 ? "$ikmValue / 5.00 (" . getPredikat($ikmValue) . ")" : "-";

    // --- JUDUL ---
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 6, 'LAPORAN REKAPITULASI PELAYANAN DIGITAL', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 5, 'Periode Laporan: ' . $periodeText, 0, 1, 'C');
    $pdf->Ln(5);

    // --- SEKSI I: TRAFIK ---
    $startY  = $pdf->GetY();
    $rowH    = 7;
    $wQR     = 35;
    $wTable1 = 155;

    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetFillColor(230, 230, 230);
    $pdf->Cell($wTable1, $rowH, ' I. RINGKASAN TRAFIK WEBSITE', 1, 0, 'L', true);
    $pdf->Cell($wQR, $rowH * 4, '', 1, 0, 'C');

    $qrContent = urlencode("MTSN1PDG|{$m}/{$year}|V:{$visits}|A:{$articleViews}|S:{$surveyCount}|F:{$feedbackCount}|IKM:{$ikmValue}");
    $qrUrl     = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={$qrContent}&bgcolor=ffffff";
    $pdf->ImageRemote($qrUrl, (10 + $wTable1) + 5.5, $startY + 2, 24, 24);
    $pdf->Ln($rowH);

    $wLabel = 65;
    $wValue = 90;
    $pdf->SetFont('Arial', '', 9);
    $pdf->SetFillColor(250, 250, 250);

    foreach (
        [
            [' Bulan Pelaporan',      '  ' . $periodeText],
            [' Total Kunjungan',      '  ' . number_format($visits) . ' Pengunjung'],
            [' Total Artikel Dibaca', '  ' . number_format($articleViews) . ' Kali Dibaca'],
        ] as [$label, $value]
    ) {
        $pdf->Cell($wLabel, $rowH, $label, 1, 0, 'L', true);
        $pdf->Cell($wValue, $rowH, $value, 1, 1, 'L');
    }
    $pdf->Ln(5);

    // --- SEKSI II: KUALITAS PELAYANAN ---
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetFillColor(230, 230, 230);
    $pdf->Cell(190, $rowH, ' II. KUALITAS PELAYANAN & PARTISIPASI PUBLIK', 1, 1, 'L', true);
    $pdf->SetFont('Arial', '', 9);
    $pdf->SetFillColor(250, 250, 250);

    $wLF = 70;
    $wVF = 120;
    foreach (
        [
            [' Jumlah Ulasan Masuk',      ' ' . number_format($feedbackCount) . ' Pesan'],
            [' Rata-rata Rating Ulasan',   ' ' . $avgRatingText],
            [' Jumlah Responden Survei',   ' ' . number_format($surveyCount) . ' Orang'],
        ] as [$label, $value]
    ) {
        $pdf->Cell($wLF, $rowH, $label, 1, 0, 'L', true);
        $pdf->Cell($wVF, $rowH, $value, 1, 1, 'L');
    }

    $wSub = 190 / 3;
    $idxLabels = [
        'zi'         => 'Indeks ZI',
        'service'    => 'Indeks Layanan',
        'academic'   => 'Indeks Akademik',
        'facilities' => 'Indeks Sarpras',
        'management' => 'Indeks Manajemen',
        'culture'    => 'Indeks Budaya',
    ];
    $idxKeys = array_keys($idxLabels);
    for ($i = 0; $i < 6; $i += 3) {
        for ($j = $i; $j < $i + 3; $j++) {
            $k    = $idxKeys[$j];
            $val  = $idx[$k] > 0 ? $idx[$k] : '-';
            $eol  = ($j % 3 === 2) ? 1 : 0;
            $pdf->Cell($wSub, $rowH, ' ' . $idxLabels[$k] . ': ' . $val, 1, $eol, 'C', true);
        }
    }

    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetFillColor(240, 240, 240);
    $pdf->Cell($wLF, $rowH, ' Indeks Kepuasan Masy. (IKM)', 1, 0, 'L', true);
    $pdf->Cell($wVF, $rowH, ' ' . $ikmText, 1, 1, 'L', true);
    $pdf->Ln(5);

    // --- TABEL A: SURVEI ---
    $drawSurveyHeader = function () use ($pdf) {
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetFillColor(0, 150, 100);
        $pdf->SetTextColor(255);
        foreach (
            [
                [8, 'No', 'C'],
                [30, 'Waktu', 'C'],
                [35, 'Nama', 'L'],
                [9, 'ZI', 'C'],
                [9, 'LYN', 'C'],
                [9, 'AKD', 'C'],
                [9, 'SAR', 'C'],
                [9, 'MGT', 'C'],
                [9, 'BUD', 'C'],
                [10, 'IDX', 'C'],
                [53, 'Masukan', 'L'],
            ] as [$w, $label, $align]
        ) {
            $pdf->Cell($w, 7, $label, 1, 0, $align, true);
        }
        $pdf->Ln(7);
        $pdf->SetTextColor(0);
        $pdf->SetFont('Arial', '', 7);
    };

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(0, 7, 'A. DATA DETAIL SURVEI KEPUASAN', 0, 1, 'L');
    $pdf->SetWidths([8, 30, 35, 9, 9, 9, 9, 9, 9, 10, 53]);
    $pdf->SetAligns(['C', 'C', 'L', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'L']);
    $drawSurveyHeader();
    $pdf->SetTableHeaderCallback($drawSurveyHeader);
    $pdf->isPrintingTable = true;

    $resSurv = $pdo->query(
        "SELECT * FROM survey_responses
         WHERE MONTH(created_at) = $m AND YEAR(created_at) = $year
         ORDER BY created_at ASC"
    );
    $no = 1;
    $found1 = false;
    while ($row = $resSurv->fetch()) {
        $found1 = true;
        $idxInd = round(
            ($row['score_zi'] + $row['score_service'] + $row['score_academic'] +
                $row['score_facilities'] + $row['score_management'] + $row['score_culture']) / 6,
            2
        );
        $pdf->Row([
            $no++,
            formatFullTime($row['created_at']),
            $row['respondent_name'] . "\n(" . $row['respondent_role'] . ")",
            $row['score_zi'],
            $row['score_service'],
            $row['score_academic'],
            $row['score_facilities'],
            $row['score_management'],
            $row['score_culture'],
            $idxInd,
            $row['feedback'] ?: '-',
        ]);
    }
    $pdf->isPrintingTable = false;
    if (!$found1) $pdf->Cell(190, 8, 'Tidak ada data pada periode ini.', 1, 1, 'C');
    $pdf->Ln(6);

    // --- TABEL B: ULASAN ---
    $drawFeedbackHeader = function () use ($pdf) {
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetFillColor(255, 193, 7);
        $pdf->SetTextColor(0);
        foreach (
            [
                [8, 'No', 'C'],
                [35, 'Waktu', 'C'],
                [45, 'Nama Lengkap', 'L'],
                [20, 'Rating', 'C'],
                [82, 'Pesan', 'L'],
            ] as [$w, $label, $align]
        ) {
            $pdf->Cell($w, 7, $label, 1, 0, $align, true);
        }
        $pdf->Ln(7);
        $pdf->SetFont('Arial', '', 8);
    };

    if ($pdf->GetY() + 15 > $pdf->getPageBreakTrigger()) $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(0, 7, 'B. DATA DETAIL ULASAN MASUK', 0, 1, 'L');
    $pdf->SetWidths([8, 35, 45, 20, 82]);
    $pdf->SetAligns(['C', 'C', 'L', 'C', 'L']);
    $drawFeedbackHeader();
    $pdf->SetTableHeaderCallback($drawFeedbackHeader);
    $pdf->isPrintingTable = true;

    $resFeed = $pdo->query(
        "SELECT * FROM feedback
         WHERE MONTH(created_at) = $m AND YEAR(created_at) = $year
         ORDER BY created_at ASC"
    );
    $no = 1;
    $found2 = false;
    while ($row = $resFeed->fetch()) {
        $found2 = true;
        $pdf->Row([
            $no++,
            formatFullTime($row['created_at']),
            $row['name'] ?: 'Anonim',
            $row['rating'] . ' / 5',
            $row['message'] ?: '-',
        ]);
    }
    $pdf->isPrintingTable = false;
    if (!$found2) $pdf->Cell(190, 8, 'Tidak ada data pada periode ini.', 1, 1, 'C');
    $pdf->Ln(8);

    // --- TANDA TANGAN ---
    if ($pdf->GetY() + 80 > $pdf->getPageBreakTrigger()) $pdf->AddPage();
    $signs = getSignatories();
    renderSignatureBlock($pdf, $signs, getIndonesianDate());

    $pdf->Output('I', 'Laporan_Statistik_Website_' . $month . '_' . $year . '.pdf');
} catch (Exception $e) {
    die("PDF Error: " . $e->getMessage());
}
