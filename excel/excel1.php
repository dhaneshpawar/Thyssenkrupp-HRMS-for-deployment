<?php

require 'spreadsheet/vendor/autoload.php';
require_once('vendor/autoload.php');
$client = new MongoDB\Client;
$db = $client->hrms;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();

$collection = $db->rounds;
$cursor = $collection->find();

$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'PRF');
$sheet->setCellValue('B1', 'Position');
$sheet->setCellValue('C1', 'Instance ID');
$sheet->setCellValue('D1', 'Round ID');
$sheet->setCellValue('E1', 'Mail ID');
$sheet->setCellValue('F1', 'Status');
$n = 1;

// $p = $row['selected'];
foreach($cursor as $row)
{
    for($i=0;$i<count($row['selected']);$i++)
    {
        $member[$i] = $row['selected'][$i];
    
    $rownum = $n+1;
    $sheet->setCellValue('A'.$rownum , $row['prf']);
    $sheet->setCellValue('B'.$rownum , $row['pos']);
    $sheet->setCellValue('C'.$rownum , $row['iid']);                        
    $sheet->setCellValue('D'.$rownum , $row['rid']);                        
    $sheet->setCellValue('E'.$rownum , $member[$i]);                        
    $sheet->setCellValue('F'.$rownum , 'selected');                        
    $n++;
    }
    for($i=0;$i<count($row['rejected']);$i++)
    {
        $member[$i] = $row['rejected'][$i];
    
    $rownum = $n+1;
    $sheet->setCellValue('A'.$rownum , $row['prf']);
    $sheet->setCellValue('B'.$rownum , $row['pos']);
    $sheet->setCellValue('C'.$rownum , $row['iid']);                        
    $sheet->setCellValue('D'.$rownum , $row['rid']);                        
    $sheet->setCellValue('E'.$rownum , $member[$i]);                        
    $sheet->setCellValue('F'.$rownum , 'rejected');                        
    $n++;
    }
    for($i=0;$i<count($row['hold']);$i++)
    {
        $member[$i] = $row['hold'][$i];
    
    $rownum = $n+1;
    $sheet->setCellValue('A'.$rownum , $row['prf']);
    $sheet->setCellValue('B'.$rownum , $row['pos']);
    $sheet->setCellValue('C'.$rownum , $row['iid']);                        
    $sheet->setCellValue('D'.$rownum , $row['rid']);                        
    $sheet->setCellValue('E'.$rownum , $member[$i]);                        
    $sheet->setCellValue('F'.$rownum , 'Hold');                        
    $n++;
    }
}

$cell_st =[
 'font' =>['bold' => true],
 'alignment' =>['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
 'borders'=>['bottom' =>['style'=> \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM]]
];
$spreadsheet->getActiveSheet()->getStyle('A1:F1')->applyFromArray($cell_st);

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