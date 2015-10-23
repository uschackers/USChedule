<?php

// RETURNS TIME CONVERTED INTO MINUTES
// ASSUME format 00:00am
function convertToMin($time){
	$hours = explode(":",$time)[0];
	$minutes = explode(":",$time)[1];

	if(strpos($minutes,"am")){
		$minutes = str_replace("am","",$minutes);
	}
	else if(strpos($minutes,"pm")){
		$minutes = str_replace("pm","",$minutes);
		if($hours != 12) $hours += 12;
	}

	return ($hours*60) + $minutes;
}

// ASSUME t12 > t11, t22 > t21
function checkConflict($t1_start,$t1_end,$t2_start,$t2_end){
	if(convertToMin($t1_start) >= convertToMin($t2_start))
		if(convertToMin($t2_end) > convertToMin($t1_start))
			return false;
		else
			return true;
	else
		checkConflict($t2_start,$t2_end,$t1_start,$t1_end);
}

if(checkConflict("10:00am","12:00pm","9:00am","10:00am")) echo "no conflict";
else echo "this is fucked";

?>