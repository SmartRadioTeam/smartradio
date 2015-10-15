<?php
include("class_include.php");
//$sql = "SELECT * FROM `takeoff` WHERE `id`=0";
$sql = DB_Select("takeoff",array("id"=>"=0"));
$query=mysql_query($sql,$con);
$backcount=mysql_num_rows($query); 
if($backcount==0){
	echo "error";
}