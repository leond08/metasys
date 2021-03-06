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
    <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">
	<link rel="stylesheet" type="text/css" href="assets/js/gritter/css/jquery.gritter.css" />
	<link rel="stylesheet" href="dist/css/chatbox.css">
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
	 <script src="dist/js/chatbox_script.js"></script>
	
   
	
  </head>

  <body class="hold-transition skin-blue sidebar-mini fixed">
	<script>
	$(function(){
		$('button#btn_submit').click(function(){
			
			$('input[type=text]').removeAttr('disabled');
			$('select').removeAttr('disabled');
			getResult();
		});
	
	});
	function edit(pn){
		
		var par = $(pn).parents('.form-group').first();
		par.find('input[type=text]').removeAttr('disabled');
		
	
	}
	function edit_sel(pn){
		
		var par = $(pn).parents('.form-group').first();
		par.find('select').removeAttr('disabled');
		
	}
	
	
  
   </script>
  

   <div class="wrapper">

      <!-- Main Header -->
	  <?php include_once('views/tags/header.php');?>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

       
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
          View Judges
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
			<li class="active">View Judges</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
		
		
		<?php
		 $ret = _sqlRetrieve_num("count(judge_id) as id","judge","event_id",$_SESSION['eid']);
		 $ret = mysqli_fetch_assoc($ret);
		 if($ret['id'] == 0):?>
		            
                  		<div class="col-md-12 col-sm-2 col-md-offset-1 box0 text-center" style="margin:0 auto;">
						<a href="controller.php?action=add_judge"><span class="li_heart">
                  			<div class="box1">
					  			<h1><i class="ion ion-person-add"></i></h1></span>
					  			<h3>Oops! Nothing to view.. Add judge now</h3>
                  			</div>
							</a>
					  			<p>Add judge now....</p>
                  		</div>
                  
			<?php endif;?>
          <!-- Your Page Content Here -->
			
		 <!-- Small boxes (Stat box) -->
       
		 <!-- SELECT -->
		<?php $r = _sqlQuerySelectAll("judge","event_id",$_SESSION['eid']);
		 $ret = _sqlRetrieve_num("count(judge_id) as id","judge","event_id",$_SESSION['eid']);
		 $ret = mysqli_fetch_assoc($ret);
		 
		 if($ret['id'] > 1):?>
		<div class="row">
		<?php endif;?>
		<?php foreach($r as $t):
		 if($ret['id'] > 1):?>
		<div class="col-md-6">
		<?php endif;?>	
          <div class="box box-info" id="box">
		  <form role="form" method="post" action="controller.php?action=update_judge" id="form" id="formsubmit">
			<input type="hidden" name="action" value="formsubmit"/>
            <div class="box-header with-border">
              <h3 class="box-title"><div class="invoice-col" style="padding:5px;">
            <b>Judge #<?php echo $t['judge_id'];?></b>
			<input type="hidden" name="ju_id" value="<?php echo $t['judge_id'];?>">
			</div><!-- /.col --></h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
               <a  data-toggle='tooltip' title='Remove' href="controller.php?action=update_judge&judge_id=<?php echo $t['judge_id'];?>" class="btn btn-box-tool"><i class="fa fa-trash-o"></i></a>
              </div>
            </div><!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
				   <label>Judge Name</label>
				   <div class="input-group">
                    <div class="input-group-btn ">
                      <button type="button" class="btn btn-flat btn-info dropdown-toggle" data-toggle="dropdown">Action <span class="fa fa-caret-down"></span></button>
                      <ul class="dropdown-menu">
                        <li onclick="edit(this);"><a href="#">Edit</a></li>
                      </ul>
                    </div><!-- /btn-group -->
                    <input type="text" class="form-control" data-toggle='tooltip' title=' <?php echo $t['name'];?>' placeholder="" name="judge_name" id="judge_name" value="<?php echo $t['name'];?>"disabled>
                  </div><!-- /input-group -->     
                  </div><!-- /.form-group -->
                </div><!-- /.col -->
			    <div class="col-md-6">
					 <div class="form-group">
                    <label>Designation</label>
					<div class="input-group">
                    <div class="input-group-btn ">
                      <button type="button" class="btn btn-flat btn-info dropdown-toggle" data-toggle="dropdown">Action <span class="fa fa-caret-down"></span></button>
                      <ul class="dropdown-menu">
                        <li onclick="edit_sel(this);"><a href="#">Edit</a></li>
                      </ul>
                    </div><!-- /btn-group -->
                    <select class="form-control select2"  data-placeholder="Select designation" style="width: 100%;" name="judge_designate" disabled>
					  
                      <option value="chairman" <?php if($t['designation'] == 'chairman'){echo 'selected';}?>>Chairman</option>
                      <option value="member" <?php if($t['designation'] == 'member'){echo 'selected';}?>>Member</option>
                    </select>
                    </div><!-- /input-group --> 
                  </div><!-- /.form group -->
                </div><!-- /.col -->
              </div><!-- /.row -->
            </div><!-- /.box-body -->
			<div class="box-footer">
					<button type="reset" class="btn btn-primary">Reset</button>
					 <button type="submit" class="btn btn-primary" id="btn_submit">Done</button>
                  </div>
			</form>
			</div>
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
	  <?php include('views/tags/control-sidebar.php');?>
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->
	<script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="assets/js/gritter-conf.js"></script>
	<!----------------------
		
	------------------------->
<script>

	function getResult(){
	
		var result = "";
		$.ajax({
			url: "controller.php?action=update_judge",
			cache: false,
			success: function(data){
			
		 var unique_id = $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: 'System has been modified..',
            // (string | mandatory) the text inside the notification
            text: 'Judge has been modified..',
            // (bool | optional) if you want it to fade out on its own or just sit there
            sticky: false,
            // (int | optional) the time you want it to be alive for before fading out
            time: '3000',
            // (string | optional) the class name you want to apply to that specific message
            class_name: 'my-sticky-class'
        });
	
			
			}
		});
	}
	

  
</script>
	
	



  </body>
</html>
