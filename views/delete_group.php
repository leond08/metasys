<?php
session_start();
include_once('../db_connections/connection_db.php');
include_once('../db_function/db_func.php');

$connect = db_connect();


	
		$id = $_POST['id'];
		
		$stat =  _sqlDelete("group_contestant","group_id",$id);
		
		 
		if($stat){
			echo "controller.php?action=view_group";
		}
		

	

?>