<?php
include 'db.php';
$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
if($cursor)
{
    include 'maildetails.php';
    

    $mail->setFrom('thyssenkrupp@tkep.com', 'tkei');
    $mail->addReplyTo(Email, 'Information');
    $mail->isHTML(true);   

    $email = $_POST['mail'];

    $candidate = $_POST['candidate'];
    $mail->addAddress($email);

    $mail->Subject = 'Update regarding offer letter';
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
                                Offer Letter Sent to '.$candidate.'
                        </p> 
                    <center><img src="cid:logoimg" width="70" height="70">
                    <p style="font-size: 20px;color: #2196F3;">engineering.tomorrow.together</p>
                    </center>

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

    $result = $db->intereval->updateOne(array("prf"=>$_POST['prf'],"pos"=>$_POST['pos'],"iid"=>$_POST['iid'],"rid"=>$_POST['rid'],"email"=>$candidate),array('$set'=>array("offerletter"=>"sent")));


    //Query to update round id in token of member
    $criteria2=array("prf"=>$_POST['prf'],"pos"=>$_POST['pos']."*","rid"=>$_POST['rid'],'iid'=>$_POST['iid'],"email"=>$candidate); 

    //Changed by sarang - 10/01/2020
    $db->tokens->updateOne(array("email"=>$candidate),array('$set'=>array("progress"=>"Offer Letter sent","afterselection"=>"6")));


    if($mail->send()) 
    {
        echo "success";
    }
    else
    {
        echo "not sent";
    }

}
else
{
    header("refresh:0;url=notfound.html");    
}

?>