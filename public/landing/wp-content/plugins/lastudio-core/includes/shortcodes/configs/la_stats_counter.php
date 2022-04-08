<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

if ( !class_exists( 'WPBakeryShortCode_la_stats_counter' ) ) {
	class WPBakeryShortCode_la_stats_counter extends LaStudio_Shortcodes_Abstract{

	}
}

$icon_type = LaStudio_Shortcodes_Helper::fieldIconType(array(
	'element' => 'icon_pos',
	'value'	=> array('top','left','right')
));

$field_icon_settings = array(
	array(
		'type'	=> 'dropdown',
		'heading'	=> __('Icon Position', 'la-studio'),
		'param_name' => 'icon_pos',
		'value'	=> array(
			__('No display', 'la-studio')	=> 'none',
			__('Icon at Top', 'la-studio') => 'top',
			__('Icon at Left', 'la-studio') => 'left',
			__('Icon at Right', 'la-studio') => 'right'
		),
		'std' => 'top',
		'description' => __('Select icon position. Icon box style will be changed according to the icon position.', 'la-studio')
	),

	array(
		'type' => 'la_number',
		'heading' => __('Icon Size', 'la-studio'),
		'param_name' => 'icon_size',
		'value' => 30,
		'min' => 10,
		'suffix' => 'px',
		'dependency' => array(
			'element' => 'icon_pos',
			'value'	=> array('top','left','right')
		)
	),
	array(
		'type' => 'colorpicker',
		'heading' => __('Icon Color', 'la-studio'),
		'param_name' => 'icon_color',
		'dependency' => array(
			'element' => 'icon_pos',
			'value'	=> array('top','left','right')
		)
	)
);

$field_icon_settings = array_merge($field_icon_settings, $icon_type);

$shortcode_params = array(
	array(
		'type' => 'textfield',
		'heading' => __('Title', 'la-studio'),
		'param_name' => 'title',
		'admin_label' => true,
	),
	array(
		'type' => 'la_number',
		'heading' => __('Value', 'la-studio'),
		'param_name' => 'value',
		'value' => 1250,
		'min' => 0,
		'suffix' => '',
		'description' => __('Enter number for counter without any special character. You may enter a decimal number. Eg 12.76', 'la-studio')
	),
	array(
		'type' => 'textfield',
		'heading' => __('Value Prefix', 'la-studio'),
		'param_name' => 'prefix'
	),
	array(
		'type' => 'textfield',
		'heading' => __('Value Suffix', 'la-studio'),
		'param_name' => 'suffix'
	),
	array(
		'type'  => 'dropdown',
		'heading' => __('Separator','la-studio'),
		'param_name'    => 'spacer',
		'value' => array(
			__('No Separator','la-studio')	=>	'none',
			__('Line','la-studio')	        =>	'line',
		),
		'default' => 'none',
	),
	array(
		'type'  => 'dropdown',
		'heading' => __('Separator Position','la-studio'),
		'param_name'    => 'spacer_position',
		'value' => array(
			__('Top','la-studio')		 	=>	'top',
			__('Bottom','la-studio')		=>	'bottom',
			__('Between Value & Title','la-studio')	=>	'middle'
		),
		'default' => 'top',
		'dependency' => array(
			'element'   => 'spacer',
			'value'     => 'line'
		)
	),
	array(
		'type'      => 'dropdown',
		'heading'   => __('Line Style', 'la-studio'),
		'param_name'    => 'line_style',
		'value'         => array(
			__('Solid', 'la-studio') => 'solid',
			__('Dashed', 'la-studio') => 'dashed',
			__('Dotted', 'la-studio') => 'dotted',
			__('Double', 'la-studio') => 'double'
		),
		'default' => 'solid',
		'dependency' => array(
			'element'   => 'spacer',
			'value'     => 'line'
		)
	),
	array(
		'type' 			=> 'la_column',
		'heading' 		=> __('Line Width', 'la-studio'),
		'param_name' 	=> 'line_width',
		'unit'			=> 'px',
		'media'			=> array(
			'xlg'	=> '',
			'lg'	=> '',
			'md'	=> '',
			'sm'	=> '',
			'xs'	=> '',
			'mb'	=> ''
		),
		'dependency' => array(
			'element'   => 'spacer',
			'value'     => 'line'
		)
	),
	array(
		'type' => 'la_number',
		'heading' => __('Line Height', 'la-studio'),
		'param_name' => 'line_height',
		'value' => 1,
		'min' => 1,
		'suffix' => 'px',
		'dependency' => array(
			'element'   => 'spacer',
			'value'     => 'line'
		)
	),
	array(
		'type' => 'colorpicker',
		'heading' => __('Line Color', 'la-studio'),
		'param_name' => 'line_color',
		'dependency' => array(
			'element'   => 'spacer',
			'value'     => 'line'
		)
	),
	LaStudio_Shortcodes_Helper::fieldCssAnimation(),
	LaStudio_Shortcodes_Helper::fieldExtraClass()
);

$title_google_font_param = LaStudio_Shortcodes_Helper::fieldTitleGFont();
$value_google_font_param = LaStudio_Shortcodes_Helper::fieldTitleGFont('value', __('Value', 'la-studio'));
$shortcode_params = array_merge( $field_icon_settings, $shortcode_params, $title_google_font_param, $value_google_font_param, array(LaStudio_Shortcodes_Helper::fieldCssClass()) );

return apply_filters(
	'LaStudio/shortcodes/configs',
	array(
		'name'			=> __('Stats Counter', 'la-studio'),
		'base'			=> 'la_stats_counter',
		'icon'          => 'la-wpb-icon la_stats_counter',
		'category'  	=> __('La Studio', 'la-studio'),
		'description' 	=> __('Your milestones, achievements, etc.','la-studio'),
		'params' 		=> $shortcode_params
	),
    'la_stats_counter'
);