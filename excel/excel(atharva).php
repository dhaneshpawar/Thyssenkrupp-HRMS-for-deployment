<?php

require 'spreadsheet/vendor/autoload.php';
require_once('vendor/autoload.php');
$client = new MongoDB\Client;
$db = $client->hrmsdb;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();

$collection = $db->applicant;
$cursor = $collection->find();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'User Photo');
$sheet->setCellValue('B1', 'Name');
$sheet->setCellValue('C1', 'Present Address');
$sheet->setCellValue('D1', 'Contact Number');
$n = 1;
foreach($cursor as $row)
{
    $rownum = $n+1;
    $sheet->setCellValue('A'.$rownum , $row['userphoto']);
    $sheet->setCellValue('B'.$rownum , $row['username']);
    $sheet->setCellValue('C'.$rownum , $row['address']);
    $sheet->setCellValue('D'.$rownum , $row['number']);                         
    $n++;
}

$cell_st =[
 'font' =>['bold' => true],
 'alignment' =>['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
 'borders'=>['bottom' =>['style'=> \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM]]
];
$spreadsheet->getActiveSheet()->getStyle('A1:C1')->applyFromArray($cell_st);

//set columns width
$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(16);
$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(18);

$spreadsheet->getActiveSheet()->setTitle('CandidateInfo'); 

$writer = new Xlsx($spreadsheet);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="candidate.xlsx"');
$writer->save('php://output');
exit;

if($writer){
    echo "File Saved.. Check Folder";
}
else{
    echo "Some Error";
}

?>