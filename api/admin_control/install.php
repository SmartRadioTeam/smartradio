<?php

include 'class_include.php';
if (!$redis->exists("settings"))
{
	$redis->SET("settings", "{'notice':'欢迎使用Smartradio','permission','0'}");
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