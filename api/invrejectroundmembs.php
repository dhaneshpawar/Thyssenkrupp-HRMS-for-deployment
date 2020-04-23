<?php 
    include "db.php";
    $cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
    $digit13 = $_POST['id'];
    $mail=$_POST['intvmail'];
    $digit13 = explode("-",$digit13);
    $result = $db->interviews->find(array("prf"=>$digit13[0],"intvmail"=>$mail, "pos"=>$digit13[1] , "iid"=>$digit13[2] , "rid"=>$digit13[3] ,"invstatus"=>"1"));
    if($result)
    {
        foreach($result as $doc)
        {
            echo json_encode($doc['members']);
        }
    }
    else
    {
        echo "fail";
    }


?>