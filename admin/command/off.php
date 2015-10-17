<?php
include("class_include.php");
$message=$_POST['off'];
if($message==""){
    System_messagebox("信息不能为空","message","/admin/");
    exit();
}
$sql = "TRUNCATE TABLE `takeoff`";
$result = DB_Query($sql,$con);
//$sql = "INSERT INTO `".MYSQLDB."`.`takeoff` (`id`) VALUES ('$message');";
$sql = DB_Insert("takeoff",array("id"=>"'".$message."'"));
$result = DB_Query($sql,$con);
if($result){
    System_messagebox("操作成功","success","/admin/");
}else{
    DB_PrintError("服务器错误！请通知管理员！管理员qq：381511791");
}
?>