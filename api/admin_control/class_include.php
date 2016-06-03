<?php
if(substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'],'/')+1) != "login.php")
{
	//todo 加入身份认证模块
	die("{'message':'鉴权失败！','mod':'loginauth_error'}");
}
include("../../config/init.php");
include("../connect/init.php");
?>