<?php
// error_reporting(0);
include 'api/db.php';
if(isset($_COOKIE['sid']))
{
  
  $cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
  
  if($cursor)
  {
    $cursor = $db->users->findOne(array("uid" => $cursor['uid']));
    
    $designation = $cursor['dsg'];
    
    if($designation == "hr" || $designation == "ceo" || $designation == "hod" || $designation == "rghead" )
    {
        $mailid = $_GET['aid'];
          $result = $db->intereval->find(array("email"=>$mailid));
          $cursor2 = $db->tokens->findOne(array("email"=>$mailid));
          
          $temp;
          foreach($result as $doc)
          { 
              $temp = $doc;
          }
          $doc = $temp;
          $cv=$cursor2['usercv'];
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
 <p id="candidatename" style="color: green;font-size: 30px"><b>Applicant Email:&nbsp; <?php echo $_GET['aid'] ; ?></b></p>
</center>        
<div class="row">
    <div class="col s12 m6 offset-m3">
        <div class="card white-text">
            <div class="card-content blue-text">
                <br>
                <!-- <div class="row">  <button  id="cv" class="btn modal-trigger blue darken-1">View CV</button></div> -->
                
                <div class="row">
                
                    <div class="col m12 s12">
                        <b style="font-size: 19px">Functional/Technical Knowledge:</b>
                        <br><br>
                        <div class="row">
                            <label class="col">
                                <input class="with-gap" <?php echo ($doc['candidateknowledge']=='Excellent')?'checked':'disabled' ?> name="group1" type="radio" id="ke" value="Excellent" />
                                <span>Excellent</span>
                            </label>

                            <label class="col">
                                <input class="with-gap" <?php echo ($doc['candidateknowledge']=='Very Good')?'checked':'disabled' ?> name="group1" type="radio" id="kvg" value="Very Good"/>
                                <span>Very Good</span>
                            </label>

                            <label class="col">
                                <input value="Good" <?php echo ($doc['candidateknowledge']=='Good')?'checked':'disabled' ?> class="with-gap" name="group1" type="radio"  id="kg" value="Good" />
                                <span>Good</span>
                            </label>

                            <label class="col">
                                <input value="Satisfactory" <?php echo ($doc['candidateknowledge']=='Satisfactory')?'checked':'disabled' ?> class="with-gap" name="group1" type="radio" id="ks" />
                                <span>Satisfactory</span>
                            </label>

                            <label class="col">
                                <input value="Poor" <?php echo ($doc['candidateknowledge']=='Poor')?'checked':'disabled' ?> class="with-gap" name="group1" type="radio" id="kp" />
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
                                <input value="Excellent" <?php echo ($doc['candidateexperience']=='Excellent')?'checked':'disabled' ?> class="with-gap" name="group2" type="radio" id="ee" />
                                <span>Excellent</span>
                            </label>

                            <label class="col">
                                <input value="Very Good" <?php echo ($doc['candidateexperience']=='Very Good')?'checked':'disabled' ?> class="with-gap" name="group2" type="radio"  id="evg"/>
                                <span>Very Good</span>
                            </label>

                            <label class="col">
                                <input value="Good" <?php echo ($doc['candidateexperience']=='Good')?'checked':'disabled' ?> class="with-gap" name="group2" type="radio" id="eg" />
                                <span>Good</span>
                            </label>

                            <label class="col">
                                <input value="Satisfactory" <?php echo ($doc['candidateexperience']=='Satisfactory')?'checked':'disabled' ?> class="with-gap" name="group2" type="radio"  id="es"/>
                                <span>Satisfactory</span>
                            </label>

                            <label class="col">
                                <input value="Poor" <?php echo ($doc['candidateexperience']=='Poor')?'checked':'disabled' ?> class="with-gap" name="group2" type="radio" id="ep" />
                                <span>Poor</span>
                            </label>
                        </div>     
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <input id="strength" type="text" class="validate" value="<?php echo $doc['candidatestrength']; ?>" readonly>
                        <label for="strength">Major Strenths(Technical/Functional)</label>                       
                    </div>
                </div>

                
                <div class="row">
                    <div class="input-field col s12">
                        <input id="weakness" type="text" class="validate" value="<?php echo $doc['candidateweakness']; ?>" readonly>
                        <label for="weakness">Major Weakness(Technical/Functional)</label>                                           
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <input id="special" type="text" class="validate" value="<?php echo $doc['candidatespecial']; ?>" readonly>
                        <label for="special">Any Special Areas Probed</label>                                                     
                    </div>
                </div>

                <div class="row">
                    <div class="col m12 s12">
                        <b style="font-size: 19px">Result Of Interview:</b>
                        <br><br>
                        <div class="row">
                            <label class="col">
                                <input value="selected" <?php echo ($doc['result']=='selected')?'checked':'disabled' ?> class="with-gap" name="group3" type="radio" onclick="disp(this)" id="rs" >
                                <span>Selected</span>
                            </label>

                            <label class="col">
                                <input value="hold" <?php echo ($doc['result']=='hold')?'checked':'disabled' ?> class="with-gap" name="group3" type="radio" onclick="disp(this)" id="rh" >
                                <span>put-on-hold</span>
                            </label>

                            <label class="col">
                                <input value="rejected" <?php echo ($doc['result']=='rejected')?'checked':'disabled' ?> class="with-gap" onclick="disp(this)" name="group3" type="radio" id="rr" >
                                <span>Rejected</span>
                            </label>
                        </div> 
                            
                    </div>
                </div>

                <!-- <div class="row" id="ifonhold">
                    <b class="col">Reason For Put-on-hold :</b>
                    <div class="input-field col s12">
                        <input id="reasonhold" type="text" class="validate">
                        <label for="reasonhold">Specify Reason For Put-on-hold</label>
                    </div>
                </div> -->

                <?php if($doc['result']=='selected'){
?>


<div class="row" id="ifselected">
                    <b class="col">Please Fill Following Information :</b>
                    <div class="input-field col s12">
                        <input id="designation" type="text" class="validate" value="<?php echo $doc['candidatedesignation'];?>" readonly>
                        <label for="designation">Designation for which candidate is found suitable</label>
                    </div>
                    
                    <div class="input-field col s12">
                        <input id="date" type="text" class="datepicker" value="<?php echo $doc['date'];?>">
                        <label for="date">Date at which candidate has agreed to join</label>
                    </div>
                    
                </div>

          
                <div class="row">
                    <div class="input-field col s12">
                        <input id="remark" type="text" value="<?php echo $doc['remark'];?>">
                        <label for="remark">Remark if any</label>
                    </div>
                </div>

                </div>
                
            </div>
        </div>
    </div>
</div>

<div id="modal1" class="modal">
    <div class="modal-content">
            <object data="p.pdf" type="application/pdf" width="700" height="800" id="obj">
                <a href="p.pdf">test.pdf</a>
            </object>
    </div>
    <div class="modal-footer">
      <a id="valid" onclick="valid(this)" value="" class="modal-close waves-effect waves-green btn-flat" style="color:green">Valid</a>
      <a id="invalid" onclick="invalid(this)" value="" class="modal-close waves-effect waves-green btn-flat" style="color: red">Invalid</a>
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
function clicked(x)
{
    var v = $(x).attr('value'); 
    var i = $(x).attr('id'); 
    // console.log("Value : ",v," -",i)
    $("#obj").attr("href",v)
    $("#obj").attr("data",v)
}
$(document).ready(function(){

$('.modal').modal();
$("#problem").hide()  

$("#ifonhold").hide()  

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
   



   
    
});


});

</script>
<!-- Script Ends -->
</body>
</html>
<?php
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
    }
    else
    {
        header("refresh:0;url=notfound.html");
    }  
?>