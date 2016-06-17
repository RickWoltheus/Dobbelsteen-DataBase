<?php

$database = "u3367p1896_Dobbel";
$username = "u3367p1896_Admin";
$password = "123wormer";
$hostname = "localhost"; 

$dbhandle = mysqli_connect($hostname, $username, $password, $database)
 
or die("Unable to connect to MySQL");

echo "Connected to MySQL<br>";
echo "hello boi";
?>
