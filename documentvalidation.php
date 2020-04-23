<?php
include 'api/db.php';
$cursor = $db->tokens->find();

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
<body>

<nav>
    <div class="nav-wrapper blue darken-1">
        <a href="#!" class="brand-logo center">thyssenkrupp</a>
    </div>
</nav>
<br><br>
<div class="row" id="parent">
    <div class="col m12  ">
        <div class="card white">
            <div class="card-content blue-text">
                <span class="card-title"><p id="mail" style="color: green"></p></span> <br>
                <input type="text" value="" id="uan" name="uan" disabled style="color:green;text-align:center;font-weight: bold;font-size:30px;">

                <table class="striped">
                    <thead>
                      <tr>
                          <th>Document</th>
                          <th>Valid</th>
                          <th>Invalid</th>

                          <th>Reason</th>
                          <th>Freez</th>
                          
                      </tr>
                    </thead>
            
                    <tbody>
                    
                       <tr id="tdcv">
                            <td>
                                 <a class="waves-effect blue darken-1  btn modal-trigger  col s12 m6" value="" href="#modal1" id="cv" onclick="clicked(this)">CV</a>
                            </td>
                            
                            <td>
                                <label style="color:green;">
                                    <input class="with-gap" name="gcv" type="radio"  value="valid" id="cvv"/>
                                    <span>Valid</span>
                                </label>
                            </td> 

                            <td>
                                <label style="color:red;">
                                    <input class="with-gap" name="gcv" type="radio" value="invalid" id="cvi"/>
                                    <span>Invalid</span>
                                </label>
                            </td>

                            <td>
                                <div class="input-field col s12 m12" id="rcv1">
                                    <input id="rcv" type="text" style="color:black" class="validate" placeholder="Specify Reason">
                                    <label for="rcv">Specify Reason</label>
                                 </div>
                            </td>

                            <td>
                            <a class="waves-effect green btn" id="cvf" onclick=freez(this.id) ><i class="material-icons right">done</i>Freez</a>
                            </td>

                        </tr>

                        

                        <tr id="tdpan">
                            <td>
                                 <a class="waves-effect blue darken-1  btn modal-trigger col s12 m6" value=""  href="#modal1" onclick="clicked(this)" id="pan">PAN Card</a>
                            </td>

                            <td>
                                <label style="color:green;">
                                    <input class="with-gap" name="gpan" type="radio"  value="valid" id="panv"/>
                                    <span>Valid</span>
                                </label>
                            </td> 

                            <td>
                                <label style="color:red;">
                                    <input class="with-gap" name="gpan" type="radio" value="invalid" id="pani"/>
                                    <span>Invalid</span>
                                </label>
                            </td>

                            <td>
                                <div class="input-field col s12 m12" id="rpan1">
                                    <input id="rpan" type="text" style="color:black" class="validate" placeholder="Specify Reason">
                                    <label for="rpan">Specify Reason</label>
                                 </div>
                            </td>

                            <td>
                            <a class="waves-effect green btn" id="panf" onclick=freez(this.id) ><i class="material-icons right">done</i>Freez</a>
                            </td>

                        </tr>

                        <tr id="tdAdhaar">
                            <td>
                                 <a class="waves-effect blue darken-1 modal-trigger btn col s12 m6" value="" href="#modal1" onclick="clicked(this)" id="Adhaar">Adhaar</a>
                            </td>
                            
                            <td>
                                <label style="color:green;">
                                    <input class="with-gap" name="gAdhaar" type="radio"  value="valid" id="Adhaarv"/>
                                    <span>Valid</span>
                                </label>
                            </td> 

                            <td>
                                <label style="color:red;">
                                    <input class="with-gap" name="gAdhaar" type="radio" value="invalid" id="Adhaari"/>
                                    <span>Invalid</span>
                                </label>
                            </td>

                            <td>
                                <div class="input-field col s12 m12" id="rAdhaar1">
                                    <input id="rAdhaar" type="text" class="validate" style="color:black" placeholder="Specify Reason">
                                    <label for="rAdhaar">Specify Reason</label>
                                 </div>
                            </td>

                            <td>
                            <a class="waves-effect green btn" id="Adhaarf" onclick=freez(this.id) ><i class="material-icons right">done</i>Freez</a>
                            </td>
                        </tr>

                        <tr id="tdPhoto">
                            <td>
                                 <a class="waves-effect blue darken-1 modal-trigger btn col s12 m6" value=""  href="#modal1" onclick="clicked(this)" id="Photo">Photo</a>
                            </td>

                            <td>
                                <label style="color:green;">
                                    <input class="with-gap" name="gPhoto" type="radio"  value="valid" id="Photov"/>
                                    <span>Valid</span>
                                </label>
                            </td> 

                            <td>
                                <label style="color:red;">
                                    <input class="with-gap" name="gPhoto" type="radio" value="invalid" id="Photoi"/>
                                    <span>Invalid</span>
                                </label>
                            </td>
                            
                            <td>
                                <div class="input-field col s12 m12" id="rPhoto1" >
                                    <input id="rPhoto" type="text" class="validate" style="color:black" placeholder="Specify Reason">
                                    <label for="rPhoto">Specify Reason</label>
                                </div>
                            </td>
                            <td>
                            <a class="waves-effect green btn" id="Photof" onclick=freez(this.id) ><i class="material-icons right">done</i>Freez</a>
                            </td>
                        </tr>

                        


                        <tr id="tdgraduation">
                            <td>
                                <a class="waves-effect blue darken-1 modal-trigger btn col s12 m6" value="" href="#modal1" onclick="clicked(this)" id="graduation">Qualification</a>
                            </td>

                            <td>
                                <label style="color:green;">
                                    <input class="with-gap" name="ggraduation" type="radio"  value="valid" id="graduationv"/>
                                    <span>Valid</span>
                                </label>
                            </td> 

                            <td>
                                <label style="color:red;">
                                    <input class="with-gap" name="ggraduation" type="radio" value="invalid" id="graduationi"/>
                                    <span>Invalid</span>
                                </label>
                            </td>
                           
                            <td>
                                <div class="input-field col s12 m12" id="rgraduation1">
                                    <input id="rgraduation" type="text" class="validate" style="color:black" placeholder="Specify Reason">
                                    <label for="rgraduation">Specify Reason</label>
                                </div>
                            </td>

                            <td>
                            <a class="waves-effect green btn" id="graduationf" onclick=freez(this.id) ><i class="material-icons right">done</i>Freez</a>
                            </td>
                        </tr>

                        <tr id="tdap">
                            <td>
                                <a class="waves-effect blue darken-1 modal-trigger btn col s12 m6" value="" href="#modal1" onclick="clicked(this)" id="ap">Address Proof</a>
                            </td>
                        
                            <td>
                                <label style="color:green;">
                                    <input class="with-gap" name="gap" type="radio"  value="valid" id="apv"/>
                                    <span>Valid</span>
                                </label>
                            </td> 

                            <td>
                                <label style="color:red;">
                                    <input class="with-gap" name="gap" type="radio" value="invalid" id="api"/>
                                    <span>Invalid</span>
                                </label>
                            </td>

                            <td>
                                <div class="input-field col s12 m12" id="rap1">
                                    <input id="rap" type="text" class="validate" style="color:black" placeholder="Specify Reason">
                                    <label for="rap">Specify Reason</label>
                                </div>
                            </td>

                            <td>
                            <a class="waves-effect green btn" id="apf" onclick=freez(this.id) ><i class="material-icons right">done</i>Freez</a>
                            </td>
                        </tr>

                        <tr id="tdal">
                            <td>
                                <a class="waves-effect blue darken-1  modal-trigger btn col s12 m6" value="" href="#modal1" onclick="clicked(this)" id="al">Appointment Letter</a>
                            </td>

                            <td>
                                <label style="color:green;">
                                    <input class="with-gap" name="gal" type="radio"  value="valid" id="alv"/>
                                    <span>Valid</span>
                                </label>
                            </td> 

                            <td>
                                <label style="color:red;">
                                    <input class="with-gap" name="gal" type="radio" value="invalid" id="ali"/>
                                    <span>Invalid</span>
                                </label>
                            </td>
 
                            <td>
                                <div class="input-field col s12 m12" id="ral1">
                                    <input id="ral" type="text" class="validate" style="color:black" placeholder="Specify Reason">
                                    <label for="ral">Specify Reason</label>
                                </div>
                            </td>

                            <td>
                            <a class="waves-effect green btn" id="alf" onclick=freez(this.id) ><i class="material-icons right">done</i>Freez</a>
                            </td>
                        </tr>

                        <tr id="tdrl">
                            <td>
                                <a class="waves-effect blue darken-1 modal-trigger btn col s12 m6"value="" href="#modal1" onclick="clicked(this)" id="rl">Relieving Letter</a>
                            </td>
                            
                            <td>
                                <label style="color:green;">
                                    <input class="with-gap" name="grl" type="radio"  value="valid" id="rlv"/>
                                    <span>Valid</span>
                                </label>
                            </td> 

                            <td>
                                <label style="color:red;">
                                    <input class="with-gap" name="grl" type="radio" value="invalid" id="rli"/>
                                    <span>Invalid</span>
                                </label>
                            </td>

                            <td>
                                <div class="input-field col s12 m12" id="rrl1">
                                    <input id="rrl" type="text" class="validate" style="color:black" placeholder="Specify Reason">
                                    <label for="rrl">Specify Reason</label>
                                </div>
                            </td>

                            <td>
                            <a class="waves-effect green btn" id="rlf" onclick=freez(this.id) ><i class="material-icons right">done</i>Freez</a>
                            </td>
                        </tr>

                        
                        <tr id="tdpayslip">
                            <td>
                                <a class="waves-effect blue darken-1 modal-trigger btn col s12 m6" value="" href="#modal1" onclick="clicked(this)" id="payslip">Past 3 Month Payslip</a>
                            </td>
                            
                            <td>
                                <label style="color:green;">
                                    <input class="with-gap" name="gpayslip" type="radio"  value="valid" id="payslipv"/>
                                    <span>Valid</span>
                                </label>
                            </td> 

                            <td>
                                <label style="color:red;">
                                    <input class="with-gap" name="gpayslip" type="radio" value="invalid" id="payslipi"/>
                                    <span>Invalid</span>
                                </label>
                            </td>

                            <td>
                                <div class="input-field col s12 m12" id="rpayslip1">
                                    <input id="rpayslip" type="text" class="validate" style="color:black" placeholder="Specify Reason">
                                    <label for="rpayslip">Specify Reason</label>
                                </div>
                            </td>

                            <td>
                            <a class="waves-effect green btn" id="payslipf" onclick=freez(this.id) ><i class="material-icons right">done</i>Freez</a>
                            </td>
                        </tr>


                        <tr id="tdcc">
                            <td>
                                <a class="waves-effect blue darken-1 modal-trigger btn col s12 m6" value="" href="#modal1" onclick="clicked(this)" id="cc">Cancelled Cheque</a>
                            </td>

                            <td>
                                <label style="color:green;">
                                    <input class="with-gap" name="gcc" type="radio"  value="valid" id="ccv"/>
                                    <span>Valid</span>
                                </label>
                            </td> 

                            <td>
                                <label style="color:red;">
                                    <input class="with-gap" name="gcc" type="radio" value="invalid" id="cci"/>
                                    <span>Invalid</span>
                                </label>
                            </td>

                            <td>
                                <div class="input-field col s12 m12" id="rcc1">
                                    <input id="rcc" type="text" class="validate" style="color:black" placeholder="Specify Reason">
                                    <label for="rcc">Specify Reason</label>
                                </div>
                            </td>

                            <td>
                            <a class="waves-effect green btn" id="ccf" onclick=freez(this.id) ><i class="material-icons right">done</i>Freez</a>
                            </td>
                        </tr>

                    </tbody>

                  </table>

            </div>
            <a class="waves-effect blue darken-1 btn col s12 m12" id="submit">Submit</a>
        </div>
    </div>
