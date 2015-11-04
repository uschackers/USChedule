<?php

include 'func/db.php';

//array of all Subject Names 
$subject = array("AHIS", "ALI", "AMST", "ANTH", "ARAB", "ASTR", "BISC", "CHEM", "CLAS", "COLT", "CORE", "CSLC", "EALC", "EASC", "ECON", "ENGL", "ENST", "EXSC", "FREN", "FSEM", "GEOG", "GEOL", "GERM", "SWMS", "GR", "HEBR", "HIST", "HBIO", "INDS", "IR", "IRAN", "ITAL", "JS", "LAT", "LBST", "LING", "MATH", "MDA", "MDES", "MPW", "NEUR", "NSCI", "OS", "PHED", "PHIL", "PHYS", "POIR", "PORT", "POSC", "PSYC", "REL", "RNR", "SLL", "SOCI", "SPAN", "SSCI", "SSEM", "USC", "WRIT", "ACCT", "ARCH", "ACAD", "BAEP", "BUAD", "BUCO", "DSO", "FBE", "GSBA", "LIM", "MKT", "MOR", "CMPP", "CNTV", "CTAN", "CTCS", "CTIN", "CTPR", "CTWR", "IML", "ASCJ", "CMGT", "COMM", "DSM", "JOUR", "PUBD", "DANC", "DENT", "CBY", "DHYG", "DIAG", "DPBL", "GDEN", "OFPM", "PEDO", "PERI", "THTR", "EDCO", "EDHP", "EDPT", "EDUC", "AME", "ASTE", "BME", "CHE", "CE", "CSCI", "EE", "ENE", "ENGR", "ISE", "INF", "ITP", "MASC", "PTE", "SAE", "ART", "CRIT", "DES", "FA", "FACE", "FACS", "FADN", "FADW", "FAIN", "FAPH", "FAPT", "FAPR", "FASC", "PAS", "WCT", "GCT", "SCIN", "SCIS", "ARLT", "SI", "ARTS", "HINQ", "SANA", "LIFE", "PSC", "QREA", "GPG", "GPH", "GESM", "GERO", "GRSC", "LAW", "ACMD", "ANST", "BIOC", "CBG", "DSR", "HP", "INTD", "MED", "MEDB", "MEDS", "MICB", "MPHY", "MSS", "NIIN", "PATH", "PHBI", "PM", "PCPA", "SCRM", "ARTL", "MTEC", "MSCR", "MUCM", "MUCO", "MUCD", "MUED", "MUEN", "MUHL", "MUIN", "MUJZ", "MPEM", "MPGU", "MPKS", "MPPM", "MPST", "MPVA", "MPWP", "MUSC", "OT", "HCDA", "MPTX", "PHRD", "PMEP", "PSCI", "BKN", "PT", "AEST", "HMGT", "MS", "NAUT", "NSC", "PPD", "PPDE", "PLUS", "RED", "SOWK");

function insertClasses($course,$title,$units,$conn){
	$title = addslashes($title);
	$query = "INSERT INTO classes (id, course, title, units) VALUES ('', '$course', '$title', '$units')";
	$query2 = "SELECT * FROM classes WHERE course='$course'";
	$result2 = $conn->query($query2);
	if(!empty($_POST["con"]) && $result2->num_rows==0){
		echo "INSERTED CLASSES.<br>";
		if($conn->query($query) === TRUE) {} else echo $query."<br>";
	}
}

function insertSection($class_id,$theme,$type,$section,$time_start,$time_end,$days,$instructor,$room,$conn){
	$instructor = addslashes($instructor);
	$theme = addslashes($theme);
	$query = "INSERT INTO section (id, class_id, theme, type, section, time_start, time_end, days, instructor, room) VALUES ('', '$class_id', '$theme', '$type', '$section', '$time_start', '$time_end', '$days', '$instructor', '$room')";
	$query2 = "SELECT * FROM section WHERE section='$section'";
	$result2 = $conn->query($query2);
	if(!empty($_POST["con"]) && $result2->num_rows==0){
		echo "INSERTED SECTIONS.<br>";
		if($conn->query($query) === TRUE) {} else echo $query."<br>";
	}
}

//download all csv files
//break each file down and strip quotes 
//2d array that contains each line (which is a class)
//each class line contains info about class
function parseContent($ex, $subject, $conn){
	// DUMP ALL SHIT INTO $ARRAY
	$fileName= "http://localhost/csv/".strtolower($ex)."-20161.csv";

	$dump = trim(file_get_contents($fileName));
	$dump = str_replace("TBA","",$dump);
	//$dump = str_replace(":","\:",$dump);
	$lines = explode(PHP_EOL, $dump);
	array_shift($lines);
	$array = array();
	foreach ($lines as $line) {
	    $array[] = str_getcsv($line);
	}

//assigns class information from array into variables
//then insert variables into MySQL database
	$i = 0;
	$course = "";
	while($i<sizeof($array)){
		if($array[$i][0] != ""){
			$course = $array[$i][0];
			insertClasses($course,$array[$i][1],$array[$i][3],$conn);
		}
		$time_start = (isset($array[$i][7]) && $array[$i][7] != "") ? explode("-",$array[$i][7])[0] : "";
		$time_end = (isset($array[$i][7]) && $array[$i][7] != "") ? explode("-",$array[$i][7])[1] : "";
		// class_id, theme, type, section, time_start, time_end, days, instructor, room
		if(isset($array[$i][4])){
			if($array[$i][0] != "") insertSection($course,"",$array[$i][4],$array[$i][5],$time_start,$time_end,$array[$i][8],$array[$i][12],$array[$i][13],$conn);
			else insertSection($course,$array[$i][1],$array[$i][4],$array[$i][5],$time_start,$time_end,$array[$i][8],$array[$i][12],$array[$i][13],$conn);
		}
		$i++;
	}

}

for($n=0;$n<sizeof($subject);$n++){
	parseContent($subject[$n], $subject, $conn);
}

$conn->close();


?>

<form action="cena.php" method="post">
<input type="hidden" name="con" value="something">
<input type="submit" value="POPULATE SQL">
</form>
