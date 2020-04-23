<?php
    
    include "db.php";
    $mail= $_POST['mail'];
    $doc=$_POST['doc'];
    $result=$db->tokens->updateOne(array("email"=>$mail),array('$addToSet'=>array('invalid'=>$_POST['doc'])),array('safe'=>true,'timeout'=>5000,'upsert'=>true));
    if($result)
    {
        echo "success";
    }
    else
    {
        echo "fail";
    }
?>