</div>

 <div id="modal1" class="modal">
    <div class="modal-content" id="cnt">

    </div>
</div>

  
  <center id="bwaiting">
  <b style="color:red">Submitting Details Please Wait...</b>
  </center>
  <center id="bcomplete">
  <h4><b style="color:green">Candidate Validated Successfully You Can Close This Window Now</b></h4>
  </center>
<!-- Script Starts Here -->
<script>
var counter=0;
var validcount = 0;
var valid = [];
var invalid = [];
var invalidreason = [];
var ctr1 = 0;
var ctr2 = 0;
var ctr = 0;

function freez(id)
{
    var b = '#'+id
    id = id.substring(0, id.length - 1);
    var group = "g"+id
    var radioresult = id+'i'
    var reason = "#r"+id
    var x = $(reason).val()

    
    var r = $('input[name="'+group+'"]:checked').attr('id');
    if(r)
    {
        if(r==radioresult)
        {
            if(x == "")
            {
                
                alert('Please Specify Reason..!!')
            }
            else
            {

            invalid[ctr1] = id;
            var str_reason = $(reason).val()
            invalidreason[ctr1] = str_reason;
            ctr1++;
            var v = '#'+id+'v'
            var i = '#'+id+'i'
            $(v).attr('disabled',true)
            $(i).attr('disabled',true)
            $(b).attr('disabled',true)
            $(reason).attr('disabled',true)
            ctr++;
            
            }
        }
        else
        {
            valid[ctr2] = id;
            ctr2++;
            var v = '#'+id+'v'
            var i = '#'+id+'i'
            $(b).text('freezed')
            $(v).attr('disabled',true)
            $(i).attr('disabled',true)
            $(b).attr('disabled',true)
            $(reason).attr('disabled',true)
            ctr++;
        }

    }
    else
    {
        alert('Please select Valid or Invalid')

    }
    


}

