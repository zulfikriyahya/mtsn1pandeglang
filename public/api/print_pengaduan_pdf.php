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

$month  = isset($_GET['month'])  ? (int)$_GET['month']        : (int)date('m');
$year   = isset($_GET['year'])   ? (int)$_GET['year']         : (int)date('Y');
$status = isset($_GET['status']) ? trim($_GET['status'])       : 'all';

$bulanIndo   = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
$periodeText = strtoupper($bulanIndo[$month] . ' ' . $year);

// Whitelist status untuk keamanan
$validStatus = ['all', 'Menunggu', 'Proses', 'Selesai', 'Ditolak'];
if (!in_array($status, $validStatus)) $status = 'all';

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

    $pdf->Cell(95, 5, '', 0, 0);
    $pdf->Cell(95, 5, $signs['city'] . ', ' . $tglCetak, 0, 1, 'C');
    $pdf->Ln(5);

    $pdf->Cell(95, 5, $signs['tu']['role'],       0, 0, 'C');
    $pdf->Cell(95, 5, $signs['pusdatin']['role'],  0, 1, 'C');

    $yImg = $pdf->GetY() + 1;
    if (file_exists($signs['tu']['img']))       $pdf->Image($signs['tu']['img'],       46,  $yImg, $qrSize);
    if (file_exists($signs['pusdatin']['img'])) $pdf->Image($signs['pusdatin']['img'], 146, $yImg, $qrSize);

    $pdf->SetY($yImg + 19);
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(95, 5, $signs['tu']['name'],       0, 0, 'C');
    $pdf->Cell(95, 5, $signs['pusdatin']['name'], 0, 1, 'C');

    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(95, 4, 'NIP. ' . $signs['tu']['nip'],       0, 0, 'C');
    $pdf->Cell(95, 4, 'NIP. ' . $signs['pusdatin']['nip'], 0, 1, 'C');
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
    public array $widths  = [];
    public array $aligns  = [];
    public       $tableHeaderCallback = null;
    public bool  $isPrintingTable     = false;

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

    // --- QUERY DENGAN FILTER ---
    $whereClause = "WHERE MONTH(created_at) = :month AND YEAR(created_at) = :year";
    $params      = [':month' => $month, ':year' => $year];

    if ($status !== 'all') {
        $whereClause       .= " AND status = :status";
        $params[':status']  = $status;
    }

    // Stats — satu query GROUP BY, lebih efisien dari 4 query terpisah
    $statsStmt = $pdo->prepare(
        "SELECT
            COUNT(*) as total,
            SUM(status = 'Menunggu') as menunggu,
            SUM(status = 'Proses')   as proses,
            SUM(status = 'Selesai')  as selesai,
            SUM(status = 'Ditolak')  as ditolak
         FROM pengaduan $whereClause"
    );
    $statsStmt->execute($params);
    $stats = $statsStmt->fetch();

    // --- JUDUL ---
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 6, 'LAPORAN PENGADUAN MASYARAKAT', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 5, 'Periode: ' . $periodeText, 0, 1, 'C');
    if ($status !== 'all') {
        $pdf->Cell(0, 5, 'Filter Status: ' . strtoupper($status), 0, 1, 'C');
    }
    $pdf->Ln(5);

    // --- RINGKASAN STATISTIK ---
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetFillColor(230, 230, 230);
    $pdf->Cell(190, 7, ' RINGKASAN STATISTIK', 1, 1, 'L', true);

    $pdf->SetFont('Arial', '', 9);
    $pdf->SetFillColor(250, 250, 250);
    $wL = 95;
    $wV = 95;

    foreach (
        [
            [' Total Pengaduan',   $stats['total']    . ' Pengaduan'],
            [' Status Menunggu',   $stats['menunggu'] . ' Pengaduan'],
            [' Status Proses',     $stats['proses']   . ' Pengaduan'],
            [' Status Selesai',    $stats['selesai']  . ' Pengaduan'],
            [' Status Ditolak',    $stats['ditolak']  . ' Pengaduan'],
        ] as [$label, $value]
    ) {
        $pdf->Cell($wL, 7, $label,        1, 0, 'L', true);
        $pdf->Cell($wV, 7, ' ' . $value,  1, 1, 'L');
    }
    $pdf->Ln(5);

    // --- TABEL DETAIL ---
    $drawHeader = function () use ($pdf) {
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetFillColor(0, 120, 215);
        $pdf->SetTextColor(255);
        foreach (
            [
                [8,  'No',        'C'],
                [28, 'Tanggal',   'C'],
                [35, 'Nama',      'L'],
                [25, 'Kategori',  'C'],
                [40, 'Judul',     'L'],
                [20, 'Status',    'C'],
                [34, 'Tanggapan', 'L'],
            ] as [$w, $label, $align]
        ) {
            $pdf->Cell($w, 7, $label, 1, 0, $align, true);
        }
        $pdf->Ln(7);
        $pdf->SetTextColor(0);
        $pdf->SetFont('Arial', '', 7);
    };

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(0, 7, 'DETAIL PENGADUAN', 0, 1, 'L');
    $pdf->SetWidths([8, 28, 35, 25, 40, 20, 34]);
    $pdf->SetAligns(['C', 'C', 'L', 'C', 'L', 'C', 'L']);
    $drawHeader();
    $pdf->SetTableHeaderCallback($drawHeader);
    $pdf->isPrintingTable = true;

    $stmt = $pdo->prepare("SELECT * FROM pengaduan $whereClause ORDER BY created_at DESC");
    $stmt->execute($params);

    $no = 1;
    $found = false;
    while ($row = $stmt->fetch()) {
        $found = true;
        $pdf->Row([
            $no++,
            formatFullTime($row['created_at']),
            $row['nama'] . "\n" . $row['email'],
            $row['kategori'],
            $row['judul'],
            $row['status'],
            $row['tanggapan'] ?: '-',
        ]);
    }
    $pdf->isPrintingTable = false;

    if (!$found) {
        $pdf->Cell(190, 8, 'Tidak ada data pada periode ini.', 1, 1, 'C');
    }
    $pdf->Ln(8);

    // --- TANDA TANGAN ---
    if ($pdf->GetY() + 80 > $pdf->getPageBreakTrigger()) $pdf->AddPage();
    $signs = getSignatories();
    renderSignatureBlock($pdf, $signs, getIndonesianDate());

    $pdf->Output('I', 'Laporan_Pengaduan_' . $month . '_' . $year . '.pdf');
} catch (Exception $e) {
    die("PDF Error: " . $e->getMessage());
}
