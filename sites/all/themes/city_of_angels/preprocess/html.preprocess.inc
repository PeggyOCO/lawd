<?php

/**
 * Implements hook_preprocess_page().
 */
function city_of_angels_preprocess_html(&$variables) {
  // You can use preprocess hooks to modify the variables before they are passed
  // to the theme function or template file.
    // Setup IE meta tag to force IE rendering mode
  $meta_ie_render_engine = array(
    '#type' => 'html_tag',
    '#tag' => 'meta',
    '#attributes' => array(
      'content' =>  'IE=edge,chrome=1',
      'http-equiv' => 'X-UA-Compatible',
    )
     '#weight' => '-99999',
  );
  
  // Add header meta tag for IE to head
  drupal_add_html_head($meta_ie_render_engine, 'meta_ie_render_engine');

}

