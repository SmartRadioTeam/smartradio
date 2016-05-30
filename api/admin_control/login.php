<?php
include("class_include.php");
if(isset($_POST['username']))
{
  $username = md5(trim($_POST['username']));
  $password = md5(trim($_POST['password']));
  //todo
  if($password == $row["password"])
  {
    die('{"mod":"success"}');
  }
  else
  {
    die('{"message":"您的密码输入错误，请重新输入！","mod":"error"}'); 
  }
}