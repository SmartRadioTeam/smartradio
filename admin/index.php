<?php
include("class_include.php");
if(isset($_GET['mod'])){
    $mode = $_GET['mod'];
}
?>
<div>
<?php
date_default_timezone_set ('PRC');
if(!isset($mode)){
  $today = date("m-d",time());
}else if($mode == "search"){
    $day = $_POST['day'];
    $time = $_POST['time'];
    $today = $time.'-'.$day; 
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
<form name="change" action="command/items.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id">
    <input type="hidden" name="mod">
    <input type="hidden" name="location" value="<?php echo $mode?>">
</form>
<script>
function changeform(id,mod){
  document.change.id.value=id;
  document.change.mod.value=mod;
  document.change.submit();
}
</script>
</div>
<hr>
</div>
</div>
</div>
    </div>
<?php
include("template/foot.htm");
?>