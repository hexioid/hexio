<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

if ( !class_exists( 'WPBakeryShortCode_la_show_portfolios' ) ) {
    class WPBakeryShortCode_la_show_portfolios extends LaStudio_Shortcodes_Abstract{

    }
}

$carousel = LaStudio_Shortcodes_Helper::fieldCarousel(array(
    'element' => 'enable_carousel',
    'not_empty' => true
));
$shortcode_params = array(
    array(
        'type' => 'dropdown',
        'heading' => __('Layout','la-studio'),
        'param_name' => 'layout',
        'value' => array(
            __('Grid','la-studio') => 'grid'
        ),
        'default' => 'grid'
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
        'heading' => __('Style','la-studio'),
        'param_name' => 'list_style',
        'value' => array(
            __('Classic 01','la-studio') => '1',
            __('Classic 02','la-studio') => '2',
            __('Classic 03','la-studio') => '3'
        ),
        'dependency' => array(
            'element'   => 'layout',
            'value'     => 'list'
        ),
        'default' => '1'
    ),
    array(
        'type'       => 'autocomplete',
        'heading'    => __( 'Category In:', 'la-studio' ),
        'param_name' => 'category__in',
        'settings'   => array(
            'unique_values'  => true,
            'multiple'       => true,
            'sortable'       => true,
            'groups'         => false,
            'min_length'     => 0,
            'auto_focus'     => true,
            'display_inline' => true,
        ),
        'group' => __('Query Settings', 'la-studio')
    ),
    array(
        'type'       => 'autocomplete',
        'heading'    => __( 'Category Not In:', 'la-studio' ),
        'param_name' => 'category__not_in',
        'settings'   => array(
            'unique_values'  => true,
            'multiple'       => true,
            'sortable'       => true,
            'groups'         => false,
            'min_length'     => 0,
            'auto_focus'     => true,
            'display_inline' => true,
        ),
        'group' => __('Query Settings', 'la-studio')
    ),
    array(
        'type'       => 'autocomplete',
        'heading'    => __( 'Post In:', 'la-studio' ),
        'param_name' => 'post__in',
        'settings'   => array(
            'unique_values'  => true,
            'multiple'       => true,
            'sortable'       => true,
            'groups'         => false,
            'min_length'     => 0,
            'auto_focus'     => true,
            'display_inline' => true,
        ),
        'group' => __('Query Settings', 'la-studio')
    ),
    array(
        'type'       => 'autocomplete',
        'heading'    => __( 'Post Not In:', 'la-studio' ),
        'param_name' => 'post__not_in',
        'settings'   => array(
            'unique_values'  => true,
            'multiple'       => true,
            'sortable'       => true,
            'groups'         => false,
            'min_length'     => 0,
            'auto_focus'     => true,
            'display_inline' => true,
        ),
        'group' => __('Query Settings', 'la-studio')
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
        'group' => __('Query Settings', 'la-studio')
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
        'group' => __('Query Settings', 'la-studio')
    ),
    array(
        'type' => 'la_number',
        'heading' => __('Total items', 'la-studio'),
        'description' => __('Set max limit for items in grid or enter -1 to display all (limited to 1000).', 'la-studio'),
        'param_name' => 'per_page',
        'value' => -1,
        'min' => -1,
        'max' => 1000,
        'group' => __('Query Settings', 'la-studio')
    ),
    array(
        'type' => 'hidden',
        'heading' => __('Paged', 'la-studio'),
        'param_name' => 'paged',
        'value' => '1',
        'group' => __('Query Settings', 'la-studio')
    ),
    array(
        'type' => 'dropdown',
        'heading' => __('Item title tag','la-studio'),
        'param_name' => 'title_tag',
        'value' => array(
            __('Default','la-studio') => 'h3',
            __('H1','la-studio') => 'h1',
            __('H2','la-studio') => 'h2',
            __('H4','la-studio') => 'h4',
            __('H5','la-studio') => 'h5',
            __('H6','la-studio') => 'h6',
            __('DIV','la-studio') => 'div',
        ),
        'default' => 'h3',
        'description' => __('Default is H3', 'la-studio'),
        'group' => __('Item Settings', 'la-studio')
    ),
    LaStudio_Shortcodes_Helper::fieldImageSize(array(
        'group' => __('Item Settings', 'la-studio')
    )),
    array(
        'type' => 'dropdown',
        'heading' => __('Item padding','la-studio'),
        'description' => __('Select gap between item in grids.', 'la-studio'),
        'param_name' => 'item_gap',
        'value' => array(
            __('0px','la-studio') => '0',
            __('5px','la-studio') => '5',
            __('10px','la-studio') => '10',
            __('15px','la-studio') => '15',
            __('20px','la-studio') => '20',
            __('25px','la-studio') => '25',
            __('30px','la-studio') => '30',
            __('35px','la-studio') => '35',
            __('40px','la-studio') => '40',
            __('50px','la-studio') => '50',
            __('60px','la-studio') => '60',
            __('70px','la-studio') => '70',
        ),
        'default' => '0',
        'group' => __('Item Settings', 'la-studio')
    ),
    LaStudio_Shortcodes_Helper::fieldColumn(array(
        'dependency' => array(
            'element'   => 'layout',
            'value'     => array('grid', 'masonry')
        ),
    )),
    array(
        'type'       => 'checkbox',
        'heading'    => __('Enable slider', 'la-studio' ),
        'param_name' => 'enable_carousel',
        'value'      => array( __( 'Yes', 'la-studio' ) => 'yes' ),
        'dependency' => array(
            'element'   => 'layout',
            'value'     => array('grid')
        ),
    ),
    array(
        'type'       => 'checkbox',
        'heading'    => __( 'Enable Load More', 'la-studio' ),
        'param_name' => 'enable_loadmore',
        'value'      => array( __( 'Yes', 'la-studio' ) => 'yes' )
    ),
    array(
        'type' => 'textfield',
        'heading' => __('Load More Text', 'la-studio'),
        'param_name' => 'load_more_text',
        'value' => __('Load more', 'la-studio'),
        'dependency' => array( 'element' => 'enable_loadmore', 'value' => 'yes' ),
    ),
    LaStudio_Shortcodes_Helper::fieldExtraClass()
);

$shortcode_params = array_merge( $shortcode_params, $carousel);

return apply_filters(
    'LaStudio/shortcodes/configs',
    array(
        'name'			=> __('Show Portfolios', 'la-studio'),
        'base'			=> 'la_show_portfolios',
        'icon'          => 'la-wpb-icon la_show_portfolios',
        'category'  	=> __('La Studio', 'la-studio'),
        'description' 	=> __('Display portfolio with la-studio themes style.','la-studio'),
        'params' 		=> $shortcode_params
    ),
    'la_show_portfolios'
);