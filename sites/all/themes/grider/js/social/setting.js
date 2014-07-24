
(function($) {

  $(document).ready(function() {
    /* ---------- hover social network  ---------------- */



    //Set opacity on each span to 0%
    $(".fb-rollover").css({'opacity': '0', 'filter': 'alpha(opacity=0)'});

    $('.social_network a').hover(
            function() {
              $(this).find('.fb-rollover').stop().fadeTo(500, 1);
            },
            function() {
              $(this).find('.fb-rollover').stop().fadeTo(500, 0);
            }
    )

    //Set opacity on each span to 0%
    $(".twitter-rollover").css({'opacity': '0'});

    $('.social_network a').hover(
            function() {
              $(this).find('.twitter-rollover').stop().fadeTo(500, 1);
            },
            function() {
              $(this).find('.twitter-rollover').stop().fadeTo(500, 0);
            }
    )

    //Set opacity on each span to 0%
    $(".linkedin-rollover").css({'opacity': '0'});

    $('.social_network a').hover(
            function() {
              $(this).find('.linkedin-rollover').stop().fadeTo(500, 1);
            },
            function() {
              $(this).find('.linkedin-rollover').stop().fadeTo(500, 0);
            }
    )

    //Set opacity on each span to 0%
    $(".google-plus-rollover").css({'opacity': '0'});

    $('.social_network a').hover(
            function() {
              $(this).find('.google-plus-rollover').stop().fadeTo(500, 1);
            },
            function() {
              $(this).find('.google-plus-rollover').stop().fadeTo(500, 0);
            }
    )

    //Set opacity on each span to 0%
    $(".email-rollover").css({'opacity': '0'});

    $('.social_network a').hover(
            function() {
              $(this).find('.email-rollover').stop().fadeTo(500, 1);
            },
            function() {
              $(this).find('.email-rollover').stop().fadeTo(500, 0);
            }
    )
    //Set opacity on each span to 0%
    $(".rss-rollover").css({'opacity': '0'});

    $('.social_network a').hover(
            function() {
              $(this).find('.rss-rollover').stop().fadeTo(500, 1);
            },
            function() {
              $(this).find('.rss-rollover').stop().fadeTo(500, 0);
            }
    )

    /* ---------- hover social network gray  ---------------- */

    //Set opacity on each span to 0%
    $(".twitter-hover").css({'opacity': '0'});

    $('.followme a').hover(
            function() {
              $(this).find('.twitter-hover').stop().fadeTo(500, 1);
            },
            function() {
              $(this).find('.twitter-hover').stop().fadeTo(500, 0);
            }
    )
    //Set opacity on each span to 0%
    $(".linkedin-hover").css({'opacity': '0'});

    $('.followme a').hover(
            function() {
              $(this).find('.linkedin-hover').stop().fadeTo(500, 1);
            },
            function() {
              $(this).find('.linkedin-hover').stop().fadeTo(500, 0);
            }
    )
    //Set opacity on each span to 0%
    $(".fb-hover").css({'opacity': '0'});

    $('.followme a').hover(
            function() {
              $(this).find('.fb-hover').stop().fadeTo(500, 1);
            },
            function() {
              $(this).find('.fb-hover').stop().fadeTo(500, 0);
            }
    )
    //Set opacity on each span to 0%
    $(".google-plus-hover").css({'opacity': '0'});

    $('.followme a').hover(
            function() {
              $(this).find('.google-plus-hover').stop().fadeTo(500, 1);
            },
            function() {
              $(this).find('.google-plus-hover').stop().fadeTo(500, 0);
            }
    )
  });
})(jQuery);