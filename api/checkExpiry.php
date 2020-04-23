<?php 
require_once('vendor/autoload.php');
    $token=$_POST['token'];
    //echo $token;
  include "db.php";
    $collection=$db->tokens;
    $cursor=$collection->findOne(array("token"=>$token));

    if($cursor)
    {
            echo "success";
    }
    else{
        echo "expired";
    }

?>