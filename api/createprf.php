<?php include 'db.php';

if(isset($_COOKIE['sid']))
{
    $cursor=$db->prfs->findOne(array("prf"=>$_POST['prfno'],"dept"=>$_POST['deptchoice'],"pos"=>$_POST['pos']));
    
    if($cursor)
    {
        echo '404';
    }
    else
    {
        $cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
        if($cursor)
        {
            $db->prfs->insertOne(array("prf"=>$_POST['prfno'],"dept"=>$_POST['deptchoice'],"pos"=>$_POST['pos'],"rg"=>$cursor["rg"]));
            echo 'success';
        }
        else
        {
            header("refresh:0;url=notfound.html");
        }
    }
}
else
{
    header("refresh:0;url=notfound.html");
}

 ?>