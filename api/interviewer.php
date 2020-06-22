<?php

include 'db.php';
include 'maildetails.php';
$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));

if($cursor)
{
    $mail->setFrom("tkep", 'tkei');
    $mail->addReplyTo(Email, 'Information');
    $mail->isHTML(true);   
    //$mail->SMTPDebug=4;
    $invname=$_POST['intv'];
    $date=$_POST['date'];
    $time=$_POST['time'];
    $digit13 = explode("/", $_POST['prf']);

    //getting the latest round from DB
    $result = $db->rounds->find(array("prf"=>$digit13[0],"pos"=>$digit13[1],"iid"=>$digit13[2]),array('sort' => array('_id' => -1)));

    $i = 0;
    
    foreach($result as $doc)
    {
        $arr[$i] = $doc;
        $i++;
    }

    $result = $arr[0];
    if($result["rid"]>=1)
    {
        //if round is 1 dont increment
        $rid =(string) sprintf("%02s",$result["rid"]);
    }
    else
    {
        //if round is 0 then increment it 
        $rid =(string) sprintf("%02s",$result["rid"]+1);
    }

    //append single zero at the beginning to make it two digit number
    $rid =(string) sprintf("%02s",$rid);
    $result3 = $db->prfs->findOne(array("prf"=>$digit13[0]));

    //Inserting a new interview in interviews collection 
    $insertinvrecord = $db->interviews->insertOne(array("rid"=>$rid,"prf"=>$digit13[0],'pos'=>$digit13[1],"iid"=>$digit13[2],"members"=>$_POST['emails'],"times"=>$_POST['times'],"modtimes"=>$_POST['times'],"dates"=>$_POST['dates'],"moddates"=>$_POST['dates'],"evaluated"=>array(),"intvmail"=>$_POST['intv'],"invname"=>$_POST['iname'],"designation"=>$_POST['idesg'],"dept"=>$_POST['idept'],"ilocation"=>$_POST['iloc'],"iperson"=>$_POST['iperson'],"status"=>"0","invstatus"=>"0","accepted"=>"no"));
    
    $date = date_default_timezone_set('Asia/Kolkata');
           
    $today = date("Y-m-d H-i-s");

                        //Current user

    $newData=array('$set' => array("status" => "assigned","assign_time"=>$today));

    $db->generalized->updateOne(array("prf"=>$digit13[0]),$newData);



    if($insertinvrecord)
    {
        
        $criteria=array("status"=>"ristart","prf"=>$digit13[0],"pos"=>$digit13[1],"rid"=>"01",'iid'=>$digit13[2],"dept"=>$digit13[4],"poszone"=>$digit13[5]);
    
        foreach($_POST['emails'] as $d)
        {
            //Query to add the available data - iid ,rid,prf,members
            $db->rounds->updateOne($criteria,array('$push'=>array('members'=>$d)),array('safe'=>true,'timeout'=>5000,'upsert'=>true));  
    
            //Query to update round id in token of member
             $criteria2=array("prf"=>$digit13[0],"pos"=>$digit13[1],"rid"=>"00",'iid'=>$digit13[2],"email"=>$d); 
             $db->tokens->updateOne($criteria2,array('$set'=>array("progress"=>"01")));
            
            //Query to remove members from selectedremove 
            $res=$db->rounds->updateOne(array("rid"=>"00",'iid'=>$digit13[2],"prf"=>$digit13[0],"pos"=>$digit13[1]),array('$pull'=>array('selectedremove'=>$d)),array('safe'=>true,'timeout'=>5000,'upsert'=>true)); 
        }
    
        //Query to add empty arrays to documents - selected, rejected, onhold
        $db->rounds->updateOne($criteria,array('$set'=>array("selected"=>array(),"rejected"=>array(),"onhold"=>array())));
        //send mail to  interviewer 
        $dashurl="http://localhost/hrms/invdash.php";
        $mail->addAddress($_POST['intv']);
        $mail->Subject = 'Interview schedule for '.$result3['department'].' - '.$result3['position'].' .';
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
        else
        {
            echo "notsent";
        }   
    }
    else
    {
        echo "fail";
    }

   

       
///newly added

    //Below conditions is to check whether all the candidates are assigned to interviewer 
    $countRound=$db->rounds->findOne(array("rid"=>"00",'iid'=>$digit13[2],"prf"=>$digit13[0],"pos"=>$digit13[1]));
    $countRound1=$db->rounds->findOne(array("rid"=>"01",'iid'=>$digit13[2],"prf"=>$digit13[0],"pos"=>$digit13[1]));
   
     $result1=$countRound['selectedremove'];
     $result2=$countRound['members'];
   
    
    $orderCount1 =count(iterator_to_array($result1));
    $orderCount2 =count(iterator_to_array($result2));
    
    //Checking whether all members are allocated to an interviewer
    if($orderCount1<$orderCount2 || $orderCount1==0)
    {
        //if Yes Change the status of the base round to complete 
        $db->rounds->updateMany(array("rid"=>"00",'iid'=>$digit13[2],"prf"=>$digit13[0],"pos"=>$digit13[1]),array('$set'=>array("status"=>"bcomplete")));
        echo "Status Changed";
    }
    else
    {
        echo "Status not Changed";
    }

}
else
{
    header("refresh:0,url=notfound.html");
}
    
?>