<?php

function redis_listadditem($redis, $listname, $row, $count = "")
{
	if ($redis->exists($listname))
	{
		$rows = json_decode($redis->get($listname), true);
	}
	if ($count == "")
	{
		$rows[] = $row;
	} else
	{
		$rows[$count] = $row;
	}
	$redis->SET($listname, json_encode($rows, JSON_UNESCAPED_UNICODE));
}

function redis_update($redis, $listname, $count, $option, $value)
{
	$rows = json_decode($redis->get($listname), true);
	$rows[$count][$option] = $value;
	$redis->SET($listname, json_encode($rows, JSON_UNESCAPED_UNICODE));
}

function redis_delete($redis, $listname, $table,$count)
{
	$i=0;
	$rows = json_decode($redis->get($listname), true);
	foreach($rows[$table] as $value ){
		if($value["id"]==$count){
			unset($rows[$table][$i]);
			$i++;
		}
	}
	$redis->SET($listname, json_encode($rows, JSON_UNESCAPED_UNICODE));
}
