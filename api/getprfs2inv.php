<?php include 'db.php';
error_reporting(0);

$cursor1 = $db->session->findOne(array("sid" => $_COOKIE['sid']));

if($cursor1)
{
    
    
    $cursor = $db->interviews->find(array("intvmail"=>$cursor1['mail']));
    if($cursor)
    {
        $i = 0;
        $ctr = 0;
        $p = 0;
        
        foreach($cursor as $doc)
        {
            for($j=0;$j<count($doc['evaluated']);$j++)
            {
                $getselectedStatus = $db->rounds->findOne(array('iid'=>$doc['iid'],"prf"=>$doc['prf'],"pos"=>$doc['pos'],"rid"=>$doc['rid']));
                $getStatus=$db->tokens->findOne(array('iid'=>$doc['iid'],"prf"=>$doc['prf'],"pos"=>$doc['pos'],"email"=>$doc['evaluated'][$j]));
                $q = $db->tokens->findOne(array("email"=>$doc['evaluated'][$j]));
                $orderCount1 = iterator_to_array($getselectedStatus['selected']);
                $orderCount2 = iterator_to_array($getselectedStatus['rejected']);
                $orderCount3 = iterator_to_array($getselectedStatus['onhold']);

                if(in_array($doc['evaluated'][$j],$orderCount1))
                {
                    $status = "Selected";
                }
                else if(in_array($doc['evaluated'][$j],$orderCount2))
                {
                    $status = "Rejected";
                }
                else if(in_array($doc['evaluated'][$j],$orderCount3))
                {
                    $status = "On Hold";
                }
                
                $arr[$i] =array("prf"=>$doc['prf'],"email"=>$q['email'],"members"=>$q['full_name'],"pos"=>$doc['pos'],"rid"=>$doc['rid'],"iid"=>$doc['iid'],"date"=>$doc['date'],"progress"=>$getStatus['progress'],"status"=>$status) ;
                $i++;  
            }
        }
        
          echo json_encode($arr);
    }
    }
else
{
    header("refresh:0;url=notfound.html");
}



?>