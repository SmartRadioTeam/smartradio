<?php

$redis = new Redis();
if (!$redis->connect('127.0.0.1', 6379))
{
    die("{'message':'链接数据库失败！','mode','error'}");
}