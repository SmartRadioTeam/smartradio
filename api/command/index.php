<?php
include("class_include.php");
$sql = DB_Select("ticket_view",null,"","*","info"); 
$query = DB_Query($sql,$con);
while($row = DB_Fetch_Array($query)){
echo '状态：';
$info = $row["info"];
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
echo "
歌曲名：".urldecode($row["name"])."
点歌人：".urldecode($row["user"])."
送给：".urldecode($row["to"])."
最想对TA说:「".urldecode($row["message"])."」";
}
?>