<?php include 'db.php';

error_reporting(0);

$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));

if($cursor)
{

    if(strlen($_POST["prf"]) > 0 and strlen($_POST["iid"]) <= 0 and strlen($_POST["rid"]) <= 0)
    {
        $cursor = $db->rounds->find(array("rg"=>$cursor["rg"],"prf"=>$_POST['prf'],"dept"=>$_POST['dept'],"pos"=>$_POST['pos']));
        if($cursor)
        {
            $i = 0;
            $ctr = 0;
            foreach($cursor as $doc)
            {
                $hold[$i] = $doc['hold'];
                $i++;
            }
            
            for($i=0;$i<count($hold);$i++)
            {
                for($j=0;$j<count($hold[$i]);$j++)
                {
                    $result[$ctr] = $hold[$i][$j];
                    $ctr+=1;
                }
            } 
            if(count($result) > 0)
            {
                echo json_encode($result);
            }
            else
            {
                echo "no data";
            }
        }
    }
    else if(strlen($_POST["prf"]) > 0 and strlen($_POST["iid"]) > 0 and strlen($_POST["rid"]) <= 0)
    {
        $cursor = $db->rounds->find(array("rg"=>$cursor["rg"],"prf"=>$_POST['prf'],"dept"=>$_POST['dept'],"pos"=>$_POST['pos'],"iid"=>$_POST['iid']));
        $i = 0;
        $ctr = 0;
        foreach($cursor as $doc)
        {
            $hold[$i] = $doc['hold'];
            $i++;
        }
        
        for($i=0;$i<count($hold);$i++)
        {
            for($j=0;$j<count($hold[$i]);$j++)
            {
                $result[$ctr] = $hold[$i][$j];
                $ctr+=1;
            }
        } if(count($result) > 0)
        {
            echo json_encode($result);
        }
        else
        {
            echo "no";
        }
    }
    else if(strlen($_POST["prf"]) > 0 and strlen($_POST["iid"]) > 0 and strlen($_POST["rid"]) > 0)
    {
        $cursor = $db->rounds->find(array("rg"=>$cursor["rg"],"prf"=>$_POST['prf'],"dept"=>$_POST['dept'],"pos"=>$_POST['pos'],"iid"=>$_POST['iid'],"rid"=>$_POST['rid']));
        $i = 0;
        $ctr = 0;
        foreach($cursor as $doc)
        {
            $hold[$i] = $doc['hold'];
            $i++;
        }
        
        for($i=0;$i<count($hold);$i++)
        {
            for($j=0;$j<count($hold[$i]);$j++)
            {
                $result[$ctr] = $hold[$i][$j];
                $ctr+=1;
            }
        } 
        
        if(count($result) > 0)
        {
            echo json_encode($result);
        }
        else
        {
            echo "no";
        }
    }
    
        }
else
{
    header("refresh:0;url=notfound.html");
}


