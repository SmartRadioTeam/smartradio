<?php
function getlaf($con)
{
	$sql = DB_Select("lostandfound");
	$query = DB_Query($sql,$con);
	while($row = DB_Fetch_Array($query))
	{
		$messages[] = 
		"来自".
		urldecode($row["user"]).
		"同学的寻物启示：".
		urldecode($row["message"]).
		"请有拾到者拨打电话：".
		urldecode($row["tel"]).
		"。谢谢！";
	}
	return $messages;
}
function getsetting($con)
{
	$sql = DB_Select("setting");
	$query = DB_Query($sql,$con);
	while($row = DB_Fetch_Array($query))
	{
		$resultarray["permission"] = urldecode($row["permission"]);
		$resultarray["notice"] = urldecode($row["notice"]);
		$resultarray["cleantime"] = urldecode($row["cleantime"]);
		break;
	}
	return $resultarray;
}
function getsongtable($con,$redis)
{
	$sql = DB_Select("ticket_view",null,"","*","info");
	$query = DB_Query($sql,$con);
	if(DB_Num_Rows($query)!=0)
	{
		while($row = DB_Fetch_Array($query))
		{
			$resultarray["info"] = $row["info"];
			$resultarray["songinfo"]=json_decode($redis->GET($row["songid"]),true)
			$resultarray["user"] = urldecode($row["user"]);
			$resultarray["to"] = urldecode($row["to"]);
			$resultarray["message"] = "「".urldecode($row["message"])."」";
			$jsonarray[] = $resultarray;
		}
	}
	return $jsonarray;
}
?>