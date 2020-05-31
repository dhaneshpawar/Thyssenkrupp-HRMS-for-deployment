<?php 
    include "db.php";
    $cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
    $digit13 = $_POST['id'];
    $mail=$_POST['intvmail'];
    $digit13 = explode("-",$digit13);
    $result = $db->interviews->findOne(array("prf"=>$digit13[0],"intvmail"=>$mail, "pos"=>$digit13[1] , "iid"=>$digit13[2] , "rid"=>$digit13[3] ,"invstatus"=>"1"));
    if($result)
    {
        $i=0;
        // $arr =array(
        //     $result['members'],
        //     $result['dates'],
        //     $result['moddates'],
        //     $result['times'],
        //     $result['modtimes']
        // );
       $arr = iterator_to_array($result);
       echo json_encode($arr);
    
        
        // 
        // $arr = array();
        // foreach($result as $doc)
        // {
        //     $arr[$i]=array($getselectednames['full_name'],$d,$dates[$i],$times[$i]);
        //     $arr[$i][0] = $doc['members'];
        //     $arr[$i][1] = $doc['dates'];
        //     $arr[$i][2] = $doc['moddates'];
        //     $arr[$i][3] = $doc['times'];
        //     $arr[$i][4] = $doc['modtimes'];
        //     $i++;
        // }
        // echo json_encode($arr);
    }
    else
    {
        echo "fail";
    }


?>