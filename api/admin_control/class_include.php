<?php
error_reporting(0); //(错误提示，开发模式下为注释)
date_default_timezone_set('PRC');
include "../../connect/init.php";
include "auth.php";
$location = substr(filter_input(INPUT_SERVER, 'PHP_SELF', FILTER_SANITIZE_URL), strrpos(filter_input(INPUT_SERVER, 'PHP_SELF', FILTER_SANITIZE_URL), '/') + 1);
$mode = filter_input(INPUT_POST, 'mode', FILTER_SANITIZE_SPECIAL_CHARS);
switch ($location)
{
    case "systeminfo.php":
    case "tableinfo.php":
        $resultkey = filter_input(INPUT_GET, "resultkey", FILTER_SANITIZE_SPECIAL_CHARS);
        $user = filter_input(INPUT_GET, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        break;
    default:
        $resultkey = filter_input(INPUT_POST, "resultkey", FILTER_SANITIZE_SPECIAL_CHARS);
        $user = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
}
if ($mode != "login" && $location != "systeminfo.php")
{
    auth($redis, $resultkey, $user);
}
?>