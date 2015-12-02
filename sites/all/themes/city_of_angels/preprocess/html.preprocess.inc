<?php 

function city_of_angels_preprocess_html(&$vars) {
$meta_ie_render_engine = array(
    '#type' => 'html_tag',
    '#tag' => 'meta',
    '#attributes' => array(
      'http-equiv' => 'X-UA-Compatible',
      'content' =>  'IE=edge',
    ),
    '#weight' => '-99999',
  );

 drupal_add_html_head($meta_ie_render_engine, 'meta_ie_render_engine');
drupal_add_js('sites/all/themes/city_of_angels/js/jcaption.min.js');
}