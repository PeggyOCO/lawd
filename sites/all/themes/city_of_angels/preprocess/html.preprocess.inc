<?php 

function city_of_angels_preprocess_html(&$vars) {

$theme_path = drupal_get_path('theme', 'city_of_angels');
require_once $theme_path . '/includes/Mobile_Detect.php'; //This include is important to add desired classes to the menus
//require_once '../includes/Mobile_Detect.php';
$detect = new Mobile_Detect;

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

/*drupal_add_js('sites/all/themes/city_of_angels/js/jcaption.js');*/
drupal_add_js('sites/all/themes/city_of_angels/js/jquery.hover_caption.js');
}