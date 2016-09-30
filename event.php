<?php
session_start();
include_once('db_connections/connection_db.php');
include_once('db_function/db_func.php');
$connect = db_connect();


if($_GET){
	if(isset($_GET['id']) && isset($_GET['name']) && isset($_GET['date'])){
	$id = $_GET['id'];
	$name = $_GET['name'];
	$date = $_GET['date'];
	$res = _sqlSelect_event_url($name,$date,$id);
	
	if(mysqli_num_rows($res) == 1){
		$result = mysqli_fetch_assoc($res);
		$_SESSION['eid'] = $id;
		$name = $result['event_name'];
		$image = $result['event_image'];
		$_SESSION['event'] = $name;
		$_SESSION['image'] = $image;
		$_SESSION['date'] = $date;
	}
	else {
		header('location:controller.php?action=404');
	}

}
else{
	header('location:controller.php?action=404');
}
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
	
	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<script src="dist/js/validate.js"></script>
	<script src="dist/js/jQuery.nicescroll.js"></script>
	
   
	
  </head>

  <body class="hold-transition skin-blue sidebar-mini">
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
          Dashboard
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
			
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
		  <div class="callout callout-success">
                    <h4>Welcome to <?php echo $_SESSION['event']; ?></h4>
                    <p>Start your event now!</p>
         </div>
			
			
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



	



  </body>
</html>
