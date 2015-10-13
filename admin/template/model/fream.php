<?php
funciton frame($id,$info,$uptime,$time,$option,$name,$user,$to,$message,$ip){
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
        投稿者ip：".'<a href="http://www.ip138.com/ips138.asp?ip='.urldecode($ip).'">'.urldecode($ip)."</a><hr>";
        changepost($id,urldecode($name),urldecode($user),urldecode($to),urldecode($message));
        echo '<form action="class/del.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="'.$id.'">
        <input type="hidden" name="mod" value="music">
        <input type="submit" name="submit" class="btn btn-success" value="标记为已播放" />
        </form><br>
        <form action="class/backmusic.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="'.$id.'">
        <input type="submit" name="submit" class="btn btn-default" value="标记为未播放" />
        </form><br>
        <form action="class/del.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="'.$id.'">
        <input type="hidden" name="mod" value="noplay">
        <input type="submit" name="submit" class="btn btn-danger" value="标记为无法播放" />
        </form><br>
        <form action="class/del.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="'.$id.'">
        <input type="hidden" name="mod" value="init">
        <input type="submit" name="submit" class="btn btn-primary" value="直接删除" />
        </form>';
echo '<div style="height:1px; margin-top:-1px;clear: both;overflow:hidden;"></div></div>';
}
function changepost($id,$name,$user,$to,$message){
    echo'
    <div id="A'.$id.'" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 class="modal-title">修改点歌单</h3>
          </div>
      <div class="modal-body">
      <form id="form1" name="form1" action="command/changedate.php" method="post">
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
        </form>
      </div>
    </div>
    </div>
    </div>';
    echo '<a href="#A'.$id.'"data-toggle="modal" class="btn btn-info">修改点歌单</a><br><br>';
}