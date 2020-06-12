<?php 


$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
if($cursor)
{
    include "db.php";
    $cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
    $digit13 = $_POST['id'];
    $mail=$_POST['intvmail'];
    $digit13 = explode("-",$digit13);

    //find candidates of interviewer rejected rounds
    $result = $db->interviews->findOne(array("prf"=>$digit13[0],"intvmail"=>$mail, "pos"=>$digit13[1] , "iid"=>$digit13[2] , "rid"=>$digit13[3] ,"invstatus"=>"1"));
    if($result)
    {
 
       $arr = iterator_to_array($result);
       echo json_encode($arr);

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