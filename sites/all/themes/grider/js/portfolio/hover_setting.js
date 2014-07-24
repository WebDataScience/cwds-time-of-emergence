(function ($) {
  
  
$(document).ready(function(){ 

/* =========== Caption portfolio hover=========== */

/* ---- Portfolio 4 column --- */


			//To switch directions up/down and left/right just place a "-" in front of the top/left attribute
			//Full Caption Sliding (Hidden to Visible)
			$('.portfolio-4column li').hover(function(){
				$(".cover", this).stop().animate({top:'0px'},{queue:false,duration:580});
			}, function() {
				$(".cover", this).stop().animate({top:'90px'},{queue:false,duration:580});
			});


/* ---- Portfolio 3 column --- */


			//To switch directions up/down and left/right just place a "-" in front of the top/left attribute
			//Full Caption Sliding (Hidden to Visible)
			$('.portfolio-3column li').hover(function(){
				$(".cover", this).stop().animate({top:'0px'},{queue:false,duration:580});
			}, function() {
				$(".cover", this).stop().animate({top:'135px'},{queue:false,duration:580});
			});
		
	
/* ---- Portfolio 2 column --- */
	

			//To switch directions up/down and left/right just place a "-" in front of the top/left attribute
			//Full Caption Sliding (Hidden to Visible)
			$('.portfolio-2column li').hover(function(){
				$(".cover", this).stop().animate({top:'0px'},{queue:false,duration:580});
			}, function() {
				$(".cover", this).stop().animate({top:'135px'},{queue:false,duration:580});
			});

});		
  
})(jQuery);