<?php
error_reporting(0);//(错误提示，开发模式下为注释)
$json = file_get_contents("setting.json",true);
$json_obj=json_decode($json);
//生成对象json_obj
include("command/project_config.php");
include("command/db_config.php");
include("command/class_config.php");
define("Location_Filename",substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], '/')+1));
date_default_timezone_set ('PRC');