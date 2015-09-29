<?php
include("../login.php");
include_once("../../../class/conn.php");
$name=$_POST['name'];
$name = str_replace('<', '', $name);
$name = str_replace('>', '', $name);
$name=urlencode($name);
$sql="INSERT INTO `".MYSQLDB."`.`ersong` (`name`) VALUES ('$name');";
$result = mysql_query($sql,$con);
if($result){
    header("Location: ../go.php");
}
?>