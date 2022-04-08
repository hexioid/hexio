<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

if ( !class_exists( 'WPBakeryShortCode_products' ) ) {
    class WPBakeryShortCode_products extends LaStudio_Shortcodes_Abstract{

    }
}

$shortcode_params = array(
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
        'type' => 'dropdown',
        'heading' => __( 'Order by', 'la-studio' ),
        'param_name' => 'orderby',
        'value' => array(
            '',
            __( 'Date', 'la-studio' ) => 'date',
            __( 'ID', 'la-studio' ) => 'ID',
            __( 'Author', 'la-studio' ) => 'author',
            __( 'Title', 'la-studio' ) => 'title',
            __( 'Modified', 'la-studio' ) => 'modified',
            __( 'Random', 'la-studio' ) => 'rand',
            __( 'Comment count', 'la-studio' ) => 'comment_count',
            __( 'Menu order', 'la-studio' ) => 'menu_order',
        ),
        'save_always' => true,
        'description' => sprintf( __( 'Select how to sort retrieved products. More at %s.', 'la-studio' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
    ),
    array(
        'type' => 'dropdown',
        'heading' => __( 'Sort order', 'la-studio' ),
        'param_name' => 'order',
        'value' => array(
            '',
            __( 'Descending', 'la-studio' ) => 'DESC',
            __( 'Ascending', 'la-studio' ) => 'ASC',
        ),
        'save_always' => true,
        'description' => sprintf( __( 'Designates the ascending or descending order. More at %s.', 'la-studio' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
    ),
    array(
        'type' => 'autocomplete',
        'heading' => __( 'Products', 'la-studio' ),
        'param_name' => 'ids',
        'settings' => array(
            'multiple' => true,
            'sortable' => true,
            'unique_values' => true
        ),
        'save_always' => true,
        'description' => __( 'Enter List of Products', 'la-studio' ),
    ),
    array(
        'type' => 'hidden',
        'param_name' => 'skus',
    ),
    array(
        'type' => 'hidden',
        'heading' => __('Paged', 'la-studio'),
        'param_name' => 'paged',
        'value' => '1'
    ),
    LaStudio_Shortcodes_Helper::fieldColumn(array(
        'heading' 		=> __('Columns', 'la-studio'),
        'param_name' 	=> 'columns',
        'dependency' => array(
            'element'   => 'layout',
            'value'     => array('grid')
        )
    )),
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
        'type'       => 'checkbox',
        'heading'    => __('Enable slider', 'la-studio' ),
        'param_name' => 'enable_carousel',
        'value'      => array( __( 'Yes', 'la-studio' ) => 'yes' ),
        'dependency' => array(
            'element'   => 'layout',
            'value'     => 'grid'
        )
    ),
    array(
        'type' => 'checkbox',
        'heading' => __( 'Enable Ajax Loading', 'la-studio' ),
        'param_name' => 'enable_ajax_loader',
        'value' => array( __( 'Yes', 'la-studio' ) => 'yes' ),
    ),
    LaStudio_Shortcodes_Helper::fieldExtraClass()
);
$carousel = LaStudio_Shortcodes_Helper::fieldCarousel(array(
    'element' => 'enable_carousel',
    'not_empty' => true
));
$shortcode_params = array_merge( $shortcode_params, $carousel);

return apply_filters(
    'LaStudio/shortcodes/configs',
    array(
        'name'			=> __('Products', 'la-studio'),
        'base'			=> 'products',
        'icon'          => 'icon-wpb-woocommerce',
        'category'  	=> __('La Studio', 'la-studio'),
        'description' 	=> __('Show multi product by ID or SKU','la-studio'),
        'params' 		=> $shortcode_params
    ),
    'products'
);