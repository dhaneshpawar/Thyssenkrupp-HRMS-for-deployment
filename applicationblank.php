<?php
session_start();
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

    <script src="public/jquery-3.2.1.min.js"></script>

    <script src="public/js/materialize.js"></script>
    <script src="public/js/materialize.min.js"></script>
    

</head>
<style>
 input[type="file"] {
    display: none;
}
input[type="text"] {
  text-transform: uppercase;
} 

<?php

$position = $_GET['position'];
$_SESSION['positionapplied'] = $position;

?>


</style>
<body>


              <nav>
                    <div class="nav-wrapper blue darken-1">
                      <a href="#!" class="brand-logo center">thyssenkrupp</a>
                     </div>
                  </nav>
                  <br><br>

                <center><h1><p id="warn" style="color:green">Details Submitted Successfully</p></h5></center>
                  <div class="row">
                        
                        <div class="col s12 m6 offset-m3">
                          <div class="card white">
                            <div class="card-content blue-text darken-1" id="form">
                      
                         <form method="POST" enctype='multipart/form-data' action="http://localhost/thyssenkrup/api/submitapplication.php">
                                 

                                <!-- form starts -->
                                <center>

                                        <b style="font-size: 35px">Application Form</b><br><br>
                                        
                                </center> 
                                
                                <div class="row">
                                        <b style="font-size:20px;">Candidate Photo</b><br>
                                        
                                       
                                                        <img name="photo"  required id="image_upload_preview" src="" alt="your image" width="150" height="150"/>
                                       
                                </div>
                                <div class="row"> 
                                    
                                    <div class="input-field col s12" id="uphoto">
                                            <label class="custom-file-upload" id="prof">
                                               <a class="btn blue darken-1"> 
                                                       <input id="photo"  required  name='photo' type="file" accept=".png, .jpg, .jpeg"><p id='myfile0'>Upload File</p></a>
                                                       <div>                                                            
                                                    </div>
                                            </label>
                                        </div>
                                    </div><br><br>
                                
                                     
                                    <b style="font-size:20px;">Candidate CV</b>
                                        <div class="row">
                                                        <div class="input-field col s12" id="ucv">
                                                                <label class="custom-file-upload" id="cv">
                                                                        <a class="btn blue darken-1"> <input id="mycv" name="mycv"   required type="file" accept=".png, .jpg, .jpeg, .pdf, .docx"><p id='myfilecv'>Upload CV</p></a>
                                                                </label>
                                                        </div>
                                        </div>                                        
                                        <br><br>
                                      
                                          <div class="row">
                                                <div class="input-field col s6">
                                                        <input id="aadharno" name="aadharno" type="number" class="validate" required aria-required="true">
                                                        <label for="aadharno">Aadhar Card Number</label>
                                                        
                                                      </div> 
                                          </div>                                           

                                        <div class="row">

                                            <div class="input-field col s12">
                                              <input id="full_name" name="full_name" type="text" class="validate" required aria-required="true">
                                              <label for="full_name">Full Name</label>
                                            </div>
                                          </div>

                                          <div class="row">
                                            <div class="input-field col s12">
                                              <input   id="address" name="address" type="text" class="validate" required aria-required="true">
                                              <label for="address">Present Address</label>
                                              
                                            </div>
                                          </div>


                                          <div class="row">
                                            <div class="input-field col s12">
                                              <input id="unumber" maxlength="10" onchange="checkcont(this.id)" name="unumber" type="number" class="validate" required aria-required="true">
                                              <label for="unumber">Contact number</label>
                                            </div>
                                          </div>
                                          <div class="row">
                                            <div class="input-field col s6">
                                              <input id="uemail" name="uemail" type="email" class="validate" required aria-required="true">
                                              <label for="uemail">Email</label>
                                            </div>

                                            
                                            <div class="input-field col s6">
                                                <input id="udob" name="udob" type="text" class="datepicker" required aria-required="true">
                                                <label for="udob">Date Of Birth</label>
                                            </div>
                                                 
                                          </div>


                                          <div class="row">
                                                <div class="input-field col s6">
                                                  <input id="position" name="position" type="text" value="<?php echo $position ?>" style="color:black" class="validate" required disabled>
                                                  <label for="position">Position Applied For</label>
                                                </div>
    
                                                
                                                <div class="input-field col s6">
                                                    <input id="location" name="location" type="text" class="validate" required aria-required="true">
                                                    <label for="location">Location</label>
                                                </div>
                           
                                          </div>


                                          <div class="row">
                                            
                                                <div class="input-field col s12">
                                                  <input id="passport" name="passport" type="text" class="validate" required aria-required="true">
                                                  <label for="passport">Passport Availability/Validity</label>
                                                </div>
                                          </div>

                                          <b style="font-size:20px;">Academic professional Qualification</b>
                                          <div class="row">
                                                
                                                <div class="input-field col s6">
                                                        <input id="qualification" name="qualification" type="text" class="validate" required aria-required="true">
                                                        <label for="qualification">Highest Qualification</label>
                                                      </div>
          
                                                      
                                                      <div class="input-field col s6">
                                                          <input id="passing" name="passing" type="text" class="validate" required aria-required="true">
                                                          <label for="passing">Passing Year</label>
                                                      </div>
                                                </div>
                                                <div class="row">
                                                               
                                                      <div class="col s12">
                                                                <b style="color: red;">Please Upload all Documents until Highest Qualification</b>
                                                                        <label class="custom-file-upload">
                    
                                                                                        <br><br>
                                                                           <a class="btn blue darken-1"> <input id="alldocs" name="alldocs" type="file"  required accept=".png, .jpg, .jpeg, .pdf, .docx"> <p id='mydocs'> Upload Document</p></a>
                                                                        </label>
                                                                    
                                                        </div>
                                                </div>

                                                      


                                                      
                                          

                                          <b style="font-size:20px;">Professional Experience (Mention Company Name And Designation)</b>
                                          <br>
                                          <b style="font-size:20px;color:red">If you are Experienced,hit the below button...!</b>
                                          <div class="row">
                                                
                                                <div class="input-field col s12">
                                                        <a class="btn blue darken-1" id='myexperience'>Add Experience</a>
                                                        <!--<input id="experience" type="text" >
                                                        <label for="experience">Professional Experience</label>-->
                                                </div>
                                                <div class=" col s12" id="mainexpdiv">
                                                  <div class="col s12" id="myexpdiv">
                                                          
                                                        <div class="input-field col s6">
                                                                <input id="orgname0" name="orgname0[]" type="text" class="validate"  aria-required="true">
                                                                <label for="orgname0" style="font-size: 11px">Current Organization Name</label>
                                                        </div>
                                  
                                                                              
                                                        <div class="input-field col s6">
                                                                <input id="olddesignation0" name="olddesignation0[]" type="text"class="validate"  aria-required="true" >
                                                                <label for="olddesignation0" style="font-size: 11px">Designation</label>
                                                        </div>
                                                        
                                                        <div class="input-field col s6">
                                                                <input id="fromdate0" name="fromdate0[]" type="text" class="datepicker">
                                                                <label for="fromdate0" style="font-size: 11px">From</label>
                                                        </div>

                                                        <div class="input-field col s6">
                                                                <input id="todate0" name="todate0[]" type="text" class="datepicker">
                                                                <label for="todate0" style="font-size: 11px">To</label>
                                                        </div> 

                                                        <div class="input-field col s6">
                                                                <input id="managername0" name="managername0[]" type="text" class="validate"  aria-required="true">
                                                                <label for="managername0" style="font-size: 11px">Reporting Manager Name</label>
                                                        </div> 
                                                              
                                                        <div class="input-field col s6">
                                                                <input id="managermail0" name="managermail0[]" type="email" class="validate"  aria-required="true">
                                                                <label for="managermail0" style="font-size: 11px">Enter Manager Email</label>
                                                        </div> 
                                                        <div class="row" id="addnextexp"x>
                                                                <a class="btn-floating btn" onclick="addnewexp(this)"><i class="material-icons">add</i></a>                                                    
                                                        </div>
                                                                                                                        
                                                  </div>
                                                </div>
          
                                                   
                                          </div>

                                          <b style="font-size:20px;">Referral Sources</b>
                                          <br><br>                        
                                           <div class="row">
                                            
                                                <label class="col s12">
                                                        <input type="checkbox" id="internet" name="internet" class="filled-in">
                                                        <span>Internet (Job Boards)</span>
                                                </label><br>

                                                <label class="col s12">
                                                        <input type="checkbox" id="empref" name="empref" class="filled-in">
                                                        <span>Employee Referel</span>
                                                </label><br>

                                                <label class="col s12">
                                                        <input type="checkbox" id="walkin" name="walkin" class="filled-in">
                                                        <span>Walk-In (Factory Gate)</span>
                                                </label><br>

                                                <label class="col s12">
                                                         <input type="checkbox" id="website" name="website" class="filled-in">
                                                        <span>Company Website</span>
                                                </label><br>

                                                <label class="col s12">
                                                        <input type="checkbox" id="other" name="other" class="filled-in">
                                                        <span>Other</span>
                                                        <input placeholder="Enter Specific Details" id="otherdetails" name="otherdetails" type="text" class="validate">                                                        
                                                </label>
                                                
                                            
                                                   
                                          </div>



                                          <div class="row">
                                                <div class="input-field col s6">
                                                  <input id="jdate" name="jdate" type="text"  required>
                                                  <label for="jdate" style="font-size: 11px">If Selected, how soon you can join us?</label>
                                                </div>
    
                                                
                                                <div class="input-field col s6">
                                                    <input id="notice" name="notice" type="text"  required>
                                                    <label for="notice" style="font-size: 11px">Notice Period In Current Oraganization</label>
                                                </div>

                                                
                                                <div class="input-field col s6" >
                                                        <input id="manager" name="manager" type="text"  required>
                                                        <label for="manager" style="font-size: 11px">Reporting Manager Name & Designation</label>
                                                </div>

                                                <div class="input-field col s6" >
                                                        <input id="ifselectposition" name="ifselectposition" type="text"  required>
                                                        <label for="ifselectposition" style="font-size: 11px">Current Position</label>
                                                </div>

                                                

                                             
                           
                                          </div>


                                          
                                          <b style="font-size:20px;">Upload your Aadhar Card as Proof Of Identity</b>
                                          <div class="row">
                                                <!-- <div class="input-field col s12">
                                                        <a class="btn green" id="yesforaadhar">YES</a>                                                                                                               
                                                        <a class="btn red" id="noforaadhar">NO</a>
                                                </div> -->
                                                                                        
                                                <div class="input-field col s12" id="showaddharupload">
                                                                <label class="custom-file-upload">
                                                                        <a class="btn blue darken-1"><input  id="proof_identity_addhar" name="proof_identity_addhar" type="file" accept=".png, .jpg, .jpeg, .pdf, .docx" required><p id='myfile_adhar'>Upload Aadhar Card </p></a>
                                                                </label>
                                                </div>
                                        </div><br>
                                         <div id="uploadotherdoc">
                                                        <b>Proof Of Identity(PAN/Voter ID/Driving Licence/Passport)</b>


                                                        <div class="row">
                                                                <div class="input-field col s12" >
                                                                                  <label class="custom-file-upload">
                                                                                           <a class="btn blue darken-1"> <input id="proof_otherthanadhar" name="proof_otherthanadhar" type="file" accept=".png, .jpg, .jpeg, .pdf, .docx"> <p id='myfile1'> Upload file </p></a>
                                                                                  </label>
                                                                              </div>
                                                              </div><br>                                                        
                                         </div>
                                         
                                            

                                            <b style="font-size:20px;">Proof Of Address(Rent Agreement/Voter ID/Driving Licence/Passport)</b>
                                                
                                          <div class="row">

                                                <div class="input-field col s12" >
                                                    <label class="custom-file-upload">

                                                    
                                                       <a class="btn blue darken-1"> <input id="proof_address" name="proof_address"   required type="file" accept=".png, .jpg, .jpeg, .pdf, .docx"> <p id='myfile2'> Upload file </p></a>
                                                    </label>
                                                </div>
                                          </div>

                                          <br><br>

                                            <b style="font-size:20px;">Family Details :</b>
                                                
                                          <div class="row">

                                                
                                            <div class="input-field col s6">
                                                    <input id="father" name="father" type="text">
                                                    <label for="father">Father Name</label>
                                            </div>

                                            
                                            <div class="input-field col s6">
                                                    <input id="fdob" name="fdob" type="text" class="datepicker"  >
                                                    <label for="fdob">DOB</label>
                                            </div>


                                            
                                            <div class="input-field col s6">
                                                    <input id="mother" name="mother" type="text">
                                                    <label for="mother">Mother Name</label>
                                            </div>

                                            
                                            <div class="input-field col s6">
                                                    <input id="mdob" name="mdob" type="text" class="datepicker" >
                                                    <label for="mdob">DOB</label>
                                            </div>


                                            
                                            <div class="input-field col s6">
                                                    <input id="spouse" name="spouse" type="text">
                                                    <label for="spouse">Spouse Name</label>
                                            </div>

                                            
                                            <div class="input-field col s3">
                                                    <input id="spdob" name="spdob" type="text" class="datepicker" >
                                                    <label for="spdob">DOB</label>
                                            </div>
                                            
                                            <div class="col s3 ">
                                                <br>
                                                    <select id='sgender' name='sgender' class="dropdown-trigger btn blue darken-1" >
                                                        <option value="" disabled selected style="color: white">Gender</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                        <option value="Other">Other</option>
                                                      </select>
                                                      <br><br>
                                                </div>   
                                  

                                            
                                            <div class="input-field col s6">
                                                    <input id="child1" name="child1" type="text">
                                                    <label for="child1">Child1 Name</label>
                                            </div>

                                            
                                            <div class="input-field col s3">
                                                    <input id="c1dob" name="c1dob" type="text" class="datepicker" >
                                                    <label for="c1dob">DOB</label>
                                            </div>
                                            <div class="col s3 ">
                                                    <br>
                                                        <select id='c1gender' name='c1gender' class="dropdown-trigger btn blue darken-1" >
                                                            <option value="" disabled selected style="color: white">Gender</option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                            <option value="Other">Other</option>
                                                          </select>
                                                          <br><br>
                                                    </div> 


                                            
                                            <div class="input-field col s6">
                                                    <input id="child2" name="child2" type="text">
                                                    <label for="child2">Child2 Name</label>
                                            </div>

                                            
                                            <div class="input-field col s3">
                                                    <input id="c2dob" name="c2dob" type="text" class="datepicker" >
                                                    <label for="c2dob">DOB</label>
                                            </div>

                                            
                                            <div class="col s3 ">
                                                    <br>
                                                        <select id='c2gender' name='c2gender' class="dropdown-trigger btn blue darken-1" >
                                                            <option value="" disabled selected style="color: white">Gender</option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                            <option value="Other">Other</option>
                                                          </select>
                                                          <br><br>
                                                    </div> 



                                          </div>
                                          <b style="font-size:20px;">Remuneration Details:</b>
                                          <div class="row">

                                                <div class="input-field col s6">
                                                        <input id="monthhome" name="monthhome" type="text" disabled value="Annual Gross(CTC)" style="color: black">
                                                        
                                                </div>
    
                                                
                                                <div class="input-field col s3">
                                                        <input id="homepresent" name="homepresent" type="number" >
                                                        <label for="homepresent">Present</label>
                                                </div>
                                                
                                                <div class="input-field col s3">
                                                        <input id="homeexp" name="homeexp" type="number">
                                                        <label for="homeexp">Expected</label>
                                                </div>
                                                
                                                
                                                <div class="input-field col s6">
                                                        <input id="monthgross" type="text" disabled value="Monthly Gross(CTC)" style="color: black">
                                                        
                                                </div>
    
                                                
                                                <div class="input-field col s3">
                                                        <input id="grosspresent" name="grosspresent" type="number">
                                                        <label for="grosspresent">Present</label>
                                                </div>
                                                
                                                
                                                <div class="input-field col s3">
                                                        <input id="grossexp" name="grossexp" type="number">
                                                        <label for="grossexp">Expected</label>
                                                </div>
                                                


                                                
                                                <div class="input-field col s6">
                                                        <input id="ypresent" type="text" disabled value="Monthly Take Home" style="color: black">
                                                        
                                                </div>
    
                                                
                                                <div class="input-field col s3">
                                                        <input id="yearpresent" name="yearpresent" type="number">
                                                        <label for="yearpresent">Present</label>
                                                </div>
                                                
                                                <div class="input-field col s3">
                                                        <input id="yearexp" name="yearexp" type="number">
                                                        <label for="yearexp">Expected</label>
                                                </div>
    
                                          </div>


                                         
                                          <b style="font-size:20px;">References :</b>
                                          <div class="row" id="mainref">
                                                  <div id="ref" class="col">

                                                <div class="input-field col s6">
                                                        <input id="refname" type="text" disabled value="Name" style="color: black">
                                                        
                                                </div>
    
                                                
                                                <div class="input-field col s6">
                                                        <input id="nameref0" name="nameref0[]" type="text">
                                                        <label for="nameref0">Reference</label>
                                                </div>
                                                
                                                
                                                
                                                
                                                <div class="input-field col s6">
                                                        <input id="dsgref" type="text" disabled value="Designation" style="color: black">
                                                        
                                                </div>
    
                                                
                                                <div class="input-field col s6">
                                                        <input id="designationref0" name="designationref0[]" type="text">
                                                        <label for="designationref0">Reference</label>
                                                </div>
                                                
                                               
                                                
                                                <div class="input-field col s6">
                                                        <input id="cnameref" type="text" disabled value="Company Name" style="color: black">
                                                        
                                                </div>
    
                                                
                                                <div class="input-field col s6">
                                                        <input id="cmpnmref0" name="cmpnmref0[]" type="text">
                                                        <label for="cmpnmref0">Reference </label>
                                                </div>
                                                
                                               


                                                
                                                <div class="input-field col s6">
                                                        <input id="cnoref" type="text" disabled value="Contact Number" style="color: black">
                                                        
                                                </div>
    
                                                
                                                <div class="input-field col s6">
                                                        <input id="contref0" name="contref0[]" type="number" class="validate" onchange="changecont(this.id)"required aria-required="true"/>
                                                        <label for="contref0">Reference</label>
                                                </div>
                                                
                                                

                                                <div class="input-field col s6">
                                                         <input id="emailref" type="email" disabled value="Email" style="color: black">
                                                </div>

                                                <div class="input-field col s6">
                                                        <input id="mailref0" name="mailref0[]" type="email" class="validate" required aria-required="true">
                                                        <label for="mailref0">Reference</label>
                                                </div>

                                                <div class="col s6" id="addnextref">
                                                        <a class="btn-floating btn" onclick="addnewref(this)"><i class="material-icons">add</i></a>                                                    
                                                </div>
                                        </div>
                                        </div>

                                              
        

                                                
         
                                            
                                <div class="row">
                                        <div class=" col s6 offset-s3 center" id="submitform">
                                        
                                              <button class="btn blue darken-2" type="submit" id="submitformdata" name="action" >Submit
                                                <i class="material-icons right">send</i>
                                              </button>
                                        </div>                                    
                                </div>   


                                <!-- form end -->







                        </form>

                        </div>
                           
                          </div>
                        </div>
                      </div>
                
        
                         
