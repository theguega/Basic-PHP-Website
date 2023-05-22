<?php

$dbhost = 'tuxa.sme.utc';
$dbuser = 'nf92p037';
$dbpass = 'iVFOm5rH';
$dbname = 'nf92p037';
$connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
mysqli_set_charset($connect, 'utf8');

?>
