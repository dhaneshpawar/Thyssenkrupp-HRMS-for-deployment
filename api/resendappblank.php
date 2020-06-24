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
                                                Dear Candidate,
                                                <br></br><br></br>
                                                Further to our discussion for the profile of '. $positionorg.' in department - '.$dept.' You are required to provide your basic
                                                details by accessing the below link so that your application could be processed further.
                                                <br></br><br></br>
                                                To access the link, please click <a href='.$url.'>here</a>
                                                <br></br><br></br>
                                                <b style = "text-transform:uppercase;color:red;">This is a final reminder for you to fill this form.</b>
                                                <br></br><br></br>
                                                Thank you for your interest in working with us.
                                                <br></br><br></br>
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