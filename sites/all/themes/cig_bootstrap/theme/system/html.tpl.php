<?php
/**
 * @file
 * Default theme implementation to display the basic html structure of a single
 * Drupal page.
 *
 * Variables:
 * - $css: An array of CSS files for the current page.
 * - $language: (object) The language the site is being displayed in.
 *   $language->language contains its textual representation.
 *   $language->dir contains the language direction. It will either be 'ltr' or
 *   'rtl'.
 * - $rdf_namespaces: All the RDF namespace prefixes used in the HTML document.
 * - $grddl_profile: A GRDDL profile allowing agents to extract the RDF data.
 * - $head_title: A modified version of the page title, for use in the TITLE
 *   tag.
 * - $head_title_array: (array) An associative array containing the string parts
 *   that were used to generate the $head_title variable, already prepared to be
 *   output as TITLE tag. The key/value pairs may contain one or more of the
 *   following, depending on conditions:
 *   - title: The title of the current page, if any.
 *   - name: The name of the site.
 *   - slogan: The slogan of the site, if any, and if there is no title.
 * - $head: Markup for the HEAD section (including meta tags, keyword tags, and
 *   so on).
 * - $styles: Style tags necessary to import all CSS files for the page.
 * - $scripts: Script tags necessary to load the JavaScript files and settings
 *   for the page.
 * - $page_top: Initial markup from any modules that have altered the
 *   page. This variable should always be output first, before all other dynamic
 *   content.
 * - $page: The rendered page content.
 * - $page_bottom: Final closing markup from any modules that have altered the
 *   page. This variable should always be output last, after all other dynamic
 *   content.
 * - $classes String of classes that can be used to style contextually through
 *   CSS.
 *
 * @see bootstrap_preprocess_html()
 * @see template_preprocess()
 * @see template_preprocess_html()
 * @see template_process()
 *
 * @ingroup themeable
 */
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN"
  "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">
<html lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>"<?php print $rdf_namespaces;?>>
<head profile="<?php print $grddl_profile; ?>">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php print $head; ?>
  <title><?php print $head_title; ?></title>
  <?php print $styles; ?>
  <!-- HTML5 element support for IE6-8 -->
  <!--[if lt IE 9]>
    <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  <?php print $scripts; ?>


	<script src="http://www.washington.edu/static/alert.js" type="text/javascript"></script>
        <link rel="stylesheet" href="/sites/all/themes/cig_bootstrap/css/app.css" />
        <link rel="icon" href="/sites/all/themes/cig_bootstrap/cig/assets/img/icons/favicon.ico" type="image/x-icon">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/sites/all/themes/cig_bootstrap/cig/assets/img/icons/apple-touch-icon-144x144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/sites/all/themes/cig_bootstrap/cig/assets/img/icons/apple-touch-icon-114x114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/sites/all/themes/cig_bootstrap/cig/assets/img/icons/apple-touch-icon-72x72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="57x57" href="/sites/all/themes/cig_bootstrap/cig/assets/img/apple-touch-icon-57x57-precomposed.png">
        <link rel="apple-touch-icon" href="/sites/all/themes/cig_bootstrap/cig/assets/img/apple-touch-icon.png">
        <link rel="stylesheet" href="/sites/all/themes/cig_bootstrap/cig/assets/foundation-icons/foundation-icons.css">
        <script type='text/javascript' src='/sites/all/themes/cig_bootstrap/cig/js/modernizr/modernizr.min.js?ver=1.0.0'></script>
        <script type='text/javascript' src='/sites/all/themes/cig_bootstrap/cig/js/jquery/dist/jquery.min.js?ver=1.0.0'></script>


</head>
<!-- <body class="<?php print $classes; ?>" <?php print $attributes;?>> -->
<body class="page page-id-82 page-child parent-pageid-80 page-template-default logged-in admin-bar no-customize-support" <?php print $attributes;?>>
  <div id="skip-link">
    <a href="#main-content" class="element-invisible element-focusable"><?php print t('Skip to main content'); ?></a>
  </div>
  <?php print $page_top; ?>
  <?php print $page; ?>
  <?php print $page_bottom; ?>
</body>
</html>
