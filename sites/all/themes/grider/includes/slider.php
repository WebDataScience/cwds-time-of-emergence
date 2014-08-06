<?php

function slider_default($banners) {

  $op = '<div id="ei-slider" class="ei-slider">';

  $op .= '<ul class="ei-slider-large">';

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

    $op .= '<li>
                ' . $image . '
                <div class="ei-title">
                  <h2>' . $banner['image_title'] . '</h2>
                  <h3>' . $banner['image_description'] . '</h3>
                </div>
              </li>';
  }
  $op .= '</ul>';

  $op .= '<ul class="ei-slider-thumbs"><li class="ei-slider-element">Current</li>';
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

    $banner['image_url'] = ($banner['image_url'] == current_path()) ? FALSE : $banner['image_url'];
    if (!empty($banner['image_url'])) {
      $op .= '<li><a href="#">' . $banner['image_title'] . '</a>' . $image . '</li>';
    } else {
      $op .= '<li><a href="' . $banner['image_url'] . '">' . $banner['image_title'] . '</a>' . $image . '</li>';
    }
  }

  $op .= '</ul>';


  $op .= '</div>';
  return $op;
}

function slider_skitter($banners) {
  $op = '<div class="box_skitter box_skitter_large"><ul>';


  $effect_array = array('cubeRandom', 'cube', 'block', 'cubeStop', 'blind');
  foreach ($banners as $i => $banner) {

    if ($i > 4) {
      $i = 0;
    }
    $op .= '<li>';

    $variables = array(
        'path' => $banner['image_path'],
        'alt' => t('@image_desc', array('@image_desc' => $banner['image_title'])),
        'title' => t('@image_title', array('@image_title' => $banner['image_title'])),
        'attributes' => array(
            'class' => $effect_array[$i], // hide all the slides except #1
            'id' => 'slide-number-' . $i,
            'longdesc' => t('@image_desc', array('@image_desc' => $banner['image_description']))
        ),
    );
    // Draw image
    $image = theme('image', $variables);

    $op .= '<a href="#">' . $image . '</a>';

    $op .= '</li>';

    $i++;
  }

  $op .= '</ul></div>';

  return $op;
}

function slider_flexslider($banners) {

  $op = '<div class="flexslider"><ul class="slides">';
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

    $op .= '<li>
			<a href="#">' . $image . '</a>
			<div class="flex-caption">
			<h5>' . $banner['image_title'] . '</h5>
			<p>' . $banner['image_description'] . '</p>
								</div>
							</li>';
  }

  $op .= '</ul></div>';

  return $op;
}