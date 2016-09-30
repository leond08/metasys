<script>
	 var t = false;
	  $(function(){
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
		self.location = "lock_screen.html";
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
			   <div class="form-group">
				
				<label class="control-sidebar-subheading">
                 Change account
                  <input type="checkbox" class="pull-right account">
                </label>
				<label class="control-sidebar-subheading">
                Show clock
                  <input type="checkbox" class="pull-right" onclick="showclock()">
                </label>
				<div class="form1" style="display:none;">
                 Username
                 <input type="text" class="form-control" value="" name="username" id="username">
                 Old Password
                 <input type="text" class="form-control" value="" name="oldpassword" id="oldpassword">
                 New Password
                 <input type="text" class="form-control" value="" name="newpassword" id="newpassword">
				 <br>
				 <button type="button" class="btn btn-flat btn-primary btn-xs pull-right ">Save</button>
				 <br>
                <p>
                
                </p>
				</div>
              </div><!-- /.form-group -->

          
          </div><!-- /.tab-pane -->
        </div>
      </aside><!-- /.control-sidebar -->
 	  