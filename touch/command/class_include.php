<?php
include("../../config/init.php");
include("../../connect/init.php");
if(Location_Filename=="update.php"){
	include("../../".Package_Net."/net_getip.php");
	include("../../".Package_System."/messagebox/messagebox.php");
	include("../../".Package_Xss_Replace."xss_replace");
}