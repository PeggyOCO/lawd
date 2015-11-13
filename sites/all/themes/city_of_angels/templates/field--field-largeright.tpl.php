<?php

/**
 * @file
 * Default theme implementation to display field-largeright.
 *
$items: An array of field values. Use render() to output them.
$label: The item label.
$label_hidden: Whether the label display is set to 'hidden'.
$classes: String of classes that can be used to style contextually through CSS. It can be manipulated through the variable $classes_array from preprocess functions. The default values can be one or more of the following:

$element['#object']: The entity to which the field is attached.
$element['#view_mode']: View mode, e.g. 'full', 'teaser'...
$element['#field_name']: The field name.
$element['#field_type']: The field type.
$element['#field_language']: The field language.
$element['#field_translatable']: Whether the field is translatable or not.
$element['#label_display']: Position of label display, inline, above, or hidden.
$field_name_css: The css-compatible field name.
$field_type_css: The css-compatible field type.
*/

//dsm($items[0]['entity']['field_collection_item'][5]['field_label_one']['#object']);
?>

<div class="surround">
<?php
print render($items[0]);

?>
</div>