<?php

/*	function 
 *	for uploading
 *	images
 */
function image_noresize($name){

		$image = $name['name'];
		$tp = $name['tmp_name'];
		$fileTypes =$name['type'];
		
		
		if((strtolower($fileTypes) == "image/jpg") ||
			(strtolower($fileTypes) == "image/jpeg") ||
			(strtolower($fileTypes) == "image/png") ||
			(strtolower($fileTypes) == "image/bmp")){
			
			$target = IMAGE_UPLOADPATH.$image;
			
			move_uploaded_file($tp,$target);

		}
		
		return $image;
} 
 
function image_upload($name){

		$image = time().$name['name'];
		$tp = $name['tmp_name'];
		$fileTypes =$name['type'];
		
		
		if((strtolower($fileTypes) == "image/jpg") ||
			(strtolower($fileTypes) == "image/jpeg") ||
			(strtolower($fileTypes) == "image/png") ||
			(strtolower($fileTypes) == "image/bmp")){
			
			$target = IMAGE_UPLOADPATH.$image;
			
			move_uploaded_file($tp,$target);
			
			$magicianObj = new imageLib($target);
			$magicianObj -> resizeImage(600, 600);
			unlink($target);
			$magicianObj -> saveImage($target);
		}
		
		return $image;
}


/*	function 
 *	for inserting data
 *	into event table
 */
function _sqlInsert_event($table,$values) {
	$connect = db_connect();
		
	$query = "Insert into ".$table." (event_name,date,venue,allow_segment,max_score,min_score,interval_score,category_select,event_image) values(".$values.")";
	
	$result = mysqli_query($connect,$query)or die(mysqli_error($connect));
	
	return $result;

		
}

/*	function 
 *	for inserting data
 *	to all tables
 */
function _sqlInsert($table,$values) {

	$connect = db_connect();
	$query = "Insert into ".$table."  values('',".$values.")";
	
	$result = mysqli_query($connect,$query)or die(mysqli_error($connect));
	
	return $result;

		
}

/*	returns 
 *	an array
 *	data
 */
function db_res_to_array($result)
{
	$connect=db_connect();
	$res_to_array = array();
	
	for($count=0;$row = mysqli_fetch_array($result);$count++)
	{
		$res_to_array[$count] = $row;
	
	}
	
	return $res_to_array;
	
}

/*	function 
 *	for selecting data
 *	from event table
 */
 function _sqlSelect_event_url($arg1,$arg2,$arg3){

	$connect=db_connect();
	$query = "Select * from event where event_name = '".$arg1."' AND date = '".$arg2."' AND event_id = '".$arg3."' LIMIT 1";
	
	$result = mysqli_query($connect,$query);
	
	
	return $result;
}
function _sqlSelect_event($arg1,$arg2){

	$connect=db_connect();
	$query = "Select * from event where event_name = '".$arg1."' AND date = '".$arg2."' LIMIT 1";
	
	$result = mysqli_query($connect,$query);
	$result = db_res_to_array($result);
	
	return $result;
}


/*	function 
 *	for selecting max id
 *	in segment table
 */
function _sqlSelect_max_segment($arg1){

	$connect=db_connect();
	$query = "Select max(segment_id) as id from segment where event_id = '".$arg1."' LIMIT 1";
	
	$result = mysqli_query($connect,$query)or die(mysqli_error($connect));
	$result = mysqli_fetch_assoc($result);
	
	return $result;
}


/*	function 
 *	for selecting id
 *	from event table
 */
function _sqlSelect_eventID($arg1,$arg2){

	$connect=db_connect();
	$query = "Select * from event where event_name = '".$arg1."' AND date = '".$arg2."' LIMIT 1";
	
	$result = mysqli_query($connect,$query);
	$result = mysqli_fetch_assoc($result);
	
	return $result;
}


/*	function 
 *	for mysql_real_escape_string
 *	
 */
function _sqlReal($values){

	$connect = db_connect();
	$val = mysqli_real_escape_string($connect,$values);
	
	return $val;
	
	
}

/*	function 
 *	for selecting data
 *	to all tables
 */
function _sqlSelect($table){

	$connect=db_connect();
	$query = "Select * from ".$table." ";
	
	$result = mysqli_query($connect,$query);
	$result = db_res_to_array($result);
	
	return $result;
}

/*	function 
 *	for selecting last insert
 *	in contestants table
 */

function _sqlLast_insert($column,$table,$col,$id){
	$connect=db_connect();
	
	$query = "Select ".$column." as id from ".$table." where ".$col." = '".$id."' LIMIT 1";
	$result = mysqli_query($connect,$query);
	$result = mysqli_fetch_assoc($result);
	$id = $result['id']; 
	
	
	return $id;
	
}

function _sqlRetrieve_num($column,$table,$col,$id){
	$connect=db_connect();
	
	$query = "Select ".$column." from ".$table." where ".$col." = '".$id."'";
	$result = mysqli_query($connect,$query);
	 
	return $result;
	
}
function _sqlRetrieve_param($column,$table,$col,$id,$param){
	$connect=db_connect();
	
	$query = "Select ".$column." from ".$table." where ".$col." = '".$id."' ".$param."";
	$result = mysqli_query($connect,$query)or die(mysqli_error($connect));
	 
	return $result;
	
}
function _sqlRetrieve_param2($column,$table,$col,$id,$param){
	$connect=db_connect();
	
	$query = "Select ".$column." from ".$table." where ".$col." = '".$id."' ".$param."";
	$result = mysqli_query($connect,$query)or die(mysqli_error($connect));
	$result = db_res_to_array($result);
	return $result;
	
}

