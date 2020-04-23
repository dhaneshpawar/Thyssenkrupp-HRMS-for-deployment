<?php
include 'maildetails.php';
include 'db.php';

$mail->setFrom("thyssenkrupp", 'Interview Call');
$mail->addReplyTo(Email, 'Information');
$mail->isHTML(true);   

$invname=$_POST['iname'];
$intvmail=$_POST['intvmail'];
$date=$_POST['date'];
$time=$_POST['time'];

$ctr = 0;
$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
foreach($_POST['emails'] as $d)
{
   
    $mail->addAddress($d);
    $mail->Subject = 'Mail Regarding Interview';
    $mail->Body    = 'You have been shortlisted for the interview. You have an interview on this '.$date.'Time : '.$time;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if(!$mail->send()) 
    {
        $ctr = 1;
    }
   
    $mail->ClearAddresses();
}

if($ctr == 0)
{
    $digit13 = preg_split('/[-]/', $_POST['prf']);

    //get latest  round created
    $result = $db->rounds->find(array("prf"=>$digit13[0],"pos"=>$digit13[1],"iid"=>$digit13[2]),array('sort' => array('_id' => -1)));

    $i = 0;
    
    foreach($result as $doc)
    {
        $arr[$i] = $doc;
        $i++;
    }

$result = $arr[0];
$result1=$arr[1];
echo "Second element status - ".$result1['status'];

// echo "Previous Rid - ".$previousrid;
if($result['status']=="ristart")
{
    if($result1['status']=='invcomplete')
    {
        $previousrid=$result1['rid'];
    }
    $rid=(string)sprintf("%02s",$result['rid']);//keep the round id same 

}
else
{
    echo "Generating new round";
    $previousrid=(string)sprintf("%02s",$result['rid']);//previous round id
    $rid =(string) sprintf("%02s",$result["rid"]+1); //next round id
}


$db->interviews->insertOne(array("rid"=>$rid,"prf"=>$digit13[0],'pos'=>$digit13[1],"iid"=>$digit13[2],"members"=>$_POST['emails'],"evaluated"=>array(),"invname"=>$_POST['iname'],"designation"=>$_POST['idesg'],"intvmail"=>$_POST['intvmail'],"date"=>$_POST['date'],"time"=>$_POST['time'],"ilocation"=>$_POST['iloc'],"iperson"=>$_POST['iperson'],"dept"=>$_POST['dept'],"status"=>"0","invstatus"=>"0","accepted"=>"no"));

//updating status of base round
//deleting tokens
$db->tokens->updateMany(array("prf"=>$digit13[0],'iid'=>$digit13[2],"pos"=>$digit13[1]),array('$set'=>array("token"=>"1")));





//newly added

$criteria=array("status"=>"ristart","prf"=>$digit13[0],"pos"=>$digit13[1],"rid"=>$rid,'iid'=>$digit13[2]);
    
foreach($_POST['emails'] as $d)
{
    //Query to add the available data - iid ,rid,prf,members
    $db->rounds->updateOne($criteria,array('$push'=>array('members'=>$d)),array('safe'=>true,'timeout'=>5000,'upsert'=>true));  

    //Query to update round id in token of member
    $criteria2=array("prf"=>$digit13[0],"pos"=>$digit13[1],"rid"=>$previousrid,'iid'=>$digit13[2],"email"=>$d); 
    $db->tokens->updateOne($criteria2,array('$set'=>array("progress"=>$rid)));
      
    //Query to remove members from selectedremove 
    $res=$db->rounds->updateOne(array("rid"=>$previousrid,'iid'=>$digit13[2],"prf"=>$digit13[0],"pos"=>$digit13[1]),array('$pull'=>array('selectedremove'=>$d)),array('safe'=>true,'timeout'=>5000,'upsert'=>true)); 
}

//Query to add empty arrays to documents - selected, rejected, onhold
$db->rounds->updateOne($criteria,array('$set'=>array("selected"=>array(),"rejected"=>array(),"onhold"=>array())));


$countRound=$db->rounds->findOne(array("rid"=>$previousrid,'iid'=>$digit13[2],"prf"=>$digit13[0],"pos"=>$digit13[1]));
// $countRound1=$db->rounds->findOne(array("rid"=>$rid,'iid'=>$digit13[2],"prf"=>$digit13[0],"pos"=>$digit13[1]));

 $result1=$countRound['selectedremove'];
 $result2=$countRound['members'];


$orderCount1 =count(iterator_to_array($result1));
$orderCount2 =count(iterator_to_array($result2));

//Checking whether all members are allocated to an interviewer
if($orderCount1==$orderCount2)
{
    //if Yes Change the status of the base round to complete 
    $db->rounds->updateMany(array("rid"=>$previousrid,'iid'=>$digit13[2],"prf"=>$digit13[0],"pos"=>$digit13[1]),array('$set'=>array("status"=>"rcomplete")));
    echo "Status Changed";
}
else
{
    echo "Status not Changed";
}




echo "sent"; 
}
else
{
    echo "notsent";
}
?>