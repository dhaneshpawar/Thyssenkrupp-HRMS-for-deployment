<?php
    
    include "db.php";
    $mail= $_POST['mail'];
    $doc=$_POST['doc'];
    $ctr=0;
    if($res=$db->tokens->find(array("email"=>$mail)))
    {
      if($cursor = $db->tokens->find(array("email"=>$mail,"invalid"=>array('$exists'=>true))))
      {

        foreach($res as $c)
        {
            $arr = $c["invalid"];
        }
        foreach($arr as $d)
        {
            if($d==$doc)
            {
                $ctr=1;
            }
        }
        if($ctr==1)
        {
            $db->tokens->updateOne(array("email"=>$mail),array('$addToSet'=>array('valid'=>$doc)),array('safe'=>true,'timeout'=>5000,'upsert'=>true));
            $db->tokens->updateOne(array("email"=>$mail),array('$pull'=>array('invalid'=>$doc)),array('safe'=>true,'timeout'=>5000,'upsert'=>true));
        }
        else 
        {
            $result=$db->tokens->updateOne(array("email"=>$mail),array('$addToSet'=>array('valid'=>$_POST['doc'])),array('safe'=>true,'timeout'=>5000,'upsert'=>true));
            if($result)
            {
                echo "success";
            }
            else
            {
                echo "fail";
            }
        }
    }
   
}
   
    
   
?>