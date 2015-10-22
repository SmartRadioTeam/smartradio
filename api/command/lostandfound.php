<?php
include("class_include.php");
$resultarray[] = array();
//todo 失物招领与寻物启事显示模式修改(已经改为两条)。
$sql = DB_Select("lostandfound",1);
$query = DB_Query($sql,$con);
while($row = DB_Fetch_Array($query)){
$messages = "来自".urldecode($row["user"])."同学的寻物启示：".urldecode($row["message"])."请有拾到者拨打电话：".urldecode($row["tel"])."。谢谢！（本信息将滚动播出，如需了解更多信息请刷新页面。）";
$resultarray["lostandfound"] = $messages;
}
json_encode($resultarray,JSON_UNESCAPED_UNICODE);