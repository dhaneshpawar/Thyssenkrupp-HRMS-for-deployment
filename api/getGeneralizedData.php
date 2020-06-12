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
    //about generalized data
    $collection=$db->generalized;

    $completed=$collection->count(array('uid'=>$uid,'status'=>'completed'));

    $ongoing=$collection->count(array('uid'=>$uid,'status'=>'ongoing'));
    $avail=$collection->count(array('uid'=>$uid,'status'=>'avail'));
    $initiated=$collection->count(array('uid'=>$uid,'status'=>'initiated'));
    
    $generalized=array("uid"=>$uid,"ongoing"=>$ongoing,"avail"=>$avail,"completed"=>$completed,"initiated"=>$initiated);

    //about initiated rounds

    $collection=$db->interviews;

    $initiated_not_assign=$collection->count(array('status'=>0,'accepted'=>'yes'));

    $assigned=$collection->count(array('status'=>0,'accepted'=>'no'));

    $initiateddata=array("initiated"=>$initiated_not_assign,"assigned"=>$assigned);

    //about completed rounds

    // $collection=$db->rounds;

    // $rounds=$collection->find();

    // $roundsdata=array();
    // $collection=$db->tokens;
    // foreach($rounds as $rid=>$val){
    //     if(in_array($val->prf,$roundsdata)==false){
           

    //         $alltokens=$collection->find(array("prf"=>$val->prf));

    //         $offer_letter_count=$collection->find(array("afterselection"=>6));





            



    //     }
    // }

    
    




    

    $para=array('generalized'=>$generalized,"initiateddata"=>$initiateddata);


    echo json_encode($para);

}
else{
    header("refresh:0;url=notfound.html");

}





?>