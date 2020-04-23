<?php 

include "db.php";
//echo "ello";
$prf=$_POST['prf'];
$iid=$_POST['iid'];
$rid=$_POST['rid'];
$oldname=$_POST['oldname']?$_POST['oldname']:"null";
$oldemail=$_POST['oldemail']?$_POST['oldemail']:"null";
$olddate=$_POST['olddate']?$_POST['olddate']:"null";
$oldtime=$_POST['oldtime']?$_POST['oldtime']:"null";
$olddept=$_POST['olddept']?$_POST['olddept']:"null";
$olddsg=$_POST['olddsg']?$_POST['olddsg']:"null";

$newname=$_POST['newname']?$_POST['newname']:"null";
$newemail=$_POST['newemail']?$_POST['newemail']:"null";
$newdate=$_POST['newdate']?$_POST['newdate']:"null";
$newtime=$_POST['newtime']?$_POST['newtime']:"null";
$newdept=$_POST['newdept']?$_POST['newdept']:"null";
$newdsg=$_POST['newdsg']?$_POST['newdsg']:"null";
$newiloc=$_POST['iloc']?$_POST['iloc']:"null";
$newiperson=$_POST['iperson']?$_POST['iperson']:"null";
$members=$_POST['members']?$_POST['members']:"null";

// echo "Dept : ".$newdept;


$res=$db->interviews->findOne(
    array("rid"=>$rid,
        'iid'=>$iid,
        "prf"=>$prf,
        "intvmail"=>$newemail,
        "date"=>$newdate,
        "time"=>$newtime,
        "invname"=>$newname));
$res=count($res);
echo("Hey - ".$res);
if($res != 0)
{

    echo "NEew".$newemail;
    echo "Old Email ".$oldemail;
    echo "Yes gotit";
    $result=$db->interviews->updateOne(
        array("rid"=>$rid,
             'iid'=>$iid,
             "prf"=>$prf,
             "intvmail"=>$newemail,
              ),
          array('$set'=>array("date"=>$newdate,"time"=>$newtime,"ilocation"=>$newiloc,"iperson"=>$newiperson)));
    
          $result=$db->interviews->updateOne(
            array("rid"=>$rid,
                 'iid'=>$iid,
                 "prf"=>$prf,
                 "intvmail"=>$newemail,
                  ),
              array('$set'=>array("reject"=>"Assigned To Other Interviewer")));
        
          foreach($members as $d)
          {
            $result=$db->interviews->updateOne(
                array("rid"=>$rid,
                     'iid'=>$iid,
                     "prf"=>$prf,
                     "intvmail"=>$newemail,
                      ),
                  array('$addToSet'=>array("members"=>$d)));
          }
         
        
}
else
{
    $result=$db->interviews->updateOne(
    array("rid"=>$rid,
         'iid'=>$iid,
         "prf"=>$prf,
         "intvmail"=>$oldemail,
          "date"=>$olddate,
          "time"=>$oldtime,
          "invname"=>$oldname),
      array('$set'=>array("intvmail"=>$newemail,"date"=>$newdate,"time"=>$newtime,"invname"=>$newname,"dsg"=>$newdsg,"dept"=>$newdept,"ilocation"=>$newiloc,"iperson"=>$newiperson)));


      $result=$db->interviews->updateOne(
        array("rid"=>$rid,
             'iid'=>$iid,
             "prf"=>$prf,
             "intvmail"=>$oldemail,
              ),
          array('$set'=>array("reject"=>"Assigned To Other Interviewer")));
          
if($result)
{
    echo "success";
}
else
{
    echo "fail";
}
}


?>