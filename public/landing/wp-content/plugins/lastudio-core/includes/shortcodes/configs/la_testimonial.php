<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

if ( !class_exists( 'WPBakeryShortCode_la_testimonial' ) ) {
    class WPBakeryShortCode_la_testimonial extends LaStudio_Shortcodes_Abstract{

    }
}

$carousel = LaStudio_Shortcodes_Helper::fieldCarousel(array(
    'element' => 'enable_carousel',
    'not_empty' => true
));
$shortcode_params = array(
    array(
        'type' => 'dropdown',
        'heading' => __('Design','la-studio'),
        'param_name' => 'style',
        'value' => array(
            __('Style 01','la-studio') => '1',
            __('Style 02','la-studio') => '2',
        ),
        'default' => '1',
        'admin_label' => true
    ),
    array(
        'type'       => 'autocomplete',
        'heading'    => __( 'Choose member', 'la-studio' ),
        'param_name' => 'ids',
        'settings'   => array(
            'unique_values'  => true,
            'multiple'       => true,
            'sortable'       => true,
            'groups'         => false,
            'min_length'     => 1,
            'auto_focus'     => true,
            'display_inline' => true
        ),
    ),
    array(
        'type'       => 'checkbox',
        'heading'    => __('Enable slider', 'la-studio' ),
        'param_name' => 'enable_carousel',
        'value'      => array( __( 'Yes', 'la-studio' ) => 'yes' ),
        'dependency' => array(
            'element' 	            => 'style',
            'value_not_equal_to' 	=> array('6')
        )
    ),

    LaStudio_Shortcodes_Helper::fieldColumn(array(
        'dependency' => array(
            'element' 	            => 'style',
            'value_not_equal_to' 	=> array('6')
        )
    )),
    LaStudio_Shortcodes_Helper::fieldExtraClass()
);

$shortcode_params = array_merge( $shortcode_params, $carousel);

return apply_filters(
    'LaStudio/shortcodes/configs',
    array(
        'name'			=> __('Testimonials', 'la-studio'),
        'base'			=> 'la_testimonial',
        'icon'          => 'la-wpb-icon la_testimonial',
        'category'  	=> __('La Studio', 'la-studio'),
        'description' 	=> __('Display the testimonial','la-studio'),
        'params' 		=> $shortcode_params
    ),
    'la_testimonial'
);