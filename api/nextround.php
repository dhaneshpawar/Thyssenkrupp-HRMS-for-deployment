<?php include 'db.php';
    error_reporting(0);
if(isset($_POST))
{ 
    $arr=array();
    $digit13 = preg_split('/[-]/', $_POST['prf']);

    $cursor = $db->rounds->findOne(array('prf' => $digit13[0],'pos'=>$digit13[1],'iid'=>$digit13[2],'rid'=>$digit13[3]));

    // $rid = sprintf("%02s",$cursor["rid"]+1);

    // if($cursor)
    // {
    //     $selectedstudents = $cursor['selectedremove'];
    //     echo json_encode($selectedstudents);
    // }
    // else
    // {
    //     echo "404";;
    // }
    if($cursor)
    {
        $cursor1 = $db->rounds->find(array("selectedremove"=>array('$exists'=>true)));
        $rc = count(iterator_to_array($cursor1));
        // echo "Value : ".$rc;
        if($rc==0)
        {
            $arr=array();
            echo json_encode($arr);
        }
        else
        {
            $selectednames=$cursor['selectedremove'];
            $i=0;
            foreach($selectednames as $d)
            {
                $getselectednames =  $db->tokens->findOne(array("prf"=>$digit13[0],"pos"=>$digit13[1],"email"=>$d));
                $arr[$i]=array($getselectednames['full_name'],$d);
                $i++;
            }
            // print_r($arr);
             
                echo json_encode($arr);
        }
         

    }
    else
    {
        echo "404";
    }
        
}




?>