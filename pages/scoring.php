<?php 
	


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
  	<script>
		function triggerUpload(event,elem){
			event.preventDefault();
			document.getElementById(elem).click();
		}
		
		function previewFile(input) {
					  var preview = document.getElementById('img');
					  var file    = input.files[0];
					  var reader  = new FileReader();

						reader.onloadend = function () {
						preview.src = reader.result;
					  }

					  if (file) {
						reader.readAsDataURL(file);
					  } else {
						preview.src = "";
					  }
					}
	</script>
	<script>
	$(function(){
			 
		$(".select2").select2();
			

	// function for validate form
		var error = 0;
		var n = 1;
		
		validateForm();
		
		$('#btn_submit').click(function(){
			
	
			
		});
		
		function validateForm(){

				$('#event').focusout(function(){
				
				if( $('#event').val() == ''){
				
				
				  $('.form-group:nth-child(1)').addClass('has-error');
				  
				 
				}
				else{
					$('.form-group:nth-child(1)').removeClass('has-error').addClass('has-success');
					
				}
				});
				
				$('#date').focusout(function(){
				
				if( $('#date').val() == ''){
				
				
				  $('.form-group:nth-child(2)').addClass('has-error');
				
				}
				else{
					$('.form-group:nth-child(2)').removeClass('has-error').addClass('has-success');
					
				}
				});
				
				$('#venue').focusout(function(){
				
				if( $('#venue').val() == ''){
				
				
				  $('.form-group:nth-child(3)').addClass('has-error');
				
				}
				else{
					$('.form-group:nth-child(3)').removeClass('has-error').addClass('has-success');
					
				}
				});
				
				$('#participants').focusout(function(){
				
				if( $('#participants').val() == ''){
				
				
				  $('.form-group:nth-child(4)').addClass('has-error');
				  
				}
				else{
					$('.form-group:nth-child(4)').removeClass('has-error').addClass('has-success');
					
				}
				});
				
			}

		
		
	
});
	
	</script>
   <script>
   $(function(){
   	// function for adding input for segment with validation
		var percent = 100;
		var count = 2;
		
		 $('[data-widget="remove"]').click(function(){
			var box = $(this).parents(".box").first();
			box.remove();
		}); 
		
	     $('#btn_add').click(function(){
					
					var n = $('#segment_percentage').val();
					var t = $('input[type=number]').length;
					var sum = 0;
					
					
					if(t == 1){
					  if(n >= 100){
						alert('this is enough more than what you think');
					  }else {
						addSegment();
						$(".select2").select2();
						$('[data-widget="remove"]').click(function(){
							var box = $(this).parents(".box").first();
							box.remove();
						}); 
						
				
					  }
					}
					else {
						
						$('input[type=number]').each(function(){
							var add = parseInt($(this).val());
							sum +=add;
						});
						
						if(sum >=100){
							alert('this is enough more than what you think');
						}
						else{
						addSegment();
						$(".select2").select2();
						$('[data-widget="remove"]').click(function(){
							var box = $(this).parents(".box").first();
							box.remove();
						}); 
					
						}
						//alert(sum);
					}

				    
				 
			
		  });
	 	 
		

	   
	   function addSegment(){
			$('.appendbox').append('<div class="box box-info" id="box"><div class="box-header with-border"> <h3 class="box-title"></h3><div class="box-tools pull-right"><button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button><button class="btn btn-box-tool" data-widget="remove" id="remove"><i class="fa fa-remove"></i></button></div></div><div class="box-body"><div class="row"><div class="col-md-6"><div class="form-group"><label>Judge Name</label><input type="text" class="form-control" placeholder="Enter a judge name" name="judge_name[]"></div></div><div class="col-md-6"><div class="form-group"><label>Designation</label><select class="form-control select2"  data-placeholder="Select designation" style="width: 100%;" name="segment_criteria[]"><option></option><option>Chairman</option><option>Member</option></select></div></div></div></div></div>');
	   
	   }
	   
	  
   });
   </script>
   <div class="wrapper">

      <!-- Main Header -->
	  
	   <header class="main-header">

        <!-- Logo -->
        <a href="index2.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>META</b>SYS</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Admin</b>PANEL</span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <li class="dropdown messages-menu">
                <!-- Menu toggle button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-envelope-o"></i>
                  <span class="label label-danger">4</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 4 messages</li>
                  <li>
                    <!-- inner menu: contains the messages -->
                    <ul class="menu">
                      <li><!-- start message -->
                        <a href="#">
                          <div class="pull-left">
                            <!-- User Image -->
                            <img src="dist/img/logo.png" class="img-circle" alt="User Image">
                          </div>
                          <!-- Message title and timestamp -->
                          <h4>
                            Support Team
                            <small><i class="fa fa-clock-o"></i> 5 mins</small>
                          </h4>
                          <!-- The message -->
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li><!-- end message -->
                    </ul><!-- /.menu -->
                  </li>
                  <li class="footer"><a href="#">See All Messages</a></li>
                </ul>
              </li><!-- /.messages-menu -->

              <!-- Notifications Menu -->
              <li class="dropdown notifications-menu">
                <!-- Menu toggle button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  <span class="label label-danger">10</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 10 notifications</li>
                  <li>
                    <!-- Inner Menu: contains the notifications -->
                    <ul class="menu">
                      <li><!-- start notification -->
                        <a href="#">
                          <i class="fa fa-users text-aqua"></i> 5 new members joined today
                        </a>
                      </li><!-- end notification -->
                    </ul>
                  </li>
                  <li class="footer"><a href="#">View all</a></li>
                </ul>
              </li>
              <!-- Tasks Menu -->
              <li class="dropdown tasks-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-flag-o"></i>
                  <span class="label label-danger">9</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 9 tasks</li>
                  <li>
                    <!-- Inner menu: contains the tasks -->
                    <ul class="menu">
                      <li><!-- Task item -->
                        <a href="#">
                          <!-- Task title and progress text -->
                          <h3>
                            Design some buttons
                            <small class="pull-right">20%</small>
                          </h3>
                          <!-- The progress bar -->
                          <div class="progress xs">
                            <!-- Change the css width attribute to simulate progress -->
                            <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                              <span class="sr-only">20% Complete</span>
                            </div>
                          </div>
                        </a>
                      </li><!-- end task item -->
                    </ul>
                  </li>
                  <li class="footer">
                    <a href="#">View all tasks</a>
                  </li>
                </ul>
              </li>
              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
                  <img src="dist/img/logo.png" class="user-image" alt="User Image">
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs">MetaSys</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
                    <img src="dist/img/logo.png" class="img-circle" alt="User Image">
                    <p>
                      MetaSys - Tabulation System
                      <small>Copyright &copy; 2015</small>
                    </p>
                  </li>
                  <!-- Menu Body -->

                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="#" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="dist/img/logo.png" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>MetaSys</p>
              <!-- Status -->
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>

     
			
          <!-- Sidebar Menu -->
<ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
             <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-edit"></i>Segment<small class="label pull-right bg-green">new</small></a>
				<ul class="treeview-menu">
				 <li><a href="segment_table.php"><i class="fa fa-edit"></i>View Segment</a></li>
                <li><a href=""><i class="fa fa-edit"></i>Add Segment</a></li>
				</ul>
				</li>
                <li><a href="judge.php"><i class="fa fa-edit"></i> Judges <small class="label pull-right bg-green">new</small></a>
				<ul class="treeview-menu">
				<li><a href="judge.php"><i class="fa fa-edit"></i>View Judges</a></li>
                <li><a href="add_judge.php"><i class="fa fa-edit"></i>Add Judges</a></li>
				</ul>
				</li>
				<li class="active"><a href="scoring.php"><i class="fa fa-edit"></i> Scoring <small class="label pull-right bg-green">new</small></a>
				<ul class="treeview-menu">
				 <li><a href="scoring.php"><i class="fa fa-edit"></i>view Scoring</a></li>
                <li><a href="add_scoring.php"><i class="fa fa-edit"></i>Add Scoring</a></li>
				</ul>
				</li>
				<li ><a href="#"><i class="fa fa-edit"></i> Contestants <small class="label pull-right bg-green">new</small></a>
				<ul class="treeview-menu">
				 <li><a href="contestants.php"><i class="fa fa-edit"></i>View Contestants</a></li>
                <li><a href="add_contestant.php"><i class="fa fa-edit"></i>Add Contestants</a></li>
				</ul>
				</li>
              </ul>
            </li>
			 <li>
             <a href="pages/calendar.php">
                <i class="fa fa-calendar"></i> <span>Calendar</span>
                <small class="label pull-right bg-red">3</small>
              </a>
            </li>
			 <li>
             <a href="pages/results.php">
                <i class="fa fa-bar-chart"></i> <span>Results</span>
              </a>
            </li>
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           Scoring
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
			<li class="active">Scoring</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
		
          <!-- Your Page Content Here -->
			  <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Scoring</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" action="" enctype="multipart/form-data" id="form"> 
                  <div class="box-body">
				  <style>
				  th,tr,td {
					text-align:center;
				  }
				  </style>
				  <table class="table table-bordered">
                    <tr>
                     
                      <th>Range</th>
                      <th>Interval</th>
					  <th>Remove/Edit</th>
                     
                    </tr>
                    <tr>
                      <td>
						<div class="row">
						<div class="col-md-4">
						<input type="number" class="form-control" min="1" max="10" value="" name="min_score" id="score" placeholder="min">
						</div>
						<div class="col-md-4">
						to 
						</div>
						<div class="col-md-4">
						<input type="number" class="form-control" min="1" max="10" value="" name="max_score" id="score" placeholder="max">
						</div>	
						</div>
                      </td>
					  <td>
					  <div class="form-group">
                       <select class="form-control" id="participants" name="participants">
					    <option value="0.1">0.1</option>
                        <option value="0.5">0.5</option>
                        <option value="1">1</option>
                      </select>
                    </div>
					  </td>
					 <td>
					<button class="btn btn-box-tool" data-widget="remove" id="remove-crit"><i class="fa fa-remove"></i></button>
					<button class="btn btn-box-tool"  id="edit-crit"><i class="fa fa-edit"></i></button>
					</td>
					
                    </tr>

                  </table>
                  
					
                   
                     <!--  <p class="help-block">Example block-level help text here.</p> -->
                   <!-- <div class="checkbox">
                      <label>
                        <input type="checkbox" name="segment" value="yes"> As is as the percentage
                      </label>
                    </div>
					<div class="callout callout-success">
                    
                    <p>The scoring is as is of the percentage of the criteria </p>
                  </div> -->

                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="reset" class="btn btn-primary">Reset</button>
					 <button type="submit" class="btn btn-primary" id="btn_submit">Done</button>
                  </div>
                </form>
              </div><!-- /.box -->
                  
			
   
			
			
        </section><!-- /.content -->

      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
	 <?php include_once('footer.php');?>

      <!-- Control Sidebar -->
	  <?php include('control-sidebar.php');?>
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->
	

	



  </body>
</html>
