<?php
$fp = fopen('lidn.txt', 'a');
$t = 'mice2';
fwrite($fp, '\nCats chase9999');
fwrite($fp, "\n".$t);
fclose($fp);
?>