			  <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                  <li class="active"><a href="#tab_1" data-toggle="tab">By Segment</a></li>
                  <li><a href="#tab_2" data-toggle="tab">By Contestant</a></li>
                       
                </ul>
                <div class="tab-content">
				<!-----------------------------
						by segment
				------------------------------>
				
                  <div class="tab-pane active" id="tab_1">	
				 <?php $res = _sqlRetrieve_param(" DISTINCT a.segment_id as seg_id,b.percentage as percentage,b.name as name","score as a,segment as b","a.event_id",$_SESSION['event_id'],"AND b.segment_id = a.segment_id");
				
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
                        </h4>
                      </div>
					<div id="collapse<?php echo $num;?>" class="panel-collapse collapse in">
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
							
							$juddd = _sqlRetrieve_param("count(distinct judge_id) as count","score","event_id",$_SESSION['event_id'],"order BY judge_id");
							$c_j = mysqli_fetch_assoc($juddd);
							$no_j = $c_j['count'];?>
						  <th colspan="<?php echo $no_j;?>">Judges</th>
						 
  
                      </tr>
					  <tr>
					<?php 
					
						  	$juddd = _sqlRetrieve_param("distinct judge_id","score","event_id",$_SESSION['event_id'],"order BY judge_id");
							$c_j = db_res_to_array($juddd);
							
							$r=db_res_to_array($res);
							
								foreach($c_j as $c ):
								$rank_tie = array();
								$num = 1;
								 if($_SESSION['cat'] == 'Group' || $_SESSION['cat'] == 'group'){
									$rank = _sqlRetrieve_param("a.group_id as con_id,a.segment_id as segment_id,a.judge_id as judge_id","score as a,group_contestant as b","a.event_id",$_SESSION['event_id'],"AND judge_id = '".$c['judge_id']."' AND segment_id = '".$seg."' AND b.group_id = a.group_id ORDER BY score DESC ");
									}else{
										$rank = _sqlRetrieve_param("score,a.con_id as con_id,a.segment_id as segment_id,a.judge_id as judge_id","score as a,individual_contestant as b","a.event_id",$_SESSION['event_id'],"AND judge_id = '".$c['judge_id']."' AND segment_id = '".$seg."' AND b.con_id = a.con_id ORDER BY score DESC ");
									}
									$dbrank = db_res_to_array($rank);
									
									if($_SESSION['cat'] == 'Group' || $_SESSION['cat'] == 'group'){
									foreach($dbrank as $row){
										updateAll("score","rank = '".$num."'","WHERE judge_id='".$row['judge_id']."' AND group_id = '".$row['con_id']."' AND segment_id = '".$row['segment_id']."'");
										$num++;
									}
									}else {
									foreach($dbrank as $row){
										updateAll("score","rank = '".$num."'","WHERE judge_id='".$row['judge_id']."' AND con_id = '".$row['con_id']."' AND segment_id = '".$row['segment_id']."'");
										$num++;
									}
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
					   if($_SESSION['cat'] == 'Group' || $_SESSION['cat'] == 'group'){
					 $t = _sqlRetrieve_param("group_id","score","event_id",$_SESSION['event_id'],"AND segment_id = '$seg' GROUP BY group_id");
					 }else{
						$t =  _sqlRetrieve_param("con_id","score","event_id",$_SESSION['event_id'],"AND segment_id = '$seg' GROUP BY con_id");
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
						<!-- first loop for segment 1 -->
						<?php
						 
							
							$sub_score = 0;
							
							//echo $seg;
							
							 if($_SESSION['cat'] == 'Group' || $_SESSION['cat'] == 'group'){
								$score_this =  _sqlRetrieve_param("score,rank,group_id","score","event_id",$_SESSION['event_id'],"AND segment_id = '$seg' AND group_id = '$cid' "); 
							}else{
									$score_this =  _sqlRetrieve_param("score,rank,con_id","score","event_id",$_SESSION['event_id'],"AND segment_id = '$seg' AND con_id = '$cid' "); 
									
							}

							
							foreach($score_this as $score):
							//$sub_score += $score['score'];
							?>
							<!-- first loop for segment 1 -->
						 
						   <td class="score_i"><?php echo $score['score'];?></td>
						  <?php endforeach;?>
					    <!-- /.judge score for segment 1 -->
						<!-- end of loop judge score for segment 1 -->
						  
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
                          <th colspan="20" class="text-center">TABULATED RESULTS FOR <?php echo strtoupper($_SESSION['event']);?></th>
                        </tr>
					   <tr>
                          <th rowspan="2">#</th>
						  <th rowspan="2">Image</th>
						  <th rowspan="2">Candidate Name</th>
						  
						  <?php $res = _sqlRetrieve_param(" DISTINCT a.segment_id as seg_id,b.percentage as percentage,b.name as name","score as a,segment as b","a.event_id",$_SESSION['event_id'],"AND b.segment_id = a.segment_id");
							
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
					<?php $res = _sqlRetrieve_param("DISTINCT a.segment_id as seg_id,b.percentage as percentage,b.name as name","score as a,segment as b","a.event_id",$_SESSION['event_id'],"AND b.segment_id = a.segment_id");
						  	$juddd = _sqlRetrieve_param("distinct judge_id","score","event_id",$_SESSION['event_id'],"order BY judge_id");
							$c_j = db_res_to_array($juddd);
							
							$r=db_res_to_array($res);
							foreach($r as $res):
								foreach($c_j as $c ):
								$rank_tie = array();
								$num = 1;
								 if($_SESSION['cat'] == 'Group' || $_SESSION['cat'] == 'group'){
									$rank = _sqlRetrieve_param("a.group_id as con_id,a.segment_id as segment_id,a.judge_id as judge_id","score as a,group_contestant as b","a.event_id",$_SESSION['event_id'],"AND judge_id = '".$c['judge_id']."' AND segment_id = '".$seg."' AND b.group_id = a.group_id ORDER BY score DESC ");
									}else{
										$rank = _sqlRetrieve_param("score,a.con_id as con_id,a.segment_id as segment_id,a.judge_id as judge_id","score as a,individual_contestant as b","a.event_id",$_SESSION['event_id'],"AND judge_id = '".$c['judge_id']."' AND segment_id = '".$seg."' AND b.con_id = a.con_id ORDER BY score DESC ");
									}
									$dbrank = db_res_to_array($rank);
									
									if($_SESSION['cat'] == 'Group' || $_SESSION['cat'] == 'group'){
									foreach($dbrank as $row){
										updateAll("score","rank = '".$num."'","WHERE judge_id='".$row['judge_id']."' AND group_id = '".$row['con_id']."' AND segment_id = '".$row['segment_id']."'");
										$num++;
									}
									}else {
									foreach($dbrank as $row){
										updateAll("score","rank = '".$num."'","WHERE judge_id='".$row['judge_id']."' AND con_id = '".$row['con_id']."' AND segment_id = '".$row['segment_id']."'");
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
					 $t =  _sqlRetrieve_param("sum(rank),group_id","score","event_id",$_SESSION['event_id'],"GROUP BY group_id order by sum(rank)");
					 }else{
						$t = _sqlRetrieve_param("sum(rank),con_id","score","event_id",$_SESSION['event_id'],"GROUP BY con_id order by sum(rank)");
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
						<!-- first loop for segment 1 -->
						<?php
						 $res = _sqlRetrieve_param("DISTINCT a.segment_id as seg_id,b.percentage as percentage,b.name as name","score as a,segment as b","a.event_id",$_SESSION['event_id'],"AND b.segment_id = a.segment_id");
						  	$r=db_res_to_array($res);
							
							foreach($r as $seg_id):
							$seg = $seg_id['seg_id'];
							$sub_score = 0;
							
							//echo $seg;
							
							 if($_SESSION['cat'] == 'Group' || $_SESSION['cat'] == 'group'){
								$score_this =  _sqlRetrieve_param("score,rank,group_id","score","event_id",$_SESSION['event_id'],"AND segment_id = '$seg' AND group_id = '$cid' "); 
							}else{
									$score_this =  _sqlRetrieve_param("score,rank,con_id","score","event_id",$_SESSION['event_id'],"AND segment_id = '$seg' AND con_id = '$cid' "); 
									
							}

							
							foreach($score_this as $score):
							$sub_score += $score['score'];
							?>
							<!-- first loop for segment 1 -->
						  <td class="score_i"><?php echo $score['score'];?></td>
						 
						  <?php endforeach;?>
					    <!-- /.judge score for segment 1 -->
						<!-- sub total -->
						 
						  <td><?php 
									$sub_score_tot = $sub_score/$no_j;
									//echo $sub_score_tot;
									$tot_score += $sub_score_tot;
									
						  ?>
						  </td>
						 <?php endforeach;?>
						<!-- end of loop judge score for segment 1 -->
						  
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
					
                </div><!-- /.box-body -->
                  </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->
