<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

      
        <!-- for sidenav -->
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
          
  <!-- <link rel="stylesheet" type="text/css" media="screen" href="css/materialize.css">
  <link rel="stylesheet" type="text/css" media="screen" href="css/materialize.min.css"> -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

  <!-- <script src="jquery-3.2.1.min.js"></script>
  
  <script src="js/materialize.js"></script>
  <script src="js/materialize.min.js"></script> -->

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
  <a href="/thyssenkrup/interview.php" class="w3-bar-item w3-button white">Update Interviews</a> <br>
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
<div class="col s12 blue lighten-4">
  <table class="striped " >
    <thead>
      <tr>
          <th>PRF</th>
          <th>Round Id</th>
          <th>Instance Id</th>
          <th>Interviewer Name</th>
          <th>Interviewer Email</th>
          <th>Date</th>
          <th>Time</th>
          <th>Accepted</th>
          <th>Update</th>
      </tr>      
    </thead>
    <tbody id='rawdata'>
    </tbody>
  </table>
</div> 
</div>


<div id='updatediv' class="row">
    <br>
    <b style="color:red;margin-left:28%;font-size:18px;" >You Can Edit The Following - Interviewer, Date & Time</b><br><br>
    <div class="col s10  m12  blue lighten-4">
           
            <div class="row" >
                
                <div class="input-field col s3">
                <b>Interviewer Name</b>
                <input id="interviewer_name" type="text" class="validate">
                </div>
                <div class="input-field col s3">
                <b>Interviewer Email</b>
                <input id="interviewer_email" type="text" class="validate">
                </div>
                <div class="input-field col s3">
                <b>Department Name</b>
                <input id="interviewer_dept" type="text" class="validate">
                </div>

                <div class="input-field col s3">
                <b>Interview Location</b>
                <input id="iloc" type="text" class="validate">
                </div>
                <div class="input-field col s3">
                <b>Contact Person</b>
                <input id="iperson" type="text" class="validate">
                </div>

                <div class="input-field col s3">
                <b>Designation</b>
                <input id="interviewer_dsg" type="text" class="validate">
                </div>

                <div class="input-field col s3">
                <b>Interview Date</b>
                <input id="interview_date" type="text" class="datepicker" type="text">
                </div>

                <div class="input-field col s3">
                <b>Interview Time</b>
                <input id="interview_time" type="text" class="timepicker" type="text">
                </div>
                <br>
                <center>
                    <a class="btn green darken-1" id='updatebtn'>UPDATE</a>
                </center>
            </div>
            <hr style="border: 2px solid black";>
            <table class="striped">
                    <thead>
                      <tr>
                      
                          <th style="font-size:15px;" >Members</th>
                      </tr>      
                    </thead>
                    <tbody id='memberdata'>
                    </tbody>
                </table>
                <br>

            
    </div>
</div>
<div id=successdiv>
    <center>
<b style="color:green">UPDATED SUCCESSFULLY</b>
</center>
</div>

  






</div>
</body>
<style>

</style>
<script>
$('#updatediv').hide();
$('#successdiv').hide();

var id;
var prfint;
var newname;
var newdate;
var newtime;
var oldname;
var olddate;
var oldtime;

var intarr=['Member1','Member2','Member3']
var newname;

