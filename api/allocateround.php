<?php include 'db.php';
error_reporting(0);

if(isset($_GET))
 {
    $cursor = $db->rounds->find(array("status"=>"invcomplete"));
 
    if($cursor)
    {
        $i = 0;
        foreach($cursor as $document)
        {
            $arr[$i] = $document['prf']."-".$document['pos']."-".$document['iid']."-".$document['rid'];
            $i++;
        }
        if(count($arr)==0)
        {
            echo "no data";
        }
        else
        {
          echo json_encode($arr);
        }
    }
    else
    {
        echo "404";
    }
}
else
{
    header("refresh:0;url=notfound.html");
}

?>