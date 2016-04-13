<?php
include("class_include.php");
if(isset($_POST['username']))
{
  $username = $_POST['username'];
  $password = $_POST['password'];
  $username = md5($username);
  $password = md5($password);
  $sql = DB_Select("adminuser",array("usermd5"=>"='".$username."'"));
  $query = DB_Query($sql,$con);
  while($row=DB_Fetch_Array($query))
  {
    if($password == $row["password"])
    {
      session_start();
      $_SESSION['thisusername']=$username;
      exit();
    }
    else
    {
      die('{"message":"您的密码输入错误，请重新输入！","mod":"error"}'); 
    }
  }
}