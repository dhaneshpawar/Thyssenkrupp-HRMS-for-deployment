<?php

include "api/db.php";
$r = $db->prfs->find(array("prf"=>"44194"));
$i=0;
foreach($r as $ty)
{
    $arr[$i]=$ty["prf"];
    $i++;
}
echo count($r);
// if(count($r))
// {
//     echo 
// }
// else
// {
//     echo "not empty";
// }

?>