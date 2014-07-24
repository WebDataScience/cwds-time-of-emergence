(function($) {

  $(document).ready(function() {
    $('.testimonials').list_ticker({
      speed: 5000,
      effect: 'fade'
    });
    $('#slide').list_ticker({
      speed: 5000,
      effect: 'slide'
    });
  })


})(jQuery);