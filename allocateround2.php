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
    <title>Rescheduling</title>

    <link rel="stylesheet" type="text/css" media="screen" href="public/css/materialize.css">
    <link rel="stylesheet" type="text/css" media="screen" href="public/css/materialize.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        
        <!-- for sidenav -->
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <script src="public/jquery-3.2.1.min.js"></script>

    <script src="public/js/materialize.js"></script>
    <script src="public/js/materialize.min.js"></script>

</head>
<script>
function abort_round()
{
  var confr = confirm("Are You Sure ?");
  if(confr)
  {
    document.location.reload();
    
  }
}
</script>
<body>

<div class="w3-sidebar blue w3-bar-block" style="width:15%;border: 5px solid white;">


<h3 class="w3-bar-item"><a href="/thyssenkrup/"><center>Home</center></a></h3> <br><br>
  <a href="/thyssenkrup/csvupload.php" class="w3-bar-item w3-button">Create new Department and PRF</a> <br>
  <a href="/thyssenkrup/hrnew.php" class="w3-bar-item w3-button">Create New Instance</a> <br>
  <a href="/thyssenkrup/initiateround.php" class="w3-bar-item w3-button">Initiate rounds for instances</a> <br>
  <a href="/thyssenkrup/allocateround.php" class="w3-bar-item w3-button">On going rounds</a> <br>
  <a href="/thyssenkrup/history.php" class="w3-bar-item w3-button">See History  </a> <br>
  <a href="/thyssenkrup/allocateround2.php" class="w3-bar-item w3-button white">Rescheduling</a> <br>
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
                    <div class="col s12 m12">
                      <div class="card  white">
                        <div class="card-content blue-text">
                            <table class="striped">
                                <thead>
                                  <tr>
                                      <th>PRF-POSITION-INSTANCE-ROUND</th>
                                      <th>Interviewer Name</th>

                                      <th>Interviewer Mail Id</th>
                                      <th>Reason Of rejection</th>
                                      <th>Reshedule Round</th>
                                  </tr>
                                </thead>
                                <tbody id="addtr">
                                  
                                </tbody>
                            </table>
                        </div>
                      </div>
                    </div>
                  </div>

                  <center>
                  <b><p id="pleasewait" style="color:red">Updating Information Please Wait...</p></b>
                  </center>

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
                                      <input id="imail" type="text" required>
                                      <label class="active" for="imail">Interviewer Mail ID</label>
                                    </div> 
                                    <div class="input-field col s3 m3 " >
                                          <input id="location" type="text" class="text" required>
                                          <label class="active" for="location" id="location">Interview Location</label>
                                        </div>
                                        <div class="input-field col s3 m3 " >
                                          <input id="contactperson" type="text" class="text" required>
                                          <label class="active" for="contactperson" id="contactperson">Contact Person Name</label>
                                        </div>
                                  </div>       
                                    <div class="row">
                                        <div class="input-field col s3 m3 " >
                                          <input id="idate" type="text" required class="datepicker">
                                          <label  for="idate">Date</label>
                                        </div>
                                        <div class="input-field col s3 m3 " >
                                          <input id="itime" type="text" class="timepicker" required>
                                          <label class="active" for="itime">Time</label>
                                        </div>
                                        <div class="input-field col s3 m3 " >
                                          <input id="idept" type="text" class="text" required>
                                          <label class="active" for="idept" id="idept">Interviewer Department</label>
                                        </div>                                    
                                        <div class="input-field col s3 m3 " >
                                          <input id="idesg" type="text" class="text" required>
                                          <label class="active" for="idesg" id="idesg">Interviewer Designation</label>
                                        </div>
                                       
                                        
                                    </div>          

                                
                                  <div class="row">
                                    <button class="btn waves-effect blue darken-1 col m3 s3 offset-m4" id='allocatesubmit'>Submit
                                    <i class="material-icons right">send</i>
                                    </button>
                                      
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <table class="striped">
                            <thead>
                              <tr>
                                <th>Mail ID</th>
                                <th>Select</th>
                                <th class="btn blue darken-1" id="submit">Assign Interviewer</th>
                                
                              </tr>
                            </thead>
                            <tbody id="adddetail">
                              
                                  <div id="temp">

                                  </div>
                              
                            </tbody>
                          </table>

                        </div>          
                      </div>
                    </div>
                  </div>
                            
                  </div>                   
<center>
<p id="nodata"><b style="color:red;margin-left:12%">No Data Available..!</b></p>
</center>
<script>

