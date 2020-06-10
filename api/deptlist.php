<?php

// Connection to Database
include 'db.php';
error_reporting(0);

// Check for Login
$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
if($cursor)
{
  $cursor2 = $db->prfs->find(array("rg" => $cursor['rg']));
  $i = 0;  
  foreach($cursor2 as $doc)
  {
    $arr[$i] = $doc["dept"];
    $i++;
  }
  echo json_encode($arr);
}
else
{
  header("refresh:0;url=notfound.html");
}

?>