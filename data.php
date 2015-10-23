<?php

header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "johncena";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {die("DUMP");}

$arr = array();
$sql = "SELECT course, title FROM classes";
$result = $conn->query($sql);
if($result->num_rows > 0){
	while($row = $result->fetch_assoc()) {
		$arr[] = array("course" => $row["course"], "title" => $row["title"], "tokens" => $row["course"]." ".$row["title"]);
	}
}

echo json_encode($arr);

?>