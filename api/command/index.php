<?php

include("class_include.php");
$resultarray["projectname"] = Project_Name;
$resultarray["settings"] = json_decode($redis->get("settings"));
$resultarray["lostandfound"] = json_decode($redis->get("lostandfound_view"));
$resultarray["songtable"] = json_decode($redis->get("songtable_view"));
$resultarray["songinfo"] = json_decode($redis->get("songinfo"));
echo json_encode($resultarray, JSON_UNESCAPED_UNICODE);
?>