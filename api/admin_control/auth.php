<?php

function auth($redis, $resultkey, $username)
{
	$usernametimes = json_decode($redis->get("usersession"), true);
	if (isset($usernametimes[$username]))
	{
		if (getuserkey($username, $usernametimes[$username]) == $resultkey)
		{
			return true;
		} else
		{
			return false;
		}
	} else
	{
		return false;
	}
}

function getuserkey($username, $time)
{
	md5(md5($username . "times" . $time));
}
