<?php

// Connection to Database
include 'db.php';


// Check for Login
$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
if($cursor)
{
    // set status of validation as completed ... .ready for offer letter
    $res=$db->rounds->updateOne(array("rid"=>$_POST['rid'],"prf"=>$_POST['prf'],"iid"=>$_POST['iid'],"pos"=>$_POST['pos']),array('$set'=>array("completevalidate"=>"completed")));
    if($res)
    {
        echo "success";
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