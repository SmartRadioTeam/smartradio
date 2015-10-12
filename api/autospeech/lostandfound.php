<?php
date_default_timezone_set ('PRC');
include("../../class/conn.php");
//$sql = "SELECT * FROM `lostandfound`";
$sql = DB_Select("lostandfound");
$query = DB_Query($sql,$con);
while($row=DB_Fetch_Array($query)){
    echo urldecode($row["user"])."|".urldecode($row["message"])."|".urldecode($row["tel"])."|"."失物招领"."|"."06041239"."}";
}
?>