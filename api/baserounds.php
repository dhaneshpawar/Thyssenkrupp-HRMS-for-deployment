<?php include 'db.php';
error_reporting(0);
$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));

if($cursor)
{
       $cursor = $db->rounds->find(array("rid"=>"00","status"=>"bstart"));

       $i = 0;
       foreach($cursor as $doc)
       {
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
