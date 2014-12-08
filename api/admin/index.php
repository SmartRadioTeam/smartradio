<?php
if($_GET["key"]=="wp8"){
include("../../class/conf.php");
include("../../class/conn.php");
$sql = "SELECT * FROM `radio`";
$query = mysql_query($sql,$con);
while($row=mysql_fetch_array($query)){
echo urldecode($row[name]);
echo "｜" ;
echo urldecode($row[user]);
echo "｜";
echo urldecode($row[to]);
echo "｜";
echo "「".urldecode($row[message])."」｜";
echo $row[info]."｜".$row[id]."〕";
}
mysql_close($con);
}else{echo "keyword error";}
?>