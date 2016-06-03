<?php
include "class_include.php";
switch($_POST['mode'])
{
	case "notice":
		$value = urlencode($_POST['message']); 
		break;
	case "permission":
		$value = $_POST["off"];
		break;
}
redis_overried_update($redis,"settings",$_POST['mode'],$value);
echo '{"message":"操作成功！","mod":"success"}';

$redis->save();
function redis_overried_update($redis,$listname,$count,$value)
{
	$rows = json_decode($redis->get($listname),true);
	$rows[$count]=$value;
	$redis->SET($listname,json_encode($rows,JSON_UNESCAPED_UNICODE));
}