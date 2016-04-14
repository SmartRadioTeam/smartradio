<?php
session_start();
if(!isset($_SESSION['thisusername']) && Location_Filename != "login.php")
{
	die("{'message':'鉴权失败！','mod':'error'}");
}
include("../../config/init.php");
include("../connect/init.php");
header("Access-Control-Allow-Origin:*");
?>