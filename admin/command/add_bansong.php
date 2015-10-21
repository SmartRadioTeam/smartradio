<?php
include("class_include.php");
$songname = $_POST['songname'];
$songname = Xss_replace($songname);
if($songname == ""){
   System_messagebox("请不要提交空白信息！","message","/admin/bansong.php");
}
$sql = DB_Insert("bansong",array("songname" => "'".$songname."'"));
$result = DB_Query($sql,$con);
if($result){
	System_messagebox("操作成功！","success","/admin/bansong.php");
}else{
	DB_PrintError("服务器错误！请通知管理员！管理员qq：381511791");
}
?>