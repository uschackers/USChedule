//gets professor's names and then concatenates them into one string
// var name = document.getElementsByClassName("result-name")[0];
// var profName = name.getElementsByClassName("pfname")[0].innerHTML+" "
// +name.getElementsByClassName("pfname")[1].innerHTML;

var names = document.querySelectorAll("span.pfname");
var profName=names[0].innerHTML.trim();
var names = document.querySelectorAll("span.plname");
profName = profName+" "+names[0].innerHTML.trim();

//first class is the overall quality (rating)
//second class is the average grade (A-)
//third class is the hotness
var text = document.getElementsByClassName("breakdown-header");
var profQuality = text[0].getElementsByClassName("grade")[0].innerHTML;
var profGrade = text[1].getElementsByClassName("grade")[0].innerHTML;
var chili = text[2].getElementsByClassName("grade")[0].firstElementChild.firstElementChild.src;
//is professor hot 
var profHotness;
(chili == "http://www.ratemyprofessors.com/assets/chilis/warm-chili.png")? (profHotness=1):(profHotness=0);


//goes through ratings sliders
var sliders = document.getElementsByClassName("rating-slider");
var profHelpfulness = sliders[0].getElementsByClassName("rating")[0].innerHTML;
var profClarity = sliders[1].getElementsByClassName("rating")[0].innerHTML;
var profEasiness = sliders[2].getElementsByClassName("rating")[0].innerHTML;



$.post("rmpProcess.php",$('overall_quality').serialize(), function(msg){
$.ajax(
	{type:"POST",url:"rmpProcess.php",data{
		name: profName, quality: profQuality, grade: profGrade,
		hotness: profHotness, helpfulness: profHelpfulness,
		clarity: profClarity, easiness: profEasiness}
	}).done(function(msg){alert("Data Saved: "+msg)});
	
}
