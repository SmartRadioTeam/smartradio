<?php
include("conf.php");
switch (DBSWITCH) {
    case "MYSQL":
	include("dbconn/mysql_conn.php");
        break;
    case "MSSQL":
        include("dbconn/mssql_conn.php");
        break;
}