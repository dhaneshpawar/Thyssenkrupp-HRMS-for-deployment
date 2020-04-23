<?php

require 'spreadsheet/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();

include("../api/db.php");

$collection = $db->tokens;
$cursor = $collection->find();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'User Photo');
$sheet->setCellValue('B1', 'Name');
$sheet->setCellValue('C1', 'Present Address');
$sheet->setCellValue('D1', 'Contact Number');
$sheet->setCellValue('E1', 'Email ID');
$sheet->setCellValue('F1', 'Date Of Birth');
$sheet->setCellValue('G1', 'Position applied for');
$sheet->setCellValue('H1', 'Location');
$sheet->setCellValue('I1', 'Passport Availability');
$sheet->setCellValue('J1', 'Highest Qualification');
$sheet->setCellValue('K1', 'Passing Out Year');
$sheet->setCellValue('L1', 'All Documents');
$sheet->setCellValue('M1', 'Experience');
$sheet->setCellValue('N1', 'Internet');
$sheet->setCellValue('O1', 'Employee');
$sheet->setCellValue('P1', 'Walk In');
$sheet->setCellValue('Q1', 'Web');
$sheet->setCellValue('R1', 'Other');
$sheet->setCellValue('S1', ' Date Of joining');
$sheet->setCellValue('T1', 'Notice Peroid In current organization');
$sheet->setCellValue('U1', 'Reporting Manager Name');
$sheet->setCellValue('V1', 'Reporting Manager Designation');
$sheet->setCellValue('W1', 'AadharCard');
$sheet->setCellValue('X1', 'PanCard');
$sheet->setCellValue('Y1', 'Proof for address');
$sheet->setCellValue('Z1', 'Fathers Name');
$sheet->setCellValue('AA1', 'Date Of Birth');
$sheet->setCellValue('AB1', 'Mothers Name');
$sheet->setCellValue('AC1', 'Date Of Birth');
$sheet->setCellValue('AD1', 'Spouse Name');
$sheet->setCellValue('AE1', 'Date Of Birth');
$sheet->setCellValue('AF1', 'Spouse Gender');
$sheet->setCellValue('AG1', 'Child 1 Name');
$sheet->setCellValue('AH1', 'Date Of Birth');
$sheet->setCellValue('AI1', 'Gender ');
$sheet->setCellValue('AJ1', 'Child 2 Name');
$sheet->setCellValue('AK1', 'Date Of Birth');
$sheet->setCellValue('AL1', 'Gender');
$sheet->setCellValue('AM1', 'Monthly Take Home (Present)');
$sheet->setCellValue('AN1', 'Monthly Take Home (Expected)');
$sheet->setCellValue('AO1', 'Monthly Gross (Present) ');
$sheet->setCellValue('AP1', 'Monthly Gross (Expected) ');
$sheet->setCellValue('AQ1', 'Yearly Gross (Present) ');
$sheet->setCellValue('AR1', 'Yearly Gross (Expected)');
$sheet->setCellValue('AS1', 'Reference1 Name ');
$sheet->setCellValue('AT1', 'Reference1 Designation');
$sheet->setCellValue('AU1', 'Reference1 Company Name ');
$sheet->setCellValue('AV1', 'Reference1 Contact Number ');
$sheet->setCellValue('AW1', 'Reference2 Name ');
$sheet->setCellValue('AX1', 'Reference2 Designation ');
$sheet->setCellValue('AY1', 'Reference2 Company Name ');
$sheet->setCellValue('AZ1', 'Reference2 Contact Number  ');

