<?php
include("../../class/conf.php");
include("../../class/conn.php");
$old=$_GET['old'];
$new=$_GET['new'];
$old=iconv("UTF-8","gbk//TRANSLIT",$old);
$new=iconv("UTF-8","gbk//TRANSLIT",$new);
$new=urlencode($new);
$old=urlencode($old);
$sql = "UPDATE `radio` SET `uri` = '$new' WHERE `uri` = '".$old."';";
$result = mysql_query($sql,$con);
$sql="ALTER TABLE `radio` ORDER BY  `info`";
mysql_query($sql,$con);
?>	
