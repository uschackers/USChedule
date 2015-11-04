<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "johncena";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {die("DUMP");}

?>