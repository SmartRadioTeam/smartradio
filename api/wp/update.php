
<?php
if($_GET["key"]=="windowphone"){
include("../../class/conn.php");
include("../../class/conf.php");
//判断是否被关闭
$sql = "SELECT * FROM `takeoff` WHERE `id`=0";
$query=mysql_query($sql,$con);
$backcount=mysql_num_rows($query); 
if($backcount==0){
echo "抱歉，系统拒绝新的点歌，详情请见公告！";
}else{
if(!empty($_SERVER["HTTP_CLIENT_IP"])){
$cip = $_SERVER["HTTP_CLIENT_IP"];
}
elseif(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
$cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
}
elseif(!empty($_SERVER["REMOTE_ADDR"])){
$cip = $_SERVER["REMOTE_ADDR"];
}else{
$cip = "NULL";
}
date_default_timezone_set ('PRC');
$uptime=date("Y-m-d H:i:s",time());

$user=$_GET['user'];
$name=$_GET['name'];
$message=$_GET['message'];
$to=$_GET['to'];
$time=$_GET['time'];
$uri=$_GET['uri'];
$option=$_GET['option'];
$time=str_replace('/', '-', $time);
if(strlen($time)>5){

$time=str_replace(substr($time,0,5), '', $time);
if(strlen($time)<4){
$res=explode("-",$time);
if(strlen($res[0])<2){$res[0]="0".$res[0];}
if(strlen($res[1])<2){$res[1]="0".$res[1];}
$time=$res[0]."-".$res[1];
}
}
//过滤
$user = str_replace('<', '', $user);
$user = str_replace('>', '', $user);
$name = str_replace('<', '', $name);
$name = str_replace('>', '', $name);
$message = str_replace('<', '', $message);
$message = str_replace('>', '', $message);
$to = str_replace('<', '', $to);
$to = str_replace('>', '', $to);
$time = str_replace('<', '', $time);
$time = str_replace('>', '', $time);
if($name==""||$user==""||$message==""||$to==""||$time==""){  
echo "信息不能为空";
}
else{
if(strlen($message)>280){
echo "祝福超过140字，请修改后发布！";
}else{
//url转码
$user=urlencode($user);
$name=urlencode($name);
$message=urlencode($message);
$to=urlencode($to);
$time=urlencode($time);
$uptime=urlencode($uptime);
$cip=urlencode($cip);
$uri=urlencode($uri);
$option=urlencode($option);
$sql = "SELECT * FROM `ersong` WHERE `name` LIKE '$name'";
$query=mysql_query($sql,$con);
$backcount=mysql_num_rows($query); 
if($backcount!=0){
header("Location: go.php?echo=".urlencode(SUBMITHSONG));
}else{
//写入
$sql = "INSERT INTO `".MYSQLDB."`.`radio` (`user`, `name`, `message`,`to`,`time`,`uptime`,`ip`,`info`,`uri`,`option`) VALUES ('$user', '$name', '$message', '$to', '$time','$uptime','$cip','0','$uri','$option');";
$result = mysql_query($sql,$con);
if($result){
echo SUBMITYES;
$sql="ALTER TABLE  `radio` ORDER BY  `info`";
mysql_query($sql,$con);
}
else{
echo SUBMITNO;
}
}
}
}
}
mysql_close($con);
}else{echo "keyword error";}
?>