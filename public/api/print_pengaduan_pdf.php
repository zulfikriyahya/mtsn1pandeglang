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

$month = isset($_GET['month']) ? (int)$_GET['month'] : (int)date('m');
$year = isset($_GET['year']) ? (int)$_GET['year'] : (int)date('Y');
$status = isset($_GET['status']) ? $_GET['status'] : 'all';

$bulanIndo = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
$periodeText = strtoupper($bulanIndo[$month] . ' ' . $year);

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

class PDF extends FPDF
{
    var $widths;
    var $aligns;
    var $tableHeaderCallback = null;
    var $isPrintingTable = false;

    function setPageBreakTrigger($val)
    {
        $this->PageBreakTrigger = $val;
    }

    function getPageBreakTrigger()
    {
        return $this->PageBreakTrigger;
    }

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
        $this->Cell(0, 10, 'Hal ' . $this->PageNo() . '/{nb} | Dicetak: ' . date('d/m/Y H:i') . ' WIB', 0, 0, 'C');
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
        if ($this->GetY() + $h > $this->PageBreakTrigger) {
            $this->AddPage($this->CurOrientation);
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

try {
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->SetMargins(10, 10, 10);
    $pdf->SetAutoPageBreak(false);
    $pdf->setPageBreakTrigger(277);
    $pdf->AddPage();

    // Filter query
    $whereClause = "WHERE MONTH(created_at) = :month AND YEAR(created_at) = :year";
    $params = [':month' => $month, ':year' => $year];

    if ($status !== 'all') {
        $whereClause .= " AND status = :status";
        $params[':status'] = $status;
    }

    // Stats
    $totalQuery = $pdo->prepare("SELECT COUNT(*) FROM pengaduan $whereClause");
    $totalQuery->execute($params);
    $totalPengaduan = $totalQuery->fetchColumn();

    $menunggu = $pdo->prepare("SELECT COUNT(*) FROM pengaduan $whereClause AND status = 'Menunggu'");
    $menunggu->execute($params);
    $jmlMenunggu = $menunggu->fetchColumn();

    $proses = $pdo->prepare("SELECT COUNT(*) FROM pengaduan $whereClause AND status = 'Proses'");
    $proses->execute($params);
    $jmlProses = $proses->fetchColumn();

    $selesai = $pdo->prepare("SELECT COUNT(*) FROM pengaduan $whereClause AND status = 'Selesai'");
    $selesai->execute($params);
    $jmlSelesai = $selesai->fetchColumn();

    // Header
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 6, 'LAPORAN PENGADUAN MASYARAKAT', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 5, 'Periode: ' . $periodeText, 0, 1, 'C');
    if ($status !== 'all') {
        $pdf->Cell(0, 5, 'Status: ' . strtoupper($status), 0, 1, 'C');
    }
    $pdf->Ln(5);

    // Statistik
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetFillColor(230, 230, 230);
    $pdf->Cell(190, 7, ' RINGKASAN STATISTIK', 1, 1, 'L', true);

    $pdf->SetFont('Arial', '', 9);
    $pdf->SetFillColor(250, 250, 250);
    $wLabel = 95;
    $wValue = 95;

    $pdf->Cell($wLabel, 7, ' Total Pengaduan', 1, 0, 'L', true);
    $pdf->Cell($wValue, 7, ' ' . $totalPengaduan . ' Pengaduan', 1, 1, 'L');

    $pdf->Cell($wLabel, 7, ' Status Menunggu', 1, 0, 'L', true);
    $pdf->Cell($wValue, 7, ' ' . $jmlMenunggu . ' Pengaduan', 1, 1, 'L');

    $pdf->Cell($wLabel, 7, ' Status Proses', 1, 0, 'L', true);
    $pdf->Cell($wValue, 7, ' ' . $jmlProses . ' Pengaduan', 1, 1, 'L');

    $pdf->Cell($wLabel, 7, ' Status Selesai', 1, 0, 'L', true);
    $pdf->Cell($wValue, 7, ' ' . $jmlSelesai . ' Pengaduan', 1, 1, 'L');

    $pdf->Ln(5);

    // Table Header Function
    $drawHeader = function () use ($pdf) {
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetFillColor(0, 120, 215);
        $pdf->SetTextColor(255);
        $pdf->Cell(8, 7, 'No', 1, 0, 'C', true);
        $pdf->Cell(28, 7, 'Tanggal', 1, 0, 'C', true);
        $pdf->Cell(35, 7, 'Nama', 1, 0, 'L', true);
        $pdf->Cell(25, 7, 'Kategori', 1, 0, 'C', true);
        $pdf->Cell(40, 7, 'Judul', 1, 0, 'L', true);
        $pdf->Cell(20, 7, 'Status', 1, 0, 'C', true);
        $pdf->Cell(34, 7, 'Tanggapan', 1, 1, 'L', true);
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
            $row['tanggapan'] ?: '-'
        ]);
    }

    $pdf->isPrintingTable = false;
    if (!$found) {
        $pdf->Cell(190, 8, 'Tidak ada data pada periode ini.', 1, 1, 'C');
    }

    $pdf->Ln(8);

    // Tanda Tangan
    $path = '../images/instansi/';
    $tglCetak = getIndonesianDate();
    $qrSize = 18;

    $pdf->Cell(95, 5, '', 0, 0);
    $pdf->Cell(95, 5, 'Pandeglang, ' . $tglCetak, 0, 1, 'C');
    $pdf->Ln(5);

    $pdf->Cell(95, 5, 'Kepala Tata Usaha,', 0, 0, 'C');
    $pdf->Cell(95, 5, 'Koordinator Tim Pusdatin,', 0, 1, 'C');

    $yImage = $pdf->GetY() + 1;
    if (file_exists($path . 'tte-kepala-tata-usaha.png'))
        $pdf->Image($path . 'tte-kepala-tata-usaha.png', 46, $yImage, $qrSize);
    if (file_exists($path . 'tte-koordinator-tim-pusdatin.png'))
        $pdf->Image($path . 'tte-koordinator-tim-pusdatin.png', 146, $yImage, $qrSize);

    $pdf->SetY($yImage + 19);
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(95, 5, "UMAR MU'TAMAR, S.Ag.", 0, 0, 'C');
    $pdf->Cell(95, 5, 'YAHYA ZULFIKRI', 0, 1, 'C');

    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(95, 4, 'NIP. 196903061998031004', 0, 0, 'C');
    $pdf->Cell(95, 4, 'NIP. 200001142025211016', 0, 1, 'C');

    $pdf->Output('I', 'Laporan_Pengaduan_' . $month . '_' . $year . '.pdf');
} catch (Exception $e) {
    die("PDF Error: " . $e->getMessage());
}
