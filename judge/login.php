<?php
session_start();
include_once('../db_connections/connection_db.php');
include_once('../db_function/db_func.php');
$connect = db_connect();
			if($_POST){
				if ($_POST['action'] == 'formsubmit') {

					
					$id = htmlentities($_POST['id']);
					$id = _sqlReal($id);
				
					
					if(empty($id)) {
						fail('Please provide your judge id.');
						
					}

					$query = "SELECT * from judge where judge_id = '".mysqli_real_escape_string($connect,$id)."' LIMIT 1";

					
				   $result = mysqli_query($connect,$query);
							
					if(mysqli_num_rows($result) == 1) {
						$sql = "Update judge set online_stat = 'YES' where judge_id = '".$id."'";
						mysqli_query($connect,$sql);
						$res  = mysqli_fetch_assoc($result);
						$_SESSION['event_id'] = $res['event_id'];

					    $que = "SELECT * from event where event_id = '".mysqli_real_escape_string($connect,$_SESSION['event_id'])."' ";

					    $resul = mysqli_query($connect,$que);
					    $c  = mysqli_fetch_assoc($resul);

					    $_SESSION['cat'] = $c['category_select'];
					    $_SESSION['event'] = $c['event_name'];
					    $_SESSION['show'] = $c['is_show'];
						$_SESSION['judge_id'] = $id;
						$_SESSION['judge_name'] = $res['name'];
						setcookie("judge_id",$id,3600);
						setcookie("event_id",$res['event_id'],3600);
						
						$q = _sqlQuerySelectLast("event","event_id",$_SESSION['event_id']);
						$_SESSION['segment'] = $q['allow_segment'];
						if($q['allow_segment'] == 'no'){
							$msg = "../controller_score.php?action=_score2";
						}
						else {
							$msg = "../controller_score.php?action=score";
						}
						
						success($msg);
						
						 
					} else {
						fail("Oh snap!Invalid judge id!");
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