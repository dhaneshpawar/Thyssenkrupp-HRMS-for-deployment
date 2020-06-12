<?php

// Connection to Database
include 'db.php';

// Check for Login
$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
if($cursor)
{
    if(isset($_POST))
    {
        // split POST data to required form
        $prf13 = explode("-",$_POST['prf13']);

        // Find and change the status of interviewer to pending ... mails to candidates not sent yet 
        $criteria = array("prf"=>$prf13[0],"rid"=>$prf13[3],"iid"=>$prf13[2],"pos"=>$prf13[1],"intvmail"=>$cursor['mail']);
        $res = $db->interviews->updateOne($criteria,array('$set'=>array("accepted"=>"pending")));
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
        echo "noaccess";
    }
}
else
{
    header("refresh:0;url=notfound.html");
}

?>