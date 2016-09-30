<?php
session_start();
include_once("db_connections/connection_db.php");


$connect = db_connect();

// login for admin and judge
if($_POST){
	if ($_POST['action'] == 'formsubmit') {

		
		$pass = htmlentities($_POST['password']);

		if( empty($pass) ) {
			fail('Please provide your Password.');
		}
		
		$query = "SELECT * from admin where password = '".mysqli_real_escape_string($connect,$pass)."'";
		
	   $result = mysqli_query($connect,$query);
				
		if(mysqli_num_rows($result) == 1) {
		    $_SESSION['pass'] = $pass;
			$msg = "dashboard.php";
			success($msg);
			
			 
		} else {
			fail("Oh snap!Invalid Password");
		}
		exit;
	}
}


	function fail($message) {
		die(json_encode(array('status' => 'fail', 'message' => $message)));
	}
	function success($message) {
		die(json_encode(array('status' => 'success', 'message' => $message)));
	}
?>