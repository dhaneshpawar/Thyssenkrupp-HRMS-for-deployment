<?php

if(isset($_POST))
{
    include "db.php";
    $prf13 = explode("-",$_POST['prf13']);
    $cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));

    $criteria = array("prf"=>$prf13[0],"rid"=>$prf13[3],"iid"=>$prf13[2],"pos"=>$prf13[1],"intvmail"=>$cursor['mail']);
    $res = $db->interviews->updateOne($criteria,array('$set'=>array("accepted"=>"yes")));

}

?>