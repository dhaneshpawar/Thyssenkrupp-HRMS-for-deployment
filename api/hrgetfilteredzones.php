<?php 
//Added by Sarang

//Added by Sarang - 03/14/2020
//when first round entry is being done  enter dept also to run this file 
include "db.php";
$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
if($cursor)
{
        $arr2=array();
        if($_POST['dept'] == "All" && $_POST['zone'] == "All")
        {
            // echo "Success";
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
            if(count($arr2) == 0)
            {
                echo "No data";
            }
            else
            {
                 echo(json_encode($arr2));
            }
        }
        else if($_POST['dept'] == "All" )
        {
            
            $iids=array();
            $cursor = $db->prfs->find(array("zone"=>$_POST['zone'],"status"=>"open"));
            $i=0;
            $j=0;
          //count($iids);
            $k=0;
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
            // echo $k;

            if(count($arr2) == 0)
            {
                echo "No data";
            }
            else
            {
                 echo(json_encode($arr2));
            }
        }
        else
        {
            //Filter using dept as weel as zone
            $iids=array();
            $cursor = $db->prfs->find(array("department"=>$_POST['dept'],"zone"=>$_POST['zone'],"status"=>"open"));
            $i=0;
            $j=0;
           
        
            $k=0;
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
            // echo $k;

            if(count($arr2) == 0)
            {
                echo "No data";
            }
            else
            {
                 echo(json_encode($arr2));
            }
            
        }
    }
    else
    {
        header("refresh:0;url=notfound.html");
    }
?>