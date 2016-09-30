<?php
session_start();
include_once('db_connections/connection_db.php');
include_once('db_function/db_func.php');

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
		
		$get_query = "SELECT event_id,event_image,event_name,date,status,venue from event ORDER BY event_id DESC $limit ";
		$data = '';
		$res_query = mysqli_query($connect,$get_query);
		while($row=mysqli_fetch_array($res_query)){
			$id = $row['event_id'];
			$image = $row['event_image'];
			$name = $row['event_name'];
			$date = $row['date'];
			$status = $row['status'];
			$venue = $row['venue'];
			$data .= $id.'|'.$image.'|'.$name.'|'.$date.'|'.$status.'|'.$venue.'||';
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