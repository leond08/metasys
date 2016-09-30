<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Meta | Scoring Panel</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <!-- Theme style -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="dist/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="dist/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="dist/css/skins/skin-navy.css">
	<link href="plugins/simple-slider/simple-slider.css" rel="stylesheet">

  </head>
  <body class="hold-transition skin-navy layout-top-nav con">

  <style>
	p.output {
		text-align:center;
	}
	.overlayer{
		background:#000;
		opacity:0.3;
		width:100%;
		height:100%;
		position:absolute;
		border:5px solid #000;
		z-index:-1;
	}
  </style>
 <?php 
 	 $flag = false;
	 $sql = _sqlRetrieve_param("distinct criteria_id ","score","event_id",$_SESSION['event_id'],"AND judge_id =".$_SESSION['judge_id']);
						if(!mysqli_num_rows($sql)){
							$flag = true;
						}
						else {

							if($flag == false){
							header('location:judge/notif.php');
							}
						}
						?>
    <div class="wrapper">
    <header class="main-header">
        <nav class="navbar navbar-static-top text-center">
		<h3><?php echo $eve_name;?></h3>
	
		<h5 class="pull-right" style="padding-right:10px;">Judge: <?php echo $_SESSION['judge_name'];?></h5>
        </nav>
    </header>
	<!------------------------------------------------------------------------
				A SCRIPT HERE
	-------------------------------------------------------------------------->
	
	
	<!------------------------------------------------------------------------
				A SCRIPT HERE
	-------------------------------------------------------------------------->
    <!-- Main content -->
		<div class="content-wrapper">
		 <div class="overlayer"></div>

			<div class="container" style="display:none;" id="con">
			<br >
			<?php
			$ta = "criteria";
			$co = "count(criteria_id)";
			$ii = "criteria_id";
			
			$q = _sqlQuerySelectLast("event","event_id",$_SESSION['event_id']);
			$img = $q['event_image'];
			
			if($q['category_select'] != 'MrMs'):?>
			<div class="box" >
			<form method="post" action="" id="formsubmit">
			<input type="hidden" name="action" value="formsubmit">
                <div class="box-header">
                  <h3 class="box-title" style="color:#000000; font-weight: bold;">Contestants</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                  <table class="table table-hover">
                    <tr>
                      <th>#</th>
                      <th>Image</th>
                      <th>Name</th>
					  <?php
						 $ii = "segment_id";
						 $qu = _sqlQuerySelectAll("criteria","event_id",$_SESSION['event_id']);
						 
						
						// if segment is not 0 show this
						 foreach($qu as $k):
						
						 
					  ?>
					   <input id="crit_id" type="hidden" name="crit_id[]" value="<?php echo $k['criteria_id'];?>">
                      <th><?php echo $k['name'];?></th>
					  <?php endforeach;?>
				
                    </tr>
                  
					<?php 
					  if($q['category_select'] == 'Group'){
						 $f =  _sqlQuerySelectByOrder2("group_contestant","event_id",$_SESSION['event_id'],"number","asc");
						 foreach($f as $fu):
						 ?>
					<tr>
					  <td><?php echo $fu['number'];?></td>
                      <td><img class="direct-chat-img" src="upload_image/<?php echo $fu['group_image'];?>" alt="<?php echo $fu['group_name'];?>"><!-- /.direct-chat-img --></td>
                      <td><?php echo $fu['group_name'];?></td>
					  <input id="con_id" type="hidden" name="con_id[]" value="<?php echo $fu['group_id'];?>">
                      <?php 
					
					for($i = 1;$i<=$count=_sqlLast_insert("count(criteria_id)","criteria","event_id",$_SESSION['event_id']);$i++):?>
                      <td><input type="text" data-slider-range="<?php echo $min;?>,<?php echo $max;?>" data-slider-step="<?php echo $int;?>" data-slider="true" name="score_val[]"></td>
					  <?php endfor;?>
                    </tr> 
					<?php endforeach;}
					// form for Mr and Ms //
					else if($q['category_select'] == 'Mr' || $q['category_select'] == 'Ms' ){
						 $f =  _sqlQuerySelectByOrder2("individual_contestant","event_id",$_SESSION['event_id'],"number","asc");
						 foreach($f as $fu):
						 ?>
					<tr>
					  <td><?php echo $fu['number'];?></td>
                      <td><img class="direct-chat-img" src="upload_image/<?php echo $fu['image_name'];?>" alt="<?php echo $fu['fname'].' '.$fu['mi'].' '.$fu['lname'];?>"><!-- /.direct-chat-img --></td>
                      <td><?php echo $fu['fname'].' '.$fu['mi'].' '.$fu['lname'];?></td>
					  <input id="con_id" type="hidden" name="con_id[]" value="<?php echo $fu['con_id'];?>">
					 <?php 
					 
						for($i = 1;$i<=$count=_sqlLast_insert("count(criteria_id)","criteria","event_id",$_SESSION['event_id']);$i++):?>
                      <td><input type="text" data-slider-range="<?php echo $min;?>,<?php echo $max;?>" data-slider-step="<?php echo $int;?>" data-slider="true" name="score_val[]"></td>
					  <?php endfor;?>
                    </tr> 
					  
					 <?php endforeach;}?>
                  </table>
                </div><!-- /.box-body -->
				<div class="box-footer" align="right">
					
					 <button type="button" data-toggle="modal" data-target="#myModal1" class="btn btn-flat btn-primary" id="btn_submit">Cast</button>
				</div><!-- /.box-footer -->
				
		
				</form>
			</div><!-- /.box -->
			
			<?php
			else:
	
			/***********************
				male contestants
			***********************/
			
			$f = _sqlQueryMrMs2("individual_contestant","event_id",$_SESSION['event_id'],"type","Mr","number","asc");
			?>
			
			
			<form method="post" action="controller_score.php?action=score_segment" id="formsubmit">
			<input type="hidden" name="action" value="formsubmit">
			<div class="box">
                <div class="box-header">
                  <h3 class="box-title" style="color:#000000; font-weight: bold;">Male Contestants</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                  <table class="table table-hover">
                    <tr>
                      <th>#</th>
                      <th>Image</th>
                      <th>Name</th>
					<?php
						$ii = "segment_id";
						  $qu = _sqlQuerySelectAll("criteria","event_id",$_SESSION['event_id']);
						 
						 foreach($qu as $k):
						
					  ?>
					  <input id="crit_id" type="hidden" name="crit_id[]" value="<?php echo $k['criteria_id'];?>">
                      <th><?php echo $k['name'];?></th>
					  <?php endforeach;?>
						
                    </tr>
					<?php
						 foreach($f as $fu):
						 ?>
					<tr>
					  <td><?php echo $fu['number'];?></td>
                      <td><img class="direct-chat-img" src="upload_image/<?php echo $fu['image_name'];?>" alt="<?php echo $fu['fname'].' '.$fu['mi'].' '.$fu['lname'];?>"><!-- /.direct-chat-img --></td>
                      <td><?php echo $fu['fname'].' '.$fu['mi'].' '.$fu['lname'];?></td>
					  <!----------------------hidden variables----------------------------->
					  <input id="con_id" type="hidden" name="con_id[]" value="<?php echo $fu['con_id'];?>">
                     <?php 
					for($i = 1;$i<=$count=_sqlLast_insert("count(criteria_id)","criteria","event_id",$_SESSION['event_id']);$i++):?>
                      <td><input type="text" data-slider-range="<?php echo $min;?>,<?php echo $max;?>" data-slider-step="<?php echo $int;?>" data-slider="true" name="score_val[]"></td>
					  <?php endfor;?>
                    </tr> 
					<?php endforeach;?>

                  </table>
                </div><!-- /.box-body -->
			</div><!-- /.box -->
		
			<!-- female contestants -->
			<?php 
			$f = _sqlQueryMrMs2("individual_contestant","event_id",$_SESSION['event_id'],"type","Ms","number","asc");
			?>
			
		
			<div class="box">
                <div class="box-header">
                  <h3 class="box-title" style="color:#000000; font-weight: bold;">Female Contestants</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                  <table class="table table-hover">
                    <tr>
                      <th>#</th>
                      <th>Image</th>
                      <th>Name</th>
					  <?php
						 $ii = "segment_id";
						 $qu = _sqlQuerySelectAll("criteria","event_id",$_SESSION['event_id']);
						 
						 
						 foreach($qu as $k):
					  ?>
					  
                      <th><?php echo $k['name'];?></th>
					  <?php endforeach;?>
                    </tr>
					<?php
						 foreach($f as $fu):
					?>
					<tr>
					  <td><?php echo $fu['number'];?></td>
                      <td><img class="direct-chat-img" src="upload_image/<?php echo $fu['image_name'];?>" alt="<?php echo $fu['fname'].' '.$fu['mi'].' '.$fu['lname'];?>"><!-- /.direct-chat-img --></td>
                      <td><?php echo $fu['fname'].' '.$fu['mi'].' '.$fu['lname'];?></td>
					  <input id="con_id" type="hidden" name="con_id[]" value="<?php echo $fu['con_id'];?>">
                       <?php 					 
					  for($i = 1;$i<=$count=_sqlLast_insert("count(criteria_id)","criteria","event_id",$_SESSION['event_id']);$i++):?>
                      <td><input type="text" data-slider-range="<?php echo $min;?>,<?php echo $max;?>" data-slider-step="<?php echo $int;?>" data-slider="true" name="score_val[]"></td>
					  <?php endfor;?>
                    </tr> 
					 <?php 
					 endforeach;
					 ?>

                  </table>
                </div><!-- /.box-body -->
			</div><!-- /.box -->
			<div class="box-footer" align="right">
					
					 <button type="button" data-toggle="modal" data-target="#myModal1" class="btn btn-flat btn-primary" id="btn_submit">Cast</button>
			</div><!-- /.box-footer -->
			</form>
			<?php endif;?>
		</div>
		
	</div>
	
	
	
	<!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
	<script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
	 <script src="plugins/simple-slider/simple-slider.js"></script>
  <script>
  $("[data-slider]")
    .each(function () {
      var input = $(this);
      $("<p>")
        .addClass("output")
        .insertAfter($(this));
    })
    .bind("slider:ready slider:changed", function (event, data) {
      $(this)
        .nextAll(".output:first")
          .html(data.value.toFixed(2));
    });
  </script>
	
	<script>
	$(function(){
		$(window).load(function() {
			
			$('#con').delay(700).fadeIn(1500);
		
		});

	$('#btnYes').on('click',function(){
		$('#formsubmit').submit();
		$(this).hide();
		$( ".container" ).fadeOut('slow');
	});
	$('#formsubmit').submit(function(event){
		event.preventDefault();
		var formData = new FormData($('#formsubmit')[0]);
		
		$.ajax({
			url: 'controller_score.php?action=score_criteria',
			type: 'POST',
			success: function(d){
				//alert(d);
				self.location = "judge/notif.php";
			},
			data: formData,
			//Options to tell JQuery not to process data or worry about content-type
			cache: false,
			contentType: false,
			processData: false
		});
		
	});	
	
	
	});
  </script>
  
  <div class="modal fade" id="myModal1">
			<div class="modal-dialog" style="width:100%;margin-top:100px;">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								</div>
								  <div class="modal-body">
									<p>Are you sure you want to cast your score? These cannot be undone&hellip;</p>
								 </div>
								  <div class="modal-footer">
									<button id="btnYes" type="button" class="btn btn-success" data-dismiss="modal"><span class="glyphicon glyphicon-check"></span>Yes</button>
									<button id="btnNo" type="submit" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button></div></div></div></div>
	<script>
		  $('.content-wrapper').backstretch("upload_image/<?php echo $img;?>", {speed: 500});
    </script>								
  </body>
</html>
