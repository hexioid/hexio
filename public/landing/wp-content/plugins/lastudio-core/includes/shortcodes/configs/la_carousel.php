<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

if ( !class_exists( 'WPBakeryShortCode_la_carousel' ) ) {
	class WPBakeryShortCode_la_carousel extends WPBakeryShortCodesContainer{

	}
}

return apply_filters(
	'LaStudio/shortcodes/configs',
	array(
		'name'			=> __('LA Advanced Carousel', 'la-studio'),
		'base'			=> 'la_carousel',
		'icon'          => 'la-wpb-icon la_icon_list',
		'category'  	=> __('La Studio', 'la-studio'),
		'description' 	=> __('Carousel anything.','la-studio'),
		'as_parent'     => array( 'except' => 'la_carousel' ),
		'content_element'=> true,
		'controls'       => "full",
		'show_settings_on_create' => true,
		'params' 		=> array(
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Slider Type', 'la-studio' ),
				'param_name' => 'slider_type',
				'value'      => array(
					'Horizontal'            => 'horizontal',
					'Vertical'              => 'vertical'
				),
				'group'      => 'General'
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Slides to Scroll', 'la-studio' ),
				'param_name' => 'slide_to_scroll',
				'value'      => array(
					'All visible' => 'all',
					'One at a Time' => 'single'
				),
				'group'      => 'General'
			),
			LaStudio_Shortcodes_Helper::fieldColumn(array(
				'heading' 		=> __('Items to Show', 'la-studio'),
				'param_name' 	=> 'slides_column',
				'group'      => 'General'
			)),
			array(
				'type' 			=> 'checkbox',
				'heading' 		=> __('Infinite loop', 'la-studio'),
				'description'	=> __( 'Restart the slider automatically as it passes the last slide.', 'la-studio' ),
				'param_name' 	=> 'infinite_loop',
				'value' 		=> array(
					__('Yes', 'la-studio') => 'yes'
				),
				'group'      => 'General'

			),
			array(
				'type'        => 'la_number',
				'heading'     => __( 'Transition speed', 'la-studio' ),
				'param_name'  => 'speed',
				'value'       => '300',
				'min'         => '100',
				'max'         => '10000',
				'step'        => '100',
				'suffix'      => 'ms',
				'description' => __( 'Speed at which next slide comes.', 'la-studio' ),
				'group'      => 'General'
			),
			array(
				'type' 			=> 'checkbox',
				'heading' 		=> __('Autoplay Slides', 'la-studio'),
				'param_name' 	=> 'autoplay',
				'value' 		=> array(
					__('Yes', 'la-studio') => 'yes'
				),
				'group'      => 'General'
			),
			array(
				'type'       => 'la_number',
				'heading'    => __( 'Autoplay Speed', 'la-studio' ),
				'param_name' => 'autoplay_speed',
				'value'      => '5000',
				'min'        => '100',
				'max'        => '10000',
				'step'       => '10',
				'suffix'     => 'ms',
				'dependency' => array(
					'element' => 'autoplay', 'value' => 'yes'
				),
				'group'      => 'General'
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Extra Class', 'la-studio' ),
				'param_name' => 'el_class',
				'group'      => 'General'
			),
			array(
				'type' 			=> 'checkbox',
				'heading' 		=> __('Navigation Arrows', 'la-studio'),
				'description' 	=> __( 'Display next / previous navigation arrows', 'la-studio' ),
				'param_name' 	=> 'arrows',
				'value' 		=> array(
					__('Show', 'la-studio') => 'yes'
				),
				'group'      	=> 'Navigation'
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Arrow Style', 'la-studio' ),
				'param_name' => 'arrow_style',
				'value'      => array(
					'Default'           => 'default',
					'Circle Background' => 'circle-bg',
					'Square Background' => 'square-bg',
					'Circle Border'     => 'circle-border',
					'Square Border'     => 'square-border',
				),
				'dependency' => array(
					'element' => 'arrows', 'value' => array( 'yes' )
				),
				'group'      	=> 'Navigation'
			),
			array(
				'type'       => 'colorpicker',
				'heading'    => __( 'Background Color', 'la-studio' ),
				'param_name' => 'arrow_bg_color',
				'dependency' => array(
					'element' => 'arrow_style',
					'value'   => array( 'circle-bg', 'square-bg' )
				),
				'group'      	=> 'Navigation'
			),
			array(
				'type'       => 'colorpicker',
				'heading'    => __( 'Border Color', 'la-studio' ),
				'param_name' => 'arrow_border_color',
				'dependency' => array(
					'element' => 'arrow_style',
					'value'   => array( 'circle-border', 'square-border' )
				),
				'group'      	=> 'Navigation'
			),
			array(
				'type'       => 'la_number',
				'heading'    => __( 'Border Size', 'la-studio' ),
				'param_name' => 'border_size',
				'value'      => '2',
				'min'        => '1',
				'max'        => '100',
				'step'       => '1',
				'suffix'     => 'px',
				'dependency' => array(
					'element' => 'arrow_style',
					'value'   => array( 'circle-border', 'square-border' )
				),
				'group'      	=> 'Navigation'
			),
			array(
				'type'       => 'colorpicker',
				'heading'    => __( 'Arrow Color', 'la-studio' ),
				'param_name' => 'arrow_color',
				'value'      => '#333333',
				'dependency' => array(
					'element' => 'arrows', 'value' => array( 'yes' )
				),
				'group'      	=> 'Navigation'
			),
			array(
				'type'       => 'la_number',
				'heading'    => __( 'Arrow Size', 'la-studio' ),
				'param_name' => 'arrow_size',
				'value'      => '24',
				'min'        => '10',
				'max'        => '75',
				'step'       => '1',
				'suffix'     => 'px',
				'dependency' => array(
					'element' => 'arrows', 'value' => array( 'yes' )
				),
				'group'      	=> 'Navigation'
			),
			array(
				'type'       => 'la_slides_navigation',
				'heading'    => __( "Select icon for 'Next Arrow'", 'la-studio' ),
				'param_name' => 'next_icon',
				'value'      => 'laslick-arrow-right4',
				'dependency' => array(
					'element' => 'arrows', 'value' => array( 'yes' )
				),
				'group'      	=> 'Navigation'
			),
			array(
				'type'       => 'la_slides_navigation',
				'heading'    => __( "Select icon for 'Previous Arrow'", 'la-studio' ),
				'param_name' => 'prev_icon',
				'value'      => 'laslick-arrow-left4',
				'dependency' => array(
					'element' => 'arrows', 'value' => array( 'yes' )
				),
				'group'      	=> 'Navigation'
			),

			array(
				'type' 			=> 'checkbox',
				'heading' 		=> __('Dots Navigation', 'la-studio'),
				'description' 	=> __( 'Display dot navigation', 'la-studio' ),
				'param_name' 	=> 'dots',
				'value' 		=> array(
					__('Show', 'la-studio') => 'yes'
				),
				'group'      	=> 'Navigation'
			),

			array(
				'type'       => 'colorpicker',
				'heading'    => __( 'Color of dots', 'la-studio' ),
				'param_name' => 'dots_color',
				'value'      => '#333333',
				'dependency' => array(
					'element' => 'dots', 'value' => array( 'yes' )
				),
				'group'      	=> 'Navigation'
			),
			array(
				'type'       => 'la_slides_navigation',
				'heading'    => __( "Select icon for 'Navigation Dots'", 'la-studio' ),
				'param_name' => 'dots_icon',
				'value'      => 'laslick-record',
				'dependency' => array(
					'element' => 'dots', 'value' => array( 'yes' )
				),
				'group'      	=> 'Navigation'
			),
			LaStudio_Shortcodes_Helper::fieldCssAnimation(array(
				'heading'    => __( 'Item Animation', 'la-studio' ),
				'param_name' => 'item_animation',
				'group'      => 'Animation'
			)),
			array(
				'type' 			=> 'checkbox',
				'heading' 		=> __('Draggable Effect', 'la-studio'),
				'description' 	=> __( 'Allow slides to be draggable', 'la-studio' ),
				'param_name' 	=> 'draggable',
				'value' 		=> array(
					__('Yes', 'la-studio') => 'yes'
				),
				'group'      	=> 'Advanced'
			),
			array(
				'type' 			=> 'checkbox',
				'heading' 		=> __('Touch Move', 'la-studio'),
				'description' 	=> __( 'Enable slide moving with touch', 'la-studio' ),
				'param_name' 	=> 'touch_move',
				'value' 		=> array(
					__('Yes', 'la-studio') => 'yes'
				),
				'dependency'  => array(
					'element' => 'draggable', 'value' => array( 'yes' )
				),
				'group'      	=> 'Advanced'
			),
			array(
				'type' 			=> 'checkbox',
				'heading' 		=> __('RTL Mode', 'la-studio'),
				'description' 	=> __( 'Turn on RTL mode', 'la-studio' ),
				'param_name' 	=> 'rtl',
				'value' 		=> array(
					__('Yes', 'la-studio') => 'yes'
				),
				'group'      	=> 'Advanced'
			),
			array(
				'type' 			=> 'checkbox',
				'heading' 		=> __('Adaptive Height', 'la-studio'),
				'description' 	=> __('Turn on Adaptive Height', 'la-studio' ),
				'param_name' 	=> 'adaptive_height',
				'value' 		=> array(
					__('Yes', 'la-studio') => 'yes'
				),
				'group'      	=> 'Advanced'
			),
			array(
				'type' 			=> 'checkbox',
				'heading' 		=> __('Pause on hover', 'la-studio'),
				'description' 	=> __('Pause the slider on hover', 'la-studio' ),
				'param_name' 	=> 'pauseohover',
				'value' 		=> array(
					__('Yes', 'la-studio') => 'yes'
				),
				'dependency'  => array(
					'element' => 'autoplay', 'value' => array( 'yes' )
				),
				'group'      	=> 'Advanced'
			),
			array(
				'type' 			=> 'checkbox',
				'heading' 		=> __('Center mode', 'la-studio'),
				'description' 	=> __("Enables centered view with partial prev/next slides. <br>Animations do not work with center mode.<br>Slides to scroll -> 'All Visible' do not work with center mode.", 'la-studio'),
				'param_name' 	=> 'centermode',
				'value' 		=> array(
					__('Yes', 'la-studio') => 'yes'
				),
				'group'      	=> 'Advanced'
			),
			array(
				'type' 			=> 'checkbox',
				'heading' 		=> __('Item Auto Width', 'la-studio'),
				'description' 	=> __('Variable width slides', 'la-studio' ),
				'param_name' 	=> 'autowidth',
				'value' 		=> array(
					__('Yes', 'la-studio') => 'yes'
				),
				'group'      	=> 'Advanced'
			),
			array(
				'type'       => 'la_number',
				'heading'    => __( 'Space between two items', 'la-studio' ),
				'param_name' => 'item_space',
				'value'      => '15',
				'min'        => 0,
				"max"        => '1000',
				'step'       => 1,
				'suffix'     => 'px',
				'group'      => 'Advanced',
			),

			array(
				'type'             => 'css_editor',
				'heading'          => __( 'Css', 'ultimate_vc' ),
				'param_name'       => 'css_ad_carousel',
				'group'            => __( 'Design ', 'ultimate_vc' )
			),
		),
		'js_view' => 'VcColumnView',
		'html_template' => LaStudio_Plugin::$plugin_dir_path . 'includes/shortcodes/templates/la_carousel.php'
	),
    'la_carousel'
);