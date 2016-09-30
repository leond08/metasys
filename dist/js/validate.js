$(function(){
		
		
		$('#btn_submit').click(function(){

		var bool = true;
			$('input').each(function(){
				if($(this).val() == ''){
				    var par = $(this).parents('.form-group').first();
					par.addClass('has-error');
					bool = false;
				}
			});
			
		
			if(!bool){
				$('.alert').fadeIn('fast').fadeOut(8000);
			}
			
			return bool;
			 
		});
		
		validateForm();
		

		
		function validateForm(){

				$('#event').focusout(function(){
				
				if( $('#event').val() == ''){
				
				
				  $('.form-group:nth-child(1)').addClass('has-error');
				  
				 
				}
				else{
					$('.form-group:nth-child(1)').removeClass('has-error').addClass('has-success');
					
				}
				});
				
				$('#date').focusout(function(){
				
				if( $('#date').val() == ''){
				
				
				  $('.form-group:nth-child(2)').addClass('has-error');
				
				}
				else{
					$('.form-group:nth-child(2)').removeClass('has-error').addClass('has-success');
					
				}
				});
				
				$('#venue').focusout(function(){
				
				if( $('#venue').val() == ''){
				
				
				  $('.form-group:nth-child(3)').addClass('has-error');
				
				}
				else{
					$('.form-group:nth-child(3)').removeClass('has-error').addClass('has-success');
					
				}
				});
				
				$('#participants').focusout(function(){
				
				if( $('#participants').val() == ''){
				
				
				  $('.form-group:nth-child(4)').addClass('has-error');
				  
				}
				else{
					$('.form-group:nth-child(4)').removeClass('has-error').addClass('has-success');
					
				}
				if( $('#fileUpload').val() == ''){
				
				
				  $('.form-group:nth-child(5)').addClass('has-error');
				  
				}
				else{
					$('.form-group:nth-child(5)').removeClass('has-error').addClass('has-success');
					
				}
				});
				
			}

		
		
	
});
	