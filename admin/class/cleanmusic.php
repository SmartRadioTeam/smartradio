<?php
date_default_timezone_set ('PRC');
$time=date("Y-m-d H:i:s",time());
error_reporting(0); 

include_once("../../class/conn.php");
$sql = "SELECT * FROM `radio`";
$query = mysql_query($sql,$con);
while($row=mysql_fetch_array($query)){
$id=$row[id];
if($row[info]!=0){
$sql = "INSERT INTO `".MYSQLDB."`.`timemachine` (`user`, `name`, `message`,`to`,`time`,`option`) VALUES ('$row[user]', '$row[name]', '$row[message]', '$row[to]', '$row[time]','$row[option]');";
mysql_query($sql,$con);
$sql="DELETE FROM `".MYSQLDB."`.`radio` WHERE `radio`.`id` = $id;";
mysql_query($sql,$con);
}
}
$sql = "TRUNCATE TABLE `timetable`";
$result = mysql_query($sql,$con);
$sql = "INSERT INTO `".MYSQLDB."`.`timetable` (`deltime`) VALUES ('$time');";
$result = mysql_query($sql,$con);
mysql_close($con);
header("Location: ../go.php");
?>