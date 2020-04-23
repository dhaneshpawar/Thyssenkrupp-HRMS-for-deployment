<?php

include 'spreadsheet/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();

include("../api/db.php");

$collection = $db->tokens;
$cursor = $collection->find();
$sheet = $spreadsheet->getActiveSheet();
//$sheet->setCellValue('A1', 'User Photo');
$sheet->setCellValue('A1', 'Name');
$sheet->setCellValue('B1', 'Present Address');
$sheet->setCellValue('C1', 'Contact Number');
$sheet->setCellValue('D1', 'Email ID');
$sheet->setCellValue('E1', 'Date Of Birth');
$sheet->setCellValue('F1', 'Position applied for');
$sheet->setCellValue('G1', 'Location');
$sheet->setCellValue('H1', 'Passport Availability');
$sheet->setCellValue('I1', 'Highest Qualification');
$sheet->setCellValue('J1', 'Passing Out Year');
//$sheet->setCellValue('L1', 'All Documents');
//$sheet->setCellValue('M1', 'Experience');
$sheet->setCellValue('K1', 'Internet');
$sheet->setCellValue('L1', 'Employee');
$sheet->setCellValue('M1', 'Walk In');
$sheet->setCellValue('N1', 'Web');
$sheet->setCellValue('O1', 'Other');
$sheet->setCellValue('P1', ' Date Of joining');
$sheet->setCellValue('Q1', 'Notice Peroid In current organization');
$sheet->setCellValue('R1', 'Reporting Manager Name');
//$sheet->setCellValue('V1', 'Reporting Manager Designation');
// $sheet->setCellValue('W1', 'AadharCard');
// $sheet->setCellValue('X1', 'PanCard');
// $sheet->setCellValue('Y1', 'Proof for address');
$sheet->setCellValue('S1', 'Fathers Name');
$sheet->setCellValue('T1', 'Date Of Birth');
$sheet->setCellValue('U1', 'Mothers Name');
$sheet->setCellValue('V1', 'Date Of Birth');
$sheet->setCellValue('W1', 'Spouse Name');
$sheet->setCellValue('X1', 'Date Of Birth');
$sheet->setCellValue('Y1', 'Spouse Gender');
$sheet->setCellValue('Z1', 'Child 1 Name');
$sheet->setCellValue('AA1', 'Date Of Birth');
$sheet->setCellValue('AB1', 'Gender ');
$sheet->setCellValue('AC1', 'Child 2 Name');
$sheet->setCellValue('AD1', 'Date Of Birth');
$sheet->setCellValue('AE1', 'Gender');
$sheet->setCellValue('AF1', 'Monthly Take Home (Present)');
$sheet->setCellValue('AG1', 'Monthly Take Home (Expected)');
$sheet->setCellValue('AH1', 'Monthly Gross (Present) ');
$sheet->setCellValue('AI1', 'Monthly Gross (Expected) ');
$sheet->setCellValue('AJ1', 'Yearly Gross (Present) ');
$sheet->setCellValue('AK1', 'Yearly Gross (Expected)');

$sheet->setCellValue('AL1', 'Reference Name');
$sheet->setCellValue('AM1', 'Reference Mail');
$sheet->setCellValue('AN1', 'Reference Designation');
$sheet->setCellValue('AO1', 'Reference Contact');
$sheet->setCellValue('AP1', 'Reference Company');

$sheet->setCellValue('AQ1', 'Organisation Name');
$sheet->setCellValue('AR1', 'Designation');
$sheet->setCellValue('AS1', 'From Date');
$sheet->setCellValue('AT1', 'To Date');
$sheet->setCellValue('AU1', 'Manager Name');
$sheet->setCellValue('AV1', 'Manager Email');


// $sheet->setCellValue('AS1', 'Reference1 Name ');
// $sheet->setCellValue('AT1', 'Reference1 Designation');
// $sheet->setCellValue('AU1', 'Reference1 Company Name ');
// $sheet->setCellValue('AV1', 'Reference1 Contact Number ');
// $sheet->setCellValue('AW1', 'Reference2 Name ');
// $sheet->setCellValue('AX1', 'Reference2 Designation ');
// $sheet->setCellValue('AY1', 'Reference2 Company Name ');
// $sheet->setCellValue('AZ1', 'Reference2 Contact Number  ');

