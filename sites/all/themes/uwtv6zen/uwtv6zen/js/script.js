/**
 * @file
 * A JavaScript file for the theme.
 *
 * In order for this JavaScript to be loaded on pages, see the instructions in
 * the README.txt next to this file.
 */

// JavaScript should be made compatible with libraries other than jQuery by
// wrapping it with an "anonymous closure". See:
// - http://drupal.org/node/1446420
// - http://www.adequatelygood.com/2010/3/JavaScript-Module-Pattern-In-Depth
(function ($, Drupal, window, document, undefined) {

// This toggles the menu checkboxes which are used in the mobile display/layout
/*Drupal.behaviors.RENAMEME = {
  attach: function (context, settings) {

  },
  detach: function (context, settings) { }
};*/


// Add the title of a jQuery UI tab to the top of the content when printing.
Drupal.behaviors.tabPrintTitles = {
  attach: function (context, settings) {
   $(".tab-container ul li a").each(function(index){
      // If the href attribute starts with a #
      if($(this).attr("href")) {
        if ($(this).attr("href").search("#") === 0) {
          var href = $(this).attr("href");
          var id = href.replace("#","");
          var text = $(this).text();
          var heading = '<h2 class="print-only">' + text + '</h2>';
          $("#"+id).prepend(heading);
        }
      }
     

   });
  },
  detach: function (context, settings) { }
};

})(jQuery, Drupal, this, this.document);
