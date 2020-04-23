<?php 
require 'spreadsheet/vendor/autoload.php';
                    
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();

require 'api/db.php';

// error_reporting(0);

$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));

$collection = $db->rounds;

if($cursor)
{
    if($cursor)
    {
        if(strlen($_POST["prf"]) > 0 and strlen($_POST["iid"]) <= 0 and strlen($_POST["rid"]) <= 0)
        {
            $cursor = $db->rounds->find(array("rg"=>$cursor["rg"],"prf"=>$_POST['prf'],"dept"=>$_POST['dept'],"pos"=>$_POST['pos']));
            if($cursor)
            {
                $i = 0;
                $ctr = 0;
                foreach($cursor as $doc)
                {
                    $selected[$i] = $doc['selected'];
                    $rejected[$i] = $doc['rejected'];
                    $hold[$i] = $doc['hold'];
                    $i++;
                }
                
                for($i=0;$i<count($selected);$i++)
                {
                    for($j=0;$j<count($selected[$i]);$j++)
                    {
                        $result[$ctr] = $selected[$i][$j];
                        $ctr+=1;
                    }
                } 
                if(count($result) > 0)
                {
                    $sheet = $spreadsheet->getActiveSheet();
                    $sheet->setCellValue('A1', 'EmailID');
                    $sheet->setCellValue('B1', 'Name');
                    $sheet->setCellValue('C1', 'Status');
                    
                    $n = 1;
                    for($i = '1'; $i <= count($selected); $i++)
                           {
                            $rowNum = $n + 1;
                            $sheet->setCellValue('A'.$rowNum, $n);
                            $sheet->setCellValue('B'.$rowNum, $row[$i]);
                            $sheet->setCellValue('C'.$rowNum, 'Selected');
                           }
                    for($i = '1'; $i <= count($selected); $i++)
                           {
                            $rowNum = $n + 1;
                            $sheet->setCellValue('A'.$rowNum, $n);
                            $sheet->setCellValue('B'.$rowNum, $row[$i]);
                            $sheet->setCellValue('C'.$rowNum, 'Rejected');
                           }
                    for($i = '1'; $i <= count($hold); $i++)
                            {
                            $rowNum = $n + 1;
                            $sheet->setCellValue('A'.$rowNum, $n);
                            $sheet->setCellValue('B'.$rowNum, $row[$i]);
                            $sheet->setCellValue('C'.$rowNum, 'Hold');
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
                           $spreadsheet->getActiveSheet()->setTitle('HistoryReport');
                           $filename = 'HistoryReport-'.time().'.xlsx';
                    
                    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
                               $writer->save('export.xlsx');
                               header('Content-Type: application/vnd.ms-excel');
                               header('Content-Disposition: attachment; filename="'.$filename.'"');
                               $writer->save("php://output");
                               exit;
               
                }
            }
        }
        else if(strlen($_POST["prf"]) > 0 and strlen($_POST["iid"]) > 0 and strlen($_POST["rid"]) <= 0)
        {
            $cursor = $db->rounds->find(array("rg"=>$cursor["rg"],"prf"=>$_POST['prf'],"dept"=>$_POST['dept'],"pos"=>$_POST['pos'],"iid"=>$_POST['iid']));
            $i = 0;
            $ctr = 0;
            foreach($cursor as $doc)
            {
                $selected[$i] = $doc['selected'];
                $i++;
            }
            
            for($i=0;$i<count($selected);$i++)
            {
                for($j=0;$j<count($selected[$i]);$j++)
                {
                    $result[$ctr] = $selected[$i][$j];
                    $ctr+=1;
                }
            } if(count($result) > 0)
            {
                $sheet = $spreadsheet->getActiveSheet();
                    $sheet->setCellValue('A1', 'EmailID');
                    $sheet->setCellValue('B1', 'Name');
                    $sheet->setCellValue('C1', 'Status');
                    
                    $n = 1;
                    for($i = '1'; $i <= count($selected); $i++)
                           {
                            $rowNum = $n + 1;
                            $sheet->setCellValue('A'.$rowNum, $n);
                            $sheet->setCellValue('B'.$rowNum, $row[$i]);
                            $sheet->setCellValue('C'.$rowNum, 'Selected');
                           }
                    for($i = '1'; $i <= count($selected); $i++)
                           {
                            $rowNum = $n + 1;
                            $sheet->setCellValue('A'.$rowNum, $n);
                            $sheet->setCellValue('B'.$rowNum, $row[$i]);
                            $sheet->setCellValue('C'.$rowNum, 'Rejected');
                           }
                    for($i = '1'; $i <= count($hold); $i++)
                            {
                            $rowNum = $n + 1;
                            $sheet->setCellValue('A'.$rowNum, $n);
                            $sheet->setCellValue('B'.$rowNum, $row[$i]);
                            $sheet->setCellValue('C'.$rowNum, 'Hold');
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
                           $spreadsheet->getActiveSheet()->setTitle('HistoryReport');
                           $filename = 'HistoryReport-'.time().'.xlsx';
                    
                    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
                               $writer->save('export.xlsx');
                               header('Content-Type: application/vnd.ms-excel');
                               header('Content-Disposition: attachment; filename="'.$filename.'"');
                               $writer->save("php://output");
                               exit;
            }
        }
        else if(strlen($_POST["prf"]) > 0 and strlen($_POST["iid"]) > 0 and strlen($_POST["rid"]) > 0)
        {
            $cursor = $db->rounds->find(array("rg"=>$cursor["rg"],"prf"=>$_POST['prf'],"dept"=>$_POST['dept'],"pos"=>$_POST['pos'],"iid"=>$_POST['iid'],"rid"=>$_POST['rid']));
            $i = 0;
            $ctr = 0;
            foreach($cursor as $doc)
            {
                $selected[$i] = $doc['selected'];
                $i++;
            }
            
            for($i=0;$i<count($selected);$i++)
            {
                for($j=0;$j<count($selected[$i]);$j++)
                {
                    $result[$ctr] = $selected[$i][$j];
                    $ctr+=1;
                }
            } 
            
            if(count($result) > 0)
            {
                $sheet = $spreadsheet->getActiveSheet();
                    $sheet->setCellValue('A1', 'EmailID');
                    $sheet->setCellValue('B1', 'Name');
                    $sheet->setCellValue('C1', 'Status');
                    
                    $n = 1;
                    for($i = '1'; $i <= count($selected); $i++)
                           {
                            $rowNum = $n + 1;
                            $sheet->setCellValue('A'.$rowNum, $n);
                            $sheet->setCellValue('B'.$rowNum, $row[$i]);
                            $sheet->setCellValue('C'.$rowNum, 'Selected');
                           }
                    for($i = '1'; $i <= count($selected); $i++)
                           {
                            $rowNum = $n + 1;
                            $sheet->setCellValue('A'.$rowNum, $n);
                            $sheet->setCellValue('B'.$rowNum, $row[$i]);
                            $sheet->setCellValue('C'.$rowNum, 'Rejected');
                           }
                    for($i = '1'; $i <= count($hold); $i++)
                            {
                            $rowNum = $n + 1;
                            $sheet->setCellValue('A'.$rowNum, $n);
                            $sheet->setCellValue('B'.$rowNum, $row[$i]);
                            $sheet->setCellValue('C'.$rowNum, 'Hold');
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
                           $spreadsheet->getActiveSheet()->setTitle('HistoryReport');
                           $filename = 'HistoryReport-'.time().'.xlsx';
                    
                    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
                               $writer->save('export.xlsx');
                               header('Content-Type: application/vnd.ms-excel');
                               header('Content-Disposition: attachment; filename="'.$filename.'"');
                               $writer->save("php://output");
                               exit;
            }
        }
    }
        }
else
{
    header("refresh:0;url=notfound.html");
}


