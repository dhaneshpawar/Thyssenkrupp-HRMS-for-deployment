<?php 
//Sarang - 16/03/2020
    include "db.php";
    $cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
    if($cursor)
    {
        
        $cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
        $index = $_POST['index'];
        $time = $_POST['time'];
        $invmail = $cursor['mail'];
        $name  = $cursor['name'];
        $digit13 = $_POST['digit13'];
        $digit13 = explode("-",$_POST['digit13']);
        $updatedtime = $_POST['updatedTime'];
        $updateddate = $_POST['updatedDate'];


        $intvmail = $cursor['mail'];

        $cursor = $db->interviews->findOne(array(
                            "prf" =>$digit13[0],
                            "pos"=>$digit13[1],
                            "iid"=>$digit13[2],
                            "rid"=>$digit13[3],
                            "intvmail"=>$cursor['mail']
        ));

        $dates = $cursor['moddates'];
        $dates = iterator_to_array($dates);
        $times = $cursor['modtimes'];
        $times = iterator_to_array($times);


        // echo "Time".$updateddate;
        // echo "Date".$updatedtime;
        // echo "Index:".$index;
        // $dates = $cursor['moddates'];
        // $dates = iterator_to_array($dates);
        // $times = $cursor['modtime'];
        // $times = iterator_to_array($times);

        //Modify the date time in array
        for($i=0;$i<count($dates);$i++)
        {
            if($i == $index )
            {
                $times[$i] = $updatedtime;
                $dates[$i] = $updateddate;
                break;
            }  
        }

        // print_r($dates);
        // print_r($times);

        $cursor = $db->interviews->updateOne(
                array(
                "prf" =>$digit13[0],
                "pos"=>$digit13[1],
                "iid"=>$digit13[2],
                "rid"=>$digit13[3],
                "intvmail"=>$intvmail
                ),
                array('$set'=>array("moddates"=>$dates,"modtimes"=>$times)));

            if($cursor)
            {
                echo "modify";
            }
    }
    else
    {
        header("refresh:0;url=notfound.html");    
    }

?>