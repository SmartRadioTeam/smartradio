<?php
include("class_include.php");
if(isset($_GET['mode']))
{
    $mode = $_GET['mode'];
}
if($mode == "today")
{
  	$today = date("m-d",time());
}
else if($mode == "search")
{
 	$arr = split('-' , $_POST['date']);
  	$today = $arr[1].'-'.$arr[2]; 
}
if(!isset($today))
{
	$sql = DB_Select("ticket_view",null,"","*","`info`");
}
else
{
	$sql = DB_Select($mode == "search"?"ticket_log":"ticket_view",array('time' => "='".$today."'"),"","*","`info`");
}
$query = DB_Query($sql,$con);
if(DB_Num_Rows($query)!=0)
{
	$sql = DB_Select("songtable");
	$Songtable = DB_Query($sql,$con);
	while($rowsongtable = DB_Fetch_Array($Songtable))
	{
	  	$songtablearr[$rowsongtable['sid']] = array(
	  		"songtitle" => urldecode($rowsongtable["songtitle"]),
	  		"songcover" => $rowsongtable["songcover"],
	  		"songurl" => $rowsongtable["songurl"]
	  		);
	}
	while($row = DB_Fetch_Array($query))
	{
		$resultarray["info"] = $row["info"];
		$resultarray["songtitle"] = $songtablearr[$row["songid"]]["songtitle"];
		$resultarray["songcover"] = $songtablearr[$row["songid"]]["songcover"];
		$resultarray["songurl"] = $songtablearr[$row["songid"]]["songurl"];
		$resultarray["user"] = urldecode($row["user"]);
		$resultarray["to"] = urldecode($row["to"]);
		$resultarray["message"] = "「".urldecode($row["message"])."」";
		$jsonarray[] = $resultarray;
	}
}
echo json_encode($jsonarray,JSON_UNESCAPED_UNICODE);
?>