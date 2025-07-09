<?php
// app/Helpers/export_helper.php
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (!function_exists('export_to_excel')) {
    function export_to_excel($data, $filename = 'laporan.xlsx') {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        // Header
        $sheet->fromArray(['No', 'ID Transaksi', 'Tanggal', 'User', 'Total Harga', 'Status'], NULL, 'A1');
        // Data
        $i = 2;
        foreach ($data as $idx => $row) {
            $sheet->setCellValue('A'.$i, $idx+1);
            $sheet->setCellValue('B'.$i, $row['id']);
            $sheet->setCellValue('C'.$i, $row['created_at']);
            $sheet->setCellValue('D'.$i, $row['username']);
            $sheet->setCellValue('E'.$i, $row['total_harga']);
            $sheet->setCellValue('F'.$i, [1=>'Paid',2=>'Shipped',3=>'Completed',4=>'Cancelled'][$row['status']] ?? '-');
            $i++;
        }
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
}
