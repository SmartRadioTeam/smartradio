<?php
if(!isset($_COOKIE['login']) && Location_Filename != "login.php"){
	header("location:../login.php");
	exit();
}
include("../../config/init.php");
include("../../connect/init.php");
include("../../package/system/messagebox/messagebox.php");
switch(Location_Filename){
	case "backmusic.php":
		include("toast.php");
		break;
	case "changedata.php":
//过滤函数
	case "items.php":
		include("toast.php");
		break;
}