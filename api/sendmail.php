<?php
session_start();
include 'maildetails.php';
include 'db.php';

$mail->setFrom('thyssenkrupp@tkep.com', 'tkei');
$mail->addReplyTo(Email, 'Information');
$mail->isHTML(true);   
// $mail->SMTPDebug = 4;                               // Enable verbose debug output

$expdate = strtotime("+7 day");
$expdate = date("Y-m-d", $expdate);

$_SESSION['department'] = $_POST['dept'];
$ctr = 0;
$position = str_replace(' ', '%20', $_POST['position']);
$positionorg = $_POST['position'];
$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
$arr = [];
if($cursor)
{
    $count=0;
    foreach ($db->listCollections() as $collectionInfo) {
       // var_dump($collectionInfo['name']);
        if($collectionInfo['name']=='rounds')
        {
            $count=1;
        }
       
    }
    if($count==1) //if round collection is present
    {
                $i=0;
                $result = $db->rounds->find(array("prf"=>$_POST['prf'],"rg"=>$cursor["rg"],"dept"=>$_POST['dept'],"pos"=>$_POST['pos']),array('sort' => array('_id' => -1)));
            $c=0;
            foreach($result as $d)
            {
                $arr[$i]=$d;
                $i=$i+1;
            }
            if(count($arr)==0)
            {//bad case when collection is present but no data
              
                $ctr=0;
                $instanceid=$instanceId=(string)sprintf("%03s",1);
                foreach($_POST['emails'] as $d)
                {
                    $mail->addAddress($d);
                    $token=sha1($d);
                    $url='http://'.$_SERVER['SERVER_NAME'].'/hrms/applicationblank.php?token='.$token.'&position='.$position;

                    $mail->Subject = "Invitation to interview with thyssenkrupp for the ". $positionorg." position";
                    $mail->AddEmbeddedImage("../public/logo.png", "logoimg", "../public/logo.png");
                    $mail->isHTML(true);  
                    $mail->Body ='
                    <body style="background-color:white;"> 
                        <table align="center" border="0" cellpadding="0" cellspacing="0"
                            width="750" bgcolor="white" > 
                            <tbody> 
                                <tr> 
                                    <td align="center"> 
                                
                                        <table align="center" border="0" cellpadding="0"
                                            cellspacing="0" class="col-550" width="750" style="background-color: rgb(0,160,246);"> 
                                            <tbody> 
                                                <tr> 
                                                    <td align="center; 
                                                            height: 50px;">  
                                                            <center>
                                                            <p style="font-size:30px;color:white;">
															thyssenkrup Elevators
                                                            </p>
                                                            </center>
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
                                            
                                            background-color: white;"> 
                                        
                                    
                                        <p class="data"
                                        style="text-align: justify-all; 
                                                align-items: center; 
                                                font-size: 18px; 
                                                padding-bottom: 12px;"> 
                                                Dear Candidate,<br></br><br></br>

                                                Further to our discussion for the profile of '. $positionorg.' in department - '.$_POST['dept'].' You are required to provide your basic
                                                details by accessing the below link so that your application could be processed further.
                                                <br></br><br></br>
                                                To access the link, please click <a href='.$url.'>here</a>
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
                    else
                    {
                        $db->tokens->insertOne(array("email"=>$d,"token"=>$token,"prf"=>$_POST['prf'],"dept"=>$_POST['dept'],"pos"=>$_POST['pos'],"position"=>$_POST['position'],"rg"=>$cursor["rg"],"rid"=>"00","expiry"=>$expdate,"iid"=>$instanceid));
                    }

                    $mail->ClearAddresses();
                }
                if($ctr==0)
                {
                    //"poszone"=>$_POST['poszone']
                    $r = $db->prfs->updateOne(array("prf"=>$_POST['prf'],"department"=>$_POST['dept'],"pos"=>$_POST['pos'],"position"=>$_POST['position']),array('$set'=>array("progress"=>"initiated")));
                    
                    $db->rounds->insertOne(array(
                        "status"=>"bstart",
                        "prf"=>$_POST['prf'],
                        "dept"=>$_POST['dept'],
                        "pos"=>$_POST['pos'],
                        "poszone"=>$_POST['poszone'],
                        "position"=>$_POST['position'],
                        "rg"=>$cursor["rg"],
                        "rid"=>"00",
                        "expiry"=>$expdate,
                        "iid"=>$instanceid,
                        "members"=>$_POST['emails'],
                        "selected"=>array(),
                        "rejected"=>array(),
                        "onhold"=>array())
                    );
                    $fp = fopen('prflogs.txt', 'a');
                    $d = date("Y/m/d");
                    $m = $cursor['mail'];
                    $prf = $_POST['prf'];
                    $dept = $_POST['dept'];
                    fwrite($fp, "\n".$d."\t".$prf."\t".$m."\t".$dept);
                    fclose($fp);  
                    echo "sent";

                    $date = date_default_timezone_set('Asia/Kolkata');
           
                    $today = date("Y-m-d H-i-s");

                     //Current user

                     $newData=array('$set' => array("status" => "initiated","init_time"=>$today));

                     $db->generalized->updateOne(array("prf"=>$_POST['prf']),$newData);

                }
                else
                {
                    echo "notsent";
                }
            }
            else
            {   //when there is collection + some data
                $instanceid=$arr[0]['iid'];
                $instanceid=$instanceid+1;
                $instanceid=(string)sprintf("%03s",$instanceid);
                $ctr=0;
                foreach($_POST['emails'] as $d)
                {
                    $mail->addAddress($d);
                    $token=sha1($d);
                    $url='http://'.$_SERVER['SERVER_NAME'].'/hrms/applicationblank.php?token='.$token.'&position='.$position;

                    $mail->Subject = "Update on your application at thyssenkrupp for ". $position." position";
                    $mail->AddEmbeddedImage("../public/logo.png", "logoimg", "../public/logo.png");
                    $mail->isHTML(true); 
                    $mail->Body ='
                    <body style="background-color:white;"> 
                        <table align="center" border="0" cellpadding="0" cellspacing="0"
                            width="750" bgcolor="white" > 
                            <tbody> 
                                <tr> 
                                    <td align="center"> 
                                
                                        <table align="center" border="0" cellpadding="0"
                                            cellspacing="0" class="col-550" width="750" style="background-color: rgb(0,160,246);"> 
                                            <tbody> 
                                                <tr> 
                                                    <td align="center; 
                                                            height: 50px;">  
                                                            <center>
                                                            <p style="font-size:30px;color:white;">
															thyssenkrup Elevators
                                                            </p>
                                                            </center>
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
                                            
                                            background-color: white;"> 
                                        
                                    
                                        <p class="data"
                                        style="text-align: justify-all; 
                                                align-items: center; 
                                                font-size: 18px; 
                                                padding-bottom: 12px;"> 
                                                Dear Candidate,<br></br><br></br>

                                                Further to our discussion for the profile of '. $positionorg.' in department - '.$_POST['dept'].' You are required to provide your basic
                                                details by accessing the below link so that your application could be processed further.
                                                <br></br><br></br>
                                                To access the link, please click <a href='.$url.'>here</a>
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
                    else
                    {
                        $db->tokens->insertOne(array("email"=>$d,"token"=>$token,"prf"=>$_POST['prf'],"dept"=>$_POST['dept'],"pos"=>$_POST['pos'],"position"=>$_POST['position'],"rg"=>$cursor["rg"],"rid"=>"00","expiry"=>$expdate,"iid"=>$instanceid));
                        $date = date_default_timezone_set('Asia/Kolkata');
           
                        $today = date("Y-m-d H-i-s");

                        //Current user

                        $newData=array('$set' => array("status" => "initiated","init_time"=>$today));

                        $db->generalized->updateOne(array("prf"=>$_POST['prf']),$newData);


                    }
                    
                    $mail->ClearAddresses();
                }
                if($ctr==0)
                {
                    $r = $db->prfs->updateOne(array("prf"=>$_POST['prf'],"department"=>$_POST['dept'],"pos"=>$_POST['pos'],"position"=>$_POST['position']),array('$set'=>array("progress"=>"initiated")));

                    $db->rounds->insertOne(array(
                        "status"=>"bstart",
                        "prf"=>$_POST['prf'],
                        "dept"=>$_POST['dept'],
                        "pos"=>$_POST['pos'],
                        "poszone"=>$_POST['poszone'],
                        "position"=>$_POST['position'],
                        "rg"=>$cursor["rg"],
                        "rid"=>"00",
                        "expiry"=>$expdate,
                        "iid"=>$instanceid,
                        "members"=>$_POST['emails'],
                        "selected"=>array(),
                        "rejected"=>array(),
                        "onhold"=>array())
                    );    
                    $fp = fopen('prflogs.txt', 'a');
                    $d = date("Y/m/d");
                    $m = $cursor['mail'];
                    $prf = $_POST['prf'];
                    $dept = $_POST['dept'];
                    fwrite($fp, "\n".$d."\t".$prf."\t".$m."\t".$dept);
                    fclose($fp);  
                    echo "sent";

                    $date = date_default_timezone_set('Asia/Kolkata');
           
                    $today = date("Y-m-d H-i-s");

                    //Current user

                    $newData=array('$set' => array("status" => "initiated","init_time"=>$today));

                    $db->generalized->updateOne(array("prf"=>$_POST['prf']),$newData);


                }
                else
                {
                    echo "notsent";
                }
               
            
            }
      
    }
    else   
    {//when there is no collection
            $ctr=0;
            $instanceid=$instanceId=(string)sprintf("%03s",1);
                foreach($_POST['emails'] as $d)
                {
                    $mail->addAddress($d);
                    $token=sha1($d);
                    $url='http://'.$_SERVER['SERVER_NAME'].'/hrms/applicationblank.php?token='.$token.'&position='.$position;

                    $mail->Subject = "Update on your application at thyssenkrupp for ". $position." position";
                    $mail->AddEmbeddedImage("../public/logo.png", "logoimg", "../public/logo.png");
                    $mail->isHTML(true); 
                    $mail->Body ='
                    <body style="background-color:white;"> 
                        <table align="center" border="0" cellpadding="0" cellspacing="0"
                            width="750" bgcolor="white" > 
                            <tbody> 
                                <tr> 
                                    <td align="center"> 
                                
                                        <table align="center" border="0" cellpadding="0"
                                            cellspacing="0" class="col-550" width="750" style="background-color: rgb(0,160,246);"> 
                                            <tbody> 
                                                <tr> 
                                                    <td align="center; 
                                                            height: 50px;">  
                                                            <center>
                                                            <p style="font-size:30px;color:white;">
															thyssenkrup Elevators
                                                            </p>
                                                            </center>
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
                                            
                                            background-color: white;"> 
                                        
                                    
                                        <p class="data"
                                        style="text-align: justify-all; 
                                                align-items: center; 
                                                font-size: 18px; 
                                                padding-bottom: 12px;"> 
                                                Dear Candidate,<br></br><br></br>

                                                Further to our discussion for the profile of '. $positionorg.' in department - '.$_POST['dept'].' You are required to provide your basic
                                                details by accessing the below link so that your application could be processed further.
                                                <br></br><br></br>
                                                To access the link, please click <a href='.$url.'>here</a>
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
                    else
                    {
                      
                        $db->tokens->insertOne(array("email"=>$d,"token"=>$token,"prf"=>$_POST['prf'],"dept"=>$_POST['dept'],"pos"=>$_POST['pos'],"position"=>$_POST['position'],"rg"=>$cursor["rg"],"rid"=>"00","expiry"=>$expdate,"iid"=>$instanceid));
                        
                        
                    }

                    $mail->ClearAddresses();
                }
                if($ctr==0)
                {
                    $r = $db->prfs->updateOne(array("prf"=>$_POST['prf'],"department"=>$_POST['dept'],"pos"=>$_POST['pos'],"position"=>$_POST['position']),array('$set'=>array("progress"=>"initiated")));
                   
                    $db->rounds->insertOne(
                        array(
                            "status"=>"bstart",
                            "prf"=>$_POST['prf'],
                            "dept"=>$_POST['dept'],
                            "pos"=>$_POST['pos'],
                            "poszone"=>$_POST['poszone'],
                            "position"=>$_POST['position'],
                            "rg"=>$cursor["rg"],
                            "rid"=>"00",
                            "expiry"=>$expdate,
                            "iid"=>$instanceid,
                            "members"=>$_POST['emails'],
                            "selected"=>array(),
                            "rejected"=>array(),
                            "onhold"=>array()));
                    
                    $fp = fopen('prflogs.txt', 'a');
                    $d = date("Y/m/d");
                    $m = $cursor['mail'];
                    $prf = $_POST['prf'];
                    $dept = $_POST['dept'];
                    fwrite($fp, "\n".$d."\t".$prf."\t".$m."\t".$dept);
                    fclose($fp);  
                    echo "sent";

                    $date = date_default_timezone_set('Asia/Kolkata');
           
                    $today = date("Y-m-d H-i-s");

                    //Current user

                    $newData=array('$set' => array("status" => "initiated","init_time"=>$today));

                    $db->generalized->updateOne(array("prf"=>$_POST['prf']),$newData);


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