var selectedmail = []
var allmail = []
$(document).ready(function(){
  $("#nodata").hide()
  $("#pleasewait").hide();
  $.ajax(
    {
      url:'http://localhost/thyssenkrup/api/rejectedinv.php',
      type:'POST',
      success:function(para){
        console.log(para)
      if(para != "nodata")
      {
       var arr =  JSON.parse(para)
        for(let i =0;i<arr.length;i++)
        {
          var intvmail=arr[i]['intvmail'];
          var reason=arr[i]['reason'];
          console.log(reason)
          var appended=arr[i]['prf']+"-"+arr[i]['position']+"-"+arr[i]['iid']+"-"+arr[i]['rid'];
          // alert(appended);
          var s1='<tr id="'+appended+'row">'
          var s6='<tr id="intvmail row">'
          var s7='<tr id="reason row">'
        
          var s2='<td>'
          var s3='<p class="btn waves-effect blue darken-1" >'+appended+'</p></td><td>'
          var s8='<p >'+arr[i]['intvmail']+'</p></td><td>'
          var s9='<p >'+reason+'</p></td><td>'
          var s10='<p>'+arr[i]['invname']+'</p></td><td>'

          var s4='<button class="waves-effect green  btn"  id='+appended+'*'+intvmail+' onclick="createnextround(this.id)">Reshedule Round</button></td></tr>'
          var str=s1+s2+s3+s10+s8+s9+s4
           $('#addtr').append(str)
        }
      }
      else
      {
        $("#nodata").fadeIn(600);
      }
      }
    });

    $('.datepicker').datepicker
  ({
      minDate:new Date(),
  })
  $('.timepicker').timepicker();
  $('#allocation').hide();
  $('#allocatingcandidate').hide();

  //final assignment for interviwer,date and time
  counter=1;

  $('#submit').click(function(){
    if(selectedmail.length <= 0 && counter == 1)
    {
      alert("Please Select Atleast 1 Member")
    }
    else
    {
      counter=1;
    
    var iid=window.iid;
     var oldintv=window.intvmail;
    
    //var oldintv=intvmail;
    for(let i=0;i<selectedmail.length;i++)
    {
     //console.log(window.iid)
     
    }
 

    $('#allocation').show(600);
    $('#allocatesubmit').click(function(){
      console.log(iid);
      // alert("Old " +oldintv);
      var imail = $('#imail').val();
      var iname = $('#iname').val();
      var idate = $('#idate').val();
      var itime = $('#itime').val();
      var idept = $('#idept').val();
      var idesg = $('#idesg').val();
      var iloc = $('#location').val();
      var iperson = $('#contactperson').val();
      // alert("new " +iname);
      console.log(selectedmail)
      $('#allocation').hide(600);
      $("#pleasewait").fadeIn(600);
      $.ajax({
        url:'http://localhost/thyssenkrup/api/updateintv.php',
        type:'POST',
        data:{
          //dept needed to be submitted
          'oldintv':oldintv,
          'emails':selectedmail,
          'intv':imail,
          'date':idate,
          'time':itime,
          'prf':iid,
          'iname':iname,
          "idesg":idesg,
          "idept":idept,
          "iloc":iloc,
          "iperson":iperson
        },
        success:function(para){
          console.log("After execution - "+para)
       //   console.log("This is the para after interbiew = ",para)
          for(let i=0;i<selectedmail.length;i++)
            {
             var ml = selectedmail[i];
             var id = allmail.indexOf(ml) 
             var str='#check'+id+'row';
              $(str).remove();
              //document.location.reload();
              $("#pleasewait").hide();
            }
            selectedmail = []
            window.setTimeout(function(){location.reload()},1000)

        }
      })
    })
  }
  })
})
//end of document.ready(function)   

var ctr=0
function selection(x)
{
 
  var b = '#'+x
  var y ='#'+x+'mail'  
 
  if($(b).prop("checked") == true)
  {
    selectedmail.push($(y).text())
    console.log(selectedmail)
  }
  else
  {                                               
    for( var i = 0; i < selectedmail.length; i++)
    { 
      if ( selectedmail[i] === $(y).text()) 
      {
        selectedmail.splice(i, 1); 
        i--;
      }
    }
    console.log(selectedmail)
  }
}

var id_round
function createnextround(ids)
{
  console.log(ids)
  var res = ids.split("*");
  var id=res[0]
  var intvmail=res[1]
  window.intvmail=intvmail
  window.iid=id;
  id_round = id
  // alert("this is id : "+id)
  // alert("this is mail : "+intvmail)
  //alert("this is reason : "+reason)
  console.log(id_round)
  console.log(intvmail)
  $('#allocatingcandidate').slideDown(600);
 
  $.ajax({
    url:'http://localhost/thyssenkrup/api/invrejectroundmembs.php',
    type:'POST',
    data:{
          "id":id_round,
          "intvmail":intvmail
         },
    success:function(para)
    {
      //var p1='<b>Reason : '+reason+'<b>'
      //$('#rid').replaceWith(p1);  
     // console.log("this are rejected round mamnreafs = ",para)
      $('#adddetail').text("")
      var arr = JSON.parse(para)
      console.log("mails : "+arr)
      for(let i =0;i<arr.length;i++)
      {
        allmail[i] = arr[i];
        var s1='<tr id="check'+i+'row"><td><p id="check'+i+'mail">'+arr[i]+'</p></td><td><label>'
        var s2='<input type="checkbox" class="filled-in" id="check'+i+'" onclick="selection(this.id)"/>'
        var s3='<span class="blue-text darken-1" ></span></label></td><td></td></tr>'
        var str=s1+s2+s3
       
        $('#adddetail').append(str)
      }
    }
  })
}

function terminateround(id)
{
  var confrm = confirm("Are You sure ? ");
  if(confrm)
  {
    id_round = id
    var str = "#"+id_round+"row";
    $.ajax({
    type:'POST',
    data:{'roundid':id_round},
    success:function(para)
    {
      $(str).remove();
    }
  })
}

}
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
