<?php

// Connection to Database
include 'db.php';
error_reporting(0);

// Check for Login
$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
if($cursor)
{
    if(isset($_GET))
    {
        $cursor = $db->rounds->find(array("status"=>"invcomplete"));
        if($cursor)
        {
            $i = 0;
            foreach($cursor as $document)
            {
                // Get base and next round completed PRFs
                $arr[$i] = array($document['prf'],$document['pos'],$document['iid'],$document['rid'],$document['dept'],$document['poszone']);
                $i++;
            }
            if(count($arr)==0)
            {
                echo "no data";
            }
            else
            {
                echo json_encode($arr);
            }
        }
        else
        {
            echo "404";
        }
    }
    else
    {
        header("refresh:0;url=notfound.html");
    }
}
else
{
    header("refresh:0;url=notfound.html");
}

?>