<?php

$_SESSION['token'] = $_GET['token'];
?>
                        
<script>
var expctr=0        
var ctr=0
var ctr2=0

function checkcont(x)
{
        var id="#"+x;
        var phone=$(id).val();
        console.log(id)
        console.log(phone)

        if(phone.length!=10)
        {
                alert("Enter Valid Contact Details")
                $(id).val(" ")
        }
       

}
function addnewexp(x)
{
        expctr = expctr+1
        //var str = 'myexpdiv'+ctr
       
        var txt='<div class="col s12" id="myexpdiv"><div class="input-field col s6"><input name="orgname0[]" id="orgname'+expctr+'" type="text" class="validate"   aria-required="true"><label for="orgname'+expctr+'" style="font-size: 11px">Current Organization Name</label></div><div class="input-field col s6"><input name="olddesignation0[]" id="olddesignation'+expctr+'" type="text" class="validate"   aria-required="true"><label for="olddesignation'+expctr+'" style="font-size: 11px">Designation</label></div><div class="input-field col s6"><input name="fromdate0[]" id="fromdate'+expctr+'" type="text" class="datepicker" ><label for="fromdate'+expctr+'" style="font-size: 11px;">From</label></div><div class="input-field col s6"><input name="todate0[]" id="todate'+expctr+'" type="text" class="datepicker"><label for="todate'+expctr+'" style="font-size: 11px;">To</label></div><div class="input-field col s6"><input name="managername0[]" id="managername'+expctr+'" type="text" class="validate"   aria-required="true"><label for="managername'+expctr+'" style="font-size: 11px">Reporting Manager Name</label></div><div class="input-field col s6"><input name="managermail0[]" id="managermail'+expctr+'" type="email" class="validate"   aria-required="true"><label for="managermail'+expctr+'" style="font-size: 11px">Enter Manager Email</label></div><div class="row" id="addnextexp"><a class="btn-floating btn" onclick="addnewexp(this)"><i class="material-icons">add</i></a></div></div>'
        $("#mainexpdiv").append(txt);
        $('.datepicker').datepicker({
                        //dateFormat:"dd/mm/yy",
                        yearRange:[1960,2019],
                        changeMonth:true,
                        
                        //changeYear:true
               
        });            

}

