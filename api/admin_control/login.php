<?php

include "class_include.php";
include "auth.php";
if (isset($_POST['username']))
{
	$input_username = $_POST['username'];
	$input_password = $_POST['password'];
	$username = md5(trim($input_username));
	$password = md5(trim($input_password));
	if ($password == $row["password"])
	{
		$time = time();
		if ($redis->exists('usersession'))
		{
			$resultinfo = json_decode($redis->get("usersession"), true);
			if (!array_key_exists($_POST['username'], $resultinfo))
			{
				redis_listadditem($redis, "usersession", $time);
			} else
			{
				redis_setlogininfo($redis, $time, $_POST['username']);
			}
		} else
		{
			redis_setlogininfo($redis, $time, $_POST['username']);
		}
		die('{"mod":"success","authkey":"' . $resultkeys . '"}');
	} else
	{
		die('{"message":"您的密码输入错误，请重新输入！","mod":"error"}');
	}
}

function redis_setlogininfo($redis, $time, $username)
{
	$resultinfo[$username] = $time;
	$redis->SET("usersession", json_encode($resultinfo, JSON_UNESCAPED_UNICODE));
}
