<?php 
include 'db.php';

include 'maildetails.php';

$cnt = 0;
$restmembers = array();
for($i=0;$i<count($_POST['allmembers']);$i++)
{
    $allmembers[$i] = $_POST['allmembers'][$i][1];
}
$restmembers = array_merge(array_diff($allmembers, $_POST['emails']), array_diff($_POST['emails'], $allmembers));
for($i=0;$i<count($restmembers);$i++)
{
    $restmembers[$i] = $restmembers[$i].",notforhr2";
}
$mail->setFrom('thyssenkrupp@tkep.com', 'tkei');
$mail->addReplyTo(Email, 'Information');
$mail->isHTML(true);
$ctr=0;


$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
if(isset($_POST) and $cursor)
{
    $digit13 = preg_split('/[-]/', $_POST['prf']);
    $selected=$_POST['emails'];
    $arr = array();


    $date = date_default_timezone_set('Asia/Kolkata');
           
    $today = date("Y-m-d H-i-s");

                        //Current user

    $newData=array('$set' => array("status" => "completed","comp_time"=>$today));

    $db->generalized->updateOne(array("prf"=>$digit13[0]),$newData);


    if($selected == 'nomail')
    {
        $db->rounds->updateMany(array("rid"=>$digit13[3],"prf"=>$digit13[0],"iid"=>$digit13[2],"pos"=>$digit13[1]),array('$set'=>array("status"=>"completed","completevalidate"=>"novalidate")));
        $db->prfs->updateMany(array("prf"=>$digit13[0]),array('$set'=>array("status"=>"completed")));     
        echo "nomails";
    }
    else
    {
            foreach($selected as $d)
            {
                $q = $db->tokens->findOne(array("email"=>$d));
                $q1 = $db->prfs->findOne(array("prf"=>$digit13[0]));
                $mail->addAddress($d);
                $token=sha1($d);
                $date = strtotime("+7 day");
                $expdate = date("Y.m.d", $date);                

                $url='http://'.$_SERVER['SERVER_NAME'].'/hrms/post-candidate-selection.php?token='.$d.'&explink='.$expdate;

                $mail->Subject = 'Your interview with thyssenkrupp for the '.$q1['position'].' position -Further Details';
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
                                                Dear '.$q['full_name'].',
                                                <br><br>
                                                Thank you for taking time to talk to us about the '.$q1['position'].' . It was a great pleasure meeting
                                                you and we think that you’d be a good fit for this role.
                                                <br><br>
                                                As a next step, we want you to submit the requisite documents to process your application
                                                further.
                                                <br><br>
                                                Please click <a href='.$url.'>here</a> to upload the documents.
                                                <br><br>
                                                Feel free to reach out in case of any query.
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

            
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                $result=$db->tokens->updateOne(array("email"=>$d),array('$set'=>array("afterselection"=>'0')));
                $result=$db->rounds->updateOne(array("prf"=>$digit13[0],"pos"=>$digit13[1],'iid'=>$digit13[2],"rid"=>$digit13[3]),array('$addToSet'=>array('selected'=>$d)),array('safe'=>true,'timeout'=>5000,'upsert'=>true));
                
                 //Query to update round id in token of member
                 $criteria2=array("prf"=>$digit13[0],"pos"=>$digit13[1],'iid'=>$digit13[2],"rid"=>$digit13[3],"email"=>$d); 
                 $db->tokens->updateOne($criteria2,array('$set'=>array("progress"=>"Selected")));
                 

                if(!$mail->send()) 
                {
                    $ctr = 1;
                }
                $mail->ClearAddresses();
            }
            if($ctr==0)
            {     
                echo "sent";
                //Changed by sarang - 10/01/2020
               $db->rounds->updateMany(array("rid"=>$digit13[3],"prf"=>$digit13[0],"iid"=>$digit13[2],"pos"=>$digit13[1]),array('$set'=>array("status"=>"completed","completevalidate"=>"inprocess")));
               $db->prfs->updateMany(array("prf"=>$digit13[0]),array('$set'=>array("status"=>"completed")));  
               if(count($restmembers) != 0)
               {
                $db->rounds->updateMany(array("rid"=>$digit13[3],"prf"=>$digit13[0],"iid"=>$digit13[2],"pos"=>$digit13[1]),array('$set'=>array("onhold"=>$restmembers)),array('safe'=>true,'timeout'=>5000,'upsert'=>true));
               }
            }
            else
            {
                echo "notsent";
            }
          
    }
   
     
}
else
{
    header("refresh:0;url=notfound.html");
}
?>