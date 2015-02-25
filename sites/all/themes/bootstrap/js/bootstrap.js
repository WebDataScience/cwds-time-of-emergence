/**
 * @file
 * bootstrap.js
 *
 * Provides general enhancements and fixes to Bootstrap's JS files.
 */

var Drupal = Drupal || {};

(function($, Drupal){
  "use strict";

  Drupal.behaviors.bootstrap = {
    attach: function(context) {
      // Provide some Bootstrap tab/Drupal integration.
      $(context).find('.tabbable').once('bootstrap-tabs', function () {
        var $wrapper = $(this);
        var $tabs = $wrapper.find('.nav-tabs');
        var $content = $wrapper.find('.tab-content');
        var borderRadius = parseInt($content.css('borderBottomRightRadius'), 10);
        var bootstrapTabResize = function() {
          if ($wrapper.hasClass('tabs-left') || $wrapper.hasClass('tabs-right')) {
            $content.css('min-height', $tabs.outerHeight());
          }
        };
        // Add min-height on content for left and right tabs.
        bootstrapTabResize();
        // Detect tab switch.
        if ($wrapper.hasClass('tabs-left') || $wrapper.hasClass('tabs-right')) {
          $tabs.on('shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
            bootstrapTabResize();
            if ($wrapper.hasClass('tabs-left')) {
              if ($(e.target).parent().is(':first-child')) {
                $content.css('borderTopLeftRadius', '0');
              }
              else {
                $content.css('borderTopLeftRadius', borderRadius + 'px');
              }
            }
            else {
              if ($(e.target).parent().is(':first-child')) {
                $content.css('borderTopRightRadius', '0');
              }
              else {
                $content.css('borderTopRightRadius', borderRadius + 'px');
              }
            }
          });
        }
      });
    }
  };

  /**
   * Bootstrap Popovers.
   */
  Drupal.behaviors.bootstrapPopovers = {
    attach: function (context, settings) {
      if (settings.bootstrap && settings.bootstrap.popoverEnabled) {
        var elements = $(context).find('[data-toggle="popover"]').toArray();
        for (var i = 0; i < elements.length; i++) {
          var $element = $(elements[i]);
          var options = $.extend(true, {}, settings.bootstrap.popoverOptions, $element.data());
          $element.popover(options);
        }
      }
    }
  };

  /**
   * Bootstrap Tooltips.
   */
  Drupal.behaviors.bootstrapTooltips = {
    attach: function (context, settings) {
      if (settings.bootstrap && settings.bootstrap.tooltipEnabled) {
        var elements = $(context).find('[data-toggle="tooltip"]').toArray();
        for (var i = 0; i < elements.length; i++) {
          var $element = $(elements[i]);
          var options = $.extend(true, {}, settings.bootstrap.tooltipOptions, $element.data());
          $element.tooltip(options);
        }
      }
    }
  };

  /**
   * Anchor fixes.
   */
  var $scrollableElement = $();
  Drupal.behaviors.bootstrapAnchors = {
    attach: function(context, settings) {
      var i, elements = ['html', 'body'];
      if (!$scrollableElement.length) {
        for (i = 0; i < elements.length; i++) {
          var $element = $(elements[i]);
          if ($element.scrollTop() > 0) {
            $scrollableElement = $element;
            break;
          }
          else {
            $element.scrollTop(1);
            if ($element.scrollTop() > 0) {
              $element.scrollTop(0);
              $scrollableElement = $element;
              break;
            }
          }
        }
      }
      if (!settings.bootstrap || !settings.bootstrap.anchorsFix) {
        return;
      }
      var anchors = $(context).find('a').toArray();
      for (i = 0; i < anchors.length; i++) {
        if (!anchors[i].scrollTo) {
          this.bootstrapAnchor(anchors[i]);
        }
      }
      $scrollableElement.once('bootstrap-anchors', function () {
        $scrollableElement.on('click.bootstrap-anchors', 'a[href*="#"]:not([data-toggle],[data-target])', function(e) {
          this.scrollTo(e);
        });
      });
    },
    bootstrapAnchor: function (element) {
      element.validAnchor = element.nodeName === 'A' && (location.hostname === element.hostname || !element.hostname) && element.hash.replace(/#/,'').length;
      element.scrollTo = function(event) {
        var attr = 'id';
        var $target = $(element.hash);
        if (!$target.length) {
          attr = 'name';
          $target = $('[name="' + element.hash.replace('#', '') + '"');
        }
        var offset = $target.offset().top - parseInt($scrollableElement.css('paddingTop'), 10) - parseInt($scrollableElement.css('marginTop'), 10);
        if (this.validAnchor && $target.length && offset > 0) {
          if (event) {
            event.preventDefault();
          }
          var $fakeAnchor = $('<div/>')
            .addClass('element-invisible')
            .attr(attr, $target.attr(attr))
            .css({
              position: 'absolute',
              top: offset + 'px',
              zIndex: -1000
            })
            .appendTo(document);
          $target.removeAttr(attr);
          var complete = function () {
            location.hash = element.hash;
            $fakeAnchor.remove();
            $target.attr(attr, element.hash.replace('#', ''));
          };
          if (Drupal.settings.bootstrap.anchorsSmoothScrolling) {
            $scrollableElement.animate({ scrollTop: offset, avoidTransforms: true }, 400, complete);
          }
          else {
            $scrollableElement.scrollTop(offset);
            complete();
          }
        }
      };
    }
  };

})(jQuery, Drupal);




