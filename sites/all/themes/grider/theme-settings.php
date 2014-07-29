<?php

include_once 'template.php';

/**
 * Advanced theme settings.
 */
function grider_form_system_theme_settings_alter(&$form, $form_state) {

  $form['home'] = array(
      '#type' => 'fieldset',
      '#title' => t('Homepage settings'),
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
  );
  $form['home']['show_home_slogan'] = array(
      '#type' => 'select',
      '#title' => t('Enable home slogan'),
      '#options' => array(1 => t('Yes'), 0 => t('No')),
      '#default_value' => theme_get_setting('show_home_slogan', 'grider'),
  );

  $form['home']['home_slogan'] = array(
      '#type' => 'textarea',
      '#title' => t('Home slogan'),
      '#default_value' => theme_get_setting('home_slogan', 'grider'),
  );

  $form['home']['home_tagline'] = array(
      '#type' => 'textarea',
      '#title' => t('Home tagline'),
      '#default_value' => theme_get_setting('home_tagline', 'grider'),
  );

  $form['home']['twitter'] = array(
      '#type' => 'fieldset',
      '#title' => t('Twitter settings'),
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
  );

  $form['home']['twitter']['show_home_twitter_feed'] = array(
      '#type' => 'select',
      '#title' => t('Enable home twitter feed'),
      '#options' => array(1 => t('Yes'), 0 => t('No')),
      '#default_value' => theme_get_setting('show_home_twitter_feed', 'grider'),
  );

  $form['home']['twitter']['twitter_username'] = array(
      '#type' => 'textfield',
      '#title' => t('Twitter username'),
      '#description' => t('Eg: tabvn'),
      '#default_value' => theme_get_setting('twitter_username', 'grider'),
  );

  $form['home']['twitter']['auto_join_text_default'] = array(
      '#type' => 'textfield',
      '#title' => t('Auto join text default'),
      '#default_value' => theme_get_setting('auto_join_text_default', 'grider'),
  );

  $form['home']['twitter']['auto_join_text_ed'] = array(
      '#type' => 'textfield',
      '#title' => t('Auto join text ed'),
      '#default_value' => theme_get_setting('auto_join_text_ed', 'grider'),
  );
  $form['home']['twitter']['auto_join_text_ing'] = array(
      '#type' => 'textfield',
      '#title' => t('Auto join text ing'),
      '#default_value' => theme_get_setting('auto_join_text_ing', 'grider'),
  );
  $form['home']['twitter']['auto_join_text_reply'] = array(
      '#type' => 'textfield',
      '#title' => t('Auto join text reply'),
      '#default_value' => theme_get_setting('auto_join_text_reply', 'grider'),
  );
  $form['home']['twitter']['auto_join_text_url'] = array(
      '#type' => 'textfield',
      '#title' => t('Auto join text URL'),
      '#default_value' => theme_get_setting('auto_join_text_url', 'grider'),
  );
  $form['home']['twitter']['loading_text'] = array(
      '#type' => 'textfield',
      '#title' => t('Loading text'),
      '#default_value' => theme_get_setting('loading_text', 'grider'),
  );

  $form['footer'] = array(
      '#type' => 'fieldset',
      '#title' => t('Footer settings'),
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
  );

  $form['footer']['footer_copyright_message'] = array(
      '#type' => 'textarea',
      '#title' => t('Footer copyright message'),
      '#default_value' => theme_get_setting('footer_copyright_message', 'grider'),
  );

  $form['footer']['social'] = array(
      '#type' => 'fieldset',
      '#title' => t('Social links setting'),
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
  );
  $form['footer']['social']['facebook_url'] = array(
      '#type' => 'textfield',
      '#title' => t('Facebook URL'),
      '#default_value' => theme_get_setting('facebook_url', 'grider'),
  );
  $form['footer']['social']['twitter_url'] = array(
      '#type' => 'textfield',
      '#title' => t('Twitter URL'),
      '#default_value' => theme_get_setting('twitter_url', 'grider'),
  );
  $form['footer']['social']['gplus_url'] = array(
      '#type' => 'textfield',
      '#title' => t('Google+ URL'),
      '#default_value' => theme_get_setting('gplus_url', 'grider'),
  );
  $form['footer']['social']['linkedin_url'] = array(
      '#type' => 'textfield',
      '#title' => t('Linkedin URL'),
      '#default_value' => theme_get_setting('linkedin_url', 'grider'),
  );
  $form['footer']['social']['site_email'] = array(
      '#type' => 'textfield',
      '#title' => t('Email'),
      '#default_value' => theme_get_setting('site_email', 'grider'),
  );
  $form['footer']['social']['rss_url'] = array(
      '#type' => 'textfield',
      '#title' => t('RSS URL'),
      '#default_value' => theme_get_setting('rss_url', 'grider'),
  );

  $form['slider'] = array(
      '#type' => 'fieldset',
      '#title' => t('Slider managment'),
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
  );

  $form['slider']['home_slider_type'] = array(
      '#type' => 'select',
      '#title' => t('Home slider type'),
      '#description' => t('select slider type for default.'),
      '#options' => array(
          'default' => 'Default slider',
          'skitter' => 'Skitter slider',
          'flexslider' => 'Flexslider',
      ),
      '#default_value' => theme_get_setting('home_slider_type', 'grider'),
  );

  // Image upload section ======================================================
  $banners = grider_get_banners();

  $form['slider']['banner']['images'] = array(
      '#type' => 'vertical_tabs',
      '#title' => t('Banner images'),
      '#weight' => 2,
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
      '#tree' => TRUE,
  );

  $i = 0;
  foreach ($banners as $image_data) {
    $form['slider']['banner']['images'][$i] = array(
        '#type' => 'fieldset',
        '#title' => t('Image !number: !title', array('!number' => $i + 1, '!title' => $image_data['image_title'])),
        '#weight' => $i,
        '#collapsible' => TRUE,
        '#collapsed' => FALSE,
        '#tree' => TRUE,
        // Add image config form to $form
        'image' => _grider_banner_form($image_data),
    );

    $i++;
  }

  $form['slider']['banner']['image_upload'] = array(
      '#type' => 'file',
      '#title' => t('Upload a new image'),
      '#weight' => $i,
  );

  $form['#submit'][] = 'grider_settings_submit';



  $form['portfolio'] = array(
      '#type' => 'fieldset',
      '#title' => t('Portfolio settings'),
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
  );

  $form['portfolio']['default_portfolio'] = array(
      '#type' => 'select',
      '#title' => t('Default portfolio display'),
      '#options' => array(
          '1c' => 'Portfolio - 1col',
          '2c' => 'Portfolio - 2cols',
          '3c' => 'Portfolio - 3cols',
          '4c' => 'portfolio - 4cols',
      ),
      '#default_value' => theme_get_setting('default_portfolio', 'grider'),
  );

  $form['portfolio']['default_nodes_portfolio'] = array(
      '#type' => 'select',
      '#title' => t('Number nodes show on portfolio page'),
      '#options' => drupal_map_assoc(array(2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 25, 30)),
      '#default_value' => theme_get_setting('default_nodes_portfolio', 'grider'),
  );

  $form['contact'] = array(
      '#type' => 'fieldset',
      '#title' => t('Contact settings'),
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
  );
  $form['contact']['contact_map'] = array(
      '#type' => 'textarea',
      '#title' => 'Map embed code',
      '#default_value' => theme_get_setting('contact_map', 'grider'),
  );

  $form['skin'] = array(
      '#type' => 'fieldset',
      '#title' => t('Skin settings'),
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
  );
  $form['skin']['theme_color'] = array(
      '#type' => 'select',
      '#title' => t('Select skin color'),
      '#options' => array(
          'blue' => t('Blue'),
          'green' => t('Green'),
          'orange' => t('Orange'),
          'pink' => t('Pink'),
          'purple' => t('Purple'),
          'red' => t('Red'),
          'yellow' => t('Yellow'),
      ),
      '#default_value' => theme_get_setting('theme_color', 'grider'),
  );


  return $form;
}

