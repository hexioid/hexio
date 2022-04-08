<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

if ( !class_exists( 'WPBakeryShortCode_la_timeline' ) ) {
	class WPBakeryShortCode_la_timeline extends WPBakeryShortCodesContainer{

	}
}

return apply_filters(
	'LaStudio/shortcodes/configs',
	array(
		'name'			=> __('Timeline', 'la-studio'),
		'base'			=> 'la_timeline',
		'icon'          => 'la-wpb-icon la_timeline',
		'category'  	=> __('La Studio', 'la-studio'),
		'description' 	=> __('Displays the timeline block','la-studio'),
		'as_parent'         => array('only' => 'la_timeline_item'),
		'content_element'   => true,
		'is_container'      => false,
		'show_settings_on_create' => false,
		'params' 		=> array(
			array(
				'type' => 'dropdown',
				'heading' => __( 'Design', 'la-studio'),
				'param_name' => 'style',
				'value' => array(
					__('Style 01', 'la-studio') => '1',
					__('Style 02', 'la-studio') => '2',
				),
			),
			array(
				'type'       => 'checkbox',
				'heading'    => __('Enable load more', 'la-studio' ),
				'param_name' => 'enable_load_more',
				'value'      => array( __( 'Yes', 'la-studio' ) => 'yes' )
			),
			array(
				"type" => "textfield",
				"heading" => __("Load More Text", 'la-studio'),
				"param_name" => "load_more_text",
				"value" => "Load More",
				"description" => __("Customize the load more text.", 'la-studio'),
				"dependency" => Array("element" => "enable_load_more","value" => array("yes")),
			),
			LaStudio_Shortcodes_Helper::fieldExtraClass()
		),
		'js_view' => 'VcColumnView',
		'html_template' => LaStudio_Plugin::$plugin_dir_path . 'includes/shortcodes/templates/la_timeline.php'
	),
    'la_timeline'
);