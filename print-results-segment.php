<?php
session_start();
include_once('db_connections/connection_db.php');
include_once('db_function/db_func.php');

$connect = db_connect();

if($_GET){
	if(isset($_GET['event_id']) && isset($_GET['seg_id']) && isset($_GET['type'])){
		$id = _sqlReal($_GET['event_id']);
		$jid = _sqlReal($_GET['seg_id']);
		$ty = _sqlReal($_GET['type']);
		
	}
	else {
		header('location:controller.php?action=404');
	}

}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php $r = _sqlRetrieve_num("event_name","event","event_id",$id);
			 $r = mysqli_fetch_assoc($r);
			 echo $r['event_name'];
	?></title>
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


  </head>
  <body onload="window.print()">
    <div class="wrapper">
      <!-- Main content -->
      <section class="invoice">
        <!-- title row -->
        <div class="row">
          <div class="col-xs-12">
            <h2 class="page-header">
              <i class="fa fa-globe"></i> Meta, Sys.
              <small class="pull-right">Date: <?php echo  date("F j, Y, g:i:s a");?> </small>
            </h2>
          </div><!-- /.col -->
        </div>
		<?php 
		
					    $j = _sqlQuerySelectLast("segment","segment_id",$jid);
						  $segment = $j['name'];
		
		?>
        <!-- info row -->
        <div class="row invoice-info">
          <div class="col-sm-4 invoice-col">
           Segment
            <address>
              <strong><?php echo $segment;?></strong>
            
            </address>
          </div><!-- /.col -->
        </div><!-- /.row -->

        <!-- Table row -->
        <div class="row">
          <div class="col-xs-12 table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Rank</th>
                  <th>Name</th>
                  <th>Score</th>
                </tr>
              </thead>
            <tbody id="tbody">
					  <!-- show event---->
					  <?php 
					 						$juddd = _sqlRetrieve_param("count(distinct judge_id) as count","score","event_id",$id,"order BY judge_id");
					
					
				    $c_j = mysqli_fetch_assoc($juddd);
					$no_j = $c_j['count'];
						
						$t = _sqlRetrieve_param2("a.criteria_id as criteria_id,a.segment_id as segment_id,sum(a.score) as score,a.con_id as con_id,b.fname as fname,b.mi as mi,b.lname as lname,b.image_name as image","score as a,individual_contestant as b","a.event_id",$id,"AND a.segment_id = '".$jid."' AND a.con_id = b.con_id AND b.type = '".$ty."' GROUP BY a.con_id");
					 
					  $tie = array();
					  $count = 1;
					   foreach($t as $d):
						$name = $d['fname'].' '.$d['mi'].' '.$d['lname'];
						$image = $d['image'];
						
						
					  ?>
					  <tr>
						<td><?php
						if(in_array($d['score'],$tie)): 
						$count -= 1 ;?>
							<small class="label pull-right bg-red">tie</small>
						<?php endif;
						$tie[] = $d['score'];
						 echo $count;?></td>
						<td><img src="upload_image/<?php echo $image;?>" class="direct-chat-img" alt="<?php echo $name;?>"></td>
						<td><?php echo $name;?></td>
						<td><?php echo $d['score']/$no_j;?></td>
						
					  </tr>
					  <?php 
					  $count++;
					  endforeach;?>
					  </tbody>
            </table>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </section><!-- /.content -->
    </div><!-- ./wrapper -->

    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
  </body>
</html>
