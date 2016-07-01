<?php
include("class_include.php");
cleantable($redis,"songtable");
cleantable($redis,"songtable_view");
echo "ok";
function cleantable($redis,$listname){
    $i = 0;
    $rows = json_decode($redis->get($listname), true);
    $resultrow=array();
    foreach ($rows as $value)
    {
        if ($value["info"] == 0)
        {
            $resultrow[] = $value;
        }
        $i++;
    }
    $redis->SET($listname, json_encode($resultrow, JSON_UNESCAPED_UNICODE));
}

