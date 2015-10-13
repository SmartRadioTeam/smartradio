<?php
if(isset($_GET['mod'])){
    $mode=$_GET['mod'];
}
if(!isset($mode)){
    $tittles="今日播放";
}else if($mode=="search"){
    $tittles="搜索结果";
}else if($mode=="selectall"){
    $tittles="全部点歌";
}
echo '<title>'.$tittles.' - <?php echo PROJECTNAME;?>管理中心 - Powered by smuradio</title>';
?>
<body>
<?php 
include("tem/t.php");
?>
<div class="container" id="body" style="width: 90%;">
<?php 
include ("infomation.php");
?>
<br>
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
if(isset($today)){

}
if($mode=="selectall"){
    $sql = "SELECT * FROM `radio`";
}else{
    $sql = "SELECT * FROM `radio` WHERE `time`='$today'";
}
$query = mysql_query($sql,$con);
while($row=mysql_fetch_array($query)){
frame($row["id"],$row["info"],$row["uptime"],$row["time"],$row["option"],$row["name"],$row["user"],$row["to"],$row["message"],$row["ip"]);
}
?>
 </div>
<hr>
</div>
<script type="text/javascript">reformobile()</script></div>
</div>
    </div>
<?php
include("tem/foot.htm");
?>
</body></html>