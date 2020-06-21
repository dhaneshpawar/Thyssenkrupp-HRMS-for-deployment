<?php


include 'db.php';
header('Content-Type: application/json');

$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid'],"dsg"=>"hr"));
if($cursor)
{


    $initiateprfs=$db->generalized->find(array("status"=>"completed"));
    $prfs=array();
    foreach($initiateprfs as $doc=>$docval){        
                $prfs[]=$docval->prf;
            //var_dump($docval);     
    }

    $dataforinitiate=array();

    foreach($prfs as $val){
        $cur_prf=$db->rounds->findOne(array("prf"=>$val,"status"=>"completed"));

        if($cur_prf){
            $object=array(
                "prf"=>$val,
                //"position"=>$cur_prf->position,
                "pos"=>$cur_prf->pos,
                "iid"=>$cur_prf->iid,
                "rid"=>$cur_prf->rid
            );

            $dataforinitiate[]=$object;
        }
    }

    echo json_encode(array("data"=>$dataforinitiate));

   // echo json_encode(array("general"=>$currentrounds,"initiateddata"=>$initiateddata,"completeddata"=>$completeddata,"para4"=>"ok","para5"=>"ok"));



}
else{
    header("refresh:0;url=notfound.html");


}

?>