<?php

/** connection to db **/
function db_connect(){
	$connect = mysqli_connect('127.0.0.1','root','');
	
	if(!$connect){
		return false;
	}
	
	if(!mysqli_select_db($connect,'meta')){
		return false;
	}
	
	return $connect;

	
}
/** end of db connection **/
/*
$db = db_connect();

if(!$db){
	echo"Not successfully connected";
}
else {
	echo"Connected!";
}
*/
?>