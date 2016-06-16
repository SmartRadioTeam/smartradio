<?php

include "class_include.php";
if (filter_input(INPUT_POST, "muilt", FILTER_SANITIZE_SPECIAL_CHARS) == "true")
{
	$id = json_decode(filter_input(INPUT_POST, "id", FILTER_UNSAFE_RAW), true);
	$muilt = true;
} else
{
	$id[] = filter_input(INPUT_POST, "id", FILTER_SANITIZE_SPECIAL_CHARS);
}

foreach ($id as $ids)
{
	$mode = filter_input(INPUT_POST, "mode", FILTER_SANITIZE_SPECIAL_CHARS);
	if ($mode == "lostandfound")
	{
		redis_delete($redis, "lostandfound", $ids);
		redis_delete($redis, "lostandfound_view", $ids);
	}
	if ($mode == "delete")
	{
		redis_delete($redis, "songtable", $ids);
		redis_delete($redis, "songtable_view", $ids);
	} else
	{
		switch ($mode)
		{
			case "played":
				$value = "1";
				break;
			case "normalplay":
				$value = "0";
				break;
			case "unplay":
				$value = "2";
				break;
		}
		redis_update($redis, "songtable", $ids, "info", $value);
		redis_update($redis, "songtable_view", $ids, "info", $value);
	}
}
$redis->SAVE();
echo '{"command":"' . $mode . '","mode":"success","muilt":"' . $muilt . '"}';