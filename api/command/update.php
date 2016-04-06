<?php
include("class_include.php");
include("../../".Package_Net."/net_getip.php");
include("../../".Package_Xss_Replace."/xss_replace.php");
$mod = $_POST["mod"];
$user = $_POST['user'];
$message = $_POST['message'];
$uptime = urlencode(date("Y-m-d H:i:s",time()));
//(TODO)检测是否禁止投稿
if($mod == "requestmusicpost")
{
	submitsong($user,$message);
}
else if ($mod = "LostandfoundPost")
{
	submitlaf($user,$message)
}
else
{
	echo '{"message":"请不要提交空信息"}';
}

//提交失物招领
function submitlaf($user,$message)
{
	$tel = $_POST['tel'];
	if($tel == ""||$user == ""||$message == "")
	{  
		die('{"message":"信息不能为空"}');
	}
	if(strlen($message) > 280)
	{
		die('{"message":"祝福超过140字，请修改后重新提交！"}');
	}
	//过滤
	$user = Xss_replace($user);
	$tel = Xss_replace($tel);
	$message = Xss_replace($message);
	//url转码(Xss_replace已包含转码
	$cip = urlencode(getip());
	//写入
	$sql = DB_Insert("lostandfound",
		array(
		"user" => $user,
		"tel" => $tel,
		"message" => $message,
		"uptime" => $uptime,
		"ip" => $cip
		));
	$result = DB_Query($sql,$con);
	if($result)
	{
		echo '{"message":"您的信息已经成功提交到数据库，请耐心等待广播站排序播放！谢谢！"}';
	}
	else
	{
		echo '{"message":"服务器错误！"'.DB_Error($con).'"}';
	}
}
//提交歌曲
function submitsong($user,$message)
{
	$songid = $_POST['songid'];
	$to = $_POST['to'];
	$time = $_POST['time'];
	$option = $_POST['option'];
	$timerarr = split('/' ,$time);
	//转换格式
 	$time = $timerarr[1].'-'.$timerarr[2];
 	//检查点歌是否为今天，如果是今天，则延顺一天
    if(date('m-d')==$time)
    {
    	 $lastday=$timerarr[2]+1;
    		$time=$timerarr[1].'-'.$lastday;
    }
    //检查提交/延顺后的时间是否为周末，如果是周末则延到下个星期一
    $thistemptime=$timerarr[0]."-".$time);
    if(date('l',strtotime($thistemptime)=="Saturday"||date('l',strtotime($thistemptime)=="Sunday")
    {
    	$time=date("m-d",strtotime("next Monday",$thistemptime));
    }
    //检查是否为空
    if($user == ""||$message == ""||$to == "")
    {   
		die('{"message":"信息不能为空"}');
	}
	if(strlen($message) > 280)
	{
		die('{"message":"祝福超过140字，请修改后重新提交！"}');
	} 
	//过滤
	$user = Xss_replace($user);
	$songid = Xss_replace($songid);
	$message = Xss_replace($message);
	$to = Xss_replace($to);
	//url转码(Xss_replace已包含转码)
	$time = urlencode($time);
	$cip = urlencode(getip());
	$option = urlencode($option);
	//检测是否重复提交
	$sql = DB_Select("ticket_view",array("user" => "LIKE "."'".$user."'","songid" => "LIKE "."'".$songid."'"));
	$query = DB_Query($sql,$con);
	if(DB_Num_Rows($query) >= 1){
		die('{"message":"请不要重复提交歌曲！谢谢！"}');
	}
	$sql = DB_Select("songtable",array("sid" => "=".$songid));
	$query = DB_Query($sql,$con);
	if(DB_Num_Rows($query) == 0){
		include("../163musicapi/command.php");
		//获取网易云音乐数据
		$resultmusic = json_decode(get_music_info($songid),true);
		$songurl = $resultmusic["songs"][0]["mp3Url"];   
		foreach($resultmusic["songs"][0]["artists"] as $artist){
		   if(isset($artists)){
		      $artists .= "/".$artist["name"];
		   }else{
		      $artists = $artist["name"];
		   }
		}
		$songtitle = urlencode($resultmusic["songs"][0]["name"]." - ".$artists);
		$songcover = $resultmusic["songs"][0]["album"]["picUrl"];
		$sql = DB_Insert("songtable",array("sid" => $songid,"songurl" => $songurl,"songtitle" => $songtitle,"songcover" => $songcover));
		$result = DB_Query($sql,$con);
	}
	//写入数据库
	$sql = DB_Insert("ticket_view",array("user" => $user,"songid" => $songid,"message" => $message,"to" => $to,"time" => $time,"uptime" => $uptime,"ip" => $cip,"info" => "0","option" => $option));
	$result = DB_Query($sql,$con);
 	$sql = DB_Insert("ticket_log",array("user" => $user,"songid" => $songid,"message" => $message,"to" => $to,"time" => $time,"uptime" => $uptime,"ip" => $cip,"info" => "0","option" => $option));
	$result = DB_Query($sql,$con);
	if($result){
		echo '{"message":"您的信息已经成功提交到数据库，请耐心等待广播站排序播放！谢谢！"}';
	}else{
		echo '{"message":"服务器错误！"'.DB_Error($con).'"}';
	}
}

?>