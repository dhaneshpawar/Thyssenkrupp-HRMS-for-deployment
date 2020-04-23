<?php 
require_once('vendor/autoload.php');
    $token=$_POST['token'];
    //echo $token;
  include "db.php";
    $cursor=$db->tokens->findOne(array("email"=>$token));

    if($cursor)
    {
            echo "success";
    }
    else{
        echo "expired";
    }

?>