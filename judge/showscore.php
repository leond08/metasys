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
    <link rel="stylesheet" href="../dist/css/ionicons.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.css">
    <!-- AdminPanel Skins. 
    -->


	<!--
	  *  My script
	 -->
	<!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4 -->
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>

    <!-- Bootstrap 3.3.5 -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->

	
   
	
  </head>

  <body>
	
          <?php 
		session_start();

		include_once("../db_function/db_func.php");
			  include_once("../db_connections/connection_db.php");?>
   

        <!-- Content Header (Page header) -->
		
		<div class="wrapper">
        <!-- Main content -->
        <section class="content">
			 <!-- Level 1 Tabulated Criteria Mix -->
			<?php 
				if($_SESSION['segment'] == 'no' && $_SESSION['cat'] != 'MrMs'):
			?>
			<?php include_once('tabulated_criteria.php');?>
			 <!-- Level 2 Tabulated Segment Mix -->
			<?php elseif($_SESSION['segment'] == 'yes' && $_SESSION['cat'] != 'MrMs'):?>
			<?php include_once('tabulated_segment.php');
			?> 

			<?php elseif($_SESSION['segment'] == 'yes' && $_SESSION['cat'] == 'MrMs'):?>
			<?php include_once('tabulated_segment_mrms.php');?>	
		    <?php else:?>
		    <?php include_once('tabulated_criteria_mrms.php');?>	
            <?php endif;?>

        </section><!-- /.content -->
		 </div>
   


  </body>
</html>
