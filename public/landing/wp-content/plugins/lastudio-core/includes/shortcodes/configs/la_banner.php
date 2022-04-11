<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

if ( !class_exists( 'WPBakeryShortCode_la_banner' ) ) {
    class WPBakeryShortCode_la_banner extends LaStudio_Shortcodes_Abstract{

    }
}

$shortcode_params = array(
    array(
        'type' => 'attach_image',
        'heading' => __('Upload the banner image', 'la-studio'),
        'param_name' => 'banner_id'
    ),
    array(
        'type' => 'dropdown',
        'heading' => __('Design','la-studio'),
        'param_name' => 'style',
        'value' => array(
            __('Default','la-studio') => 'default',
            __('Description at bottom','la-studio') => '1',
            __('Description at left center','la-studio') => '2',
            __('Description at right center','la-studio') => '3',
            __('Display content when mouse over','la-studio') => 'hover_effect',
            __('Centered Description','la-studio') => 'centered'
        ),
        'default' => 'default',
        'dependency' => array(
            'element'   => 'banner_id',
            'not_empty'     => true
        ),
    ),
    array(
        'type' => 'colorpicker',
        'heading' => __('Background Overlay', 'la-studio'),
        'param_name' => 'bg_overlay',
        'dependency' => array(
            'element'   => 'banner_id',
            'not_empty'     => true
        ),
        'group' => __('Design', 'la-studio')
    ),
    array(
        'type' => 'colorpicker',
        'heading' => __('Background Overlay On Hover', 'la-studio'),
        'param_name' => 'bg_overlay_hover',
        'dependency' => array(
            'element'   => 'banner_id',
            'not_empty'     => true
        ),
        'group' => __('Design', 'la-studio')
    ),
    array(
        'type' => 'vc_link',
        'heading' => __('Banner Link', 'la-studio'),
        'param_name' => 'banner_link',
        'description' => __('Add link / select existing page to link to this banner', 'la-studio'),
        'dependency' => array(
            'element'   => 'banner_id',
            'not_empty'     => true
        )
    ),
    array(
        'type' => 'textarea_html',
        'heading' => __('Description', 'la-studio'),
        'param_name' => 'content',
        'dependency' => array(
            'element'   => 'banner_id',
            'not_empty'     => true
        )
    ),

    LaStudio_Shortcodes_Helper::fieldCssAnimation(array(
        'dependency' => array(
            'element'   => 'banner_id',
            'not_empty'     => true
        )
    )),
    LaStudio_Shortcodes_Helper::fieldExtraClass(array(
        'dependency' => array(
            'element'   => 'banner_id',
            'not_empty'     => true
        )
    ))
);

return apply_filters(
    'LaStudio/shortcodes/configs',
    array(
        'name'			=> __('Banner Box', 'la-studio'),
        'base'			=> 'la_banner',
        'icon'          => 'la-wpb-icon la_banner',
        'category'  	=> __('La Studio', 'la-studio'),
        'description'   => __('Displays the banner image with Information', 'la-studio'),
        'params' 		=> $shortcode_params
    ),
    'la_banner'
);