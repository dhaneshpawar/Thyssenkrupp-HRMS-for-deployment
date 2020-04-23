
<?php
include 'api/db.php';
$result = $db->tokens->findOne(array('email'=>$_GET['token']));
//echo $_GET['token'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HR2</title>

    <link rel="stylesheet" type="text/css" media="screen" href="public/css/materialize.css">
    <link rel="stylesheet" type="text/css" media="screen" href="public/css/materialize.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <script src="public/jquery-3.2.1.min.js"></script>

    <script src="public/js/materialize.js"></script>
    <script src="public/js/materialize.min.js"></script>

</head>
<style>
input[type="file"]
{
    display: none;
}
</style>
<body>

<nav>
    <div class="nav-wrapper blue darken-1">
        <a href="#!" class="brand-logo center">thyssenkrupp</a>
    </div>
</nav>
<br><br>

<div class="row" id="formdiv">
    <div class="col m6  offset-m3">
        <div class="card white">
            <div class="card-content blue-text">
                <span class="card-title"><p id="mail" style="color: green"></p></span>
                <table >
                    <thead>
                      <tr>
                          <th>Document</th>
                
                          <th>Reason</th>
                      </tr>
                    </thead>
                   

            <form id="forms" method="POST" enctype="multipart/form-data" name="validationform"> 
                    <tbody >

                      <tr id="tdcv">
                            <td>
                                <label class="custom-file-upload" >
                                 <a class="btn col s12 m12 blue darken-1"><input id="cv" name="cv" type="file" accept=".pdf" class="validate" required="" aria-required="true" ><p id='letter1'>cv</p></a>
                                </label>
                            </td>
                            

                            <td>
                                <div class="input-field col s12 m12" id="rcv1">
                                    <input id="rcv" type="text" class="validate" value="<?php echo $result['cvreason'];?> " readonly>
                                    <label for="rcv">Specify Reason</label>
                                 </div>
                            </td>
                        </tr>

                        

                        <tr id="tdpan">
                            <td>
                                <label class="custom-file-upload">
                                     <a class="btn col s12 m12 blue darken-1"><input id="pan" name="pan" type="file" accept=".pdf" class="validate" required="" aria-required="true" ><p id='letter2'>pan</p></a>
                                </label>
                                 
                            </td>
                            

                            <td>
                                <div class="input-field col s12 m12" id="rpan1">
                                    <input id="rpan" type="text" class="validate" value="<?php echo $result['pancardreason'];?>" readonly>
                                    <label for="rpan">Specify Reason</label>
                                 </div>
                            </td>
                        </tr>

                        <tr id="tdAdhaar">
                            <td>
                                <label class="custom-file-upload">
                                    <a class="btn col s12 m12 blue darken-1"><input id="Adhaar" name="Adhaar" type="file" accept=".pdf" class="validate" required="" aria-required="true" ><p id='letter3'>Adhaar Card</p></a>
                                </label>
                            </td>
                            
                            <td>
                                <div class="input-field col s12 m12" id="rAdhaar1">
                                    <input id="rAdhaar" type="text" class="validate" value="<?php echo $result['adhaarreason'];?>" readonly>
                                    <label for="rAdhaar">Specify Reason</label>
                                 </div>
                            </td>
                        </tr>

                        <tr id="tdPhoto">
                            <td>
                                <label class="custom-file-upload">
                                    <a class="btn col s12 m12 blue darken-1"><input id="photo" name="photo" name="photo" type="file" accept=".png, .jpg, .jpeg, .pdf, .docx" class="validate" required="" aria-required="true" ><p id='letter4'>PHOTO</p></a>
                                </label>
                            </td>
                           

                            <td>
                                <div class="input-field col s12 m12" id="rPhoto1" >
                                    <input id="rPhoto" type="text" class="validate" value="<?php echo $result['photoreason'];?>" readonly>
                                    <label for="rPhoto">Specify Reason</label>
                                </div>
                            </td>
                        </tr>

                        <tr id="tdgraduation">
                            <td>
                                <label class="custom-file-upload">
                                    <a class="btn col s12 m12 blue darken-1"><input id="graduation" name="graduation" type="file" accept=".pdf" class="validate" required="" aria-required="true"><p id='letter5'>GRADUATION</p></a>
                                </label>
                            </td>
                           
                            <td>
                                <div class="input-field col s12 m12" id="rgraduation1">
                                    <input id="rgraduation" type="text" class="validate" value="<?php echo $result['graduatereason'];?>" readonly>
                                    <label for="rgraduation">Specify Reason</label>
                                </div>
                            </td>
                        </tr>
                        <tr id="tdap">
                            <td >
                                <label class="custom-file-upload">
                                     <a class="btn col s12 m12 blue darken-1"><input id="ap" name="ap" type="file" accept=".pdf" class="validate" required="" aria-required="true" ><p id='letter6'>Address Proof</p></a>
                                </label>
                            </td>
                           
                            <td>
                                <div class="input-field col s12 m12" id="rap1">
                                    <input id="rap" type="text" class="validate" value="<?php echo $result['addressreason'];?>" readonly>
                                    <label for="rap">Specify Reason</label>
                                </div>
                            </td>
                        </tr>

                        <tr id="tdal">
                            <td>
                                <label class="custom-file-upload">
                                 <a class="btn col s12 m12 blue darken-1"><input id="al" name="al" type="file" accept=".pdf" class="validate" required="" aria-required="true" ><p id='letter7'>APPOINTMENT LETTER</p></a>
                                </label>
                            </td>
                           
                            <td>
                                <div class="input-field col s12 m12" id="ral1">
                                    <input id="ral" type="text" class="validate" value="<?php echo $result['appletterreason'];?>" readonly>
                                    <label for="ral">Specify Reason</label>
                                </div>
                            </td>
                        </tr>

                        <tr id="tdrl">
                            <td>
                            <label class="custom-file-upload">
                                 <a class="btn col s12 m12 blue darken-1"><input id="rl" name="rl" type="file" accept=".pdf" class="validate" required="" aria-required="true" ><p id='letter8'>Relieving Letter</p></a>
                                </label>
                            </td>
                            
                            <td>
                                <div class="input-field col s12 m12" id="rrl1">
                                    <input id="rrl" type="text" class="validate" value="<?php echo $result['relletterreason'];?>" readonly>
                                    <label for="rrl">Specify Reason</label>
                                </div>
                            </td>
                        </tr>

                        <tr id="tdpayslip">
                            <td>
                            <label class="custom-file-upload">
                                 <a class="btn col s12 m12 blue darken-1"><input id="payslip" name="payslip" type="file" accept=".pdf" class="validate" required="" aria-required="true" ><p id='letter10'>PAST PAY SLIP</p></a>
                                </label>
                            </td>
                            
                            <td>
                                <div class="input-field col s12 m12" id="rpayslip1">
                                    <input id="rpayslip" type="text" class="validate" value="<?php echo $result['pastpayslipreason'];?>" readonly>
                                    <label for="rpayslip">Specify Reason</label>
                                </div>
                            </td>
                        </tr>
                        
                        <tr id="tdcc">
                            <td>
                            <label class="custom-file-upload">
                                 <a class="btn col s12 m12 blue darken-1"><input id="cc" name="cc" type="file" accept=".pdf" class="validate" required="" aria-required="true" ><p id='letter11'>CANCELLED CHEQUE</p></a>
                                </label>
                            </td>
                            
                            <td>
                                <div class="input-field col s12 m12" id="rcc1">
                                    <input id="rcc" type="text" class="validate" value="<?php echo $result['cancheckreason'];?>" readonly>
                                    <label for="rcc">Specify Reason</label>
                                </div>
                            </td>
                        </tr>

                    </tbody>
                    </form>

                    <script> 
                        function getUrlVars() {
                            var vars = {};
                            var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
                                vars[key] = value;
                            });
                            return vars;
                        }



                        var token = getUrlVars()["token"];
                        console.log("Mail-"+token);
                        document.getElementById('forms').action = 'updatedoc.php?token='+token;
                    </script>
                  </table>

            </div><br>
            <center>
