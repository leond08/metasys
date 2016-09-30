<?php
/*	function 
 *	for inserting data
 *	into score table with 
 *  segment only
 */
 function _sqlInsert_scoreSeg($table,$column,$values) {
	$connect = db_connect();
		
	$query = "Insert into ".$table." (".$column.") values(".$values.")";
	
	$result = mysqli_query($connect,$query)or die(mysqli_error($connect));
	
	return $result;
		
}

function _sqlInsert_score($table,$values) {
	$connect = db_connect();
		
	$query = "Insert into ".$table." (judge_id,con_id,criteria_id,score,event_id) values(".$values.")";
	
	$result = mysqli_query($connect,$query)or die(mysqli_error($connect));
	
	return $result;
		
}
function _sqlInsert_scoreGroup($table,$values) {
	$connect = db_connect();
		
	$query = "Insert into ".$table." (judge_id,group_id,criteria_id,score,event_id) values(".$values.")";
	
	$result = mysqli_query($connect,$query)or die(mysqli_error($connect));
	
	return $result;
		
}
?>