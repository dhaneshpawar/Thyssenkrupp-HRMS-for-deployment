<?php
 include "db.php";
$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
if($cursor)
{
   
    include 'maildetails.php';
    $mail->setFrom('thyssenkrupp@tkep.com', 'tkei');
    $mail->addReplyTo(Email, 'Information');
    $mail->isHTML(true);
    $i=0;
    $prf13 = explode("*",$_POST['prf13']);
    echo json_encode($prf13);
    $cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
    if($cursor)
    {
        $criteria = array("prf"=>$prf13[0],"rid"=>$prf13[1],"iid"=>$prf13[2],"intvmail"=>$prf13[3],"invname"=>$prf13[6],"accepted"=>$prf13[7],"ilocation"=>$prf13[8],"iperson"=>$prf13[9]);
        $result = $db->interviews->findOne($criteria);
        $res = $db->interviews->updateOne($criteria,array('$set'=>array("sent"=>"done","accepted"=>"yes")));




        $date = date_default_timezone_set('Asia/Kolkata');
           
        $today = date("Y-m-d H-i-s");

                        //Current user

        $newData=array('$set' => array("status" => "ongoing","accepted_time"=>$today));

        $db->generalized->updateOne(array("prf"=>$prf13[0]),$newData);

        foreach($result['members'] as $d)
        {
            $name = $db->tokens->findOne(array("email"=>$d));
            $name1 = $name['full_name'];
            $_SESSION['posi'] = $name['position'];
            $mail->addAddress($d);
            $mail->Subject = "Invitation to interview with thyssenkrupp for the ". $name['position']." position";
            $mail->AddEmbeddedImage("../public/logo.png", "logoimg", "../public/logo.png");
            $mail->isHTML(true); 
            $mail->Body ='
            <head>
        
            </head>
            <body style="background-color:white;"> 
                <table align="center" border="0" cellpadding="0" cellspacing="0"
                    width="750" bgcolor="white"> 
                    <tbody> 
                        <tr> 
                            <td align="center"> 
                        
                                <table align="center" border="0" cellpadding="0"
                                    cellspacing="0" class="col-550" width="750"> 
                                    <tbody> 
                                        <tr> 
                                            <td align="center" style="background-color: rgb(0,160,246); 
                                                    height: 50px;">  
                                                    <p style="font-size:30px;color:white;">
                                                    thyssenkrup Elevators
                                                    </p>
                                                </a> 
                                            </td> 
                                        </tr> 
                                    </tbody> 
                                </table> 
                            </td> 
                        </tr> 
                        <tr style="display: inline-block;"> 
                            <td style="height: 150px; 
                                    padding: 20px; 
                                    border: none; 
                                    border-bottom: 2px solid #361B0E; 
                                    background-color: white;"> 
                                
                            
                                <p class="data"
                                style="text-align: justify-all; 
                                        align-items: center; 
                                        font-size: 18px; 
                                        padding-bottom: 12px;"> 
                                        Dear '.$name1.',
                                        <br><br>
                                Thank you for the application for the role of '.$name['position'].'. Further to our discussion you are
                                required to meet us as per the below details to have face to face interview round.
                                <br><br>

                                Date : '.$result['dates'][$i].'
                                <br><br>
                                Timings : '.$result['times'][$i].'
                                <br><br>
                                Address : '.$prf13[8].'
                                <br><br>
                                Contact Person : '.$prf13[9].'
                                <br><br>
                                In-case of any query, feel free to reach out to recruitment@tkeap.com

                                tkEI Recruiting Team.
                                </p> 
                            <center><img src="cid:logoimg" width="70" height="70">
                            <p style="font-size: 20px;color: #2196F3;">engineering.tomorrow.together</p></center>

                            </td> 
                        </tr> 
                        <tr style="border: none; 
                        background-color: rgb(0,160,246); 
                        height: 40px; 
                        color:white; 
                        padding-bottom: 20px; 
                        text-align: center;"> 
                            
            <td height="40px" align="center"> 
               
                <a href="#"
                style="border:none; 
                    text-decoration: none; 
                    padding: 5px;"> 
                        
                <img height="30"
                src= 
            "https://extraaedgeresources.blob.core.windows.net/demo/salesdemo/EmailAttachments/icon-twitter_20190610074030.png"
                width="30" /> 
                </a> 
                
                <a href="#"
                style="border:none; 
                text-decoration: none; 
                padding: 5px;"> 
                
                <img height="30"
                src= 
            "https://extraaedgeresources.blob.core.windows.net/demo/salesdemo/EmailAttachments/icon-linkedin_20190610074015.png"
            width="30" /> 
                </a> 
                
                <a href="#"
                style="border:none; 
                text-decoration: none; 
                padding: 5px;"> 
                
                <img height="20"
                src= 
            "https://extraaedgeresources.blob.core.windows.net/demo/salesdemo/EmailAttachments/facebook-letter-logo_20190610100050.png"
                    width="24"
                    style="position: relative; 
                        padding-bottom: 5px;" /> 
                </a> 
            </td> 
            </tr> 

                    </tbody> 
                </table> 
            </body> ';
            $mail->AltBody = 'You are assigned for an interview. Please check your dashboard for further progress.';

            $mail->send(); 
            $mail->ClearAddresses();
            $i++;
        }

        $r = $db->prfs->findOne(array("prf"=>$prf13[0]));
        $mail->addAddress($result['intvmail']);
        $mail->Subject = 'Interview schedule for '.$r['department'].' - '.$r['position'].'';
        $mail->AddEmbeddedImage("../public/logo.png", "logoimg", "../public/logo.png");
        $mail->isHTML(true); 
        $mail->Body ='
                    <head>
                
                    </head>
                    <body style="background-color:white;"> 
                        <table align="center" border="0" cellpadding="0" cellspacing="0"
                            width="750" bgcolor="white";"> 
                            <tbody> 
                                <tr> 
                                    <td align="center"> 
                                
                                        <table align="center" border="0" cellpadding="0"
                                            cellspacing="0" class="col-550" width="750"> 
                                            <tbody> 
                                                <tr> 
                                                    <td align="center" style="background-color: rgb(0,160,246); 
                                                            height: 50px;">  
                                                            <p style="font-size:30px;color:white;">
															thyssenkrup Elevators
															</p>
                                                        </a> 
                                                    </td> 
                                                </tr> 
                                            </tbody> 
                                        </table> 
                                    </td> 
                                </tr> 
                                <tr style="display: inline-block;"> 
                                    <td style="height: 150px; 
                                            padding: 20px; 
                                            border: none; 
                                            border-bottom: 2px solid #361B0E; 
                                            background-color: white;"> 
                                        
                                    
                                        <p class="data"
                                        style="text-align: justify-all; 
                                                align-items: center; 
                                                font-size: 18px; 
                                                padding-bottom: 12px;"> 
                                                Dear '.$result['invname'].',
                                                <br><br>
                                                Thank you for confirmation, please find below the details for the interview for the post of '.$r['position'].'.
                                                <br><br>
                                                Address : '.$prf13[8].'
                                                <br><br>
                                                You will find date & time of each candidate on your dashboard. Please be available at the stipulated time.
                                                <br><br>
                                                In-case of any query, feel free to reach out to recruitment@tkeap.com

                                                tkEI Recruiting Team.
                                        </p> 
                                    <center><img src="cid:logoimg" width="70" height="70">
                                    <p style="font-size: 20px;color: #2196F3;">engineering.tomorrow.together</p></center>

                                    </td> 
                                </tr> 
                                <tr style="border: none; 
                                background-color: rgb(0,160,246); 
                                height: 40px; 
                                color:white; 
                                padding-bottom: 20px; 
                                text-align: center;"> 
                                    
                    <td height="40px" align="center"> 
                       
                        <a href="#"
                        style="border:none; 
                            text-decoration: none; 
                            padding: 5px;"> 
                                
                        <img height="30"
                        src= 
                    "https://extraaedgeresources.blob.core.windows.net/demo/salesdemo/EmailAttachments/icon-twitter_20190610074030.png"
                        width="30" /> 
                        </a> 
                        
                        <a href="#"
                        style="border:none; 
                        text-decoration: none; 
                        padding: 5px;"> 
                        
                        <img height="30"
                        src= 
                    "https://extraaedgeresources.blob.core.windows.net/demo/salesdemo/EmailAttachments/icon-linkedin_20190610074015.png"
                    width="30" /> 
                        </a> 
                        
                        <a href="#"
                        style="border:none; 
                        text-decoration: none; 
                        padding: 5px;"> 
                        
                        <img height="20"
                        src= 
                    "https://extraaedgeresources.blob.core.windows.net/demo/salesdemo/EmailAttachments/facebook-letter-logo_20190610100050.png"
                            width="24"
                            style="position: relative; 
                                padding-bottom: 5px;" /> 
                        </a> 
                    </td> 
                    </tr> 

                            </tbody> 
                        </table> 
                    </body> ';
        $mail->AltBody = 'Thank You For Confirmation.';

        $mail->send();
        echo "done";

    }
}
else
{
    header("refresh:0;url=notfound.html");    
}


?>