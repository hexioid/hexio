<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

if ( !class_exists( 'WPBakeryShortCode_la_portfolio_masonry' ) ) {
    class WPBakeryShortCode_la_portfolio_masonry extends LaStudio_Shortcodes_Abstract{

    }
}

$shortcode_params = array(

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
            __( 'Date', 'la-studio' ) => 'date',
            __( 'ID', 'la-studio' ) => 'ID',
            __( 'Author', 'la-studio' ) => 'author',
            __( 'Title', 'la-studio' ) => 'title',
            __( 'Modified', 'la-studio' ) => 'modified',
            __( 'Random', 'la-studio' ) => 'rand',
            __( 'Comment count', 'la-studio' ) => 'comment_count',
            __( 'Menu order', 'la-studio' ) => 'menu_order',
        ),
        'default' => 'date',
        'description' => sprintf( __( 'Select how to sort retrieved products. More at %s.', 'la-studio' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
        'group' => __('Query Settings', 'la-studio')
    ),
    array(
        'type' => 'dropdown',
        'heading' => __( 'Sort order', 'la-studio' ),
        'param_name' => 'order',
        'default' => 'desc',
        'value' => array(
            __( 'Descending', 'la-studio' ) => 'desc',
            __( 'Ascending', 'la-studio' ) => 'asc',
        ),
        'description' => sprintf( __( 'Designates the ascending or descending order. More at %s.', 'la-studio' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
        'group' => __('Query Settings', 'la-studio')
    ),
    array(
        'type' => 'la_number',
        'heading' => __('Items per page', 'la-studio'),
        'description' => __('Set max limit for items in grid or enter -1 to display all (limited to 1000).', 'la-studio'),
        'param_name' => 'per_page',
        'value' => 10,
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
        'type'       => 'checkbox',
        'heading'    => __( 'Enable Skill Filter', 'la-studio' ),
        'param_name' => 'enable_skill_filter',
        'value'      => array( __( 'Yes', 'la-studio' ) => 'yes' ),
        'group' => __('Query Settings', 'la-studio')
    ),
    array(
        'type'       => 'checkbox',
        'heading'    => __( 'Enable Load More', 'la-studio' ),
        'param_name' => 'enable_loadmore',
        'value'      => array( __( 'Yes', 'la-studio' ) => 'yes' ),
        'group' => __('Query Settings', 'la-studio')
    ),
    array(
        'type' => 'textfield',
        'heading' => __('Load More Text', 'la-studio'),
        'param_name' => 'load_more_text',
        'value' => __('Load more', 'la-studio'),
        'dependency' => array( 'element' => 'enable_loadmore', 'value' => 'yes' ),
        'group' => __('Query Settings', 'la-studio')
    ),

    array(
        'type'       => 'autocomplete',
        'heading'    => __( 'Skill Filter', 'la-studio' ),
        'param_name' => 'filters',
        'settings'   => array(
            'unique_values'  => true,
            'multiple'       => true,
            'sortable'       => true,
            'groups'         => false,
            'min_length'     => 0,
            'auto_focus'     => true,
            'display_inline' => true,
        ),
        'dependency' => array(
            'element'   => 'enable_skill_filter',
            'value'     => 'yes'
        ),
        'group' => __('Skill Filters', 'la-studio'),
    ),
    array(
        'type' => 'dropdown',
        'heading' => __('Filter style','la-studio'),
        'param_name' => 'filter_style',
        'value' => array(
            __('Style 01','la-studio') => '1',
            __('Style 02','la-studio') => '2'
        ),
        'default' => '1',
        'dependency' => array(
            'element'   => 'enable_skill_filter',
            'value'     => 'yes'
        ),
        'group' => __('Skill Filters', 'la-studio')
    ),

    array(
        'type' => 'dropdown',
        'heading' => __('Design','la-studio'),
        'param_name' => 'masonry_style',
        'value' => array(
            __('Design 01','la-studio') => '1',
            __('Design 02','la-studio') => '2'
        ),
        'default' => '1',
        'group' => __('Item Settings', 'la-studio')
    ),

    array(
        'type' => 'dropdown',
        'heading' => __('Item Title HTML Tag','la-studio'),
        'param_name' => 'title_tag',
        'value' => array(
            __('Default','la-studio') => 'h5',
            __('H1','la-studio') => 'h1',
            __('H2','la-studio') => 'h2',
            __('H3','la-studio') => 'h3',
            __('H4','la-studio') => 'h4',
            __('H6','la-studio') => 'h6',
            __('DIV','la-studio') => 'div',
        ),
        'default' => 'h5',
        'description' => __('Default is H5', 'la-studio'),
        'group' => __('Item Settings', 'la-studio')
    ),

    array(
        'type' 			=> 'textfield',
        'heading' 		=> __('Image Size', 'la-studio'),
        'param_name' 	=> 'img_size',
        'value'			=> 'full',
        'description' 	=> __('Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height)).', 'la-studio'),
        'group' => __('Item Settings', 'la-studio')
    ),

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
            __('35px','la-studio') => '35'
        ),
        'default' => '15',
        'group' => __('Item Settings', 'la-studio')
    ),

    array(
        'type' => 'dropdown',
        'heading' => __('Column Type','la-studio'),
        'param_name' => 'column_type',
        'value' => array(
            __('Default','la-studio') => 'default',
            __('Custom','la-studio') => 'custom',
        ),
        'default' => 'default',
        'group' => __('Item Settings', 'la-studio')
    ),
    array(
        'type' 			=> 'la_column',
        'heading' 		=> __('Responsive Column', 'la-studio'),
        'param_name' 	=> 'column',
        'unit'			=> '',
        'media'			=> array(
            'xlg'	=> 1,
            'lg'	=> 1,
            'md'	=> 1,
            'sm'	=> 1,
            'xs'	=> 1,
            'mb'	=> 1
        ),
        'dependency'        => array(
            'element'   => 'column_type',
            'value'     => 'default'
        ),
        'group' => __('Item Settings', 'la-studio')
    ),

    array(
        'type' => 'la_number',
        'heading' => __('Portfolio Item Width', 'la-studio'),
        'param_name' => 'base_item_w',
        'description' => __('Set your portfolio item default width', 'la-studio'),
        'value' => 400,
        'min' => 100,
        'max' => 1920,
        'suffix' => 'px',
        'dependency'        => array(
            'element'   => 'column_type',
            'value'     => 'custom'
        ),
        'group' => __('Item Settings', 'la-studio')
    ),

    array(
        'type' => 'la_number',
        'heading' => __('Portfolio Item Height', 'la-studio'),
        'description' => __('Set your portfolio item default height', 'la-studio'),
        'param_name' => 'base_item_h',
        'value' => 400,
        'min' => 100,
        'max' => 1920,
        'suffix' => 'px',
        'dependency'        => array(
            'element'   => 'column_type',
            'value'     => 'custom'
        ),
        'group' => __('Item Settings', 'la-studio')
    ),

    array(
        'type' 			=> 'la_column',
        'heading' 		=> __('Mobile Column', 'la-studio'),
        'param_name' 	=> 'mb_column',
        'unit'			=> '',
        'media'			=> array(
            'md'	=> 1,
            'sm'	=> 1,
            'xs'	=> 1,
            'mb'	=> 1
        ),
        'dependency'        => array(
            'element'   => 'column_type',
            'value'     => 'custom'
        ),
        'group' => __('Item Settings', 'la-studio')
    ),

    array(
        'type'       => 'checkbox',
        'heading'    => __( 'Enable Custom Item Setting', 'la-studio' ),
        'param_name' => 'custom_item_size',
        'value'      => array( __( 'Yes', 'la-studio' ) => 'yes' ),
        'dependency'        => array(
            'element'   => 'column_type',
            'value'     => 'custom'
        ),
        'group' => __('Item Settings', 'la-studio')
    ),
    array(
        'type' => 'param_group',
        'param_name' => 'item_sizes',
        'heading' => __( 'Item Sizes', 'js_composer' ),
        'params' => array(
            array(
                'type' => 'dropdown',
                'heading' => __('Width','la-studio'),
                'description' 	=> __('it will occupy x width of base item width ( example: this item will be occupy 2x width of base width you need entered "2")', 'la-studio'),
                'param_name' => 'w',
                'admin_label' => true,
                'value' => array(
                    __('1/2x width','la-studio')    => '0.5',
                    __('1x width','la-studio')      => '1',
                    __('1.5x width','la-studio')    => '1.5',
                    __('2x width','la-studio')      => '2',
                    __('2.5x width','la-studio')    => '2.5',
                    __('3x width','la-studio')      => '3',
                    __('3.5x width','la-studio')    => '3.5',
                    __('4x width','la-studio')      => '4',
                ),
                'default' => '1'
            ),
            array(
                'type' => 'dropdown',
                'heading' => __('Height','la-studio'),
                'description' 	=> __('it will occupy x height of base item height ( example: this item will be occupy 2x height of base height you need entered "2")', 'la-studio'),
                'param_name' => 'h',
                'admin_label' => true,
                'value' => array(
                    __('1/2x height','la-studio')    => '0.5',
                    __('1x height','la-studio')      => '1',
                    __('1.5x height','la-studio')    => '1.5',
                    __('2x height','la-studio')      => '2',
                    __('2.5x height','la-studio')    => '2.5',
                    __('3x height','la-studio')      => '3',
                    __('3.5x height','la-studio')    => '3.5',
                    __('4x height','la-studio')      => '4',
                ),
                'default' => '1'
            ),
            array(
                'type' 			=> 'textfield',
                'heading' 		=> __('Custom Image Size', 'la-studio'),
                'param_name' 	=> 's',
                'description' 	=> __('leave blank to inherit from parent settings', 'la-studio')
            ),
        ),
        'dependency' => array(
            'element'   => 'custom_item_size',
            'value'     => 'yes'
        ),
        'group' => __('Item Settings', 'la-studio')
    ),

    array(
        'type' 			=> 'textfield',
        'heading' 		=> __('Extra Class name', 'la-studio'),
        'param_name' 	=> 'el_class',
        'description' 	=> __('Style particular content element differently - add a class name and refer to it in custom CSS.', 'la-studio'),
        'group' => __('Item Settings', 'la-studio')
    )
);

return apply_filters(
    'LaStudio/shortcodes/configs',
    array(
        'name'			=> __('Portfolio Masonry', 'la-studio'),
        'base'			=> 'la_portfolio_masonry',
        'icon'          => 'la-wpb-icon la_portfolio_masonry',
        'category'  	=> __('La Studio', 'la-studio'),
        'description' 	=> __('Display portfolio with la-studio themes style.','la-studio'),
        'params' 		=> $shortcode_params
    ),
    'la_portfolio_masonry'
);