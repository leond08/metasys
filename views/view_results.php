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
				 <li onclick="run(event,this)" id="view_results"><a href="#"><i class="fa fa-edit"></i>View Results</a></li>
                
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
					  			<h1><i class="ion ion-person-add"></i></h1></span>
					  			<h3>Oops! Nothing to view.. Please wait for the results</h3>
                  			</div>
							
					  			<p>Please wait for the results....</p>
                  		</div>
                  
			<?php else:?>
		       <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                  <li class="active"><a href="#tab_1" data-toggle="tab">By Judge</a></li>
                  <li><a href="#tab_2" data-toggle="tab">By Contestant</a></li>
                  <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                </ul>
                <div class="tab-content">
				<!-----------------------------
						by judge
				------------------------------>
				
                  <div class="tab-pane active" id="tab_1">
				   <?php $res = _sqlRetrieve_num("count(score_id)","score","event_id",$_SESSION['eid']);
				       $re = mysqli_fetch_assoc($res);

					if($re['count(score_id)'] > 0):
					 $num = 1;
						$r = _sqlRetrieveBygroup("sum(score) as score,con_id,judge_id","score","event_id",$_SESSION['eid'],"judge_id","ASC");
					foreach($r as $u):
						
					    $j = _sqlQuerySelectLast("judge","judge_id",$u['judge_id']);
						  $judge = $j['name'];
					  ?>	
				<div class="box-body">
                  <div class="box-group" id="accordion">
				     <div class="panel box box-primary">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $num;?>">
                            <?php echo $judge;?>
                          </a>
                        </h4>
                      </div>
					<div id="collapse<?php echo $num;?>" class="panel-collapse collapse in">
                   <div class="box-body">
				  <div class="table-responsive">
                    <table id="event_table" class="table no-margin table-hover">
                      <thead>
                        <tr>
                          <th>Rank</th>
                          <th>Image</th>
                          <th>Name</th>
						  <th>Score</th>
                        </tr>
                      </thead
					  <!-- show event---->
					  <tbody id="tbody">
					 <?php 
					 	$v = 'sum(score)';
					 if($cat == 'Group' || $cat == 'group'){
					 $t = _sqlRetrieveBygroup("sum(score),group_id","score","judge_id",$u['judge_id'],"group_id","DESC");
					 }else{
					 $t = _sqlRetrieveBygroup("sum(score),con_id","score","judge_id",$u['judge_id'],"con_id","DESC");
					 }
					  $tie = array();
					  $count = 1;
					   foreach($t as $d):
					   if($cat == 'Group' || $cat == 'group'){
					   $c = _sqlQuerySelectLast("group_contestant","group_id",$d['group_id']);
					      $name = $c['group_name'];
						  $image = $c['group_image'];
						}
						else{
						$c = _sqlQuerySelectLast("individual_contestant","con_id",$d['con_id']);
					      $name = $c['fname'].' '.$c['mi'].' '.$c['lname'];
						  $image = $c['image_name'];
						}
						 
					  ?>
					  <tr>
						<td><?php
						if(in_array($d['sum(score)'],$tie)): 
						$count -= 1 ;?>
							<small class="label pull-right bg-red">tie</small>
						<?php endif;
						$tie[] = $d['sum(score)'];
						 echo $count;?></td>
						<td><img src="upload_image/<?php echo	$image;?>" class="direct-chat-img" alt="<?php echo $name;?>"></td>
						<td><?php echo $name;?></td>
						<td><?php echo $d['sum(score)'];?></td>
						
					  </tr>
					  <?php 
					  $count++;
					  endforeach;?>
					  </tbody>
                    </table>
						<div class="box-footer pull-right">
						  <a href="print-results-judge.php?event_id=<?php echo $_SESSION['eid'];?>&judge_id=<?php echo $u['judge_id'];?>&cat=<?php echo $cat;?>" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>

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
				<?php else:?>
					<h5 class="text-center">Please wait for the results&hellip;</h5>
					<?php endif;?>
                </div><!-- /.tab-pane -->
				
				<!----------------------- /
					By Contestants 
				/------------------------>
				
                  <div class="tab-pane" id="tab_2">
                  <?php $res = _sqlRetrieve_num("count(score_id)","score","event_id",$_SESSION['eid']);
					$re = mysqli_fetch_assoc($res);
					$juddd = _sqlRetrieve_param("count(distinct judge_id) as count","score","event_id",$_SESSION['eid'],"order BY judge_id");
					
					
				    $c_j = mysqli_fetch_assoc($juddd);
					$no_j = $c_j['count'];
				   //echo $no_j;
					if($re['count(score_id)'] > 0):
					 $num = 1;
						
					  ?>	
				  <div class="table-responsive">
                    <table id="event_table" class="table no-margin table-hover">
                      <thead>
                        <tr>
                          <th>Rank</th>
                          <th>Image</th>
                          <th>Name</th>
						  <th>Score</th>
                        </tr>
                      </thead
					  <!-- show event---->
					  <tbody id="tbody">
					 <?php 
					   if($cat == 'Group' || $cat == 'group'){
					 $t = _sqlRetrieveBygroup("sum(score),group_id","score","event_id",$_SESSION['eid'],"group_id","DESC");
					 }else{
						$t = _sqlRetrieveBygroup("sum(score),con_id","score","event_id",$_SESSION['eid'],"con_id","DESC");
					 }
					  $tie = array();
					  $count = 1;
					   foreach($t as $d):
					   if($cat == 'Group' || $cat == 'group'){
					   $c = _sqlQuerySelectLast("group_contestant","group_id",$d['group_id']);
					      $name = $c['group_name'];
						  $image = $c['group_image'];
						}
						else{
						$c = _sqlQuerySelectLast("individual_contestant","con_id",$d['con_id']);
					      $name = $c['fname'].' '.$c['mi'].' '.$c['lname'];
						  $image = $c['image_name'];
						}
						 
					  ?>
			
					  <tr>
						<td><?php
						if(in_array($d['sum(score)'],$tie)): 
						$count -= 1 ;?>
							<small class="label pull-right bg-red">tie</small>
						<?php endif;
						$tie[] = $d['sum(score)'];
						 echo $count;?></td>
						<td><img src="upload_image/<?php echo	$image;?>" class="direct-chat-img" alt="<?php echo $name;?>"></td>
						<td><?php echo $name;?></td>
						<td><?php echo number_format($d['sum(score)']/$no_j,2);?></td>
						
					  </tr>
					  <?php 
					  $count++;
					  endforeach;?>
					  </tbody>
                    </table>
						<div class="box-footer pull-right">
						  <a href="print-results-con.php?event_id=<?php echo $_SESSION['eid'];?>&cat=<?php echo $cat;?>" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>

						  <a href="javascript:void()" class="btn btn-primary"><i class="fa fa-download"></i> Generate PDF</a>
						</div>
                </div><!-- /.box-body -->
				<?php else:?>
					<h5 class="text-center">Please wait for the results&hellip;</h5>
					<?php endif;?>
				  
				  
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