function clicked(x)
{

    var v = $(x).attr('value'); 
    var i = $(x).attr('id'); 
    // console.log("Value : ",v," -",i)


    $(".modal-content").empty();
    $(".modal-content").removeData();
    var str='<object data="p.pdf" type="application/pdf" width="700" height="800" id="obj"><a href="p.pdf">test.pdf</a></object>'
    $("#cnt").append(str)
    $("#obj").attr("href",v)
    $("#obj").attr("data",v)
    $("#valid").attr("value",i)
    $("#invalid").attr("value",i)
}

function valid(x)
{
    counter++;
    var v = $(x).attr('value'); 
    // alert(v)
    nameDoc=v;
    var btn = "#"+v
    var v2 = "#r"+v 
    v = "#r"+v+"1"
    $(v).show()
    $(v2).val("Validated")
    $(v2).attr("disabled","true")

    // alert("This is val : "+$(v2).val())
    var m = localStorage.getItem('currentemail')
    doc=$(v2).val()
    console.log("This is valid : "+doc)
    $.ajax({

    type:"POST",
    url:"http://localhost/thyssenkrup/api/validdoc.php",

    data:
    {
    "doc":nameDoc,
    'reason':doc,
    'mail':m
    },
    success:function(para)
    {

    console.log(para)
    //alert(str)
    if(para=="success")
    {
    console.log("successful")
    }
    else
    {
    console.log("not successful")

    }

    }

    })
}