/**
 * Save settings data.
 */
function grider_settings_submit($form, &$form_state) {
  $settings = array();

  // Update image field
  foreach ($form_state['input']['images'] as $image) {
    if (is_array($image)) {
      $image = $image['image'];

      if ($image['image_delete']) {
        // Delete banner file
        file_unmanaged_delete($image['image_path']);
        // Delete banner thumbnail file
        file_unmanaged_delete($image['image_thumb']);
      } else {
        // Update image
        $settings[] = $image;
      }
    }
  }

  // Check for a new uploaded file, and use that if available.
  if ($file = file_save_upload('image_upload')) {
    $file->status = FILE_STATUS_PERMANENT;
    if ($image = _grider_save_image($file)) {
      // Put new image into settings
      $settings[] = $image;
    }
  }

  // Save settings
  grider_set_banners($settings);
}

/**
 * Check if folder is available or create it.
 *
 * @param <string> $dir
 *    Folder to check
 */
function _grider_check_dir($dir) {
  // Normalize directory name
  $dir = file_stream_wrapper_uri_normalize($dir);

  // Create directory (if not exist)
  file_prepare_directory($dir, FILE_CREATE_DIRECTORY);
}

/**
 * Save file uploaded by user and generate setting to save.
 *
 * @param <file> $file
 *    File uploaded from user
 *
 * @param <string> $banner_folder
 *    Folder where save image
 *
 * @param <string> $banner_thumb_folder
 *    Folder where save image thumbnail
 *
 * @return <array>
 *    Array with file data.
 *    FALSE on error.
 */
