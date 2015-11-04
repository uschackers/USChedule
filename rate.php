
<?php

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
//echo sizeof($array);

?>