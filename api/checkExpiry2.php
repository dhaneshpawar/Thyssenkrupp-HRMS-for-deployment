<?php 

// Connection to Database
include 'db.php';
error_reporting(0);

// Check for Login
$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
if($cursor)
{
  $token=$_POST['token'];
  if($token == "123")
  {
    echo "submitted";
  }
  else
  {
    $cursor=$db->tokens->findOne(array("email"=>$token));
    $count = count($cursor);
    $expdate = date($_POST['expdate']);
    if($cursor)
    {
      $currentdate = date("Y.m.d");
  
      // check current date with expiry and number of documents (after selection inclusive)
      if(($currentdate < $expdate) and ($count < 70))
      {
        echo "success";
      }
      else
      {
          echo "expired";
      }
    }
    else
    {
      echo "404";
    }
  }
}
else
{
    header("refresh:0;url=notfound.html");
}

?>