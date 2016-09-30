<?php
session_start();
if(!isset($_SESSION['pass'])){
		
		header('location:index.php');
	
}
include_once('db_connections/connection_db.php');
include_once('db_function/db_func.php');


$connect = db_connect();

$sql = "SELECT count(event_id) as id from event";
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
	<link rel="stylesheet" type="text/css" href="assets/js/gritter/css/jquery.gritter.css" />
	<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
	    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="assets/js/gritter-conf.js"></script>
	
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
  	<div class="modal-event" id="samp">
            
    </div><!-- /.example-modal -->	
	<div class="modal-update-event" id="update-event">
            
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
		var updatemodal = _("update-event");
		
		var data = new XMLHttpRequest();
					data.open("POST", "getEvent.php", true);
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
							var image = item[1];
							var name = item[2];
							var date = item[3];
							var status = item[4];
							var venue = item[5];
							var res = name.replace(/ /g, "");
													not += '<tr>'+
                          '<td align="center"><a href="event.php?id='+id+'&name='+name+'&date='+date+'"><i class="fa fa-eye"></i></a></td>'+
                          '<td>   <div class="user-panel">'+
							'<div class="pull-left image">'+
							  '<img src="upload_image/'+image+'" class="img-square" alt="User Image">'+
							'</div>'+
							'</div></td>'+
						 '<td>'+name+'</td>'+
                          '<td><div class="sparkbar" data-color="#00a65a" data-height="20">'+date+'</div></td>'+
						  '<td><span class="label label-success">'+status+'</span></td>'+
						  '<td><div class="tools">'+
                        '<a data-toggle="modal" href="#edit'+id+'"> <i class="fa fa-edit"></i></a>'+
                       '<a data-toggle="modal" href="#'+res+'"><i class="fa fa-trash-o"></i></a>'+
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
									'<p>Are you sure you want to delete this event? This cannot be undone&hellip;</p>'+
								  '</div>'+
								  '<div class="modal-footer">'+
									'<button type="submit" class="btn btn-success" data-dismiss="modal" onclick="delete_event('+id+');"><span class="glyphicon glyphicon-check"></span> Delete</button>'+
									'<button type="submit" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button></div></div></div></div>'
						
						sample.innerHTML = samp;
								//modal for edit event
							
								up+='<form method="post" action="controller.php?action=update_event" enctype="multipart/form-data"><input type="hidden" name="event_id" id="event_id" value="'+id+'"/><div class="modal fade" id="edit'+id+'">'
							+'<div class="modal-dialog modal-md">'+
								'<div class="modal-content">'+
								  '<div class="modal-header">'+
									'<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
									'<h4 class="modal-title"><span class="fa fa-edit"></span>EDIT EVENT</h4>'+
								  '</div>'+
								  '<div class="modal-body">'+
									'<div class="box-body"><div class="row"><div class="col-md-6"><label for="exampleInputFile">Event Background</label><div class="img-square"><img width="100%" id="img" src="upload_image/'+image+'" alt="Image preview..."></div></div><div class="col-md-6"><div class="form-group"><label for="exampleInputEvent">Event Title</label><input type="text" class="form-control" id="event_name" placeholder="Enter event title" value="'+name+'" name="event_name" required></div><div class="form-group"><label for="exampleInputDate">Date</label><input type="date" class="form-control" id="event_date" placeholder="" name="event_date" value="'+date+'" required></div><div class="form-group"><label for="venue">Venue</label><input type="text" class="form-control" id="event_venue" placeholder="Where this will be held?" name="event_venue" value="'+venue+'" required><div class="standard" style=""><br /><input type="file"  id="event_image" name="event_image" value ="'+image+'" accept="image/*"></div></div></div></div></div></div>'+
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
		var updatemodal = _("update-event");
		
		var data = new XMLHttpRequest();
					data.open("POST", "searchEvent.php", true);
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
							var image = item[1];
							var name = item[2];
							var date = item[3];
							var status = item[4];
							var venue = item[5];
							var res = name.replace(/ /g, "");
													not += '<tr>'+
                          '<td align="center"><a href="event.php?id='+id+'&name='+name+'&date='+date+'">'+id+'</a></td>'+
                          '<td>   <div class="user-panel">'+
							'<div class="pull-left image">'+
							  '<img src="upload_image/'+image+'" class="img-square" alt="User Image">'+
							'</div>'+
							'</div></td>'+
						 '<td>'+name+'</td>'+
                          '<td><div class="sparkbar" data-color="#00a65a" data-height="20">'+date+'</div></td>'+
						  '<td><span class="label label-success">'+status+'</span></td>'+
						  '<td><div class="tools">'+
                        '<a data-toggle="modal" href="#edit'+id+'"> <i class="fa fa-edit"></i></a>'+
                       '<a data-toggle="modal" href="#'+res+'"><i class="fa fa-trash-o"></i></a>'+
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
									'<p>Are you sure you want to delete this event? This cannot be undone&hellip;</p>'+
								  '</div>'+
								  '<div class="modal-footer">'+
									'<button type="submit" class="btn btn-success" data-dismiss="modal" onclick="delete_event('+id+');"><span class="glyphicon glyphicon-check"></span> Delete</button>'+
									'<button type="submit" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button></div></div></div></div>'
						
						sample.innerHTML = samp;
								//modal for edit event
							
								up+='<form method="post" action="controller.php?action=update_event" enctype="multipart/form-data"><input type="hidden" name="event_id" id="event_id" value="'+id+'"/><div class="modal fade" id="edit'+id+'">'
							+'<div class="modal-dialog modal-md">'+
								'<div class="modal-content">'+
								  '<div class="modal-header">'+
									'<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
									'<h4 class="modal-title"><span class="fa fa-edit"></span>EDIT EVENT</h4>'+
								  '</div>'+
								  '<div class="modal-body">'+
									'<div class="box-body"><div class="row"><div class="col-md-6"><label for="exampleInputFile">Event Background</label><div class="img-square"><img width="100%" id="img" src="upload_image/'+image+'" alt="Image preview..."></div></div><div class="col-md-6"><div class="form-group"><label for="exampleInputEvent">Event Title</label><input type="text" class="form-control" id="event_name" placeholder="Enter event title" value="'+name+'" name="event_name" required></div><div class="form-group"><label for="exampleInputDate">Date</label><input type="date" class="form-control" id="event_date" placeholder="" name="event_date" value="'+date+'" required></div><div class="form-group"><label for="venue">Venue</label><input type="text" class="form-control" id="event_venue" placeholder="Where this will be held?" name="event_venue" value="'+venue+'" required><div class="standard" style=""><br /><input type="file"  id="event_image" name="event_image" value ="'+image+'" accept="image/*"></div></div></div></div></div></div>'+
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
	
	function update_event(id){
		
		var event_image = _("event_image").files[0];
		var event_name = _("event_name").value;
		var event_date = _("event_date").value;
		var event_venue = _("event_venue").value;
		var event_id = id;
	
		
		var formdata = new FormData();
		formdata.append("event_name",event_name);
		formdata.append("event_id",event_id);
		formdata.append("event_date",event_date);
		formdata.append("event_venue",event_venue);
		formdata.append("event_image",event_image);

		var ajax = new XMLHttpRequest();
		
		ajax.open("POST","controller.php?action=update_event",true);
		ajax.onreadystatechange = function(){
			if(ajax.readyState == 4 && ajax.status == 200){
				var data = ajax.responseText;
				
			 alert(data);
		 var unique_id = $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: 'System has been modified..',
            // (string | mandatory) the text inside the notification
            text:'The event has been modified..',
            // (string | optional) the image to display on the left
            // (bool | optional) if you want it to fade out on its own or just sit there
            sticky: false,
            // (int | optional) the time you want it to be alive for before fading out
            time: '3000',
            // (string | optional) the class name you want to apply to that specific message
            class_name: 'my-sticky-class'
        });
			
		 	request_page(1);
				
				
			}
		}
		ajax.send(formdata);
		
	
	}
	
	
	</script>
	<!---------------------------------------------------
		delete event
	----------------------------------------------------->
	<script>
	function delete_event(id){
	

		
		var data = new XMLHttpRequest();
					data.open("POST", "delete_event.php", true);
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
							
							self.location = "all_events.php";

						

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
	  
	  <?php include_once('tags/header.php');?>
      <!-- Left side column. contains the logo and sidebar -->
      <?php include_once('tags/sidebar.php');?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            All Events
            <small>Control Panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">All Events</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
	
          <!-- Your Page Content Here -->
			
					<div class="box box-info">
					<div class="box-header with-border">
					<i class="ion ion-clipboard"></i>
                  <h3 class="box-title">Events Listed</h3>
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
                          <th>Event ID</th>
                          <th>Image</th>
                          <th>Event Name</th>
						  <th>Date</th>
                          <th>Status</th>
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
			  <script> request_page(1); </script>
				
		
			
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
	 <?php include_once('tags/footer.php');?>

      <!-- Control Sidebar -->
       <?php include('views/tags/control-sidebar.php');?>
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