<?php
include("class_include.php");
if(isset($_POST['username']))
{
  $username = md5(trim($_POST['username']));
  $password = md5(trim($_POST['password']));
  $sql = DB_Select("adminuser",array("usermd5"=>"='".$username."'"));
  $query = DB_Query($sql,$con);
  while($row=DB_Fetch_Array($query))
  {
    if($password == $row["password"])
    {
      session_start();
      $_SESSION['thisusername']=$username;
      die('{"message":"","mod":"success"}');
    }
    else
    {
      die('{"message":"您的密码输入错误，请重新输入！","mod":"error"}'); 
    }
  }
}