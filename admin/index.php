<?php
include("class_include.php");
if(isset($_GET['mod'])){
    $mode=$_GET['mod'];
}
?>
<div>
<?php
date_default_timezone_set ('PRC');
if(!isset($mode){
    $today=date("m-d",time());
}else if($mode=="search"){
    $day=$_POST['day'];
    $time=$_POST['time'];
    $today=$time.'-'.$day; 
}
if($mode=="selectall"){
 $sql = DB_Select("radio");
}else{
	$sql = DB_Select("radio",array('time' => "=".$today));
}
$query = mysql_query($sql,$con);
while($row=mysql_fetch_array($query)){
	frame($row["id"],$row["info"],$row["uptime"],$row["time"],$row["option"],$row["name"],$row["user"],$row["to"],$row["message"],$row["ip"],$mode);
}
?>
</div>
<hr>
</div>
</div>
</div>
    </div>
<?php
include("tem/foot.htm");
?>