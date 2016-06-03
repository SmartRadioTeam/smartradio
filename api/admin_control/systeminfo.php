<?php

$resultarray["projectname"] = Project_Name;
$resultarray["settings"] = json_decode($redis->get("setting"), true);
echo json_encode($resultarray, JSON_UNESCAPED_UNICODE);
