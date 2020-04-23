<?php
//error_reporting(0);

if(isset($_COOKIE['sid']))
{
  include 'db.php';
  
  $cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
 
  if($cursor)
  {
    $cursor2 = $db->prfs->find(array("rg" => $cursor['rg'],"dept" => $_POST['dept']));
    $arr = [];
    $i = 0;  
    foreach($cursor2 as $doc)
    {
      $arr[$i] = $doc["prf"];
      $i++;
    }
    echo json_encode($arr);
  }
  else
  {
      echo "i ama here";
  }
}
?>