<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>数据库错误！ - Powered by 睿翼通ERP</title>
    <link href="../../library/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/sticky-footer.css" rel="stylesheet">
  </head>

  <body>

    <!-- Begin page content -->
    <div class="container">
      <div class="page-header">
        <h1>数据库错误！<h1>
      </div>
      请将以下信息提交给开发者：<br>
      <?php
      include ('../conf.php');
      $con = mysql_connect(MYSQLHOST,MYSQLUSER,MYSQLPASSWORD);
echo 'Could not connect: ' . mysql_error();
  ?>
    </div>
    <div class="footer">
      <div class="container">
        <p class="text-muted">睿欧科技有限公司</p>
      </div>
    </div>
  

</body></html>
