<?php	
/* 
session_start();
include_once('../db_connections/connection_db.php');
include_once('../db_function/db_func.php');
include_once('../php_image_magician/php_image_magician.php');
define('IMAGE_UPLOADPATH','../upload_image/');

$connect = db_connect();

	$result = _sqlSelect_eventID($_SESSION['event'],$_SESSION['date']);
		$id = $result['event_id'];
		$cat = $result['category_select'];


		if($_POST){
		
			$lname = _sqlReal($_POST['candid_lname']);
			$fname = _sqlReal($_POST['candid_fname']);
			$mi = _sqlReal($_POST['candid_mi']);
			$barangay = _sqlReal($_POST['candid_barangay']);
			$city = _sqlReal($_POST['candid_address']);
			$candid_no = _sqlReal($_POST['candid_no']);
			
	
			//contestant inserted
				
				$image = $_FILES['fileUpload'];
			
				$image = image_upload($image);
				
			if(!empty($_POST['candid_lname'])){
			
			$result = _sqlInsert("individual_contestant","'$lname','$fname','$mi','$cat','$barangay','$city','$candid_no','YES','NO','$image','$id'");
			

			
			}
			
			if($result){
				echo "success";
			}
			else {
				echo "fail";
			}
		
		}
	*/	
?> 