<?php

    include 'db.php';
    
    $result = $db->tokens->findOne(array('email'=>$_POST['mail']));
    //echo $_GET['token']; 
    $i=0;
    //echo $result['cvreason'];
    $valid=$result['valid'];
    foreach($valid as $d)
    {
        $arr[$i]=$d;
        $i++;
    }
    echo json_encode($arr);
    


?>