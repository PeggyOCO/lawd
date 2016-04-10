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

/*function city_of_angels_html_head_alter(&$head_elements) {
  unset($head_elements['viewport']);
  $head_elements['viewport'] = array(
    '#type' => 'html_tag',
    '#tag' => 'meta',
    '#attributes' => array('name' => 'viewport' , 'content' => 'width=device-width, maximum-scale=1.0, minimum-scale=1.0, initial-scale=1.0'),
    '#weight' => -1001,
  );
  }*/
