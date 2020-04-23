<?php
if(isset($_POST))
{
    include 'db.php';
    $cursorlog = $db->session->findOne(array("sid" => $_COOKIE['sid']));
    $fp = fopen('loginlogs.txt', 'a');
    date_default_timezone_set("Asia/Kolkata");
    $timestamp = time();  
    $ld = date("d/m/Y");
    $lt = date("h:i:s A", $timestamp);
    $ln = $cursorlog['name'];
    $ldept = $cursorlog['dept'];
    $lmail = $cursorlog['mail'];
    fwrite($fp, "\n".$ln."\t".$lmail."\t".$ldept."\t\t".$ld."\t".$lt."\tLogout");
    fclose($fp);
    $db->session->deleteMany(array("sid"=>$_COOKIE['sid']));
    
    $result = setcookie("sid",$_COOKIE['sid'] , time()-3600 , '/');
    
    if($result)
    {
        echo "success";
        
    }
}
else
{
    echo "failed";
}
?>
