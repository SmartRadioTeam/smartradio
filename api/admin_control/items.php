<?php

include "class_include.php";
if ($_POST["multi"] == "true")
{
    $id = json_decode($_POST["id"], true);
} else
{
    $id[] = $_POST["id"];
}
$mode = $_POST["mode"];
$i = 0;
while ($i < count($id))
{
    $ids = $id[$i];
    $i++;
    if ($mode == "lostandfound")
    {
        redis_delete($redis, "lostandfound", $ids);
        redis_delete($redis, "lostandfound_view", $ids);
    } else
    {
        if ($mode == "delete")
        {
            redis_delete($redis, "songtable", $ids);
            redis_delete($redis, "songtable_view", $ids);
        } else
        {
            switch ($mode)
            {
                case "played":
                    $value = 1;
                    break;
                case "normalplay":
                    $value = 0;
                    break;
                case "unplay":
                    $value = 2;
                    break;
            }
            redis_update($redis, "songtable", $ids, "info", $value);
            redis_update($redis, "songtable_view", $ids, "info", $value);
        }
    }
}
$redis->SAVE();
echo '{"mode":"success"}';