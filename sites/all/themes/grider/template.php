<?php

define('GRIDER_THEME_SETTINGS_COLUMN_VARIABLE_PATTERN', 'grider_%s_size');
define('GRIDER_THEME_SETTINGS_ROW_VARIABLE_PATTERN', 'grider_%s_size');
define('GRIDER_PAGE_TEMPLATE_VARIABLE_PATTERN', '%s_size');
define('GRIDER_GRID_COLUMNS', 12);

require_once 'includes/custom_menu.inc';
require_once 'includes/slider.php';

/**
 * Implements template_html_head_alter().
 */
function grider_html_head_alter(&$variables) {
  global $theme;
  if ($theme == 'grider') {
    if (theme_get_setting('default_favicon')) {
      foreach ($variables as $key => $value) {
        if (strpos($key, 'misc/favicon.ico') !== FALSE) {
          $variables[$key]['#attributes']['href'] = url(drupal_get_path('theme', 'grider') . '/images/favicon.ico');
        }
      }
    }
  }
}

/**
 * Implements hook_preprocess_html().
 */
function grider_preprocess_html(&$variables) {



  $theme_path = path_to_theme();


  // Cache path to theme for duration of this function:
  $path_to_theme = drupal_get_path('theme', 'grider');
  // Add 'viewport' meta tag:
  drupal_add_html_head(
          array(
      '#tag' => 'meta',
      '#attributes' => array(
          'name' => 'viewport',
          'content' => 'width=device-width, initial-scale=1',
      ),
          ), 'grider:viewport_meta'
  );
  $path_to_icons = $path_to_theme . '/';
  global $theme;
  if ($theme == 'grider') {
    drupal_add_html_head_link(array('rel' => 'apple-touch-icon-precomposed', 'href' => $path_to_icons . 'images/apple-touch-icon.png', 'sizes' => '55x55'));
    drupal_add_html_head_link(array('rel' => 'apple-touch-icon-precomposed', 'href' => $path_to_icons . 'images/apple-touch-icon-114x114.png', 'sizes' => '114x114'));
    drupal_add_html_head_link(array('rel' => 'apple-touch-icon-precomposed', 'href' => $path_to_icons . 'images/apple-touch-icon-72x72.png', 'sizes' => '72x72'));
  }

  grider_add_css();
}

function grider_preprocess_page(&$vars) {

  // main menu
  $custom_main_menu = _custom_main_menu_render_superfish();
  if (!empty($custom_main_menu['content'])) {
    $vars['navigation'] = $custom_main_menu['content'];
  }

  // overide node title with content type

  if (arg(0) == 'node' && arg(1)) {
    $nid = arg(1);

    $node = node_load($nid);
    switch ($node->type) {
      case 'blog':
        $vars['title'] = t('Blog');

        break;

      case 'portfolio':
        $vars['title'] = t('Portfolio');
        break;
    }
  }


  //search block form
  $seach_block_form = drupal_get_form('search_block_form');
  $seach_block_form['#id'] = 'searchForm';
  $seach_block_form['search_block_form']['#id'] = 's';
  $seach_block_form['search_block_form']['#attributes']['placeholder'] = t('Search...');
  $vars['seach_block_form'] = drupal_render($seach_block_form);


  //banner slider

  if (variable_get('theme_grider_first_install', TRUE)) {
    include_once 'theme-settings.php';
    _grider_install();
  }


  // slider setting
  $banners = grider_show_banners();
  $vars['slider'] = grider_banners_markup($banners);


  //sidebar
  $sidebar_region_details = _grider_get_multiple_regions(array('sidebar_'));
  $sidebar_regions = $sidebar_region_details['sidebar_'];
  // Count the results:
  $sidebar_count = count($sidebar_regions);

  // Start from zero:
  $sidebar_total_width = 0;
  // If there are any sidebars, loop through all the columns:
  if ($sidebar_count > 0) {
    foreach ($sidebar_regions as $key => $name) {
      // If this sidebar actually has content:
      if (count($vars['page'][$key]) > 0) {
        // Find out how big it's supposed to be:
        $column_width_setting = (int) theme_get_setting(sprintf(GRIDER_THEME_SETTINGS_COLUMN_VARIABLE_PATTERN, $key));
        // Make it available to the page template:
        $vars[sprintf(GRIDER_PAGE_TEMPLATE_VARIABLE_PATTERN, $key)] = $column_width_setting;
        // Add the width of this sidebar to the total sidebar width:
        $sidebar_total_width += $column_width_setting;
      }
    }
  }

  $vars[sprintf(GRIDER_PAGE_TEMPLATE_VARIABLE_PATTERN, 'content')] = GRIDER_GRID_COLUMNS - $sidebar_total_width;
}

function _grider_get_multiple_regions($region_types = array('sidebar_'), $theme_override = NULL) {

  $current_theme = $theme_override ? $theme_override : variable_get('theme_default', $theme_override);

  $regions = system_region_list($current_theme);

  $theme_regions = array();
  // Loop through the region types:
  foreach ($region_types as $region_type) {
    foreach ($regions as $key => $name) {
      if (strpos($key, $region_type) === 0) {
        $theme_regions[$region_type][$key] = $name;
      }
    }
  }

  return $theme_regions;
}

function grider_get_banners($all = TRUE) {
  // Get all banners
  $banners = variable_get('theme_grider_banner_settings', array());

  // Create list of banner to return
  $banners_value = array();
  foreach ($banners as $banner) {
    if ($all || $banner['image_published']) {
      // Add weight param to use `drupal_sort_weight`
      $banner['weight'] = $banner['image_weight'];
      $banners_value[] = $banner;
    }
  }

  // Sort image by weight
  usort($banners_value, 'drupal_sort_weight');

  return $banners_value;
}

