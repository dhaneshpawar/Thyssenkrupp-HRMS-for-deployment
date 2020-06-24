<?php
include 'api/maildetails.php';
include 'api/db.php';

$mail->setFrom('thyssenkrupp@tkep.com', 'tkei');
$mail->addReplyTo("sarang@123", 'Information');
$mail->isHTML(true);   
// $mail->SMTPDebug = 4;

$expdate = strtotime("+7 day");
$expdate = date("Y-m-d", $expdate); 

$ctr = 0;

$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
$arr = [];
$self = $_SERVER["REQUEST_URI"];
 //echo "PRF".$host.$self;
 $url_components = parse_url($self); 
 parse_str($url_components['query'], $params); 

$prf=$params['prf'];
$pos=$params['pos'];
$dept=$params['dept'];
$position = $params['position'];
$position2 = str_replace(' ', '%20', $params['position']);



function readCSV($csvFile){
    $file_handle = fopen($csvFile, 'r');
    while (!feof($file_handle) ) {
        $line_of_text[] = fgetcsv($file_handle, 1024);
    }
    fclose($file_handle);
    return $line_of_text;
}

if(isset($_FILES))
{
    include 'api/db.php';
    // Set path to CSV file
    // $csvFile = 'test.csv';
    $csvFile = $_FILES['uploadcsv']['name'];
    $ctemp = $_FILES["uploadcsv"]['tmp_name'];
    move_uploaded_file($ctemp,"EmailDumps/".$csvFile);
    $csvFile = "EmailDumps/".$csvFile;
    $cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
    
    $csv = readCSV($csvFile);
}
//START - Make an array of emails from the csv
    $j = 0;
    for($i = 1; $i < count($csv)-1; $i++)
    {
        $emails[$j]=$csv[$i][1] ? $csv[$i][1] :"null";
        $j++;
                //  echo $emails[$i];
    } 

    
    // $emails = iterator_to_array($emails);
//END -  Make an array of emails from the csv

$count=0;

//START - Check for rounds collection
    foreach ($db->listCollections() as $collectionInfo) {
       // var_dump($collectionInfo['name']);
        if($collectionInfo['name']=='rounds')
        {
            $count=1;
        }
       
    }
//END - Check for rounds collection


