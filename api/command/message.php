<?php
include("class_include.php");
$sql = DB_Select("setting");
$query = DB_Query($sql,$con);
while($row = DB_Fetch_Array($query)){
 $resultarray["permission"] = $row["permission"];
 $resultarray["notice"] = $row["notice"];
	$resultarray["cleantime"] = $row["cleantime"];
	break；
}
json_encode($resultarray,JSON_UNESCAPED_UNICODE);
?>