function addnewref(x)
{

        ctr2 = ctr2+1
        var txt='<div id="ref" class="col"><div class="input-field col s6"><input id="child2" type="text" disabled value="Name" style="color: black"></div><div class="input-field col s6"><input name="nameref0[]" id="nameref'+ctr2+'" type="text"><label for="nameref'+ctr2+'">Reference</label></div><div class="input-field col s6"><input id="child2" type="text" disabled value="Designation" style="color: black"></div><div class="input-field col s6"><input name="designationref0[]" id="designationref'+ctr2+'" type="text"><label for="designationref'+ctr2+'">Reference</label></div><div class="input-field col s6"> <input id="child2" type="text" disabled value="Company Name" style="color: black"></div><div class="input-field col s6"><input name="cmpnmref0[]" id="cmpnmref'+ctr2+'" type="text"><label for="cpmnmref'+ctr2+'">Reference </label></div><div class="input-field col s6"><input id="child2" type="text" disabled value="Contact Number" style="color: black"></div><div class="input-field col s6"><input name="contref0[]" id="contref'+ctr2+'" type="number"><label for="contref'+ctr2+'">Reference</label></div><div class="input-field col s6"><input id="child2" type="text" disabled value="Email" style="color: black"></div><div class="input-field col s6"><input name="mailref0[]" id="mailref'+ctr2+'" type="email"><label for="mailref'+ctr2+'">Reference</label></div><div class="col s6" id="addnextref"><a class="btn-floating btn" onclick="addnewref(this)"><i class="material-icons">add</i></a></div></div>'
        $("#mainref").append(txt);
}



