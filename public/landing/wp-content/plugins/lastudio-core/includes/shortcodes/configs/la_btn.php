<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

if ( !class_exists( 'WPBakeryShortCode_la_btn' ) ) {
    class WPBakeryShortCode_la_btn extends LaStudio_Shortcodes_Abstract{

    }
}

$shortcode_params = array(
    array(
        'type' => 'textfield',
        'heading' => __( 'Text', 'la-studio' ),
        'param_name' => 'title',
        'value' => __( 'Text on the button', 'la-studio' ),
        'admin_label' => true
    ),
    array(
        'type' => 'vc_link',
        'heading' => __( 'URL (Link)', 'la-studio' ),
        'param_name' => 'link',
        'description' => __( 'Add link to button.', 'la-studio' )
    ),
    array(
        'type' => 'dropdown',
        'heading' => __( 'Style', 'la-studio' ),
        'description' => __( 'Select button display style.', 'la-studio' ),
        'param_name' => 'style',
        'value' => array(
            __( 'Flat', 'la-studio' ) => 'flat',
            __( 'Outline', 'la-studio' ) => 'outline'
        )
    ),
    array(
        'type' => 'dropdown',
        'heading' => __( 'Border width', 'la-studio' ),
        'description' => __( 'Select border width.', 'la-studio' ),
        'param_name' => 'border_width',
        'value' => array(
            __( '1px', 'la-studio' ) => '1',
            __( '2px', 'la-studio' ) => '2',
            __( '3px', 'la-studio' ) => '3'
        ),
        'dependency' => array(
            'element' => 'style',
            'value' => 'outline'
        ),
        'std' => '1'
    ),
    array(
        'type' => 'dropdown',
        'heading' => __( 'Shape', 'la-studio' ),
        'description' => __( 'Select button shape.', 'la-studio' ),
        'param_name' => 'shape',
        'value' => array(
            __( 'Rounded', 'la-studio' ) => 'rounded',
            __( 'Square', 'la-studio' ) => 'square',
            __( 'Round', 'la-studio' ) => 'round'
        ),
        'std' => 'square'
    ),
    array(
        'type' => 'dropdown',
        'heading' => __( 'Color', 'la-studio' ),
        'param_name' => 'color',
        'description' => __( 'Select button color.', 'la-studio' ),
        'value' => array(
                __( 'Black', 'la-studio' ) => 'black',
                __( 'Primary', 'la-studio' ) => 'primary',
                __( 'Three', 'la-studio' ) => 'three',
                __( 'White', 'la-studio' ) => 'white',
                __( 'White 2', 'la-studio' ) => 'white2',
                __( 'Gray', 'la-studio' ) => 'gray'
        ),
        'std' => 'black'
    ),
    array(
        'type' => 'dropdown',
        'heading' => __( 'Size', 'la-studio' ),
        'param_name' => 'size',
        'description' => __( 'Select button display size.', 'la-studio' ),
        'std' => 'md',
        'value' => array(
            'Mini' => 'xs',
            'Small' => 'sm',
            'Normal' => 'md',
            'Large' => 'lg',
        )
    ),
    array(
        'type' => 'dropdown',
        'heading' => __( 'Alignment', 'la-studio' ),
        'param_name' => 'align',
        'description' => __( 'Select button alignment.', 'la-studio' ),
        'value' => array(
            __( 'Inline', 'la-studio' ) => 'inline',
            __( 'Left', 'la-studio' ) => 'left',
            __( 'Right', 'la-studio' ) => 'right',
            __( 'Center', 'la-studio' ) => 'center',
        ),
    ),
    array(
        'type' => 'textfield',
        'heading' => __( 'Extra class name', 'la-studio' ),
        'param_name' => 'el_class',
        'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'la-studio' ),
    ),
);


return apply_filters(
    'LaStudio/shortcodes/configs',
    array(
        'name'			=> __('La Button', 'la-studio'),
        'base'			=> 'la_btn',
        'icon'          => 'icon-wpb-ui-button',
        'category'  	=> __('La Studio', 'la-studio'),
        'description'   => __('Eye catching button', 'la-studio'),
        'params' 		=> $shortcode_params
    ),
    'la_btn'
);