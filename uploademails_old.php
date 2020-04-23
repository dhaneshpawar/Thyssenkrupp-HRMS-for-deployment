<?PHP
error_reporting(0);
function readCSV($csvFile){
    $file_handle = fopen($csvFile, 'r');
    while (!feof($file_handle) ) {
        $line_of_text[] = fgetcsv($file_handle, 1024);
    }
    fclose($file_handle);
    return $line_of_text;
}

if(isset($_FILES))
{
    include 'api/db.php';
    // Set path to CSV file
    // $csvFile = 'test.csv';
    $csvFile = $_FILES['uploadcsv']['name'];
    $cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
    
    $csv = readCSV($csvFile);
    // echo $csv;
    for($i = 0; $i < count($csv)-1; $i++)
    {
        
            $exist = $db->tokens->findOne(array("email" => $csv[$i][1]));
            if(!empty($exist))
            {
                echo "";
            }
            else
            {
                $val=$db->tokens->insertOne(array(
                    "email" => $csv[$i][1] ? $csv[$i][1] :"null"
                   ));
            }
        
        
    }
   
    if($val)
    {
        echo "<script>alert('CSV Uploaded Successfully')</script>";
        header("refresh:0;url=hrnew.php");
    }
    else
    {
        echo "<script>alert('CSV Data Already Exists')</script>";
        header("refresh:0;url=hrnew.php");

    }
    
}
else
{
    echo "error";
}
?>

