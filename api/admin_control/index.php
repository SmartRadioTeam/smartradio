<?php
include("class_include.php");
$resultarray["lostandfound"] = json_decode($redis->get("lostandfound"),true);
$resultarray["songtable"] = json_decode($redis->get("songtable"),true);
$resultarray["songinfo"] = json_decode($redis->get("songinfo"),true);
echo json_encode($resultarray,JSON_UNESCAPED_UNICODE);
?>