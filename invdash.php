<?php 
if(isset($_COOKIE['sid']))
{
  include 'api/db.php';
  
  $cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
  
  if($cursor)
  {
    $cursor = $db->users->findOne(array("uid" => $cursor['uid']));
    $designation = $cursor['dsg'];
    if($designation == 'inv')
    {
    
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Interviewer</title>

        <link rel="stylesheet" type="text/css" media="screen" href="public/css/materialize.css">
        <link rel="stylesheet" type="text/css" media="screen" href="public/css/materialize.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

        <!-- for sidenav -->
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" type="text/css" media="screen" href="public/css/common.css">


        <script src="public/jquery-3.2.1.min.js"></script>

        <script src="public/js/materialize.js"></script>
        <script src="public/js/materialize.min.js"></script>
        <link rel="stylesheet" type="text/css" href="public/css/common.css">

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
}

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
  font-size:25px;
  color:lightskyblue;
  margin-left:33% !important;
  margin-top:18% !important; 
}
#accept {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  width: 100%;
  background: rgba(0,0,0,0.95)  url(loader2.gif)  no-repeat center center !important;
  z-index: 10000;
}
#accept > #txt{
  font-size:20px;
  color:lightskyblue;
  margin-left:33% !important;
  margin-top:18% !important; 
}
</style>

    <body>

        <!-- modal1 starts here -->
        <div id="modal1" class="modal">
        <div class="modal-content">
            <center><i class="material-icons large " style="color: #ff5252;">error_outline</i></center>
            <br>
            
            <center><h2>Are You Sure ?</h2></center>
            <center>
            <div class="row">
                <div class="input-field col s12 m6 offset-m3">
                <input id="reject_reason" type="text" >
                <label for="reject_reason">Specify Reason</label>
                </div>
            </div>
            </center>
            <center><p style="color:red" id="reason_line">Please specify reason.</p></center>
            <div id="appending_id"></div>

            
        </div>
        <div class="modal-footer">
            <center>
            <a onclick="rejectInterview(true)"  class="waves-effect green btn" id="confirm_id">Confirm<i class="material-icons left" >check_box</i></a>
            <a onclick="rejectInterview(false)" class="modal-close waves-effect red btn">Cancel<i class="material-icons left">highlight_off</i></a>
            </center>
        </div>
        </div>
        <!-- modal1 ends here -->

        <!-- modal2 starts here -->
        <div id="modal2" class="modal">
        <div class="modal-content">
            <center><i class="material-icons large " style="color: #ff5252;">error_outline</i></center>
            <br>
            
            <center><h2>Are You Sure ?</h2></center>
            
            
        </div>
        <div class="modal-footer">
            <center>
            <a onclick="submit_interview(true)" class="modal-close waves-effect green btn" >Confirm<i class="material-icons left" >check_box</i></a>
            <a onclick="submit_interview(false)" class="modal-close waves-effect red btn">Cancel<i class="material-icons left">highlight_off</i></a>
            </center>
        </div>
        </div>
        <!-- modal2 Ends here -->

        <!-- modal3 starts here -->
        <div id="modal3" class="modal">
        <div class="modal-content">
            <center><i class="material-icons large " style="color: #ff5252;">error_outline</i></center>
            <br>
            
            <center><h2>Are You Sure ?</h2></center>
            <center><p>You Will Be Redirected To Evaluation Sheet of This Candidate</p></center>
            <div id="appending_id2"></div>
            
            
        </div>
        <div class="modal-footer">
            <center>
            <a onclick="evaluateMail(true)" class="modal-close waves-effect green btn" >Confirm<i class="material-icons left" >check_box</i></a>
            <a onclick="evaluateMail(false)" class="modal-close waves-effect red btn">Cancel<i class="material-icons left">highlight_off</i></a>
            </center>
        </div>
        </div>
        <!-- modal3 ends here -->

        <!-- modal4 starts here -->
        <div id="modal4" class="modal">
        <div class="modal-content">
            <center><i class="material-icons large " style="color: #ff5252;">error_outline</i></center>
            <br>
            
            <center><h2>Are You Sure ?</h2></center>
            <div id="appending_id3"></div>
            
            
        </div>
        <div class="modal-footer">
            <center>
            <a onclick="acceptintr(true)" class="modal-close waves-effect green btn" >Confirm<i class="material-icons left" >check_box</i></a>
            <a onclick="acceptintr(false)" class="modal-close waves-effect red btn">Cancel<i class="material-icons left">highlight_off</i></a>
            </center>
        </div>
        </div>
        <!-- modal4 ends here -->

        <!-- modal5 starts here -->
        <div id="modal5" class="modal">
        <div class="modal-content">
            <center><i class="material-icons large " style="color: #ff5252;">error_outline</i></center>
            <br>
            
            <center><h2>Are You Sure ?</h2></center>
            <div id="appending_id4"></div>
            
            
        </div>
        <div class="modal-footer">
            <center>
            <a onclick="onholdMail(true)" class="modal-close waves-effect green btn" >Confirm<i class="material-icons left" >check_box</i></a>
            <a onclick="onholdMail(false)" class="modal-close waves-effect red btn">Cancel<i class="material-icons left">highlight_off</i></a>
            </center>
        </div>
        </div>
        <!-- modal5 ends here -->

 <div id="sidenn" class="w3-sidebar blue w3-bar-block sidemenu" style="z-index: 1000">

  <h3 class="w3-bar-item white"> <center><a href="/hrms/">Home</a>
  <i id="remin" class="material-icons" style="float: right;cursor: pointer;">close</i></center>   
  </a></h3> <br><br>

  <a href="/hrms/invhistory.php" class="w3-bar-item w3-button">See History  </a> <br>  
  <a href="/hrms/rejecedinvhistory.php" class="w3-bar-item w3-button">Rejected Interviews</a> <br>
  <a href="#" id="logoutuser" class="w3-bar-item w3-button">Logout</a> <br>

