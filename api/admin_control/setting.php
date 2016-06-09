<?php

include "class_include.php";
$mode=filter_input(INPUT_POST, "mode", FILTER_SANITIZE_SPECIAL_CHARS);
switch ($mode)
{
	case "notice":
		$value = filter_input(INPUT_POST, "message", FILTER_UNSAFE_RAW);
		break;
	case "permission":
		$value = filter_input(INPUT_POST, "off", FILTER_SANITIZE_SPECIAL_CHARS);
		break;
}
redis_overried_update($redis, "settings", $mode, $value);
echo '{"message":"操作成功！","mode":"success"}';
$redis->save();

function redis_overried_update($redis, $listname, $count, $value)
{
	$rows = json_decode($redis->get($listname), true);
	$rows[$count] = $value;
	$redis->SET($listname, json_encode($rows, JSON_UNESCAPED_UNICODE));
}
