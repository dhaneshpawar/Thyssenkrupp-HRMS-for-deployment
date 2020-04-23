<?php include 'db.php';
error_reporting(0);

$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));

if($cursor)
{
    
    
    $cursor = $db->rounds->find(array("status"=>"completed"));
    if($cursor)
    {
        $i = 0;
        $ctr = 0;
        $p = 0;
       
        foreach($cursor as $doc)
        {
            $c=$db->prfs->findOne(array("prf"=>$doc['prf']));
            $arr[$i] =array($doc['prf'],$c['position'],$c['zone'],$c['department'],$doc['pos'],$doc['iid'],$doc['status']);
            $i++;
        }
        
        echo json_encode($arr);
    }
    }
else
{
    header("refresh:0;url=notfound.html");
}



?>