</div>

<div id="remin">
<nav> 
    <div class="nav-wrapper blue darken-1">
      <a href="#!" class="brand-logo left" style="margin-left: 2%;"><i id="showsidenbutton" class="material-icons">menu</i>
    </a>
    <a href="/hrms/" class="brand-logo center">thyssenkrupp</a>
    </div>
</nav>
<br><br>
<!-- nav and side menu ended -->
  
  <br>
  

    <br>

    <div class="row">
        <div class="col s12 m12">
            <div class="white-text">
                <div class="card-content blue-text" id="wait">
                    <span class="card-title">TO DO LIST</span>
                    <table class="striped">
                        <thead>
                            <tr>
                                <th>INTERVIEWS</th>
                                <th>DATE</th>
                                <th>TIME</th>
                                <th>SEE MEMBERS</th>
                                <th>ACTION</th>
                                <th>ACCEPT</th>
                                <th>REJECT</th>
                            </tr>
                        </thead>
                        <!-- TO DO LIST  -->
                        <tbody id="todolistbody">
                            
                        </tbody>
                        <!-- End of TO DO LIST -->
                    </table>
                </div>
            </div>
        </div>
    </div>


        
    <div class="row" id="emailrow">
        <div class="col s12 m12">
            <div class="card white-text">
                <div class="card-content blue-text">
                    <span class="card-title">Candidates Mail</span>
                    <table class="striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Evaluate</th>
                                <th>Absent</th>
                                
                            </tr>
                        </thead>
                        <!-- Email Body  -->
                        <tbody id="emailbody">

                        </tbody>
                        <!-- End of Email Body -->
                    </table>
                    <center>
                    <br><br>
                    <b style="color:green;">If No Candidates Found, You Can Click Below Button</b><br><br>
                    <button class="btn waves-effect blue darken-1" id="submitinterview" onclick='$("#modal2").modal("open")'>Complete Interview</button>
                    
                    
                    </center>
                </div>
            </div>
        </div>
    </div>




    <div class="row" id="emailrow10">
        <div class="col s12 m12">
            <div class="card white-text">
                <div class="card-content blue-text">
                    <span class="card-title">Candidates Mail</span>
                    <table class="striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Date</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <!-- Email Body  -->
                        <tbody id="emailbody10">


                        </tbody>
                        <!-- End of Email Body -->
                    </table>
                    <div id="cnfrmMod">
                        After you finish modification so we can send your request to HR.
                    </div>
                   
                   
                </div>
            </div>
        </div>
    </div>

    <div id="loader">
        <div id="txt">
          <b>Please wait while we send your request to HR !!</b>
        </div>
    </div>
    <div id="accept">
        <div id="txt">
          <b>Registering your confirmation.Please wait!!</b>
        </div>
    </div>
    <div id="status"style="background-color:green;border-radius:10px;font-size:25px;width:40%;margin-left:32%;">
        <center>    
            Please wait till HR confirms this acceptance...
        </center>    
    </div>

    























    <!-- Script Starts Here -->
    <script src="public/js/common.js"></script>

    <script>
    var id13digit;
    var rjctid;

    // function for opening dialouge box1
    function openmodal(cid)
    {
        $("#appending_id").empty()
        $("#appending_id").append("<b id='bid' name='"+cid+"'></b>")
        $("#modal1").modal("open")
    }

    // function for opening dialouge box3
    function openmodal2(cid)
    {
        $("#appending_id2").empty()
        $("#appending_id2").append("<b id='bid2' name='"+cid+"'></b>")
        $("#modal3").modal("open")
    }

    // function for opening dialouge box4
    function openmodal3(cid)
    {
        $("#appending_id3").empty()
        $("#appending_id3").append("<b id='bid3' name='"+cid+"'></b>")
        $("#modal4").modal("open")
    }

    // function for opening dialouge box5
    function openmodal4(cid)
    {
        $("#appending_id4").empty()
        $("#appending_id4").append("<b id='bid4' name='"+cid+"'></b>")
        $("#modal5").modal("open")
    }


    function rejectInterview(cnfrm)
    {
        
        if(cnfrm)
        {
            if($('#reject_reason').val()=="")
            {
                $('#reason_line').show()
            }
            else
            {
                $.ajax({
                    url:"http://localhost/hrms/api/updateinterviewstatus.php",
                    type:'POST',
                    data:{
                        "id":$('#bid').attr('name'),
                        "reason":$('#reject_reason').val(),
                    },
                    success:function(){
                        var x = $('#bid').attr('name')
                        var p = "#"+x;
                        $(p).remove();
                        location.reload(true)
                    }
                })
            }

        }

    }
    function timeout()
    {
        
    }
  
    function acceptintr(cnfrm)
    {
        var x = $('#bid3').attr('name')
        var acbtnid="#"+x;
        x1 = x.slice(3);
        // alert(x1)
        
        var rjbtnid="#"+x+'1';
        // alert(rjbtnid)
        
        if(cnfrm)
        {
            $("#accept").show()
            $(acbtnid).attr('disabled','disabled')
            $(rjbtnid).attr('disabled','disabled')     
            $.ajax({
                url:"http://localhost/hrms/api/accepted.php",
                type:"POST",
                data:{
                    "prf13":x1
                },
                success:function(para)
                {
                    if(para == "success")
                    {
                        setTimeout(() => { $("#accept").hide()}, 2000);
                        $("#status").fadeIn(500)
                        console.log(para)
                        window.setTimeout(function(){location.reload()},2000)  
                    }
                    else if(para == "fail")
                    {
                        $("#accept").hide()
                        alert("Transaction Failed \n Click Accept Button Again")
                    }
                    else if(para == "noaccess")
                    {
                        $("#accept").hide()
                        alert("Please Send POST Data")
                    }
                    else
                    {
                        $("#accept").hide()
                        alert("something went wrong")
                    }
                }
        })
        }
        
    }

    
