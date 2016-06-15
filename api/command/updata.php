<?php

include("class_include.php");
$user = filter_input(INPUT_POST, "user", FILTER_SANITIZE_SPECIAL_CHARS);
$message = filter_input(INPUT_POST, "message", FILTER_SANITIZE_SPECIAL_CHARS);
if (strlen($message) > 280)
{
	die('{"message":"祝福超过140字，请修改后重新提交！","mode":"error"}');
}

$uptime = date("Y-m-d H:i:s", time());

//获取设置
$setting = json_decode($redis->get("settings"), true);
if ($setting["permission"] == 0)
{
	die("{'message':'您没有权限提交信息!','mode':'error'}");
}
switch (filter_input(INPUT_POST, "mode", FILTER_SANITIZE_SPECIAL_CHARS))
{
	case "requestmusicpost":
		$songid = filter_input(INPUT_POST, "songid", FILTER_SANITIZE_SPECIAL_CHARS);
		$to = filter_input(INPUT_POST, "to", FILTER_SANITIZE_SPECIAL_CHARS);
		$time = filter_input(INPUT_POST, "time", FILTER_SANITIZE_SPECIAL_CHARS);
		$option = filter_input(INPUT_POST, "option", FILTER_SANITIZE_SPECIAL_CHARS);
		if ($user == "" || $message == "" || $to == "")
		{
			die('{"message":"信息不能为空","mode":"error"}');
		}
		submitsong($redis, $user, $message, $to, $time, $option, $uptime, $songid);
		break;
	case "LostandfoundPost":
		$tel = filter_input(INPUT_POST, "tel", FILTER_SANITIZE_SPECIAL_CHARS);
		if ($tel == "" || $user == "" || $message == "")
		{
			die('{"message":"信息不能为空","mode":"error"}');
		}
		submitlaf($user, $message, $tel, $uptime);
		break;
	default:
		die('{"message":"请不要提交空信息","mode":"error"}');
}
$redis->SAVE();

//提交失物招领
function submitlaf($redis, $user, $message, $tel, $uptime)
{
	//写入
	$id = $redis->incr("count_song");
	$row = array("id" => $id, "user" => $user, "tel" => $tel, "message" => $message, "uptime" => $uptime, "ip" => getip());
	redis_listadditem($redis, "lostandfound", $row);
	unset($row["ip"]);
	unset($row["uptime"]);
	redis_listadditem($redis, "lostandfound_view", $row);
	echo '{"message":"您的信息已经成功提交到数据库，请耐心等待广播站排序播放！谢谢！","mode":"success"}';
}

//提交歌曲
function submitsong($redis, $user, $message, $to, $time, $option, $uptime, $songid)
{
	get163musicinfo($redis, $songid);
	$id = $redis->incr("count_song");
	$submitinfo = array("id" => $id, "user" => $user, "songid" => $songid, "message" => $message, "to" => $to, "uptime" => $uptime, "time" => checktime($time), "ip" => getip(), "info" => "0", "option" => $option);
	redis_listadditem($redis, "songtable", $submitinfo);
	unset($submitinfo["time"]);
	unset($submitinfo["uptime"]);
	unset($submitinfo["ip"]);
	unset($submitinfo["option"]);
	redis_listadditem($redis, "songtable_view", $submitinfo);
	echo '{"message":"您的信息已经成功提交到数据库，请耐心等待广播站排序播放！谢谢！","mode":"success"}';
}

function get163musicinfo($redis, $songid)
{
	$songinfo=  json_decode($redis->get("songinfo"));
	if(array_key_exists($songid, $songinfo)){
		return;
	}
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
	$resultmusic = json_decode($output, true);
	foreach ($resultmusic["songs"][0]["artists"] as $artist)
	{
		if (isset($artists))
		{
			$artists .= "/" . $artist["name"];
		} else
		{
			$artists = $artist["name"];
		}
		$songtitle = $resultmusic["songs"][0]["name"] . " - " . $artists;
		$songcover = $resultmusic["songs"][0]["album"]["picUrl"];
		$resultarray["songtitle"] = $songtitle;
		$resultarray["songcover"] = $songcover;
		redis_listadditem($redis, "songinfo", $resultarray, $songid);
	}
}

function checktime($time)
{
	$timerarr = explode('/', $time);
	//检查点歌是否为今天，如果是今天，则延顺一天
	$time = $timerarr[1] . '-' . $timerarr[2];
	if (date('m-d') == $time)
	{
		$time = casetime($timerarr[1], sprintf("%02d", $timerarr[2] + 1));
	}
	//检查提交/延顺后的时间是否为周末，如果是周末则延到下个星期一
	$timer = explode('/', $time);
	$thistemptime = $timerarr[0] . "-" . $timer[0] . "-" . $timer[1];
	$weekday = date('l', strtotime($thistemptime));
	if ($weekday == "Saturday")
	{
		$daytime = sprintf("%02d", $timer[1] + 2);
	}
	if ($weekday == "Sunday")
	{
		$daytime = sprintf("%02d", $timer[1] + 1);
	}
	if (isset($daytime))
	{
		$time = casetime($timer[0], $time);
		$time=str_replace('/', "-", $time);
	}
	return $time;
}

//计算是否超越天数
function casetime($mouth, $day)
{
	$refushmouth = false;
	$matcharray = array(1, 3, 5, 7, 8, 10, 12);
	if (in_array($mouth, $matcharray) && $day > 31)
	{
		$refushmouth = true;
	} 
	if ($mouth != 2 && $day > 30)
	{
		$refushmouth = true;
	}
	if ($mouth == 2 && $day > 29)
	{
		$refushmouth = true;
	}
	//
	if ($refushmouth)
	{
		$time = sprintf("%02d", $mouth + 1) . '/01';
	} else
	{
		$time = $mouth . '/' . $day;
	}
	return $time;
}

function getip()
{
	if (!empty($_SERVER["HTTP_CLIENT_IP"]))
	{
		$cip = $_SERVER["HTTP_CLIENT_IP"];
	} else if (!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
	{
		$cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
	} else if (!empty($_SERVER["REMOTE_ADDR"]))
	{
		$cip = $_SERVER["REMOTE_ADDR"];
	} else
	{
		$cip = "无法获取ip数据";
	}
	return $cip;
}

?>