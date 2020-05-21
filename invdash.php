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
        <a href="http://localhost/hrms/invhistory.php">
        <button class="btn waves-effect blue darken-1" type="submit" name="action" style="float:left;margin-top: 18px;margin-right: 18px ">SEE HISTORY</button>
        </a>
            <a href="#!" class="brand-logo center">thyssenkrupp</a>
      
            <div id="logoutuser" class="row">
    <button class="btn waves-effect blue darken-1" type="submit" name="action" style="float:right;margin-top: 18px;margin-right: 18px ">LOGOUT</button>
        </div>
    </nav>
  </div>
   
  <br>
    <center>
<button class="button">You Are Logged In As Interviewer Of <?php echo $cursor['rg']; ?> Region and <?php echo $cursor['dept']; ?> Department</button>
</center>

    <br>


    <div class="row">
        <div class="col s12 m12">
            <div class="card white-text">
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
                                <th>Evaluate</th>
                                
                            </tr>
                        </thead>
                        <!-- Email Body  -->
                        <tbody id="emailbody">

                        </tbody>
                        <!-- End of Email Body -->
                    </table>
                    <center>
                    <button class="btn waves-effect blue darken-1" id="submitinterview">Complete Interview</button>
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
                                <th>Time</th>
                            </tr>
                        </thead>
                        <!-- Email Body  -->
                        <tbody id="emailbody10">


                        </tbody>
                        <!-- End of Email Body -->
                    </table>
                   
                </div>
            </div>
        </div>
    </div>


























    <!-- Script Starts Here -->
    <script>
    var id13digit;
    var rjctid;
    function rejectInterview(x)
    {
    //    alert(x)
        var cnfrm = confirm("Are You Sure ?")
        if(cnfrm)
        {
            var reason = prompt("Specify Reason For Rejecting : ");
            // alert(x)
            $.ajax({
                url:"http://localhost/hrms/api/updateinterviewstatus.php",
                type:'POST',
                data:{
                    "id":x ,
                    "reason":reason,
                },
                success:function(para){
                    alert(para)
                    var p = "#"+x;
                    $(p).remove();
                    location.reload(true)
                }
            })
        }

    }
    function acceptintr(x)
    {
        var acbtnid="#"+x;
        x1 = x.slice(3);
        // alert(x1)
        
        var rjbtnid="#"+x+'1';
        // alert(rjbtnid)
        
        var cnfrm=confirm("Are Your Sure ?");
        if(cnfrm)
        {
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
                    console.log(para)
                window.setTimeout(function(){location.reload()},10)
                    
                }
        })
        }
        
    }

    
//Sarang - 16/03/2020
function modifyMail(id,name)
{
    // console.log("Data  : "+id );
    id=id.split("*");
    console.log("Name  : "+name );
    name = '#'+name+'tp';
    updatedTime = $(name).val()
    console.log('This is time : ',$(name).val())
    // console.log("This is : ")
    // console.log("Split data : "+id[0]+" & "+id[1]+"&"+id[2])

    $.ajax({
        url:"http://localhost/hrms/api/invmodifytime.php",
        type:"POST",
        data:{
            "index":id[0],
            "time":id[1],
            "digit13":id[2],
            "updatedTime":updatedTime
        },
        success:function(para)
        {
            console.log("This is my data:  "  +para)
        }

    })
}







