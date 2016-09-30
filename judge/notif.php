 
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   

    <title>Meta | Lock</title>

    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="../assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="../assets/css/style-responsive.css" rel="stylesheet">
	
   
  </head>

  <body onload="getTime()">
		
  		<?php session_start();?>
	  <div class="container"> 
	 <h1 style="margin-bottom:-200px;margin-top:100px;color:#fff;display:none;"class="text-center">Please wait for the announcement of winners</h1>
	 <div id="showtime"></div>

	 <script type="text/javascript">
	 	
	 	set();

	 	function set(){

	 		setTimeout(function(){
	 			getShow(<?php echo $_SESSION['event_id'];?>);
	 			// alert(<?php //echo $_SESSION['event_id'];?>);
	 			set();
	 	 }, 1000);}
	 	

	 	function getShow(val){
          	

          	var data = new XMLHttpRequest();
				data.open("POST", "../controller.php?action=get_show", true);
				data.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				data.onreadystatechange = function() {
				
				if (data.readyState == 4 && data.status == 200) {
					
					var dataArray = data.responseText.split("||");
							
							
 							for(var i =  0;i<dataArray.length - 1;i++){
							var item = dataArray[i].split("|");
							var name = item[0];
							//alert(name);
							if(name == 'YES'){
								location.href='showscore.php';
							}
						}
					
					}
				}	

					var url = "id="+val;
					
					data.send(url);


        }

	 		
	 	
	 </script>

	 </div>

   	<script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
	
 
    <script type="text/javascript" src="../assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("../dist/img/bg.jpg", {speed: 500});
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
