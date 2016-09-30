<?php 
session_start();
	if(isset($_SESSION['pass'])){
		
		header('location:dashboard.php');
	
	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   

    <title>Meta | Lock</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
	
   
  </head>

  <body onload="getTime()">
		
    

	  	<div class="container">
	<!--<h1 style="margin-bottom:-200px;margin-top:100px;color:#fff;display:none;"class="text-center">I LOVE METASYS</h1>-->
			 <p class="centered"><img style="margin-bottom:-200px;margin-top:100px;" width="150" src="dist/img/logo.png"></p>
	  		<div id="showtime"></div>
				
	  			<div class="col-lg-4 col-lg-offset-4">
	  				<div class="lock-screen">
		  				<h2><a data-toggle="modal" href="#myModal"><i class="fa fa-lock"></i></a></h2>
		  				<p>UNLOCK</p>
		  				
				          <!-- Modal -->
						   <form role="form" class="form-login" method="post" action="login.php" id="formsubmit">
							<input type="hidden" name="action" value="formsubmit"/>
				          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
						  
				              <div class="modal-dialog">
				                  <div class="modal-content">
				                      <div class="modal-header">
				                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                          <h4 class="modal-title">Welcome Admin</h4>
				                      </div>
				                      <div class="modal-body">
				                          <p class="centered"><img class="img-circle" width="80" src="dist/img/logo.png"></p>
				                          <input type="password" name="password" placeholder="Password" autocomplete="off" class="form-control placeholder-no-fix"><br>
									  <div class="alert alert-danger" style="display:none;">
				                      </div>
				                      <div class="modal-footer centered">
				                          
				                          <button class="btn btn-theme03" type="submit" id="btn">Login</button>
				                      </div>
				                  </div>
				              </div>
							
				          </div>
						  </form>
				          <!-- modal -->
		  				
		  				
	  				</div><! --/lock-screen -->
	  			</div><!-- /col-lg-4 -->
	  	
	  	</div><!-- /container -->

   
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
	
 
    <script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("dist/img/bg.jpg", {speed: 500});
    </script>

    <script>
		
        function getTime()
        {
            var today=new Date();
            var h=today.getHours();
            var m=today.getMinutes();
            var s=today.getSeconds();
            // add a zero in front of numbers<10
            m=checkTime(m);
            s=checkTime(s);
            document.getElementById('showtime').innerHTML=h+":"+m+":"+s;
            t=setTimeout(function(){getTime()},500);
        }

        function checkTime(i)
        {
            if (i<10)
            {
                i="0" + i;
            }
            return i;
        }
    </script>
	<script>
		$(function(){
			slide();
			function slide(){
				$('h1').delay(300).slideToggle('slow');
			}
			$('#btn').click(function(e) {
				e.preventDefault();
			
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

  </body>
</html>
