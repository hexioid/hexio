<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

if ( !class_exists( 'WPBakeryShortCode_la_pricing_table' ) ) {
	class WPBakeryShortCode_la_pricing_table extends LaStudio_Shortcodes_Abstract{

	}
}

$shortcode_params = array(
	array(
		'type' => 'textfield',
		'heading' => __( 'Package Name / Title', 'la-studio' ),
		'param_name' => 'package_title',
		'description' => __( 'Enter the package name or table heading', 'la-studio' )
	),
	array(
		'type' => 'textfield',
		'heading' => __( 'Package Price', 'la-studio' ),
		'param_name' => 'package_price',
		'description' => __( 'Enter the price for this package. e.g. $157', 'la-studio' )
	),
	array(
		'type' => 'textfield',
		'heading' => __( 'Price Unit', 'la-studio' ),
		'param_name' => 'price_unit',
		'description' => __( 'Enter the price unit for this package. e.g. per month', 'la-studio' )
	),
	array(
		'type' => 'param_group',
		'heading' => __( 'Features', 'la-studio' ),
		'param_name' => 'features',
		'description' => __( 'Create the features list', 'la-studio' ),
		'value' => urlencode( json_encode( array(
			array(
				'highlight' => 'Sample',
				'text' => 'Text'
			),
			array(
				'highlight' => 'Sample',
				'text' => 'Text',
			),
			array(
				'highlight' => 'Sample',
				'text' => 'Text',
			),
		) ) ),
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => __( 'Highlight Text', 'la-studio' ),
				'param_name' => 'highlight',
				'admin_label' => true,
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Text', 'la-studio' ),
				'param_name' => 'text',
				'admin_label' => true,
			),
			array(
				'type' => 'iconpicker',
				'param_name' => 'icon',
				'settings' => array(
					'emptyIcon' => true,
					'iconsPerPage' => 50,
				),
			),
		),
	),
	array(
		'type' => 'textarea',
		'heading' => __( 'Description before featured', 'la-studio' ),
		'param_name' => 'desc_before',
	),
	array(
		'type' => 'textarea',
		'heading' => __( 'Description after featured', 'la-studio' ),
		'param_name' => 'desc_after',
	),
	array(
		'type' => 'textfield',
		'heading' => __( 'Button text', 'la-studio' ),
		'param_name' => 'button_text',
		'description' => __( 'Enter call to action button text', 'la-studio' ),
		'value' => 'View More'
	),
	array(
		'type'       => 'vc_link',
		'heading'    => __( 'Button Link', 'la-studio' ),
		'param_name' => 'button_link',
		'description' => __('Select / enter the link for call to action button', 'la-studio')
	),
	array(
		'type'       => 'checkbox',
		'param_name' => 'package_featured',
		'value'      => array( __( 'Make this pricing box as featured', 'la-studio' ) => 'yes' ),
	),
	array(
		'type' => 'textfield',
		'heading' => __( 'Custom badge', 'la-studio' ),
		'param_name' => 'custom_badge',
		'value'		=> 'Recommended',
		'dependency' => array(
			'element' => 'package_featured',
			'value' => 'yes'
		)
	),
	LaStudio_Shortcodes_Helper::fieldCssAnimation(),
	LaStudio_Shortcodes_Helper::fieldExtraClass(),
	
	array(
		'type' => 'colorpicker',
		'param_name' => 'main_bg_color',
		'heading' => __('Main background color', 'la-studio'),
		'group' => 'Design',
	),
	array(
		'type' => 'colorpicker',
		'param_name' => 'main_text_color',
		'heading' => __('Main text color', 'la-studio'),
		'group' => 'Design',
	),
	array(
		'type' => 'colorpicker',
		'param_name' => 'highlight_color',
		'heading' => __('Highlight color', 'la-studio'),
		'group' => 'Design',
	),
);

$icon_type = LaStudio_Shortcodes_Helper::fieldIconType(array(), true);

$title_google_font_param = LaStudio_Shortcodes_Helper::fieldTitleGFont('package_title', __('Package Name/Title', 'la-studio'));
$price_google_font_param = LaStudio_Shortcodes_Helper::fieldTitleGFont('package_price', __('Price', 'la-studio'));
$price_unit_google_font_param = LaStudio_Shortcodes_Helper::fieldTitleGFont('package_price_unit', __('Price Unit', 'la-studio'));
$desc_google_font_param = LaStudio_Shortcodes_Helper::fieldTitleGFont('package_desc', __('After Featured/ Before Featured', 'la-studio'));
$featured_google_font_param = LaStudio_Shortcodes_Helper::fieldTitleGFont('package_featured', __('Featured', 'la-studio'));
$button_google_font_param = LaStudio_Shortcodes_Helper::fieldTitleGFont('package_button', __('Button', 'la-studio'));
$icon_google_font_param = array(
	array(
		'type' 			=> 'la_heading',
		'param_name' 	=> 'icon__typography',
		'text' 			=> __('Icon settings', 'la-studio'),
		'group' 		=> __('Typography', 'la-studio')
	),
	array(
		'type' 			=> 'la_column',
		'heading' 		=> __('Icon Width', 'la-studio'),
		'param_name' 	=> 'icon_lh',
		'unit' 			=> 'px',
		'media' => array(
			'xlg'	=> '',
			'lg'    => '',
			'md'    => '',
			'sm'    => '',
			'xs'	=> '',
			'mb'	=> ''
		),
		'group' 		=> __('Typography', 'la-studio')
	),
	array(
		'type' 			=> 'la_column',
		'heading' 		=> __('Font size', 'la-studio'),
		'param_name' 	=> 'icon_fz',
		'unit' 			=> 'px',
		'media' => array(
			'xlg'	=> '',
			'lg'    => '',
			'md'    => '',
			'sm'    => '',
			'xs'	=> '',
			'mb'	=> ''
		),
		'group' 		=> __('Typography', 'la-studio')
	),
	array(
		'type' 			=> 'colorpicker',
		'param_name' 	=> 'icon_color',
		'heading' 		=> __('Color', 'la-studio'),
		'group' 		=> __('Typography', 'la-studio')
	)
);


$shortcode_params = array_merge(
	array(
		array(
			'type' => 'dropdown',
			'heading' => __('Select Design','la-studio'),
			'description' => __('Select Pricing table design you would like to use','la-studio'),
			'param_name' => 'style',
			'value' => array(
				__("Design 01",'la-studio') => "1",
				__("Design 02",'la-studio') => "2",
				__("Design 03",'la-studio') => "3",
				__("Design 04",'la-studio') => "4",
			),
		)
	),
	$icon_type,
	$shortcode_params,
	$icon_google_font_param,
	$title_google_font_param,
	$price_google_font_param,
	$price_unit_google_font_param,
	$desc_google_font_param,
	$featured_google_font_param,
	$button_google_font_param
);

return apply_filters(
	'LaStudio/shortcodes/configs',
	array(
		'name'			=> __('Pricing Table', 'la-studio'),
		'base'			=> 'la_pricing_table',
		'icon'          => 'la-wpb-icon la_pricing_table',
		'category'  	=> __('La Studio', 'la-studio'),
		'description' 	=> __('Create nice looking pricing tables','la-studio'),
		'params' 		=> $shortcode_params
	),
    'la_pricing_table'
);