<?php 

// Connection to Database
include 'db.php';
error_reporting(0);

// Check for Login
$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
if($cursor and isset($_POST))
{
    $result = $db->tokens->findOne(array("email"=>$_POST['email']));
    if($result)
    {
        echo $result['full_name'];
    }
    else
    {
        echo "error";
    }
}
else
{
    header("refresh:0;url=notfound.html");
}

?>