<meta http-equiv="Content-Type" content="text/html; charset=gbk">
<?php
include("../../class/conf.php");
if($_GET["key"]==PASSWORD){
include("../../admin/class/toast.php");
include("../../class/conn.php");
$id=$_GET['id'];
$sql = "UPDATE `".MYSQLDB."`.`radio` SET `info` = '1' WHERE `radio`.`id` = $id;";
$result = mysql_query($sql,$con);
if($result){
$sql = "SELECT * FROM `radio` WHERE `radio`.`id` = $id;";
$query = mysql_query($sql,$con);
while($row=mysql_fetch_array($query)){
if($row["uri"]!=null){
toastup($row["uri"],"���ĵ�衸".urldecode($row["name"])."���ѱ�����");
}
}
echo "��ɣ�"
}
else{
echo "������������֪ͨ����Ա������Աqq��381511791";
}
$sql="ALTER TABLE  `radio` ORDER BY  `info`";
mysql_query($sql,$con);
mysql_close($con);
}
?>	