function invalid(x)
{
    counter++;

    var va = $(x).attr('value'); 
    v = "#r"+va+"1"
    $(v).show()
    //alert(v)
    var m = localStorage.getItem('currentemail')
    $.ajax({

        type:"POST",
        url:"http://localhost/thyssenkrup/api/invaliddoc.php",
        data:
        {
            'doc':va,
            'mail':m
        },
        success:function(para)
        {
            
            console.log(para)
            //alert(str)
            if(para=="success")
            {
                console.log("successful")
            }
            else
            {
                console.log("not successful")
                
            }

        }
    
    })
}


$(document).ready(function(){

//for valid
$("#cvv").click(function(){
        var r = $("input[name='gcv']:checked").attr('id');
        if(r=="cvi"){
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            //$("#rcv").val("")
            $(r).prop("disabled", false)
                    
        }
        else
        {
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            $(r).val("Validated")
            $(r).prop("disabled", true)
        }
});

$("#panv").click(function(){
        var r = $("input[name='gpan']:checked").attr('id');
        if(r=="pani"){
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            //$("#rpan").val("")
            $(r).prop("disabled", false)
                    
        }
        else
        {
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            $(r).val("Validated")
            $(r).prop("disabled", true)
        }
});

$("#Adhaarv").click(function(){
        var r = $("input[name='gAdhaar']:checked").attr('id');
        if(r=="Adhaari"){
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            //$("#rAdhaar").val("")
            $(r).prop("disabled", false)
                    
        }
        else
        {
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            $(r).val("Validated")
            $(r).prop("disabled", true)
        }
});

$("#Photov").click(function(){
        var r = $("input[name='gPhoto']:checked").attr('id');
        if(r=="Photoi"){
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            //$("#rPhoto").val("")
            $(r).prop("disabled", false)
                    
        }
        else
        {
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            $(r).val("Validated")
            $(r).prop("disabled", true)
        }
});

$("#graduationv").click(function(){
        var r = $("input[name='ggraduation']:checked").attr('id');
        if(r=="graduationi"){
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            //$("#rgraduation").val("")
            $(r).prop("disabled", false)
                    
        }
        else
        {
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            $(r).val("Validated")
            $(r).prop("disabled", true)
        }
});

$("#apv").click(function(){
        var r = $("input[name='gap']:checked").attr('id');
        if(r=="api"){
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            //$("#rap").val("")
            $(r).prop("disabled", false)
                    
        }
        else
        {
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            $(r).val("Validated")
            $(r).prop("disabled", true)
        }
});

$("#alv").click(function(){
        var r = $("input[name='gal']:checked").attr('id');
        if(r=="ali"){
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            //$("#ral").val("")
            $(r).prop("disabled", false)
                    
        }
        else
        {
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            $(r).val("Validated")
            $(r).prop("disabled", true)
        }
});

$("#rlv").click(function(){
        var r = $("input[name='grl']:checked").attr('id');
        if(r=="rli"){
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            //$("#rrl").val("")
            $(r).prop("disabled", false)
                    
        }
        else
        {
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            $(r).val("Validated")
            $(r).prop("disabled", true)
        }
});

$("#payslipv").click(function(){
        var r = $("input[name='gpayslip']:checked").attr('id');
        if(r=="payslipi"){
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            //$("#rpayslip").val("")
            $(r).prop("disabled", false)
                    
        }
        else
        {
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            $(r).val("Validated")
            $(r).prop("disabled", true)
        }
});

$("#ccv").click(function(){
        var r = $("input[name='gcc']:checked").attr('id');
        if(r=="cci"){
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            //$("#rcc").val("")
            $(r).prop("disabled", false)
                    
        }
        else
        {
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            $(r).val("Validated")
            $(r).prop("disabled", true)
        }
});



//for invalid
$("#cvi").click(function(){
        var r = $("input[name='gcv']:checked").attr('id');
        if(r=="cvi"){
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            //$("#rcv").val("")
            $(r).prop("disabled", false)
                    
        }
        else
        {
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            $(r).val("Validated")
            $(r).prop("disabled", true)
        }
});

$("#pani").click(function(){
        var r = $("input[name='gpan']:checked").attr('id');
        if(r=="pani"){
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            //$("#rpan").val("")
            $(r).prop("disabled", false)
                    
        }
        else
        {
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            $(r).val("Validated")
            $(r).prop("disabled", true)
        }
});

$("#Adhaari").click(function(){
        var r = $("input[name='gAdhaar']:checked").attr('id');
        if(r=="Adhaari"){
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            //$("#rAdhaar").val("")
            $(r).prop("disabled", false)
                    
        }
        else
        {
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            $(r).val("Validated")
            $(r).prop("disabled", true)
        }
});

$("#Photoi").click(function(){
        var r = $("input[name='gPhoto']:checked").attr('id');
        if(r=="Photoi"){
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            //$("#rPhoto").val("")
            $(r).prop("disabled", false)
                    
        }
        else
        {
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            $(r).val("Validated")
            $(r).prop("disabled", true)
        }
});

$("#graduationi").click(function(){
        var r = $("input[name='ggraduation']:checked").attr('id');
        if(r=="graduationi"){
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            //$("#rgraduation").val("")
            $(r).prop("disabled", false)
                    
        }
        else
        {
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            $(r).val("Validated")
            $(r).prop("disabled", true)
        }
});

$("#api").click(function(){
        var r = $("input[name='gap']:checked").attr('id');
        if(r=="api"){
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            //$("#rap").val("")
            $(r).prop("disabled", false)
                    
        }
        else
        {
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            $(r).val("Validated")
            $(r).prop("disabled", true)
        }
});

$("#ali").click(function(){
        var r = $("input[name='gal']:checked").attr('id');
        if(r=="ali"){
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            //$("#ral").val("")
            $(r).prop("disabled", false)
                    
        }
        else
        {
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            $(r).val("Validated")
            $(r).prop("disabled", true)
        }
});

$("#rli").click(function(){
        var r = $("input[name='grl']:checked").attr('id');
        if(r=="rli"){
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            //$("#rrl").val("")
            $(r).prop("disabled", false)
                    
        }
        else
        {
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            $(r).val("Validated")
            $(r).prop("disabled", true)
        }
});

$("#payslipi").click(function(){
        var r = $("input[name='gpayslip']:checked").attr('id');
        if(r=="payslipi"){
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            //$("#rpayslip").val("")
            $(r).prop("disabled", false)
                    
        }
        else
        {
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            $(r).val("Validated")
            $(r).prop("disabled", true)
        }
});

$("#cci").click(function(){
        var r = $("input[name='gcc']:checked").attr('id');
        if(r=="cci"){
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            //$("#rcc").val("")
            $(r).prop("disabled", false)
                    
        }
        else
        {
            
            r = r.substring(0, r.length - 1);
            var btn = r
            btn = '#'+btn+'f'
            r = '#r'+r+'1' 
            $(r).fadeIn(600)
            r = r.substring(0, r.length - 1);
            $(r).val("Validated")
            $(r).prop("disabled", true)
        }
});



$("#bwaiting").hide()
$("#bcomplete").hide()
$('.modal').modal();
var m = localStorage.getItem('currentemail')

var str = "<b>Candidate :</b> "+m
$("#mail").append(str)
$("#rcv1").hide()
$("#raf1").hide()
$("#rpan1").hide()
$("#rAdhaar1").hide()
$("#rPhoto1").hide()
$("#rssc1").hide()
$("#rhsc1").hide()
$("#rgraduation1").hide()
$("#rap1").hide()
$("#ral1").hide()
$("#rrl1").hide()
$("#rpayslip1").hide()
$("#ruan1").hide()
$("#rcc1").hide()
$("#rdiploma1").hide()

$.ajax({
    url:"http://localhost/thyssenkrup/api/getdocuments.php",
    data:{
        "mail" : m
    },
    type:"POST",
    success:function(para)
    {
        console.log(para)
        
        para=JSON.parse(para)
        console.log("len:" +para[1].length)
        for(i=0;i<para.length;i++)
        {
            console.log("This is : ",para)
        }
        console.log("this is data = ",para)
        //console.log(para)
        $("#cv").attr("value",para[0][0])
        $("#pan").attr("value",para[0][1])
        $("#Adhaar").attr("value",para[0][2])
        $("#Photo").attr("value",para[0][3])
        $("#graduation").attr("value",para[0][4])
        $("#ap").attr("value",para[0][5])
        $("#al").attr("value",para[0][6])
        $("#rl").attr("value",para[0][7])
        $("#payslip").attr("value",para[0][8])
        $("#uan").attr("value","UAN:  "+para[0][9])
        $("#cc").attr("value",para[0][10])  
        validcount = para[1].length
        for(let i=0;i<para[1].length;i++)
        {
            var hideelement='#td'+para[1][i];
            // alert(hideelement)
            $(hideelement).remove()
        }        

    }
})

});

