<?php 
    include "db.php";
    include 'maildetails.php';

    $cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
    
    if($cursor)
    {
        $mail->setFrom('thyssenkrupp@tkep.com', 'tkei');
        $mail->addReplyTo(Email, 'Information');
        $mail->isHTML(true);  
        
        $digit13 = explode("-",$_POST['id']);
        
        $prf = $digit13[0];
        $pos = $digit13[1];
        $iid = $digit13[2];

        echo "Prf = ".$prf;
        echo "Pos = ".$pos;
        echo "IID = ".$iid;

        $getprfinfo = $db->prfs->findOne(array("prf"=>$prf,"pos"=>$pos));

        $dept = $getprfinfo["department"];
        $positionorg = $getprfinfo['position'];
        // echo("Dept = ".$dept);
        // echo("Position = ".$positionorg);



        $ctr = 0;
        foreach($_POST["emails"] as $d)
        {
                $mail->addAddress($d);
                $token=sha1($d);
                $url='http://'.$_SERVER['SERVER_NAME'].'/hrms/applicationblank.php?token='.$token.'&position='.$positionorg;
                $mail->Subject = "Final Reminder - Invitation to interview with thyssenkrupp for the ". $positionorg." position";
                $mail->Body    =   nl2br('Dear Candidate,

                Further to our discussion for the profile of '. $positionorg.' in department - '.$dept.' You are required to provide your basic
                details by accessing the below link so that your application could be processed further.
                
                To access the link, please click <a href='.$url.'>here</a>
                
                <b style = "text-transform:uppercase;color:red;">This is a final reminder for you to fill this form.</b>
                
                Thank you for your interest in working with us.
                
                In-case of any query, feel free to reach out to recruitment@tkeap.com
                
                tkEI Recruiting Team.');
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                if(!$mail->send()) 
                {
                    $ctr = 1;
                }
        }
        if($ctr == 1)
        {
            echo "fail";
        }
        else
        {
            echo "success";
        }
    }
    else
    {
        header("refresh:0;url=notfound.html");    
    }
?>