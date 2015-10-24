<?php
//header("Location: /touch");
//Todo 入口文件载入（唯一入口）
if(is_file("config/setting.json")){
	header("Location: /install");
	exit();
}
include("touch/index.html");