$("#image_upload_preview").hide()
$("#myexpdiv").hide();
$("#otherdetails").hide();
//$("#uploadotherdoc").hide();
//$("#showaddharupload").hide();
//$("#myphoto").hide();


$(document).ready(function(){
        $('#warn').hide()
        function getUrlVars() {
            var vars = {};
            var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
                vars[key] = value;
            });
            return vars;
        }
        var token = getUrlVars()["token"];
        var data={"token":token};
       // console.log(token);
        $.ajax({
                                            url : 'http://localhost/thyssenkrup/api/checkExpiry.php',
                                            type : 'POST',
                                            data :(data),          
                                             success : function(para){
                                           
                                             if(para == "expired")
                                             {
                                               console.log("Expired Page");
                                                $('#form').hide()
                                                $('#warn').show()
                                           
                                             }
                                             else if(para=='success')
                                             {
                                                console.log("You are welcome");
                                             
                                             }
                                             },
                                            error : function(err){        
                                            }
                 });
               
        

        $('.datepicker').datepicker({
                        //dateFormat:"dd/mm/yy",
                        yearRange:[1919,2019],
                        changeMonth:true,
                        
                        //changeYear:true
               
        });            

        $('.filled-in').on('change', function() {
		    $('.filled-in').not(this).prop('checked', false);  

	});    
               

        $("#other").change(function(){
        if(this.checked)
        {
                $("#otherdetails").fadeIn("slow")
        }
        else
        {
                $("#otherdetails").fadeOut("slow")
        }
})
});




