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
    
    if($designation == "hr2" || $designation == "ceo" || $designation == "hod" || $designation == "rghead" )
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
<div class="col s12 blue lighten-4">
  <table class="striped">
    <thead>
      <tr>
          <th>PRF</th>
          <th>POSITION</th>
          <th>NAME</th>
          <th>MEMBERS</th>
          <th>STATUS</th>

      </tr>
    </thead>

    <tbody id='rawdata'>
      
    </tbody>
  </table>
      </div>
      </div>
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
 


        $('#rejected').hide()
      $('#hold').hide()
      // $('#mytabs').hide()

    $('.tabs').tabs();
   $('#roundchoice').hide();    

$('#emailcollection').hide();
$('#submitmail').hide();
$('#groupcreated').hide()
$('#groupnotcreated').hide()
$('#creatinggrp').hide()

$('#select').click(function(){
        $('#rejected').hide()
        $('#hold').hide()

      $('#selected').show()
  
    })



    
    $('#reject').click(function(){
        
      $('#hold').hide()

      $('#selected').hide()
      $('#rejected').show()
  
    })
    


    
    $('#hld').click(function(){
        $('#rejected').hide()
     

      $('#selected').hide()
      $('#hold').show()
  
    })
var id;
var flag0 = 0

function xyz(x)
{
  roundid = x
      console.log(roundid)
      $('#tabledataselect').empty()

      $.ajax({

              url : 'http://localhost/thyssenkrup/api/getprfs2hr2.php',
              type : 'POST',
              data : {'prf':roundid},

              success:function(para)
              {
                console.log("this is the data came from backeka;lksdjfl;askjdf : ",para)
                
                $("#select").click()
              //  console.log( JSON.parse(para))
              if(para != "no data")
              {
                parseddata = JSON.parse(para)

                var element = parseddata[0].selected
                for (let i = 0; i < element.length; i++) {
                  var str = "<tr><td><a href='http://localhost/thyssenkrup/documentcheckhr2.php?aid="+element[i]+"' target='_blank'>"+element[i]+"</td></tr>"
                  
                  $('#tabledataselect').append(str)
                    
                } 

                var element = parseddata[0].rejected
                for (let i = 0; i < element.length; i++) {
                  var str = "<tr><td><a href='http://localhost/thyssenkrup/documentcheckhr2.php?aid="+element[i]+"' target='_blank'>"+element[i]+"</td></tr>"
                  
                  $('#tabledatareject').append(str)
                    
                } 

                var element = parseddata[0].hold
                for (let i = 0; i < element.length; i++) {
                  var str = "<tr><td><a href='http://localhost/thyssenkrup/documentcheckhr2.php?aid="+element[i]+"' target='_blank'>"+element[i]+"</td></tr>"
                  
                  $('#tabledatahold').append(str)
                    
                } 

              }

                
                
                $('#mytabs').fadeIn(900); 
                $('#select').click()
                flag0 = 1
              },
              error:function(err)
              {

              }
              });


  }
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
    url:'http://localhost/thyssenkrup/api/getprfshr2.php',
    type:'POST',
    // data:{'arr1':arr1},
    success : function(para)
    {
      // console.log(para)
      para=JSON.parse(para)
      // window.data=para
      // para=['1001','Developer','North','Sales','5','ongoing']
      console.log("This is the data came from backend = ",para)
      console.log("this is length : "+para.length)
      for(let j=0;j<para.length;j++)
      {
        if(para[j].status == "1")
        {
          status = "Revalidation"
        }
        if(para[j].status == "2")
        {
          status = "Validated"
        }
        if(para[j].status == "3")
        {
          status = "Revalidation"
        }
        if(para[j].status == "4")
        {
          status = "Revalidation"
        }
        if(para[j].status == "5")
        {
          status = "Offer Letter Requested"
        }
        if(para[j].status == "6")
        {
          status = "Offer Letter Sent"
        }
        var x='<tr id="rows"><td id="prf" value="'+para[j].prf+'">'+para[j].prf+'</td><td id="pos">'+para[j].pos+'</td><td id="zone">'+para[j].name+'</td><td id="dept">'+para[j].members+'</td><td id="dept">'+status+'</td></tr>'
       $('#rawdata').append(x);
      }
     
      for(let j=0;j<arr.length;j++)
      {
       
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
       