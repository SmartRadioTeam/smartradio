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

function cmp($a, $b)
{
	if ($a["option"] > $b["option"])
	{
		return 1;
	}
}

function redis_update($redis, $listname, $count, $option, $value)
{
	$rows = json_decode($redis->get($listname), true);
	$rows[$count][$option] = $value;
	usort($rows, "cmp");
	$redis->SET($listname, json_encode($rows, JSON_UNESCAPED_UNICODE));
}

function redis_delete($redis, $listname, $count)
{
	$i = 0;
	$rows = json_decode($redis->get($listname), true);
	foreach ($rows as $value)
	{
		if ($value["id"] == $count)
		{
			unset($rows[$i]);
			$i++;
		}
	}
	$redis->SET($listname, json_encode($rows, JSON_UNESCAPED_UNICODE));
}
