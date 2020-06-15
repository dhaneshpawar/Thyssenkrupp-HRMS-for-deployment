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
                    <button class="btn waves-effect blue darken-1" id="submitinterview" onclick='$("#modal2").modal("open")'>Submit</button>
                    </center>
                </div>
            </div>
        </div>
    </div>



    <!-- Script Starts Here -->
    <script>

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
                    type:'GET',
                    data:{
                        "id":$('#bid').attr('name'),
                        "reason":$('#reject_reason').val(),
                    },
                    success:function(){
                        var x = $('#bid').attr('name')
                        var p = "#"+x;
                        $(p).remove();
                    }
                })
            }

        }

    }
    var id13digit;
    $(document).ready(function(){
        $('.modal').modal();
        $('#reason_line').hide()
        window.mail = "<?php echo $cursor["mail"]; ?>"
       // mail = JSON.stringify(mail)
   
    window.focus(function(){
        location. reload(true);
    })

    //submitting complete interview
    
    function submit_interview(cnfrm)
    {
        
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
                    alert(para)
                    var y = "#"+id13digit
                    $(y).attr('disabled','disabled')
                    $(y).text('evaluated')
                    
                    $(y).css("background","red")    
                }   
              
            
            })
            
        }
        
    }

    $("#emailrow").hide()
    alert(window.mail)
    // Ajax Call For Tking data of to do list
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
                for(let j=0;j<3;j++)
                {
                    temparr[j] = para[i][j];
                }

                var txt1 = '<tr id="'+temparr[0]+'"><td><label class="waves-effect blue darken-1 btn">'+temparr[0]+'</label></td>'
                var txt2 = '<td>'+temparr[1]+'</td><td>'+temparr[2]+'</td>' 
                var txt3 = '<td><button class="btn waves-effect green"  id="'+temparr[0]+'" onclick="displayMail(this.id)">Start<i class="material-icons right">send</i>'                       
                var txt4 = ' </button></td><td><td><button class="btn waves-effect red"  id="'+temparr[0]+'" onclick="openmodal(this.id)">Reject<i class="material-icons right">send</i></button></td></tr>' 
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
            url:"http://localhost/hrms/api/evaluationsetup.php",
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
                    var txt2 = '<td><button class="btn waves-effect green"  id="'+para[i]+'" onclick="openmodal2(this.id)">Evaluate<i class="material-icons right">send</i>'                       
                    var txt3 = ' </button></td></tr>' 
                    var str = txt1+txt2+txt3;
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