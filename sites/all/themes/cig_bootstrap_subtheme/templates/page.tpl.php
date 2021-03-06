<?php
/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template in this directory.
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
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 *
 * @see bootstrap_preprocess_page()
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see bootstrap_process_page()
 * @see template_process()
 * @see html.tpl.php
 *
 * @ingroup themeable
 */
?>
        <div class="skipnav"><a href="#main-col">Skip to main content</a> <a href="#footer">Skip to footer unit links</a></div>
        <div class="off-canvas-wrap" data-offcanvas>
            <div class="inner-wrap">
                <nav class="tab-bar show-for-small-only">
                    <section class="left-small mobile-logo">
                        <a href="<?php print $front_page; ?>" rel="home" title="Climate Impacts Group">
                            <svg id="logo" width="108" height="73" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 108 73" enable-background="new 0 0 108 73" xml:space="preserve">
                                <path d="M79.343,0.112c0,0.858,0,12.238,0,13.098c0.856,0,9.206,0,9.206,0L78.271,51.461
                                    c0,0-12.577-50.636-12.756-51.349c-0.687,0-12.626,0-13.303,0c-0.188,0.696-13.796,51.352-13.796,51.352L28.95,13.21
                                    c0,0,8.726,0,9.585,0c0-0.859,0-12.239,0-13.098c-0.919,0-37.532,0-38.451,0c0,0.858,0,12.238,0,13.098c0.851,0,8.52,0,8.52,0
                                    s14.703,58.809,14.88,59.522c0.708,0,19.942,0,20.639,0c0.183-0.697,9.852-37.454,9.852-37.454s9.188,36.747,9.364,37.454
                                    c0.707,0,19.941,0,20.639,0C84.164,72.03,99.635,13.21,99.635,13.21s7.6,0,8.449,0c0-0.859,0-12.239,0-13.098
                                    C107.176,0.112,80.251,0.112,79.343,0.112z"></path>
                            </svg>
                        </a>
                    </section>
                    <section class="middle tab-bar-section">
                      <a href="<?php print $front_page; ?>" rel="home" title="Climate Impacts Group">
                        </a>
                    </section>
                    <section class="right-small">
                        <a class="right-off-canvas-toggle menu-icon" ><span></span></a>
                    </section>
                </nav>
                <aside class="right-off-canvas-menu">
                <nav class="mobile-menu"><!-- usually contains main site navigation --></nav>
                </aside>
                <nav id="top-nav" class="show-for-medium-up">
                    <div class="row">
                        <div class="top-menu normal-top-menu">
                            <ul id="menu-university" class="menu">
                                <li id="menu-item-2660" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-2660"><a href="http://uw.edu">UW Home</a></li>
                                <li id="menu-item-2661" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-2661"><a href="http://environment.uw.edu">College Home</a></li>
                            </ul> 
                        </div><!-- .top-menu -->
                    </div><!-- .row -->
                </nav><!-- #top-nav -->
                <div class="banner-container"> 
                    <div class="row title-row">
                        <div class="columns medium-2 name show-for-medium-up">
                        <a href="<?php print $front_page; ?>" rel="home" title="Climate Impacts Group">
                                <!--[if gte IE 9]><!-->
                                <svg id="logo" width="148" height="100" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 108 73" xml:space="preserve">
                                <path d="M79.343,0.112c0,0.858,0,12.238,0,13.098c0.856,0,9.206,0,9.206,0L78.271,51.461
                                c0,0-12.577-50.636-12.756-51.349c-0.687,0-12.626,0-13.303,0c-0.188,0.696-13.796,51.352-13.796,51.352L28.95,13.21
                                c0,0,8.726,0,9.585,0c0-0.859,0-12.239,0-13.098c-0.919,0-37.532,0-38.451,0c0,0.858,0,12.238,0,13.098c0.851,0,8.52,0,8.52,0
                                s14.703,58.809,14.88,59.522c0.708,0,19.942,0,20.639,0c0.183-0.697,9.852-37.454,9.852-37.454s9.188,36.747,9.364,37.454
                                c0.707,0,19.941,0,20.639,0C84.164,72.03,99.635,13.21,99.635,13.21s7.6,0,8.449,0c0-0.859,0-12.239,0-13.098
                                C107.176,0.112,80.251,0.112,79.343,0.112z"/>
                                </svg>
                                <!--<![endif]-->
                                <!--[if lte IE 8]>
                                <img src="assets/img/W.png" id="logo" alt="W" />
                                <!--<![endif]-->
                            </a>
                        </div>
                    <div class="columns large-8 medium-10 show-for-medium-up">
                        <div id="unit-college-uw" class="centered">
                            <h1 class="left"><a href="<?php print $front_page; ?>" rel="home" title="<?php print $site_name; ?>"><?php print $site_name; ?></a></h1>
                            <div class="units show-for-large-up right">
                                <a href="http://environment.uw.edu" title="UW College of the Environment"><img src="<?php print base_path() . path_to_theme();?>/assets/img/College-of-the-Environment.png" class="college-name" alt="College of the Environment"></a><br />
                                <a href="http://uw.edu" title="University of Washington"><img src="<?php print base_path() . path_to_theme();?>/assets/img/UW-Tagline.png" class="uw-name" alt="University of Washington"></a>
                            </div>
                        </div>
                    </div>
                    <div class="columns large-2 show-for-large-up">
                        <a href="http://uw.edu" title="University of Washington"><img src="<?php print base_path() . path_to_theme();?>/assets/img/logo-cig-header.png" class="right" alt="Climate Impacts Group Logo" /></a>
                    </div>
                </div>
            </div>
            <div class="top-bar-container show-for-medium-up">
                <nav class="top-bar">
                   <!-- <section class="top-bar-section"> -->
                            <?php if (!empty($primary_nav) || !empty($secondary_nav) || !empty($page['navigation']) ): ?>
                              <div class="navbar-collapse collapse">
                                <nav role="navigation">
                                  <?php if (!empty($primary_nav)): ?>
                                    <?php print render($primary_nav); ?>
                                  <?php endif; ?>
                                  <?php if (!empty($secondary_nav)): ?>
                                    <?php //print render($secondary_nav); ?>
                                  <?php endif; ?>
                                  <?php if (!empty($page['navigation'])): ?>
                                    <?php //print render($page['navigation']); ?>
                                  <?php endif; ?>

                                </nav>
                              </div>
                            <?php endif; ?>
                 <!--   </section> -->
                </nav>
            </div>
            <section class="container" role="document">
                <div class="row">
                    <div class="entry-content">
                    <?php print render($page['header']); ?>
                    </div>
                    <div class="small-12 medium-12 columns" role="main">
                            <?php if (!empty($page['sidebar_first'])): ?>
                            <div class="main-container container">
                            <aside id="sidebar" class="small-12 medium-3 columns">
                                <article id="coenv_base_subnav-2" class="row widget widget_coenv_base_subnav">
                                    <!--<ul class="side-nav">
                                    </ul> -->
                                    <aside role="complementary">   
                                    <?php print render($page['sidebar_first']); ?>
                                    </aside>
                                    <!-- <aside class="col-sm-3" role="complementary">    
                                    </aside>   /#sidebar-second -->
                                </article>
                            </aside>
                            </div>
                            <?php endif; ?>
                        <article class="post-82 page type-page status-publish hentry template-page" id="post-82">
                            <div class="entry-content">
                                <section<?php print $content_column_class; ?>>
                                                <?php if (!empty($page['highlighted'])): ?>
                                                <div class="highlighted jumbotron"><?php print render($page['highlighted']); ?></div>
                                                <?php endif; ?>
                                                <?php if (!empty($breadcrumb)): print $breadcrumb; endif;?> 
                                <article id="post-82" class="post-82 page type-page status-publish hentry article">
                                    <header class="article__header">
                                        <div class="article__meta"></div>
                                    </header>
                                    <section class="article__content">
                                               <a id="main-content"></a>
                                                  <?php print render($title_prefix); ?>
                                                  <?php if (!empty($title)): ?>
                                                    <h1 class="page-header"><?php print $title; ?></h1>
                                                  <?php endif; ?>
                                                  <?php print render($title_suffix); ?>
                                                  <?php print $messages; ?>
                                                  <?php if (!empty($tabs)): ?>
                                                    <?php print render($tabs); ?>
                                                  <?php endif; ?>
                                                  <?php if (!empty($page['help'])): ?>
                                                    <?php print render($page['help']); ?>
                                                  <?php endif; ?>
                                                  <?php if (!empty($action_links)): ?>
                                                    <ul class="action-links"><?php print render($action_links); ?></ul>
                                                  <?php endif; ?>
                                                  <?php print render($page['content']); ?>
                                </article><!-- .article -->
                                </section>
                            </div>
                        </article>
                        <?php if (!empty($page['sidebar_second'])): ?>
                            <div class="main-container container">
                            <aside id="sidebar" class="small-12 medium-3 columns">
                                <article id="coenv_base_subnav-2" class="row widget widget_coenv_base_subnav">
                                    <!-- <ul class="side-nav">
                                    </ul> --> 
                                    <aside role="complementary">
                                    <?php print render($page['sidebar_second']); ?>
                                    </aside>  <!-- /#sidebar-second -->
                                </article>
                            </aside>
                           </div>
                        <?php endif; ?>
                    </div><!-- main -->
                </div>
            </section>
      <div class="content-footer-row">
                     <?php print render($page['footer']); ?>
                </div>
            <footer id="footer" role="contentinfo" class="site-footer">        
                <div class="footer-row">                 
                    <div class="row">
                        <div class="medium-6 columns">
                            <div class="footer-logo left">
                                <img src="/sites/all/themes/cig_bootstrap_subtheme/assets/img/logo-color.png" alt="Climate Impacts Group Logo" />
                            </div>
                            <header class="site-footer__header">
                                <h2>Climate Impacts Group</h2>
                            </header>
                            <div class="unit-contact">
                                <p><a href="http://maps.google.com/?q=Box%20355674%20Seattle,%20WA%2098195-5672" title="Google Maps link" target="_blank">Box 355674 Seattle, WA 98195-5672</a></p>
                                <p><a href="mailto:cig@uw.edu" title="Send us an Email">cig@uw.edu</a>  | (206) 616-5350</p>
                            </div>
                            <div class="footer__info">
                                <div class="social-buttons"></div>
                            </div>
                        </div>
                    <div class="medium-6 columns right">
                        <nav class="footer-nav">
                            <header class="site-footer__header">
                                <h2 id="logo"><a href="http://environment.uw.edu" rel="home" title="UW College of the Environment"><img alt="College of the Environment Logo" src="<?php print base_path() . path_to_theme();?>/assets/img/uw-footer.svg" width="350" ></a></h2>
                            </header>
                            <ul class="menu-footer-units">
                                <li><a target="_blank" href="http://fish.washington.edu/">Aquatic and Fishery Sciences</a></li>
                                <li><a target="_blank" href="http://www.atmos.washington.edu/">Atmospheric Sciences</a></li>
                                <li><a target="_blank" href="http://www.ess.washington.edu/">Earth and Space Sciences</a></li>
                                <li><a target="_blank" href="http://www.sefs.washington.edu/">Environmental and Forest Sciences</a></li>
                                <li><a target="_blank" href="http://smea.uw.edu">School of Marine and Environmental Affairs</a></li>
                                <li><a target="_blank" href="http://www.ocean.washington.edu/">Oceanography</a></li>
                                <li><a target="_blank" href="http://depts.washington.edu/poeweb/">Program on the Environment</a></li>
                                <li><a target="_blank" href="http://cses.washington.edu/cig/">Climate Impacts Group</a></li>
                                <li><a target="_blank" href="http://depts.washington.edu/fhl/">Friday Harbor Labs</a></li>
                                <li><a target="_blank" href="http://jisao.washington.edu/">Joint Institute for the Study of the Atmosphere and Ocean</a></li>
                                <li><a target="_blank" href="http://depts.washington.edu/uwbg/">UW Botanic Gardens</a></li>
                                <li><a target="_blank" href="http://www.waspacegrant.org/">Washington NASA Space Grant</a></li>
                                <li><a target="_blank" href="http://wsg.washington.edu/">Washington Sea Grant</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="footer-footer">
                <div class="row uw-footer">
                    <div class="medium-6 columns">
                        <p class="copyright">&copy; 2015 <a href="http://www.washington.edu/">University of Washington</a></p>
                    </div>
                <div class="medium-6 columns">
                    <ul id="menu-footer-links" class="menu-footer-links">
                        <li><a target="_blank" href="http://www.washington.edu/admin/hr/jobs/">Jobs</a></li>
                        <li><a target="_blank" href="http://myuw.washington.edu/">My UW</a></li>
                        <li><a target="_blank" href="http://www.washington.edu/admin/rules/wac/rulesindex.html">Rules Docket</a></li>
                        <li><a target="_blank" href="http://www.washington.edu/online/privacy/">Privacy</a></li>
                        <li><a target="_blank" href="http://www.washington.edu/online/terms/">Terms</a></li>
                    </ul>
                </div>
            </div>
        </div>
        </footer><!-- #footer -->
        </div>
    <a class="exit-off-canvas"></a>
    </div>
        <script type='text/javascript' src='/sites/all/themes/cig_bootstrap_subtheme/js/app.js?ver=1.0.0'></script>