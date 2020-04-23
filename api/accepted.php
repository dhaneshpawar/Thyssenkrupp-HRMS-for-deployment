<?php

if(isset($_POST))
{
    include "db.php";
    include 'maildetails.php';
    $mail->setFrom('thyssenkrupp@tkep.com', 'Interview Call');
    $mail->addReplyTo(Email, 'Information');
    $mail->isHTML(true);

    $prf13 = explode("-",$_POST['prf13']);
    $cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));

    $criteria = array("prf"=>$prf13[0],"rid"=>$prf13[3],"iid"=>$prf13[2],"pos"=>$prf13[1],"intvmail"=>$cursor['mail']);
    $result = $db->interviews->findOne($criteria);
        // $res = $db->interviews->updateOne($criteria,array('$set'=>array('accepted'=>"yes")),array('safe'=>true,'timeout'=>5000,'upsert'=>true));
        $res = $db->interviews->updateOne($criteria,array('$set'=>array("accepted"=>"yes")));
        foreach($result['members'] as $d)
        {
            $name = $db->tokens->findOne(array("email"=>$d));
            $name1 = $name['full_name'];
            $_SESSION['posi'] = $name['position'];
            $mail->addAddress($d);
            $mail->Subject = 'Your Application at tkEI - Interview Schedule';
            $mail->Body    = nl2br('Dear '.$name1.',

            Thank you for the application for the role of '.$name['position'].'. Further to our discussion you are
            required to meet us as per the below details to have face to face interview round.

            Contact Person

            Date : '.$result['date'].'

            Timings : '.$result['time'].'

            Address : '.$cursor['rg'].'

            In-case of any query, feel free to reach out to recruitment@tkeap.com

            tkEI Recruiting Team.');
            $mail->AltBody = 'You are assigned for an interview. Please check your dashboard for further progress.';

            $mail->send(); 
            $mail->ClearAddresses();

        }
        if($res)
        {
            $r = $db->prfs->findOne(array("prf"=>$prf13[0]));
            $mail->addAddress($result['intvmail']);
            $mail->Subject = 'Interview schedule for '.$r['department'].' - '.$r['position'].'';
            $mail->Body    = nl2br('Dear '.$result['invname'].',

            Thank you for confirmation, please find below the details for the interview for the post of '.$r['position'].'.

            Date - '.$result['date'].'

            Timing - '.$result['time'].'

            Location - '.$cursor['rg'].'

            Please be available at the stipulated time.

            In-case of any query, feel free to reach out to recruitment@tkeap.com

            tkEI Recruiting Team.');
            $mail->AltBody = 'Thank You For Confirmation.';

            $mail->send();
            echo "done";
        }
        else
        {
            echo "not done";
        }
    

}

?>