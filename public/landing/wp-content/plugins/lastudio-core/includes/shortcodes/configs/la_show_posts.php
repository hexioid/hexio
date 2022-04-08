<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

if ( !class_exists( 'WPBakeryShortCode_la_show_posts' ) ) {
    class WPBakeryShortCode_la_show_posts extends LaStudio_Shortcodes_Abstract{

    }
}

$carousel = LaStudio_Shortcodes_Helper::fieldCarousel(array(
    'element' => 'enable_carousel',
    'not_empty' => true
));
$shortcode_params = array(
//    array(
//        'type' => 'hidden',
//        'heading' => __('Layout', 'la-studio'),
//        'param_name' => 'layout',
//        'value' => 'blog'
//    ),
//    array(
//        'type' => 'dropdown',
//        'heading' => __('Layout','la-studio'),
//        'param_name' => 'layout',
//        'value' => array(
//            __('List','la-studio') => 'list',
//            __('Grid','la-studio') => 'grid',
//            __('Masonry', 'la-studio') => 'masonry',
//            __('Special', 'la-studio') => 'special'
//        ),
//        'default' => 'grid'
//    ),
    array(
        'type' => 'dropdown',
        'heading' => __('Layout','la-studio'),
        'param_name' => 'layout',
        'value' => array(
            __('Default','la-studio') => 'blog',
//            __('Special', 'la-studio') => 'special'
        ),
        'default' => 'blog'
    ),
    array(
        'type' => 'dropdown',
        'heading' => __('Blog Style','la-studio'),
        'param_name' => 'blog_style',
        'value' => array(
            __('Style 01','la-studio') => '1',
            __('Style 02','la-studio') => '2',
            __('Style 03','la-studio') => '3',
            __('Style 04','la-studio') => '4',
            __('List Sidebar','la-studio') => 'mini'
        ),
        'dependency' => array(
            'element'   => 'layout',
            'value'     => 'blog'
        ),
        'default' => '1'
    ),
    array(
        'type' => 'dropdown',
        'heading' => __('Style','la-studio'),
        'param_name' => 'list_style',
        'value' => array(
            __('Default','la-studio') => '1'
        ),
        'dependency' => array(
            'element'   => 'layout',
            'value'     => 'list'
        ),
        'default' => '1'
    ),
    array(
        'type' => 'dropdown',
        'heading' => __('Style','la-studio'),
        'param_name' => 'grid_style',
        'value' => array(
            __('Style 01','la-studio') => '1',
            __('Style 02','la-studio') => '2',
            __('Style 03','la-studio') => '3',
            __('Style 04','la-studio') => '4'
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
        'param_name' => 'masonry_style',
        'value' => array(
            __('Style 01','la-studio') => '1',
            __('Style 02','la-studio') => '2',
            __('Style 03','la-studio') => '3',
            __('Style 04','la-studio') => '4'
        ),
        'dependency' => array(
            'element'   => 'layout',
            'value'     => 'masonry'
        ),
        'default' => '1'
    ),
    array(
        'type' => 'dropdown',
        'heading' => __('Style','la-studio'),
        'param_name' => 'special_style',
        'value' => array(
            __('Default', 'la-studio') => '1'
        ),
        'dependency' => array(
            'element'   => 'layout',
            'value'     => 'special'
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
    array(
        'type' => 'la_number',
        'heading' => __('Excerpt Length', 'la-studio'),
        'param_name' => 'excerpt_length',
        'value' => 20,
        'min' => 1,
        'max' => 100,
        'suffix' => '',
        'group' => __('Item Settings', 'la-studio')
    ),
    LaStudio_Shortcodes_Helper::fieldImageSize(array(
        'group' => __('Item Settings', 'la-studio')
    )),
    array(
        'type' 			=> 'textfield',
        'heading' 		=> __('Image size 2', 'la-studio'),
        'param_name' 	=> 'img_size2',
        'value'			=> 'thumbnail',
        'description' 	=> __('Enter image size ( For Special Style ).', 'la-studio'),
        'group'         => __('Item Settings', 'la-studio'),
        'dependency' => array(
            'element'   => 'special_style',
            'value'     => array('1')
        )
    ),
    LaStudio_Shortcodes_Helper::fieldColumn(array(
        'dependency' => array(
            'element'   => 'layout',
            'value'     => array('grid','masonry','blog')
        ),
    )),
    array(
        'type'       => 'checkbox',
        'heading'    => __('Enable slider', 'la-studio' ),
        'param_name' => 'enable_carousel',
        'value'      => array( __( 'Yes', 'la-studio' ) => 'yes' ),
        'dependency' => array(
            'element'   => 'layout',
            'value'     => array('grid','blog')
        )
    ),
    array(
        'type' => 'dropdown',
        'heading' => __('Display Style','la-studio'),
        'description' => __('Select display style for grid.', 'la-studio'),
        'param_name' => 'style',
        'value' => array(
            __('Show all','la-studio') => 'all',
            __('Load more button','la-studio') => 'load-more',
            __('Pagination','la-studio') => 'pagination',
        ),
        'default' => 'all',
        'dependency' => array(
            'element'               => 'layout',
            'value_not_equals_to'   => array('special')
        )
    ),
    array(
        'type' => 'la_number',
        'heading' => __('Total items', 'la-studio'),
        'description' => __('Set max limit for items in grid or enter -1 to display all (limited to 1000).', 'la-studio'),
        'param_name' => 'per_page',
        'value' => 4,
        'min' => -1,
        'max' => 1000
    ),
    array(
        'type' => 'hidden',
        'heading' => __('Paged', 'la-studio'),
        'param_name' => 'paged',
        'value' => '1'
    ),
    array(
        'type' => 'la_number',
        'heading' => __('Number items showing', 'la-studio'),
        'param_name' => 'items_per_page',
        'description' => __('Number of items to show per page.', 'la-studio'),
        'value' => 4,
        'min' => 1,
        'max' => 1000,
        'dependency' => array(
            'element'   => 'style',
            'value'     => array('load-more','pagination')
        )
    ),
    array(
        'type' => 'textfield',
        'heading' => __('Load more text', 'la-studio'),
        'param_name' => 'load_more_text',
        'value' => 'Read more',
        'dependency' => array(
            'element'   => 'style',
            'value'     => 'load-more'
        )
    ),

    LaStudio_Shortcodes_Helper::fieldExtraClass()
);


$shortcode_params = array_merge( $shortcode_params, $carousel);

return apply_filters(
    'LaStudio/shortcodes/configs',
    array(
        'name'			=> __('Blog Posts', 'la-studio'),
        'base'			=> 'la_show_posts',
        'icon'          => 'icon-wpb-application-icon-large',
        'category'  	=> __('La Studio', 'la-studio'),
        'description' 	=> __('Display posts with la-studio themes style.','la-studio'),
        'params' 		=> $shortcode_params
    ),
    'la_show_posts'
);