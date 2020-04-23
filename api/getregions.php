<?php

include 'db.php';
$result = $db->prfs->find();
foreach($result as $doc)
{
    echo $doc['rg'];
}

?>