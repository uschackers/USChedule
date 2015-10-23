<?php
$server='localhost';
$dbname='johncena';
$dbc = new PDO("mysql:host=$server;dbname=$dbname", 'root', '');
$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
echo "Connection Successful"."<br />";
$pref = $_GET['filter'];

if($pref == "pm")
{

$retrieveClasses = $dbc->prepare("SELECT * FROM section WHERE class_id = :class");
$retrieveClasses->bindParam(':class', $_GET['class']);
$retrieveClasses->execute();


while($classResults=$retrieveClasses->fetch(PDO::FETCH_ASSOC)){
print_r($classResults['section']);
echo "<br />";

}
echo "<br />".count($classResults);
}

 
if($pref == 4)
{
	echo "<img src='http://c.jcket.com/stoneyroads/files/2015/09/600x/John-Cena.jpg'/> < br/> <img src = 'http://i.ytimg.com/vi/TUQ3nVoN-ko/maxresdefault.jpg /> < br /> <img src = 'http://www.quickmeme.com/img/26/260e24f735bd6ca4c5e3a1815b9986bf14fb14c25446db674a24b877a91c82cb.jpg' />";
}
?>