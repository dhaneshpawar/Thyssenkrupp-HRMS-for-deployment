<?php include 'db.php';
error_reporting(0);

$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));

if($cursor)
{
    
    
    $cursor = $db->rounds->find(array("rg"=>$cursor["rg"],"prf"=>$_POST['prf'],"dept"=>$_POST['dept'],"pos"=>$_POST['pos']));

    if($cursor)
    {
        $i = 0;
        $ctr = 0;
        $p = 0;
        foreach($cursor as $doc)
        {
            $selected[$i] = $doc['selected'];
            $i++;
            $iid[$p] = $doc['iid'];
            $p++;
        }
        
        for($i=0;$i<count($selected);$i++)
        {
            for($j=0;$j<count($selected[$i]);$j++)
            {
                $result[$ctr] = $selected[$i][$j];
                $ctr+=1;
            }
        }
        
       
        
        $arr = array("iid"=>$iid,"selected"=>$result);
        echo json_encode($arr);
    }
    }
else
{
    header("refresh:0;url=notfound.html");
}



?>