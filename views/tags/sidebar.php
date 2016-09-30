          <script>
			var url;
			function run(e,elem){
				e.preventDefault();
			    url = $(elem).attr('id');
				$(elem).addClass('active');
				location.href = 'controller.php?action='+url;
				
			}
			

	
		  </script>
		  	<?php
				$result = _sqlSelect_eventID($_SESSION['event'],$_SESSION['date']);
				$cat = $result['category_select'];
				$seg = $result['allow_segment'];
				?>
		  <div class="user-panel">
            <div class="pull-left image">
              <img src="upload_image/<?php echo	$_SESSION['image'];?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo wordwrap($_SESSION['event'],15,'<br>');?></p>
              <!-- Status -->
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
		<ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
           
            <li class="active treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
             <ul class="treeview-menu">
				<?php if($seg == 'yes'){?>
                <li><a href="#"><i class="fa fa-edit"></i>Segment<small class="label pull-right bg-green"></small></a>
				<ul class="treeview-menu">
				 <li onclick="run(event,this)" id="view_segment"><a href="#"><i class="fa fa-edit"></i>View Segment</a></li>
                <li onclick="run(event,this)" id="add_segment"><a href="#"><i class="fa fa-edit"></i>Add Segment</a></li>
				</ul>
				</li>
				<?php }else{?>
				<li><a href="#"><i class="fa fa-edit"></i>Criteria<small class="label pull-right bg-green"></small></a>
				<ul class="treeview-menu">
				 <li onclick="run(event,this)" id="view_criteria"><a href="#"><i class="fa fa-edit"></i>View Criteria</a></li>
                <li onclick="run(event,this)" id="add_criteria"><a href="#"><i class="fa fa-edit"></i>Add Criteria</a></li>
				</ul>
				</li>
				<?php }?>
                <li><a href="#"><i class="fa fa-edit"></i> Judges <small class="label pull-right bg-green"></small></a>
				<ul class="treeview-menu">
				<li onclick="run(event,this)" id="view_judge"><a href="#"><i class="fa fa-edit"></i>View Judges</a></li>
                <li onclick="run(event,this)" id="add_judge"><a href="#"><i class="fa fa-edit"></i>Add Judges</a></li>
				</ul>
				</li>
				<li><a href="#"><i class="fa fa-edit"></i> Scoring <small class="label pull-right bg-green"></small></a>
				<ul class="treeview-menu">
				 <li onclick="run(event,this)" id="view_score"><a href="#"><i class="fa fa-edit"></i>view Scoring</a></li>
                <li onclick="run(event,this)" id="add_score"><a href="#"><i class="fa fa-edit"></i>Update Scoring</a></li>
				</ul>
				</li>
				<?php
					$result = _sqlSelect_eventID($_SESSION['event'],$_SESSION['date']);
					$cat = $result['category_select'];
					if($cat == 'Group'){ ?>
				<li ><a href="#"><i class="fa fa-edit"></i> Group <small class="label pull-right bg-green"></small></a>
				<ul class="treeview-menu">
				 <li onclick="run(event,this)" id="view_group"><a href="#"><i class="fa fa-edit"></i>View Group</a></li>
                <li onclick="run(event,this)" id="add_group"><a href="#" ><i class="fa fa-edit"></i>Add Group</a></li>
				</ul>
				</li>
				<?php }else{?>
				<li ><a href="#"><i class="fa fa-edit"></i> Contestants <small class="label pull-right bg-green"></small></a>
				<ul class="treeview-menu">
				 <li onclick="run(event,this)" id="view_contestant"><a href="#"><i class="fa fa-edit"></i>View Contestants</a></li>
                <li onclick="run(event,this)" id="add_contestant"><a href="#" ><i class="fa fa-edit"></i>Add Contestants</a></li>
				</ul>
				</li>
				<?php }?>

              </ul>
            </li>
			
			<?php	$result = _sqlSelect_eventID($_SESSION['event'],$_SESSION['date']);
					$cat = $result['category_select'];
					$allow_seg = $result['allow_segment'];
					if($allow_seg == 'YES' || $allow_seg == 'yes'):
					if($cat == 'MrMs' || $cat == 'mrms'): ?>
			<li><a href="#"><i class="fa fa-edit"></i> Results <small class="label pull-right bg-green"></small></a>
				<ul class="treeview-menu">
				 <li onclick="run(event,this)" id="view_tabulated_mrms_segment"><a href="#"><i class="fa fa-edit"></i>View Results</a></li>
                
				</ul>
				</li>
				<?php else:?>
				<li ><a href="#"><i class="fa fa-edit"></i> Results <small class="label pull-right bg-green"></small></a>
				<ul class="treeview-menu">
				 <li onclick="run(event,this)" id="view_tabulated"><a href="#"><i class="fa fa-edit"></i>View Results</a></li>
                
				</ul>
				</li>
				<?php endif;
					  else:
			if($cat == 'MrMs' || $cat == 'mrms'): ?>
			<li><a href="#"><i class="fa fa-edit"></i> Results <small class="label pull-right bg-green"></small></a>
				<ul class="treeview-menu">
				 <li onclick="run(event,this)" id="view_tabulated_mrms_criteria"><a href="#"><i class="fa fa-edit"></i>View Results</a></li>
                
				</ul>
				</li>
				<?php else:?>
				<li ><a href="#"><i class="fa fa-edit"></i> Results <small class="label pull-right bg-green"></small></a>
				<ul class="treeview-menu">
				 <li onclick="run(event,this)" id="view_tabulated_criteria"><a href="#"><i class="fa fa-edit"></i>View Results</a></li>
                
				</ul>
				</li>
				<?php endif;
					  endif;
				?>
				
          </ul><!-- /.sidebar-menu -->