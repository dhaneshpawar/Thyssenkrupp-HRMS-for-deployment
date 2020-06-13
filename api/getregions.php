<?php

// Connection to Database
include 'db.php';

// Check for Login
$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
if($cursor)
{
    // return all regions
    $result = $db->prfs->find();
    foreach($result as $doc)
    {
        echo $doc['rg'];
    }
}
else
{
    header("refresh:0;url=notfound.html");
}

?>