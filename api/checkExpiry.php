<?php 
  
    require_once('vendor/autoload.php');
    include "db.php";

    $cursor=$db->tokens->findOne(array("token"=>$_POST['token']));
    
    if($cursor)
    {
      $date1 = $cursor["expiry"];
      $date2 = date("Y-m-d");
      $date1Timestamp = strtotime($date1);
      $date2Timestamp = strtotime($date2);
      $difference = $date1Timestamp - $date2Timestamp;
      $days = floor($difference / (60*60*24) );
      if($days <= 0)
      {
          echo "expired2";
      }
      else
      {
          echo "success";
      }
    }
    else
    {
      echo "expired";
    }

?>