<?php
function DB_Insert($table,$arr_values){
	$id=1;
	$keys="";
	$vals="";
	foreach ($arr_values as $key => $val) {
		if($id!=count($arr_values)){
			if($val!=NULL||!is_numeric($val)){
				$keys=$keys."`".$key."`,";
				$vals=$vals."'".$val."',";
			}else{
				if($val==NULL&&$val!=0){
					$val="NULL";
				}
				$keys=$keys."`".$key."`,";
				$vals=$vals.$val.",";
			}
			$id++;
		}else{
			if($val!=NULL||!is_numeric($val)){
				$keys=$keys."`".$key."`";
				$vals=$vals."'".$val."'";
			}else{
				if($val==NULL&&$val!=0){
					$val="NULL";
				}
				$keys=$keys."`".$key."`";
				$vals=$vals.$val;
			}
		}
	}
	return "INSERT INTO `".$table."` (".$keys.") VALUES (".$vals.");";
}
function DB_Select($table,$where=null,$limit="",$filter="*",$orderby=null){
	if($where==null){
		if($limit!=""){
			$returnsql = "SELECT ".$filter." FROM `".$table."` LIMIT ".$limit;
		}else{
			$returnsql = "SELECT ".$filter." FROM `".$table."`";
		}
	}else{
		$id=1;
		$wheres="";
		foreach ($where as $key => $val) {
			if($id!=count($where)){
				$wheres=$wheres."`".$key."` ".$val." AND ";
			}else{
				$wheres=$wheres."`".$key."` ".$val;
			}
		}
		if($limit!=""){
			$returnsql= "SELECT ".$filter." FROM `".$table."` WHERE ".$wheres." LIMIT ".$limit.";";
		}else{
			$returnsql= "SELECT ".$filter." FROM `".$table."` WHERE ".$wheres.";";
		}
	}
	if($orderby!=null){
	   $returnsql .= "ORDER BY ´".$orderby."´";
	}
	return $returnsql
}
function DB_Delete($table,$where){
	$id=1;
	$wheres="";
	foreach ($where as $key => $val) {
		if($id!=count($where)){
			$wheres=$wheres."`".$key."` ".$val." AND ";
		}else{
			$wheres=$wheres."`".$key."` ".$val."";
		}
	}
	return "DELETE FROM `".$table."` WHERE ".$wheres.";";
}
function DB_Update($table,$set,$where){
	$id=1;
	$wheres="";
		foreach ($where as $key => $val) {
		if($id!=count($arr_values)){
			$wheres=$wheres."`".$key."` ".$val." AND ";
		}else{
			$wheres=$wheres."`".$key."` ".$val;
		}
	}
	foreach($set as $key =>$val){
		$sets="`".$key."`='".$val."'";
	}
	return "UPDATE `".$table."` SET ".$sets." WHERE ".$where.";";
}
function DB_Query($sql,$con){
	return mysql_query($sql,$con);
}
function DB_Fetch_Array($query){
	return mysql_fetch_array($query);
}
function DB_Num_Rows($query){
	return mysql_num_rows($query);
}
function DB_Insert_Id($con){
	return mysql_insert_id($con);
}
function DB_Error($con){
	return mysql_error($con);
}