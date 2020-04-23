<?php
if(isset($_POST))
{
    include 'db.php';
    
    $cursor = $db->users->findOne(array("uid" =>$_POST['uid'],"password" => $_POST['pwd']));
    
    if($cursor)
    {
        $fp = fopen('loginlogs.txt', 'a');
        date_default_timezone_set("Asia/Kolkata");
        $timestamp = time();  
        $ld = date("d/m/Y");
        $lt = date("h:i:s A", $timestamp);
        $ln = $cursor['name'];
        $ldept = $cursor['dept'];
        $lmail = $cursor['mail'];
        fwrite($fp, "\n".$ln."\t".$lmail."\t".$ldept."\t\t".$ld."\t".$lt."\tLogin");
        fclose($fp);
        $session_id = md5(uniqid(mt_rand(), true));
        $result = $db->session->insertOne(array('uid'=>$_POST['uid'],'sid' => $session_id,'rg'=>$cursor["rg"],'dept'=>$cursor["dept"],'dsg'=>$cursor["dsg"],'mail'=>$cursor["mail"],'name'=>$cursor["name"]));
        
        setcookie('sid', $session_id , time()+60*60*7 , '/');
        echo $cursor['dsg'];
    }
    else
    {
        echo "404";
    }
}
else
{
    header("refresh:0;url=notfound.html");
} ?>