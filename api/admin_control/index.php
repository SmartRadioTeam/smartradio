<?php
include("class_include.php");
if(isset($_GET['mode']))
{
    $mode = $_GET['mode'];
}
if($mode == "today")
{
  	$today = date("m-d",time());
}

echo json_encode($jsonarray,JSON_UNESCAPED_UNICODE);
?>