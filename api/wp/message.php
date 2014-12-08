<?php
include("../../class/conn.php");
$sql = "SELECT * FROM `timetable`";
$query = mysql_query($sql,$con);
while($row=mysql_fetch_array($query)){
echo $row[deltime];
}
$sql = "SELECT * FROM `message`";
$query = mysql_query($sql,$con);
while($row=mysql_fetch_array($query)){
echo "|".urldecode($row[message]);
}
mysql_close($con);
?>