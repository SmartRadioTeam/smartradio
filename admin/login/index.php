<?php
include("../class/conf.php");
include("../class/conn.php");
$user=$_POST['user'];
$passwd=$_POST['passwd'];
//网页登陆
$page='<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/signin.css" rel="stylesheet">
    <script src="js/ie-emulation-modes-warning.js"></script>
  </head>
  <body>
    <div class="container">
      <form class="form-signin" role="form" method="post">
        <h2 class="form-signin-heading">睿翼通ERP用户登录</h2>
        <input type="text" name="user" class="form-control" placeholder="用户名" required="" autofocus="">
        <input type="password" name="passwd" class="form-control" placeholder="密码" required="">
        <button class="btn btn-lg btn-primary btn-block" type="submit">登录</button>
      </form>
    </div>
	    <div class="footer">
      <div class="container2">
        <p class="text-muted">福州市睿欧计算机有限公司</p>
      </div>
    </div>
    <script src="js/ie10-viewport-bug-workaround.js"></script>
</body></html>';
$ok=false;
$weight=false;
if($user==""){
echo $page;
}else{
$message='用户名或密码错误！请重试！';
$sql = "SELECT * FROM `user` WHERE `user`='$user'";
$query = mysql_query($sql,$con);
while($row=mysql_fetch_array($query)){
	if($row[password]==md5($passwd)){
$ok=true;
	}
}
if($ok==false){
echo $page;
echo '<script type="text/javascript" >alert("'.$message.'");</script>';
}else{
setcookie('login',$name,time()+86400,"/");
}
}
echo '<title>登录 - '.PROJECTNAME.'管理中心 - Powered by 睿翼通ERP</title>';
?>
