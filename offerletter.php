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
    
    if($designation == "hr" || $designation == "ceo" || $designation == "hod" || $designation == "rghead" )
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
<div class="w3-sidebar blue w3-bar-block" style="width:15%;border: 5px solid white;">


<h3 class="w3-bar-item"><a href="/thyssenkrup/"><center>Home</center></a></h3> <br><br>
  <a href="/thyssenkrup/csvupload.php" class="w3-bar-item w3-button">Create new Department and PRF</a> <br>
  <a href="/thyssenkrup/hrnew.php" class="w3-bar-item w3-button">Create New Instance</a> <br>
  <a href="/thyssenkrup/initiateround.php" class="w3-bar-item w3-button">Initiate rounds for instances</a> <br>
  <a href="/thyssenkrup/allocateround.php" class="w3-bar-item w3-button">On going rounds</a> <br>
  <a href="/thyssenkrup/history.php" class="w3-bar-item w3-button">See History  </a> <br>
  <a href="/thyssenkrup/allocateround2.php" class="w3-bar-item w3-button">Rescheduling</a> <br>
  <a href="/thyssenkrup/interview.php" class="w3-bar-item w3-button">Update Interviews</a> <br>
  <a href="/thyssenkrup/offerletter.php" class="w3-bar-item w3-button white">Offer Letter</a> <br>

</div>
<div style="margin-left:15%">

    <nav>
        <div class="nav-wrapper blue darken-1">
        <a href="/thyssenkrup/">
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
<div class="col s10  offset-m1 blue lighten-4">
  <table class="striped">
    <thead>
      <tr>
          <th>PRF</th>
          <th>Position</th>
          <th>Instance ID</th>
          <th>Round ID</th>
          <th>Result</th>
          <th>Candidate</th>

          <th>Requester</th>

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
  <style>
    .tabs .indicator {
            background-color:#1e88e5;
            height: 7px;
        } /*Color of underline*/
      
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

var id;
var flag0 = 0

function sendmailtoinv(x,name)
{
  
  btnid=x;
  // alert(btnid);
  prfid=x.split("-")
  //  alert(x);
  // console.log("Hey , ",x);
  // console.log("Prf : "+prf)
  var str = '#'+btnid;
  alert(str);
  var candidate = "#"+prfid[0]+"5"
  var cmail = $(candidate).html()
  $(str).html("sending...");
  $(str).attr('disabled','disabled')
 
  //Changed by sarang - 10/01/2020
  // console.log("Prf : ",prfid[1]);
  // console.log("Pos : ",prfid[2]);
  // console.log("iid : ",prfid[3]);
  // console.log("rid : ",prfid[4]);
  $.ajax({
    url:'http://localhost/thyssenkrup/api/sendofferletter.php',
    type:'POST',
    data:{
      'mail':name,
      'candidate':cmail,
      'prf':prfid[1],
      'pos':prfid[2],
      'iid':prfid[3],
      'rid':prfid[4]
    },
    success:function(para)
    {
      console.log("This is : ",para);
      if(para=="success")
      {
       
        $(str).html("letter sent");
      }
      else
      {

      }
    }
  })
}

var ctr = 0
var arr=[]
$(document).ready(function(){ 

 $.ajax({
    url:'http://localhost/thyssenkrup/api/seerequestletters.php',
    type:'POST',
    success : function(para)
    {
      console.log(para)
      para = JSON.parse(para)
      console.log(para)
      // alert(para.length)

      for(let i=0;i<para.length;i++)
      {
        arr[i]=para[i];
      }
     
      for(let j=0;j<arr.length;j++)
      {
        //Changed by sarang - 10/01/2020
        var candidate = arr[j][5];
        console.log("prf : ",arr[j][0]);
        console.log("pos : ",arr[j][1]);
        console.log("iid : ",arr[j][2]);
        console.log("rid : ",arr[j][3]);
        digit13=arr[j][0]+'-'+arr[j][1]+'-'+arr[j][2]+'-'+arr[j][3];
        console.log("Digit13",digit13)
        var x='<tr id="rows"><td id="prf" value="'+arr[j][0]+'">'+arr[j][0]+'</td><td id="pos">'+arr[j][1]+'</td><td id="iid">'+arr[j][2]+'</td><td id="rid">'+arr[j][3]+'</td><td id="result">'+arr[j][4]+'</td><td id="'+j+'5" >'+arr[j][5]+'</td><td id="interviewer">'+arr[j][6]+'</td><td><a name="'+arr[j][6]+'" id="'+j+'-'+digit13+'" class="btn green darken-1" onclick="sendmailtoinv(this.id,this.name)">Send Letter</a></td></tr>'
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