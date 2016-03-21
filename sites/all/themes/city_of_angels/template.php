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

function city_of_angels_parallax_bg_admin_form_alter($form, &$form_state) {
          
          dsm($form);

          } 