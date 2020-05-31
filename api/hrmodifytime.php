<?php 
//Sarang - 16/03/2020
include "db.php";
$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
$index = $_POST['index'];
$time = $_POST['time'];
$intvmail = $_POST['mail'];
$digit13 = $_POST['digit13'];
$digit13 = explode("-",$_POST['digit13']);
$updatedtime = $_POST['updatedTime'];
$updateddate = $_POST['updatedDate'];

// echo "PRF".$digit13[0];
// echo "PRF".$digit13[1];
// echo "PRF".$digit13[2];
// echo "PRF".$digit13[3];
// // echo $digit13[3];
// echo $cursor['mail'];


$cursor = $db->interviews->findOne(array(
                    "prf" =>$digit13[0],
                    "pos"=>$digit13[1],
                    "iid"=>$digit13[2],
                    "rid"=>$digit13[3],
                    "intvmail"=>$intvmail
));

$dates = $cursor['dates'];
$dates = iterator_to_array($dates);
$times = $cursor['times'];
$times = iterator_to_array($times);


// echo "Time".$updateddate;
// echo "Date".$updatedtime;
// echo "Index:".$index;
// $dates = $cursor['moddates'];
// $dates = iterator_to_array($dates);
// $times = $cursor['modtime'];
// $times = iterator_to_array($times);

//Modify the date time in array
for($i=0;$i<count($dates);$i++)
{
    if($i == $index )
    {
        $times[$i] = $updatedtime;
        $dates[$i] = $updateddate;
        break;
    }  
}

// print_r($dates);
// print_r($times);

$cursor = $db->interviews->updateOne(
        array(
        "prf" =>$digit13[0],
        "pos"=>$digit13[1],
        "iid"=>$digit13[2],
        "rid"=>$digit13[3],
        "intvmail"=>$intvmail
        ),
        array('$set'=>array("dates"=>$dates,"moddates"=>$dates,"times"=>$times,"modtimes"=>$times)));

    if($cursor)
    {
        echo "modify";
    }

?>