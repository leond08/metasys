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
	<link rel="stylesheet" href="plugins/iCheck/all.css">
    <!-- AdminPanel Skins. 
    -->
    <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">
	<link rel="stylesheet" href="dist/css/chatbox.css">

	<!--
	  *  My script
	 -->
	<!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4 -->
	<script src="dist/js/chatbox_script.js"></script>

    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
	<script src="plugins/select2/select2.full.min.js"></script>
	<script src="dist/js/jQuery.nicescroll.js"></script>
	
   
	
  </head>

  <body class="hold-transition skin-blue sidebar-mini fixed" >
	<script>
		$(function() { 
			$('.content-wrapper').niceScroll({cursorwidth: '10px', autohidemode: false, zindex: 999, horizrailenabled: false });
		});
   </script>

   <div class="wrapper">

      <!-- Main Header -->
	  <?php include('views/tags/header.php');?>

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
           Scoring
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
			<li class="active">Add Scoring</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
		<form role="form" method="post" action="controller.php?action=create_score" id="form" id="formsubmit">
		<input type="hidden" name="action" value="formsubmit"/>
          <!-- Your Page Content Here -->
			  <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Add Scoring</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                
                  <div class="box-body">
                    <div class="form-group">
                      <label for="rangeMin">Range</label>
                       <input type="number" class="form-control" min="1" max="10" value="" name="min_score" id="min_score" placeholder="min" >
                    </div>
                    <div class="form-group">
                      <label for="rangeMax">To</label>
                      <input type="number" class="form-control" min="1" max="10" value="" name="max_score" id="max_score" placeholder="max" >
                    </div>
				    <div class="form-group">
                      <label for="venue">Interval</label>
                       <select class="form-control" id="score_interval" name="score_interval">
					    <option value="0.1">0.1</option>
                        <option value="0.5">0.5</option>
                        <option value="1">1</option>
                      </select>
                    </div>
					<!--
					<div class="form-group">
                    <label id="check">
                      <input type="checkbox" class="minimal" name="score_asis" value="yes" checked>
					    As is with the percentage
                    </label>
                  </div>-->

                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="reset" class="btn btn-primary">Reset</button>
					 <button type="submit" class="btn btn-primary" id="btn_submit">Save</button>
                  </div>
                </form>
              </div><!-- /.box -->
                  
			
   
			
			
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
                    <p> The minimum score is greater than or equal the maximum score...</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-outline " data-dismiss="modal">Close</button>
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
	
	 <script src="plugins/iCheck/icheck.min.js"></script>
	<script>
	 //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue'
          
        });
	</script>
	<!------------------------
		function for ranges
		return false if the
		minimum score is greater
		than the maximum score
	-------------------------->
	<script>
	var range = true;
	var t = false;
	$(function(){
		
		$('#btn_submit').click(function(){
		
		$('input[type=number]').each(function(){
				if($(this).val() == ''){
					
					var par = $(this).parents('.form-group').first();
					par.addClass('has-error');
					range = false;
			
				 
				}
				else{

					var par = $(this).parents('.form-group').first();
					par.removeClass('has-error').addClass('has-success');
				
				}

		});
	
		if($('#min_score').val() != '' && $('#max_score').val() != ''){

			if(parseInt($('#min_score').val()) >= parseInt($('#max_score').val())){
				
				$('#myModal').modal();
				var par = $('#min_score').parents('.form-group').first();
				par.addClass('has-error');
				range =  false;
			}
			else {
				range = true;
			}
		}
			return range;
		});
		
		
		
/* 		 $('#check').click(function(){
		
		if(!t){

			$('input[type=number]').each(function(){
				
				$(this).removeAttr('disabled');
			
			});
			t  = true;
			range = false;
			
		} else {
			


			$('input[type=number]').each(function(){
				
				$(this).attr('disabled','true');
				$(this).val('');
			
			});
			t = false;
			range = true;
			
		}
			
			
			
		});  */
		
	

			
				
		});
		
		
	
	</script>

  </body>
</html>
