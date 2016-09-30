s<?php
$connect = db_connect();

$sql = "SELECT count(group_id) as id from group_contestant where event_id = '".$_SESSION['eid']."'";
$query = mysqli_query($connect,$sql);
$row = mysqli_fetch_array($query);

//total row count
$total_rows = $row[0];
// results per page
$rpp = 5;
$last = ceil($total_rows/$rpp);
 if($last < 1){
	$last = 1;
} 

?>
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

	<link rel="stylesheet" type="text/css" href="assets/js/gritter/css/jquery.gritter.css" />
	<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
	    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="assets/js/gritter-conf.js"></script>
	<script src="dist/js/chatbox_script.js"></script>
	<link href="dist/css/style.css" rel="stylesheet">

  </head>

  <body class="hold-transition skin-blue sidebar-mini fixed">
    <style>
  .modal-header, h4, .close {
      background-color: #5cb85c;
      color:white !important;
      text-align: center;
      font-size: 30px;
  }
  .modal-footer {
      background-color: #f9f9f9;
  }
  </style>
  	<div class="example-modal" id="samp">
            
    </div><!-- /.example-modal -->
		<div class="modal-update-event" id="update-con">
            
    </div><!-- /.example-modal -->	

  <script>
  
	var rpp = <?php echo $rpp;?>;
	var last = <?php echo $last;?>;
	

	function _(elem){
		return document.getElementById(elem);
	}
	function request_page(pn){
	

		var result = _("tbody");
		var pagination = _("page");
		var sample = _("samp");
		var updatemodal = _("update-con");
		var data = new XMLHttpRequest();
					data.open("POST", "views/getGroup.php", true);
					data.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					data.onreadystatechange = function() {
						
						if (data.readyState == 4 && data.status == 200) {
							var not = '';
							var samp = '';
							var up = '';
							var dataArray = data.responseText.split("||");
							
							
 							for(var i =  0;i<dataArray.length - 1;i++){
							var item = dataArray[i].split("|");
							var id = item[0];
							var con_id = item[1];
							var image = item[2];
							var name = item[3];
							var status = item[4];
							var res = name.replace(/ /g, "");
							if(status == 'YES' || status == 'yes'){
								var btn = '<div class="btn-group" data-toggle="btn-toggle"><button type="button" class="btn btn-info btn-xs" value="YES" onclick="getVal(this.value,'+id+')">YES</button><button type="button" class="btn btn-default btn-xs" value="NO" onclick="getVal(this.value,'+id+')">NO</button></div>'
							}
							else {
								var btn = '<div class="btn-group" data-toggle="btn-toggle"><button type="button" class="btn btn-default btn-xs" value="YES" onclick="getVal(this.value,'+id+')">YES</button><button type="button" class="btn btn-danger btn-xs" value="NO" onclick="getVal(this.value,'+id+')">NO</button></div>'
							}
													not += '<tr>'+
                          '<td>'+con_id+'</td>'+
                          '<td>   <div class="user-panel">'+
							'<div class="pull-left image">'+
							  '<img src="upload_image/'+image+'" class="img-square" alt="User Image">'+
							'</div>'+
							'</div></td>'+
						 '<td>'+name+'</td>'+
						  '<td>'+btn+
                        '<div class="btn-group pull-right"> <a class="btn btn-success btn-flat btn-xs" data-toggle="modal" href="#edit'+id+'"> <i class="fa fa-edit"></i></a>'+
                       '<a class="btn btn-danger btn-flat btn-xs" data-toggle="modal" href="#'+res+'"><i class="fa fa-trash-o"></i></a></div>'+
                      '</div></td>'+
                        '</tr>'
						result.innerHTML = not;
						// modal for delete event
						samp += '<div class="modal fade" id="'+res+'">'
							+'<div class="modal-dialog modal-sm">'+
								'<div class="modal-content">'+
								  '<div class="modal-header">'+
									'<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
									'<h4 class="modal-title"><span class="glyphicon glyphicon-lock"></span>DELETE</h4>'+
								  '</div>'+
								  '<div class="modal-body">'+
									'<p>Are you sure you want to delete this contestant? This cannot be undone&hellip;</p>'+
								  '</div>'+
								  '<div class="modal-footer">'+
									'<button type="submit" class="btn btn-success" data-dismiss="modal" onclick="delete_event('+id+');"><span class="glyphicon glyphicon-check"></span> Delete</button>'+
									'<button type="submit" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button></div></div></div></div>'
						sample.innerHTML = samp;

							//modal for edit group
								up+='<form method="post" action="controller.php?action=update_group" enctype="multipart/form-data"><input type="hidden" name="con_id" id="con_id" value="'+id+'"/><div class="modal fade" id="edit'+id+'">'
							+'<div class="modal-dialog modal-md">'+
								'<div class="modal-content">'+
								  '<div class="modal-header">'+
									'<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
									'<h4 class="modal-title"><span class="fa fa-edit"></span>EDIT CONTESTANT</h4>'+
								  '</div>'+
								  '<div class="modal-body">'+
									'<div class="box-body"><div class="row"><div class="col-md-6"><label for="exampleInputFile">Image</label><div class="img-square"><img width="80%" height="200px" id="img" src="upload_image/'+image+'" alt="Image preview..."></div></div><div class="col-md-6"><div class="form-group"><label for="exampleInputCandid">Group No.</label><input type="number" class="form-control" id="candid_no" placeholder="Candidate No." value="'+con_id+'" min="1" max="100" name="candid_no"></div><div class="form-group"><label for="exampleInputDate">Group Name</label><input type="text" class="form-control" id="candid_fname" placeholder=" First name" name="candid_fname" value="'+name+'"></div><div class="form-group"><div class="standard" style=""><br /><input type="file"  id="candid_image" name="candid_image" value ="'+image+'" accept="image/*"></div></div></div></div></div></div>'+
								  '</div>'+
								  '<div class="modal-footer">'+
									'<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-check"></span> Save</button>'+
									'<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button></div></div></div></div></form>'
							updatemodal.innerHTML = up;
						}
				
						
						_("loading").style.display = "none";

					}
				}	

					var url = "rpp="+rpp+"&last="+last+"&pn="+pn;
					
					data.send(url);
					
					_("loading").style.display = "block";
					
		var paginationCtrls = "";
						   

		if(last!=1){
			if(pn > 1){
				paginationCtrls+= '<li onclick="request_page('+(pn-1)+')"><a href="#">&laquo;</a></li>';
			}
		if(last > 1){
			for(i = 0;i < last;i++){
				paginationCtrls+= '<li onclick="request_page('+(i+1)+')"><a href="#">'+ (i+1) +'</a></li>';
			}
		}
		if(pn != last){
			paginationCtrls+= '<li onclick="request_page('+(pn+1)+')"><a href ="#">&raquo;</a></li>';
		}
		}
		
		pagination.innerHTML = paginationCtrls;
	}
	
	function search(pn){
	
		var pn = pn.value;
		var result = _("tbody");
		var pagination = _("page");
		var sample = _("samp");
		var updatemodal = _("update-con");
		var data = new XMLHttpRequest();
					data.open("POST", "views/getSearchgroup.php", true);
					data.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					data.onreadystatechange = function() {
						
						if (data.readyState == 4 && data.status == 200) {
							var not = '';
							var samp = '';
							var up = '';
							var dataArray = data.responseText.split("||");
							
							
 							for(var i =  0;i<dataArray.length - 1;i++){
							var item = dataArray[i].split("|");
							var id = item[0];
							var con_id = item[1];
							var image = item[2];
							var name = item[3];
							var status = item[4];
							var res = name.replace(/ /g, "");
							if(status == 'YES' || status == 'yes'){
								var btn = '<div class="btn-group" data-toggle="btn-toggle"><button type="button" class="btn btn-info btn-xs" value="YES" onclick="getVal(this.value,'+id+')">YES</button><button type="button" class="btn btn-default btn-xs" value="NO" onclick="getVal(this.value,'+id+')">NO</button></div>'
							}
							else {
								var btn = '<div class="btn-group" data-toggle="btn-toggle"><button type="button" class="btn btn-default btn-xs" value="YES" onclick="getVal(this.value,'+id+')">YES</button><button type="button" class="btn btn-danger btn-xs" value="NO" onclick="getVal(this.value,'+id+')">NO</button></div>'
							}
													not += '<tr>'+
                          '<td>'+con_id+'</td>'+
                          '<td>   <div class="user-panel">'+
							'<div class="pull-left image">'+
							  '<img src="upload_image/'+image+'" class="img-square" alt="User Image">'+
							'</div>'+
							'</div></td>'+
						 '<td>'+name+'</td>'+
						  '<td>'+btn+
                        '<div class="btn-group pull-right"> <a class="btn btn-success btn-flat btn-xs" data-toggle="modal" href="#edit'+id+'"> <i class="fa fa-edit"></i></a>'+
                       '<a class="btn btn-danger btn-flat btn-xs" data-toggle="modal" href="#'+res+'"><i class="fa fa-trash-o"></i></a></div>'+
                      '</div></td>'+
                        '</tr>'
						result.innerHTML = not;
						// modal for delete event
						samp += '<div class="modal fade" id="'+res+'">'
							+'<div class="modal-dialog modal-sm">'+
								'<div class="modal-content">'+
								  '<div class="modal-header">'+
									'<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
									'<h4 class="modal-title"><span class="glyphicon glyphicon-lock"></span>DELETE</h4>'+
								  '</div>'+
								  '<div class="modal-body">'+
									'<p>Are you sure you want to delete this contestant? This cannot be undone&hellip;</p>'+
								  '</div>'+
								  '<div class="modal-footer">'+
									'<button type="submit" class="btn btn-success" data-dismiss="modal" onclick="delete_event('+id+');"><span class="glyphicon glyphicon-check"></span> Delete</button>'+
									'<button type="submit" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button></div></div></div></div>'
						sample.innerHTML = samp;

							//modal for edit group
								up+='<form method="post" action="controller.php?action=update_group" enctype="multipart/form-data"><input type="hidden" name="con_id" id="con_id" value="'+id+'"/><div class="modal fade" id="edit'+id+'">'
							+'<div class="modal-dialog modal-md">'+
								'<div class="modal-content">'+
								  '<div class="modal-header">'+
									'<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
									'<h4 class="modal-title"><span class="fa fa-edit"></span>EDIT CONTESTANT</h4>'+
								  '</div>'+
								  '<div class="modal-body">'+
									'<div class="box-body"><div class="row"><div class="col-md-6"><label for="exampleInputFile">Image</label><div class="img-square"><img width="80%" height="200px" id="img" src="upload_image/'+image+'" alt="Image preview..."></div></div><div class="col-md-6"><div class="form-group"><label for="exampleInputCandid">Group No.</label><input type="number" class="form-control" id="candid_no" placeholder="Candidate No." value="'+con_id+'" min="1" max="100" name="candid_no"></div><div class="form-group"><label for="exampleInputDate">Group Name</label><input type="text" class="form-control" id="candid_fname" placeholder=" First name" name="candid_fname" value="'+name+'"></div><div class="form-group"><div class="standard" style=""><br /><input type="file"  id="candid_image" name="candid_image" value ="'+image+'" accept="image/*"></div></div></div></div></div></div>'+
								  '</div>'+
								  '<div class="modal-footer">'+
									'<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-check"></span> Save</button>'+
									'<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button></div></div></div></div></form>'
							updatemodal.innerHTML = up;
						}
				
						
						_("loading").style.display = "none";

					}
				}	

					var url = "name="+pn;
					
					data.send(url);
					
					_("loading").style.display = "block";
					
		
	}
	
		function getVal(val1,val2){
		 /* alert(val1);
		alert(val2);  */
		
		var data = new XMLHttpRequest();
				data.open("POST", "controller.php?action=update_group", true);
				data.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				data.onreadystatechange = function() {
				
				if (data.readyState == 4 && data.status == 200) {
					
					request_page(1);
					
					}
				}	

					var url = "status="+val1+"&id="+val2;
					
					data.send(url);
	
	}

	</script>
	<!---------------------------------------------------
		delete event
	----------------------------------------------------->
	<script>
 	function delete_event(id){
	

		
		var data = new XMLHttpRequest();
					data.open("POST", "views/delete_group.php", true);
					data.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					data.onreadystatechange = function() {
						
						if (data.readyState == 4 && data.status == 200) {
						
							var dataArray = data.responseText;
							
								 var unique_id = $.gritter.add({
								// (string | mandatory) the heading of the notification
								title: 'System has been modified modified...',
								// (string | mandatory) the text inside the notification
								text: 'Deleted Successfully...',
								// (bool | optional) if you want it to fade out on its own or just sit there
								sticky: false,
								// (int | optional) the time you want it to be alive for before fading out
								time: '3000',
								// (string | optional) the class name you want to apply to that specific message
								class_name: 'my-sticky-class'
							});
							
							self.location = "controller.php?action=view_group";
							
							

						

						}
				
						
						_("loading").style.display = "none";

					}
				

					var url = "id="+id;
					
					data.send(url);
					
					_("loading").style.display = "block";
					

	}
	
	</script>
	
	
    <div class="wrapper">
	
      <!-- Main Header -->
	 <?php include_once('views/tags/header.php');?>
      
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

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
            Contestants
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">All Contestants</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
		 <?php
		 $ret = _sqlRetrieve_num("count(group_id) as id","group_contestant","event_id",$_SESSION['eid']);
		 $ret = mysqli_fetch_assoc($ret);
		 if($ret['id'] == 0):?>
		            
                  		<div class="col-md-12 col-sm-2 col-md-offset-1 box0 text-center" style="margin:0 auto;">
						<a href="controller.php?action=add_group"><span class="li_heart">
                  			<div class="box1">
					  			<h1><i class="ion ion-person-add"></i></h1></span>
					  			<h3>Oops! Nothing to view.. Add contestant now</h3>
                  			</div>
							</a>
					  			<p>Add contestant now....</p>
                  		</div>
                  
			<?php else:?>
          <!-- Your Page Content Here -->
			
					<div class="box box-info">
					<div class="box-header with-border">
					<i class="ion ion-clipboard"></i>
                  <h3 class="box-title">Contestants List</h3>
					   <div class="box-tools">
                    <div class="input-group" style="width: 150px;">
                      <input type="text" name="table_search" class="form-control input-sm pull-right" placeholder="Search" onkeyup="search(this)">
                      
					  
                    </div>

                  </div>
					</div><!-- /.box-header -->
					<div class="box-body" id="box-body">
					<div class="table-responsive">
                    <table id="event_table" class="table no-margin table-hover">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Image</th>
                          <th>Name</th>
                          <th>Is Active</th>
                        </tr>
                      </thead
					  <!-- show event---->
					  <tbody id="tbody">
					  
					  
					  </tbody>
                    </table>
					<div class="box-tools pull-right">
					<ul class="pagination pagination-sm inline" id="page">
                     
                    </ul>
					</div>
                </div><!-- /.box-body -->
				</div>
				<div class="overlay" id="loading" style="display:none;">
                  <i class="fa fa-spinner fa-spin"></i> 
                </div>
              </div><!-- /.box -->
			  <script>request_page(1); </script>
			<?php endif;?>
		
			
        </section><!-- /.content -->
		
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
	 <?php include_once('tags/footer.php');?>

      <!-- Control Sidebar -->
  
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4 -->
  
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
	<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>

	
  </body>
</html>