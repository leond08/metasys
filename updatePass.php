<?php
session_start();
include_once('db_connections/connection_db.php');
include_once('db_function/db_func.php');
$connect = db_connect();

if($_POST){

		$old = _sqlReal($_POST['oldpassword']);
		$new = _sqlReal($_POST['newpassword']);

		if(empty($old) || empty($new)) {
					fail('Please provide your Password.');
		}

		$sql = mysqli_query($connect,"select password from admin");
		$pass = mysqli_fetch_array($sql);
		
		if($old == $pass['password']){
			$res = updateAll("admin","password = '$new'","WHERE password = '$old'");
			$msg = 'Password changed successfully';
			success($msg);
		}
		else {
			fail('Old Password does not match.');
		}


}
function fail($message) {
		die(json_encode(array('status' => 'fail', 'message' => $message)));
	}
	function success($message) {
		die(json_encode(array('status' => 'success', 'message' => $message)));
	}
?>