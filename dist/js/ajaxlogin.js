<script>
$(document).ready(function(){


	
	$('#btn').click(function(e) {
		e.preventDefault();
		alert("yes");
		showLogin();
		

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
</script>