<?php
include("../../class/conn.php");
include("../../class/conf.php");
//�ж��Ƿ񱻹ر�
$sql = "SELECT * FROM `takeoff` WHERE `id`=0";
$query=mysql_query($sql,$con);
$backcount=mysql_num_rows($query); 
if($backcount==0){
echo "error";
}