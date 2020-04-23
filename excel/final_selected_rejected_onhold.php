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
$sheet->setCellValue('E1', 'Name');
$sheet->setCellValue('F1', 'Mail ID');
$sheet->setCellValue('G1', 'Status');
$n = 1;
foreach($cursor as $row)
{
    for($i=0;$i<count($row['selected']);$i++)
    {
        $member[$i] = $row['selected'][$i];
    
        $fullname =  $db->tokens->findOne(array("email"=>$member[$i]));
        
    
    $rownum = $n+1;
    $sheet->setCellValue('A'.$rownum , $row['prf']);
    $sheet->setCellValue('B'.$rownum , $row['pos']);
    $sheet->setCellValue('C'.$rownum , $row['iid']);                        
    $sheet->setCellValue('D'.$rownum , $row['rid']);
    $sheet->setCellValue('E'.$rownum , $fullname['full_name']);
    $sheet->setCellValue('F'.$rownum , $member[$i]);                        
    $sheet->setCellValue('G'.$rownum , 'selected');                        
    $n++;
    }
    for($i=0;$i<count($row['rejected']);$i++)
    {
        $member[$i] = $row['rejected'][$i];
        $fullname =  $db->tokens->findOne(array("email"=>$member[$i]));
    $rownum = $n+1;
    $sheet->setCellValue('A'.$rownum , $row['prf']);
    $sheet->setCellValue('B'.$rownum , $row['pos']);
    $sheet->setCellValue('C'.$rownum , $row['iid']);                        
    $sheet->setCellValue('D'.$rownum , $row['rid']);
    $sheet->setCellValue('E'.$rownum , $fullname['full_name']);                        
    $sheet->setCellValue('F'.$rownum , $member[$i]);                        
    $sheet->setCellValue('G'.$rownum , 'rejected');                        
    $n++;
    }
    for($i=0;$i<count($row['onhold']);$i++)
    {
        $member[$i] = $row['onhold'][$i];
        $fullname =  $db->tokens->findOne(array("email"=>$member[$i]));
    
    $rownum = $n+1;
    $sheet->setCellValue('A'.$rownum , $row['prf']);
    $sheet->setCellValue('B'.$rownum , $row['pos']);
    $sheet->setCellValue('C'.$rownum , $row['iid']);                        
    $sheet->setCellValue('D'.$rownum , $row['rid']);
    $sheet->setCellValue('E'.$rownum , $fullname['full_name']);                        
    $sheet->setCellValue('F'.$rownum , $member[$i]);                        
    $sheet->setCellValue('G'.$rownum , 'onhold');                        
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

$spreadsheet->getActiveSheet()->setTitle('Candidate details');
       $filename = 'CandidateDetails-'.time().'.xlsx';

$writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
ob_end_clean(); 
$writer->save('export.xlsx');
           header('Content-Type: application/vnd.ms-excel');
           header('Content-Disposition: attachment; filename="'.$filename.'"');
           $writer->save("php://output");
           exit;

?>