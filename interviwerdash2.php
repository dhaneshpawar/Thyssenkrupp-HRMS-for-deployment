<?php 
if(isset($_COOKIE['sid']))
{
  include 'api/db.php';
  
  $cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
  
  if($cursor)
  {
    $cursor = $db->users->findOne(array("uid" => $cursor['uid']));
    $designation = $cursor['dsg'];
    if($designation == 'interviewer')
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
    <body>

    <nav>
        <div class="nav-wrapper blue darken-1">
            <a href="#!" class="brand-logo center">thyssenkrupp</a>
        </div>
    </nav>
    <br><br>
    <div id="logoutuser" class="row">
    <button class="btn waves-effect blue darken-1" type="submit" name="action" style="float:right;margin-top: 18px;margin-right: 18px ">LOGOUT</button>
  </div>
   
    <div class="row">
        <div class="col s12 m12">
            <div class="card white-text">
                <div class="card-content blue-text">
                    <span class="card-title">TO DO LIST</span>
                    <table class="striped">
                        <thead>
                            <tr>
                                <th>INTERVIEWS</th>
                                <th>DATE</th>
                                <th>TIME</th>
                                <th>ACTION</th>
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
                    <button class="btn waves-effect blue darken-1" id="submitinterview">Submit</button>
                    </center>
                </div>
            </div>
        </div>
    </div>



    <!-- Script Starts Here -->
    <script>

    function rejectInterview(x)
    {
        var cnfrm = confirm("Are You Sure ?")
        if(cnfrm)
        {
            var reason = prompt("Specify Reason For Rejecting : ");
            alert(x)
            $.ajax({
                url:"http://localhost/thyssenkrup/api/updateinterviewstatus.php",
                type:'GET',
                data:{
                    "id":x ,
                    "reason":reason,
                },
                success:function(){
                    var p = "#"+x;
                    $(p).remove();
                }
            })
        }

    }
    var id13digit;
    $(document).ready(function(){
        $('.modal').modal();
        window.mail = "<?php echo $cursor["mail"]; ?>"
       // mail = JSON.stringify(mail)
   
    window.focus(function(){
        location. reload(true);
    })

    //submitting complete interview
    
    $("#submitinterview").click(function(){
        var cnfrm = confirm("Are You Sure ?")
        if(cnfrm)
        {
            $.ajax({
                url:"http://localhost/thyssenkrup/api/endinterview.php",
                type:"POST",
                data:{
                    "id": id13digit 
                },
                success:function(para)
                {
                    alert(para)
                    var y = "#"+id13digit
                    $(y).attr('disabled','disabled')
                    $(y).text('evaluated')
                    
                    $(y).css("background","red")    
                }   
              
            
            })
            
        }
        
    })

    $("#emailrow").hide()
    alert(window.mail)
    // Ajax Call For Tking data of to do list
    $.ajax({
        url:"http://localhost/thyssenkrup/api/interviewertodo.php",
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
                for(let j=0;j<3;j++)
                {
                    temparr[j] = para[i][j];
                }

                var txt1 = '<tr id="'+temparr[0]+'"><td><label class="waves-effect blue darken-1 btn">'+temparr[0]+'</label></td>'
                var txt2 = '<td>'+temparr[1]+'</td><td>'+temparr[2]+'</td>' 
                var txt3 = '<td><button class="btn waves-effect green"  id="'+temparr[0]+'" onclick="displayMail(this.id)">Start<i class="material-icons right">send</i>'                       
                var txt4 = ' </button></td><td><td><button class="btn waves-effect red"  id="'+temparr[0]+'" onclick="rejectInterview(this.id)">Reject<i class="material-icons right">send</i></button></td></tr>' 
                var str = txt1+txt2+txt3+txt4;
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
       // alert(id13digit)
        $.ajax({
            url:"http://localhost/thyssenkrup/api/evaluationsetup.php",
            type:"POST",
            data:{
                "id":x,
                "mail": window.mail 
    },
    
            success:function(para)
            {   
            
                //para = JSON.parse(para)
                console.log(para)
                para = JSON.parse(para)
                $("#emailrow").show(600)
                $("#emailbody").text("")
                // Dummy Data
                //para = ['Tanny@gmail.com',"rb@gmail.com","ad@gmail.com"]
                
                for(let i =0 ;i< para.length;i++)
                {
                    
                    var txt1 = '<tr id="'+para[i]+'"><td><p >'+para[i]+'</p></td>'
                    var txt2 = '<td><button class="btn waves-effect green"  id="'+para[i]+'" onclick="evaluateMail(this.id)">Evaluate<i class="material-icons right">send</i>'                       
                    var txt3 = ' </button></td></tr>' 
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
        window.open("http://localhost/thyssenkrup/evaluation.php", '_blank');
        }
    }

    </script>

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