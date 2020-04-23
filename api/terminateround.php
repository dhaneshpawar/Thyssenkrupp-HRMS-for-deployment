<?php include 'db.php';

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
$mail->setFrom('thyssenkrupp@tkep.com', 'Interview Call');
$mail->addReplyTo(Email, 'Information');
$mail->isHTML(true);
$ctr=0;
if(isset($_POST))
{
    $cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
    $digit13 = preg_split('/[-]/', $_POST['prf']);
    $selected=$_POST['emails'];
    $arr = array();

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
                $url='http://'.$_SERVER['SERVER_NAME'].'/thyssenkrup/post-candidate-selection.php?token='.$d;

                $mail->Subject = 'Your interview at tkEI - Next Steps';
                $mail->Body    = nl2br('Dear '.$q['full_name'].',

                Thank you for taking time to talk to us about the '.$q1['position'].' . It was a great pleasure meeting
                you and we think that you’d be a good fit for this role.
                
                As a next step, we want you to submit the requisite documents to process your application
                further.
                
                Please click here '.$url.' to upload the documents.
                
                Feel free to reach out in case of any query.
                
                In-case of any query, feel free to reach out to recruitment@tkeap.com
                
                tkEI Recruiting Team.');
            
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
else{
    header("refresh:0;url=notfound.html");
}
?>