//Sarang - 16/03/2020
function modifyMail(id,name)
{
    console.log("id=",id)
    console.log("name=",name)
   
    console.log("Data  : "+id );
    id_ = id;
    id=id.split("*");
    console.log("Name  : "+name );
    date = '#check'+name+"date2";
    name = '#'+name+'tp';
    console.log("Date id - ",date)
    updatedTime = $(name).val()
    updatedDate = $(date).val()
    console.log("Updated Date - ",$(date).val())
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
        url:"http://localhost/hrms/api/invmodifytime.php",
        type:"POST",
        data:{
            "index":id[0],
            "date":id[1],
            'time':id[2],
            "digit13":id[3],
            "updatedTime":updatedTime,
            "updatedDate":updatedDate
        },
        success:function(para)
        {
            if(para=="modify")
            {
                alert("Modification Done");
            }
            console.log("This is my data:  "  +para)
        }

       })
    }
    console.log("This is : ")
    console.log("Split data : "+id[0]+" & "+id[1]+"&"+id[2])

    
}





//global variable for counting number of records

var totalButtons = 0;

//Changed by Sarang - 15/03/2020
function displayreadonlymail(id)
{
    id = id.split("*");
    console.log("This is : "+id[0])
    $("#cnfrmMod").empty()
    $.ajax({
                url:"http://localhost/hrms/api/showmembersfirst.php",
                type:"POST",
                data:{
                    "id": id[0] 
                },
                success:function(para)
                {
                    console.log("This is my - "+para)
                    para=JSON.parse(para);
                    
                    // $(y).css("background","red")    
                    // $("#emailrow").fadeOut(600)
                    $("#emailrow10").show(600)
                    $("#emailbody10").text("")
                    // Dummy Data
                    //para = ['Tanny@gmail.com',"rb@gmail.com","ad@gmail.com"]
                    totalButtons = para.length;
                    
                    for(let i =0 ;i< para.length;i++)
                    {
                        console.log("Loop"+id[0])
                        //along with modify button
                        var txt1 = '<tr id="'+para[i]+'"><td><a href="http://localhost/hrms/applicationblank_readonly.php?aid='+para[i][1]+'"  target="_blank" ><p >'+para[i][0]+'</p></a></td>'
                        var txt2 = '<td><p >'+para[i][1]+'</p></td><td><input id="check'+i+'date2" value="'+para[i][2]+'" class="datepicker" ></td>'
                        var txt3 = '<td><input type="text" style="width:50%;" id="'+i+'tp" value="'+para[i][3]+'" class="timepicker"></td>'
                        var txt4 = '<td><button  class="btn waves-effect green"  id="'+i+'*'+para[i][2]+'*'+para[i][3]+'*'+id[0]+'" name="'+i+'" onclick="modifyMail(this.id,this.name)">Modify Time<i class="material-icons right">send</i></button></td></tr>'
                        // var txt1 = '<tr id="'+para[i]+'"><td><a href="http://localhost/hrms/applicationblank_readonly.php?aid='+para[i][1]+'"  target="_blank" ><p >'+para[i][0]+'</p></a></td><td><p >'+para[i][1]+'</p></td><td><p>'+para[i][2]+'</p></td></tr>'                   
                        txt = txt1+txt2+txt3+txt4;
                        $("#emailbody10").append(txt)
                        $('.timepicker').timepicker();
                        $('.datepicker').datepicker();
                    }

                    var modifyAllButton = '<button  class="btn waves-effect green" id="'+id[0]+'" onclick="confirmmodifyAllMails(this.id)">Confirm Modification<i class="material-icons right">send</i></button></td></tr>'
                    $("#cnfrmMod").append(modifyAllButton)
                    }   
              
            
            })
}


