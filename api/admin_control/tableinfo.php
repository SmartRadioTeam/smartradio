<?php

include "class_include.php";
$resultarray["lostandfound"] = json_decode($redis->get("lostandfound"));
$resultarray["songtable"] = json_decode($redis->get("songtable"));
$resultarray["songinfo"] = json_decode($redis->get("songinfo"));
echo json_encode($resultarray);