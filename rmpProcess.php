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

set_time_limit(0);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "johncena";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {die("DUMP");}




// Retrieve the DOM from a given URL
//This collects all Teacher IDs from ratemyprof and puts it into an array
$array = array();
for($i = 1; $i <= 130; $i++ ){
	$url = "http://www.ratemyprofessors.com/find/professor/?department=&institution=&page=".(string)$i."&query=*%3A*&queryoption=TEACHER&queryBy=schoolId&sid=1381&sortBy=";
	$json = file_get_contents($url);
	$data = json_decode($json,true);
	$professor = $data["professors"];
	//echo $i."<br>";

//loops through professors of a single PAGE
//adds professor's teacher id to array
	for($m = 0; $m < sizeof($data["professors"]); $m++){
		$professor = $data["professors"][$m];
		$array[] = $professor["tid"];
	}
}

for($j = 0; $j < sizeof($array);$j++){
	$teacherURL = "http://www.ratemyprofessors.com/ShowRatings.jsp?tid=".$array[$j];
	scrapeURL($teacherURL,$array[$j], $conn);
}
function insertProfessor($tid, $profName, $profQuality, $profGrade, $chili, $profHelpfulness, $profClarity, $profEasiness,$conn)
{
	$query = "INSERT INTO professors (id, tid, profName, profQuality, profGrade, chili, profHelpfulness, profClarity, profEasiness) VALUES ('','$tid','$profName', '$profQuality', '$profGrade','$chili','$profHelpfulness','$profClarity','$profEasiness')";
	if ($conn->query($query) === TRUE) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $query . "<br>" . $conn->error;
	}

}

function scrapeURL ( $url , $id, $conn){
	echo "Scraping<br>";
	$html = file_get_html($url);
	$tid = $id;
//find name of professor
	$ret = $html -> find('span.pfname');
	$profName = trim($ret[0]-> innertext);
	$ret = $html -> find('span.plname');
	$profName = $profName." ".trim($ret[0] -> innertext);
	$profName = addslashes($profName);
	//echo $fName."<br>";
//find information about professor
	$ret = $html -> find('.breakdown-header');

	$profQuality = $ret[0] -> find('.grade');
	$profQuality = $profQuality[0] -> innertext;

	//echo $profQuality."<br>";

	$profGrade = $ret[1]->find('.grade');
	$profGrade = $profGrade[0] -> innertext;
	$profGrade = addslashes($profGrade);

	$chili = $ret[2]->find('.grade');
	$chili = $chili[0] -> find('img');
	echo $chili[0]->src;
	if(($chili[0]->src)==="/assets/chilis/cold-chili.png")
	{
		$chili = 0;
	}
	else if(($chili[0]->src)==="/assets/chilis/warm-chili.png")
	{
		$chili = 1;
	}
	else
	{
		$chili = 2;
	}

	$ret = $html -> find('.rating-slider');

	$profHelpfulness = $ret[0]->find('.rating');
	$profHelpfulness = $profHelpfulness[0] -> innertext;
	//echo $profHelpfulness."<br>";

	$profClarity = $ret[1] -> find('.rating');
	$profClarity = $profClarity[0] -> innertext;
	//echo $profClarity."<br>";

	$profEasiness = $ret[2] -> find('.rating');
	$profEasiness= $profEasiness[0] -> innertext;
	//echo $profClarity."<br><br><br>";

	insertProfessor($tid, $profName, $profQuality, $profGrade, $chili, $profHelpfulness, $profClarity, $profEasiness,$conn);
}

?>