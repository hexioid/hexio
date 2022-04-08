<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

if ( !class_exists( 'WPBakeryShortCode_la_icon_list_item' ) ) {
	class WPBakeryShortCode_la_icon_list_item extends LaStudio_Shortcodes_Abstract{

	}
}

return apply_filters(
	'LaStudio/shortcodes/configs',
	array(
		'name'			=> __('Icon', 'la-studio'),
		'base'			=> 'la_icon_list_item',
		'icon'          => 'la-wpb-icon la_icon_list_item',
		'category'  	=> __('La Studio', 'la-studio'),
		'description' 	=> __('Displays the list icon','la-studio'),
		'as_child'         => array('only' => 'la_icon_list'),
		'content_element'   => true,
		'params' 		=> array(
			array(
				'type' => 'dropdown',
				'heading' => __( 'Icon library', 'la-studio' ),
				'value' => array(
					__( 'Font Awesome', 'la-studio' ) => 'fontawesome',
					__( 'LaStudio Icon Outline', 'la-studio' ) => 'la_icon_outline',
				),
				'param_name' => 'icon_type',
				'description' => __( 'Select icon library.', 'la-studio' )
			),
			array(
				'type' => 'iconpicker',
				'heading' => __( 'Icon', 'la-studio' ),
				'param_name' => 'icon_fontawesome',
				'settings' => array(
					'emptyIcon' => true,
					'iconsPerPage' => 20,
				),
				'dependency' => array(
					'element' => 'icon_type',
					'value' => 'fontawesome',
				)
			),
			array(
				'type' => 'iconpicker',
				'heading' => __( 'Icon', 'la-studio' ),
				'param_name' => 'icon_la_icon_outline',
				'settings' => array(
					'emptyIcon' => true,
					'type' => 'la_icon_outline',
					'iconsPerPage' => 20,
				),
				'dependency' => array(
					'element' => 'icon_type',
					'value' => 'la_icon_outline',
				)
			),
			array(
				'type' => 'hidden',
				'heading' => __('Icon', 'la-studio'),
				'param_name' => 'icon'
			),
			array(
				'type' => 'colorpicker',
				'heading' => __('Icon Color', 'la-studio'),
				'param_name' => 'icon_color'
			),
			array(
				"type" => "textfield",
				"heading" => __("Content", 'la-studio'),
				"param_name" => "content",
				"admin_label" => true
			),
			LaStudio_Shortcodes_Helper::fieldExtraClass()
		),
	),
    'la_icon_list_item'
);