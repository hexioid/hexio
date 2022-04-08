<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 *
 * WP Customize custom controls
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
class LaStudio_Customize_Control extends WP_Customize_Control {

  public $unique  = '';
  public $type    = 'la_field';
  public $options = array();

  public function render_content() {

    $this->options['id'] = $this->id;
    $this->options['default'] = $this->setting->default;
    $this->options['attributes']['data-customize-setting-link'] = $this->settings['default']->id;
    if(!empty($this->options) && 'wp_editor' === $this->options['type']){
      do_action('admin_print_footer_scripts');
    }
    echo la_fw_add_element( $this->options, $this->value(), $this->unique );
  }

}