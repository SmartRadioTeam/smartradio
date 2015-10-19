<?php
include("class_include.php");
$id=$_POST['id'];
$location=$_POST["location"];
$sql = DB_Update("radio",array("info" => "0"),array("id" => "=".$id));
$result = DB_Query($sql,$con);
    if($result){
        $sql = DB_Select("ticket_view",array("id" => "=".$id));
        $query = DB_Query($sql,$con);
        while($row = DB_Fetch_Array($query)){
            if($row["uri"] != null){
                toastup($row["uri"],"您的点歌「".urldecode($row["name"])."」未被播放");
        }
        System_messagebox("操作完成","success","/admin/index.php?mod=".$location);
    }else{
        DB_PrintError("服务器错误！请通知管理员！管理员qq：381511791");
    }
?>	