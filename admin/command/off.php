<?php
include("../login.php");
include("../../../class/conn.php");
$message=$_POST['off'];
if($message==""){
    echo "信息不能为空";
}
$sql = "TRUNCATE TABLE `takeoff`";
$result = mysql_query($sql,$con);
$sql = "INSERT INTO `".MYSQLDB."`.`takeoff` (`id`) VALUES ('$message');";
$result = mysql_query($sql,$con);
if($result){
    header("Location: ../go.php");
}else{
    echo "服务器错误！请通知管理员！管理员qq：381511791";
}
?>