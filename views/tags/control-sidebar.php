<script>
	 var t = false;
	  $(function(){
 			$('#formsubmit').submit(function() {
					return false;
				});
				
				$('#btn').click(function(e) {
					e.preventDefault();
					
					showLogin();
					$('input').val('');
					return false;
				});	
				
	  $('.account').change(function(){
				if(!t){
					
					
					$('.form1').show('fast');
					
					t  = true;
					
					
				} else {
					
					
					$('.form1').hide('fast');
				
					t = false;
					
					
				}
		});
	  
	  });
	   function showclock(){
		self.location = "logout.php";
	  }

 
	function showLogin(){

		var data = $('#formsubmit').serializeArray();
		$.post($('#formsubmit').attr('action'), data, function(json){
			
			if (json.status == "fail") {
			
				$('.alert').fadeIn('fast',function(){
					
					$(this).text(json.message);		
				
				});
				$('.alert').delay(2000).fadeOut('slow')
					
			}
			if(json.status == "success") {
				$('input').val('');
			$('.alert').fadeIn('fast',function(){
					
					$(this).text(json.message);		
				
				});
			$('.alert').delay(2000).fadeOut('slow')
			
			}
		}, "json");

	} 
	
	  </script>  

 <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
          <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <!-- Home tab content -->
          <!-- Stats tab content -->
         
          <!-- Settings tab content -->
          <div class="tab-pane active" id="control-sidebar-settings-tab">
   
              <h3 class="control-sidebar-heading text-center">Account Settings</h3>
			  <form method="post" action="updatePass.php" id="formsubmit">
			   <div class="form-group">
				
				<label class="control-sidebar-subheading">
                 Change account
                  <input type="checkbox" class="pull-right account">
                </label>
				<label class="control-sidebar-subheading">
				Lock screen
                  <input type="checkbox" class="pull-right lock" onclick="showclock()">
                </label>
				<div class="form1" style="display:none;">
                 Old Password
                 <input type="password" class="form-control" value="" name="oldpassword" id="oldpassword" placeholder="Old Password">
                 New Password
                 <input type="password" class="form-control" value="" name="newpassword" id="newpassword" placeholder="New Password">
				 <br>
				  <div class="alert alert-danger" style="display:none;">
				                      </div>
				 <button id="btn" type="submit" class="btn btn-primary pull-right ">Save</button>
				 <br>
                
				</div>
              </div><!-- /.form-group -->
			 </form>
          
          </div><!-- /.tab-pane -->
        </div>
      </aside><!-- /.control-sidebar -->
 	  