<?php
/**
 * @file
 * Contains the theme's functions to manipulate Drupal's default markup.
 *
 * A QUICK OVERVIEW OF DRUPAL THEMING
 *
 *   The default HTML for all of Drupal's markup is specified by its modules.
 *   For example, the comment.module provides the default HTML markup and CSS
 *   styling that is wrapped around each comment. Fortunately, each piece of
 *   markup can optionally be overridden by the theme.
 *
 *   Drupal deals with each chunk of content using a "theme hook". The raw
 *   content is placed in PHP variables and passed through the theme hook, which
 *   can either be a template file (which you should already be familiary with)
 *   or a theme function. For example, the "comment" theme hook is implemented
 *   with a comment.tpl.php template file, but the "breadcrumb" theme hooks is
 *   implemented with a theme_breadcrumb() theme function. Regardless if the
 *   theme hook uses a template file or theme function, the template or function
 *   does the same kind of work; it takes the PHP variables passed to it and
 *   wraps the raw content with the desired HTML markup.
 *
 *   Most theme hooks are implemented with template files. Theme hooks that use
 *   theme functions do so for performance reasons - theme_field() is faster
 *   than a field.tpl.php - or for legacy reasons - theme_breadcrumb() has "been
 *   that way forever."
 *
 *   The variables used by theme functions or template files come from a handful
 *   of sources:
 *   - the contents of other theme hooks that have already been rendered into
 *     HTML. For example, the HTML from theme_breadcrumb() is put into the
 *     $breadcrumb variable of the page.tpl.php template file.
 *   - raw data provided directly by a module (often pulled from a database)
 *   - a "render element" provided directly by a module. A render element is a
 *     nested PHP array which contains both content and meta data with hints on
 *     how the content should be rendered. If a variable in a template file is a
 *     render element, it needs to be rendered with the render() function and
 *     then printed using:
 *       <?php print render($variable); ?>
 *
 * ABOUT THE TEMPLATE.PHP FILE
 *
 *   The template.php file is one of the most useful files when creating or
 *   modifying Drupal themes. With this file you can do three things:
 *   - Modify any theme hooks variables or add your own variables, using
 *     preprocess or process functions.
 *   - Override any theme function. That is, replace a module's default theme
 *     function with one you write.
 *   - Call hook_*_alter() functions which allow you to alter various parts of
 *     Drupal's internals, including the render elements in forms. The most
 *     useful of which include hook_form_alter(), hook_form_FORM_ID_alter(),
 *     and hook_page_alter(). See api.drupal.org for more information about
 *     _alter functions.
 *
 * OVERRIDING THEME FUNCTIONS
 *
 *   If a theme hook uses a theme function, Drupal will use the default theme
 *   function unless your theme overrides it. To override a theme function, you
 *   have to first find the theme function that generates the output. (The
 *   api.drupal.org website is a good place to find which file contains which
 *   function.) Then you can copy the original function in its entirety and
 *   paste it in this template.php file, changing the prefix from theme_ to
 *   uwtv6zen_. For example:
 *
 *     original, found in modules/field/field.module: theme_field()
 *     theme override, found in template.php: uwtv6zen_field()
 *
 *   where uwtv6zen is the name of your sub-theme. For example, the
 *   zen_classic theme would define a zen_classic_field() function.
 *
 *   Note that base themes can also override theme functions. And those
 *   overrides will be used by sub-themes unless the sub-theme chooses to
 *   override again.
 *
 *   Zen core only overrides one theme function. If you wish to override it, you
 *   should first look at how Zen core implements this function:
 *     theme_breadcrumbs()      in zen/template.php
 *
 *   For more information, please visit the Theme Developer's Guide on
 *   Drupal.org: http://drupal.org/node/173880
 *
 * CREATE OR MODIFY VARIABLES FOR YOUR THEME
 *
 *   Each tpl.php template file has several variables which hold various pieces
 *   of content. You can modify those variables (or add new ones) before they
 *   are used in the template files by using preprocess functions.
 *
 *   This makes THEME_preprocess_HOOK() functions the most powerful functions
 *   available to themers.
 *
 *   It works by having one preprocess function for each template file or its
 *   derivatives (called theme hook suggestions). For example:
 *     THEME_preprocess_page    alters the variables for page.tpl.php
 *     THEME_preprocess_node    alters the variables for node.tpl.php or
 *                              for node--forum.tpl.php
 *     THEME_preprocess_comment alters the variables for comment.tpl.php
 *     THEME_preprocess_block   alters the variables for block.tpl.php
 *
 *   For more information on preprocess functions and theme hook suggestions,
 *   please visit the Theme Developer's Guide on Drupal.org:
 *   http://drupal.org/node/223440 and http://drupal.org/node/1089656
 */


