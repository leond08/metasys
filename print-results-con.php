<?php
session_start();
include_once('db_connections/connection_db.php');
include_once('db_function/db_func.php');

$connect = db_connect();

if($_GET){
	if(isset($_GET['event_id']) && isset($_GET['cat'])){
		$id = _sqlReal($_GET['event_id']);
		$cat = _sqlReal($_GET['cat']);
	
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

        <!-- info row -->
        <div class="row invoice-info">
          <div class="col-sm-4 invoice-col">
              <label class="jumbotron text-center"><?php echo $r['event_name'];?></label>
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
              <tbody>
			  <?php 
					 if($cat == 'Group' || $cat == 'group'){
					 
					 $t = _sqlRetrieveBygroup("sum(score),group_id","score","event_id",$id,"group_id","DESC");
					 }else{
					 $t = _sqlRetrieveBygroup("sum(score),con_id","score","event_id",$id,"con_id","DESC");
					 }
					  $tie = array();
					  $count = 1;
					  
					   foreach($t as $d):
					    if($cat == 'Group' || $cat == 'group'){
					   $c = _sqlQuerySelectLast("group_contestant","group_id",$d['group_id']);
					      $name = $c['group_name'];;
						  $image = $c['group_image'];
						}
						else {
						  $c = _sqlQuerySelectLast("individual_contestant","con_id",$d['con_id']);
					      $name = $c['fname'].' '.$c['mi'].' '.$c['lname'];
						  $image = $c['image_name'];
						}
						
						 
				?>
                <tr>
                  <td><?php
						if(in_array($d['sum(score)'],$tie)): 
						$count -= 1 ;?>
							<small class="label pull-right bg-red">tie</small>
						<?php endif;
						$tie[] = $d['sum(score)'];
						echo $count;?></td>
				  
                  <td><?php echo $name;?></td>
                  <td><?php echo $d['sum(score)'];?></td>
                </tr>
				<?php $count++; endforeach;?>
                 
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
