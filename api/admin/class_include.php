<?php
include("../../config/init.php");
include("../connect/init.php");
header("Access-Control-Allow-Origin:*");
if(!isset($_COOKIE['login']) && Location_Filename != "login.php")
{
	die("{message:'autherror'}");
}
?>