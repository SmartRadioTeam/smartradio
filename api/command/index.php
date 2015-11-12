<?php
include("class_include.php");
$sql = DB_Select("songtable");
$Songtable = DB_Query($sql,$con);
while($row = DB_Fetch_Array($Songtable)){
	$songtablearr[$rowsongtable['id']] = array("songtittle" => urldecode($rowsongtable["songtittle"]),"songcover" => urldecode($rowsongtable["songcover"]),"songurl" => urldecode($rowsongtable["songurl"]));
}
$sql = DB_Select("ticket_view",null,"","*","info");
$query = DB_Query($sql,$con);
while($row = DB_Fetch_Array($query)){
	$resultarray["info"] = $row["info"];
	$resultarray["songtittle"] = $songtablearr[$row["songid"]]["songtittle"];
	$resultarray["songcover"] = $songtablearr[$row["songid"]]["songcover"];
	$resultarray["songurl"] = $songtablearr[$row["songid"]]["songurl"];
	$resultarray["user"] = urldecode($row["user"]);
	$resultarray["to"] = urldecode($row["to"]);
	$resultarray["message"] = "「".urldecode($row["message"])."」";
	$jsonarray[] = $resultarray;
}
echo json_encode($jsonarray,JSON_UNESCAPED_UNICODE);
?>