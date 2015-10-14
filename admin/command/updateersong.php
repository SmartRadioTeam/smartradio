<?php
include("../login.php");
include_once("../../../class/conn.php");
$name=$_POST['name'];
$name = str_replace('<', '', $name);
$name = str_replace('>', '', $name);
$name=urlencode($name);
$sql="INSERT INTO `".MYSQLDB."`.`ersong` (`name`) VALUES ('$name');";
$result = mysql_query($sql,$con);
if($result){
    header("Location: ../go.php");
}else{
	DB_PrintError("服务器错误！请通知管理员！管理员qq：381511791");
}
?>