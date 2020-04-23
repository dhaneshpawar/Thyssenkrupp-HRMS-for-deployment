<?php 
 include 'db.php';
    $mail=$_POST['mail'];
    $digit13=$_POST['id'];
    $digit13 = explode("-",$digit13);
    
    $criteria=array("prf"=>$digit13[0],"pos"=>$digit13[1],"iid"=>$digit13[2],"rid"=>$digit13[3]);

    $m = $mail.",absent";
    $result=$db->rounds->updateOne($criteria,array('$addToSet'=>array("onhold"=>$m)));
    if($result)
    {
        $db->rounds->updateOne($criteria,array('$pull'=>array('members'=>$mail)),array('safe'=>true,'timeout'=>5000,'upsert'=>true));
        echo "success";

    }
    else
    {
        echo "fail";
    }
?>