<?php
include("class_include.php");
$sql = DB_Select("lostandfound");
$query = DB_Query($sql,$con);
while($row = DB_Fetch_Array($query))
{
urldecode($row["uptime"])
urldecode($row["user"])
urldecode($row["tel"])
urldecode($row["message"])
urldecode($row["ip"]);
}
?>