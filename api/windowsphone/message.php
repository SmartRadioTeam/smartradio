<?php
include("class_include.php");
//$sql = "SELECT * FROM `timetable`";
$sql = DB_Select("timetable");
$query = DB_Query($sql,$con);
while($row=DB_Fetch_Array($query)){
	echo $row["deltime"];
}
//$sql = "SELECT * FROM `message`";
$sql = DB_Select("message");
$query = DB_Query($sql,$con);
while($row=DB_Fetch_Array($query)){
	echo "|".urldecode($row["message"]);
}
?>