// function for modifying all mails time and date

function confirmmodifyAllMails(id)
{
    $('#modifyAll').prop('disabled',true)
    console.log("Number of buttons : ",id)
    $("#loader").show()
    $.ajax({
        url:"http://localhost/hrms/api/invrequest.php",
        type:"POST",
        data:{
            "digit13":id
        },
        success:function(para)
        {
           
            if(para=="success")
            {
                $("#loader").hide()
                alert("Request Sent")
                window.setTimeout(function(){location.reload()},1000)

            }
            else
            {
                $("#loader").hide()
                alert("Request Sending Failed")
            }
            console.log("This is my data:  "  +para)
        }

       })
    // for(let i=0;i<totalButtons;i++)
    // {
    //     $("button[name='"+i+"']").click();
    // }

    // after all buttons are clicked
    // $('#modifyAll').prop('disabled',false)
    
}

function submit_interview(cnfrm){
        console.log("Status - "+cnfrm)
        if(cnfrm)
        {
            $.ajax({
                url:"http://localhost/hrms/api/endinterview.php",
                type:"POST",
                data:{
                    "id": id13digit 
                },
                success:function(para)
                {
                    console.log(para)
                    var y = "#"+id13digit
                    $(y).attr('disabled','disabled')
                    $(y).text('evaluated')
                    
                    $(y).css("background","red")    
                    $("#emailrow").fadeOut(600)
                    window.setTimeout(function(){location.reload()},1000)
                }   
              
            
            })
            
        }
    }



