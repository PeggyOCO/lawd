<?php

/**
 * @file
 * Template overrides as well as (pre-)process and alter hooks for the
 * City of Angels theme.
 */
function city_of_angels_preprocess_node(&$variables) {

  $wrapper = entity_metadata_wrapper('node', $node); 
  foreach ($wrapper->field_largeright as $i){
      //print $i->field_image1->value(); 
      dsm($i);
 }

}