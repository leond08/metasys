<?php
$result = _sqlSelect_eventID($_SESSION['event'],$_SESSION['date']);
$id = $result['event_id'];
$cat = $result['category_select'];

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
	<link rel="stylesheet" type="text/css" href="assets/js/gritter/css/jquery.gritter.css" />
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
	<script src="dist/js/jQuery.nicescroll.js"></script>
	<script src="dist/js/uploadscript.js"></script>
	
   
	
  </head>

  <body class="hold-transition skin-blue sidebar-mini fixed">
	<script>
		$(function() { 
			$('.wrapper').niceScroll({cursorwidth: '10px', autohidemode: false, zindex: 999, horizrailenabled: false });
		});
   </script>
 <script>


$(function(){

	
	$('#formsubmit').submit(function(){
		return false;
	});	
	
	
	
	$('#btn_submit').click(function(){
		
			bool = 'true';
			
			$('input').each(function(){
				if($(this).val() == ''){

				    var par = $(this).parents('.form-group').first();
					par.addClass('has-error');
                   
						
				}
				
				else{
				    var par = $(this).parents('.form-group').first();
					par.removeClass('has-error').addClass('has-success');

					
				}
			});
			

			if($('#candid_lname').val() != '' && $('#candid_fname').val() != '' && $('#fileUpload').val() != ''){
				_sendData();
				_clearData();
				
			}
			
		
		
			 
	});
	
	function _clearData(){
	
		$('input').each(function(){
			$(this).val('');
			var par = $(this).parents('.form-group').first();
			par.removeClass('has-success');
		});
		
	
	}

	
});



function _(elem){
			
	return document.getElementById(elem);
}
		
	function _sendData(){
		bool = true;
		var image = _("fileUpload").files[0];
		var candid_no = _("candid_no").value;
		var candid_lname = _("candid_lname").value;
		var candid_fname = _("candid_fname").value;
		var candid_mi = _("candid_mi").value;
		<?php if($cat == 'MrMs'):?>
		var participants = _("participants").value;
		<?php endif;?>
		var candid_address = _("candid_address").value;
		var candid_barangay = _("candid_barangay").value;
		
		var formdata = new FormData();
		formdata.append("fileUpload",image);
		formdata.append("candid_no",candid_no);
		formdata.append("candid_lname",candid_lname);
		formdata.append("candid_fname",candid_fname);
		formdata.append("candid_mi",candid_mi);
		<?php if($cat == 'MrMs'):?>
		formdata.append("participants",participants);
		<?php endif;?>
		formdata.append("candid_address",candid_address);
		formdata.append("candid_barangay",candid_barangay);

		var ajax = new XMLHttpRequest();
		
		ajax.open("POST","controller.php?action=create_contestant",true);
		ajax.onreadystatechange = function(){
			if(ajax.readyState == 4 && ajax.status == 200){
				var data = ajax.responseText.split("||");
			
				
				for(i = 0; i < data.length - 1;i++){
					
					var item = data[i].split("|");
					var name = item[0];
					var image = item[1];
				
				}
			 _("loading").style.display = "none";	
		 var unique_id = $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: 'New contestant has been added..',
            // (string | mandatory) the text inside the notification
            text: name+' has been added..',
            // (string | optional) the image to display on the left
            image: 'upload_image/'+image,
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
           Add Contestants
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active">Dashboard</li>
			<li class="active">Add Contestants</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
		<form role="form" method="post" enctype="multipart/form-data" action="controller.php?action=create_contestant" id="formsubmit">
		
          <!-- Your Page Content Here -->
			
		       <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Contestants</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEvent">Candidate No.</label>
                      <input type="number" class="form-control" id="candid_no" placeholder="Candidate No." min="1" max="100" name="candid_no">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputDate">Last Name</label>
                      <input type="text" class="form-control" id="candid_lname" placeholder="Last Name" name="candid_lname">
                    </div>
				    <div class="form-group">
                      <label for="venue">First Name</label>
                      <input type="text" class="form-control" id="candid_fname" placeholder=" First name" name="candid_fname">
                    </div>
					<div class="form-group">
                      <label for="venue">Middle Initial</label>
                      <input type="text" class="form-control" id="candid_mi" placeholder="Middle Initial" name="candid_mi" size="1" maxlength="1">
                    </div>
			
					<?php 
					if($cat == 'MrMs'):?>
					  <div class="form-group">
                      <label for="exampleInputVenue">Gender</label>
                      <select class="form-control" id="participants" name="participants">
                        <option value="Mr">Male</option>
                        <option value="Ms">Female</option>
                      </select>
                    </div>
					<?php endif;?>   
					
					
					 <div class="form-group">
                      <label>Municipality/City</label>
                     <select class="form-control select2" data-placeholder="Select a municipality/city" style="width: 100%;" name="candid_address" id="candid_address">
						<option></option>
						<?php $crit = _sqlSelect("city");
						foreach($crit as $value):?>
                      <option><?php echo $value['City_name'];?></option>
					  <?php endforeach;?>
                      </select>
                    </div>
					<div class="form-group">
                      <label for="venue">Barangay</label>
                      <input type="text" class="form-control" id="candid_barangay" placeholder="Barangay" name="candid_barangay">
                    </div>
                    <div class="form-group has-error">
                    <label for="exampleInputFile">Upload Image</label>
					 
                    <div class="standard" style="display:none;">
					<input type="file" onchange="previewFile(this)" id="fileUpload" name="fileUpload"></div>
					
					<div class="pix" style="width:100px; height:100px;border:1px solid #ccc; cursor:pointer;" onclick="triggerUpload(event,'fileUpload')">
					<img id="img" src="dist/css/png/512/ios7-person.png" width="100" height="100" alt="Image preview..."></div>
                   
					<!--<p class="help-block" id="status"></p>-->
                    </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="reset" class="btn btn-primary">Reset</button>
					 <button type="submit" class="btn btn-primary" id="btn_submit">Add</button>
                  </div>
                </form>
				<div class="overlay" id="loading" style="display:none;">
                  <i class="fa fa-spinner fa-spin"></i> 
                </div>
              </div><!-- /.box -->
			
		  
				
             
			
   
			
			
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
	<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
	<script>
	 $(function(){
        $('.select2').select2({
          // specify tags
          tags: true
        });
      });
			
	</script>




  </body>
</html>
