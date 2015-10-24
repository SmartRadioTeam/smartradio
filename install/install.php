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
	$dbhost == ''||
	$dbuser == ''||
	$dbpasswd == ''||
	$dbname == ''||
	$adminuser == ''||
	$adminpasswd == ''){
	System_messagebox("表单信息不能为空，请重新填写","message","/");
	exit();
}
$jsonarray['DB_Host'] = $dbhost;
$jsonarray['DB_User'] = $dbuser;
$jsonarray['DB_Password'] = $dbpasswd;
$jsonarray['DB_Name'] = $dbname;
$jsonarray['Project_Name'] = $projectname;
Writefile("../config/setting.json",json_encode($jsonarray,JSON_UNESCAPED_UNICODE));
include("../config/init.php");
include("../connect/init.php");
$sql = file_get_contents("../Datebase/db_source.sql");
$result = DB_Query($sql,$con);
if(!$result){
	DB_printerror(DB_Error($con));
	exit();
}
$sql =DB_Insert("adminuser",array("user"=>$adminuser,"usermd5"=>md5($adminuser),"password"=>md5($adminpasswd)));
$result = DB_Query($sql,$con); 
if($result){
	fopen("../config/install.lock", "w");
	System_messagebox("安装成功！点击确定跳转到首页。","success","/");
}else{
	DB_printerror(DB_Error($con));
}
