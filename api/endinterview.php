<?php

include 'db.php';


$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
$digit13 = preg_split('/[-]/', $_POST['id']);

if($cursor)
{

    $db->interviews->updateOne(array("intvmail"=>$cursor["mail"],"rid"=>$digit13[3],'iid'=>$digit13[2],"prf"=>$digit13[0],"pos"=>$digit13[1]),array('$set'=>array("status"=>"1")));
    $result = $db->interviews->find(array("rid"=>$digit13[3],'iid'=>$digit13[2],"prf"=>$digit13[0],"pos"=>$digit13[1]));
    $element = "start;";

    $check = "1";

    foreach($result as $doc)
    {
        $element = $element.";grest;".$doc["status"];
        if($doc["status"] == "0")
        {
            $check = "0";
        }
    }
    
    if($check == "1")
    {
        
       $db->rounds->updateOne(array("rid"=>$digit13[3],'iid'=>$digit13[2],"prf"=>$digit13[0],"pos"=>$digit13[1]),array('$set'=>array("status"=>"invcomplete")));
       echo "we succeded";
    }
    else{
        echo "we failed";
    }
    // echo json_encode($element);







    //$result = $db->rounds->find(array("rg"=>$cursor["rg"],"prf"=>$digit13[0],"pos"=>$digit13[1],"iid"=>$digit13[2],"dept"=>$cursor["dept"]),array('sort' => array('_id' => -1)));
    // $i = 0;
    
    // foreach($result as $doc)
    // {
    //     $arr[$i] = $doc;
    //     $i++;
    // }
    // $db->rounds->updateMany(array("rid"=>"00",'iid'=>$digit13[2],"prf"=>$digit13[0],"rg"=>$cursor["rg"],"dept"=>$_POST['dept'],"pos"=>$digit13[1]),array('$set'=>array("status"=>"1")));
}
else
{
    echo "you are not logged in ";
}
?>