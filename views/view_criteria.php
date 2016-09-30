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
	<link rel="stylesheet" href="dist/css/chatbox.css">
    <!-- AdminPanel Skins. 
    -->
	<link rel="stylesheet" href="plugins/iCheck/all.css">
	<link rel="stylesheet" type="text/css" href="assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">
	<link href="dist/css/style.css" rel="stylesheet">
	<!--
	  *  My script
	 -->
	<!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
	<script src="plugins/select2/select2.full.min.js"></script>
	<script src="dist/js/jQuery.nicescroll.js"></script>
	<script src="dist/js/validatesegment.js"></script>
	 <script src="plugins/iCheck/icheck.min.js"></script>
	 <script src="dist/js/chatbox_script.js"></script>
	 <script src="plugins/select2/select2.full.min.js"></script>
	
   
	
  </head>

  <body class="hold-transition skin-blue sidebar-mini fixed">
	<script>
	$(function(){
		$('button#btn_submit').click(function(){
			
			$('input[type=number]').removeAttr('disabled');
		
		});
		

	
	});
	
	function edit(pn){
		var par = $(pn).parents('.form-group').first();
		par.find('input[type=number]').removeAttr('disabled');
		
	}

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
<?php include_once('views/tags/sidebar.php');?>
        </section>
        <!-- /.sidebar -->
      </aside>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Criteria
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
			<li class="active">View criteria</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
		<?php
		 $ret = _sqlRetrieve_num("count(criteria_id) as id","criteria","event_id",$_SESSION['eid']);
		 $ret = mysqli_fetch_assoc($ret);
		 if($ret['id'] == 0):?>
		            
                  		<div class="col-md-12 col-sm-2 col-md-offset-1 box0 text-center" style="margin:0 auto;">
						<a href="controller.php?action=add_criteria"><span class="li_heart">
                  			<div class="box1">
					  			<h1><i class="ion ion-person-add"></i></h1></span>
					  			<h3>Oops! Nothing to view.. Add criteria now</h3>
                  			</div>
							</a>
					  			<p>Add criteria now....</p>
                  		</div>
                  
			<?php endif;?>
		
		
		<?php 
		$r = _sqlQuerySelectAll("criteria","event_id",$_SESSION['eid']);
		$ret = _sqlRetrieve_num("count(criteria_id) as id","criteria","event_id",$_SESSION['eid']);
		 $ret = mysqli_fetch_assoc($ret);?>
			
		 <?php if($ret['id'] > 1):?>
		<div class="row">
		<?php endif;?>
		<?php foreach($r as $t):
		 if($ret['id'] > 1):?>
		<div class="col-md-6">
		<?php endif;?>	
		 <form method="post" action="controller.php?action=update_crit" id="formsubmit">
			<input type="hidden" name="action" value="formsubmit" id="action">
			<input type="hidden" name="seg_id" id="seg_id" value="<?php echo $t['criteria_id'];?>">
		 <div class="box box-default">
            <div class="box-header with-border">
			  <h3 class="box-title" data-toggle='tooltip' title='<?php echo $t['name']; ?>'><?php echo substr($t['name'],0,25); ?></h3>
			  <div class="form-group">
					<?php if($t['percentage'] == 0 || $t['percentage'] == '0'):?>
                     <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-laptop"></i>
                      </div>
					  
                      <input type="number" class="form-control" min="1" max="100" value="" name="seg" id="seg">
					 
					</div><!-- /.input group -->
					 <?php else:?>
					 <div class="input-group">
                    <div class="input-group-btn ">
                      <button type="button" class="btn btn-flat btn-info dropdown-toggle" data-toggle="dropdown">Action <span class="fa fa-caret-down"></span></button>
                      <ul class="dropdown-menu">
                        <li onclick="edit(this);"><a href="#">Edit</a></li>
                        
                      </ul>
                    </div><!-- /btn-group -->
                    <input type="number" class="form-control" min="1" max="100" value="<?php echo $t['percentage'];?>" name="seg" id="seg" disabled>
                  </div><!-- /input-group -->
					   <?php endif;?>
                  </div><!-- /.form-group -->
              <div class="box-tools pull-right">
			  
                <button class="btn btn-box-tool" data-widget="collapse"  data-toggle='tooltip' title='Hide'><i class="fa fa-minus"></i></button>
				
                <a  data-toggle='tooltip' title='Remove' href="controller.php?action=update_criteria&crit_id=<?php echo $t['criteria_id'];?>" class="btn btn-box-tool"><i class="fa fa-trash-o"></i></a>
              </div>
            </div><!-- /.box-header -->

            <div class="box-footer">
             <button type="reset" class="btn btn-flat btn-primary">Reset</button>
					<button type="submit" class="btn btn-flat btn-primary" id="btn_submit">Save</button>
            </div>
						<div class="overlay" id="loading" style="display:none;">
                  <i class="fa fa-spinner fa-spin"></i> 
            </div>
			<div class="overlay" id="loading" style="display:none;">
                  <i class="fa fa-spinner fa-spin"></i> 
            </div>
          </div><!-- /.box -->
		  </form>
		  <?php if($ret['id'] > 1):?>
		    </div><!-- /.col -->
		  <?php endif;?>
		<?php endforeach;?>
             
		 <?php if($ret['id'] > 1):?>
		    </div><!-- /.row -->
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
	
	<div class="modal modal-danger fade" id="myModal">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa  fa-exclamation-triangle"></i> Oh! Snap...</h4>
                  </div>
                  <div class="modal-body">
                    <p> </p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-outline " data-dismiss="modal">Close</button>
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
		<script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="assets/js/gritter-conf.js"></script>

	

		  <!------------------------
			
				do not remove
		  ------------------------->



  </body>
</html>
