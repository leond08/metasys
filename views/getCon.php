<?php
session_start();
include_once('../db_connections/connection_db.php');
include_once('../db_function/db_func.php');

$connect = db_connect();


/* if($_GET){
	if($_GET['action'] == 'getEvent') {

	$get_query = "SELECT * from event";
	
	$res_query = mysqli_query($connect,$get_query);
	
	$msg = array();
	while($row=mysqli_fetch_array($res_query)){
		 array_push($msg,array('id' =>$row['event_id'],'image' => $row['event_image'],'name'=>$row['event_name'],'date' => $row['date'], 'status' => $row['status'])); 
	
	}
	
	echo json_encode(array('msg' => $msg));
	
	//write to json file
/*     $fp = fopen('data.json', 'w');
    fwrite($fp, json_encode(array('msg' => $msg)));
    fclose($fp);
	exit; 
	}
	
	

} */


		$rpp = preg_replace('#[^0-9]#', '', $_POST['rpp']);
		$last = preg_replace('#[^0-9]#', '', $_POST['last']);
		$pn = preg_replace('#[^0-9]#', '', $_POST['pn']);
		
		if($pn < 1){
			$pn = 1;
		} else if($pn > $last){
			$pn = $last;
		}
		
		$limit = 'LIMIT '.($pn-1)*$rpp.','.$rpp;
		
	
		
		$get_query = "SELECT * from individual_contestant where event_id = '".$_SESSION['eid']."'  ORDER BY type  $limit ";
		$data = '';
		$res_query = mysqli_query($connect,$get_query);
		while($row=mysqli_fetch_array($res_query)){
			$id = $row['con_id'];
			$con_id = $row['number'];
			$image = $row['image_name'];
			$fname = $row['fname'];
			$mi = $row['mi'];
			
			if($mi == ''){

				$mi = 'none';

			}

			$lname = $row['lname'];
			$name = $row['fname'].' '.$row['mi'].' '.$row['lname'];
			$country = $row['barangay'].','.$row['city'];
			$is_active = $row['is_active'];
			$finalist = $row['finalist'];
			$data .= $id.'|'.$con_id.'|'.$image.'|'.$name.'|'.$country.'|'.$is_active.'|'.$finalist.'|'.$fname.'|'.$mi.'|'.$lname.'|'.$row['barangay'].'|'.$row['city'].'||';
		}
		echo $data;
		exit;
	
	




function fail($message) {
	die(json_encode(array('status' => 'fail', 'message' => $message)));
}

function success($message) {
	die(json_encode(array('status' => 'success', 'message' => $message)));
}
?>