<?php

// Connection to Database
include 'db.php';

// Check for Login
$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
if($cursor)
{
    $result = $db->tokens->findOne(array('email'=>$_POST['mail']));
    $i=0;
    $valid=$result['valid'];
    foreach($valid as $d)
    {
        $arr[$i]=$d;
        $i++;
    }
    echo json_encode($arr);
  
}
else
{
    header("refresh:0;url=notfound.html");
}

?>