/**
 * Override or insert variables into the maintenance page template.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("maintenance_page" in this case.)
 */
/* -- Delete this line if you want to use this function
function uwtv6zen_preprocess_maintenance_page(&$variables, $hook) {
  // When a variable is manipulated or added in preprocess_html or
  // preprocess_page, that same work is probably needed for the maintenance page
  // as well, so we can just re-use those functions to do that work here.
  uwtv6zen_preprocess_html($variables, $hook);
  uwtv6zen_preprocess_page($variables, $hook);
}
// */

/**
 * Override or insert variables into the html templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("html" in this case.)
 */

function uwtv6zen_preprocess_html(&$variables, $hook) {
  
  // Adding the trumba spud code for calendars  
  $options = array();
  $options['type'] = 'external';
  $options['scope'] = 'header';
  drupal_add_js('http://www.trumba.com/scripts/spuds.js', $options);

  // Adding the GreenSock Animation Platform library.
  // http://www.greensock.com/get-started-js/
  drupal_add_js('http://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenMax.min.js', $options);

  // Adding jquery ui fanciness
  drupal_add_library('system', 'ui.tabs');
  drupal_add_library('system', 'ui.accordion');
  drupal_add_library('system', 'ui.button');
  drupal_add_js('sites/all/themes/uwtv6zen/js/jqueryui.default.open.js', 'file');
  drupal_add_js ( 'jQuery(document).ready(function(){
                     jQuery("a.faux-button").button();
                   });' , 'inline' );

  // The body tag's classes are controlled by the $classes_array variable. To
  // remove a class from $classes_array, use array_diff().
  
  // Put the section class in the body 'section-###' where ### is the term id.ß
  $obj = menu_get_object();
  if (isset($obj->workbench_access) && count($obj->workbench_access)) {
    $wbid = reset($obj->workbench_access);
    $variables['classes_array'][] = 'section-' . $wbid;
  }
  
  // make the 'section_menu' region turn the content into columns
  if (isset($variables['page']['section_menu'])) {
    $variables['classes_array'] = array_diff($variables['classes_array'], array('no-sidebars'));
    $variables['classes_array'][] = 'one-sidebar';
    $variables['classes_array'][] = 'sidebar-first';
  }

  //$variables['classes_array'] = array_diff($variables['classes_array'], array('class-to-remove'));
}
// */

/**
 * Override or insert variables into the page templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("page" in this case.)
 */

function uwtv6zen_preprocess_page(&$variables, $hook) {
  // Get the Shibboleth authentication link
  $shiblink = _get_shiblink();
  $variables['shiblink'] = $shiblink;
  
  // Generate a link to the users page
  $userlink = _get_userlink();
  $variables['userlink'] = $userlink;

  // Get the Home/site links for the current site
  $node = NULL;
  if(isset($variables['node'])){
    $node = $variables['node'];
  }
  $sitelinks = _get_site_links($node);
  
  // Send the Home/site links to the templates
  $variables['patch'] = $sitelinks['patch'];
  $variables['wordmark'] = $sitelinks['wordmark'];
  if(isset($sitelinks['site_home'])) {
    $variables['site_home'] = $sitelinks['site_home'];
  }
  
  // Add the frontpage javascript to the frontpage.
  if($variables['is_front'] === TRUE) {
    $options = array(
      'group' => JS_THEME,
        );
    drupal_add_js(drupal_get_path('theme', 'uwtv6zen'). '/js/uwt-frontpage.js', $options);
  }
  // Display the nid and link to this node for the convenience of publishers and contributors.
  if(isset($node) && !empty($node)){
    global $user;
    $ur = array_values($user->roles);
    $rtc = array('Publisher', 'Contributor', 'admin');
    $check = array_intersect($ur, $rtc);
    $show_link = empty($check) ? FALSE : TRUE;
    if($show_link){
      $link_info = array();
      $link_info['nid'] = $node->nid;
      $link_info['href'] = '/node/' . $node->nid;
      $variables['link_info'] = $link_info;
    }
  }
  // Specify custom 403 template.
  $header = drupal_get_http_header("status");
  if($header == "403 Forbidden") {
    $variables['theme_hook_suggestions'][] = 'page__403';
  }
}


