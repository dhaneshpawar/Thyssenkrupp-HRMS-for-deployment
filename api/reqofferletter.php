<?php

if(isset($_POST))
{

    include "db.php";
    $digit13 = explode("-",$_POST['id']);
    $cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));

    $result = $db->intereval->findOne(array("email"=>$_POST['mail']));
    if(!empty($result))
    {
        $db->tokens->updateOne(array("email"=>$_POST['mail']),array('$set'=>array("afterselection"=>"5")));
        $result = $db->intereval->updateOne(array("prf"=>$digit13[0],"pos"=>$digit13[1],"iid"=>$digit13[2],"rid"=>$digit13[3],"email"=>$_POST['mail']),array('$set'=>array("offerletter"=>"requested","requester"=>$cursor['mail'])));
        if($result)
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
        echo "gotcha";
    }
}

?>