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
	<script src="dist/js/chatbox_script.js"></script>
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
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
			<li class="active">Add criteria</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
		<form role="form" method="post" action="controller.php?action=create_segment" enctype="multipart/form-data" id="form" id="formsubmit">
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
                    <label>Select Criteria</label>
                    <select class="form-control select2" data-placeholder="Select a criteria" style="width: 100%;" name="segment_criteria" id="segment_criteria">
					  <option></option>
					  <?php $crit = _sqlSelect("criteria_temp");
					  
					  foreach($crit as $value):?>
                      <option><?php echo $value['criteria_temp_name'];?></option>
					  
					  <?php endforeach;?>
                    </select>
                  </div><!-- /.form-group -->
                </div><!-- /.col -->
				
			    <div class="col-md-6">
					 <div class="form-group">
                    <label>Percentage</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-laptop"></i>
                      </div>
                      <input type="number" class="form-control" min="1" max="100" value="" name="segment_percentage" id="segment_percentage">
                    </div><!-- /.input group -->
                    <label id="check">
                      <input type="checkbox" class="minimal" name="notallowed" value="no"  id="check" checked>
					    Allow percentage?
                    </label>
                  </div><!-- /.form group -->
                </div><!-- /.col -->
               
              </div><!-- /.row -->
            </div><!-- /.box-body -->
			<div class="overlay" id="loading" style="display:none;">
                  <i class="fa fa-spinner fa-spin"></i> 
            </div>
          </div><!-- /.box -->

				
		</div><!-- /.appendbox -->
		  
					<div class="box-footer">
					 <button type="submit" class="btn btn-primary" id="btn_submit">Save</button>
                  </div>

                  
        </form>
             
			
   
			

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

	
	<script>
	 $(function(){
        $('.select2').select2({
          // specify tags
          tags: true
        });
      });
			
	</script>

		  <!------------------------
			
				do not remove
		  ------------------------->
<script>
	var bool = true;
	var t = false;
	var percent = 0;
	var sum = 0;
	var FREQ = 1000;
	
	
				

  
	$(function(){
	
	
		$('#formsubmit').submit(function(){
			return false;
		});
		
		
	
	
		$('#check').each(function(){
			$(this).change(function(){
				if(!t){
					
					var par = $(this).parents('.form-group').first();
						par.find('input[type=number]').attr('disabled','true');
						par.find('input[type=number]').val('');
					t  = true;
					bool = true
					
				} else {
					
					var par = $(this).parents('.form-group').first();
						par.find('input[type=number]').removeAttr('disabled');
				

					t = false;
					bool = false;
					
				}
		});
		});
		
		$('#btn_submit').click(function(){
				
				
		

				var attr = $('input[type=number]').attr('disabled');
				if(typeof(attr) === undefined || typeof(attr) === 'undefined'){
					if($('input[type=number]').val() == ''){
					
					var par = $('input[type=number]').parents('.form-group');
					par.addClass('has-error');
					bool = false;
			
			
				 
					}
					else{
						
						var par = $('input[type=number]').parents('.form-group');
						par.removeClass('has-error').addClass('has-success');
						sum = parseInt($('input[type=number]').val());
						bool = true;
					}
				}
				else {
					if(bool){
						_sendData();
						_clearData();
					}  
				}
				
				if(typeof(attr) === undefined || typeof(attr) === 'undefined'){
				var ajax = new XMLHttpRequest();
			    
				ajax.open("GET","controller.php?action=create_criteria",true);
				ajax.onreadystatechange = function(){
					if(ajax.readyState == 4 && ajax.status == 200){
						 var data = ajax.responseText;
						
						 percent = parseInt(data);
					
						if(percent < 100){
						
						if(sum < percent){
							
							var sump = sum+percent;
							
								if(sump <= 100){
									
									bool = true;
								}
								else{
								$('#myModal').modal();
								$('.modal-body>p').text('Sorry the percentage is total of 100%...');
									bool = false;
								}
						}
					}
					if(percent == 100){
						
						$('#myModal').modal();
						 $('.modal-body>p').text('Sorry the percentage is total of 100%...');
						bool = false;	
					}
					if(bool){
					_sendData();
					_clearData();
					}  
					}

				}
				
				
				 ajax.send(); 	
				}	

				return false;


	});
	
	});
		
	
	   

	  

   

   	function _clearData(){
	
		$('input').each(function(){
			$(this).val('');
			var par = $(this).parents('.form-group').first();
			par.removeClass('has-success');
		});
		
		
	
	}
   
   function _(elem){
			
	return document.getElementById(elem);
}

	
		
	function _sendData(){
		var segment_criteria = _("segment_criteria").value;
		var segment_percentage = _("segment_percentage").value;
		
		
		var formdata = new FormData();

		formdata.append("segment_percentage",segment_percentage);
		formdata.append("segment_criteria",segment_criteria);

		var ajax = new XMLHttpRequest();
		
		ajax.open("POST","controller.php?action=create_criteria",true);
		ajax.onreadystatechange = function(){
			if(ajax.readyState == 4 && ajax.status == 200){
				var data = ajax.responseText.split("||");
 				for(i = 0; i < data.length - 1;i++){
					
					var item = data[i].split("|");
					var name = item[0];
					var percent = item[1];
				
				
				} 
				
			 _("loading").style.display = "none";	
		 var unique_id = $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: name+' criteria has been added..',
            // (string | mandatory) the text inside the notification
            text: 'Percentage: '+percent+'%',
            // (bool | optional) if you want it to fade out on its own or just sit there
            sticky: false,
            // (int | optional) the time you want it to be alive for before fading out
            time: '3000',
            // (string | optional) the class name you want to apply to that specific message
            class_name: 'my-sticky-class'
        });
			
		 
				
				
			}
		}
		ajax.send(formdata);
		_("loading").style.display = "block";
		
	
		
	}

		  
</script>


  </body>
</html>

