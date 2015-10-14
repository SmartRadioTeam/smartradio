<?php
include("class_include.php");
switch($_POST["mod"]){
    case "played" :
        $id=$_POST['id'];
        $sql = "UPDATE `radio` SET `info` = '1' WHERE `radio`.`id` = $id;";
        $result = mysql_query($sql,$con);
        if($result){
            $sql = "SELECT * FROM `radio` WHERE `radio`.`id` = $id;";
            $query = mysql_query($sql,$con);
            while($row=mysql_fetch_array($query)){
                if($row["uri"]!=null){
                    toastup($row["uri"],"您的点歌「".urldecode($row["name"])."」已被播放");
                }
            }
            header("Location: ../go.php");
        }else{
            DB_PrintError("服务器错误！请通知管理员！管理员qq：381511791");
        }
        break;
    case "delete":
        $id=$_POST['id'];
        $sql="DELETE FROM `radio` WHERE `radio`.`id` = $id;";
        $result = mysql_query($sql,$con);
        if($result){
            header("Location: ../go.php");
        }else{
            echo "服务器错误！请通知管理员！管理员qq：381511791";
        }
        break;
    case "unplay":
        $id=$_POST['id'];
        $sql = "UPDATE `".MYSQLDB."`.`radio` SET `info` = '2' WHERE `radio`.`id` = $id;";
        $result = mysql_query($sql,$con);
        if($result){
            $sql = "SELECT * FROM `radio` WHERE `radio`.`id` = $id;";
            $query = mysql_query($sql,$con);
            while($row=mysql_fetch_array($query)){
                if($row["uri"]!=null){
                    toastup($row["uri"],"您的点歌「".urldecode($row["name"])."」无法播放");
                }
            }
            header("Location: ../go.php");
        }else{
            DB_PrintError("服务器错误！请通知管理员！管理员qq：381511791");
        }
    case "deletelost":
        $id=$_POST['id'];
        $sql="DELETE FROM `".MYSQLDB."`.`lostandfound` WHERE `lostandfound`.`id` = $id;";
        $result = mysql_query($sql,$con);
        if($result){
            header("Location: ../go.php?url=/admin/touch/lostandfound.php");
        }else{
            echo "服务器错误！请通知管理员！管理员qq：381511791";
        }
        break;
    case "deletecatch":
        $id=$_POST['id'];
        $sql="DELETE FROM `".MYSQLDB."`.`ersong` WHERE `ersong`.`id` = $id;";
        $result = mysql_query($sql,$con);
        if($result){
            header("Location: ../go.php");}
        else{
            echo "服务器错误！请通知管理员！管理员qq：381511791";
        }
        break;
}
?>