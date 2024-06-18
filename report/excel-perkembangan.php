<?php 

session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location:../auth/login.php");
    exit;
}

require_once "../config.php";
require '../vendor/autoload.php'; // Include PHPSpreadsheet

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Create new Spreadsheet object
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set document properties
$spreadsheet->getProperties()->setCreator('Posyandu Bougenville')
    ->setLastModifiedBy('Posyandu Bougenville')
    ->setTitle('Laporan Perkembangan Balita')
    ->setSubject('Laporan Perkembangan Balita')
    ->setDescription('Laporan Perkembangan Balita dari Posyandu Bougenville')
    ->setKeywords('Posyandu Bougenville Laporan Perkembangan Balita')
    ->setCategory('Laporan');

// Add some data
$sheet->setCellValue('A1', 'No');
$sheet->setCellValue('B1', 'ID');
$sheet->setCellValue('C1', 'NIK');
$sheet->setCellValue('D1', 'Nama Balita');
$sheet->setCellValue('E1', 'Jenis Kelamin');
$sheet->setCellValue('F1', 'Umur');
$sheet->setCellValue('G1', 'Tanggal Periksa');
$sheet->setCellValue('H1', 'Berat Badan');
$sheet->setCellValue('I1', 'Tinggi Badan');
$sheet->setCellValue('J1', 'Status');

$no = 1;
$query = "
    SELECT 
        p.id_perkembangan, 
        b.nama AS nama_balita, 
        b.nik,
        b.jenis_kelamin,
        b.umur,
        p.tgl_periksa, 
        p.berat_badan, 
        p.tinggi_badan, 
        p.status 
    FROM 
        tbl_perkembangan p 
    LEFT JOIN 
        tbl_balita b ON p.nama_balita = b.nama
";
$result = mysqli_query($koneksi, $query);
$row = 2; // Starting row for data
while ($data = mysqli_fetch_array($result)) {
    $tgl_periksa = date('d-m-Y', strtotime($data['tgl_periksa']));

    $sheet->setCellValueExplicit('C' . $row, $data['nik'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
    
    $sheet->setCellValue('A' . $row, $no++);
    $sheet->setCellValue('B' . $row, $data['id_perkembangan']);
    $sheet->setCellValue('D' . $row, $data['nama_balita']);
    $sheet->setCellValue('E' . $row, $data['jenis_kelamin']);
    $sheet->setCellValue('F' . $row, $data['umur'] . ' tahun');
    $sheet->setCellValue('G' . $row, $tgl_periksa);
    $sheet->setCellValue('H' . $row, $data['berat_badan'] . ' kg');
    $sheet->setCellValue('I' . $row, $data['tinggi_badan'] . ' cm');
    $sheet->setCellValue('J' . $row, $data['status']);
    $row++;
}

// Auto size columns for each column
foreach (range('A', 'J') as $columnID) {
    $sheet->getColumnDimension($columnID)->setAutoSize(true);
}

// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Laporan_Perkembangan_Balita.xlsx"');
header('Cache-Control: max-age=0');
header('Cache-Control: max-age=1');

// If you're serving to IE 9, then the following may be needed
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // Always modified
header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header('Pragma: public'); // HTTP/1.0

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
?>
