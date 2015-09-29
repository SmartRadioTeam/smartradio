<?php
function DB_Init($db_name){
  if (!($con = new SQLite3(dirname(__FILE__)."/".$db_name))) {
   die(DB_Sqlite_Error($con));
  }
  return $con;
}