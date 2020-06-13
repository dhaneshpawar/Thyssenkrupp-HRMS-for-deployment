<?php

// Connection to Database
include 'db.php';

// Check for Login
$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
if($cursor)
{
    $arr=array();
    if(isset($_GET))
    {
        $cursor1 = $db->tokens->find(array("offerletter"=>array('$exists'=>true)));
    
        $orderCount1 =count(iterator_to_array($cursor1));
        if($orderCount1 == 0)
        {
            //Changed by sarang - 10/01/2020
            $cursor = $db->rounds->find(array("status"=>"completed","completevalidate"=>"inprocess"));
            
            $i = 0;
            foreach($cursor as $document)
            {
                $id = $document['prf']."-".$document['pos']."-".$document['iid']."-".$document['rid'];
                $arr[$i] = array($id);
                $i++;
            }  
           
             if(count($arr)==0)
             {
                 //Changed by sarang - 10/01/2020
                echo json_encode($arr);
             }
             else
             {
                echo json_encode($arr);
             }
            
    
        }
        else
        {
            $arr = "no data";
            echo $arr;
        }
       
    }
}
else
{
    header("refresh:0;url=notfound.html");
}

?>


