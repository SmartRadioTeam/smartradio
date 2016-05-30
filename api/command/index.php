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
if(!$redis->exists('songtable'))
{
	$resultarray["songtable"] = json_decode($redis->get("songtable_view"),true);
}
if(!$redis->exists('songinfo'))
{
	$resultarray["songinfo"] = json_decode($redis->get("songinfo"),true);
}
echo json_encode($resultarray,JSON_UNESCAPED_UNICODE);
?>