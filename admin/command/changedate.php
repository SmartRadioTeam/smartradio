<?php
include("class_include.php");
$id=$_POST["id"];
$user=$_POST['user'];
$name=$_POST['name'];
$message=$_POST['message'];
$to=$_POST['to'];
$user = Xss_replace($user);
$name = Xss_replace($name);
$message = Xss_replace($message);
$to = Xss_replace($to);
if(strlen($message)>280){
    echo "祝福超过140字，请修改后重新提交！";
}else{
    //url转码
    $user=urlencode($user);
    $name=urlencode($name);
    $message=urlencode($message);
    $to=urlencode($to);
    //写入
    //$sql = "UPDATE `".MYSQLDB."`.`radio` SET `user` = '$user',`name`='$name',`message`='$message',`to`='$to' WHERE `radio`.`id` = $id;";
    $sql = DB_Update("radio",array("user"=>$user,
                                   "name"=>$name,
                                   "message"=>$message,
                                   "to"=>$to);
    $result = mysql_query($sql,$con);
    if($result){
        header("Location: ../go.php");
    }else{
        echo SUBMITNO;
    }
}
?>