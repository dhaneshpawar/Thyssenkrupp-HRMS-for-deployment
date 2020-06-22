<?php

include "db.php";
$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
if($cursor)
{

        include 'maildetails.php';
        
        $mail->setFrom('thyssenkrupp@tkep.com', 'tkei');
        $mail->addReplyTo(Email, 'Information');
        $mail->isHTML(true); 

        $ctr=0;
        $mails= $_POST['mail'];
        $valid=$_POST["valid"];
        if(isset($_POST['invalid']))
        {
            echo " Hello";
            $invalid=$_POST["invalid"];
            foreach($invalid as $d)
            {
                $db->tokens->updateOne(array("email"=>$mails),array('$addToSet'=>array("invalid"=>$d)));
            }
        }
        else
        {
            $invalid=array();
            $db->tokens->updateOne(array("email"=>$mails),array('$set'=>array("invalid"=>$invalid)));
            
        }
        
        foreach($valid as $v)
        {
            $db->tokens->updateOne(array("email"=>$mails),array('$addToSet'=>array("valid"=>$v)));
        }


        //Start - pulling values from invalid to valid
        $validin=$db->tokens->findOne(array("email"=>$mails));
        $val=$validin['valid'];
        $inval=$validin['invalid'];
        
        $val=iterator_to_array($val);
        $inval=iterator_to_array($inval);

        $result = array_intersect($val,$inval); 
        print_r($result);
        $countintersect=count($result);
            //  echo "Count ".$countintersect;
        
        if($countintersect == 0)
        {

        }
        else
        {
            foreach($result as $g)
            {
                $db->tokens->updateOne(array("email"=>$mails),array('$pull'=>array("invalid"=>$g)),array('safe'=>true,'timeout'=>5000,'upsert'=>true));
                // $db->interviews->updateOne($criteria,array('$pull'=>array('members'=>$_GET["name"])),array('safe'=>true,'timeout'=>5000,'upsert'=>true));

            }
        }
        //END - pulling values from invalid to valid


        $result=$db->tokens->updateOne(array("email"=>$mails),array('$set'=>array("cvreason"=>$_POST['cv']?$_POST['cv']:"Validated","pancardreason"=>$_POST['pancard']?$_POST['pancard']:"Validated","adhaarreason"=>$_POST['adhaar']?$_POST['adhaar']:"Validated","photoreason"=>$_POST['photo']?$_POST['photo']:"Validated","graduatereason"=>$_POST['graduate']?$_POST['graduate']:"Validated","addressreason"=>$_POST['address']?$_POST['address']:"Validated","cancheckreason"=>$_POST['cancheck']?$_POST['cancheck']:"Validated","appletterreason"=>$_POST['appletter']?$_POST['appletter']:"Validated","pastpayslipreason"=>$_POST['pastpayslip']?$_POST['pastpayslip']:"Validated","relletterreason"=>$_POST['relletter']?$_POST['relletter']:"Validated")));
        
        
        if($result)
        {
            $i=0;
            $find = $db->tokens->findOne(array("email"=>$mails));
            
            
            $arr =iterator_to_array($find["invalid"]);
            
            if(count($arr)>=1)
            {
                $result=$db->tokens->updateOne(array("email"=>$mails),array('$set'=>array("afterselection"=>"4","validationstatus"=>"1")));
                $mail->addAddress($mails); 
                $token=sha1($mails);

                $date = strtotime("+7 day");
                $expdate = date("Y.m.d", $date);

                $url='http://'.$_SERVER['SERVER_NAME'].'/hrms/reupload.php?token='.$mails.'&expdate='.$expdate;
                $mail->Subject = 'Your Application at tkEI - Re-enter the requisite details';
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
                                                Dear '.$find['full_name'].',
                                                <br><br>
                                                We are pleased to confirm that we have received your documents. Thank you. Please be
                                                updated that some more clarity is required on the following.
                                                <br><br>
                                                Click <a href='.$url.'>here</a> to reupload documents
                                                <br><br>
                                                You are required to complete the same at the earliest.
                                                <br><br>
                                                In-case of any query, feel free to reach out to recruitment@tkeap.com
                                                
                                                tkEI Recruiting Team.
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
                    
                if($mail->send()) 
                {
                    echo "sent invalid";
                }
                else
                {
                    echo "notsent invalid" ;
                }
            }
            else if(count($arr)==0)
            {
                $result=$db->tokens->updateOne(array("email"=>$mails),array('$set'=>array("afterselection"=>"2","validationstatus"=>"0")));
            
                $mail->addAddress($mails);
                $token=sha1($mails);
                $mail->Subject = 'Document Verification Successfull';
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
                                            <br><br>
                                            All your documents are valid you can visit us for further information
                                            <br><br>
                                            In-case of any query, feel free to reach out to recruitment@tkeap.com
                                            <br><br>
                                            tkEI Recruiting Team.
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
                if(!$mail->send()) 
                {
                    echo "notsent valid";
                }
                else
                {
                    echo "sent valid" ;
                }
            }
            
            }   
        else
        {
            //    echo "Hud";
        }
    }
    else
    {
         header("refresh:0;url=notfound.html");    
    }
   ?>