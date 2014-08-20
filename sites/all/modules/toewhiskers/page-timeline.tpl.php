<?php

// Error reporting code
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

/**
 * @file
 * Zen theme's implementation to display a single Drupal page.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $secondary_menu_heading: The title of the menu used by the secondary links.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['header']: Items for the header region.
 * - $page['navigation']: Items for the navigation region, below the main menu (if any).
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['footer']: Items for the footer region.
 * - $page['bottom']: Items to appear at the bottom of the page below the footer.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see zen_preprocess_page()
 * @see template_process()
 */
?>
<!-- toewhiskers/page-timeline.tpl.php-->

<style>    
		h4 {
			text-align: center;
		}  
  	hr {
			max-width: 915px;
			margin: 0;
		} 
</style>
<div class="timeline-thumbnail"><img src="/sites/all/modules/toewhiskers/images/kingcounty200x200.png"></img></div>
<h2>Multi-Model Median Time of Emergence for <span class="region">King County</span> under <span class="emission"></span></h2>
  <p>    
  Confidence: <span class="confidence"></span><br/>
  Tolerance: <span class="tolerance"></span><br/>
  Dataset: <span class="dataset"></span>
  </p>
<div id="chartmessage"></div>
<div id="horizontal-bar-chart"></div>
<div id="timeline-chart"></div> 

<div>
  <canvas id="svg-canvas" style="display:none"></canvas> 
  <a id="svg-img-wrapper" href="" download="timeline.png">
    <!--<button id="print-button" type="button">Save</button>-->
    <input id="print-button" name="op" value="Export Timeline Image" class="form-submit" type="submit">
    <img style="display:none" id="svg-img"></img>
  </a>  
</div>

  
<div id="range-revise-wrapper">
  <div id="toe-range">
  
  <h2>Projected Range of Time of Emergence for <span class="region">King County</span> under <span class="emission"></span> </h2>
    <p>
      <table id="tabledata">
      <th>Hydro-climatic Variable</th><th>ToE Range</th><th>Direction of Change</th>
      <!--<tr><td>Variable Shortname (Column G)</td><td>{Year A} – {Year B}</td><td>ChangeDir (Column C)</td></tr>
      <tr><td>Tmax>90degF(32.2degC)</td><td>2045 - 2065</td><td>Negative</td></tr>-->
      <span class="tablerows"></span>
      </table>
    </p>
  
 </div> 
    <div id="toe-revise">  
      <h2>Revise and recalculate</h2>
      <div class="h-form">
        <?php print $parameterform; ?><br/>
      <div style="clear:both"></div>
    </div>
  </div>  
</div>
    
        
    
<script type="text/javascript" src="http://canvg.googlecode.com/svn/trunk/rgbcolor.js"></script> 
<script type="text/javascript" src="http://canvg.googlecode.com/svn/trunk/StackBlur.js"></script>
<script type="text/javascript" src="http://canvg.googlecode.com/svn/trunk/canvg.js"></script> 
    
<script type="text/javascript">

jQuery( document ).ready(function( $ ) {

  $('#print-button').click(function(){
    // Find existing svg content.
    var $container = $('#timeline-chart');
    var content = $container.html().trim();
    // Prep and draw to canvas with canfg() function.
    var canvas = document.getElementById('svg-canvas');
    canvg(canvas, content);
    // Pull canvas content as .png data.
    var theImage = canvas.toDataURL('image/png');
    // Populate some html elements with the image content.
    $('#svg-img').attr('src', theImage);
    $('#svg-img-wrapper').attr('href', theImage);
  });
  
});
</script>

