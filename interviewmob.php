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

        <!-- for sidenav -->
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" type="text/css" media="screen" href="public/css/common.css">

<style>
   
   #loader {
     position: fixed;
     top: 0;
     left: 0;
     right: 0;
     bottom: 0;
     width: 100%;
     background: rgba(0,0,0,0.95)  url(loader2.gif)  no-repeat center center !important;
     z-index: 10000;
   }
   #loader > #txt{
     font-size:23px;
     color:lightskyblue;
     margin-left:22% !important;
     margin-top:18% !important; 
   }
   #updated {
     position: fixed;
     top: 0;
     left: 0;
     right: 0;
     bottom: 0;
     width: 100%;
     background: rgba(0,0,0,0.95)  url(loader2.gif)  no-repeat center center !important;
     z-index: 10000;
   }
   #updated > #txt{
     font-size:23px;
     color:lightskyblue;
     margin-left:22% !important;
     margin-top:18% !important; 
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

<div id="sidenn" class="w3-sidebar blue w3-bar-block sidemenu" style="z-index: 1000;overflow-y:hidden">

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

 <div class="row" style="width: 350%;">
<div class="col s12 blue lighten-4">
  <table class="striped" >
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
          <th>Notify Candidates</th>
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
    <div class="col s12 m12  blue lighten-4">
           
            <div class="row" >
                
                <div class="input-field col s12">
                <b>Interviewer Name</b>
                <input id="interviewer_name" type="text" class="validate">
                </div>
                <div class="input-field col s12">
                <b>Interviewer Email</b>
                <input id="interviewer_email" type="text" class="validate">
                </div>
                <div class="input-field col s12">
                <b>Department Name</b>
                <input id="interviewer_dept" type="text" class="validate">
                </div>

                <div class="input-field col s12">
                <b>Interview Location</b>
                <input id="iloc" type="text" class="validate">
                </div>
                <div class="input-field col s12">
                <b>Contact Person</b>
                <input id="iperson" type="text" class="validate">
                </div>

                <div class="input-field col s12">
                <b>Designation</b>
                <input id="interviewer_dsg" type="text" class="validate">
                </div>

                <div class="input-field col s12">
                <b>Interview Date</b>
                <input id="interview_date" type="text" class="datepicker" type="text">
                </div>

                <div class="input-field col s12">
                <b>Interview Time</b>
                <input id="interview_time" type="text" class="timepicker" type="text">
                </div>
                <br>
                <center>
                    <a class="btn green darken-1" id='updatebtn'>UPDATE</a>
                </center>
            </div>
            <hr style="border: 2px solid black";>
            <table class="striped" style="width: 350%;">
                    <thead>
                      <tr>
                      
                          <th style="font-size:15px;" >Members</th>
                          <th style="font-size:15px;" >Date</th>
                          <th style="font-size:15px;" >Time</th>
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
<div id="loader" >
    <div id="txt">
        <b>Please wait while we send confirmation to candidates and interviewer</b>    
    </div>  
</div>

<div id="updated" >
    <div id="txt">
        <b>Please wait while we send modification details to respective authority</b>    
    </div>  
  </div>
</div>
</body>


<script src="public/js/common.js"></script>

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

function modifyMail(id,name)
{
    newemail=$('#interviewer_email').val()    
    console.log("id=",id)
    console.log("name=",newemail)
    console.log("mail=",newemail)
    console.log("Data  : "+id );
    id_ = id;
    id=id.split("*");
    // console.log("Name  : "+name );
    date = '#check'+name+"date";
    name = '#check'+name+'time';
    console.log("Date id - ",date,name)
    updatedTime = $(name).val()
    updatedDate = $(date).val()
    console.log("Updated Date - ",updatedDate)
    console.log("Updated Time - ",updatedTime)
    console.log('Exsiting is time : ',id[2])

    if(id[2].localeCompare(updatedTime)==0 && id[1].localeCompare(updatedDate) == 0 )
    {
       alert("Same date time")
    }
    else
    {
        console.log("Not Equal")
        $.ajax({
        url:"http://localhost/hrms/api/hrmodifytime.php",
        type:"POST",
        data:{
            "index":id[0],
            "date":id[1],
            'time':id[2],
            "digit13":id[3],
            "mail":newemail,
            "updatedTime":updatedTime,
            "updatedDate":updatedDate
        },
        success:function(para)
        {
            if(para=="modify")
            {
                alert("Modification Done");
                window.setTimeout(function(){location.reload()},1000)
      
            }
            else if(para == "fail")
            {
                alert("Operation Failed . Please try again..")
            }
           
            console.log("This is my data:  "  +para)
        }

       })
    }
    console.log("This is : ")
    console.log("Split data : "+id[0]+" & "+id[1]+"&"+id[2])

    
}


