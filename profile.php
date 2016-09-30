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
		        <section class="content">
		  <div class="row">
			<div class="col-md-4">
              <!-- Widget: user widget style 1 -->
              <div class="box box-widget widget-user-2">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-aqua">
                  <div class="widget-user-image">
                    <img class="img-circle" src="dist/img/pic.jpg" alt="User Avatar">
                  </div><!-- /.widget-user-image -->
                  <h3 class="widget-user-username">Mark Leo A. Sumadero</h3>
                  <h5 class="widget-user-desc">System Developer</h5>
                </div>
                <div class="box-footer no-padding">
                  <ul class="nav nav-stacked">
				  <br>
                    <li><a href="#">See me in Facebook <span class="pull-right badge bg-blue">f</span></li>
                  </ul>
                </div>
              </div><!-- /.widget-user -->
            </div><!-- /.col -->
			 <div class="col-md-4">
              <!-- Widget: user widget style 1 -->
              <div class="box box-widget widget-user-2">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-yellow">
                  <div class="widget-user-image">
                    <img class="img-circle" src="dist/img/user7-128x128.jpg" alt="User Avatar">
                  </div><!-- /.widget-user-image -->
                  <h3 class="widget-user-username">Jojo Navarro Marquillero</h3>
                  <h5 class="widget-user-desc">System Analyst</h5>
                </div>
                <div class="box-footer no-padding">
                  <ul class="nav nav-stacked">
                    <li><a href="#">See me in Facebook <span class="pull-right badge bg-blue">f</span></li>
                  </ul>
                </div>
              </div><!-- /.widget-user -->
            </div><!-- /.col -->
			<div class="col-md-4">
              <!-- Widget: user widget style 1 -->
              <div class="box box-widget widget-user-2">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-navy">
                  <div class="widget-user-image">
                    <img class="img-circle" src="dist/img/user7-128x128.jpg" alt="User Avatar">
                  </div><!-- /.widget-user-image -->
                  <h3 class="widget-user-username">Vencel Angelo R Sanglay</h3>
                  <h5 class="widget-user-desc">System Designer</h5>
                </div>
                <div class="box-footer no-padding">
                  <ul class="nav nav-stacked">
                    <li><a href="#">See me in Facebook <span class="pull-right badge bg-blue">f</li>
                  </ul>
                </div>
              </div><!-- /.widget-user -->
            </div><!-- /.col -->
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