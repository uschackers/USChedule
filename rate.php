<?php

$url = "http://www.ratemyprofessors.com/find/professor/?department=&institution=&page=1&query=*%3A*&queryoption=TEACHER&queryBy=schoolId&sid=1381&sortBy=";
$json = file_get_contents($url);
$data = json_decode($json,true);
for($i = 0; $i < sizeof($data["professors"]); $i++)
{
	$professor = $data["professors"][$i];
	//name
	echo "Professor: ".$professor["tFname"]." ".$data["professors"][$i]["tLname"];
	
	//overall rating
	echo " Rating: ".$professor["overall_rating"];

	//line break
	echo "<br>";
}



?>