<?php
include("class_include.php");
//$sql = "SELECT * FROM `radio`";
$sql = DB_Select("radio",null,"","*","info");
$query = DB_Query($sql,$con);
while($row=DB_Fetch_Array($query)){
	echo urldecode($row["name"])."｜"
	.urldecode($row["user"])."｜"
	.urldecode($row["to"])."｜"
	."「".urldecode($row["message"])."」｜"
	.$row["info"]."｜〕";
}
?>