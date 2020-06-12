<?php 

//Check if session exists
include 'db.php';
$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
if($cursor)
{
   
    //Check if Request exists
    if($_POST)
    {
        $mail = $_POST["mail"];
        
        //find the interviewer using mail
        $result = $db->interviews->find(array("intvmail"=>$mail,"status"=>"0","invstatus"=>"0"));
        
    

        $arr = [];
        //Check whether above query executed 
        if($result)
        {
            $i = 0;
            foreach($result as $document)
            {
                $prf = $document['prf'] ."-". $document['pos']."-". $document['iid'] ."-". $document['rid'];
                $date = $document['date'];
                $time = $document['time'];
                $acc = $document['accepted'];
                $invstat = $document['invstatus'];
                $arr[$i] = array($prf , $date , $time ,$acc, $invstat); 
                $i+=1;  
            }
            print_r( json_encode($arr));
            
        }
    
    }
}
else
{
    //run when session not found
    header("refresh:0;url=notfound.html");
}


?>