<!DOCTYPE html>
<html lang="zh"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
if(!isset($_COOKIE['login'])){header("location:login.php");}
include("../../class/conf.php");
include("tem/hand.htm");
?>
<title>禁播歌曲管理 - <?php echo PROJECTNAME;?>管理中心 - Powered by smuradio</title>
<body>
<?php 
include("tem/t.php");
?>
<div class="container" id="body" style="width: 90%;">
<?php 
include ("infomation.php");
?>
<br>
<a href="#postmsg" data-toggle="modal" class="btn btn-primary" >添加禁播歌曲</a>
<script type="text/javascript"> 
function submit(){
document.form2.submit();
}
</script> 
<div id="postmsg" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="modal-title">添加禁播歌曲</h3>
      </div>
      <div class="modal-body">
          <form id="form2" name="form2" action="../class/updateersong.php" method="post">
              歌曲名：<input type="text"name="name"><br><br>
          </form>
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
		<input type="button" name="Submit" class="btn btn-success" value="提交" onclick="submit();" />
      </div>
      </form>
      </div>
    </div>
  </div>
</div>



<div>
<?php
include("../../class/conn.php");
$sql = "SELECT * FROM `ersong`";
$query = mysql_query($sql,$con);
while($row=mysql_fetch_array($query)){
    echo '<div class="anime img-thumbnail" id="anime">';
    echo '歌曲名：'.urldecode($row[name]).'<hr>';
    echo '<form action="../class/del.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="'.$row[id].'">
    <input type="hidden" name="mod" value="catch">
    <input type="submit" name="submit" class="btn btn-danger" value="删除" />
    </form>';
    echo '<div style="height:1px; margin-top:-1px;clear: both;overflow:hidden;"></div></div>';

}
mysql_close($con);
?>
 </div>
<hr>
</div>
<script type="text/javascript">reformobile()</script></div>
</div>
    </div>
<?php
include("tem/foot.htm");
?>
</body></html>