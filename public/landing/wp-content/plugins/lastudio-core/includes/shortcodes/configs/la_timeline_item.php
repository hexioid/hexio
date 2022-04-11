<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

if ( !class_exists( 'WPBakeryShortCode_la_timeline_item' ) ) {
	class WPBakeryShortCode_la_timeline_item extends LaStudio_Shortcodes_Abstract{

	}
}

return apply_filters(
	'LaStudio/shortcodes/configs',
	array(
		'name'			=> __('Timeline', 'la-studio'),
		'base'			=> 'la_timeline_item',
		'icon'          => 'la-wpb-icon la_timeline_item',
		'category'  	=> __('La Studio', 'la-studio'),
		'description' 	=> __('Displays the timeline block','la-studio'),
		'as_child'         => array('only' => 'la_timeline'),
		'content_element'   => true,
		'params' 		=> array(
			array(
				"type" => "textfield",
				"heading" => __("Title", 'la-studio'),
				"param_name" => "title",
				"admin_label" => true
			),
			array(
				"type" => "textfield",
				"heading" => __("Sub-Title", 'la-studio'),
				"param_name" => "sub_title",
				"admin_label" => true
			),
			array(
				"type" => "textarea_html",
				"heading" => __("Content", 'la-studio'),
				"param_name" => "content",
			),
			array(
				"type" => "dropdown",
				"heading" => __("Apply link to:", 'la-studio'),
				"param_name" => "time_link_apply",
				"value" => array(
					__("None",'la-studio') => "",
					__("Complete box",'la-studio') => "box",
					__("Box Title",'la-studio') => "title",
					__("Display Read More",'la-studio') => "more",
				),
				"description" => __("Select the element for link.", 'la-studio')
			),
			array(
				"type" => "vc_link",
				"heading" => __("Add Link", 'la-studio'),
				"param_name" => "time_link",
				"dependency" => Array("element" => "time_link_apply","value" => array("more","title","box")),
				"description" => __("Provide the link that will be applied to this timeline.", 'la-studio')
			),
			array(
				"type" => "textfield",
				"heading" => __("Read More Text", 'la-studio'),
				"param_name" => "time_read_text",
				"value" => "Read More",
				"description" => __("Customize the read more text.", 'la-studio'),
				"dependency" => Array("element" => "time_link_apply","value" => array("more")),
			),
			array(
				'type' => 'colorpicker',
				'heading' => __('Dot Color', 'la-studio'),
				'param_name' => 'dot_color'
			),
			LaStudio_Shortcodes_Helper::fieldCssAnimation(),
			LaStudio_Shortcodes_Helper::fieldExtraClass()
		),
	),
    'la_timeline_item'
);