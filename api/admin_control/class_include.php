<?php

include "../../config/init.php";
include "../../connect/init.php";
include "auth.php";
$location = substr($_SERVER['PHP_SELF'], strrpos($_SERVER['PHP_SELF'], '/') + 1);
if (filter_input(INPUT_POST, 'mode', FILTER_SANITIZE_SPECIAL_CHARS) != "login" && $location != "install.php")
{
	auth($redis,filter_input(INPUT_POST, "resultkey", FILTER_SANITIZE_SPECIAL_CHARS), filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS));
}
?>