// function for modifying all ends


    $(document).ready(function(){
        $("#status").hide()
        $("#loader").hide()
        $("#accept").hide()
        $('.modal').modal();
        $('#reason_line').hide()
         window.mail = "<?php echo $cursor["mail"]; ?>"
         $('.timepicker').timepicker();
       // mail = JSON.stringify(mail)
       $("#emailrow10").hide()
       
    window.focus(function(){
        location. reload(true);
    })

    //submitting complete interview
    

        
    

    $("#emailrow").hide()
    console.log(window.mail)
    // Ajax Call For Tking data of to do list
    // alert(window.mail)

    $.ajax({
        url:"http://localhost/hrms/api/interviewertodo.php",
        type:"POST",
        data:{
            "mail": window.mail 
        },
        
        success:function(para)
        {   
            para = JSON.parse(para)
            //para = [['PRF1-INSTANCE1-ROUND1','some date','some time'],['PRF2-INSTANCE2-ROUND2','some date','some time']]
            var temparr=[]; 
            
            for(let i = 0 ;i<para.length;i++)
            {
                for(let j=0;j<4;j++)
                {
                    temparr[j] = para[i][j];
                }
                console.log("Status - ",temparr[3])
                
                var status = temparr[3]=="yes" ||temparr[3]=="pending"?"disabled":" ";
                var txt1 = '<tr><td><b>'+temparr[0]+'</b></td>'
                var txt2 = '<td>'+temparr[1]+'</td><td>'+temparr[2]+'</td>' 
                var txt6 = '<td><button class="btn waves-effect green"  id="'+temparr[0]+'*2" onclick="displayreadonlymail(this.id)">See Members<i class="material-icons right">send</i>'                       
                var txt5 = '<td><button class="btn waves-effect green"  id="act'+temparr[0]+'" onclick="openmodal3(this.id)" '+status+'>Accept<i class="material-icons right">send</i></button></td>' 
                var txt4 = '<td><button class="btn waves-effect red"  id="act'+temparr[0]+'1" '+status+' onclick="openmodal(this.id)">Reject<i class="material-icons right">send</i></button></td>' 
               
               

                
                // const time = new Intl.DateTimeFormat('en-US', options).format(tempdate)
                // console.log(time)


                // console.log("Existing : ",mydate);
                // console.log("curr : ",currdate);

                // console.log("Existing : ",temparr[2]);
                // console.log("curr : ",time);
                // // alert(temparr)
                // //CONCAT CURRENT TIME 
                // tempampcursplit=time.split(" ");
                // tempcurtimesplit=tempampcursplit[0].split(":")
                // hours=parseInt(tempcurtimesplit[0]);
                // tempcurintertime="" + hours+tempcurtimesplit[1];
                // // alert("Hud "+tempcurintertime)

                // // CALCULATED current time 
                // curintertime=parseInt(tempcurintertime);

                // //logic comparing
                // tempampmsplit=temparr[2].split(" ");
                // if(tempampmsplit[1]=="PM")
                // {
                    
                //     temptimesplit=tempampmsplit[0].split(":")
                //     if(temptimesplit[0]=="12")
                //     {
                //         hours=parseInt(temptimesplit[0]);
                //     }
                //     else
                //     {
                //         hours=parseInt(temptimesplit[0])+12;
                //     }
                   
                //     tempintertime="" + hours+temptimesplit[1];
                //     intertime=parseInt(tempintertime);
                //     // alert("Hud PM "+tempintertime)
                // }
                // else if(tempampmsplit[1]=="AM")
                // {
                //     temptimesplit=tempampmsplit[0].split(":")
                //     hours=parseInt(temptimesplit[0]);
                //     tempintertime="" + hours+temptimesplit[1];
                //     // alert("Hud am "+tempintertime)
                //     intertime=parseInt(tempintertime);
                // }
                // console.log("Curr date - ",currdate)
                // console.log("Exisitng date - ",mydate)
                // console.log("entered2");
                // console.log("Existing : ",intertime);
                // console.log("curr : ",curintertime);
                // console.log("Existing date : ",mydate);
                // console.log("curr date : ",currdate);
                    //comparing time 
                    if(temparr[3]=="yes")
                    {
                        $("#status").hide()
                      
                            var txt3 = '<td><button class="btn waves-effect green"  id="'+temparr[0]+'" onclick="displayMail(this.id)">Conduct Interview<i class="material-icons right">send</i>'                       
                            console.log("valid");
                      
                    }
                    else if(temparr[3]=="pending")
                    {
                            var txt3 = '<td><button disabled class="btn waves-effect green"  id="'+temparr[0]+'" onclick="displayMail(this.id)">Conduct Interview<i class="material-icons right">send</i>'                       
                            console.log("valid");
                    }
                    else if(temparr[3]=="no")
                    {
                        var txt3 = '<td><button disabled class="btn waves-effect green"  id="'+temparr[0]+'" onclick="displayMail(this.id)">Start<i class="material-icons right">send</i>'                       

                    }
                    
                    
                  
                
                var str = txt1+txt2+txt6+txt3+txt5+txt4;
                $("#todolistbody").append(str)             
            }            
        }    

    })
    // end of page loading ajax call



    });


    //ajax call for displaying email id's
    function displayMail(x)
    {
        id13digit = x;
        window.digit13=id13digit
       console.log(id13digit)

       var currdate = new Date(new Date().getFullYear(),new Date().getMonth() , new Date().getDate())
       currdate.setHours(0,0,0,0)
                // var mydate=new Date(temparr[1])
                const tempdate = new Date()
                const options = {
                hour: 'numeric',
                minute: 'numeric',
                hour12: false
                };

                const currtime = new Intl.DateTimeFormat('en-US', options).format(tempdate)
                console.log("Curr Date is - ",currtime)
       
        console.log("Curr Date - ",currdate.getTime())
        $.ajax({
            url:"http://localhost/hrms/api/evaluationsetup.php",
            type:"POST",
            data:{
                "id":x,
                "mail": window.mail 
            },
    
            success:function(para)
            {   
                console.log(para)
                para = JSON.parse(para)
                var splittime = currtime.split(":")
                var finaltime = splittime[0]+splittime[1]
                console.log("My time is - "+finaltime)


                $("#emailrow").show(600)
                $("#emailbody").text("")
                // Dummy Data
                //para = ['Tanny@gmail.com',"rb@gmail.com","ad@gmail.com"]
                
                for(let i =0 ;i< para.length;i++)
                {
                    setDate = new Date(para[i][2])
                    // setDate = new Date("May 25, 2020")
                    // const time = new Intl.DateTimeFormat('en-US', options).format(setDate)
                    console.log("Set Time - "+para[i][3])
                    var time = para[i][3]
                    time = time.split(" ")
                    if(time[1] == "PM")
                    {
                        time = time[0].split(":")
                        hrs = Number(time[0])+12
                        time= String(hrs)+time[1]
                        console.log(time)
                    }
                    else
                    {
                        time = time[0].split(":")
                        time= time[0]+time[1]
                        console.log(time)
                    }
                    console.log("Final current time - "+finaltime)
                    console.log("Final db time - "+time)
                    setDate.setHours(0,0,0,0)
                    console.log(setDate)
                    // var status = para[i][2]=="yes"?"disabled":" ";
                    var txt1 = '<tr id="'+para[i][1]+'"><td ><a href="http://localhost/hrms/applicationblank_readonly.php?aid='+para[i][1]+'"  target="_blank" ><p >'+para[i][0]+'</p></a></td>'
                    var txt2 = '<td ><p >'+para[i][1]+'</p></td>'
                    var txt3 = '<td ><input disabled id="check'+i+'date2" value="'+para[i][2]+'" class="datepicker" ></td>'
                    var txt4 = '<td ><input disabled type="text"  id="'+i+'tp" value="'+para[i][3]+'" class="timepicker"></td>'
                    if(setDate >currdate)
                    {
                        var txt5 = '<td><button disabled class="btn waves-effect green"  id="'+para[i][1]+'" onclick="openmodal2(this.id)">Evaluate<i class="material-icons right">send</i></button></td>'                       
                        var txt6 = '<td><button disabled class="btn waves-effect red"  id="'+para[i][1]+'" onclick="openmodal4(this.id)">Absent<i class="material-icons right">send</i></button></td></tr>' 
                    }
                    else
                    {
                        if(time <= finaltime)
                        {
                            // alert("Set time is lesser than current")
                            var txt5 = '<td><button  class="btn waves-effect green"  id="'+para[i][1]+'" onclick="openmodal2(this.id)">Evaluate<i class="material-icons right">send</i></button></td>'                       
                            var txt6 = '<td><button  class="btn waves-effect red"  id="'+para[i][1]+'" onclick="openmodal4(this.id)">Absent<i class="material-icons right">send</i></button></td></tr>' 

                        }
                        else
                        {
                            // alert("Set time is greater than current")
                            var txt5 = '<td><button disabled  class="btn waves-effect green"  id="'+para[i][1]+'" onclick="openmodal2(this.id)">Evaluate<i class="material-icons right">send</i></button></td>'                       
                            var txt6 = '<td><button disabled  class="btn waves-effect red"  id="'+para[i][1]+'" onclick="openmodal4(this.id)">Absent<i class="material-icons right">send</i></button></td></tr>' 

                        }
                    }
                  
                    var str = txt1+txt2+txt3+txt4+txt5+txt6;
                    $('.timepicker').timepicker();
                    $('.datepicker').datepicker();
                    $("#emailbody").append(str)

                    
                }
            }
        })
    }

    // function for jumping to evaluation form
    function evaluateMail(p)
    {   
        if(p)
        {
        localStorage.setItem('currentemail',$('#bid2').attr('name'))
        localStorage.setItem('id',window.digit13)
        $(document.getElementById($('#bid2').attr('name'))).remove()
        window.open("http://localhost/hrms/evaluation.php", '_blank');
        }
    }

    function onholdMail(p)
    {   
        
        var x = $('#bid4').attr('name')
    
        if(p)
        {
        localStorage.setItem('currentemail',x)
        localStorage.setItem('id',window.digit13)
        // $(document.getElementById(x)).remove()
        // window.open("http://localhost/hrms/evaluation.php", '_blank');
        
        $.ajax({
            url:"http://localhost/hrms/api/putonhold.php",
            type:"POST",
            data:{
                "id":window.digit13,
                "mail": x 
             },
    
            success:function(para)
            {   
                // para = JSON.parse(para)
                 console.log(para)
                // console.log(para)
                if(para=="success")
                {
                    $(document.getElementById(x)).remove()
                    // alert("Success")
                }
                else
                {
                    alert("Fail")
                }
              
            }
        })
    }
}

    </script>

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
    
        </script>
    <!-- Script Ends -->
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
