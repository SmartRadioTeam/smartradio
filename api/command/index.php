<?php
include("class_include.php");
$sql = DB_Select("ticket_view",null,"","*","info"); 
$query = DB_Query($sql,$con);
while($row = DB_Fetch_Array($query)){
$resultarray["info"] = $row["info"];
$resultarray["songname"] = urldecode($row["songname"]);
$resultarray["user"] = urldecode($row["user"]);
$resultarray["to"] = urldecode($row["to"]);
$resultarray["message"] = "「".urldecode($row["message"])."」";
$jsonarray[] = $resultarray;
}
echo json_encode($jsonarray,JSON_UNESCAPED_UNICODE);
?>