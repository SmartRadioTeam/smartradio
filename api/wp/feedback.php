<?php
if($_GET['key']=="wp8"){
include_once("../../class/conn.php");
$message=$_GET['message'];
$message=urlencode($message);
$sql="INSERT INTO `".MYSQLDB."`.`feedback` (`message`) VALUES ('$message');";
$result = mysql_query($sql,$con);
if($result){
echo "非常感谢您的反馈，您反馈的信息将帮助sumradio系统更好的发展!";}
else{
echo "嗯哼~系统出错了哦~检查下你的信息里是不是有什么不该输入的东西吧~";
}
mysql_close($con);
}else{
echo "error key";
}
?>