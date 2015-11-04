<?php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "johncena";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connection_error) die("DUMP");

?>