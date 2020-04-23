<?php include 'db.php';
// error_reporting(0);

$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));

if($cursor)
{
    
    
    $cursor = $db->rounds->findOne(array("status"=>"completed","prf"=>$_POST['prf'],"iid"=>$_POST['iid'],"pos"=>$_POST['pos']));
    if($cursor)
    {
        $i = 0;
        $j=0;
        $k=0;
        $ctr = 0;
        $p = 0;
        $selected=$cursor['selected'];
        $rejected=$cursor['rejected'];
        $onhold=$cursor['onhold'];
        // print_r($selected);
        foreach($selected as $d)
        {
                // echo "Email = ".$d."<br>";
                 $getselectednames =  $db->tokens->findOne(array("prf"=>$_POST['prf'],"pos"=>$_POST['pos'],"email"=>$d));
                 $selected[$i]=array($d,$getselectednames['full_name']);
                 $i++;
        }
         
        foreach($rejected as $d)
        {
                $d = explode(",",$d);
                $getrejectednames =  $db->tokens->findOne(array("prf"=>$_POST['prf'],"pos"=>$_POST['pos'],"email"=>$d[0]));
                $rejected[$j]=array($d,$getrejectednames['full_name']);
                $j++;
        }
        foreach($onhold as $d)
        {
                $holdmail=explode(',',$d);
                $getonholdnames =  $db->tokens->findOne(array("prf"=>$_POST['prf'],"pos"=>$_POST['pos'],"email"=> $holdmail[0]));
                $onhold[$k]=array($d,$getonholdnames['full_name']);
                $k++;
        }
        $t=0;
        foreach($cursor as $doc)
        {
            $arr[$t] =array("selected"=>$selected,"rejected"=>$rejected,"onhold"=>$onhold) ;
            // array($d,$getselectednames['full_name']
            $t++;
        }
//         // print_r($selected);
        echo json_encode($arr);
    }
}
else
{
    header("refresh:0;url=notfound.html");
}



?>