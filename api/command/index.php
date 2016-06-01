<?php
include("class_include.php");
$resultarray["projectname"] = Project_Name;
if(!$redis->exists("settings"))
{
	$redis->SET("settings","{'notice':'欢迎使用Smartradio','permission','0'}");
}
$resultarray["settings"] = json_decode($redis->get("setting"),true);
if(!$redis->exists('lostandfound'))
{
	$resultarray["lostandfound"] = json_decode($redis->get("lostandfound_view"),true);
}
else
{
	$resultarray["lostandfound"]="[]";
	$redis->SET("lostandfound_view","[]");
	$redis->SET("lostandfound","[]");
}
if(!$redis->exists('songtable_view'))
{
	$resultarray["songtable"] = json_decode($redis->get("songtable_view"),true);
}
else
{
	$resultarray["songtable"]="[]";
	$redis->SET("songtable","[]");
	$redis->SET("songtable_view","[]");
}
if(!$redis->exists('songinfo'))
{
	$resultarray["songinfo"] = json_decode($redis->get("songinfo"),true);
}
else
{
	$resultarray["songinfo"]="[]";
	$redis->SET("songinfo","[]");
}
echo json_encode($resultarray,JSON_UNESCAPED_UNICODE);
?>