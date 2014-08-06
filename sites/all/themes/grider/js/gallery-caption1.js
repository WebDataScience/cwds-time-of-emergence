 /* --- Caption Gallery --- */
 
$(document).ready(function(){
			//To switch directions up/down and left/right just place a "-" in front of the top/left attribute
			//Full Caption Sliding (Hidden to Visible)
			$('.last-project li').hover(function(){
				$(".cover", this).stop().animate({top:'0px'},{queue:false,duration:160});
			}, function() {
				$(".cover", this).stop().animate({top:'90px'},{queue:false,duration:160});
			});
		});