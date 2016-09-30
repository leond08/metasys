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
	<link rel="stylesheet" href="dist/css/chatbox.css">
    <!-- AdminPanel Skins. 
    -->
	<link rel="stylesheet" href="plugins/iCheck/all.css">
	<link rel="stylesheet" type="text/css" href="assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">
	<link href="dist/css/style.css" rel="stylesheet">
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
	<script src="dist/js/jQuery.nicescroll.js"></script>
	<script src="dist/js/validatesegment.js"></script>
	 <script src="plugins/iCheck/icheck.min.js"></script>
	 <script src="dist/js/chatbox_script.js"></script>
	 <script src="plugins/select2/select2.full.min.js"></script>
	
   
	
  </head>

  <body class="hold-transition skin-blue sidebar-mini fixed">
	<script>
	$(function(){
		$('button#btn_submit').click(function(){
			
			$('input[type=number]').removeAttr('disabled');
			getResult();
		});
		

	
	});
	
	function edit(pn){
		var par = $(pn).parents('.form-group').first();
		par.find('input[type=number]').removeAttr('disabled');
		
	}
	
	 function selectdata() {
     var items;
     var list = document.getElementById("segment_criteria");
     var selected = new Array();
	
	
		 for (i = 0; i < list.options.length; i++) {
			  if (list.options[ i ].selected) {
				   var re = list.options[i].value;
				   var r = re.replace(/,/g," ");
				   selected.push(r);
			  }
		 }
	  return selected;
	}

	function update_crit(pn){
		var segment_criteria = selectdata();
		
		var formdata = new FormData();

		formdata.append("segment_criteria",segment_criteria);
		formdata.append("id",pn);

		var ajax = new XMLHttpRequest();
		
		ajax.open("POST","controller.php?action=update_crit",true);
		ajax.onreadystatechange = function(){
			if(ajax.readyState == 4 && ajax.status == 200){
				var data = ajax.responseText;
				
			// _("loading").style.display = "none";	
		 var unique_id = $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: 'System has been modified...',
            // (string | mandatory) the text inside the notification
            text: 'Segment criteria has been added...',
            // (bool | optional) if you want it to fade out on its own or just sit there
            sticky: false,
            // (int | optional) the time you want it to be alive for before fading out
            time: '3000',
            // (string | optional) the class name you want to apply to that specific message
            class_name: 'my-sticky-class'
        });
		
			self.location.href = data;
			
		 
				
				
			}
		}
		ajax.send(formdata);
		//_("loading").style.display = "block";
		
	}

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
            Segment
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
			<li class="active">View segment</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
		<?php
		 $ret = _sqlRetrieve_num("count(segment_id) as id","segment","event_id",$_SESSION['eid']);
		 $ret = mysqli_fetch_assoc($ret);
		 if($ret['id'] == 0):?>
		            
                  		<div class="col-md-12 col-sm-2 col-md-offset-1 box0 text-center" style="margin:0 auto;">
						<a href="controller.php?action=add_segment"><span class="li_heart">
                  			<div class="box1">
					  			<h1><i class="ion ion-person-add"></i></h1></span>
					  			<h3>Oops! Nothing to view.. Add segment now</h3>
                  			</div>
							</a>
					  			<p>Add segment now....</p>
                  		</div>
                  
			<?php endif;?>
		
		
		<?php 
		$r = _sqlQuerySelectAll("segment","event_id",$_SESSION['eid']);
		$ret = _sqlRetrieve_num("count(segment_id) as id","segment","event_id",$_SESSION['eid']);
		 $ret = mysqli_fetch_assoc($ret);?>
			
		 <?php if($ret['id'] > 1):?>
		<div class="row">
		<?php endif;?>
		<?php foreach($r as $t):
		 if($ret['id'] > 1):?>
		<div class="col-md-6">
		<?php endif;?>	
		 <form method="post" action="controller.php?action=update_segment" id="formsubmit">
			<input type="hidden" name="action" value="formsubmit" id="action">
			<input type="hidden" name="seg_id" id="seg_id" value="<?php echo $t['segment_id'];?>">
		 <div class="box box-default">
            <div class="box-header with-border">
			  <h3 class="box-title" data-toggle='tooltip' title='<?php echo $t['name']; ?>'><?php echo substr($t['name'],0,25); ?></h3>
			  <div class="form-group">
					<?php if($t['percentage'] == 0 || $t['percentage'] == '0'):?>
                     <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-laptop"></i>
                      </div>
					  
                      <input type="number" class="form-control" min="1" max="100" value="" name="seg" id="seg">
					 
					</div><!-- /.input group -->
					 <?php else:?>
					 <div class="input-group">
                    <div class="input-group-btn ">
                      <button type="button" class="btn btn-flat btn-info dropdown-toggle" data-toggle="dropdown">Action <span class="fa fa-caret-down"></span></button>
                      <ul class="dropdown-menu">
                        <li onclick="edit(this);"><a href="#">Edit</a></li>
                        
                      </ul>
                    </div><!-- /btn-group -->
                    <input type="number" class="form-control" min="1" max="100" value="<?php echo $t['percentage'];?>" name="seg" id="seg" disabled>
                  </div><!-- /input-group -->
					   <?php endif;?>
                  </div><!-- /.form-group -->
              <div class="box-tools pull-right">
			  
                <button class="btn btn-box-tool" data-widget="collapse"  data-toggle='tooltip' title='Hide'><i class="fa fa-minus"></i></button>
				
                <a  data-toggle='tooltip' title='Remove' href="controller.php?action=update_segment&seg_id=<?php echo $t['segment_id'];?>" class="btn btn-box-tool"><i class="fa fa-trash-o"></i></a>
              </div>
            </div><!-- /.box-header -->
            <div class="box-body">
			
			<div class="row">
			 <?php 
			 
			  $num_row = _sqlRetrieve_num("count(criteria_id) as c ","criteria","segment_id",$t['segment_id']);
			 $row = mysqli_fetch_array($num_row);
			  if($row['c'] < 1):?>
			  
				<div class="col-md-12">
				
				   <div class="form-group">
                    <label>Select Criteria</label>
                    <select class="form-control select2" multiple="multiple" data-placeholder="Select a criteria" style="width: 100%;" name="segment_criteria[]" id="segment_criteria">
					  <option></option>
					  <?php $crit = _sqlSelect("criteria_temp");
					  
					  foreach($crit as $value):?>
                      <option><?php echo $value['criteria_temp_name'];?></option>
					  
					  <?php endforeach;?>
                    </select>
					
                  </div><!-- /.form-group -->
				  
					<button type="submit" formaction="controller.php?action=update_criteria_segment&id=<?php echo $t['segment_id'];?>" class="btn btn-flat btn-primary pull-right" id="btn_submit">Add</button>
					
				  </div>
				
			<?php else:?>
			  	<?php 
					$x = _sqlQuerySelectAll("criteria","segment_id",$t['segment_id']);
					
				foreach($x as $z):?>
				
                <div class="col-md-6">
                  <div class="form-group">
                    <label data-toggle='tooltip' title='<?php echo $z['name']?>'><?php echo substr($z['name'],0,22);?></label>
					<input type="hidden" id="crit_id" name="crit_id[]" value="<?php echo $z['criteria_id'];?>">
					<?php if($z['percentage'] == 0 || $z['percentage'] == '0'):?>
                     <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-laptop"></i>
                      </div>
					  
                      <input type="number" class="form-control" min="1" max="100" value="" name="criteria_percentage[]" id="criteria_percentage">
					 
					</div><!-- /.input group -->
					
					 <?php else:?>
					 <div class="input-group">
                    <div class="input-group-btn ">
                      <button type="button" class="btn btn-flat btn-info dropdown-toggle" data-toggle="dropdown">Action <span class="fa fa-caret-down"></span></button>
                      <ul class="dropdown-menu">
                        <li onclick="edit(this);"><a href="#">Edit</a></li>
                        <li><a href="controller.php?action=update_segment&id=<?php echo $z['criteria_id'];?>">Delete</a></li>
                      </ul>
                    </div><!-- /btn-group -->
                    <input type="number" class="form-control" min="1" max="100" value="<?php echo $z['percentage'];?>" name="criteria_percentage[]" id="criteria_percentage" disabled>
                  </div><!-- /input-group -->
					   <?php endif;?>
                  </div><!-- /.form-group -->
                </div><!-- /.col -->
				
				<?php 
				endforeach;?>
				<?php endif;?>
				
				  
              </div><!-- /.row -->
            </div><!-- /.box-body -->
            <div class="box-footer">
             <button type="reset" class="btn btn-flat btn-primary">Reset</button>
					<button type="submit" class="btn btn-flat btn-primary" id="btn_submit">Save</button>
            </div>
						<div class="overlay" id="loading" style="display:none;">
                  <i class="fa fa-spinner fa-spin"></i> 
            </div>
			<div class="overlay" id="loading" style="display:none;">
                  <i class="fa fa-spinner fa-spin"></i> 
            </div>
          </div><!-- /.box -->
		  </form>
		  <?php if($ret['id'] > 1):?>
		    </div><!-- /.col -->
		  <?php endif;?>
		<?php endforeach;?>
             
		 <?php if($ret['id'] > 1):?>
		    </div><!-- /.row -->
		  <?php endif;?>
   
			

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

	

		  <!------------------------
			
				do not remove
		  ------------------------->
<script>

	function getResult(){
	
		var result = "";
		$.ajax({
			url: "controller.php?action=update_segment",
			cache: false,
			success: function(data){
			
		 var unique_id = $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: 'System has been modified..',
            // (string | mandatory) the text inside the notification
            text: 'segment has been modified..',
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
	

  
</script>
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
