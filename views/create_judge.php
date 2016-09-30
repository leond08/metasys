<?php	
	$result = _sqlSelect_eventID($_SESSION['event'],$_SESSION['date']);
	$id = $result['event_id'];
	if($_POST){

			if($_POST['action'] == 'formsubmit'){
				
					
				if(!empty($_POST['judge_name'])){
				
				for($i = 0;$i<count($_POST['judge_name']);$i++){
				$name = _sqlReal($_POST['judge_name'][$i]);
				$designate = _sqlReal($_POST['judge_designate'][$i]);
				$result = _sqlInsert("judge","'$name','$designate','$id','NO'");
				}
				}
				
		if($result){
			echo 'true';
		} 
		else {
			echo 'false';
		}
		header('location:controller.php?action=add_judge');
		}
		}

?> 