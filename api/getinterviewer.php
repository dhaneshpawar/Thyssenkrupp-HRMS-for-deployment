<?php 
    include "db.php";
    error_reporting(0);
    $i=0;
    $result=$db->interviews->find(array("status"=>"0"));
    foreach($result as $d)
    {
        $arr[$i]=array($d['prf'],$d['rid'],$d['iid'],$d['intvmail'],$d['invstatus'],$d['date'],$d['time'],$d['invname'],$d['dept'],$d['designation'],$d['accepted'],$d['iperson'],$d['ilocation']);
        $i++;
    }
    echo json_encode($arr);
?>