<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

if ( !class_exists( 'WPBakeryShortCode_la_image_with_hotspots' ) ) {
    class WPBakeryShortCode_la_image_with_hotspots extends LaStudio_Shortcodes_Abstract{

    }
}

$shortcode_params = array(
    array(
        'type'          => 'attach_image',
        'heading'       => __('Image', 'la-studio'),
        'param_name'    => 'image',
        'description'   => __('Choose your image that will show the hotspots. <br/> You can then click on the image in the preview area to add your hotspots in the desired locations.', 'la-studio')
    ),
    array(
        'type'          => 'la_hotspot_image_preview',
        'heading'       => __('Preview', 'la-studio'),
        'param_name'    => 'preview',
        'description'   => __("Click to add - Drag to move - Edit content below<br/> Note: this preview will not reflect hotspot style choices or show tooltips. <br/>This is only used as a visual guide for positioning.", 'la-studio')
    ),
    array(
        'type'          => 'textarea_html',
        'heading'       => __('Hotspots', 'la-studio'),
        'param_name'    => 'content'
    ),
    array(
        'type' 			=> 'textfield',
        'heading' 		=> __('Extra Class name', 'la-studio'),
        'group'         => __('Style', 'la-studio'),
        'param_name' 	=> 'el_class',
        'description' 	=> __('Style particular content element differently - add a class name and refer to it in custom CSS.', 'la-studio')
    ),
    array(
        'type'          => 'dropdown',
        'save_always'   => true,
        'group'         => __('Style', 'la-studio'),
        'heading'       => __('Color', 'la-studio'),
        'admin_label'   => true,
        'param_name'    => 'color',
        'default'       => 'primary',
        'description'   => __('Choose the color which the hotspot will use', 'la-studio'),
        'value'         => array(
            'Primary' => 'primary',
            'Secondary' => 'secondary',
            'Blue' => 'blue',
            'Turquoise' => 'turquoise',
            'Pink' => 'pink',
            'Violet' => 'violet',
            'Peacoc' => 'peacoc',
            'Chino' => 'chino',
            'Mulled Wine' => 'mulled_wine',
            'Vista Blue' => 'vista_blue',
            'Black' => 'black',
            'Grey' => 'grey',
            'Orange' => 'orange',
            'Sky' => 'sky',
            'Green' => 'green',
            'Juicy pink' => 'juicy_pink',
            'Sandy brown' => 'sandy_brown',
            'Purple' => 'purple',
            'White' => 'white'
        )
    ),
    array(
        'type'          => 'dropdown',
        'save_always'   => true,
        'group'         => __('Style', 'la-studio'),
        'heading'       => __('Hotspot Icon', 'la-studio'),
        'description'   => __('The icon that will be shown on the hotspots', 'la-studio'),
        'param_name'    => 'hotspot_icon',
        'admin_label'   => true,
        'value'         => array(
            __('Plus Sign', 'la-studio') => 'plus_sign',
            __('Numerical', 'la-studio') => 'numerical'
        )
    ),
    array(
        'type'          => 'dropdown',
        'save_always'   => true,
        'group'         => __('Style', 'la-studio'),
        'heading'       => __('Tooltip Functionality', 'la-studio'),
        'param_name'    => 'tooltip',
        'description'   => __('Select how you want your tooltips to display to the user', 'la-studio'),
        'value'         => array(
            __('Show On Hover', 'la-studio')    => 'hover',
            __('Show On Click', 'la-studio')    => 'click',
            __('Always Show', 'la-studio')      => 'always_show'
        )
    ),
    array(
        'type'          => 'dropdown',
        'save_always'   => true,
        'group'         => __('Style', 'la-studio'),
        'heading'       => __('Tooltip Shadow', 'la-studio'),
        'param_name'    => 'tooltip_shadow',
        'description'   => __('Select the shadow size for your tooltip', 'la-studio'),
        'value'         => array(
            __('None', 'la-studio')         => 'none',
            __('Small Depth', 'la-studio')  => 'small_depth',
            __('Medium Depth', 'la-studio') => 'medium_depth',
            __('Large Depth', 'la-studio')  => 'large_depth'
        )
    ),
    array(
        'type'          => 'checkbox',
        'heading'       => __('Enable Animation', 'la-studio'),
        'param_name'    => 'animation',
        'group'         => __('Style', 'la-studio'),
        'description'   => __('Turning this on will make your hotspots animate in when the user scrolls to the element', 'la-studio'),
        'value'         => array(
            __('Yes, please', 'la-studio') => 'true'
        )
    )
);


return apply_filters(
    'LaStudio/shortcodes/configs',
    array(
        'name'			=> __('Image With Hotspots', 'la-studio'),
        'base'			=> 'la_image_with_hotspots',
        'icon'          => 'icon-wpb-single-image',
        'category'  	=> __('La Studio', 'la-studio'),
        'description'   => __('Add Hotspots On Your Image', 'la-studio'),
        'params' 		=> $shortcode_params
    ),
    'la_image_with_hotspots'
);