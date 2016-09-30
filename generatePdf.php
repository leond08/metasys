<?php
session_start();
require_once('dompdf/dompdf_config.inc.php');
include_once('db_connections/connection_db.php');
include_once('db_function/db_func.php');
$connect = db_connect();
ob_start();

if($_GET){
	if(isset($_GET['event_id']) && isset($_GET['judge_id']) && isset($_GET['cat'])){
		$id = _sqlReal($_GET['event_id']);
		$jid = _sqlReal($_GET['judge_id']);
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
    <title>
	</title>
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

  </head>
  <body>
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
		
					    $j = _sqlQuerySelectLast("judge","judge_id",$jid);
						  $judge = $j['name'];
		
		?>
        <!-- info row -->
        <div class="row invoice-info">
          <div class="col-sm-4 invoice-col">
            From
            <address>
              <strong>Judge <?php echo $judge;?></strong>
            
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
					 
					 $t = _sqlRetrieveBygroup("sum(score),group_id","score","judge_id",$jid,"con_id","DESC");
					}else{
					$t = _sqlRetrieveBygroup("sum(score),con_id","score","judge_id",$jid,"con_id","DESC");
					}
					  $tie = array();
					  $count = 1;
					   foreach($t as $d):
					   if($cat == 'Group' || $cat == 'group'){
					   
					   $c = _sqlQuerySelectLast("group_contestant","group_id",$d['group_id']);
					      $name = $c['group_name'];
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

  </body>
</html>

<?php

	$html = ob_get_clean();
	
	$dompdf = new DOMPDF();
	$dompdf->load_html($html);
	$dompdf->set_paper("LETTER","PORTRAIT");
	$dompdf->render();
	$dompdf->stream("report.pdf",array("Attachment"=>0));
	
?>