function xyz(x)
{
  $('#memberdata').text('')
  id=x;
  prfint=id;
  prfints=id.split('*')
  // alert(prfint)
  $.ajax({
      url:"http://localhost/thyssenkrup/api/getthatintvmembers.php",
      type:"POST",
      data:{'prfint':prfint},
      success:function(para)
      {
        console.log("This is : ",para);
        // intarr=para;
        para=JSON.parse(para);
        members=para
        for (let i=0;i<para.length;i++)
        {
            
            var interviewdata='<tr><td>'+para[i]+'</td></tr><br>'
            $('#memberdata').append(interviewdata)
        }
      }

  })
  console.log(prfints)
    $('#updatediv').show(600);
    $('#interviewer_name').val(prfints[7])
    $('#interviewer_email').val(prfints[3])
    $('#interviewer_dept').val(prfints[8])
    $('#interviewer_dsg').val(prfints[9])
    $('#interview_date').val(prfints[5])
    $('#interview_time').val(prfints[6])
    $('#iloc').val(prfints[12])
    $('#iperson').val(prfints[11])

    prf=prfints[0];
    rid=prfints[1];
    iid=prfints[2];

    oldname=prfints[7];
    olddept=prfints[8];
    olddsg=prfints[9];
    oldemail=prfints[3];
    olddate=prfints[5];
    oldtime=prfints[6];
    oldiloc=prfints[10];
    oldiperson=prfints[12];

}




var prf
var arr=[]
$(document).ready(function(){     
  $('.datepicker').datepicker
  ({
      minDate:new Date(),
  })
  $('.timepicker').timepicker();
 $.ajax({
    url:'http://localhost/thyssenkrup/api/getinterviewer.php',
    type:'POST',
    data:{
        'arr':arr,
        },
    success : function(para)
    {
      console.log("this is : ",para)
      para=JSON.parse(para);
      console.log("this is : ",para)
      //para=JSON.parse(para)
      //para=[['1111','ABCD','Accept','28/11/19','4.00'],['1111','ABCD','Accept','28/11/19','4.00'],['1111','ABCD','Accept','28/11/19','4.00']]
     
      for(let j=0;j<para.length;j++)
      {
          var x='<tr id="rows" class="rows"><td>'+para[j][0]+'</td><td>'+para[j][1]+'</td><td>'+para[j][2]+'</td><td>'+para[j][7]+'</td><td>'+para[j][3]+'</td><td>'+para[j][5]+'</td><td>'+para[j][6]+'</td><td>'+para[j][10]+'</td><td><a id="'+para[j][0]+'*'+para[j][1]+'*'+para[j][2]+'*'+para[j][3]+'*'+para[j][4]+'*'+para[j][5]+'*'+para[j][6]+'*'+para[j][7]+'*'+para[j][8]+'*'+para[j][9]+'*'+para[j][10]+'*'+para[j][11]+'*'+para[j][12]+'" class="btn green darken-1" onclick="xyz(this.id)">Update</a></td></tr>'
          $('#rawdata').append(x);
        
      }
    },
  })
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

$('#updatebtn').click(function()
    {  
        newname=$('#interviewer_name').val()
        newdate=$('#interview_date').val()
        newtime=$('#interview_time').val()   
        newemail=$('#interviewer_email').val()    
        newdept=$('#interviewer_dept').val()   
        newdsg=$('#interviewer_dsg').val() 
        iloc=$('#iloc').val()   
        iperson=$('#iperson').val()   

console.log("Members", members)
// console.log("Dept: "+newdept);

       

        // alert("Button clicked");  
        $.ajax({
          
            url:"http://localhost/thyssenkrup/api/updateint.php",
            type:"POST",
            data:
            {
                'prf':prf,
                'rid':rid,
                'iid':iid,
                'oldname':oldname,
                'oldemail':oldemail,
                'olddept':olddept,
                'olddsg':olddsg,
                'olddate':olddate,
                'oldtime':oldtime,
                'newname':newname,
                'newdate':newdate,
                'newtime':newtime,
                'newemail':newemail,
                'newdept':newdept,
                'newdsg':newdsg,
                'iloc':iloc,
                'iperson':iperson,
                'members' : members

            },
            success:function(para)
            {
              console.log("para : ",para)
                //console.log(oldname,olddate,oldtime,newname,newdate,newtime)
                if(para=="success")
                {
                  // window.setTimeout(function(){location.reload()},1000)
                   $('#updatediv').hide(800);
                  $('#successdiv').show(800);
                }
                else{
                  alert("Done")
                  //window.setTimeout(function(){location.reload()},1000)
                  
                }
                
                


            }

        })       
              
    })


</script>
</html>
        