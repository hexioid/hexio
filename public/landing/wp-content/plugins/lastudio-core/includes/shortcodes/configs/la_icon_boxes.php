<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

if ( !class_exists( 'WPBakeryShortCode_la_icon_boxes' ) ) {
	class WPBakeryShortCode_la_icon_boxes extends LaStudio_Shortcodes_Abstract{

	}
}

$icon_type = LaStudio_Shortcodes_Helper::fieldIconType();

$shortcode_params = array(
	array(
		'type' => 'textfield',
		'heading' => __('Heading', 'la-studio'),
		'param_name' => 'title',
		'admin_label' => true,
		'description' => __('Provide the title for this icon boxes.', 'la-studio'),
	),
	array(
		'type' => 'textarea_html',
		'heading' => __('Description', 'la-studio'),
		'param_name' => 'content',
		'description' => __('Provide the description for this icon box.', 'la-studio'),
	),
	array(
		'type'	=> 'dropdown',
		'heading'	=> __('Icon Position', 'la-studio'),
		'param_name' => 'icon_pos',
		'value'	=> array(
			__('Icon at left with heading', 'la-studio') => 'default',
			__('Icon at Right with heading', 'la-studio') => 'heading-right',
			__('Icon at Left', 'la-studio') => 'left',
			__('Icon at Right', 'la-studio') => 'right',
			__('Icon at Top', 'la-studio') => 'top',
		),
		'std' => 'default',
		'description' => __('Select icon position. Icon box style will be changed according to the icon position.', 'la-studio'),
		'group' => __('Icon Settings', 'la-studio')
	),

	array(
		'type' => 'dropdown',
		'heading' => __('Icon Styles', 'la-studio'),
		'param_name' => 'icon_style',
		'description' => __('We have given four quick preset if you are in a hurry. Otherwise, create your own with various options.', 'la-studio'),
		'std'	=> 'simple',
		'value' => array(
			__('Simple', 'la-studio') => 'simple',
			__('Circle Background', 'la-studio') => 'circle',
			__('Square Background', 'la-studio') => 'square',
			__('Round Background', 'la-studio') => 'round',
			__('Advanced', 'la-studio') => 'advanced',
		),
		'group' => __('Icon Settings', 'la-studio')
	),

	array(
		'type' => 'la_number',
		'heading' => __('Icon Size', 'la-studio'),
		'param_name' => 'icon_size',
		'value' => 30,
		'min' => 10,
		'suffix' => 'px',
		'group' => __('Icon Settings', 'la-studio')
	),
	array(
		'type' => 'la_number',
		'heading' => __('Icon Box Width', 'la-studio'),
		'param_name' => 'icon_width',
		'value' => 30,
		'min' => 10,
		'suffix' => 'px',
		'group' => __('Icon Settings', 'la-studio'),
		'dependency' => array(
			'element' 	=> 'icon_style',
			'value' 	=> array('circle','square','round','advanced')
		),
	),
	array(
		'type' => 'la_number',
		'heading' => __('Icon Padding', 'la-studio'),
		'param_name' => 'icon_padding',
		'value' => 0,
		'min' => 0,
		'suffix' => 'px',
		'group' => __('Icon Settings', 'la-studio'),
		'dependency' => array(
			'element' 	=> 'icon_style',
			'value' 	=> array('advanced')
		)
	),
	array(
		'type' => 'colorpicker',
		'heading' => __('Icon Color', 'la-studio'),
		'param_name' => 'icon_color',
		'group' => __('Icon Settings', 'la-studio')
	),
	array(
		'type' => 'colorpicker',
		'heading' => __('Icon Background Color', 'la-studio'),
		'param_name' => 'icon_bg',
		'dependency' => array(
			'element' 	=> 'icon_style',
			'value' 	=> array('circle','square','round','advanced')
		),
		'group' => __('Icon Settings', 'la-studio')
	),
	array(
		'type' => 'dropdown',
		'heading' => __('Icon Border Style', 'la-studio'),
		'param_name' => 'icon_border_style',
		'value' => array(
			__('None', 'la-studio') => '',
			__('Solid', 'la-studio') => 'solid',
			__('Dashed', 'la-studio') => 'dashed',
			__('Dotted', 'la-studio') => 'dotted',
			__('Double', 'la-studio') => 'double',
		),
		'group' => __('Icon Settings', 'la-studio')
	),
	array(
		'type' => 'la_number',
		'heading' => __('Icon Border Width', 'la-studio'),
		'param_name' => 'icon_border_width',
		'value' => 1,
		'min' => 1,
		'max' => 10,
		'suffix' => 'px',
		'dependency' => array(
			'element' 	=> 'icon_border_style',
			'not_empty' 	=> true
		),
		'group' => __('Icon Settings', 'la-studio')
	),
	array(
		'type' => 'colorpicker',
		'heading' => __('Icon Border Color', 'la-studio'),
		'param_name' => 'icon_border_color',
		'dependency' => array(
			'element' 	=> 'icon_border_style',
			'not_empty' 	=> true
		),
		'group' => __('Icon Settings', 'la-studio')
	),
	array(
		'type' => 'la_number',
		'heading' => __('Icon Border Radius', 'la-studio'),
		'param_name' => 'icon_border_radius',
		'value' => 500,
		'min' => 1,
		'suffix' => 'px',
		'description' => __('0 pixel value will create a square border. As you increase the value, the shape convert in circle slowly. (e.g 500 pixels).', 'la-studio'),
		'dependency' => array(
			'element' 	=> 'icon_style',
			'value' 	=> array('advanced')
		),
		'group' => __('Icon Settings', 'la-studio')
	),
	LaStudio_Shortcodes_Helper::fieldCssAnimation(),
	LaStudio_Shortcodes_Helper::fieldExtraClass(),
	LaStudio_Shortcodes_Helper::fieldExtraClass(array(
		'heading' 		=> __('Extra Class for heading', 'la-studio'),
		'param_name' 	=> 'title_class',
	)),
	LaStudio_Shortcodes_Helper::fieldExtraClass(array(
		'heading' 		=> __('Extra Class for description', 'la-studio'),
		'param_name' 	=> 'desc_class',
	))
);

$title_google_font_param = LaStudio_Shortcodes_Helper::fieldTitleGFont();
$desc_google_font_param = LaStudio_Shortcodes_Helper::fieldTitleGFont('desc', __('Description', 'la-studio'));

$shortcode_params = array_merge( $icon_type, $shortcode_params, $title_google_font_param, $desc_google_font_param, array(LaStudio_Shortcodes_Helper::fieldCssClass()) );

return apply_filters(
	'LaStudio/shortcodes/configs',
	array(
		'name'			=> __('Icon boxes', 'la-studio'),
		'base'			=> 'la_icon_boxes',
		'icon'          => 'la-wpb-icon la_icon_boxes',
		'category'  	=> __('La Studio', 'la-studio'),
		'description' 	=> __('Adds icon box with custom font icon','la-studio'),
		'params' 		=> $shortcode_params
	),
    'la_icon_boxes'
);