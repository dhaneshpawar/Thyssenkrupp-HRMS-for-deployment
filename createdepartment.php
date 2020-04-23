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

  <link rel="stylesheet" type="text/css" media="screen" href="public/css/materialize.css">
  <link rel="stylesheet" type="text/css" media="screen" href="public/css/materialize.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

  <script src="public/jquery-3.2.1.min.js"></script>
  
  <script src="public/js/materialize.js"></script>
  <script src="public/js/materialize.min.js"></script>

</head>

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
 <br><br>
  <div class="row" id='row' >
    <div class="col m4 offset-m4  center">
      <div class="card  white">
        <div class="card-content white-text">
          
          
          <div class="col s12 ">
<?php
if($designation == "ceo")
{
  ?>
          <div class="input-field col s11  blue-text">
              <i class="material-icons prefix">location_city</i>
              <input id="regname" type="text" class="validate" placeholder="Region Name">               
            </div>

          <div class="input-field col s11  blue-text">
              <i class="material-icons prefix">account_balance</i>
              <input id="deptname" type="text" class="validate" placeholder="Department Name">               
            </div>
  
  <?php
}
else if($designation == "hod")
{
  ?>
          <div class="input-field col s11  blue-text">
              <i class="material-icons prefix">location_city</i>
              <input id="regname" type="text" class="validate" placeholder="Region Name">               
            </div>

          <div class="input-field col s11  blue-text">
              <i class="material-icons prefix">account_balance</i>
              <input id="deptname" type="text" class="validate" placeholder="Department Name" value="<?php echo $cursor["dept"] ?>" readonly>               
            </div>
  
  <?php
}
else if($designation == "rghead")
{
  ?>
            <div class="input-field col s11  blue-text">
              <i class="material-icons prefix">location_city</i>
              <input id="regname" type="text" class="validate" placeholder="Region Name" value="<?php echo $cursor["rg"] ?>" readonly>               
            </div>

          <div class="input-field col s11  blue-text">
              <i class="material-icons prefix">account_balance</i>
              <input id="deptname" type="text" class="validate" placeholder="Department Name">               
            </div>

  <?php
}
else if($designation == "hr")
{
  ?>
            <div class="input-field col s11  blue-text">
              <i class="material-icons prefix">location_city</i>
              <input id="regname" type="text" class="validate" placeholder="Region Name" value="<?php echo $cursor["rg"] ?>" readonly>               
            </div>

            <div class="input-field col s11  blue-text">
              <i class="material-icons prefix">account_balance</i>
              <input id="deptname" type="text" class="validate" placeholder="Department Name" value="<?php echo $cursor["dept"] ?>" readonly>               
            </div>

  <?php
}
?>



          
            <br><br>
          

          
            <div class="input-field col s11  blue-text">
              <i class="material-icons prefix">assignment</i>
              <input id="prfno" type="text" class="validate" placeholder="PRF Number">               
            </div>
                        
            <div class="input-field col s11  blue-text">
              <i class="material-icons prefix">group</i>
              <input id="pos" type="text" class="validate" placeholder="Enter Position">               
            </div>
            
            
            <div class="input-field col s6 offset-s3 center">
              <button class="btn waves-effect waves-light blue darken-1" id="checkprf">Submit
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
