<?php
error_reporting(0);

if(isset($_COOKIE['sid']))
{
  include 'api/db.php';
  
  $cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
  
  if($cursor)
  {
    $cursor = $db->users->findOne(array("uid" => $cursor['uid']));
    $designation = $cursor['dsg'];
    if($designation == "inv" || $designation == "ceo" || $designation == "hod" || $designation == "rghead" )
    {
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>

  <link rel="stylesheet" type="text/css" media="screen" href="./public/css/materialize.css">
  <link rel="stylesheet" type="text/css" media="screen" href="./public/css/materialize.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        
        <!-- for sidenav -->
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

  <script src="./public/jquery-3.2.1.min.js"></script>
  
  <script src="./public/js/materialize.js"></script>
  <script src="./public/js/materialize.min.js"></script>

</head>

<body>
    <nav>
        <div class="nav-wrapper blue darken-1">
        <a href="http://localhost/thyssenkrup/invdash.php">
            <button class="btn waves-effect blue darken-1" style="float:left;margin-top: 18px;margin-right: 18px "> <- BACK</button>
            </a> 

      
            <a href="#!" class="brand-logo center">thyssenkrupp</a>
            <div id="logoutuser" class="row">
          <button class="btn waves-effect blue darken-1" type="submit" name="action" style="float:right;margin-top: 18px;margin-right: 18px ">LOGOUT</button>
        </div>
          </div>
        </nav>
        <br><br>
 <div class="row">
<div class="col s12 blue lighten-4">
  <table class="striped">
    <thead>
      <tr>
          <th>Instance ID</th>
          <th>POSITION</th>
          <th>RID</th>
          <th>IID</th>
          <th>DATE</th>
          <th>TIME</th>
          <th>STATUS</th>
          <th>REASON</th>
      </tr>
    </thead>

    <tbody id='rawdata'>
      
    </tbody>
  </table>
</div> 
</div>


     
</body>
<style>
  html{
    scroll-behaviour:smooth;
  }
</style>
  

<script>
    $('#logoutuser').click(function(){
    
    $.ajax({
    url:"http://localhost/thyssenkrup/api/logout.php",
    type:"POST",
    success:function(para){
    
    if(para=="success")
    {
    $("#row").hide()
    $("#logout").show()
    document.location.replace("http://localhost/thyssenkrup/index.php")
    }
    else
    {
    $("#notlogout").show()
    document.location.replace("/thyssenkrup/")
    }
    } 
    
    })
    
    });

  var ctr = 0
function addText(x)
{
ctr = ctr+1
var str = 'email'+ctr
var txt="<div class='row'><div class='input-field col s4 offset-m4  blue-text' ><i class='material-icons prefix'>email</i>  <input id='"+str+"' onfocus='addText(this)' type='text' class='validate' placeholder='Enter Email'></div></div>"
$("#emailcollection").append(txt);
}
var arr=[]
$(document).ready(function(){

 $.ajax({
    url:'http://localhost/thyssenkrup/api/viewrejectioninv.php',
    type:'POST',
    // data:{'arr1':arr1},
    success : function(para)
    {
      console.log(para)

      para=JSON.parse(para)
      console.log("this is length : "+para.length)

      for(let i=0;i<para.length;i++)
      { 
        var x='<tr id="rows"><td id="prf" value="'+para[i].prf+'">'+para[i].prf+'</td><td id="pos">'+para[i].pos+'</td><td id="rid">'+para[i].rid+'</td><td id="iid">'+para[i].iid+'</td><td id="date">'+para[i].date+'</td><td id="time">'+para[i].time+'</td><td id="status">'+para[i].status+'</td><td id="reason">'+para[i].reason+'</td></tr>'
        $('#rawdata').append(x);
      }
     
     
    },
  })
  

})
</script>
</html>
 
<?php
            }
            else
            {
                header("refresh:0;url=notfound.html");
            }
        }
        else
        {
            header("refresh:0;url=notfound.html");
        }
    }
    else
    {
        header("refresh:0;url=notfound.html");
    }  
?>
       