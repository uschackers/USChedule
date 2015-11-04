<?php

header('Content-Type: application/json');

include 'func/db.php';

$classid = $_GET['classid'];

$arr = array();
$sql = "SELECT theme FROM section WHERE class_id = '$classid'";
$result = $conn->query($sql);
if($result->num_rows > 0){
	while($row = $result->fetch_assoc()) {
		if(!in_array($row["theme"],$arr) && $row["theme"] != "") $arr[] = $row["theme"];
	}
}
else $arr[] = 0;

if(isset($classid)) echo json_encode($arr);

$conn->close();

?>