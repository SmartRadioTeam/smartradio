<?php

include("../../class/conf.php");
include("../../class/conn.php");
$sql = "SELECT * FROM `radio`";
$query = mysql_query($sql,$con);
while($row=mysql_fetch_array($query)){
	echo urldecode($row[name])."｜".urldecode($row[user])."｜".urldecode($row[to])."｜"."「".urldecode($row[message])."」｜".$row[info]."｜〕";
}
?>