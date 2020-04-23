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
    
<div class="row">
    <div class="col s12 m12">
        <div class="card white-text">
            <div class="card-content blue-text">
                <span class="card-title">Groups For Document Validation</span>
                <table class="striped">
                    <thead>
                        <tr>
                            <th>Groups</th>
                           
                            <th>Validate</th>
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

<div class="row" id="selection" >
    <div class="col s12" >
        <ul class="tabs">
            <li class="tab col s3" id="validation"><a class="active" href="#test1" style="color: orangered">Validation</a></li>
            <li class="tab col s3" id="revalidation"><a  href="#test2" style="color: red">Revalidation</a></li>
        </ul>
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
                                <th>Validate</th>
                                
                                
                            </tr>
                        </thead>
                        <!-- Email Body  -->
                        <tbody id="emailbody">
    
                        </tbody>
                        <!-- End of Email Body -->
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row" id="emailrow2">
        <div class="col s12 m12">
            <div class="card white-text">
                <div class="card-content blue-text">
                    <span class="card-title">Candidates Mail</span>
                    <table class="striped">
                        <thead>
                            <tr>
                               
                                <th>Email</th>
                                <th>Validate</th>
                                
                                
                            </tr>
                        </thead>
                        <!-- Email Body  -->
                        <tbody id="emailbody2">
    
                        </tbody>
                        <!-- End of Email Body -->
                    </table>
                </div>
            </div>
        </div>
    </div>
    
</div>
    


<!-- Script Starts Here -->
<script>
$(document).ready(function(){
$('.tabs').tabs();
$("#emailrow").hide()
$("#selection").hide()
$("#emailrow2").hide()


//displaying validation and revalidation on click

$("#validation").click(function(){
   
    
    $("#emailrow2").hide();
    $("#emailrow").fadeIn(600)
})


$("#revalidation").click(function(){
    $("#emailrow").hide();
    $("#emailrow2").fadeIn(600)
})

// Ajax Call For Tking data of Grops for validation
$.ajax({
    url:"/demo.txt",
    type:"GET",
    success:function(para)
    {   
        //dummy data please send in below format..!!
        para = ['PRF1-INSTANCE1-ROUND1','PRF2-INSTANCE2-ROUND2']
        
        for(let i=0;i<para.length;i++)
        {
            var txt1 = '<tr><td><label class="waves-effect blue darken-1 btn">'+para[i]+'</label></td>'
            var txt2 = '<td><button class="btn waves-effect green"  id="'+para[i]+'" onclick="displayMail(this.id)">Start Validation<i class="material-icons right">send</i>' 
            var txt3 = ' </button></td></tr>'
            var str = txt1+txt2+txt3;
            $("#todolistbody").append(str)
        }
                
    }    

})
// end of page loading ajax call



});

//ajax call for displaying email id's
function displayMail(x)
{
    alert(x)
    
    $.ajax({
        url:"/demo.txt",
        type:"GET",
        data:{
            "id":x
        },
        success:function(para)
        {   
            $("#emailbody").text("")
            $("#emailbody2").text("")

            // Dummy Data please send in below format..!!
            para = [['Tanny@gmail.com',"0"],["rb@gmail.com","1"],["ad@gmail.com","0"],["shaikh@gmail.com","1"]]
            var temparr = [];
            for(let i=0;i<para.length;i++)
            {
                for(let j=0;j<2;j++)
                {
                    temparr[j] = para[i][j];
                    
                }
                var status;
                if(temparr[1] == "0")
                {
                    status = "#emailbody"
                    
                    
                    
                }
                else if(temparr[1] == "1")
                {
                    status = "#emailbody2"

                }
                var txt1 = '<tr><td><p>'+temparr[0]+'</p></td>'
                var txt2 = '<td><button class="btn waves-effect green" onclick="evaluateMail(this.id)">Validate Candidate<i class="material-icons right">send</i>'                       
                var txt3 = ' </button></td></tr>' 
                var str = txt1+txt2+txt3;
                $(status).append(str)  

            }
            $("#validation").click()
            $("#selection").fadeIn(600)
        }
    })
}

// function for jumping to Document Validation Form form
function evaluateMail(x)
{
    
    localStorage.setItem('currentemail',x)
    alert(localStorage.getItem('currentemail'))
     window.open("/validatedocument.html", '_blank');
}

</script>
<!-- Script Ends -->
</body>




</html>