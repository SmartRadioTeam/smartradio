<br>
<br>
<?php
include("class_include.php");
$sql = DB_Select("message");
$query = DB_query($sql,$con);
while($row=DB_Fetch_Array($query)){
  echo '<div class="alert alert-info"><font color="#000000">';
  echo "<strong>通知：</strong>".urldecode($row["message"]);
  echo '</font></div>';
}
?>
<div id="off" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="modal-title">系统设置</h3>
      </div>
      <div class="modal-body">
投稿开关：
<form name="formoff" action="command/off.php" method="post">
<?php
$sql = DB_Select("takeoff",array("id"=>"=0"));
$query = DB_Query($sql,$con);
$backcount = DB_Num_Rows($query); 
if($backcount == 0){
  echo '<label class="radio-inline"><input type="radio" name="off" value="0">打开</label>
        <label class="radio-inline"><input type="radio" name="off" value="1" checked></label>';
}else{
  echo '<label class="radio-inline"><input type="radio" name="off" value="0" checked>打开</label>
        <label class="radio-inline"><input type="radio" name="off" value="1">关闭</label>';
}
?>
	<input type="submit" name="Submit" class="btn btn-success" value="提交" />
      </form>
	  <hr>
	  通知修改：
	  <form id="form1" name="form1" action="command/message.php" method="post">
<textarea class="form-control" rows="3" value="<?php
$sql = DB_Select("message");
$query = DB_Query($sql,$con);
    while($row=DB_Fetch_Array($query)){
        echo urldecode($row["message"]);
    }?>"></textarea>
&nbsp;&nbsp <input type="submit" name="Submit" class="btn btn-success" value="提交" />
</form>
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
		      </div>
</div>
      </div>
    </div>
  </div>


<div id="today" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="modal-title">点播搜索</h3>
      </div>
      <div class="modal-body">
<form action="index.php?mod=search" method="post" enctype="multipart/form-data">
<?php
echo '<select name="time" class="form-control" style="width:100px;">';
$i = 1;
$today = date("m",time());
while($i!=13){
  if(strlen($i) == 1){
      $i = '0'.$i;
  }
  if($today == $i){
      echo '<option value ="'.$i.'" selected="selected">'.$i.'月</option>';
  }else{
      echo '<option value ="'.$i.'">'.$i.'月</option>';
  }
  $i=$i+1;
}
echo '</select><select class="form-control" name="day" style="width:100px;">';
$i = 1;
$today = date("d",time());
while($i!=32){
  if(strlen($i) == 1){
      $i='0'.$i;
  }
  if($today == $i){
      echo '<option value ="'.$i.'" selected="selected">'.$i.'日</option>';
  }else{
      echo '<option value ="'.$i.'">'.$i.'日</option>';
  }
$i = $i+1;
}
	  echo '</select>&nbsp;&nbsp;';?>
	          <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
<input type="submit" name="submit" class="btn btn-success" value="查询" />
</div>
</form>
      </div>
    </div>
  </div>
</div>
<?php
$sql = DB_Select("timetable");
$query = DB_Query($sql,$con);
while($row = DB_Fetch_Array($query)){
    echo '<div class="alert alert-success">上次清理数据库时间：'.$row["deltime"].'</div>';
}
?>