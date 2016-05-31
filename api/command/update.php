<?php
include("class_include.php");
$mod = $_POST["mod"];
$user = $_POST['user'];
$message = $_POST['message'];
if(strlen($message) > 280)
{
	die('{"message":"祝福超过140字，请修改后重新提交！","mod":"error"}');
} 
$uptime = urlencode(date("Y-m-d H:i:s",time()));
$sql = DB_Select("setting");
$query = DB_Query($sql,$con);
while($row = DB_Fetch_Array($query))
{
	if($row["permission"]==false)
	{
		die("{'message':'您没有权限提交信息!','mod':'error'}");
	}
	break;
}
//(TODO)检测是否禁止投稿
switch ($mod)
{
	case "requestmusicpost":
		submitsong($con,$redis,$user,$message,$uptime);
		break;
	case "LostandfoundPost":
		submitlaf($con,$user,$message,$uptime);
		break;
	default:
		die('{"message":"请不要提交空信息","mod":"error"}');
}
$redis->SAVE();



//提交失物招领
function submitlaf($redis,$user,$message,$uptime)
{
	$tel = $_POST['tel'];
	if($tel == ""||$user == ""||$message == "")
	{
		die('{"message":"信息不能为空","mod":"error"}');
	}
	//过滤
	$user = Xss_replace($user);
	$tel = Xss_replace($tel);
	$message = Xss_replace($message);
	//url转码(Xss_replace已包含转码
	$cip = urlencode(getip());
	//写入
	$row=array("user" => $user,"tel" => $tel,"message" => $message,"uptime" => $uptime,"ip" => $cip);
	redis_listadditem($redis,"lostandfound",$row);
	unset($row["ip"]);
	unset($row["uptime"]);
	redis_listadditem($redis,"lostandfound_view",$row);
	echo '{"message":"您的信息已经成功提交到数据库，请耐心等待广播站排序播放！谢谢！","mod":"success"}';
}
//提交歌曲
function submitsong($redis,$user,$message,$uptime)
{
	$songid = $_POST['songid'];
	$to = $_POST['to'];
	$time = $_POST['time'];
	$option = $_POST['option'];
	$time=checktime($time);
    //检查是否为空
    if($user == ""||$message == ""||$to == "")
    {   
		die('{"message":"信息不能为空","mod":"error"}');
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
	$submitinfo = array("user" => $user,"songid" => $songid,"message" => $message,"to" => $to,"time" => $time,"ip" => $cip,"info" => "0","option" => $option);
	redis_listadditem($redis,"songtable",$submitinfo);
	unset($submitinfo["ip"]);
	unset($submitinfo["option"]);
	redis_listadditem($redis,"songtable_view",$submitinfo);
	echo '{"message":"您的信息已经成功提交到数据库，请耐心等待广播站排序播放！谢谢！","mod":"success"}';
}
function get163musicinfo($redis,$songid)
{
	$refer = "http://music.163.com/";
    $header[] = "Cookie: appver=1.9.2.109452;";
    $ch = curl_init();
    $url = "http://music.163.com/api/song/detail/?id=" . $songid . "&ids=%5B" . $songid . "%5D";
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
    curl_setopt($ch, CURLOPT_REFERER, $refer);
    $output = curl_exec($ch);
    curl_close($ch);
    //发起请求结束
	$resultmusic = json_decode($output,true);  
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
		$songtitle = urlencode($resultmusic["songs"][0]["name"]." - ".$artists);
		$songcover = $resultmusic["songs"][0]["album"]["picUrl"];
		$resultarray["songtitle"]=$songtitle;
		$resultarray["songcover"]=$songcover;
		redis_listadditem($redis,"songinfo",$resultarray);
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
function Xss_replace($string)
{
	$string = str_replace('<', '（', $string);
	$string = str_replace('>', '）', $string);
	$string = urlencode($string);
	return $string;
}


?>