function xyz(x)
{
  $('#memberdata').text('')
  id=x;
  prfint=id;
  prfints=id.split('*')
  // alert(prfint)
  $.ajax({
      url:"http://localhost/hrms/api/getthatintvmembers.php",
      type:"POST",
      data:{'prfint':prfint},
      success:function(para)
      {
        console.log("This is : ",para);
        // intarr=para;
        para=JSON.parse(para);
        members=para
        for (let i=0;i<(para.members).length;i++)
        {
            $digit13 = para.prf+'-'+para.pos+'-'+para.iid+'-'+para.rid;
            var s0 ='<tr><td>'+para.members[i]+'</td>'
            var s1='<td><input type="text" id="check'+i+'date" value="'+para.dates[i]+'"class="datepicker"></td>'
            var s2='<td><input type="text" id="check'+i+'time" value="'+para.times[i]+'"class="timepicker"></td>'
            var s3 ='<td><button  class="btn waves-effect green"  id="'+i+'*'+para.dates[i]+'*'+para.times[i]+'*'+$digit13+'" name="'+i+'" onclick="modifyMail(this.id,this.name)">Modify Time<i class="material-icons right">send</i></button></td></tr>'
            var str= s0+s1+s2+s3
            // s2 = s0+s1;
            $('#memberdata').append(str)
            $('.timepicker').timepicker();
            $('.datepicker').datepicker();
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
  $('#loader').hide()
  $('#updated').hide()
  $('.modal').modal();
  $('.datepicker').datepicker
  ({
      minDate:new Date(),
  })
  $('.timepicker').timepicker();
 $.ajax({
    url:'http://localhost/hrms/api/getinterviewer.php',
    type:'POST',
    data:{
        'arr':arr,
        },
    success : function(para)
    {
      if(para == "No Data")
      {
        $("#nodatamodal").modal("open");
      }else
      {
        console.log("this is : ",para)
        para=JSON.parse(para);
        console.log("this is : ",para)
        //para=JSON.parse(para)
        //para=[['1111','ABCD','Accept','28/11/19','4.00'],['1111','ABCD','Accept','28/11/19','4.00'],['1111','ABCD','Accept','28/11/19','4.00']]
      
        for(let j=0;j<para.length;j++)
        {
            if(para[j][10] == "yes" && para[j][13] == "done")
            {
              var x='<tr id="rows" class="rows"><td>'+para[j][0]+'</td><td>'+para[j][1]+'</td><td>'+para[j][2]+'</td><td>'+para[j][7]+'</td><td>'+para[j][3]+'</td><td>'+para[j][5]+'</td><td>'+para[j][6]+'</td><td>'+para[j][10]+'</td><td><a id="'+para[j][0]+'*'+para[j][1]+'*'+para[j][2]+'*'+para[j][3]+'*'+para[j][4]+'*'+para[j][5]+'*'+para[j][6]+'*'+para[j][7]+'*'+para[j][8]+'*'+para[j][9]+'*'+para[j][10]+'*'+para[j][11]+'*'+para[j][12]+'" class="btn green darken-1" onclick="xyz(this.id)">Update</a></td><td><a id="'+para[j][0]+'*'+para[j][1]+'*'+para[j][2]+'*'+para[j][3]+'*'+para[j][5]+'*'+para[j][6]+'*'+para[j][7]+'*'+para[j][10]+'*'+para[j][12]+'*'+para[j][11]+'" class="btn green darken-1" onclick="notifyCandidate(this.id)" name="notify" style="width: 150px;" disabled>Mail Sent</a></td></tr>'
            }
            else if(para[j][10] == "pending")
            {
              var x='<tr id="rows" class="rows"><td>'+para[j][0]+'</td><td>'+para[j][1]+'</td><td>'+para[j][2]+'</td><td>'+para[j][7]+'</td><td>'+para[j][3]+'</td><td>'+para[j][5]+'</td><td>'+para[j][6]+'</td><td>'+para[j][10]+'</td><td><a id="'+para[j][0]+'*'+para[j][1]+'*'+para[j][2]+'*'+para[j][3]+'*'+para[j][4]+'*'+para[j][5]+'*'+para[j][6]+'*'+para[j][7]+'*'+para[j][8]+'*'+para[j][9]+'*'+para[j][10]+'*'+para[j][11]+'*'+para[j][12]+'" class="btn green darken-1" onclick="xyz(this.id)">Update</a></td><td><a id="'+para[j][0]+'*'+para[j][1]+'*'+para[j][2]+'*'+para[j][3]+'*'+para[j][5]+'*'+para[j][6]+'*'+para[j][7]+'*'+para[j][10]+'*'+para[j][12]+'*'+para[j][11]+'" class="btn green darken-1" onclick="notifyCandidate(this.id)" name="notify"  style="width: 150px;">Send Mail</a></td></tr>'
            }
            else
            {
              var x='<tr id="rows" class="rows"><td>'+para[j][0]+'</td><td>'+para[j][1]+'</td><td>'+para[j][2]+'</td><td>'+para[j][7]+'</td><td>'+para[j][3]+'</td><td>'+para[j][5]+'</td><td>'+para[j][6]+'</td><td>'+para[j][10]+'</td><td><a id="'+para[j][0]+'*'+para[j][1]+'*'+para[j][2]+'*'+para[j][3]+'*'+para[j][4]+'*'+para[j][5]+'*'+para[j][6]+'*'+para[j][7]+'*'+para[j][8]+'*'+para[j][9]+'*'+para[j][10]+'*'+para[j][11]+'*'+para[j][12]+'" class="btn green darken-1" onclick="xyz(this.id)">Update</a></td><td><a id="'+para[j][0]+'*'+para[j][1]+'*'+para[j][2]+'*'+para[j][3]+'*'+para[j][5]+'*'+para[j][6]+'*'+para[j][7]+'*'+para[j][10]+'*'+para[j][12]+'*'+para[j][11]+'" class="btn green darken-1" onclick="notifyCandidate(this.id)" name="notify" style="width: 150px;" disabled>Send Mail</a></td></tr>'
            }
            $('#rawdata').append(x);  
          
        }
      }
      
    },
  })
})


function notifyCandidate(id)
{
  $('#loader').show()
  // alert(id)
  $.ajax({
    url:"http://localhost/hrms/api/notifyCandidate.php",
    type:"POST",
    data:{
      "prf13":id
    },
    success:function(){
      $('#loader').hide()
      window.setTimeout(function(){location.reload()},1000)
      
    }
  })
}

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

$('#updatebtn').click(function()
    {  
        $('#updated').show()   
        newname=$('#interviewer_name').val()
        newdate=$('#interview_date').val()
        newtime=$('#interview_time').val()   
        newemail=$('#interviewer_email').val()    
        newdept=$('#interviewer_dept').val()   
        newdsg=$('#interviewer_dsg').val() 
        iloc=$('#iloc').val()   
        iperson=$('#iperson').val()   

        console.log("Members", members) 
        $.ajax({
          
            url:"http://localhost/hrms/api/updateint.php",
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
               
                   $('#updatediv').hide(800);
                  $('#successdiv').show(800);
                  $('#updated').hide()     

            }

        })       
              
    })





</script>
</html>
        