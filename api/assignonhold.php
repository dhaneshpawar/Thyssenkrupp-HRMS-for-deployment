<?php

// Connection to Database
include 'db.php';


// Check for Login
$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
if($cursor)
{
    if(isset($_POST))
    {
        include 'maildetails.php';
        $mail->setFrom("tkep", 'tkei');
        $mail->addReplyTo(Email, 'Information');
        $mail->isHTML(true);  
        $result = $db->rounds->find(array("prf"=>$_POST["prf"],"pos"=>$_POST['pos'],"iid"=>$_POST['iid']),array('sort' => array('_id' => -1)));

        $i = 0;
        
        foreach($result as $doc)
        {
            $arr[$i] = $doc;
            $i++;
        }

        $result = $arr[0];
        $iid =(string) sprintf("%03s",$result["iid"]+1);
        $dashurl="http://localhost/hrms/invdash.php";
        $result3 = $db->prfs->findOne(array("prf"=>$_POST["prf"]));
        $interviewUpdate = $db->interviews->insertOne(array("rid"=>"01","prf"=>$_POST["prf"],'pos'=>$_POST["pos"],"iid"=>$iid,"members"=>$_POST['emails'],"evaluated"=>array(),"intvmail"=>$_POST["intvmail"],"invname"=>$_POST["iname"],"designation"=>$_POST['idesg'],"dept"=>$_POST['dept'],"date"=>$_POST['date'],"time"=>$_POST['time'],"ilocation"=>$_POST['iloc'],"iperson"=>$_POST['iperson'],"status"=>"0","invstatus"=>"0","accepted"=>"no"));
        if($interviewUpdate)
        {
            $mail->addAddress($_POST["intvmail"]);
            $mail->Subject = 'Interview schedule for '.$result3['department'].' - '.$result3['position'].' .';
            $mail->AddEmbeddedImage("../public/logo.png", "logoimg", "../public/logo.png");
            $mail->isHTML(true); 
            $mail->Body ='
                    <head>
                
                    </head>
                    <body style="background-color:white;"> 
                        <table align="center" border="0" cellpadding="0" cellspacing="0"
                            width="750" bgcolor="white" style="border: 3px solid rgb(0,160,246);"> 
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
                                                Dear '.$_POST['iname'].',
                                                <br><br>
                                                Please find below the details for the interview for the post of '.$result3['position'].' and Confirm on the site portal.
                                                <br><br>
                                                Date - '.$_POST['date'].'
                                                <br><br>
                                                Timing - '.$_POST['time'].'
                                                <br><br>
                                                Location - '.$_POST['iloc'].'
                                                <br><br>
                                                Contact Person - '.$_POST['iperson'].'
                                                <br><br>
                                                To access your dashboard for more details, please click <a href='.$dashurl.'>here</a> 
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

            if($mail->send()) 
            {
                echo "sent";
            }
            
            $criteria=array("status"=>"ristart","prf"=>$_POST["prf"],'pos'=>$_POST["pos"],"rid"=>"01",'iid'=>$iid);
            foreach($_POST['emails'] as $d)
            {
                //remove onhold candidate from previous round
                $q = $db->rounds->findOne(array("status"=>"completed","prf"=>$_POST["prf"],'pos'=>$_POST["pos"],'iid'=>$result['iid']));
                for($k=0;$k<count($q['onhold']);$k++)
                {
                    $var2 = explode(",",$q['onhold'][$k]);
                    if($var2[0] == $d)
                    {
                        $var = explode(",",$q['onhold'][$k]); 
                        if($var[1] == "absent")
                        {
                            $db->rounds->updateOne(array("status"=>"completed","prf"=>$_POST["prf"],'pos'=>$_POST["pos"],'iid'=>$result['iid']),array('$pull'=>array('onhold'=>$d.",absent")),array('safe'=>true,'timeout'=>5000,'upsert'=>true));
                        }     
                        else
                        {
                            $db->rounds->updateOne(array("status"=>"completed","prf"=>$_POST["prf"],'pos'=>$_POST["pos"],'iid'=>$result['iid']),array('$pull'=>array('onhold'=>$d)),array('safe'=>true,'timeout'=>5000,'upsert'=>true));
                        }
                    }
                }
                


                //Query to add the available data - iid ,rid,prf,members
                $db->rounds->updateOne($criteria,array('$push'=>array('members'=>$d)),array('safe'=>true,'timeout'=>5000,'upsert'=>true));  

                //Query to update round id in token of member
                $criteria2=array("prf"=>$_POST["prf"],'pos'=>$_POST["pos"],'iid'=>$result['iid'],"email"=>$d); 
                $r = $db->tokens->updateOne($criteria2,array('$set'=>array("progress"=>"01")));
                
            }
            // Query to add empty arrays to documents - selected, rejected, onhold
            $db->rounds->updateOne($criteria,array('$set'=>array("selected"=>array(),"rejected"=>array(),"onhold"=>array())));
        
        }
    }   
}
else
{
    header("refresh:0;url=notfound.html");
}

?>