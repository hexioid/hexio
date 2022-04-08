<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 *
 * Field: Switcher
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
class LaStudio_Framework_Field_switcher extends LaStudio_Framework_Field_Base {

  public function __construct( $field, $value = '', $unique = '' ) {
    parent::__construct( $field, $value, $unique );
  }

  public function output() {

    echo $this->element_before();
    $label = ( isset( $this->field['label'] ) ) ? '<div class="la-text-desc">'. $this->field['label'] . '</div>' : '';
    echo '<label><input type="checkbox" name="'. $this->element_name() .'" value="1"'. $this->element_class() . $this->element_attributes() . checked( $this->element_value(), 1, false ) .'/><em data-on="'. __( 'on', 'la-studio' ) .'" data-off="'. __( 'off', 'la-studio' ) .'"></em><span></span></label>' . $label;
    echo $this->element_after();

  }

}