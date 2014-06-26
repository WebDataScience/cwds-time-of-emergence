<?php
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
$uwt_alerts = render($page['uwt_alerts']);
$global_navigation = render($page['global_navigation']);
$audience_navigation = render($page['audience_navigation']);
$global_search = render($page['global_search']);
$global_secondary = render($page['global_secondary']);
$post_header = render($page['post_header']);
$section_identifier = render($page['section_identifier']);
$site_menu = render($page['site_menu']);
$section_menu = render($page['section_menu']);
$footer_menus = render($page['footer_menus']);
?>




<div id="page">
  
  <?php if($uwt_alerts) { ?>
  <div id="uwtalerts">
    <?php print $uwt_alerts; ?>
  </div>
  <?php } ?>

  <div id="band"> </div> <!-- /band -->
  <header id="header" role="banner">  
    <div id="header-left">
      <div id="patch">
        <?php 
          if(isset($patch)) {
            print $patch;
          }
        ?>
      </div>
    </div> <!-- /header-left -->
    <div id="header-center">

      <?php if($audience_navigation){ ?>
        <div id="audience-menu">
          <nav role="navigation" class="menus">
            <input type="checkbox" id="audience-menu-checkbox">
            <label for="audience-menu-checkbox" class="icons-audience-menu-button-narrow" onclick></label>
            <?php print $audience_navigation; ?>
          </nav>
        </div>
      <?php } ?>

      <?php if($global_navigation){ ?>
        <div id="global-menu">
          <nav role="navigation" class="menus">
            <!-- Fix for iOS -->
            <input type="checkbox" id="main-menu-checkbox">
            <label for="main-menu-checkbox" class="icons-main-menu-button-narrow" onclick></label>
            <?php print $global_navigation; ?>
          </nav>
        </div> <!-- /global-menu -->
      <?php } ?>

      <div id="wordmark">
        <?php 
          if(isset($wordmark)){
            print $wordmark;
          }
      ?>
      </div>
      <div id="site-home-link-wrapper">
        <?php if(isset($site_home)){echo $site_home; } ?>
      </div>
    </div><!-- /header-center -->

    <div id="header-right">
      <div id="global-search">
        <?php if($global_search){print $global_search;} ?>
      </div> <!-- /global-search -->
      <div id="global-secondary" class="grey-buttons">
        <?php if($global_secondary){print $global_secondary;} ?>
      </div>
    </div>
  </header><!-- /#header -->

  <div id="post-header">
    <?php if($post_header){print $post_header;} ?>
  </div>

  <?php if($section_identifier) { ?>
    <div id="section-identifier">
      <?php print $section_identifier; ?>
    </div> <!-- /#section-identifier -->
  <?php } ?>

  <?php if($site_menu){ ?>
    <div id="site-menu">
      <nav role="navigation" class="menus">
        <input type="checkbox" id="site-menu-checkbox">
        <label for="site-menu-checkbox" class="icons-site-menu-button-narrow" onclick></label>
        <?php print $site_menu; ?>
      </nav>
    </div><!-- /#site-menu -->
  <?php } ?>

  <?php if($section_menu){ ?>
    <div id="section-menu" class="<?php print _is_menu_dupe($page['site_menu'], $page['section_menu'])?>">
      <nav role="navigation" class="menus">
        <input type="checkbox" id="section-menu-checkbox">
        <label for="section-menu-checkbox" class="icons-site-menu-button-narrow" onclick></label>
        <?php print $section_menu; ?>
      </nav>
    </div><!-- /#section-menu -->
  <?php } ?>

  <div id="main">

    

    <div id="content" class="column" role="main">
      <?php print render($page['highlighted']); ?>
      <?php print $breadcrumb; ?>
      <a id="main-content"></a>
      <?php print render($title_prefix); ?>
      <?php if ($title): ?>
        <h1 class="title" id="page-title"><?php print $title; ?></h1>
      <?php endif; ?>
      <?php print render($title_suffix); ?>
      <?php print $messages; ?>
      <?php print render($tabs); ?>
      <?php print render($page['help']); ?>
      <?php if ($action_links): ?>
        <ul class="action-links"><?php print render($action_links); ?></ul>
      <?php endif; ?>
      
      <?php 
        // content just says 'You are not authorized to access this page.'
        print render($page['content']);
        $dest = drupal_get_destination();
        print "<p>You can " . l('log in with your UWNetID', $shiblink) . "  or use the ";
        print l('Non-UW login', 'user', array('query' => $dest)) . " form.</p>"; 
      ?>


      <?php print $feed_icons; ?>
    </div><!-- /#content -->



    <?php
      // Render the sidebars to see if there's anything in them.
      $sidebar_first  = render($page['sidebar_first']);
      $sidebar_second = render($page['sidebar_second']);
    ?>

    <?php if ($sidebar_first || $sidebar_second || $section_menu): ?>
      <aside class="sidebars">
        <?php print $section_menu; ?>
        <?php print $sidebar_first; ?>
        <?php print $sidebar_second; ?>
      </aside><!-- /.sidebars -->
    <?php endif; ?>

  </div><!-- /#main -->


</div><!-- /#page -->

  <div id="footer">
    <div id="footer_top">
      <div class="graphics-uwt_w_and_wordmark_horiz_white">&nbsp;</div>
    </div><!-- /#footer_top -->

    <div id="footer-middle">
      <?php if($footer_menus){print $footer_menus;} ?>
    </div><!-- /#footer_middle -->

  </div><!-- /#footer -->
  
  <div id="footer-bottom">
    <div class="inner">
      <div class="left">
        <span class="inner">&copy; <?php echo date('Y'); ?> University of Washington Tacoma</span>
      </div>
      <div class="right">
        <?php 
          if(!user_is_logged_in()) {
            echo l('UWNetID login', $shiblink);
            echo " | ";
            echo l('Non-UW login', 'user');
          }else{
            if(isset($userlink)) {
              echo $userlink;
            }
          }
        ?>
        <?php
          if(isset($link_info) && is_array($link_info)){
            echo '<br />Node ID: ' .  $link_info['nid'] . ' href: ' . $link_info['href'];
            }
        ?>
      </div>
    </div><!-- /.inner -->
  </div><!-- /#footer-bottom -->
<?php print render($page['bottom']); ?>
