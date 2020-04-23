<?php

require 'spreadsheet/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();

require 'db.php';

$collection = $db->intereval;
$cursor = $collection->find();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'Email');
$sheet->setCellValue('B1', 'Functional/Technical Knowledge');
$sheet->setCellValue('C1', 'Relevant Project/Functional Experience');
$sheet->setCellValue('D1', 'Major Strengths(Technical/Functional)');
$sheet->setCellValue('E1', 'Major Weaknesses(Technical/Functional)');
$sheet->setCellValue('F1', 'Any special areas probes');
$sheet->setCellValue('G1', 'Result Of Interview ');
$sheet->setCellValue('H1', 'If on-hold (Reason)');
$sheet->setCellValue('I1', 'If selected (Designation)');
$sheet->setCellValue('J1', 'If selected (Joining Date)');
$sheet->setCellValue('K1', 'Remarks, if any');


$n = 1;
	foreach($cursor as $row)
	{
		$rowNum = $n + 1;
        $sheet->setCellValue('A'.$rowNum, $n);
        $sheet->setCellValue('B'.$rowNum, $row['email']);
        $sheet->setCellValue('C'.$rowNum, $row['candidateknowledge']);
        $sheet->setCellValue('D'.$rowNum, $row['candidateexperience']);
        $sheet->setCellValue('E'.$rowNum, $row['candidatestrength']);
		$sheet->setCellValue('F'.$rowNum, $row['candidateweakness']);
		$sheet->setCellValue('G'.$rowNum, $row['candidatespecial']);
		$sheet->setCellValue('H'.$rowNum, $row['candidatereasonhold']);
		$sheet->setCellValue('I'.$rowNum, $row['candidatedesignation']);
		$sheet->setCellValue('J'.$rowNum, $row['jdate']);
		$sheet->setCellValue('K'.$rowNum, $row['remark']);
		
		$n++;
	}

    $cell_st =[
        'font' =>['bold' => true],
        'alignment' =>['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
        'borders'=>['bottom' =>['style'=> \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM]]
       ];
       $spreadsheet->getActiveSheet()->getStyle('A1:BZ1')->applyFromArray($cell_st);
       
       //set columns widthz
       for($i = 'A'; $i <= 'Z'; $i++)
       {
       $spreadsheet->getActiveSheet()->getColumnDimension($i)->setWidth(20);
       
       }
       $spreadsheet->getActiveSheet()->setTitle('EvaluationForm');
       $filename = 'EvaluationForm-'.time().'.xlsx';

$writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
           $writer->save('export.xlsx');
           header('Content-Type: application/vnd.ms-excel');
           header('Content-Disposition: attachment; filename="'.$filename.'"');
           $writer->save("php://output");
           exit;

      
?>