<?php
include("class_include.php");
?>
//代码输出部分
<?php
if(isset($_GET['mode'])){
    $mode = $_GET['mode'];
}
if(!isset($mode)){
  $today = date("m-d",time());
}else if($mode == "search"){
 	$arr = split('-' , $_POST['date']);
  $today = $arr[1].'-'.$arr[2]; 
}
if(!isset($today)){
 $sql = DB_Select("ticket_view",null,"","*","`info`");
}else{
	$sql = DB_Select($mode == "search"?"ticket_log":"ticket_view",array('time' => "='".$today."'"),"","*","`info`");
}
$query = DB_Query($sql,$con);
$sql = DB_Select("songtable");
$Songtable = DB_Query($sql,$con);
while($rowsongtable = DB_Fetch_Array($Songtable)){
  $songtablearr[$rowsongtable['sid']] = array("songtitle" => urldecode($rowsongtable["songtitle"]),"songcover" => $rowsongtable["songcover"],"songurl" => $rowsongtable["songurl"]);
}
while($row = DB_Fetch_Array($query)){
	frame($row["id"],$row["info"],$row["uptime"],$row["time"],$row["option"],$row["songid"],$row["user"],$row["to"],$row["message"],$row["ip"],$mode,$songtablearr);
}
?>