//Changed by Sarang - 15/03/2020
function displayreadonlymail(id)
{
    id = id.split("*");
    console.log("This is : "+id[0])
    $.ajax({
                url:"http://localhost/hrms/api/showmembersfirst.php",
                type:"POST",
                data:{
                    "id": id[0] 
                },
                success:function(para)
                {
                    console.log("This is my - "+id[0])
                     para=JSON.parse(para);
                    
                    // $(y).css("background","red")    
                    // $("#emailrow").fadeOut(600)
                    $("#emailrow10").show(600)
                    $("#emailbody10").text("")
                    // Dummy Data
                    //para = ['Tanny@gmail.com',"rb@gmail.com","ad@gmail.com"]
                    
                    for(let i =0 ;i< para.length;i++)
                    {
                        console.log("Loop"+id[0])
                        //along with modify button
                        var txt1 = '<tr id="'+para[i]+'"><td><a href="http://localhost/hrms/applicationblank_readonly.php?aid='+para[i][1]+'"  target="_blank" ><p >'+para[i][0]+'</p></a></td><td><p >'+para[i][1]+'</p></td><td><input type="text" style="width:50%;" id="'+i+'tp" value="'+para[i][2]+'" class="timepicker"></td><td><button class="btn waves-effect green"  id="'+i+'*'+para[i][2]+'*'+id[0]+'" name="'+i+'" onclick="modifyMail(this.id,this.name)">Modify Time<i class="material-icons right">send</i></button></td></tr>'
                        // var txt1 = '<tr id="'+para[i]+'"><td><a href="http://localhost/hrms/applicationblank_readonly.php?aid='+para[i][1]+'"  target="_blank" ><p >'+para[i][0]+'</p></a></td><td><p >'+para[i][1]+'</p></td><td><p>'+para[i][2]+'</p></td></tr>'                   
                        $("#emailbody10").append(txt1)
                        $('.timepicker').timepicker();
                    }
                    }   
              
            
            })
}


    $(document).ready(function(){
         window.mail = "<?php echo $cursor["mail"]; ?>"
         $('.timepicker').timepicker();
       // mail = JSON.stringify(mail)
       $("#emailrow10").hide()
    window.focus(function(){
        location. reload(true);
    })

    //submitting complete interview
    
    $("#submitinterview").click(function(){
        var cnfrm = confirm("Are You Sure ?")
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
        
    })

    $("#emailrow").hide()
    console.log(window.mail)
    // Ajax Call For Tking data of to do list
    // alert(window.mail)

    $.ajax({
        url:"http://localhost/hrms/api/interviewertodo.php",
        type:"GET",
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
                var status = temparr[3]=="yes"?"disabled":" ";
                var txt1 = '<tr><td><label class="waves-effect blue darken-1 btn">'+temparr[0]+'</label></td>'
                var txt2 = '<td>'+temparr[1]+'</td><td>'+temparr[2]+'</td>' 
                var txt6 = '<td><button class="btn waves-effect green"  id="'+temparr[0]+'*2" onclick="displayreadonlymail(this.id)">See Members<i class="material-icons right">send</i>'                       
                var txt5 = '<td><button class="btn waves-effect green"  id="act'+temparr[0]+'" onclick="acceptintr(this.id)" '+status+'>Accept<i class="material-icons right">send</i></button></td>' 
                var txt4 = '<td><button class="btn waves-effect red"  id="act'+temparr[0]+'1" '+status+' onclick="rejectInterview(this.id)">Reject<i class="material-icons right">send</i></button></td>' 
               
                var currdate = new Date()
                var mydate=new Date(temparr[1])
                const tempdate = new Date()
                const options = {
                hour: 'numeric',
                minute: 'numeric',
                hour12: false
                };

                
                const time = new Intl.DateTimeFormat('en-US', options).format(tempdate)
                console.log(time)


                console.log("Existing : ",mydate);
                console.log("curr : ",currdate);

                console.log("Existing : ",temparr[2]);
                console.log("curr : ",time);
                // alert(temparr)
                //CONCAT CURRENT TIME 
                tempampcursplit=time.split(" ");
                tempcurtimesplit=tempampcursplit[0].split(":")
                hours=parseInt(tempcurtimesplit[0]);
                tempcurintertime="" + hours+tempcurtimesplit[1];
                // alert("Hud "+tempcurintertime)

                // CALCULATED current time 
                curintertime=parseInt(tempcurintertime);

                //logic comparing
                tempampmsplit=temparr[2].split(" ");
                if(tempampmsplit[1]=="PM")
                {
                    
                    temptimesplit=tempampmsplit[0].split(":")
                    if(temptimesplit[0]=="12")
                    {
                        hours=parseInt(temptimesplit[0]);
                    }
                    else
                    {
                        hours=parseInt(temptimesplit[0])+12;
                    }
                   
                    tempintertime="" + hours+temptimesplit[1];
                    intertime=parseInt(tempintertime);
                    // alert("Hud PM "+tempintertime)
                }
                else if(tempampmsplit[1]=="AM")
                {
                    temptimesplit=tempampmsplit[0].split(":")
                    hours=parseInt(temptimesplit[0]);
                    tempintertime="" + hours+temptimesplit[1];
                    // alert("Hud am "+tempintertime)
                    intertime=parseInt(tempintertime);
                }
                
                if(currdate < mydate)
                {
                    console.log("entered");
                    var txt3 = '<td><button disabled class="btn waves-effect green"  id="'+temparr[0]+'" onclick="displayMail(this.id)">Start<i class="material-icons right">send</i>'                       
                }
                else{
                    console.log("entered2");

                    console.log("Existing : ",intertime);
                    console.log("curr : ",curintertime);
                    //comparing time 
                    if(temparr[3]=="yes")
                    {
                        if(intertime <=curintertime)
                        {
                            var txt3 = '<td><button class="btn waves-effect green"  id="'+temparr[0]+'" onclick="displayMail(this.id)">Conduct Interview<i class="material-icons right">send</i>'                       
                            console.log("valid");
                        }
                        else
                        {
                            var txt3 = '<td><button disabled class="btn waves-effect green"  id="'+temparr[0]+'" onclick="displayMail(this.id)">Start<i class="material-icons right">send</i>'                       
                            console.log("invalid");
                        }
                    }
                    else if(temparr[3]=="no")
                    {
                        var txt3 = '<td><button disabled class="btn waves-effect green"  id="'+temparr[0]+'" onclick="displayMail(this.id)">Start<i class="material-icons right">send</i>'                       

                    }
                    
                    
                  
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
                


                $("#emailrow").show(600)
                $("#emailbody").text("")
                // Dummy Data
                //para = ['Tanny@gmail.com',"rb@gmail.com","ad@gmail.com"]
                
                for(let i =0 ;i< para.length;i++)
                {
                    
                    var txt1 = '<tr id="'+para[i][1]+'"><td><a href="http://localhost/hrms/applicationblank_readonly.php?aid='+para[i][1]+'"  target="_blank" ><p >'+para[i][0]+'</p></a></td><td><p >'+para[i][1]+'</p></td>'
                    var txt2 = '<td><button class="btn waves-effect green"  id="'+para[i][1]+'" onclick="evaluateMail(this.id)">Evaluate<i class="material-icons right">send</i></button></td>'                       
                    var txt3 = '<td><button class="btn waves-effect red"  id="'+para[i][1]+'" onclick="onholdMail(this.id)">Absent<i class="material-icons right">send</i></button></td></tr>' 
                    var str = txt1+txt2+txt3;
                    $("#emailbody").append(str)
                    
                }
            }
        })
    }

    // function for jumping to evaluation form
    function evaluateMail(x)
    {   
        var p = confirm("are you sure?")
    
        
        
        if(p)
        {
        localStorage.setItem('currentemail',x)
        localStorage.setItem('id',window.digit13)
        $(document.getElementById(x)).remove()
        window.open("http://localhost/hrms/evaluation.php", '_blank');
        }
    }
    function onholdMail(x)
    {   
        
        var p = confirm("are you sure?")
    
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
                    alert("Success")
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
