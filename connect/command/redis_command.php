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
	if ($a["info"] > $b["info"])
	{
		return 1;
	}
}

function redis_update($redis, $listname, $count, $option, $value)
{
	$rows = json_decode($redis->get($listname), true);
	$i = 0;
	foreach ($rows as $values)
	{
		if ($values["id"] == $count)
		{
			$values[$option] = $value;
			$rows[$i] = $values;
			break;
		}
		$i++;
	}
	usort($rows, "cmp");
	$redis->SET($listname, json_encode($rows, JSON_UNESCAPED_UNICODE));
}

function redis_delete($redis, $listname, $count)
{
	$i = 0;
	$rows = json_decode($redis->get($listname), true);
	$resultrow=array();
	foreach ($rows as $value)
	{
		if ($value["id"] != $count)
		{
			$resultrow[] = $value;
		}
		$i++;
	}
	$redis->SET($listname, json_encode($resultrow, JSON_UNESCAPED_UNICODE));
}
