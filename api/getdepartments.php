<?php 

// Connection to Database
include 'db.php';

// Check for Login
$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
if($cursor)
{
    $arra=array();
    $i=0;
    $cursor = $db->prfs->find(array(),array("department"=>1));
    
    // get all the departments
    foreach($cursor as $d)
    {
       $arra[$i] = $d['department'];
       $i++;
    }
    echo (json_encode($arra));
}
else
{
    header("refresh:0;url=notfound.html");
}

?>