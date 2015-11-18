<?php
include("../../config/init.php");
if(!isset($_COOKIE['login']) && Location_Filename != "login.php"){
	header("location:../login.php");
	exit();
}
include("../../connect/init.php");
include("../../package/system/messagebox/messagebox.php");
switch(Location_Filename){
	case "items.php":
		include("toast.php");
		break;
}