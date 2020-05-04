<?php 
//Sarang - 16/03/2020
include "db.php";
$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
$index = $_POST['index'];
$time = $_POST['time'];
$invmail = $cursor['mail'];
$name  = $cursor['name'];
$digit13 = $_POST['digit13'];
$digit13 = explode("-",$_POST['digit13']);
$updatedtime = $_POST['updatedTime'];

// echo $digit13[3];
echo $cursor['mail'];
$intvmail = $cursor['mail'];

$cursor = $db->interviews->findOne(array(
                    "prf" =>$digit13[0],
                    "pos"=>$digit13[1],
                    "iid"=>$digit13[2],
                    "rid"=>$digit13[3],
                    "intvmail"=>$cursor['mail']
));

$dates = $cursor['dates'];
$dates = iterator_to_array($dates);
// //Modify the time in array
for($i=0;$i<count($dates);$i++)
{
    if($i == $index )
    {
        $dates[$i] = $updatedtime;
        break;
    }  
}

$cursor = $db->interviews->updateOne(
    array(
    "prf" =>$digit13[0],
    "pos"=>$digit13[1],
    "iid"=>$digit13[2],
    "rid"=>$digit13[3],
    "intvmail"=>$intvmail
    ),
    array('$set'=>array("dates"=>$dates)));

// $cursor=$db->interviews->updateOne(
//     array(
//     "prf" =>$digit13[0],
//     "pos"=>$digit13[1],
//     "iid"=>$digit13[2],
//     "rid"=>$digit13[3],
//     "intvmail"=>$cursor['mail']),
//     array('$set'=>array("dates"=>$dates)));





?>