$("#submit").click(function(){
    console.log("this is valid:",valid)
    console.log("this is invalid:",invalid)
    console.log("this is vinalid reason:",invalidreason)
    console.log("this is ctr:",ctr)


    if(ctr==(10-validcount))    
    {
    
    cv=$("#rcv").val()
    pancard = $("#rpan").val()
    adhaar=$("#rAdhaar").val()
    photo = $("#rPhoto").val()
    graduate= $("#rgraduation").val()
    address=$("#rap").val()
    cancheck=$("#rcc").val()
    appletter=$("#ral").val()
    pastpayslip=$("#rpayslip").val()
    relletter=$("#rrl").val()
    currcomp=$("#rccl").val()
    
    var m = localStorage.getItem('currentemail')
    $('#parent').empty();

    $('#parent').append('<center><h4><b style="color:red;">Submitting Details Please Wait</b></h4></center>')
   // alert(cv)
    $.ajax({
        url:"http://localhost/thyssenkrup/api/submitvalidation.php",
        type:"POST",
        data:{
            "valid":valid,
            "invalid" :invalid,
            "reason" :invalidreason,
            "cv":cv,
            "pancard" : pancard,
            "adhaar":adhaar,
            "photo" : photo,
            "graduate": graduate,
            "address":address,
            "cancheck":cancheck,
            "appletter":appletter,
            "pastpayslip":pastpayslip,
            "relletter":relletter,
            "mail":m
        },
        success:function(para)
        {
            $('#parent').empty();
            console.log("submit"+para)
            $("#parent").fadeOut(600)
            $("#bcomplete").show()   
            setTimeout(function(){ window.close(); }, 3000); 
           // para="success
            // if(para=="success")
            // alert(para)
            // else
            // alert("error")
        }
    })
    }else{
        alert("Please Validate All Documents..!")
    }

})


</script>
<!-- Script Ends -->


</body>

</html>