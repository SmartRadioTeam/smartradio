﻿<!DOCTYPE html>
<html lang="zh">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="/library/bootstrap/css/bootstrap.css" rel="stylesheet">
	<link href="./css/css.css" rel="stylesheet">
    <script src="/library/jquery.min.js"></script>
    <script src="/library/bootstrap/js/bootstrap.min.js"></script>
    <script src="./js/mobile.js" type="text/javascrpt"></script>
    <script src="./js/reformobile.js" type="text/javascript"></script>
    <?
    switch(Location_Filename){
    	case "index.php":
    		if(!isset($_GET['mode']){
    			$tittles = "今日播放";
    		}
    		if($_GET['mode'] == "selectall"){
    			$tittles = "全部点播";
    		}
    		if($_GET['mode']=="search"){
    			$tittles = "点播搜索";
    		}
    		break;
    	case "lostandfound.php":
    		$tittles = "失物招领";
    		break;
    }
    echo '<title>'.$tittles.' - <?php echo Project_Name;?>管理中心 - Powered by smuradio</title>';
    ?>
</head>
<body>
<?php 
include("navi.php");
?>
<div class="container" id="body" style="width: 90%;">
<br>