<?php
error_reporting(0);

if(isset($_COOKIE['sid']))
{
  include 'api/db.php';

  $countPrfs = $db->prfs->count();
  $countHistory = $db->prfs->count(array("status"=>"completed"));
  $countInstances = $db->prfs->count(array("status"=>"open"));

  $countInitiate = $db->rounds->count(array("status"=>"bstart"));
  $countOngoing = $db->rounds->count(array("status"=>"invcomplete"));
  $countSchedule = $db->interviews->count(array("invstatus"=>"1"));
  $countInterviews = $db->interviews->count(array("status"=>"0"));
  $countOffers = $db->intereval->count(array("offerletter"=>"requested"));





  
  
  $cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
  
  if($cursor)
  {
    $cursor = $db->users->findOne(array("uid" => $cursor['uid']));
    $designation = $cursor['dsg'];
    
    if($designation == "hr" || $designation == "ceo" || $designation == "hod" || $designation == "rghead" )
    {
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    
        <link rel="stylesheet" type="text/css" media="screen" href="public/css/materialize.css">
        <link rel="stylesheet" type="text/css" media="screen" href="public/css/materialize.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        
        <!-- for sidenav -->
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

        <script src="public/jquery-3.2.1.min.js"></script>
    
        <script src="public/js/materialize.js"></script>
        <script src="public/js/materialize.min.js"></script>
    
    </head>
    <style>
    .button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
}</style>

<body>
<div class="w3-sidebar blue w3-bar-block" style="width:15%;border: 5px solid white;">

  <h3 class="w3-bar-item white"><a href="/thyssenkrup/"><center>Home</center></a></h3> <br><br>
  <a href="/thyssenkrup/csvupload.php" class="w3-bar-item w3-button">Create new Department and PRF</a> <br>
  <a href="/thyssenkrup/hrnew.php" class="w3-bar-item w3-button">Create New Instance</a> <br>
  <a href="/thyssenkrup/initiateround.php" class="w3-bar-item w3-button">Initiate rounds for instances</a> <br>
  <a href="/thyssenkrup/allocateround.php" class="w3-bar-item w3-button">On going rounds</a> <br>
  <a href="/thyssenkrup/history.php" class="w3-bar-item w3-button">See History  </a> <br>
  <a href="/thyssenkrup/allocateround2.php" class="w3-bar-item w3-button">Rescheduling</a> <br>
  <a href="/thyssenkrup/interview.php" class="w3-bar-item w3-button">Update Interviews</a> <br>
  <a href="/thyssenkrup/offerletter.php" class="w3-bar-item w3-button">Offer Letter</a> <br>

</div>
<div style="margin-left:15%">

    <nav>
        <div class="nav-wrapper blue darken-1">
       
          <a href="#!" class="brand-logo center">thyssenkrupp</a>
          <div id="logoutuser" class="row">
    <button class="btn waves-effect blue darken-1" type="submit" name="action" style="float:right;margin-top: 18px;margin-right: 18px ">LOGOUT</button>
  </div>

        </div>
      </nav>
      <br>
    <center>
<!-- <button class="button">You Are Logged In As HR Of  <?php echo $cursor['rg']; ?> Region and Department Of <?php echo $cursor['dept']; ?> </button> -->
</center>



        <!-- main card starts here -->
                    <div class="row" id="attr">
                        <div class="col s12 m12 ">
                          <!-- <div class="card white"> -->
                            <div class="card-content blue-text">
                                
                                    <div class="row" id="cardsradius">
                                        <a href="/thyssenkrup/csvupload.php">
                                            <div class="col  m6 s6">
                                              <div class="card " style="background: #536DFE">
                                                <div class="card-content white-text">
                                                  <span class="card-title">Upload PRF Dump</span>
                                                  <br>Total PRFs : <?php echo $countPrfs; ?><p></p>
                                                </div>
                                                
                                              </div>
                                            </div>
                                        </a>

                                        <a href="/thyssenkrup/hrnew.php">

                                            <div class="col  m6 s6">
                                              <div class="card " style="background: #EA5455;">
                                                <div class="card-content white-text">
                                                  <span class="card-title">Open PRFs</span>
                                                  <br> Open PRFs : <?php echo $countInstances; ?> <p></p>
                                                </div>

                                                
                                                
                                              </div>
                                            </div>

                                        </a> 
                                        </div>
                                        <div class="row" id="cardsradius">
                                        <a href="/thyssenkrup/initiateround.php">
                                            <div class="col  m6 s6">
                                              <div class="card " style="background: #28C76F;">
                                                <div class="card-content white-text">
                                                  <span class="card-title">Round Initiation</span>
                                                  <br> PRFs to be Initiated : <?php echo $countInitiate; ?>
                                                </div>
                                                
                                              </div>
                                            </div>
                                        </a>
                                       
                                        <a href="/thyssenkrup/allocateround.php">

                                            <div class="col  m6 s6">
                                              <div class="card " style="background: #9F44D3;">
                                                <div class="card-content white-text">
                                                  <span class="card-title">Ongoing Rounds  </span>
                                                  <br> Total Ongoing PRFs : <?php echo $countOngoing; ?><p></p>
                                                </div>
                                              </div>
                                            </div>
                                        </a>

                                        <a href="/thyssenkrup/history.php">

                                            <div class="col  m6 s6">
                                              <div class="card " style="background: #9F44D3;">
                                                <div class="card-content white-text">
                                                  <span class="card-title">History  </span>
                                                  <br> Completed PRFs : <?php echo $countHistory; ?><p></p>
                                                </div>
                                              </div>
                                            </div>
                                        </a>

                                        <a href="/thyssenkrup/allocateround2.php">

                                            <div class="col  m6 s6">
                                              <div class="card " style="background: #28C76F; ">
                                                <div class="card-content white-text">
                                                  <span class="card-title">Rescheduling  </span>
                                                  <br> Interviews to be Resheduled : <?php echo $countSchedule; ?><p></p>
                                                </div>
                                              </div>
                                            </div>
                                        </a>

                                        <a href="/thyssenkrup/interview.php">

                                            <div class="col  m6 s6">
                                              <div class="card " style="background: #677E8C">
                                                <div class="card-content white-text">
                                                  <span class="card-title">Interview Updation  </span>
                                                  <br> Total Scheduled Interviews : <?php echo $countInterviews; ?><p></p>
                                                </div>
                                              </div>
                                            </div>
                                        </a>

                                        <a href="/thyssenkrup/offerletter.php">

                                            <div class="col  m6 s6">
                                              <div class="card " style="background: #EA5455; ">
                                                <div class="card-content white-text">
                                                  <span class="card-title">Offer Letters  </span>
                                                  <br> Offer Letter Requests : <?php echo $countOffers; ?><p></p>
                                                <!-- </div> -->
                                              </div>
                                            </div>
                                        </a>

                                              
                                         
                                           

                                        
                  
                                    
                                            
                          </div>
                          </div>
                          </div>
                          </div>
                          </div>

                         
        </div>
                         
                    
                        
                
            
                
            
            
            
            
            
            
      
    <!-- main card ends here -->

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
