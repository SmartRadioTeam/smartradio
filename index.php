<?php
if(!is_file("config/setting.json")){
	header("Location: /install");
	exit();
}