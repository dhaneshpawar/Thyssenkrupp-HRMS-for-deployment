<?php

// Connection to Database
include 'db.php';

// Check for Login
$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
if($cursor)
{
    if(isset($_GET))
    {
        // get prf from GET request
        $digit13 = explode("-",$_GET["id"]);
        $cursor = $db->tokens->find(array("prf"=>$digit13[0],"pos"=>$digit13[1],"afterselection"=>array('$exists'=>true)));
        $i = 0;
        foreach($cursor as $doc)
        {
            if($doc['afterselection']=="6")
            {
                $members_arr = array(array());
            }
            else
            {
                $r = $db->intereval->find(array("email"=>$doc['email'],"offerletter"=>array('$exists'=>false)));
                $getname=$db->tokens->findOne(array("email"=>$doc['email'],array("full_name"=>1)));
                $rc = iterator_to_array($r);
                
                if(count($rc) > 0)
                {
                        $getselectednames =  $db->tokens->findOne(array("prf"=>$digit13[0],"pos"=>$digit13[1],"iid"=>$digit13[2],"email"=>$doc['email']));
                        $members_arr[$i]=array($doc['full_name'],$doc['email'],$doc['afterselection']);
                        $i+=1;   
                }
                else
                {
                    if($doc['afterselection'] != "2")
                    {
                        $members_arr[$i]=array($doc['full_name'],$doc['email'],$doc['afterselection']);
                        $i+=1;
                    }
                    else if($doc['afterselection'] == "2")
                    {
                        $members_arr[$i]=array($doc['full_name'],$doc['email'],"5");
                        $i+=1;
                    }
                    else
                    {
                        $members_arr = array(array());
                    }
                }
                }
            
        }
        echo json_encode($members_arr);
    }
}
else
{
    header("refresh:0;url=notfound.html");
}    

?>