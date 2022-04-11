<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

if ( !class_exists( 'WPBakeryShortCode_la_divider' ) ) {
    class WPBakeryShortCode_la_divider extends LaStudio_Shortcodes_Abstract{

    }
}

$shortcode_params = array(
    array(
        'type' 			=> 'la_column',
        'heading' 		=> __('Space Height', 'la-studio'),
        'admin_label'   => true,
        'param_name' 	=> 'height',
        'unit'			=> 'px',
        'media'			=> array(
            'xlg'	=> '',
            'lg'	=> '',
            'md'	=> '',
            'sm'	=> '',
            'xs'	=> '',
            'mb'	=> ''
        )
    ),
    LaStudio_Shortcodes_Helper::fieldExtraClass()
);

return apply_filters(
    'LaStudio/shortcodes/configs',
    array(
        'name'			=> __('LaStudio Space', 'la-studio'),
        'base'			=> 'la_divider',
        'icon'          => 'la-wpb-icon icon-wpb-ui-empty_space',
        'category'  	=> __('La Studio', 'la-studio'),
        'description' 	=> __('Blank space with custom height.','la-studio'),
        'params' 		=> $shortcode_params
    ),
    'la_divider'
);