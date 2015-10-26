<?php
// servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "johncena";
// $conn = new mysqli($servername, $username, $password, $dbname);
// if($conn -> connect_error) {die("DUMP");}

// echo $_POST['name']." ".$_POST['quality']." ".$_POST['grade']." ".$_POST['hotness']." ".
// $_POST['helpfulness']." ".$_POST['clarity']." ".$_POST['easiness'];
// // function insertProfessor($name,$quality,$grade,$hotness,$helpfulness,$clarity,$easiness,$conn){ 
// 	$query = "INSERT INTO professors (id, name, quality, grade, hotness, helpfulness, clarity, easiness) 
// 	VALUES('','$name','$quality','$grade','$hotness','$helpfulness','$clarity','$easiness')";
// 	if($conn->query($query) === TRUE){} else echo $query."<br>";

// }


// Include the library
include('simple_html_dom.php');
// Retrieve the DOM from a given URL
$url='';
$html = file_get_html($url);

//find name of professor



?>