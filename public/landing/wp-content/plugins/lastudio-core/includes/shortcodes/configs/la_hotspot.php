<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

if ( !class_exists( 'WPBakeryShortCode_la_hotspot' ) ) {
    class WPBakeryShortCode_la_hotspot extends LaStudio_Shortcodes_Abstract{

    }
}

$shortcode_params = array(
    array(
        'type'          => 'dropdown',
        'save_always'   => true,
        'heading'       => __('Position', 'la-studio'),
        'param_name'    => 'position',
        'value'         => array(
            __('Top', 'la-studio')      => 'top',
            __('Right', 'la-studio')    => 'right',
            __('Bottom', 'la-studio')   => 'bottom',
            __('Left', 'la-studio')     => 'left'
        )
    ),
    array(
        'type'          => 'textfield',
        'heading'       => __('Left', 'la-studio'),
        'param_name'    => 'left'
    ),
    array(
        'type'          => 'textfield',
        'heading'       => __('Top', 'la-studio'),
        'param_name'    => 'top'
    ),
    array(
        'type'          => 'textarea_html',
        'heading'       => __('Content', 'la-studio'),
        'param_name'    => 'content'
    )
);


return apply_filters(
    'LaStudio/shortcodes/configs',
    array(
        'name'                      => __('LA Hotspot', 'la-studio'),
        'base'                      => 'la_hotspot',
        'allowed_container_element' => 'vc_row',
        'content_element'           => false,
        'params' 		            => $shortcode_params
    ),
    'la_hotspot'
);