/**
 * jQuery Once Plugin v1.2
 * http://plugins.jquery.com/project/once
 *
 * Dual licensed under the MIT and GPL licenses:
 *   http://www.opensource.org/licenses/mit-license.php
 *   http://www.gnu.org/licenses/gpl.html
 */

(function ($) {
  var cache = {}, uuid = 0;

  /**
   * Filters elements by whether they have not yet been processed.
   *
   * @param id
   *   (Optional) If this is a string, then it will be used as the CSS class
   *   name that is applied to the elements for determining whether it has
   *   already been processed. The elements will get a class in the form of
   *   "id-processed".
   *
   *   If the id parameter is a function, it will be passed off to the fn
   *   parameter and the id will become a unique identifier, represented as a
   *   number.
   *
   *   When the id is neither a string or a function, it becomes a unique
   *   identifier, depicted as a number. The element's class will then be
   *   represented in the form of "jquery-once-#-processed".
   *
   *   Take note that the id must be valid for usage as an element's class name.
   * @param fn
   *   (Optional) If given, this function will be called for each element that
   *   has not yet been processed. The function's return value follows the same
   *   logic as $.each(). Returning true will continue to the next matched
   *   element in the set, while returning false will entirely break the
   *   iteration.
   */
  $.fn.once = function (id, fn) {
    if (typeof id != 'string') {
      // Generate a numeric ID if the id passed can't be used as a CSS class.
      if (!(id in cache)) {
        cache[id] = ++uuid;
      }
      // When the fn parameter is not passed, we interpret it from the id.
      if (!fn) {
        fn = id;
      }
      id = 'jquery-once-' + cache[id];
    }
    // Remove elements from the set that have already been processed.
    var name = id + '-processed';
    var elements = this.not('.' + name).addClass(name);

    return $.isFunction(fn) ? elements.each(fn) : elements;
  };

  /**
   * Filters elements that have been processed once already.
   *
   * @param id
   *   A required string representing the name of the class which should be used
   *   when filtering the elements. This only filters elements that have already
   *   been processed by the once function. The id should be the same id that
   *   was originally passed to the once() function.
   * @param fn
   *   (Optional) If given, this function will be called for each element that
   *   has not yet been processed. The function's return value follows the same
   *   logic as $.each(). Returning true will continue to the next matched
   *   element in the set, while returning false will entirely break the
   *   iteration.
   */
  $.fn.removeOnce = function (id, fn) {
    var name = id + '-processed';
    var elements = this.filter('.' + name).removeClass(name);

    return $.isFunction(fn) ? elements.each(fn) : elements;
  };
})(jQuery);

