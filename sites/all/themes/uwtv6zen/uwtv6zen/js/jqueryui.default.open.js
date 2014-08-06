jQuery(document).ready(function ($) {

   
    var defaultPanel = parseInt(getParam('panel'));
    // Accordion with auto scroll
    jQuery(".accordion-container.autoscroll").accordion({
        autoHeight:false,
        collapsible:true,
        active:defaultPanel,
        change: function( event, ui){ // Autoscroll callback
          _scrollToElement(event, ui);
        }
      });
    // Accordion with NO auto scroll

    jQuery(".accordion-container").accordion({
        autoHeight:false,
        collapsible:true,
        active:defaultPanel
      });

    var defaultTab = parseInt(getParam('tab'));
    jQuery(".tab-container").tabs({
        selected:defaultTab
        });

    function getParam(name) {
        var query = location.search.substring(1);
        if (query.length) {
            var parts = query.split('&');
            for (var i = 0; i < parts.length; i++) {
                var pos = parts[i].indexOf('=');
                if (parts[i].substring(0,pos) == name) {
                    return parts[i].substring(pos+1);
                }
            }
        }
        // No query has been detected, this is the default
        if(name == 'tab') {
          return 0;
        }else{
          return -1;
        }
    }

// Helper callback that moves scrolls the window to the clicked on accordion
//  container.
function _scrollToElement(event, ui) {
  if(jQuery(ui.newHeader).offset()){
    jQuery('html, body').animate({
      scrollTop: jQuery(ui.newHeader).offset().top
      }, 1000);
    }
  }
});
