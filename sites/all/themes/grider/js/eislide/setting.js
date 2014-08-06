(function($) {


  $(document).ready(function() {
    $('#ei-slider').eislideshow({
      animation: 'center',
      autoplay: true,
      slideshow_interval: 6000,
      // speed for the sliding animation
      speed: 800,
      // easing for the sliding animation
      easing: '',
      // percentage of speed for the titles animation.
      // Speed will be speed * titlesFactor
      titlesFactor: 0.60,
      // titles animation speed
      titlespeed: 800
    });
  });

})(jQuery);
