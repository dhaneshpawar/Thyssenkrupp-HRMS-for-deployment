<?php
include "db.php";
    // if($_POST)
    // {
        $cursor = $db->prfs->find(array("status"=>"open"));
        $i=0;
        foreach($cursor as $doc)
        {
            $arr[0]=$doc['prf'];
            $arr[1]=$doc['position'];
            $arr[2]=$doc['zone'];
            $arr[3]=$doc['department'];
            $arr[4]=$doc['pos'];
            $arr[5]=$doc['status'];
            $arr[6]=$doc['progress'];
            $arr2[$i] = $arr;
            $i=$i+1;
        }
        echo(json_encode($arr2));

        

    // }



?>