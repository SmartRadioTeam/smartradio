<?php
function redis_listadditem($redis,$listname,$row)
{
	if($redis->exists($listname))
	{
		$rows = json_decode($redis->get($listname),true);
	}
	$rows[] = $row;
	$redis->SET($listname,json_encode($rows,JSON_UNESCAPED_UNICODE));

}
function redis_update($redis,$listname,$count,$option,$value)
{
	$rows = json_decode($redis->get($listname),true);
	$rows[$count][$option]=$value;
	$redis->SET($listname,json_encode($rows,JSON_UNESCAPED_UNICODE));
}
function redis_delete($redis,$listname,$count)
{
	$rows = json_decode($redis->get($listname),true);
	$rows = unset($rows[$count]);
	$redis->SET($listname,json_encode($rows,JSON_UNESCAPED_UNICODE));
}