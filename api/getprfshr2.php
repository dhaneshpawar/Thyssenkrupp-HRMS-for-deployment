<?php include 'db.php';
error_reporting(0);

$cursor1 = $db->session->findOne(array("sid" => $_COOKIE['sid']));

if($cursor1)
{
    
    
    $cursor = $db->tokens->find(array("valid"=>array('$exists'=>true)));

    if($cursor)
    {
        $i = 0;
        $ctr = 0;
        $p = 0;
        foreach($cursor as $doc)
        {
                $getselectednames =  $db->tokens->findOne(array("prf"=>$doc['prf'],"pos"=>$doc['pos'],"iid"=>$doc['iid'],"email"=>$doc['email']));
                $arr[$i] =array("prf"=>$doc['prf'],"members"=>$doc['email'],"pos"=>$doc['position'],"name"=>$getselectednames['full_name'],"status"=>$getselectednames['afterselection']);

        
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