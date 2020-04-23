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
<div class="w3-sidebar blue w3-bar-block" style="width:15%;border: 5px solid white;">

<h3 class="w3-bar-item"><a href="/thyssenkrup/"><center>Home</center></a></h3> <br><br>
  <a href="/thyssenkrup/csvupload.php" class="w3-bar-item w3-button white">Create new Department and PRF</a> <br>
  <a href="/thyssenkrup/hrnew.php" class="w3-bar-item w3-button">Create New Instance</a> <br>
  <a href="/thyssenkrup/initiateround.php" class="w3-bar-item w3-button">Initiate rounds for instances</a> <br>
  <a href="/thyssenkrup/allocateround.php" class="w3-bar-item w3-button">On going rounds</a> <br>
  <a href="/thyssenkrup/history.php" class="w3-bar-item w3-button">See History  </a> <br>
  <a href="/thyssenkrup/allocateround2.php" class="w3-bar-item w3-button">Rescheduling</a> <br>
  <a href="/thyssenkrup/interview.php" class="w3-bar-item w3-button">Update Interviews</a> <br>
  <a href="/thyssenkrup/offerletter.php" class="w3-bar-item w3-button">Offer Letter</a> <br>

</div>
<div style="margin-left:15%">
  <!-- navbar -->

  <nav>
        <div class="nav-wrapper blue darken-1">
       
          <a href="#!" class="brand-logo center">thyssenkrupp</a>
          <div id="logoutuser" class="row">
    <button class="btn waves-effect blue darken-1" type="submit" name="action" style="float:right;margin-top: 18px;margin-right: 18px ">LOGOUT</button>
  </div>

        </div>
      </nav>
            
    <!-- navbar end -->
    <br><br>

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
                            <br><br><br>
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
    
</body>
</html>