</center>
            <a class="waves-effect blue darken-1 btn col s12 m12" type="submit" id="submit" onclick="submitForm()">Submit</a>
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
<script type="text/javascript">

para=['pan','ccl']
 
function clicked(x)
{
    var v = $(x).attr('value'); 
    var i = $(x).attr('id'); 
    
    $("#obj").attr("href",v)
    $("#obj").attr("data",v)
    $("#valid").attr("value",i)
    $("#invalid").attr("value",i)
}

$('#cv').change(function(){
    var f=$('#cv').val();

$('#letter1').replaceWith(f);
})

$('#pan').change(function(){
    var f=$('#pan').val();

$('#letter2').replaceWith(f);
})

$('#Adhaar').change(function(){
    var f=$('#Adhaar').val();
    $('#letter3').replaceWith(f);
})
$('#photo').change(function(){
    var f=$('#photo').val();

$('#letter4').replaceWith(f);
})
$('#graduation').change(function(){
    var f=$('#graduation').val();

$('#letter5').replaceWith(f);
})
$('#ap').change(function(){
    var f=$('#ap').val();

$('#letter6').replaceWith(f);
})
$('#al').change(function(){
    var f=$('#al').val();
    

$('#letter7').replaceWith(f);
})
$('#rl').change(function(){
    var f=$('#rl').val();
    

$('#letter8').replaceWith(f);
})
$('#ccl').change(function(){
    var f=$('#ccl').val();
    

$('#letter9').replaceWith(f);
})
$('#payslip').change(function(){
    var f=$('#payslip').val();
    

$('#letter10').replaceWith(f);
})
$('#cc').change(function(){
    var f=$('#cc').val();
    

$('#letter11').replaceWith(f);
})


$(document).ready(function(){

    if(token == "1")
    {
        $("#formdiv").hide()
    }
    else
    {
        $.ajax({
        url:"http://localhost/thyssenkrup/api/getvaliddoc.php",
        type:'POST',
        data:
        {
            "mail":token
        },
        success:function(para)
        {

            console.log(para)
            para=JSON.parse(para)
            
            for(let i=0;i<para.length;i++)
            {
                var hideelement='#td'+para[i];
                // alert(hideelement)
                $(hideelement).remove()
                
                
            }

        }
  }  )
    }
  
    // $("#done").hide();
    // $('#submit').click(function(){
    //     alert(para)
    //     $('#done').show()
    // })

})

function submitForm()
{
    var x = document.getElementsByName('validationform');
    x[0].submit(); // Form submission
    alert('submitted')
    
}
</script>
<!-- Script Ends -->


</body>

</html>