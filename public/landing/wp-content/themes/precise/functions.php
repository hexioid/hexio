<?php

/**
 * Require plugins vendor
 */

require_once get_template_directory() . '/plugins/tgm-plugin-activation/class-tgm-plugin-activation.php';
require_once get_template_directory() . '/plugins/plugins.php';

/**
 * Include the main class.
 */

include_once get_template_directory() . '/framework/classes/class-precise.php';


Precise::$template_dir_path   = get_template_directory();
Precise::$template_dir_url    = get_template_directory_uri();
Precise::$stylesheet_dir_path = get_stylesheet_directory();
Precise::$stylesheet_dir_url  = get_stylesheet_directory_uri();

/**
 * Include the autoloader.
 */
include_once Precise::$template_dir_path . '/framework/classes/class-autoload.php';

new Precise_Autoload();

/**
 * load functions for later usage
 */

require_once Precise::$template_dir_path . '/framework/functions/functions.php';

new Precise_Multilingual();

if(!function_exists('precise_init_options')){
    function precise_init_options(){
        Precise::$options = Precise_Options::get_instance();
    }
    precise_init_options();
}

if(!function_exists('Precise')){
    function Precise(){
        return Precise::get_instance();
    }
}

new Precise_Scripts();

new Precise_Admin();

new Precise_WooCommerce();

Precise_Visual_Composer::get_instance();

/**
 * Set the $content_width global.
 */
global $content_width;
if ( ! is_admin() ) {
    if ( ! isset( $content_width ) || empty( $content_width ) ) {
        $content_width = (int) Precise()->layout->get_content_width();
    }
}

require_once Precise::$template_dir_path . '/framework/functions/extra-functions.php';