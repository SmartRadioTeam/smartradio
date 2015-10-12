<?php
include("class_include.php");
//$sql = "SELECT * FROM `radio`";
$sql = DB_Select("radio"); 
$query = DB_Query($sql,$con);
while($row=DB_Fetch_Array($query)){
echo '状态：';
$info=$row[info];
switch ($info){
   case "0":
      echo '<span class="label label-default">未播放</span>';
      break;
   case "1":
      echo '<span class="label label-success">已播放</span>';
      break;
   case "2":
      echo '<span class="label label-danger">无法播放</span>';
      break;
}
echo "<br><br>
歌曲名：".urldecode($row[name])."<br><br>
点歌人：".urldecode($row[user])."<br><br>
送给：".urldecode($row[to])."<br><br>
最想对TA说:「".urldecode($row[message])."」";
}
?>