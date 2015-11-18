<?php
include("class_include.php");
?>
<div>
<?php
$sql = DB_Select("adminuser");
$query = DB_Query($sql,$con);
while($row = DB_Fetch_Array($query)){
    echo '<div class="anime img-thumbnail" id="anime">';
    echo "<br><br>";
    echo "用户名:".$row["user"];
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