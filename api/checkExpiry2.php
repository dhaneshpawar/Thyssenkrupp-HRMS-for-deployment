<?php 
  error_reporting(0);
  require_once('vendor/autoload.php');
  $token=$_POST['token'];
  include "db.php";
  $cursor=$db->tokens->findOne(array("email"=>$token));
  $count = count($cursor);
  $expdate = date($_POST['expdate']);
  if($cursor)
  {
    $currentdate = date("Y.m.d");
    if(($currentdate < $expdate) and ($count<70))
    {
      echo "success";
    }
    else
    {
        echo "expired";
    }
  }
  else
  {
    echo "404";
  }
  

?>