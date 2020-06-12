<?php 
//Added by Sarang
//Added by Sarang - 03/14/2020

//when first round entry is being done  enter dept also to run this file 
include "db.php";
// Check for Login
$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
if($cursor)
{
        $arr2=array();

        if($_POST['dept'] == "All" )
        {
            
            $iids=array();
            $cursor = $db->prfs->find(array("status"=>"completed"));
            $i=0;
            $j=0;
            $cursor1 = $db->rounds->find(array("status"=>"completed"));
          
            foreach($cursor1 as $d)
            {
                $iids[$j] = $d['iid'];
                $j++;
            }
            // echo count($iids);
            $k=0;
            foreach($cursor as $doc)
            {
                $arr[0]=$doc['prf'];
                $arr[1]=$doc['position'];
                $arr[2]=$doc['zone'];
                $arr[3]=$doc['department'];
                $arr[4]=$doc['pos'];
                $arr[5]=$doc['status'];
                $arr[6]=$iids[$i];
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
 
            $iids=array();
            

            
            $i=0;
            $j=0;
            $cursor1 = $db->rounds->find(array("status"=>"completed", "dept"=>$_POST['dept']));
          
            foreach($cursor1 as $d)
            {
                $iids[$j][0] = $d['prf'];
                $iids[$j][1] = $d['iid'];
                $j++;
            }
            $j=0;
            foreach ($iids as $i)
            {
                $cursor = $db->prfs->findOne(array("prf"=>$i[0],"department"=>$_POST['dept'],"status"=>"completed"));
                $arr[0]=$cursor['prf'];
                $arr[1]=$cursor['position'];
                $arr[2]=$cursor['zone'];
                $arr[3]=$cursor['department'];
                $arr[4]=$cursor['pos'];
                $arr[5]=$cursor['status'];
                $arr[6] = $i[1];
                $arr2[$j] = $arr;
                $j++;
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
       
       
      

    }
    else
    {
        header("refresh:0;url=notfound.html");
    }

?>