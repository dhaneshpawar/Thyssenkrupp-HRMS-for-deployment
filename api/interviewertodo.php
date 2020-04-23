<?php include 'db.php';

if($_GET)
{
    $mail = $_GET["mail"];
    
    $result = $db->interviews->find(array("intvmail"=>$mail,"status"=>"0","invstatus"=>"0"));
    $arr = [];
    if($result)
    {
        $i = 0;
        foreach($result as $document)
        {
            $prf = $document['prf'] ."-". $document['pos']."-". $document['iid'] ."-". $document['rid'];
            $date = $document['date'];
            $time = $document['time'];
            $acc = $document['accepted'];
            $arr[$i] = array($prf , $date , $time ,$acc); 
            $i+=1;  
        }
        print_r( json_encode($arr));
        
    }
}


?>