<?php 

// Connection to Database
include 'db.php';

// Check for Login
$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
if($cursor)
{
    $digit13 =$_POST['prfint'];
    $prfint = explode("*",$digit13);
    $result=$db->interviews->findOne(array("prf"=>$prfint[0],"rid"=>$prfint[1],"iid"=>$prfint[2],"intvmail"=>$prfint[3]));
    $i=0;
    $arr = iterator_to_array($result);
    echo json_encode($arr);
}
else
{
    header("refresh:0;url=notfound.html");
}

?>
