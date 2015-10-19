<?php
include("../../config/init.php");
include("../../connect/init.php");
include("../../".Package_Net."/net_getip.php");
include("../../".Package_System."/messagebox/messagebox.php");
include("../../".Package_Xss_Replace."xss_replace");
date_default_timezone_set ('PRC');
$sql = DB_Select("takeoff",array("id" => "= 0"));
$query = DB_Query($sql,$con);
$backcount = DB_Num_Rows($query);
if($backcount == 0){
    System_messagebox("抱歉，系统拒绝提交新信息，详情请见公告！","message","/touch/");
	exit();
}
switch($_POST["mod"]){
	case "requestmusicpost":
		requestmusicpost();
		break;
	case "LostandfoundPost":
		LostandfoundPost();
		break;
}

function requestmusicpost(){
	$user = $_POST['user'];
	$message = $_POST['message'];
	$name = $_POST['name'];
	$to = $_POST['to'];
	$time = $_POST['time'];
	$option = $_POST['option'];
	$day = $_POST['day'];
	//过滤
	$user = Xss_replace($user);
	$name = Xss_replace($name);
	$message = Xss_replace($message);
	$to = Xss_replace($to);
	$time = $time.'-'.$day;
	if($name == ""||$user == ""||$message == ""||$to == ""){  
		System_messagebox("信息不能为空","message","/touch/");
		exit();
	}
	if(strlen($message) > 280){
		System_messagebox("祝福超过140字，请修改后重新提交！","message","/touch/");
		exit();
	}
	//url转码(Xss_replace已包含转码)
	$time = urlencode($time);
	$uptime = urlencode(date("Y-m-d H:i:s",time()));
	$cip = urlencode(getip());
	$option = urlencode($option);
	//检查是否为禁播歌曲
	$sql = DB_Select("ersong",array("name"=>"LIKE "."'".$name."'"));
	$query = DB_Query($sql,$con);
	$backcount = DB_Num_Rows($query); 
	if($backcount != 0){
		System_messagebox("您点播的歌曲为禁止点播歌曲，无法提交到点歌台。请更换后再提交！","message","/touch");
		exit();
	}
	//检测是否重复提交
	$sql = DB_Select("radio",array("user" => "LIKE "."'".$user."'","name" => "LIKE "."'".$name."'"));
	$query = DB_Query($sql,$con);
	if(DB_Num_Rows($query) >= 1){
		System_messagebox("请不要重复提交歌曲！谢谢！","message","/touch");
		exit();
	}
	//写入数据库
	$sql = DB_Insert("radio",array("user" => $user,"name" => $name,"message" => $message,"to" => $to,"time" => $time,"uptime" => $uptime,"ip" => $cip,"info" => "0","option" => $option));
 $sql = DB_Insert("ticket_log",array("user" => $user,"name" => $name,"message" => $message,"to" => $to,"time" => $time,"uptime" => $uptime,"ip" => $cip,"info" => "0","option" => $option));
	//$sql = "INSERT INTO `radio` (`user`, `name`, `message`,`to`,`time`,`uptime`,`ip`,`info`,`option`) VALUES ('$user', '$name', '$message', '$to', '$time','$uptime','$cip','0','$option');";
	$result = DB_Query($sql,$con);
	if($result){
	 //排序优先级作为输出时条件
		System_messagebox("您的信息已经成功提交到数据库，请耐心等待广播站排序播放！谢谢！","success","/touch/");
		exit();
	}else{
		System_messagebox("服务器错误！请通知管理员！管理员qq：381511791","message","/touch/");
		exit();
	}
}

function LostandfoundPost(){
	$uptime = date("Y-m-d H:i:s",time());
	$user = $_POST['user'];
	$message = $_POST['message'];
	$tel = $_POST['tel'];
	//过滤
	$user = Xss_replace($user);
	$tel = Xss_replace($tel);
	$message = Xss_replace($message);
	if($tel == ""||$user == ""||$message == ""){  
		System_messagebox("信息不能为空","message","/touch/");
		exit();
	}
	if(strlen($message) > 280){
		System_messagebox("祝福超过140字，请修改后重新提交！","message","/touch/");
		exit();
	}
	//url转码(Xss_replace已包含转码)
	$uptime = urlencode(date("Y-m-d H:i:s",time()));
	$cip = urlencode(getip());
	//写入
	$sql = DB_Insert("lostandfound",array("user" => $user,"tel" => $tel,"message" => $message,"uptime" => $uptime,"ip" => $cip));
	//$sql = "INSERT INTO `lostandfound` (`user`, `tel`, `message`,`uptime`,`ip`) VALUES ('$user', '$tel', '$message','$uptime','$cip');";
	$result = mysql_query($sql,$con);
	if($result){
	   //排序任务交给前端处理
	   		System_messagebox("您的信息已经成功提交到数据库，请耐心等待广播站排序播放！谢谢！","success","/touch/");
		exit();
	}else{
		System_messagebox("服务器错误！","message","/touch");
		exit();
	}
}
?>