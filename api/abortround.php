<?php 

// Connection to Database
include 'db.php';

// Check for Login
$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
if($cursor)
{
    // split POST data to required form
    $digit13 = preg_split('/[-]/', $_POST['digit13']);
    $criteria = array("rid"=>$digit13[3],'iid'=>$digit13[2],"prf"=>$digit13[0],"pos"=>$digit13[1]);
    $result = $db->rounds->findOne($criteria);
    if($result)
    {
        // remove candidates from selectedremove array as well as from selected array 
        for($i=0;$i<count($result['selected']);$i++)
        {   
            $removal = $db->rounds->updateOne($criteria,array('$pull'=>array("selectedremove"=>$result["selected"][$i],"selected"=>$result["selected"][$i])));
        }

        if($removal)
        {
            // push all candidates to rejected array and append Aborted to it for reference
            for($i=0;$i<count($result['selected']);$i++)
            {
                $pushToRejected = $db->rounds->updateOne($criteria,array('$push'=>array("rejected"=>$result["selected"][$i].",Aborted")));
            }
        }
        // set status of that round to Completed
        if($removal and $pushToRejected)
        {
            $roundUpdate = $db->rounds->updateOne($criteria,array('$set'=>array("status"=>"completed")));
            $prfsUpdate = $db->prfs->updateOne(array("prf"=>$digit13[0]),array('$set'=>array("status"=>"completed")));    
        }

        if($roundUpdate and $prfsUpdate)
        {
            echo "success";
        }
        else
        {
            echo "fail";
        }
    }  
    // prf doesnot exist  
    else
    {
        echo "notfound";
    }
}
else
{
    header("refresh:0;url=notfound.html");
}

?>