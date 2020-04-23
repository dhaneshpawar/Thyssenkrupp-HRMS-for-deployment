<?php include 'db.php';

error_reporting(0);

$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
if($cursor)
{
    $digit13 = $_GET['id'];
    $digit13 = explode("-",$digit13);
    //echo $digit13[0].'-'.$digit13[1].'-'.$digit13[2].'-'.$digit13[3];

    //$result = $db->interviews->find(array("prf"=>$digit13[0] , "pos"=>$digit13[1] , "iid"=>$digit13[2] , "rid"=>$digit13[3] , "intvmail"=>$_POST['mail']));
   
     $selection=$_GET['result'];
    //  echo $selection;
    $values=array(
        "candidateknowledge"=>$_GET["candidateknowledge"],
        "candidateexperience"=>$_GET["candidateexperience"],
        "candidatestrength"=>$_GET["candidatestrength"],
        "candidateweakness"=>$_GET["candidateweakness"],
        "candidatespecial"=>$_GET["candidatespecial"],
        "candidatereasonhold"=>$_GET["candidatereasonhold"],
        "candidatedesignation"=>$_GET["candidatedesignation"],
        "date"=>$_GET["date"],
        "remark"=>$_GET["remark"],
        "email"=>$_GET["name"],
        "result"=>$_GET['result'],
        "prf"=>$digit13[0],
        "pos"=>$digit13[1],
        "iid"=>$digit13[2],
        "rid"=>$digit13[3],
        "interviewer"=>$cursor['mail']
            
    );
    $result = $db->intereval->insertOne($values);
    $result1 = $db->interviews->find(array("prf"=>$digit13[0],"pos"=>$digit13[1],"iid"=>$digit13[2],"rid"=>$digit13[3]));
    $criteria=array("prf"=>$digit13[0],"pos"=>$digit13[1],"iid"=>$digit13[2],"rid"=>$digit13[3]);
    if($result1)
    {
        //push evaluated candidates in evaluated array 
        $db->interviews->updateOne($criteria,array('$push'=>array('evaluated'=>$_GET["name"])),array('safe'=>true,'timeout'=>5000,'upsert'=>true));

        
        //pull candidates from members array 
        $db->interviews->updateOne($criteria,array('$pull'=>array('members'=>$_GET["name"])),array('safe'=>true,'timeout'=>5000,'upsert'=>true));

          $selectedcandidate = ($selection=="selected") ? $_GET['name']:"false";
        if($selectedcandidate=="false")
        {
                //enter logic for rejected
                $db->rounds->updateOne($criteria,array('$push'=>array($selection=>$_GET["name"]),'$pull'=>array("members"=>$_GET["name"])),array('safe'=>true,'timeout'=>5000,'upsert'=>true));  
    
        }
        else
        {
            //push selected/rejected/onhold candidates into array and pull members from members array
            //push only selected candidates in the selected remove array
            $db->rounds->updateOne($criteria,array('$push'=>array($selection=>$_GET["name"],"selectedremove"=>$selectedcandidate),'$pull'=>array("members"=>$_GET["name"])),array('safe'=>true,'timeout'=>5000,'upsert'=>true));  
            
        }
       

    }

    if($result)
    {
        echo "success";
    }
}

else{
    header("refresh:0,url=notfound.html");
}


?>