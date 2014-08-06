(function($) {


  $(document).ready(function() {
    $('ul.tabs.primary li a').click(function() {

      $('#comment-form .form-item input,#comment-form .form-item textarea').blur(function() {
        $(this).parent('.form-item').find('label').show('slide', 'fast');

      });

      $('#comment-form .form-item input,#comment-form .form-item textarea').focus(function() {
        $(this).parent('.form-item').find('label').hide('slide', 'fast');

      });

    });
  });



  $(document).ready(function() {



    // cache container
    var $IsoContainer = $('#portfolio');
    // initialize isotope

    $IsoContainer.isotope({
      // options...
      itemSelector: '.portf_item'
    });



    // filter items when filter link is clicked
    $('#filter a').click(function() {
      var selector = $(this).attr('data-filter');
      $IsoContainer.isotope({
        filter: selector
      });
      $('#filter a').removeClass('active');
      $(this).addClass('active');
      return false;
    });


    jQuery(".color_whell").toggle(function() {
      jQuery('#style-switcher').animate({ left: "0px"}, {duration: 300});
    }, function() {
      jQuery('#style-switcher').animate({left: "-358px"}, {duration: 300});
    });



  });


})(jQuery);