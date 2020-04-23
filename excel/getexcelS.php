<?php 

include '../api/db.php';
$cursor = $db->rounds->find();
$i = 0;
foreach($cursor as $doc)
{
    if(count($doc['selected']) > 0)
    {
        for($j=0;$j<count($doc['selected']);$j++)
        {
            $selected[$i][$j] = $doc['selected'][$j];
        }
    }
    
    
    $i += 1;
}
$p = 0;
for($i=0;$i<count($selected);$i++)
{
    for($j=0;$j<count($selected[$i]);$j++)
    {
        $mem[$p] = $selected[$i][$j];
        $p+=1;
    }
}
$selected = $mem;
echo json_encode($selected);

?>