<?php
include("class_include.php");
if(isset($_POST['username']))
{
  $username = $_POST['username'];
  $password = $_POST['password'];
  if(isset($_COOKIE['login']))
  {
    header('location:/admin/');
    exit();
  }
  $username = md5($username);
  $password = md5($password);
  $sql = DB_Select("adminuser",array("usermd5"=>"='".$username."'"));
  $query = DB_Query($sql,$con);
  while($row=DB_Fetch_Array($query))
  {
    if($password == $row["password"])
    {
      setcookie('login',$row["user"],time()+86400,"/");
      exit();
    }
    else
    {
      $message = '您的密码输入错误，请重新输入！'; 
      break;
    }
  }
}