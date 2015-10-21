<?php
include("class_include.php");
$sql = DB_Select("ticket_view",null,"","*","info"); 
$query = DB_Query($sql,$con);
while($row = DB_Fetch_Array($query)){
echo '状态：';
$info = $row["info"];
switch ($info
echo "
歌曲名：".urldecode($row["name"])."
点歌人：".urldecode($row["user"])."
送给：".urldecode($row["to"])."
最想对TA说:「".urldecode($row["message"])."」";
}
?>