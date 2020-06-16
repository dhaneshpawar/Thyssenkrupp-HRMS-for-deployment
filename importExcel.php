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

<?PHP
// error_reporting(0);
function readCSV($csvFile){
    $file_handle = fopen($csvFile, 'r');
    while (!feof($file_handle) ) {
        $line_of_text[] = fgetcsv($file_handle,2024);
    }
    fclose($file_handle);
    return $line_of_text;
}

if(isset($_FILES))
{
    include 'api/db.php';
    $ctr = 0;
    // Set path to CSV file
    // $csvFile = 'test.csv';
    $csvFile = $_FILES['uploadcsv']['name'];
    $ctemp = $_FILES["uploadcsv"]['tmp_name'];
    move_uploaded_file($ctemp,"PRFDumps/".$csvFile);
    $csvFile = "PRFDumps/".$csvFile;

    $cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
    $uid="";
    if($cursor){
        foreach($cursor as $key=>$val){
            if($key=='uid'){
                $uid=$val;
            }
        }
    }

    $csv = readCSV($csvFile);
    // echo count($csv);
    $ctr = 0;
    for($i = 1; $i < count($csv); $i++)
    {
        if($csv[$i][28])
        {
            $db->prfs->createIndex(
                array( "prf"=>1 ),
                array( "unique"=>true )
            );
            
            $exist = $db->prfs->find(array("prf" => $csv[$i][0],"status"=>"open"));
            $orderCount1 =count(iterator_to_array($exist));
            if($orderCount1 > 0)
            {
                $ctr++;
            }


            $val = array(              
                    "prf"               => $csv[$i][0]  ? $csv[$i][0]  :"null",
                    "prfname"           => $csv[$i][1]  ? $csv[$i][1]  :"null",
                    "submissiongdate"   => $csv[$i][2]  ? $csv[$i][2]  :"null",
                    "requester"         => $csv[$i][3]  ? $csv[$i][3]  :"null",
                    "position"          => $csv[$i][4]  ? $csv[$i][4]  :"null",
                    "productionline"    => $csv[$i][5]  ? $csv[$i][5]  :"null",
                    "hiringtype"        => $csv[$i][6]  ? $csv[$i][6]  :"null",
                    "classification100" => $csv[$i][7]  ? $csv[$i][7]  :"null",
                    "classification110" => $csv[$i][8]  ? $csv[$i][8]  :"null",
                    "classification111" => $csv[$i][9]  ? $csv[$i][9]  :"null",
                    "zone"              => $csv[$i][10] ? $csv[$i][10] :"null",
                    "branch"            => $csv[$i][11] ? $csv[$i][11] :"null",
                    "costcentername"    => $csv[$i][12] ? $csv[$i][12] :"null",
                    "costcentercode"    => $csv[$i][13] ? $csv[$i][13] :"null",
                    "department"        => $csv[$i][14] ? $csv[$i][14] :"null",
                    "location"          => $csv[$i][15] ? $csv[$i][15] :"null",
                    "pos"          => $csv[$i][16] ? sprintf("%02s",$csv[$i][16]) :"null",
                    "workforceclsf"     => $csv[$i][17] ? $csv[$i][17] :"null",
                    "requesttype"       => $csv[$i][18] ? $csv[$i][18] :"null",
                    "employeecodeandid" => $csv[$i][19] ? $csv[$i][19] :"null",
                    "employeename"      => $csv[$i][20] ? $csv[$i][20] :"null",    
                    "newjoinerid"       => $csv[$i][21] ? $csv[$i][21] :"null",    
                    "newjoinername"     => $csv[$i][22] ? $csv[$i][22] :"null",    
                    "requireddate"      => $csv[$i][23] ? $csv[$i][23] :"null",    
                    "reportingto"       => $csv[$i][24] ? $csv[$i][24] :"null",    
                    "budget"            => $csv[$i][25] ? $csv[$i][25] :"null",    
                    "internalposting"   => $csv[$i][26] ? $csv[$i][26] :"null",    
                    "status"            => $csv[$i][27] ? $csv[$i][27] :"null",    
                    "nexthandler"       => $csv[$i][28] ? $csv[$i][28] :"null",
                    "progress"          => "empty");
                    
                    $result = $db->prfs->updateOne(
                        array("prf" => $csv[$i][0]),
                        array('$setOnInsert'=>$val),
                        array("upsert"=>true)
                    );

                    
                    $date = date_default_timezone_set('Asia/Kolkata');
           
                    $today = date("Y-m-d H-i-s");

                    $db->generalized->insertOne(array("prf"=>$csv[$i][0],"uid"=>$uid,"init_time"=>"NA","comp_time"=>"NA","assign_time"=>"NA","accepted_time"=>"NA","creation_time"=>$today,"status"=>"avail"));

                    
                    
            
        
        }
    }
  $countInstances = $db->prfs->count(array("status"=>"open"));
  $new = $countInstances - $ctr;
  ?>
          <br><br><br><br><br>

<div class="row">
  <div class="col s12 m6 offset-m3">
      <div class="card white">
          <div class="card-content blue-text">
          <span class="card-title">Upload Dump Status : </span>
          <p>
          
          <br><br><br>

          <?php
    if($result)
    {
        echo "<center id='bwaiting'><h1>CSV Uploaded Successfully<br>".$new." New Entries Added</h1></center>";
        header("refresh:2;url=csvupload.php");
    }
    else
    {
        echo "<script>alert('Data Not Submitted. Please Reupload')</script>";
        header("refresh:0;url=http://localhost/hrms/csvupload.php");

    }
}
else
{
    echo "error";
}
?>

          </p>

          <br><br><br><br>
          </div>

      </div>
  </div>
</div>



</body>
</html>