<?php
include("../conf.php");
error_reporting(0); 
$con = mysql_connect(MYSQLHOST,MYSQLUSER,MYSQLPASSWORD);
if (!$con)
  { 
Header( "Location: ../class/dbconn/disconn.php" );
  }
mysql_select_db(MYSQLDB);
mysql_query("SET NAMES UTF8");