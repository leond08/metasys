$(document).ready(function(){
	$('#formsubmit').submit(function() {
		return false;
	});
	
	$('.btn').click(function(e) {
		e.preventDefault();
		
		showLogin();
		return false;
	});	

	function showLogin(){
		
		
		
		var data = $('#formsubmit').serializeArray();

		$.post($('#formsubmit').attr('action'), data, function(json){
			
			if (json.status == "fail") {
			
				$('.alert').fadeIn('fast',function(){
					
					$(this).text(json.message);		
				
				});
				
					
			}
			if (json.status == "success") {
				
				location.href=json.message;
			
			}
		}, "json");
		
	
	}
	
});
