<?php
session_start();
include 'db.php';

    if($_POST)
    {
            include 'maildetails.php';
            
            $fullname = $_POST["full_name"];
            $token = $_SESSION['token'];
            $collection = $db->tokens;
            $result1 = $collection->findOne(array("token" => $token));
            $res = $db->prfs->findOne(array("prf"=>$result1['prf']));
            date_default_timezone_set("Asia/Kolkata");
            $folder = $result1['email'];
            $time = date("h.i.sa");
            $date = date("Y.m.d");
            $folder = $folder."(".$date."--".$time.")";
            mkdir("../upload/".$folder);
            $namephoto = $_FILES['photo']['name'];
            $tempphoto = $_FILES["photo"]['tmp_name'];
            move_uploaded_file($tempphoto,"../upload/".$folder."/".$namephoto);
            $namephoto = "upload/".$folder."/".$namephoto;
            $namecv = $_FILES['mycv']['name'];
            $tempcv = $_FILES["mycv"]['tmp_name'];
            move_uploaded_file($tempcv,"../upload/".$folder."/".$namecv);
            $namecv = "upload/".$folder."/".$namecv;
            $namealldocs = $_FILES['alldocs']['name'];
            $tempalldocs = $_FILES["alldocs"]['tmp_name'];
            move_uploaded_file($tempalldocs,"../upload/".$folder."/".$namealldocs);
            $namealldocs =  "upload/".$folder."/".$namealldocs;
            $nameaadhar = $_FILES['proof_identity_addhar']['name'];
            $tempaadhar = $_FILES["proof_identity_addhar"]['tmp_name'];
            move_uploaded_file($tempaadhar,"../upload/".$folder."/".$nameaadhar);
            $nameaadhar = "upload/".$folder."/".$nameaadhar;
            $nameotheraadhar = $_FILES['proof_otherthanadhar']['name'];
            $tempotheraadhar = $_FILES["proof_otherthanadhar"]['tmp_name'];
            move_uploaded_file($tempotheraadhar,"../upload/".$folder."/".$nameotheraadhar);
            $nameotheraadhar =  "upload/".$folder."/".$nameotheraadhar;
            $nameaddr = $_FILES['proof_address']['name'];
            $tempaddr = $_FILES["proof_address"]['tmp_name'];
            move_uploaded_file($tempaddr,"../upload/".$folder."/".$nameaddr);
            $nameaddr =  "upload/".$folder."/".$nameaddr;
            if($result1)
            {
                $refname = $_POST['nameref0']?$_POST['nameref0']:"NA";
                $refdsg = $_POST['designationref0']?$_POST['designationref0']:"NA";
                $refcn = $_POST['cmpnmref0']?$_POST['cmpnmref0']:"NA";
                $refcontact = $_POST['contref0']?$_POST['contref0']:"NA";
                $refmail = $_POST['mailref0']?$_POST['mailref0']:"NA";

                $orgname = $_POST['orgname0']?$_POST['orgname0']:"NA";
                $olddesignation0 = $_POST['olddesignation0']?$_POST['olddesignation0']:"NA";
                $fromdate = $_POST['fromdate0']?$_POST['fromdate0']:"NA";
                $todate = $_POST['todate0']?$_POST['todate0']:"NA";
                $managername = $_POST['managername0']?$_POST['managername0']:"NA";
                $managermail = $_POST['managermail0']?$_POST['managermail0']:"NA";


                $values = array(
                "userphoto" => $namephoto,
                "usercv" => $namecv,
                    "aadharno" => $_POST["aadharno"],
                    "full_name" => $_POST["full_name"],
                    "address" => $_POST["address"],
                    "number" => $_POST["unumber"],
                    "mail" => $_POST["uemail"],
                    "dob" => $_POST["udob"],
                    "position" => $_SESSION['positionapplied'],
                    "location" => $_POST["location"],
                    "passport" => $_POST["passport"],
                    "qualification" => $_POST["qualification"],
                    "passing" => $_POST["passing"],
                    "alldocs" => $namealldocs,
                    "internet" => $_POST["internet"],
                    "checkemp" => $_POST["empref"],
                    "walk" => $_POST["walkin"],
                    "web" => $_POST["website"],
                    "other" => $_POST["other"],
                    "jdate" => $_POST["jdate"],
                    "notice" => $_POST["notice"],
                    "manager" => $_POST["manager"],
                    "ifselectposition" => $_POST["ifselectposition"],
                    "proofaadhar" => $nameaadhar,
                    "proofidentity" => $nameotheraadhar,
                    "proofaddr" => $nameaddr,
                    "fathersname" => $_POST["father"],
                    "fdob" => $_POST["fdob"],
                    "mother" => $_POST["mother"],
                    "mdob" => $_POST["mdob"],
                    "spousename" => $_POST["spouse"],
                    "spdob" => $_POST["spdob"],
                    "sgender" => $_POST["sgender"],
                    "child1" => $_POST["child1"],
                    "ch1dob" => $_POST["c1dob"],
                    "ch1gender" => $_POST["c1gender"],
                    "child2" => $_POST["child2"],
                    "ch2dob" => $_POST["c2dob"],
                    "ch2gender" => $_POST["c2gender"],
                    "homepresent" => $_POST["homepresent"],
                    "homeexpect" => $_POST["homeexp"],
                    "grosspresent" => $_POST["grosspresent"],
                    "grossexpect" => $_POST["grossexp"],
                    "ypresent" => $_POST["yearpresent"],
                    "yexpect" => $_POST["yearexp"],
                    "otherdetails" => $_POST['otherdetails']?$_POST['otherdetails']:"",
                    "refname" => $refname,
                    "refdsg" => $refdsg,
                    "refcn" => $refcn,
                    "refcontact" => $refcontact,
                    "refmail" => $refmail,
                    "orgname" =>$orgname,
                    "olddesignation0" => $olddesignation0,
                    "fromdate" => $fromdate,
                    "todate" => $todate,
                    "managername" => $managername,
                    "managermail" => $managermail,
                    "postfilled" => ""
                    
                );
                $result = $collection->updateOne(array("token" => $token),array('$set'=>$values));
            

                if($result)
                {
                    
                    $d = $result1;
                    $prf=array("prf"=>$d['prf'],"iid"=>$d['iid'],"rid"=>$d['rid'],"position"=>$d['position']);                
                

                    //Changed by Sarang - selectedremove addition
                    $db->rounds->updateOne($prf,array('$push'=>array('selected'=>$result1['email'],'selectedremove'=>$result1['email'])),array('safe'=>true,'timeout'=>5000,'upsert'=>true));
                    
                    $db->rounds->updateOne($prf,array('$pull'=>array('members'=>$result1["email"])),array('safe'=>true,'timeout'=>5000,'upsert'=>true));
                    $result = $collection->updateOne(array("token" => $token),array('$unset' => array('token' => $token,)),array('multi' => true));
                    
                    $mail->setFrom('thyssenkrupp@tkep.com', 'tkei');
                    $mail->addReplyTo(Email, 'Information');
                    $mail->isHTML(true);   
                    $mail->addAddress($result1['email']);

                    $mail->Subject = 'Update on your application at thyssenkrupp for '.$res['position'].'position';
                    $mail->AddEmbeddedImage("../public/logo.png", "logoimg", "../public/logo.png");
                    $mail->isHTML(true); 
                    $mail->Body ='
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
                                                Dear '.$fullname.' ,
                                                <br><br>
                                                We are pleased to confirm that we have received your application. Thank you. We aim to get back to you
                                                as soon as possible to let you know about the further process.
                                                <br><br>
                                                Your CV/resume has been submitted for the following position :
                                                
                                                    '.$res['department'].' - '.$res['position'].' 
                                                 <br><br>
                                                In the meantime, if you wish to know more about the organisation. Please click <a href ="https://www.thyssenkrupp-elevator.com/in/">here</a>
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
                    $mail->send();
                    header("location:../applicationblank.php?token=123");
                }
                

                $ftp_host   = 'localhost';
                $ftp_username = 'ad';
                $ftp_password = 'ad';
                

            

                

        }
        else
        {
            echo "404";
        }
    }
    else
    {
    header("refresh:0,url=notfound.html");

    }

?>