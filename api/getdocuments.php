<?php 
    include "db.php";
// error_reporting(0);
    $mail=$_POST['mail'];
    $cursor = $db->tokens->find(array('email'=>$mail));
    $cursor1 = $db->tokens->find(array("email"=>$mail,"valid"=>array('$exists'=>true)));
    $i=0;
    foreach($cursor1 as $d)
    {
        $i++;
    }
    if($i > 0)
    {
        foreach($cursor as $d)
        {
            $valid = $d['valid'];
            $arr = array($d['usercv'],$d['proofidentity'],$d['proofaadhar'],$d['userphoto'],$d['alldocs'],$d['proofaddr'],$d['appletter'],$d['relletter'],$d['pastpayslip'],$d['uan'],$d['cancelledcheck']);
        }
        $arr1 = array($arr,$valid);
        echo json_encode($arr1);

    }
    else
    {
        $valid = array();
        foreach($cursor as $d)
        {
            $arr = array($d['usercv'],$d['proofidentity'],$d['proofaadhar'],$d['userphoto'],$d['alldocs'],$d['proofaddr'],$d['appletter'],$d['relletter'],$d['pastpayslip'],$d['uan'],$d['cancelledcheck']);
        }
        $arr1 = array($arr,$valid);
        echo json_encode($arr1);

    }
        
               

    
?>