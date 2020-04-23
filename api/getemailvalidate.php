<?php

// error_reporting(0);
if(isset($_GET))
{
    include('db.php');
    $digit13 = explode("-",$_GET["id"]);
    $cursor = $db->tokens->find(array("prf"=>$digit13[0],"pos"=>$digit13[1],"afterselection"=>array('$exists'=>true)));
    $i = 0;
    
   
    foreach($cursor as $doc)
    {

        if($doc['afterselection']=="6")
        {
            //Changed by sarang - 10/01/2020
            $members_arr = array(array());
        }
        else
        {
            // echo "Hello";
            $r = $db->intereval->find(array("email"=>$doc['email'],"offerletter"=>array('$exists'=>false)));
            $getname=$db->tokens->findOne(array("email"=>$doc['email'],array("full_name"=>1)));
            $rc = iterator_to_array($r);
            
            if(count($rc) > 0)
            {
                // echo "Hello";
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
    

?>