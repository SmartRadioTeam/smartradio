<?php
function frame($id,$info,$uptime,$time,$option,$name,$user,$to,$message,$ip,$mod){
	    echo '<div class="anime img-thumbnail" id="anime">';
    echo '状态：';
    switch($info){
    	case "0":
    		echo '<span class="label label-default">未播放</span>';
    		break;
    	case "1":
    		echo '<span class="label label-success">已播放</span>';
    		break;
    	case "2":
    		echo '<span class="label label-danger">无法播放</span>';
    		break;
    }
        echo "<br><br>
        提交时间：".urldecode($uptime)."<br><br>
        希望播放的时间：".str_replace('-', '月', urldecode($time))."日 ".urldecode($option)."<br><br>
        歌曲名：".urldecode($name)."<br><br>
        点歌人：".urldecode($user)."<br><br>
        送给：".urldecode($to)."<br><br>
        留言：".urldecode($message)."<br><br>
        投稿者ip：".urldecode($ip)."</a><hr>";
        changepost($id,urldecode($name),urldecode($user),urldecode($to),urldecode($message),$mod);
        echo 
        '<button onclick="javascript:changeform(\''.$id.'\',\'played\')" class="btn btn-success"  />标记为已播放</button>
        <div class="dropdown btn-group">
  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
  更多操作
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
    <li><a href="#A'.$id.'" data-toggle="modal">修改点歌单</a></li>
    <li><a href="#" onclick="changeform(\''.$id.'\',\'backplay\')">标记为未播放</a></li>
    <li><a href="#" onclick="changeform(\''.$id.'\',\'unplay\')">标记为无法播放</a></li>
    <li><a href="#" onclick="changeform(\''.$id.'\',\'delete\')">直接删除</a></li>
  </ul>
</div>
</div>';
}
function changepost($id,$name,$user,$to,$message,$mod){
    echo'
    <div id="A'.$id.'" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 class="modal-title">修改点歌单</h3>
          </div>
      <div class="modal-body">
      <form id="form1" name="form1" action="command/changedata.php" method="post">
    <font color="#000000">歌曲名：</font><input type="text"name="name" value="'.$name.'"><br><br>
    <font color="#000000">点歌人：</font><input type="text"name="user" value="'.$user.'"><br><br>
    <font color="#000000">送给：</font><input type="text"name="to" value="'.$to.'"><br><br>
    <font color="#000000">想说的话:</font><input name="message" onkeyup="checkLength(this);" value="'.$message.'"><br><br>
    <font color="#000000">文字最大长度: 140. 还剩: <span id="chLeft"></span></font>
      </div>
      <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <input type="submit" name="submit" class="btn btn-success" value="保存" />
        <input type="hidden" name="id" value="'.$id.'">
        <input type="hidden" name="location" value="'.$mod.'">
        </form>
      </div>
    </div>
    </div>
    </div>';
}