$n = 1;
	foreach($cursor as $row)
	{

		$rowNum = $n + 1;
		$refname=$row['refname'];
		$refmail=$row['refmail'];
		$refdsg=$row['refdsg'];
		$refcontact=$row['refcontact'];
		$refcn=$row['refcn'];

		$managername=$row['managername'];
		$managermail=$row['managermail'];
		$fromdate=$row['fromdate'];
		$todate=$row['todate'];
		$orgname=$row['orgname'];
		$olddesg=$row['olddesignation0'];




		$sheet->setCellValue('A'.$rowNum, $row['full_name']);
		$sheet->setCellValue('B'.$rowNum, $row['address']);
		$sheet->setCellValue('C'.$rowNum, $row['number']);
		$sheet->setCellValue('D'.$rowNum, $row['email']);
		$sheet->setCellValue('E'.$rowNum, $row['dob']);
		$sheet->setCellValue('F'.$rowNum, $row['position']);
		$sheet->setCellValue('G'.$rowNum, $row['location']);
		$sheet->setCellValue('H'.$rowNum, $row['passport']);
		$sheet->setCellValue('I'.$rowNum, $row['qualification']);
		$sheet->setCellValue('J'.$rowNum, $row['passing']);
		$sheet->setCellValue('K'.$rowNum, $row['internet']);
		$sheet->setCellValue('L'.$rowNum, $row['checkemp']);
		$sheet->setCellValue('M'.$rowNum, $row['walk']);
		$sheet->setCellValue('N'.$rowNum, $row['web']);
		$sheet->setCellValue('O'.$rowNum, $row['other']);
		$sheet->setCellValue('P'.$rowNum, $row['jdate']);
		$sheet->setCellValue('Q'.$rowNum, $row['notice']);
		$sheet->setCellValue('R'.$rowNum, $row['manager']);
		$sheet->setCellValue('S'.$rowNum, $row['fathersname']);
		$sheet->setCellValue('T'.$rowNum, $row['fdob']);
		$sheet->setCellValue('U'.$rowNum, $row['mother']);
		$sheet->setCellValue('V'.$rowNum, $row['mdob']);
		$sheet->setCellValue('W'.$rowNum, $row['spousename']);
		$sheet->setCellValue('X'.$rowNum, $row['spdob']);
		$sheet->setCellValue('Y'.$rowNum, $row['sgender']);
		$sheet->setCellValue('Z'.$rowNum, $row['child1']);
		$sheet->setCellValue('AA'.$rowNum, $row['ch1dob']);
		$sheet->setCellValue('AB'.$rowNum, $row['ch1gender']);
		$sheet->setCellValue('AC'.$rowNum, $row['child2']);
		$sheet->setCellValue('AD'.$rowNum, $row['ch2dob']);
		$sheet->setCellValue('AE'.$rowNum, $row['ch2gender']);
		$sheet->setCellValue('AF'.$rowNum, $row['homepresent']);
		$sheet->setCellValue('AG'.$rowNum, $row['homeexpect']);
		$sheet->setCellValue('AH'.$rowNum, $row['grosspresent']);
		$sheet->setCellValue('AI'.$rowNum, $row['grossexpect']);
		$sheet->setCellValue('AJ'.$rowNum, $row['ypresent']);
		$sheet->setCellValue('AK'.$rowNum, $row['yexpect']);
		$numm=$rowNum;
		for ($i = 0; $i < count($refname); $i++) {
			
			$sheet->setCellValue('AL'.$numm,$refname[$i]);
			$numm++;
		}
		$numm1=$rowNum;
		for ($i = 0; $i < count($refmail); $i++) {
			
			$sheet->setCellValue('AM'.$numm1,$refmail[$i]);
			$numm1++;
		}
		$numm2=$rowNum;
		for ($i = 0; $i < count($refdsg); $i++) {
			
			$sheet->setCellValue('AN'.$numm2,$refdsg[$i]);
			$numm2++;
		}
		$numm3=$rowNum;
		for ($i = 0; $i < count($refcontact); $i++) {
			
			$sheet->setCellValue('AO'.$numm3,$refcontact[$i]);
			$numm3++;
		}
		$numm4=$rowNum;
		for ($i = 0; $i < count($refcn); $i++) {
			
			$sheet->setCellValue('AP'.$numm4,$refcn[$i]);
			$numm4++;
		}

		$expnum=$rowNum;
		for ($i = 0; $i < count($orgname); $i++) {
			
			$sheet->setCellValue('AQ'.$expnum,$orgname[$i]);
			$expnum++;
		}

		$expnum1=$rowNum;
		for ($i = 0; $i < count($olddesg); $i++) {
			
			$sheet->setCellValue('AR'.$expnum1,$olddesg[$i]);
			$expnum1++;
		}

		$expnum2=$rowNum;
		for ($i = 0; $i < count($fromdate); $i++) {
			
			$sheet->setCellValue('AS'.$expnum2,$fromdate[$i]);
			$expnum2++;
		}

		$expnum3=$rowNum;
		for ($i = 0; $i < count($todate); $i++) {
			
			$sheet->setCellValue('AT'.$expnum3,$todate[$i]);
			$expnum3++;
		}

		$expnum4=$rowNum;
		for ($i = 0; $i < count($managername); $i++) {
			
			$sheet->setCellValue('AU'.$expnum4,$managername[$i]);
			$expnum4++;
		}

		$expnum5=$rowNum;
		for ($i = 0; $i < count($managermail); $i++) {
			
			$sheet->setCellValue('AV'.$expnum5,$managermail[$i]);
			$expnum5++;
		}
		if(count($orgname)>count($refname)){
			$n+=count($orgname);
		}else{
			$n+=count($refname);
		}

		
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
ob_end_clean(); 
$writer->save('export.xlsx');
           header('Content-Type: application/vnd.ms-excel');
           header('Content-Disposition: attachment; filename="'.$filename.'"');
           $writer->save("php://output");
           exit;

      
?>