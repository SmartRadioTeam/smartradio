<br>
<?php
include("class_include.php");
$sql = DB_Select("timetable");
$query = DB_Query($sql,$con);
while($row = DB_Fetch_Array($query)){
	echo '<div class="alert alert-success">上次自动清理数据库时间：'.$row["deltime"].'</div>';
}
$sql = DB_Select("message");
$query = DB_Query($sql,$con);
while($row = DB_Fetch_Array($query)){
	echo '<div class="alert alert-info">
	<font color="#000000"><strong>通知：</strong>'.urldecode($row["message$"])."</font>
	</div>";
}
//todo 失物招领与寻物启事显示模式修改（已修改为两条）
$sql = "SELECT * FROM `lostandfound` ORDER BY RAND() LIMIT 1;";
$sql = DB_Select("lostandfound",1);
$query = DB_Query($sql,$con);
while($row = DB_Fetch_Array($query)){
$messages = "来自".urldecode($row["user"])."同学的寻物启示：".urldecode($row["message"])."请有拾到者拨打电话：".urldecode($row["tel"])."。谢谢！（本信息将滚动播出，如需了解更多信息请刷新页面。）";
	echo '<div class="alert alert-danger">
	<font color="#000000"><strong></strong>'.$messages."</font>
	</div>";
}
?>