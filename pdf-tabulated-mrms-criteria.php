<?php
session_start();
require_once('dompdf/dompdf_config.inc.php');
include_once('db_connections/connection_db.php');
include_once('db_function/db_func.php');
$connect = db_connect();
ob_start();

if($_GET){
	if(isset($_GET['event_id']) && isset($_GET['seg_id']) && isset($_GET['type'])){
		$id = _sqlReal($_GET['event_id']);
		$seg= _sqlReal($_GET['seg_id']);
		$cat = _sqlReal($_GET['type']);
		
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
               Meta Sys.
              <small class="pull-right">Date: <?php echo  date("F j, Y");?> </small>
            </h2>
          </div><!-- /.col -->
        </div>
		<?php 
		
					    $j = _sqlQuerySelectLast("criteria","criteria_id",$seg);
						  $criteria = $j['name'];
		
		?>
        <!-- info row -->
        <div class="row invoice-info">
          <div class="col-sm-4 invoice-col">
           criteria
            <address>
              <strong><?php echo $criteria;?></strong>
            
            </address>
          </div><!-- /.col -->
        </div><!-- /.row -->

        <!-- Table row -->
        <div class="row">
          <div class="col-xs-12 table-responsive">
            <table class="table table-striped text-center">
                                    <thead>
                        <tr>
                          <th colspan="20" class="text-center">TABULATED RESULTS FOR <?php echo strtoupper($_SESSION['event']);?></th>
                        </tr>
					   <tr>
                          <th rowspan="2">#</th>
						 
						  <th rowspan="2">Candidate Name</th>
						  
						  <?php 
							
							$juddd = _sqlRetrieve_param("count(distinct judge_id) as count","score","event_id",$id,"order BY judge_id");
							$c_j = mysqli_fetch_assoc($juddd);
							$no_j = $c_j['count'];?>
						  <th colspan="<?php echo $no_j;?>">Judges</th>
						
						  <th rowspan="2">Total</th>
						  <th rowspan="2">Rank</th>
  
                      </tr>
					  <tr>
					<?php 
					
						  	$juddd = _sqlRetrieve_param("distinct judge_id","score","event_id",$id,"order BY judge_id");
							$c_j = db_res_to_array($juddd);
							
							
								foreach($c_j as $c ):?>
								
								<th><?php echo $c['judge_id'];?></th>
								
								
						   <?php endforeach;?>
						
                      </tr>
                      </thead
					  <!-- show event---->
					   <tbody id="tbody">
					  
					 <!-- loop contestant details -->
					<?php 
					     
					 $t =  _sqlRetrieve_param2("sum(a.score) as score,a.criteria_id as criteria_id,a.criteria_id as criteria_id,a.con_id as con_id,b.fname as fname,b.mi as mi,b.lname as lname,b.number as number,b.image_name as image","score as a,individual_contestant as b","a.event_id",$_SESSION['eid'],"AND a.criteria_id = '$seg' AND a.con_id = b.con_id AND b.type = '".$cat."' GROUP BY a.con_id ORDER BY score DESC");
					   
					  $tie = array();
					  $count = 1;
					   foreach($t as $d):
					   $tot_score = 0;
					  
						$name = $d['fname'].' '.$d['mi'].' '.$d['lname'];
						$image = $d['image'];
						$number = $d['number'];
						$cid = $d['con_id'];
						 
					  ?>
					 <tr>
						<!-- con 1 -->
                          <td><?php echo $number;?></td>
						  
						  <td><?php echo $name;?></td>
						<!-- first loop for criteria 1 -->
						<?php
						 
							
							$sub_score = 0;
							
							//echo $seg;
							
								$score_this = _sqlRetrieve_param("score,con_id","score","event_id",$_SESSION['eid'],"AND criteria_id = '$seg' AND con_id = '$cid' ");

							
							foreach($score_this as $score):
							$sub_score += $score['score'];
							?>
							<!-- first loop for criteria 1 -->
						  <td><?php echo number_format($score['score'],2);?></td>
						  <?php endforeach;?>
					    <!-- /.judge score for criteria 1 -->
						<!-- end of loop judge score for criteria 1 -->
						  
					   <!-- total score -->
						  <td><?php 
								echo $d['score']/$no_j;?></td>
					   <!-- ranking -->
						  <td><?php
						if(in_array($d['score'],$tie)): 
						$count -= 1 ;?>
							<small class="label pull-right bg-red">tie</small>
						<?php endif;
						$tie[] = $d['score'];
						 echo $count;?></td>
  
                      </tr>
					 <!-- /.end of loop contestant details -->
					   <?php 
					  $count++;
					  endforeach;?>
					  </tbody>
            </table>
			  <br />  <br />  <br />
          </div><!-- /.col -->
		
		
		<?php for($i=0;$i<$no_j;$i++):?>
		 <div class="col-xs-6 text-center">
			<h5>_______________________________________</h5>
			<p style="margin-left:10px;margin-bottom:10px;">Signature of Judge</p>
		</div><!-- /.col -->
		<?php endfor;?>
        </div><!-- /.row -->
		
      </section><!-- /.content -->
    </div><!-- ./wrapper -->
  </body>
</html>
<?php

	$html = ob_get_clean();
	$dompdf = new DOMPDF();
	$dompdf->set_base_path('/bootstrap/css/');
	$dompdf->load_html($html);
	$dompdf->set_paper("A4","PORTRAIT");
	$dompdf->render();
	$dompdf->stream("pdftabulatedmrmscriteria.pdf",array("Attachment"=>0));
	
?>