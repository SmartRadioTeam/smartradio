<?php
include("class_include.php");
$name=$_POST['name'];
$name = Xss_replace($name);
$name = urlencode($name);
//$sql="INSERT INTO `".MYSQLDB."`.`ersong` (`name`) VALUES ('$name');";
$sql = DB_Insert("bansong",array("name"=>"'".$name."'"));
$result = DB_Query($sql,$con);
if($result){
   System_messagebox("操作成功！","success","/admin/bansong.php");
}else{
	DB_PrintError("服务器错误！请通知管理员！管理员qq：381511791");
}
?>