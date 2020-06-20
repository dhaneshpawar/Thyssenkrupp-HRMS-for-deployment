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

        <!-- for sidenav -->
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" type="text/css" media="screen" href="public/css/common.css">

  <script src="./public/jquery-3.2.1.min.js"></script>
  
  <script src="./public/js/materialize.js"></script>
  <script src="./public/js/materialize.min.js"></script>

<style>
@media screen and (min-width: 800px)
{
  #firsttb{
width: 100%;
}
#deptchoice{
  width: 19%;
} 

#zonechoice{
  width: 19%;
}

}

@media screen and (max-width: 800px)
{
#firsttb{
width: 350%;
}
#deptchoice{
  width: 70%;
} 

#zonechoice{
  width: 70%;
}

}

</style>
</head>

<body>

<!-- No data modal starts here -->
  <!-- Modal Structure -->
  <div id="nodatamodal" class="modal">
    <div class="modal-content">
      <center><i class="material-icons large " style="color: #ff5252;">error_outline</i></center>
      <br>
      
      <center><h2>No Data Avilable</h2></center>
      
    </div>
    <div class="modal-footer">
      <center>
      <a class="modal-close waves-effect green btn" >OK<i class="material-icons left" >check_box</i></a>
      </center>
    </div>
  </div>
<!-- no data modal ends here -->

<div id="sidenn" class="w3-sidebar blue w3-bar-block sidemenu" style="z-index: 1000">

  <h3 class="w3-bar-item white"> <center><a href="/hrms/">Home</a>
  <i id="remin" class="material-icons" style="float: right;cursor: pointer;">close</i></center>   
  </a></h3> <br><br>

  <a href="/hrms/csvupload.php" class="w3-bar-item w3-button">Create new Department and PRF</a> <br>
  <a href="/hrms/hrnew.php" class="w3-bar-item w3-button">Create New Instance</a> <br>
  <a href="/hrms/initiateround.php" class="w3-bar-item w3-button">Initiate rounds for instances</a> <br>
  <a href="/hrms/allocateround.php" class="w3-bar-item w3-button">On going rounds</a> <br>
  <a href="/hrms/history.php" class="w3-bar-item w3-button">See History  </a> <br>
  <a href="/hrms/allocateround2.php" class="w3-bar-item w3-button">Rescheduling</a> <br>
  <a href="/hrms/interview.php" class="w3-bar-item w3-button">Update Interviews</a> <br>
  <a href="/hrms/offerletter.php" class="w3-bar-item w3-button">Offer Letter</a> <br>
  <a href="#" id="logoutuser" class="w3-bar-item w3-button">Logout</a> <br>

</div>

<div id="remin">
<nav> 
    <div class="nav-wrapper blue darken-1">
      <a href="#!" class="brand-logo left" style="margin-left: 2%;"><i id="showsidenbutton" class="material-icons">menu</i>
    </a>
    <a href="/hrms/" class="brand-logo center">thyssenkrupp Elevators</a>
    </div>
</nav>
<br><br>
<!-- nav and side menu ended -->

 <div class="row" id="firsttb">
<div class="col s10  offset-m1 blue lighten-4">
  <table class="striped">
    <thead>
      <tr>
          <th>PRF</th>
          <th>Position</th>
          <th>Instance ID</th>
          <th>Round ID</th>
          <th>Candidate Name</th>
          <th>Candidate Mail</th>
          <th>Requester Name</th>
          <th>Requester Mail</th>
          <th>Offer Letter</th>

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
    <script src="public/js/common.js"></script>

<script>


$('#logoutuser').click(function(){

$.ajax({
url:"http://localhost/hrms/api/logout.php",
type:"POST",
success:function(para){

if(para=="success")
{
$("#row").hide()
$("#logout").show()
document.location.replace("http://localhost/hrms/index.php")
}
else
{
$("#notlogout").show()
document.location.replace("/hrms/")
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
  var str = '#'+btnid;
  alert(str);
  var candidate = "#"+prfid[0]+"5"
  var cmail = $(candidate).html()
  $(str).html("sending...");
  $(str).attr('disabled','disabled')
 
  $.ajax({
    url:'http://localhost/hrms/api/sendofferletter.php',
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
        alert("Mail Sent To Candidate")
        window.setTimeout(function(){location.reload()},1000)
      }
      else
      {
        console.log(para)
      }
    }
  })
}

var ctr = 0
var arr=[]
$(document).ready(function(){ 
  $('.modal').modal();
 $.ajax({
    url:'http://localhost/hrms/api/seerequestletters.php',
    type:'POST',
    success : function(para)
    {
      if(para == "No Data")
      {
        $("#nodatamodal").modal("open");
      }
      else
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
          var x='<tr id="rows"><td id="prf" value="'+arr[j][0]+'">'+arr[j][0]+'</td><td id="pos">'+arr[j][1]+'</td><td id="iid">'+arr[j][2]+'</td><td id="rid">'+arr[j][3]+'</td><td id="'+j+'4" >'+arr[j][4]+'</td><td id="'+j+'5" >'+arr[j][5]+'</td><td id="interviewername">'+arr[j][6]+'</td><td id="interviewermail">'+arr[j][7]+'</td><td><a name="'+arr[j][7]+'" id="'+j+'-'+digit13+'" class="btn green darken-1" onclick="sendmailtoinv(this.id,this.name)">Send Letter</a></td></tr>'
        $('#rawdata').append(x);
      }
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