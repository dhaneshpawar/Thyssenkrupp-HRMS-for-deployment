<?php

//api/login.php:- 
$fp = fopen('loginlogs.txt', 'a');
$timestamp = time();  
$ld = date("d/m/Y");
$lt = date("h:i:s A", $timestamp);
$ln = $cursor['name'];
$ldept = $cursor['dept'];
$lmail = $cursor['mail'];
fwrite($fp, "\n".$ln."\t".$lmail."\t".$ldept."\t\t".$ld."\t".$lt."\tLogin");
fclose($fp);


//api/logout.php:-
$cursorlog = $db->session->findOne(array("sid" => $_COOKIE['sid']));
$fp = fopen('loginlogs.txt', 'a');
$timestamp = time();  
$ld = date("d/m/Y");
$lt = date("h:i:s A", $timestamp);
$ln = $cursorlog['name'];
$ldept = $cursorlog['dept'];
$lmail = $cursorlog['mail'];
fwrite($fp, "\n".$ln."\t".$lmail."\t".$ldept."\t\t".$ld."\t".$lt."\tLogout");
fclose($fp);


//importExcel.php:- (For Success)
$cursorlog = $db->session->findOne(array("sid" => $_COOKIE['sid']));
$fp = fopen('api/activities.txt', 'a');
$act = "PRF Data Upload";
$timestamp = time();  
$ld = date("d/m/Y");
$lt = date("h:i:s A", $timestamp);
$ln = $cursorlog['name'];
$ldept = $cursorlog['dept'];
$lmail = $cursorlog['mail'];
fwrite($fp, "\n".$act."\t\t".$ln."\t".$lmail."\t".$ldept."\t\t".$ld."\t".$lt."\tSuccessful");
fclose($fp);


//importExcel.php:- (For Failure)
$cursorlog = $db->session->findOne(array("sid" => $_COOKIE['sid']));
$fp = fopen('api/activities.txt', 'a');
$act = "PRF Data Upload";
$timestamp = time();  
$ld = date("d/m/Y");
$lt = date("h:i:s A", $timestamp);
$ln = $cursorlog['name'];
$ldept = $cursorlog['dept'];
$lmail = $cursorlog['mail'];
fwrite($fp, "\n".$act."\t\t".$ln."\t".$lmail."\t".$ldept."\t\t".$ld."\t".$lt."\tFailed");
fclose($fp);

//api/sendmail.php:- (For Success)
$cursorlog = $db->session->findOne(array("sid" => $_COOKIE['sid']));
$fp = fopen('activities.txt', 'a');
$act = "Initiate PRF";
$timestamp = time();  
$ld = date("d/m/Y");
$lt = date("h:i:s A", $timestamp);
$ln = $cursorlog['name'];
$ldept = $cursorlog['dept'];
$lmail = $cursorlog['mail'];
fwrite($fp, "\n".$act."\t\t".$ln."\t".$lmail."\t".$ldept."\t\t".$ld."\t".$lt."\tSuccessful");
fclose($fp);

//api/sendmail.php:- (For Failure)
$cursorlog = $db->session->findOne(array("sid" => $_COOKIE['sid']));
$fp = fopen('activities.txt', 'a');
$act = "Initiate PRF";
$timestamp = time();  
$ld = date("d/m/Y");
$lt = date("h:i:s A", $timestamp);
$ln = $cursorlog['name'];
$ldept = $cursorlog['dept'];
$lmail = $cursorlog['mail'];
fwrite($fp, "\n".$act."\t\t".$ln."\t".$lmail."\t".$ldept."\t\t".$ld."\t".$lt."\tFailed");
fclose($fp);

?>