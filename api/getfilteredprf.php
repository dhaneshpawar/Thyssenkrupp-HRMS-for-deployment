<?php 

// Connection to Database
include 'db.php';

// Check for Login
$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
if($cursor)
{
    if($_POST['dept'] == "All" )
    {
        // only open prfs
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
        if(count($arr2)==0)
        {
            echo "No Data";
        }
        else
        {
            echo(json_encode($arr2));
        }
    }
    else
    {
        // extra filter of department
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
        if(count($arr2)==0)
        {
            echo "No Data";
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