<?php
session_start();
include_once('db_connections/connection_db.php');
include_once('db_function/db_func.php');
include_once('php_image_magician/php_image_magician.php');
define('IMAGE_UPLOADPATH','upload_image/');
$connect = db_connect();




$action = empty($_GET['action'])? 'index': $_GET['action'];


  
switch($action){

	case "index":
		header('location:dashboard.php');
	break;
	
	case "calendar":
		if(!isset($_SESSION['pass'])){
		
		header('location:index.php');
	
		}
		header('views/calendar.php');
	break;
	
	case "add_event":
		if(!isset($_SESSION['pass'])){
		
		header('location:index.php');
	
		}
		header('views/add_event.php');
	break;

	case "add_segment":
		if(!isset($_SESSION['pass'])){
		
		header('location:index.php');
	
		}
		header('views/add_segment');
	break;

	case "add_judge":
		if(!isset($_SESSION['pass'])){
		
		header('location:index.php');
	
		}
		header('views/add_judge');
	break;
	
	case "add_score":
		if(!isset($_SESSION['pass'])){
		
		header('location:index.php');
	
		}
		header('views/add_scoring');
	break;
	
	case "add_contestant":
		if(!isset($_SESSION['pass'])){
		
		header('location:index.php');
	
		}
		header('views/add_contestant');
	break;
	
	case "add_group":
		if(!isset($_SESSION['pass'])){
		
		header('location:index.php');
	
		}
		header('views/add_group');
	break;
	
	case "add_criteria":
		if(!isset($_SESSION['pass'])){
		
		header('location:index.php');
	
		}
		header('views/add_criteria');
	break;
	
	case "view_criteria":
		if(!isset($_SESSION['pass'])){
		
		header('location:index.php');
	
		}
		header('views/view_criteria');
	break;

	case "view_segment":
		if(!isset($_SESSION['pass'])){
		
		header('location:index.php');
	
		}
			 /*******************************/

	break;
	
	case "view_group":	
		if(!isset($_SESSION['pass'])){
		
		header('location:index.php');
	
		}
			 /*******************************/

	break;

	case "view_judge":
		if(!isset($_SESSION['pass'])){
		
		header('location:index.php');
	
		}
	break;
	
	case "view_score":
		if(!isset($_SESSION['pass'])){
		
		header('location:index.php');
	
		}
		//echo 'this a view score';
		
	break;
	
	case "view_contestant":
		if(!isset($_SESSION['pass'])){
		
		header('location:index.php');
	
		}
	break;
	
	case "view_results":
		if(!isset($_SESSION['pass'])){
		
		header('location:index.php');
	
		}
	break;
	
	case "view_mrms":
		if(!isset($_SESSION['pass'])){
		
		header('location:index.php');
	
		}
	break;
	
	case "view_tabulated":
		if(!isset($_SESSION['pass'])){
		
		header('location:index.php');
	
		}
	break;
	
	case "view_tabulated_mrms_segment":
		if(!isset($_SESSION['pass'])){
		
		header('location:index.php');
	
		}
	break;
	
	case "view_tabulated_mrms_criteria":
		if(!isset($_SESSION['pass'])){
		
		header('location:index.php');
	
		}
	break;
	
	case "view_tabulated_criteria":
		if(!isset($_SESSION['pass'])){
		
		header('location:index.php');
	
		}
	break;
	/*  create event
	 *
	 *
	 */
	case "create":
		if($_POST){
			if($_POST['action'] == 'formsubmit'){
				
				$name = _sqlReal($_POST['event_name']);
				$date = _sqlReal($_POST['event_date']);
				$venue= _sqlReal($_POST['event_venue']);
				$part = _sqlReal($_POST['participants']);
				$segment = $_POST['segment'];
				if($segment == 'yes'){
					$segment = 'yes';
				}
				else{
					$segment = 'no';
				}
				
				$image = $_FILES['event_image'];
			
				$image = image_upload($image);

			if(!empty($_POST['event_name'])){
			
			$result = _sqlInsert_event("event","'$name','$date','$venue','$segment','10','7','0.5','$part','$image'");
			}
			if($result){
				$result = _sqlSelect_eventID($name,$date);
				$id = $result['event_id'];
				header('location:event.php?id='.$id.'&name='.urlencode($name).'&date='.$date);
			}
		}
		}
	break;
	
	/*  create segment
	 *
	 *
	 */
	case "create_segment":
		/*******************************
		 * segment
		 *******************************/
		 $connect = db_connect();
		 $result = _sqlSelect_eventID($_SESSION['event'],$_SESSION['date']);
		 $id = $result['event_id'];
	if($_POST){

		
		
		$name = _sqlReal($_POST['segment_name']);
		$percentage = _sqlReal($_POST['segment_percentage']);
		$result = _sqlInsert("segment","'$name','$percentage','$id'");
		

		$res = _sqlSelect_max_segment($id);
		$idto = $res['id']; 
		
		$criteria = explode(",", $_POST['segment_criteria']);
		
		
		for($b = 0;$b<count($criteria);$b++){
		$cc = $b+1;
		$crit = $criteria[$b];
		
		$result = _sqlInsert("criteria","'$crit','0','$cc','$id','$idto'");
		
		}
		
		
		if($result){
			 $data = '';
				
				$i = _sqlLast_insert("max(segment_id)","segment","event_id",$id);
				
			
				
				$crit = _sqlQuerySelectLast("segment","segment_id",$i);
				
				$name = $crit['name'];
				$percentage = $crit['percentage'];
				
				
				$data .= $name.'|'.$percentage.'||';
				 
				echo $data;
		} 
		else {
			echo 'false';
		}
		
	}
	
	if($_GET){
		$sum = _sqlLast_insert("sum(percentage)","segment","event_id",$id);
		
		echo $sum;
		
	}
	break;
	/*  create judge
	 *
	 *
	 */
	case "create_judge":

	break;
	/*  create score
	 *
	 *
	 */
	case "create_score":
	$result = _sqlSelect_eventID($_SESSION['event'],$_SESSION['date']);
	$id = $result['event_id'];
	if($_POST){
	

		$interval = $_POST['score_interval'];
		
		if($_POST['action'] == 'formsubmit'){
		
/* 			if($_POST['score_asis'] == 'yes'){
				
				$result = _sqlUpdate_event_asis($interval,$id);
				
			}else{ */
			$min = _sqlReal($_POST['min_score']);
			$max = _sqlReal($_POST['max_score']);
			if(!empty($_POST['min_score']) && !empty($_POST['max_score'])){
				
				$result = _sqlUpdate_event_score($max,$min,$interval,$id);
			}
			
			/* } */
			if($result){
				header('location:controller.php?action=view_score');
			}
		}

		
		}
	
	break;
	
	case "create_group":
		$result = _sqlSelect_eventID($_SESSION['event'],$_SESSION['date']);
		$id = $result['event_id'];
		if($_POST){
		

			$name = _sqlReal($_POST['group_name']);
			$no = _sqlReal($_POST['group_no']);
		
			
	
			//group inserted
				
				$image = $_FILES['fileUpload'];
			
				$image = image_upload($image);
				
			if(!empty($_POST['group_name'])){
			
			$result = _sqlInsert("group_contestant","'$name','$no','YES','$image','$id'");
			
			
			}
			
		
			
			if($result){
				$data = '';
				
				$id = _sqlLast_insert("max(group_id)","group_contestant","event_id",$id);
				
				$crit = _sqlQuerySelectLast("group_contestant","group_id",$id);
				
				$name = $crit['group_name'];
				$image = $crit['group_image'];
				
				$data .= $name.'|'.$image.'||';
			}
			else {
				$data = 'fail';
			}
			echo $data;
		}
	
	break;
	
	case "create_contestant":

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
			if($cat == 'MrMs'){
				$cat = _sqlReal($_POST['participants']);
			}
			else{
				$cat = $result['category_select'];
			}
			
	
			//contestant inserted
				
				$image = $_FILES['fileUpload'];
			
				$image = image_upload($image);
				
			if(!empty($_POST['candid_lname'])){
			
			$result = _sqlInsert("individual_contestant","'$lname','$fname','$mi','$cat','$barangay','$city','$candid_no','YES','NO','$image','$id'");
			

			
			}
			
		
			
			if($result){
				$data = '';
				
				$id = _sqlLast_insert("count(con_id)","individual_contestant","event_id",$id);
				
				$crit = _sqlQuerySelectLast("individual_contestant","con_id",$id);
				
				$name = $crit['lname'];
				$image = $crit['image_name'];	
				
				$data .= $name.'|'.$image.'||';
			}
			else {
				$data = 'fail';
			}
			echo $data;
		}
		

	break;
	
	case "create_criteria":
	$connect = db_connect();
		 $result = _sqlSelect_eventID($_SESSION['event'],$_SESSION['date']);
		 $id = $result['event_id'];
	if($_POST){

		$percentage = _sqlReal($_POST['segment_percentage']);
		$crit = _sqlReal($_POST['segment_criteria']);
		

		
		$result = _sqlInsert("criteria","'$crit','$percentage','0','$id','0'");

		
		
		if($result){
			 $data = '';
				
				$i = _sqlLast_insert("max(criteria_id)","criteria","event_id",$id);
				
			
				
				$crit = _sqlQuerySelectLast("criteria","criteria_id",$i);
				
				$name = $crit['name'];
				$percentage = $crit['percentage'];
				
				
				$data .= $name.'|'.$percentage.'||';
				 
				echo $data;
		} 
		else {
			echo 'false';
		}
		
	}
	
	if($_GET){
		$sum = _sqlLast_insert("sum(percentage)","criteria","event_id",$id);
		
		echo $sum;
		
	}
	break;
	
	case "update_segment":
		 $connect = db_connect();
		 $result = _sqlSelect_eventID($_SESSION['event'],$_SESSION['date']);
		 $id = $result['event_id'];
		 $count = 0;
	if($_POST){
		$data = '';
		if($_POST['action'] == 'formsubmit'){
		$seg = $_POST['seg_id'];
		
		$query = "UPDATE segment SET percentage = '".$_POST['seg']."' where segment_id = '".$seg."' AND event_id = '".$id."'";
			
		$result = mysqli_query($connect,$query);

		foreach($_POST['crit_id'] as $key => $value){
		$per = $_POST['criteria_percentage'][$key];
 			$query = "UPDATE criteria SET percentage = '".$per."' where criteria_id = '".$value."' AND event_id = '".$id."'";
			
			$result = mysqli_query($connect,$query);
			
		}
		if($result){
			echo "Success";
			header('location:controller.php?action=view_segment');
			
		}
		
		}
	}
	
	if($_GET){
		$i = $_GET['id'];
		$q = "DELETE FROM criteria where criteria_id = '".$i."'";
		$reso = mysqli_query($connect,$q);
		header('location:controller.php?action=view_segment');
	}
	if($_GET){
		$d = $_GET['seg_id'];
		$q = "DELETE FROM segment where segment_id = '".$d."'";
		$reso = mysqli_query($connect,$q);
		
		$q = "DELETE FROM criteria where segment_id = '".$d."'";
		$reso = mysqli_query($connect,$q);

		$q = "DELETE FROM score where segment_id = '".$d."'";
		$reso = mysqli_query($connect,$q);

		header('location:controller.php?action=view_segment');
	}
		
	break;
	
	case "update_judge":
		 $connect = db_connect();
		 $result = _sqlSelect_eventID($_SESSION['event'],$_SESSION['date']);
		 $id = $result['event_id'];
		 $count = 0;
	if($_POST){
		$data = '';
		if($_POST['action'] == 'formsubmit'){
		$jid = $_POST['ju_id'];
		echo $jid;
		echo $_POST['judge_name'];
		echo $_POST['judge_designate'];
		
		$query = "UPDATE judge SET name = '".$_POST['judge_name']."', designation = '".$_POST['judge_designate']."' where judge_id = '".$jid."' AND event_id = '".$id."'";
			
		$result = mysqli_query($connect,$query)or die(mysqli_error($connect));

		if($result){
			echo "Success";
			header('location:controller.php?action=view_judge');
			
		}
		
		}
	}
	
		
    if($_GET){
		if(isset($_GET['judge_id'])){
		$d = $_GET['judge_id'];
		$q = "DELETE FROM judge where judge_id = '".$d."'";
		$reso = mysqli_query($connect,$q);
		if($reso){
		echo "success";
		header('location:controller.php?action=view_judge');
		}
		}
		
	}
		
	break;
	
	case "update_event":

				
				$name = _sqlReal($_POST['event_name']);
				$date = _sqlReal($_POST['event_date']);
				$venue= _sqlReal($_POST['event_venue']);
				$id = _sqlReal($_POST['event_id']);
				$image = $_FILES['event_image'];
				$img = $_FILES['event_image']['name'];
			
				if($img == ''){
					$result = updateAll("event","event_name = '$name',date = '$date',venue='$venue'","WHERE event_id = '$id'");
				}
				else{
					if(!empty($_POST['event_name'])){
			
					$result = updateAll("event","event_name = '$name',date = '$date',venue='$venue',event_image='$img'","WHERE event_id = '$id'");
						 $image = image_noresize($image);
					}
				}

			
			if($result){
				echo "Success ";
			header('location:all_events.php');
			}
	
	break;

	case "get_show":
	
		
		$get_query = "SELECT * from event where event_id = '".$_SESSION['event_id']."' ";
		$data = '';
		$res_query = mysqli_query($connect,$get_query);
		while($row=mysqli_fetch_array($res_query)){
			$show = $row['is_show'];
			
			$data .= $show.'||';
		}
		echo $data;
		exit;


	break;
	
	case "update_con":
	if($_POST){
	
		$stat = _sqlReal($_POST['status']);
		$id =  _sqlReal($_POST['id']);
			
				
					$result = updateAll("individual_contestant","is_active = '$stat'","WHERE con_id = '$id'");
		
		
		if($result){
			echo "success";
		}
				
	}
	break;


	case "show_score":
	if($_POST){
	
	
		$id =  _sqlReal($_POST['id']);
			
				
					$result = updateAll("event","is_show = 'YES'","WHERE event_id = '$id'");
		
		
		if($result){
			
		}

		
				
	}
	break;
	
	case "update_contestant":
	
	if($_POST){
	
		$cid = _sqlReal($_POST['con_id']);
		$con_id = _sqlReal($_POST['candid_no']);
		$lname= _sqlReal($_POST['candid_lname']);
		$fname = _sqlReal($_POST['candid_fname']);
		$mi = _sqlReal($_POST['candid_mi']);
		$address = _sqlReal($_POST['candid_address']);
		$barangay = _sqlReal($_POST['candid_barangay']);
		$img = $_FILES['candid_image']['name'];
		$image = $_FILES['candid_image'];
		
				if($img == ''){
					$result = updateAll("individual_contestant","number = '$con_id',lname = '$lname',fname='$fname',mi = '$mi',barangay = '$barangay',city = '$address'","WHERE con_id = '$cid'");
				}
				else{
					$image = image_upload($image);
					$result = updateAll("individual_contestant","number = '$con_id',lname = '$lname',fname='$fname',mi = '$mi',barangay = '$barangay',city = '$address',image_name = '$image'","WHERE con_id = '$cid'");	 
				}

				if($result){
					header('location:controller.php?action=view_contestant');
				}
			
				

				
	}
	break;
	
	case "update_criteria_segment":
		$connect = db_connect();
		$result = _sqlSelect_eventID($_SESSION['event'],$_SESSION['date']);
		$id = $result['event_id'];
		$criteria =$_POST['segment_criteria'];
		$idto = $_GET['id'];
		
		for($b = 0;$b<count($criteria);$b++){
		$cc = $b+1;
		$crit = $criteria[$b];
		
		$result = _sqlInsert("criteria","'$crit','0','$cc','$id','$idto'");
		
		}
		
		if($result){
			header('location:controller.php?action=view_segment');
		}
		
	break;
	
		case "update_crit":
		$connect = db_connect();
		$percentage = _sqlReal($_POST['seg']);
		$criteria_id = _sqlReal($_POST['seg_id']);
		
		$result =  updateAll("criteria","percentage = '$percentage'","WHERE criteria_id = '$criteria_id'");	 
		
		if($result){
			header('location:controller.php?action=view_criteria');
		}
		
	break;
	
	case "update_criteria":
		if($_GET){
		$i = $_GET['crit_id'];
		$q = "DELETE FROM criteria where criteria_id = '".$i."'";
		$reso = mysqli_query($connect,$q);
		$c = "DELETE FROM score where criteria_id = '".$i."'";
		$res = mysqli_query($connect,$c);
		header('location:controller.php?action=view_criteria');
	}
	break;
	
	case "update_group":
	if($_POST){
		
		$cid = _sqlReal($_POST['con_id']);
		$con_id = _sqlReal($_POST['candid_no']);
		$fname = _sqlReal($_POST['candid_fname']);
		$img = $_FILES['candid_image']['name'];
		$image = $_FILES['candid_image'];
		
				if($img == ''){
					$result = updateAll("group_contestant","number = '$con_id',group_name='$fname'","WHERE group_id = '$cid'");
				}
				else{
					$image = image_upload($image);
					$result = updateAll("group_contestant","number = '$con_id',group_name='$fname',group_image = '$image'","WHERE group_id = '$cid'");	 
				}

				if($result){
					header('location:controller.php?action=view_group');
				}
	
		
	
	}
	if($_POST){
	
		$stat = _sqlReal($_POST['status']);
		$id =  _sqlReal($_POST['id']);
			
				
					$result = updateAll("group_contestant","is_active = '$stat'","WHERE group_id = '$id'");
		
		
		if($result){
			echo "success";
		}
				
	}
	
	
	break;
		
	case "404":
		header('views/404');
	break;
	
	default:
		header('location:controller.php?action=404');
	break;
	

}
// controller pages
include($_SERVER['DOCUMENT_ROOT'].'/'.'meta/views/'.$action.'.php' );


?>