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

    //about initiated rounds

     $initiated_not_assign=$collection->count(array('status'=>'initiated'));
 
     $assigned=$collection->count(array('status'=>"assigned"));

     
     $accepted=$collection->count(array('status'=>"ongoing"));
 
     $initiateddata=array("init"=>$initiated_not_assign,"assigned"=>$assigned,"accepted"=>$accepted);
        

    //about completed rounds

    $collection=$db->tokens;

    $validate_process=$collection->find(['afterselection'=>['$exists'=>true]]);
    $validateprocessprfs=array();
    $validatedprfs=array();
    $completedprfs=array();
    $offerrequestedmem=array();
    if($validate_process){


        foreach($validate_process as $key=>$val){
            //echo "here   ".$val->prf." "."<br>".$val->afterselection;
            if(($val->afterselection=="0" or $val->afterselection=="1" or  $val->afterselection=="4")  and in_array($val->prf,$validateprocessprfs)==false){
                $validateprocessprfs[]=$val->prf;

            }


            
            else if(($val->afterselection=="2")  and (in_array($val->prf,$validatedprfs)==false)){
                $validatedprfs[]=$val->prf;

            }

            
            else if(($val->afterselection=="5")  and (in_array($val->prf,$offerrequestedmem)==false)){
                $offerrequestedmem[]=$val->prf;

            }


            
            else if(($val->afterselection=="6")  and in_array($val->prf,$completedprfs)==false){
                $completedprfs[]=$val->prf;

            }

        }

        $completeddata=array("compl_not_hr2"=>$validateprocessprfs,"validated"=>$validatedprfs,"olrequest"=>$offerrequestedmem,"completed"=>$completedprfs);
    }
    else{

        $completeddata=array("compl_not_hr2"=>0,"validated"=>0,"completed"=>0);

    }

    echo json_encode(array("general"=>$currentrounds,"initiateddata"=>$initiateddata,"completeddata"=>$completeddata,"para4"=>"ok","para5"=>"ok"));

}
else{
    header("refresh:0;url=notfound.html");

}





?>