<?php
session_start();
include_once('../db_connections/connection_db.php');
include_once('../db_function/db_func.php');

$connect = db_connect();


	
		$id = $_POST['id'];
		//$file = $_POST['img'];
		
		$stat =  _sqlDelete("individual_contestant","con_id",$id);
		 //_deleteImage($file);
		 
		if($stat){
			echo "deleted";
		}
		

	

?>