<?php 
//Sarang - 16/03/2020
include "db.php";



$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));


if($cursor)
{
    $index = $_POST['index'];
    $time = $_POST['time'];
    $intvmail = $_POST['mail'];
    $digit13 = $_POST['digit13'];
    $digit13 = explode("-",$_POST['digit13']);
    $updatedtime = $_POST['updatedTime'];
    $updateddate = $_POST['updatedDate'];



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
    else
    {
        echo "fail";
    }

}
else
{
    header("refresh:0;url=notfound.html");
}

?>