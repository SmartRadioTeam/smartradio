<?php

include"../../config/init.php";
include"../connect/init.php";
include"auth.php";
if (substr($_SERVER['PHP_SELF'], strrpos($_SERVER['PHP_SELF'], '/') + 1) != "login.php")
{
	if (!auth($redis, $_POST["key"], $_POST["user"]))
	{
		die("{'message':'鉴权失败！','mod':'loginauth_error'}");
	}
}
?>