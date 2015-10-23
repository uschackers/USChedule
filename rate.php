
<?php

$url = "http://www.ratemyprofessors.com/find/professor/?department=&institution=&page=1&query=*%3A*&queryoption=TEACHER&queryBy=schoolId&sid=1381&sortBy=";
$json = file_get_contents($url);
$data = json_decode($json,true);
$professor = $data["professors"];

// for($i = 0; $i < sizeof($data["professors"]); $i++)
// {
// 	$professor = $data["professors"][$i];
	
// 	//overall rating
// 	echo " Rating: ".$professor["overall_rating"];

// 	//line break
// 	echo "<br>";
// }
//$array = json_decode($professor,true);
usort($professor, function($a,$b){

	return (int)$a["overall_rating"] > (int)$b["overall_rating"] ? -1 : 1;
});

echo json_encode($professor,JSON_PRETTY_PRINT);



?>