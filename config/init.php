<?php
//error_reporting(0);
require("command/project_config.php");
require("command/db_config.php");
require("command/class_config.php");
$url=$_SERVER['PHP_SELF']; 
$location_filename=substr($url,strrpos($url,'/')+1);