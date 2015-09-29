<?php
function DB_Insert($table,$arr_values){
	$id=1;
	$keys="";
	$vals="";
	foreach ($arr_values as $key => $val) {
		if($id!=count($arr_values)){
			if($val!=NULL||!is_numeric($val)){
				$keys=$keys.$key.",";
				$vals=$vals."'".$val."',";
			}else{
				if($val==NULL&&$val!=0){
					$val="NULL";
				}
				$keys=$keys.$key.",";
				$vals=$vals.$val.",";
			}
			$id++;
		}else{
			if($val!=NULL||!is_numeric($val)){
				$keys=$keys.$key;
				$vals=$vals."'".$val."'";
			}else{
				if($val==NULL&&$val!=0){
					$val="NULL";
				}
				$keys=$keys.$key;
				$vals=$vals.$val;
			}
		}
	}
	return "INSERT INTO ".$table." (".$keys.") VALUES (".$vals.");";
}
function DB_Select($table,$where=null,$limit="",$filter="*"){
	if($where==null){
		if($limit!=""){
			return "SELECT ".$filter." FROM ".$table." LIMIT ".$limit;
		}else{
			return "SELECT ".$filter." FROM ".$table;
		}
	}else{
		$id=1;
		$wheres="";
		foreach ($where as $key => $val) {
			if($id!=count($where)){
				$wheres=$wheres.$key.$val." AND ";
			}else{
				$wheres=$wheres.$key.$val;
			}
		}
		if($limit!=""){
			return "SELECT ".$filter." FROM ".$table." WHERE ".$wheres." LIMIT ".$limit.";";
		}else{
			return "SELECT ".$filter." FROM ".$table." WHERE ".$wheres.";";
		}
	}
}
function DB_Delete($table,$where){
	$id=1;
	$wheres="";
	foreach ($where as $key => $val) {
		if($id!=count($arr_values)){
			$wheres=$wheres.$key.$val." AND ";
		}else{
			$wheres=$wheres.$key.$val."";
		}
	}
	return "DELETE FROM ".$table." WHERE ".$where.";";
}
function DB_Update($table,$set,$where){
	$id=1;
	$wheres="";
		foreach ($where as $key => $val) {
		if($id!=count($arr_values)){
			$wheres=$wheres.$key.$val." AND ";
		}else{
			$wheres=$wheres.$key.$val;
		}
	}
	foreach($set as $key =>$val){
		$sets=$key."='".$val."'";
	}
	return "UPDATE ".$table." SET ".$sets." WHERE ".$where.";";
}
function DB_Query($sql,$con){
	return $con->query($sql);	 
}
function DB_Fetch_Array($result){
	return $result->fetchArray();
}
function DB_Num_Rows($result){
	//return sqlite_num_rows($result);
	return count($result);
}
function DB_Insert_Id($con){
	return $con->lastInsertRowID();
}
function DB_Error($con){
	return 	"[DB Error]".$con->lastErrorCode()." ".$con->lastErrorMsg();
}