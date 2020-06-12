<?php

// Connection to Database
include 'db.php';
error_reporting(0);

// Check for Login
$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
if($cursor)
{
       $cursor2 = $db->rounds->find(array("rid"=>"00","status"=>"bstart"),array('projection' => array('prf' => 1,'pos'=>1,'iid'=>1,'rid'=>1,'dept'=>1,'poszone'=>1,'_id' => 1)));

       $i = 0;
       foreach($cursor2 as $doc)
       {
              // store base round info
              $arr[$i] = $doc;
              $i++;
       }
       if(count($arr) == 0)
       {
              echo "no data";
       }
       else
       {
              echo json_encode($arr);
       }
}
else
{
    header("refresh:0;url=notfound.html");
}
?>