if($count==1) //if round collection is present
{
            $i=0;
            $result = $db->rounds->find(array("prf"=>$prf,"dept"=>$dept,"pos"=>$pos),array('sort' => array('_id' => -1)));
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
            foreach($emails as $d)
            {
                // echo $d;
                $mail->addAddress($d);
                $token=sha1($d);
                $url='http://'.$_SERVER['SERVER_NAME'].'/hrms/applicationblank.php?token='.$token.'&position='.$position2;

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
                    //$db->tokens->insertOne(array("email"=>$d,"token"=>$token,"prf"=>$_POST['prf'],"dept"=>$_POST['dept'],"pos"=>$_POST['posdetail'],"position"=>$_POST['pos'],"rg"=>$cursor["rg"],"rid"=>"00","iid"=>$instanceid));
                     $val=$db->tokens->insertOne(array(
                    "email" => $d,
                    "token" =>$token,
                    "prf" =>$prf,
                    "pos"=>$pos,
                    "position"=>$position,
                    "dept"=>$dept,
                    "rid"=>"00",
                    "iid"=>$instanceid,
                    "expiry"=>$expdate
                   ));
                
                }

                $mail->ClearAddresses();
            }
            if($ctr==0)
            {
                $r = $db->prfs->updateOne(array("prf"=>$prf,"department"=>$dept,"pos"=>$pos,"position"=>$position),array('$set'=>array("progress"=>"initiated")));
                $emails = json_decode(json_encode($emails), true);
                $db->rounds->insertOne(array("status"=>"bstart","prf"=>$prf,"dept"=>$dept,"pos"=>$pos,"position"=>$position,"rg"=>$cursor["rg"],"rid"=>"00","iid"=>$instanceid,"expiry"=>$expdate,"members"=>$emails,"selected"=>array(),"rejected"=>array(),"onhold"=>array()));    
                echo "<script>alert('File Uploaded Successfully')</script>";
                header("refresh:0;url=http://localhost/hrms/hrnew.php");
            }
            else
            {
                
                echo "<script>alert('File Upload Failed')</script>";
                header("refresh:0;url=http://localhost/hrms/hrnew.php");
            }
        }
        else
        {   //when there is collection + some data
            $instanceid=$arr[0]['iid'];
            $instanceid=$instanceid+1;
            $instanceid=(string)sprintf("%03s",$instanceid);
            $ctr=0;
            foreach($emails as $d)
            {
                $mail->addAddress($d);
                $token=sha1($d);
                $url='http://'.$_SERVER['SERVER_NAME'].'/hrms/applicationblank.php?token='.$token.'&position='.$position2;

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
                    // $db->tokens->insertOne(array("email"=>$d,"token"=>$token,"prf"=>$_POST['prf'],"dept"=>$_POST['dept'],"pos"=>$_POST['posdetail'],"position"=>$_POST['pos'],"rg"=>$cursor["rg"],"rid"=>"00","iid"=>$instanceid));
                    $val=$db->tokens->insertOne(array(
                        "email" => $d,
                        "token" =>$token,
                        "prf" =>$prf,
                        "pos"=>$pos,
                        "position"=>$position,
                        "dept"=>$dept,
                        "rid"=>"00",
                        "iid"=>$instanceid,
                        "expiry"=>$expdate
                       ));
                }

                $mail->ClearAddresses();
            }
            if($ctr==0)
            {
                $r = $db->prfs->updateOne(array("prf"=>$prf,"department"=>$dept,"pos"=>$pos,"position"=>$position),array('$set'=>array("progress"=>"initiated")));
                $emails = json_decode(json_encode($emails), true);
                $db->rounds->insertOne(array("status"=>"bstart","prf"=>$prf,"dept"=>$dept,"pos"=>$pos,"position"=>$position,"rid"=>"00","iid"=>$instanceid,"expiry"=>$expdate,"members"=>$emails,"selected"=>array(),"rejected"=>array(),"onhold"=>array()));    
                // echo "sent";
                echo "<script>alert('File Uploade Successfully')</script>";

                header("refresh:0;url=http://localhost/hrms/hrnew.php");
            }
            else
            {
                // echo "notsent2";
                echo "<script>alert('File Upload Failed')</script>";

                header("refresh:0;url=http://localhost/hrms/hrnew.php");
            }
           
        
        }
  
}

else   
{//when there is no collection
        $ctr=0;
        $instanceid=$instanceId=(string)sprintf("%03s",1);
        
            foreach($emails as $d)
            {
                $mail->addAddress($d);
                $token=sha1($d);
                $url='http://'.$_SERVER['SERVER_NAME'].'/hrms/applicationblank.php?token='.$token.'&position='.$position2;

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
                    // echo "Not sent";
                    $ctr = 1;
                }
                else
                {
                  
                   $val=$db->tokens->insertOne(array(
                        "email" => $d,
                        "token" =>$token,
                        "prf" =>$prf,
                        "pos"=>$pos,
                        "position"=>$position,
                        "dept"=>$dept,
                        "rid"=>"00",
                        "iid"=>$instanceid,
                        "expiry"=>$expdate
                       ));
                    //    $ctr==0;
                }
                // echo "Counter : ".$ctr;
                $mail->ClearAddresses();
            }
            if($ctr==0)
            {
                $r = $db->prfs->updateOne(array("prf"=>$prf,"department"=>$dept,"pos"=>$pos,"position"=>$position),array('$set'=>array("progress"=>"initiated")));
                $emails = json_decode(json_encode($emails), true);
                $db->rounds->insertOne(array("status"=>"bstart","prf"=>$prf,"dept"=>$dept,"pos"=>$pos,"position"=>$position,"rid"=>"00","iid"=>$instanceid,"expiry"=>$expdate,"members"=>$emails,"selected"=>array(),"rejected"=>array(),"onhold"=>array()));
                // echo "sent";
                echo "<script>alert('File Uploaded Successfully')</script>";

                header("refresh:0;url=http://localhost/hrms/hrnew.php");
            }
            else
            {
                // echo "notsent3";
                echo "<script>alert('File Upload Failed')</script>";

                header("refresh:0;url=http://localhost/hrms/hrnew.php");
            }
   

}




?>