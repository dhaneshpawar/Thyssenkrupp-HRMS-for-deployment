<?php 

// Connection to Database
include 'db.php';

// Check for Login
$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
if($cursor)
{
    $arra=array();
    $i=0;
    $cursor = $db->prfs->find(array(),array("zones"=>1));
    foreach($cursor as $d)
    {
       $arra[$i] = $d['zone'];
       $i++;
    }
    echo (json_encode($arra));
}
else
{
    header("refresh:0;url=notfound.html");
}

?>