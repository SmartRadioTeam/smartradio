<?php
if(!($con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD))){ 
	DB_PrintError('Could not connect: ' . mysql_error());
}
mysql_select_db(DB_NAME);
mysql_query("SET NAMES UTF8");