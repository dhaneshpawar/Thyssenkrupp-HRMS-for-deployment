<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="public/css/materialize.css">
    <link rel="stylesheet" href="public/css/materialize.min.css">


    <!-- Compiled and minified JavaScript -->
    <script src="public/js/materialize.js"></script>
    <script src="public/js/materialize.min.js"></script>
    <script src="public/jquery-3.2.1.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        
        <!-- for sidenav -->
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" type="text/css" media="screen" href="public/css/common.css">
            
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
    input[type="file"] {
    display: none;
    }
    </style>
</head>
<body>
<div id="sidenn" class="w3-sidebar blue w3-bar-block sidemenu" style="z-index: 1000">

  <h3 class="w3-bar-item white"> <center>
  <a href="/hrms/">Home</a><i id="remin" class="material-icons" style="float: right;cursor: pointer;">close</i></center>  
</a></h3> <br><br>
  <a href="/hrms/csvupload.php" class="w3-bar-item w3-button">Create new Department and PRF</a> <br>
  <a href="/hrms/hrnew.php" class="w3-bar-item w3-button">Create New Instance</a> <br>
  <a href="/hrms/initiateround.php" class="w3-bar-item w3-button">Initiate rounds for instances</a> <br>
  <a href="/hrms/allocateround.php" class="w3-bar-item w3-button">On going rounds</a> <br>
  <a href="/hrms/history.php" class="w3-bar-item w3-button">See History  </a> <br>
  <a href="/hrms/allocateround2.php" class="w3-bar-item w3-button">Rescheduling</a> <br>
  <a href="/hrms/interview.php" class="w3-bar-item w3-button">Update Interviews</a> <br>
  <a href="/hrms/offerletter.php" class="w3-bar-item w3-button">Offer Letter</a> <br>
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

    <!-- card stars -->
    <div class="row">
        <div class="col s12 m6 offset-m3">
            <div class="card white">
                <div class="card-content blue-text">
                <span class="card-title">Upload Dump</span>
                <p>Upload csv dump here cosisting of all the previous data.<br>
                    Once the file is uploaded
                 cannot be changed.   
                </p>

                <form action="importExcel.php" method="POST" enctype="multipart/form-data">
                            
                         
                    <div class="input-field col s12 offset-m4" id="uphoto">
                            
                            <label class="custom-file-upload" id="prof">
                                <a class="btn blue darken-1">
                                <input id="uploadcsv" required type="file" accept=".csv" name="uploadcsv" onchange="readURL(this)"><p id='myfile0'> Select file<i class="material-icons right">open_in_browser</i> </p></a>
                            </label>
                            <br><br><br> &nbsp;&nbsp;&nbsp;
                    <button type="submit" class="btn blue darken-1" name="submit" id="submit" value="Upload"><i class="material-icons right">send</i>Upload</button>

                    </div>
                   
                    
                </form>
                <br><br><br><br><br>
                </div>

            </div>
        </div>
  </div>
    <!-- card ends -->
    </div>
    <script src="public/js/common.js"></script>

  <script>
  
function readURL(input) {
  var f = $('#uploadcsv').val().split('.')
      var x=f[1]
      if(x=='csv')
      {
        var f = $('#uploadcsv').val()
      
      $('#myfile0').text(f)
      }
      else
      {
        alert('Invalid File\n Only CSV Files Accepted')
        $('#uploadcsv').val(" ")
      }
}
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
    
</body>
</html>