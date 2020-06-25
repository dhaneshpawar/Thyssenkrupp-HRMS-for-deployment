<?php 

// Connection to Database
include 'db.php';

// Check for Login
$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
if($cursor)
{
    if(isset($_POST))
    {
        $digit13 = explode("-",$_POST['id']);
    
        // get members of particular interviewer
        $result = $db->interviews->findOne(array("prf"=>$digit13[0] , "pos"=>$digit13[1] , "iid"=>$digit13[2] , "rid"=>$digit13[3] , "intvmail"=>$_POST['mail']));
        $members=$result['members'];
        $i=0;
        $arr = array();
    
        if($result)
        {
            foreach($members as $d)
            {
                // find names of candidates
                $getselectednames =  $db->tokens->findOne(array("prf"=>$digit13[0],"pos"=>$digit13[1],"email"=>$d));
                $arr[$i]=array($getselectednames['full_name'],$d,$result['dates'][$i],$result['times'][$i]);
                $i++;
            }
            if(count($arr)==0)
            {
                echo count($arr);
            }
            else
            {
             echo json_encode($arr);
            }
        }
        else
        {
            echo "nooooooo";
        }
    } 
}
else
{
    header("refresh:0;url=notfound.html");
}

?>