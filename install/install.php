<?php
include("../package/file/writefile.php");
include("../package/system/messagebox/messagebox.php");
if(is_file("../config/install.lock")){
	System_messagebox("安装程序已经被锁定，请删除config文件夹下的安装锁定程序！","message","/");
	exit();
}
$projectname = $_POST['projectname'];
$dbhost = $_POST['dbhost'];
$dbuser = $_POST['dbuser'];
$dbpasswd = $_POST['dbpasswd'];
$dbname = $_POST['dbname'];
$adminuser = $_POST['adminuser'];
$adminpasswd = $_POST["adminpasswd"];
if($projectname == ''||
	$dbuser == ''||
	$dbpasswd == ''||
	$dbname == ''||
	$adminuser == ''||
	$adminpasswd == ''){
	System_messagebox("表单信息不能为空，请重新填写","message","/");
	exit();
}
if($dbhost == ""){
   $dbhost = "localhost";
}
$jsonarray['DB_Host'] = $dbhost;
$jsonarray['DB_User'] = $dbuser;
$jsonarray['DB_Password'] = $dbpasswd;
$jsonarray['DB_Name'] = $dbname;
$jsonarray['Project_Name'] = $projectname;
Writefile("../config/setting.json",json_encode($jsonarray,JSON_UNESCAPED_UNICODE));
include("../config/init.php");
include("../connect/init.php");
//创建表
$sql_array[] = 'CREATE TABLE IF NOT EXISTS `lostandfound` (`id` int(11) NOT NULL AUTO_INCREMENT,`user` text NOT NULL,`tel` text NOT NULL,`message` text NOT NULL,`uptime` text NOT NULL,`ip` text NOT NULL,PRIMARY KEY (`id`))';
$sql_array[] = 'CREATE TABLE IF NOT EXISTS `setting` (`notice` text NOT NULL,`permission` int(11) NOT NULL,`cleantime` text NOT NULL,`id` int(11) NOT NULL AUTO_INCREMENT,PRIMARY KEY (`id`))';
$sql_array[] = 'CREATE TABLE IF NOT EXISTS `ticket_view` (`id` int(11) NOT NULL AUTO_INCREMENT,`songname` text NOT NULL,`user` text NOT NULL,`message` text NOT NULL,`to` text NOT NULL,`time` text NOT NULL,`uptime` text NOT NULL,`ip` text NOT NULL,`info` int(11) NOT NULL DEFAULT "0",`uri` text,`option` text NOT NULL,PRIMARY KEY (`id`))';
$sql_array[] = 'CREATE TABLE IF NOT EXISTS `ticket_log` (`id` int(11) NOT NULL AUTO_INCREMENT,`songname` text NOT NULL,`user` text NOT NULL,`message` text NOT NULL,`to` text NOT NULL,`time` text NOT NULL,`uptime` text NOT NULL,`ip` text NOT NULL,`info` int(11) NOT NULL DEFAULT "0",`uri` text,`option` text NOT NULL,PRIMARY KEY (`id`))';
$sql_array[] = 'CREATE TABLE IF NOT EXISTS `adminuser` (`usermd5` text NOT NULL,`user` int(11) NOT NULL,`password` text NOT NULL,`id` int(11) NOT NULL AUTO_INCREMENT,PRIMARY KEY (`id`))';
foreach($sql_array as $val){
   if(!DB_Query($val,$con)){
      echo DB_Error($con);
      exit();
   }
}
//写入用户信息
$sql =DB_Insert("adminuser",array("user"=>$adminuser,"usermd5"=>md5($adminuser),"password"=>md5($adminpasswd)));
$result = DB_Query($sql,$con); 
if($result){
	fopen("../config/install.lock", "w");
	System_messagebox("安装成功！点击确定跳转到首页。","success","/");
}else{
	DB_printerror(DB_Error($con));
}