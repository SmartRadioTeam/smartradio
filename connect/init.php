<?php
if(is_file("conn.lock")){
	die("系统正在升级，无法连接数据库！请稍后重试！");
}
include("command/mysql_command.php");
include("command/mysql_conn.php");
include("command/redis_conn.php");