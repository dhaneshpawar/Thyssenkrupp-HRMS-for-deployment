<?php
error_reporting(0);
include 'db.php';

$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));

if($cursor)
{
    $digit13 = preg_split('/[-]/', $_POST['id']);
    $cursor2 =  $db->rounds->findOne(array("prf"=>$digit13[0],"pos"=>$digit13[1],"iid"=>$digit13[2],"rid"=>"00"));
    $memcount = count(iterator_to_array($cursor2['members']));
    $selectednames=$cursor2['selectedremove'];
    $i=0;
    foreach($selectednames as $d)
    {
        $getselectednames =  $db->tokens->findOne(array("prf"=>$digit13[0],"pos"=>$digit13[1],"email"=>$d));
        $arr[$i]=array($getselectednames['full_name'],$d);
        $i++;
    }
    $variable = array($arr,$memcount,$cursor2['members']);
    echo json_encode($variable);
}
else
{
    header("refresh:0;url=notfound.html");
}

?>