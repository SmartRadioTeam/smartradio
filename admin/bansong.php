<?php
include("class_include.php");
?>
<a href="#postmsg" data-toggle="modal" class="btn btn-primary" >添加禁播歌曲</a>
<div>
<?php
$sql = DB_Select("bansong");
$query = DB_Query($sql,$con);
while($row=DB_Fetch_Array($query)){
    echo '<div class="anime img-thumbnail" id="anime">
    歌曲名：'.urldecode($row["name"]).'
    <hr>
    <form action="command/items.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="'.$row["id"].'">
    <input type="hidden" name="mod" value="deletecatch">
    <input type="submit" name="submit" class="btn btn-danger" value="删除" />
    </form>
    <div style="height:1px; margin-top:-1px;clear: both;overflow:hidden;"></div></div>';

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