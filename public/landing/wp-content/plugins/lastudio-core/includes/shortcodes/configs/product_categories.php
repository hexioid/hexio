<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

if ( !class_exists( 'WPBakeryShortCode_product_categories' ) ) {
    class WPBakeryShortCode_product_categories extends LaStudio_Shortcodes_Abstract{

    }
}

$shortcode_params = array(
    array(
        'type' => 'autocomplete',
        'heading' => __( 'Categories', 'la-studio' ),
        'param_name' => 'ids',
        'settings' => array(
            'multiple' => true,
            'sortable' => true,
        ),
        'save_always' => true,
        'description' => __( 'List of product categories', 'la-studio' ),
    ),
    array(
        'type' => 'la_number',
        'heading' => __( 'Maximum Category will be displayed', 'la-studio' ),
        'param_name' => 'number',
        'description' => __( 'The `number` field is used to display the number of products.', 'la-studio' ),
        'min' => 0,
        'max' => 50,
        'default' => 0
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
        'type' => 'checkbox',
        'heading' => __( 'Hide Empty', 'la-studio' ),
        'param_name' => 'hide_empty',
        'value' => array( __( 'Yes', 'la-studio') => '1' ),
    ),
    LaStudio_Shortcodes_Helper::fieldColumn(array(
        'heading' 		=> __('Columns', 'la-studio'),
        'param_name' 	=> 'columns'
    )),
    array(
        'type' => 'dropdown',
        'heading' => __('Style','la-studio'),
        'param_name' => 'style',
        'value' => array(
            __('Design 01','la-studio') => '1'
        ),
        'default' => '1'
    ),
    array(
        'type' 			=> 'checkbox',
        'heading' 		=> __( 'Enable Custom Image Size', 'la-studio' ),
        'param_name' 	=> 'enable_custom_image_size',
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
        'value'      => array( __( 'Yes', 'la-studio' ) => 'yes' )
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
        'name'			=> __('Product Categories', 'la-studio'),
        'base'			=> 'product_categories',
        'icon'          => 'icon-wpb-woocommerce',
        'category'  	=> __('La Studio', 'la-studio'),
        'description' 	=> __('Display product categories loop','la-studio'),
        'params' 		=> $shortcode_params
    ),
    'product_categories'
);