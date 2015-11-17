<?php
include("class_include.php");
$id = $_POST["id"];
$user = $_POST['user'];
$name = $_POST['name'];
$message = $_POST['message'];
$to = $_POST['to'];
$location = $_POST['location'];
//过滤器（含转码）
$user = Xss_replace($user);
$name = Xss_replace($name);
$message = Xss_replace($message);
$to = Xss_replace($to);
if(strlen($message) > 280){
   System_messagebox("想说的话超过140字，请修改后重新提交！","message","/admin/index.php?mod=".$location);
    exit();
}
//写入
$sql = DB_Update("ticket_view",array("user" => $user,"name" => $name,"message" => $message,"to" => $to));
$result = DB_Query($sql,$con);
if($result){
    System_messagebox("操作成功！","success","/admin/index.php?mod=".$location);
}else{
     DB_PrintError(DB_Error($con));
}
?>