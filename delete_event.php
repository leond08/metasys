<?php
session_start();
include_once('db_connections/connection_db.php');
include_once('db_function/db_func.php');

$connect = db_connect();

	if($_POST){
	
	if(isset($_POST['id'])){
		$id = $_POST['id'];
		
		$stat = _sqlDeleteAll($id);
		
		if($stat){
			echo "deleted";
			header('location:all_events.php');
		}
		else {
			echo"not deleted";
			header('location:all_events.php');
		}
		

	}

}

?>