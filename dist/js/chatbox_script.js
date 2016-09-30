$(document).ready(function(){
	var FREQ = 1000;
	var notif= true;
	
	getMessages();
	
	startCall();
	

	
	$("#min").click(function(e){
		e.preventDefault();
		$("#chatbox").slideUp("fast");
		$("#min_chatbox").slideDown("fast");
	});
	$("#min_online").click(function(e){
		e.preventDefault();
		$("#online_box").slideUp("fast");
		$("#min_chatbox_online").slideDown("fast");
	});
	$(".maximize").click(function(){
		$("#chatbox").slideDown("fast");
		$("#min_chatbox").slideToggle("fast");
		$(".chat_window").animate({ scrollTop: $('.chat_window')[0].scrollHeight},1000);
	});
	$(".maximize_online").click(function(){
		$("#online_box").slideDown("fast");
		$("#min_chatbox_online").slideToggle("fast");
	});
	$("#send").click(function(){
		$(".chat_window").animate({ scrollTop: $('.chat_window')[0].scrollHeight},1000);
	});
	$(".dropdown-toggle").click(function(){
		$('.notif').empty();
		
	});
	
function getMessages(){
		
		$.getJSON("getUpdateJudge.php?action=getMessage", function(json) {
			if (json.msg.length > 0) {
			
					$('.menu').empty();
					$('.notif').empty();
					//$('.notif').append('NEW');
				$.each(json.msg,function() {
					var chatmate = '<p style="margin-left:13px;"><a href="#"><i class="fa fa-users text-aqua"></i> '+this['judge_name']+' has cast his vote in '+this['crit_name']+' </a></p>';
					
					
					$('.menu').append(chatmate);
					
				});
			
		
			}else {
				$('.notif').empty();
			}
		});
		
	}

function startCall(){
	setTimeout(function() {
					//$(".chat_window").animate({ scrollTop: $('.chat_window').scrollHeight},1000);
					getMessages();
					startCall();
				}, 	
				FREQ
	);
	
}	
	
});