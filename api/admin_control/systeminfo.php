<?php
include "class_include.php";
$resultarray["settings"] = json_decode($redis->get("settings"), true);
echo json_encode($resultarray);
