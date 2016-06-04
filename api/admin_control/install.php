<?php

include 'class_include.php';
if (!$redis->exists("settings"))
{
	$settings["notice"]="欢迎使用smartradio!";
	$settings["permission"]="0";
	$redis->SET("settings", json_encode($settings));
}
if (!$redis->exists('lostandfound'))
{
	$resultarray["lostandfound"] = "[]";
	$redis->SET("lostandfound_view", "[]");
	$redis->SET("lostandfound", "[]");
}
if (!$redis->exists('songtable_view'))
{
	$resultarray["songtable"] = "[]";
	$redis->SET("songtable", "[]");
	$redis->SET("songtable_view", "[]");
}
if (!$redis->exists('songinfo'))
{
	$resultarray["songinfo"] = "[]";
	$redis->SET("songinfo", "[]");
}
$redis->save();