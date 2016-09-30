<div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                  <li class="active"><a href="#tab_1" data-toggle="tab">By criteria</a></li>
                  <li><a href="#tab_2" data-toggle="tab">By Contestant</a></li>
                        
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
					   
					 $t =  _sqlRetrieve_param2("a.criteria_id as criteria_id,a.con_id as con_id,b.fname as fname,b.mi as mi,b.lname as lname,b.number as number,b.image_name as image","score as a,individual_contestant as b","a.event_id",$_SESSION['eid'],"AND a.criteria_id = '$seg' AND a.con_id = b.con_id AND b.type = 'Mr' GROUP BY a.con_id ");
					   
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
						  <td><img src="../upload_image/<?php echo	$image;?>" class="direct-chat-img" alt="<?php echo $name;?>"></td>
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
						
						
                </div><!-- /.table-responsive -->
				</div><!-- /.box-body -->
				 </div><!-- /.tab-pane -->
				 
				 
				 <!-------/.female contestant --------------->
				 
				<div class="tab-pane " id="tab_2_<?php echo $female;?>">
				   <div class="box-body">
				  <div class="table-responsive">
					                     <table id="event_table" class="table no-margin table-hover text-center">
                                            <thead>
                   
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
                      </thead
					  <!-- show event---->
					  <tbody id="tbody">
					  
					 <!-- loop contestant details -->
					<?php 
					   
					 $t =  _sqlRetrieve_param2("a.criteria_id as criteria_id,a.criteria_id as criteria_id,a.con_id as con_id,b.fname as fname,b.mi as mi,b.lname as lname,b.number as number,b.image_name as image","score as a,individual_contestant as b","a.event_id",$_SESSION['eid'],"AND a.criteria_id = '$seg' AND a.con_id = b.con_id AND b.type = 'Ms' GROUP BY a.con_id");
					   
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
						  <td><img src="../upload_image/<?php echo	$image;?>" class="direct-chat-img" alt="<?php echo $name;?>"></td>
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
					   $t = _sqlRetrieve_param2("sum(a.rank) as score,a.criteria_id as criteria_id,a.criteria_id as criteria_id,a.con_id as con_id,b.fname as fname,b.mi as mi,b.lname as lname,b.number as number,b.image_name as image","score as a,individual_contestant as b","a.event_id",$_SESSION['eid'],"AND a.con_id = b.con_id AND b.type = 'Mr' GROUP by a.con_id ORDER BY sum(a.rank)");
					
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
						  <td><img src="../upload_image/<?php echo	$image;?>" class="direct-chat-img" alt="<?php echo $name;?>"></td>
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
									echo $tot_score;?></td>
					
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
					
                </div><!-- /.table-responsive -->
				</div><!-- /.box-body -->
				 </div><!-- /.tab-pane -->
				 
				 
				 <!-------/.female contestant --------------->
				 
				<div class="tab-pane " id="tab_2_<?php echo $female;?>">
				   <div class="box-body">
				  <div class="table-responsive">
					<table id="event_table" class="table no-margin table-hover text-center">
                   <thead>
                       
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
                      </thead
					  <!-- show event---->
					  <tbody id="tbody">
					  
					 <!-- loop contestant details -->
					<?php 
					  $t = _sqlRetrieve_param2("sum(a.rank) as score,a.criteria_id as criteria_id,a.criteria_id as criteria_id,a.con_id as con_id,b.fname as fname,b.mi as mi,b.lname as lname,b.number as number,b.image_name as image","score as a,individual_contestant as b","a.event_id",$_SESSION['eid'],"AND a.con_id = b.con_id AND b.type = 'Ms' GROUP by a.con_id ORDER BY sum(a.rank)");
					
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
						  <td><img src="../upload_image/<?php echo	$image;?>" class="direct-chat-img" alt="<?php echo $name;?>"></td>
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
									echo $tot_score;?></td>
								
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
						
					
					
				</div><!-- /.table-responsive -->
				</div><!-- /.box-body -->
				 </div><!-- /.tab-pane -->
				</div><!-- /.tab-content -->
				</div><!--/.nav-custom -->
                  </div><!-- /.tab-pane -->

                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->