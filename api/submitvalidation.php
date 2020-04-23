<?php
include 'maildetails.php';
include "db.php";
$mail->setFrom('thyssenkrupp@tkep.com', 'Interview Call');
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
        $url='http://'.$_SERVER['SERVER_NAME'].'/thyssenkrup/reupload.php?token='.$mails;
        $mail->Subject = 'Your Application at tkEI - Re-enter the requisite details';
        $mail->Body    = nl2br('Dear '.$find['full_name'].',

        We are pleased to confirm that we have received your documents. Thank you. Please be
        updated that some more clarity is required on the following.

        Click here to reupload documents '.$url.'
        
        You are required to complete the same at the earliest.
        
        In-case of any query, feel free to reach out to recruitment@tkeap.com
        
        tkEI Recruiting Team.');
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
        $mail->Subject = 'Document validation Result';
        $mail->Body    = 'All your documents are valid you can visit us for further information';
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
   ?>