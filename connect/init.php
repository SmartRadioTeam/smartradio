<?php
if(is_file("conn.lock")){
	DB_PrintError("系统正在升级，无法连接数据库！请稍后重试！");
}
switch(DB_SWITCH){
	case "mysql":
		include("command/mysql_command.php");
		include("command/mysql_conn.php");
		break;
	case "sqlite":
		include("command/sqlite_command.php");
		include("command/sqlite_conn.php");
		break;
	default:
		DB_PrintError("未知的数据库！");
		break;
}
function DB_PrintError($message){
	Header("Location: /error_page/disconn.php?message=".urlencode($message));
	exit();
}