<?php 
//Added by Sarang - 03/14/2020
include 'db.php';
$arra=array();
$i=0;
$cursor = $db->prfs->find(array(),array("zones"=>1));
foreach($cursor as $d)
{
   $arra[$i] = $d['zone'];
   $i++;
    // $i++;
}
// $rc = iterator_to_array($cursor['department']);
// print_r($arra);
echo (json_encode($arra));
?>