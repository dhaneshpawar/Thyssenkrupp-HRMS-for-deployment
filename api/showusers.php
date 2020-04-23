<?php

include 'db.php';
if(isset($_POST))
{
    $result = $db->users->find();

    if($result)
    {
        foreach($result as $doc)
        {
            echo $doc['uid'];
            echo $doc['first_name'];
            echo $doc['last_name'];
            echo $doc['region'];
            echo $doc['dept'];
            echo $doc['mail'];
            echo $doc['designation'];        
        }
    }
    else
    {
        echo "404";
    }
}

?>