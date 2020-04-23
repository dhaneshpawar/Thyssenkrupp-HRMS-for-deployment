<?php
include "db.php";
    $digit13=explode("-",$_POST['id']);
    $digit13[0] = substr($digit13[0],3);
    $digit13[3] = substr_replace($digit13[3],"",2);
    print_r($digit13);

    $reason=$_POST['reason'];
    $result= $db->interviews->updateOne(array("rid"=>$digit13[3],'iid'=>$digit13[2],"prf"=>$digit13[0],"pos"=>$digit13[1]),array('$set'=>array("invstatus"=>"1","reason"=>$reason)));
    if($result)
    {
        echo "success";
    }
    else
    {
        echo "fail";
    }
?>