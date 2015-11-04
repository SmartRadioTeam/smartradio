<?php
include("class_include.php");
include("../../".Package_Net."/net_getip.php");
include("../../".Package_Xss_Replace."xss_replace");
$sql = DB_Select("takeoff",array("id" => "= 0"));
$query = DB_Query($sql,$con);
$backcount = DB_Num_Row?s($query);
if($backcount == 0){
    echo "抱歉，系统拒绝提交新信息，详情请见公告！";
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
	$songname = $_POST['songname'];
	$to = $_POST['to'];
	$time = $_POST['time'];
	$option = $_POST['option'];
	$day = $_POST['day'];
	//过滤
	$user = Xss_replace($user);
	$songname = Xss_replace($songname);
	$message = Xss_replace($message);
	$to = Xss_replace($to);
	$time = $time.'-'.$day;
	if($name == ""||$user == ""||$message == ""||$to == ""){  
		System_messagebox("信息不能为空","message","/touch/");
		exit();
	}
	if(strlen($message) > 280){
		echo "祝福超过140字，请修改后重新提交！";
		exit();
	}
	//url转码(Xss_replace已包含转码)
	$time = urlencode($time);
	$uptime = urlencode(date("Y-m-d H:i:s",time()));
	$cip = urlencode(getip());
	$option = urlencode($option);
	//检查是否为禁播歌曲
	$sql = DB_Select("bansong",array("songname"=>"LIKE "."'".$songname."'"));
	$query = DB_Query($sql,$con);
	$backcount = DB_Num_Rows($query); 
	if($backcount != 0){
		echo "您点播的歌曲为禁止点播歌曲，无法提交到点歌台。请更换后再提交！";
		exit();
	}
	//检测是否重复提交
	$sql = DB_Select("ticket_view",array("user" => "LIKE "."'".$user."'","songname" => "LIKE "."'".$songname."'"));
	$query = DB_Query($sql,$con);
	if(DB_Num_Rows($query) >= 1){
		echo "请不要重复提交歌曲！谢谢！";
		exit();
	}
	//写入数据库
	$sql = DB_Insert("ticket_view",array("user" => $user,"songname" => $songname,"message" => $message,"to" => $to,"time" => $time,"uptime" => $uptime,"ip" => $cip,"info" => "0","option" => $option));
 $sql = DB_Insert("ticket_log",array("user" => $user,"songname" => $songname,"message" => $message,"to" => $to,"time" => $time,"uptime" => $uptime,"ip" => $cip,"info" => "0","option" => $option));
	$result = DB_Query($sql,$con);
	if($result){
		echo "您的信息已经成功提交到数据库，请耐心等待广播站排序播放！谢谢！";
		exit();
	}else{
		echo "服务器错误！请通知管理员！管理员qq：381511791";
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
		echo "信息不能为空";
		exit();
	}
	if(strlen($message) > 280){
		"祝福超过140字，请修改后重新提交！";
		exit();
	}
	//url转码(Xss_replace已包含转码)
	$uptime = urlencode(date("Y-m-d H:i:s",time()));
	$cip = urlencode(getip());
	//写入
	$sql = DB_Insert("lostandfound",array("user" => $user,"tel" => $tel,"message" => $message,"uptime" => $uptime,"ip" => $cip));
	$result = mysql_query($sql,$con);
	if($result){
	   		echo "您的信息已经成功提交到数据库，请耐心等待广播站排序播放！谢谢！";
		exit();
	}else{
		echo "服务器错误！";
		exit();
	}
}
?>