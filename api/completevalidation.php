<?php

//Changed by sarang - 10/01/2020
    include "db.php";
 
    // echo $_POST['prf']
    $res=$db->rounds->updateOne(array("rid"=>$_POST['rid'],"prf"=>$_POST['prf'],"iid"=>$_POST['iid'],"pos"=>$_POST['pos']),array('$set'=>array("completevalidate"=>"completed")));
    if($res)
    {
        echo "success";
    }
    else
    {
        echo "fail";
    }
?>