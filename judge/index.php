<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Meta | Log in</title>

    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../dist/css/font-awesome.min.css">
    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="../assets/css/style-responsive.css" rel="stylesheet">
	<script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
	<script src="ajaxlogin.js"></script>
	<script type="text/javascript" src="../plugins/jquery.backstretch.min.js"></script>
	
	
    
  </head>

<body>

		<div id="login-page">
	  	<div class="container">
	  	
			 <form role="form" class="form-login" method="post" action="login.php" id="formsubmit">
		      <input type="hidden" name="action" value="formsubmit"/>
		        <h2 class="form-login-heading"><i class="fa fa-lock"></i>&nbsp;sign in now</h2>
		        <div class="login-wrap">
		         
		            <input type="text" class="form-control" placeholder="Judge ID" id="uname" name="id" autocomplete="off" autofocus>
		            <br>
					<div class="alert alert-danger text-center" style="display:none;">
					</div>
		            <button class="btn btn-theme btn-block btn-flat" type="submit"><i class="fa fa-lock"></i> SIGN IN</button>
		            </div>

		        </div>
		      </form>	  	
	  	
	  	</div>

    

    <script>
        $.backstretch("../assets/img/login-bg.jpg", {speed: 500});
    </script>
	
	
  </body>
</html>
