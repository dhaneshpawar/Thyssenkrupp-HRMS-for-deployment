<?php
error_reporting(0);
include 'api/db.php';
if(isset($_COOKIE['sid']))
{
  
  $cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
  
  if($cursor)
  {
    $cursor = $db->users->findOne(array("uid" => $cursor['uid']));
    
    $designation = $cursor['dsg'];
    
    if($designation == "hr" || $designation == "ceo" || $designation == "hod" || $designation == "rghead" )
    {
        $mailid = $_GET['aid'];
          $result = $db->intereval->find(array("email"=>$mailid));
          $cursor2 = $db->tokens->findOne(array("email"=>$mailid));
          
          $temp;
          foreach($result as $doc)
          { 
              $temp = $doc;
          }
          $doc = $temp;
          $cv=$cursor2['usercv'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Evaluation Form</title>

    <link rel="stylesheet" type="text/css" media="screen" href="public/css/materialize.css">
    <link rel="stylesheet" type="text/css" media="screen" href="public/css/materialize.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <script src="public/jquery-3.2.1.min.js"></script>

    <script src="public/js/materialize.js"></script>
    <script src="public/js/materialize.min.js"></script>

</head>
<body>
 


<nav>
    <div class="nav-wrapper blue darken-1">
        <a href="#!" class="brand-logo center">thyssenkrupp</a>
    </div>
</nav>
<br><br>
<center>
<?php $cv = str_replace(' ', '%20', $cv); ?>
<object data="<?php echo $cv; ?>" type="application/pdf" width="700" height="800" id="obj">
    <a href="<?php echo $cv; ?>"></a>
</object>
</center>

    <?php if($doc['result']=='selected'){
?>




<!-- Script Starts Here -->
<script>

</script>
<!-- Script Ends -->
</body>
</html>
<?php
          }
            }
            else
            {
                header("refresh:0;url=notfound.html");
            }
        }
        else
        {
            header("refresh:0;url=notfound.html");
        }
    }
    else
    {
        header("refresh:0;url=notfound.html");
    }  
?>