/**
 * Set banner settings.
 *
 * @param <array> $value
 *    Settings to save
 */
function grider_set_banners($value) {
  variable_set('theme_grider_banner_settings', $value);
}

function grider_banners_markup($banners) {

  if ($banners) {
    // Add javascript to manage banners
    // Generate HTML markup for banners
    return grider_banner_markup($banners);
  } else {
    return '';
  }
}

function grider_banners_add_js() {
  
}

/**
 * Generate banners markup.
 *
 * @return <string>
 *    HTML code to display banner markup.
 */
function grider_banner_markup($banners) {

  $slider_default = theme_get_setting('home_slider_type', 'grider');


  if (!empty($_GET['slider'])) {
    $_SESSION['slider'] = $_GET['slider'];
  }
  if (!empty($_SESSION['slider'])) {
    $slider = $_SESSION['slider'];
    if (in_array($slider, array('default', 'skitter', 'flexslider'))) {
      $slider_default = $_SESSION['slider'];
    }
  }



  switch ($slider_default) {
    case 'default':
      $slider = slider_default($banners);

      break;

    case 'skitter':
      $slider = slider_skitter($banners);
      break;

    case 'flexslider':
      $slider = slider_flexslider($banners);
      break;

    default :
      $slider = slider_default($banners);
      break;
  }

  return $slider;
}

function grider_default_slider_markup($banners) {
  $output = '<div id="onebyone_slider">';
  foreach ($banners as $i => $banner) {
    $variables = array(
        'path' => $banner['image_path'],
        'alt' => t('@image_desc', array('@image_desc' => $banner['image_title'])),
        'title' => t('@image_title', array('@image_title' => $banner['image_title'])),
        'attributes' => array(
            'class' => 'ob1_img_device1', // hide all the slides except #1
            'id' => 'slide-number-' . $i,
            'longdesc' => t('@image_desc', array('@image_desc' => $banner['image_description']))
        ),
    );
    // Draw image
    $image = theme('image', $variables);

    $img_url_title = ($banner['image_url_title']) ? $banner['image_url_title'] : 'Read more';


    // Remove link if is the same page
    $banner['image_url'] = ($banner['image_url'] == current_path()) ? FALSE : $banner['image_url'];

    $image_url_title = '';
    if (isset($banner['image_url']) && !empty($banner['image_url'])) {
      $image_url_title = l($img_url_title, $banner['image_url'], array('attributes' => array('class' => array('button'))));
    }



    $output .= '<div class="oneByOne_item">';
    $output .='<span class="ob1_title">' . $banner['image_title'] . '</span>';
    if (isset($banner['image_description'])) {
      $output .= "\n";
      $output .= '<span class="ob1_description">' . $banner['image_description'] . '</span>';
    }
    if (isset($banner['image_url'])) {
      $output .= "\n";
      $output .= '<span class="ob1_button"><a href="' . url($banner['image_url']) . '" class="default_button">' . $img_url_title . '</a></span>';
    }
    if (isset($image)) {
      $output .= "\n";
      $output .=$image;
    }
    $output .= "\n";
    $output.= '</div>';
  }

  $output .='</div>';
  return $output;
}

/**
 * Get banner to show into current page in accord with settings
 *
 * @return <array>
 *    Banners to show
 */ 
function grider_show_banners() {
  $banners = grider_get_banners(FALSE);

  return $banners;
}

function grider_format_comma_field($field_category, $node, $limit = NULL) {
  $category_arr = array();
  $category = '';
  if (!empty($node->{$field_category}[LANGUAGE_NONE])) {
    foreach ($node->{$field_category}[LANGUAGE_NONE] as $item) {
      $term = taxonomy_term_load($item['tid']);
      if ($term) {
        $category_arr[] = l($term->name, 'taxonomy/term/' . $item['tid']);
      }

      if ($limit) {
        if (count($category_arr) == $limit) {
          $category = implode(', ', $category_arr);
          return $category;
        }
      }
    }
  }
  $category = implode(', ', $category_arr);

  return $category;
}

function grider_add_css() {

  $theme_path = path_to_theme();

  drupal_add_css($theme_path . '/css/base.css');
  drupal_add_css($theme_path . '/css/amazium.css');
//  drupal_add_css($theme_path . '/css/boxgallery.css');
//  drupal_add_css($theme_path . '/css/skitter.css');
//  drupal_add_css($theme_path . '/css/flexslider.css');
//  drupal_add_css($theme_path . '/css/prettyPhoto.css');
  drupal_add_css($theme_path . '/font/font.css');
  drupal_add_css($theme_path . '/css/grider.css');
  drupal_add_css($theme_path . '/css/style.css');



  if (!empty($_GET['theme_color'])) {
    $_SESSION['theme_color'] = $_GET['theme_color'];
  }


  $default_color = theme_get_setting('theme_color', 'grider');
  if (!empty($_SESSION['theme_color'])) {
    $default_color = $_SESSION['theme_color'];
  }

  if (file_exists($theme_path . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'color' . DIRECTORY_SEPARATOR . $default_color . '.css')) {

    drupal_add_css($theme_path . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'color' . DIRECTORY_SEPARATOR . $default_color . '.css');
  } else {
    $default_color = 'grey';
    drupal_add_css($theme_path . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'color' . DIRECTORY_SEPARATOR . $default_color . '.css');
  }
}
