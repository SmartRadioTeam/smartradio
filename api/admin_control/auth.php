<?php
function auth($redis, $resultkey, $username)
{
    $usernametimes = json_decode($redis->get("usersession"), true);
    if (isset($usernametimes[$username]))
    {
        if (getuserkey($username, $usernametimes[$username]) == $resultkey)
        {
            return true;
        }
    }
    die("{'message':'鉴权失败！','mode':'error'}");
}

function getuserkey($username, $time)
{
    return md5(md5($username . "times" . $time));
}
