<?php include 'db.php';

error_reporting(0);

$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));

if($cursor)
{ 
    $cursor = $db->rounds->find(array("status"=>"completed","prf"=>$_POST['prf']));
    if($cursor)
    {
        $i = 0;
        $ctr = 0;
        $p = 0;
        foreach($cursor as $doc)
        {
            $arr[$i] =array("prf"=>$doc['prf'],"rid"=>$doc['rid'],"iid"=>$doc['iid'],"selected"=>$doc['selected']);
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