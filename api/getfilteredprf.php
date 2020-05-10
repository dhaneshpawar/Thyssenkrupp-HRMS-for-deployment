<?php 
//Added by Sarang - 03/14/2020
include "db.php";


        if($_POST['dept'] == "All" )
        {
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
        }
        else
        {
            $cursor = $db->prfs->find(array("department"=>$_POST['dept'],"status"=>"open"));
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
    
        }
       
        

?>