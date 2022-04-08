<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

if ( !class_exists( 'WPBakeryShortCode_product' ) ) {
    class WPBakeryShortCode_product extends LaStudio_Shortcodes_Abstract{

    }
}

$shortcode_params = array(
    array(
        'type' => 'autocomplete',
        'heading' => __( 'Select identificator', 'la-studio' ),
        'param_name' => 'id',
        'description' => __( 'Input product ID or product SKU or product title to see suggestions', 'la-studio' ),
    ),
    array(
        'type' => 'hidden',
        'param_name' => 'sku',
    ),
    array(
        'type' => 'dropdown',
        'heading' => __('Layout','la-studio'),
        'param_name' => 'layout',
        'value' => array(
            __('List','la-studio') => 'list',
            __('Grid','la-studio') => 'grid'
        ),
        'default' => 'grid'
    ),
    array(
        'type' => 'dropdown',
        'heading' => __('Style','la-studio'),
        'param_name' => 'list_style',
        'value' => array(
            __('Default','la-studio') => 'default',
            __('Mini','la-studio') => 'mini'
        ),
        'dependency' => array(
            'element'   => 'layout',
            'value'     => 'list'
        ),
        'default' => 'default'
    ),
    array(
        'type' => 'dropdown',
        'heading' => __('Style','la-studio'),
        'param_name' => 'grid_style',
        'value' => array(
            __('Design 01','la-studio') => '1',
            __('Design 02','la-studio') => '2'
        ),
        'dependency' => array(
            'element'   => 'layout',
            'value'     => 'grid'
        ),
        'default' => '1'
    ),
    array(
        'type' 			=> 'checkbox',
        'heading' 		=> __( 'Enable Custom Image Size', 'la-studio' ),
        'param_name' 	=> 'enable_custom_image_size',
        'value' 		=> array( __( 'Yes', 'la-studio' ) => 'yes' ),
    ),
    array(
        'type' 			=> 'checkbox',
        'heading' 		=> __( 'Disable alternative image ', 'la-studio' ),
        'param_name' 	=> 'disable_alt_image',
        'value' 		=> array( __( 'Yes', 'la-studio' ) => 'yes' ),
    ),
    LaStudio_Shortcodes_Helper::fieldImageSize(array(
        'dependency' => array(
            'element'   => 'enable_custom_image_size',
            'value'     => 'yes'
        )
    )),
    array(
        'type' => 'checkbox',
        'heading' => __( 'Enable Ajax Loading', 'la-studio' ),
        'param_name' => 'enable_ajax_loader',
        'value' => array( __( 'Yes', 'la-studio' ) => 'yes' ),
    ),
    LaStudio_Shortcodes_Helper::fieldExtraClass()
);


return apply_filters(
    'LaStudio/shortcodes/configs',
    array(
        'name'			=> __('Product', 'la-studio'),
        'base'			=> 'product',
        'icon'          => 'icon-wpb-woocommerce',
        'category'  	=> __('La Studio', 'la-studio'),
        'description' 	=> __('Show a single product by ID or SKU.','la-studio'),
        'params' 		=> $shortcode_params
    ),
    'product'
);