<?php
include("class_include.php");
?>
<div>
<?php
$sql = DB_Select("lostandfound");
$query = DB_Query($sql,$con);
while($row = DB_Fetch_Array($query)){
    echo '<div class="anime img-thumbnail">';
    echo "<br><br>
        提交时间：".urldecode($row["uptime"])."<br><br>
        申报人：".urldecode($row["user"])."<br><br>
        联系电话：".urldecode($row["tel"])."<br><br>
        信息：".urldecode($row["message"])."<br><br>
        投稿者ip：".urldecode($row["ip"]);
    echo '<form action="command/items.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="'.$row["id"].'">
        <input type="hidden" name="mod" value="lost">
        <input type="submit" name="submit" class="btn btn-primary" value="删除" />
        </form>';
        changelaf($row[id],urldecode($row["user"]),urldecode($row["tel"]),urldecode($row["message"]));
    echo "</div>";
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