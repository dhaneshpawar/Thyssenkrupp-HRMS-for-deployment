<?php
include 'api/maildetails.php';
include 'api/db.php';

$mail->setFrom('thyssenkrupp@tkep.com', 'Interview Call');
$mail->addReplyTo("sarang@123", 'Information');
$mail->isHTML(true);   
// $mail->SMTPDebug = 4;

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
$position=$params['position'];

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
    for($i = 1; $i < count($csv)-1; $i++)
    {
        
            
                $emails[$i]=$csv[$i][1] ? $csv[$i][1] :"null";
                // echo $emails[$i];
        
    }
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
                echo $d;
                $mail->addAddress($d);
                $token=sha1($d);
                $url='http://'.$_SERVER['SERVER_NAME'].'/thyssenkrup/applicationblank.php?token='.$token;

                $mail->Subject = 'Mail Regarding Interview';
                $mail->Body    = 'You have been shortlisted for the interview. You have an interview on this date.'.$url;
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                if(!$mail->send()) 
                {
                    $ctr = 1;
                }
                else
                {
                    //$db->tokens->insertOne(array("email"=>$d,"token"=>$token,"prf"=>$_POST['prf'],"dept"=>$_POST['dept'],"pos"=>$_POST['posdetail'],"position"=>$_POST['pos'],"rg"=>$cursor["rg"],"rid"=>"00","iid"=>$instanceid));
                     $val=$db->tokens->insertOne(array(
                    // "email" => $d,
                    // "prf" =>$prf,
                    // "pos"=>$pos,
                    // "position"=>$position,
                    // "dept"=>$dept,
                    // "rid"=>"00",
                    // "iid"=>$instanceid,

                    "email"=>$d,
                    "token"=>$token,
                    "prf" =>$prf,
                    "pos"=>$pos,
                    "position"=>$position,
                    "dept"=>$dept,
                    "rg"=>$cursor["rg"],
                    "rid"=>"00",
                    "iid"=>$instanceid


                   ));
                
                }

                $mail->ClearAddresses();
            }
            if($ctr==0)
            {
                $r = $db->prfs->updateOne(array(
                    "prf" =>$prf,
                    "pos"=>$pos,
                    "position"=>$position,
                    "dept"=>$dept),
                    array('$set'=>array("progress"=>"initiated")));

                $db->rounds->insertOne(array(
                    // "status"=>"0",
                    // "prf"=>$prf,
                    // "dept"=>$dept,
                    // "pos"=>$pos,
                    // "position"=>$position,
                    // "rid"=>"00",
                    // "iid"=>$instanceid,
                    // "members"=>$emails,
                    // "selected"=>array(),
                    // "rejected"=>array(),
                    // "hold"=>array(),


                    "status"=>"bstart",
                    "prf" =>$prf,
                    "pos"=>$pos,
                    "position"=>$position,
                    "dept"=>$dept,
                    "rg"=>$cursor["rg"],
                    "rid"=>"00",
                    "iid"=>$instanceid,
                    "members"=>$emails,
                    "selected"=>array(),
                    "rejected"=>array(),
                    "onhold"=>array()));

                    $fp = fopen('prflogs.txt', 'a');
                    $d = date("Y/m/d");
                    $m = $cursor['mail'];
                    $prf = $prf;
                    $dept = $dept;
                    fwrite($fp, "\n".$d."\t".$prf."\t".$m."\t".$dept);
                    fclose($fp);  
                    echo "sent";
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
            foreach($emails as $d)
            {
                $mail->addAddress($d);
                $token=sha1($d);
                $url='http://'.$_SERVER['SERVER_NAME'].'/thyssenkrup/applicationblank.php?token='.$token;

                $mail->Subject = 'Mail Regarding Interview';
                $mail->Body    = 'You have been shortlisted for the interview. You have an interview on this date.'.$url;
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                if(!$mail->send()) 
                {
                    $ctr = 1;
                }
                else
                {
                    // $db->tokens->insertOne(array("email"=>$d,"token"=>$token,"prf"=>$_POST['prf'],"dept"=>$_POST['dept'],"pos"=>$_POST['posdetail'],"position"=>$_POST['pos'],"rg"=>$cursor["rg"],"rid"=>"00","iid"=>$instanceid));
                    $val=$db->tokens->insertOne(array(
                        // "email" => $d,
                        // "prf" =>$prf,
                        // "pos"=>$pos,
                        // "position"=>$position,
                        // "dept"=>$dept,
                        // "rid"=>"00",
                        // "iid"=>$instanceid,

                        "email"=>$d,
                        "token"=>$token,
                        "prf" =>$prf,
                        "pos"=>$pos,
                        "position"=>$position,
                        "dept"=>$dept,
                        "rg"=>$cursor["rg"],
                        "rid"=>"00",
                        "iid"=>$instanceid



                       ));
                }

                $mail->ClearAddresses();
            }
            if($ctr==0)
            {
                $r = $db->prfs->updateOne(array(
                    "prf" =>$prf,
                    "pos"=>$pos,
                    "position"=>$position,
                    "dept"=>$dept),
                    array('$set'=>array("progress"=>"initiated")));

                $db->rounds->insertOne(array(
                    // "status"=>"0",
                    // "prf"=>$prf,
                    // "dept"=>$dept,
                    // "pos"=>$pos,
                    // "position"=>$position,
                    // "rid"=>"00","iid"=>$instanceid,
                    // "members"=>$emails,
                    // "selected"=>array(),
                    // "rejected"=>array(),
                    // "hold"=>array(),

                    "status"=>"bstart",
                    "prf" =>$prf,
                    "pos"=>$pos,
                    "position"=>$position,
                    "dept"=>$dept,
                    "rg"=>$cursor["rg"],
                    "rid"=>"00",
                    "iid"=>$instanceid,
                    "members"=>$emails,
                    "selected"=>array(),
                    "rejected"=>array(),
                    "onhold"=>array()
                ));    
                echo "sent";
                header("refresh:0;url=http://localhost/thyssenkrup/hrnew.php");
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
        
            foreach($emails as $d)
            {
                $mail->addAddress($d);
                $token=sha1($d);
                $url='http://'.$_SERVER['SERVER_NAME'].'/thyssenkrup/applicationblank.php?token='.$token;

                $mail->Subject = 'Mail Regarding Interview';
                $mail->Body    = 'You have been shortlisted for the interview. You have an interview on this date.'.$url;
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                if(!$mail->send()) 
                {
                    echo "Not sent";
                    $ctr = 1;
                }
                else
                {
                  
                   $val=$db->tokens->insertOne(array(
                        // "email" => $d,
                        // "prf" =>$prf,
                        // "pos"=>$pos,
                        // "position"=>$position,
                        // "dept"=>$dept,
                        // "rid"=>"00",
                        // "iid"=>$instanceid,

                        "email"=>$d,
                        "token"=>$token,
                        "prf" =>$prf,
                        "pos"=>$pos,
                        "position"=>$position,
                        "dept"=>$dept,
                        "rg"=>$cursor["rg"],
                        "rid"=>"00",
                        "iid"=>$instanceid
                       ));
                    //    $ctr==0;
                }
                echo "Counter : ".$ctr;
                $mail->ClearAddresses();
            }
            if($ctr==0)
            {
                $r = $db->prfs->updateOne(array(
                    "prf"=>$prf,
                    "dept"=>$dept,
                    "pos"=>$pos,
                    "position"=>$position)
                    ,array('$set'=>array("progress"=>"initiated")));
                $db->rounds->insertOne(array(
                    // "status"=>"0",
                    // "prf"=>$prf,
                    // "dept"=>$dept,
                    // "pos"=>$pos,
                    // "position"=>$position,
                    // "rid"=>"00",
                    // "iid"=>$instanceid,
                    // "members"=>$emails,
                    // "selected"=>array(),
                    // "rejected"=>array(),
                    // "hold"=>array(),

                        "status"=>"bstart",
                        "prf"=>$prf,
                        "dept"=>$dept,
                        "pos"=>$pos,
                        "position"=>$position,
                        "rg"=>$cursor["rg"],
                        "rid"=>"00",
                        "iid"=>$instanceid,
                        "members"=>$emails,
                        "selected"=>array(),
                        "rejected"=>array(),
                        "onhold"=>array()
                    ));
                        $fp = fopen('prflogs.txt', 'a');
                        $d = date("Y/m/d");
                        $m = $cursor['mail'];
                        $prf = $prf;
                        $dept = $dept;
                        fwrite($fp, "\n".$d."\t".$prf."\t".$m."\t".$dept);
                        fclose($fp);  
                        echo "sent";                       
        
            }
            else
            {
                echo "notsent";
            }
   

}




?>