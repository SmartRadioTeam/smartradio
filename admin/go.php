<head>
<?php
include("../class/conf.php"); ?>
 
<title>操作完成 - <?php echo PROJECTNAME;?> - Powered by smuradio</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
echo '<script language="javascript">alert("操作完成！");</script>';
echo '<meta http-equiv="Refresh" content="0.1; url='.$_COOKIE['adminua'].'" /> ';
?>