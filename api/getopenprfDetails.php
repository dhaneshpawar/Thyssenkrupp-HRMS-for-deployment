<?php


include 'db.php';
header('Content-Type: application/json');

$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid'],"dsg"=>"hr"));
if($cursor)
{


    $availableprfs=$db->generalized->find(array("status"=>"avail"));
    $prfs=array();
    foreach($availableprfs as $doc=>$docval){        
                $availprf[]=$docval->prf;
            //var_dump($key);     
    }

    $dataforavail=array();

    foreach($availprf as $val){
        $cur_prf=$db->prfs->findOne(array("prf"=>$val));

        if($cur_prf){
            $object=array(
                "prf"=>$val,
                "position"=>$cur_prf->position,
                "pos"=>$cur_prf->pos,
                "iid"=>0,
                "rid"=>0
            );

            $dataforavail[]=$object;
        }
    }

    echo json_encode(array("data"=>$dataforavail));

   // echo json_encode(array("general"=>$currentrounds,"initiateddata"=>$initiateddata,"completeddata"=>$completeddata,"para4"=>"ok","para5"=>"ok"));



}
else{
    header("refresh:0;url=notfound.html");


}

?>