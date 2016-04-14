<?php
include("class_include.php");
include("../../".Package_Xss_Replace."/xss_replace.php");
$mod = $_POST["mod"];
$user = $_POST['user'];
$message = $_POST['message'];
if(strlen($message) > 280)
{
	die('{"message":"祝福超过140字，请修改后重新提交！","mod":"error"}');
} 
$uptime = urlencode(date("Y-m-d H:i:s",time()));
//(TODO)检测是否禁止投稿
switch ($mod)
{
	case "requestmusicpost":
		submitsong($con,$user,$message,$uptime);
		break;
	case "LostandfoundPost":
		submitlaf($con,$user,$message,$uptime);
		break;
	default:
		die('{"message":"请不要提交空信息","mod":"error"}');
}

//提交失物招领
function submitlaf($con,$user,$message,$uptime)
{
	$tel = $_POST['tel'];
	if($tel == ""||$user == ""||$message == "")
	{  
		die('{"message":"信息不能为空"}');
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
					)
		);
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
function submitsong($con,$user,$message,$uptime)
{
	$songid = $_POST['songid'];
	$to = $_POST['to'];
	$time = $_POST['time'];
	$option = $_POST['option'];
	$time=checktime($time);
    //检查是否为空
    if($user == ""||$message == ""||$to == "")
    {   
		die('{"message":"信息不能为空"}');
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
	$sql = DB_Select("ticket_view",
						array("user" => "LIKE "."'".$user."'",
							"songid" => "LIKE "."'".$songid."'")
						);
	$query = DB_Query($sql,$con);
	if(DB_Num_Rows($query) >= 1)
	{
		die('{"message":"请不要重复提交歌曲！谢谢！"}');
	}

	//写入数据库
	$sql = DB_Insert("ticket_view",array("user" => $user,"songid" => $songid,"message" => $message,"to" => $to,"time" => $time,"uptime" => $uptime,"ip" => $cip,"info" => "0","option" => $option));
	$result = DB_Query($sql,$con);
 	$sql = DB_Insert("ticket_log",array("user" => $user,"songid" => $songid,"message" => $message,"to" => $to,"time" => $time,"uptime" => $uptime,"ip" => $cip,"info" => "0","option" => $option));
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
function get163musicinfo()
{
	$sql = DB_Select("songtable",array("sid" => "=".$songid));
	$query = DB_Query($sql,$con);
	if(DB_Num_Rows($query) == 0)
	{
		include("../163musicapi/command.php");
		//获取网易云音乐数据
		$resultmusic = json_decode(get_music_info($songid),true);
		$songurl = $resultmusic["songs"][0]["mp3Url"];   
		foreach($resultmusic["songs"][0]["artists"] as $artist)
		{
		   if(isset($artists))
		   {
		      $artists .= "/".$artist["name"];
		   	}
		   	else
		   	{
		      $artists = $artist["name"];
		   	}
		}
		$songtitle = urlencode($resultmusic["songs"][0]["name"]." - ".$artists);
		$songcover = $resultmusic["songs"][0]["album"]["picUrl"];
		$sql = DB_Insert("songtable",array("sid" => $songid,"songurl" => $songurl,"songtitle" => $songtitle,"songcover" => $songcover));
		$result = DB_Query($sql,$con);
	}
}
function checktime($time)
{
	$timerarr = explode('/' ,$time);
	//转换格式
 	$time = $timerarr[1].'-'.$timerarr[2];
 	//检查点歌是否为今天，如果是今天，则延顺一天
    if(date('m-d')==$time)
    {
    	$lastday=sprintf("%02d",$timerarr[2]+1);
    }
    //检查提交/延顺后的时间是否为周末，如果是周末则延到下个星期一
    $thistemptime=$timerarr[0]."-".$time;
    $weekday=date('l',strtotime($thistemptime));
    if($weekday=="Saturday")
    {
    	$lastday=sprintf("%02d",$timerarr[2]+2);
    }
    if($weekday=="Sunday")
    {
    	$lastday=sprintf("%02d",$timerarr[2]+1);
    }
    return casetime($timerarr[1],$lastday);
}
//计算是否超越天数
function casetime($mouth,$day)
{
	switch($mouth){
		case 1:
		case 3:
		case 5:
		case 7:
		case 8:
		case 10:
		case 12:
			$flag=0;
			break;
		case 4:
		case 6:
		case 9:
		case 11:
			$flag=1;
			break;
		case 2:
			$flag=2;
			break;
	}
	if($flag==2&&$day<=29)
	{
		$time=$mouth.'-'.$day;
	}
	else if($flag==1&&$day<=30)
	{
		$time=$mouth.'-'.$day;
	}
	else if($flag==0&&$day<=31)
	{
		$time=sprintf("%02d",$mouth+1).'-01';
	}
	return $time;
}
function getip()
{
	if(!empty($_SERVER["HTTP_CLIENT_IP"]))
	{
		$cip = $_SERVER["HTTP_CLIENT_IP"];
	}
	else if(!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
	{
		$cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
	}
	else if(!empty($_SERVER["REMOTE_ADDR"]))
	{
		$cip = $_SERVER["REMOTE_ADDR"];
	}
	else
	{
		$cip = "无法获取ip数据";
	}
	return $cip;
}
?>