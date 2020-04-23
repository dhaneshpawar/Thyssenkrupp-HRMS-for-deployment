<?php 
include "db.php";
if(isset($_POST))
{
    $digit13 = $_POST['id'];
    $digit13 = explode("-",$digit13);

    $result = $db->interviews->findOne(array("prf"=>$digit13[0] , "pos"=>$digit13[1] , "iid"=>$digit13[2] , "rid"=>$digit13[3] , "intvmail"=>$_POST['mail']));
    $members=$result['members'];
    // echo json_encode($members);
    $i=0;
    $arr = array();
    if($result)
    {
        foreach($members as $d)
        {
            // echo "Mail".$d;
            $getselectednames =  $db->tokens->findOne(array("prf"=>$digit13[0],"pos"=>$digit13[1],"email"=>$d));
            $arr[$i]=array($getselectednames['full_name'],$d);
            $i++;
        }
         echo json_encode($arr);
    }
    else
    {
        echo "nooooooo";
    }
} 

?>