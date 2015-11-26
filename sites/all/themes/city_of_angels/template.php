<?php

/**
 * @file
 * Template overrides as well as (pre-)process and alter hooks for the
 * City of Angels theme.
 */
function city_of_angels_preprocess_field(&$variables) {
	if($variables['element']['#field_name'] == 'field_fourup') {
            dsm($variables['items'][0]);
	}
}

