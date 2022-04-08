<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 *
 * Field: Backup
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
class LaStudio_Framework_Field_backup extends LaStudio_Framework_Field_Base {

  public function __construct( $field, $value = '', $unique = '' ) {
    parent::__construct( $field, $value, $unique );
  }

  public function output() {

    echo $this->element_before();

    echo '<textarea name="'. $this->unique .'[import]"'. $this->element_class() . $this->element_attributes() .'></textarea>';
    submit_button( __( 'Import a Backup', 'la-studio' ), 'primary la-import-backup', 'la_btn_opt_backup', false );
    echo '<small>( '. __( 'copy-paste your backup string here', 'la-studio' ).' )</small>';

    echo '<hr />';

    echo '<textarea name="_nonce"'. $this->element_class() . $this->element_attributes() .' disabled="disabled">'. esc_textarea( json_encode(get_option( $this->unique )) ) .'</textarea>';
    echo '<a href="'. admin_url( 'admin-ajax.php?action=la-export-options&unique=' .$this->unique ) .'" class="button button-primary" target="_blank">'. __( 'Export and Download Backup', 'la-studio' ) .'</a>';
    echo '<small>-( '. __( 'or', 'la-studio' ) .' )-</small>';
    submit_button( __( 'Reset All Options', 'la-studio' ), 'la-warning-primary la-reset-confirm', $this->unique . '[resetall]', false );
    echo '<small class="la-text-warning">'. __( 'Please be sure for reset all of framework options.', 'la-studio' ) .'</small>';

    echo $this->element_after();

  }

}
