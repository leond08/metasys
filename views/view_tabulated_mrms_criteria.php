<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Meta | AdminPanel</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<!--- Select 2 ----->
	<link rel="stylesheet" href="plugins/select2/select2.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="dist/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="dist/css/ionicons.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.css">
    <!-- AdminPanel Skins. 
    -->
	<link rel="stylesheet" href="plugins/iCheck/all.css">
	<link rel="stylesheet" type="text/css" href="assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">
	<link rel="stylesheet" href="dist/css/chatbox.css">

	<!--
	  *  My script
	 -->
	<!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
	<script src="dist/js/chatbox_script.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
	<script src="plugins/select2/select2.full.min.js"></script>
	<script src="dist/js/jQuery.nicescroll.js"></script>
	<script src="dist/js/validatecriteria.js"></script>
	 <script src="plugins/iCheck/icheck.min.js"></script>
	
   
	
  </head>

  <body class="hold-transition skin-blue sidebar-mini fixed">
	<script>
		$(function() { 
			$('.conten-wrapper').niceScroll({cursorwidth: '10px', autohidemode: false, zindex: 999, horizrailenabled: false });
		});
   </script>
 
   <div class="wrapper">

      <!-- Main Header -->
	  
	  <?php include_once('views/tags/header.php');?>

      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          <!-- Sidebar Menu -->
          <style type="text/css">
	          	.rank_i {
	          		display: none;
	          	}

          </style>
          <script>
          $(function(){

          		$(".rank").click(function(){

          			$(".rank_i").show();
          			$(".score_i").hide();

          			//alert("you clicked me");

          		});
          		$(".score").click(function(){

          			$(".score_i").show();
          			$(".rank_i").hide();

          			//alert("you clicked me");

          		});





          });

          function showScore(val){
               
               var data = new XMLHttpRequest();
                    data.open("POST", "controller.php?action=show_score", true);
                    data.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                    data.onreadystatechange = function() {
                    
                    if (data.readyState == 4 && data.status == 200) {
                         
                         //alert("success");
                         
                         }
                    }    

                         var url = "id="+val;
                         
                         data.send(url);


          }
     </script>

          <script>
			var url;
			function run(e,elem){
				e.preventDefault();
			    url = $(elem).attr('id');
				$(elem).addClass('active');
				location.href = 'controller.php?action='+url;
				
			}
			

	
		  </script>
		  	<?php
				$result = _sqlSelect_eventID($_SESSION['event'],$_SESSION['date']);
				$cat = $result['category_select'];
				$seg = $result['allow_segment'];
				?>
		  <div class="user-panel">
            <div class="pull-left image">
              <img src="upload_image/<?php echo	$_SESSION['image'];?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo wordwrap($_SESSION['event'],15,'<br>');?></p>
              <!-- Status -->
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
		<ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
           
            <li>
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
             <ul class="treeview-menu">
				<?php if($seg == 'yes'){?>
                <li><a href="#"><i class="fa fa-edit"></i>criteria<small class="label pull-right bg-green"></small></a>
				<ul class="treeview-menu">
				 <li onclick="run(event,this)" id="view_criteria"><a href="#"><i class="fa fa-edit"></i>View criteria</a></li>
                <li onclick="run(event,this)" id="add_criteria"><a href="#"><i class="fa fa-edit"></i>Add criteria</a></li>
				</ul>
				</li>
				<?php }else{?>
				<li><a href="#"><i class="fa fa-edit"></i>Criteria<small class="label pull-right bg-green"></small></a>
				<ul class="treeview-menu">
				 <li onclick="run(event,this)" id="view_criteria"><a href="#"><i class="fa fa-edit"></i>View Criteria</a></li>
                <li onclick="run(event,this)" id="add_criteria"><a href="#"><i class="fa fa-edit"></i>Add Criteria</a></li>
				</ul>
				</li>
				<?php }?>
                <li><a href="#"><i class="fa fa-edit"></i> Judges <small class="label pull-right bg-green"></small></a>
				<ul class="treeview-menu">
				<li onclick="run(event,this)" id="view_judge"><a href="#"><i class="fa fa-edit"></i>View Judges</a></li>
                <li onclick="run(event,this)" id="add_judge"><a href="#"><i class="fa fa-edit"></i>Add Judges</a></li>
				</ul>
				</li>
				<li><a href="#"><i class="fa fa-edit"></i> Scoring <small class="label pull-right bg-green"></small></a>
				<ul class="treeview-menu">
				 <li onclick="run(event,this)" id="view_score"><a href="#"><i class="fa fa-edit"></i>view Scoring</a></li>
                <li onclick="run(event,this)" id="add_score"><a href="#"><i class="fa fa-edit"></i>Add Scoring</a></li>
				</ul>
				</li>
				<?php
					$result = _sqlSelect_eventID($_SESSION['event'],$_SESSION['date']);
					$cat = $result['category_select'];
					if($cat == 'Group'){ ?>
				<li ><a href="#"><i class="fa fa-edit"></i> Group <small class="label pull-right bg-green"></small></a>
				<ul class="treeview-menu">
				 <li onclick="run(event,this)" id="view_group"><a href="#"><i class="fa fa-edit"></i>View Group</a></li>
                <li onclick="run(event,this)" id="add_group"><a href="#" ><i class="fa fa-edit"></i>Add Group</a></li>
				</ul>
				</li>
				<?php }else{?>
				<li ><a href="#"><i class="fa fa-edit"></i> Contestants <small class="label pull-right bg-green"></small></a>
				<ul class="treeview-menu">
				 <li onclick="run(event,this)" id="view_contestant"><a href="#"><i class="fa fa-edit"></i>View Contestants</a></li>
                <li onclick="run(event,this)" id="add_contestant"><a href="#" ><i class="fa fa-edit"></i>Add Contestants</a></li>
				</ul>
				</li>
				<?php }?>

              </ul>
            </li>
			
			<li><a href="#"><i class="fa fa-edit"></i> Results <small class="label pull-right bg-green"></small></a>
				<ul class="treeview-menu">
				 <li onclick="run(event,this)" id="view_tabulated_mrms_criteria"><a href="#"><i class="fa fa-edit"></i>View Results</a></li>
                
				</ul>
				</li>
	
				
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Result
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
			<li class="active">View Result</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
				<?php
		 $ret = _sqlRetrieve_num("count(score_id) as id","score","event_id",$_SESSION['eid']);
		 $ret = mysqli_fetch_assoc($ret);
		 if($ret['id'] == 0):?>
		            
                  		<div class="col-md-12 col-sm-2 col-md-offset-1 box0 text-center" style="margin:0 auto;">
						<span class="li_heart">
                  			<div class="box1">
					  			<h1><i class="fa ion-person-add"></i></h1></span>
					  			<h3>Oops! Nothing to view.. Please wait for the results</h3>
                  			</div>
							
					  			<p>Please wait for the results....</p>
                  		</div>
                  
			<?php else:?>
		       <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                  <li class="active"><a href="#tab_1" data-toggle="tab">By criteria</a></li>
                  <li><a href="#tab_2" data-toggle="tab">By Contestant</a></li>
                        <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                     <i class="fa fa-gear"></i>
                    </a>
                    <ul class="dropdown-menu">
                      
                      <li class="judge" role="presentation"><a role="menuitem" tabindex="-1" href="#" onclick="showScore(<?php echo $_SESSION['eid'];?>)">show to Judges</a></li>
                      <li role="presentation" class="divider"></li>
                  
                    </ul>
      </li>
                </ul>
                <div class="tab-content">
				<!-----------------------------
						by criteria
				------------------------------>
				
                  <div class="tab-pane active" id="tab_1">
						
				<?php $res = _sqlRetrieve_param(" DISTINCT a.criteria_id as seg_id,b.percentage as percentage,b.name as name","score as a,criteria as b","a.event_id",$_SESSION['eid'],"AND b.criteria_id = a.criteria_id");
				
				$num = 1;
				$r=db_res_to_array($res);
				 $seg;
				 
				 foreach($r as $r):
				 $seg = $r['seg_id'];
				?>
				<div class="box-body">
                  <div class="box-group" id="accordion">
				     <div class="panel box box-primary">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                           <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $num;?>">
                            <?php echo $r['name'];?>
                          </a>
                          </a>
                        </h4>
                      </div>
					<div id="collapse<?php echo $num;?>" class="panel-collapse collapse in">
					<div class="nav-tabs-custom">
						<ul class="nav nav-tabs">
						<?php $male = md5($r['name'].'male');
							  $female = md5($r['name'].'female');
						?>
						  <li class="active"><a href="#tab_1_<?php echo $male?>" data-toggle="tab">Male</a></li>
						  <li><a href="#tab_2_<?php echo $female;?>" data-toggle="tab">Female</a></li>
			  
						</ul>
					 <div class="tab-content">
					 
					  <!---------/. Male Results ---------------->
					<div class="tab-pane active" id="tab_1_<?php echo $male;?>">
				   <div class="box-body">
				  <div class="table-responsive">
                   <table id="event_table" class="table no-margin table-hover text-center">
                      <thead>
                        <tr>
                          <th colspan="20" class="text-center">TABULATED RESULTS FOR <?php echo strtoupper($_SESSION['event']);?></th>
                        </tr>
					   <tr>
                          <th rowspan="2">#</th>
						  <th rowspan="2">Image</th>
						  <th rowspan="2">Candidate Name</th>
						  
						  <?php 
							
							$juddd = _sqlRetrieve_param("count(distinct judge_id) as count","score","event_id",$_SESSION['eid'],"order BY judge_id");
							$c_j = mysqli_fetch_assoc($juddd);
							$no_j = $c_j['count'];?>
						  <th colspan="<?php echo $no_j;?>">Judges</th>
						
  
                      </tr>
					  <tr>
					<?php 
					
						  	$juddd = _sqlRetrieve_param("distinct judge_id","score","event_id",$_SESSION['eid'],"order BY judge_id");
							$c_j = db_res_to_array($juddd);
							
							$r=db_res_to_array($res);
								foreach($c_j as $c ):
								$rank_tie = array();
								$num = 1;
									$rank = _sqlRetrieve_param("a.con_id as con_id,a.criteria_id as criteria_id,a.judge_id as judge_id","score as a,individual_contestant as b","a.event_id",$_SESSION['eid'],"AND judge_id = '".$c['judge_id']."' AND criteria_id = '".$seg."' AND b.con_id = a.con_id AND b.type = 'Mr' order BY score desc");
									$dbrank = db_res_to_array($rank);
									
									foreach($dbrank as $row){
										updateAll("score","rank = '".$num."'","WHERE judge_id='".$row['judge_id']."' AND con_id = '".$row['con_id']."' AND criteria_id = '".$row['criteria_id']."'");
										$num++;
									}
								?>
								
								<th><?php $ret = _sqlRetrieve_num("name","judge","judge_id",$c['judge_id']);

									 $judge = mysqli_fetch_assoc($ret);

									 echo $judge['name'];?></th>
								
								
						   <?php endforeach;?>
						
                      </tr>
                      </thead
					  <!-- show event---->
					  <tbody id="tbody">
					  
					 <!-- loop contestant details -->
					<?php 
					   
					 $t =  _sqlRetrieve_param2("a.criteria_id as criteria_id,a.con_id as con_id,b.fname as fname,b.mi as mi,b.lname as lname,b.number as number,b.image_name as image","score as a,individual_contestant as b","a.event_id",$_SESSION['eid'],"AND a.criteria_id = '$seg' AND a.con_id = b.con_id AND b.type = 'Mr' GROUP BY a.con_id ORDER BY sum(a.score) DESC");
					   
					  $tie = array();
					  $count = 1;
					   foreach($t as $d):
					   $tot_score = 0;
					  
						$name = $d['fname'].' '.$d['mi'].' '.$d['lname'];
						$image = $d['image'];
						$number = $d['number'];
						$cid = $d['con_id'];
						 
					  ?>
					 <tr>
						<!-- con 1 -->
                          <td><?php echo $number;?></td>
						  <td><img src="upload_image/<?php echo	$image;?>" class="direct-chat-img" alt="<?php echo $name;?>"></td>
						  <td><?php echo $name;?></td>
						<!-- first loop for criteria 1 -->
						<?php
						 
							
							$sub_score = 0;
							
							//echo $seg;
							
							$score_this = _sqlRetrieve_param("score,rank,con_id","score","event_id",$_SESSION['eid'],"AND criteria_id = '$seg' AND con_id = '$cid' "); 

							
							foreach($score_this as $score):
							//$sub_score += $score['rank'];
							?>
							<!-- first loop for criteria 1 -->
						  <?php //echo number_format($score['score'],2);?>
						   <td class="rank_i"><?php 
								echo $score['rank'];?></td>
								 <td class="score_i"><?php 
								echo $score['score'];?></td>
						  <?php endforeach;?>
					    <!-- /.judge score for criteria 1 -->
						<!-- end of loop judge score for criteria 1 -->
						  
					   <!-- total score -->
						  <?php 
								//echo $d['score']/$no_j;?>
					   <!-- ranking -->
						
  
                      </tr>
					 <!-- /.end of loop contestant details -->
					   <?php 
					  $count++;
					  endforeach;?>
					  </tbody>
                    </table>
						<div class="box-footer pull-right">
						  <a href="print-tabulated-mrms-criteria.php?event_id=<?php echo $_SESSION['eid'];?>&seg_id=<?php echo $seg;?>&type=Mr" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i> Print</a>
						</div>
						
                </div><!-- /.table-responsive -->
				</div><!-- /.box-body -->
				 </div><!-- /.tab-pane -->
				 
				 
				 <!------ female contestant -->
				 
				<div class="tab-pane " id="tab_2_<?php echo $female;?>">
				   <div class="box-body">
				  <div class="table-responsive">
					                     <table id="event_table" class="table no-margin table-hover text-center">
                                            <thead>
                        <tr>
                          <th colspan="20" class="text-center">TABULATED RESULTS FOR <?php echo strtoupper($_SESSION['event']);?></th>
                        </tr>
					   <tr>
                          <th rowspan="2">#</th>
						  <th rowspan="2">Image</th>
						  <th rowspan="2">Candidate Name</th>
						  
						  <?php 
							
							$juddd = _sqlRetrieve_param("count(distinct judge_id) as count","score","event_id",$_SESSION['eid'],"order BY judge_id");
							$c_j = mysqli_fetch_assoc($juddd);
							$no_j = $c_j['count'];?>
						  <th colspan="<?php echo $no_j;?>">Judges</th>
						
  
                      </tr>
					  <tr>
					<?php 
					
						  	$juddd = _sqlRetrieve_param("distinct judge_id","score","event_id",$_SESSION['eid'],"order BY judge_id");
							$c_j = db_res_to_array($juddd);
							
							$r=db_res_to_array($res);
								foreach($c_j as $c ):
								$rank_tie = array();
								$num = 1;
									$rank = _sqlRetrieve_param("a.con_id as con_id,a.criteria_id as criteria_id,a.judge_id as judge_id","score as a,individual_contestant as b","a.event_id",$_SESSION['eid'],"AND judge_id = '".$c['judge_id']."' AND criteria_id = '".$seg."' AND b.con_id = a.con_id AND b.type = 'Ms' order BY score desc");
									$dbrank = db_res_to_array($rank);
									
									foreach($dbrank as $row){
										updateAll("score","rank = '".$num."'","WHERE judge_id='".$row['judge_id']."' AND con_id = '".$row['con_id']."' AND criteria_id = '".$row['criteria_id']."'");
										$num++;
									}
								?>
								
								<th><?php $ret = _sqlRetrieve_num("name","judge","judge_id",$c['judge_id']);

									 $judge = mysqli_fetch_assoc($ret);

									 echo $judge['name'];?></th>
								
								
						   <?php endforeach;?>
						
                      </tr>
                      </thead>
					  <!-- show event---->
					  <tbody id="tbody">
					  
					 <!-- loop contestant details -->
					<?php 
					   
					 $t =  _sqlRetrieve_param2("a.criteria_id as criteria_id,a.criteria_id as criteria_id,a.con_id as con_id,b.fname as fname,b.mi as mi,b.lname as lname,b.number as number,b.image_name as image","score as a,individual_contestant as b","a.event_id",$_SESSION['eid'],"AND a.criteria_id = '$seg' AND a.con_id = b.con_id AND b.type = 'Ms' GROUP BY a.con_id ORDER BY sum(a.score) DESC");
					   
					  $tie = array();
					  $count = 1;
					   foreach($t as $d):
					   $tot_score = 0;
					  
						$name = $d['fname'].' '.$d['mi'].' '.$d['lname'];
						$image = $d['image'];
						$number = $d['number'];
						$cid = $d['con_id'];
						 
					  ?>
					 <tr>
						<!-- con 1 -->
                          <td><?php echo $number;?></td>
						  <td><img src="upload_image/<?php echo	$image;?>" class="direct-chat-img" alt="<?php echo $name;?>"></td>
						  <td><?php echo $name;?></td>
						<!-- first loop for criteria 1 -->
						<?php
						 
							
							$sub_score = 0;
							
							//echo $seg;
							
							$score_this = _sqlRetrieve_param("score,rank,con_id","score","event_id",$_SESSION['eid'],"AND criteria_id = '$seg' AND con_id = '$cid' "); 

							
							foreach($score_this as $score):
							//$sub_score += $score['rank'];
							?>
							<!-- first loop for criteria 1 -->
						  <td class="rank_i"><?php echo $score['rank'];?></td>
						   <td class="score_i"><?php echo $score['score'];?></td>
						  <?php endforeach;?>
					    <!-- /.judge score for criteria 1 -->
						<!-- end of loop judge score for criteria 1 -->
						  
					   <!-- total score -->
						  <?php 
								//echo $d['score']/$no_j;?>
					   <!-- ranking -->
						 
  
                      </tr>
					 <!-- /.end of loop contestant details -->
					   <?php 
					  $count++;
					  endforeach;?>
					  </tbody>
                    </table>
						<div class="box-footer pull-right">
						  <a href="print-tabulated-mrms-criteria.php?event_id=<?php echo $_SESSION['eid'];?>&seg_id=<?php echo $seg;?>&type=Ms" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i> Print</a>

						 
						</div>
					
					
				</div><!-- /.table-responsive -->
				</div><!-- /.box-body -->
				 </div><!-- /.tab-pane -->
				</div><!-- /.tab-content -->
				</div><!--/.nav-custom -->
			  </div>
			</div>
			</div>
			</div>
			 <?php 
			  $num++;
			 endforeach;?>
                </div><!-- /.tab-pane -->
				
				<!----------------------- /
					By Contestants 
				/------------------------>
				 <div class="tab-pane" id="tab_2">
					<div class="nav-tabs-custom">
						<ul class="nav nav-tabs">
						<?php $male = md5('jfsdklafsdjkl'.'male');
							  $female = md5('jdslakfjsdkl'.'female');
						?>
						  <li class="active"><a href="#tab_1_<?php echo $male?>" data-toggle="tab">Male</a></li>
						  <li><a href="#tab_2_<?php echo $female;?>" data-toggle="tab">Female</a></li>
			  
						</ul>
					 <div class="tab-content">
					 
					  <!---------/. Male Results ---------------->
					<div class="tab-pane active" id="tab_1_<?php echo $male;?>">
				   <div class="box-body">
				  <div class="table-responsive">
					<table id="event_table" class="table no-margin table-hover text-center">
                       <thead>
                        <tr>
                          <th colspan="20" class="text-center">TABULATED RESULTS FOR <?php echo strtoupper($_SESSION['event']);?></th>
                        </tr>
					   <tr>
                          <th rowspan="2">#</th>
						  <th rowspan="2">Image</th>
						  <th rowspan="2">Candidate Name</th>
						  
						 <?php $res =  _sqlRetrieve_param("DISTINCT a.criteria_id as seg_id,b.percentage as percentage,b.name as name","score as a,criteria as b","a.event_id",$_SESSION['eid'],"AND b.criteria_id = a.criteria_id");
							
							$juddd = _sqlRetrieve_param("count(distinct judge_id) as count","score","event_id",$_SESSION['eid'],"order BY judge_id");
							$c_j = mysqli_fetch_assoc($juddd);
							$no_j = $c_j['count'];
						  
						  while($r=mysqli_fetch_array($res)):?>
						  <th colspan="<?php echo $no_j;?>"> <?php echo $r['name'];?></th>
						  <th rowspan="2"></th>
						  <?php endwhile;?>
						  <th rowspan="2"></th>
						  <th rowspan="2">Overall Rank</th>
  
                      </tr>
					  <tr>
					<?php $res = _sqlRetrieve_param("DISTINCT a.criteria_id as seg_id,b.percentage as percentage,b.name as name","score as a,criteria as b","a.event_id",$_SESSION['eid'],"AND b.criteria_id = a.criteria_id");
					
						  	$juddd = _sqlRetrieve_param("distinct judge_id","score","event_id",$_SESSION['eid'],"order BY judge_id");
							$c_j = db_res_to_array($juddd);
							
							$r=db_res_to_array($res);
							foreach($r as $res):
								foreach($c_j as $c ):
								$rank_tie = array();
								$num = 1;
									$rank = _sqlRetrieve_param("a.con_id as con_id,a.criteria_id as criteria_id,a.judge_id as judge_id","score as a,individual_contestant as b","a.event_id",$_SESSION['eid'],"AND judge_id = '".$c['judge_id']."' AND criteria_id = '".$res['seg_id']."' AND b.con_id = a.con_id AND b.type = 'Mr' order BY score desc");
									$dbrank = db_res_to_array($rank);
									
									foreach($dbrank as $row){
										updateAll("score","rank = '".$num."'","WHERE judge_id='".$row['judge_id']."' AND con_id = '".$row['con_id']."' AND criteria_id = '".$row['criteria_id']."'");
										$num++;
									}
								?>
								
								<th><?php $ret = _sqlRetrieve_num("name","judge","judge_id",$c['judge_id']);

									 $judge = mysqli_fetch_assoc($ret);

									 echo $judge['name'];?></th>
								
								
						   <?php endforeach; 
						         endforeach;?>
						
                      </tr>
                      </thead
					  <!-- show event---->
					  <tbody id="tbody">
					  
					 <!-- loop contestant details -->
					<?php 
					   $t = _sqlRetrieve_param2("sum(a.rank) as score,a.criteria_id as criteria_id,a.criteria_id as criteria_id,a.con_id as con_id,b.fname as fname,b.mi as mi,b.lname as lname,b.number as number,b.image_name as image","score as a,individual_contestant as b","a.event_id",$_SESSION['eid'],"AND a.con_id = b.con_id AND b.type = 'Mr' GROUP by a.con_id ORDER BY sum(a.score) DESC");
					
					  $tie = array();
					  $count = 1;
					   foreach($t as $d):
					   $tot_score = 0;
						$name = $d['fname'].' '.$d['mi'].' '.$d['lname'];
						$image = $d['image'];
						$cid = $d['con_id'];
						$number = $d['number'];
						 
					  ?>
					 <tr>
						<!-- con 1 -->
                          <td><?php echo $number;?></td>
						  <td><img src="upload_image/<?php echo	$image;?>" class="direct-chat-img" alt="<?php echo $name;?>"></td>
						  <td><?php echo $name;?></td>
						<!-- first loop for criteria 1 -->
						<?php
						 $res = _sqlRetrieve_param("DISTINCT a.criteria_id as seg_id,b.percentage as percentage,b.name as name","score as a,criteria as b","a.event_id",$_SESSION['eid'],"AND b.criteria_id = a.criteria_id");
						  	$r=db_res_to_array($res);
							
							foreach($r as $seg_id):
							$seg = $seg_id['seg_id'];
							$sub_score = 0;
							
							//echo $seg;
							
							$score_this =   _sqlRetrieve_param("rank,score,con_id","score","event_id",$_SESSION['eid'],"AND criteria_id = '$seg' AND con_id = '$cid'");

							$score_array = array();
							foreach($score_this as $score):
							$sub_score += $score['score'];
							$score_array[] = $score['score'];
							
							?>
							<!-- first loop for criteria 1 -->
						 
						  <td  class="score_i"><?php echo $score['score'];?></td>
						   <td class="rank_i"><?php echo $score['rank'];?></td>
						  <?php endforeach;
						  //print_r($score_array);
						  ?>
						  
					    <!-- /.judge score for criteria 1 -->
						<!-- sub total -->
						 
						  <td><?php 
									$sub_score_tot = $sub_score/$no_j;
									//echo $sub_score_tot;
									$tot_score += $sub_score_tot;
									
						  ?></td>
						 
						 <?php endforeach;?>
						<!-- end of loop judge score for criteria 1 -->
						  
					   <!-- total score -->
						  <td class="score_i"><?php 
									echo number_format($tot_score,2);?></td>
						  <td class="rank_i"></td>
					   <!-- ranking -->
						  <td><?php
						if(in_array($tot_score,$tie)): 
						$count -= 1 ;?>
							<small class="label pull-right bg-red">tie</small>
						<?php endif;
						$tie[] = $tot_score;
						 echo $count;?></td>
  
                      </tr>
					 <!-- /.end of loop contestant details -->
					   <?php 
					  $count++;
					  endforeach;?>
					  </tbody>
                    </table>
						<div class="box-footer pull-right">
						  <a href="print-tabulated-all-mrms-criteria.php?event_id=<?php echo $_SESSION['eid'];?>&type=Mr" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i> Print</a>

						  
						</div>
						
                </div><!-- /.table-responsive -->
				</div><!-- /.box-body -->
				 </div><!-- /.tab-pane -->
				 
				 
				 <!-------/.female contestant -------->
				 
				<div class="tab-pane " id="tab_2_<?php echo $female;?>">
				   <div class="box-body">
				  <div class="table-responsive">
					<table id="event_table" class="table no-margin table-hover text-center">
                   <thead>
                        <tr>
                          <th colspan="20" class="text-center">TABULATED RESULTS FOR <?php echo strtoupper($_SESSION['event']);?></th>
                        </tr>
					   <tr>
                          <th rowspan="2">#</th>
						  <th rowspan="2">Image</th>
						  <th rowspan="2">Candidate Name</th>
						  
						  <?php $res =  _sqlRetrieve_param("DISTINCT a.criteria_id as seg_id,b.percentage as percentage,b.name as name","score as a,criteria as b","a.event_id",$_SESSION['eid'],"AND b.criteria_id = a.criteria_id");
							
							$juddd = _sqlRetrieve_param("count(distinct judge_id) as count","score","event_id",$_SESSION['eid'],"order BY judge_id");
							$c_j = mysqli_fetch_assoc($juddd);
							$no_j = $c_j['count'];
						  
						  while($r=mysqli_fetch_array($res)):?>
						  <th colspan="<?php echo $no_j;?>"> <?php echo $r['name'];?></th>
						  <th rowspan="2"></th>
						  <?php endwhile;?>
						  <th rowspan="2"></th>
						  <th rowspan="2">Overall Rank</th>
  
                      </tr>
					  <tr>
					<?php $res = _sqlRetrieve_param("DISTINCT a.criteria_id as seg_id,b.percentage as percentage,b.name as name","score as a,criteria as b","a.event_id",$_SESSION['eid'],"AND b.criteria_id = a.criteria_id");
						  	$juddd = _sqlRetrieve_param("distinct judge_id","score","event_id",$_SESSION['eid'],"order BY judge_id");
							$c_j = db_res_to_array($juddd);
							
							$r=db_res_to_array($res);
							foreach($r as $res):
								foreach($c_j as $c ):
								$rank_tie = array();
								$num = 1;
									$rank = _sqlRetrieve_param("a.con_id as con_id,a.criteria_id as criteria_id,a.judge_id as judge_id","score as a,individual_contestant as b","a.event_id",$_SESSION['eid'],"AND judge_id = '".$c['judge_id']."' AND criteria_id = '".$res['seg_id']."' AND b.con_id = a.con_id AND b.type = 'Ms' order BY score desc");
									$dbrank = db_res_to_array($rank);
									
									foreach($dbrank as $row){
										updateAll("score","rank = '".$num."'","WHERE judge_id='".$row['judge_id']."' AND con_id = '".$row['con_id']."' AND criteria_id = '".$row['criteria_id']."'");
										$num++;
									}
								?>
								
								<th><?php $ret = _sqlRetrieve_num("name","judge","judge_id",$c['judge_id']);

									 $judge = mysqli_fetch_assoc($ret);

									 echo $judge['name'];?></th>
								
								
						   <?php endforeach; 
						         endforeach;?>
						
                      </tr>
                      </thead>
					  <!-- show event---->
					  <tbody id="tbody">
					  
					 <!-- loop contestant details -->
					<?php 
					  $t = _sqlRetrieve_param2("sum(a.rank) as score,a.criteria_id as criteria_id,a.criteria_id as criteria_id,a.con_id as con_id,b.fname as fname,b.mi as mi,b.lname as lname,b.number as number,b.image_name as image","score as a,individual_contestant as b","a.event_id",$_SESSION['eid'],"AND a.con_id = b.con_id AND b.type = 'Ms' GROUP by a.con_id ORDER BY sum(a.SCORE) DESC");
					
					  $tie = array();
					  $count = 1;
					   foreach($t as $d):
					   $tot_score = 0;
						$name = $d['fname'].' '.$d['mi'].' '.$d['lname'];
						$image = $d['image'];
						$cid = $d['con_id'];
						$number = $d['number'];
						 
					  ?>
					 <tr>
						<!-- con 1 -->
                          <td><?php echo $number;?></td>
						  <td><img src="upload_image/<?php echo	$image;?>" class="direct-chat-img" alt="<?php echo $name;?>"></td>
						  <td><?php echo $name;?></td>
						<!-- first loop for criteria 1 -->
						<?php
						 $res = _sqlRetrieve_param("DISTINCT a.criteria_id as seg_id,b.percentage as percentage,b.name as name","score as a,criteria as b","a.event_id",$_SESSION['eid'],"AND b.criteria_id = a.criteria_id");
						  	$r=db_res_to_array($res);
							
							foreach($r as $seg_id):
							$seg = $seg_id['seg_id'];
							$sub_score = 0;
							
							//echo $seg;
							
							$score_this =   _sqlRetrieve_param("rank,score,con_id","score","event_id",$_SESSION['eid'],"AND criteria_id = '$seg' AND con_id = '$cid'");

							$score_array = array();
							foreach($score_this as $score):
							$sub_score += $score['score'];
							$score_array[] = $score['score'];
							
							?>
							<!-- first loop for criteria 1 -->
						 
						  <td class="score_i"><?php echo $score['score'];?></td>
						  <td class="rank_i"><?php echo $score['rank'];?></td>
						  <?php endforeach;
						  //print_r($score_array);
						  ?>
						  
					    <!-- /.judge score for criteria 1 -->
						<!-- sub total -->
						 
						  <td><?php 
									$sub_score_tot = $sub_score/$no_j;
									//echo $sub_score_tot;
									$tot_score += $sub_score_tot;
									
						  ?></td>
						 
						 <?php endforeach;?>
						<!-- end of loop judge score for criteria 1 -->
						  
					   <!-- total score -->
						  <td class="score_i"><?php 
									echo number_format($tot_score,2);?></td>
									  <td class="rank_i">
									</td>
					   <!-- ranking -->
						  <td><?php
						if(in_array($tot_score,$tie)): 
						$count -= 1 ;?>
							<small class="label pull-right bg-red">tie</small>
						<?php endif;
						$tie[] = $tot_score;
						 echo $count;?></td>
  
                      </tr>
					 <!-- /.end of loop contestant details -->
					   <?php 
					  $count++;
					  endforeach;?>
					  </tbody>
                    </table>
						<div class="box-footer pull-right">
						  <a href="print-tabulated-all-mrms-criteria.php?event_id=<?php echo $_SESSION['eid'];?>&type=Ms" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i> Print</a>

						</div>
					
					
				</div><!-- /.table-responsive -->
				</div><!-- /.box-body -->
				 </div><!-- /.tab-pane -->
				</div><!-- /.tab-content -->
				</div><!--/.nav-custom -->
                  </div><!-- /.tab-pane -->

                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->
			<?php endif;?>

			

        </section><!-- /.content -->
		   
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
	 <?php include_once('views/tags/footer.php');?>

      <!-- Control Sidebar -->
	 
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->
	


  </body>
</html>
