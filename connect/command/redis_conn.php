<?php

$redis = new Redis();
if (!$redis->connect('127.0.0.1', 6379))
{
    die("{'message':'链接数据库失败！','mode','error'}");
}
//根据配置文件选择数据库
//$redis->select(0);