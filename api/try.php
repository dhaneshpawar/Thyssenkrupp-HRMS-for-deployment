<?php
//backup file for interviewer.php

include 'maildetails.php';
include 'db.php';

$mail->setFrom("thyssenkrupp", 'Interview Call');
$mail->addReplyTo(Email, 'Information');
$mail->isHTML(true);   


$ctr = 0;

foreach($_POST['emails'] as $d)
{
   
    $mail->addAddress($d);
    $token=sha1($d);
    $db->tokens->insertOne(array("email"=>$d,"token"=>$token));
    $url='http://'.$_SERVER['SERVER_NAME'].'/thyssenkrup/applicationblank.html?token='.$token;
    $mail->Subject = 'Mail Regarding to take Interview for interviewer';
    $mail->Body    = 'You have been shortlisted for the interview. You have an interview on this date.'.$url;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if(!$mail->send()) 
    {
        $ctr = 1;
    }
    $mail->ClearAddresses();
}

if($ctr == 0)
{
$result = $db->interviews->insertOne(array("rid"=>$rid,"rg"=>$cursor["rg"],"prf"=>$digit13[0],'pos'=>$digit13[1],"iid"=>$digit13[2],"members"=>$_POST['emails'],"intvmail"=>$_POST['intv'],"date"=>$_POST['date'],"time"=>$_POST['time'],"status"=>"0"));

echo "sent"; 

//updating status of base round
$collection->updateOne(array("prf"=>$_POST['prf'],"rg"=>$cursor["rg"],"dept"=>$_POST['dept'],"pos"=>$_POST['pos']),array("status"=>"1"));
}

else
{
    echo "notsent";
}
?>


