<?php
$q = shell_exec('mongodump --port 27017 --db hrms --out /C:/Users/lenovo/Desktop/');
if($q)
{
    echo "done";
}
else
{
    echo "not done";
}
?>
