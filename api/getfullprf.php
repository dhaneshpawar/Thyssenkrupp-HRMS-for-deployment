<?php

// Connection to Database
include 'db.php';

// Check for Login
$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
if($cursor)
{
    // get full info from excel file
    $q = $db->prfs->findOne(array("prf"=>$_POST['prf']));
    $arr = array(
    $q['prf'],
    $q['prfname'],
    $q['submissiongdate'],
    $q['requester'],
    $q['position'],
    $q['productionline'],
    $q['hiringtype'],
    $q['classification100'],
    $q['classification110'],
    $q['classification111'],
    $q['zone'],    
    $q['branch'],
    $q['costcentername'],
    $q['costcentercode'],
    $q['department'],
    $q['location'],
    $q['pos'],
    $q['workforceclsf'],
    $q['requesttype'],
    $q['employeecodeandid'],
    $q['employeename'],
    $q['newjoinerid'],
    $q['newjoinername'],
    $q['requireddate'],
    $q['reportingto'],
    $q['budget'],
    $q['internalposting'],
    $q['status'],
    $q['nexthandler']
    );
    echo json_encode($arr);
}
else
{
    header("refresh:0;url=notfound.html");
}

?>