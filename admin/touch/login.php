<html lang="zh"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
include("../../class/conf.php");
error_reporting(0);
$username=md5($_POST['username']);
$password=md5($_POST['password']);
if(!isset($_COOKIE['login'])){
    if($password==""){
        echo'<!DOCTYPE html>
            <html lang="zh-cn"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link href="css/bootstrap.css" rel="stylesheet">
                <link href="css/login.css" rel="stylesheet">
              </head>
              <body>
                <div class="container">
                  <form class="form-signin" role="form" method="post">
                    <h2 class="form-signin-heading">登录管理中心</h2>
                    <input type="text" name="username" class="form-control" placeholder="用户名" required="">
                    <input type="password" name="password" class="form-control" placeholder="密码" required="">
                    <button class="btn btn-lg btn-primary btn-block" type="submit">登录</button>
                  </form>
                </div>
        </body></html>';
    }else{
        include("../../class/conn.php");
        $sql = "SELECT * FROM `adminuser` WHERE `usermd5`=$username";
        $query = mysql_query($sql,$con);
        while($row=mysql_fetch_array($query)){
            if($password==$row[password]){
                setcookie('login','sanmingxueyuan',time()+86400,"/");
                header('location:index.php');
            }else{
                header('location:login.php');
            }
        }
    }
}else{
    header('location:index.php');
}
?>
<title>登录 - <?php echo PROJECTNAME;?>管理中心 - Powered by smuradio</title>