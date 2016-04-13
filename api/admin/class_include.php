<?php
include("../../config/init.php");
include("../connect/init.php");
header("Access-Control-Allow-Origin:*");
session_start();
if(!isset($_SESSION['thisusername']) && Location_Filename != "login.php")
{
	die("{'message':'autherror','mod':'error'}");
}
?>