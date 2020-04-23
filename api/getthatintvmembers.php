<?php 
include "db.php";
$digit13 =$_POST['prfint'];
$prfint = explode("*",$digit13);
// $prfint=explode("-",$_POST['prfint']);
// echo("PRF ". $prfint[0]."\n");
// echo("Rid ". $prfint[1]."\n");
// echo("IID ".$prfint[2]."\n");
// echo("Mail ".$prfint[3]."\n");
// echo("Status ".$prfint[4]."\n");
// echo("Date ".$prfint[5]."\n");
// echo("Time ".$prfint[6]."\n");
$result=$db->interviews->findOne(array("prf"=>$prfint[0],"rid"=>$prfint[1],"iid"=>$prfint[2],"intvmail"=>$prfint[3],"date"=>$prfint[5],"time"=>$prfint[6]));
$i=0;
$arr=array();
echo json_encode($result['members']);
// foreach($result as $doc)
// {
//     $arr[$i] = $doc;
//     $i++;
// }
    
    //$result = $arr[0];
    // $selected=$result['members'];
    // echo json_encode($selected);
?>
