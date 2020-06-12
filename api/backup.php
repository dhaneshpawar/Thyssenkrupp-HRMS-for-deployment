<?php
$query = shell_exec('mongodump --port 27017 --db hrms --out /C:/Users/lenovo/Desktop/');
if($query)
{
    echo "done";
}
else
{
    echo "not done";
}
?>
