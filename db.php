<?php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "johncena";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {die("DUMP");}

?>