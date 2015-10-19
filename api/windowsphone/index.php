<?php
include("class_include.php");
$sql = DB_Select("ticket＿view",null,"","*","info");
$query = DB_Query($sql,$con);
while($row=DB_Fetch_Array($query)){
	echo urldecode($row["name"])."｜"
	.urldecode($row["user"])."｜"
	.urldecode($row["to"])."｜"
	."「".urldecode($row["message"])."」｜"
	.$row["info"]."｜〕";
}
?>