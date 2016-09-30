/*  $(function(){
   
		$('#btn_submit').click(function(){
				var bool = true;
				var sum = 0;
				$('input#segment_name').each(function(){
				
				if($(this).val() == ''){
				
					var par = $(this).parents('.form-group').first();
					par.addClass('has-error');
					bool = false;
			
				 
				}
				else{
				
					var par = $(this).parents('.form-group').first();
					par.removeClass('has-error').addClass('has-success');
					
				}
						
				});
				
				$('input[type=number]').each(function(){
				if($(this).val() == ''){
					
					var par = $(this).parents('.form-group').first();
					par.addClass('has-error');
					bool = false;
			
				 
				}
				else{
					
					sum += parseInt($(this).val());
					var par = $(this).parents('.form-group').first();
					par.removeClass('has-error').addClass('has-success');
					
				}


				return false;
		
		
		
		});

	   


	  
   }); */