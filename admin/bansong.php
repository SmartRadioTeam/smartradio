<?php
include("class_include.php");
?>
<a href="#postmsg" data-toggle="modal" class="btn btn-primary" >添加禁播歌曲</a>
<div>
<?php
include("../../class/conn.php");
$sql = "SELECT * FROM `ersong`";
$query = mysql_query($sql,$con);
while($row=mysql_fetch_array($query)){
    echo '<div class="anime img-thumbnail" id="anime">';
    echo '歌曲名：'.urldecode($row[name]).'<hr>';
    echo '<form action="class/del.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="'.$row[id].'">
    <input type="hidden" name="mod" value="catch">
    <input type="submit" name="submit" class="btn btn-danger" value="删除" />
    </form>';
    echo '<div style="height:1px; margin-top:-1px;clear: both;overflow:hidden;"></div></div>';

}
?>
 </div>
<hr>
</div>
</div>
</div>
    </div>
<?php
include("template/foot.htm");
?>