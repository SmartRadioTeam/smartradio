<?php
if(!isset($_COOKIE['login'])){
	header("location:login.php");
	exit();
}
include("../config/init.php");
include("../connect/init.php");
include("/template/head.php");
?>