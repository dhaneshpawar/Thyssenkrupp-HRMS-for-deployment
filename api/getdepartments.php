<?php 

include 'db.php';
$arra=array();
$i=0;
$cursor = $db->prfs->find(array(),array("department"=>1));
foreach($cursor as $d)
{
   $arra[$i] = $d['department'];
   $i++;
    // $i++;
}
// $rc = iterator_to_array($cursor['department']);
// print_r($arra);
echo (json_encode($arra));
?>