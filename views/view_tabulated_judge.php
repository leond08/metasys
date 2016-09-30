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
	<script src="dist/js/validatesegment.js"></script>
	 <script src="plugins/iCheck/icheck.min.js"></script>
	
   
	
  </head>

  <body class="hold-transition skin-blue sidebar-mini fixed">
	<script>
		$(function() { 
			$('.content-wrapper').niceScroll({cursorwidth: '10px', autohidemode: false, zindex: 999, horizrailenabled: false });
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
                <li><a href="#"><i class="fa fa-edit"></i>Segment<small class="label pull-right bg-green"></small></a>
				<ul class="treeview-menu">
				 <li onclick="run(event,this)" id="view_segment"><a href="#"><i class="fa fa-edit"></i>View Segment</a></li>
                <li onclick="run(event,this)" id="add_segment"><a href="#"><i class="fa fa-edit"></i>Add Segment</a></li>
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
			 <li>
             <a href="controller.php?action=view_calendar">
                <i class="fa fa-calendar"></i> <span>Calendar</span>
                <small class="label pull-right bg-red">3</small>
              </a>
            </li>
			<?php	$result = _sqlSelect_eventID($_SESSION['event'],$_SESSION['date']);
					$cat = $result['category_select'];
					if($cat == 'MrMs' || $cat == 'mrms'): ?>
			<li><a href="#"><i class="fa fa-edit"></i> Results <small class="label pull-right bg-green"></small></a>
				<ul class="treeview-menu">
				 <li onclick="run(event,this)" id="view_mrms"><a href="#"><i class="fa fa-edit"></i>View Results</a></li>
                
				</ul>
				</li>
				<?php else:?>
				<li ><a href="#"><i class="fa fa-edit"></i> Results <small class="label pull-right bg-green"></small></a>
				<ul class="treeview-menu">
				 <li onclick="run(event,this)" id="view_tabulated"><a href="#"><i class="fa fa-edit"></i>View Results</a></li>
                
				</ul>
				</li>
				<?php endif;?>
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
                  <li class="active"><a href="#tab_1" data-toggle="tab">By Segment</a></li>
                  <li><a href="#tab_2" data-toggle="tab">By Contestant</a></li>
                  <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                </ul>
                <div class="tab-content">
				<!-----------------------------
						by segment
				------------------------------>
				
                  <div class="tab-pane active" id="tab_1">	
				 <?php $res = _sqlRetrieve_param(" DISTINCT a.segment_id as seg_id,b.percentage as percentage,b.name as name","score as a,segment as b","a.event_id",$_SESSION['eid'],"AND b.segment_id = a.segment_id");
				
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
						  <th rowspan="2">Candidate Name</th>
						  <th rowspan="2">Rank</th>
  
                      </tr>
					
                      </thead
					  <!-- show event---->
					  <tbody id="tbody">
					  
					 <!-- loop contestant details -->
					<?php 
					   if($cat == 'Group' || $cat == 'group'){
					 $t = _sqlRetrieve_param("sum(score),group_id","score","event_id",$_SESSION['eid'],"AND segment_id = '$seg' GROUP BY group_id order by sum(score) desc ");
					 }else{
						$t =  _sqlRetrieve_param("sum(score),con_id","score","event_id",$_SESSION['eid'],"AND segment_id = '$seg' GROUP BY con_id order by sum(score) desc ");
					 }
					  $tie = array();
					  $count = 1;
					  $t = db_res_to_array($t);
					   foreach($t as $d):
					   $tot_score = 0;
					 
					  
					   if($cat == 'Group' || $cat == 'group'){
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
						
						  <td><?php echo $name;?></td>
						<!-- first loop for segment 1 -->
						 
					
					    <!-- /.judge score for segment 1 -->
						<!-- end of loop judge score for segment 1 -->
						  
					   <!-- total score -->
					   <!-- ranking -->
						  <td><?php
						if(in_array($d['sum(score)'],$tie)): 
						$count -= 1 ;?>
							<small class="label pull-right bg-red">tie</small>
						<?php endif;
						$tie[] = $d['sum(score)'];
						 echo $count;?></td>
  
                      </tr>
					 <!-- /.end of loop contestant details -->
					   <?php 
					  $count++;
					  endforeach;?>
					  </tbody>
                    </table>
						<div class="box-footer pull-right">
						  <a href="print-tabulated-all-segment.php?event_id=<?php echo $_SESSION['eid'];?>&seg_id=<?php echo $seg;?>&type=<?php echo $cat;?>" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>

						  <a href="javascript:void()" class="btn btn-primary"><i class="fa fa-download"></i> Generate PDF</a>
						</div>
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
						  <th rowspan="2">Candidate Name</th>
						  <th rowspan="2">Rank</th>
  
                      </tr>
					
				
                      </thead
					  <!-- show event---->
					  <tbody id="tbody">
					  
					 <!-- loop contestant details -->
					<?php 
					   if($cat == 'Group' || $cat == 'group'){
					 $t =  _sqlRetrieve_param("sum(score),group_id","score","event_id",$_SESSION['eid'],"GROUP BY group_id order by sum(score) desc");
					 }else{
						$t = _sqlRetrieve_param("sum(score),con_id","score","event_id",$_SESSION['eid'],"GROUP BY con_id order by sum(score) desc");
					 }
					  $tie = array();
					  $count = 1;
					   foreach($t as $d):
					   $tot_score = 0;
					 
					  
					   if($cat == 'Group' || $cat == 'group'){
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
						  <td><?php echo $name;?></td>

						<!-- end of loop judge score for segment 1 -->
						  
					   <!-- total score -->
						 
					   <!-- ranking -->
						  <td><?php
						if(in_array($d['sum(score)'],$tie)): 
						$count -= 1 ;?>
							<small class="label pull-right bg-red">tie</small>
						<?php endif;
						$tie[] = $d['sum(score)'];
						 echo $count;?></td>
  
                      </tr>
					 <!-- /.end of loop contestant details -->
					   <?php 
					  $count++;
					  endforeach;?>
					  </tbody>
                    </table>
						<div class="box-footer pull-right">
						  <a href="print-tabulated-all-cont.php?event_id=<?php echo $_SESSION['eid'];?>&type=<?php echo $cat;?>" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>

						  <a href="javascript:void()" class="btn btn-primary"><i class="fa fa-download"></i> Generate PDF</a>
						</div>
                </div><!-- /.box-body -->
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
