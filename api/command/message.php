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
$sql = DB_Select("lostandfound",null,1);
$query = DB_Query($sql,$con);
while($row = DB_Fetch_Array($query)){
	$messages = "来自".urldecode($row["user"])."同学的寻物启示：".urldecode($row["message"])."请有拾到者拨打电话：".urldecode($row["tel"])."。谢谢！（本信息将滚动播出，如需了解更多信息请刷新页面。）";
	$lostandfoundarr[] = $messages;
}
$resultarray["lostandfound"] = $lostandfoundarr;
json_encode($resultarray,JSON_UNESCAPED_UNICODE);
?>