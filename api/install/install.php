<?php

include 'class_include.php';
if (!$redis->exists("settings"))
{
	$settings["notice"] = "欢迎使用Smartradio!";
	$settings["permission"] = "0";
	$settings["projectname"]="Smartradio";
	$redis->SET("settings", json_encode($settings));
}
if (!$redis->exists('lostandfound'))
{
	$redis->SET("lostandfound_view", "[]");
	$redis->SET("lostandfound", "[]");
}
if (!$redis->exists('songtable_view'))
{
	$redis->SET("songtable", "[]");
	$redis->SET("songtable_view", "[]");
}
if (!$redis->exists('songinfo'))
{
	$redis->SET("songinfo", "{}");
}
if (!$redis->exists("usersession"))
{
	$redis->SET("usersession", "{}");
}
if (!$redis->exists("usertable"))
{
	$result["admin"] = "";
	$redis->SET("usertable", "{}");
}
$redis->save();
