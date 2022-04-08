<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

if ( !class_exists( 'WPBakeryShortCode_la_block' ) ) {
    class WPBakeryShortCode_la_block extends LaStudio_Shortcodes_Abstract{

    }
}

$shortcode_params = array(
    array(
        'type' => 'autocomplete',
        'heading' => __( 'Select identificator', 'la-studio' ),
        'param_name' => 'id',
        'description' => __( 'Input block ID or block title to see suggestions', 'la-studio' ),
    ),
    array(
        'type' => 'hidden',
        'param_name' => 'name',
    ),
    LaStudio_Shortcodes_Helper::fieldExtraClass(),
);


return apply_filters(
    'LaStudio/shortcodes/configs',
    array(
        'name'			=> __('La Custom Block', 'la-studio'),
        'base'			=> 'la_block',
        'icon'          => 'la-wpb-icon la_block',
        'category'  	=> __('La Studio', 'la-studio'),
        'description'   => __('Displays the custom block', 'la-studio'),
        'params' 		=> $shortcode_params
    ),
    'la_block'
);