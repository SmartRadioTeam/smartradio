<?php
if(!isset($_COOKIE['login'])&&Location_Filename != "login.php"){
	header("location:login.php");
	exit();
}
include("../config/init.php");
include("../connect/init.php");
if(Location_Filename != "login.php"){
	//导入模板文件
	include("template/head.php");
	include ("template/model/infomation.php");
	include ("template/model/change.php");
	if(Location_Filename == "bansong.php"){
		include("template/model/add_bansong.php")
	}
}
?>