<?php
error_reporting(0);

if(isset($_COOKIE['sid']))
{
  include 'api/db.php';
  
  $cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
  
  if($cursor)
  {
    $cursor = $db->users->findOne(array("uid" => $cursor['uid']));
    $designation = $cursor['dsg'];
    
    if($designation == "hr" || $designation == "ceo" || $designation == "hod" || $designation == "rghead" )
    {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" type="text/css" media="screen" href="./public/css/materialize.css">
    <link rel="stylesheet" type="text/css" media="screen" href="./public/css/materialize.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <script src="./public/jquery-3.2.1.min.js"></script>

    <script src="./public/js/materialize.js"></script>
    <script src="./public/js/materialize.min.js"></script>

</head>
<body>


    <nav>
    <div class="nav-wrapper blue darken-1">
    <a href="/thyssenkrup/">
      <button class="btn waves-effect blue darken-1" style="float:left;margin-top: 18px;margin-right: 18px "> <- BACK</button>
      </a> 
    <a href="#!" class="brand-logo center">thyssenkrupp</a>
    <div id="logoutuser" class="row">
    <button class="btn waves-effect blue darken-1" type="submit" name="action" style="float:right;margin-top: 18px;margin-right: 18px ">LOGOUT</button>
  </div>
    </div>
    </nav>
    <br><br>
    <a class="waves-effect waves-light btn right" id="exp" onclick="location.href='excel/excel1.php'">Export To Excel</a>

    <div class="row">
    <div class="col s12 m12 ">
    <div class="">
    <div class="card-content blue-text">
    <b id="prfno">PRF Number : </b>
    <br><br>

    <div class="card  col m12 s12">
    <br>
    <div class="col m2">

    <select id='deptchoice' class="dropdown-trigger btn blue darken-1" >
    <option value="" disabled selected style="color: white">Select Instance</option>
    <!-- <option value="Instance A">Instance A</option>
    <option value="Instance B">Instance B</option>
    <option value="Instance C">Instance C</option> -->
    </select>
    <br><br>

    <select id='roundchoice' class="dropdown-trigger btn blue darken-1" >
    <option value="" disabled selected style="color: white">Select Round</option>

    </select>

    <br><br><br><br>

    </div>
    </div>




    <div id="mytabs" >

    <ul class="tabs" >
    <li id="select"  class="tab col s3">  <a> <b style="color: green;cursor: pointer;" >Selected</b></a></li>
    <li id="reject" class="tab col s3"><a ><b style="color: red;cursor: pointer;" >Rejected</b></a></li>

    <li id="hld" class="tab col s3"><a ><b style="color: orangered;cursor: pointer;" >Hold</b></a></li>

    </ul>

    <div class="row" id="selected">
    <div class="col s12 ">
    <div class="card white">
    <div class="card-content ">

    <table class="striped">
      <thead >
        <tr>
            
            <th>EMAIL ID</th>
            
        </tr>
      </thead>

      <tbody id="tabledataselect">
        
      </tbody>
    </table>
    </div>
    </div>
    </div>

    </div>

    </div>
    <div class="row" id="rejected">
    <div class="col s12 ">
    <div class="card white">
    <div class="card-content ">

    <table class="striped">
      <thead>
        <tr>
            <th>Email ID</th>
            
        </tr>
      </thead>

      <tbody id="tabledatareject">
        
      </tbody>
    </table>
    </div>
    </div>
    </div>

    </div>


    <div class="row" id="hold">
    <div class="col s12 ">
    <div class="card white">
    <div class="card-content">

    <table class="striped">
    <thead>
    <tr>
    <th>Email ID</th>
   
    </tr>
    </thead>

    <tbody id="tabledatahold">
    <th>Email ID</th>
    
    </tbody>
    </table>
    </div>
    </div>
    </div>

    </div>




    </div>
    </div>
















  <script>
    
    var instancech;
    var roundch;

    var dept = localStorage.getItem("dept");
    var prf = localStorage.getItem("prf");
    var pos = localStorage.getItem("pos");
    
    

//get docs
function dispdoc(para)
{
alert(para)
document.location.replace('/showdocs.php')
}


  $(document).ready(function(){

    $('#prfno').append(" "+prf+" - "+pos)


    console.log(dept)
    $.ajax({
      url:'http://localhost/thyssenkrup/api/getinstances.php',
      type:'POST',
      data:{'dept':dept,'prf':prf,'pos':pos},
      success:function(para)
      {
        // alert(para)
        // aler(member)
        if(!para)
        {
          console.log("Sorry")
        }
        console.log(para);
       
        //para=['one','two','three']
        para = JSON.parse(para)
        iid = para["iid"]
        selected_members = para["selected"]
        console.log(selected_members)
        
        var norepet = []
        for(let i=0;i<iid.length;i++)
        {
          if(norepet.indexOf(String(iid[i])) == -1)
          {
            var str = '<option>'+iid[i]+'</option>'
          $('#deptchoice').append(str)
          norepet.push(String(iid[i]))
          }
          else
          {
            console.log("you are just repeating instaces")
          }
        }

        for(let i = 0;i<selected_members.length;i++)
          {
            var str2 = "<tr><td><a href='http://localhost/thyssenkrup/documentcheck.php?aid="+selected_members[i]+"' target='_blank'>"+selected_members[i]+"</a></td></tr>"
            $("#tabledataselect").append(str2)
          }
          
        
        
      }
    })
      $('#rejected').hide()
      $('#hold').hide()
      // $('#mytabs').hide()

    $('.tabs').tabs();
   $('#roundchoice').hide();    
    $('#deptchoice').change(function(){
      var instance = $('#deptchoice').val()
      $('#tabledataselect').text("")
     $.ajax({
      url:'http://localhost/thyssenkrup/api/getrounds.php',
      type:'POST',
      data:{'dept':dept,'prf':prf,'iid':instance,"pos":pos},
      success: function(para)
      {
        para = JSON.parse(para);        
        var rid = para["rid"]
        var selected_members = para["selected"]
        
        if(para == "fail")
        {
          console.log("Not found")
        }
        else
        {
          console.log(para)
          $('#roundchoice').show(); 
          $('#roundchoice').find('option').remove()
          var label =' <option value="" disabled selected style="color: white">Select Round</option>'
            $('#roundchoice').append(label)  
          
          //para=['one','two','three']
        
          for(let i=0;i<rid.length;i++)
          {
            var str = '<option>'+rid[i]+'</option>'
            $('#roundchoice').append(str)
          }

          for(let i = 0;i<selected_members.length;i++)
          {
            var str2 = '<tr><td><a href="http://localhost/thyssenkrup/documentcheck.php?aid='+selected_members[i]+'" target="_blank" ">'+selected_members[i]+'</a></td></tr>'
            $("#tabledataselect").append(str2)
          }
        }
        
        
      }
    })
     
    })
   

    $('#select').click(function(){
        $('#rejected').hide()
        $('#hold').hide()

      $('#selected').show()
  
    })



    
    $('#reject').click(function(){
        
      $('#hold').hide()

      $('#selected').hide()
      $('#rejected').show()
  
    })
    


    
    $('#hld').click(function(){
        $('#rejected').hide()
     

      $('#selected').hide()
      $('#hold').show()
  
    })

    $('#deptchoice').change(function(){
      instancech=$("#deptchoice").val()

    })

    var flag0 = 0
    $('#roundchoice').change(function(){
      roundid = $("#roundchoice").val()
      console.log(roundid)
      $('#tabledataselect').empty()

      $.ajax({

              url : 'http://localhost/thyssenkrup/api/getselected.php',
              type : 'POST',
              data : {'dept':dept,'prf':prf,"pos":pos,'iid':$("#deptchoice").val(),'rid':roundid},

              success:function(para)
              {
                
                $("#select").click()
              //  console.log( JSON.parse(para))
              if(para != "no data")
              {

                var element = JSON.parse(para)
                for (let i = 0; i < element.length; i++) {
                  var str = "<tr><td><a href='http://localhost/thyssenkrup/documentcheck.php?aid="+element[i]+"' target='_blank'>"+element[i]+"</td></tr>"
                  
                  $('#tabledataselect').append(str)
                    
                } 
              
              }

                
                
                $('#mytabs').fadeIn(900); 
                $('#select').click()
                flag0 = 1
              },
              error:function(err)
              {

              }
              });




           })

  var flag =0

  $('#reject').click(function(){

    $('#tabledatareject').empty()
    
    $.ajax({

                  url : 'http://localhost/thyssenkrup/api/getrejected.php',
                  type : 'POST',
                  data : {'dept':dept,'prf':prf,"pos":pos,'iid':$("#deptchoice").val(),'rid':$("#roundchoice").val()},
                  success:function(para)
                  {
                    //para = [['mailreject','linkreject','namereject'],['mail','link','name'],['mail','link','name']]
                  
                    console.log("mi array =  ")
                    console.log(para)
                    
                    
                      var element = JSON.parse(para)
                      for (let i = 0; i < element.length; i++) {

                        var str = "<tr><td><a href='http://localhost/thyssenkrup/documentcheck.php?aid="+element[i]+"' target='_blank'>"+element[i]+"</a></td><td></tr>"
                        
                        
                        $('#tabledatareject').append(str)
                      }
               

                    flag=1
                    
                    
                  
                  },
                  error:function(err)
                  {

                  }
                  });


      })
   
    



  var flag2 = 0
 
  $('#hld').click(function(){


    $('#tabledatahold').empty()    
              $.ajax({

              url : 'http://localhost/thyssenkrup/api/gethold.php',
              type : 'POST',
              data : {'dept':dept,'prf':prf,"pos":pos,'iid':$("#deptchoice").val(),'rid':$("#roundchoice").val()},
                  success:function(para)
                  {
                    //para = [['mailreject','linkreject','namereject'],['mail','link','name'],['mail','link','name']]
                  
                    console.log("ml arrat =  ",para)
                    var element = JSON.parse(para)
                    for (let i = 0; i < element.length; i++) {

                      var str = "<tr><td><a href='http://localhost/thyssenkrup/documentcheck.php?aid="+element[i]+"' target='_blank'>"+element[i]+"</td><td></tr>"
                      
                      
                      $('#tabledatahold').append(str)
              

             
              

              }
              


              },
              error:function(err)
              {

              }
              });


          })




//logout user
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

// $("#exp").click(function(){

// $.ajax({
  
//   url:"http://localhost/thyssenkrup/excel/excel1.php",
//   type:"POST",
//   success:function(para){
//     console.log(para)
//     // para = JSON.parse(para)
// //     $.ajax({
  
// //     url:"http://localhost/thyssenkrup/excel/excel1.php",
// //     type:"POST",
// //     data:{"para":para},
// //     success:function(para1){
// //       console.log(para1)
    
// //     }
// // })
//   }
// })
// });



    
     
  });



  </script>
  <style>
    .tabs .indicator {
            background-color:#1e88e5;
            height: 7px;
        } /*Color of underline*/
      
  </style>
                               
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