function _grider_save_image($file, $banner_folder = 'public://banner/', $banner_thumb_folder = 'public://banner/thumb/') {
  // Check directory and create it (if not exist)
  _grider_check_dir($banner_folder);
  _grider_check_dir($banner_thumb_folder);

  $parts = pathinfo($file->filename);
  $destination = $banner_folder . $parts['basename'];
  $setting = array();

  $file->status = FILE_STATUS_PERMANENT;

  // Copy temporary image into banner folder
  if ($img = file_copy($file, $destination, FILE_EXISTS_REPLACE)) {
    // Generate image thumb
    $image = image_load($destination);
    $small_img = image_scale($image, 100, 59);
    $image->source = $banner_thumb_folder . $parts['basename'];
    image_save($image);

    // Set image info
    $setting['image_path'] = $destination;
    $setting['image_thumb'] = $image->source;
    $setting['image_title'] = '';
    $setting['image_description'] = '';
    $setting['image_url'] = '<front>';
    $setting['image_url_title'] = 'Read more';
    $setting['image_weight'] = 0;
    $setting['image_published'] = FALSE;


    return $setting;
  }

  return FALSE;
}

/**
 * Provvide default installation settings for grider.
 */
function _grider_install() {
  // Deafault data
  $file = new stdClass;
  $banners = array();
  // Source base for images

  $src_base_path = drupal_get_path('theme', 'grider');
  $default_banners = theme_get_setting('default_banners', 'grider');


  // Put all image as banners
  foreach ($default_banners as $i => $data) {
    $file->uri = $src_base_path . '/' . $data['image_path'];
    $file->filename = $file->uri;

    $banner = _grider_save_image($file);
    unset($data['image_path']);
    $banner = array_merge($banner, $data);
    $banners[$i] = $banner;
  }

  // Save banner data
  grider_set_banners($banners);

  // Flag theme is installed
  variable_set('theme_grider_first_install', FALSE);
}

/**
 * Generate form to mange banner informations
 *
 * @param <array> $image_data
 *    Array with image data
 *
 * @return <array>
 *    Form to manage image informations
 */
function _grider_banner_form($image_data) {
  $img_form = array();

  // Image preview
  $img_form['image_preview'] = array(
      '#markup' => theme('image', array('path' => $image_data['image_thumb'])),
  );

  // Image path
  $img_form['image_path'] = array(
      '#type' => 'hidden',
      '#value' => $image_data['image_path'],
  );

  // Thumbnail path
  $img_form['image_thumb'] = array(
      '#type' => 'hidden',
      '#value' => $image_data['image_thumb'],
  );

  // Image title
  $img_form['image_title'] = array(
      '#type' => 'textfield',
      '#title' => t('Title'),
      '#default_value' => $image_data['image_title'],
  );

  // Image description
  $img_form['image_description'] = array(
      '#type' => 'textarea',
      '#title' => t('Description'),
      '#default_value' => $image_data['image_description'],
  );

  // Link url
  $img_form['image_url'] = array(
      '#type' => 'textfield',
      '#title' => t('Link'),
      '#default_value' => $image_data['image_url'],
  );

  $img_form['image_url_title'] = array(
      '#type' => 'textfield',
      '#title' => t('Link title'),
      '#default_value' => $image_data['image_url_title'],
  );

  // Image weight
  $img_form['image_weight'] = array(
      '#type' => 'weight',
      '#title' => t('Weight'),
      '#default_value' => $image_data['image_weight'],
  );

  // Image is published
  $img_form['image_published'] = array(
      '#type' => 'checkbox',
      '#title' => t('Published'),
      '#default_value' => $image_data['image_published'],
  );

  // Delete image
  $img_form['image_delete'] = array(
      '#type' => 'checkbox',
      '#title' => t('Delete image.'),
      '#default_value' => FALSE,
  );

  return $img_form;
}