$("#yesforaadhar").click(function(){
        $("#uploadotherdoc").fadeOut("slow");
        $("#showaddharupload").fadeIn("slow");
})

$("#noforaadhar").click(function(){
        $("#showaddharupload").fadeOut("slow");
        $("#uploadotherdoc").fadeIn("slow");
})



$("#myexperience").click(function(){
        $("#myexpdiv").fadeIn(300);
        
})


$("#addnextexp").click(function(){
        $("#myexpdiv").fadeIn(300);
})


$('#alphaaddh').hide();
$('#12addh').hide();
$( "#aadharno" ).change(function() {
  
        var addharnumber=$('#aadharno').val();
        //alert(addharnumber)
        if(addharnumber.length != 12)
        {
                alert("Please Enter 12 Digits of Aadhar");
                $('#aadharno').val(" ")

                
        }
        else if(addharnumber>="a" && addharnumber<="z")
        {
                alert("Please Enter Valid Aadhar Details");
                $('#aadharno').val(" ")

        }
       else if(addharnumber>="A" && addharnumber<="Z")
        {
                alert("Please Enter Valid Aadhar Details");
                $('#aadharno').val(" ")

        }

});




        
        
        // if(addaharnumber.length<12)
        // {
        //         alert('Invalid')
        // }
        





