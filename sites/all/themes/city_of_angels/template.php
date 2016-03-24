<?php

/**
 * @file
 * Template overrides as well as (pre-)process and alter hooks for the
 * City of Angels theme.
 */
function city_of_angels_preprocess_field(&$variables) {
	if($variables['element']['#field_name'] == 'field_fourup') {
            //dsm($variables['items'][0]['#item']);
      for($i=0;$i < 4;$i++){
            $variables['items'][$i]['#prefix']="<div class='inlinefourup'>";
            $variables['items'][$i]['#suffix']="</div>";}
	}
}

function city_of_angels_preprocess_html(&$vars) {
dpm $vars;
  
  /* Setup Viewport Meta Tag
  $viewport = array(
    '#type' => 'html_tag',
    '#tag' => 'meta',
    '#attributes' => array(
      'name' => 'viewport',
      'content' => 'width=device-width, initial-scale=1.0',
    )
  );*/
  
  /* Add Viewport Meta Tag to head
  drupal_add_html_head($viewport, 'viewport');*/
}