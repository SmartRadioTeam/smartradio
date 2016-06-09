<?php

include "class_include.php";
$input_username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
$input_password = md5(trim(filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS)));
$mode = filter_input(INPUT_POST, 'mode', FILTER_SANITIZE_SPECIAL_CHARS);
if (!isset($username))
{
	die('{"message":"请不要提交空数据！","mode":"error"}');
}
switch ($mode)
{
	case "login":
		Login($redis, $input_username, $input_password);
		break;
	case "adduser":
		adduser($redis, $input_username, $input_password);
		break;
	case "changepassword":
		$new_password = filter_input(INPUT_POST, "newpasswd", FILTER_SANITIZE_SPECIAL_CHARS);
		changepassword($redis, $username, $input_password, $new_password);
		break;
	case "deluser":
		deluser($redis, $input_username);
		break;
}
echo '{"message":"操作完成","mode":"success"}';

function changepassword($redis, $username, $old_password, $new_password)
{

	$row = json_decode($redis->get("usertable"), true);
	if (!array_key_exists($username, $row) || $old_password != $row[$username])
	{
		die('{"message":"输入错误，请重新输入！","mode":"error"}');
	}
	$row[$username] = $new_password;
	$redis->SET("usertable", json_encode($row, JSON_UNESCAPED_UNICODE));
}

function redis_setlogininfo($redis, $time, $username)
{
	$resultinfo[$username] = $time;
	$redis->SET("usersession", json_encode($resultinfo, JSON_UNESCAPED_UNICODE));
}

function adduser($redis, $username, $password)
{
	$row = json_decode($redis->get("usertable"), true);
	if (array_key_exists($username, $row))
	{
		die('{"message":"用户已存在！","mode":"error"}');
	}
	$row[$username] = $password;
	$redis->SET("usertable", json_encode($row, JSON_UNESCAPED_UNICODE));
}

function deluser($redis, $username)
{
	$row = json_decode($redis->get("usertable"), true);
	if (!array_key_exists($username, $row))
	{
		die('{"message":"用户不存在！","mode":"error"}');
	}
	unset($row[$username]);
	$redis->SET("usertable", json_encode($row, JSON_UNESCAPED_UNICODE));
}

function Login($redis, $username, $password)
{
	$row = json_decode($redis->get("usertable"), true);
	if (!array_key_exists($username, $row) || $password != $row[$username])
	{
		die('{"message":"输入错误，请重新输入！","mode":"error"}');
	}
	$time = time();
	$resultinfo = json_decode($redis->get("usersession"), true);
	if (!array_key_exists($username, $resultinfo))
	{
		redis_listadditem($redis, "usersession", $time);
	} else
	{
		redis_setlogininfo($redis, $time, $username);
	}
	die('{"mod":"success","authkey":"' . getuserkey($username, $time) . '"}');
}