/**
* Create a specially formateed Shibboleth link. This link points to the
*   shibby login module and redirects to r.php, which then redirects to the
*   location that the user was on when the shibby login link was clicked.
*
* This exists because there is bug in the Drupal Shibby module that doesn't
*   set the session properly for the first page load.
*   @see https://drupal.org/node/1430242#comment-7775603
*/
function _get_shiblink() {
  if (module_exists('shib_auth') && module_exists('uwtloginmods') && !user_is_logged_in()) {
    module_load_include('module', 'uwtloginmods');
    $shiblink = _uwtloginmods_get_shiblink();
    return $shiblink;
  }else{
    return '';
  }
}

/**
* Create a link to the users page. Also create a logout link.
*/
function _get_userlink() {
  $userlink = '';
  if(user_is_logged_in()) {
    global $user;
    $userlink = l($user->name, 'user/' . $user->uid);
    $userlink .= '&nbsp;|&nbsp;';
    $userlink .= l('Logout', 'user/logout');
  }
  return $userlink;
}

/**
 * Add several containers to the menu links so that they can be properly 
 *   centered horizontally and vertically and support CSS3 flyout menus.
 */
function uwtv6zen_menu_link(array $variables) {
  $element = $variables['element'];
  $sub_menu = '';


  $hide_all_children = FALSE;
  if(isset($element['#localized_options']['hide_all_children']) && $element['#localized_options']['hide_all_children'] == 1){
    $hide_all_children = TRUE;
    $element['#attributes']['class'] = array_diff($element['#attributes']['class'], array('expanded', 'is-expanded'));
  }

  if ($element['#below'] && $hide_all_children == FALSE) {
    $sub_menu = drupal_render($element['#below']);
  }
  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  


  $ret ='<li' . drupal_attributes($element['#attributes']) . '>'; 
  $ret .= '<div class="outerContainer">';
  $ret .= '<div class="innerContainer">';
  $ret .= '<div class="element">';
  $ret .= $output . $sub_menu;
  $ret .= "</div></div></div>";
  $ret .= "</li>\n";
  return $ret;
}

/**
 * Returns an array of HTML snippets for the Patch link, Text-logo link, and 
 * site home link.
 * 
 */
