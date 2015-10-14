<?php
if(!isset($_COOKIE['login'])&&Location_Filename!="login.php"){
	header("location:../login.php");
	exit();
}
include("../../config/init.php");
include("../../connect/init.php");
switch(Location_Filename){
	case "backmusic.php":
		include("toast.php");
		break;
	case "changedata.php":
//过滤函数
	case "del.php":
		include("toast.php");
		break;
}