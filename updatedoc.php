<?php

    include 'api/db.php';
    $arr=[];
    $mail=$_GET['token'];
    $time = date("h.i.sa");
    $date = date("Y.m.d");

    $folder = $mail."(".$date."--".$time.")";
    mkdir("upload/".$folder);


   if(isset($_FILES['photo']))
   {
        $namephoto = $_FILES['photo']['name'];
        $tempphoto = $_FILES['photo']['tmp_name'];
        move_uploaded_file($tempphoto,"upload/".$folder."/".$namephoto);
        $photo = "upload/".$folder."/".$namephoto;
       $result=$db->tokens->updateOne(array("email"=>$mail),array('$set'=>array("userphoto"=>$photo)));

   }
   if(isset($_FILES['pan']))
   {
        $namephoto = $_FILES['pan']['name'];
        $tempphoto = $_FILES['pan']['tmp_name'];
        move_uploaded_file($tempphoto,"upload/".$folder."/".$namephoto);
        $pan = "upload/".$folder."/".$namephoto;
    $result=$db->tokens->updateOne(array("email"=>$mail),array('$set'=>array("pancard"=>$pan)));

   }
   if(isset($_FILES['cv']))
   {
        $namephoto = $_FILES['cv']['name'];
        $tempphoto = $_FILES['cv']['tmp_name'];
        move_uploaded_file($tempphoto,"upload/".$folder."/".$namephoto);
        $cv = "upload/".$folder."/".$namephoto;
    $result=$db->tokens->updateOne(array("email"=>$mail),array('$set'=>array("usercv"=>$cv)));

   }
   if(isset($_FILES['Adhaar']))
   {
        $namephoto = $_FILES['Adhaar']['name'];
        $tempphoto = $_FILES['Adhaar']['tmp_name'];
        move_uploaded_file($tempphoto,"upload/".$folder."/".$namephoto);
        $adhar = "upload/".$folder."/".$namephoto;
        $result=$db->tokens->updateOne(array("email"=>$mail),array('$set'=>array("Adhaar"=>$adhar)));
   }

   if(isset($_FILES['graduation']))
   {
        $namephoto = $_FILES['graduation']['name'];
        $tempphoto = $_FILES['graduation']['tmp_name'];
        move_uploaded_file($tempphoto,"upload/".$folder."/".$namephoto);
        $graduation = "upload/".$folder."/".$namephoto;
        $result=$db->tokens->updateOne(array("email"=>$mail),array('$set'=>array("alldocs"=>$graduation)));
   
   }
   if(isset($_FILES['ap']))
   {
        $namephoto = $_FILES['ap']['name'];
        $tempphoto = $_FILES['ap']['tmp_name'];
        move_uploaded_file($tempphoto,"upload/".$folder."/".$namephoto);
        $ap = "upload/".$folder."/".$namephoto;
        $result=$db->tokens->updateOne(array("email"=>$mail),array('$set'=>array("proofaddr"=>$ap)));
   
   }
   if(isset($_FILES['al']))
   {
        $namephoto = $_FILES['al']['name'];
        $tempphoto = $_FILES['al']['tmp_name'];
        move_uploaded_file($tempphoto,"upload/".$folder."/".$namephoto);
        $al = "upload/".$folder."/".$namephoto;
        $result=$db->tokens->updateOne(array("email"=>$mail),array('$set'=>array("appletter"=>$al)));
   
   }
   if(isset($_FILES['rl']))
   {
        $namephoto = $_FILES['rl']['name'];
        $tempphoto = $_FILES['rl']['tmp_name'];
        move_uploaded_file($tempphoto,"upload/".$folder."/".$namephoto);
        $rl = "upload/".$folder."/".$namephoto;
        $result=$db->tokens->updateOne(array("email"=>$mail),array('$set'=>array("relletter"=>$rl)));
   
   }
   if(isset($_FILES['ccl']))
   {
        $namephoto = $_FILES['ccl']['name'];
        $tempphoto = $_FILES['ccl']['tmp_name'];
        move_uploaded_file($tempphoto,"upload/".$folder."/".$namephoto);
        $ccl = "upload/".$folder."/".$namephoto;
        $result=$db->tokens->updateOne(array("email"=>$mail),array('$set'=>array("ccletter"=>$ccl)));
   
   } if(isset($_FILES['payslip']))
   {
        $namephoto = $_FILES['payslip']['name'];
        $tempphoto = $_FILES['payslip']['tmp_name'];
        move_uploaded_file($tempphoto,"upload/".$folder."/".$namephoto);
        $payslip = "upload/".$folder."/".$namephoto;
        $result=$db->tokens->updateOne(array("email"=>$mail),array('$set'=>array("pastpayslip"=>$payslip)));

   } 
   if(isset($_FILES['cc']))
   {
        $namephoto = $_FILES['cc']['name'];
        $tempphoto = $_FILES['cc']['tmp_name'];
        move_uploaded_file($tempphoto,"upload/".$folder."/".$namephoto);
        $cc = "upload/".$folder."/".$namephoto;
        $result=$db->tokens->updateOne(array("email"=>$mail),array('$set'=>array("cancelledcheck"=>$cc)));

   }

   if($result)
   {
     $result=$db->tokens->updateOne(array("email"=>$mail),array('$set'=>array("afterselection"=>"1")));

       echo "success";
       header("refresh:0;url=http://localhost/thyssenkrup/reupload.php?token=1");
   }        
    else
    {
        echo "fail";
    }
 
 

?>