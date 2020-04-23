<?php

include 'db.php';
if(isset($_POST))
{
    $result = $db->users->find(array('firstname'=>$_POST['first_name'],
    'lastname'=>$_POST['last_name'],
    'uid'=>$_POST['uid'],
    'pwd'=>$_POST['password'],
    'region'=>$_POST['region'],
    'dept'=>$_POST['dept'],
    'mail'=>$_POST['mail'],
    'designation'=>$_POST['designation']));

    if($result)
    {
        echo "found";
    }
    else
    {
        $result = $db->users->insertOne(array('firstname'=>$_POST['first_name'],
            'lastname'=>$_POST['last_name'],
            'uid'=>$_POST['uid'],
            'pwd'=>$_POST['password'],
            'region'=>$_POST['region'],
            'dept'=>$_POST['dept'],
            'mail'=>$_POST['mail'],
            'designation'=>$_POST['designation']));
    
        if($result)
        {
            echo "success";
        }
        else
        {
            echo "404";
        }
    }
}

?>