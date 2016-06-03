<?php
include("class_include.php");
$resultarray["projectname"] = Project_Name;
$resultarray["settings"] = json_decode($redis->get("setting"),true);
$resultarray["lostandfound"] = json_decode($redis->get("lostandfound_view"),true);
$resultarray["songtable"] = json_decode($redis->get("songtable_view"),true);
$resultarray["songinfo"] = json_decode($redis->get("songinfo"),true);
echo json_encode($resultarray,JSON_UNESCAPED_UNICODE);
?>