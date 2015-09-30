<?php
include("../../class/conn.php");
include("../../class/conf.php");
//判断是否被关闭
$sql = "SELECT * FROM `takeoff` WHERE `id`=0";
$query=mysql_query($sql,$con);
$backcount=mysql_num_rows($query); 
if($backcount==0){
	header("Location: go.php?echo=".urlencode("抱歉，系统拒绝新的点歌，详情请见公告！"));
}

function requestmusicpost(){
	$cip=getip();
	date_default_timezone_set ('PRC');
	$uptime=date("Y-m-d H:i:s",time());
	$user=$_POST['user'];
	$message=$_POST['message'];
	$name=$_POST['name'];
	$to=$_POST['to'];
	$time=$_POST['time'];
	$option=$_POST['option'];
	$day=$_POST['day'];
	//过滤
	$user = str_replace('<', '', $user);
	$user = str_replace('>', '', $user);
	$name = str_replace('<', '', $name);
	$name = str_replace('>', '', $name);
	$message = str_replace('<', '', $message);
	$message = str_replace('>', '', $message);
	$to = str_replace('<', '', $to);
	$to = str_replace('>', '', $to);
	$time=$time.'-'.$day;
	if($name==""||$user==""||$message==""||$to==""){  
		header("Location: go.php?echo=".urlencode("信息不能为空"));
		//todo
	}
	if(strlen($message)>280){
		header("Location: go.php?echo=".urlencode("祝福超过140字，请修改后重新提交！"));
		//todo
	}
	//url转码
	$user=urlencode($user);
	$name=urlencode($name);
	$message=urlencode($message);
	$to=urlencode($to);
	$time=urlencode($time);
	$uptime=urlencode($uptime);
	$cip=urlencode($cip);
	$option=urlencode($option);

	$sql = "SELECT * FROM `ersong` WHERE `name` LIKE '$name'";
	$query=mysql_query($sql,$con);
	$backcount=mysql_num_rows($query); 
	if($backcount!=0){
		header("Location: go.php?echo=".urlencode(SUBMITHSONG));
	}
	//写入
	$sql = "SELECT * FROM `radio` WHERE `user` LIKE '$user' AND `name` LIKE '$name' AND `message` LIKE '$message' AND `to` LIKE '$to' AND `time` LIKE '$time'";
	$query=mysql_query($sql,$con);
	if(mysql_num_rows($query)>=1){
		header("Location: go.php?echo=".urlencode("请不要重复提交歌曲！谢谢！"));
	}
	$sql = "INSERT INTO `radio` (`user`, `name`, `message`,`to`,`time`,`uptime`,`ip`,`info`,`option`) VALUES ('$user', '$name', '$message', '$to', '$time','$uptime','$cip','0','$option');";
	$result = mysql_query($sql,$con);
	if($result){
		header("Location: go.php?echo=".urlencode(SUBMITYES));
		$sql="ALTER TABLE  `radio` ORDER BY  `info`";
		mysql_query($sql,$con);
	}else{
		header("Location: go.php?echo=".urlencode(SUBMITNO));
	}
}

function LostandfoundPost(){
	$cip=getip();
	date_default_timezone_set ('PRC');
	$uptime=date("Y-m-d H:i:s",time());
	$user=$_POST['user'];
	$message=$_POST['message'];
	$tel=$_POST['tel'];
	//过滤
	$user = str_replace('<', '', $user);
	$user = str_replace('>', '', $user);
	$tel = str_replace('<', '', $tel);
	$tel = str_replace('>', '', $tel);
	$message = str_replace('<', '', $message);
	$message = str_replace('>', '', $message);
	if($tel==""||$user==""||$message==""){  
		header("Location: go.php?echo=".urlencode("信息不能为空"));
	}else{
	if(strlen($message)>280){
		header("Location: go.php?echo=".urlencode("祝福超过140字，请修改后重新提交！"));
		}else{
			//url转码
			$user=urlencode($user);
			$tel=urlencode($tel);
			$message=urlencode($message);
			$time=urlencode($time);
			$uptime=urlencode($uptime);
			//写入
			$sql = "INSERT INTO `lostandfound` (`user`, `tel`, `message`,`uptime`,`ip`) VALUES ('$user', '$tel', '$message','$uptime','$cip');";
			$result = mysql_query($sql,$con);
			if($result){
				header("Location: go.php?echo=".urlencode(SUBMITYES));
				$sql="ALTER TABLE  `lostandfound` ORDER BY  `info`";
				mysql_query($sql,$con);
			}else{
				header("Location: go.php?echo=".urlencode(SUBMITNO));
			}
		}
	}
}

function getip(){
	if(!empty($_SERVER["HTTP_CLIENT_IP"])){
		$cip = $_SERVER["HTTP_CLIENT_IP"];
	}else if(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
		$cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
	}else if(!empty($_SERVER["REMOTE_ADDR"])){
		$cip = $_SERVER["REMOTE_ADDR"];
	}else{
		$cip = "NULL";
	}
	return $cip;
}
?>