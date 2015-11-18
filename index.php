<?php
if(!is_file("config/setting.php")){
	header("Location: /install");
	exit();
}
header("Location: /touch");