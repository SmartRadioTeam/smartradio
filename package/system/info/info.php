<?php
function get_mem(){
	$str = shell_exec('more /proc/meminfo'); 
	$pattern = "/(.+):\s*([0-9]+)/"; 
	preg_match_all($pattern, $str, $out); 
	return (100*($out[2][0]-$out[2][1])/$out[2][0]);
}
function get_hd(){
    $fp = popen('df -lh | grep -E "^(/)"',"r");
    $rs = fread($fp,1024);
    pclose($fp);
    $rs = preg_replace("/\s{2,}/",' ',$rs);
    $hd = explode(" ",$rs);
    return $hd;
 }