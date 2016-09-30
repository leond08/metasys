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
           Add Judges
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
			<li class="active">Add Judges</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
		<form role="form" method="post" action="controller.php?action=create_judge" id="form" id="formsubmit">
		<input type="hidden" name="action" value="formsubmit"/>
          <!-- Your Page Content Here -->
			
		 <!-- Small boxes (Stat box) -->
       
		 <!-- SELECT -->
		 <div class="appendbox">
          <div class="box box-info" id="box">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
               
              </div>
            </div><!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Judge Name</label>
					     <input type="text" class="form-control" placeholder="Enter a judge name" name="judge_name[]" id="judge_name">
                  </div><!-- /.form-group -->
                </div><!-- /.col -->
			    <div class="col-md-6">
					 <div class="form-group">
                    <label>Designation</label>
                   
     
                   
                    <select class="form-control select2"  data-placeholder="Select designation" style="width: 100%;" name="judge_designate[]">
                      <option value="chairman">Chairman</option>
                      <option value="member">Member</option>
                      
                    </select>
                   
                  </div><!-- /.form group -->
                </div><!-- /.col -->
               
              </div><!-- /.row -->
            </div><!-- /.box-body -->
         
          </div><!-- /.box -->
		</div><!-- /.appendbox -->
		  
					<div class="box-footer">
                    <button type="button" class="btn btn-primary" id="btn_add">Add Field</button>
					 <button type="submit" class="btn btn-primary" id="btn_submit">Done</button>
                  </div>

                  
		</form>
             
			
   
			
			
        </section><!-- /.content -->
		   
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
	 <?php include_once('views/tags/footer.php');?>

      <!-- Control Sidebar -->
	
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->
	<script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="assets/js/gritter-conf.js"></script>
	<!----------------------
		function for adding judge
	------------------------->
<script>
$(function(){
   	// function for adding judge with validation
		var designate;
		 $('[data-widget="remove"]').click(function(){
			var box = $(this).parents(".box").first();
			box.remove();
		}); 
		
		var count = 1;

		
	     $('#btn_add').click(function(){
						addJudge();
	
						$('[data-widget="remove"]').click(function(){
							var box = $(this).parents(".box").first();
							box.remove();
						}); 
					
				});
		  
			

	
   
   
   $('#btn_submit').click(function(){
				var bool = true;
				$('input#judge_name').each(function(){
					if($(this).val() == ''){
						var par = $(this).parents('.form-group');
						par.addClass('has-error');
						bool =  false;
					}
				});
				
				if(bool){
					getResult();
				}
				
				return bool;
		});			
   
    function addJudge(){
			$('.appendbox').append('<div class="box box-info" id="box"><div class="box-header with-border"> <h3 class="box-title"></h3><div class="box-tools pull-right"><button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button><button class="btn btn-box-tool" data-widget="remove" id="remove"><i class="fa fa-remove"></i></button></div></div><div class="box-body"><div class="row"><div class="col-md-6"><div class="form-group"><label>Judge Name</label><input type="text" class="form-control" placeholder="Enter a judge name" name="judge_name[]" id="judge_name"></div></div><div class="col-md-6"><div class="form-group"><label>Designation</label><select class="form-control select2"  data-placeholder="Select designation" style="width: 100%;" name="judge_designate[]"> <option value="chairman">Chairman</option><option value="member">Member</option></select></div></div></div></div></div>');
	   
	}
	
	function getResult(){
	
		var result = "";
		$.ajax({
			url: "controller.php?action=create_judge",
			cache: false,
			success: function(data){
		
		 var unique_id = $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: 'New judge has been added..',
            // (string | mandatory) the text inside the notification
            text: 'Judge has been added..',
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
	
});
  
</script>
	
	



  </body>
</html>
