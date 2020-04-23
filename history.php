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
  <a href="/thyssenkrup/history.php" class="w3-bar-item w3-button white">See History  </a> <br>
  <a href="/thyssenkrup/allocateround2.php" class="w3-bar-item w3-button">Rescheduling</a> <br>
  <a href="/thyssenkrup/interview.php" class="w3-bar-item w3-button">Update Interviews</a> <br>
  <a href="/thyssenkrup/offerletter.php" class="w3-bar-item w3-button">Offer Letter</a> <br>

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
<div class="col s12  blue lighten-4">
  <table class="striped">
    <thead>
      <tr>
          <th>PRF</th>
          
          <th>Position Details</th>
          <th>Zone</th>
          <th>Department</th>
          <th>No. of Positions</th>
          <th>Instance ID</th>
          <th>Status</th>
          <th>VIEW DETAILS</th>

      </tr>
      </thead>

    <tbody id='rawdata'>
      
    </tbody>
  </table>
</div> 
</div>

<div class="row" id="emailcollection">
  
  <div class="input-field col s4 offset-m4  blue-text" >
    <i class="material-icons prefix">email</i>
    <input id="email" onfocus="addText(this)" type="text" class="validate" placeholder="Enter Email">
  </div>
</div>

  
  <div class="input-field col s6 offset-s3 center">
    <button  class="btn waves-effect waves-light blue darken-1" id="submitmail" >Submit Mail
      <i class="material-icons right">send</i>
    </button>
  </div>



  <div class="row" >
      <center>
      <p style="color: green" id="creatinggrp">Creating Group...! </p>
      <p style="color: green" id="groupcreated">Group Created Successfully </p>
      <p style="color: red" id="groupnotcreated">Unable to create group </p>
      </center>
  </div>

  <div class="row">
      <div class="col s12 m12 ">
      <div class="">
      <div class="card-content blue-text">
      <br><br>
  
      <div class="card  col m12 s12">
      <div class="col m2">
      </div>
      </div>
  
                  <div class="row" id="allocatingcandidate" >
                    <div class="col s12 m12">
                      <div class="card  white">
                        <div class="card-content blue-text">
                          <p id='rid'><b></b></p>
                          <div class="row" id="allocation" >
                            <div class="col s12 m12" style="border: solid 5p">
                              <div class="card white">
                                <div class="card-content blue-text">
                                  <div class="row">
                                
                                  <div class="input-field col s3 m3 " >
                                      <input id="iname" type="text" class="text">
                                      <label class="active" for="iname" id="iname" required>Interviewer Name</label>
                                    </div>  

                                    <div class="input-field col s3 m3 white-text" >
                                      <input id="imail" type="text" >
                                      <label class="active" for="iname" required>Interwiever Mail ID</label>
                                    </div>

                                    <div class="input-field col s3 m3 white-text" >
                                      <input id="iloc" type="text" >
                                      <label class="active" for="iloc" required>Interview Location</label>
                                    </div>

                                    <div class="input-field col s3 m3 white-text" >
                                      <input id="iperson" type="text" >
                                      <label class="active" for="iperson" required>Contact Person</label>
                                    </div>        
                                  </div>
                                    
                                    <div class="row">
                                        <div class="input-field col s3 m3">
                                          <input id="idate" type="text" class="datepicker" required>
                                          <label  for="idate">Date</label>
                                        </div>
                                        <div class="input-field col s3 m3 " >
                                          <input id="itime" type="text" class="timepicker" required>
                                          <label class="active" for="itime">Time</label>
                                        </div>
                                        <div class="input-field col s3 m3 " >
                                          <input id="idept" type="text" class="text">
                                          <label class="active" for="idept" id="idept" required>Interviewer Department</label>
                                        </div>                                    
                                        <div class="input-field col s3 m3 " >
                                          <input id="idesg" type="text" class="text">
                                          <label class="active" for="idesg" id="idesg" required>Interviewer Designation</label>
                                        </div>
                                    </div>          
                                  

                                  <div class="row">
                                    <button class="btn waves-effect blue darken-1 col m3 s3 offset-m4" type="submit" id='allocatesubmit'>Submit
                                    <i class="material-icons right">send</i>
                                    </button>
                                  </div>
                                  
                                </div>
                              </div>
                            </div>
                          </div>
  
      <div id="mytabs" >
  
      <ul class="tabs" >
      <li id="select"  class="tab col s2">  <a> <b style="color: green;cursor: pointer;" >Selected</b></a></li>
      <li id="reject" class="tab col s2"><a ><b style="color: red;cursor: pointer;" >Rejected</b></a></li>
  
      <li id="hld" class="tab col s2"><a ><b style="color: orangered;cursor: pointer;" >Hold</b></a></li>
      <li id="exp_eval"  class="tab col s2"> <button class="btn btn-primary" onclick="location.href='excel/final_excel_evaluationForm.php'">Export Evaluations</button></li>
      <li id="exp_app"  class="tab col s2"> <button class="btn btn-primary" onclick="location.href='excel/final_excel_applicationBlank.php'">Export Applications </button></li>
      <li id="exp"  class="tab col s2"> <button class="btn btn-primary" onclick="location.href='excel/final_selected_rejected_onhold.php'">Export </button></li>  
      </ul>
  
      <div class="row" id="selected">
      <div class="col s12 ">
      <div class="card white">
      <div class="card-content ">
  
      <table class="striped">
        <thead >
          <tr>
              <th>Full Name</th>
              <th>Email ID</th>
              <th>View Evaluation Sheet</th>
              <th>View CV</th>
              
          </tr>
        </thead>
  
        <tbody id="tabledataselect">
          
        </tbody>
      </table>
      </div>
      </div>
      </div>
  
      </div>
  
      </div>
      <div class="row" id="rejected">
      <div class="col s12 ">
      <div class="card white">
      <div class="card-content ">
  
      <table class="striped">
        <thead>
          <tr>
              <th>Full Name</th>
              <th>Email ID</th>
              <th>View Evaluation Sheet</th>
              <th>View CV</th>
              
          </tr>
        </thead>
  
        <tbody id="tabledatareject">
          
        </tbody>
      </table>
      </div>
      </div>
      </div>
  
      </div>
  
  
      <div class="row" id="hold">
      <div class="col s12 ">
      <div class="card white">
      <div class="card-content">
  
      <table class="striped">
      <thead>
      <tr>
      <th>Email ID</th>
      <th>Full Name</th>
      <th>View Evaluation Sheet</th>
      <th>View CV</th>
      <th>Select</th>
     
      </tr>
      </thead>
  
      <tbody id="tabledatahold">  
         
      </tbody>
      <a class="green btn right" id="submithold">Assign Interviewer</a> 
      </table>
      </div>
      </div>
      </div>
  
      </div>
  
  
  
  
      </div>
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
var roundid;
var selectedmail = []
$('#submithold').click(function(){
  if(selectedmail.length <= 0)
    {
      alert("Please Select Atleast 1 Member")
    }
    else
    {
      for(let i=0;i<selectedmail.length;i++)
      {
        $('#allocation').fadeIn();

        console.log(selectedmail[i])
      }
    }                      

})


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
  roundid = x.split("*");
  

      console.log(roundid)

      $('#tabledataselect').empty()

      $.ajax({

              url : 'http://localhost/thyssenkrup/api/getprfs2.php',
              type : 'POST',
              data : {
                'prf':roundid[0],
                'pos':roundid[1],
                'iid':roundid[2]
                  },

              success:function(para)
              {
                console.log("para : ",para)
                
                $("#select").click()
              //  console.log( JSON.parse(para))
              if(para != "no data")
              {
                parseddata = JSON.parse(para)
                var element = parseddata[0].selected
                for (let i = 0; i < element.length; i++) 
                {
                  var str = "<tr><td><p>"+element[i][1]+"</p></td><td><a href='http://localhost/thyssenkrup/documentcheck.php?aid="+element[i][0]+"' target='_blank'>"+element[i][0]+"</a></td><td> <a class='waves-effect waves-light btn' href='http://localhost/thyssenkrup/documentcheck.php?aid="+element[i][0]+"' target='_blank'>Evaluation Sheet</a></td><td><a class='waves-effect waves-light btn' href='http://localhost/thyssenkrup/viewcv.php?aid="+element[i][0]+"' target='_blank'>View CV</a></td></tr>"
                  
                  $('#tabledataselect').append(str)
                    
                } 

                var element = parseddata[0].rejected
                console.log(element)
                for (let i = 0; i < element.length; i++) 
                {
                  if(element[i][0][1] == "Aborted")
                  {
                    var str = "<tr><td><p>"+element[i][1]+"</p></td><td><a href='http://localhost/thyssenkrup/documentcheck.php?aid="+element[i]+"' target='_blank'>"+element[i][0][0]+"</a> </td><td>Aborted</td><td><a class='waves-effect waves-light btn' href='http://localhost/thyssenkrup/viewcv.php?aid="+element[i]+"' target='_blank'>View CV</a></td></tr>"
                    $('#tabledatareject').append(str)
                  }
                  else
                  {
                    var str = "<tr><td><p>"+element[i][1]+"</p></td><td><a href='http://localhost/thyssenkrup/documentcheck.php?aid="+element[i]+"' target='_blank'>"+element[i][0]+"</a> </td><td> <a class='waves-effect waves-light btn' href='http://localhost/thyssenkrup/documentcheck.php?aid="+element[i]+"' target='_blank'>Evaluation Sheet</a></td><td><a class='waves-effect waves-light btn' href='http://localhost/thyssenkrup/viewcv.php?aid="+element[i]+"' target='_blank'>View CV</a></td></tr>"
                  
                  $('#tabledatareject').append(str)
                  }
                  
                    
                } 
                if(parseddata[0].onhold != "")
                {
                  var element = parseddata[0].onhold
                console.log("element: ",element)
                elemail = element[0][0].split(",")
                // var arr=[["Tanmay Kulkarni","tvkulkarni@mitaoe.ac.in"]]
                for (let i = 0; i < element.length; i++) 
                {
                  mailidonly = element[i][0].split(",")
                  if(mailidonly[1] == "absent")
                  {
                    var str = "<tr><td><p id='"+i+"mail'>"+mailidonly[0]+"</p></td><td><p>"+element[i][1]+"</p></td><td><p>Absent</p>&nbsp;&nbsp;</td><td><a class='waves-effect waves-light btn' href='http://localhost/thyssenkrup/viewcv.php?aid="+mailidonly[0]+"' target='_blank'>View CV</a></td><td><p><label><input type='checkbox' class='filled-in' id='"+i+"check' name='"+i+"mail' onclick='selection(this.id,this.name)' /><span></span></label></p></td></tr>"
                  $('#tabledatahold').append(str)
                  }
                  else
                  {
                    var str = "<tr><td><a href='http://localhost/thyssenkrup/documentcheck.php?aid="+mailidonly[0]+"' target='_blank'><p id='"+i+"mail'>"+mailidonly[0]+"</p></a> </td><td><p>"+element[i][1]+"</p></td><td> <a class='waves-effect waves-light btn' href='http://localhost/thyssenkrup/documentcheck.php?aid="+mailidonly[0]+"' target='_blank'>Evaluation Sheet</a>&nbsp;&nbsp;</td><td><a class='waves-effect waves-light btn' href='http://localhost/thyssenkrup/viewcv.php?aid="+mailidonly[0]+"' target='_blank'>View CV</a></td><td><p><label><input type='checkbox' class='filled-in' id='"+i+"check' name='"+i+"mail' onclick='selection(this.id,this.name)' /><span></span></label></p></td></tr>"
                  $('#tabledatahold').append(str)
                  }
                  
                    
                } 
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
  $('#allocation').hide();
  $('.datepicker').datepicker
  ({
      minDate:new Date(),
  })
  $('.timepicker').timepicker();

  $('.filled-in').on('change', function() {
		    $('.filled-in').not(this).prop('checked', false);  

	}); 

 $("#mytabs").hide()
 $.ajax({
    url:'http://localhost/thyssenkrup/api/getprfs.php',
    type:'POST',
    // data:{'arr1':arr1},
    success : function(para)
    {
      // console.log(para+"<br>")
      para=JSON.parse(para)
      // window.data=para
      // para=['1001','Developer','North','Sales','5','ongoing']
      console.log("This is the data came from backend = ",para)
      console.log("this is length : "+para.length)
      for(let i=0;i<para.length;i++)
      {
        arr[i]=para[i];
      }
     
      for(let j=0;j<arr.length;j++)
      {
        var x='<tr id="rows"><td id="prf" value="'+arr[j][0]+'">'+arr[j][0]+'</td><td id="position">'+arr[j][1]+'</td><td id="zone">'+arr[j][2]+'</td><td id="dept">'+arr[j][3]+'</td><td id="posno">'+arr[j][4]+'</td><td id="iid">'+arr[j][5]+'</td><td id="status">'+arr[j][6]+'</td><td width="25%"><a id="'+arr[j][0]+"*"+arr[j][4]+"*"+arr[j][5]+'" class="btn small green darken-1" onclick="xyz(this.id)">View Details</a></td></tr>'
       $('#rawdata').append(x);
      }
     
    },
  })
})

$('#allocatesubmit').click(function()
{
  $("#waiting").fadeIn(600);
  var groupid=window.groupid
  var iname = $('#iname').val();
  var idate = $('#idate').val();
  var itime = $('#itime').val();
  var idept = $('#idept').val();
  var idesg = $('#idesg').val();
  var imail = $('#imail').val();
  var iloc = $('#iloc').val();
  var iperson = $('#iperson').val();

  $('#allocation').hide(600);
  $.ajax({
  url:'http://localhost/thyssenkrup/api/assignonhold.php',
  type:'POST',
  data:{
        "emails":selectedmail,
        "iname":iname,
        "intvmail":imail,
        "date":idate,
        "time":itime,
        "prf":groupid,
        "iloc":iloc,
        "iperson":iperson,
        "idesg":idesg,
        "dept":idept,
        "prf":roundid[0],
        'pos':roundid[1],
        'iid':roundid[2]
      },
  success:function(para){
    console.log(para);
    selectedmail = []
    document.location.reload();


  }
  })

 })

var ctr=0
function selection(umail,mail)
{
  console.log("name: ",mail)

  
  var umail="#"+umail;
  var pmail = '#'+mail
  console.log("id: ",$(umail).text())

  if($(umail).prop("checked") == true)
  {
    selectedmail.push($(pmail).text())
    console.log(selectedmail)
  }
  else
  {                                               
    for( var i = 0; i < selectedmail.length; i++)
    { 
      if ( selectedmail[i] == $(pmail).text()) 
      {
        selectedmail.splice(i, 1); 
        i--;
      }
    }
    console.log(selectedmail)
  }
}
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