function _sqlRetrieveBygroup($column,$table,$condition,$value,$group,$order){
	$connect=db_connect();
	
	$query = "SELECT ".$column." FROM ".$table." WHERE ".$condition." = '".$value."' GROUP BY ".$group." ORDER BY sum(score) ".$order."";
	$result = mysqli_query($connect,$query);
	$result = db_res_to_array($result);
	
	
	
	return $result;
	
}


/*	function 
 *	for retrieving data
 *	in contestants table last insert id
 */
function _sqlQuerySelectLast($table,$column,$last){
	$connect=db_connect();
	$query = "Select * from ".$table." where ".$column." =  '".$last."'";
	
	$result = mysqli_query($connect,$query);
	$result = mysqli_fetch_assoc($result);
	
	return $result;
}

/*	function 
 *	for retrieving data
 *	in criteria table last insert id
 */
 function _sqlQueryMrMs($table,$column,$id,$col2,$id2,$column2,$val){
	$connect=db_connect();
	$query = "Select * from ".$table." where ".$column." =  '".$id."' AND ".$col2." = '".$id2."' ORDER BY ".$column2." ".$val."";
	
	$result = mysqli_query($connect,$query);
	$result = db_res_to_array($result);

	
	return $result;
}

 function _sqlQueryMrMs2($table,$column,$id,$col2,$id2,$column2,$val){
	$connect=db_connect();
	$query = "Select * from ".$table." where ".$column." =  '".$id."' AND ".$col2." = '".$id2."' AND is_active = 'YES' ORDER BY ".$column2." ".$val."";
	
	$result = mysqli_query($connect,$query);
	$result = db_res_to_array($result);

	
	return $result;
}

function _sqlQuerycritseg($table,$column,$id,$col2,$id2){
	$connect=db_connect();
	$query = "Select * from ".$table." where ".$column." =  '".$id."' AND ".$col2." = '".$id2."'";
	
	$result = mysqli_query($connect,$query);

	
	return $result;
}

function _sqlQuerycrit($table,$col1,$val1,$col2,$val2,$col3,$val3){
	$connect=db_connect();
	$query = "Select * from ".$table." where ".$col1." =  '".$val1."' AND ".$col2." = '".$val2."' AND ".$col3." = '".$val3."'";
	
	$result = mysqli_query($connect,$query);

	
	return $result;
}

/*	function 
 *	for retrieving data
 *	where id = $id
 */
function _sqlQuerySelectAll($table,$column,$id){
	$connect=db_connect();
	$query = "Select * from ".$table." where ".$column." =  '".$id."'";
	
	$result = mysqli_query($connect,$query);
	$result = db_res_to_array($result);
	
	return $result;
}

function _sqlQuerySelectByOrder($table,$column,$id,$column2,$val){
	$connect=db_connect();
	$query = "Select * from ".$table." where ".$column." =  '".$id."' ORDER BY ".$column2." ".$val."";
	
	$result = mysqli_query($connect,$query);
	$result = db_res_to_array($result);
	
	return $result;
}
function _sqlQuerySelectByOrder2($table,$column,$id,$column2,$val){
	$connect=db_connect();
	$query = "Select * from ".$table." where ".$column." =  '".$id."' AND is_active = 'YES' ORDER BY ".$column2." ".$val."";
	
	$result = mysqli_query($connect,$query);
	$result = db_res_to_array($result);
	
	return $result;
}
/*	function 
 *	for updating
 *	event score
 */
function _sqlUpdate_event_score($val1,$val2,$val3,$id){

	$connect=db_connect();
	$query = "Update event SET max_score = '".$val1."', min_score = '".$val2."',interval_score='".$val3."', asispercentagescore = 'no' where event_id = '".$id."'";
	
	$result = mysqli_query($connect,$query)or die(mysqli_error($connect));
	
	return $result;
}

/*	function 
 *	for updating as is percentage
 *	in event score table
 */
function _sqlUpdate_event_asis($val1,$id){

	$connect=db_connect();
	$query = "Update event SET max_score = 0,min_score = 0, interval_score='".$val1."', asispercentagescore = 'yes' where event_id = '".$id."'";
	
	$result = mysqli_query($connect,$query)or die(mysqli_error($connect));
	
	return $result;
}

function updateAll($table,$column,$condition){
	
	$connect=db_connect();
	$query = "Update ".$table." SET ".$column." ".$condition." ";
	
	$result = mysqli_query($connect,$query)or die(mysqli_error($connect));
	
	return $result;

}

/*	function 
 *	for encrypting data
 *	withtime stamp;
 */

function  _deleteImage($file){
	$filename = 'upload_image/'.$file;
	unlink($filename);

}

function _sqlDelete($table,$column,$id){
	$connect=db_connect();
	mysqli_query($connect,"Delete from ".$table." where ".$column." =  '".$id."'");

	
	
	$result = mysqli_affected_rows($connect);
	
	
	return $result;

}


function _sqlDeleteAll($id){
	$connect=db_connect();
	mysqli_query($connect,"Delete from event where event_id =  '".$id."'");
	mysqli_query($connect,"Delete from criteria where event_id =  '".$id."'");
	mysqli_query($connect,"Delete from segment where event_id =  '".$id."'");
	mysqli_query($connect,"Delete from individual_contestant where event_id =  '".$id."'");
	mysqli_query($connect,"Delete from group_contestant where event_id =  '".$id."'");
	mysqli_query($connect,"Delete from judge where event_id =  '".$id."'");
	mysqli_query($connect,"Delete from score where event_id =  '".$id."'");
	
	
	$result = mysqli_affected_rows($connect);
	
	
	return $result;

}
function _md5($url){
	
	$encrypt = md5($url.time());
	
	
	return $encrypt;
	
}



?>