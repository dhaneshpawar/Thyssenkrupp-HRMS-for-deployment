<?php

    include "api/db.php";
    $dates = array("15","16","17");
    // $cursor = $db->eg->updateOne(array("prf"=>"123"),array('$rename'=>array("dates"=>"modifieddates")));
    $cursor = $db->eg->updateOne(array("prf"=>"123"),array('$set'=>array('dates'=>$dates)));
    
    if($cursor)
    {
        echo "True";
    }
    else
    {
        echo "False";
    }

?>