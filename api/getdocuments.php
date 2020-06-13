<?php 

// Connection to Database
include 'db.php';

// Check for Login
$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
if($cursor)
{
    $mail=$_POST['mail'];

    // get documents of particular user
    $cursor = $db->tokens->find(array('email'=>$mail));
    $cursor1 = $db->tokens->find(array("email"=>$mail,"valid"=>array('$exists'=>true)));
    $i=0;
    foreach($cursor1 as $d)
    {
        $i++;
    }
    if($i > 0)
    {
        foreach($cursor as $d)
        {
            $valid = $d['valid'];
            $arr = array($d['usercv'],$d['proofidentity'],$d['proofaadhar'],$d['userphoto'],$d['alldocs'],$d['proofaddr'],$d['appletter'],$d['relletter'],$d['pastpayslip'],$d['uan'],$d['cancelledcheck']);
        }
        $arr1 = array($arr,$valid);
        echo json_encode($arr1);

    }
    else
    {
        $valid = array();
        foreach($cursor as $d)
        {
            $arr = array($d['usercv'],$d['proofidentity'],$d['proofaadhar'],$d['userphoto'],$d['alldocs'],$d['proofaddr'],$d['appletter'],$d['relletter'],$d['pastpayslip'],$d['uan'],$d['cancelledcheck']);
        }

        // send valid and all documents
        $arr1 = array($arr,$valid);
        echo json_encode($arr1);

    }
}
else
{
    header("refresh:0;url=notfound.html");
}
                   
?>