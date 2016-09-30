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
	<link rel="stylesheet" href="dist/css/chatbox.css">

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
	<script src="dist/js/uploadscript.js"></script>
	<script src="dist/js/validate.js"></script>
	<script src="dist/js/chatbox_script.js"></script>


	
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
			<li class="active">Create event</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Your Page Content Here -->
			
		 <!-- Small boxes (Stat box) -->
       
         
             <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Create Event</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" action="controller.php?action=create" enctype="multipart/form-data" id="form" id="formsubmit">
				<input type="hidden" name="action" value="formsubmit"/>
                  <div class="box-body">
				 

				  
                    <div class="form-group">
                      <label for="exampleInputEvent">Event Title</label>
                      <input type="text" class="form-control" id="event" placeholder="Enter event title" value="" name="event_name">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputDate">Date</label>
                      <input type="date" class="form-control" id="date" placeholder="" name="event_date">
                    </div>
				    <div class="form-group">
                      <label for="venue">Venue</label>
                      <input type="text" class="form-control" id="venue" placeholder="Where this will be held?" name="event_venue">
                    </div>
					 <div class="form-group">
                      <label for="exampleInputVenue">Participants</label>
                      <select class="form-control" id="participants" name="participants">
                        <option value="Mr">Male</option>
                        <option value="Ms">Female</option>
                        <option value="MrMs">Male & Female</option>
                         <option value="Mr">Mix</option>
                        <option value="Group">Group</option>
                      </select>
                    </div>
                    <div class="form-group">
                    <label for="exampleInputFile">Upload Image</label>
					 
                    <div class="standard" style="display:none;"><input type="file" onchange="previewFile(this)" id="fileUpload" name="event_image" accept="image/*"></div>
					
					<div class="pix" style="width:100px; height:100px;border:1px solid #ccc; cursor:pointer;" onclick="triggerUpload(event,'fileUpload')">
					<img id="img" src="dist/css/png/512/ios7-person.png" width="100" height="100" alt="Image preview..."></div>
                   
                     <!--  <p class="help-block">Example block-level help text here.</p> -->
                    </div>
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="segment" value="yes" checked> Allow segment for this event?
                      </label>
                    </div>
					 <!------- alert div for input null ------>
					<div class="alert alert-danger alert-dismissable" style="display:none;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-ban"></i> Alert!</h4>
					Oh Snap! Looks like you've encountered an error, please input all the corresponding fields. Thank you.
                  </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="reset" class="btn btn-primary">Reset</button>
					 <button type="submit" class="btn btn-primary" id="btn_submit">Submit</button>
                  </div>
                </form>
              </div><!-- /.box -->
			
   
			
			
        </section><!-- /.content -->
		
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
	 <?php include_once('tags/footer.php');?>

      <!-- Control Sidebar -->
    
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->


	


  </body>
</html>
