$(document).ready(function(){ 
 /* ---------- hover partners  ---------------- */



    //Set opacity partner1 to 0%
    $(".partner1-hover").css({'opacity':'0','filter':'alpha(opacity=0)'});

	$('.partners a').hover(
		function() {
			$(this).find('.partner1-hover').stop().fadeTo(500, 1);
		},
		function() {
			$(this).find('.partner1-hover').stop().fadeTo(500, 0);
		}
	)
	
    //Set opacity partner2 to 0%
    $(".partner2-hover").css({'opacity':'0','filter':'alpha(opacity=0)'});

	$('.partners a').hover(
		function() {
			$(this).find('.partner2-hover').stop().fadeTo(500, 1);
		},
		function() {
			$(this).find('.partner2-hover').stop().fadeTo(500, 0);
		}
	)	

    //Set opacity partner3 to 0%
    $(".partner3-hover").css({'opacity':'0','filter':'alpha(opacity=0)'});

	$('.partners a').hover(
		function() {
			$(this).find('.partner3-hover').stop().fadeTo(500, 1);
		},
		function() {
			$(this).find('.partner3-hover').stop().fadeTo(500, 0);
		}
	)

    //Set opacity partner4 to 0%
    $(".partner4-hover").css({'opacity':'0','filter':'alpha(opacity=0)'});

	$('.partners a').hover(
		function() {
			$(this).find('.partner4-hover').stop().fadeTo(500, 1);
		},
		function() {
			$(this).find('.partner4-hover').stop().fadeTo(500, 0);
		}
	)

    //Set opacity partner5 to 0%
    $(".partner5-hover").css({'opacity':'0','filter':'alpha(opacity=0)'});

	$('.partners a').hover(
		function() {
			$(this).find('.partner5-hover').stop().fadeTo(500, 1);
		},
		function() {
			$(this).find('.partner5-hover').stop().fadeTo(500, 0);
		}
	)
	
});		