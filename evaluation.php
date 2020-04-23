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
    <title>Evaluation Form</title>

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
<center>
 <p id="candidatename" style="color: green;font-size: 20px"></p>
</center>        
<div class="row">
    <div class="col s12 m6 offset-m3">
        <div class="card white-text">
            <div class="card-content blue-text">
                <br>
                <div class="row">
                    <div class="col m12 s12">
                        <b style="font-size: 19px">Functional/Technical Knowledge:</b>
                        <br><br>
                        <div class="row">
                            <label class="col">
                                <input class="with-gap" name="group1" type="radio" id="ke" value="Excellent" />
                                <span>Excellent</span>
                            </label>

                            <label class="col">
                                <input class="with-gap" name="group1" type="radio" id="kvg" value="Very Good"/>
                                <span>Very Good</span>
                            </label>

                            <label class="col">
                                <input value="Good" class="with-gap" name="group1" type="radio"  id="kg" value="Good" />
                                <span>Good</span>
                            </label>

                            <label class="col">
                                <input value="Satisfactory" class="with-gap" name="group1" type="radio" id="ks" />
                                <span>Satisfactory</span>
                            </label>

                            <label class="col">
                                <input value="Poor" class="with-gap" name="group1" type="radio" id="kp" />
                                <span>Poor</span>
                            </label>
                        </div>     
            
                    </div>
                </div>

                <div class="row">
                    <div class="col m12 s12">
                        <b style="font-size: 19px">Relevent Project/Functional Experience:</b>
                        <br><br>
                        <div class="row">
                            <label class="col">
                                <input value="Excellent" class="with-gap" name="group2" type="radio" id="ee" />
                                <span>Excellent</span>
                            </label>

                            <label class="col">
                                <input value="Very Good" class="with-gap" name="group2" type="radio"  id="evg"/>
                                <span>Very Good</span>
                            </label>

                            <label class="col">
                                <input value="Good" class="with-gap" name="group2" type="radio" id="eg" />
                                <span>Good</span>
                            </label>

                            <label class="col">
                                <input value="Satisfactory" class="with-gap" name="group2" type="radio"  id="es"/>
                                <span>Satisfactory</span>
                            </label>

                            <label class="col">
                                <input value="Poor" class="with-gap" name="group2" type="radio" id="ep" />
                                <span>Poor</span>
                            </label>
                        </div>     
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <input id="strength" type="text" class="validate">
                        <label for="strength">Major Strengths(Technical/Functional)</label>
                    </div>
                </div>

                
                <div class="row">
                    <div class="input-field col s12">
                        <input id="weakness" type="text" class="validate">
                        <label for="weakness">Major Weakness(Technical/Functional)</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <input id="special" type="text" class="validate">
                        <label for="special">Any Special Areas Probed</label>
                    </div>
                </div>

                <div class="row">
                    <div class="col m12 s12">
                        <b style="font-size: 19px">Result Of Interview:</b>
                        <br><br>
                        <div class="row">
                            <label class="col">
                                <input value="selected"class="with-gap" name="group3" type="radio" onclick="disp(this)" id="rs"/>
                                <span>Selected</span>
                            </label>

                            <label class="col">
                                <input value="onhold" class="with-gap" name="group3" type="radio" onclick="disp(this)" id="rh" />
                                <span>put-on-hold</span>
                            </label>

                            <label class="col">
                                <input value="rejected" class="with-gap" onclick="disp(this)" name="group3" type="radio" id="rr"/>
                                <span>Rejected</span>
                            </label>

                        </div> 
                            
                    </div>
                </div>

                <div class="row" id="ifonhold">
                    <b class="col">Reason For Put-on-hold :</b>
                    <div class="input-field col s12">
                        <input id="reasonhold" type="text" class="validate">
                        <label for="reasonhold">Specify Reason For Put-on-hold</label>
                    </div>
                </div>

                <div class="row" id="ifselected">
                    <b class="col">Please Fill Following Information :</b>
                    <div class="input-field col s12">
                        <input id="designation" type="text" class="validate">
                        <label for="designation">Designation for which candidate is found suitable</label>
                    </div>
                    
                    <div class="input-field col s12">
                        <input id="date" type="text" class="datepicker">
                        <label for="date">Date at which candidate has agreed to join</label>
                    </div>
                    
                </div>
                
                <div class="row">
                    <div class="input-field col s12">
                        <input id="remark" type="text" >
                        <label for="remark">Remark if any</label>
                    </div>
                </div>

                <div class="row">
                      <button class="btn waves-effect blue darken-1 offset-m4 col m3 s3" id="submit" >Submit
                        <i class="material-icons right">send</i>
                        </button>
                </div>
                <div class="row">
                    <center>
                    <b style="color: red" id="submitting">Please Wait Submitting Details...</b>                     
                    <b style="color: green" id="submitted">Submitted ..!</b>                     
                    <b style="color: red" id="problem">Unable To Submit</b>                     
                    
                
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>

    

<!-- Script Starts Here -->
<script>


function disp(x)
{
    var result = $("input[name='group3']:checked").val();
    window.selection = result
    console.log(window.selection) //changed by sarang
    if(result == "put-on-hold")
    {
        $("#ifselected").hide() 
        $("#ifonhold").show(600)    
    }

    if(result == "selected")
    {
        $("#ifonhold").hide() 
        $("#ifselected").show(600) 
    }

    if(result == "rejected"){
        $("#ifselected").hide() 
        $("#ifonhold").hide() 
        


    }

}

$(document).ready(function(){
$("#submitting").hide()  
$("#submitted").hide()  
$("#problem").hide()  

$("#ifonhold").hide()  
$("#ifselected").hide()    
$('.datepicker').datepicker();
var name = localStorage.getItem('currentemail')
var id=localStorage.getItem('id')
window.digit13=id
var str = "<b>Instance:</b> "+id+" <b>Applicant Email:</b> "+name;
$("#candidatename").append(str)


$("#submit").click(function(){
    var knowledge = $("input[name='group1']:checked").val();
    if(knowledge){
            console.log(knowledge);
    }
    var experience = $("input[name='group2']:checked").val();
    if(experience){
        console.log(experience);
    }

    var candidateknowledge = knowledge
    var candidateexperience = experience
    var candidatestrength = $("#strength").val()
    var candidateweakness = $("#weakness").val()
  
    var candidatespecial = $("#special").val()
    var candidatereasonhold = $("#reasonhold").val()
    var candidatedesignation = $("#designation").val()
    var date = $("#date").val()
    var remark = $("#remark").val()
    var name = localStorage.getItem('currentemail')
     var id=localStorage.getItem('id') //added by sarang
    // console.log("Hello",name)
    $("#submitting").show(600)
   
    $.ajax({
        url:"http://localhost/thyssenkrup/api/intereval.php",
        type:"GET",
        data : {
            "candidateknowledge":candidateknowledge,
            "candidateexperience":candidateexperience,
            "candidatestrength":candidatestrength,
            "candidateweakness":candidateweakness,
            "candidatespecial":candidatespecial,
            "candidatereasonhold":candidatereasonhold,
            "candidatedesignation":candidatedesignation,
            "date":date,
            "remark":remark,
            "name":name,
            "result":window.selection,
            "id":window.digit13//added by sarang
            // provide 13 digit number as "id"

        },
        success:function(para)
        {
            //alert(para)
            console.log(para)
            if(para == "success")
            {
                $("#submitting").hide()
                $("#submitted").show(600)
                alert("Details Submitted..!!")
                window.close()
                
            }
        }
        
    })
});


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