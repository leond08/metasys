<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">

    <title>Meta | Scoring Panel</title>
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
	
	    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="dist/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="dist/css/ionicons.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.css">
    <!-- AdminPanel Skins. 
    -->
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

  </head>

  <body class="hold-transition skin-navy layout-top-nav fixed">
  
	<header class="main-header">
        <nav class="navbar navbar-static-top text-center bg-navy">
		<h3><?php echo $eve_name;?></h3>
        </nav>
    </header>
  <script>
	$(function(){
		$(window).load(function() {
			
			$('div.button_sliding_bg').delay(800).fadeIn( 1500 );
		
		});
		
		
	
	
	});
  </script>
  <style>
  .button_sliding_bg {
	display:none;
    color: #fff;
    padding: 12px 17px;
    margin:0 auto;
    font-family: 'OpenSansBold', sans-serif;
    border: 3px solid #31302B;
    font-size: 14px;
    font-weight: bold;
    letter-spacing: 1px;
    text-transform: uppercase;
    border-radius: 2px;
    text-align: center;
    cursor: pointer;
    box-shadow: inset 0 0 0 0 #31302B;
	-webkit-transition: all ease 0.8s;
	-moz-transition: all ease 0.8s;
	transition: all ease 0.8s;
	}
	.button_sliding_bg:hover {
		box-shadow: inset 0 100px 0 0 #31302B;
		color: #FFF;
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
			$q = _sqlQuerySelectLast("event","event_id",$_SESSION['event_id']);
			$c = $q['allow_segment'];
			$img = $q['event_image'];
			$table = $c == 'yes'? 'segment' : 'criteria';
			$column = $c == 'yes'? 'segment_id' : 'criteria_id';
			
	
				$res = _sqlQuerySelectAll($table,"event_id",$_SESSION['event_id']);?>
				 <div class="overlayer"></div>
					<div class="container">
					<br /><br />
					  <div class="login-box">
					 <?php foreach($res as $col):
								$id = $table == 'segment'? $col['segment_id'] : $col['criteria_id'];
						$sql = _sqlRetrieve_param("distinct ".$column,"score","event_id",$_SESSION['event_id'],"AND judge_id =".$_SESSION['judge_id']." AND ".$column." = ".$id);
						if(!mysqli_num_rows($sql)):
							$flag = true;
							
								?>
				 <div onclick="window.location = 'controller_score.php?action=_score&id=<?php echo $id;?>&criteria=<?php echo $col['name'];?>'" class="button_sliding_bg"><?php $sub = substr($col['name'],0,30); echo strtoupper($sub);?></div>
				 <br />
					<?php 
					endif;
					endforeach;
					if($flag == false){
						
						header('location:judge/notif.php');
					
					}?>
				 </div>
				 </div>
				 
				 
		
			
    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("upload_image/<?php echo $img;?>", {speed: 500});
    </script>

	
  </body>
</html>