function _get_site_links($node){
  /**
  * The point of this custom template file is to insert the patch and 
  * wordmark on any site that uses this theme, irrespective of
  * the presence of a block of content or whatever.
  * If a site uses the uwt_v6 theme, it will have the patch and wordmark. 
  * Period.
  */

  $links = array();

  // create link to UWT Home
  $path = '<front>';
  $href = url($path);

  $patch_link = '<a href="' . $href . '">';
  $patch_link .= '<span class="graphics-uwt_logo_patch"><span class="element-invisible">UW Tacoma patch icon</span></span>';
  $patch_link .= '</a>';

  $patch_link .= '<a href="' . $href . '">';
  $patch_link .= '<span class="graphics-uwt_logo_patch_narrow"><span class="element-invisible">UW Tacoma patch icon</span></span>';
  $patch_link .= '</a>';

  // Printed page patch
  $patchvars = array(
    'path' => path_to_theme() . '/images/graphics/uwt_logo_patch.png',
    'alt' => 'UWT Home Link',
    'attributes' => array(
      'class' => 'print-only'),
  );
  
  $patch_link .= '<a href="' . $href . '">';
  $patch_link .= theme('image', $patchvars);
  $patch_link .= '</a>';

  $links['patch'] = $patch_link;

  // Front page wordmark
  $wordmark_link = '<a href="' . $href . '">';
  $wordmark_link .= '<span class="graphics-uwt_wordmark_front"><span class="element-invisible">University of washington | Tacoma</span></span>';
  $wordmark_link .= '</a>';

  // Sub page wordmark
  $wordmark_link .= '<a href="' . $href . '">';
  $wordmark_link .= '<span class="graphics-uwt_wordmark_not_front"><span class="element-invisible">University of washington | Tacoma</span></span>';
  $wordmark_link .= '</a>';

  // Printed page patch
  $wordmarkhvars = array(
    'path' => path_to_theme() . '/images/graphics/uwt_wordmark_not_front.png',
    'alt' => 'University of Washington | Tacoma',
    'attributes' => array(
      'class' => 'print-only'),
  );
  
  $wordmark_link .= '<a href="' . $href . '">';
  $wordmark_link .= theme('image', $wordmarkhvars);
  $wordmark_link .= '</a>';

  // Wordmark for narrow screens (mobile)
  $wordmark_link .= '<a href="' . $href . '">';
  $wordmark_link .= '<span class="graphics-uwt_wordmark_narrow"><span class="element-invisible">University of washington | Tacoma</span></span>';
  $wordmark_link .= '</a>';

  $links['wordmark'] = $wordmark_link;
  
  // Get the link to the site home
  // Not all sites using the UWTv6Zen theme will use the field_site field,
  //  so check for it.
  if($node && module_exists('entity') && isset($node->field_site)){
    // Get the menu name for the site of this page.
    $wrapper = entity_metadata_wrapper('node', $node);
    // Make sure we have a term, then get the menu for the term
    if(isset($wrapper->field_site->value()->tid)){
      $siteid = $wrapper->field_site->value()->tid;
      // Get the menu name as defined in the GUI at taxonomy/term/<tid>/edit
      module_load_include('module', 'uwt_menu_admin');
      $menu = _uwt_menu_admin_get_site_menu_by_tid($siteid);
      // Get the menu tree 
      $menu_tree = reset(menu_tree($menu));
      // Create the site home link.
      $site_home_link = '';
      if(isset($menu_tree['#title']) && isset($menu_tree['#href'])){
        $label = $menu_tree['#title'];
        $href = $menu_tree['#href'];
        $options = array('attributes' => array('class' => 'site-home-link'));
        $site_home_link = '<span id="site-home-link">';
        $site_home_link .= l($label, $href);
        $site_home_link .= '</span>';
        $links['site_home'] = $site_home_link;
      }
    }
  }
  return $links;
}



/**
 * Override or insert variables into the node templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("node" in this case.)
 */
/* -- Delete this line if you want to use this function
function uwtv6zen_preprocess_node(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');

  // Optionally, run node-type-specific preprocess functions, like
  // uwtv6zen_preprocess_node_page() or uwtv6zen_preprocess_node_story().
  $function = __FUNCTION__ . '_' . $variables['node']->type;
  if (function_exists($function)) {
    $function($variables, $hook);
  }
}
// */

/**
 * Override or insert variables into the comment templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("comment" in this case.)
 */
/* -- Delete this line if you want to use this function
function uwtv6zen_preprocess_comment(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the region templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("region" in this case.)
 */
/* -- Delete this line if you want to use this function
function uwtv6zen_preprocess_region(&$variables, $hook) {
  // Don't use Zen's region--sidebar.tpl.php template for sidebars.
  //if (strpos($variables['region'], 'sidebar_') === 0) {
  //  $variables['theme_hook_suggestions'] = array_diff($variables['theme_hook_suggestions'], array('region__sidebar'));
  //}
}
// */

/**
 * Override or insert variables into the block templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("block" in this case.)
 */
/* -- Delete this line if you want to use this function
function uwtv6zen_preprocess_block(&$variables, $hook) {
  // Add a count to all the blocks in the region.
  // $variables['classes_array'][] = 'count-' . $variables['block_id'];

  // By default, Zen will use the block--no-wrapper.tpl.php for the main
  // content. This optional bit of code undoes that:
  //if ($variables['block_html_id'] == 'block-system-main') {
  //  $variables['theme_hook_suggestions'] = array_diff($variables['theme_hook_suggestions'], array('block__no_wrapper'));
  //}
}
// */

