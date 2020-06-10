<?php

// Connection to Database
include 'db.php';

// Check for Login
$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
if($cursor)
{
    if(isset($_POST))
    {
        // check for user existance
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
            // add new user
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
    
}
else
{
    header("refresh:0;url=notfound.html");
}

?>