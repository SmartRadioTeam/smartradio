<?php
include("class_include.php");
$sql = DB_Select("lostandfound");
$query = DB_Query($sql,$con);
while($row = DB_Fetch_Array($query))
{
	$resultarray['uptime'] = urldecode($row["uptime"]);
	$resultarray['user'] = urldecode($row["user"]);
	$resultarray['telphone'] = urldecode($row["tel"]);
	$resultarray['message']=urldecode($row["message"]);
	$resultarray['ip']=urldecode($row["ip"]);
	$jsonarray[] = $resultarray;
}
echo json_encode($jsonarray,JSON_UNESCAPED_UNICODE);
?>