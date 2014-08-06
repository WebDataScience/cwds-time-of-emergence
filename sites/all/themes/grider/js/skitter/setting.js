(function($) {


  $(document).ready(function() {

    var options = {};

    if (document.location.search) {
      var array = document.location.search.split('=');
      var param = array[0].replace('?', '');
      var value = array[1];


    }

    $('.box_skitter_large').skitter(options);


  });

})(jQuery);