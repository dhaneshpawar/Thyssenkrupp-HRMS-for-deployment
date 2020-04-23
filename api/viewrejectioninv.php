<?php error_reporting(0);

if(isset($_COOKIE['sid']))
{
  include 'db.php';
  
  $cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
  
  if($cursor)
  {
      $q = $db->interviews->find(array("intvmail"=>$cursor['mail']));
      $i=0;
      foreach($q as $doc)
      {
          if($doc['reason'] != "")
          {
            $arr[$i] =array("prf"=>$doc['prf'],"pos"=>$doc['pos'],"rid"=>$doc['rid'],"iid"=>$doc['iid'],"date"=>$doc['date'],"time"=>$doc['time'],"status"=>"Rejected","reason"=>$doc['reason']);
            $i+=1;
          }
      }   
      echo json_encode($arr);

  }
}

?>