<?php
include("class_include.php");
$id=$_POST['id'];
$sql = DB_Update("radio",array("info"=>"0"),array("id"=>"=".$id))
//$sql = "UPDATE `".MYSQLDB."`.`radio` SET `info` = '0' WHERE `radio`.`id` = $id;";
$result = DB_Query($sql,$con);
    if($result){
        //$sql = "SELECT * FROM `radio` WHERE `radio`.`id` = $id;";
        $sql = DB_Select("radio",array("id"=>"=".$id));
        $query = DB_Query($sql,$con);
        while($row=DB_Fetch_Array($query)){
            if($row["uri"]!=null){
                toastup($row["uri"],"您的点歌「".urldecode($row["name"])."」未被播放");
        }
        header("Location: ../go.php");
    }else{
        DB_PrintError("服务器错误！请通知管理员！管理员qq：381511791");
    }
?>	