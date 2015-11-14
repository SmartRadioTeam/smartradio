<?php
include("class_include.php");
if(isset($_GET['mode'])){
    $mode = $_GET['mode'];
}
?>
<div>
<?php
date_default_timezone_set ('PRC');
if(!isset($mode)){
    $today = date("m-d",time());
}else if($mode == "search"){
 	$arr = split('/' , $_POST['time']);
    $today = $arr[1].'-'.$arr[2]; 
}
if($mode == "selectall"){
    $sql = DB_Select("ticket_view");
}else{
	$sql = DB_Select("ticket_view",array('time' => "=".$today));
}
$query = DB_Query($sql,$con);
while($row = DB_Fetch_Array($query)){
	frame($row["id"],$row["info"],$row["uptime"],$row["time"],$row["option"],$row["name"],$row["user"],$row["to"],$row["message"],$row["ip"],$mode);
}
?>
</div>
</div>
<hr>
</div>
</div>
</div>
<?php
include("template/foot.htm");
?>