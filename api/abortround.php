<?php include 'db.php';

$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
   
if($cursor)
{
    $digit13 = preg_split('/[-]/', $_POST['digit13']);
    $criteria = array("rid"=>$digit13[3],'iid'=>$digit13[2],"prf"=>$digit13[0],"pos"=>$digit13[1]);
    $result = $db->rounds->findOne($criteria);
    for($i=0;$i<count($result['selected']);$i++)
    {   
        $db->rounds->updateOne($criteria,array('$pull'=>array("selectedremove"=>$result["selected"][$i],"selected"=>$result["selected"][$i])));

    }

    for($i=0;$i<count($result['selected']);$i++)
    {
        $db->rounds->updateOne($criteria,array('$push'=>array("rejected"=>$result["selected"][$i].",Aborted")));
    }
    $db->rounds->updateOne($criteria,array('$set'=>array("status"=>"completed")));

    $db->prfs->updateOne(array("prf"=>$digit13[0]),array('$set'=>array("status"=>"completed")));

    echo "success";
}
else
{
    echo "fail";
}

?>