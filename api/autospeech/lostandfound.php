<?php
date_default_timezone_set ('PRC');
include("../../class/conn.php");
$sql = "SELECT * FROM `lostandfound`";
$query = mysql_query($sql,$con);
while($row=mysql_fetch_array($query)){
    echo urldecode($row[user])."|".urldecode($row[message])."|".urldecode($row[tel])."|"."失物招领"."|"."06041239"."}";
}
?>