<?php

error_reporting(0);//(错误提示，开发模式下为注释)
date_default_timezone_set ('PRC');
include "../../connect/init.php";
include "auth.php";
if (filter_input(INPUT_POST, 'mode', FILTER_SANITIZE_SPECIAL_CHARS) != "login")
{
	auth($redis,filter_input(INPUT_POST, "resultkey", FILTER_SANITIZE_SPECIAL_CHARS), filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS));
}
?>