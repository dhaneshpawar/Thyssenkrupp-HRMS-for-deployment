<?php

if(isset($_POST))
{
    include "db.php";
    $result = $db->intereval->find(array("offerletter"=>"requested"));
    $i = 0;
    foreach($result as $doc)
    {
        $arr[$i] = array($doc['prf'],$doc['pos'],$doc['iid'],$doc['rid'],$doc['result'],$doc['email'],$doc['requester']);
        $i += 1;
    }
    echo json_encode($arr);
}

?>