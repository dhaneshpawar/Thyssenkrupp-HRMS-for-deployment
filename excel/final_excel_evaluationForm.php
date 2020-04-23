<?php

require 'spreadsheet/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();

require 'db.php';

$collection = $db->intereval;
$cursor = $collection->find();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'PRF-POSITION-INSTANCE-ROUND');
$sheet->setCellValue('B1', 'Full Name');
$sheet->setCellValue('C1', 'Email');
$sheet->setCellValue('D1', 'Functional/Technical Knowledge');
$sheet->setCellValue('E1', 'Relevant Project/Functional Experience');
$sheet->setCellValue('F1', 'Major Strengths(Technical/Functional)');
$sheet->setCellValue('G1', 'Major Weaknesses(Technical/Functional)');
$sheet->setCellValue('H1', 'Any special areas probes');
$sheet->setCellValue('I1', 'Result Of Interview ');
$sheet->setCellValue('J1', 'If on-hold (Reason)');
$sheet->setCellValue('K1', 'If selected (Designation)');
$sheet->setCellValue('L1', 'If selected (Joining Date)');
$sheet->setCellValue('M1', 'Remarks, if any');


$n = 1;
	foreach($cursor as $row)
	{
		$rowNum = $n + 1;
        $id=array($row['prf'],$row['pos'],$row['iid'],$row['rid']);
        $id=implode("-",$id);
        $fullname =  $db->tokens->findOne(array("email"=>$row['email']));

        $sheet->setCellValue('A'.$rowNum, $id);
        $sheet->setCellValue('B'.$rowNum, $fullname['full_name']);
        $sheet->setCellValue('C'.$rowNum, $row['email']);
        $sheet->setCellValue('D'.$rowNum, $row['candidateknowledge']);
        $sheet->setCellValue('E'.$rowNum, $row['candidateexperience']);
        $sheet->setCellValue('F'.$rowNum, $row['candidatestrength']);
		$sheet->setCellValue('G'.$rowNum, $row['candidateweakness']);
		$sheet->setCellValue('H'.$rowNum, $row['candidatespecial']);
        $sheet->setCellValue('I'.$rowNum, $row['result']);    
		$sheet->setCellValue('J'.$rowNum, $row['candidatereasonhold']);
		$sheet->setCellValue('K'.$rowNum, $row['candidatedesignation']);
        $sheet->setCellValue('L'.$rowNum, $row['date']);
        $sheet->setCellValue('M'.$rowNum, $row['remark']);
        $sheet->setCellValue('N'.$rowNum, $fullname['full_name']);
	
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