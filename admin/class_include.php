<?php
if(!isset($_COOKIE['login'])&&Location_Filename!="login.php"){
	header("location:login.php");
	exit();
}
include("../config/init.php");
include("../connect/init.php");
if(Location_Filename!="login.php"){
	include("/template/head.php");
}
?>