$n = 1;
	foreach($cursor as $row)
	{
		$rowNum = $n + 1;
        $sheet->setCellValue('A'.$rowNum, $n);
		$sheet->setCellValue('B'.$rowNum, $row['userphoto']);
		$sheet->setCellValue('C'.$rowNum, $row['username']);
		$sheet->setCellValue('D'.$rowNum, $row['address']);
		$sheet->setCellValue('E'.$rowNum, $row['number']);
		$sheet->setCellValue('F'.$rowNum, $row['email']);
		$sheet->setCellValue('G'.$rowNum, $row['dob']);
		$sheet->setCellValue('H'.$rowNum, $row['position']);
		$sheet->setCellValue('I'.$rowNum, $row['location']);
		$sheet->setCellValue('J'.$rowNum, $row['passport']);
		$sheet->setCellValue('K'.$rowNum, $row['qualification']);
		$sheet->setCellValue('L'.$rowNum, $row['passing']);
		$sheet->setCellValue('M'.$rowNum, $row['alldocs']);
		$sheet->setCellValue('N'.$rowNum, $row['exp']);
		$sheet->setCellValue('O'.$rowNum, $row['internet']);
		$sheet->setCellValue('P'.$rowNum, $row['checkemp']);
		$sheet->setCellValue('Q'.$rowNum, $row['walk']);
		$sheet->setCellValue('R'.$rowNum, $row['web']);
		$sheet->setCellValue('S'.$rowNum, $row['other']);
		$sheet->setCellValue('T'.$rowNum, $row['jdate']);
		$sheet->setCellValue('U'.$rowNum, $row['notice']);
		$sheet->setCellValue('V'.$rowNum, $row['manger']);
		$sheet->setCellValue('W'.$rowNum, $row['posifselect']);
		$sheet->setCellValue('X'.$rowNum, $row['proofidentityaadhar']);
		$sheet->setCellValue('Y'.$rowNum, $row['proofidentitypan']);
		$sheet->setCellValue('Z'.$rowNum, $row['proofaddr']);
		$sheet->setCellValue('AA'.$rowNum, $row['fathersname']);
		$sheet->setCellValue('AB'.$rowNum, $row['fdob']);
		$sheet->setCellValue('AC'.$rowNum, $row['mother']);
		$sheet->setCellValue('AD'.$rowNum, $row['mdob']);
		$sheet->setCellValue('AE'.$rowNum, $row['spousename']);
		$sheet->setCellValue('AF'.$rowNum, $row['spdob']);
		$sheet->setCellValue('AG'.$rowNum, $row['sgender']);
		$sheet->setCellValue('AH'.$rowNum, $row['child1']);
		$sheet->setCellValue('AI'.$rowNum, $row['ch1dob']);
		$sheet->setCellValue('AJ'.$rowNum, $row['ch1gender']);
		$sheet->setCellValue('AK'.$rowNum, $row['child2']);
		$sheet->setCellValue('AL'.$rowNum, $row['ch2dob']);
		$sheet->setCellValue('AM'.$rowNum, $row['ch2gender']);
		$sheet->setCellValue('AN'.$rowNum, $row['homepresent']);
		$sheet->setCellValue('AO'.$rowNum, $row['homeexpect']);
		$sheet->setCellValue('AP'.$rowNum, $row['grosspresent']);
		$sheet->setCellValue('AQ'.$rowNum, $row['grossexpect']);
		$sheet->setCellValue('AR'.$rowNum, $row['ypresent']);
		$sheet->setCellValue('AS'.$rowNum, $row['yexpect']);
		$sheet->setCellValue('AT'.$rowNum, $row['nameref1']);
		$sheet->setCellValue('AU'.$rowNum, $row['desigref1']);
		$sheet->setCellValue('AV'.$rowNum, $row['cmpn1']);
		$sheet->setCellValue('AW'.$rowNum, $row['cont1']);
		$sheet->setCellValue('AX'.$rowNum, $row['namerf2']);
		$sheet->setCellValue('AY'.$rowNum, $row['desgref2']);
		$sheet->setCellValue('AZ'.$rowNum, $row['cmpnref2']);
		$sheet->setCellValue('BA'.$rowNum, $row['contref2']);

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
       $spreadsheet->getActiveSheet()->setTitle('ApplicationBlank');
       $filename = 'ApplicationBlank-'.time().'.xlsx';

$writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
           $writer->save('export.xlsx');
           header('Content-Type: application/vnd.ms-excel');
           header('Content-Disposition: attachment; filename="'.$filename.'"');
           $writer->save("php://output");
           exit;

      
?>