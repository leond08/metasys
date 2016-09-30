<?php
session_start();
include_once('db_connections/connection_db.php');
include_once('db_function/db_func.php');
include_once('db_function/score_func.php');

$connect = db_connect();

$eve_id =$_SESSION['event_id'];


$action = empty($_GET['action'])? 'index': $_GET['action'];


  
switch($action){

	case "index":
		header('location:judge/');
	break;
	
	case "score":
		$q = _sqlQuerySelectLast("event","event_id",$_SESSION['event_id']);
			$eve_name = $q['event_name'];
		header('judge/score');
	break;
	
	case "_score":
	if($_GET){
	
		if(isset($_GET['id']) && isset($_GET['criteria'])){
			$id = $_GET['id'];
			$crit = $_GET['criteria'];
			$q = _sqlQuerySelectLast("event","event_id",$_SESSION['event_id']);
			$eve_name = $q['event_name'];
			$asis = $q['asispercentagescore'];
			$cat = $q['category_select'];
			$min = $q['min_score'];
			$max = $q['max_score'];
			$int = $q['interval_score'];
			$_SESSION['crit'] = $id;
			if($q['allow_segment'] == 'yes'){
				$res = _sqlQuerycritseg("criteria","segment_id",$id,"event_id",$_SESSION['event_id']);
				if(mysqli_num_rows($res) <= 0){
					
				}
			}
			else {
				$res = _sqlQuerycrit("criteria","criteria_id",$id,"name",$crit,"event_id",$_SESSION['event_id']);
				if(mysqli_num_rows($res) <= 0){
				header('location:controller.php?action=404');
				}
			}
			

			
		
		}else{
			header('location:controller.php?action=404');
		}	
	}
	
	break;
	
	case "_score2":
	
			
			$q = _sqlQuerySelectLast("event","event_id",$_SESSION['event_id']);
			$eve_name = $q['event_name'];
			$asis = $q['asispercentagescore'];
			$cat = $q['category_select'];
			$min = $q['min_score'];
			$max = $q['max_score'];
			$int = $q['interval_score'];
			

			

			
		
	
	
	break;
	
	case "score_segment":
	
	$judge = $_SESSION['judge_id'];
	$cid = $_SESSION['crit'];
	// mr and ms.............
	$final = '';
	if($_POST){
		if(isset($_POST['action']) == 'formsubmit'){
			$q = _sqlQuerySelectLast("event","event_id",$_SESSION['event_id']);
			$seg = $q['allow_segment'];
			$cat = $q['category_select'];
			$count = 0;
			$score = '';
			
			
			/***************************
				for group
			***************************/
			if($cat == 'Group' || $cat == 'group' ){
			echo "You are in Grouup";
				if($seg == 'yes' || $seg == 'Yes' ){
				
				//loop all contestant
				foreach($_POST['con_id'] as $con){
					$value = 0;
					
					// if segment does not have criteria return this
					$res = _sqlQuerycritseg("criteria","segment_id",$cid,"event_id",$_SESSION['event_id']);
					if(mysqli_num_rows($res) <= 0){
						$score_value =  $_POST['score_val'][$count];
						
						$qu = _sqlQuerySelectAll("segment","segment_id",$cid);
						foreach($qu as $q){
						  $n = ($q['percentage']/100);
						}
						echo " Candidate no : ".$con;
						echo " Score is: ".$score_value;
						echo " Process 1 => ".$n;
						$percent = $n;
						$reso = $score_value*$percent;
						echo " process 2 => ".$reso." "; 
						
						$result = _sqlInsert_scoreSeg("score","judge_id,group_id,segment_id,score,event_id","'$judge','$con','$cid','$reso','$eve_id'");
						
						echo " DITO KA>..";
						$count++;
					}
					else{
					
					//loop all criteria
					foreach($_POST['crit_id'] as $crit){
					echo $crit."=> ";
					
					//get percentage of the criteria
					$percent =  _sqlQuerySelectLast("criteria","criteria_id",$crit);
						
						// if percentage is 0 return this
						if($percent['percentage'] == 0 || $percent['percentage'] == '0.00'){
						$check = true;
						$score_value =  $_POST['score_val'][$count];
						$qu = _sqlQuerySelectAll("segment","segment_id",$cid);
						foreach($qu as $q){
						  $n = ($q['percentage']/100);
						}
						echo " process 5 => ".$n;
						$percent = $n;
						$reso = $score_value*$percent;
						echo " process 6 => ".$reso." "; 
						$result =_sqlInsert_scoreSeg("score","judge_id,group_id,segment_id,score,event_id","'$judge','$con','$cid','$reso','$eve_id'");
						
						echo $score_value."iTO NAH ";
						
						}
						
						// else if percentage is not 0 return this
						else{
						echo "con id# ".$con."=> ";
						echo " process 1 =>".$value;
						
						// get computed_score, score * percentage
						$computed_score = $_POST['score_val'][$count] * ($percent['percentage']/100);
						echo " criteria percentage ".($percent['percentage']/100);
						echo " process 2 => ".$computed_score."\n";
						$value += $computed_score;
						echo " process 3 => ".$value.' => ';

						}
						// end of if else
						$count++;
					}
						
						 // echo end inner loop
						 if($check == false){
						$value = $value;
						echo " process 4 => ".$value;
						$qu = _sqlQuerySelectAll("segment","segment_id",$cid);
						foreach($qu as $q){
						 if($q['percentage'] == 0){
						  $n = 1;
						}
						else {
							$n = ($q['percentage']/100);
						}
						}
						echo " process 5 => ".$n;
						$percent = $n;
						$reso = $value*$percent;
						echo " process 6 => ".$reso." "; 
						
						$result = _sqlInsert_scoreSeg("score","judge_id,group_id,segment_id,score,event_id","'$judge','$con','$cid','$reso','$eve_id'");
						
						}
						
						
						//$final .= $con.'=>'.$reso.'||'; */
						
				}	
				// endof outer loop
				
					
					//echo $final;
						//header('location:controller_score.php?action=score');
				}
				}
				// else if allow segment is false return this
				else {
				echo "You are in no allowed segment";
				// loop all contestant
				foreach($_POST['con_id'] as $con){
					    $percent =  _sqlQuerySelectLast("criteria","criteria_id",$cid);
						
						// check if percentage is 0 then return this
						if($percent['percentage'] == 0 || $percent['percentage'] == '0.00'){
						$score_value =  $_POST['score_val'][$count];
						$result = _sqlInsert_scoreSeg("score","judge_id,group_id,criteria_id,score,event_id","'$judge','$con','$cid','$score_value','$eve_id'");
						}
						// else percentage is 1 then return this
						else{
						$computed_score = $_POST['score_val'][$count] * ($percent['percentage']/100);
					
						$result = _sqlInsert_scoreSeg("score","judge_id,group_id,criteria_id,score,event_id","'$judge','$con','$cid','$computed_score','$eve_id'");
						}
						$count++;
					
				}
				
				//header('location:controller_score.php?action=score');
				
		
				}

						
			}
			/***************************
				for MR and MS
			***************************/
			else{
			// allow segment condition if true return this
			if($seg == 'yes' || $seg == 'Yes' ){
				$check = false;
				//loop all contestant
				foreach($_POST['con_id'] as $con){
					$value = 0;
					
					// if segment does not have criteria return this
					$res = _sqlQuerycritseg("criteria","segment_id",$cid,"event_id",$_SESSION['event_id']);
					if(mysqli_num_rows($res) <= 0){
						$score_value =  $_POST['score_val'][$count];
						
						$qu = _sqlQuerySelectAll("segment","segment_id",$cid);
						foreach($qu as $q){
						  $n = ($q['percentage']/100);
						}
						echo " Candidate no : ".$con;
						echo " Score is: ".$score_value;
						echo " Process 1 => ".$n;
						$percent = $n;
						$reso = $score_value*$percent;
						echo " process 2 => ".$reso." "; 
						
						$result = _sqlInsert_scoreSeg("score","judge_id,con_id,segment_id,score,event_id","'$judge','$con','$cid','$reso','$eve_id'");
						
						echo " DITO KA>..";
						$count++;
					}
					else{
					
					//loop all criteria
					foreach($_POST['crit_id'] as $crit){
					//echo $crit."=> ";
					
					//get percentage of the criteria
					$percent =  _sqlQuerySelectLast("criteria","criteria_id",$crit);
						
						// if percentage is 0 return this
						if($percent['percentage'] == 0 || $percent['percentage'] == '0.00'){
						$check = true;
						$score_value =  $_POST['score_val'][$count];
						
						$qu = _sqlQuerySelectAll("segment","segment_id",$cid);
						foreach($qu as $q){
						  $n = ($q['percentage']/100);
						}
						echo " process 5 => ".$n;
						$percent = $n;
						$reso = $score_value*$percent;
						echo " process 6 => ".$reso." "; 
						$result =_sqlInsert_scoreSeg("score","judge_id,con_id,segment_id,score,event_id","'$judge','$con','$cid','$reso','$eve_id'");
						
						echo $score_value."iTO NAH ";
						
						}
						
						// else if percentage is not 0 return this
						else{
						echo "con id# ".$con."=> ";
						echo " process 1 =>".$value;
						
						// get computed_score, score * percentage
						$computed_score = $_POST['score_val'][$count] * ($percent['percentage']/100);
						echo " criteria percentage ".($percent['percentage']/100);
						echo " process 2 => ".$computed_score."\n";
						$value += $computed_score;
						echo " process 3 => ".$value.' => ';

						}
						// end of if else
						$count++;
						
					}
						
 					 // echo end inner loop
						
						if($check == false){
 						$value = $value;
						echo " process 4 => ".$value;
						$qu = _sqlQuerySelectAll("segment","segment_id",$cid);
						foreach($qu as $q){
						if($q['percentage'] == 0){
						  $n = 1;
						}
						else {
							$n = ($q['percentage']/100);
						}
						}
						echo " process 5 => ".$n;
						$percent = $n;
						$reso = $value*$percent;
						echo " process 6 => ".$reso." "; 
						
						$result = _sqlInsert_scoreSeg("score","judge_id,con_id,segment_id,score,event_id","'$judge','$con','$cid','$reso','$eve_id'");
						}
						
						
						//$final .= $con.'=>'.$reso.'||'; */
						
				}	
				// endof outer loop
				
					
					//echo $final;
						//header('location:controller_score.php?action=score');
				}
				}
				// else if allow segment is false return this
				else {
				// loop all contestant
				foreach($_POST['con_id'] as $con){
					    $percent =  _sqlQuerySelectLast("criteria","criteria_id",$cid);
						
						// check if percentage is 0 then return this
						if($percent['percentage'] == 0 || $percent['percentage'] == '0.00'){
						$score_value =  $_POST['score_val'][$count];
						$result = _sqlInsert_scoreSeg("score","judge_id,con_id,segment_id,score,event_id","'$judge','$con','$cid','$score_value','$eve_id'");
						}
						// else percentage is 1 then return this
						else{
						$computed_score = $_POST['score_val'][$count] * ($percent['percentage']/100);
					
						$result = _sqlInsert_scoreSeg("score","judge_id,con_id,criteria_id,score,event_id","'$judge','$con','$cid','$computed_score','$eve_id'");
						}
						$count++;
					
				}
				
				//header('location:controller_score.php?action=score');
		
				}
			}
		}
	}	
	break;
	
	case "score_criteria":
	
	$judge = $_SESSION['judge_id'];
	
	// mr and ms.............
	$final = '';
	if($_POST){
		if(isset($_POST['action']) == 'formsubmit'){
			$q = _sqlQuerySelectLast("event","event_id",$_SESSION['event_id']);
		
			$cat = $q['category_select'];
			$count = 0;
			$score = '';
			
			
			/***************************
				for group
			***************************/
			if($cat == 'Group' || $cat == 'group' ){
			echo "You are in Grouup";
				
				//loop all contestant
				foreach($_POST['con_id'] as $con){
					$value = 0;
					
					
					//loop all criteria
					foreach($_POST['crit_id'] as $crit){
					echo $crit."=> ";
					
					$percent =  _sqlQuerySelectLast("criteria","criteria_id",$crit);
						
						// check if percentage is 0 then return this
						if($percent['percentage'] == 0 || $percent['percentage'] == '0.00'){
						$score_value =  $_POST['score_val'][$count];
						$result = _sqlInsert_scoreSeg("score","judge_id,group_id,criteria_id,score,event_id","'$judge','$con','$crit','$score_value','$eve_id'");
						}
						// else percentage is 1 then return this
						else{
						$computed_score = $_POST['score_val'][$count] * ($percent['percentage']/100);
					
						$result = _sqlInsert_scoreSeg("score","judge_id,group_id,criteria_id,score,event_id","'$judge','$con','$crit','$computed_score','$eve_id'");
						}
						$count++;
					}
				}
						
			}
			/***************************
				for MR and MS
			***************************/
			else{
			
			foreach($_POST['con_id'] as $con){
					$value = 0;
					
					
					//loop all criteria
					foreach($_POST['crit_id'] as $crit){
					echo $crit."=> ";
					
					$percent =  _sqlQuerySelectLast("criteria","criteria_id",$crit);
						
						// check if percentage is 0 then return this
						if($percent['percentage'] == 0 || $percent['percentage'] == '0.00'){
						$score_value =  $_POST['score_val'][$count];
						$result = _sqlInsert_scoreSeg("score","judge_id,con_id,criteria_id,score,event_id","'$judge','$con','$crit','$score_value','$eve_id'");
						}
						// else percentage is 1 then return this
						else{
						$computed_score = $_POST['score_val'][$count] * ($percent['percentage']/100);
					
						$result = _sqlInsert_scoreSeg("score","judge_id,con_id,criteria_id,score,event_id","'$judge','$con','$crit','$computed_score','$eve_id'");
						}
						$count++;
					}
				}
	}	
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
include($_SERVER['DOCUMENT_ROOT'].'/'.'meta/judge/'.$action.'.php' );


?>