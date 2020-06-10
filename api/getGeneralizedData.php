<?php

include 'db.php';
header('Content-Type: application/json');

$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid'],"dsg"=>"hr"));

if($cursor){
    $uid="";

    foreach($cursor as $doc=>$value)
        {
            if($doc=='uid'){
                $uid=$value;
            }      
        }
    
    //echo "Current user ".$uid."<br>";

    $collection=$db->generalized;

    $completed=$collection->count(array('uid'=>$uid,'status'=>'completed'));

    $ongoing=$collection->count(array('uid'=>$uid,'status'=>'ongoing'));
    $avail=$collection->count(array('uid'=>$uid,'status'=>'avail'));
    $initiated=$collection->count(array('uid'=>$uid,'status'=>'initiated'));
    
    $currentrounds=array("uid"=>$uid,"ongoing"=>$ongoing,"avail"=>$avail,"completed"=>$completed,"initiated"=>$initiated);

    echo json_encode($currentrounds);

}
else{
    header("refresh:0;url=notfound.html");

}





?>