<?php 
session_start();
	if(!isset($_SESSION['pass'])){
		
		header('location:index.php');
	
	}
?>
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
    <!-- Font Awesome -->
    <link rel="stylesheet" href="dist/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="dist/css/ionicons.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.css">
    <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">
	<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>

  </head>

  <body class="hold-transition skin-blue sidebar-mini fixed">
    <div class="wrapper">
	
      <!-- Main Header -->
	  
	  <?php include_once('tags/header.php');?>
      <!-- Left side column. contains the logo and sidebar -->
      <?php include_once('tags/sidebar.php');?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>Control Panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
	
          <!-- Your Page Content Here -->
			
			          <!-- Small boxes (Stat box) -->
          <div class="row">
            
			<div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3><i class="ion ion-person-add"></i></h3>
                  <p>Create Event</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="controller.php?action=add_event" class="small-box-footer">Create<i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><i class="fa fa-arrow-circle-right"></i><sup style="font-size: 20px"></sup></h3>
                  <p>Upcoming Events</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="all_events.php" class="small-box-footer">Show events<i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
          <!--
            <div class="col-lg-3 col-xs-6">
              <!-- small box -
              <div class="small-box bg-red">
                <div class="inner">
                  <h3>65</h3>
                  <p>Results</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
         </div><!-- /.row -->
			
			
			
        </section><!-- /.content -->
		   
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
	 
	 <?php include_once('tags/footer.php');?>
		
      <!-- Control Sidebar -->
     <?php include('views/tags/control-sidebar.php');?>
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
		  
      <div class="control-sidebar-bg"></div>
	
	
    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4 -->
   
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
	 <script src="dist/js/chatbox_script.js"></script>
	  <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>

  </body>
</html>