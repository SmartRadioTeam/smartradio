<?php
include("class_include.php");
include("function.php");
$resultarray["projectname"] = Project_Name;
$resultarray["settings"] = getsetting($con);
$resultarray["lostandfound"] = getlaf($con);
$resultarray["songinfo"] = getsongtable($con);
echo json_encode($resultarray,JSON_UNESCAPED_UNICODE);
?>