/**
  * Implements hook_form_FORM_ID_alter.
  *
  * Adds a class to the search button for the search form.
  */
function uwtv6zen_form_search_block_form_alter(&$form, &$form_state, $form_id) {
  $form['actions']['submit']['#attributes']['class'][] = 'icons-search-submit-dark';
}
/**
  * On the mobile site, the site and section menus can both show the same
  *   content, and because they are stacked, it looks dumb to have identical
  *   menus. This code checks two different menu blocks and returns 'dupe'
  *   to be used as a class in the mobile style sheet.
  */
function _is_menu_dupe($first, $second) {
  $dupe = '';
  $first_menu = array();
  $second_menu = array();
  foreach($first as $key => $value) {
    if(stripos($key, 'menu_block_') !== FALSE) {
      $first_menu['title'] = $value['#block']->subject_array['#title'];
      $first_menu['href'] = $value['#block']->subject_array['#href'];
    }
  }
  foreach($second as $key => $value) {
    if(stripos($key, 'menu_block_') !== FALSE) {
      $second_menu['title'] = $value['#block']->subject_array['#title'];
      $second_menu['href'] = $value['#block']->subject_array['#href'];
    }
  }
  if ($first_menu == $second_menu) {
    $dupe = 'dupe';
  }
  return $dupe;
}


/**
 * Return a themed breadcrumb trail.
 *
 * @param $variables
 *   - title: An optional string to be used as a navigational heading to give
 *     context for breadcrumb links to screen-reader users.
 *   - title_attributes_array: Array of HTML attributes for the title. It is
 *     flattened into a string within the theme function.
 *   - breadcrumb: An array containing the breadcrumb links.
 * @return
 *   A string containing the breadcrumb output.
 */
function uwtv6zen_breadcrumb($variables) {
  $breadcrumb = $variables['breadcrumb'];
  // Wrapping the first breadcrumb with the UWT home logo
  if(isset($breadcrumb[0])) {
    $newhome = '<span class="icons-W-home">';
    $newhome .= $breadcrumb[0];
    $newhome .= '</span>';
    $breadcrumb[0] = $newhome;
  }
  $output = '';

  // Determine if we are to display the breadcrumb.
  $show_breadcrumb = theme_get_setting('zen_breadcrumb');
  if ($show_breadcrumb == 'yes' || $show_breadcrumb == 'admin' && arg(0) == 'admin') {

    // Optionally get rid of the homepage link.
    $show_breadcrumb_home = theme_get_setting('zen_breadcrumb_home');
    if (!$show_breadcrumb_home) {
      array_shift($breadcrumb);
    }

    // Return the breadcrumb with separators.
    if (!empty($breadcrumb)) {
      $breadcrumb_separator = theme_get_setting('zen_breadcrumb_separator');
      $trailing_separator = $title = '';
      if (theme_get_setting('zen_breadcrumb_title')) {
        $item = menu_get_item();
        if (!empty($item['tab_parent'])) {
          // If we are on a non-default tab, use the tab's title.
          $breadcrumb[] = check_plain($item['title']);
        }
        else {
          $breadcrumb[] = drupal_get_title();
        }
      }
      elseif (theme_get_setting('zen_breadcrumb_trailing')) {
        $trailing_separator = $breadcrumb_separator;
      }

      // Provide a navigational heading to give context for breadcrumb links to
      // screen-reader users.
      if (empty($variables['title'])) {
        $variables['title'] = t('You are here');
      }
      // Unless overridden by a preprocess function, make the heading invisible.
      if (!isset($variables['title_attributes_array']['class'])) {
        $variables['title_attributes_array']['class'][] = 'element-invisible';
      }

      // Build the breadcrumb trail.
      $output = '<nav class="breadcrumb" role="navigation">';
      $output .= '<h2' . drupal_attributes($variables['title_attributes_array']) . '>' . $variables['title'] . '</h2>';
      $output .= '<ol><li>' . implode($breadcrumb_separator . '</li><li>', $breadcrumb) . $trailing_separator . '</li></ol>';
      $output .= '</nav>';
    }
  }

  return $output;
}

