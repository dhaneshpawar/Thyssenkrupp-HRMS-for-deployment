<?php
//error_reporting(0);

if(isset($_COOKIE['sid']))
{
  include 'api/db.php';
  
  $cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
  
  if($cursor)
  {
    $cursor = $db->users->findOne(array("uid" => $cursor['uid']));
    $designation = $cursor['dsg'];
    
    if($designation == "ceo")
    {
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>

  <link rel="stylesheet" type="text/css" media="screen" href="public/css/materialize.css">
  <link rel="stylesheet" type="text/css" media="screen" href="public/css/materialize.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

  <script src="public/jquery-3.2.1.min.js"></script>
  
  <script src="public/js/materialize.js"></script>
  <script src="public/js/materialize.min.js"></script>

</head>
<style>
    .button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
}</style>

<body>

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

    <br>
    <center>
<button class="button">Only you can create delete or update info of users.</button>
</center>

    <br>
  <div class="row" id='row' >
    <div class="col m4 offset-m4">
      <div class="card  white">
        <div class="card-content white-text">
          
          
          <div class="col s12 ">

          <div class="input-field col s1 blue-text">
          <i class="material-icons prefix ">assignment_ind</i>
          </div>
          
          <div class="input-field col s11 blue-text ">
          <select id='dsgchoice' class="dropdown-trigger btn blue darken-1" >
              <option value="" disabled selected style="color: white">Select Designation</option>
              <option value="hod">Head of Department for all Regions</option>
              <option value="rghead">Head of Region</option>
              <option value="hr">HR</option>
              <option value="hr2">HR2</option>
              <option value="inv">Interviewer</option>
            </select>
            </div>

            <div class="input-field col s1 blue-text" > 
          <i class="material-icons prefix " id="rg">location_city</i>
          </div>

          
          <div class="input-field col s11 blue-text">
                     <select id='rgchoice' class="dropdown-trigger btn blue darken-1" >
              <option value="" disabled selected style="color: white">Select Region</option>
            </select>
            </div>

            <div class="input-field col s1 blue-text" >
          <i class="material-icons prefix " id="dept">account_balance</i>
          </div>

          <div class="input-field col s11  blue-text">
          <select id='deptchoice' class="dropdown-trigger btn blue darken-1" >
              <option value="" disabled selected style="color: white">Select Department</option>
            </select>
            </div>
                        
            <div class="input-field col s11  blue-text">
              <i class="material-icons prefix">email</i>
              <input id="pos" type="text" class="validate" placeholder="Enter Mail">               
            </div>
            
                        <div class="input-field col s11  blue-text">
              <i class="material-icons prefix">account_circle</i>
              <input id="username" type="text" class="validate" placeholder="Enter Username">               
            </div>

            <div class="input-field col s11  blue-text">
              <i class="material-icons prefix">vpn_key</i>
              <input id="password" type="password" class="validate" placeholder="Enter Password">               
            </div>

            <div class="input-field col s11  blue-text">
              <i class="material-icons prefix">lock</i>
              <input id="cnfrmpassword" type="password" class="validate" placeholder="Confirm Password">               
            </div>

            <div class="input-field col s12">

              <button class="btn waves-effect waves-light blue darken-1" id="checkprf">Update if exist or create
                <i class="material-icons right">send</i>
              </button>

              <button class="btn waves-effect waves-light blue darken-1" id="checkprf">Delete
                <i class="material-icons right">send</i>
              </button>

            </div>

          </div>  
          
          </div>
         
<div class="row" >
<center>
<p style="color: green" id="creatinggrp"> Inserting Details ...</p>
<p style="color: green" id="groupcreated"> Details inserted Successfully</p>
<p style="color: red" id="groupnotcreated"> These Details already exist</p>
</center>
</div>

</div>



</div>

</div>
</div>


<div id="logout">
<h1>Successfully Logged Out</h1>
</div>





</body>
</html>
<!-- end create group -->




<script>
var groupStatus;
var department
var prfno
var pos

var prfno
var ctr = 0
function addText(x)
{
ctr = ctr+1
var str = 'email'+ctr

var txt="<div class='row'><div class='input-field col s11  blue-text' ><i class='material-icons prefix'>email</i>  <input id='"+str+"' onfocus='addText(this)' type='text' class='validate' placeholder='Enter Email'></div></div>"
$("#emailcollection").append(txt);


}

$(document).ready(function(){
$('#rgchoice').hide()
$('#deptchoice').hide()
$('#rg').hide()
$('#dept').hide()
$("#notlogout").hide()
$("#logout").hide()
$('#histbtn').hide()
$('#hide').hide()
$('#hide2').hide()
$('#Exist').hide();
$('#groupcreated').hide()
$('#groupnotcreated').hide()
$('#creatinggrp').hide()

$('#groupcreation').hide();


$('#newgroup').hide();
$('#notexist').hide();

$('#groupcreation').click(function(){

$('#newgroup').show(600);
});


//load event to populate dept and regions event

$.ajax({
type:"GET",
url:"demo.txt",

success : function(para){
para = ['chakan','xyz','pqr','abc']
var para2 = ['dept1','dept2','dept3']
//for loop -> region
for(let i =0;i<para.length;i++)
{
  var str = '<option value="'+para[i]+'"  style="color: white">'+para[i]+'</option>'
  $("#rgchoice").append(str)
}
//for loop -> dept
for(let i =0;i<para2.length;i++)
{
  var str = '<option value="'+para2[i]+'" style="color: white">'+para2[i]+'</option>'
  $("#deptchoice").append(str)
}

}
});
  

$('#dsgchoice').change(function(){
  var dsg = $('#dsgchoice').val();
  alert(dsg)

  console.log(dsg);
  if(dsg == 'hod')
  {
    $('#rgchoice').fadeOut()
    $('#rg').fadeOut()
    $('#dept').fadeIn()
    $('#deptchoice').fadeIn()



  }
  else if(dsg == 'rghead')
  {
    $('#dept').fadeOut()
    $('#deptchoice').fadeOut()
    $('#rgchoice').fadeIn()
    $('#rg').fadeIn()
    

  }
  else
  {
    $('#rg').fadeIn(600)
    $('#dept').fadeIn(600)
    $('#rgchoice').fadeIn(600)
    $('#deptchoice').fadeIn(600)
  }
})














//create PRF Number

$('#checkprf').click(function(){

$('#groupcreated').hide()
$('#groupnotcreated').hide()

$('#creatinggrp').hide()

$('#creatinggrp').fadeIn(600);


department = $('#deptname').val();
prfno = $('#prfno').val();
if(prfno.length == 6)
pos=$("#pos").val();

//prfno = $('#prfno').val();

var data = {'deptchoice':department,"prfno":prfno,"pos":pos}
console.log(data)


$.ajax({
url : 'http://localhost/thyssenkrup/api/createprf.php',
type : 'POST',
data : {'deptchoice':department,"prfno":prfno,"pos":pos},


success : function(para){

  $('#creatinggrp').hide(600);

if(para == '404')
{

  $('#groupnotcreated').fadeIn(600)

  console.log("PRF ALREADY EXISTS")
$('#notexist').hide()
groupStatus=1
var txt = '<b style="color: green" id="Exist">This PRF Number Already Exist</b>'
$('#exist').append(txt)
$('#histbtn').show()


}
else if(para == 'success')
{

  $('#groupcreated').fadeIn(600)

groupStatus=0;
$('#Exist').hide()
console.log("INSERTED")
var txt = '<b style="color: red" id="notexist">This PRF Number Does Not Exist</b> '
$('#exist').append(txt)
}


},



});


$('#notexist').fadeIn(600);

});



});



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


</script>

</body>
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
