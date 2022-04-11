<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 *
 * Field: Wysiwyg
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
class LaStudio_Framework_Field_wp_editor extends LaStudio_Framework_Field_Base {

  public function __construct( $field, $value = '', $unique = '' ) {
    parent::__construct( $field, $value, $unique );
  }

  public function output() {

    echo $this->element_before();

    $defaults = array(
      'textarea_rows' => 10,
      'textarea_name' => $this->element_name()
    );

    $settings    = ( ! empty( $this->field['settings'] ) ) ? $this->field['settings'] : array();
    $settings    = wp_parse_args( $settings, $defaults );

    $field_id    = ( ! empty( $this->field['id'] ) ) ? $this->field['id'] : '';
    $field_value = $this->element_value();

    $la_attr = '';

    if(!empty( $this->field['attributes']['data-customize-setting-link'] )){
      $la_attr .= ' data-la-customize-setting-link="' . $this->field['attributes']['data-customize-setting-link'] . '"';
      $la_attr .= ' data-la-customize-setting-key="'. (( isset( $this->field['id'] ) ) ? $this->field['id'] : '') .'"';
      unset($this->field['attributes']['data-customize-setting-link']);
    }

    echo '<div' . $this->element_class('la-parent-wp-editor-fields') . $la_attr .'></div>';

    wp_editor( $field_value, $field_id, $settings );

    echo $this->element_after();

  }

}
