<?php
if(isset($_POST))
{
    include 'maildetails.php';
    include 'db.php';
    $mail->setFrom("tkep", 'Interview Call');
    $mail->addReplyTo(Email, 'Information');
    $mail->isHTML(true);  
    $result = $db->rounds->find(array("prf"=>$_POST["prf"],"pos"=>$_POST['pos'],"iid"=>$_POST['iid']),array('sort' => array('_id' => -1)));

    $i = 0;
    
    foreach($result as $doc)
    {
        $arr[$i] = $doc;
        $i++;
    }

    $result = $arr[0];
    $iid =(string) sprintf("%03s",$result["iid"]+1);

    $result3 = $db->prfs->findOne(array("prf"=>$_POST["prf"]));
    $db->interviews->insertOne(array("rid"=>"01","prf"=>$_POST["prf"],'pos'=>$_POST["pos"],"iid"=>$iid,"members"=>$_POST['emails'],"evaluated"=>array(),"intvmail"=>$_POST["intvmail"],"invname"=>$_POST["iname"],"designation"=>$_POST['idesg'],"dept"=>$_POST['dept'],"date"=>$_POST['date'],"time"=>$_POST['time'],"ilocation"=>$_POST['iloc'],"iperson"=>$_POST['iperson'],"status"=>"0","invstatus"=>"0","accepted"=>"no"));
    $mail->addAddress($_POST["intvmail"]);
    $mail->Subject = 'Interview schedule for '.$result3['department'].' - '.$result3['position'].' .';
    $mail->Body    = nl2br('Dear '.$_POST['iname'].',

    Please find below the details for the interview for the post of '.$result3['position'].' and Confirm on the site portal.
        
    Date - '.$_POST['date'].'

    Timing - '.$_POST['time'].'

    Location - '.$_POST['iloc'].'

    Contact Person - '.$_POST['iperson'].'
        
    In-case of any query, feel free to reach out to recruitment@tkeap.com

    tkEI Recruiting Team.');
    $mail->AltBody = 'You are assigned for an interview. Please check your dashboard for further progress.';

    if($mail->send()) 
    {
        echo "sent";
    }
    
    $criteria=array("status"=>"ristart","prf"=>$_POST["prf"],'pos'=>$_POST["pos"],"rid"=>"01",'iid'=>$iid);
    foreach($_POST['emails'] as $d)
    {
        //Query to remove onhold candidate from previous round
        $q = $db->rounds->findOne(array("status"=>"completed","prf"=>$_POST["prf"],'pos'=>$_POST["pos"],'iid'=>$result['iid']));
        for($k=0;$k<count($q['onhold']);$k++)
        {
            $var2 = explode(",",$q['onhold'][$k]);
            if($var2[0] == $d)
            {
                $var = explode(",",$q['onhold'][$k]); 
                if($var[1] == "absent")
                {
                    $db->rounds->updateOne(array("status"=>"completed","prf"=>$_POST["prf"],'pos'=>$_POST["pos"],'iid'=>$result['iid']),array('$pull'=>array('onhold'=>$d.",absent")),array('safe'=>true,'timeout'=>5000,'upsert'=>true));
                }     
                else
                {
                    $db->rounds->updateOne(array("status"=>"completed","prf"=>$_POST["prf"],'pos'=>$_POST["pos"],'iid'=>$result['iid']),array('$pull'=>array('onhold'=>$d)),array('safe'=>true,'timeout'=>5000,'upsert'=>true));
                }
            }
        }
        


        //Query to add the available data - iid ,rid,prf,members
        $db->rounds->updateOne($criteria,array('$push'=>array('members'=>$d)),array('safe'=>true,'timeout'=>5000,'upsert'=>true));  

        //Query to update round id in token of member
         $criteria2=array("prf"=>$_POST["prf"],'pos'=>$_POST["pos"],'iid'=>$result['iid'],"email"=>$d); 
         $r = $db->tokens->updateOne($criteria2,array('$set'=>array("progress"=>"01")));
        
    }
    // Query to add empty arrays to documents - selected, rejected, onhold
    $db->rounds->updateOne($criteria,array('$set'=>array("selected"=>array(),"rejected"=>array(),"onhold"=>array())));
}

?>