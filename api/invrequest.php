<?php 
  include "db.php";
  $cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
  if($cursor)
  {
      
      $digit13 = explode("-",$_POST['digit13']);
      $prf = $digit13[0]; 
      $pos = $digit13[1];
      $iid = $digit13[2];
      $rid = $digit13[3];


      //Update invstatus=1 to inform HR that the interviewer rejected
      $updateStatus = $db->interviews->updateOne(
        array("prf"=>$prf,"pos"=>$pos,"iid"=>$iid,"rid"=>$rid,"intvmail"=>$cursor['mail']),array('$set'=>array("invstatus"=>"1","reason"=>"modify","accepted"=>"no")));

      if($updateStatus)
      {
        echo "success";
      }
      else
      {
        echo "fail";
      }
  }
  else
  {
    header("refresh:0;url=notfound.html");    
  }




?>