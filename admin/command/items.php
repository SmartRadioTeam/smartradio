<?php
include("class_include.php");
$location = $_POST["location"];
switch($_POST["mod"]){
    case "played":
        $id = $_POST['id'];
        $sql = DB_Update("radio",array("info"=>"1"),array("id"=>"=".$id));
        $result = DB_Query($sql,$con);
        if($result){
            $sql = DB_Select("radio",array("id" => "=".$id));
            $query = DB_Query($sql,$con);
            while($row = DB_Fetch_Array($query)){
                if($row["uri"] != null){
                    toastup($row["uri"],"您的点歌「".urldecode($row["name"])."」已被播放");
                }
            }
            System_messagebox("操作成功!","success","/admin/index.php?mod=".$location);
        }else{
            DB_PrintError("服务器错误！请通知管理员！管理员qq：381511791");
        }
        break;
    case "delete":
        $id = $_POST['id'];
        $sql = DB_Delete("radio",array("id"=>"=".$id));
        $result = DB_Query($sql,$con);
        if($result){
            System_messagebox("操作成功！","success","/admin/index.php?mod=".$location);
        }else{
            DB_PrintError("服务器错误！请通知管理员！管理员qq：381511791");
        }
        break;
    case "unplay":
        $id=$_POST['id'];
        $sql = DB_Update("radio",array("info"=>"2"),array("id"=>"=".$id));
        $result = DB_Query($sql,$con);
        if($result){
            //$sql = "SELECT * FROM `radio` WHERE `radio`.`id` = $id;";
            $sql = DB_Select("radio",array("id"=>"=".$id));
            $query = DB_Query($sql,$con);
            while($row = DB_Fetch_Array($query)){
                if($row["uri"] != null){
                    toastup($row["uri"],"您的点歌「".urldecode($row["name"])."」无法播放");
                }
            }
            System_messagebox("操作成功！","success","/admin/index.php?mod=".$location);
        }else{
            DB_PrintError("服务器错误！请通知管理员！管理员qq：381511791");
        }
    case "deletelost":
        $id = $_POST['id'];
        $sql = DB_Delete("lostandfound",array("id" => "=".$id));
        $result = DB_Query($sql,$con);
        if($result){
            System_messagebox("操作成功！","success","/admin/lostandfound.php");
        }else{
            DB_PrintError("服务器错误！请通知管理员！管理员qq：381511791");
        }
        break;
    case "deletecatch":
        $id = $_POST['id'];
        $sql = DB_Delete("bansong",array("id" => "=".$id));
        $result = DB_Query($sql,$con);
        if($result){
           System_messagebox("操作成功！","success","/admin/bansong.php");    
        }else{
           DB_PrintError("服务器错误！请通知管理员！管理员qq：381511791");
        }
        break;
}
?>