/**
 *
 * If we want to send additional variables to the search results we can just
 *   uncomment this function and send them along.
 */

function uwtv6zen_preprocess_search_result(&$variables) {
  // Get the section of the search result
  $variables['search_result_sectionlink'] = FALSE;
  $node = node_load($variables['result']['node']->entity_id);
  if(isset($node) && !empty($node)){
  // Get the term field for the section from the node
  $section = field_get_items('node', $node, 'field_site');
  // Get the term id for the section term
  $tid = $section[0]['tid'];
  // Get the menu machine name associated with the section
  $menu_name = _uwt_menu_admin_get_site_menu_by_tid($tid);
  // Get the fully loaded term in case we need to create a link to it
  $term = taxonomy_term_load($section[0]['tid']);
  // Get the parents of the link using the node path and menu 
  $parents = NULL;
  if(isset($node->path)){
    $parents = _get_link_parents($node->path['source'], $menu_name);
    //dpm($parents, '$parents');
  }
  $section_id_link = NULL;
  // Only process links that have parents
  if(is_array($parents) && count($parents) > 0){
    foreach($parents as $parent){
      // Only process links that have options
      if(!empty($parent['options']) && !empty($parent['options']['section_id'])){
        // If the link is a section id, set the link and stop processing

        if($parent['options']['section_id'] == 1) {
           $section_id_link = l($parent['link_title'], $parent['link_path']);
           break;
        }
      }
    }
  }
  
  if(!is_null($section_id_link)) {
    $variables['search_result_sectionlink'] = $section_id_link;
  }else if(is_object($term)){
    $variables['search_result_sectionlink'] = l($term->name, 'taxonomy/term/' . $term->tid);
  }else{
    $variables['search_result_sectionlink'] = FALSE;
  }
  }
}

function _get_mlid($path, $menu_name) {

  $mlid = db_select('menu_links' , 'ml')
    ->condition('ml.link_path' , $path)
    ->condition('ml.menu_name',$menu_name)
    ->fields('ml' , array('mlid'))
    ->execute()
    ->fetchField();
  return $mlid;
}


/**
 *  Ok, once we get the menu link, we'll have the depth and the parents, which
 *    are in the p1-p9 elements.  Since these should be mlids, we can probably
 *    loop over these and inspect the options, stopping when we get to a section
 *    identifier and using that link title and path to make a link.
 *
 *  @param string $path A menu link path like 'node/123'.
 *  @param string $menu_name The machine name for a menu.
 *
 *  @return An array of link ______ or an empty array.
 */
function _get_link_parents($path, $menu_name){
  //dpm($path, $menu_name);
  $parents = array();
  $mlid = NULL;

  if(!empty($path) && !empty($menu_name)){
    $mlid = _get_mlid($path, $menu_name);
    //dpm($mlid, '$mlid');
    $menu_link = menu_link_load($mlid);
    if(is_array($menu_link) && !empty($menu_link)){
      //dpm($menu_link, '$menu_link');
      $depth = $menu_link['depth'];
      //dpm($depth, '$depth');
      for($i = $depth; $i > 0; $i--) {
        $parent_link = NULL;
        //dpm($menu_link['p'.$i], 'link parent');
        $parent_link = menu_link_load($menu_link['p'.$i]);
        //dpm($parent_link['link_path'], $parent_link['link_title']);
        $parents[] = $parent_link;
      }
    }
  }
  return $parents;
}

/**
* Overriding feed aggregator display
*/
function uwtv6zen_aggregator_block_item($variables){
  $item = $variables['item'];
  switch ($item->fid) {
    case '2': // Trumba Academic Deadlines calendar feed
      $output = '<span class="trumba-rss-title">';
      $output .= l($item->title, $item->link);
      $output .= '</span>';
      $output .= '<span class="trumba-rss-description">';
      $output .= ' ' . $item->description;
      $output .= '</span>';
      return $output;
      break;
    
    default:
      $output = '<span class="trumba-rss-title">';
      $output .= l($item->title, $item->link);
      $output .= '</span>';
      return $output;
      break;
  }
}
