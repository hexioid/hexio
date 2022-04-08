<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

if ( !class_exists( 'WPBakeryShortCode_la_social_link' ) ) {
    class WPBakeryShortCode_la_social_link extends LaStudio_Shortcodes_Abstract{

    }
}

$shortcode_params = array(
    array(
        'type' => 'dropdown',
        'heading' => __('Style','la-studio'),
        'param_name' => 'style',
        'value' => array(
            __('Default','la-studio') => 'default',
            __('Circle','la-studio') => 'circle',
            __('Square','la-studio') => 'square',
            __('Round','la-studio') => 'round',
        ),
        'default' => 'default'
    ),
    LaStudio_Shortcodes_Helper::fieldExtraClass(),
);

return apply_filters(
    'LaStudio/shortcodes/configs',
    array(
        'name'			=> __('Social Media Link', 'la-studio'),
        'base'			=> 'la_social_link',
        'icon'          => 'la_social_link fa fa-share-alt',
        'category'  	=> __('La Studio', 'la-studio'),
        'description' 	=> __('Display Social Media Link.','la-studio'),
        'params' 		=> $shortcode_params
    ),
    'la_social_link'
);