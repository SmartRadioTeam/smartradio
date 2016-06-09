<?php

include "class_include.php";
$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_SPECIAL_CHARS);
$mode = filter_input(INPUT_POST, "mode", FILTER_SANITIZE_SPECIAL_CHARS);
if ($mode == "lostandfound")
{
	redis_delete($redis, "lostandfound", $id);
	redis_delete($redis, "lostandfound_view", $id);
} else if ($mode == "delete")
{
	redis_delete($redis, "songtable", $id);
	redis_delete($redis, "songtable_view", $id);
} else
{
	switch ($mode)
	{
		case "played":
			$table = "songtable";
			$count = $id;
			$value = "1";
			break;
		case "normalplay":
			$table = "songtable";
			$count = $id;
			$value = "0";
			break;
		case "unplay":
			$table = "songtable";
			$count = $id;
			$value = "2";
			break;
	}
	redis_update($redis, "songtable", $id, "info", $value);
	redis_update($redis, "songtable_view", $id, "info", $value);
}
$redis->SAVE();
echo '{"message":"操作完成！","mode":"success"}';
?>