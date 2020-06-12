<?php

include "db.php";
$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
 
if($cursor)
{
   
    $result=$db->interviews->find(array("invstatus"=>"1"));
    if($result)
    {
        $arr=array();
        $i=0;
        foreach($result as $d)
        {
           // $element=$d['prf']."-".$d['pos']."-".$d['iid']."-".$d['rid'];
            $arr[$i]=array("prf"=>$d['prf'],"invname"=>$d['invname'],"position"=>$d['pos'],"iid"=>$d['iid'],"rid"=>$d['rid'] ,"intvmail"=>$d['intvmail'],"reason"=>$d['reason']);
            $i++;
        }
      
        if(count($arr)>=1)
        {
            echo json_encode($arr);
        }
        else if(count($arr)==0)
        {
            echo "nodata";
        }
        
    }
    else
    {
        echo "nodata";
    }
}
else
{
    header("refresh:0;url=notfound.html");    
}
   
?>