$(function(){
function getEvent(){
		alert("show");
		$.getJSON("getEvent.php?action=getEvent", function(json) {
			if (json.msg.length > 0) {
			
					$('.table').empty();
					
				$.each(json.msg,function() {
					
					
						var data = '<tr>'+
                          '<td><a href="#">'+this['id']+'</a></td>'+
                          '<td>   <div class="user-panel">'+
							'<div class="pull-left image">'+
							  '<img src="upload_image/'+this['image']+'" class="img-circle" alt="User Image">'+
							'</div>'+
							'</div></td>'+
						 '<td>'+this['name']+'</td>'+
                          '<td><div class="sparkbar" data-color="#00a65a" data-height="20">'+this['date']+'</div></td>'+
						  '<td><span class="label label-success">'+this['status']+'</span></td>'+
						  '<td><div class="tools">'+
                        '<a href="#"> <i class="fa fa-edit"></i></a>'+
                       '<a href ="#"><i class="fa fa-trash-o"></i></a>'+
                      '</div></td>'+
                        '</tr>';
						
						$('.table').append( data );
			
				
				});
			}
		});
		
	}
});