<?php
session_start();
include_once('db_connections/connection_db.php');
include_once('db_function/db_func.php');


$connect = db_connect();


if($_GET){
	if($_GET['action'] == 'getMessage') {
	
	$result = _sqlSelect_eventID($_SESSION['event'],$_SESSION['date']);
	$seg = $result['allow_segment'];
	if($seg == 'YES' || $seg == 'yes'){
		$col = "c.segment_id";
		$table = "segment";
		$col1 = "a.segment_id";
	}
	else {
		$col = "c.criteria_id";
		$table = "criteria";
		$col1 = "a.criteria_id";
	}
			
	$selecta =  _sqlRetrieve_param2("distinct b.name as jname,c.name as name","score as a,judge as b,$table  as c","a.event_id",$_SESSION['eid'],"AND $col = $col1  AND a.judge_id = b.judge_id ORDER BY a.score_id");
	
	$msg = array();
	  foreach($selecta as $row){
		array_push($msg,array('judge_name' => $row['jname'],'crit_name' => $row['name'],));
	}
	
	echo json_encode(array('msg' => $msg));
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