<!--custom header added-->
<!--<div id="page-header-custom">-->
<!-- navigation -->
      <?php if (isset($navigation)): ?>
       <!-- <nav> -->
          <?php # print $navigation; ?>
       <!-- </nav> -->
      <?php endif; ?>
      <!-- // navigation -->
<!--</div>

<style>
#page-header-custom {
  width: 100%;
  height: 120px;
  background-color: purple;
}
</style>
-->



<div id="wrapper">
  <!-- start header -->
  <header id="header">
    <div class="row">


      <!-- logo -->
      <div class="logo">
        <a href="<?php print $front_page; ?>"><img id="brenthaven-logo-black" src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" /></a>  
      </div>
      <!-- // logo -->
      
      <!-- serial combo banner -->
      <div id="banner-serial-combo">
		<a href="<?php print $front_page; ?>"><img src="<?php print base_path() . 'images/banner.png'; ?>" alt="<?php print t('Home'); ?>" /></a>
	  </div>
	  <!-- // serial combo banner -->

      <!-- navigation -->
      <?php if (isset($navigation)): ?>
        <nav>
          <?php print $navigation; ?>
        </nav>
      <?php endif; ?>
      <!-- // navigation -->

    </div>
  </header>
  <!-- end header -->

  <!-- page title -->
  <?php if (!drupal_is_front_page() && $title): ?>
    <div class="row">
      <div class="column grid_12">
        <div id="headline-page">
          <div class="page-title">						
            <h4><?php print $title; ?></h4>

          </div>	

          <?php
          if (!empty($seach_block_form)) {
            print $seach_block_form;
          }
          ?>

        </div>
      </div>
    </div>
  <?php endif; ?>
  <!-- // page title -->


  <?php if (drupal_is_front_page() && (theme_get_setting('show_home_slogan', 'grider') || theme_get_setting('show_home_twitter_feed', 'grider') || !empty($slider))): ?>
    <div id="featured-wrap">
      <div class="row featured-top">

        <!-- home slogan -->
        <?php if (theme_get_setting('show_home_slogan', 'grider')): ?>
          <div class="column intro">
            <h3><?php print theme_get_setting('home_slogan', 'grider'); ?></h3>
          </div>
        <?php endif; ?>
        <!-- // home slogan -->

        <!-- home twitter feed -->
        <!--<?php /*if (theme_get_setting('show_home_twitter_feed', 'grider')): */ ?>
          <div class="column grid_7">
            <div class="twitter_feed">
              <ul class="tweet_list"></ul>
            </div>
            <p><img src="<?php /*print base_path() . path_to_theme(); */ ?>/images/icons/tweet_bird.png" alt="" /></p>		
          </div>
        <?php /* endif; */ ?>-->
        <!-- // home twitter feed -->

      </div>

      <!-- slider -->
      <!-- 
      <?php /* if (!empty($slider)): */ ?>
        <div class="row">
          <div class="column grid_12">

            <div class="featured_area">
              <?php /* print $slider; */ ?>
            </div>				

          </div>
        </div>
      <?php /* endif; */ ?>-->

      <!-- // slider -->
    </div>
  <?php endif; ?>

  <div id="maincontent">

    <?php
    $home_tagline = theme_get_setting('home_tagline', 'grider');
    ?>
    <?php if (drupal_is_front_page() && !empty($home_tagline)): ?>
      <div class="row">
        <div class="column grid_12">
          <div id="tagline">
            <h3><?php print $home_tagline; ?></h3>
          </div>
        </div>
      </div>
    <?php endif; ?>

    <!-- Divider -->
    <?php if (drupal_is_front_page()): ?>
      <div class="row">
        <div class="column grid_12">
          <div class="clear"></div>
          <div class="divider spacer20"></div>
        </div>
      </div>
    <?php endif; ?>
    <!-- End divider -->	

    <div class="row">
      <?php
      $content_wrapper_class = 'row';
      
      if (arg(0) == 'portfolio' || drupal_is_front_page()) {
        if (!$page['sidebar_first'] && !$page['sidebar_second']) {
          $content_wrapper_class = 'content-wrapper-inner';
          
        } else {
          $content_wrapper_class = 'row';
        }
      }
      ?>
      <div class="column grid_12">
        <div class="<?php print $content_wrapper_class; ?>">

          <?php if ($messages): ?>
            <div id="messages"><div class="section clearfix">
                <?php print $messages; ?>
              </div></div> <!-- /.section, /#messages -->
          <?php endif; ?>


          <!-- sidebar first -->
          <?php if ($page['sidebar_first']): ?>
            <div id="sidebar-first" class="sidebar column grid_<?php print $sidebar_first_size; ?>"><div class="section aside">
                <?php print render($page['sidebar_first']); ?>
              </div></div> <!-- /.section, /#sidebar-first -->
          <?php endif; ?>
          <!-- // sidebar first -->

          <!-- content -->
          <?php  if (arg(0) == 'portfolio' || drupal_is_front_page()) {?>
          <div id="content">
            <?php } else{ ?>
              <div id="content" class="column grid_<?php print $content_size; ?>">
            <?php } ?>

            <?php if ($tabs): ?>
              <div class="tabs">
                <?php print render($tabs); ?>
              </div>
            <?php endif; ?>
            <?php print render($page['help']); ?>
            <?php if ($action_links): ?>
              <ul class="action-links">
                <?php print render($action_links); ?>
              </ul>
            <?php endif; ?>
			<?php print render($page['content']); ?>        
            <?php print $feed_icons; ?>
          </div>
          <!-- // content -->

          <!-- sidebar second -->
          <?php if ($page['sidebar_second']): ?>
            <div id="sidebar-second" class="sidebar column grid_<?php print $sidebar_second_size; ?>"><div class="section aside">
                <?php print render($page['sidebar_second']); ?>
              </div></div> <!-- /.section, /#sidebar-second -->
          <?php endif; ?>
          <!-- // sidebar second -->

        </div>

      </div>
    </div>



  </div>

  <!-- Footer -->
  <div id="footer">

    <!-- Footer contain -->
    <?php if ($page['footer_firstcolumn'] || $page['footer_secondcolumn'] || $page['footer_thirdcolumn']): ?>
      <div class="row">
        <div class="column grid_12">
          <div class="row">

            <div class="column grid_4">
              <?php print render($page['footer_firstcolumn']); ?>
              <div class="clear"></div>

            </div>

            <div class="column grid_4">
              <?php print render($page['footer_secondcolumn']); ?>
              <div class="clear"></div>

            </div>

            <div class="column grid_4">
              <?php print render($page['footer_thirdcolumn']); ?>
              <div class="clear"></div>

            </div>			


          </div>
        </div>
      </div>
    <?php endif; ?>
    <!-- End footer contain -->

    <!-- Sub footer -->
    <div class="subfooter">
      <div class="row">
        <div class="column grid_12">
		<!--
          <ul class="social_network">
            <?php /* $theme_path = base_path() . path_to_theme(); */ ?>
            <li class="image_one"><a href="<?php /* print theme_get_setting('facebook_url', 'grider'); */ ?>"><span class="fb-rollover"></span><img src="<?php /* print $theme_path; */?>/images/social/fb.png" alt="" /></a></li>
            <li class="image_one"><a href="<?php /* print theme_get_setting('twitter_url', 'grider'); */ ?>"><span class="twitter-rollover"></span><img src="<?php /* print $theme_path; */ ?>/images/social/twitter.png" alt="" /></a></li>
            <li class="image_one"><a href="<?php /* print theme_get_setting('gplus_url', 'grider'); */ ?>"><span class="google-plus-rollover"></span><img src="<?php /* print $theme_path; */ ?>/images/social/google-plus.png" alt="" /></a></li>
            <li class="image_one"><a href="<?php /* print theme_get_setting('linkedin_url', 'grider'); */ ?>"><span class="linkedin-rollover"></span><img src="<?php /* print $theme_path; */ ?>/images/social/linkedin.png" alt="" /></a></li>						
            <li class="image_one"><a href="mailto:<?php /*print theme_get_setting('site_email', 'grider');*/ ?>"><span class="email-rollover"></span><img src="<?php /* print $theme_path; */ ?>/images/social/email.png" alt="" /></a></li>
            <li class="image_one"><a href="<?php /* print theme_get_setting('rss_url', 'grider'); */ ?>"><span class="rss-rollover"></span><img src="<?php /* print $theme_path; */ ?>/images/social/rss.png" alt="" /></a></li>							
          </ul>
          <span class="copyright"><?php /* print theme_get_setting('footer_copyright_message', 'grider'); */ ?></span>-->
        </div>
      </div>
    </div>
    <!-- End sub footer -->

  </div>
  <!--End footer -->
