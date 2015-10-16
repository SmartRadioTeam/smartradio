
<div id="postmsg" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="modal-title">添加禁播歌曲</h3>
      </div>
      <div class="modal-body">
          <form id="addbansong" name="addbansong" action="command/add_bansong.php" method="post">
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
<script type="text/javascript"> 
function submit(){
document.form2.submit();
}
</script> 