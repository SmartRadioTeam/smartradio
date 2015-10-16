<?php
include("class_include.php");
$id = $_POST["id"];
$user = $_POST['user'];
$name = $_POST['name'];
$message = $_POST['message'];
$to = $_POST['to'];
$location = $_POST['location'];
$user = Xss_replace($user);
$name = Xss_replace($name);
$message = Xss_replace($message);
$to = Xss_replace($to);
if(strlen($message)>280){
   System_messagebox("想说的话超过140字，请修改后重新提交！","message","/admin/index.php?mod=".$location);
    exit();
}
    //url转码
    $user = urlencode($user);
    $name = urlencode($name);
    $message = urlencode($message);
    $to = urlencode($to);
    //写入
    //$sql = "UPDATE `".MYSQLDB."`.`radio` SET `user` = '$user',`name`='$name',`message`='$message',`to`='$to' WHERE `radio`.`id` = $id;";
    $sql = DB_Update("radio",array("user" => $user,
                                   "name" => $name,
                                   "message" => $message,
                                   "to" => $to);
    $result = mysql_query($sql,$con);
    if($result){
        System_messagebox("操作成功！","success","/admin/index.php?mod=".$location);
    }else{
         DB_PrintError("服务器错误！请通知管理员！管理员qq：381511791");
    }

?>