$('#proof_identity_addhar').change(function(){
      var f = $('#proof_identity_addhar').val().split('.')
      var x=f[1]
      if(x=='pdf'||x=='jpeg'||x=='png'||x=='jpg')
      {
        var f = $('#proof_identity_addhar').val()
      
      $('#myfile_adhar').text(f)
      }
      else
      {
        alert('Invalid File\n Only PDF/IMAGES accepted')
        
      }
        
})
$('#proof_otherthanadhar').change(function(){
      var f = $('#proof_otherthanadhar').val().split('.')
      var x=f[1]
      if(x=='pdf'||x=='jpeg'||x=='png'||x=='jpg')
      {
        var f = $('#proof_otherthanadhar').val()
      
      $('#myfile1').text(f)
      }
      else
      {
        alert('Invalid File\n Only PDF/IMAGES accepted')
        
      }
        
})


$('#proof_address').change(function(){
      var f = $('#proof_address').val().split('.')
      var x=f[1]
      if(x=='pdf'||x=='jpeg'||x=='png'||x=='jpg')
      {
        var f = $('#proof_address').val()
      
      $('#myfile2').text(f)
      }
      else
      {
        alert('Invalid File\n Only PDF/IMAGE accepted')
        
      }
})
$('#alldocs').change(function(){
      var f = $('#alldocs').val().split('.')
      var x=f[1]
      if(x=='pdf')
      {
        var f = $('#alldocs').val()
      
      $('#mydocs').text(f)
      }
      else
      {
        alert('Invalid File\n Only PDF accepted')
        
      }
        
})


$('#photo').change(function(){
        
        
   var f=$('#photo').val().split('.')
   var x=f[1]
   if(x=='jpeg'||x=='png'||x=='jpg')
   {
        $('#myfile0').replaceWith($('#photo').val())
        
            if (this.files && this.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#image_upload_preview').attr('src', e.target.result);
                    
                };

                reader.readAsDataURL(this.files[0]);
            }
        
        $("#image_upload_preview").slideDown("slow");
   }
   else
   {
        alert('Invalid File \n Only IMAGE accepted')
   }
   
  
})
$('#mycv').change(function(){ 
        var f =$('#mycv').val().split('.')
        var x=f[1]
        if(x=='pdf')
        {         
                f =$('#mycv').val()
        $('#myfilecv').text(f)
        }
        else
        {
        alert('Invalid File \n Only PDF accepted')
                
        }
        
})



</script>
</body>
</html>