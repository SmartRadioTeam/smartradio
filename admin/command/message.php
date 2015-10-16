<?php
include("class_include.php");
$message = $_POST['message']; 
$message = urlencode($message);
$sql = "TRUNCATE TABLE `message`";
$result = mysql_query($sql,$con);
if($message!=""){
    //$sql = "INSERT INTO `".MYSQLDB."`.`message` (`message`) VALUES ('$message');";
    $sql = DB_Insert("message",array("message"=>"'".$message."'"));
    $result = DB_Query($sql,$con);
}
if($result){
    System_messagebox("操作成功！","success","/admin/");
}else{
    DB_PrintError("服务器错误！请通知管理员！管理员qq：381511791");
}
?>