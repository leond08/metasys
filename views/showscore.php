<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Meta | AdminPanel</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
	<!--- Select 2 ----->
	<link rel="stylesheet" href="plugins/select2/select2.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../dist/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="../dist/css/ionicons.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.css">
    <!-- AdminPanel Skins. 
    -->
	<link rel="stylesheet" href="../plugins/iCheck/all.css">
	<link rel="stylesheet" type="text/css" href="../assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" href="../dist/css/skins/skin-blue.min.css">
	<link rel="stylesheet" href="../dist/css/chatbox.css">

	<!--
	  *  My script
	 -->
	<!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4 -->
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
	<script src="../dist/js/chatbox_script.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js"></script>
	<script src="../plugins/select2/select2.full.min.js"></script>
	<script src=../"dist/js/jQuery.nicescroll.js"></script>
	<script src="../dist/js/validatecriteria.js"></script>
	 <script src="../plugins/iCheck/icheck.min.js"></script>
	
   
	
  </head>

  <body class="hold-transition skin-blue sidebar-mini fixed">
	<script>
		$(function() { 
			$('.content-wrapper').niceScroll({cursorwidth: '10px', autohidemode: false, zindex: 999, horizrailenabled: false });
		});
   </script>
 
   <div class="wrapper">

          <?php 
		session_start();

		include_once("../db_function/db_func.php");
			  include_once("../db_connections/connection_db.php");?>
   

      <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <section class="content-header">
        
        </section>

        <!-- Main content -->
        <section class="content">
			 <!-- <h1 style="margin-bottom:-200px;margin-top:100px;color:#fff;display:none;"class="text-center">Please wait for the announcement of winners</h1>
	  		<div id="showtime"></div> -->

		       <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                  <li class="active"><a href="#tab_1" data-toggle="tab">By Criteria</a></li>
                  <li><a href="#tab_2" data-toggle="tab">By Contestant</a></li>
                 <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                     <i class="fa fa-gear"></i>
                    </a>
                    <ul class="dropdown-menu">
                      <li class="rank" role="presentation"><a role="menuitem" tabindex="-1" href="#">shown by Rank</a></li>
                      <li class="score" role="presentation"><a role="menuitem" tabindex="-1" href="#">shown by Score</a></li>
                      <li class="judge" role="presentation"><a role="menuitem" tabindex="-1" href="#">shown to Judges</a></li>
                      <li role="presentation" class="divider"></li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>
                    </ul>
                  </li>
                </ul>
                <div class="tab-content">
				<!-----------------------------
						by criteria
				------------------------------>
				
                  <div class="tab-pane active" id="tab_1">	
				 <?php $res = _sqlRetrieve_param(" DISTINCT a.criteria_id as crit_id,b.percentage as percentage,b.name as name","score as a,criteria as b","a.event_id",$_SESSION['event_id'],"AND b.criteria_id = a.criteria_id");
				
				$num = 1;
				
				$r=db_res_to_array($res);

				$seg;
				foreach($r as $r):
				$seg = $r['crit_id'];
				?>
				<div class="box-body">
                  <div class="box-group" id="accordion">
				     <div class="panel box box-primary">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $num;?>">
                            <?php echo $r['name'];?>
                          </a>
                        </h4>
                      </div>
					<div id="collapse<?php echo $num;?>" class="panel-collapse collapse in">
                   <div class="box-body">
				  <div class="table-responsive">
				 
                    <table id="event_table" class="table no-margin table-hover text-center">
                      <thead>
                       
					   <tr>
                          <th rowspan="2">#</th>
						  <th rowspan="2">Image</th>
						  <th rowspan="2">Candidate Name</th>
						  
						  <?php 
							
							$juddd = _sqlRetrieve_param("count(distinct judge_id) as count","score","event_id",$_SESSION['event_id'],"order BY judge_id");
							$c_j = mysqli_fetch_assoc($juddd);
							$no_j = $c_j['count'];?>
						  <th colspan="<?php echo $no_j;?>">Judges</th>
						 
  
                      </tr>
					  <tr>
					<?php 

							$judgecount = 1;
						  	$juddd = _sqlRetrieve_param("distinct judge_id","score","event_id",$_SESSION['event_id'],"order BY judge_id");
							$c_j = db_res_to_array($juddd);
							
							$r=db_res_to_array($res);
								foreach($c_j as $c ):
								$rank_tie = array();
								$num = 1;
								 if($_SESSION['cat'] == 'Group' || $_SESSION['cat'] == 'group'){
									$rank = _sqlRetrieve_param("a.group_id as con_id,a.criteria_id as criteria_id,a.judge_id as judge_id","score as a,group_contestant as b","a.event_id",$_SESSION['event_id'],"AND judge_id = '".$c['judge_id']."' AND criteria_id = '".$seg."' AND b.group_id = a.group_id ORDER BY score DESC ");
									}else{
										$rank = _sqlRetrieve_param("score,a.con_id as con_id,a.criteria_id as criteria_id,a.judge_id as judge_id","score as a,individual_contestant as b","a.event_id",$_SESSION['event_id'],"AND judge_id = '".$c['judge_id']."' AND criteria_id = '".$seg."' AND b.con_id = a.con_id ORDER BY score DESC ");
									}
									$dbrank = db_res_to_array($rank);
									
									 if($_SESSION['cat'] == 'Group' || $_SESSION['cat'] == 'group'){
									foreach($dbrank as $row){
										updateAll("score","rank = '".$num."'","WHERE judge_id='".$row['judge_id']."' AND group_id = '".$row['con_id']."' AND criteria_id = '".$row['criteria_id']."'");
										$num++;
									}
									}
									else {
									foreach($dbrank as $row){
										updateAll("score","rank = '".$num."'","WHERE judge_id='".$row['judge_id']."' AND con_id = '".$row['con_id']."' AND criteria_id = '".$row['criteria_id']."'");
										$num++;
									}
									}
								?>
								
								<th><?php $ret = _sqlRetrieve_num("name","judge","judge_id",$c['judge_id']);

									 $judge = mysqli_fetch_assoc($ret);

									 echo $judge['name'];
									
									$judgecount++;
								?></th>
								
								
						   <?php endforeach;?>
						
                      </tr>
                      </thead
					  <!-- show event---->
					  <tbody id="tbody">
					  
					 <!-- loop contestant details -->
					<?php 
					   if($_SESSION['cat'] == 'Group' || $_SESSION['cat'] == 'group'){
					 $t = _sqlRetrieve_param("group_id","score","event_id",$_SESSION['event_id'],"AND criteria_id = '$seg' GROUP BY group_id ");
					 }else{
						$t =  _sqlRetrieve_param("con_id","score","event_id",$_SESSION['event_id'],"AND criteria_id = '$seg' GROUP BY con_id ");
					 }
					  $tie = array();
					  $count = 1;
					  $t = db_res_to_array($t);
					   foreach($t as $d):
					   $tot_score = 0;
					 
					  
					   if($_SESSION['cat'] == 'Group' || $_SESSION['cat'] == 'group'){
					   $c = _sqlQuerySelectLast("group_contestant","group_id",$d['group_id']);
					      $name = $c['group_name'];
						  $image = $c['group_image'];
						  $number = $c['number'];
						  $cid = $d['group_id'];
						}
						else{
						$c = _sqlQuerySelectLast("individual_contestant","con_id",$d['con_id']);
					      $name = $c['fname'].' '.$c['mi'].' '.$c['lname'];
						  $image = $c['image_name'];
						  $number = $c['number'];
						  $cid = $d['con_id'];
						
						}
						 
					  ?>
					 <tr>
						<!-- con 1 -->
                          <td><?php echo $number;?></td>
						  <td><img src="../upload_image/<?php echo	$image;?>" class="direct-chat-img" alt="<?php echo $name;?>"></td>
						  <td><?php echo $name;?></td>
						<!-- first loop for criteria 1 -->
						<?php
						 
							
							$sub_score = 0;
							
							//echo $seg;
							
							 if($_SESSION['cat'] == 'Group' || $_SESSION['cat'] == 'group'){
								$score_this =  _sqlRetrieve_param("score,rank,group_id","score","event_id",$_SESSION['event_id'],"AND criteria_id = '$seg' AND group_id = '$cid' "); 
							}else{
									$score_this =  _sqlRetrieve_param("score,rank,con_id","score","event_id",$_SESSION['event_id'],"AND criteria_id = '$seg' AND con_id = '$cid' "); 
									
							}

							
							foreach($score_this as $score):
							$sub_score += $score['rank'];
							?>
							<!-- first loop for criteria 1 -->
						  <td class="rank_i"><?php echo $score['rank'];?></td>
						  <td class="score_i"><?php echo $score['score'];?></td>
						  <?php endforeach;?>
					    <!-- /.judge score for criteria 1 -->
						<!-- end of loop judge score for criteria 1 -->
						  
					   <!-- total score -->
						
                      </tr>
					 <!-- /.end of loop contestant details -->
					   <?php 
					  $count++;
					  endforeach;?>
					  </tbody>
                    </table>
						
                </div><!-- /.box-body -->
				</div>
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
				  <div class="table-responsive">
                   <table id="event_table" class="table no-margin table-hover text-center">
                      <thead>
                       
					   <tr>
                          <th rowspan="2">#</th>
						  <th rowspan="2">Image</th>
						  <th rowspan="2">Candidate Name</th>
						  
						  <?php $res = _sqlRetrieve_param(" DISTINCT a.criteria_id as crit_id,b.percentage as percentage,b.name as name","score as a,criteria as b","a.event_id",$_SESSION['event_id'],"AND b.criteria_id = a.criteria_id");
							
							$juddd = _sqlRetrieve_param("count(distinct judge_id) as count","score","event_id",$_SESSION['event_id'],"order BY judge_id");
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
					<?php $res = _sqlRetrieve_param("DISTINCT a.criteria_id as crit_id,b.percentage as percentage,b.name as name","score as a,criteria as b","a.event_id",$_SESSION['event_id'],"AND b.criteria_id = a.criteria_id");
						  	$juddd = _sqlRetrieve_param("distinct judge_id","score","event_id",$_SESSION['event_id'],"order BY judge_id");
							$c_j = db_res_to_array($juddd);
							
							$r=db_res_to_array($res);
							foreach($r as $res):
								foreach($c_j as $c ):
								$rank_tie = array();
								$num = 1;
								 if($_SESSION['cat'] == 'Group' || $_SESSION['cat'] == 'group'){
									$rank = _sqlRetrieve_param("a.group_id as con_id,a.criteria_id as criteria_id,a.judge_id as judge_id","score as a,group_contestant as b","a.event_id",$_SESSION['event_id'],"AND judge_id = '".$c['judge_id']."' AND criteria_id = '".$seg."' AND b.group_id = a.group_id ORDER BY score DESC ");
									}else{
										$rank = _sqlRetrieve_param("score,a.con_id as con_id,a.criteria_id as criteria_id,a.judge_id as judge_id","score as a,individual_contestant as b","a.event_id",$_SESSION['event_id'],"AND judge_id = '".$c['judge_id']."' AND criteria_id = '".$seg."' AND b.con_id = a.con_id ORDER BY score DESC ");
									}
									$dbrank = db_res_to_array($rank);
									
									 if($_SESSION['cat'] == 'Group' || $_SESSION['cat'] == 'group'){
									foreach($dbrank as $row){
										updateAll("score","rank = '".$num."'","WHERE judge_id='".$row['judge_id']."' AND group_id = '".$row['con_id']."' AND criteria_id = '".$row['criteria_id']."'");
										$num++;
									}
									}
									else {
									foreach($dbrank as $row){
										updateAll("score","rank = '".$num."'","WHERE judge_id='".$row['judge_id']."' AND con_id = '".$row['con_id']."' AND criteria_id = '".$row['criteria_id']."'");
										$num++;
									}
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
					   if($_SESSION['cat'] == 'Group' || $_SESSION['cat'] == 'group'){
					 $t =  _sqlRetrieve_param("sum(rank),group_id","score","event_id",$_SESSION['event_id'],"GROUP BY group_id order by sum(rank) ");
					 }else{
						$t = _sqlRetrieve_param("sum(rank),con_id","score","event_id",$_SESSION['event_id'],"GROUP BY con_id order by sum(rank) ");
					 }
					  $tie = array();
					  $count = 1;
					   foreach($t as $d):
					   $tot_score = 0;
					 
					  
					   if($_SESSION['cat'] == 'Group' || $_SESSION['cat'] == 'group'){
					   $c = _sqlQuerySelectLast("group_contestant","group_id",$d['group_id']);
					      $name = $c['group_name'];
						  $image = $c['group_image'];
						  $number = $c['number'];
						  $cid = $d['group_id'];
						}
						else{
						$c = _sqlQuerySelectLast("individual_contestant","con_id",$d['con_id']);
					      $name = $c['fname'].' '.$c['mi'].' '.$c['lname'];
						  $image = $c['image_name'];
						  $number = $c['number'];
						  $cid = $d['con_id'];
						
						}
						 
					  ?>
					 <tr>
						<!-- con 1 -->
                          <td><?php echo $number;?></td>
						  <td><img src="../upload_image/<?php echo	$image;?>" class="direct-chat-img" alt="<?php echo $name;?>"></td>
						  <td><?php echo $name;?></td>
						<!-- first loop for criteria 1 -->
						<?php
						 $res = _sqlRetrieve_param("DISTINCT a.criteria_id as seg_id,b.percentage as percentage,b.name as name","score as a,criteria as b","a.event_id",$_SESSION['event_id'],"AND b.criteria_id = a.criteria_id");
						  	$r=db_res_to_array($res);
							
							foreach($r as $seg_id):
							$seg = $seg_id['seg_id'];
							$sub_score = 0;
							
							//echo $seg;
							
							 if($_SESSION['cat'] == 'Group' || $_SESSION['cat'] == 'group'){
								$score_this =  _sqlRetrieve_param("score,rank,group_id","score","event_id",$_SESSION['event_id'],"AND criteria_id = '$seg' AND group_id = '$cid' "); 
							}else{
									$score_this =  _sqlRetrieve_param("score,rank,con_id","score","event_id",$_SESSION['event_id'],"AND criteria_id = '$seg' AND con_id = '$cid' "); 
									
							}

							
							foreach($score_this as $score):
							$sub_score += $score['score'];
							?>
							<!-- first loop for criteria 1 -->
						  <td class="score_i"><?php echo $score['score'];?></td>
						  <td class="rank_i"><?php echo $score['rank'];?></td>
						  <?php endforeach;?>
						    
						
					    <!-- /.judge score for criteria 1 -->
						<!-- sub total -->
						 
						  <td><?php 
									$sub_score_tot = $sub_score/$no_j;
									//echo $sub_score_tot;
									$tot_score += $sub_score_tot;
									
						  ?>
						  </td>
						 <?php endforeach;?>
						<!-- end of loop judge score for criteria 1 -->
						  
					   <!-- total score -->
						  <td class="score_i"><?php 
									echo $tot_score;?></td>
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
						
						  
						</div>
                </div><!-- /.box-body -->
                  </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->
		

        </section><!-- /.content -->
		   
      </div><!-- /.content-wrapper -->


    </div><!-- ./wrapper -->
	


  </body>
</html>
