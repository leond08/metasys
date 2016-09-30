<?php
session_start();
include_once('db_connections/connection_db.php');
include_once('db_function/db_func.php');

$connect = db_connect();

if($_GET){
	if(isset($_GET['event_id']) && isset($_GET['type'])){
		$id = _sqlReal($_GET['event_id']);
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
              <i class="fa fa-globe"></i> Meta Sys.
              <small class="pull-right">Date: <?php echo  date("F j, Y");?> </small>
            </h2>
          </div><!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
          <div class="col-sm-4 invoice-col">
           
            <address>
              <strong></strong>
            
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
						  
						  <?php $res =  _sqlRetrieve_param("DISTINCT a.segment_id as seg_id,b.percentage as percentage,b.name as name","score as a,segment as b","a.event_id",$_SESSION['eid'],"AND b.segment_id = a.segment_id");
							
							$juddd = _sqlRetrieve_param("count(distinct judge_id) as count","score","event_id",$_SESSION['eid'],"order BY judge_id");
							$c_j = mysqli_fetch_assoc($juddd);
							$no_j = $c_j['count'];
						  
						  while($r=mysqli_fetch_array($res)):?>
						  <th colspan="<?php echo $no_j;?>"> <?php echo $r['name'];?></th>
						  <th rowspan="2"></th>
						  <?php endwhile;?>
						  <th rowspan="2"></th>
						  <th rowspan="2">Overall Rank</th>
  
                      </tr>
					  <tr>
					<?php $res = _sqlRetrieve_param("DISTINCT a.segment_id as seg_id,b.percentage as percentage,b.name as name","score as a,segment as b","a.event_id",$_SESSION['eid'],"AND b.segment_id = a.segment_id");
						  	$juddd = _sqlRetrieve_param("distinct judge_id","score","event_id",$_SESSION['eid'],"order BY judge_id");
							$c_j = db_res_to_array($juddd);
							
							$r=db_res_to_array($res);
							foreach($r as $res):
								foreach($c_j as $c ):?>
								
								<th><?php $ret = _sqlRetrieve_num("name","judge","judge_id",$c['judge_id']);

									 $judge = mysqli_fetch_assoc($ret);

									 echo $judge['name'];?></th>
								
								
						   <?php endforeach; 
						         endforeach;?>
						
                      </tr>
                      </thead
					  <!-- show event---->
					  <tbody id="tbody">
					  
					 <!-- loop contestant details -->
					<?php 
					  $t = _sqlRetrieve_param2("sum(a.rank) as score,a.criteria_id as criteria_id,a.segment_id as segment_id,a.con_id as con_id,b.fname as fname,b.mi as mi,b.lname as lname,b.number as number,b.image_name as image","score as a,individual_contestant as b","a.event_id",$_SESSION['eid'],"AND a.con_id = b.con_id AND b.type = '".$cat."' GROUP BY a.con_id ORDER BY sum(a.score) DESC");
					
					  $tie = array();
					  $count = 1;
					   foreach($t as $d):
					   $tot_score = 0;
						$name = $d['fname'].' '.$d['mi'].' '.$d['lname'];
						$image = $d['image'];
						$cid = $d['con_id'];
						$number = $d['number'];
						 
					  ?>
					 <tr>
						<!-- con 1 -->
                          <td><?php echo $number;?></td>
						 
						  <td><?php echo $name;?></td>
						<!-- first loop for segment 1 -->
						<?php
						 $res = _sqlRetrieve_param("DISTINCT a.segment_id as seg_id,b.percentage as percentage,b.name as name","score as a,segment as b","a.event_id",$_SESSION['eid'],"AND b.segment_id = a.segment_id");
						  	$r=db_res_to_array($res);
							
							foreach($r as $seg_id):
							$seg = $seg_id['seg_id'];
							$sub_score = 0;
							
							//echo $seg;
							
							$score_this =   _sqlRetrieve_param("score,rank,con_id","score","event_id",$_SESSION['eid'],"AND segment_id = '$seg' AND con_id = '$cid' ");

							
							foreach($score_this as $score):
							$sub_score += $score['score'];
							?>
							<!-- first loop for segment 1 -->
						  <td><?php echo $score['score'];?></td>
						  <?php endforeach;?>
					    <!-- /.judge score for segment 1 -->
						<!-- sub total -->
						 
						  <td><?php 
									$sub_score_tot = $sub_score/$no_j;
									//echo $sub_score_tot;
									$tot_score += $sub_score_tot;
									
						  ?>
						  </td>
						 <?php endforeach;?>
						<!-- end of loop judge score for segment 1 -->
						  
					   <!-- total score -->
						  <td><?php 
									echo number_format($tot_score,2);?></td>
					   <!-- ranking -->
						  <td><?php
						if(in_array($tot_score,$tie)): 
						$count -= 1 ;?>
							<small class="label pull-right bg-red">tie</small>
						<?php endif;
						$tie[] = $tot_score;
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

    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
  </body>
</html>
