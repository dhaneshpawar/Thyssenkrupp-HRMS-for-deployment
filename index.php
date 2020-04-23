<?php
error_reporting(0);

if(isset($_COOKIE['sid']))
{
  include 'api/db.php';
  $sid = $_COOKIE['sid'];
  $cursor = $db->session->findOne(array("sid" => $sid));
  
  if($cursor)
  {
    $cursor = $db->users->findOne(array("uid" => $cursor['uid']));
    $designation = $cursor['dsg']."dash";
    
    header("refresh:0;url=$designation.php");
  }
  else
  {
    header("refresh:0;url=notfound.html");
  }
}
else
{
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

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
    
    <div class="col m6 offset-m3" >
      
      <center>
        <div id="invalidlogin"></div>
      </center>
      
      <div class="card">
        
        <div class="card blue darken-1">
          <div class="card-content white-text">
            <span class="card-title center" style="font-weight: 500;"> Login</span>
          </div>
        </div>
        
        <div class="card-content white-text">
          
          <div class="row">
            
            <div class="input-field col s8 offset-s2 blue-text">
              <i class="material-icons prefix">account_circle</i>
              <input id="userid" type="text" class="validate" placeholder="User Id">
            </div>
            
            <div class="input-field col s8 offset-s2 blue-text">
              <i class="material-icons prefix">lock</i>
              <input id="pwd" type="password" class="validate" placeholder="Password">
            </div>
            
            <div class="input-field col s6 offset-s3 center">
              <button class="btn waves-effect waves-light blue darken-1" id="submit" name="action">Submit
                <i class="material-icons right">send</i>
              </button>
            </div>
          </div>
        </div>
    
      </div>
      
    </div>
  </div>
  
  <script>
  
  $('#submit').click(function()
  {
    var id = $('#userid').val();
    var pwd = $('#pwd').val();
    var data = {'uid':id,'pwd':pwd}
    
    console.log("This is captured data = ",data)
    $('#invalidlogin').empty()
    
    $.ajax(
      {
        url : 'http://localhost/thyssenkrup/api/login.php',
        type : 'POST',
        data : {"uid":id,"pwd":pwd},
        
        success : function(para)
        {
          
          var errtxt = '<p style="color: red">Invalid Login Details..!!</p>'
          console.log("This is the path to reditect = ",para)
          
          if(para != "404")
          {
            var result = "http://localhost/thyssenkrup/"+para+"dash.php"
            document.location.replace(result)
          }
          
          else
          {
            var errtxt = '<p style="color: red">Invalid Login Details..!!</p>'
            $('#invalidlogin').hide()
            $('#invalidlogin').append(errtxt)
            $('#invalidlogin').fadeIn(1000)
          }

        },
      }
    );
  });
</script>
</body>
</html>
<?php } ?>