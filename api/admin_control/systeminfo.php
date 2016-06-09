<?php
include "class_include.php";
$resultarray["projectname"] = Project_Name;
$resultarray["settings"] = json_decode($redis->get("settings"), true);
echo json_encode($resultarray, JSON_UNESCAPED_UNICODE);
