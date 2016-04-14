<?php
include("class_include.php");
$id = $_POST['id'];
switch($_POST["mod"])
{
    case "played":
        $sql = DB_Update("ticket_view",array("info"=>"1"),array("id"=>"=".$id));
        break;
    case "backplay":
        $sql = DB_Update("ticket_view",array("info" => "0"),array("id" => "=".$id));
        break;
    case "delete":
        $sql = DB_Delete("ticket_view",array("id"=>"=".$id));
        break;
    case "unplay":
        $sql = DB_Update("ticket_view",array("info"=>"2"),array("id"=>"=".$id));
        break;
    case "deletelost":
        $sql = DB_Delete("lostandfound",array("id" => "=".$id));
        break;
    default:
        die('{"message":"参数错误！","mod":"error"}');
        break;
}
$result = DB_Query($sql,$con);
if($result)
{
    echo '{"message":"操作成功！","mod":"success"}';
}
else
{
    echo '{"message":"Datebase Error：'.DB_Error($con).'","mod":"error"}';
}
?>